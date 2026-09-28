<?php
/**
 * Handles slider management for WooForge Engine.
 *
 * مدیریت اسلایدرها در افزونه WooForge Engine.
 *
 * This class is responsible for:
 * - Creating new sliders.
 * - Updating existing sliders.
 * - Deleting sliders.
 * - Retrieving all sliders from the database.
 * - Retrieving sliders for the front-end.
 * - Managing admin operation messages.
 *
 * این کلاس مسئول موارد زیر است:
 * - ایجاد اسلایدر جدید.
 * - ویرایش اسلایدرهای موجود.
 * - حذف اسلایدرها.
 * - دریافت تمام اسلایدرها از دیتابیس.
 * - دریافت اسلایدرها برای نمایش در بخش Front-End.
 * - مدیریت پیام‌های عملیات در پنل مدیریت.
 *
 * @package WooForgeEngine
 */
class Slider extends CRUD
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
     * Slider database table name.
     *
     * نام جدول دیتابیس مربوط به اسلایدرها.
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
    private string $message='';


    /**
     * Initialize the Slider class.
     *
     * Initializes the WordPress database object and
     * sets the slider database table name.
     *
     * کلاس Slider را مقداردهی اولیه می‌کند و شیء دیتابیس
     * وردپرس و نام جدول اسلایدرها را تنظیم می‌کند.
     *
     * @return void
     */
    public function __construct(){
        global $wpdb;
        $this->db = $wpdb;
        $this->table = $wpdb->prefix."tns_sliders";
    }

    /**
     * Insert a new slider.
     *
     * Validates the submitted request and nonce, sanitizes
     * slider data and inserts a new slider into the database.
     *
     * یک اسلایدر جدید ایجاد می‌کند.
     * درخواست و nonce را بررسی کرده، اطلاعات اسلایدر را پاک‌سازی
     * و سپس در دیتابیس ذخیره می‌کند.
     *
     * @return void
     */
    protected function wooen_insert(): void
    {
        // TODO: Implement wooen_insert() method.
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
            if (!isset($_POST['_nonce_wooen_edit_slider']) || !wp_verify_nonce($_POST['_nonce_wooen_edit_slider'], '_nonce_wooen_edit_slider')) {
                $this->message = '<div class="notice notice-error is-dismissible"><p>Security validation failed!</p></div>';
            } else {

                $link = filter_var($_POST['tns_link'], FILTER_SANITIZE_URL);
                $link = esc_url_raw($link);
                $data = [
                    'top_title'   => sanitize_text_field($_POST['tns_top_title']),
                    'main_title'  => sanitize_text_field($_POST['tns_main_title']),
                    'sub_title'   => sanitize_text_field($_POST['tns_sub_title']),
                    'p_thumbnail' => $link,
                    'p_image'     => sanitize_text_field($_POST['tns_images']),
                ];
                $format = ['%s','%s','%s','%s','%s'];
                $stmt = $this->db->insert($this->table, $data, $format);
                if ($stmt) {
                    $this->message = '<div class="notice notice-success is-dismissible"><p>Settings saved successfully!</p></div>';
                }else{
                    $this->message = '<div class="notice notice-error is-dismissible"><p>Failed to save the slider!</p></div>';
                }
            }
        }
    }

    /**
     * Update an existing slider.
     *
     * Validates the submitted request and nonce, sanitizes
     * the slider data and updates the selected slider.
     *
     * یک اسلایدر موجود را ویرایش می‌کند.
     * درخواست و nonce را بررسی کرده و اطلاعات اسلایدر انتخاب‌شده
     * را پس از پاک‌سازی در دیتابیس به‌روزرسانی می‌کند.
     *
     * @return void
     */
    protected function wooen_update(): void
    {
        // TODO: Implement wooen_update() method.
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_submit'])) {
            if (!isset($_POST['_nonce_wooen_edit_slider']) || !wp_verify_nonce($_POST['_nonce_wooen_edit_slider'], '_nonce_wooen_edit_slider')) {
                $this->message = '<div class="notice notice-error is-dismissible"><p>Validation failed while editing!</p></div>';
            } else {
                $id = intval($_POST['edit_id']);
                $link = filter_var($_POST['edit_tns_link'], FILTER_SANITIZE_URL);
                $link = esc_url_raw($link);
                $data = [
                    'top_title'   => sanitize_text_field($_POST['edit_tns_top_title']),
                    'main_title'  => sanitize_text_field($_POST['edit_tns_main_title']),
                    'sub_title'   => sanitize_text_field($_POST['edit_tns_sub_title']),
                    'p_thumbnail' => $link,
                    'p_image'     => sanitize_text_field($_POST['edit_tns_images']),
                ];
                $format = ['%s','%s','%s','%s','%s'];
                $where_format = ['%d'];
                $stmt = $this->db->update($this->table, $data, ['id' => $id],$format , $where_format);
                if ($stmt) {
                    $this->message = '<div class="notice notice-success is-dismissible"><p>Changes saved successfully!</p></div>';
                }else{
                    $this->message = '<div class="notice notice-error is-dismissible"><p>Failed to update the slider!</p></div>';
                }

            }
        }
    }


    /**
     * Delete a slider.
     *
     * Retrieves the slider ID from the GET request and
     * removes the selected slider from the database.
     *
     * یک اسلایدر را حذف می‌کند.
     * شناسه اسلایدر را از درخواست GET دریافت کرده و
     * رکورد مربوطه را از دیتابیس حذف می‌کند.
     *
     * @return void
     */
    protected function wooen_delete(): void
    {
        // TODO: Implement wooen_delete() method.
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['ID'])) {
                $slider_id = intval($_GET['ID']);
                $where = ['id' => $slider_id];
                $where_format = ['%d'];
                $stmt = $this->db->delete($this->table, $where, $where_format);
                if ($stmt) {
                    $this->message = '<div class="notice notice-success is-dismissible"><p>The selected slider has been deleted!</p></div>';
                } else {
                    $this->message = '<div class="notice notice-error is-dismissible"><p>Failed to delete the slider!</p></div>';
                }
            }
        }
    }


    /**
     * Retrieve all sliders.
     *
     * Retrieves all slider records from the database
     * as an associative array.
     *
     * تمام اسلایدرها را از دیتابیس دریافت می‌کند.
     *
     * @return array|null List of sliders or null when no result is available.
     *
     * لیستی از اسلایدرها را برمی‌گرداند یا در صورت نبود نتیجه null
     * برمی‌گرداند.
     */
    protected function wooen_select(): array
    {
        // TODO: Implement wooen_select() method.

        $home_sliders =$this->db->get_results("SELECT * FROM {$this->table}", ARRAY_A);
        return $home_sliders;

    }

    /**
     * Get the current admin operation message.
     *
     * Returns the message generated during the latest
     * slider management operation.
     *
     * پیام مربوط به آخرین عملیات مدیریت اسلایدر را برمی‌گرداند.
     *
     * @return string Current operation message.
     *
     * پیام فعلی عملیات.
     */
    public function get_message() : string
    {
        return $this->message;
    }

    /**
     * Retrieve all sliders for the admin panel.
     *
     * Provides a public interface for retrieving slider data
     * without exposing the internal CRUD select method.
     *
     * تمام اسلایدرها را برای پنل مدیریت دریافت می‌کند.
     *
     * این متد یک رابط عمومی برای دریافت اطلاعات اسلایدرها
     * فراهم می‌کند، بدون اینکه متد داخلی CRUD در خارج از کلاس
     * در دسترس باشد.
     *
     * @return array List of all sliders for the admin panel.
     *
     * لیستی از تمام اسلایدرها برای پنل مدیریت.
     */
    public function wooen_get_slider_to_admin(): array
    {
        return $this->wooen_select();
    }

    /**
     * Retrieve sliders for the front-end.
     *
     * Retrieves the latest three sliders ordered by ID
     * in descending order.
     *
     * سه اسلایدر آخر را برای نمایش در Front-End دریافت می‌کند.
     * اسلایدرها بر اساس شناسه به صورت نزولی مرتب می‌شوند.
     *
     * @return array List of the latest three sliders.
     *
     * آرایه‌ای شامل سه اسلایدر آخر را برمی‌گرداند.
     */
    public function  wooen_get_slider_to_front() : array
    {
        $stmt = $this->db->get_results("SELECT * FROM {$this->table} ORDER BY id DESC LIMIT 3", ARRAY_A);
        return (array) $stmt;
    }

}

//// Slider
////
//// ├── Internal CRUD
//// │   ├── wooen_insert()               ← Protected / Internal
//// │   ├── wooen_update()               ← Protected / Internal
//// │   ├── wooen_delete()               ← Protected / Internal
//// │   └── wooen_select()               ← Protected / Internal
//// │
//// ├── Admin
//// │   ├── wooen_handle_admin_actions() ← Admin Actions
//// │   ├── wooen_get_slider_to_admin()  ← Admin Data
//// │   └── get_message()                ← Admin Message
//// │
//// └── Front
////     └── wooen_get_slider_to_front()  ← Front Data
