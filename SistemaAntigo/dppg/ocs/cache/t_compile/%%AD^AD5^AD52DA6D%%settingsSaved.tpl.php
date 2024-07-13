<?php /* Smarty version 2.6.26, created on 2014-03-31 12:30:09
         compiled from manager/schedConfSetup/settingsSaved.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'url', 'manager/schedConfSetup/settingsSaved.tpl', 15, false),array('function', 'translate', 'manager/schedConfSetup/settingsSaved.tpl', 16, false),array('modifier', 'assign', 'manager/schedConfSetup/settingsSaved.tpl', 15, false),)), $this); ?>
<?php $this->assign('pageTitle', "manager.schedConfSetup.schedConfSetup"); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "manager/schedConfSetup/setupHeader.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php if ($this->_tpl_vars['showSetupHints']): ?>
	<?php echo ((is_array($_tmp=$this->_plugins['function']['url'][0][0]->smartyUrl(array('page' => 'manager'), $this))) ? $this->_run_mod_handler('assign', true, $_tmp, 'conferenceManagementUrl') : $this->_plugins['modifier']['assign'][0][0]->smartyAssign($_tmp, 'conferenceManagementUrl'));?>

	<p><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.setup.finalSchedConfStepSavedNotes",'conferenceManagementUrl' => $this->_tpl_vars['conferenceManagementUrl']), $this);?>
</p>
<?php else: ?>
	<p><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.setup.conferenceSetupUpdated"), $this);?>
</p>
<?php endif; ?>

<?php if ($this->_tpl_vars['setupStep'] == 1): ?>
<div id="step1"><span class="disabled">&lt;&lt; <?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "navigation.previousStep"), $this);?>
</span> | <a href="<?php echo $this->_plugins['function']['url'][0][0]->smartyUrl(array('op' => 'schedConfSetup','path' => '2'), $this);?>
"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "navigation.nextStep"), $this);?>
 &gt;&gt;</a></div>

<?php elseif ($this->_tpl_vars['setupStep'] == 2): ?>
<div id="step2"><a href="<?php echo $this->_plugins['function']['url'][0][0]->smartyUrl(array('op' => 'schedConfSetup','path' => '1'), $this);?>
">&lt;&lt; <?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "navigation.previousStep"), $this);?>
</a> | <a href="<?php echo $this->_plugins['function']['url'][0][0]->smartyUrl(array('op' => 'schedConfSetup','path' => '3'), $this);?>
"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "navigation.nextStep"), $this);?>
 &gt;&gt;</a></div>

<?php elseif ($this->_tpl_vars['setupStep'] == 3): ?>
<div id="step3"><a href="<?php echo $this->_plugins['function']['url'][0][0]->smartyUrl(array('op' => 'schedConfSetup','path' => '2'), $this);?>
">&lt;&lt; <?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "navigation.previousStep"), $this);?>
</a> | <span class="disabled"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "navigation.nextStep"), $this);?>
 &gt;&gt;</span></div>
<?php endif; ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "common/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>