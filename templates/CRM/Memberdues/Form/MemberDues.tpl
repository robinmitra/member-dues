{* HEADER *}
<div class="crm-submit-buttons">
{include file="CRM/common/formButtons.tpl" location="top"}
</div>

<div class="crm-section">
    <div class="label">
        <label>{$form.start_date.label}</label>
    </div>
    <div class="content">
        {$form.start_date.html}
    </div>
    <div class="clear"></div>
</div>
<div class="crm-section">
    <div class="label">
        <label>{$form.end_date.label}</label>
    </div>
    <div class="content">
        {$form.end_date.html}
    </div>
    <div class="clear"></div>
</div>

<div class="crm-submit-buttons">
{include file="CRM/common/formButtons.tpl" location="bottom"}
</div>

<div class="crm-section">
    <div class="label">
        <label>{$form.member_dues.label}</label>
    </div>
    <div class="content">
        {$form.member_dues.html}
    </div>
    <div class="clear"></div>
</div>

<p>Total member dues: <strong>{$total}</strong></p>
{* FOOTER *}