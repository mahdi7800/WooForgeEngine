<?php
add_action( 'wp_ajax_nopriv_wooen_contact_us', 'wooen_contact_us' );
add_action( 'wp_ajax_wooen_contact_us', 'wooen_contact_us' );

function wooen_contact_us(): void
{
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'wooen_nonce')) {
        wp_send_json([
            'error' => true,
            'message' => 'Unauthorized request.'
        ], 403);
    }
    $email = sanitize_email( $_POST['email'] );
    $name = sanitize_text_field( $_POST['name'] );
    $subject = sanitize_text_field( $_POST['subject'] );
    $message = sanitize_textarea_field( $_POST['message'] );
    $phone = sanitize_text_field( $_POST['phone'] );
    $validation =  new Validation();
    $validation->wooden_contact_us_Parameter($email,$name,$subject,$message,$phone);

        $receive_mail = new SendEmail();
        $receive_mail = $receive_mail->wooen_get_contact_layout($name,$email,$subject,$message,$phone);

        $to = get_option('_wooen_settings_plugin_wooforgeengine_smtp')['username'];
        $headers = [ 'Content-Type: text/html; charset=UTF-8' ];
        $send_mail = wp_mail(
            $to ,
            'پیام های ارسالی شما :',
            $receive_mail,
            $headers);

        if ( $send_mail === true ) {
            wp_send_json(['success' => true,'message'=>'Your message has been sent successfully.'],200);
        }else{
            wp_send_json(['error' => true,'message'=>'Failed to send your message. Please try again later.'],500);
        }
        wp_die();
}