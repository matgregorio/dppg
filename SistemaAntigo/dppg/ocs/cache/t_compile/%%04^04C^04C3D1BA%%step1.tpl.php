<?php /* Smarty version 2.6.26, created on 2014-03-31 12:06:44
         compiled from manager/setup/step1.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'url', 'manager/setup/step1.tpl', 14, false),array('function', 'fieldLabel', 'manager/setup/step1.tpl', 21, false),array('function', 'form_language_chooser', 'manager/setup/step1.tpl', 24, false),array('function', 'translate', 'manager/setup/step1.tpl', 25, false),array('modifier', 'assign', 'manager/setup/step1.tpl', 23, false),array('modifier', 'escape', 'manager/setup/step1.tpl', 37, false),)), $this); ?>
<?php $this->assign('pageTitle', "manager.setup.aboutConference.title"); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "manager/setup/setupHeader.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<form name="setupForm" method="post" action="<?php echo $this->_plugins['function']['url'][0][0]->smartyUrl(array('op' => 'saveSetup','path' => '1'), $this);?>
">
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
			<?php echo ((is_array($_tmp=$this->_plugins['function']['url'][0][0]->smartyUrl(array('op' => 'setup','path' => '1','escape' => false), $this))) ? $this->_run_mod_handler('assign', true, $_tmp, 'setupFormUrl') : $this->_plugins['modifier']['assign'][0][0]->smartyAssign($_tmp, 'setupFormUrl'));?>

			<?php echo $this->_plugins['function']['form_language_chooser'][0][0]->smartyFormLanguageChooser(array('form' => 'setupForm','url' => $this->_tpl_vars['setupFormUrl']), $this);?>

			<span class="instruct"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "form.formLanguage.description"), $this);?>
</span>
		</td>
	</tr>
</table>
</div>
<?php endif; ?>
<div id="titleInfo">
<h3>1.1 <?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "common.title"), $this);?>
</h3>

<table width="100%" class="data">
	<tr valign="top">
		<td width="20%" class="label"><?php echo $this->_plugins['function']['fieldLabel'][0][0]->smartyFieldLabel(array('name' => 'title','key' => "common.title",'required' => 'true'), $this);?>
</td>
		<td width="80%" class="value"><input type="text" name="title[<?php echo ((is_array($_tmp=$this->_tpl_vars['formLocale'])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
]" id="title" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['title'][$this->_tpl_vars['formLocale']])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
" size="30" maxlength="120" class="textField" /></td>
	</tr>
</table>
</div>
<div class="separator"></div>
<div id="descriptionInfo">
<h3><label for="description">1.2 <?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.setup.aboutConference.conferenceDescription"), $this);?>
</label></h3>
<span class="instruct"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.setup.aboutConference.conferenceDescription.description"), $this);?>
</span>

<textarea name="description[<?php echo ((is_array($_tmp=$this->_tpl_vars['formLocale'])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
]" id="description" rows="5" cols="60" class="textArea"><?php echo ((is_array($_tmp=$this->_tpl_vars['description'][$this->_tpl_vars['formLocale']])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
</textarea>
</div>
<div class="separator"></div>
<div id="principalContact">
<h3>1.3 <?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.setup.aboutConference.principalContact"), $this);?>
</h3>

<table width="100%" class="data">
	<tr valign="top">
		<td width="20%" class="label"><?php echo $this->_plugins['function']['fieldLabel'][0][0]->smartyFieldLabel(array('name' => 'contactName','key' => "user.name",'required' => 'true'), $this);?>
</td>
		<td width="80%" class="value"><input type="text" name="contactName" id="contactName" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['contactName'])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
" size="30" maxlength="60" class="textField" /></td>
	</tr>
	<tr valign="top">
		<td width="20%" class="label"><?php echo $this->_plugins['function']['fieldLabel'][0][0]->smartyFieldLabel(array('name' => 'contactTitle','key' => "user.title"), $this);?>
</td>
		<td width="80%" class="value"><input type="text" name="contactTitle" id="contactTitle" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['contactTitle'])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
" size="30" maxlength="90" class="textField" /></td>
	</tr>	
	<tr valign="top">
		<td width="20%" class="label"><?php echo $this->_plugins['function']['fieldLabel'][0][0]->smartyFieldLabel(array('name' => 'contactAffiliation','key' => "user.affiliation"), $this);?>
</td>
		<td width="80%" class="value"><textarea name="contactAffiliation[<?php echo ((is_array($_tmp=$this->_tpl_vars['formLocale'])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
]" id="contactAffiliation" rows="5" cols="40" class="textArea"><?php echo ((is_array($_tmp=$this->_tpl_vars['contactAffiliation'][$this->_tpl_vars['formLocale']])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
</textarea></td>
	</tr>
	<tr valign="top">
		<td width="20%" class="label"><?php echo $this->_plugins['function']['fieldLabel'][0][0]->smartyFieldLabel(array('name' => 'contactEmail','key' => "user.email",'required' => 'true'), $this);?>
</td>
		<td width="80%" class="value"><input type="text" name="contactEmail" id="contactEmail" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['contactEmail'])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
" size="30" maxlength="90" class="textField" /></td>
	</tr>
	<tr valign="top">
		<td width="20%" class="label"><?php echo $this->_plugins['function']['fieldLabel'][0][0]->smartyFieldLabel(array('name' => 'contactPhone','key' => "user.phone"), $this);?>
</td>
		<td width="80%" class="value"><input type="text" name="contactPhone" id="contactPhone" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['contactPhone'])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
" size="15" maxlength="24" class="textField" /></td>
	</tr>
	<tr valign="top">
		<td width="20%" class="label"><?php echo $this->_plugins['function']['fieldLabel'][0][0]->smartyFieldLabel(array('name' => 'contactFax','key' => "user.fax"), $this);?>
</td>
		<td width="80%" class="value"><input type="text" name="contactFax" id="contactFax" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['contactFax'])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
" size="15" maxlength="24" class="textField" /></td>
	</tr>
	<tr valign="top">
		<td width="20%" class="label"><?php echo $this->_plugins['function']['fieldLabel'][0][0]->smartyFieldLabel(array('name' => 'contactMailingAddress','key' => "common.mailingAddress"), $this);?>
</td>
		<td width="80%" class="value"><textarea name="contactMailingAddress" id="contactMailingAddress" rows="3" cols="40" class="textArea"><?php echo ((is_array($_tmp=$this->_tpl_vars['contactMailingAddress'])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
</textarea></td>
	</tr>
</table>
</div>
<div class="separator"></div>
<div id="copyrightNoticeInfo">
<h3><label for="copyrightNotice">1.4 <?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.setup.aboutConference.copyrightNotice"), $this);?>
</label></h3>
<p><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.setup.aboutConference.copyrightNotice.description"), $this);?>
</p>

<p><textarea name="copyrightNotice[<?php echo ((is_array($_tmp=$this->_tpl_vars['formLocale'])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
]" id="copyrightNotice" rows="10" cols="60" class="textArea"><?php echo ((is_array($_tmp=$this->_tpl_vars['copyrightNotice'][$this->_tpl_vars['formLocale']])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
</textarea></p>

<p><input type="checkbox" name="copyrightNoticeAgree" id="copyrightNoticeAgree" value="1"<?php if ($this->_tpl_vars['copyrightNoticeAgree']): ?> checked="checked"<?php endif; ?> /> <?php echo $this->_plugins['function']['fieldLabel'][0][0]->smartyFieldLabel(array('name' => 'copyrightNoticeAgree','key' => "manager.setup.aboutConference.copyrightNoticeAgree"), $this);?>
<br/>
<input type="checkbox" name="postCreativeCommons" id="postCreativeCommons" value="1"<?php if ($this->_tpl_vars['postCreativeCommons']): ?> checked="checked"<?php endif; ?> /> <?php echo $this->_plugins['function']['fieldLabel'][0][0]->smartyFieldLabel(array('name' => 'postCreativeCommons','key' => "manager.setup.aboutConference.postCreativeCommons"), $this);?>
<br/></p>
</div>
<div class="separator"></div>
<div id="archiveAccessPolicyInfo">
<h3>1.5 <?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.setup.aboutConference.accessPolicy"), $this);?>
</h3>

<p><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.setup.additionalContent.accessPolicy.description"), $this);?>
</p>

<table width="100%" class="data">
	<tr valign="top">
		<td width="5%" class="label"><input type="radio" name="paperAccess" id="paperAccess-1" value="<?php echo @PAPER_ACCESS_OPEN; ?>
" <?php if ($this->_tpl_vars['paperAccess'] == PAPER_ACCESS_OPEN || $this->_tpl_vars['paperAccess'] == ""): ?> checked="checked"<?php endif; ?> /></td>
		<td width="95%" class="value"><?php echo $this->_plugins['function']['fieldLabel'][0][0]->smartyFieldLabel(array('name' => "paperAccess-1",'key' => "manager.setup.additionalContent.archiveAccess.open"), $this);?>
</td>
	</tr>
	<tr valign="top">
		<td class="label"><input type="radio" name="paperAccess" id="paperAccess-2" value="<?php echo @PAPER_ACCESS_ACCOUNT_REQUIRED; ?>
" <?php if ($this->_tpl_vars['paperAccess'] == PAPER_ACCESS_ACCOUNT_REQUIRED): ?> checked="checked"<?php endif; ?> /></td>
		<td class="value"><?php echo $this->_plugins['function']['fieldLabel'][0][0]->smartyFieldLabel(array('name' => "paperAccess-2",'key' => "manager.setup.additionalContent.archiveAccess.accountRequired"), $this);?>
</td>
	</tr>
	<tr valign="top">
		<td class="label"><input type="radio" name="paperAccess" id="paperAccess-3" value="<?php echo @PAPER_ACCESS_REGISTRATION_REQUIRED; ?>
" <?php if ($this->_tpl_vars['paperAccess'] == PAPER_ACCESS_REGISTRATION_REQUIRED): ?> checked="checked"<?php endif; ?> /></td>
		<td class="value"><?php echo $this->_plugins['function']['fieldLabel'][0][0]->smartyFieldLabel(array('name' => "paperAccess-3",'key' => "manager.setup.additionalContent.archiveAccess.registrationRequired"), $this);?>
</td>
	</tr>
</table>

<p><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.setup.aboutConference.archiveAccessPolicy.description"), $this);?>
</p>

<table width="100%" class="data">
	<tr valign="top">
		<td width="5%" class="label"><input type="checkbox" name="restrictPaperAccess" id="restrictPaperAccess" value="1"<?php if ($this->_tpl_vars['restrictPaperAccess']): ?> checked="checked"<?php endif; ?> /></td>
		<td width="95%" colspan="2" class="value"><?php echo $this->_plugins['function']['fieldLabel'][0][0]->smartyFieldLabel(array('name' => 'restrictPaperAccess','key' => "manager.setup.aboutConference.restrictPaperAccess"), $this);?>
</td>
	</tr>
	<tr valign="top">
		<td width="5%" class="label"><input type="checkbox" name="enableComments" id="enableComments" value="1"<?php if ($this->_tpl_vars['enableComments']): ?> checked="checked"<?php endif; ?> /></td>
		<td width="95%" colspan="2" class="value"><?php echo $this->_plugins['function']['fieldLabel'][0][0]->smartyFieldLabel(array('name' => 'enableComments','key' => "manager.setup.aboutConference.comments.enable"), $this);?>
</td>
	</tr>
	<tr valign="top">
		<td width="5%" class="label">&nbsp;</td>
		<td width="5%" class="label"><input type="checkbox" name="commentsRequireRegistration" id="commentsRequireRegistration" value="1"<?php if ($this->_tpl_vars['commentsRequireRegistration']): ?> checked="checked"<?php endif; ?> /></td>
		<td width="90%" class="value"><?php echo $this->_plugins['function']['fieldLabel'][0][0]->smartyFieldLabel(array('name' => 'commentsRequireRegistration','key' => "manager.setup.aboutConference.comments.requireRegistration"), $this);?>
</td>
	</tr>
	<tr valign="top">
		<td width="5%" class="label">&nbsp;</td>
		<td width="5%" class="label"><input type="checkbox" name="commentsAllowAnonymous" id="commentsAllowAnonymous" value="1"<?php if ($this->_tpl_vars['commentsAllowAnonymous']): ?> checked="checked"<?php endif; ?> /></td>
		<td width="90%" class="value"><?php echo $this->_plugins['function']['fieldLabel'][0][0]->smartyFieldLabel(array('name' => 'commentsAllowAnonymous','key' => "manager.setup.aboutConference.comments.allowAnonymous"), $this);?>
</td>
	</tr>
</table>
<div id="policy">
<h4><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.setup.aboutConference.archiveAccessPolicy"), $this);?>
</h4>

<p><textarea name="archiveAccessPolicy[<?php echo ((is_array($_tmp=$this->_tpl_vars['formLocale'])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
]" id="archiveAccessPolicy" rows="10" cols="60" class="textArea"><?php echo ((is_array($_tmp=$this->_tpl_vars['archiveAccessPolicy'][$this->_tpl_vars['formLocale']])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
</textarea></p>
</div>
</div>
<div class="separator"></div>
<div id="privacyStatementInfo">
<h3>1.6 <?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.setup.aboutConference.privacyStatement"), $this);?>
</h3>

<p><textarea name="privacyStatement[<?php echo ((is_array($_tmp=$this->_tpl_vars['formLocale'])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
]" id="privacyStatement" rows="10" cols="60" class="textArea"><?php echo ((is_array($_tmp=$this->_tpl_vars['privacyStatement'][$this->_tpl_vars['formLocale']])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
</textarea></p>
</div>
<div class="separator"></div>
<div id="addItemtoAboutConference">
<h3>1.7 <?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.setup.aboutConference.addItemtoAboutConference"), $this);?>
</h3>

<table width="100%" class="data">
<?php $_from = $this->_tpl_vars['customAboutItems'][$this->_tpl_vars['formLocale']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['customAboutItems'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['customAboutItems']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['aboutId'] => $this->_tpl_vars['aboutItem']):
        $this->_foreach['customAboutItems']['iteration']++;
?>
	<tr valign="top">
		<td width="5%" class="label"><?php echo $this->_plugins['function']['fieldLabel'][0][0]->smartyFieldLabel(array('name' => "customAboutItems-".($this->_tpl_vars['aboutId'])."-title",'key' => "common.title"), $this);?>
</td>
		<td width="95%" class="value"><input type="text" name="customAboutItems[<?php echo ((is_array($_tmp=$this->_tpl_vars['formLocale'])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
][<?php echo ((is_array($_tmp=$this->_tpl_vars['aboutId'])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
][title]" id="customAboutItems-<?php echo ((is_array($_tmp=$this->_tpl_vars['aboutId'])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
-title" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['aboutItem']['title'])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
" size="40" maxlength="255" class="textField" /><?php if ($this->_foreach['customAboutItems']['total'] > 1): ?> <input type="submit" name="delCustomAboutItem[<?php echo ((is_array($_tmp=$this->_tpl_vars['aboutId'])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
]" value="<?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "common.delete"), $this);?>
" class="button" /><?php endif; ?></td>
	</tr>
	<tr valign="top">
		<td width="20%" class="label"><?php echo $this->_plugins['function']['fieldLabel'][0][0]->smartyFieldLabel(array('name' => "customAboutItems-".($this->_tpl_vars['aboutId'])."-content",'key' => "manager.setup.aboutConference.aboutItemContent"), $this);?>
</td>
		<td width="80%" class="value"><textarea name="customAboutItems[<?php echo ((is_array($_tmp=$this->_tpl_vars['formLocale'])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
][<?php echo ((is_array($_tmp=$this->_tpl_vars['aboutId'])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
][content]" id="customAboutItems-<?php echo ((is_array($_tmp=$this->_tpl_vars['aboutId'])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
-content" rows="10" cols="40" class="textArea"><?php echo ((is_array($_tmp=$this->_tpl_vars['aboutItem']['content'])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
</textarea></td>
	</tr>
	<?php if (! ($this->_foreach['customAboutItems']['iteration'] == $this->_foreach['customAboutItems']['total'])): ?>
	<tr valign="top">
		<td colspan="2" class="separator">&nbsp;</td>
	</tr>
	<?php endif; ?>
<?php endforeach; else: ?>
	<tr valign="top">
		<td width="20%" class="label"><?php echo $this->_plugins['function']['fieldLabel'][0][0]->smartyFieldLabel(array('name' => "customAboutItems-0-title",'key' => "common.title"), $this);?>
</td>
		<td width="80%" class="value"><input type="text" name="customAboutItems[<?php echo ((is_array($_tmp=$this->_tpl_vars['formLocale'])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
][0][title]" id="customAboutItems-0-title" value="" size="40" maxlength="255" class="textField" /></td>
	</tr>
	<tr valign="top">
		<td width="20%" class="label"><?php echo $this->_plugins['function']['fieldLabel'][0][0]->smartyFieldLabel(array('name' => "customAboutItems-0-content",'key' => "manager.setup.aboutConference.aboutItemContent"), $this);?>
</td>
		<td width="80%" class="value"><textarea name="customAboutItems[<?php echo ((is_array($_tmp=$this->_tpl_vars['formLocale'])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
][0][content]" id="customAboutItems-0-content" rows="10" cols="40" class="textArea"></textarea></td>
	</tr>
<?php endif; unset($_from); ?>
</table>

<p><input type="submit" name="addCustomAboutItem" value="<?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.setup.aboutConference.addAboutItem"), $this);?>
" class="button" /></p>
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