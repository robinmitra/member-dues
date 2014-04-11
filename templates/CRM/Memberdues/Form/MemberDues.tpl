{* HEADER *}
<div class="crm-submit-buttons">
{include file="CRM/common/formButtons.tpl" location="top"}
</div>

{* FIELD EXAMPLE: OPTION 1 (AUTOMATIC LAYOUT) *}

{*foreach from=$elementNames item=elementName}
  <div class="crm-section">
    <div class="label">{$form.$elementName.label}</div>
    <div class="content">{$form.$elementName.html}</div>
    <div class="clear"></div>
  </div>
{/foreach*}

<div class="crm-section">
    <div class="label">
        <label for="">{$form.start_date.label}</label>
    </div>
    <div class="content">
        {$form.start_date.html}
    </div>
    <div class="clear"></div>
</div>
<div class="crm-section">
    <div class="label">
        <label for="">{$form.end_date.label}</label>
    </div>
    <div class="content">
        {$form.end_date.html}
    </div>
    <div class="clear"></div>
</div>

{* FIELD EXAMPLE: OPTION 2 (MANUAL LAYOUT)

  <div>
    <span>{$form.favorite_color.label}</span>
    <span>{$form.favorite_color.html}</span>
  </div>

{* FOOTER *}
<div class="crm-submit-buttons">
{include file="CRM/common/formButtons.tpl" location="bottom"}
</div>

<div class="crm-section">
    <div class="label">
        <label for="">{$form.member_dues.label}</label>
    </div>
    <div class="content">
        {$form.member_dues.html}
    </div>
    <div class="clear"></div>
</div>

<p>Total member dues: <strong>{$total}</strong></p>