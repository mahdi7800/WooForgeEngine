<?php

class Slider extends CRUD
{
    private $db;
    private $table;
    private string $message='';

    public function __construct(){
        global $wpdb;
        $this->db = $wpdb;
        $this->table = $wpdb->prefix."tns_sliders";
    }

    public function wooen_insert(): void
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

    public function wooen_update(): void
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

    public function wooen_delete(): void
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

    public function wooen_select(): ?array
    {
        // TODO: Implement wooen_select() method.

        $home_sliders =$this->db->get_results("SELECT * FROM {$this->table}", ARRAY_A);
        return $home_sliders;

    }

    public function get_message() : string
    {
        return $this->message;
    }

}