<?php /* Smarty version 2.6.26, created on 2016-10-08 21:32:20
         compiled from manager/setup/step4.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'url', 'manager/setup/step4.tpl', 94, false),array('function', 'translate', 'manager/setup/step4.tpl', 114, false),array('function', 'fieldLabel', 'manager/setup/step4.tpl', 118, false),array('modifier', 'escape', 'manager/setup/step4.tpl', 123, false),array('modifier', 'date_format', 'manager/setup/step4.tpl', 136, false),)), $this); ?>
<?php $this->assign('pageTitle', "manager.setup.style.title"); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "manager/setup/setupHeader.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<script type="text/javascript">
<?php echo '
<!--

// Swap the given entries in the select field.
function swapEntries(field, i, j) {
	var tmpLabel = field.options[j].label;
	var tmpVal = field.options[j].value;
	var tmpText = field.options[j].text;
	var tmpSel = field.options[j].selected;
	field.options[j].label = field.options[i].label;
	field.options[j].value = field.options[i].value;
	field.options[j].text = field.options[i].text;
	field.options[j].selected = field.options[i].selected;
	field.options[i].label = tmpLabel;
	field.options[i].value = tmpVal;
	field.options[i].text = tmpText;
	field.options[i].selected = tmpSel;
}

// Move selected items up in the given select list.
function moveUp(field) {
	var i;
	for (i=0; i<field.length; i++) {
		if (field.options[i].selected == true && i>0) {
			swapEntries(field, i-1, i);
		}
	}
 }

// Move selected items down in the given select list.
function moveDown(field) {
	var i;
	var max = field.length - 1;
	for (i = max; i >= 0; i=i-1) {
		if(field.options[i].selected == true && i < max) {
			swapEntries(field, i+1, i);
		}
	}
}

// Move selected items from select list a to select list b.
function jumpList(a, b) {
	var i;
	for (i=0; i<a.options.length; i++) {
		if (a.options[i].selected == true) {
			bMax = b.options.length;
			b.options[bMax] = new Option(a.options[i].text);
			b.options[bMax].value = a.options[i].value;
			a.options[i] = null;
			i=i-1;
		}
	}
 }

function prepBlockFields() {
	var i;
	var theForm = document.setupForm;
 
	theForm.elements["blockSelectLeft"].value = "";
	for (i=0; i<theForm.blockSelectLeftWidget.options.length; i++) {
		theForm.blockSelectLeft.value += encodeURI(theForm.blockSelectLeftWidget.options[i].value) + " ";
	}
 
	theForm.blockSelectRight.value = "";
	for (i=0; i<theForm.blockSelectRightWidget.options.length; i++) {
		theForm.blockSelectRight.value += encodeURI(theForm.blockSelectRightWidget.options[i].value) + " ";
	}
 
	theForm.blockUnselected.value = "";
	for (i=0; i<theForm.blockUnselectedWidget.options.length; i++) {
		theForm.blockUnselected.value += encodeURI(theForm.blockUnselectedWidget.options[i].value) + " ";
	}
	return true;
}

// -->
'; ?>

</script>

<form name="setupForm" method="post" action="<?php echo $this->_plugins['function']['url'][0][0]->smartyUrl(array('op' => 'saveSetup','path' => '4'), $this);?>
" enctype="multipart/form-data">
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "common/formErrors.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div id="confStyleSheet">
<p><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.setup.style.conferenceStyleSheet.description"), $this);?>
</p>

<table width="100%" class="data">
<tr>
	<td width="20%" class="label"><?php echo $this->_plugins['function']['fieldLabel'][0][0]->smartyFieldLabel(array('name' => 'conferenceTheme','key' => "manager.setup.style.conferenceTheme"), $this);?>
</td>
	<td width="80%" class="value">
		<select name="conferenceTheme" class="selectMenu" id="conferenceTheme"<?php if (empty ( $this->_tpl_vars['conferenceThemes'] )): ?> disabled="disabled"<?php endif; ?>>
			<option value=""><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "common.none"), $this);?>
</option>
			<?php $_from = $this->_tpl_vars['conferenceThemes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['path'] => $this->_tpl_vars['conferenceThemePlugin']):
?>
				<option value="<?php echo ((is_array($_tmp=$this->_tpl_vars['path'])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
"<?php if ($this->_tpl_vars['path'] == $this->_tpl_vars['conferenceTheme']): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['conferenceThemePlugin']->getDisplayName(); ?>
</option>
			<?php endforeach; endif; unset($_from); ?>
		</select>
	</td>

</tr>
<tr>
	<td width="20%" class="label"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.setup.style.useConferenceStyleSheet"), $this);?>
</td>
	<td width="80%" class="value"><input type="file" name="conferenceStyleSheet" class="uploadField" /> <input type="submit" name="uploadConferenceStyleSheet" value="<?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "common.upload"), $this);?>
" class="button" /></td>
</tr>
</table>

<?php if ($this->_tpl_vars['conferenceStyleSheet']): ?>
<?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "common.fileName"), $this);?>
: <a href="<?php echo $this->_tpl_vars['publicFilesDir']; ?>
/<?php echo $this->_tpl_vars['conferenceStyleSheet']['uploadName']; ?>
" class="file"><?php echo ((is_array($_tmp=$this->_tpl_vars['conferenceStyleSheet']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
</a> <?php echo ((is_array($_tmp=$this->_tpl_vars['conferenceStyleSheet']['dateUploaded'])) ? $this->_run_mod_handler('date_format', true, $_tmp, $this->_tpl_vars['datetimeFormatShort']) : smarty_modifier_date_format($_tmp, $this->_tpl_vars['datetimeFormatShort'])); ?>
 <input type="submit" name="deleteConferenceStyleSheet" value="<?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "common.delete"), $this);?>
" class="button" />
<?php endif; ?>
</div>
<div id="sidebars">
<table border="0" align="center">
	<tr align="center">
		<td rowspan="2">
			<?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.setup.layout.leftSidebar"), $this);?>
<br/>
			<input class="button defaultButton" style="width: 130px;" type="button" value="&uarr;" onclick="moveUp(this.form.elements['blockSelectLeftWidget']);" /><br/>
			<select name="blockSelectLeftWidget" multiple="multiple" size="10" class="selectMenu" style="width: 130px; height:200px" >
				<?php $_from = $this->_tpl_vars['leftBlockPlugins']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['block']):
?>
					<option value="<?php echo ((is_array($_tmp=$this->_tpl_vars['block']->getName())) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['block']->getDisplayName())) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
</option>
				<?php endforeach; else: ?>
					<option value=""></option>
				<?php endif; unset($_from); ?>
			</select><br/>
			<input class="button defaultButton" style="width: 130px;" type="button" value="&darr;" onclick="moveDown(this.form.elements['blockSelectLeftWidget']);" />
		</td>
		<td>
			<input class="button defaultButton" style="width: 30px;" type="button" value="&larr;" onclick="jumpList(this.form.elements['blockUnselectedWidget'],this.form.elements['blockSelectLeftWidget']);" /><br/>
			<input class="button defaultButton" style="width: 30px;" type="button" value="&rarr;" onclick="jumpList(this.form.elements['blockSelectLeftWidget'],this.form.elements['blockUnselectedWidget']);" />

		</td>
		<td valign="top">
			<?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.setup.layout.unselected"), $this);?>
<br/>
			<select name="blockUnselectedWidget" multiple="multiple" size="10" class="selectMenu" style="width: 120px; height:180px;" >
				<?php $_from = $this->_tpl_vars['disabledBlockPlugins']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['block']):
?>
					<option value="<?php echo ((is_array($_tmp=$this->_tpl_vars['block']->getName())) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['block']->getDisplayName())) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
</option>
				<?php endforeach; else: ?>
					<option value=""></option>
				<?php endif; unset($_from); ?>
			</select>
		</td> 
		<td>
			<input class="button defaultButton" style="width: 30px;" type="button" value="&larr;" onclick="jumpList(this.form.elements['blockSelectRightWidget'],this.form.elements['blockUnselectedWidget']);" /><br/>
			<input class="button defaultButton" style="width: 30px;" type="button" value="&rarr;" onclick="jumpList(this.form.elements['blockUnselectedWidget'],this.form.elements['blockSelectRightWidget']);" />
		</td>
		<td rowspan="2">
			<?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.setup.layout.rightSidebar"), $this);?>
<br/>
			<input class="button defaultButton" style="width: 130px;" type="button" value="&uarr;" onclick="moveUp(this.form.elements['blockSelectRightWidget']);" /><br/>
			<select name="blockSelectRightWidget" multiple="multiple" size="10" class="selectMenu" style="width: 130px; height:200px" >
				<?php $_from = $this->_tpl_vars['rightBlockPlugins']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['block']):
?>
					<option value="<?php echo ((is_array($_tmp=$this->_tpl_vars['block']->getName())) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['block']->getDisplayName())) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
</option>
				<?php endforeach; else: ?>
					<option value=""></option>
				<?php endif; unset($_from); ?>
			</select><br/>
			<input class="button defaultButton" style="width: 130px;" type="button" value="&darr;" onclick="moveDown(this.form.elements['blockSelectRightWidget']);" />
		</td>
	</tr>
	<tr align="center">
		<td colspan="3" valign="top" height="60px">
			<input class="button defaultButton" style="width: 190px;" type="button" value="&larr;" onclick="jumpList(this.form.elements['blockSelectRightWidget'],this.form.elements['blockSelectLeftWidget']);" /><br/>
			<input class="button defaultButton" style="width: 190px;" type="button" value="&rarr;" onclick="jumpList(this.form.elements['blockSelectLeftWidget'],this.form.elements['blockSelectRightWidget']);" />
		</td>
	</tr>
</table>
<input type="hidden" name="blockSelectLeft" value="" />
<input type="hidden" name="blockSelectRight" value="" />
<input type="hidden" name="blockUnselected" value="" />
</div>
<div class="separator"></div>

<p><input type="submit" onclick="prepBlockFields()" value="<?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "common.saveAndContinue"), $this);?>
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