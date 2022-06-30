<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://www.fiverr.com/junaidzx90
 * @since      1.0.0
 *
 * @package    Affiliate_Products
 * @subpackage Affiliate_Products/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div id="products">
    <form style="width: 75%;" method="post" action="options.php">
        <?php
        settings_fields( 'products_opt_section' );
        do_settings_sections('products_opt_page');
        ?>
    </form>
</div>