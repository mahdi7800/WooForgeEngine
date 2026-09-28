<?php

/**
 * Handles banner management for WooForge Engine.
 *
 * مدیریت بنرها در افزونه WooForge Engine.
 *
 * This class is responsible for:
 * - Creating new banners.
 * - Updating existing banners.
 * - Deleting banners.
 * - Retrieving all banners from the database.
 * - Retrieving banners for the admin panel.
 * - Retrieving banners for the front-end.
 * - Managing admin operation messages.
 *
 * این کلاس مسئول موارد زیر است:
 * - ایجاد بنرهای جدید.
 * - ویرایش بنرهای موجود.
 * - حذف بنرها.
 * - دریافت تمام بنرها از دیتابیس.
 * - دریافت بنرها برای پنل مدیریت.
 * - دریافت بنرها برای نمایش در بخش Front-End.
 * - مدیریت پیام‌های عملیات در پنل مدیریت.
 *
 * @package WooForgeEngine
 */

class Banner extends  CRUD
{

    /**
     * WordPress database object.
     *
     * شیء دیتابیس وردپرس.
     *
     * @var wpdb
     */
    private wpdb $db;

    /**
     * Database table name.
     *
     * نام جدول دیتابیس مربوط به بنرها.
     *
     * @var string
     */
    private string $table;

    /**
     * Admin operation message.
     *
     * پیام مربوط به نتیجه عملیات در پنل مدیریت.
     *
     * @var string
     */
    private string $message = '';


    /**
     * Initialize the Banner class.
     *
     * کلاس Banner را مقداردهی اولیه می‌کند.
     *
     * Initializes the WordPress database object and
     * sets the banner database table name.
     *
     * شیء دیتابیس وردپرس را دریافت کرده و نام جدول
     * مربوط به بنرها را مشخص می‌کند.
     *
     * @return void
     */
    public function __construct(){
        global $wpdb;
        $this->db = $wpdb;
        $this->table = $wpdb->prefix."tns_banner";
    }


