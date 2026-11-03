<?php
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

$table_notifications =  $this->db->prefix . 'wooen_notifications';
$wooen_notifications = "CREATE TABLE IF NOT EXISTS `$table_notifications` (
                                `id` int(11) NOT NULL,
                                `title` varchar(256) NOT NULL,
                                `message` varchar(512) NOT NULL,
                                `slug` varchar(256) NOT NULL,
                                `type` int(11) NOT NULL,
                                `status` bit(1) NOT NULL DEFAULT b'1' COMMENT '1 : active , 2 : diactive',
                                `created_at` datetime NOT NULL DEFAULT current_timestamp(),
                                `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
                                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";

require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
dbDelta($tns_newsletter);
dbDelta($tns_banner);
dbDelta($tns_sliders);
dbDelta($tns_wishlist);
dbDelta($tns_faq);
dbDelta($tns_faq_details);
dbDelta( $tns_verify_code);
dbDelta($tns_validate_token);
dbDelta($wooen_notifications);
$options = [
    '_shw_social_media_website'  => [
        'telegram' => '',
        'instagram' => '',
        'whatsapp' => '',
        'discord' => '',
        'linkedin' => '',
        'youtube' =>'',
        'x'=> ''
    ]
    ,'_shw_settings_set_general'  => [
        'wishlist_enable'=>'no',
        'newsletter_enable'=>'no',
        'sale_plugin_or_themes_enable'=> 'no',
        'register_from_enable'=>'no',
        'register_from_sms_enable'=>'no',
        'adv_enable'=>'no',
        'exclude_category_id'=>'',
        'link_enamad' => '',
        'link_zarinpal' => ''
    ]
    ,'_shw_settings_set_smtp'     => [
        'host'     =>'',
        'port'     =>'',
        'username' =>'',
        'password' =>'',
        'from'     =>'',
        'FormName' =>''
    ]
    ,'_shw_settings_set_contact_us'=>[
        'email_contact'       => '',
        'phone_number_store'  => '',
        'phone_number_mobile' => '',
        'start_work_h'        => '',
        'end_work_h'          => '',
        'start_work'          => '',
        'end_work'            =>'',
        'working_time_raw'    => '',
        'address'             => '',
        'iframe_map_url'      => '',
    ]
    ,'_shw_sms_settings_set'=>[
        'username' =>'',
        'password'    =>'',
        'verify_code' =>'',
        'welcome'     =>''
    ]
    ,'_shw_set_index_website'=> 1
];
foreach ($options as $key => $value) {
    if (get_option($key) === false) {
        update_option($key, $value);
    }
}