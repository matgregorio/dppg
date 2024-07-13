<?php /* Smarty version 2.6.26, created on 2015-10-15 10:40:42
         compiled from schedConf/papers.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'url', 'schedConf/papers.tpl', 17, false),array('function', 'html_options_translate', 'schedConf/papers.tpl', 19, false),array('function', 'translate', 'schedConf/papers.tpl', 22, false),array('function', 'html_options', 'schedConf/papers.tpl', 31, false),array('modifier', 'escape', 'schedConf/papers.tpl', 25, false),array('modifier', 'strip_unsafe_html', 'schedConf/papers.tpl', 42, false),array('modifier', 'to_array', 'schedConf/papers.tpl', 47, false),)), $this); ?>
<?php echo ''; ?><?php $this->assign('pageTitle', "schedConf.presentations"); ?><?php echo ''; ?><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "common/header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php echo ''; ?>


<?php if ($this->_tpl_vars['mayViewProceedings']): ?>
	<form method="post" name="submit" action="<?php echo $this->_plugins['function']['url'][0][0]->smartyUrl(array('op' => 'presentations'), $this);?>
">
		<select name="searchField" size="1" class="selectMenu">
			<?php echo $this->_plugins['function']['html_options_translate'][0][0]->smartyHtmlOptionsTranslate(array('options' => $this->_tpl_vars['fieldOptions'],'selected' => $this->_tpl_vars['searchField']), $this);?>

		</select>
		<select name="searchMatch" size="1" class="selectMenu">
			<option value="contains"<?php if ($this->_tpl_vars['searchMatch'] == 'contains'): ?> selected="selected"<?php endif; ?>><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "form.contains"), $this);?>
</option>
			<option value="is"<?php if ($this->_tpl_vars['searchMatch'] == 'is'): ?> selected="selected"<?php endif; ?>><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "form.is"), $this);?>
</option>
		</select>
		<input type="text" size="15" name="search" class="textField" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['search'])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
" />
		<input type="submit" value="<?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "common.search"), $this);?>
" class="button" />
		<br />
		<?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "user.lastName"), $this);?>

		<?php $_from = $this->_tpl_vars['alphaList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['letter']):
?><a href="<?php echo $this->_plugins['function']['url'][0][0]->smartyUrl(array('op' => 'presentations','searchInitial' => $this->_tpl_vars['letter'],'track' => $this->_tpl_vars['track']), $this);?>
"><?php if ($this->_tpl_vars['letter'] == $this->_tpl_vars['searchInitial']): ?><strong><?php echo ((is_array($_tmp=$this->_tpl_vars['letter'])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
</strong><?php else: ?><?php echo ((is_array($_tmp=$this->_tpl_vars['letter'])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
<?php endif; ?></a> <?php endforeach; endif; unset($_from); ?><a href="<?php echo $this->_plugins['function']['url'][0][0]->smartyUrl(array('op' => 'presentations','track' => $this->_tpl_vars['track']), $this);?>
"><?php if ($this->_tpl_vars['searchInitial'] == ''): ?><strong><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "common.all"), $this);?>
</strong><?php else: ?><?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "common.all"), $this);?>
<?php endif; ?></a>
		<br />
		<?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "track.track"), $this);?>
: <select name="track" onchange="location.href='<?php echo ((is_array($_tmp=$this->_plugins['function']['url'][0][0]->smartyUrl(array('searchField' => $this->_tpl_vars['searchField'],'searchMatch' => $this->_tpl_vars['searchMatch'],'search' => $this->_tpl_vars['search'],'track' => 'TRACK_ID'), $this))) ? $this->_run_mod_handler('escape', true, $_tmp, 'javascript') : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp, 'javascript'));?>
'.replace('TRACK_ID', this.options[this.selectedIndex].value)" size="1" class="selectMenu"><?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['trackOptions'],'selected' => $this->_tpl_vars['track']), $this);?>
</select>
	</form>
	&nbsp;

	<?php $_from = $this->_tpl_vars['publishedPapers']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['tracks'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['tracks']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['trackId'] => $this->_tpl_vars['track']):
        $this->_foreach['tracks']['iteration']++;
?>
		<?php if ($this->_tpl_vars['track']['title']): ?><h4><?php echo ((is_array($_tmp=$this->_tpl_vars['track']['title'])) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
</h4><?php endif; ?>

		<?php $_from = $this->_tpl_vars['track']['papers']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['paper']):
?>
			<table width="100%">
			<tr valign="top">
				<td width="75%">
				<?php if (! $this->_tpl_vars['mayViewPapers'] || $this->_tpl_vars['paper']->getLocalizedAbstract() != ""): ?><a href="<?php echo $this->_plugins['function']['url'][0][0]->smartyUrl(array('page' => 'paper','op' => 'view','path' => $this->_tpl_vars['paper']->getBestPaperId($this->_tpl_vars['currentConference'])), $this);?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['paper']->getLocalizedTitle())) ? $this->_run_mod_handler('strip_unsafe_html', true, $_tmp) : String::stripUnsafeHtml($_tmp)); ?>
</a><?php else: ?><?php echo ((is_array($_tmp=$this->_tpl_vars['paper']->getLocalizedTitle())) ? $this->_run_mod_handler('strip_unsafe_html', true, $_tmp) : String::stripUnsafeHtml($_tmp)); ?>
<?php endif; ?>
				</td>
				<td align="right" width="25%">
					<?php if ($this->_tpl_vars['mayViewPapers'] && $this->_tpl_vars['paper']->getStatus() == @STATUS_PUBLISHED): ?>
						<?php $_from = $this->_tpl_vars['paper']->getGalleys(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['galleyList'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['galleyList']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['galley']):
        $this->_foreach['galleyList']['iteration']++;
?>
							<a href="<?php echo $this->_plugins['function']['url'][0][0]->smartyUrl(array('page' => 'paper','op' => 'view','path' => ((is_array($_tmp=$this->_tpl_vars['paper']->getBestPaperId($this->_tpl_vars['currentConference']))) ? $this->_run_mod_handler('to_array', true, $_tmp, $this->_tpl_vars['galley']->getId()) : $this->_plugins['modifier']['to_array'][0][0]->smartyToArray($_tmp, $this->_tpl_vars['galley']->getId()))), $this);?>
" class="file"><?php echo ((is_array($_tmp=$this->_tpl_vars['galley']->getGalleyLabel())) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
</a>
						<?php endforeach; endif; unset($_from); ?>
					<?php endif; ?>
				</td>
			</tr>
			<tr>
				<td style="padding-left: 30px;font-style: italic;">
					<?php $_from = $this->_tpl_vars['paper']->getAuthors(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['authorList'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['authorList']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['author']):
        $this->_foreach['authorList']['iteration']++;
?>
						<?php echo ((is_array($_tmp=$this->_tpl_vars['author']->getFullName())) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
<?php if (! ($this->_foreach['authorList']['iteration'] == $this->_foreach['authorList']['total'])): ?>,<?php endif; ?>
					<?php endforeach; endif; unset($_from); ?>
				</td>
				<td align="right"><?php echo ((is_array($_tmp=$this->_tpl_vars['paper']->getPages())) ? $this->_run_mod_handler('escape', true, $_tmp) : $this->_plugins['modifier']['escape'][0][0]->smartyEscape($_tmp)); ?>
</td>
			</tr>
			</table>
		<?php endforeach; else: ?>
			<?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "presentations.trackEmpty"), $this);?>

		<?php endif; unset($_from); ?>

		<?php if (! ($this->_foreach['tracks']['iteration'] == $this->_foreach['tracks']['total'])): ?>
			<div class="separator"></div>
		<?php endif; ?>
	<?php endforeach; else: ?>
		<br />
		<?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "presentations.schedConfEmpty"), $this);?>

	<?php endif; unset($_from); ?>
<?php else: ?> 	<?php echo $this->_plugins['function']['translate'][0][0]->smartyTranslate(array('key' => "presentations.notPermitted"), $this);?>

<?php endif; ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "common/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