    /**
     * Insert a new banner into the database.
     *
     * یک بنر جدید را در دیتابیس ایجاد می‌کند.
     *
     * Validates the request nonce, sanitizes the submitted
     * banner data, and inserts the banner into the database.
     *
     * امنیت درخواست را بررسی کرده، اطلاعات ارسال‌شده بنر را
     * پاک‌سازی کرده و بنر را در دیتابیس ذخیره می‌کند.
     *
     * @return void
     */
    protected function wooen_insert(): void
    {
        // TODO: Implement wooen_insert() method.
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
            if (!isset($_POST['_nonce_tns_setting_banner']) || !wp_verify_nonce($_POST['_nonce_tns_setting_banner'], '_nonce_tns_setting_banner')) {
                $this->message = '<div class="notice notice-error is-dismissible"><p>Security validation failed!</p></div>';
            } else {
                $link_url =$_POST['tns_link'];
                $link = filter_var($link_url , FILTER_SANITIZE_URL);
                $link_url  = esc_url_raw($link_url );
                $data = [
                    'image_url'=>esc_url_raw($_POST['tns_image']) ,
                    'title'=> sanitize_text_field($_POST['tns_title']),
                    'link_url'=>$link_url ,
                ];
                $format = ['%s' , '%s' , '%s'];
                $stmt = $this->db->insert($this->table,$data,$format);
                if ($stmt) {
                    $this->message = '<div class="notice notice-success is-dismissible"><p>Banner saved successfully!</p></div>';
                }else{
                    $this->message = '<div class="notice notice-error is-dismissible"><p>Failed to save the banner!</p></div>';
                }
            }
        }
    }

    /**
     * Update an existing banner.
     *
     * یک بنر موجود را ویرایش می‌کند.
     *
     * Validates the request nonce, sanitizes the submitted
     * banner data, and updates the selected banner.
     *
     * امنیت درخواست را بررسی کرده، اطلاعات ارسال‌شده بنر را
     * پاک‌سازی کرده و بنر انتخاب‌شده را به‌روزرسانی می‌کند.
     *
     * @return void
     */
    protected function wooen_update(): void
    {
        // TODO: Implement wooen_update() method.
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_submit'])) {
            if (!isset($_POST['_nonce_tns_edit_banner']) || !wp_verify_nonce($_POST['_nonce_tns_edit_banner'], '_nonce_tns_edit_banner')) {
                $this->message = '<div class="notice notice-error is-dismissible"><p>Security validation failed!</p></div>';
            } else {
                $id = intval($_POST['edit_id']);
                $data = [
                    'image_url' => esc_url_raw($_POST['edit_image']),
                    'title' => sanitize_text_field($_POST['edit_title']),
                    'link_url' => esc_url_raw($_POST['edit_link']),
                ];
                $where = ['id' => $id];
                $format = ['%s' , '%s' , '%s'];
                $where_format = ['%d'];
                $stmt = $this->db->update($this->table, $data, $where , $format, $where_format);
                if ($stmt) {
                    $this->message = '<div class="notice notice-success is-dismissible"><p>Banner updated successfully!</p></div>';
                }else{
                    $this->message = '<div class="notice notice-success is-dismissible"><p>Failed to update the banner!</p></div>';
                }
            }
        }
    }

    /**
     * Delete a banner from the database.
     *
     * یک بنر را از دیتابیس حذف می‌کند.
     *
     * Retrieves the banner ID from the GET request and
     * removes the corresponding banner from the database.
     *
     * شناسه بنر را از درخواست GET دریافت کرده و بنر مربوطه
     * را از دیتابیس حذف می‌کند.
     *
     * @return void
     */
    protected function wooen_delete(): void
    {
        // TODO: Implement wooen_delete() method.
        if ($_SERVER['REQUEST_METHOD'] == 'GET'){
            if (isset($_GET['action']) && $_GET['action']=='delete' && isset($_GET['id'])){
                $banner_id = intval($_GET['id']);
                $where = [ 'id'=>$banner_id ];
                $where_format = ['%d'];
                $stmt = $this->db->delete($this->table,$where,$where_format);
                if ($stmt) {
                    $this->message = '<div class="notice notice-success is-dismissible"><p>Banner updated successfully!</p></div>';
                }else {
                    $this->message = '<div class="notice notice-success is-dismissible"><p>Failed to update the banner!</p></div>';
                }
            }

        }

    }


    /**
     * Retrieve all banners from the database.
     *
     * تمام بنرها را از دیتابیس دریافت می‌کند.
     *
     * @return array List of all banners.
     *
     * آرایه‌ای شامل تمام بنرها.
     */
    protected function wooen_select(): array
    {
        // TODO: Implement wooen_select() method.
        $home_banners = $this->db->get_results("SELECT * FROM {$this->table}", ARRAY_A);
        return $home_banners;
    }

    /**
     * Retrieve the current admin operation message.
     *
     * پیام مربوط به آخرین عملیات پنل مدیریت را برمی‌گرداند.
     *
     * @return string Admin operation message.
     *
     * پیام عملیات پنل مدیریت.
     */
    public function get_message(): string
    {
        return $this->message;
    }

    /**
     * Retrieve all banners for the admin panel.
     *
     * تمام بنرها را برای پنل مدیریت دریافت می‌کند.
     *
     * Provides a public interface for retrieving banner data
     * without exposing the internal CRUD select method.
     *
     * این متد یک رابط عمومی برای دریافت اطلاعات بنرها
     * فراهم می‌کند، بدون اینکه متد داخلی CRUD در خارج
     * از کلاس در دسترس باشد.
     *
     * @return array List of all banners for the admin panel.
     *
     * لیستی از تمام بنرها برای پنل مدیریت.
     */
    public function wooen_get_banner_to_admin(): array
    {
        return  $this->wooen_select();
    }

    /**
     * Retrieve banners for the front-end.
     *
     * بنرها را برای نمایش در Front-End دریافت می‌کند.
     *
     * Retrieves the latest three banners ordered by ID
     * in descending order.
     *
     * سه بنر آخر را بر اساس شناسه به صورت نزولی دریافت می‌کند.
     *
     * @return array List of the latest three banners.
     *
     * آرایه‌ای شامل سه بنر آخر.
     */
    public function wooen_get_banner_to_front(): array
    {
        $stmt = $this->db->get_results($this->db->prepare("SELECT * FROM {$this->table}ORDER BY id DESC LIMIT 3"),ARRAY_A);
        return (array) $stmt;
    }

}
//// Banner
////
//// ├── Internal CRUD
//// │   ├── wooen_insert()               ← Protected / Internal
//// │   ├── wooen_update()               ← Protected / Internal
//// │   ├── wooen_delete()               ← Protected / Internal
//// │   └── wooen_select()               ← Protected / Internal
//// │
//// ├── Admin
//// │   ├── wooen_handle_admin_actions() ← Inherited from CRUD
//// │   ├── wooen_get_banner_to_admin()  ← Admin Data
//// │   └── get_message()                ← Admin Message
//// │
//// └── Front
////     └── wooen_get_banner_to_front()  ← Front Data
