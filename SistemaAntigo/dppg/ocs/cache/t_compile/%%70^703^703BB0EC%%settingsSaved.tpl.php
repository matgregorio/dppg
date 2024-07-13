<?php /* Smarty version 2.6.26, created on 2016-10-08 21:32:35
         compiled from manager/setup/settingsSaved.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'url', 'manager/setup/settingsSaved.tpl', 15, false),array('function', 'translate', 'manager/setup/settingsSaved.tpl', 16, false),array('modifier', 'assign', 'manager/setup/settingsSaved.tpl', 15, false),)), $this); ?>
<?php $this->assign('pageTitle', "manager.websiteManagement"); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "manager/setup/setupHeader.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php if ($this->_tpl_vars['showSetupHints']): ?>
	<?php echo ((is_array($_tmp=$this->_plugins['function']['url'][0][0]->smartyUrl(array('schedConf' => 'index','page' => 'manager','op' => 'createSchedConf'), $this))) ? $this->_run_mod_handler('assign', true, $_tmp, 'schedConfSetupUrl') : $this->_plugins['modifier']['assign'][0][0]->smartyAssign($_tmp, 'schedConfSetupUrl'));?>

	<p><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.setup.finalStepSavedNotes",'schedConfSetupUrl' => ($this->_tpl_vars['schedConfSetupUrl'])), $this);?>
</p>
<?php else: ?>
	<p><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.setup.conferenceSetupUpdated"), $this);?>
</p>
<?php endif; ?>

<?php if ($this->_tpl_vars['setupStep'] == 1): ?>
<div id="step1"><span class="disabled">&lt;&lt; <?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "navigation.previousStep"), $this);?>
</span> | <a href="<?php echo $this->_plugins['function']['url'][0][0]->smartyUrl(array('op' => 'setup','path' => '2'), $this);?>
"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "navigation.nextStep"), $this);?>
 &gt;&gt;</a></div>

<?php elseif ($this->_tpl_vars['setupStep'] == 2): ?>
<div id="step2"><a href="<?php echo $this->_plugins['function']['url'][0][0]->smartyUrl(array('op' => 'setup','path' => '1'), $this);?>
">&lt;&lt; <?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "navigation.previousStep"), $this);?>
</a> | <a href="<?php echo $this->_plugins['function']['url'][0][0]->smartyUrl(array('op' => 'setup','path' => '3'), $this);?>
"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "navigation.nextStep"), $this);?>
 &gt;&gt;</a></div>

<?php elseif ($this->_tpl_vars['setupStep'] == 3): ?>
<div id="step3"><a href="<?php echo $this->_plugins['function']['url'][0][0]->smartyUrl(array('op' => 'setup','path' => '2'), $this);?>
">&lt;&lt; <?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "navigation.previousStep"), $this);?>
</a> | <a href="<?php echo $this->_plugins['function']['url'][0][0]->smartyUrl(array('op' => 'setup','path' => '4'), $this);?>
"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "navigation.nextStep"), $this);?>
 &gt;&gt;</a></div>

<?php elseif ($this->_tpl_vars['setupStep'] == 4): ?>
<div id="step4"><a href="<?php echo $this->_plugins['function']['url'][0][0]->smartyUrl(array('op' => 'setup','path' => '3'), $this);?>
">&lt;&lt; <?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "navigation.previousStep"), $this);?>
</a> | <a href="<?php echo $this->_plugins['function']['url'][0][0]->smartyUrl(array('op' => 'setup','path' => '5'), $this);?>
"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "navigation.nextStep"), $this);?>
 &gt;&gt;</a></div>

<?php elseif ($this->_tpl_vars['setupStep'] == 5): ?>
<div id="step5"><a href="<?php echo $this->_plugins['function']['url'][0][0]->smartyUrl(array('op' => 'setup','path' => '4'), $this);?>
">&lt;&lt; <?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "navigation.previousStep"), $this);?>
</a> | <a href="<?php echo $this->_plugins['function']['url'][0][0]->smartyUrl(array('op' => 'setup','path' => '6'), $this);?>
"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "navigation.nextStep"), $this);?>
 &gt;&gt;</a></div>

<?php elseif ($this->_tpl_vars['setupStep'] == 6): ?>
<div id="step6"><a href="<?php echo $this->_plugins['function']['url'][0][0]->smartyUrl(array('op' => 'setup','path' => '5'), $this);?>
">&lt;&lt; <?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "navigation.previousStep"), $this);?>
</a> | <span class="disabled"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "navigation.nextStep"), $this);?>
 &gt;&gt;</span></div>
<?php endif; ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "common/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>