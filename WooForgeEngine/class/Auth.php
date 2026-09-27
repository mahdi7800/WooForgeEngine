<?php
class Auth {
    use SecurityTrait;

    /**
     * WordPress database object.
     * شیء دیتابیس وردپرس.
     *
     * @var wpdb
     */

    private wpdb $db;

    /**
     * Database table used to store SMS verification codes.
     * جدول دیتابیس مورد استفاده برای ذخیره کدهای تأیید پیامکی.
     *
     * @var string
     */

    private string $table_verify_code;

    /**
     * Database table used to store password recovery tokens.
     * جدول دیتابیس مورد استفاده برای ذخیره توکن‌های بازیابی رمز عبور.
     *
     * @var string
     */

    private string $table_validate_token;

    /**
     * Validation handler used to validate authentication parameters.
     * مدیریت اعتبارسنجی برای بررسی پارامترهای مربوط به احراز هویت.
     *
     * @var Validation
     */

    private Validation $validation;

    /**
     * Initializes the authentication handler.
     * مدیریت احراز هویت را مقداردهی اولیه می‌کند.
     *
     * Sets the required database tables, creates the validation
     * handler, and registers AJAX actions for authentication,
     * registration, password recovery, password changing,
     * SMS verification, and verification-code validation.
     *
     * جدول‌های مورد نیاز دیتابیس را مشخص می‌کند، شیء اعتبارسنجی را
     * ایجاد می‌کند و اکشن‌های AJAX مربوط به ورود، ثبت‌نام،
     * بازیابی رمز عبور، تغییر رمز عبور، تأیید پیامکی و بررسی
     * کد تأیید را ثبت می‌کند.
     *
     * @since 1.0.0
     *
     * @return void
     */

    public function __construct() {
        global $wpdb;
        $this->db = $wpdb;
        $this->table_verify_code = $this->db->prefix . "wooen_verify_code";
        $this->table_validate_token = $this->db->prefix . "wooen_validate_token";
        $this->validation = new Validation();
        $this->wooen_registerHooks();
    }

    /**
     * Handles user login requests.
     * درخواست‌های ورود کاربر را مدیریت می‌کند.
     *
     * The user can authenticate using either their username
     * or email address.
     *
     * کاربر می‌تواند با استفاده از نام کاربری یا آدرس ایمیل
     * خود وارد حساب کاربری شود.
     *
     * @since 1.0.0
     *
     * @return void
     */

    public function wooen_signing(): void
    {
        $this->wooen_verifyNonce();

        $emailOrUsername = sanitize_text_field($_POST['emailOrUsername']);
        $password = sanitize_text_field($_POST['password']);
        $remember_me = isset($_POST['remember_me']) && $_POST['remember_me'] === 'true';

        $this->validation->wooen_signing_Parameter($emailOrUsername,  $password);

        $user = get_user_by('login', $emailOrUsername);
        if (!$user) {
            $user = get_user_by('email', $emailOrUsername);
        }
        $cred = [
            'user_login'    => $user->user_login,
            'user_password' => $password ,
            'remember'      => $remember_me
        ];
        $login = wp_signon($cred);
        if ( !is_wp_error( $login ) ) {
            wp_send_json(  [
                'success'=>true,
                'redirect_url' => site_url(),
                'message' => 'Login successful. Redirecting...'],
                200 );
        }else{
            wp_send_json( [
                'error' => true,
                'message' => 'The username, email, or password is incorrect.' ],
                403 );
        }


    }

    /**
     * Registers a new WordPress user.
     * یک کاربر جدید در وردپرس ثبت می‌کند.
     *
     * Creates a WordPress user account using the provided
     * name, email address, and password.
     *
     * با استفاده از نام، آدرس ایمیل و رمز عبور ارائه‌شده،
     * یک حساب کاربری جدید در وردپرس ایجاد می‌کند.
     *
     * If SMS registration is enabled in the plugin settings,
     * the user's phone number is also stored as user metadata.
     *
     * اگر ثبت‌نام پیامکی در تنظیمات افزونه فعال باشد،
     * شماره تلفن کاربر نیز به عنوان متادیتای کاربر ذخیره می‌شود.
     *
     * @since 1.0.0
     *
     * @return void
     */

