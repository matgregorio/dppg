<?php /* Smarty version 2.6.26, created on 2014-03-31 15:25:44
         compiled from trackDirector/submission/directors.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'trackDirector/submission/directors.tpl', 12, false),array('function', 'url', 'trackDirector/submission/directors.tpl', 29, false),array('function', 'icon', 'trackDirector/submission/directors.tpl', 30, false),array('modifier', 'concat', 'trackDirector/submission/directors.tpl', 28, false),array('modifier', 'to_array', 'trackDirector/submission/directors.tpl', 29, false),array('modifier', 'strip_tags', 'trackDirector/submission/directors.tpl', 29, false),array('modifier', 'assign', 'trackDirector/submission/directors.tpl', 29, false),array('modifier', 'escape', 'trackDirector/submission/directors.tpl', 30, false),array('modifier', 'date_format', 'trackDirector/submission/directors.tpl', 32, false),)), $this); ?>
<div id="directors">
<h3><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "user.role.directors"), $this);?>
</h3>
<table width="100%" class="listing">
	<tr class="heading" valign="bottom">
		<td width="<?php if ($this->_tpl_vars['isDirector']): ?>20%<?php else: ?>25%<?php endif; ?>">&nbsp;</td>
		<td>&nbsp;</td>
		<td width="<?php if ($this->_tpl_vars['isDirector']): ?>20%<?php else: ?>25%<?php endif; ?>"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "submission.request"), $this);?>
</td>
		<?php if ($this->_tpl_vars['isDirector']): ?><td width="10%"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "common.action"), $this);?>
</td><?php endif; ?>
	</tr>
	<?php $this->assign('editAssignments', $this->_tpl_vars['submission']->getEditAssignments()); ?>
	<?php $_from = $this->_tpl_vars['editAssignments']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['editAssignments'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['editAssignments']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['editAssignment']):
        $this->_foreach['editAssignments']['iteration']++;
?>
	<?php if ($this->_tpl_vars['editAssignment']->getDirectorId() == $this->_tpl_vars['userId']): ?>
		<?php $this->assign('selfAssigned', 1); ?>
	<?php endif; ?>
		<tr valign="top">
			<td><?php if ($this->_tpl_vars['editAssignment']->getIsDirector()): ?><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "user.role.director"), $this);?>
<?php else: ?><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "user.role.trackDirector"), $this);?>
<?php endif; ?></td>
			<td>
				<?php $this->assign('emailString', ((is_array($_tmp=$this->_tpl_vars['editAssignment']->getDirectorFullName())) ? $this->_run_mod_handler('concat', true, $_tmp, " <", $this->_tpl_vars['editAssignment']->getDirectorEmail(), ">") : $this->_plugins['modifier']['concat'][0][0]->smartyConcat($_tmp, " <", $this->_tpl_vars['editAssignment']->getDirectorEmail(), ">"))); ?>
				<?php echo ((is_array($_tmp=$this->_plugins['function']['url'][0][0]->smartyUrl(array('page' => 'user','op' => 'email','redirectUrl' => $this->_tpl_vars['currentUrl'],'to' => ((is_array($_tmp=$this->_tpl_vars['emailString'])) ? $this->_run_mod_handler('to_array', true, $_tmp) : $this->_plugins['modifier']['to_array'][0][0]->smartyToArray($_tmp)),'subject' => ((is_array($_tmp=$this->_tpl_vars['submission']->getLocalizedTitle)) ? $this->_run_mod_handler('strip_tags', true, $_tmp) : smarty_modifier_strip_tags($_tmp)),'paperId' => $this->_tpl_vars['submission']->getPaperId()), $this))) ? $this->_run_mod_handler('assign', true, $_tmp, 'url') : $this->_plugins['modifier']['assign'][0][0]->smartyAssign($_tmp, 'url'));?>

				<?php echo ((is_array($_tmp=$this->_tpl_vars['editAssignment']->getDirectorFullName())) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
 <?php echo $this->_plugins['function']['icon'][0][0]->smartyIcon(array('name' => 'mail','url' => $this->_tpl_vars['url']), $this);?>

			</td>
			<td><?php if ($this->_tpl_vars['editAssignment']->getDateNotified()): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['editAssignment']->getDateNotified())) ? $this->_run_mod_handler('date_format', true, $_tmp, $this->_tpl_vars['dateFormatShort']) : smarty_modifier_date_format($_tmp, $this->_tpl_vars['dateFormatShort'])); ?>
<?php else: ?>&mdash;<?php endif; ?></td>
			<?php if ($this->_tpl_vars['isDirector']): ?>
				<td><a href="<?php echo $this->_plugins['function']['url'][0][0]->smartyUrl(array('page' => 'director','op' => 'deleteEditAssignment','path' => $this->_tpl_vars['editAssignment']->getEditId()), $this);?>
" class="action"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "common.delete"), $this);?>
</a></td>
			<?php endif; ?>
		</tr>
	<?php endforeach; else: ?>
		<tr><td colspan="<?php if ($this->_tpl_vars['isDirector']): ?>4<?php else: ?>3<?php endif; ?>" class="nodata"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "common.noneAssigned"), $this);?>
</td></tr>
	<?php endif; unset($_from); ?>
</table>
<?php if ($this->_tpl_vars['isDirector']): ?>
	<a href="<?php echo $this->_plugins['function']['url'][0][0]->smartyUrl(array('page' => 'director','op' => 'assignDirector','path' => 'trackDirector','paperId' => $this->_tpl_vars['submission']->getPaperId()), $this);?>
" class="action"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "director.paper.assignTrackDirector"), $this);?>
</a>
	|&nbsp;<a href="<?php echo $this->_plugins['function']['url'][0][0]->smartyUrl(array('page' => 'director','op' => 'assignDirector','path' => 'director','paperId' => $this->_tpl_vars['submission']->getPaperId()), $this);?>
" class="action"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "director.paper.assignDirector"), $this);?>
</a>
	<?php if (! $this->_tpl_vars['selfAssigned']): ?>|&nbsp;<a href="<?php echo $this->_plugins['function']['url'][0][0]->smartyUrl(array('page' => 'director','op' => 'assignDirector','path' => 'director','directorId' => $this->_tpl_vars['userId'],'paperId' => $this->_tpl_vars['submission']->getPaperId()), $this);?>
" class="action"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "common.addSelf"), $this);?>
</a><?php endif; ?>
<?php endif; ?>
</div>