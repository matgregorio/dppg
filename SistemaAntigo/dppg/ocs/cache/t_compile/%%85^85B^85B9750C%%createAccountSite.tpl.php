<?php /* Smarty version 2.6.26, created on 2015-10-15 10:39:13
         compiled from user/createAccountSite.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'user/createAccountSite.tpl', 16, false),array('function', 'url', 'user/createAccountSite.tpl', 21, false),array('block', 'iterate', 'user/createAccountSite.tpl', 18, false),array('modifier', 'escape', 'user/createAccountSite.tpl', 21, false),)), $this); ?>
<?php echo ''; ?><?php $this->assign('pageTitle', "navigation.account"); ?><?php echo ''; ?><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "common/header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php echo ''; ?>

<div id="selectConference">
<?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "user.account.selectConference"), $this);?>
:
<ul>
<?php $this->_tag_stack[] = array('iterate', array('from' => 'conferences','item' => 'conference')); $_block_repeat=true;$this->_plugins['block']['iterate'][0][0]->smartyIterate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
	<li>
		<?php if ($this->_tpl_vars['source']): ?>
			<a href="<?php echo $this->_plugins['function']['url'][0][0]->smartyUrl(array('conference' => $this->_tpl_vars['conference']->getPath(),'page' => 'user','op' => 'account','source' => ((is_array($_tmp=$this->_tpl_vars['source'])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp))), $this);?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['conference']->getConferenceTitle())) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
</a>
		<?php else: ?>
			<a href="<?php echo $this->_plugins['function']['url'][0][0]->smartyUrl(array('conference' => $this->_tpl_vars['conference']->getPath(),'page' => 'user','op' => 'account'), $this);?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['conference']->getConferenceTitle())) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
</a>
		<?php endif; ?>
	</li>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['iterate'][0][0]->smartyIterate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
</ul>
<?php if ($this->_tpl_vars['conferences']->wasEmpty()): ?>
	<?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "user.account.noConferences"), $this);?>

<?php endif; ?>
</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "common/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>