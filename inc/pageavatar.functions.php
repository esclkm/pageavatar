<?php

/**
 * Pageavatar for Cotonti CMF
 *
 * @version 4.00
 * @author  esclkm, Seditio.by
 * @copyright (c) 2011 esclkm
 */
defined('COT_CODE') or die('Wrong URL');

global $sets;
if (!isset($pav_sets))
{
	$tpaset = str_replace("\r\n", "\n", $cfg['plugin']['pageavatar']['set']);
	$tpaset = explode("\n", $tpaset);
	foreach ($tpaset as $val)
	{
		$val = explode('|', $val);
		$val = array_map('trim', $val);
		if (!empty($val[0]))
		{
			$thumbs = array();
			if (!empty($val[2]) > 0)
			{
				$varfields = explode(' ', $val[2]);
				foreach ($varfields as $val2)
				{
					$val2 = explode('-', $val2);
					$val2[3] = (!in_array($val2[3], array('crop', 'height', 'width'))) ? 'auto' : $val2[3];
					$thumbs[$val2[0]] = array('x' => (int)$val2[1], 'y' => (int)$val2[2], 'set' => $val2[3]);
				}
			}

			$val[1] = (!empty($val[1])) ? $val[1] : 'datas/photos';
			$val[1] .= (substr($val[1], -1) == '/') ? '' : '/';
			$sets[$val[0]] = array(
				'path' => $val[1],
				'thumbs' => $thumbs,
				'req' => (int)$val[3] ? 1 : 0,
				'ext' => (!empty($val[4])) ? explode(' ', $val[4]) : array('jpg', 'jpeg', 'png', 'gif'),
				'max' => ((int)$val[5] > 0) ? $val[5] : 0
			);
		}
	}
}
else
{
	$sets = $pav_sets;
}
if (!$sets['all'])
{
	$sets['all'] = array(
		'path' => 'datas/photos/',
		'thumbs' => array(),
		'req' => 0,
		'ext' => array('jpg', 'jpeg', 'png', 'gif'),
		'max' => 0
	);
}

if (!function_exists(cot_thumb))
{

	/**
	 * Creates image thumbnail
	 *
	 * @param string $source Original image path
	 * @param string $target Thumbnail path
	 * @param int $width Thumbnail width
	 * @param int $height Thumbnail height
	 * @param string $resize resize options: crop auto width height
	 * @param int $quality JPEG quality in %
	 */
	function cot_thumb($source, $target, $width, $height, $resize = 'crop', $quality = 85)
	{
		$ext = strtolower(pathinfo($source, PATHINFO_EXTENSION));
		list($width_orig, $height_orig) = getimagesize($source);
		$x_pos = 0;
		$y_pos = 0;

		if ($resize == 'crop')
		{
			$newimage = imagecreatetruecolor($width, $height);
			$width_temp = $width;
			$height_temp = $height;

			if ($width_orig / $height_orig > $width / $height)
			{
				$width = $width_orig * $height / $height_orig;
				$x_pos = -($width - $width_temp) / 2;
				$y_pos = 0;
			}
			else
			{
				$height = $height_orig * $width / $width_orig;
				$y_pos = -($height - $height_temp) / 2;
				$x_pos = 0;
			}
		}
		else
		{
			if ($resize == 'auto')
			{
				if ($width_orig < $width && $height_orig < $height)
				{
					$width = $width_orig;
					$height = $height_orig;
				}
				else
				{
					if ($width_orig / $height_orig > $width / $height)
					{
						$height = $width * $height_orig / $width_orig;
					}
					else
					{
						$width = $height * $width_orig / $height_orig;
					}
				}
			}

			if ($resize == 'width')
			{
				if ($width_orig > $width)
				{
					$height = $height_orig * $width / $width_orig;
				}
				else
				{
					$width = $width_orig;
					$height = $height_orig;
				}
			}

			if ($resize == 'height')
			{
				if ($height_orig > $height)
				{
					$width = $width_orig * $height / $height_orig;
				}
				else
				{
					$width = $width_orig;
					$height = $height_orig;
				}
			}
			$newimage = imagecreatetruecolor($width, $height);//
		}

		switch ($ext)
		{
			case 'gif':
				$oldimage = imagecreatefromgif($source);
				break;
			case 'png':
				imagealphablending($newimage, false);
				imagesavealpha($newimage, true);
				$oldimage = imagecreatefrompng($source);
				break;
			default:
				$oldimage = imagecreatefromjpeg($source);
				break;
		}

		imagecopyresampled($newimage, $oldimage, $x_pos, $y_pos, 0, 0, $width, $height, $width_orig, $height_orig);

		switch ($ext)
		{
			case 'gif':
				imagegif($newimage, $target);
				break;
			case 'png':
				imagepng($newimage, $target);
				break;
			default:
				imagejpeg($newimage, $target, $quality);
				break;
		}

		imagedestroy($newimage);
		imagedestroy($oldimage);
	}

}
?>
