<?php /* Smarty version 2.6.26, created on 2014-03-31 12:31:12
         compiled from manager/schedConfSetup/step3.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'url', 'manager/schedConfSetup/step3.tpl', 14, false),array('function', 'fieldLabel', 'manager/schedConfSetup/step3.tpl', 21, false),array('function', 'form_language_chooser', 'manager/schedConfSetup/step3.tpl', 24, false),array('function', 'translate', 'manager/schedConfSetup/step3.tpl', 25, false),array('function', 'html_select_date', 'manager/schedConfSetup/step3.tpl', 68, false),array('modifier', 'assign', 'manager/schedConfSetup/step3.tpl', 23, false),array('modifier', 'escape', 'manager/schedConfSetup/step3.tpl', 38, false),)), $this); ?>
<?php $this->assign('pageTitle', "manager.schedConfSetup.review.title"); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "manager/schedConfSetup/setupHeader.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<form name="setupForm" method="post" action="<?php echo $this->_plugins['function']['url'][0][0]->smartyUrl(array('op' => 'saveSchedConfSetup','path' => '3'), $this);?>
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
			<?php echo ((is_array($_tmp=$this->_plugins['function']['url'][0][0]->smartyUrl(array('op' => 'schedConfSetup','path' => '3','escape' => false), $this))) ? $this->_run_mod_handler('assign', true, $_tmp, 'setupFormUrl') : $this->_plugins['modifier']['assign'][0][0]->smartyAssign($_tmp, 'setupFormUrl'));?>

			<?php echo $this->_plugins['function']['form_language_chooser'][0][0]->smartyFormLanguageChooser(array('form' => 'setupForm','url' => $this->_tpl_vars['setupFormUrl']), $this);?>

			<span class="instruct"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "form.formLanguage.description"), $this);?>
</span>
		</td>
	</tr>
</table>
</div>
<?php endif; ?>
<div id="reviewPolicyInfo">
<h3>3.1 <?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.schedConfSetup.review.reviewPolicy"), $this);?>
</h3>

<p><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.schedConfSetup.review.reviewDescription"), $this);?>
</p>

<h4><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.schedConfSetup.review.reviewPolicy"), $this);?>
</h4>

<p><textarea name="reviewPolicy[<?php echo ((is_array($_tmp=$this->_tpl_vars['formLocale'])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
]" id="reviewPolicy" rows="12" cols="60" class="textArea"><?php echo ((is_array($_tmp=$this->_tpl_vars['reviewPolicy'][$this->_tpl_vars['formLocale']])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
</textarea></p>
</div>
<div class="separator"></div>
<div id="peerReview">
<h3>3.2 <?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.schedConfSetup.review.peerReview"), $this);?>
</h3>

<p><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.schedConfSetup.review.reviewGuidelinesDescription"), $this);?>
</p>

<p><textarea name="reviewGuidelines[<?php echo ((is_array($_tmp=$this->_tpl_vars['formLocale'])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
]" id="reviewGuidelines" rows="12" cols="60" class="textArea"><?php echo ((is_array($_tmp=$this->_tpl_vars['reviewGuidelines'][$this->_tpl_vars['formLocale']])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
</textarea></p>

<script type="text/javascript">
	<?php echo '
	<!--
		function toggleAllowSetInviteReminder(form) {
			form.numDaysBeforeInviteReminder.disabled = !form.numDaysBeforeInviteReminder.disabled;
		}
		function toggleAllowSetSubmitReminder(form) {
			form.numDaysBeforeSubmitReminder.disabled = !form.numDaysBeforeSubmitReminder.disabled;
		}
	// -->
	'; ?>

</script>

<p>
	<input type="radio" name="reviewDeadlineType" id="reviewDeadline-1" value="<?php echo @REVIEW_DEADLINE_TYPE_RELATIVE; ?>
" <?php if ($this->_tpl_vars['reviewDeadlineType'] == @REVIEW_DEADLINE_TYPE_RELATIVE): ?> checked="checked"<?php endif; ?> />
		<?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.schedConfSetup.review.numWeeksPerReview1"), $this);?>
&nbsp;
		<input type="text" name="numWeeksPerReviewRelative" id="numWeeksPerReview" <?php if ($this->_tpl_vars['numWeeksPerReviewRelative'] > 0): ?> value="<?php echo ((is_array($_tmp=$this->_tpl_vars['numWeeksPerReviewRelative'])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
" <?php endif; ?> size="2" maxlength="8" class="textField" />&nbsp;
		<?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.schedConfSetup.review.numWeeksPerReview2"), $this);?>
<br/>
	<input type="radio" name="reviewDeadlineType" id="reviewDeadline-2" value="<?php echo @REVIEW_DEADLINE_TYPE_ABSOLUTE; ?>
" <?php if ($this->_tpl_vars['reviewDeadlineType'] == @REVIEW_DEADLINE_TYPE_ABSOLUTE): ?> checked="checked"<?php endif; ?> />
		<?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.schedConfSetup.review.numWeeksPerReview1b"), $this);?>
&nbsp;
		<?php echo smarty_function_html_select_date(array('prefix' => 'numWeeksPerReviewAbsolute','time' => $this->_tpl_vars['absoluteReviewDate'],'all_extra' => "class=\"selectMenu\"",'start_year' => $this->_tpl_vars['firstYear'],'end_year' => $this->_tpl_vars['lastYear']), $this);?>

		<?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.schedConfSetup.review.numWeeksPerReview2b"), $this);?>
<br/>
	<input type="checkbox" name="restrictReviewerFileAccess" id="restrictReviewerFileAccess" value="1"<?php if ($this->_tpl_vars['restrictReviewerFileAccess']): ?> checked="checked"<?php endif; ?> />&nbsp;<label for="restrictReviewerFileAccess"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.schedConfSetup.review.restrictReviewerFileAccess"), $this);?>
</label>
</p>

<p>
	<input type="checkbox" name="reviewerAccessKeysEnabled" id="reviewerAccessKeysEnabled" value="1"<?php if ($this->_tpl_vars['reviewerAccessKeysEnabled']): ?> checked="checked"<?php endif; ?> />&nbsp;<label for="reviewerAccessKeysEnabled"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.schedConfSetup.review.reviewerAccessKeysEnabled"), $this);?>
</label><br/>
	<span class="instruct"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.schedConfSetup.review.reviewerAccessKeysEnabled.description"), $this);?>
</span>
</p>

<p>
	<?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.schedConfSetup.review.automatedReminders"), $this);?>
:<br/>
	<input type="checkbox" <?php if (! $this->_tpl_vars['scheduledTasksEnabled']): ?>disabled="disabled" <?php endif; ?> name="remindForInvite" id="remindForInvite" value="1" onclick="toggleAllowSetInviteReminder(this.form)"<?php if ($this->_tpl_vars['remindForInvite']): ?> checked="checked"<?php endif; ?> />&nbsp;
	<label for="remindForInvite"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.schedConfSetup.review.remindForInvite1"), $this);?>
</label>
	<select name="numDaysBeforeInviteReminder" size="1" class="selectMenu"<?php if (! $this->_tpl_vars['remindForInvite']): ?> disabled="disabled"<?php endif; ?>>
		<?php unset($this->_sections['inviteDayOptions']);
$this->_sections['inviteDayOptions']['name'] = 'inviteDayOptions';
$this->_sections['inviteDayOptions']['start'] = (int)3;
$this->_sections['inviteDayOptions']['loop'] = is_array($_loop=11) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['inviteDayOptions']['show'] = true;
$this->_sections['inviteDayOptions']['max'] = $this->_sections['inviteDayOptions']['loop'];
$this->_sections['inviteDayOptions']['step'] = 1;
if ($this->_sections['inviteDayOptions']['start'] < 0)
    $this->_sections['inviteDayOptions']['start'] = max($this->_sections['inviteDayOptions']['step'] > 0 ? 0 : -1, $this->_sections['inviteDayOptions']['loop'] + $this->_sections['inviteDayOptions']['start']);
else
    $this->_sections['inviteDayOptions']['start'] = min($this->_sections['inviteDayOptions']['start'], $this->_sections['inviteDayOptions']['step'] > 0 ? $this->_sections['inviteDayOptions']['loop'] : $this->_sections['inviteDayOptions']['loop']-1);
if ($this->_sections['inviteDayOptions']['show']) {
    $this->_sections['inviteDayOptions']['total'] = min(ceil(($this->_sections['inviteDayOptions']['step'] > 0 ? $this->_sections['inviteDayOptions']['loop'] - $this->_sections['inviteDayOptions']['start'] : $this->_sections['inviteDayOptions']['start']+1)/abs($this->_sections['inviteDayOptions']['step'])), $this->_sections['inviteDayOptions']['max']);
    if ($this->_sections['inviteDayOptions']['total'] == 0)
        $this->_sections['inviteDayOptions']['show'] = false;
} else
    $this->_sections['inviteDayOptions']['total'] = 0;
if ($this->_sections['inviteDayOptions']['show']):

            for ($this->_sections['inviteDayOptions']['index'] = $this->_sections['inviteDayOptions']['start'], $this->_sections['inviteDayOptions']['iteration'] = 1;
                 $this->_sections['inviteDayOptions']['iteration'] <= $this->_sections['inviteDayOptions']['total'];
                 $this->_sections['inviteDayOptions']['index'] += $this->_sections['inviteDayOptions']['step'], $this->_sections['inviteDayOptions']['iteration']++):
$this->_sections['inviteDayOptions']['rownum'] = $this->_sections['inviteDayOptions']['iteration'];
$this->_sections['inviteDayOptions']['index_prev'] = $this->_sections['inviteDayOptions']['index'] - $this->_sections['inviteDayOptions']['step'];
$this->_sections['inviteDayOptions']['index_next'] = $this->_sections['inviteDayOptions']['index'] + $this->_sections['inviteDayOptions']['step'];
$this->_sections['inviteDayOptions']['first']      = ($this->_sections['inviteDayOptions']['iteration'] == 1);
$this->_sections['inviteDayOptions']['last']       = ($this->_sections['inviteDayOptions']['iteration'] == $this->_sections['inviteDayOptions']['total']);
?>
		<option value="<?php echo $this->_sections['inviteDayOptions']['index']; ?>
"<?php if ($this->_tpl_vars['numDaysBeforeInviteReminder'] == $this->_sections['inviteDayOptions']['index'] || ( $this->_sections['inviteDayOptions']['index'] == 5 && ! $this->_tpl_vars['remindForInvite'] )): ?> selected="selected"<?php endif; ?>><?php echo $this->_sections['inviteDayOptions']['index']; ?>
</option>
		<?php endfor; endif; ?>
	</select>
	<?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.schedConfSetup.review.remindForInvite2"), $this);?>

	<br/>

	<input type="checkbox" <?php if (! $this->_tpl_vars['scheduledTasksEnabled']): ?>disabled="disabled" <?php endif; ?>name="remindForSubmit" id="remindForSubmit" value="1" onclick="toggleAllowSetSubmitReminder(this.form)"<?php if ($this->_tpl_vars['remindForSubmit']): ?> checked="checked"<?php endif; ?> />&nbsp;
	<label for="remindForSubmit"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.schedConfSetup.review.remindForSubmit1"), $this);?>
</label>
	<select name="numDaysBeforeSubmitReminder" size="1" class="selectMenu"<?php if (! $this->_tpl_vars['remindForSubmit']): ?> disabled="disabled"<?php endif; ?>>
		<?php unset($this->_sections['submitDayOptions']);
$this->_sections['submitDayOptions']['name'] = 'submitDayOptions';
$this->_sections['submitDayOptions']['start'] = (int)0;
$this->_sections['submitDayOptions']['loop'] = is_array($_loop=11) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['submitDayOptions']['show'] = true;
$this->_sections['submitDayOptions']['max'] = $this->_sections['submitDayOptions']['loop'];
$this->_sections['submitDayOptions']['step'] = 1;
if ($this->_sections['submitDayOptions']['start'] < 0)
    $this->_sections['submitDayOptions']['start'] = max($this->_sections['submitDayOptions']['step'] > 0 ? 0 : -1, $this->_sections['submitDayOptions']['loop'] + $this->_sections['submitDayOptions']['start']);
else
    $this->_sections['submitDayOptions']['start'] = min($this->_sections['submitDayOptions']['start'], $this->_sections['submitDayOptions']['step'] > 0 ? $this->_sections['submitDayOptions']['loop'] : $this->_sections['submitDayOptions']['loop']-1);
if ($this->_sections['submitDayOptions']['show']) {
    $this->_sections['submitDayOptions']['total'] = min(ceil(($this->_sections['submitDayOptions']['step'] > 0 ? $this->_sections['submitDayOptions']['loop'] - $this->_sections['submitDayOptions']['start'] : $this->_sections['submitDayOptions']['start']+1)/abs($this->_sections['submitDayOptions']['step'])), $this->_sections['submitDayOptions']['max']);
    if ($this->_sections['submitDayOptions']['total'] == 0)
        $this->_sections['submitDayOptions']['show'] = false;
} else
    $this->_sections['submitDayOptions']['total'] = 0;
if ($this->_sections['submitDayOptions']['show']):

            for ($this->_sections['submitDayOptions']['index'] = $this->_sections['submitDayOptions']['start'], $this->_sections['submitDayOptions']['iteration'] = 1;
                 $this->_sections['submitDayOptions']['iteration'] <= $this->_sections['submitDayOptions']['total'];
                 $this->_sections['submitDayOptions']['index'] += $this->_sections['submitDayOptions']['step'], $this->_sections['submitDayOptions']['iteration']++):
$this->_sections['submitDayOptions']['rownum'] = $this->_sections['submitDayOptions']['iteration'];
$this->_sections['submitDayOptions']['index_prev'] = $this->_sections['submitDayOptions']['index'] - $this->_sections['submitDayOptions']['step'];
$this->_sections['submitDayOptions']['index_next'] = $this->_sections['submitDayOptions']['index'] + $this->_sections['submitDayOptions']['step'];
$this->_sections['submitDayOptions']['first']      = ($this->_sections['submitDayOptions']['iteration'] == 1);
$this->_sections['submitDayOptions']['last']       = ($this->_sections['submitDayOptions']['iteration'] == $this->_sections['submitDayOptions']['total']);
?>
			<option value="<?php echo $this->_sections['submitDayOptions']['index']; ?>
"<?php if ($this->_tpl_vars['numDaysBeforeSubmitReminder'] == $this->_sections['submitDayOptions']['index']): ?> selected="selected"<?php endif; ?>><?php echo $this->_sections['submitDayOptions']['index']; ?>
</option>
	<?php endfor; endif; ?>
	</select>
	<?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.schedConfSetup.review.remindForSubmit2"), $this);?>


	<?php if (! $this->_tpl_vars['scheduledTasksEnabled']): ?>
	<br/>
	<?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.schedConfSetup.review.automatedRemindersDisabled"), $this);?>

	<?php endif; ?>
</p>

<p>
	<input type="checkbox" name="rateReviewerOnQuality" id="rateReviewerOnQuality" value="1"<?php if ($this->_tpl_vars['rateReviewerOnQuality']): ?> checked="checked"<?php endif; ?> />&nbsp;<label for="rateReviewerOnQuality"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.schedConfSetup.review.onQuality"), $this);?>
</label>
</p>
</div>
<div class="separator"></div>
<div id="directorDecision">
<h3>3.3 <?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.schedConfSetup.review.directorDecision"), $this);?>
</h3>

<p>
	<input type="checkbox" name="notifyAllAuthorsOnDecision" id="notifyAllAuthorsOnDecision" value="1"<?php if ($this->_tpl_vars['notifyAllAuthorsOnDecision']): ?> checked="checked"<?php endif; ?> />&nbsp;<label for="notifyAllAuthorsOnDecision"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.schedConfSetup.review.notifyAllAuthorsOnDecision"), $this);?>
</label>
</p>
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