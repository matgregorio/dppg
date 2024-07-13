<?php /* Smarty version 2.6.26, created on 2014-03-31 15:25:44
         compiled from trackDirector/submission/management.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'trackDirector/submission/management.tpl', 12, false),array('function', 'url', 'trackDirector/submission/management.tpl', 21, false),array('function', 'icon', 'trackDirector/submission/management.tpl', 22, false),array('function', 'html_options', 'trackDirector/submission/management.tpl', 69, false),array('modifier', 'assign', 'trackDirector/submission/management.tpl', 21, false),array('modifier', 'escape', 'trackDirector/submission/management.tpl', 22, false),array('modifier', 'strip_unsafe_html', 'trackDirector/submission/management.tpl', 27, false),array('modifier', 'to_array', 'trackDirector/submission/management.tpl', 34, false),array('modifier', 'date_format', 'trackDirector/submission/management.tpl', 34, false),array('modifier', 'concat', 'trackDirector/submission/management.tpl', 56, false),array('modifier', 'strip_tags', 'trackDirector/submission/management.tpl', 57, false),array('modifier', 'nl2br', 'trackDirector/submission/management.tpl', 94, false),)), $this); ?>
<div id="submission">
<h3><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "paper.submission"), $this);?>
</h3>

<?php $this->assign('submissionFile', $this->_tpl_vars['submission']->getSubmissionFile()); ?>
<?php $this->assign('suppFiles', $this->_tpl_vars['submission']->getSuppFiles()); ?>

<table width="100%" class="data">
	<tr>
		<td width="20%" class="label"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "paper.authors"), $this);?>
</td>
		<td width="80%" colspan="2" class="value">
			<?php echo ((is_array($_tmp=$this->_plugins['function']['url'][0][0]->smartyUrl(array('page' => 'user','op' => 'email','redirectUrl' => $this->_tpl_vars['currentUrl'],'to' => $this->_tpl_vars['submission']->getAuthorEmails(),'subject' => $this->_tpl_vars['submission']->getLocalizedTitle(),'paperId' => $this->_tpl_vars['submission']->getPaperId()), $this))) ? $this->_run_mod_handler('assign', true, $_tmp, 'url') : $this->_plugins['modifier']['assign'][0][0]->smartyAssign($_tmp, 'url'));?>

			<?php echo ((is_array($_tmp=$this->_tpl_vars['submission']->getAuthorString())) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
 <?php echo $this->_plugins['function']['icon'][0][0]->smartyIcon(array('name' => 'mail','url' => $this->_tpl_vars['url']), $this);?>

		</td>
	</tr>
	<tr>
		<td class="label"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "paper.title"), $this);?>
</td>
		<td colspan="2" class="value"><?php echo ((is_array($_tmp=$this->_tpl_vars['submission']->getLocalizedTitle())) ? $this->_run_mod_handler('strip_unsafe_html', true, $_tmp) : String::stripUnsafeHtml($_tmp)); ?>
</td>
	</tr>
<?php if ($this->_tpl_vars['submissionFile'] || $this->_tpl_vars['submission']->getReviewMode() != REVIEW_MODE_ABSTRACTS_ALONE): ?>
	<tr>
		<td class="label"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "submission.originalFile"), $this);?>
</td>
		<td colspan="2" class="value">
			<?php if ($this->_tpl_vars['submissionFile']): ?>
				<a href="<?php echo $this->_plugins['function']['url'][0][0]->smartyUrl(array('op' => 'downloadFile','path' => ((is_array($_tmp=$this->_tpl_vars['submission']->getPaperId())) ? $this->_run_mod_handler('to_array', true, $_tmp, $this->_tpl_vars['submissionFile']->getFileId()) : $this->_plugins['modifier']['to_array'][0][0]->smartyToArray($_tmp, $this->_tpl_vars['submissionFile']->getFileId()))), $this);?>
" class="file"><?php echo ((is_array($_tmp=$this->_tpl_vars['submissionFile']->getFileName())) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
</a>&nbsp;&nbsp;<?php echo ((is_array($_tmp=$this->_tpl_vars['submissionFile']->getDateModified())) ? $this->_run_mod_handler('date_format', true, $_tmp, $this->_tpl_vars['dateFormatShort']) : smarty_modifier_date_format($_tmp, $this->_tpl_vars['dateFormatShort'])); ?>

			<?php else: ?>
				<?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "common.none"), $this);?>

			<?php endif; ?>
		</td>
	</tr>
<?php endif; ?>
	<tr valign="top">
		<td class="label"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "paper.suppFilesAbbrev"), $this);?>
</td>
		<td colspan="2" class="value">
			<?php $_from = $this->_tpl_vars['suppFiles']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['suppFiles'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['suppFiles']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['suppFile']):
        $this->_foreach['suppFiles']['iteration']++;
?>
				<a href="<?php echo $this->_plugins['function']['url'][0][0]->smartyUrl(array('op' => 'downloadFile','path' => ((is_array($_tmp=$this->_tpl_vars['submission']->getPaperId())) ? $this->_run_mod_handler('to_array', true, $_tmp, $this->_tpl_vars['suppFile']->getFileId()) : $this->_plugins['modifier']['to_array'][0][0]->smartyToArray($_tmp, $this->_tpl_vars['suppFile']->getFileId()))), $this);?>
" class="file"><?php echo ((is_array($_tmp=$this->_tpl_vars['suppFile']->getFileName())) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
</a>&nbsp;&nbsp;<?php echo ((is_array($_tmp=$this->_tpl_vars['suppFile']->getDateModified())) ? $this->_run_mod_handler('date_format', true, $_tmp, $this->_tpl_vars['dateFormatShort']) : smarty_modifier_date_format($_tmp, $this->_tpl_vars['dateFormatShort'])); ?>
&nbsp;&nbsp;<a href="<?php echo $this->_plugins['function']['url'][0][0]->smartyUrl(array('op' => 'editSuppFile','from' => 'submission','path' => ((is_array($_tmp=$this->_tpl_vars['submission']->getPaperId())) ? $this->_run_mod_handler('to_array', true, $_tmp, $this->_tpl_vars['suppFile']->getId()) : $this->_plugins['modifier']['to_array'][0][0]->smartyToArray($_tmp, $this->_tpl_vars['suppFile']->getId()))), $this);?>
" class="action"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "common.edit"), $this);?>
</a>&nbsp;&nbsp;&nbsp;&nbsp;<?php if (! $this->_tpl_vars['notFirst']): ?>&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo $this->_plugins['function']['url'][0][0]->smartyUrl(array('op' => 'addSuppFile','from' => 'submission','path' => $this->_tpl_vars['submission']->getPaperId()), $this);?>
" class="action"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "submission.addSuppFile"), $this);?>
</a><?php endif; ?><br />
				<?php $this->assign('notFirst', 1); ?>
			<?php endforeach; else: ?>
				<?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "common.none"), $this);?>
&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo $this->_plugins['function']['url'][0][0]->smartyUrl(array('op' => 'addSuppFile','from' => 'submission','path' => $this->_tpl_vars['submission']->getPaperId()), $this);?>
" class="action"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "submission.addSuppFile"), $this);?>
</a>
			<?php endif; unset($_from); ?>
		</td>
	</tr>
	<tr>
		<td class="label"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "submission.submitter"), $this);?>
</td>
		<td colspan="2" class="value">
			<?php $this->assign('submitter', $this->_tpl_vars['submission']->getUser()); ?>
			<?php $this->assign('emailString', ((is_array($_tmp=$this->_tpl_vars['submitter']->getFullName())) ? $this->_run_mod_handler('concat', true, $_tmp, " <", $this->_tpl_vars['submitter']->getEmail(), ">") : $this->_plugins['modifier']['concat'][0][0]->smartyConcat($_tmp, " <", $this->_tpl_vars['submitter']->getEmail(), ">"))); ?>
			<?php echo ((is_array($_tmp=$this->_plugins['function']['url'][0][0]->smartyUrl(array('page' => 'user','op' => 'email','redirectUrl' => $this->_tpl_vars['currentUrl'],'to' => ((is_array($_tmp=$this->_tpl_vars['emailString'])) ? $this->_run_mod_handler('to_array', true, $_tmp) : $this->_plugins['modifier']['to_array'][0][0]->smartyToArray($_tmp)),'subject' => ((is_array($_tmp=$this->_tpl_vars['submission']->getLocalizedTitle)) ? $this->_run_mod_handler('strip_tags', true, $_tmp) : smarty_modifier_strip_tags($_tmp)),'paperId' => $this->_tpl_vars['submission']->getPaperId()), $this))) ? $this->_run_mod_handler('assign', true, $_tmp, 'url') : $this->_plugins['modifier']['assign'][0][0]->smartyAssign($_tmp, 'url'));?>

			<?php echo ((is_array($_tmp=$this->_tpl_vars['submitter']->getFullName())) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
 <?php echo $this->_plugins['function']['icon'][0][0]->smartyIcon(array('name' => 'mail','url' => $this->_tpl_vars['url']), $this);?>

		</td>
	</tr>
	<tr>
		<td class="label"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "common.dateSubmitted"), $this);?>
</td>
		<td><?php echo ((is_array($_tmp=$this->_tpl_vars['submission']->getDateSubmitted())) ? $this->_run_mod_handler('date_format', true, $_tmp, $this->_tpl_vars['dateFormatShort']) : smarty_modifier_date_format($_tmp, $this->_tpl_vars['dateFormatShort'])); ?>
</td>
	</tr>
	<tr>
		<td class="label"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "track.track"), $this);?>
</td>
		<td class="value">
			<form action="<?php echo $this->_plugins['function']['url'][0][0]->smartyUrl(array('op' => 'changeTrack','paperId' => $this->_tpl_vars['submission']->getPaperId()), $this);?>
" method="post">
				<select name="trackId" size="1" class="selectMenu"><?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['tracks'],'selected' => $this->_tpl_vars['submission']->getTrackId()), $this);?>
</select>
				<input type="submit" value="<?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "common.record"), $this);?>
" class="button" />
			</form>
		</td>
	</tr>

	<?php $this->assign('sessionType', $this->_tpl_vars['submission']->getData('sessionType')); ?>
	<?php if (is_array ( $this->_tpl_vars['sessionTypes'] ) && ! empty ( $this->_tpl_vars['sessionTypes'] ) && ! ( count ( $this->_tpl_vars['sessionTypes'] ) == 1 && ! empty ( $this->_tpl_vars['sessionType'] ) && isset ( $this->_tpl_vars['sessionTypes'][$this->_tpl_vars['sessionType']] ) )): ?>
		<tr valign="top">
			<td width="20%" class="label"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "paper.sessionType"), $this);?>
</td>
			<td class="data" colspan="2">
				<form action="<?php echo $this->_plugins['function']['url'][0][0]->smartyUrl(array('op' => 'changeSessionType','paperId' => $this->_tpl_vars['submission']->getPaperId()), $this);?>
" method="post">
					<select name="sessionType" size="1" class="selectMenu">
						<?php if (empty ( $this->_tpl_vars['sessionType'] ) || ! isset ( $this->_tpl_vars['sessionTypes'][$this->_tpl_vars['sessionType']] )): ?><option value=""></option><?php endif; ?>
						<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['sessionTypes'],'selected' => $this->_tpl_vars['sessionType']), $this);?>

					</select>
					<input type="submit" value="<?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "common.record"), $this);?>
" class="button" />
				</form>
			</td>
		</tr>
	<?php endif; ?>
	<?php if ($this->_tpl_vars['submission']->getCommentsToDirector()): ?>
	<tr valign="top">
		<td width="20%" class="label"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "paper.commentsToDirector"), $this);?>
</td>
		<td width="80%" colspan="2" class="data"><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['submission']->getCommentsToDirector())) ? $this->_run_mod_handler('strip_unsafe_html', true, $_tmp) : String::stripUnsafeHtml($_tmp)))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</td>
	</tr>
	<?php endif; ?>
	<?php if ($this->_tpl_vars['publishedPaper']): ?>
	<tr>
		<td class="label"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "submission.abstractViews"), $this);?>
</td>
		<td><?php echo $this->_tpl_vars['publishedPaper']->getViews(); ?>
</td>
	</tr>
	<?php endif; ?>
</table>
</div>