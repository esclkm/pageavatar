<?php

/* ====================
[BEGIN_COT_EXT]
Hooks=page.add.tags,page.edit.tags
Tags=page.add.tpl: {PAGEADD_FORM_AVATAR};page.edit.tpl:{PAGEEDIT_FORM_AVATARFILE}, {PAGEEDIT_FORM_AVATAR}, {PAGEEDIT_FORM_AVATARDELETE}
[END_COT_EXT]
==================== */

/**
 * Pageavatar for Cotonti CMF
 *
 * @version 4.00
 * @author  esclkm
 * @copyright (c) 2011 esclkm
 */
defined('COT_CODE') or die('Wrong URL');
global $paset;
if ($m == 'add')
{
	$t->assign(array(
		"PAGEADD_FORM_AVATAR" => cot_inputbox('file', 'pageavatar', '', 'class="file" size="56"')
	));
}
else
{
	$t->assign(array(
		"PAGEEDIT_FORM_AVATARFILE" => $pag['page_'.$cfg['plugin']['pageavatar']['field']],
		"PAGEEDIT_FORM_AVATAR" => cot_inputbox('hidden', 'rpage'.$cfg['plugin']['pageavatar']['field'], $pag['page_'.$cfg['plugin']['pageavatar']['field']])
		.cot_inputbox('file', 'pageavatar', '', 'class="file" size="56"'),
		"PAGEEDIT_FORM_AVATARDELETE" => cot_radiobox(0, 'rpageavatardelete', array(1, 0), array($L['Yes'], $L['No']))
	));
}
?>