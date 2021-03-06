<?php

require_once 'memberdues.civix.php';

/**
 * Implementation of hook_civicrm_config
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_config
 */
function memberdues_civicrm_config(&$config) {
  _memberdues_civix_civicrm_config($config);
}

/**
 * Implementation of hook_civicrm_xmlMenu
 *
 * @param $files array(string)
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_xmlMenu
 */
function memberdues_civicrm_xmlMenu(&$files) {
  _memberdues_civix_civicrm_xmlMenu($files);
}

/**
 * Implementation of hook_civicrm_install
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_install
 */
function memberdues_civicrm_install() {
  return _memberdues_civix_civicrm_install();
}

/**
 * Implementation of hook_civicrm_uninstall
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_uninstall
 */
function memberdues_civicrm_uninstall() {
  return _memberdues_civix_civicrm_uninstall();
}

/**
 * Implementation of hook_civicrm_enable
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_enable
 */
function memberdues_civicrm_enable() {
  return _memberdues_civix_civicrm_enable();
}

/**
 * Implementation of hook_civicrm_disable
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_disable
 */
function memberdues_civicrm_disable() {
  return _memberdues_civix_civicrm_disable();
}

/**
 * Implementation of hook_civicrm_upgrade
 *
 * @param $op string, the type of operation being performed; 'check' or 'enqueue'
 * @param $queue CRM_Queue_Queue, (for 'enqueue') the modifiable list of pending up upgrade tasks
 *
 * @return mixed  based on op. for 'check', returns array(boolean) (TRUE if upgrades are pending)
 *                for 'enqueue', returns void
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_upgrade
 */
function memberdues_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _memberdues_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implementation of hook_civicrm_managed
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_managed
 */
function memberdues_civicrm_managed(&$entities) {
  return _memberdues_civix_civicrm_managed($entities);
}

/**
 * Implementation of hook_civicrm_caseTypes
 *
 * Generate a list of case-types
 *
 * Note: This hook only runs in CiviCRM 4.4+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function memberdues_civicrm_caseTypes(&$caseTypes) {
  _memberdues_civix_civicrm_caseTypes($caseTypes);
}

/**
 * Implementation of hook_civicrm_alterSettingsFolders
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_alterSettingsFolders
 */
function memberdues_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _memberdues_civix_civicrm_alterSettingsFolders($metaDataFolders);
}

/**
 * Implementation of hook_civicrm_tabs
 *
 * @param $tabs
 *
 * @param $contactID
 */
function memberdues_civicrm_tabs(&$tabs, $contactID) {
  if (CRM_Core_Permission::check('show member dues')) {
    $url = CRM_Utils_System::url('civicrm/contact/view/memberdues', 'reset=1&snippet=1&force=1&cid=' . $contactID);

    $tabs[] = array(
      'id' => 'memberDues',
      'url' => $url,
      'title' => 'Member Dues',
      'weight' => 500
    );
  }
}

/**
 * Implementation of hook_civicrm_permission
 *
 * @param array $permissions
 */
function memberdues_civicrm_permission( array &$permissions ) {
  $prefix = ts('CiviCRM Member Dues') . ': ';
  $permissions['show member dues'] = $prefix . 'show member dues';
}