<?php


/**
 * محاسبه زمان تقریبی مطالعه نوشته
 *
 * این کلاس زمان تقریبی موردنیاز برای مطالعه محتوای یک نوشته وردپرس را
 * بر اساس تعداد کاراکترها و سرعت مطالعه محاسبه می‌کند.
 *
 * Calculate the estimated reading time of a post.
 *
 * This class estimates the time required to read WordPress post content
 * based on its character count and the specified reading speed.
 *
 * @package WooForgeEngine
 * @since   1.0.0
 */


class ReadPost {

    /**
     * محاسبه زمان تقریبی مطالعه محتوا بر حسب دقیقه
     *
     * ابتدا تگ‌های HTML و شورت‌کدهای وردپرس را حذف می‌کند.
     * سپس فاصله‌های اضافی را پاک کرده و تعداد کاراکترها را محاسبه می‌کند.
     * در نهایت، با فرض میانگین 3.5 کاراکتر فارسی در هر کلمه،
     * زمان تقریبی مطالعه را بر اساس سرعت مطالعه محاسبه می‌کند.
     *
     * Calculate the estimated reading time in minutes.
     *
     * First, HTML tags and WordPress shortcodes are removed.
     * Then, consecutive whitespace characters are normalized,
     * and the total character count is calculated.
     * Finally, the estimated word count is derived using an average
     * of 3.5 Persian characters per word, and the reading time
     * is calculated based on the specified reading speed.
     *
     * @param string $content محتوای نوشته | The post content.
     * @param int    $wpm     سرعت مطالعه بر حسب کلمه در دقیقه (پیش‌فرض: 250).
     *                        Reading speed in words per minute (default: 250).
     *
     * @return int زمان تقریبی مطالعه بر حسب دقیقه، حداقل 1 دقیقه.
     *             Estimated reading time in minutes, with a minimum of 1.
     */

	public static function wooen_read_post_time(string $content, int $wpm = 250): int {
		$clean_content = strip_tags(strip_shortcodes($content));
		$clean_content = preg_replace('/\s+/u', ' ', $clean_content);


		$char_count = mb_strlen($clean_content, 'UTF-8');


		$persian_chars_per_word = 3.5;
		$words = $char_count / $persian_chars_per_word;

		$reading_time = ceil($words / $wpm);
		return max(1, $reading_time);
	}
}
