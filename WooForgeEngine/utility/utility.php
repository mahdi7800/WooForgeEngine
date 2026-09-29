<?php

class utility
{
    /**
     * Default length used for generating random strings.
     * طول پیش‌فرض مورد استفاده برای تولید رشته‌های تصادفی.
     *
     * @var int
     */
    private const length = 9;

    /**
     * Character set used for generating random strings.
     * مجموعه کاراکترهای مورد استفاده برای تولید رشته‌های تصادفی.
     *
     * @var string
     */
    private const  character = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';

    /**
     * Special characters used in generated random strings.
     * کاراکترهای ویژه مورد استفاده در رشته‌های تصادفی تولیدشده.
     *
     * @var string
     */
    private const character_s = '@#$%&*!?';

    /**
     * Converts a date between Gregorian and Jalali calendars.
     * تاریخ را بین تقویم میلادی و شمسی تبدیل می‌کند.
     *
     * Supports the following calendar conversion modes:
     * حالت‌های تبدیل تقویم زیر را پشتیبانی می‌کند:
     *
     * - g2j: Gregorian to Jalali
     *   تبدیل میلادی به شمسی
     *
     * - j2g: Jalali to Gregorian
     *   تبدیل شمسی به میلادی
     *
     * - g2g: Keeps the Gregorian date without conversion
     *   تاریخ میلادی را بدون تبدیل نگه می‌دارد
     *
     * @param string $date Date string in YYYY-MM-DD or YYYY/MM/DD format.
     *                     تاریخ در قالب YYYY-MM-DD یا YYYY/MM/DD.
     * @param string $separator Separator used in the returned date.
     *                           جداکننده مورد استفاده در تاریخ خروجی.
     * @param string $calendar Calendar conversion mode.
     *                         حالت تبدیل تقویم.
     *
     * @return string Converted date or an empty string if the input is invalid.
     *                تاریخ تبدیل‌شده یا در صورت نامعتبر بودن ورودی، رشته خالی.
     */
    public static function wooen_date(string $date ,string  $separator = '-' ,  string $calendar = 'g2g' ) : string
    {
        $date = str_replace(['/', '-'], '-', $date);
        $parts = explode('-', $date);
        $result_date = '';
        if (count($parts) !== 3) {
            return '';
        }

        $year = (int) $parts[0];
        $month =(int) $parts[1];
        $day = (int)  $parts[2];
       if ($calendar == 'g2j' ){
          switch ($separator) {
              case '-':
                  $result_date =  gregorian_to_jalali($year, $month, $day,'-');
                  return $result_date ;
              case '/':
                  $result_date = gregorian_to_jalali($year, $month, $day,'/');
                  return $result_date;
          }
       }elseif ($calendar == 'j2g') {
           switch ($separator) {
               case '-':
                   $result_date = jalali_to_gregorian($year, $month, $day, '-');
                   return $result_date;
               case '/':
                   $result_date = jalali_to_gregorian($year, $month, $day, '/');
                   return  $result_date;
           }
       }elseif ($calendar == 'g2g') {
           switch ($separator) {
               case '-':
                   $result_date = $year . '-' . $month . '-' . $day;;
                   return $result_date;
                   case '/':
                       $result_date = $year . '/' . $month . '/' . $day;
                     return $result_date;
           }
       }else{
           return '';
       }
       return $result_date;
    }

    /**
     * Generates a six-digit SMS verification code.
     * یک کد تأیید شش‌رقمی برای پیامک تولید می‌کند.
     *
     * @return string Generated six-digit verification code.
     *                کد تأیید شش‌رقمی تولیدشده.
     */
    Public static function wooen_create_verification_code(): string
    {
        $vc =  rand( '100000', '999999' );
        return (string) $vc;
    }


    /**
     * Generates a unique username based on the user's email address.
     * یک نام کاربری بر اساس آدرس ایمیل کاربر تولید می‌کند.
     *
     * The local part of the email address is combined with a random number.
     * بخش قبل از @ در ایمیل به همراه یک عدد تصادفی ترکیب می‌شود.
     *
     * @param string $email User email address.
     *                     آدرس ایمیل کاربر.
     *
     * @return string Generated username.
     *                نام کاربری تولیدشده.
     */
    public static function wooen_create_user_login(string $email ): string {
        return explode( '@', $email )[0] . rand( 1, 99 );
    }

