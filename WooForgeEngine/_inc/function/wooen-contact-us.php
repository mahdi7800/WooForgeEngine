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

/**
 * Retrieves contact information and working hours for the frontend.
 *
 * Loads the contact page settings from the WordPress options table.
 * If a setting is missing or empty, a default value is provided.
 *
 * The returned data includes the address, contact phone numbers,
 * contact email, embedded map URL, and working-hour values.
 *
 * @since 1.0.0
 *
 * @return array{
 *     address: string,
 *     mobile: string,
 *     mobile_2: string,
 *     email: string,
 *     iframe_map_url: string,
 *     start_work: string,
 *     end_work: string,
 *     start_work_h: string,
 *     end_work_h: string
 * } Contact information and working-hour settings.
 */
function wooen_contact_us_setting_front(): array {
        $contact_us_data = get_option('_tnm_settings_set_contact_us');

        $address = !empty($contact_us_data['address']) ? $contact_us_data['address'] : ' ';
        $mobile  = !empty($contact_us_data['phone_number_mobile']) ? $contact_us_data['phone_number_mobile'] : '09123456789';
        $mobile_2  = !empty($contact_us_data['phone_number_store']) ? $contact_us_data['phone_number_store'] : '021-22334455';
        $email   = !empty($contact_us_data['email_contact']) ? $contact_us_data['email_contact'] : 'info@example.com';
        $iframe_map_url = !empty($contact_us_data['iframe_map_url']) ? $contact_us_data['iframe_map_url'] : 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3240.0762034011345!2d51.33938432078328!3d35.69974233666176!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMzXCsDQxJzU5LjEiTiA1McKwMjAnMTMuOSJF!5e0!3m2!1sfa!2s!4v1585894944267!5m2!1sfa!2s';
        $start_work = !empty($contact_us_data['start_work']) ? $contact_us_data['start_work'] :  '7' ;
        $end_work = !empty($contact_us_data['end_work']) ? $contact_us_data['end_work'] : '11' ;
        $start_work_h = !empty($contact_us_data['start_work_h']) ? $contact_us_data['start_work_h'] : '5' ;
        $end_work_h = !empty($contact_us_data['end_work_h']) ? $contact_us_data['end_work_h'] : '12';

        return array(
            'address'        => $address,
            'mobile'         => $mobile,
            'mobile_2'       => $mobile_2,
            'email'          => $email,
            'iframe_map_url' => $iframe_map_url,
            'start_work'     => $start_work,
            'end_work'       => $end_work,
            'start_work_h'   => $start_work_h,
            'end_work_h'     => $end_work_h,
        );
}
