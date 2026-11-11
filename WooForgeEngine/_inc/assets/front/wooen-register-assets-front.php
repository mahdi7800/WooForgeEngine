<?php
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

