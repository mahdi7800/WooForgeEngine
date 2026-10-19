<?php

class Notification extends CRUD
{
    private $db;
    private string $table_notification;

    private string $message = ' ';

    public function __construct()
    {
        global $wpdb;
        $this->db = $wpdb;
        $this->table_notification = $wpdb->prefix . 'wooen_notifications';
    }

    protected function wooen_insert(){
        // TODO: Implement wooen_insert() method.
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
            if (!isset($_POST['_nonce_tns_setting_notice']) || !wp_verify_nonce($_POST['_nonce_tns_setting_notice'], '_nonce_tns_setting_notice')) {
                $this->message = '<div class="notice notice-error is-dismissible"><p>Security validation failed!</p></div>';
            } else {
                $link = filter_var($link_url , FILTER_SANITIZE_URL) || NULL;
                $type = isset($_POST['tns_type']) ? absint($_POST['tns_type']) : 0;
                $data = [
                    'title'=>sanitize_text_field($_POST['tns_title']),
                    'message'=>sanitize_text_field($_POST['tns_message']),
                    'slug'=> $link,
                    'type'=>$type
                ];
                $format = ['%s', '%s', '%s','%d'];
                $stmt = $this->db->insert($this->table_notification, $data,$format);
                if ($stmt) {
                    $this->message = '<div class="notice notice-success is-dismissible"><p>Notification saved successfully!</p></div>';
                }else {
                    $this->message = '<div class="notice notice-success is-dismissible"><p>An error occurred while saving the notification.</p></div>';
                }
            }
        }

    }
    protected function wooen_update(){
        // TODO: Implement wooen_update() method.
    }
    protected function wooen_delete(){
        // TODO: Implement wooen_delete() method.
        if ($_SERVER['REQUEST_METHOD'] == 'GET'){
            if (isset($_GET['action']) && $_GET['action']=='delete' && isset($_GET['id'])){
                $where = ['id'=>$_GET['id']];
                $where_format = ['%d'];
                $stmt = $this->db->delete($this->table_notification,$where,$where_format);
                if ($stmt) {
                    $this->message = '<div class="notice notice-success is-dismissible"><p>Notification deleted successfully!</p></div>';
                }else{
                    $this->message = '<div class="notice notice-error is-dismissible"><p>Failed to delete the notification due to a database error.</p></div>';
                }
            }
        }
    }
    public function wooen_select(){
        // TODO: Implement wooen_select() method.
        $stmt = $this->db->get_results($this->db->prepare("SELECT * FROM {$this->table_notification} ORDER BY id DESC "),ARRAY_A);
        return (array) $stmt;
    }


    public function wooen_select_front(): ?array {
        $stmt = $this->db->get_results($this->db->prepare("SELECT * FROM {$this->table_notification} ORDER BY id DESC "),ARRAY_A);
        return (array) $stmt;
    }
    public function wooen_notification_count() : int {
        return (int) $this->db->get_var("SELECT COUNT(*) FROM {$this->table_notification}");
    }

    public function get_message(): string
    {
        return $this->message;
    }
}
