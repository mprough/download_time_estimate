<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2003 The zen-cart developers                           |
// |                                                                      |
// | http://www.zen-cart.com/index.php                                    |
// |                                                                      |
// | Portions Copyright (c) 2003 osCommerce                               |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the GPL license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.zen-cart.com/license/2_0.txt.                             |
// | If you did not receive a copy of the zen-cart license and are unable |
// | to obtain it through the world-wide-web, please send a note to       |
// | license@zen-cart.com so we can mail you a copy immediately.          |
// +----------------------------------------------------------------------+
// $Id: functions_dl_estimate.php 408 2014-10-07 05:45:00Z pro-webs.net $
//

////
// Estimate the download time of files
	function zen_dl_estimate($filename) {
	    global $db;
	$dl_attributes_query = "select pad.products_attributes_filename
	                        as filename
	                        from " . TABLE_PRODUCTS_ATTRIBUTES_DOWNLOAD . " pad, " . TABLE_PRODUCTS_ATTRIBUTES . " pa, " . TABLE_PRODUCTS . " p
	                        where p.products_id = " . (int)$_GET['products_id'] . "
	                        and pa.products_id = p.products_id
	                        and pa.products_attributes_id = pad.products_attributes_id";

    $dl_attributes = $db->Execute($dl_attributes_query);

		$bytes = filesize (DIR_FS_DOWNLOAD . $dl_attributes->fields['filename']);

		if ($bytes >= 1048576) {
			$units = "MB";
			$size = sprintf("%01.1f", $bytes / 1048576);
		} elseif ($bytes >= 1024) {
			$units = "KB";
			$size = sprintf("%01.1f", $bytes / 1024);
		} else {
			$units = "bytes";
			$size = $bytes;
		}

		# Cable
		$sec = $bytes / 3750000;
		if ($sec < 1) {
			$slow_time = "< 1 sec";
		} elseif ($sec < 60 ) {
			$slow_time = sprintf("%01.0f seconds", $sec);
		} else {
			$slow_time = sprintf("%01.0f minutes", $sec / 60);
			if ($slow_time >= 60) {
				$slow_time_hours = sprintf("%01.0f", $sec / 60 / 60);
				$slow_time_minutes = sprintf("%01.0f", ($sec - ($slow_time_hours * 60 * 60)) % 60);
				$slow_time = "$slow_time_hours hrs, $slow_time_minutes min";
			}
		}

		# DSL
		$sec = $bytes / 187500;
		if ($sec < 1) {
			$fast_time = "< 1 sec";
		} elseif ($sec < 60 ) {
			$fast_time = sprintf("%01.0f seconds", $sec);
		} else {
			$fast_time = sprintf("%01.0f minutes", $sec / 60);
			if ($fast_time >= 60) {
				$fast_time_hours = sprintf("%01.0f", $sec / 60 / 60);
				$fast_time_minutes = sprintf("%01.0f", ($sec - ($fast_time_hours * 60 * 60)) % 60);
				$fast_time = "$fast_time_hours hrs, $fast_time_minutes min";
			}
		}

		return array ($size . " " . $units, $slow_time, $fast_time);

	}
?>