    public function wooen_signup(): void
    {
        $this->wooen_verifyNonce();
        $full_name = sanitize_text_field($_POST['full_name']);
        $email = sanitize_text_field($_POST['email']);
        $password = sanitize_text_field($_POST['password']);

        $general_settings = get_option('_shw_settings_set_general', []);

        $register_from_sms = (($general_settings['register_from_sms_enable'] ?? 'no') === 'yes');

        $phone_number = '';
        if ($register_from_sms && !empty($phone_number)){
            $phone_number = sanitize_text_field($_POST['phone_number']);
        }

        $this->validation->wooen_signup_Parameter($email,$full_name, $password);
        $user_data = [
            'user_login'   => apply_filters('pre_user_login', utility::wooen_create_user_login($email)),
            'display_name' => apply_filters('pre_user_display_name', utility::wooen_create_display_name($full_name)['display_name']),
            'first_name'   => apply_filters('pre_user_first_name', utility::wooen_create_display_name($full_name)['first_name']),
            'last_name'    => apply_filters('pre_user_last_name', utility::wooen_create_display_name($full_name)['last_name']),
            'user_email'   => apply_filters('pre_user_email', $email),
            'user_pass'    => apply_filters('pre_user_pass', $password),
        ];
        $insert_user_in = wp_insert_user($user_data);
        if ( ! is_wp_error( $insert_user_in ) ) {
            if (isset($phone_number)&& !empty($phone_number)) {
                add_user_meta($insert_user_in,'_wooen_user_phone_number',$phone_number,true);
            }
            wp_set_current_user( $insert_user_in );
            wp_set_auth_cookie( $insert_user_in );
            do_action( 'wp_login', $user_data['user_login'], get_user_by('id', $insert_user_in) );
            wp_send_json(['success'=>true,'message'=>'ثبت نام شما با موفقیت انجام شد،انتفال به سایت!','redirect_url' => site_url()],200);
        } else {
            wp_send_json(['error' => true, 'message' => 'خطایی در ثبت نام لطفا دوباره تلاش کنید!'], 403);
        }
    }


    /**
     * Creates a password recovery request.
     * درخواست بازیابی رمز عبور را ایجاد می‌کند.
     *
     * Validates the submitted email address, generates a recovery
     * token, stores the token in the database, and sends the
     * password recovery email to the user.
     *
     * آدرس ایمیل ارسال‌شده را اعتبارسنجی می‌کند، یک توکن بازیابی
     * ایجاد می‌کند، توکن را در دیتابیس ذخیره کرده و ایمیل
     * بازیابی رمز عبور را برای کاربر ارسال می‌کند.
     *
     * @since 1.0.0
     *
     * @return void
     */

    public function wooen_password_recovery(): void{
            $this->wooen_verifyNonce();
            $email = sanitize_text_field($_POST['email']);
            $this->validation->wooden_newsletter_Parameter($email);
            if (!email_exists( $email )) {
                wp_send_json(['error'=>true,'message'=>'No account was found with this email address.'],402);
            }
            $token = utility::wooen_create_token($email);
            $stmt = $this->wooen_creating_and_select_verification_token($email,$token);
            if (!$stmt) {
                wp_send_json(['error'   => true, 'message' => 'Unable to create the password recovery request. Please try again later.'], 500);
            }
            $sendmail = new SendEmail();
            $sendmail->wooen_send_email_recovery($email,$token);
    }

    /**
     * Changes the user's password using a valid recovery token.
     * رمز عبور کاربر را با استفاده از یک توکن بازیابی معتبر تغییر می‌دهد.
     *
     * Validates the new password, verifies the recovery token,
     * updates the user's password, and removes the used token.
     *
     * رمز عبور جدید را اعتبارسنجی می‌کند، توکن بازیابی را بررسی می‌کند،
     * رمز عبور کاربر را تغییر می‌دهد و توکن استفاده‌شده را حذف می‌کند.
     *
     * @since 1.0.0
     *
     * @return void
     */

