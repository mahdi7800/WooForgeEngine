<?php

/**
 * Handles the WooCommerce wishlist functionality.
 *
 * این کلاس مسئول مدیریت قابلیت لیست علاقه‌مندی محصولات ووکامرس است.
 *
 * @package WooForgeEngine
 */

class Wishlist
{
    use SecurityTrait;

    /**
     * WordPress database object.
     *
     * شیء دیتابیس وردپرس.
     *
     * @var wpdb
     */
    private wpdb $db;

    /**
     * Wishlist database table name.
     *
     * نام جدول دیتابیس مربوط به لیست علاقه‌مندی‌ها.
     *
     * @var string
     */
    private string $table_wishlist;

    /**
     * Initializes the Wishlist class.
     *
     * Sets the WordPress database object, defines the wishlist
     * database table name, and registers the required hooks.
     *
     * کلاس Wishlist را مقداردهی اولیه می‌کند.
     *
     * شیء دیتابیس وردپرس را تنظیم کرده، نام جدول لیست علاقه‌مندی‌ها
     * را مشخص می‌کند و Hookهای مورد نیاز را ثبت می‌کند.
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function __construct()
    {
        global $wpdb;
        $this->db = $wpdb;
        $this->table_wishlist = $wpdb->prefix . 'tns_wishlist';
        $this->wooen_registerHooks();
    }


    /**
     * Adds or removes a product from the user's wishlist.
     *
     * If the product already exists in the user's wishlist,
     * it will be removed. Otherwise, the product will be added.
     *
     * یک محصول را به لیست علاقه‌مندی کاربر اضافه یا از آن حذف می‌کند.
     *
     * اگر محصول از قبل در لیست علاقه‌مندی کاربر وجود داشته باشد،
     * از لیست حذف می‌شود؛ در غیر این صورت، محصول به لیست اضافه می‌شود.
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function wooen_Wishlist (): void
    {
        if(is_user_logged_in()) {
            $this->wooen_verifyNonce();
            $product_id = intval($_POST['product_id']);
            $user_id = get_current_user_id();
            $p_title = get_the_title($product_id);
            $p_thumbnail = get_the_post_thumbnail_url($product_id);
            $p_permalink = get_the_permalink($product_id);

            if ($this->wooen_is_product_in_wishlist($product_id,$user_id)) {
                $this->wooen_remove_from_wishlist($product_id, $user_id);
            } else {
                $this->wooen_add_to_wishlist($product_id ,$user_id, $p_title, $p_thumbnail, $p_permalink);
            }

        }else{
            wp_send_json(['error' => true ,'message'=>'Please log in to use the wishlist.'],401);
        }

    }


    /**
     * Checks whether a product exists in the user's wishlist.
     *
     * بررسی می‌کند که آیا یک محصول در لیست علاقه‌مندی کاربر وجود دارد یا خیر.
     *
     * @param int $product_id Product ID.
     *                    شناسه محصول.
     *
     * @param int $user_id WordPress user ID.
     *                    شناسه کاربر وردپرس.
     *
     * @return bool True if the product exists in the wishlist,
     *              otherwise false.
     *
     *              در صورت وجود محصول در لیست علاقه‌مندی مقدار true
     *              و در غیر این صورت مقدار false برمی‌گرداند.
     */
    private function wooen_is_product_in_wishlist(int $product_id, int $user_id): bool{
        $exists = $this->db->get_var($this->db->prepare("SELECT COUNT(*) FROM {$this->table_wishlist} WHERE p_id = %d AND u_id = %d", $product_id, $user_id));
        return (int) $exists > 0;
    }


    /**
     * Removes a product from the user's wishlist.
     *
     * یک محصول را از لیست علاقه‌مندی کاربر حذف می‌کند.
     *
     * @param int $product_id Product ID.
     *                    شناسه محصول.
     *
     * @param int $user_id WordPress user ID.
     *                    شناسه کاربر وردپرس.
     *
     * @return void
     */
    private function wooen_remove_from_wishlist (int $product_id, int $user_id): void {
        $where = [
            'p_id' => $product_id,
            'u_id' => $user_id
        ];
        $where_format = ['%d','%d'];
        $deleted = $this->db->delete($this->table_wishlist,$where, $where_format);
        if($deleted){
            wp_send_json(['success'=>true,'message'=>'Product deleted successfully'],200);
        }else{
            wp_send_json(['error'=>true,'message'=>'Product delete failed'],500);
        }
    }


