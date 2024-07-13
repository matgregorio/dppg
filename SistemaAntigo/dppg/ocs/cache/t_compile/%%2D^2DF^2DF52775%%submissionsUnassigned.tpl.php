<?php /* Smarty version 2.6.26, created on 2014-03-31 15:25:40
         compiled from director/submissionsUnassigned.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'sort_search', 'director/submissionsUnassigned.tpl', 17, false),array('function', 'translate', 'director/submissionsUnassigned.tpl', 33, false),array('function', 'url', 'director/submissionsUnassigned.tpl', 34, false),array('function', 'page_info', 'director/submissionsUnassigned.tpl', 53, false),array('function', 'page_links', 'director/submissionsUnassigned.tpl', 54, false),array('block', 'iterate', 'director/submissionsUnassigned.tpl', 27, false),array('modifier', 'date_format', 'director/submissionsUnassigned.tpl', 30, false),array('modifier', 'escape', 'director/submissionsUnassigned.tpl', 31, false),array('modifier', 'truncate', 'director/submissionsUnassigned.tpl', 32, false),array('modifier', 'assign', 'director/submissionsUnassigned.tpl', 33, false),array('modifier', 'default', 'director/submissionsUnassigned.tpl', 34, false),array('modifier', 'strip_unsafe_html', 'director/submissionsUnassigned.tpl', 34, false),)), $this); ?>
<div id="submissions">
<table width="100%" class="listing">
	<tr>
		<td colspan="5" class="headseparator">&nbsp;</td>
	</tr>
	<tr class="heading" valign="bottom">
		<td width="5%"><?php echo $this->_plugins['function']['sort_search'][0][0]->smartySortSearch(array('key' => "common.id",'sort' => 'id'), $this);?>
</td>
		<td width="5%"><span class="disabled">MM-DD</span><br /><?php echo $this->_plugins['function']['sort_search'][0][0]->smartySortSearch(array('key' => "submissions.submit",'sort' => 'submitDate'), $this);?>
</td>
		<td width="5%"><?php echo $this->_plugins['function']['sort_search'][0][0]->smartySortSearch(array('key' => "submissions.track",'sort' => 'track'), $this);?>
</td>
		<td width="30%"><?php echo $this->_plugins['function']['sort_search'][0][0]->smartySortSearch(array('key' => "paper.authors",'sort' => 'authors'), $this);?>
</td>
		<td width="50%"><?php echo $this->_plugins['function']['sort_search'][0][0]->smartySortSearch(array('key' => "paper.title",'sort' => 'title'), $this);?>
</td>
	</tr>
	<tr>
		<td colspan="5" class="headseparator">&nbsp;</td>
	</tr>
	
	<?php $this->_tag_stack[] = array('iterate', array('from' => 'submissions','item' => 'submission')); $_block_repeat=true;$this->_plugins['block']['iterate'][0][0]->smartyIterate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
	<tr valign="top">
		<td><?php echo $this->_tpl_vars['submission']->getPaperId(); ?>
</td>
		<td><?php echo ((is_array($_tmp=$this->_tpl_vars['submission']->getDateSubmitted())) ? $this->_run_mod_handler('date_format', true, $_tmp, $this->_tpl_vars['dateFormatTrunc']) : smarty_modifier_date_format($_tmp, $this->_tpl_vars['dateFormatTrunc'])); ?>
</td>
		<td><?php echo ((is_array($_tmp=$this->_tpl_vars['submission']->getTrackAbbrev())) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
</td>
		<td><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['submission']->getAuthorString(true))) ? $this->_run_mod_handler('truncate', true, $_tmp, 40, "...") : $this->_plugins['modifier']['truncate'][0][0]->smartyTruncate($_tmp, 40, "...")))) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
</td>
		<?php echo ((is_array($_tmp=$this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "common.untitled"), $this))) ? $this->_run_mod_handler('assign', true, $_tmp, 'untitledPaper') : $this->_plugins['modifier']['assign'][0][0]->smartyAssign($_tmp, 'untitledPaper'));?>

		<td><a href="<?php echo $this->_plugins['function']['url'][0][0]->smartyUrl(array('op' => 'submission','path' => $this->_tpl_vars['submission']->getPaperId()), $this);?>
" class="action"><?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=@$this->_tpl_vars['submission']->getLocalizedTitle())) ? $this->_run_mod_handler('default', true, $_tmp, @$this->_tpl_vars['untitledPaper']) : smarty_modifier_default($_tmp, @$this->_tpl_vars['untitledPaper'])))) ? $this->_run_mod_handler('strip_unsafe_html', true, $_tmp) : String::stripUnsafeHtml($_tmp)))) ? $this->_run_mod_handler('truncate', true, $_tmp, 60, "...") : $this->_plugins['modifier']['truncate'][0][0]->smartyTruncate($_tmp, 60, "...")); ?>
</a>
			<?php if ($this->_tpl_vars['submissionProgress'] != 0 && ( $this->_tpl_vars['currentStage'] == REVIEW_STAGE_ABSTRACT || ( $this->_tpl_vars['currentStage'] == REVIEW_STAGE_PRESENTATION && $this->_tpl_vars['submissionProgress'] < 3 ) )): ?>
				(<a href="<?php echo $this->_plugins['function']['url'][0][0]->smartyUrl(array('op' => 'deleteSubmission','path' => $this->_tpl_vars['paperId']), $this);?>
" class="action" onclick="return confirm('<?php echo ((is_array($_tmp=$this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "author.submissions.confirmDelete"), $this))) ? $this->_run_mod_handler('escape', true, $_tmp, 'jsparam') : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp, 'jsparam'));?>
')"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "common.delete"), $this);?>
</a>)
			<?php endif; ?>
		</td>
	</tr>
	<tr>
		<td colspan="5" class="<?php if ($this->_tpl_vars['submissions']->eof()): ?>end<?php endif; ?>separator">&nbsp;</td>
	</tr>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['iterate'][0][0]->smartyIterate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
<?php if ($this->_tpl_vars['submissions']->wasEmpty()): ?>
	<tr>
		<td colspan="5" class="nodata"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "submissions.noSubmissions"), $this);?>
</td>
	</tr>
	<tr>
		<td colspan="5" class="endseparator">&nbsp;</td>
	</tr>
<?php else: ?>
	<tr>
		<td colspan="4" align="left"><?php echo $this->_plugins['function']['page_info'][0][0]->smartyPageInfo(array('iterator' => $this->_tpl_vars['submissions']), $this);?>
</td>
		<td align="right"><?php echo $this->_plugins['function']['page_links'][0][0]->smartyPageLinks(array('anchor' => 'submissions','name' => 'submissions','iterator' => $this->_tpl_vars['submissions'],'searchField' => $this->_tpl_vars['searchField'],'searchMatch' => $this->_tpl_vars['searchMatch'],'search' => $this->_tpl_vars['search'],'track' => $this->_tpl_vars['track'],'sort' => $this->_tpl_vars['sort'],'sortDirection' => $this->_tpl_vars['sortDirection']), $this);?>
</td>
	</tr>
<?php endif; ?>
</table>
</div>