    public function wooen_change_password(): void
    {
        $this->wooen_verifyNonce();
        $new_password = sanitize_text_field($_POST['new_password']) ?? '';
        $confirm_password = sanitize_text_field($_POST['confirm_password']) ?? '';
        $token_cr = sanitize_text_field($_POST['token_cr']) ?? '';
        $this->validation->wooen_validate_change_password_code($new_password,$confirm_password);
        $userid = $this->wooen_check_token_get_user_ID($token_cr);
            if ($userid) {
                wp_set_password( $new_password, $userid );
                $this->wooen_delete_token($token_cr);
                wp_send_json(['success' => true, 'message' => 'Password changed successfully!'], 200);
            }else{
                wp_send_json(['error' => true, 'message' => 'The recovery token is invalid or the user was not found.'], 403);
            }

    }

    /**
     * Generates a random password.
     * تولید یک رمز عبور تصادفی.
     *
     * Creates a random password and returns it as a JSON response.
     * یک رمز عبور تصادفی ایجاد کرده و آن را به صورت پاسخ JSON برمی‌گرداند.
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function wooen_random_password(): void
    {
        $this->wooen_verifyNonce();
        $random_password = utility::wooen_generate_Random_String();
        if ($random_password){
            wp_send_json(['success' => true,'password' => $random_password ,'message'=>'Password generated successfully.']);
        }else{
            wp_send_json(['error' => true,'message'=>'Failed to generate password.']);
        }
    }


    /**
     * Sends an SMS verification code to a phone number.
     * یک کد تأیید پیامکی را به شماره تلفن ارسال می‌کند.
     *
     * Generates a verification code, stores it in the database,
     * loads the configured SMS gateway settings, and sends the
     * verification code through the selected SMS provider.
     *
     * یک کد تأیید ایجاد می‌کند، آن را در دیتابیس ذخیره می‌کند،
     * تنظیمات پنل پیامکی را دریافت کرده و کد تأیید را از طریق
     * سرویس پیامکی انتخاب‌شده ارسال می‌کند.
     *
     * @since 1.0.0
     *
     * @return void
     */

    public function wooen_send_code(): void
    {
        $this->wooen_verifyNonce();

        $phone_number = sanitize_text_field($_POST['phone_number']);
        $verification_code = utility::wooen_create_verification_code();

        $this->validation->wooen_validate_phone_number($phone_number);
        $this->wooen_select_and_insert_verify_code($phone_number,$verification_code);

        $sms_settings = get_option(
            '_shw_sms_settings_set',
            [],
        );
        $panel = $sms_settings['panel'] ?? 'melipayamak';

        $api_key = $sms_settings['api_key'] ?? '';

        $from = $sms_settings['from'] ?? '';

        $sms = new Sms();

        $sms->sets_sms(
            $from,
            $phone_number,
            $verification_code,
            $panel,
            $api_key,
            '',
            $verification_code
        );

        $result = $sms->choice_panel();

        if ($result === true) {

            wp_send_json([
                'success' => true,
                'message' => 'کد تایید ارسال شد.'
            ], 200);

        }else{
            wp_send_json([
                'error' => true,
                'message' => 'ارسال پیامک با خطا مواجه شد!'
            ], 500);
        }


    }

    /**
     * Verifies an SMS verification code.
     * کد تأیید پیامکی را بررسی می‌کند.
     *
     * Checks whether the submitted verification code belongs
     * to the specified phone number and removes the code after
     * successful verification.
     *
     * بررسی می‌کند که کد تأیید ارسال‌شده متعلق به شماره تلفن
     * مشخص‌شده باشد و پس از تأیید موفق، کد را حذف می‌کند.
     *
     * @since 1.0.0
     *
     * @return void
     */

    public function wooen_verification_code_check() : void {
        $this->wooen_verifyNonce();
        $verified = sanitize_text_field($_POST['verified']);
        $phone_number = sanitize_text_field($_POST['phone_number']);
        $this->validation->wooen_validate_verification_code_check($verified);
        $this->wooen_select_code_check($verified,$phone_number);
    }

