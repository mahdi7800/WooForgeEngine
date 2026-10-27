<?php

class Validation
{
    /**
     * Current WordPress locale.
     *
     * @var string
     */
    private string $locale = '';

    /**
     * Get the current WordPress locale.
     *
     * @return string
     */
    private function setLocale(): string
    {
        $this->locale = get_locale();
        return $this->locale;
    }

    /**
     * Validate newsletter email.
     *
     * @param string $email
     * @return void
     */
    public function wooden_newsletter_Parameter($email) : void
   {
        if ($this->setLocale() ==='fa_IR'){
            if (empty($email)) {
                wp_send_json([
                    'error'   => true,
                    'message' => 'لطفاً آدرس ایمیل خود را وارد کنید.',
                ], 422);
            }

            if (!is_email($email)) {
                wp_send_json([
                    'error'   => true,
                    'message' => 'لطفاً یک آدرس ایمیل معتبر وارد کنید.',
                ], 422);
            }
        }else {
            if (empty($email)) {
                wp_send_json(['error' => true, 'message' => 'Please enter your email address.'], 422);
            }
            if (!is_email($email)) {
                wp_send_json(['error' => true, 'message' => 'Please enter a valid email address.'], 422);
            }
        }
   }

    /**
     * Validate contact form fields.
     *
     * @param string $email
     * @param string $name
     * @param string $subject
     * @param string $message
     * @param string $phone
     * @return void
     */
    public function wooden_contact_us_Parameter($email,$name,$subject,$message,$phone): void
   {
       if ($this->setLocale() === 'fa_IR') {
           if (empty($email)) {
               wp_send_json(['error' => true, 'message' => 'لطفاً آدرس ایمیل خود را وارد کنید!'], 422);
           }

           if (empty($name)) {
               wp_send_json(['error' => true, 'message' => 'لطفاً نام و نام خانوادگی خود را وارد کنید!'], 422);
           }

           if (empty($subject)) {
               wp_send_json(['error' => true, 'message' => 'لطفاً موضوع پیام خود را وارد کنید!'], 422);
           }

           if (empty($message)) {
               wp_send_json(['error' => true, 'message' => 'لطفاً متن پیام خود را بنویسید!'], 422);
           }

           if (!is_email($email)) {
               wp_send_json(['error' => true, 'message' => 'لطفاً یک آدرس ایمیل معتبر وارد کنید!'], 422);
           }

           if (strlen($message) < 10) {
               wp_send_json(['error' => true, 'message' => 'متن پیام باید حداقل ۱۰ کاراکتر باشد!'], 422);
           }

           if (empty($phone)) {
               wp_send_json(['error' => true, 'message' => 'لطفاً شماره موبایل خود را وارد کنید!'], 422);
           }

           if (!preg_match('/^(0|09|\+98|0098)?[0-9]{10}$/', $phone)) {
               wp_send_json(['error' => true, 'message' => 'لطفاً یک شماره موبایل معتبر وارد کنید!'], 422);
           }


       }else {

           if (empty($email)) {
               wp_send_json(['error' => true, 'message' => 'Please enter your email address!'], 422);
           }

           if (empty($name)) {
               wp_send_json(['error' => true, 'message' => 'Please enter your full name!'], 422);
           }

           if (empty($subject)) {
               wp_send_json(['error' => true, 'message' => 'Please enter the subject of your message!'], 422);
           }

           if (empty($message)) {
               wp_send_json(['error' => true, 'message' => 'Please write your message!'], 422);
           }

           if (!is_email($email)) {
               wp_send_json(['error' => true, 'message' => 'Please enter a valid email address!'], 422);
           }

           if (strlen($message) < 10) {
               wp_send_json(['error' => true, 'message' => 'Your message must be at least 10 characters long!'], 422);
           }

           if (empty($phone)) {
               wp_send_json(['error' => true, 'message' => 'Please enter your mobile number!'], 422);
           }

           if (!preg_match('/^(0|09|\+98|0098)?[0-9]{10}$/', $phone)) {
               wp_send_json(['error' => true, 'message' => 'Please enter a valid mobile number!'], 422);
           }
       }

   }

