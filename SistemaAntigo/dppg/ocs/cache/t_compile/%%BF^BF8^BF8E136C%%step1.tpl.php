<?php /* Smarty version 2.6.26, created on 2014-03-31 12:38:57
         compiled from author/submit/step1.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'author/submit/step1.tpl', 20, false),array('function', 'url', 'author/submit/step1.tpl', 28, false),array('function', 'fieldLabel', 'author/submit/step1.tpl', 44, false),array('function', 'html_options', 'author/submit/step1.tpl', 45, false),array('modifier', 'escape', 'author/submit/step1.tpl', 29, false),array('modifier', 'assign', 'author/submit/step1.tpl', 39, false),array('modifier', 'nl2br', 'author/submit/step1.tpl', 132, false),)), $this); ?>
<?php $this->assign('pageTitle', "author.submit.step1"); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "author/submit/submitHeader.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php if ($this->_tpl_vars['currentSchedConf']->getSetting('supportPhone')): ?>
	<?php $this->assign('howToKeyName', "author.submit.howToSubmit"); ?>
<?php else: ?>
	<?php $this->assign('howToKeyName', "author.submit.howToSubmitNoPhone"); ?>
<?php endif; ?>

<p><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => $this->_tpl_vars['howToKeyName'],'supportName' => $this->_tpl_vars['currentSchedConf']->getSetting('supportName'),'supportEmail' => $this->_tpl_vars['currentSchedConf']->getSetting('supportEmail'),'supportPhone' => $this->_tpl_vars['currentSchedConf']->getSetting('supportPhone')), $this);?>
</p>

<div class="separator"></div>

<?php if (count ( $this->_tpl_vars['trackOptions'] ) <= 1): ?>
	<p><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "author.submit.notAccepting"), $this);?>
</p>
<?php else: ?>

<form name="submit" method="post" action="<?php echo $this->_plugins['function']['url'][0][0]->smartyUrl(array('op' => 'saveSubmit','path' => $this->_tpl_vars['submitStep']), $this);?>
" onsubmit="return checkSubmissionChecklist()">
<?php if ($this->_tpl_vars['paperId']): ?><input type="hidden" name="paperId" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['paperId'])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
" /><?php endif; ?>

<?php if (count ( $this->_tpl_vars['trackOptions'] ) == 2): ?>	<?php $_from = $this->_tpl_vars['trackOptions']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['trackOptionKey'] => $this->_tpl_vars['trackOption']):
?>
			<?php endforeach; endif; unset($_from); ?>
	<input type="hidden" name="trackId" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['trackOptionKey'])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
" />
<?php else: ?>	<h3><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "author.submit.conferenceTrack"), $this);?>
</h3>

	<?php echo ((is_array($_tmp=$this->_plugins['function']['url'][0][0]->smartyUrl(array('page' => 'schedConf','op' => 'trackPolicies'), $this))) ? $this->_run_mod_handler('assign', true, $_tmp, 'url') : $this->_plugins['modifier']['assign'][0][0]->smartyAssign($_tmp, 'url'));?>

	<p><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "author.submit.conferenceTrackDescription",'aboutUrl' => $this->_tpl_vars['url']), $this);?>
</p>

	<table class="data" width="100%">
	<tr valign="top">	
		<td width="20%" class="label"><?php echo $this->_plugins['function']['fieldLabel'][0][0]->smartyFieldLabel(array('name' => 'trackId','required' => 'true','key' => "track.track"), $this);?>
</td>
		<td width="80%" class="value"><select name="trackId" id="trackId" size="1" class="selectMenu"><?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['trackOptions'],'selected' => $this->_tpl_vars['trackId']), $this);?>
</select></td>
	</tr>
	</table>

	<div class="separator"></div>
<?php endif; ?>
<?php if (is_array ( $this->_tpl_vars['sessionTypes'] ) && count ( $this->_tpl_vars['sessionTypes'] ) != 0): ?>
	<?php if (count ( $this->_tpl_vars['sessionTypes'] ) == 1): ?>
				<?php $_from = $this->_tpl_vars['sessionTypes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['sessionTypeObject']):
?><?php endforeach; endif; unset($_from); ?>
		<input type="hidden" name="sessionType" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['sessionTypeObject']->getId())) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
" />
	<?php else: ?>		<h3><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "paper.sessionType"), $this);?>
</h3>

		<table width="100%" class="data">
			<?php $this->assign('firstSessionType', 1); ?>
			<?php $_from = $this->_tpl_vars['sessionTypes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['sessionTypeObject']):
?>
				<tr valign="top">
					<td rowspan="2" width="20%" class="label">
						<?php if ($this->_tpl_vars['firstSessionType']): ?>
							<?php echo $this->_plugins['function']['fieldLabel'][0][0]->smartyFieldLabel(array('name' => 'sessionType','key' => "paper.sessionType"), $this);?>

						<?php else: ?>
							&nbsp;
						<?php endif; ?>
					</td>
					<td rowspan="2" width="5%" class="value">
						<input type="radio" class="radioButton" name="sessionType" value="<?php echo $this->_tpl_vars['sessionTypeObject']->getId(); ?>
" <?php if (( $this->_tpl_vars['sessionType'] == $this->_tpl_vars['sessionTypeObject']->getId() ) || ( $this->_tpl_vars['firstSessionType'] && ! $this->_tpl_vars['sessionType'] )): ?>checked="checked" <?php endif; ?> />
					</td>
					<td class="value" width="75%">
						<strong><?php echo $this->_tpl_vars['sessionTypeObject']->getLocalizedName(); ?>
</strong>
					</td>
				</tr>
				<tr valign="top">
					<td class="value">
						<?php echo $this->_tpl_vars['sessionTypeObject']->getLocalizedDescription(); ?>

						<?php if ($this->_tpl_vars['sessionTypeObject']->getLength()): ?>
							<br/>
							<?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.schedConfSetup.submissions.typeOfSubmission.length"), $this);?>
: <?php echo ((is_array($_tmp=$this->_tpl_vars['sessionTypeObject']->getLength())) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>

						<?php endif; ?>
						<?php if ($this->_tpl_vars['sessionTypeObject']->getAbstractLength()): ?>
							<br/>
							<?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.schedConfSetup.submissions.typeOfSubmission.abstractLength"), $this);?>
: <?php echo ((is_array($_tmp=$this->_tpl_vars['sessionTypeObject']->getAbstractLength())) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>

						<?php endif; ?>
					</td>
				</tr>
				<?php $this->assign('firstSessionType', 0); ?>
			<?php endforeach; endif; unset($_from); ?>
		</table>
		<div class="separator"></div>
	<?php endif; ?><?php endif; ?>
<script type="text/javascript">
<?php echo '
<!--
function checkSubmissionChecklist() {
	var elements = document.submit.elements;
	for (var i=0; i < elements.length; i++) {
		if (elements[i].type == \'checkbox\' && !elements[i].checked) {
			if (elements[i].name.match(\'^checklist\')) {
				alert('; ?>
'<?php echo ((is_array($_tmp=$this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "author.submit.verifyChecklist"), $this))) ? $this->_run_mod_handler('escape', true, $_tmp, 'jsparam') : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp, 'jsparam'));?>
'<?php echo ');
				return false;
			} else if (elements[i].name == \'copyrightNoticeAgree\') {
				alert('; ?>
'<?php echo ((is_array($_tmp=$this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "author.submit.copyrightNoticeAgreeRequired"), $this))) ? $this->_run_mod_handler('escape', true, $_tmp, 'jsparam') : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp, 'jsparam'));?>
'<?php echo ');
				return false;
			}
		}
	}
	return true;
}
// -->
'; ?>

</script>

<?php if ($this->_tpl_vars['currentSchedConf']->getLocalizedSetting('submissionChecklist')): ?>
<div id="submissionChecklist">
<?php $_from = $this->_tpl_vars['currentSchedConf']->getLocalizedSetting('submissionChecklist'); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['checklist'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['checklist']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['checklistId'] => $this->_tpl_vars['checklistItem']):
        $this->_foreach['checklist']['iteration']++;
?>
	<?php if ($this->_tpl_vars['checklistItem']['content']): ?>
		<?php if (! $this->_tpl_vars['notFirstChecklistItem']): ?>
			<?php $this->assign('notFirstChecklistItem', 1); ?>
			<h3><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "author.submit.submissionChecklist"), $this);?>
</h3>
			<p><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "author.submit.submissionChecklistDescription"), $this);?>
</p>
			<table width="100%" class="data">
		<?php endif; ?>
		<tr valign="top">
			<td width="5%"><input type="checkbox" id="checklist-<?php echo $this->_foreach['checklist']['iteration']; ?>
" name="checklist[]" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['checklistId'])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
"<?php if ($this->_tpl_vars['paperId'] || $this->_tpl_vars['submissionChecklist']): ?> checked="checked"<?php endif; ?> /></td>
			<td width="95%"><label for="checklist-<?php echo $this->_foreach['checklist']['iteration']; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['checklistItem']['content'])) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</label></td>
		</tr>
	<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>

<?php if ($this->_tpl_vars['notFirstChecklistItem']): ?>
	</table>
	<div class="separator"></div>
<?php endif; ?>
</div>
<?php endif; ?>

<?php if ($this->_tpl_vars['currentConference']->getLocalizedSetting('copyrightNotice') != ''): ?>
<div id="copyrightNotice">
<h3><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "about.copyrightNotice"), $this);?>
</h3>

<p><?php echo ((is_array($_tmp=$this->_tpl_vars['currentConference']->getLocalizedSetting('copyrightNotice'))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</p>

<?php if ($this->_tpl_vars['currentConference']->getSetting('copyrightNoticeAgree')): ?>
<table width="100%" class="data">
	<tr valign="top">
		<td width="5%"><input type="checkbox" name="copyrightNoticeAgree" id="copyrightNoticeAgree" value="1"<?php if ($this->_tpl_vars['paperId'] || $this->_tpl_vars['copyrightNoticeAgree']): ?> checked="checked"<?php endif; ?> /></td>
		<td width="95%"><label for="copyrightNoticeAgree"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "author.submit.copyrightNoticeAgree"), $this);?>
</label></td>
	</tr>
</table>
<?php endif; ?>
</div>
<div class="separator"></div>
<?php endif; ?>

<?php if (( $this->_tpl_vars['currentSchedConf']->getLocalizedSetting('privacyStatement') ) != ''): ?>
<div id="privacyStatement">
<h3><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "author.submit.privacyStatement"), $this);?>
</h3>
<br />
<?php echo ((is_array($_tmp=$this->_tpl_vars['currentSchedConf']->getLocalizedSetting('privacyStatement'))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>


<div class="separator"></div>
</div>
<?php endif; ?>
<div id="commentsForDirector">
<h3><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "author.submit.commentsForDirector"), $this);?>
</h3>
<table width="100%" class="data">

<tr valign="top">
	<td width="20%" class="label"><?php echo $this->_plugins['function']['fieldLabel'][0][0]->smartyFieldLabel(array('name' => 'commentsToDirector','key' => "author.submit.comments"), $this);?>
</td>
	<td width="80%" class="value"><textarea name="commentsToDirector" id="commentsToDirector" rows="3" cols="40" class="textArea"><?php echo ((is_array($_tmp=$this->_tpl_vars['commentsToDirector'])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
</textarea></td>
</tr>

</table>
</div>
<div class="separator"></div>

<p><input type="submit" value="<?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "common.saveAndContinue"), $this);?>
" class="button defaultButton" /> <input type="button" value="<?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "common.cancel"), $this);?>
" class="button" onclick="<?php if ($this->_tpl_vars['paperId']): ?>confirmAction('<?php echo $this->_plugins['function']['url'][0][0]->smartyUrl(array('page' => 'author'), $this);?>
', '<?php echo ((is_array($_tmp=$this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "author.submit.cancelSubmission"), $this))) ? $this->_run_mod_handler('escape', true, $_tmp, 'jsparam') : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp, 'jsparam'));?>
')<?php else: ?>document.location.href='<?php echo $this->_plugins['function']['url'][0][0]->smartyUrl(array('page' => 'author'), $this);?>
'<?php endif; ?>" /></p>

<p><span class="formRequired"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "common.requiredField"), $this);?>
</span></p>

</form>

<?php endif; ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "common/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>