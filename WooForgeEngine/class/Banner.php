<?php

class Banner extends  CRUD
{
    private $db;
    private $table;

    private string $message = '';

    public function __construct(){
        global $wpdb;
        $this->db = $wpdb;
        $this->table = $wpdb->prefix."tns_banner";
    }

    public function wooen_insert(): void
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
    public function wooen_update(): void
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
    public function wooen_delete(): void
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

    public function wooen_select(): ?array
    {
        // TODO: Implement wooen_select() method.
        $home_banners = $this->db->get_results("SELECT * FROM {$this->table}", ARRAY_A);
        return $home_banners;
    }

    public function get_message(): string
    {
        return $this->message;
    }



}