    /**
     * Validate login parameters.
     *
     * @param string $EmailOrUsername
     * @param string $password
     * @return void
     */
    public function wooen_signing_Parameter($EmailOrUsername , $password): void
   {

       if ($this->setLocale() ==='fa_IR'){
           if (empty($EmailOrUsername) && empty($password)) {
               wp_send_json(['error'   => true, 'message' => 'لطفاً نام کاربری یا ایمیل و رمز عبور خود را وارد کنید!',], 422);
           }

           if (empty($EmailOrUsername)) {
               wp_send_json(['error'   => true, 'message' => 'لطفاً نام کاربری یا ایمیل خود را وارد کنید!',], 422);
           }

           if (empty($password)) {
               wp_send_json(['error'   => true, 'message' => 'لطفاً رمز عبور خود را وارد کنید!',], 422);
           }

           $user = get_user_by('login', $EmailOrUsername);

           if (!$user) {
               $user = get_user_by('email', $EmailOrUsername);
           }

           if (!$user) {
               wp_send_json(['error'   => true, 'message' => 'کاربری با این نام کاربری یا ایمیل پیدا نشد.',], 403);
           }

       }else{
           if (empty($EmailOrUsername) && empty($password)) {
               wp_send_json(['error' => true, 'message' => 'lease enter your username or email and password!'], 422);
           }
           if (empty($EmailOrUsername)) {
               wp_send_json(['error' => true, 'message' => 'Please enter your username or email!'], 422);
           }
           if (empty($password)) {
               wp_send_json(['error' => true, 'message' => 'Please enter your password!'], 422);
           }
           $user = get_user_by('login', $EmailOrUsername);
           if (!$user) {
               $user = get_user_by('email', $EmailOrUsername);
           }
           if (!$user) {
               wp_send_json([
                   'error' => true,
                   'message' => 'No user was found with this username or email.'
               ], 403);
           }
       }

   }

