<?php
/* ====================
[BEGIN_COT_EXT]
Hooks=page.edit.tags
Tags=page.edit.tpl:{PAGEEDIT_FORM_AVATARFILE}, {PAGEEDIT_FORM_AVATAR}, {PAGEEDIT_FORM_AVATARDELETE}
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

$t->assign(array(
    "PAGEEDIT_FORM_AVATARFILE" => $pag['page_'.$cfg['plugin']['pageavatar']['field']],
    "PAGEEDIT_FORM_AVATAR" => '<input type="hidden" name="rpageavatar" value="'.$pag['page_'.$cfg['plugin']['pageavatar']['field']].'" /><input type="file" class="file" name="pageavatar" size="56"/>',
	"PAGEEDIT_FORM_AVATARDELETE" => "<input type=\"radio\" class=\"radio\" name=\"rpageavatardelete\" value=\"1\" />".$L['Yes']." <input type=\"radio\" class=\"radio\" name=\"rpageavatardelete\" value=\"0\" checked=\"checked\" />".$L['No']
));

?>