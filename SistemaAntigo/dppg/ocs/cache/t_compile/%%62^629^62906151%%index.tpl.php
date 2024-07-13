<?php /* Smarty version 2.6.26, created on 2014-03-31 12:35:40
         compiled from schedConf/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'nl2br', 'schedConf/index.tpl', 22, false),array('modifier', 'date_format', 'schedConf/index.tpl', 23, false),array('modifier', 'escape', 'schedConf/index.tpl', 45, false),array('function', 'translate', 'schedConf/index.tpl', 32, false),array('function', 'url', 'schedConf/index.tpl', 36, false),)), $this); ?>
<?php echo ''; ?><?php $this->assign('pageCrumbTitleTranslated', $this->_tpl_vars['schedConf']->getSchedConfTitle()); ?><?php echo ''; ?><?php $this->assign('pageTitleTranslated', $this->_tpl_vars['schedConf']->getFullTitle()); ?><?php echo ''; ?><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "common/header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php echo ''; ?>


<h2><?php echo ((is_array($_tmp=$this->_tpl_vars['schedConf']->getSetting('locationName'))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</h2>
<?php if ($this->_tpl_vars['schedConf']->getSetting('startDate')): ?><h2><?php echo ((is_array($_tmp=$this->_tpl_vars['schedConf']->getSetting('startDate'))) ? $this->_run_mod_handler('date_format', true, $_tmp, $this->_tpl_vars['dateFormatLong']) : smarty_modifier_date_format($_tmp, $this->_tpl_vars['dateFormatLong'])); ?>
 &ndash; <?php echo ((is_array($_tmp=$this->_tpl_vars['schedConf']->getSetting('endDate'))) ? $this->_run_mod_handler('date_format', true, $_tmp, $this->_tpl_vars['dateFormatLong']) : smarty_modifier_date_format($_tmp, $this->_tpl_vars['dateFormatLong'])); ?>
</h2><?php endif; ?>

<br />

<div><?php echo ((is_array($_tmp=$this->_tpl_vars['schedConf']->getLocalizedSetting('introduction'))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</div>

<?php if ($this->_tpl_vars['enableAnnouncementsHomepage']): ?>
		<div id="announcementsHome">
		<h3><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "announcement.announcementsHome"), $this);?>
</h3>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "announcement/list.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>	
		<table class="announcementsMore">
			<tr>
				<td><a href="<?php echo $this->_plugins['function']['url'][0][0]->smartyUrl(array('page' => 'announcement'), $this);?>
"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "announcement.moreAnnouncements"), $this);?>
</a></td>
			</tr>
		</table>
	</div>
<?php endif; ?>

<br />

<?php if ($this->_tpl_vars['homepageImage']): ?>
<div id="homepageImage"><img src="<?php echo $this->_tpl_vars['publicFilesDir']; ?>
/<?php echo ((is_array($_tmp=$this->_tpl_vars['homepageImage']['uploadName'])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
" width="<?php echo $this->_tpl_vars['homepageImage']['width']; ?>
" height="<?php echo $this->_tpl_vars['homepageImage']['height']; ?>
" <?php if ($this->_tpl_vars['homepageImageAltText'] != ''): ?>alt="<?php echo ((is_array($_tmp=$this->_tpl_vars['homepageImageAltText'])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
"<?php else: ?>alt="<?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "common.conferenceHomepageImage.altText"), $this);?>
"<?php endif; ?> /></div>
<?php endif; ?>

<?php if ($this->_tpl_vars['schedConfPostOverview'] || $this->_tpl_vars['schedConfShowCFP'] || $this->_tpl_vars['schedConfPostPolicies'] || $this->_tpl_vars['schedConfShowProgram'] || $this->_tpl_vars['schedConfPostPresentations'] || $this->_tpl_vars['schedConfPostSchedule'] || $this->_tpl_vars['schedConfPostPayment'] || $this->_tpl_vars['schedConfPostAccommodation'] || $this->_tpl_vars['schedConfPostSupporters'] || $this->_tpl_vars['schedConfPostTimeline']): ?>
<h3><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "schedConf.contents"), $this);?>
</h3>

<ul class="plain">
	<?php if ($this->_tpl_vars['schedConfPostOverview']): ?><li>&#187; <a href="<?php echo $this->_plugins['function']['url'][0][0]->smartyUrl(array('page' => 'schedConf','op' => 'overview'), $this);?>
"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "schedConf.overview"), $this);?>
</a></li><?php endif; ?>
	<?php if ($this->_tpl_vars['schedConfShowCFP']): ?>
		<li>&#187; <a href="<?php echo $this->_plugins['function']['url'][0][0]->smartyUrl(array('page' => 'schedConf','op' => 'cfp'), $this);?>
"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "schedConf.cfp"), $this);?>
</a><?php if ($this->_tpl_vars['submissionsOpenDate']): ?> (<?php echo ((is_array($_tmp=$this->_tpl_vars['submissionsOpenDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, $this->_tpl_vars['dateFormatLong']) : smarty_modifier_date_format($_tmp, $this->_tpl_vars['dateFormatLong'])); ?>
 - <?php echo ((is_array($_tmp=$this->_tpl_vars['submissionsCloseDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, $this->_tpl_vars['dateFormatLong']) : smarty_modifier_date_format($_tmp, $this->_tpl_vars['dateFormatLong'])); ?>
)<?php endif; ?></li>
	<?php endif; ?>
	<?php if ($this->_tpl_vars['schedConfPostTrackPolicies']): ?><li>&#187; <a href="<?php echo $this->_plugins['function']['url'][0][0]->smartyUrl(array('page' => 'schedConf','op' => 'trackPolicies'), $this);?>
"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "schedConf.trackPolicies"), $this);?>
</a></li><?php endif; ?>
	<?php if ($this->_tpl_vars['schedConfShowProgram']): ?><li>&#187; <a href="<?php echo $this->_plugins['function']['url'][0][0]->smartyUrl(array('page' => 'schedConf','op' => 'program'), $this);?>
"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "schedConf.program"), $this);?>
</a></li><?php endif; ?>
	<?php if ($this->_tpl_vars['schedConfPostPresentations']): ?><li>&#187; <a href="<?php echo $this->_plugins['function']['url'][0][0]->smartyUrl(array('page' => 'schedConf','op' => 'presentations'), $this);?>
"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "schedConf.presentations.short"), $this);?>
</a></li><?php endif; ?>
	<?php if ($this->_tpl_vars['schedConfPostSchedule']): ?><li>&#187; <a href="<?php echo $this->_plugins['function']['url'][0][0]->smartyUrl(array('page' => 'schedConf','op' => 'schedule'), $this);?>
"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "schedConf.schedule"), $this);?>
</a></li><?php endif; ?>
	<?php if ($this->_tpl_vars['schedConfPostPayment']): ?><li>&#187; <a href="<?php echo $this->_plugins['function']['url'][0][0]->smartyUrl(array('page' => 'schedConf','op' => 'registration'), $this);?>
"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "schedConf.registration"), $this);?>
</a></li><?php endif; ?>
	<?php if ($this->_tpl_vars['schedConfPostAccommodation']): ?><li>&#187; <a href="<?php echo $this->_plugins['function']['url'][0][0]->smartyUrl(array('page' => 'schedConf','op' => 'accommodation'), $this);?>
"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "schedConf.accommodation"), $this);?>
</a></li><?php endif; ?>
	<?php if ($this->_tpl_vars['schedConfPostSupporters']): ?><li>&#187; <a href="<?php echo $this->_plugins['function']['url'][0][0]->smartyUrl(array('page' => 'about','op' => 'organizingTeam'), $this);?>
"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "schedConf.supporters"), $this);?>
</a></li><?php endif; ?>
	<?php if ($this->_tpl_vars['schedConfPostTimeline']): ?><li>&#187; <a href="<?php echo $this->_plugins['function']['url'][0][0]->smartyUrl(array('page' => 'schedConf','op' => 'timeline'), $this);?>
"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "schedConf.timeline"), $this);?>
</a></li><?php endif; ?>
</ul>
<?php endif; ?>
<?php echo $this->_tpl_vars['additionalHomeContent']; ?>


<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "common/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>