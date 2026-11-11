<?php
// CSS
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