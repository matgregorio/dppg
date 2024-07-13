<?php /* Smarty version 2.6.26, created on 2016-10-08 21:32:41
         compiled from manager/setup/step3.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'url', 'manager/setup/step3.tpl', 14, false),array('function', 'fieldLabel', 'manager/setup/step3.tpl', 21, false),array('function', 'form_language_chooser', 'manager/setup/step3.tpl', 24, false),array('function', 'translate', 'manager/setup/step3.tpl', 25, false),array('modifier', 'assign', 'manager/setup/step3.tpl', 23, false),array('modifier', 'escape', 'manager/setup/step3.tpl', 40, false),array('modifier', 'date_format', 'manager/setup/step3.tpl', 50, false),)), $this); ?>
<?php $this->assign('pageTitle', "manager.setup.layout.title"); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "manager/setup/setupHeader.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<form name="setupForm" method="post" action="<?php echo $this->_plugins['function']['url'][0][0]->smartyUrl(array('op' => 'saveSetup','path' => '3'), $this);?>
" enctype="multipart/form-data">
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "common/formErrors.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php if (count ( $this->_tpl_vars['formLocales'] ) > 1): ?>
<div id="locales">
<table width="100%" class="data">
	<tr valign="top">
		<td width="20%" class="label"><?php echo $this->_plugins['function']['fieldLabel'][0][0]->smartyFieldLabel(array('name' => 'formLocale','key' => "form.formLanguage"), $this);?>
</td>
		<td width="80%" class="value">
			<?php echo ((is_array($_tmp=$this->_plugins['function']['url'][0][0]->smartyUrl(array('op' => 'setup','path' => '3','escape' => false), $this))) ? $this->_run_mod_handler('assign', true, $_tmp, 'setupFormUrl') : $this->_plugins['modifier']['assign'][0][0]->smartyAssign($_tmp, 'setupFormUrl'));?>

			<?php echo $this->_plugins['function']['form_language_chooser'][0][0]->smartyFormLanguageChooser(array('form' => 'setupForm','url' => $this->_tpl_vars['setupFormUrl']), $this);?>

			<span class="instruct"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "form.formLanguage.description"), $this);?>
</span>
		</td>
	</tr>
</table>
</div>
<?php endif; ?>
<div id="homepageHeader">
<h3>3.1 <?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.setup.layout.homepageHeader"), $this);?>
</h3>

<p><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.setup.layout.homepageHeader.description"), $this);?>
</p>
<div id="conferenceTitleInfo">
<h4><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.setup.layout.conferenceTitle"), $this);?>
</h4>

<table width="100%" class="data">
	<tr valign="top">
		<td width="20%" class="label"><input type="radio" name="homeHeaderTitleType[<?php echo ((is_array($_tmp=$this->_tpl_vars['formLocale'])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
]" id="homeHeaderTitleType-0" value="0"<?php if (! $this->_tpl_vars['homeHeaderTitleType'][$this->_tpl_vars['formLocale']]): ?> checked="checked"<?php endif; ?> /> <?php echo $this->_plugins['function']['fieldLabel'][0][0]->smartyFieldLabel(array('name' => "homeHeaderTitleType-0",'key' => "manager.setup.layout.useTextTitle"), $this);?>
</td>
		<td width="80%" class="value"><input type="text" name="homeHeaderTitle[<?php echo ((is_array($_tmp=$this->_tpl_vars['formLocale'])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
]" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['homeHeaderTitle'][$this->_tpl_vars['formLocale']])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
" size="40" maxlength="255" class="textField" /></td>
	</tr>
	<tr valign="top">
		<td width="20%" class="label"><input type="radio" name="homeHeaderTitleType[<?php echo ((is_array($_tmp=$this->_tpl_vars['formLocale'])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
]" id="homeHeaderTitleType-1" value="1"<?php if ($this->_tpl_vars['homeHeaderTitleType'][$this->_tpl_vars['formLocale']]): ?> checked="checked"<?php endif; ?> /> <?php echo $this->_plugins['function']['fieldLabel'][0][0]->smartyFieldLabel(array('name' => "homeHeaderTitleType-1",'key' => "manager.setup.layout.useImageTitle"), $this);?>
</td>
		<td width="80%" class="value"><input type="file" name="homeHeaderTitleImage" class="uploadField" /> <input type="submit" name="uploadHomeHeaderTitleImage" value="<?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "common.upload"), $this);?>
" class="button" /></td>
	</tr>
</table>

<?php if ($this->_tpl_vars['homeHeaderTitleImage'][$this->_tpl_vars['formLocale']]): ?>
<?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "common.fileName"), $this);?>
: <?php echo ((is_array($_tmp=$this->_tpl_vars['homeHeaderTitleImage'][$this->_tpl_vars['formLocale']]['name'])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['homeHeaderTitleImage'][$this->_tpl_vars['formLocale']]['dateUploaded'])) ? $this->_run_mod_handler('date_format', true, $_tmp, $this->_tpl_vars['datetimeFormatShort']) : smarty_modifier_date_format($_tmp, $this->_tpl_vars['datetimeFormatShort'])); ?>
 <input type="submit" name="deleteHomeHeaderTitleImage" value="<?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "common.delete"), $this);?>
" class="button" />
<br />
<img src="<?php echo $this->_tpl_vars['publicFilesDir']; ?>
/<?php echo ((is_array($_tmp=$this->_tpl_vars['homeHeaderTitleImage'][$this->_tpl_vars['formLocale']]['uploadName'])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
" width="<?php echo ((is_array($_tmp=$this->_tpl_vars['homeHeaderTitleImage'][$this->_tpl_vars['formLocale']]['width'])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
" height="<?php echo ((is_array($_tmp=$this->_tpl_vars['homeHeaderTitleImage'][$this->_tpl_vars['formLocale']]['height'])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
" style="border: 0;" alt="<?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "common.homePageHeader.altText"), $this);?>
" />
<br />
<table width="100%" class="data">
	<tr valign="top">
		<td width="20%" class="label"><?php echo $this->_plugins['function']['fieldLabel'][0][0]->smartyFieldLabel(array('name' => 'homeHeaderTitleImageAltText','key' => "common.altText"), $this);?>
</td>
		<td width="80%" class="value"><input type="text" id="homeHeaderTitleImageAltText" name="homeHeaderTitleImageAltText[<?php echo ((is_array($_tmp=$this->_tpl_vars['formLocale'])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
]" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['homeHeaderTitleImageAltText'][$this->_tpl_vars['formLocale']])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
" size="40" maxlength="255" class="textField" /></td>
	</tr>
	<tr valign="top">
		<td>&nbsp;</td>
		<td class="value"><span class="instruct"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "common.altTextInstructions"), $this);?>
</span></td>
	</tr>
</table>
<?php endif; ?>
</div>
<div id="conferenceLogoInfo">
<h4><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.setup.layout.conferenceLogo"), $this);?>
</h4>

<table width="100%" class="data">
	<tr valign="top">
		<td width="20%" class="label"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.setup.layout.useImageLogo"), $this);?>
</td>
		<td width="80%" class="value"><input type="file" name="homeHeaderLogoImage" class="uploadField" /> <input type="submit" name="uploadHomeHeaderLogoImage" value="<?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "common.upload"), $this);?>
" class="button" /></td>
	</tr>
</table>

<?php if ($this->_tpl_vars['homeHeaderLogoImage'][$this->_tpl_vars['formLocale']]): ?>
<?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "common.fileName"), $this);?>
: <?php echo ((is_array($_tmp=$this->_tpl_vars['homeHeaderLogoImage'][$this->_tpl_vars['formLocale']]['name'])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['homeHeaderLogoImage']['dateUploaded'])) ? $this->_run_mod_handler('date_format', true, $_tmp, $this->_tpl_vars['datetimeFormatShort']) : smarty_modifier_date_format($_tmp, $this->_tpl_vars['datetimeFormatShort'])); ?>
 <input type="submit" name="deleteHomeHeaderLogoImage" value="<?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "common.delete"), $this);?>
" class="button" />
<br />
<img src="<?php echo $this->_tpl_vars['publicFilesDir']; ?>
/<?php echo ((is_array($_tmp=$this->_tpl_vars['homeHeaderLogoImage'][$this->_tpl_vars['formLocale']]['uploadName'])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
" width="<?php echo ((is_array($_tmp=$this->_tpl_vars['homeHeaderLogoImage'][$this->_tpl_vars['formLocale']]['width'])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
" height="<?php echo ((is_array($_tmp=$this->_tpl_vars['homeHeaderLogoImage'][$this->_tpl_vars['formLocale']]['height'])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
" style="border: 0;" alt="<?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "common.homePageHeaderLogo.altText"), $this);?>
" />
<br />
<table width="100%" class="data">
	<tr valign="top">
		<td width="20%" class="label"><?php echo $this->_plugins['function']['fieldLabel'][0][0]->smartyFieldLabel(array('name' => 'homeHeaderLogoImageAltText','key' => "common.altText"), $this);?>
</td>
		<td width="80%" class="value"><input type="text" id="homeHeaderLogoImageAltText" name="homeHeaderLogoImageAltText[<?php echo ((is_array($_tmp=$this->_tpl_vars['formLocale'])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
]" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['homeHeaderLogoImageAltText'][$this->_tpl_vars['formLocale']])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
" size="40" maxlength="255" class="textField" /></td>
	</tr>
	<tr valign="top">
		<td>&nbsp;</td>
		<td class="value"><span class="instruct"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "common.altTextInstructions"), $this);?>
</span></td>
		</tr>
</table>
<?php endif; ?>
</div>
</div>
<div class="separator"></div>
<div id="conferencePageHeaderInfo">
<h3>3.2 <?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.setup.layout.conferencePageHeader"), $this);?>
</h3>

<p><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.setup.layout.conferencePageHeader.description"), $this);?>
</p>
<div id="conferenceTitle">
<h4><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.setup.layout.conferenceTitle"), $this);?>
</h4>

<table width="100%" class="data">
	<tr valign="top">
		<td width="20%" class="label"><input type="radio" name="pageHeaderTitleType[<?php echo ((is_array($_tmp=$this->_tpl_vars['formLocale'])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
]" id="pageHeaderTitleType-0" value="0"<?php if (! $this->_tpl_vars['pageHeaderTitleType'][$this->_tpl_vars['formLocale']]): ?> checked="checked"<?php endif; ?> /> <?php echo $this->_plugins['function']['fieldLabel'][0][0]->smartyFieldLabel(array('name' => "pageHeaderTitleType-0",'key' => "manager.setup.layout.useTextTitle"), $this);?>
</td>
		<td width="80%" class="value"><input type="text" name="pageHeaderTitle[<?php echo ((is_array($_tmp=$this->_tpl_vars['formLocale'])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
]" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['pageHeaderTitle'][$this->_tpl_vars['formLocale']])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
" size="40" maxlength="255" class="textField" /></td>
	</tr>
	<tr valign="top">
		<td width="20%" class="label"><input type="radio" name="pageHeaderTitleType[<?php echo ((is_array($_tmp=$this->_tpl_vars['formLocale'])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
]" id="pageHeaderTitleType-1" value="1"<?php if ($this->_tpl_vars['pageHeaderTitleType'][$this->_tpl_vars['formLocale']]): ?> checked="checked"<?php endif; ?> /> <?php echo $this->_plugins['function']['fieldLabel'][0][0]->smartyFieldLabel(array('name' => "pageHeaderTitleType-1",'key' => "manager.setup.layout.useImageTitle"), $this);?>
</td>
		<td width="80%" class="value"><input type="file" name="pageHeaderTitleImage" class="uploadField" /> <input type="submit" name="uploadPageHeaderTitleImage" value="<?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "common.upload"), $this);?>
" class="button" /></td>
	</tr>
</table>

<?php if ($this->_tpl_vars['pageHeaderTitleImage'][$this->_tpl_vars['formLocale']]): ?>
<?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "common.fileName"), $this);?>
: <?php echo ((is_array($_tmp=$this->_tpl_vars['pageHeaderTitleImage'][$this->_tpl_vars['formLocale']]['name'])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['pageHeaderTitleImage'][$this->_tpl_vars['formLocale']]['dateUploaded'])) ? $this->_run_mod_handler('date_format', true, $_tmp, $this->_tpl_vars['datetimeFormatShort']) : smarty_modifier_date_format($_tmp, $this->_tpl_vars['datetimeFormatShort'])); ?>
 <input type="submit" name="deletePageHeaderTitleImage" value="<?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "common.delete"), $this);?>
" class="button" />
<br />
<img src="<?php echo $this->_tpl_vars['publicFilesDir']; ?>
/<?php echo ((is_array($_tmp=$this->_tpl_vars['pageHeaderTitleImage'][$this->_tpl_vars['formLocale']]['uploadName'])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
" width="<?php echo ((is_array($_tmp=$this->_tpl_vars['pageHeaderTitleImage'][$this->_tpl_vars['formLocale']]['width'])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
" height="<?php echo ((is_array($_tmp=$this->_tpl_vars['pageHeaderTitleImage'][$this->_tpl_vars['formLocale']]['height'])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
" style="border: 0;" alt="<?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "common.pageHeader.altText"), $this);?>
" />
<br />
<table width="100%" class="data">
	<tr valign="top">
		<td width="20%" class="label"><?php echo $this->_plugins['function']['fieldLabel'][0][0]->smartyFieldLabel(array('name' => 'pageHeaderTitleImageAltText','key' => "common.altText"), $this);?>
</td>
		<td width="80%" class="value"><input type="text" id="pageHeaderTitleImageAltText" name="pageHeaderTitleImageAltText[<?php echo ((is_array($_tmp=$this->_tpl_vars['formLocale'])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
]" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['pageHeaderTitleImageAltText'][$this->_tpl_vars['formLocale']])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
" size="40" maxlength="255" class="textField" /></td>
	</tr>
	<tr valign="top">
		<td>&nbsp;</td>
		<td class="value"><span class="instruct"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "common.altTextInstructions"), $this);?>
</span></td>
		</tr>
</table>
<?php endif; ?>
</div>
<div id="conferenceLogo">
<h4><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.setup.layout.conferenceLogo"), $this);?>
</h4>

<table width="100%" class="data">
	<tr valign="top">
		<td width="20%" class="label"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.setup.layout.useImageLogo"), $this);?>
</td>
		<td width="80%" class="value"><input type="file" name="pageHeaderLogoImage" class="uploadField" /> <input type="submit" name="uploadPageHeaderLogoImage" value="<?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "common.upload"), $this);?>
" class="button" /></td>
	</tr>
</table>

<?php if ($this->_tpl_vars['pageHeaderLogoImage'][$this->_tpl_vars['formLocale']]): ?>
<?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "common.fileName"), $this);?>
: <?php echo ((is_array($_tmp=$this->_tpl_vars['pageHeaderLogoImage'][$this->_tpl_vars['formLocale']]['name'])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['pageHeaderLogoImage'][$this->_tpl_vars['formLocale']]['dateUploaded'])) ? $this->_run_mod_handler('date_format', true, $_tmp, $this->_tpl_vars['datetimeFormatShort']) : smarty_modifier_date_format($_tmp, $this->_tpl_vars['datetimeFormatShort'])); ?>
 <input type="submit" name="deletePageHeaderLogoImage" value="<?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "common.delete"), $this);?>
" class="button" />
<br />
<img src="<?php echo $this->_tpl_vars['publicFilesDir']; ?>
/<?php echo ((is_array($_tmp=$this->_tpl_vars['pageHeaderLogoImage'][$this->_tpl_vars['formLocale']]['uploadName'])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
" width="<?php echo ((is_array($_tmp=$this->_tpl_vars['pageHeaderLogoImage'][$this->_tpl_vars['formLocale']]['width'])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
" height="<?php echo ((is_array($_tmp=$this->_tpl_vars['pageHeaderLogoImage'][$this->_tpl_vars['formLocale']]['height'])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
" style="border: 0;" alt="<?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "common.pageHeaderLogo.altText"), $this);?>
" />
<br />
<table width="100%" class="data">
	<tr valign="top">
		<td width="20%" class="label"><?php echo $this->_plugins['function']['fieldLabel'][0][0]->smartyFieldLabel(array('name' => 'pageHeaderLogoImageAltText','key' => "common.altText"), $this);?>
</td>
		<td width="80%" class="value"><input type="text" id="pageHeaderLogoImageAltText" name="pageHeaderLogoImageAltText[<?php echo ((is_array($_tmp=$this->_tpl_vars['formLocale'])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
]" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['pageHeaderLogoImageAltText'][$this->_tpl_vars['formLocale']])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
" size="40" maxlength="255" class="textField" /></td>
	</tr>
	<tr valign="top">
		<td>&nbsp;</td>
		<td class="value"><span class="instruct"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "common.altTextInstructions"), $this);?>
</span></td>
		</tr>
</table>
<?php endif; ?>
</div>

<div id="conferenceFavicon">
<h4><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.setup.layout.favicon"), $this);?>
</h4>

<p><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.setup.layout.faviconDescription"), $this);?>
</p>

<table width="100%" class="data">
	<tr valign="top">
		<td width="20%" class="label"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.setup.layout.useImageLogo"), $this);?>
</td>
		<td width="80%" class="value"><input type="file" name="conferenceFavicon" class="uploadField" /> <input type="submit" name="uploadConferenceFavicon" value="<?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "common.upload"), $this);?>
" class="button" /></td>
	</tr>
</table>

<?php if ($this->_tpl_vars['conferenceFavicon'][$this->_tpl_vars['formLocale']]): ?>
<?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "common.fileName"), $this);?>
: <?php echo ((is_array($_tmp=$this->_tpl_vars['conferenceFavicon'][$this->_tpl_vars['formLocale']]['name'])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['conferenceFavicon'][$this->_tpl_vars['formLocale']]['dateUploaded'])) ? $this->_run_mod_handler('date_format', true, $_tmp, $this->_tpl_vars['datetimeFormatShort']) : smarty_modifier_date_format($_tmp, $this->_tpl_vars['datetimeFormatShort'])); ?>
 <input type="submit" name="deleteConferenceFavicon" value="<?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "common.delete"), $this);?>
" class="button" />
<br />
<img src="<?php echo $this->_tpl_vars['publicFilesDir']; ?>
/<?php echo ((is_array($_tmp=$this->_tpl_vars['conferenceFavicon'][$this->_tpl_vars['formLocale']]['uploadName'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp, 'url')); ?>
" width="16px" height="16px" style="border: 0;" alt="favicon" />
<?php endif; ?>
</div>

<div id="alternateHeader">
<h4><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.setup.layout.alternateHeader"), $this);?>
</h4>

<p><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.setup.layout.alternateHeaderDescription"), $this);?>
</p>

<p><textarea name="conferencePageHeader[<?php echo ((is_array($_tmp=$this->_tpl_vars['formLocale'])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
]" id="conferencePageHeader" rows="10" cols="60" class="textArea"><?php echo ((is_array($_tmp=$this->_tpl_vars['conferencePageHeader'][$this->_tpl_vars['formLocale']])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
</textarea></p>
</div>
</div>

<div class="separator"></div>

<div id="conferencePageFooterInfo">
<h3>3.3 <?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.setup.layout.conferencePageFooter"), $this);?>
</h3>

<p><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.setup.layout.conferencePageFooterDescription"), $this);?>
</p>

<p><textarea name="conferencePageFooter[<?php echo ((is_array($_tmp=$this->_tpl_vars['formLocale'])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
]" id="conferencePageFooter" rows="10" cols="60" class="textArea"><?php echo ((is_array($_tmp=$this->_tpl_vars['conferencePageFooter'][$this->_tpl_vars['formLocale']])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
</textarea></p>
</div>

<div class="separator"></div>
<div id="navigationBar">
<h3>3.4 <?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.setup.layout.navigationBar"), $this);?>
</h3>

<p><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.setup.layout.itemsDescription"), $this);?>
</p>

<table width="100%" class="data">
	<?php $_from = $this->_tpl_vars['navItems'][$this->_tpl_vars['formLocale']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['navItems'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['navItems']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['navItemId'] => $this->_tpl_vars['navItem']):
        $this->_foreach['navItems']['iteration']++;
?>
		<tr valign="top">
			<td width="20%" class="label"><?php echo $this->_plugins['function']['fieldLabel'][0][0]->smartyFieldLabel(array('name' => "navItems-".($this->_tpl_vars['navItemId'])."-name",'key' => "manager.setup.layout.labelName"), $this);?>
</td>
			<td width="80%" class="value">
				<input type="text" name="navItems[<?php echo ((is_array($_tmp=$this->_tpl_vars['formLocale'])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
][<?php echo $this->_tpl_vars['navItemId']; ?>
][name]" id="navItems-<?php echo $this->_tpl_vars['navItemId']; ?>
-name" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['navItem']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
" size="30" maxlength="90" class="textField" /> <input type="submit" name="delNavItem[<?php echo $this->_tpl_vars['navItemId']; ?>
]" value="<?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "common.delete"), $this);?>
" class="button" />
				<table width="100%">
					<tr valign="top">
						<td width="5%"><input type="checkbox" name="navItems[<?php echo ((is_array($_tmp=$this->_tpl_vars['formLocale'])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
][<?php echo $this->_tpl_vars['navItemId']; ?>
][isLiteral]" id="navItems-<?php echo $this->_tpl_vars['navItemId']; ?>
-isLiteral" value="1"<?php if ($this->_tpl_vars['navItem']['isLiteral']): ?> checked="checked"<?php endif; ?> /></td>
						<td width="95%"><?php echo $this->_plugins['function']['fieldLabel'][0][0]->smartyFieldLabel(array('name' => "navItems-".($this->_tpl_vars['navItemId'])."-isLiteral",'key' => "manager.setup.layout.navItemIsLiteral"), $this);?>
</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr valign="top">
			<td width="20%" class="label"><?php echo $this->_plugins['function']['fieldLabel'][0][0]->smartyFieldLabel(array('name' => "navItems-".($this->_tpl_vars['navItemId'])."-url",'key' => "common.url"), $this);?>
</td>
			<td width="80%" class="value">
				<input type="text" name="navItems[<?php echo ((is_array($_tmp=$this->_tpl_vars['formLocale'])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
][<?php echo $this->_tpl_vars['navItemId']; ?>
][url]" id="navItems-<?php echo $this->_tpl_vars['navItemId']; ?>
-url" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['navItem']['url'])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
" size="60" maxlength="255" class="textField" />
				<table width="100%">
					<tr valign="top">
						<td width="5%"><input type="checkbox" name="navItems[<?php echo ((is_array($_tmp=$this->_tpl_vars['formLocale'])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
][<?php echo $this->_tpl_vars['navItemId']; ?>
][isAbsolute]" id="navItems-<?php echo $this->_tpl_vars['navItemId']; ?>
-isAbsolute" value="1"<?php if ($this->_tpl_vars['navItem']['isAbsolute']): ?> checked="checked"<?php endif; ?> /></td>
						<td width="95%"><?php echo $this->_plugins['function']['fieldLabel'][0][0]->smartyFieldLabel(array('name' => "navItems-".($this->_tpl_vars['navItemId'])."-isAbsolute",'key' => "manager.setup.layout.navItemIsAbsolute"), $this);?>
</label></td>
					</tr>
				</table>
			</td>
		</tr>
		<?php if (! ($this->_foreach['navItems']['iteration'] == $this->_foreach['navItems']['total'])): ?>
			<tr valign="top">
				<td colspan="2" class="separator">&nbsp;</td>
			</tr>
		<?php endif; ?>
	<?php endforeach; else: ?>
		<tr valign="top">
			<td width="20%" class="label"><?php echo $this->_plugins['function']['fieldLabel'][0][0]->smartyFieldLabel(array('name' => "navItems-0-name",'key' => "manager.setup.layout.labelName"), $this);?>
</td>
			<td width="80%" class="value">
				<input type="text" name="navItems[<?php echo ((is_array($_tmp=$this->_tpl_vars['formLocale'])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
][0][name]" id="navItems-0-name" size="30" maxlength="90" class="textField" />
				<table width="100%">
					<tr valign="top">
						<td width="5%"><input type="checkbox" name="navItems[<?php echo ((is_array($_tmp=$this->_tpl_vars['formLocale'])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
][0][isLiteral]" id="navItems-0-isLiteral" value="1" /></td>
						<td width="95%"><?php echo $this->_plugins['function']['fieldLabel'][0][0]->smartyFieldLabel(array('name' => "navItems-0-isLiteral",'key' => "manager.setup.layout.navItemIsLiteral"), $this);?>
</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr valign="top">
			<td width="20%" class="label"><?php echo $this->_plugins['function']['fieldLabel'][0][0]->smartyFieldLabel(array('name' => "navItems-0-url",'key' => "common.url"), $this);?>
</td>
			<td width="80%" class="value">
				<input type="text" name="navItems[<?php echo ((is_array($_tmp=$this->_tpl_vars['formLocale'])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
][0][url]" id="navItems-0-url" size="60" maxlength="255" class="textField" />
				<table width="100%">
					<tr valign="top">
						<td width="5%"><input type="checkbox" name="[<?php echo ((is_array($_tmp=$this->_tpl_vars['formLocale'])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
]navItems[0][isAbsolute]" id="navItems-0-isAbsolute" value="1" /></td>
						<td width="95%"><?php echo $this->_plugins['function']['fieldLabel'][0][0]->smartyFieldLabel(array('name' => "navItems-0-isAbsolute",'key' => "manager.setup.layout.navItemIsAbsolute"), $this);?>
</td>
					</tr>
				</table>
			</td>
		</tr>
	<?php endif; unset($_from); ?>
</table>

<p><input type="submit" name="addNavItem" value="<?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.setup.layout.addNavItem"), $this);?>
" class="button" /></p>
</div>
<div class="separator"></div>

<div id="lists">
<h3>3.5 <?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.setup.layout.lists"), $this);?>
</h3>

<p><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.setup.layout.lists.description"), $this);?>
</p>

<table width="100%" class="data">
	<tr valign="top">
		<td width="20%" class="label"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.setup.layout.itemsPerPage"), $this);?>
</td>
		<td width="80%" class="value"><input type="text" size="3" name="itemsPerPage" class="textField" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['itemsPerPage'])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
" /></td>
	</tr>
	<tr valign="top">
		<td width="20%" class="label"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.setup.layout.numPageLinks"), $this);?>
</td>
		<td width="80%" class="value"><input type="text" size="3" name="numPageLinks" class="textField" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['numPageLinks'])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
" /></td>
	</tr>
</table>
</div>
<div class="separator"></div>

<p><input type="submit" value="<?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "common.saveAndContinue"), $this);?>
" class="button defaultButton" /> <input type="button" value="<?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "common.cancel"), $this);?>
" class="button" onclick="document.location.href='<?php echo $this->_plugins['function']['url'][0][0]->smartyUrl(array('op' => 'setup'), $this);?>
'" /></p>

<p><span class="formRequired"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "common.requiredField"), $this);?>
</span></p>

</form>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "common/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>