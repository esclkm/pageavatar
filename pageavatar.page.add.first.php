<?php

/* ====================
[BEGIN_COT_EXT]
Hooks=page.add.add.first,page.edit.update.first
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

require_once(cot_langfile('pageavatar'));
require_once cot_incfile('pageavatar', 'plug');

global $paset, $pageavatar;

$catp = cot_import('rpagecat', 'P', 'TXT');
$catp_p = cot_structure_parents('page', $catp, 'first');
$paset = ($sets[$catp_p]) ? $sets[$catp_p] : $sets['all'];
$paset = ($sets[$catp]) ? $sets[$catp] : $paset;

$pageavatar = (isset($_FILES['pageavatar']) && ($_FILES['pageavatar']['error'] == UPLOAD_ERR_OK) ) ? $_FILES['pageavatar'] : null;

if (!empty($pageavatar["name"]))
{
	$pa_file_ext = mb_strtolower(pathinfo($pageavatar["name"], PATHINFO_EXTENSION));
	if ($pageavatar['error'] == UPLOAD_ERR_OK)
	{
		if (!in_array($pa_file_ext, $paset['ext']))
		{
			cot_error($L['upload']['NAF']);
		}
		if ($paset['max'] > 0 && $pageavatar['size'] * 1024 * 1024 > $paset['max'])
		{
			cot_error($L['upload']['UPLOAD_ERR_SIZE']);
		}
	}
	else
	{
		cot_error($L['upload'][$pageavatar['error']]);
	}
}
elseif (empty($pageavatar["name"]) && $paset['req'] && empty($catp))
{
	cot_error($L['upload']['nofile']);
}
?>