    /**
     * Creates first name, last name, and display name from a full name.
     * نام، نام خانوادگی و نام نمایشی را از نام کامل ایجاد می‌کند.
     *
     * The first word is treated as the first name and the second word
     * is treated as the last name.
     * کلمه اول به عنوان نام و کلمه دوم به عنوان نام خانوادگی در نظر گرفته می‌شود.
     *
     * @param string $full_name User's full name.
     *                          نام کامل کاربر.
     *
     * @return array Array containing first name, last name, and display name.
     *               آرایه شامل نام، نام خانوادگی و نام نمایشی.
     */
    public static function wooen_create_display_name(string $full_name ): array {

        $display_name_parts = explode( ' ', $full_name );

        $first_name   = $display_name_parts[0] ?? '';
        $last_name    = $display_name_parts[1] ?? '';
        $display_name = trim( $first_name . ' ' . $last_name );

        return [
            'first_name'   => $first_name,
            'last_name'    => $last_name,
            'display_name' => $display_name
        ];
    }


    /**
     * Creates a password recovery URL containing a recovery token.
     * یک لینک بازیابی رمز عبور حاوی توکن بازیابی ایجاد می‌کند.
     *
     * The token is generated using the current date, the user's email,
     * and a random number.
     * توکن با استفاده از تاریخ فعلی، ایمیل کاربر و یک عدد تصادفی تولید می‌شود.
     *
     * @param string $email User email address.
     *                     آدرس ایمیل کاربر.
     *
     * @return string Password recovery URL.
     *                لینک بازیابی رمز عبور.
     */
    public static function wooen_create_token(string $email ): string {
        $token = date('Ymd') . md5( $email ) . rand( 10000000, 99999999 );
        $token_url = site_url('password-recovery') . '?recovery_token=' . $token;
        return $token_url;
    }

    /**
     * Generates a random password string.
     * یک رشته تصادفی برای استفاده به عنوان رمز عبور تولید می‌کند.
     *
     * The generated password contains alphabetic characters,
     * a random number, and one special character.
     * رمز عبور تولیدشده شامل حروف، یک عدد تصادفی و یک کاراکتر ویژه است.
     *
     * @return string Generated random password.
     *                رمز عبور تصادفی تولیدشده.
     */
    public static function wooen_generate_Random_String() : string {
        $charactersNumber = strlen(self::character);
        $charactersLength = strlen(self::character_s);
        $number_random = rand(1,999);
        $result = "";
        for ($i = 0; $i < self::length; $i++) {
            $result = $result . self::character[rand(0, $charactersNumber - 1)];
        }
        $result = $result . $number_random . self::character_s[rand(0, $charactersLength - 1)];
        return $result;
    }

    /**
     * Calculates the discount percentage between the regular price and sale price.
     * درصد تخفیف را بین قیمت اصلی و قیمت فروش محاسبه می‌کند.
     *
     * The calculated percentage is rounded up to the nearest integer.
     * درصد محاسبه‌شده به سمت بالا به نزدیک‌ترین عدد صحیح گرد می‌شود.
     *
     * @param float|int|string $regular_price The regular product price.
     *                                        قیمت اصلی محصول.
     * @param float|int|string $sale_price The sale product price.
     *                                     قیمت فروش محصول.
     *
     * @return float The calculated discount percentage.
     *               درصد تخفیف محاسبه‌شده.
     */
    public static function wooen_calculateDiscountPercentage(float|int|string $regular_price, float|int|string $sale_price): float
    {
        $regular = (float)$regular_price;
        $sale = (float)$sale_price;

        if ($regular <= 0 || $sale <= 0) {
            return 0.0;
        }
        if ($regular > $sale) {
            $discount = (($regular - $sale) / $regular) * 100;
            return ceil($discount);
        }
        return 0.0;
    }
    