    /**
     * Validate signup parameters.
     *
     * @param string $email
     * @param string $full_name
     * @param string $password
     * @return bool
     */
    public function wooen_signup_Parameter($email,$full_name,$password): bool
   {
       if ($this->setLocale() ==='fa_IR'){
           if (empty($email) && empty($full_name) && empty($password)) {
               wp_send_json(['error'   => true, 'message' => 'لطفاً تمام فیلدها را تکمیل کنید!',], 422);
           }
           if (empty($email)) {
               wp_send_json(['error'   => true, 'message' => 'لطفاً آدرس ایمیل خود را وارد کنید!',], 422);
           }
           if (!is_email($email)) {
               wp_send_json(['error'   => true, 'message' => 'لطفاً یک آدرس ایمیل معتبر وارد کنید!',], 422);
           }
           if (email_exists($email)) {
               wp_send_json(['error'   => true, 'message' => 'این آدرس ایمیل قبلاً ثبت شده است!',], 422);
           }
           if (empty($full_name)) {
               wp_send_json(['error'   => true, 'message' => 'لطفاً نام و نام خانوادگی خود را وارد کنید!',], 422);
           }
           if (!substr_count($full_name, ' ')) {
               wp_send_json(['error'   => true, 'message' => 'لطفاً نام و نام خانوادگی خود را وارد کنید!',], 422);
           }
           if (empty($password)) {
               wp_send_json(['error'   => true, 'message' => 'لطفاً رمز عبور خود را وارد کنید!',], 422);
           }
           if (!preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[#?!@$%^&*-]).{8,}$/', $password)) {
               wp_send_json(['error'   => true, 'message' => 'رمز عبور باید حداقل ۸ کاراکتر داشته باشد و شامل حروف بزرگ و کوچک انگلیسی، عدد و کاراکتر خاص باشد!',], 422);
           }
       }else {
           if (empty($email) && empty($full_name) && empty($password)) {
               wp_send_json([
                   'error' => true,
                   'message' => 'Please fill in all fields!'
               ], 422);
           }
           if (empty($email)) {
               wp_send_json([
                   'error' => true,
                   'message' => 'Please enter your email address!'
               ], 422);
           }
           if (!is_email($email)) {
               wp_send_json([
                   'error' => true,
                   'message' => 'Please enter a valid email address!'
               ], 422);
           }
           if (email_exists($email)) {
               wp_send_json([
                   'error' => true,
                   'message' => 'This email address is already registered!'
               ], 422);
           }
           if (empty($full_name)) {
               wp_send_json([
                   'error' => true,
                   'message' => 'Please enter your full name!'
               ], 422);
           }
           if (!substr_count($full_name, ' ')) {
               wp_send_json([
                   'error' => true,
                   'message' => 'Please enter your first and last name!'
               ], 422);
           }
           if (empty($password)) {
               wp_send_json(['error' => true, 'message' => 'Please enter your password!'], 422);
           }
           if (!preg_match("'/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/", $password)) {
               wp_send_json([
                   'error' => true,
                   'message' => 'Password must contain at least 8 characters, including uppercase, lowercase, number, and special character!'
               ], 422);
           }
       }
     return true;
   }

    /**
     * Validate a phone number.
     *
     * @param string $phone_number
     * @return bool
     */
    public function wooen_validate_phone_number($phone_number): bool
   {
       if ($this->setLocale() ==='fa_IR'){
           if (empty($phone_number)) {
               wp_send_json(['error'   => true, 'message' => 'لطفاً شماره موبایل خود را وارد کنید!',], 422);
           }
           if (!preg_match('/^(0|09|\+)[0-9]{8,10}$/', $phone_number)) {
               wp_send_json(['error'   => true, 'message' => 'لطفاً یک شماره موبایل معتبر وارد کنید!',], 422);
           }
       }else {
           if (empty($phone_number)) {
               wp_send_json(['error' => true, 'message' => 'Please enter your mobile number!'], 422);
           }
           if (!preg_match('/^(0|09|\+)[0-9]{8,10}$/', $phone_number)) {
               wp_send_json(['error' => true, 'message' => 'Please enter a valid mobile number!'], 422);
           }
       }
        return true;
   }

    /**
     * Validate a verification code.
     *
     * @param string $verify_code
     * @return bool
     */
    public function wooen_validate_verification_code_check($verify_code): bool
   {
       if ($this->setLocale() ==='fa_IR'){
           if (empty($verify_code)) {
               wp_send_json(['error'   => true, 'message' => 'لطفاً کد تأیید خود را وارد کنید!',], 422);
           }
           if (!is_numeric($verify_code)) {
               wp_send_json(['error'   => true, 'message' => 'کد تأیید باید فقط شامل اعداد باشد!',], 422);
           }
           if (strlen((string) $verify_code) !== 6) {
               wp_send_json(['error'   => true, 'message' => 'کد تأیید باید دقیقاً ۶ رقم باشد!',], 422);
           }
       }else {
           if (empty($verify_code)) {
               wp_send_json(['error' => true, 'message' => __('Please enter your verification code!')], 422);
           }
           if (!is_numeric($verify_code)) {
               wp_send_json(['error' => true, 'message' => __('Verification code must contain only numbers!')], 422);
           }
           if (strlen($verify_code) != 6) {
               wp_send_json(['error' => true, 'message' => __('Verification code must be exactly 6 digits!')], 422);
           }
       }
       return true;
   }
   
    /**
     * Validate a new password and its confirmation.
     *
     * @param string $new_password
     * @param string $confirm_password
     * @return bool
     */
    public function wooen_validate_change_password_code($new_password , $confirm_password): bool {
       if ($this->setLocale() ==='fa_IR'){
           if (empty($new_password) && empty($confirm_password)) {
               wp_send_json(['error'   => true, 'message' => 'لطفاً رمز عبور خود را وارد کنید!',], 422);
           }
           if (empty($new_password)) {
               wp_send_json(['error'   => true, 'message' => 'لطفاً رمز عبور جدید را وارد کنید!',], 422);
           }
           if (empty($confirm_password)) {
               wp_send_json(['error'   => true, 'message' => 'لطفاً تکرار رمز عبور را وارد کنید!',], 422);
           }
           if (!preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[#?!@$%^&*-]).{8,}$/', $new_password)) {
               wp_send_json(['error'   => true, 'message' => 'رمز عبور باید حداقل ۸ کاراکتر داشته باشد و شامل حروف بزرگ و کوچک انگلیسی، عدد و یک کاراکتر خاص باشد!',], 422);
           }
           if ($new_password !== $confirm_password) {
               wp_send_json(['error'   => true, 'message' => 'رمز عبور جدید و تکرار آن مطابقت ندارند!',], 422);
           }
       }else {
           if (empty($new_password) && empty($confirm_password)) {
               wp_send_json(['error' => true, 'message' => __('Please enter your password!')], 422);
           }
           if (empty($new_password)) {
               wp_send_json(['error' => true, 'message' => 'Please enter your password!'], 422);
           }
           if (empty($confirm_password)) {
               wp_send_json(['error' => true, 'message' => 'Please enter confirm password!'], 422);
           }
           if (!preg_match("'/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/", $new_password)) {
               wp_send_json([
                   'error' => true,
                   'message' => 'Password must contain at least 8 characters, including uppercase, lowercase, number, and special character!'
               ], 422);
           }

           if ($new_password !== $confirm_password) {
               wp_send_json(['error' => true, 'message' => __('Passwords do not match!')], 422);
           }
       }
        return true;
   }

}
