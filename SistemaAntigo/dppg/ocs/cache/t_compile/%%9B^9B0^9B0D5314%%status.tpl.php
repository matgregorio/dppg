<?php /* Smarty version 2.6.26, created on 2014-03-31 15:25:45
         compiled from trackDirector/submission/status.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'trackDirector/submission/status.tpl', 12, false),array('function', 'url', 'trackDirector/submission/status.tpl', 34, false),array('function', 'html_options_translate', 'trackDirector/submission/status.tpl', 52, false),array('modifier', 'date_format', 'trackDirector/submission/status.tpl', 42, false),)), $this); ?>
<div id="status">
<h3><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "common.status"), $this);?>
</h3>

<table width="100%" class="data">
	<tr>
		<?php $this->assign('status', $this->_tpl_vars['submission']->getSubmissionStatus()); ?>
		<td width="20%" class="label"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "common.status"), $this);?>
</td>
		<td width="30%" class="value">
			<?php if ($this->_tpl_vars['status'] == STATUS_ARCHIVED): ?><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "submissions.archived"), $this);?>

			<?php elseif ($this->_tpl_vars['status'] == STATUS_QUEUED_UNASSIGNED): ?><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "submissions.queuedUnassigned"), $this);?>

			<?php elseif ($this->_tpl_vars['status'] == STATUS_QUEUED_EDITING): ?><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "submissions.queuedEditing"), $this);?>

			<?php elseif ($this->_tpl_vars['status'] == STATUS_QUEUED_REVIEW): ?>
				<?php if ($this->_tpl_vars['submission']->getCurrentStage() == REVIEW_STAGE_PRESENTATION): ?>
					<?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "submissions.queuedPaperReview"), $this);?>

				<?php else: ?>
					<?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "submissions.queuedAbstractReview"), $this);?>

				<?php endif; ?>
			<?php elseif ($this->_tpl_vars['status'] == STATUS_PUBLISHED): ?><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "submissions.published"), $this);?>

			<?php elseif ($this->_tpl_vars['status'] == STATUS_DECLINED): ?><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "submissions.declined"), $this);?>

			<?php endif; ?>
		</td>
		<td width="50%" class="value">
			<?php if ($this->_tpl_vars['status'] != STATUS_ARCHIVED): ?>
				<a href="<?php echo $this->_plugins['function']['url'][0][0]->smartyUrl(array('op' => 'unsuitableSubmission','paperId' => $this->_tpl_vars['submission']->getPaperId()), $this);?>
" class="action"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "director.paper.archiveSubmission"), $this);?>
</a>
			<?php else: ?>
				<a href="<?php echo $this->_plugins['function']['url'][0][0]->smartyUrl(array('op' => 'restoreToQueue','path' => $this->_tpl_vars['submission']->getPaperId()), $this);?>
" class="action"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "director.paper.restoreToQueue"), $this);?>
</a>
			<?php endif; ?>
		</td>
	</tr>
	<tr>
		<td class="label"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "submission.initiated"), $this);?>
</td>
		<td colspan="2" class="value"><?php echo ((is_array($_tmp=$this->_tpl_vars['submission']->getDateStatusModified())) ? $this->_run_mod_handler('date_format', true, $_tmp, $this->_tpl_vars['dateFormatShort']) : smarty_modifier_date_format($_tmp, $this->_tpl_vars['dateFormatShort'])); ?>
</td>
	</tr>
	<tr>
		<td class="label"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "submission.lastModified"), $this);?>
</td>
		<td colspan="2" class="value"><?php echo ((is_array($_tmp=$this->_tpl_vars['submission']->getLastModified())) ? $this->_run_mod_handler('date_format', true, $_tmp, $this->_tpl_vars['dateFormatShort']) : smarty_modifier_date_format($_tmp, $this->_tpl_vars['dateFormatShort'])); ?>
</td>
	</tr>
<?php if ($this->_tpl_vars['enableComments']): ?>
	<tr>
		<td class="label"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "comments.readerComments"), $this);?>
</td>
		<td class="value"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => $this->_tpl_vars['submission']->getCommentsStatusString()), $this);?>
</td>
		<td class="value"><form action="<?php echo $this->_plugins['function']['url'][0][0]->smartyUrl(array('op' => 'updateCommentsStatus','path' => $this->_tpl_vars['submission']->getPaperId()), $this);?>
" method="post"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "submission.changeComments"), $this);?>
 <select name="commentsStatus" size="1" class="selectMenu"><?php echo $this->_plugins['function']['html_options_translate'][0][0]->smartyHtmlOptionsTranslate(array('options' => $this->_tpl_vars['commentsStatusOptions'],'selected' => $this->_tpl_vars['submission']->getCommentsStatus()), $this);?>
</select> <input type="submit" value="<?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "common.record"), $this);?>
" class="button" /></form></td>
	</tr>
<?php endif; ?>
</table>
</div>