    /**
     * Finds a password recovery token.
     * توکن بازیابی رمز عبور را پیدا می‌کند.
     *
     * Searches the recovery-token table for a matching token
     * and returns the corresponding database row.
     *
     * جدول توکن‌های بازیابی را برای پیدا کردن توکن موردنظر
     * جستجو کرده و رکورد مربوطه را برمی‌گرداند.
     *
     * @since 1.0.0
     *
     * @param string $token Password recovery token.
     *                      توکن بازیابی رمز عبور.
     *
     * @return object|null Database row if the token exists,
     *                     otherwise null.
     *                     در صورت وجود توکن، رکورد دیتابیس را برمی‌گرداند؛
     *                     در غیر این صورت null.
     */
    private function wooen_find_recaver_token(string $token): ?object
    {
        return $this->db->get_row($this->db->prepare("SELECT * FROM {$this->table_validate_token} WHERE token = %s AND create_date >= DATE_SUB(NOW(), INTERVAL 30 MINUTE)", $token));
    }

    /**
     * Inserts or updates an SMS verification code.
     * کد تأیید پیامکی را ایجاد یا به‌روزرسانی می‌کند.
     *
     * If a verification record already exists for the phone number,
     * its verification code is updated. Otherwise, a new record
     * is inserted into the verification-code table.
     *
     * اگر برای شماره تلفن موردنظر رکوردی وجود داشته باشد،
     * کد تأیید آن به‌روزرسانی می‌شود. در غیر این صورت،
     * یک رکورد جدید در جدول کدهای تأیید ایجاد می‌شود.
     *
     * @since 1.0.0
     *
     * @param string $phone_number Phone number associated with the code.
     *                             شماره تلفن مرتبط با کد تأیید.
     *
     * @param string $verification_code Generated verification code.
     *                                  کد تأیید تولیدشده.
     *
     * @return void
     */
    private function wooen_select_and_insert_verify_code(string $phone_number,string $verification_code): void
    {
        $stmt = $this->db->get_row($this->db->prepare("SELECT * FROM {$this->table_verify_code} WHERE phone=%s",$phone_number));
        if($stmt !== null){
            $data = ['verification_code'=>$verification_code];
            $format=['%s'];
            $where = ['phone'=>$phone_number];
            $where_format = ['%s'];
            $this->db->update($this->table_verify_code,$data,$where,$format,$where_format);
        }else{
            $data =
                [
                    'phone'=>$phone_number,
                    'verification_code'=>$verification_code
                ];
            $format=['%s','%s'];
            $this->db->insert($this->table_verify_code,$data,$format);
        }

    }

    /**
     * Checks an SMS verification code against a phone number.
     * کد تأیید پیامکی را با شماره تلفن بررسی می‌کند.
     *
     * If the verification code is valid, the stored code is deleted
     * and a successful JSON response is returned. Otherwise, an
     * error response is returned.
     *
     * اگر کد تأیید معتبر باشد، کد ذخیره‌شده حذف شده و یک پاسخ JSON
     * موفقیت‌آمیز ارسال می‌شود. در غیر این صورت، پاسخ خطا ارسال می‌شود.
     *
     * @since 1.0.0
     *
     * @param string $verification_code Submitted verification code.
     *                                  کد تأیید ارسال‌شده توسط کاربر.
     *
     * @param string $phone_number Phone number associated with the code.
     *                             شماره تلفن مرتبط با کد تأیید.
     *
     * @return void
     */
    private function wooen_select_code_check(string $verification_code , string $phone_number): void{
        $stmt = $this->db->get_row($this->db->prepare("SELECT * FROM {$this->table_verify_code} WHERE phone=%s AND verification_code =%s	",$phone_number,$verification_code));
        if ($stmt) {
            $this->wooen_delete_verify_code_check($verification_code ,$phone_number);
            wp_send_json(['success' => true, 'message' => 'کد تاییدیه معتبر است!'], 200);
        }else{
            wp_send_json(['error' => true, 'message' => 'کد تاییدیه معتبر نمی‌باشد!'], 403);
        }
    }

    /**
     * Deletes a used SMS verification code.
     * کد تأیید پیامکی استفاده‌شده را حذف می‌کند.
     *
     * Removes the verification record matching both the
     * verification code and phone number.
     *
     * رکورد تأیید را بر اساس کد تأیید و شماره تلفن حذف می‌کند.
     *
     * @since 1.0.0
     *
     * @param string $verification_code Verification code.
     *                                  کد تأیید.
     *
     * @param string $phone_number Phone number associated with the code.
     *                             شماره تلفن مرتبط با کد.
     *
     * @return void
     */
    private function wooen_delete_verify_code_check(string $verification_code ,string $phone_number): void {
        $where = ['verification_code'=>$verification_code,'phone' => $phone_number];
        $where_format = ['%s','%s'];
        $this->db->delete($this->table_verify_code, $where, $where_format);
    }

