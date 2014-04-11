<?php

require_once 'CRM/Core/Form.php';

/**
 * Form controller class
 *
 * @see http://wiki.civicrm.org/confluence/display/CRMDOC43/QuickForm+Reference
 */
class CRM_Memberdues_Form_MemberDues extends CRM_Core_Form
{
  function buildQuickForm()
  {
    $this->addFormFields();
    $this->addTotalMembershipDues();
    parent::buildQuickForm();
  }

  /**
   * Add form fields to the template
   */
  protected function addFormFields()
  {
    $this->add(
      'date',
      'start_date',
      'Start Date',
      array('minYear' => 2000, 'maxYear' => 2014, 'addEmptyOption' => true)
    );

    $this->add(
      'date',
      'end_date',
      'End Date',
      array('minYear' => 2000, 'maxYear' => 2014, 'addEmptyOption' => true)
    );

    $this->addButtons(array(
      array(
        'type' => 'submit',
        'name' => ts('Submit'),
        'isDefault' => TRUE,
      ),
    ));

    // export form elements
    $this->assign('elementNames', $this->getRenderableElementNames());
  }

  /**
   * Add total amount of membership dues to the template
   */
  protected function addTotalMembershipDues()
  {
    $total = $this->getTotalMembershipDues();
    $this->assign('total', $total);
  }

  /**
   * Return total amount of membership dues for the current contact
   *
   * @return int
   */
  protected function getTotalMembershipDues()
  {
    $values = $this->exportValues();

    $contactId = $this->getContactID();

    /** @var int $financialTypeId Value of 2 refers to 'Membership dues' */
    $financialTypeId = 2;

    $startDate = $this->getStartDate($values);
    $endDate = $this->getEndDate($values);

    $sql = "
      SELECT SUM(total_amount) AS total
      FROM civicrm_contribution
      WHERE contact_id = %0
      AND financial_type_id = %1
      AND receive_date > %2
      AND receive_date < %3
	  ";

    $params = array(
      array($contactId, 'Int'),
      array($financialTypeId, 'Int'),
      array($startDate, 'String'),
      array($endDate, 'String')
    );

    // $queryStr = CRM_Core_DAO::composeQuery($sql, $params, true);

    /** @var CRM_Core_DAO $result */
    $result = CRM_Core_DAO::executeQuery($sql, $params);

    /** @var DB_result $dbResult */
    $dbResult = $result->getDatabaseResult();

    /** @var int $total Total contribution amount */
    $total = (int)reset($dbResult->fetchRow());

    return $total;
  }

  /**
   * Return end date in standard MySQL format
   *
   * @param $values
   *
   * @return string
   */
  protected function getEndDate($values)
  {
    $endDate = null;

    if (array_key_exists('end_date', $values)) {
      $endDate = $this->getMysqlDate($values['end_date']);
    } else {
      $dateTime = new DateTime();
      $endDate = $dateTime->format('Y-m-d 00:00:00');
    }

    return $endDate;
  }

  /**
   * Return start date in standard MySQL format
   *
   * @param array $values
   *
   * @return string
   */
  protected function getStartDate(array $values)
  {
    $startDate = null;

    if (array_key_exists('start_date', $values)) {
      $startDate = $this->getMysqlDate($values['start_date']);
    } else {
      $dateTime = new DateTime();
      $dateTime->modify('-1 year');
      $startDate = $dateTime->format('Y-m-d 00:00:00');
    }

    return $startDate;
  }

  /**
   * Get the fields/elements defined in this form.
   *
   * @return array (string)
   */
  public function getRenderableElementNames()
  {
    // The _elements list includes some items which should not be
    // auto-rendered in the loop -- such as "qfKey" and "buttons".  These
    // items don't have labels.  We'll identify renderable by filtering on
    // the 'label'.
    $elementNames = array();
    foreach ($this->_elements as $element) {
      $label = $element->getLabel();
      if (!empty($label)) {
        $elementNames[] = $element->getName();
      }
    }
    return $elementNames;
  }

  /**
   * Get date in standard MySQL format
   *
   * @param array $dateArr
   *
   * @return string
   */
  protected function getMysqlDate(array $dateArr)
  {
    $day = str_pad($dateArr['d'], 2, '0', STR_PAD_LEFT);
    $month = str_pad($dateArr['M'], 2, '0', STR_PAD_LEFT);
    $year = $dateArr['Y'];

    $date = $year . '-' . $month . '-' . $day . ' 00:00:00';

    return $date;
  }
}