    /**
     * Display the formatted price of a WooCommerce product.
     *
     * نمایش قیمت فرمت‌شده یک محصول ووکامرس.
     *
     * This method requires WooCommerce to be installed and active.
     * It handles variable, sale, and regular products.
     *
     * این متد برای اجرا نیازمند نصب و فعال بودن ووکامرس است
     * و محصولات متغیر، تخفیف‌خورده و عادی را مدیریت می‌کند.
     *
     * @param WC_Product $product                 WooCommerce product object.
     *                                             آبجکت محصول ووکامرس.
     * @param string     $new_price_class_html    CSS class for the current/sale price.
     *                                             کلاس CSS برای قیمت فعلی یا تخفیف‌خورده.
     * @param string     $old_price_class_html    CSS class for the regular/old price.
     *                                             کلاس CSS برای قیمت اصلی/قدیمی.
     *
     * @return void
     */
    public static function wooen_get_product_price(WC_Product $product ,string $new_price_class_html= '' ,string $old_price_class_html= ''): void
    {
        if ($product->is_type('variable')) {
            $min_price = $product->get_variation_price('min');
            $max_price = $product->get_variation_price('max');
            echo '<span class="'.esc_attr($new_price_class_html).'">' . wc_price($max_price) . '</span>';
            if ($min_price != $max_price) {
                echo '<span class="'.esc_attr($new_price_class_html).'">' . wc_price($max_price) . '</span>';
            }elseif($product->is_on_sale()){
                echo '<span class="'.esc_attr($new_price_class_html).'">' . wc_price($product->get_sale_price()) . '</span>';
                echo '<span class="'.esc_attr($old_price_class_html).'">' . wc_price($product->get_regular_price()) . '</span>';
            }else {
                echo '<span class="'.esc_attr($new_price_class_html).'">' . wc_price($product->get_price()) . '</span>';
            }
        }
    }


    /**
     * Display the out-of-stock label for a WooCommerce product.
     *
     * نمایش برچسب ناموجود برای یک محصول ووکامرس.
     *
     * This method requires WooCommerce to be installed and active.
     *
     * این متد برای اجرا نیازمند نصب و فعال بودن ووکامرس است.
     *
     * The label is displayed only when the product is out of stock.
     *
     * این برچسب فقط زمانی نمایش داده می‌شود که محصول ناموجود باشد.
     *
     * @param WC_Product $product                  WooCommerce product object.
     *                                              آبجکت محصول ووکامرس.
     * @param string     $product_stock_class_html CSS class for the stock label.
     *                                              کلاس CSS برای برچسب وضعیت موجودی.
     *
     * @return void
     */
    public static function wooen_get_product_stock_label(WC_Product $product ,string $product_stock_class_html = ''): void
    {
        if (!$product->is_in_stock()) {
            echo '<span class="'.esc_attr($product_stock_class_html).'">'.'ناموجود'.'</span>';
         }

    }
    
    /**
     * Display the appropriate discount label for a WooCommerce product.
     *
     * نمایش برچسب مناسب تخفیف برای یک محصول ووکامرس.
     *
     * If the product has a valid discount percentage, the calculated
     * discount percentage is displayed. Otherwise, if the product is
     * on sale, the "فروش ویژه" label is displayed.
     *
     * اگر محصول دارای درصد تخفیف معتبر باشد، درصد تخفیف محاسبه‌شده
     * نمایش داده می‌شود. در غیر این صورت، اگر محصول در حالت فروش ویژه
     * باشد، برچسب «فروش ویژه» نمایش داده می‌شود.
     *
     * This method requires WooCommerce to be installed and active.
     *
     * این متد برای اجرا نیازمند نصب و فعال بودن ووکامرس است.
     *
     * @param WC_Product $product
     *        WooCommerce product object.
     *        آبجکت محصول ووکامرس.
     *
     * @param string $product_label_class_html
     *        CSS class for the discount percentage label.
     *        کلاس CSS برای برچسب درصد تخفیف.
     *
     * @param string $product__class_html
     *        CSS class for the special-sale label.
     *        کلاس CSS برای برچسب فروش ویژه.
     *
     * @return void
     */
    public static function wooen_get_product_discount_label(WC_Product $product , string $product_label_class_html= '' ,string $product__class_html=''): void
    {
        $discount_percentage = Utility::wooen_calculateDiscountPercentage($product->get_regular_price(),$product->get_sale_price());
        if ($discount_percentage > 0) {
            echo '<span class="'.esc_attr($product_label_class_html).'">'. 'تخفیف' .  Utility::wooen_calculateDiscountPercentage($product->get_regular_price(),$product->get_sale_price()). '%' .'</span>';
        }elseif($product->is_on_sale()){
            echo '<span class="'.esc_attr($product__class_html).'">فروش ویژه</span>';
        }
    }

}
