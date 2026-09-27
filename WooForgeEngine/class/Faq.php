<?php

class Faq extends CRUD
{
    private $db;
    private $table;
    private $table_detail;
    private string $message = '';

    public function __construct(){
        global $wpdb;
        $this->db = $wpdb;
        $this->table = $this->db->prefix."tns_faq";
        $this->table_detail = $this->db->prefix."tns_faq_detail";
    }
    public function wooen_insert(): void
    {
        // TODO: Implement wooen_insert() method.
        $this->insert_faq_headers();
        $this->insert_faq_details();
    }
    public function wooen_update(): void
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
    public function wooen_delete(): void
    {
        // TODO: Implement wooen_delete() method.
        $this->delete_faq_headers();
        $this->delete_faq_details();
    }
    public function wooen_select(): ?array
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

    public function select_header(): ?array
    {
        $headers_faq = $this->db->get_results("SELECT * FROM $this->table", ARRAY_A);
        return $headers_faq;
    }
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
    public function get_message(): string
    {
        return $this->message;
    }

}