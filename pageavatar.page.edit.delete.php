<?php

/* ====================
[BEGIN_COT_EXT]
Hooks=page.edit.delete.done
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

require_once cot_incfile('pageavatar', 'plug');

$catp = $rpagecat;
$catp_p = cot_structure_parents('page', $catp, 'first');
$paset = ($sets[$catp_p]) ? $sets[$catp_p] : $sets['all'];
$paset = ($sets[$catp]) ? $sets[$catp] : $paset;

$filename = $paset['path'].$row['page_'.$cfg['plugin']['pageavatar']['field']];
if (file_exists($filename))
{
	@unlink($filename);
}
foreach ($paset['thumbs'] as $key => $val)
{
	$newfilename = $paset['path'].$key.$row['page_'.$cfg['plugin']['pageavatar']['field']];
	if (file_exists($newfilename))
	{
		@unlink($newfilename);
	}
}
?>
