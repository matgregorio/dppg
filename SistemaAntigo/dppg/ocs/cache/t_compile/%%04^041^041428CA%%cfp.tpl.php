<?php /* Smarty version 2.6.26, created on 2014-03-31 12:38:22
         compiled from schedConf/cfp.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'schedConf/cfp.tpl', 12, false),array('function', 'url', 'schedConf/cfp.tpl', 26, false),array('modifier', 'assign', 'schedConf/cfp.tpl', 12, false),array('modifier', 'nl2br', 'schedConf/cfp.tpl', 16, false),)), $this); ?>
<?php echo ''; ?><?php echo ((is_array($_tmp=$this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "schedConf.cfp.title"), $this))) ? $this->_run_mod_handler('assign', true, $_tmp, 'pageTitleTranslated') : $this->_plugins['modifier']['assign'][0][0]->smartyAssign($_tmp, 'pageTitleTranslated'));?><?php echo ''; ?><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "common/header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php echo ''; ?>

<div id="cfp">
<p><?php echo ((is_array($_tmp=$this->_tpl_vars['cfpMessage'])) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</p>

<?php if ($this->_tpl_vars['authorGuidelines'] != ''): ?>
	<h3><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "about.authorGuidelines"), $this);?>
</h3>
	<p><?php echo ((is_array($_tmp=$this->_tpl_vars['authorGuidelines'])) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</p>
<?php endif; ?>

<?php if ($this->_tpl_vars['acceptingSubmissions']): ?>
	<p>
		<?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "author.submit.startHere"), $this);?>
<br/>
		<a href="<?php echo $this->_plugins['function']['url'][0][0]->smartyUrl(array('page' => 'author','op' => 'submit','requiresAuthor' => 1), $this);?>
" class="action"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "author.submit.startHereLink"), $this);?>
</a><br />
	</p>
<?php else: ?>
	<p>
		<?php echo $this->_tpl_vars['notAcceptingSubmissionsMessage']; ?>

	</p>
<?php endif; ?>
</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "common/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>