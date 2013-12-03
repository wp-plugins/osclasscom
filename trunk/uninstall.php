<?php
/**
 * Fired when the plugin is uninstalled.
 */

//if uninstall not called from WordPress exit
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) )
    exit ();

if( get_option('osclasscom_pageid') != '' ) {
    wp_delete_post(get_option('osclasscom_pageid'), true);
}

delete_option( 'osclasscom' );
delete_option( 'osclasscom_key' );
delete_option( 'osclasscom_pageid' );