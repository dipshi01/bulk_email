<?php
/**
* Plugin Name: Bulk Mailer - Ontrack
* Description: Email broadcasting plugin for ontrack 
* Plugin URI: http://mypluginuri.com/
* Version: 1.0 or whatever version of the plugin (pretty self explanatory)
* Author: Plugin Author's Name
* Author URI: Author's website
* License: A "Slug" license name e.g. GPL12
*/

error_reporting(E_ALL & ~E_NOTICE);

define('PLUGIN_PATH_BM', dirname(__FILE__));

add_action('admin_menu', 'email_setup_menu');

require_once('cron-manager.php');

function email_setup_menu(){
        
        //Top level page
        add_menu_page( 'Mail', 'Bulk Mailer', 'manage_options', 'bulk-campaign', 'bulk_campaign' );
        
        //Submenu
        add_submenu_page( 'bulk-campaign', 'Campaigns', 'Campaigns', 'manage_options', 'bulk-campaign', 'bulk_campaign' );
        
        add_submenu_page( 'bulk-campaign', 'Aliases', 'Email-Aliases', 'manage_options', 'bulk-alias', 'bulk_alias' );
        
        add_submenu_page( 'bulk-campaign', 'Templates', 'Templates', 'manage_options', 'bulk-templates', 'bulk_templates' );
        
        add_submenu_page( 'bulk-campaign', 'Lists', 'Lists', 'manage_options', 'bulk-emails', 'bulk_emails' );
}


function bulk_alias(){
        require_once( plugin_dir_path(__FILE__).'admin/alias.php' );
}

function bulk_templates(){
        require_once( plugin_dir_path(__FILE__).'admin/templates.php' );
}

function bulk_emails(){
        require_once( plugin_dir_path(__FILE__).'admin/emails.php' );
}

function bulk_campaign(){
        require_once( plugin_dir_path(__FILE__).'admin/campaign.php' );
}


function wmpudev_enqueue_icon_stylesheet() {
    wp_register_style( 'fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' );
    wp_enqueue_style( 'fontawesome');
}
add_action( 'wp_enqueue_scripts', 'wmpudev_enqueue_icon_stylesheet' );

//Design and scripts
add_action('wp_enqueue_scripts', 'callback_for_setting_up_scripts_frontend');
function callback_for_setting_up_scripts_frontend() {
    wp_register_style( 'assess', site_url().'/wp-content/plugins/assesment/style.css' );
    wp_enqueue_style( 'assess' );
}
add_action('admin_enqueue_scripts', 'callback_for_setting_up_scripts_for_admin');
function callback_for_setting_up_scripts_for_admin() {
    wp_register_style( 'assess', site_url().'/wp-content/plugins/bulk-mailer/admin.css' );
    wp_enqueue_style( 'assess' );
}


        