    /**
     * Creates or updates a password recovery token.
     * توکن بازیابی رمز عبور را ایجاد یا به‌روزرسانی می‌کند.
     *
     * If a recovery record already exists for the email address,
     * its token is updated. Otherwise, a new recovery record
     * is inserted.
     *
     * اگر برای آدرس ایمیل موردنظر رکورد بازیابی وجود داشته باشد،
     * توکن آن به‌روزرسانی می‌شود. در غیر این صورت،
     * یک رکورد جدید ایجاد می‌شود.
     *
     * @since 1.0.0
     *
     * @param string $email User email address.
     *                      آدرس ایمیل کاربر.
     *
     * @param string $token Generated recovery token.
     *                      توکن بازیابی تولیدشده.
     *
     * @return bool True if the database operation was successful,
     *              otherwise false.
     *              در صورت موفقیت عملیات دیتابیس true و در غیر این صورت false.
     */
    private function wooen_creating_and_select_verification_token(string $email, string $token): bool
    {
        $token = explode('=', $token);
        $stmt = $this->db->get_row($this->db->prepare("SELECT * FROM {$this->table_validate_token} WHERE email=%s", $email));
        if ($stmt) {
            $data = ['token'=>$token[1]];
            $where = ['email'=>$email];
            $format=['%s'];
            $where_format = ['%s'];
            return $this->db->update($this->table_validate_token, $data , $where, $format,$where_format) != false;
        }else{
            $data = ['email'=>$email , 'token'=>$token[1]];
            $format=['%s','%s'];
            return $this->db->insert($this->table_validate_token,$data,$format) != false;
        }

    }

    /**
     * Retrieves the WordPress user ID associated with a recovery token.
     * شناسه کاربر وردپرس مرتبط با توکن بازیابی را دریافت می‌کند.
     *
     * Looks up the recovery token, retrieves the stored email address,
     * and finds the corresponding WordPress user.
     *
     * توکن بازیابی را جستجو می‌کند، آدرس ایمیل ذخیره‌شده را دریافت کرده
     * و کاربر وردپرس مرتبط با آن را پیدا می‌کند.
     *
     * @since 1.0.0
     *
     * @param string $token Password recovery token.
     *                      توکن بازیابی رمز عبور.
     *
     * @return int|false User ID if found, otherwise false.
     *                   در صورت پیدا شدن کاربر، شناسه او و در غیر این صورت false.
     */
    private function wooen_check_token_get_user_ID(string $token): bool|int
    {
        $stmt = $this->wooen_find_recaver_token($token);
        if (!$stmt || empty($stmt->email)) {
            return false;
        }
        $user = get_user_by('email', $stmt->email);
        return $user ? $user->ID : false;
    }

    /**
     * Deletes a password recovery token.
     * توکن بازیابی رمز عبور را حذف می‌کند.
     *
     * Removes the password recovery token from the database
     * after it has been successfully used.
     *
     * پس از استفاده موفقیت‌آمیز، توکن بازیابی رمز عبور را
     * از دیتابیس حذف می‌کند.
     *
     * @since 1.0.0
     *
     * @param string $token Password recovery token.
     *                      توکن بازیابی رمز عبور.
     *
     * @return void
     */
    private function wooen_delete_token(string $token): void
    {
        $where = ['token'=>$token];
        $where_format = ['%s'];
        $this->db->delete($this->table_validate_token, $where, $where_format);
    }

