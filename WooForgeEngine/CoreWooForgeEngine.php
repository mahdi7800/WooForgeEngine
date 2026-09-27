<?php
/*
Plugin Name: WooForge Engine
Plugin URI: https://github.com/mahdi7800
Description:
Author: Mahdi Davoodi
Version: 1.0.0
Author URI: https://github.com/mahdi7800
License: GPL-2.0+
*/

defined( 'ABSPATH' ) || exit();

Class CoreWooForgeEngine {
    private $db;
    public  function __construct() {
        global $wpdb;
         $this->db = $wpdb;
         $this->init();
         $this->define_file();
    }

    public function init(): void{
        define('WOOEN_PLUGIN_DIR', plugin_dir_path(__FILE__));
        define('WOOEN_PLUGIN_URL', plugin_dir_url(__FILE__));
    }

    public function define_file(): void{
        $this->loadEntities();
        add_action('wp_enqueue_scripts', [$this, 'register_assets_front']);
        add_action('admin_enqueue_scripts', [$this, 'register_assets_admin']);
        register_activation_hook(__FILE__, [$this, 'activation_file']);
        register_deactivation_hook(__FILE__, [$this, 'deactivation_file']);
    }
    public function loadEntities(): void{
        require_once WOOEN_PLUGIN_DIR . 'AutoLoadWooForgeEngine.php';
        require_once WOOEN_PLUGIN_DIR . '_inc/theme-setup/wooen-theme-setup.php';
        require_once WOOEN_PLUGIN_DIR . 'lib/jdf.php';
        include_once WOOEN_PLUGIN_DIR . '_inc/meta-box/wooen-meta-box.php';
        include_once WOOEN_PLUGIN_DIR . '_inc/function/wooen-contact-us.php';
        include_once WOOEN_PLUGIN_DIR . '_inc/function/wooen-bookmark-posts.php';
        include_once WOOEN_PLUGIN_DIR . '_inc/widget/widget-plugin.php';
        include_once WOOEN_PLUGIN_DIR . '_inc/setting/add-menu-setting.php';


    }





    public function register_assets_front() : void {
        // CSS
        wp_register_style('wooen-toast-css',WOOEN_PLUGIN_URL . 'assets/front/css/jquery.toast.css,',[],'2.0.0');
        wp_enqueue_style('wooen-toast-css');

        // JS
        wp_register_script('wooen-toast-js',WOOEN_PLUGIN_URL . 'assets/front/js/jquery.toast.js',['jquery'],'2.0.0',true);
        wp_enqueue_script('wooen-toast-js');
        // AJAX
        wp_enqueue_script('wooen-ajax-front-js',WOOEN_PLUGIN_URL . 'assets/front/js/ajax.js',['jquery', 'wooen-toast-js'],'1.0.0',true);
        wp_localize_script(
            'wooen-ajax-front-js',
            'ajax',
            [
                '_nonce'  => wp_create_nonce('wooen_nonce'),
                'ajaxurl' => admin_url('admin-ajax.php'),
            ]);


    }
    public function register_assets_admin(): void
    {
        // CSS     assets/vendor/quill/css/quill.snow.css

        wp_register_style('wooen-font-awesome-css',WOOEN_PLUGIN_URL . 'assets/admin/vendor/font-awesome/css/all.min.css',[],'5.15.1');
        wp_register_style('wooen-bootstrap-icons-css',WOOEN_PLUGIN_URL . 'assets/admin/vendor/bootstrap-icons/bootstrap-icons.css',[],'1.11.1');
        wp_register_style('wooen-apexchart-css',WOOEN_PLUGIN_URL . 'assets/admin/vendor/apexcharts/css/apexcharts.css',[],'1');
        wp_register_style('wooen-quill-snow-css',WOOEN_PLUGIN_URL . 'assets/admin/vendor/quill/css/quill.snow.css',[],'1.3.7');
        wp_register_style('wooen-uikit-css',WOOEN_PLUGIN_URL . 'assets/admin/css/uikit.css,',[],'5.3.2');
        wp_register_style('wooen-style-css',WOOEN_PLUGIN_URL . 'assets/admin/css/style.css,',[],'3.25.21');

        wp_enqueue_style('wooen-uikit-css');
        wp_enqueue_style('wooen-font-awesome-css');
        wp_enqueue_style('wooen-bootstrap-icons-css');
        wp_enqueue_style('wooen-apexchart-css');
        wp_enqueue_style('wooen-quill-snow-css');
        wp_enqueue_style('wooen-style-css');
        // JS
        wp_register_script('wooen-bootstrap-bundle-min-js',WOOEN_PLUGIN_URL . 'assets/admin/vendor/bootstrap/dist/js/bootstrap.bundle.min.js',['jquery'],'5.3.2',true);
        wp_register_script('wooen-apexcharts-js',WOOEN_PLUGIN_URL . 'assets/admin/vendor/apexcharts/js/apexcharts.min.js',['jquery'],'3.27.3',true);
        wp_register_script('wooen-OverlayScrollbars-min-js',WOOEN_PLUGIN_URL . 'assets/admin/vendor/overlay-scrollbar/js/OverlayScrollbars.min.js',['jquery'],'1.13.0',true);
        wp_register_script('wooen-functions-js',WOOEN_PLUGIN_URL . 'assets/admin/js/functions.js',['jquery'],'1.3.1',true);
        wp_register_script('wooen-uikit-min-js',WOOEN_PLUGIN_URL . 'assets/admin/js/uikit.min.js',['jquery'],'3.25.21',true);
        wp_register_script('wooen-uikit-icons-min-js',WOOEN_PLUGIN_URL . 'assets/admin/js/uikit-icons.min.js',['jquery'],'3.25.21',true);

        wp_enqueue_script('wooen-uikit-min-js');
        wp_enqueue_script('wooen-uikit-icons-min-js');
        wp_enqueue_script('wooen-bootstrap-bundle-min-js');
        wp_enqueue_script('wooen-apexcharts-js');
        wp_enqueue_script('wooen-OverlayScrollbars-min-jss');
        wp_enqueue_script('wooen-functions-js');
    }
    public function activation_file(): void{

        $table_newsletter = $this->db->prefix .'wooen_plugin_newsletter';
        $tns_newsletter = "CREATE TABLE IF NOT EXISTS `$table_newsletter` (
        `ID` int(11) NOT NULL AUTO_INCREMENT,
        `email` varchar(256) NOT NULL,
        `status` int(1) NOT NULL DEFAULT 1 COMMENT 'active: 1, deactive: 0',
        `create at` datetime NOT NULL DEFAULT current_timestamp(),
        `update_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
        PRIMARY KEY (`id`),
        UNIQUE KEY `email` (`email`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";


        $table_banner = $this->db->prefix . 'tns_banner';
        $tns_banner = "CREATE TABLE IF NOT EXISTS `$table_banner` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `image_url` varchar(256) NOT NULL,
        `title` varchar(256) NOT NULL,
        `link_url` varchar(256) NOT NULL,
        `create_at` datetime NOT NULL DEFAULT current_timestamp(),
        PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";

        $table_sliders = $this->db->prefix . 'tns_sliders';
        $tns_sliders = "CREATE TABLE IF NOT EXISTS `$table_sliders` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `top_title` varchar(256) NOT NULL,
        `main_title` varchar(256) NOT NULL,
        `sub_title` varchar(256) NOT NULL,
        `p_thumbnail` varchar(256) NOT NULL,
        `p_image` varchar(256) NOT NULL,
        `create_at` datetime NOT NULL DEFAULT current_timestamp(),
        `update_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
        PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";


        $table_wishlist = $this->db->prefix .'tns_wishlist';
        $tns_wishlist = "CREATE TABLE IF NOT EXISTS `$table_wishlist` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `p_id` int(11) NOT NULL,
        `u_id` int(11) NOT NULL,
        `p_title` varchar(256) NOT NULL,
        `p_thumbnail` varchar(256) NOT NULL,
        `p_permalink` varchar(256) NOT NULL,
        `create_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
        PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";

        $table_faq = $this->db->prefix .'tns_faq';
        $tns_faq = "CREATE TABLE IF NOT EXISTS `$table_faq` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `header` varchar(256) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp(),
  `update_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
   PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";

        $table_faq_details = $this->db->prefix .'tns_faq_detail';
        $tns_faq_details = "CREATE TABLE IF NOT EXISTS `$table_faq_details` (
    `ID` int(11) NOT NULL AUTO_INCREMENT,
    `faq_question` varchar(256) NOT NULL,
    `faq_answer` text NOT NULL,
    `faq_id` int(11) NOT NULL,
    `create_at` datetime NOT NULL DEFAULT current_timestamp(),
    `update_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
    PRIMARY KEY (`ID`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";

        $table_verify_code = $this->db->prefix . 'wooen_verify_code';
        $tns_verify_code = "CREATE TABLE IF NOT EXISTS `$table_verify_code` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `verification_code` varchar(6) NOT NULL,
        `phone` varchar(15) NOT NULL,
        `status` int(11) NOT NULL DEFAULT 1 COMMENT '0: unverify, 1: verify',
        `create_date` datetime NOT NULL DEFAULT current_timestamp(),
        `update_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
        PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci";

        $table_token = $this->db->prefix . 'wooen_validate_token';
        $tns_validate_token = "CREATE TABLE IF NOT EXISTS `$table_token` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `token` varchar(256) NOT NULL,
        `email` varchar(256) NOT NULL,
        `status` int(11) NOT NULL,
        `create_at` datetime NOT NULL DEFAULT current_timestamp(),
        `update_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
        PRIMARY KEY (`id`),
        INDEX (`token`),
        INDEX (`email`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($tns_newsletter);
        dbDelta($tns_banner);
        dbDelta($tns_sliders);
        dbDelta($tns_wishlist);
        dbDelta($tns_faq);
        dbDelta($tns_faq_details);
        dbDelta( $tns_verify_code);
        dbDelta($tns_validate_token);
    }
    public function deactivation_file(): void{

    }

}

new CoreWooForgeEngine();
new Newsletter();
new Auth();

