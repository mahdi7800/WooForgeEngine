<?php

/**
 * مدیریت و کوتاه‌سازی متن خلاصه نوشته‌ها و پیام‌ها
 *
 * این کلاس شامل متدهایی برای محدود کردن طول خلاصه نوشته،
 * خلاصه اسلایدر و پیام‌های اطلاع‌رسانی است.
 *
 * Manage and truncate post excerpts and notification messages.
 *
 * This class provides methods to limit the length of post excerpts,
 * slider excerpts, and notification messages.
 *
 * @package WooForgeEngine
 * @since   1.0.0
 */

class PostExcerpt {

    /**
     * دریافت خلاصه کوتاه‌شده نوشته
     *
     * خلاصه پیش‌فرض نوشته را دریافت کرده و آن را به 200 کاراکتر محدود می‌کند.
     *
     * Retrieve a truncated post excerpt.
     *
     * Gets the default post excerpt and limits its length to 200 characters.
     *
     * @return string خلاصه نوشته با حداکثر 200 کاراکتر.
     *                The post excerpt limited to 200 characters.
     */
     public static function wooen_post_excerpt(): string {
	     $post_text  = get_the_excerpt();
		 return mb_substr($post_text,0,200). ' ' . '....' ;
     }

    /**
     * دریافت خلاصه کوتاه‌شده نوشته برای اسلایدر
     *
     * خلاصه نوشته را دریافت کرده و طول آن را به 100 کاراکتر محدود می‌کند.
     *
     * Retrieve a shortened post excerpt for the slider.
     *
     * Gets the post excerpt and limits its length to 100 characters.
     *
     * @return string خلاصه نوشته با حداکثر 100 کاراکتر.
     *                The post excerpt limited to 100 characters.
     */
	public static function wooen_post_excerpt_slider(): string {
		$post_text  = get_the_excerpt();
		return mb_substr($post_text,0,100). ' ' . '....' ;
	}

    /**
     * کوتاه‌سازی پیام‌های اطلاع‌رسانی
     *
     * متن پیام را دریافت کرده و آن را به 29 کاراکتر محدود می‌کند.
     *
     * Truncate notification messages.
     *
     * Takes a message and limits its length to 29 characters.
     *
     * @param string $message متن پیام موردنظر | The message to truncate.
     *
     * @return string پیام کوتاه‌شده با حداکثر 29 کاراکتر.
     *                The message limited to 29 characters.
     */
    public static function wooen_message_notices_excerpt_more(string $message): string {
         return mb_substr($message,0,29). ' ' . '....' ;
    }
}
