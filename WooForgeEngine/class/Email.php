<?php

class Email
{
    public  function wooen_recovery_send_mail($phpmailer): void
    {
        $smtp_data = get_option('_wooen_settings_plugin_wooforgeengine_smtp');
        $phpmailer->isSMTP();
        $phpmailer->Host     = $smtp_data['host'];
        $phpmailer->SMTPAuth = true;
        $phpmailer->Port     = $smtp_data['port'];
        $phpmailer->Username = $smtp_data['username'];
        $phpmailer->Password = $smtp_data['password'];
        // Sender and recipient settings
        $phpmailer->From     = $smtp_data['from'];
        $phpmailer->FormName = $smtp_data['FormName'];
    }
}
$email_smtp = new Email();
add_action( 'phpmailer_init', [$email_smtp , 'wooen_recovery_send_mail']);