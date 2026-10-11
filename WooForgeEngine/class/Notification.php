<?php



class Notification
{
    private $db;
    private string $table_notification;

    private string $message;

    public function __construct()
    {
        global $wpdb;
        $this->db = $wpdb;
        $this->table_notification = $wpdb->prefix . 'wooen_notifications';
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