<?php

namespace wccbef\classes\bootstrap;

use wccbef\classes\controllers\WCCBEF_Ajax;
use wccbef\classes\controllers\WCCBEF_Post;
use wccbef\classes\controllers\Woo_Coupon_Controller;
use wccbef\classes\repositories\Option;

class WCCBEF
{
    private static $instance;

    public static function init()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
    }

    private function __construct()
    {
        if (!current_user_can('manage_woocommerce')) {
            return;
        }

        WCCBEF_Ajax::register_callback();
        WCCBEF_Post::register_callback();
        (new WCCBEF_Meta_Fields())->init();
        (new WCCBEF_Custom_Queries())->init();

        // update all options
        (new Option())->update_options('wccbef');

        add_action('admin_menu', [$this, 'add_menu']);
        add_action('admin_enqueue_scripts', [$this, 'load_assets']);
    }

    public static function wccbef_woocommerce_required()
    {
        include WCCBEF_VIEWS_DIR . 'alerts/wccbef_woocommerce_required.php';
    }

    public static function wccbef_wp_init()
    {
        $version = get_option('wccbef_version');
        if (empty($version) || $version != WCCBEF_VERSION) {
            update_option('wccbef_version', WCCBEF_VERSION);
        }

        // load textdomain
        load_plugin_textdomain('ithemeland-woocommerce-bulk-coupon-editing-lite', false, WCCBEF_LANGUAGES_DIR);
    }

    public function add_menu()
    {
        add_menu_page(esc_html__('Woo Coupons', WCCBEF_NAME), esc_html__('Woo Coupons', WCCBEF_NAME), 'manage_woocommerce', 'wccbef', [new Woo_Coupon_Controller(), 'index'], WCCBEF_IMAGES_URL . 'wccbef_icon.svg', 2);
    }

    public function load_assets($page)
    {
        if ($page == "toplevel_page_wccbef") {
            // Styles
            wp_enqueue_style('wccbef-reset', WCCBEF_CSS_URL . 'reset.css');
            wp_enqueue_style('wccbef-LineIcons', WCCBEF_CSS_URL . 'LineIcons.min.css');
            wp_enqueue_style('wccbef-select2', WCCBEF_CSS_URL . 'select2.min.css');
            wp_enqueue_style('wccbef-sweetalert', WCCBEF_CSS_URL . 'sweetalert.css');
            wp_enqueue_style('wccbef-jquery-ui', WCCBEF_CSS_URL . 'jquery-ui.min.css');
            wp_enqueue_style('wccbef-tipsy', WCCBEF_CSS_URL . 'jquery.tipsy.css');
            wp_enqueue_style('wccbef-datetimepicker', WCCBEF_CSS_URL . 'jquery.datetimepicker.css');
            wp_enqueue_style('wccbef-scrollbar', WCCBEF_CSS_URL . 'jquery.scrollbar.css');
            wp_enqueue_style('wccbef-main', WCCBEF_CSS_URL . 'style.css', [], '2.1.2');

            // Scripts
            wp_enqueue_script('wccbef-datetimepicker', WCCBEF_JS_URL . 'jquery.datetimepicker.js', ['jquery']);
            wp_enqueue_script('wccbef-functions', WCCBEF_JS_URL . 'functions.js', ['jquery'], '6.7');
            wp_enqueue_script('wccbef-select2', WCCBEF_JS_URL . 'select2.min.js', ['jquery']);
            wp_enqueue_script('wccbef-moment', WCCBEF_JS_URL . 'moment-with-locales.min.js', ['jquery']);
            wp_enqueue_script('wccbef-tipsy', WCCBEF_JS_URL . 'jquery.tipsy.js', ['jquery']);
            wp_enqueue_script('wccbef-scrollbar', WCCBEF_JS_URL . 'jquery.scrollbar.min.js', ['jquery']);
            wp_enqueue_script('wccbef-sweetalert', WCCBEF_JS_URL . 'sweetalert.min.js', ['jquery']);
            wp_enqueue_script('wccbef-main', WCCBEF_JS_URL . 'main.js', ['jquery'], '6.7');
            wp_localize_script('wccbef-main', 'WCCBEF_DATA', [
                'ajax_url' => admin_url('admin-ajax.php'),
                'wp_nonce' => wp_create_nonce(),
            ]);
            wp_enqueue_media();
            wp_enqueue_editor();
            wp_enqueue_script('jquery-ui-sortable');
            wp_enqueue_script('jquery-ui-datepicker');
        }
    }

    private static function create_tables()
    {
        global $wpdb;
        $history_table_name = esc_sql($wpdb->prefix . 'wccbef_history');
        $history_items_table_name = esc_sql($wpdb->prefix . 'wccbef_history_items');
        $query = '';
        $history_table = $wpdb->prepare('SHOW TABLES LIKE %s', $wpdb->esc_like($history_table_name));
        if (!$wpdb->get_var($history_table) == $history_table_name) {
            $query .= "CREATE TABLE {$history_table_name} (
                  id int(11) NOT NULL AUTO_INCREMENT,
                  user_id int(11) NOT NULL,
                  fields text NOT NULL,
                  operation_type varchar(32) NOT NULL,
                  operation_date timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                  reverted tinyint(1) NOT NULL DEFAULT '0',
                  PRIMARY KEY (id),
                  INDEX (user_id)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
        }

        $history_items_table = $wpdb->prepare('SHOW TABLES LIKE %s', $wpdb->esc_like($history_items_table_name));
        if (!$wpdb->get_var($history_items_table) == $history_items_table_name) {
            $query .= "CREATE TABLE {$history_items_table_name} (
                      id int(11) NOT NULL AUTO_INCREMENT,
                      history_id int(11) NOT NULL,
                      historiable_id int(11) NOT NULL,
                      field varchar(255) NOT NULL,
                      prev_value longtext,
                      new_value longtext,
                      PRIMARY KEY (id),
                      INDEX (history_id),
                      INDEX (historiable_id)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

            $query .= "ALTER TABLE {$history_items_table_name} ADD CONSTRAINT wccbef_history_items_history_id_relation FOREIGN KEY (history_id) REFERENCES {$history_table_name} (id) ON DELETE CASCADE ON UPDATE CASCADE;";
        }

        if (!empty($query)) {
            require_once(ABSPATH . '/wp-admin/includes/upgrade.php');
            dbDelta($query);
        }
    }

    public static function activate()
    {
        // set plugin version
        update_option('wccbef_version', WCCBEF_VERSION);

        // create tables
        self::create_tables();
    }

    public static function deactivate()
    {
        $option_repository = new Option();
        $option_repository->delete_options_with_like_name('wccbef');
    }
}
