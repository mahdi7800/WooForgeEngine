<?php

class TeamOur extends CRUD
{
    use LocaleTrait;
    private wpdb $db;
    private string $table_team_our;
    private string $message;

    public function __construct(){
        global $wpdb;
        $this->db = $wpdb;
        $this->table_team_our = $wpdb->prefix . 'wooen_team_our';
    }

    protected function wooen_insert()
    {
        // TODO: Implement wooen_insert() method.
    }
    protected function wooen_update()
    {}
    protected function wooen_delete(){

    }

    protected function wooen_select(): array
    {
        $stmt = $this->db->get_results($this->db->prepare("SELECT * FROM {$this->table_team_our} ORDER BY position ASC"),ARRAY_A);
        return (array) $stmt;
    }


    public function wooen_select_team_our_front(): array
    {
        $stmt = $this->db->get_results($this->db->prepare("SELECT * FROM {$this->table_team_our} ORDER BY position ASC"),ARRAY_A);
        return (array) $stmt;
    }

    public function wooen_team_our_count() : int {
        return (int) $this->db->get_var("SELECT COUNT(*) FROM {$this->table_team_our}");
    }

    public function gat_message(): string
    {
      return $this->message;
    }

}