<?php

/**
 * مدیریت و شمارش بازدید نوشته‌ها
 *
 * این کلاس برای ثبت و دریافت تعداد بازدید هر نوشته در وردپرس استفاده می‌شود.
 * تعداد بازدیدها در Post Meta با کلید `_wooen_post_view` ذخیره می‌شود.
 *
 * Manage and track WordPress post views.
 *
 * This class provides methods to increment and retrieve the view count
 * of a WordPress post. View counts are stored in post meta using
 * the `_wooen_post_view` meta key.
 *
 * @package WooForgeEngine
 * @since   1.0.0
 */


class PostView {

    /**
     * ثبت یک بازدید جدید برای نوشته
     *
     * اگر متای تعداد بازدید برای نوشته وجود نداشته باشد، آن را با مقدار 1 ایجاد می‌کند.
     * در غیر این صورت، مقدار فعلی را یک واحد افزایش می‌دهد.
     *
     * Increment the view count of a post.
     *
     * If the view meta does not exist, it creates the meta with an initial
     * value of 1. Otherwise, it increments the existing view count by one.
     *
     * @param int $PostID شناسه نوشته موردنظر | The ID of the target post.
     *
     * @return void
     */

	public static function wooen_set_post_view(int $PostID):void {
		$view_meta_key = '_wooen_post_view';
		$post_view = get_post_meta($PostID,$view_meta_key,true);
		if (!metadata_exists('post',$PostID,$view_meta_key)){
			add_post_meta($PostID,$view_meta_key,'1');
		}else{
			$post_view++;
			update_post_meta($PostID,$view_meta_key,$post_view);
		}
    }

    /**
     * دریافت تعداد بازدیدهای نوشته
     *
     * تعداد بازدید ذخیره‌شده برای نوشته را برمی‌گرداند.
     * اگر متای بازدید وجود نداشته باشد، مقدار صفر برگردانده می‌شود.
     *
     * Retrieve the view count of a post.
     *
     * Returns the stored view count. If the view meta does not exist,
     * the method returns "0".
     *
     * @param int $PostID شناسه نوشته موردنظر | The ID of the target post.
     *
     * @return string تعداد بازدید نوشته یا صفر | The post view count or "0".
     */

	public static function wooen_get_post_view(int $PostID):string {
		$view_num_meta_key = '_wooen_post_view';
		$get_post_view_num = get_post_meta($PostID,$view_num_meta_key,true);
		if (!metadata_exists('post',$PostID,$view_num_meta_key)){
			return "0" ;
		}else{
			 return $get_post_view_num;
		}
	}
}
