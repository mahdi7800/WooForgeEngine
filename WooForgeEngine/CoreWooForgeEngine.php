<?php
/**
 * Plugin Name:       WooForge Engine
 * Plugin URI:        https://github.com/mahdi7800/WooForgeEngine
 * Description:       A powerful and extensible WordPress plugin that brings essential website functionality, user management, AJAX-driven interactions, and WooCommerce integration together in one modular solution.
 * Version:           1.0.0
 * Author:            Mahdi Davoodi
 * Author URI:        https://github.com/mahdi7800
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       wooforge-engine
 * Domain Path:       /languages
 */

defined( 'ABSPATH' ) || exit();

Class CoreWooForgeEngine {
  
    public  function __construct() {

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
        wp_register_style('wooen-uikit-css',WOOEN_PLUGIN_URL . 'assets/admin/css/uikit.css',[],'5.3.2');
        wp_register_style('wooen-style-css',WOOEN_PLUGIN_URL . 'assets/admin/css/style.css',[],'3.25.21');

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
        wp_register_script('wooen-main-js',WOOEN_PLUGIN_URL . 'assets/admin/js/main.js',['jquery'],'1.11.0',true);


        wp_enqueue_script('wooen-uikit-min-js');
        wp_enqueue_script('wooen-uikit-icons-min-js');
        wp_enqueue_script('wooen-bootstrap-bundle-min-js');
        wp_enqueue_script('wooen-apexcharts-js');
        wp_enqueue_script('wooen-OverlayScrollbars-min-jss');
        wp_enqueue_script('wooen-functions-js');
        wp_enqueue_script('wooen-main-js');

        
    }
    public function activation_file(): void {
         require_once WOOEN_PLUGIN_DIR . '_inc/db/wooen-create-table.php';
    }
    public function deactivation_file(): void{

    }

}

new CoreWooForgeEngine();
new Newsletter();
new Auth();
new Banner();
new Slider();
new Faq();
new Wishlist();

