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
        include_once WOOEN_PLUGIN_DIR . 'lib/jdf.php';
        include_once WOOEN_PLUGIN_DIR . '_inc/meta-box/wooen-meta-box.php';
        include_once WOOEN_PLUGIN_DIR . '_inc/function/wooen-contact-us.php';
        include_once WOOEN_PLUGIN_DIR . '_inc/function/wooen-bookmark-posts.php';
        include_once WOOEN_PLUGIN_DIR . '_inc/widget/widget-plugin.php';
        include_once WOOEN_PLUGIN_DIR . '_inc/setting/add-menu-setting.php';
    }

    public function register_assets_front() : void {
        require_once WOOEN_PLUGIN_DIR . '_inc/assets/front/wooen-register-assets-front.php';
    }
    public function register_assets_admin(): void
    {
        require_once  WOOEN_PLUGIN_DIR . '_inc/assets/admin/wooen-register-admin-assets.php';
    }
    public function activation_file(): void{
        require_once WOOEN_PLUGIN_DIR . '_inc/db/wooen-create-table.php';
    }
    public function deactivation_file(): void{

    }

}

new CoreWooForgeEngine();
new Newsletter();
new Auth();
new Notification ();
new Banner();
new Slider();
new Faq();
new Wishlist();
new TeamOur();
