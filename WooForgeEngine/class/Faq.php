<?php

/**
 * Handles FAQ management for WooForge Engine.
 *
 * مدیریت سوالات متداول (FAQ) در افزونه WooForge Engine.
 *
 * This class is responsible for:
 * - Creating FAQ headers.
 * - Creating FAQ questions and answers.
 * - Updating FAQ questions and answers.
 * - Deleting FAQ headers.
 * - Deleting FAQ questions and answers.
 * - Retrieving FAQ headers and their related details.
 * - Retrieving FAQ details with their related headers.
 * - Managing admin operation messages.
 *
 * این کلاس مسئول موارد زیر است:
 * - ایجاد عنوان‌های FAQ.
 * - ایجاد سوالات و پاسخ‌های FAQ.
 * - ویرایش سوالات و پاسخ‌های FAQ.
 * - حذف عنوان‌های FAQ.
 * - حذف سوالات و پاسخ‌های FAQ.
 * - دریافت عنوان‌های FAQ به همراه جزئیات مرتبط.
 * - دریافت جزئیات FAQ به همراه عنوان مرتبط.
 * - مدیریت پیام‌های عملیات در پنل مدیریت.
 *
 * @package WooForgeEngine
 */
class Faq extends CRUD
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
     * FAQ header database table name.
     *
     * نام جدول دیتابیس مربوط به عنوان‌های FAQ.
     *
     * @var string
     */
    private string $table;

    /**
     * FAQ detail database table name.
     *
     * نام جدول دیتابیس مربوط به سوالات و پاسخ‌های FAQ.
     *
     * @var string
     */
    private string $table_detail;

    /**
     * Admin operation message.
     *
     * پیام مربوط به نتیجه عملیات در پنل مدیریت.
     *
     * @var string
     */
    private string $message = '';

    /**
     * Initialize the FAQ class.
     *
     * کلاس FAQ را مقداردهی اولیه می‌کند.
     *
     * Initializes the WordPress database object and
     * sets the FAQ header and detail table names.
     *
     * شیء دیتابیس وردپرس را دریافت کرده و نام جدول‌های
     * Header و Detail مربوط به FAQ را مشخص می‌کند.
     *
     * @return void
     */
    public function __construct(){
        global $wpdb;
        $this->db = $wpdb;
        $this->table = $this->db->prefix."tns_faq";
        $this->table_detail = $this->db->prefix."tns_faq_detail";
    }

    /**
     * Handle FAQ insert operations.
     *
     * عملیات ایجاد FAQ را مدیریت می‌کند.
     *
     * Executes the appropriate insert operation for FAQ
     * headers or FAQ details based on the submitted request.
     *
     * بر اساس نوع درخواست ارسال‌شده، عملیات ایجاد عنوان FAQ
     * یا جزئیات FAQ را اجرا می‌کند.
     *
     * @return void
     */
    protected function wooen_insert(): void
    {
        // TODO: Implement wooen_insert() method.
        $this->insert_faq_headers();
        $this->insert_faq_details();
    }

    /**
     * Update an existing FAQ detail.
     *
     * یک جزئیات FAQ موجود را ویرایش می‌کند.
     *
     * Updates the question, answer, and related FAQ header ID
     * after validating the request nonce.
     *
     * پس از بررسی nonce، سوال، پاسخ و شناسه عنوان FAQ مرتبط
     * را به‌روزرسانی می‌کند.
     *
     * @return void
     */
    protected function wooen_update(): void
    {
        // TODO: Implement wooen_update() method.
        if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_submit_faq'])) {
            if (!isset($_POST['_nonce_tns_edit_faq']) || !wp_verify_nonce($_POST['_nonce_tns_edit_faq'], '_nonce_tns_edit_faq')) {
                $this->message = '<div class="notice notice-error is-dismissible"><p>Security validation failed while updating the FAQ!</p></div>';
            } else {
                $id = intval($_POST['faq_header_id_update']);
                $id_D = intval($_POST['edit_id']);
                $data =[
                    'faq_question' => sanitize_text_field($_POST['faq-question-update']),
                    'faq_answer' => wp_kses_post($_POST['faq-answer-update']),
                    'faq_ID'=>$id
                ];
                $where= ['ID'=>$id_D];
                $format = ['%s','%s','%d'];
                $where_format = ['%d'];
                $stmt = $this->db->update($this->table_detail,$data,$where,$format,$where_format);
                if ($stmt !== false) {
                    $this->message  = '<div class="notice notice-success is-dismissible"><p>FAQ question and answer updated successfully!</p></div>';
                } else {
                    $this->message  = '<div class="notice notice-error is-dismissible"><p>Failed to update the FAQ question and answer!</p></div>';
                }
            }
        }
    }

    /**
     * Handle FAQ delete operations.
     *
     * عملیات حذف FAQ را مدیریت می‌کند.
     *
     * Executes the appropriate delete operation for FAQ
     * headers or FAQ details based on the current request.
     *
     * بر اساس نوع درخواست فعلی، عملیات حذف عنوان FAQ
     * یا جزئیات FAQ را اجرا می‌کند.
     *
     * @return void
     */
    protected function wooen_delete(): void
    {
        // TODO: Implement wooen_delete() method.
        $this->delete_faq_headers();
        $this->delete_faq_details();
    }

    /**
     * Retrieve all FAQ headers with their related details.
     *
     * تمام عنوان‌های FAQ را به همراه جزئیات مرتبط دریافت می‌کند.
     *
     * Retrieves all FAQ headers and attaches their related
     * questions and answers to each header.
     *
     * تمام عنوان‌های FAQ را دریافت کرده و سوالات و پاسخ‌های
     * مرتبط با هر عنوان را به آن متصل می‌کند.
     *
     * @return array List of FAQ headers with their details.
     *
     * آرایه‌ای شامل عنوان‌های FAQ به همراه جزئیات آن‌ها.
     */
    protected function wooen_select(): ?array
    {
        // TODO: Implement wooen_select() method.


        $headers = $this->select_header();
        foreach ($headers as &$header) {

            $header['questions'] = $this->db->get_results(
                $this->db->prepare(
                    "SELECT *
                 FROM {$this->table_detail}
                 WHERE faq_id = %d
                 ORDER BY ID DESC",
                    $header['ID']
                ),
                ARRAY_A
            );
        }

        unset($header);

        return $headers;
    }

    /**
     * Insert a new FAQ header.
     *
     * یک عنوان جدید برای FAQ ایجاد می‌کند.
     *
     * Validates the request nonce and inserts the FAQ header
     * into the database.
     *
     * nonce درخواست را بررسی کرده و عنوان FAQ را
     * در دیتابیس ذخیره می‌کند.
     *
     * @return void
     */
    private function insert_faq_headers(): void
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit-faq-header'])) {
            if (!isset($_POST['_nonce_tnm_setting_faq']) || !wp_verify_nonce($_POST['_nonce_tnm_setting_faq'], '_nonce_tnm_setting_faq')) {
                $this->message = '<div class="notice notice-error is-dismissible"><p>Security validation failed while creating the FAQ header!</p></div>';
            } else {
                $data = ['header' => sanitize_text_field($_POST['tnm-headers'])];
                $format = ['%s'];
                $stmt = $this->db->insert($this->table, $data, $format);
                if ($stmt !== false){
                    $this->message = '<div class="notice notice-success is-dismissible"><p>FAQ header created successfully!</p></div>';
                } else {
                    $this->message = '<div class="notice notice-error is-dismissible"><p>Failed to create the FAQ header!</p></div>';
                }
            }
        }
    }

    /**
     * Insert a new FAQ question and answer.
     *
     * یک سوال و پاسخ جدید برای FAQ ایجاد می‌کند.
     *
     * Validates the request nonce, verifies the selected FAQ header,
     * and inserts the question and answer into the detail table.
     *
     * nonce درخواست را بررسی کرده، عنوان انتخاب‌شده FAQ را اعتبارسنجی
     * کرده و سوال و پاسخ را در جدول جزئیات ذخیره می‌کند.
     *
     * @return void
     */
    private function insert_faq_details(): void
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit-faq-details'])) {
            if (!isset($_POST['_nonce_tnm_setting_faq_details']) || !wp_verify_nonce($_POST['_nonce_tnm_setting_faq_details'], '_nonce_tnm_setting_faq_details')) {
                $this->message = '<div class="notice notice-error is-dismissible"><p>Security validation failed while creating the FAQ question and answer!</p></div>';
            } else {



                $faq_id = isset($_POST['faq_header_id']) ? intval($_POST['faq_header_id']) : 0;

                if($faq_id > 0) {
                    $data = [
                        'faq_question' => sanitize_text_field($_POST['faq-question']),
                        'faq_answer' => wp_kses_post($_POST['faq-answer']),
                        'faq_id' => $faq_id
                    ];
                    $format = ['%s','%s','%d'];
                    $stmt = $this->db->insert($this->table_detail, $data, $format);

                    if ($stmt !== false){
                        $this->message = '<div class="notice notice-success is-dismissible"><p>FAQ question and answer created successfully!</p></div>';
                    } else {
                        $this->message = '<div class="notice notice-error is-dismissible"><p>Failed to create the FAQ question and answer!</p></div>';
                    }
                } else {
                    $this->message = '<div class="notice notice-error is-dismissible"><p>Please select an FAQ header first!</p></div>';
                }
            }
        }
    }

    /**
     * Delete an FAQ header.
     *
     * یک عنوان FAQ را حذف می‌کند.
     *
     * Deletes the selected FAQ header based on the ID
     * provided in the GET request.
     *
     * عنوان FAQ انتخاب‌شده را بر اساس شناسه موجود
     * در درخواست GET حذف می‌کند.
     *
     * @return void
     */
    private function delete_faq_headers(): void {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            if(isset($_GET['action']) && $_GET['action']=='delete_header' && isset($_GET['id'])){
                $ID = intval($_GET['id']);
                $where = ['ID' => $ID];
                $where_format = ['%d'];
                $stmt = $this->db->delete($this->table,$where, $where_format);
                if($stmt !== false){
                    $message = '<div class="notice notice-success is-dismissible"><p>FAQ header deleted successfully!</p></div>';
                }else{
                    $message = '<div class="notice notice-error is-dismissible"><p>Failed to delete the FAQ header!</p></div>';
                }
            }
        }
    }

    /**
     * Delete an FAQ question and answer.
     *
     * یک سوال و پاسخ FAQ را حذف می‌کند.
     *
     * Deletes the selected FAQ detail based on the ID
     * provided in the GET request.
     *
     * جزئیات FAQ انتخاب‌شده را بر اساس شناسه موجود
     * در درخواست GET حذف می‌کند.
     *
     * @return void
     */
    private function delete_faq_details(): void {
        if ($_SERVER['REQUEST_METHOD'] == 'GET'){
            if(isset($_GET['action']) && $_GET['action']=='delete_detail' && isset($_GET['id'])){
                $ID = intval($_GET['id']);
                $where = ['ID'=>$ID];
                $where_format = ['%d'];
                $stmt = $this->db->delete($this->table_detail,$where ,$where_format);

                if($stmt !== false){
                    $this->message = '<div class="notice notice-error is-dismissible"><p>FAQ question and answer deleted successfully!</p></div>';
                }else{
                    $this->message = '<div class="notice notice-error is-dismissible"><p>Failed to delete the FAQ question and answer!</p></div>';
                }
            }
        }
    }


    /**
     * Retrieve all FAQ headers.
     *
     * تمام عنوان‌های FAQ را دریافت می‌کند.
     *
     * @return array List of FAQ headers.
     *
     * آرایه‌ای شامل تمام عنوان‌های FAQ.
     */
    public function select_header(): ?array
    {
        $headers_faq = $this->db->get_results("SELECT * FROM $this->table", ARRAY_A);
        return $headers_faq;
    }

    /**
     * Retrieve all FAQ details with their related headers.
     *
     * تمام جزئیات FAQ را به همراه عنوان مرتبط دریافت می‌کند.
     *
     * Uses an INNER JOIN to retrieve the FAQ question,
     * answer, and related header in a single query.
     *
     * با استفاده از INNER JOIN، سوال، پاسخ و عنوان مرتبط
     * را در یک Query دریافت می‌کند.
     *
     * @return array List of FAQ details with their headers.
     *
     * آرایه‌ای شامل جزئیات FAQ به همراه عنوان مرتبط.
     */
    public function select_detail(): ?array {
        return $this->db->get_results(
            "SELECT 
        d.*,
        h.header
     FROM $this->table_detail AS d 
     INNER JOIN $this->table AS h ON d.faq_id = h.ID 
     ORDER BY d.faq_id DESC",
            ARRAY_A
        );
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

    public function wooen_get_faq_to_front(): ?array
    {
            return $this->wooen_select();
    }

}
