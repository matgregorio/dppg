<?php /* Smarty version 2.6.26, created on 2014-03-31 12:33:11
         compiled from manager/timelineEdit.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'manager/timelineEdit.tpl', 19, false),array('function', 'url', 'manager/timelineEdit.tpl', 24, false),array('function', 'html_select_date', 'manager/timelineEdit.tpl', 42, false),array('function', 'fieldLabel', 'manager/timelineEdit.tpl', 198, false),)), $this); ?>
<?php echo ''; ?><?php $this->assign('pageTitle', "manager.timeline.conferenceTimeline"); ?><?php echo ''; ?><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "common/header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php echo ''; ?>


<br />

<div class="instruct">
	<?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.timeline.description"), $this);?>

</div>

<br />

<form action="<?php echo $this->_plugins['function']['url'][0][0]->smartyUrl(array('op' => 'updateTimeline'), $this);?>
" method="post">

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "common/formErrors.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div id="scheduleEvents">
<h3><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.timeline.scheduleEvents"), $this);?>
</h3>

<table width="100%" class="data">
	<tr valign="top">
		<td width="50%" class="heading"><h4><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.timeline.conference"), $this);?>
</h4></td>
		<td width="50%" class="heading"><h4><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.timeline.postDate"), $this);?>
</h4></td>
	</tr>
	<tr valign="top">
		<td width="50%" class="label">
			<a name="startDate"></a>
			<?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.timeline.schedConfStartsOn"), $this);?>

		</td>
		<td width="50%" class="value">
			<?php echo smarty_function_html_select_date(array('prefix' => 'startDate','time' => $this->_tpl_vars['startDate'],'all_extra' => "class=\"selectMenu\"",'start_year' => $this->_tpl_vars['firstYear'],'end_year' => $this->_tpl_vars['lastYear']), $this);?>

		</td>
	</tr>
	<tr valign="top">
		<td width="50%" class="label">
			<a name="endDate"></a>
			<?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.timeline.schedConfEndsOn"), $this);?>

		</td>
		<td width="50%" class="value">
			<?php echo smarty_function_html_select_date(array('prefix' => 'endDate','time' => $this->_tpl_vars['endDate'],'all_extra' => "class=\"selectMenu\"",'start_year' => $this->_tpl_vars['firstYear'],'end_year' => $this->_tpl_vars['lastYear']), $this);?>

		</td>
	</tr>
</table>
</div>
<br/>

<div id="websiteTimeline">
<table width="100%" class="data">
	<tr valign="top">
		<td width="50%" class="heading"><h4><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.timeline.website"), $this);?>
</h4></td>
		<td width="50%" class="heading"><h4><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.timeline.postDate"), $this);?>
</h4></td>
	</tr>
	<tr valign="top">
		<td width="50%" class="label">
			<a name="siteStartDate"></a>
			<?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.timeline.schedConfAppearsOn"), $this);?>

		</td>
		<td width="50%" class="value">
			<?php echo smarty_function_html_select_date(array('prefix' => 'siteStartDate','time' => $this->_tpl_vars['siteStartDate'],'all_extra' => "class=\"selectMenu\"",'start_year' => $this->_tpl_vars['firstYear'],'end_year' => $this->_tpl_vars['lastYear']), $this);?>

		</td>
	</tr>
	<tr valign="top">
		<td width="50%" class="label">
			<a name="siteEndDate"></a>
			<?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.timeline.schedConfArchivedOn"), $this);?>

		</td>
		<td width="50%" class="value">
			<?php echo smarty_function_html_select_date(array('prefix' => 'siteEndDate','time' => $this->_tpl_vars['siteEndDate'],'all_extra' => "class=\"selectMenu\"",'start_year' => $this->_tpl_vars['firstYear'],'end_year' => $this->_tpl_vars['lastYear']), $this);?>

		</td>
	</tr>
</table>
</div>
<br/>

<div id="submissionsTimeline">
<table width="100%" class="data">
<tr valign="top">
		<td width="50%" class="heading"><h4><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.timeline.submissions"), $this);?>
</h4></td>
		<td width="50%" class="heading"><h4><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.timeline.postDate"), $this);?>
</h4></td>
	</tr>
	<tr valign="top">
		<td width="50%" class="label">
			<a name="regAuthorOpenDate"></a>
			<?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.timeline.openRegAuthor"), $this);?>

		</td>
		<td width="50%" class="value">
			<?php echo smarty_function_html_select_date(array('prefix' => 'regAuthorOpenDate','time' => $this->_tpl_vars['regAuthorOpenDate'],'all_extra' => "class=\"selectMenu\"",'start_year' => $this->_tpl_vars['firstYear'],'end_year' => $this->_tpl_vars['lastYear']), $this);?>

		</td>
	</tr>
	<tr valign="top">
		<td width="50%" class="label">
			<a name="regAuthorCloseDate"></a>
			<?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.timeline.closeRegAuthor"), $this);?>

		</td>
		<td width="50%" class="value">
			<?php echo smarty_function_html_select_date(array('prefix' => 'regAuthorCloseDate','time' => $this->_tpl_vars['regAuthorCloseDate'],'all_extra' => "class=\"selectMenu\"",'start_year' => $this->_tpl_vars['firstYear'],'end_year' => $this->_tpl_vars['lastYear']), $this);?>

			<input type="hidden" name="regAuthorCloseDateHour" value="23" />
			<input type="hidden" name="regAuthorCloseDateMinute" value="59" />
			<input type="hidden" name="regAuthorCloseDateSecond" value="59" />
		</td>
	</tr>
	<tr valign="top">
		<td width="50%" class="label">
			<a name="showCFPDate"></a>
			<?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.timeline.showCFP"), $this);?>

		</td>
		<td width="50%" class="value">
			<?php echo smarty_function_html_select_date(array('prefix' => 'showCFPDate','time' => $this->_tpl_vars['showCFPDate'],'all_extra' => "class=\"selectMenu\"",'start_year' => $this->_tpl_vars['firstYear'],'end_year' => $this->_tpl_vars['lastYear']), $this);?>

		</td>
	</tr>
	<tr valign="top">
		<td width="50%" class="label">
			<a name="submissionsOpenDate"></a>
			<?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.timeline.submissionsOpen"), $this);?>

		</td>
		<td width="50%" class="value">
			<?php echo smarty_function_html_select_date(array('prefix' => 'submissionsOpenDate','time' => $this->_tpl_vars['submissionsOpenDate'],'all_extra' => "class=\"selectMenu\"",'start_year' => $this->_tpl_vars['firstYear'],'end_year' => $this->_tpl_vars['lastYear']), $this);?>

		</td>
	</tr>
	<tr valign="top">
		<td width="50%" class="label">
			<a name="submissionsCloseDate"></a>
			<?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.timeline.submissionsClosed"), $this);?>

		</td>
		<td width="50%" class="value">
			<?php echo smarty_function_html_select_date(array('prefix' => 'submissionsCloseDate','time' => $this->_tpl_vars['submissionsCloseDate'],'all_extra' => "class=\"selectMenu\"",'start_year' => $this->_tpl_vars['firstYear'],'end_year' => $this->_tpl_vars['lastYear']), $this);?>

			<input type="hidden" name="submissionsCloseDateHour" value="23" />
			<input type="hidden" name="submissionsCloseDateMinute" value="59" />
			<input type="hidden" name="submissionsCloseDateSecond" value="59" />
		</td>
	</tr>
</table>
</div>
<br/>

<div id="reviewsTimeline">
<table width="100%" class="data">
	<tr valign="top">
		<td width="50%" class="heading"><h4><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.timeline.reviews"), $this);?>
</h4></td>
		<td width="50%" class="heading"><h4><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.timeline.postDate"), $this);?>
</h4></td>
	</tr>
	<tr valign="top">
		<td width="50%" class="label">
			<a name="regReviewerOpenDate"></a>
			<?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.timeline.openRegReviewer"), $this);?>

		</td>
		<td width="50%" class="value">
			<?php echo smarty_function_html_select_date(array('prefix' => 'regReviewerOpenDate','time' => $this->_tpl_vars['regReviewerOpenDate'],'all_extra' => "class=\"selectMenu\"",'start_year' => $this->_tpl_vars['firstYear'],'end_year' => $this->_tpl_vars['lastYear']), $this);?>

		</td>
	</tr>
	<tr valign="top">
		<td width="50%" class="label">
			<a name="regReviewerCloseDate"></a>
			<?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.timeline.closeRegReviewer"), $this);?>

		</td>
		<td width="50%" class="value">
			<?php echo smarty_function_html_select_date(array('prefix' => 'regReviewerCloseDate','time' => $this->_tpl_vars['regReviewerCloseDate'],'all_extra' => "class=\"selectMenu\"",'start_year' => $this->_tpl_vars['firstYear'],'end_year' => $this->_tpl_vars['lastYear']), $this);?>

			<input type="hidden" name="regReviewerCloseDateHour" value="23" />
			<input type="hidden" name="regReviewerCloseDateMinute" value="59" />
			<input type="hidden" name="regReviewerCloseDateSecond" value="59" />
		</td>
	</tr>
</table>
</div>
<br/>

<div id="websitePosting">
<h3><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.timeline.websitePosting"), $this);?>
</h3>

<table width="100%" class="data">
		
	
	<tr valign="top">
		<td class="label" colspan="2">
			<input type="checkbox" name="postTimeline" id="postTimeline" value="1" <?php if ($this->_tpl_vars['postTimeline']): ?>checked="checked"<?php endif; ?> />
			<?php echo $this->_plugins['function']['fieldLabel'][0][0]->smartyFieldLabel(array('name' => 'postTimeline','key' => "manager.timeline.postTimeline"), $this);?>

		</td>
	</tr>
	
	<tr valign="top">
		<td class="label" colspan="2">
			<input type="checkbox" name="postOverview" id="postOverview" value="1" <?php if ($this->_tpl_vars['postOverview']): ?>checked="checked"<?php endif; ?> />
			<?php echo $this->_plugins['function']['fieldLabel'][0][0]->smartyFieldLabel(array('name' => 'postOverview','key' => "manager.timeline.postOverview"), $this);?>

		</td>
	</tr>
	<tr valign="top">
		<td class="label" colspan="2">
			<input type="checkbox" name="postCFP" id="postCFP" value="1" <?php if ($this->_tpl_vars['postCFP']): ?>checked="checked"<?php endif; ?> />
			<?php echo $this->_plugins['function']['fieldLabel'][0][0]->smartyFieldLabel(array('name' => 'postCFP','key' => "manager.timeline.postCFP"), $this);?>

		</td>
	</tr>
	<tr valign="top">
		<td class="label" colspan="2">
			<input type="checkbox" name="postProposalSubmission" id="postProposalSubmission" value="1" <?php if ($this->_tpl_vars['postProposalSubmission']): ?>checked="checked"<?php endif; ?> />
			<?php echo $this->_plugins['function']['fieldLabel'][0][0]->smartyFieldLabel(array('name' => 'postProposalSubmission','key' => "manager.timeline.postProposalSubmission"), $this);?>

		</td>
	</tr>
	<tr valign="top">
		<td class="label" colspan="2">
			<input type="checkbox" name="postTrackPolicies" id="postTrackPolicies" value="1" <?php if ($this->_tpl_vars['postTrackPolicies']): ?>checked="checked"<?php endif; ?> />
			<?php echo $this->_plugins['function']['fieldLabel'][0][0]->smartyFieldLabel(array('name' => 'postTrackPolicies','key' => "manager.timeline.postTrackPolicies"), $this);?>

		</td>
	</tr>
	<tr valign="top">
		<td class="label" colspan="2">
			<input type="checkbox" name="postProgram" id="postProgram" value="1" <?php if ($this->_tpl_vars['postProgram']): ?>checked="checked"<?php endif; ?> /> 
			<?php echo $this->_plugins['function']['fieldLabel'][0][0]->smartyFieldLabel(array('name' => 'postProgram','key' => "manager.timeline.postProgram"), $this);?>

		</td>
	</tr>
	<tr valign="top">
		<td class="label" colspan="2">
			<input type="checkbox" name="postPresentations" id="postPresentations" value="1" <?php if ($this->_tpl_vars['postPresentations']): ?>checked="checked"<?php endif; ?> />
			<?php echo $this->_plugins['function']['fieldLabel'][0][0]->smartyFieldLabel(array('name' => 'postPresentations','key' => "manager.timeline.postPresentations"), $this);?>

		</td>
	</tr>
	<tr valign="top">
		<td class="label" colspan="2">
			<input type="checkbox" name="postAccommodation" id="postAccommodation" value="1" <?php if ($this->_tpl_vars['postAccommodation']): ?>checked="checked"<?php endif; ?> />
			<?php echo $this->_plugins['function']['fieldLabel'][0][0]->smartyFieldLabel(array('name' => 'postAccommodation','key' => "manager.timeline.postAccommodation"), $this);?>

		</td>
	</tr>
	<tr valign="top">
		<td class="label" colspan="2">
			<input type="checkbox" name="postSupporters" id="postSupporters" value="1" <?php if ($this->_tpl_vars['postSupporters']): ?>checked="checked"<?php endif; ?> />
			<?php echo $this->_plugins['function']['fieldLabel'][0][0]->smartyFieldLabel(array('name' => 'postSupporters','key' => "manager.timeline.postSupporters"), $this);?>

		</td>
	</tr>
	<tr valign="top">
		<td class="label" colspan="2">
			<input type="checkbox" name="postPayment" id="postPayment" value="1" <?php if ($this->_tpl_vars['postPayment']): ?>checked="checked"<?php endif; ?> />
			<?php echo $this->_plugins['function']['fieldLabel'][0][0]->smartyFieldLabel(array('name' => 'postPayment','key' => "manager.timeline.postRegistration"), $this);?>

		</td>
	</tr>
	
	<tr valign="top">
		<td width="50%"><h4><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.timeline.include"), $this);?>
</h4></td>
		<td width="50%" class="heading"><h4><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.timeline.postDate"), $this);?>
</h4></td>
	</tr>
	<tr valign="top">
		<td width="50%" class="label">
			<input type="checkbox" name="postSchedule" id="postSchedule" value="1" <?php if ($this->_tpl_vars['postSchedule']): ?>checked="checked"<?php endif; ?> />
			<?php echo $this->_plugins['function']['fieldLabel'][0][0]->smartyFieldLabel(array('name' => 'postSchedule','key' => "manager.timeline.postSchedule"), $this);?>

		</td>
		<td width="50%" class="value">
			<?php echo smarty_function_html_select_date(array('prefix' => 'postScheduleDate','time' => $this->_tpl_vars['postScheduleDate'],'all_extra' => "class=\"selectMenu\"",'start_year' => $this->_tpl_vars['firstYear'],'end_year' => $this->_tpl_vars['lastYear']), $this);?>

		</td>
	</tr>
	<tr valign="top">
		<td width="50%" class="label">
			<input type="checkbox" name="postAbstracts" id="postAbstracts" value="1" <?php if ($this->_tpl_vars['postAbstracts']): ?>checked="checked"<?php endif; ?> />
			<?php echo $this->_plugins['function']['fieldLabel'][0][0]->smartyFieldLabel(array('name' => 'postAbstracts','key' => "manager.timeline.postAbstracts"), $this);?>

		</td>
		<td width="50%" class="value">
				<?php echo smarty_function_html_select_date(array('prefix' => 'postAbstractsDate','time' => $this->_tpl_vars['postAbstractsDate'],'all_extra' => "class=\"selectMenu\"",'start_year' => $this->_tpl_vars['firstYear'],'end_year' => $this->_tpl_vars['lastYear']), $this);?>

		</td>
	</tr>
	<tr valign="top">
		<td width="50%" class="label">
			<input type="checkbox" name="postPapers" id="postPapers" value="1" <?php if ($this->_tpl_vars['postPapers']): ?>checked="checked"<?php endif; ?> />
			<?php echo $this->_plugins['function']['fieldLabel'][0][0]->smartyFieldLabel(array('name' => 'postPapers','key' => "manager.timeline.postPapers"), $this);?>

		</td>
		<td width="50%" class="value">
				<?php echo smarty_function_html_select_date(array('prefix' => 'postPapersDate','time' => $this->_tpl_vars['postPapersDate'],'all_extra' => "class=\"selectMenu\"",'start_year' => $this->_tpl_vars['firstYear'],'end_year' => $this->_tpl_vars['lastYear']), $this);?>

		</td>
	</tr>
	<tr valign="top">
		<td width="50%" class="label">
			<input type="checkbox" name="delayOpenAccess" id="delayOpenAccess" value="1" <?php if ($this->_tpl_vars['delayOpenAccess']): ?>checked="checked"<?php endif; ?> />
			<?php echo $this->_plugins['function']['fieldLabel'][0][0]->smartyFieldLabel(array('name' => 'delayOpenAccess','key' => "manager.timeline.delayOpenAccess"), $this);?>

		</td>
		<td width="50%" class="value">
				<?php echo smarty_function_html_select_date(array('prefix' => 'delayOpenAccessDate','time' => $this->_tpl_vars['delayOpenAccessDate'],'all_extra' => "class=\"selectMenu\"",'start_year' => $this->_tpl_vars['firstYear'],'end_year' => $this->_tpl_vars['lastYear']), $this);?>

		</td>
	</tr>
	<tr valign="top">
		<td width="50%" class="label">
			<input type="checkbox" name="closeComments" id="closeComments" value="1" <?php if ($this->_tpl_vars['closeComments']): ?>checked="checked"<?php endif; ?> />
			<?php echo $this->_plugins['function']['fieldLabel'][0][0]->smartyFieldLabel(array('name' => 'closeComments','key' => "manager.timeline.closeComments"), $this);?>

		</td>
		<td width="50%" class="value">
				<?php echo smarty_function_html_select_date(array('prefix' => 'closeCommentsDate','time' => $this->_tpl_vars['closeCommentsDate'],'all_extra' => "class=\"selectMenu\"",'start_year' => $this->_tpl_vars['firstYear'],'end_year' => $this->_tpl_vars['lastYear']), $this);?>

			<input type="hidden" name="closeCommentsDateHour" value="23" />
			<input type="hidden" name="closeCommentsDateMinute" value="59" />
			<input type="hidden" name="closeCommentsDateSecond" value="59" />
		</td>
	</tr>
	
</table>
</div>
<br/>

<p>
	<?php if ($this->_tpl_vars['errorsExist']): ?><input type="checkbox" name="overrideDates" value="1" id="overrideDates" />&nbsp;&nbsp;<label for="overrideDates"><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "manager.timeline.overrideDates"), $this);?>
</label><br /><?php endif; ?>
	<input type="submit" value="<?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "common.save"), $this);?>
" class="button defaultButton" />
	<input type="button" value="<?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "common.cancel"), $this);?>
" class="button" onclick="document.location.href='<?php echo $this->_plugins['function']['url'][0][0]->smartyUrl(array('op' => 'index'), $this);?>
'" />
</p>

</form>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "common/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>