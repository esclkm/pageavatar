<?php

/* ====================
[BEGIN_COT_EXT]
Hooks=pagetags.main
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

global $paset, $pageavatar, $sets;

$catp = $page_data['page_cat'];
$catp_p = cot_structure_parents('page', $catp, 'first');

$paset = ($sets[$catp_p]) ? $sets[$catp_p] : $sets['all'];
$paset = ($sets[$catp]) ? $sets[$catp] : $paset;

$rpageavatar = $page_data['page_'.$cfg['plugin']['pageavatar']['field']];
$temp_array['PAVATAR'] = '';
foreach ($paset['thumbs'] as $key => $val)
{
	$temp_array[mb_strtoupper($key).'PAVATAR'] = '';
}	
if (!empty($rpageavatar))
{
	$filename = $paset['path'].$rpageavatar;
	if (file_exists($filename))
	{
		$temp_array['PAVATAR'] = $filename;
	}
	foreach ($paset['thumbs'] as $key => $val)
	{
		$newfilename = $paset['path'].$key.$rpageavatar;
		if (file_exists($newfilename))
		{
			$temp_array[mb_strtoupper($key).'PAVATAR'] = $newfilename;
		}
	}
}
?>
