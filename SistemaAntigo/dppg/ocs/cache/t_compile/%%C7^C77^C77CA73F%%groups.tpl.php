<?php /* Smarty version 2.6.26, created on 2014-03-31 12:32:16
         compiled from manager/groups/groups.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'url', 'manager/groups/groups.tpl', 25, false),array('function', 'translate', 'manager/groups/groups.tpl', 28, false),array('function', 'icon', 'manager/groups/groups.tpl', 52, false),array('function', 'page_info', 'manager/groups/groups.tpl', 71, false),array('function', 'page_links', 'manager/groups/groups.tpl', 72, false),array('modifier', 'assign', 'manager/groups/groups.tpl', 26, false),array('modifier', 'escape', 'manager/groups/groups.tpl', 52, false),array('block', 'iterate', 'manager/groups/groups.tpl', 48, false),)), $this); ?>
<?php echo ''; ?><?php $this->assign('pageTitle', "manager.groups"); ?><?php echo ''; ?><?php $this->assign('pageId', "manager.groups"); ?><?php echo ''; ?><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "common/header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php echo ''; ?>


<script type="text/javascript">
<?php echo '
$(document).ready(function() { setupTableDND("#dragTable", "moveGroup"); });
'; ?>

</script>

<br/>

<form action="<?php echo $this->_plugins['function']['url'][0][0]->smartyUrl(array('op' => 'setBoardEnabled'), $this);?>
" method="post">
	<?php echo ((is_array($_tmp=$this->_plugins['function']['url'][0][0]->smartyUrl(array('page' => 'about','op' => 'organizingTeam'), $this))) ? $this->_run_mod_handler('assign', true, $_tmp, 'aboutOrganizingTeamUrl') : $this->_plugins['modifier']['assign'][0][0]->smartyAssign($_tmp, 'aboutOrganizingTeamUrl'));?>

	<?php echo ((is_array($_tmp=$this->_plugins['function']['url'][0][0]->smartyUrl(array('page' => 'manager','op' => 'people','path' => 'all'), $this))) ? $this->_run_mod_handler('assign', true, $_tmp, 'peopleManagementUrl') : $this->_plugins['modifier']['assign'][0][0]->smartyAssign($_tmp, 'peopleManagementUrl'));?>

	<?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.groups.enableBoard.description",'aboutOrganizingTeamUrl' => $this->_tpl_vars['aboutOrganizingTeamUrl']), $this);?>
<br/>
	<input type="radio" id="boardEnabledOff" <?php if (! $this->_tpl_vars['boardEnabled']): ?>checked="checked" <?php endif; ?>name="boardEnabled" value="0"/>&nbsp;<label for="boardEnabledOff"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.groups.disableBoard"), $this);?>
</label><br/>
	<input type="radio" id="boardEnabledOn" <?php if ($this->_tpl_vars['boardEnabled']): ?>checked="checked" <?php endif; ?>name="boardEnabled" value="1"/>&nbsp;<label for="boardEnabledOn"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.groups.enableBoard"), $this);?>
</label><br/>
	<input type="submit" value="<?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "common.record"), $this);?>
" class="button defaultButton"/>
</form>

<br />

<div id="groups">
<table width="100%" id="dragTable" class="listing">
	<tr>
		<td colspan="2" class="headseparator">&nbsp;</td>
	</tr>
	<tr class="heading" valign="bottom">
		<td width="75%"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.groups.title"), $this);?>
</td>
		<td width="25%"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "common.action"), $this);?>
</td>
	</tr>
	<tr>
		<td colspan="2" class="headseparator">&nbsp;</td>
	</tr>
<?php $this->_tag_stack[] = array('iterate', array('from' => 'groups','item' => 'group')); $_block_repeat=true;$this->_plugins['block']['iterate'][0][0]->smartyIterate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
	<tr class="data" valign="top" id="group-<?php echo $this->_tpl_vars['group']->getId(); ?>
">
		<td class="drag">
			<?php echo ((is_array($_tmp=$this->_plugins['function']['url'][0][0]->smartyUrl(array('page' => 'manager','op' => 'email','toGroup' => $this->_tpl_vars['group']->getId()), $this))) ? $this->_run_mod_handler('assign', true, $_tmp, 'url') : $this->_plugins['modifier']['assign'][0][0]->smartyAssign($_tmp, 'url'));?>

			<?php echo ((is_array($_tmp=$this->_tpl_vars['group']->getLocalizedTitle())) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
&nbsp;<?php echo $this->_plugins['function']['icon'][0][0]->smartyIcon(array('name' => 'mail','url' => $this->_tpl_vars['url']), $this);?>

		</td>
		<td>
			<a href="<?php echo $this->_plugins['function']['url'][0][0]->smartyUrl(array('op' => 'editGroup','path' => $this->_tpl_vars['group']->getId()), $this);?>
" class="action"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "common.edit"), $this);?>
</a>&nbsp;|&nbsp;<a href="<?php echo $this->_plugins['function']['url'][0][0]->smartyUrl(array('op' => 'groupMembership','path' => $this->_tpl_vars['group']->getId(),'clearPageContext' => 1), $this);?>
" class="action"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.groups.membership"), $this);?>
</a>&nbsp;|&nbsp;<a href="<?php echo $this->_plugins['function']['url'][0][0]->smartyUrl(array('op' => 'deleteGroup','path' => $this->_tpl_vars['group']->getId()), $this);?>
" onclick="return confirm('<?php echo ((is_array($_tmp=$this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.groups.confirmDelete"), $this))) ? $this->_run_mod_handler('escape', true, $_tmp, 'jsparam') : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp, 'jsparam'));?>
')" class="action"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "common.delete"), $this);?>
</a>&nbsp;|&nbsp;<a href="<?php echo $this->_plugins['function']['url'][0][0]->smartyUrl(array('op' => 'moveGroup','d' => 'u','id' => $this->_tpl_vars['group']->getId()), $this);?>
">&uarr;</a>&nbsp;<a href="<?php echo $this->_plugins['function']['url'][0][0]->smartyUrl(array('op' => 'moveGroup','d' => 'd','id' => $this->_tpl_vars['group']->getId()), $this);?>
">&darr;</a>
		</td>
	</tr>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['iterate'][0][0]->smartyIterate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
	<tr>
		<td colspan="2" class="endseparator">&nbsp;</td>
	</tr>
<?php if ($this->_tpl_vars['groups']->wasEmpty()): ?>
	<tr>
		<td colspan="2" class="nodata"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.groups.noneCreated"), $this);?>
</td>
	</tr>
	<tr>
		<td colspan="2" class="endseparator">&nbsp;</td>
	</tr>
<?php else: ?>
	<tr>
		<td align="left"><?php echo $this->_plugins['function']['page_info'][0][0]->smartyPageInfo(array('iterator' => $this->_tpl_vars['groups']), $this);?>
</td>
		<td align="right"><?php echo $this->_plugins['function']['page_links'][0][0]->smartyPageLinks(array('anchor' => 'groups','name' => 'groups','iterator' => $this->_tpl_vars['groups']), $this);?>
</td>
	</tr>
<?php endif; ?>
</table>

<a href="<?php echo $this->_plugins['function']['url'][0][0]->smartyUrl(array('op' => 'createGroup'), $this);?>
" class="action"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.groups.create"), $this);?>
</a>
</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "common/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>