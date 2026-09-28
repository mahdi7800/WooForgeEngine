<?php

/**
 * Handles newsletter subscriptions and subscriber management.
 *
 * This class is responsible for:
 * - Registering users to the newsletter.
 * - Checking duplicate subscriptions.
 * - Managing subscriber status.
 * - Retrieving newsletter subscribers.
 * - Deleting subscribers.
 * - Sending new post notifications to active subscribers.
 *
 * @package WooForgeEngine
 */

class Newsletter extends CRUD
{
    use SecurityTrait;
    /**
     * WordPress database object.
     *
     * @var wpdb
     */

    private $db ;

    /**
     * Newsletter database table name.
     *
     * @var string
     */

    private $table ;

    /**
     * Admin operation message.
     *
     * @var string
     */

    private string $message = '' ;

    /**
     * Subscriber email address.
     *
     * @var string
     */

    protected string $email ;

    /**
     * Initialize the Newsletter class.
     *
     * Sets the WordPress database object, newsletter table name
     * and registers required WordPress AJAX and post hooks.
     *
     * @return void
     */

   public function __construct()
   {
       global $wpdb;
       $this->db = $wpdb;
       $this->table = $wpdb->prefix . "wooen_plugin_newsletter";
       $this->wooen_registerHooks();

   }

    /**
     * Handle newsletter subscription request.
     *
     * Validates the AJAX nonce, sanitizes the submitted email,
     * checks the email and inserts the subscriber into the database.
     *
     * @return void
     */

   public function wooen_newsletter(): void
   {
       $this->wooen_verifyNonce();
       $this->email = sanitize_text_field($_POST['email']);
       $validation = new Validation();
       $validation->wooden_newsletter_Parameter($this->email);
       $this->get_user_subscribe();
       $this->wooen_insert();
   }

    /**
     * Check whether the current email is already subscribed.
     *
     * If the email already exists in the newsletter table,
     * a JSON error response is returned.
     *
     * @return void
     */

   private function get_user_subscribe(): void
   {
       $stmt = $this->db->get_row($this->db->prepare("SELECT * FROM {$this->table} WHERE `email` = %s", $this->email ));
       if ($stmt) {
           wp_send_json(['error' => true, 'message' => 'This email address is already subscribed to our newsletter.'], 403);
       }
   }

    /**
     * Retrieve all active newsletter subscribers.
     *
     * Only subscribers with status equal to 1 are returned.
     *
     * @return array List of active subscriber email addresses.
     */

    private function wooen_get_user_subscribe(): array {
       $stmt = $this->db->get_col($this->db->prepare("SELECT `email` FROM {$this->table} WHERE `status` = %d",1));
       return $stmt;
   }

    /**
     * Send the latest published post to active newsletter subscribers.
     *
     * Retrieves active subscriber email addresses, generates the
     * newsletter content and sends the email to each subscriber.
     *
     * @return void
     */

    private function wooen_post_send_mail_newsletter(): void {
       $content = new SendEmail();
        $headers  = ['Content-Type: text/html; charset=UTF-8'];
        $email_to = $this->wooen_get_user_subscribe();
        $subject  = 'خبرنامه';
        $message  = $content->wooen_get_recent_post();

        if ( ! empty( $email_to ) && is_array( $email_to) ) {
            foreach ( $email_to as $email ) {
                wp_mail( $email, $subject, $message, $headers );
            }
        }
    }

    /**
     * Insert a new newsletter subscriber.
     *
     * Adds the current email address to the newsletter table
     * and returns a JSON response indicating the operation result.
     *
     * @return void
     */

    protected function wooen_insert(): void
    {
        // TODO: Implement wooen_insert() method.

        $data = ['email'=>$this->email];
        $format = ['%s'];
        $stmt = $this->db->insert($this->table,$data,$format);
        if ($stmt) {
            wp_send_json(['success' => true,'message'=>'You have successfully subscribed to our newsletter.'],200);
        }else{
            wp_send_json( [ 'error' => true, 'message' => 'An error occurred while saving your email address.' ], 500 );
        }
    }

    /**
     * Delete a newsletter subscriber.
     *
     * Checks the current GET request for a delete action and removes
     * the corresponding subscriber from the database.
     *
     * @return void
     */

    protected function wooen_delete(): void{
        // TODO: Implement wooen_delete() method.
        if ($_SERVER['REQUEST_METHOD'] == 'GET'){
            if (isset($_GET['action']) && $_GET['action']=='delete' && isset($_GET['id'])){
                $user_id = intval($_GET['id']);
                $where = ['ID' => $user_id];
                $where_format = ['%d'];
                $stmt = $this->db->delete($this->table,$where,$where_format);
                if ($stmt) {
                    $this->message = '<div class="notice notice-success is-dismissible"><p>Newsletter subscriber deleted successfully!</p></div>';
                }else{
                    $this->message = '<div class="notice notice-error is-dismissible"><p>Failed to delete the newsletter subscriber!</p></div>';
                }
            }
        }
    }

    /**
     * Update the newsletter subscription status.
     *
     * Reads the subscriber ID and checkbox state from the POST request,
     * validates the nonce and updates the subscriber status.
     *
     * @return void
     */

    protected function wooen_update(): void
    {
        // TODO: Implement wooen_update() method.
         if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['newsletter_id'])) {
             if(!isset($_POST['newsletter_nonce']) || !wp_verify_nonce($_POST['newsletter_nonce'], 'wooen_update_newsletter_status')) {
                 $this->message = '<div class="notice notice-error is-dismissible"><p>Validation failed while editing!</p></div>';
             }else{
                 $user_id = intval($_POST['newsletter_id']);
                 $status = isset($_POST['newsletter_status']) ? 1 : 0;
                 $data = ['status'=>$status];
                 $format = ['%d'];
                 $where = ['ID' => $user_id];
                 $where_format = ['%d'];
                $stmt = $this->db->update($this->table,$data,$where,$format,$where_format);
                if ($stmt) {
                    $this->message = '<div class="notice notice-success is-dismissible"><p>Newsletter status updated successfully!</p></div>';
                }else{
                    $this->message = '<div class="notice notice-error is-dismissible"><p>Failed to update the newsletter status!</p></div>';
                }
             }
         }

    }

    /**
     * Retrieve all newsletter subscribers.
     *
     * @return array|null List of newsletter subscribers.
     */

    protected function wooen_select(): array|null
    {
        // TODO: Implement wooen_select() method.
        $users = $this->db->get_results("SELECT * FROM {$this->table}", ARRAY_A);
        return $users;
    }

    /**
     * Get the current admin operation message.
     *
     * @return string Current operation message.
     */

    public function get_message(): string
    {
        return $this->message;
    }

    /**
     * Get the total number of newsletter subscribers.
     *
     * @return int Number of subscribers.
     */

    public function wooen_user_count() : int {
        return (int) $this->db->get_var("SELECT COUNT(*) FROM {$this->table}");
    }

    public function wooen_select_admin(): ?array
    {
        return $this->wooen_select();
    }

    private function wooen_registerHooks(): void{
        add_action('wp_ajax_nopriv_wooen_newsletter', array($this,'wooen_newsletter'));
        add_action('wp_ajax_wooen_newsletter', array($this,'wooen_newsletter'));
        add_action('publish_post',array($this,'wooen_post_send_mail_newsletter'));
    }
}
