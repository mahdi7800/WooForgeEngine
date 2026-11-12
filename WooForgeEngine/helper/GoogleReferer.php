<?php

/**
 * مدیریت و شمارش ورودی‌های گوگل به نوشته‌ها
 *
 * این کلاس برای شناسایی بازدیدکنندگانی استفاده می‌شود که از طریق
 * موتور جستجوی گوگل وارد یک نوشته شده‌اند.
 * تعداد این ورودی‌ها در Post Meta ذخیره می‌شود.
 *
 * Manage and track Google search referrals to WordPress posts.
 *
 * This class identifies visitors who arrive at a post through
 * Google Search and stores the total referral count in post meta.
 *
 * @package WooForgeEngine
 * @since   1.0.0
 */



class GoogleReferer {

    /**
     * ثبت ورودی جدید از موتور جستجوی گوگل
     *
     * آدرس ارجاع‌دهنده (Referer) را بررسی می‌کند.
     * اگر آدرس شامل google.com باشد، تعداد ورودی‌های گوگل را یک واحد افزایش می‌دهد.
     * در صورت نبود متای مربوطه، آن را با مقدار اولیه 1 ایجاد می‌کند.
     *
     * Record a new referral from Google Search.
     *
     * Checks the referrer URL for the presence of "google.com".
     * If Google is detected, the referral count is incremented by one.
     * If the corresponding post meta does not exist, it is created
     * with an initial value of 1.
     *
     * @param int    $postID شناسه نوشته موردنظر | The ID of the target post.
     * @param string $url    آدرس ارجاع‌دهنده | The referrer URL.
     *
     * @return void
     */


    public static function wooen_set_google_referer( int $postID, string $url ): void
    {
        $host = wp_parse_url($url, PHP_URL_HOST);
        if (is_string($host) && (strtolower($host) === 'google.com' || str_ends_with(strtolower($host), '.google.com'))){
            $key = '_wooen_plugin_referer_key_num';
            if (!metadata_exists('post', $postID, $key)) {
                add_post_meta($postID, $key, 1, true);
            } else {
                $count = (int) get_post_meta($postID, $key, true);
                $count++;
                update_post_meta($postID, $key, $count);
            }
        }
    }

    /**
     * دریافت تعداد ورودی‌های گوگل به نوشته
     *
     * تعداد بازدیدکنندگانی را که از طریق گوگل وارد نوشته شده‌اند،
     * از متادیتای نوشته دریافت می‌کند.
     * اگر متای مربوطه وجود نداشته باشد، مقدار صفر برمی‌گرداند.
     *
     * Retrieve the number of Google referrals for a post.
     *
     * Gets the number of visitors who arrived at the post through Google
     * from the post meta. Returns zero if the corresponding meta does not exist.
     *
     * @param int $postID شناسه نوشته موردنظر | The ID of the target post.
     *
     * @return int تعداد ورودی‌های گوگل | The number of Google referrals.
     */

    public static function wooen_get_google_referer( int $postID ): int
    {

        $key = '_wooen_plugin_referer_key_num';

        if ( ! metadata_exists( 'post', $postID, $key ) ) {
            return 0;
        }

        return (int) get_post_meta( $postID, $key, true );
    }
}