    /**
     * Registers AJAX hooks used by the authentication system.
     * اکشن‌های AJAX مورد استفاده سیستم احراز هویت را ثبت می‌کند.
     *
     * Authentication and password recovery hooks are always registered.
     * SMS verification hooks are registered only when SMS registration
     * is enabled in the plugin settings.
     *
     * اکشن‌های مربوط به احراز هویت و بازیابی رمز عبور همیشه ثبت می‌شوند.
     * اکشن‌های مربوط به تأیید پیامکی فقط زمانی ثبت می‌شوند که
     * ثبت‌نام پیامکی در تنظیمات افزونه فعال باشد.
     *
     * @since 1.0.0
     *
     * @return void
     */
    private function wooen_registerHooks(): void
    {
        add_action('wp_ajax_nopriv_wooen_signing', array($this, 'wooen_signing'));
        add_action('wp_ajax_nopriv_wooen_signup', array($this, 'wooen_signup'));
        add_action('wp_ajax_nopriv_wooen_password_recovery',array($this,'wooen_password_recovery'));
        add_action('wp_ajax_nopriv_wooen_change_password',array($this,'wooen_change_password'));
        add_action('wp_ajax_nopriv_wooen_random_password', array($this,'wooen_random_password'));

        $settings = get_option('_shw_settings_set_general', []);
        if (($settings['register_from_sms_enable'] ?? 'no') === 'yes') {
            add_action('wp_ajax_nopriv_wooen_send_code', array($this, 'wooen_send_code'));
            add_action('wp_ajax_nopriv_wooen_verification_code_check', array($this, 'wooen_verification_code_check'));
        }
    }

    /**
     * Generates the appropriate password recovery HTML layout.
     * ساختار HTML مناسب برای مرحله بازیابی رمز عبور را تولید می‌کند.
     *
     * Checks whether a recovery token is available and verifies the token
     * against the stored password recovery records.
     *
     * بررسی می‌کند که آیا توکن بازیابی وجود دارد یا خیر و سپس آن را
     * با رکوردهای ذخیره‌شده بازیابی رمز عبور مقایسه می‌کند.
     *
     * If the token is valid, the new-password form is returned.
     * If the token is invalid or expired, an error message is displayed.
     * When no token is provided, the email submission form is returned.
     *
     * اگر توکن معتبر باشد، فرم تعیین رمز عبور جدید نمایش داده می‌شود.
     * اگر توکن نامعتبر یا منقضی شده باشد، پیام خطا نمایش داده می‌شود.
     * اگر توکنی ارسال نشده باشد، فرم ارسال ایمیل نمایش داده می‌شود.
     *
     * @since 1.0.0
     *
     * @param string|null $token Password recovery token.
     *                           توکن بازیابی رمز عبور.
     *
     * @param string $html_get_email HTML markup for the email form.
     *                               کد HTML مربوط به فرم دریافت ایمیل.
     *
     * @param string $html_get_new_password HTML markup for the new-password form.
     *                                     کد HTML مربوط به فرم تعیین رمز عبور جدید.
     *
     * @return string HTML markup for the appropriate password recovery step.
     *                کد HTML مربوط به مرحله مناسب بازیابی رمز عبور.
     */
    public function wooen_recovery_password_html_layout(?string $token,string $html_get_email,string $html_get_new_password): string
    {
             $get_token = isset( $token ) && ! empty( $token );
             $html_token = '';
            if ($get_token) {
                $recovery_token =  $this->wooen_find_recaver_token($token);
                if ($recovery_token) {
                    $html_token = $html_get_new_password;
                }else{
                    $html_token = ' <div class="alert alert-danger">This password recovery link is invalid or has expired.</div>';
                }
            }else{
                    $html_token =$html_get_email;
            }
            return $html_token;
    }

}
//Auth
//│
//├── Login
//│   └── wooen_signing()
//│
//├── Registration
//│   └── wooen_signup()
//│
//├── Password Recovery
//│   ├── wooen_password_recovery()
//│   ├── wooen_change_password()
//│   ├── wooen_find_recaver_token()
//│   ├── wooen_creating_and_select_verification_token()
//│   ├── wooen_check_token_get_user_ID()
//│   └── wooen_delete_token()
//│
//├── SMS Verification
//│   ├── wooen_send_code()
//│   ├── wooen_verification_code_check()
//│   ├── wooen_select_and_insert_verify_code()
//│   ├── wooen_select_code_check()
//│   └── wooen_delete_verify_code_check()
//│
//├── Security
//│   └── verifyNonce()
//│
//├── Hooks
//│   └── registerHooks()
//│
//└── HTML
//    └── wooen_recovery_password_html_layout()