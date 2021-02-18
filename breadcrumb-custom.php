<?php
/*
Plugin Name: Breadcrumb - Custom
Plugin URI: https://www.pickplugins.com/item/breadcrumb/
Description: Custom breadcrumb elements
Version: 1.0.0
Author: PickPlugins
Author URI: https://www.pickplugins.com/
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 

if( !class_exists( 'breadcrumbCustom' )){
    class breadcrumbCustom{

        public function __construct(){

            define('breadcrumb_custom_plugin_url', plugins_url('/', __FILE__));
            define('breadcrumb_custom_plugin_dir', plugin_dir_path(__FILE__));
            define('breadcrumb_custom_plugin_basename', plugin_basename(__FILE__));
            define('breadcrumb_custom_plugin_name', 'Breadcrumb - Custom');
            define('breadcrumb_custom_version', '1.0.0');

            include('templates/breadcrumb-hook.php');


            add_action('wp_enqueue_scripts', array($this, '_scripts_front'));
            add_action('admin_enqueue_scripts', array($this, '_scripts_admin'));

            add_action('plugins_loaded', array($this, '_textdomain'));

            register_activation_hook(__FILE__, array($this, '_activation'));
            register_deactivation_hook(__FILE__, array($this, '_deactivation'));


        }


        public function _textdomain(){

            $locale = apply_filters('plugin_locale', get_locale(), 'breadcrumb-custom');
            load_textdomain('breadcrumb-custom', WP_LANG_DIR . '/breadcrumb-custom/breadcrumb-custom-' . $locale . '.mo');

            load_plugin_textdomain('breadcrumb-custom', false, plugin_basename(dirname(__FILE__)) . '/languages/');

        }

        public function _activation(){

            /*
             * Custom action hook for plugin activation.
             * Action hook: breadcrumb_custom_activation
             * */
            do_action('breadcrumb_custom_activation');

        }

        public function breadcrumb_custom_uninstall(){

            /*
             * Custom action hook for plugin uninstall/delete.
             * Action hook: breadcrumb_custom_uninstall
             * */
            do_action('breadcrumb_custom_uninstall');
        }

        public function _deactivation(){

            /*
             * Custom action hook for plugin deactivation.
             * Action hook: breadcrumb_custom_deactivation
             * */
            do_action('breadcrumb_custom_deactivation');
        }


        public function _scripts_front(){

            wp_register_style('breadcrumb-custom', breadcrumb_custom_plugin_url.'assets/frontend/css/style.css');


//            wp_register_script('breadcrumb_custom_scripts', breadcrumb_custom_plugin_url. 'assets/frontend/js/scripts.js', array( 'jquery' ));
//            wp_enqueue_script('mixitup');


            /*
             * Custom action hook for scripts front.
             * Action hook: breadcrumb_custom_scripts_front
             * */
            do_action('breadcrumb_custom_scripts_front');
        }


        public function _scripts_admin(){

            //wp_register_style('post-grid-style', breadcrumb_custom_plugin_url.'assets/admin/css/style.css');
            //wp_enqueue_style('post-grid-style');

            /*
             * Custom action hook for scripts admin.
             * Action hook: breadcrumb_custom_scripts_admin
             * */
            do_action('breadcrumb_custom_scripts_admin');
        }


    }
}
new breadcrumbCustom();