    /**
     * Adds a product to the user's wishlist.
     *
     * یک محصول را به لیست علاقه‌مندی کاربر اضافه می‌کند.
     *
     * @param int $product_id Product ID.
     *                    شناسه محصول.
     *
     * @param int $user_id WordPress user ID.
     *                    شناسه کاربر وردپرس.
     *
     * @param string $p_title Product title.
     *                    عنوان محصول.
     *
     * @param bool|string $p_thumbnail Product thumbnail URL.
     *                    آدرس تصویر شاخص محصول.
     *
     * @param bool|string $p_permalink Product permalink.
     *                    لینک دائمی محصول.
     *
     * @return void
     */
    private function wooen_add_to_wishlist (int $product_id, int $user_id , string $p_title , string $p_thumbnail ,string $p_permalink) : void {
            $data = [
                'p_id' => $product_id,
                'u_id' => $user_id,
                'p_title' => $p_title,
                'p_thumbnail' => $p_thumbnail,
                'p_permalink' => $p_permalink
            ];
            $format = ['%d','%d','%s','%s','%s'];
            $inserted = $this->db->insert($this->table_wishlist,$data,$format);
            if($inserted){
                wp_send_json(['success'=>true,'message'=>'Product added successfully'],200);
            }else{
                wp_send_json(['error'=>true,'message'=>'Product added failed'],500);
            }
    }


    /**
     * Registers the AJAX hooks required for the Wishlist functionality.
     *
     * Hookهای AJAX مورد نیاز برای قابلیت لیست علاقه‌مندی‌ها را ثبت می‌کند.
     *
     * @since 1.0.0
     *
     * @return void
     */
    private function wooen_registerHooks() : void {
        add_action('wp_ajax_wooen_Wishlist', array($this, 'wooen_Wishlist'));
    }


    /**
     * Retrieves the wishlist products of the currently logged-in user.
     *
     * محصولات موجود در لیست علاقه‌مندی کاربر واردشده فعلی را دریافت می‌کند.
     *
     * Redirects the user to the home page if they are not logged in.
     *
     * در صورتی که کاربر وارد نشده باشد، او را به صفحه اصلی سایت
     * هدایت می‌کند.
     *
     * @return array List of wishlist products as associative arrays.
     *
     *               لیستی از محصولات موجود در لیست علاقه‌مندی را
     *               به‌صورت آرایه‌های انجمنی برمی‌گرداند.
     */
    public function  wooen_get_user_wishlist() : array
    {
        if (is_user_logged_in()) {
            $user_id = get_current_user_id();
            $stmt = $this->db->get_results($this->db->prepare("SELECT * FROM {$this->table_wishlist} WHERE u_id = %d", $user_id), ARRAY_A);
            return (array) $stmt;
        }else{
            wp_redirect(home_url());
            exit;
        }
    }

    /**
     * Retrieves the number of wishlist products belonging to the current user.
     *
     * تعداد محصولات موجود در لیست علاقه‌مندی کاربر فعلی را دریافت می‌کند.
     *
     * @return int Number of wishlist products.
     *
     *              تعداد محصولات موجود در لیست علاقه‌مندی را برمی‌گرداند.
     */
    public function wooen_get_user_count_wishlist() : int
    {
        if (is_user_logged_in()) {
            $user_id = get_current_user_id();
            $stmt = $this->db->get_var($this->db->prepare("SELECT COUNT(*) FROM {$this->table_wishlist} WHERE u_id = %d", $user_id));
            return (int) $stmt;
        }else{
            return 0 ;
        }
    }
}
//Wishlist
//│
//├── __construct()
//│
//├── wooen_toggle_wishlist()
//│
//├── wooen_is_product_in_wishlist()
//│
//├── wooen_add_to_wishlist()
//│
//├── wooen_remove_from_wishlist()
//│
//├── wooen_get_user_wishlist()
//│
//├── wooen_get_user_count_wishlist()
//│
//└── wooen_register_hooks()
