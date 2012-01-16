<?php

/**
 * Pageavatar for Cotonti CMF
 *
 * @version 4.00
 * @author  esclkm
 * @copyright (c) 2011 esclkm
 */

defined('COT_CODE') or die('Wrong URL');

require_once cot_incfile('page', 'module');
global $db_pages, $cfg, $R;
$field = (!$cfg['plugin']['pageavatar']['field']) ? 'avatar' : $cfg['plugin']['pageavatar']['field'];
// Extrafields setup
cot_extrafield_add($db_pages, $field, 'input', $R['input_text'], '', '');
	
?>
