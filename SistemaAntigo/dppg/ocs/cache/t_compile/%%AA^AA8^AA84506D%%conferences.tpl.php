<?php /* Smarty version 2.6.26, created on 2016-10-08 21:31:14
         compiled from admin/conferences.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'admin/conferences.tpl', 29, false),array('function', 'url', 'admin/conferences.tpl', 39, false),array('function', 'page_info', 'admin/conferences.tpl', 57, false),array('function', 'page_links', 'admin/conferences.tpl', 58, false),array('block', 'iterate', 'admin/conferences.tpl', 37, false),array('modifier', 'escape', 'admin/conferences.tpl', 39, false),)), $this); ?>
<?php echo ''; ?><?php $this->assign('pageTitle', "conference.conferences"); ?><?php echo ''; ?><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "common/header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php echo ''; ?>

<script type="text/javascript">
<?php echo '
$(document).ready(function() { setupTableDND("#adminConferences", "moveConference"); });
'; ?>

</script>

<br />

<div id="conferences">
<table width="100%" class="listing" id="adminConferences">
	<tr>
		<td colspan="4" class="headseparator">&nbsp;</td>
	</tr>
	<tr valign="top" class="heading">
		<td width="35%"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.setup.layout.conferenceTitle"), $this);?>
</td>
		<td width="35%"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "common.path"), $this);?>
</td>
		<td width="10%"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "common.order"), $this);?>
</td>
		<td width="20%" align="right"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "common.action"), $this);?>
</td>
	</tr>
	<tr>
		<td colspan="4" class="headseparator">&nbsp;</td>
	</tr>
	<?php $this->_tag_stack[] = array('iterate', array('from' => 'conferences','item' => 'conference')); $_block_repeat=true;$this->_plugins['block']['iterate'][0][0]->smartyIterate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
	<tr valign="top" id="conference-<?php echo $this->_tpl_vars['conference']->getId(); ?>
" class="data">
		<td class="drag"><a class="action" href="<?php echo $this->_plugins['function']['url'][0][0]->smartyUrl(array('conference' => $this->_tpl_vars['conference']->getPath(),'page' => 'manager'), $this);?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['conference']->getConferenceTitle())) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
</a></td>
		<td class="drag"><?php echo ((is_array($_tmp=$this->_tpl_vars['conference']->getPath())) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
</td>
		<td><a href="<?php echo $this->_plugins['function']['url'][0][0]->smartyUrl(array('op' => 'moveConference','d' => 'u','id' => $this->_tpl_vars['conference']->getId()), $this);?>
">&uarr;</a> <a href="<?php echo $this->_plugins['function']['url'][0][0]->smartyUrl(array('op' => 'moveConference','d' => 'd','id' => $this->_tpl_vars['conference']->getId()), $this);?>
">&darr;</a></td>
		<td align="right"><a href="<?php echo $this->_plugins['function']['url'][0][0]->smartyUrl(array('op' => 'editConference','path' => $this->_tpl_vars['conference']->getId()), $this);?>
" class="action"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "common.edit"), $this);?>
</a>&nbsp;|&nbsp;<a class="action" href="<?php echo $this->_plugins['function']['url'][0][0]->smartyUrl(array('op' => 'deleteConference','path' => $this->_tpl_vars['conference']->getId()), $this);?>
" onclick="return confirm('<?php echo ((is_array($_tmp=$this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "admin.conferences.confirmDelete"), $this))) ? $this->_run_mod_handler('escape', true, $_tmp, 'jsparam') : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp, 'jsparam'));?>
')"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "common.delete"), $this);?>
</a></td>
	</tr>
	<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['iterate'][0][0]->smartyIterate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
	<?php if ($this->_tpl_vars['conferences']->wasEmpty()): ?>
	<tr>
		<td colspan="4" class="nodata"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "admin.conferences.noneCreated"), $this);?>
</td>
	</tr>
	<tr>
		<td colspan="4" class="endseparator">&nbsp;</td>
	<tr>
	<?php else: ?>
		<tr>
			<td colspan="4" class="endseparator">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="2" align="left"><?php echo $this->_plugins['function']['page_info'][0][0]->smartyPageInfo(array('iterator' => $this->_tpl_vars['conferences']), $this);?>
</td>
			<td colspan="2" align="right"><?php echo $this->_plugins['function']['page_links'][0][0]->smartyPageLinks(array('anchor' => 'conferences','name' => 'conferences','iterator' => $this->_tpl_vars['conferences']), $this);?>
</td>
		</tr>
	<?php endif; ?>
</table>

<p><a href="<?php echo $this->_plugins['function']['url'][0][0]->smartyUrl(array('op' => 'createConference'), $this);?>
" class="action"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "admin.conferences.create"), $this);?>
</a> | <a href="<?php echo $this->_plugins['function']['url'][0][0]->smartyUrl(array('op' => 'importOCS1'), $this);?>
" class="action"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "admin.conferences.importOCS1"), $this);?>
</a></p>
</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "common/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>