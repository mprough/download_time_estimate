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
// $Id: dl_estimate.php 408 2014-10-07 05:40:26Z pro-webs.net
//
	$dl_attributes_query = "select pad.products_attributes_filename
	                        as filename
	                        from " . TABLE_PRODUCTS_ATTRIBUTES_DOWNLOAD . " pad, " . TABLE_PRODUCTS_ATTRIBUTES . " pa, " . TABLE_PRODUCTS . " p
	                        where p.products_id = " . (int)$_GET['products_id'] . "
	                        and pa.products_id = p.products_id
	                        and pa.products_attributes_id = pad.products_attributes_id";

    $dl_attributes = $db->Execute($dl_attributes_query);

	if ($dl_attributes->RecordCount() > 0 ) {
		list($dl_size, $dl_time_slow, $dl_time_fast) = zen_dl_estimate($dl_attributes->fields['filename']);
?>
				<div id="dl">
					<strong><?php echo TEXT_FILE_SIZE_BYTES ?><?php echo $dl_size ?><?php echo TEXT_FILE_TYPE ?></strong><br />
     				<?php echo TEXT_ESTIMATED_TIME ?><br />
					<?php echo TEXT_MODEM ?><?php echo $dl_time_slow ?><br />
					<?php echo TEXT_CABLE ?><?php echo $dl_time_fast ?>
				</div>
<?php
}
?>