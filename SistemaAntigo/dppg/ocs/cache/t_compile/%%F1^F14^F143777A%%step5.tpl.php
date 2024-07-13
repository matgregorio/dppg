<?php /* Smarty version 2.6.26, created on 2014-03-31 12:09:20
         compiled from manager/setup/step5.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'url', 'manager/setup/step5.tpl', 14, false),array('function', 'translate', 'manager/setup/step5.tpl', 34, false),array('function', 'fieldLabel', 'manager/setup/step5.tpl', 39, false),)), $this); ?>
<?php $this->assign('pageTitle', "manager.setup.loggingAndAuditing.title"); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "manager/setup/setupHeader.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<form name="setupForm" method="post" action="<?php echo $this->_plugins['function']['url'][0][0]->smartyUrl(array('op' => 'saveSetup','path' => '5'), $this);?>
" enctype="multipart/form-data">
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "common/formErrors.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div id="pageDescription">
<p><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.setup.loggingAndAuditing.pageDescription"), $this);?>
</p>

<table width="100%" class="data">
	<tr valign="top">
		<td width="5%" class="label"><input type="checkbox" name="paperEventLog" id="paperEventLog" value="1"<?php if ($this->_tpl_vars['paperEventLog']): ?> checked="checked"<?php endif; ?> /></td>
		<td width="95%" class="value"><?php echo $this->_plugins['function']['fieldLabel'][0][0]->smartyFieldLabel(array('name' => 'paperEventLog','key' => "manager.setup.loggingAndAuditing.submissionEventLogging"), $this);?>
</td>
	</tr>
	<tr valign="top">
		<td class="label"><input type="checkbox" name="paperEmailLog" id="paperEmailLog" value="1"<?php if ($this->_tpl_vars['paperEmailLog']): ?> checked="checked"<?php endif; ?> /></td>
		<td class="value"><?php echo $this->_plugins['function']['fieldLabel'][0][0]->smartyFieldLabel(array('name' => 'paperEmailLog','key' => "manager.setup.loggingAndAuditing.submissionEmailLogging"), $this);?>
</td>
	</tr>
	<tr valign="top">
		<td class="label"><input type="checkbox" name="conferenceEventLog" id="conferenceEventLog" value="1"<?php if ($this->_tpl_vars['conferenceEventLog']): ?> checked="checked"<?php endif; ?> /></td>
		<td class="value"><?php echo $this->_plugins['function']['fieldLabel'][0][0]->smartyFieldLabel(array('name' => 'conferenceEventLog','key' => "manager.setup.loggingAndAuditing.conferenceEventLogging"), $this);?>
</td>
	</tr>
</table>
</div>
<p><input type="submit" value="<?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "common.saveAndContinue"), $this);?>
" class="button defaultButton" /> <input type="button" value="<?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "common.cancel"), $this);?>
" class="button" onclick="document.location.href='<?php echo $this->_plugins['function']['url'][0][0]->smartyUrl(array('op' => 'setup'), $this);?>
'" /></p>

<p><span class="formRequired"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "common.requiredField"), $this);?>
</span></p>

</form>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "common/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>