<?php
/**
 * Plugin Name: Quick View Woocommerce Product
 * Description: This plugin allows create to product quick view.
 * Version: 1.0
 * Copyright: 2019 
 */


if (!defined('ABSPATH')) {
    die('-1');
}
if (!defined('OCWQV_PLUGIN_NAME')) {
    define('OCWQV_PLUGIN_NAME', 'Quick View Woocommerce Product');
}
if (!defined('OCWQV_PLUGIN_VERSION')) {
    define('OCWQV_PLUGIN_VERSION', '1.0.0');
}
if (!defined('OCWQV_PLUGIN_FILE')) {
    define('OCWQV_PLUGIN_FILE', __FILE__);
}
if (!defined('OCWQV_PLUGIN_DIR')) {
    define('OCWQV_PLUGIN_DIR',plugins_url('', __FILE__));
}
if (!defined('OCWQV_DOMAIN')) {
    define('OCWQV_DOMAIN', 'ocwcp');
}
if (!defined('OCWQV_BASE_NAME')) {
    define('OCWQV_BASE_NAME', plugin_basename(OCWQV_PLUGIN_FILE));
}


if (!class_exists('OCWQV')) {

    class OCWQV {
        protected static $OCWQV_instance;
        function __construct() {
            include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
            add_action('admin_init', array($this, 'OCWQV_check_plugin_state'));
        }


        function OCWQV_load_admin_script_style() {
            wp_enqueue_style( 'OCWQV_admin_css', OCWQV_PLUGIN_DIR . '/css/admin_style.css', false, '1.0.0' );
            wp_enqueue_style( 'OCWQV_admin_fa_css', OCWQV_PLUGIN_DIR . '/css/font-awesome.min.css', false, '1.0.0' );
            wp_enqueue_style( 'OCWQV_admin_fa_css' );
            wp_enqueue_style( 'wp-color-picker' );
            wp_enqueue_script( 'wp-color-picker-alpha', OCWQV_PLUGIN_DIR . '/js/wp-color-picker-alpha.js', array( 'wp-color-picker' ), '1.0.0', true );
        }


        function OCWQV_load_script_style() {
            global $woocommerce;
            $translation_array_img = OCWQV_PLUGIN_DIR;
            $ocwqv_qw_popup_loader = get_option( 'ocwqv_qw_popup_loader', 'loader-1.gif' );
            $ocwqv_ajax_atc = get_option( 'ocwqv_ajax_atc');

            wp_enqueue_script( 'wc-add-to-cart-variation' );

            if((get_option( 'ocwqv_lightbox_enable', 'yes' )  == 'yes')) {
            	wp_enqueue_script( 'prettyPhoto', $woocommerce->plugin_url() . '/assets/js/prettyPhoto/jquery.prettyPhoto.min.js', array( 'jquery' ), '1.7', true );
            	wp_enqueue_style( 'woocommerce_prettyPhoto_css', $woocommerce->plugin_url() . '/assets/css/prettyPhoto.css' );
            }

            wp_enqueue_style( 'OCWQV_front_css', OCWQV_PLUGIN_DIR . '/css/style.css', false, '1.0.0' );
            wp_enqueue_style( 'OCWQV_front_fa_css', OCWQV_PLUGIN_DIR . '/css/font-awesome.min.css', false, '1.0.0' );
            wp_enqueue_style( 'OCWQV_front_fa_css' );
            wp_enqueue_script( 'OCWQV_front_js', OCWQV_PLUGIN_DIR . '/js/front.js', false, '1.0.0' );
            wp_localize_script( 'OCWQV_front_js', 'ajax_url', admin_url('admin-ajax.php') );
            wp_localize_script( 'OCWQV_front_js', 'object_name', $translation_array_img );
            wp_localize_script( 'OCWQV_front_js', 'ocwqv_qw_popup_loader', $ocwqv_qw_popup_loader );

            if($ocwqv_ajax_atc == 'yes') {
            	wp_enqueue_script( 'OCWQV_ajax_atc_js', OCWQV_PLUGIN_DIR . '/js/ajax-add-to-cart.js', false, '1.0.0' );
            }
        }


        function OCWQV_show_notice() {

            if ( get_transient( get_current_user_id() . 'ocwqverror' ) ) {

                deactivate_plugins( plugin_basename( __FILE__ ) );

                delete_transient( get_current_user_id() . 'ocwqverror' );

                echo '<div class="error"><p> This plugin is deactivated because it require <a href="plugin-install.php?tab=search&s=woocommerce">WooCommerce</a> plugin installed and activated.</p></div>';
            }
        }


        function OCWQV_check_plugin_state(){
            if ( ! ( is_plugin_active( 'woocommerce/woocommerce.php' ) ) ) {
                set_transient( get_current_user_id() . 'ocwqverror', 'message' );
            }
        }


        function OCWQV_footer(){
            wp_enqueue_script( 'wc-add-to-cart-variation' );
            wp_enqueue_script('wc-single-product');
        }


        function init() {
            add_action( 'admin_notices', array($this, 'OCWQV_show_notice'));
            add_action( 'admin_enqueue_scripts', array($this, 'OCWQV_load_admin_script_style'));
            add_action( 'wp_enqueue_scripts',  array($this, 'OCWQV_load_script_style'));
            add_filter( 'plugin_row_meta', array( $this, 'OCWQV_plugin_row_meta' ), 10, 2 );
            add_filter( 'wp_footer', array( $this, 'OCWQV_footer' ), 10, 2 );
        }


        function OCWQV_plugin_row_meta( $links, $file ) {
            if (OCWQV_BASE_NAME === $file ) {
                $row_meta = array(
                    'rating'    =>  '<a href="#" target="_blank"><img src="'.OCWQV_PLUGIN_DIR.'/images/star.png" class="OCWQV_rating_div"></a>',
                );

                return array_merge( $links, $row_meta );
            }

            return (array) $links;
        }


        function includes() {
            include_once('includes/oc-ocwqv-backend.php');
            include_once('includes/oc-ocwqv-front.php');
        }


        public static function OCWQV_instance() {
            if (!isset(self::$OCWQV_instance)) {
                self::$OCWQV_instance = new self();
                self::$OCWQV_instance->init();
                self::$OCWQV_instance->includes();
            }
            return self::$OCWQV_instance;
        }
    }
    add_action('plugins_loaded', array('OCWQV', 'OCWQV_instance'));
}