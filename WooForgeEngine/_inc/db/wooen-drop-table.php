<?php

    global $wpdb;

    $tables = [
        $wpdb->prefix . 'wooen_plugin_newsletter',
        $wpdb->prefix . 'tns_banner',
        $wpdb->prefix . 'tns_sliders',
        $wpdb->prefix . 'tns_wishlist',
        $wpdb->prefix . 'tns_faq',
        $wpdb->prefix . 'tns_faq_detail',
        $wpdb->prefix . 'wooen_verify_code',
        $wpdb->prefix . 'wooen_validate_token',
        $wpdb->prefix . 'wooen_notifications',
    ];

    foreach ($tables as $table) {
        $wpdb->query("DROP TABLE IF EXISTS `{$table}`");
    }
