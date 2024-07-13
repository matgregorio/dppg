<?php /* Smarty version 2.6.26, created on 2014-03-31 12:07:47
         compiled from manager/setup/step2.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'url', 'manager/setup/step2.tpl', 14, false),array('function', 'fieldLabel', 'manager/setup/step2.tpl', 21, false),array('function', 'form_language_chooser', 'manager/setup/step2.tpl', 24, false),array('function', 'translate', 'manager/setup/step2.tpl', 25, false),array('function', 'html_options', 'manager/setup/step2.tpl', 42, false),array('modifier', 'assign', 'manager/setup/step2.tpl', 23, false),array('modifier', 'date_format', 'manager/setup/step2.tpl', 61, false),array('modifier', 'escape', 'manager/setup/step2.tpl', 68, false),)), $this); ?>
<?php $this->assign('pageTitle', "manager.setup.additionalContent.title"); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "manager/setup/setupHeader.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<form name="setupForm" method="post" action="<?php echo $this->_plugins['function']['url'][0][0]->smartyUrl(array('op' => 'saveSetup','path' => '2'), $this);?>
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
			<?php echo ((is_array($_tmp=$this->_plugins['function']['url'][0][0]->smartyUrl(array('op' => 'setup','path' => '2','escape' => false), $this))) ? $this->_run_mod_handler('assign', true, $_tmp, 'setupFormUrl') : $this->_plugins['modifier']['assign'][0][0]->smartyAssign($_tmp, 'setupFormUrl'));?>

			<?php echo $this->_plugins['function']['form_language_chooser'][0][0]->smartyFormLanguageChooser(array('form' => 'setupForm','url' => $this->_tpl_vars['setupFormUrl']), $this);?>

			<span class="instruct"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "form.formLanguage.description"), $this);?>
</span>
		</td>
	</tr>
</table>
</div>
<?php endif; ?>
<div id="redirect">
<h3>2.1 <?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.setup.additionalContent.redirect"), $this);?>
</h3>

<p><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.setup.additionalContent.redirect.description"), $this);?>
</p>

<table width="100%" class="data">
	<tr valign="top">
		<td width="20%" class="label"><?php echo $this->_plugins['function']['fieldLabel'][0][0]->smartyFieldLabel(array('name' => 'schedConfRedirect','key' => "manager.setup.additionalContent.schedConfRedirect"), $this);?>
</td>
		<td width="80%" class="value">
			<select name="schedConfRedirect" id="schedConfRedirect" class="selectMenu">
				<option value=""><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.setup.additionalContent.redirect.noSchedConfRedirect"), $this);?>
</option>
				<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['schedConfTitles'],'selected' => $this->_tpl_vars['schedConfRedirect']), $this);?>

			</select>
		</td>
	</tr>
</table>
</div>
<div id="homepage">
<h3>2.2 <?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.setup.additionalContent.homepage"), $this);?>
</h3>
<div id="homepageImageInfo">
<h4><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.setup.additionalContent.homepageImage"), $this);?>
</h4>

<table width="100%" class="data">
	<tr valign="top">
		<td width="20%" class="label"><?php echo $this->_plugins['function']['fieldLabel'][0][0]->smartyFieldLabel(array('name' => 'homepageImage','key' => "manager.setup.additionalContent.homepageImage"), $this);?>
</td>
		<td width="80%" class="value"><input type="file" id="homepageImage" name="homepageImage" class="uploadField" /> <input type="submit" name="uploadHomepageImage" value="<?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "common.upload"), $this);?>
" class="button" /></td>
	</tr>
</table>

<?php if ($this->_tpl_vars['homepageImage'][$this->_tpl_vars['formLocale']]): ?>
<?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "common.fileName"), $this);?>
: <?php echo $this->_tpl_vars['homepageImage'][$this->_tpl_vars['formLocale']]['name']; ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['homepageImage'][$this->_tpl_vars['formLocale']]['dateUploaded'])) ? $this->_run_mod_handler('date_format', true, $_tmp, $this->_tpl_vars['datetimeFormatShort']) : smarty_modifier_date_format($_tmp, $this->_tpl_vars['datetimeFormatShort'])); ?>
 <input type="submit" name="deleteHomepageImage" value="<?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "common.delete"), $this);?>
" class="button" />
<br />
<img src="<?php echo $this->_tpl_vars['publicFilesDir']; ?>
/<?php echo $this->_tpl_vars['homepageImage'][$this->_tpl_vars['formLocale']]['uploadName']; ?>
" width="<?php echo $this->_tpl_vars['homepageImage'][$this->_tpl_vars['formLocale']]['width']; ?>
" height="<?php echo $this->_tpl_vars['homepageImage'][$this->_tpl_vars['formLocale']]['height']; ?>
" style="border: 0;" alt="<?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "common.conferenceHomepageImage.altText"), $this);?>
" />
<br />
<table width="100%" class="data">
	<tr valign="top">
		<td width="20%" class="label"><?php echo $this->_plugins['function']['fieldLabel'][0][0]->smartyFieldLabel(array('name' => 'homepageImageAltText','key' => "common.altText"), $this);?>
</td>
		<td width="80%" class="value"><input type="text" id="homepageImageAltText" name="homepageImageAltText[<?php echo ((is_array($_tmp=$this->_tpl_vars['formLocale'])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
]" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['homepageImageAltText'][$this->_tpl_vars['formLocale']])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
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
<div id="additionalContent">
<h4><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.setup.additionalContent.additionalContent"), $this);?>
</h4>

<p><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.setup.additionalContent.additionalContent.description"), $this);?>
</p>

<p><textarea name="additionalHomeContent[<?php echo ((is_array($_tmp=$this->_tpl_vars['formLocale'])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
]" id="additionalHomeContent" rows="10" cols="60" class="textArea"><?php echo ((is_array($_tmp=$this->_tpl_vars['additionalHomeContent'][$this->_tpl_vars['formLocale']])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
</textarea></p>
</div>
</div>
<div class="separator"></div>
<div id="additionalInformation">
<h3>2.3 <?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.setup.additionalContent.information"), $this);?>
</h3>

<p><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.setup.additionalContent.information.description"), $this);?>
</p>
<div id="infoForReaders">
<h4><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.setup.additionalContent.information.forReaders"), $this);?>
</h4>

<p><textarea name="readerInformation[<?php echo ((is_array($_tmp=$this->_tpl_vars['formLocale'])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
]" id="readerInformation" rows="10" cols="60" class="textArea"><?php echo ((is_array($_tmp=$this->_tpl_vars['readerInformation'][$this->_tpl_vars['formLocale']])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
</textarea></p>
</div>
<div id="forAuthors">
<h4><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.setup.additionalContent.information.forAuthors"), $this);?>
</h4>

<p><textarea name="authorInformation[<?php echo ((is_array($_tmp=$this->_tpl_vars['formLocale'])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
]" id="authorInformation" rows="10" cols="60" class="textArea"><?php echo ((is_array($_tmp=$this->_tpl_vars['authorInformation'][$this->_tpl_vars['formLocale']])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
</textarea></p>
</div>
</div>
<div class="separator"></div>
<div id="announcementsSetup">
<h3>2.4 <?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.setup.additionalContent.announcements"), $this);?>
</h3>

<p><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.setup.additionalContent.announcementsDescription"), $this);?>
</p>

	<script type="text/javascript">
		<?php echo '
		<!--
			function toggleEnableAnnouncementsHomepage(form) {
				form.numAnnouncementsHomepage.disabled = !form.numAnnouncementsHomepage.disabled;
			}
		// -->
		'; ?>

	</script>

<p>
	<input type="checkbox" name="enableAnnouncements" id="enableAnnouncements" value="1" <?php if ($this->_tpl_vars['enableAnnouncements']): ?> checked="checked"<?php endif; ?> />&nbsp;
	<?php echo $this->_plugins['function']['fieldLabel'][0][0]->smartyFieldLabel(array('name' => 'enableAnnouncements','key' => "manager.setup.additionalContent.enableAnnouncements"), $this);?>

</p>

<p>
	<input type="checkbox" name="enableAnnouncementsHomepage" id="enableAnnouncementsHomepage" value="1" onclick="toggleEnableAnnouncementsHomepage(this.form)"<?php if ($this->_tpl_vars['enableAnnouncementsHomepage']): ?> checked="checked"<?php endif; ?> />&nbsp;
	<?php echo $this->_plugins['function']['fieldLabel'][0][0]->smartyFieldLabel(array('name' => 'enableAnnouncementsHomepage','key' => "manager.setup.additionalContent.enableAnnouncementsHomepage1"), $this);?>

	<select name="numAnnouncementsHomepage" size="1" class="selectMenu" <?php if (! $this->_tpl_vars['enableAnnouncementsHomepage']): ?>disabled="disabled"<?php endif; ?>>
		<?php unset($this->_sections['numAnnouncementsHomepageOptions']);
$this->_sections['numAnnouncementsHomepageOptions']['name'] = 'numAnnouncementsHomepageOptions';
$this->_sections['numAnnouncementsHomepageOptions']['start'] = (int)1;
$this->_sections['numAnnouncementsHomepageOptions']['loop'] = is_array($_loop=11) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['numAnnouncementsHomepageOptions']['show'] = true;
$this->_sections['numAnnouncementsHomepageOptions']['max'] = $this->_sections['numAnnouncementsHomepageOptions']['loop'];
$this->_sections['numAnnouncementsHomepageOptions']['step'] = 1;
if ($this->_sections['numAnnouncementsHomepageOptions']['start'] < 0)
    $this->_sections['numAnnouncementsHomepageOptions']['start'] = max($this->_sections['numAnnouncementsHomepageOptions']['step'] > 0 ? 0 : -1, $this->_sections['numAnnouncementsHomepageOptions']['loop'] + $this->_sections['numAnnouncementsHomepageOptions']['start']);
else
    $this->_sections['numAnnouncementsHomepageOptions']['start'] = min($this->_sections['numAnnouncementsHomepageOptions']['start'], $this->_sections['numAnnouncementsHomepageOptions']['step'] > 0 ? $this->_sections['numAnnouncementsHomepageOptions']['loop'] : $this->_sections['numAnnouncementsHomepageOptions']['loop']-1);
if ($this->_sections['numAnnouncementsHomepageOptions']['show']) {
    $this->_sections['numAnnouncementsHomepageOptions']['total'] = min(ceil(($this->_sections['numAnnouncementsHomepageOptions']['step'] > 0 ? $this->_sections['numAnnouncementsHomepageOptions']['loop'] - $this->_sections['numAnnouncementsHomepageOptions']['start'] : $this->_sections['numAnnouncementsHomepageOptions']['start']+1)/abs($this->_sections['numAnnouncementsHomepageOptions']['step'])), $this->_sections['numAnnouncementsHomepageOptions']['max']);
    if ($this->_sections['numAnnouncementsHomepageOptions']['total'] == 0)
        $this->_sections['numAnnouncementsHomepageOptions']['show'] = false;
} else
    $this->_sections['numAnnouncementsHomepageOptions']['total'] = 0;
if ($this->_sections['numAnnouncementsHomepageOptions']['show']):

            for ($this->_sections['numAnnouncementsHomepageOptions']['index'] = $this->_sections['numAnnouncementsHomepageOptions']['start'], $this->_sections['numAnnouncementsHomepageOptions']['iteration'] = 1;
                 $this->_sections['numAnnouncementsHomepageOptions']['iteration'] <= $this->_sections['numAnnouncementsHomepageOptions']['total'];
                 $this->_sections['numAnnouncementsHomepageOptions']['index'] += $this->_sections['numAnnouncementsHomepageOptions']['step'], $this->_sections['numAnnouncementsHomepageOptions']['iteration']++):
$this->_sections['numAnnouncementsHomepageOptions']['rownum'] = $this->_sections['numAnnouncementsHomepageOptions']['iteration'];
$this->_sections['numAnnouncementsHomepageOptions']['index_prev'] = $this->_sections['numAnnouncementsHomepageOptions']['index'] - $this->_sections['numAnnouncementsHomepageOptions']['step'];
$this->_sections['numAnnouncementsHomepageOptions']['index_next'] = $this->_sections['numAnnouncementsHomepageOptions']['index'] + $this->_sections['numAnnouncementsHomepageOptions']['step'];
$this->_sections['numAnnouncementsHomepageOptions']['first']      = ($this->_sections['numAnnouncementsHomepageOptions']['iteration'] == 1);
$this->_sections['numAnnouncementsHomepageOptions']['last']       = ($this->_sections['numAnnouncementsHomepageOptions']['iteration'] == $this->_sections['numAnnouncementsHomepageOptions']['total']);
?>
		<option value="<?php echo $this->_sections['numAnnouncementsHomepageOptions']['index']; ?>
"<?php if ($this->_tpl_vars['numAnnouncementsHomepage'] == $this->_sections['numAnnouncementsHomepageOptions']['index'] || ( $this->_sections['numAnnouncementsHomepageOptions']['index'] == 1 && ! $this->_tpl_vars['numAnnouncementsHomepage'] )): ?> selected="selected"<?php endif; ?>><?php echo $this->_sections['numAnnouncementsHomepageOptions']['index']; ?>
</option>
		<?php endfor; endif; ?>
	</select>
	<?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.setup.additionalContent.enableAnnouncementsHomepage2"), $this);?>

</p>
<div id="announcementsIntroductionInfo">
<h4><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.setup.additionalContent.announcementsIntroduction"), $this);?>
</h4>

<p><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.setup.additionalContent.announcementsIntroductionDescription"), $this);?>
</p>

<p><textarea name="announcementsIntroduction[<?php echo ((is_array($_tmp=$this->_tpl_vars['formLocale'])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
]" id="announcementsIntroduction" rows="10" cols="60" class="textArea"><?php echo ((is_array($_tmp=$this->_tpl_vars['announcementsIntroduction'][$this->_tpl_vars['formLocale']])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
</textarea></p>
</div>
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