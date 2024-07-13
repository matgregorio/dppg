<?php /* Smarty version 2.6.26, created on 2015-10-15 10:40:13
         compiled from conference/archive.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'conference/archive.tpl', 19, false),array('function', 'url', 'conference/archive.tpl', 22, false),array('block', 'iterate', 'conference/archive.tpl', 21, false),array('modifier', 'escape', 'conference/archive.tpl', 22, false),array('modifier', 'nl2br', 'conference/archive.tpl', 25, false),array('modifier', 'date_format', 'conference/archive.tpl', 28, false),)), $this); ?>
<?php echo ''; ?><?php $this->assign('pageTitleTranslated', $this->_tpl_vars['conferenceTitle']); ?><?php echo ''; ?><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "common/header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php echo ''; ?>


<div id="archive">
<h3><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "conference.archive"), $this);?>
</h3>
<?php if (! $this->_tpl_vars['schedConfs']->eof()): ?>
	<?php $this->_tag_stack[] = array('iterate', array('from' => 'schedConfs','item' => 'schedConf')); $_block_repeat=true;$this->_plugins['block']['iterate'][0][0]->smartyIterate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
		<h4><a href="<?php echo $this->_plugins['function']['url'][0][0]->smartyUrl(array('schedConf' => $this->_tpl_vars['schedConf']->getPath()), $this);?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['schedConf']->getFullTitle())) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
</a></h4>
		<p>
			<?php echo ((is_array($_tmp=$this->_tpl_vars['schedConf']->getSetting('locationName'))) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
<br/>
			<?php echo ((is_array($_tmp=$this->_tpl_vars['schedConf']->getSetting('locationAddress'))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
<br/>
			<?php if ($this->_tpl_vars['schedConf']->getSetting('locationCity')): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['schedConf']->getSetting('locationCity'))) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
<?php $this->assign('needsComma', true); ?><?php endif; ?><?php if ($this->_tpl_vars['schedConf']->getSetting('locationCountry')): ?><?php if ($this->_tpl_vars['needsComma']): ?>, <?php endif; ?><?php echo ((is_array($_tmp=$this->_tpl_vars['schedConf']->getSetting('locationCountry'))) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
<?php endif; ?>
		</p>
		<p><?php echo ((is_array($_tmp=$this->_tpl_vars['schedConf']->getSetting('startDate'))) ? $this->_run_mod_handler('date_format', true, $_tmp, $this->_tpl_vars['dateFormatLong']) : smarty_modifier_date_format($_tmp, $this->_tpl_vars['dateFormatLong'])); ?>
 &ndash; <?php echo ((is_array($_tmp=$this->_tpl_vars['schedConf']->getSetting('endDate'))) ? $this->_run_mod_handler('date_format', true, $_tmp, $this->_tpl_vars['dateFormatLong']) : smarty_modifier_date_format($_tmp, $this->_tpl_vars['dateFormatLong'])); ?>
</p>
		<?php if ($this->_tpl_vars['schedConf']->getLocalizedSetting('introduction')): ?>
			<p><?php echo ((is_array($_tmp=$this->_tpl_vars['schedConf']->getLocalizedSetting('introduction'))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</p>
		<?php endif; ?>
		<p><a href="<?php echo $this->_plugins['function']['url'][0][0]->smartyUrl(array('schedConf' => $this->_tpl_vars['schedConf']->getPath()), $this);?>
" class="action"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "site.schedConfView"), $this);?>
</a>
	<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['iterate'][0][0]->smartyIterate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
<?php else: ?>
	<?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "conference.noCurrentConferences"), $this);?>

<?php endif; ?>
</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "common/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>