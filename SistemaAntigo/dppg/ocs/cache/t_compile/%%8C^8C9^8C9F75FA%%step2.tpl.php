<?php /* Smarty version 2.6.26, created on 2014-03-31 12:30:11
         compiled from manager/schedConfSetup/step2.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'url', 'manager/schedConfSetup/step2.tpl', 14, false),array('function', 'fieldLabel', 'manager/schedConfSetup/step2.tpl', 26, false),array('function', 'form_language_chooser', 'manager/schedConfSetup/step2.tpl', 29, false),array('function', 'translate', 'manager/schedConfSetup/step2.tpl', 30, false),array('modifier', 'assign', 'manager/schedConfSetup/step2.tpl', 28, false),array('modifier', 'escape', 'manager/schedConfSetup/step2.tpl', 92, false),array('modifier', 'concat', 'manager/schedConfSetup/step2.tpl', 95, false),)), $this); ?>
<?php $this->assign('pageTitle', "manager.schedConfSetup.submissions.title"); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "manager/schedConfSetup/setupHeader.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<form name="setupForm" method="post" action="<?php echo $this->_plugins['function']['url'][0][0]->smartyUrl(array('op' => 'saveSchedConfSetup','path' => '2'), $this);?>
">
<input type="hidden" name="paperTypeAction" value="" />
<input type="hidden" name="paperTypeId" value="" />
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
			<?php echo ((is_array($_tmp=$this->_plugins['function']['url'][0][0]->smartyUrl(array('op' => 'schedConfSetup','path' => '2','escape' => false), $this))) ? $this->_run_mod_handler('assign', true, $_tmp, 'setupFormUrl') : $this->_plugins['modifier']['assign'][0][0]->smartyAssign($_tmp, 'setupFormUrl'));?>

			<?php echo $this->_plugins['function']['form_language_chooser'][0][0]->smartyFormLanguageChooser(array('form' => 'setupForm','url' => $this->_tpl_vars['setupFormUrl']), $this);?>

			<span class="instruct"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "form.formLanguage.description"), $this);?>
</span>
		</td>
	</tr>
</table>
</div>
<?php endif; ?>

<div id="submissionProcess">
<h3>2.1 <?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.schedConfSetup.submissions.submissionProcess"), $this);?>
</h3>

<p><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.schedConfSetup.submissions.description"), $this);?>
</p>

<h4><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.schedConfSetup.submissions.submissionMaterials"), $this);?>
</h4>

<table width="100%" class="data">
	<tr valign="top">
		<td width="5%" class="label">
			<input type="radio" name="reviewMode" id="reviewMode-1" value="<?php echo @REVIEW_MODE_ABSTRACTS_ALONE; ?>
" <?php if ($this->_tpl_vars['reviewMode'] == REVIEW_MODE_ABSTRACTS_ALONE): ?>checked="checked"<?php endif; ?> onclick="document.setupForm.previewAbstracts.disabled=true;" />
		</td>
		<td width="95%" class="value">
			<?php echo $this->_plugins['function']['fieldLabel'][0][0]->smartyFieldLabel(array('name' => "reviewMode-1",'key' => "manager.schedConfSetup.submissions.abstractsAlone"), $this);?>

		</td>
	</tr>
	<tr valign="top">
		<td class="label">
			<input type="radio" name="reviewMode" id="reviewMode-2" value="<?php echo @REVIEW_MODE_PRESENTATIONS_ALONE; ?>
" <?php if ($this->_tpl_vars['reviewMode'] == REVIEW_MODE_PRESENTATIONS_ALONE): ?>checked="checked"<?php endif; ?> onclick="document.setupForm.previewAbstracts.disabled=true;" />
		</td>
		<td class="value">
			<?php echo $this->_plugins['function']['fieldLabel'][0][0]->smartyFieldLabel(array('name' => "reviewMode-2",'key' => "manager.schedConfSetup.submissions.presentationsAlone"), $this);?>

		</td>
	</tr>
	<tr valign="top">
		<td class="label">
			<input type="radio" name="reviewMode" id="reviewMode-3" value="<?php echo @REVIEW_MODE_BOTH_SIMULTANEOUS; ?>
" <?php if ($this->_tpl_vars['reviewMode'] == REVIEW_MODE_BOTH_SIMULTANEOUS): ?>checked="checked"<?php endif; ?> onclick="document.setupForm.previewAbstracts.disabled=true;" />
		</td>
		<td class="value">
			<?php echo $this->_plugins['function']['fieldLabel'][0][0]->smartyFieldLabel(array('name' => "reviewMode-3",'key' => "manager.schedConfSetup.submissions.bothTogether"), $this);?>

		</td>
	</tr>
	<tr valign="top">
		<td class="label">
			<input type="radio" name="reviewMode" id="reviewMode-4" value="<?php echo @REVIEW_MODE_BOTH_SEQUENTIAL; ?>
" <?php if ($this->_tpl_vars['reviewMode'] == REVIEW_MODE_BOTH_SEQUENTIAL): ?>checked="checked"<?php endif; ?> onclick="document.setupForm.previewAbstracts.disabled=false;" />
		</td>
		<td class="value">
			<?php echo $this->_plugins['function']['fieldLabel'][0][0]->smartyFieldLabel(array('name' => "reviewMode-4",'key' => "manager.schedConfSetup.submissions.bothSequential"), $this);?>

		</td>
	</tr>
	<tr valign="top">
		<td class="label">&nbsp;</td>
		<td class="value">
			<input type="checkbox" name="previewAbstracts" id="previewAbstracts" <?php if ($this->_tpl_vars['previewAbstracts']): ?>checked="checked" <?php endif; ?><?php if ($this->_tpl_vars['reviewMode'] != REVIEW_MODE_BOTH_SEQUENTIAL): ?>disabled="disabled" <?php endif; ?>/>
			<?php echo $this->_plugins['function']['fieldLabel'][0][0]->smartyFieldLabel(array('name' => 'previewAbstracts','key' => "manager.schedConfSetup.submissions.previewAbstracts"), $this);?>

		</td>
	</tr>
</table>

<div id="typeOfSubmission">
<h4><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.schedConfSetup.submissions.typeOfSubmission"), $this);?>
</h4>

<table width="100%" class="data">
	<?php $this->assign('paperTypeNumber', 1); ?>
	<?php $_from = $this->_tpl_vars['paperTypes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['paperTypeId'] => $this->_tpl_vars['paperType']):
?>
		<input type="hidden" name="paperTypes[<?php echo ((is_array($_tmp=$this->_tpl_vars['paperTypeId'])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
][seq]" value="<?php echo $this->_tpl_vars['paperTypeNumber']; ?>
" />
		<tr valign="top">
			<td rowspan="4" width="5%"><?php echo $this->_tpl_vars['paperTypeNumber']; ?>
.</td>
			<td width="15%" class="label"><?php echo $this->_plugins['function']['fieldLabel'][0][0]->smartyFieldLabel(array('name' => ((is_array($_tmp="paperTypeName-")) ? $this->_run_mod_handler('concat', true, $_tmp, $this->_tpl_vars['paperTypeId']) : $this->_plugins['modifier']['concat'][0][0]->smartyConcat($_tmp, $this->_tpl_vars['paperTypeId'])),'key' => "common.title"), $this);?>
</td>
			<td width="80%" colspan="2" class="value">
				<input type="text" size="40" class="textField" name="paperTypes[<?php echo ((is_array($_tmp=$this->_tpl_vars['paperTypeId'])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
][name][<?php echo ((is_array($_tmp=$this->_tpl_vars['formLocale'])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
]" id="paperTypeName-<?php echo ((is_array($_tmp=$this->_tpl_vars['paperTypeId'])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['paperType']['name'][$this->_tpl_vars['formLocale']])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
" />
			</td>
		</tr>
		<tr valign="top">
			<td class="label"><?php echo $this->_plugins['function']['fieldLabel'][0][0]->smartyFieldLabel(array('name' => ((is_array($_tmp="paperTypeDescription-")) ? $this->_run_mod_handler('concat', true, $_tmp, $this->_tpl_vars['paperTypeId']) : $this->_plugins['modifier']['concat'][0][0]->smartyConcat($_tmp, $this->_tpl_vars['paperTypeId'])),'key' => "common.description"), $this);?>
</td>
			<td class="value" colspan="2">
				<textarea cols="40" rows="4" class="textArea" name="paperTypes[<?php echo ((is_array($_tmp=$this->_tpl_vars['paperTypeId'])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
][description][<?php echo ((is_array($_tmp=$this->_tpl_vars['formLocale'])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
]" id="paperTypeDescription-<?php echo ((is_array($_tmp=$this->_tpl_vars['paperTypeId'])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['paperType']['description'][$this->_tpl_vars['formLocale']])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
</textarea>
			</td>
		</tr>
		<tr valign="top">
			<td class="label">&nbsp;</td>
			<td width="35%" class="value">
				<?php echo $this->_plugins['function']['fieldLabel'][0][0]->smartyFieldLabel(array('name' => ((is_array($_tmp="paperTypeAbstractLength-")) ? $this->_run_mod_handler('concat', true, $_tmp, $this->_tpl_vars['paperTypeId']) : $this->_plugins['modifier']['concat'][0][0]->smartyConcat($_tmp, $this->_tpl_vars['paperTypeId'])),'key' => "manager.schedConfSetup.submissions.typeOfSubmission.abstractLength"), $this);?>
&nbsp;
				<input type="text" size="5" class="textField" name="paperTypes[<?php echo ((is_array($_tmp=$this->_tpl_vars['paperTypeId'])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
][abstractLength]" id="paperTypeAbstractLength-<?php echo ((is_array($_tmp=$this->_tpl_vars['paperTypeId'])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['paperType']['abstractLength'])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
" />
			</td>
			<td width="45%" class="value">
				<?php echo $this->_plugins['function']['fieldLabel'][0][0]->smartyFieldLabel(array('name' => ((is_array($_tmp="paperTypeLength-")) ? $this->_run_mod_handler('concat', true, $_tmp, $this->_tpl_vars['paperTypeId']) : $this->_plugins['modifier']['concat'][0][0]->smartyConcat($_tmp, $this->_tpl_vars['paperTypeId'])),'key' => "manager.schedConfSetup.submissions.typeOfSubmission.length"), $this);?>
&nbsp;
				<input type="text" size="5" class="textField" name="paperTypes[<?php echo ((is_array($_tmp=$this->_tpl_vars['paperTypeId'])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
][length]" id="paperTypeLength-<?php echo ((is_array($_tmp=$this->_tpl_vars['paperTypeId'])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['paperType']['length'])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
" />
			</td>
		</tr>
		<tr valign="top">
			<td class="label">&nbsp;</td>
			<td colspan="2" class="label">
				<?php echo '<a onclick="document.setupForm.paperTypeAction.value=\'movePaperTypeUp\'; document.setupForm.paperTypeId.value=\''; ?><?php echo ((is_array($_tmp=$this->_tpl_vars['paperTypeId'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'jsparam') : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp, 'jsparam')); ?><?php echo '\'; document.setupForm.submit();" href="#">&uarr;</a>&nbsp;<a onclick="document.setupForm.paperTypeAction.value=\'movePaperTypeDown\'; document.setupForm.paperTypeId.value=\''; ?><?php echo ((is_array($_tmp=$this->_tpl_vars['paperTypeId'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'jsparam') : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp, 'jsparam')); ?><?php echo '\'; document.setupForm.submit();" href="#">&darr;</a>&nbsp;|&nbsp;<a onclick="document.setupForm.paperTypeAction.value=\'deletePaperType\'; document.setupForm.paperTypeId.value=\''; ?><?php echo ((is_array($_tmp=$this->_tpl_vars['paperTypeId'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'jsparam') : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp, 'jsparam')); ?><?php echo '\'; document.setupForm.submit();" href="#" class="action">'; ?><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "common.delete"), $this);?><?php echo '</a>'; ?>

			</td>
		</tr>
		<?php $this->assign('paperTypeNumber', $this->_tpl_vars['paperTypeNumber']+1); ?>
	<?php endforeach; endif; unset($_from); ?>
	<tr valign="top">
		<td width="5%" class="label">&nbsp;</td>
		<td width="95%" colspan="3" class="value">
			<input type="button" onclick="document.setupForm.paperTypeAction.value='createPaperType'; document.setupForm.submit();" value="<?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.schedConfSetup.submissions.typeOfSubmission.create"), $this);?>
" />
		</td>
	</tr>
</table>
</div>

<div id="suppFiles">
<h4><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.schedConfSetup.submissions.suppFiles"), $this);?>
</h4>

<table width="100%" class="data">
	<tr valign="top">
		<td width="5%" class="label">
			<input type="checkbox" name="acceptSupplementaryReviewMaterials" id="acceptSupplementaryReviewMaterials" value="1" <?php if ($this->_tpl_vars['acceptSupplementaryReviewMaterials']): ?>checked="checked"<?php endif; ?> />
		</td>
		<td width="95%" class="value">
			<?php echo $this->_plugins['function']['fieldLabel'][0][0]->smartyFieldLabel(array('name' => 'acceptSupplementaryReviewMaterials','key' => "manager.schedConfSetup.submissions.acceptSupplementaryReviewMaterials"), $this);?>

		</td>
	</tr>
</table>
</div>

<div id="notifications">
<h4><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.schedConfSetup.notifications"), $this);?>
</h4>

<p><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.schedConfSetup.submissions.notifications.description"), $this);?>
</p>

<table width="100%" class="data">
	<tr valign="top">
		<td width="5%" class="label"><input <?php if (! $this->_tpl_vars['submissionAckEnabled']): ?>disabled="disabled" <?php endif; ?>type="checkbox" name="copySubmissionAckPrimaryContact" id="copySubmissionAckPrimaryContact" value="true" <?php if ($this->_tpl_vars['copySubmissionAckPrimaryContact']): ?>checked="checked"<?php endif; ?>/></td>
		<td width="95%" class="value"><?php echo $this->_plugins['function']['fieldLabel'][0][0]->smartyFieldLabel(array('name' => 'copySubmissionAckPrimaryContact','key' => "manager.schedConfSetup.submissions.notifications.copyPrimaryContact"), $this);?>
</td>
	</tr>
	<tr valign="top">
		<td class="label"><input <?php if (! $this->_tpl_vars['submissionAckEnabled']): ?>disabled="disabled" <?php endif; ?>type="checkbox" name="copySubmissionAckSpecified" id="copySubmissionAckSpecified" value="true" <?php if ($this->_tpl_vars['copySubmissionAckSpecified']): ?>checked="checked"<?php endif; ?>/></td>
		<td class="value"><?php echo $this->_plugins['function']['fieldLabel'][0][0]->smartyFieldLabel(array('name' => 'copySubmissionAckAddress','key' => "manager.schedConfSetup.submissions.notifications.copySpecifiedAddress"), $this);?>
&nbsp;&nbsp;<input <?php if (! $this->_tpl_vars['submissionAckEnabled']): ?>disabled="disabled" <?php endif; ?>type="text" class="textField" name="copySubmissionAckAddress" id="copySubmissionAckAddress" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['copySubmissionAckAddress'])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
"/></td>
	</tr>
	<?php if (! $this->_tpl_vars['submissionAckEnabled']): ?>
	<tr valign="top">
		<td>&nbsp;</td>
		<?php echo ((is_array($_tmp=$this->_plugins['function']['url'][0][0]->smartyUrl(array('op' => 'emails','clearPageContext' => 1), $this))) ? $this->_run_mod_handler('assign', true, $_tmp, 'preparedEmailsUrl') : $this->_plugins['modifier']['assign'][0][0]->smartyAssign($_tmp, 'preparedEmailsUrl'));?>

		<td><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.schedConfSetup.submissions.notifications.submissionAckDisabled",'preparedEmailsUrl' => $this->_tpl_vars['preparedEmailsUrl']), $this);?>
</td>
	</tr>
	<?php endif; ?>
</table>
</div>
</div>
<div class="separator"></div>

<div id="callForPapers">
<h3>2.2 <?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.schedConfSetup.submissions.callForPapers"), $this);?>
</h3>

<table width="100%" class="data">
	<tr valign="top">
		<td width="10%" class="label"><?php echo $this->_plugins['function']['fieldLabel'][0][0]->smartyFieldLabel(array('name' => 'cfpMessage','key' => "manager.schedConfSetup.submissions.cfpMessage"), $this);?>
</td>
		<td width="90%" class="value">
			<textarea name="cfpMessage[<?php echo ((is_array($_tmp=$this->_tpl_vars['formLocale'])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
]" id="cfpMessage" rows="10" cols="80" class="textArea"><?php echo ((is_array($_tmp=$this->_tpl_vars['cfpMessage'][$this->_tpl_vars['formLocale']])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
</textarea>
			<br />
			<span class="instruct"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.schedConfSetup.submissions.cfpMessageDescription"), $this);?>
</span>
		</td>
	</tr>
</table>
</div>

<div class="separator"></div>

<div id="authorGuidelinesInfo">
<h3>2.3 <?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.schedConfSetup.submissions.authorGuidelines"), $this);?>
</h3>

<p><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.schedConfSetup.submissions.authorGuidelinesDescription"), $this);?>
</p>

<p>
	<textarea name="authorGuidelines[<?php echo ((is_array($_tmp=$this->_tpl_vars['formLocale'])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
]" id="authorGuidelines" rows="12" cols="60" class="textArea"><?php echo ((is_array($_tmp=$this->_tpl_vars['authorGuidelines'][$this->_tpl_vars['formLocale']])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
</textarea>
</p>

<table width="100%" class="data">
	<tr valign="top">
		<td width="5%" class="label">
			<input type="checkbox" name="metaCitations" id="metaCitations" value="1"<?php if ($this->_tpl_vars['metaCitations']): ?> checked="checked"<?php endif; ?> />
		</td>
		<td width="95%" class="value"><label for="metaCitations"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.setup.citations"), $this);?>
</label>
		</td>
	</tr>
</table>

<div id="preparationChecklist">
<h4><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.schedConfSetup.submissions.preparationChecklist"), $this);?>
</h4>

<p><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.schedConfSetup.submissions.preparationChecklist.description"), $this);?>
</p>

<?php $_from = $this->_tpl_vars['submissionChecklist'][$this->_tpl_vars['formLocale']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['checklist'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['checklist']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['checklistId'] => $this->_tpl_vars['checklistItem']):
        $this->_foreach['checklist']['iteration']++;
?>
	<?php if (! $this->_tpl_vars['notFirstChecklistItem']): ?>
		<?php $this->assign('notFirstChecklistItem', 1); ?>
		<table width="100%" class="data">
			<tr valign="top">
				<td width="5%"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "common.order"), $this);?>
</td>
				<td width="95%" colspan="2">&nbsp;</td>
			</tr>
	<?php endif; ?>

	<tr valign="top">
		<td width="5%" class="label"><input type="text" name="submissionChecklist[<?php echo ((is_array($_tmp=$this->_tpl_vars['formLocale'])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
][<?php echo ((is_array($_tmp=$this->_tpl_vars['checklistId'])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
][order]" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['checklistItem']['order'])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
" size="3" maxlength="2" class="textField" /></td>
		<td class="value"><textarea name="submissionChecklist[<?php echo ((is_array($_tmp=$this->_tpl_vars['formLocale'])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
][<?php echo ((is_array($_tmp=$this->_tpl_vars['checklistId'])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
][content]" id="submissionChecklist-<?php echo ((is_array($_tmp=$this->_tpl_vars['checklistId'])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
" rows="3" cols="40" class="textArea"><?php echo ((is_array($_tmp=$this->_tpl_vars['checklistItem']['content'])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
</textarea></td>
		<td width="100%"><input type="submit" name="delChecklist[<?php echo ((is_array($_tmp=$this->_tpl_vars['checklistId'])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
]" value="<?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "common.delete"), $this);?>
" class="button" /></td>
	</tr>
<?php endforeach; endif; unset($_from); ?>
</table>

<p><input type="submit" name="addChecklist" value="<?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.schedConfSetup.submissions.addChecklistItem"), $this);?>
" class="button" /></p>
</div>
</div>
<div class="separator"></div>

<div id="forAuthorsToIndexTheirWork">
<h3>2.4 <?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.schedConfSetup.submissions.forAuthorsToIndexTheirWork"), $this);?>
</h3>

<p><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.schedConfSetup.submissions.forAuthorsToIndexTheirWorkDescription"), $this);?>
</p>

<table width="100%" class="data">
	<tr valign="top">
		<td width="5%" class="label"><input type="checkbox" name="metaDiscipline" id="metaDiscipline" value="1"<?php if ($this->_tpl_vars['metaDiscipline']): ?> checked="checked"<?php endif; ?> /></td>
		<td width="95%" class="value">
			<strong><?php echo $this->_plugins['function']['fieldLabel'][0][0]->smartyFieldLabel(array('name' => 'metaDiscipline','key' => "manager.schedConfSetup.submissions.discipline"), $this);?>
</strong>
			<br />
			<span class="instruct"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.schedConfSetup.submissions.disciplineDescription"), $this);?>
</span>
		</td>
	</tr>
	<tr valign="top">
		<td>&nbsp;</td>
		<td class="value">
			<span class="instruct"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.schedConfSetup.submissions.disciplineProvideExamples"), $this);?>
:</span>
			<br />
			<input type="text" name="metaDisciplineExamples[<?php echo ((is_array($_tmp=$this->_tpl_vars['formLocale'])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
]" id="metaDisciplineExamples" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['metaDisciplineExamples'][$this->_tpl_vars['formLocale']])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
" size="60" maxlength="255" class="textField" />
			<br />
			<span class="instruct"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.schedConfSetup.submissions.disciplineExamples"), $this);?>
</span>
		</td>
	</tr>
	
	<tr>
		<td class="separator" colspan="2"><br />&nbsp;</td>
	</tr>
	
	<tr valign="top">
		<td width="5%" class="label"><input type="checkbox" name="metaSubjectClass" id="metaSubjectClass" value="1"<?php if ($this->_tpl_vars['metaSubjectClass']): ?> checked="checked"<?php endif; ?> /></td>
		<td width="95%" class="value">
			<strong><?php echo $this->_plugins['function']['fieldLabel'][0][0]->smartyFieldLabel(array('name' => 'metaSubjectClass','key' => "manager.schedConfSetup.submissions.subjectClassification"), $this);?>
</strong>
		</td>
	</tr>
	<tr valign="top">
		<td>&nbsp;</td>
		<td class="value">
			<table width="100%">
				<tr valign="top">
					<td width="10%"><?php echo $this->_plugins['function']['fieldLabel'][0][0]->smartyFieldLabel(array('name' => 'metaSubjectClassTitle','key' => "common.title"), $this);?>
</td>
					<td width="90%"><input type="text" name="metaSubjectClassTitle[<?php echo ((is_array($_tmp=$this->_tpl_vars['formLocale'])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
]" id="metaSubjectClassTitle" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['metaSubjectClassTitle'][$this->_tpl_vars['formLocale']])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
" size="40" maxlength="255" class="textField" /></td>
				</tr>
				<tr valign="top">
					<td width="10%"><?php echo $this->_plugins['function']['fieldLabel'][0][0]->smartyFieldLabel(array('name' => 'metaSubjectClassUrl','key' => "common.url"), $this);?>
</td>
					<td width="90%"><input type="text" name="metaSubjectClassUrl" id="metaSubjectClassUrl" value="<?php if ($this->_tpl_vars['metaSubjectClassUrl']): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['metaSubjectClassUrl'])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
<?php else: ?>http://<?php endif; ?>" size="40" maxlength="255" class="textField" /></td>
				</tr>
			</table>
			<span class="instruct"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.schedConfSetup.submissions.subjectClassificationExamples"), $this);?>
</span>
		</td>
	</tr>
	
	<tr>
		<td class="separator" colspan="2"><br />&nbsp;</td>
	</tr>
	
	<tr valign="top">
		<td width="5%" class="label"><input type="checkbox" name="metaSubject" id="metaSubject" value="1"<?php if ($this->_tpl_vars['metaSubject']): ?> checked="checked"<?php endif; ?> /></td>
		<td width="95%" class="value">
			<strong><?php echo $this->_plugins['function']['fieldLabel'][0][0]->smartyFieldLabel(array('name' => 'metaSubject','key' => "manager.schedConfSetup.submissions.subjectKeywordTopic"), $this);?>
</strong>
		</td>
	</tr>
	<tr valign="top">
		<td>&nbsp;</td>
		<td class="value">
			<span class="instruct"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.schedConfSetup.submissions.subjectProvideExamples"), $this);?>
:</span>
			<br />
			<input type="text" name="metaSubjectExamples[<?php echo ((is_array($_tmp=$this->_tpl_vars['formLocale'])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
]" id="metaSubjectExamples" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['metaSubjectExamples'][$this->_tpl_vars['formLocale']])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
" size="60" maxlength="255" class="textField" />
			<br />
			<span class="instruct"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.schedConfSetup.submissions.subjectExamples"), $this);?>
</span>
		</td>
	</tr>
	
	<tr>
		<td class="separator" colspan="2"><br />&nbsp;</td>
	</tr>
	
	<tr valign="top">
		<td width="5%" class="label"><input type="checkbox" name="metaCoverage" id="metaCoverage" value="1"<?php if ($this->_tpl_vars['metaCoverage']): ?> checked="checked"<?php endif; ?> /></td>
		<td width="95%" class="value">
			<strong><?php echo $this->_plugins['function']['fieldLabel'][0][0]->smartyFieldLabel(array('name' => 'metaCoverage','key' => "manager.schedConfSetup.submissions.coverage"), $this);?>
</strong>
			<br />
			<span class="instruct"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.schedConfSetup.submissions.coverageDescription"), $this);?>
</span>
		</td>
	</tr>
	<tr>
		<td class="separator" colspan="2">&nbsp;</td>
	</tr>
	<tr valign="top">
		<td>&nbsp;</td>
		<td class="value">
			<span class="instruct"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.schedConfSetup.submissions.coverageGeoProvideExamples"), $this);?>
:</span>
			<br />
			<input type="text" name="metaCoverageGeoExamples[<?php echo ((is_array($_tmp=$this->_tpl_vars['formLocale'])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
]" id="metaCoverageGeoExamples" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['metaCoverageGeoExamples'][$this->_tpl_vars['formLocale']])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
" size="60" maxlength="255" class="textField" />
			<br />
			<span class="instruct"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.schedConfSetup.submissions.coverageGeoExamples"), $this);?>
</span>
		</td>
	</tr>
	<tr>
		<td class="separator" colspan="2">&nbsp;</td>
	</tr>
	<tr valign="top">
		<td>&nbsp;</td>
		<td class="value">
			<span class="instruct"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.schedConfSetup.submissions.coverageChronProvideExamples"), $this);?>
:</span>
			<br />
			<input type="text" name="metaCoverageChronExamples[<?php echo ((is_array($_tmp=$this->_tpl_vars['formLocale'])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
]" id="metaCoverageChronExamples" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['metaCoverageChronExamples'][$this->_tpl_vars['formLocale']])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
" size="60" maxlength="255" class="textField" />
			<br />
			<span class="instruct"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.schedConfSetup.submissions.coverageChronExamples"), $this);?>
</span>
		</td>
	</tr>
	<tr>
		<td class="separator" colspan="2">&nbsp;</td>
	</tr>
	<tr valign="top">
		<td>&nbsp;</td>
		<td class="value">
			<span class="instruct"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.schedConfSetup.submissions.coverageResearchSampleProvideExamples"), $this);?>
:</span>
			<br />
			<input type="text" name="metaCoverageResearchSampleExamples[<?php echo ((is_array($_tmp=$this->_tpl_vars['formLocale'])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
]" id="metaCoverageResearchSampleExamples" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['metaCoverageResearchSampleExamples'][$this->_tpl_vars['formLocale']])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
" size="60" maxlength="255" class="textField" />
			<br />
			<span class="instruct"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.schedConfSetup.submissions.coverageResearchSampleExamples"), $this);?>
</span>
		</td>
	</tr>
	
	<tr>
		<td class="separator" colspan="2"><br />&nbsp;</td>
	</tr>
	
	<tr valign="top">
		<td width="5%" class="label"><input type="checkbox" name="metaType" id="metaType" value="1"<?php if ($this->_tpl_vars['metaType']): ?> checked="checked"<?php endif; ?> /></td>
		<td width="95%" class="value">
			<strong><?php echo $this->_plugins['function']['fieldLabel'][0][0]->smartyFieldLabel(array('name' => 'metaType','key' => "manager.schedConfSetup.submissions.typeMethodApproach"), $this);?>
</strong>
		</td>
	</tr>
	<tr valign="top">
		<td>&nbsp;</td>
		<td class="value">
			<span class="instruct"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.schedConfSetup.submissions.typeProvideExamples"), $this);?>
:</span>
			<br />
			<input type="text" name="metaTypeExamples[<?php echo ((is_array($_tmp=$this->_tpl_vars['formLocale'])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
]" id="metaTypeExamples" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['metaTypeExamples'][$this->_tpl_vars['formLocale']])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
" size="60" maxlength="255" class="textField" />
			<br />
			<span class="instruct"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.schedConfSetup.submissions.typeExamples"), $this);?>
</span>
		</td>
	</tr>
</table>
</div>
<div class="separator"></div>

<div id="publicIdentifier">
<h3>2.5 <?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.schedConfSetup.submissions.publicIdentifier"), $this);?>
</h3>

<p><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.schedConfSetup.submissions.uniqueIdentifierDescription"), $this);?>
</p>

<table width="100%" class="data">
	<tr valign="top">
		<td width="5%" class="label"><input type="checkbox" name="enablePublicPaperId" id="enablePublicPaperId" value="1"<?php if ($this->_tpl_vars['enablePublicPaperId']): ?> checked="checked"<?php endif; ?> /></td>
		<td width="95%" class="value"><?php echo $this->_plugins['function']['fieldLabel'][0][0]->smartyFieldLabel(array('name' => 'enablePublicPaperId','key' => "manager.schedConfSetup.submissions.enablePublicPaperId"), $this);?>
</td>
	</tr>
	<tr valign="top">
		<td width="5%" class="label"><input type="checkbox" name="enablePublicSuppFileId" id="enablePublicSuppFileId" value="1"<?php if ($this->_tpl_vars['enablePublicSuppFileId']): ?> checked="checked"<?php endif; ?> /></td>
		<td width="95%" class="value"><?php echo $this->_plugins['function']['fieldLabel'][0][0]->smartyFieldLabel(array('name' => 'enablePublicSuppFileId','key' => "manager.schedConfSetup.submissions.enablePublicSuppFileId"), $this);?>
</td>
	</tr>
</table>
</div>
<div class="separator"></div>

<p><input type="submit" value="<?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "common.saveAndContinue"), $this);?>
" class="button defaultButton" /> <input type="button" value="<?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "common.cancel"), $this);?>
" class="button" onclick="document.location.href='<?php echo $this->_plugins['function']['url'][0][0]->smartyUrl(array('op' => 'schedConfSetup'), $this);?>
'" /></p>

<p><span class="formRequired"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "common.requiredField"), $this);?>
</span></p>

</form>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "common/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>