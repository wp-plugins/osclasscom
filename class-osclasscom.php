<?php

class Osclasscom
{
    protected static $instance = null;

    public function __construct()
    {
        // Add the options page and menu item.
        add_action( 'admin_menu', array( $this, 'add_plugin_admin_menu' ) );
        add_action( 'admin_init', array( $this, 'admin_init' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts' ) );
    }

    public static function get_instance()
    {
        // If the single instance hasn't been set, set it now.
        if ( null == self::$instance ) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    function admin_init()
    {
        /* Register our stylesheet. */
        wp_register_style(
            'osclasscom-style',
	    plugins_url('css/style-wp.css', __FILE__)
        );
        wp_register_style(
            'osclasscom-custom',
            plugins_url('css/custom.css', __FILE__)
        );
        /* Register our javascript. */
        wp_register_script(
            'osclasscom-jquery-validate',
            plugins_url('js/jquery.validate.min.js', __FILE__),
            array('jquery'),
            '1.10.0',
            true
        );
        wp_register_script(
            'osclasscom-create',
            plugins_url('js/create.js', __FILE__),
            array('jquery', 'osclasscom-jquery-validate'),
            '1.10.0',
            true
        );
    }

    function add_plugin_admin_menu()
    {
        $page = add_menu_page(
            'Jobs - Osclass.com',
            'Jobs',
            'administrator',
            'osclasscom',
            'print_create_osclasscom',
            plugins_url('osclasscom/images/icon.png')
        );
    }

    function admin_scripts($hook)
    {
        if($hook=='toplevel_page_osclasscom') {
            wp_enqueue_script('osclasscom-jquery-validate');
            wp_enqueue_script('osclasscom-create');

            wp_enqueue_style('osclasscom-style');
            wp_enqueue_style('osclasscom-custom');
        }
    }
}