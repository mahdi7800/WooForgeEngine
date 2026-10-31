<?php $locale = get_locale();
if ($locale === 'fa_IR') : ?>
    <div class="uk-container uk-container-small uk-margin-top">
        <div class="uk-card uk-card-default uk-card-body uk-border-rounded uk-box-shadow-medium">

            <!-- لوگو و عنوان قالب -->
            <div class="uk-grid-medium uk-flex-middle" uk-grid>
                <div class="uk-width-auto">
                    <img src="<?php echo WOOEN_PLUGIN_URL . '/assets/admin/img/WooForgeEngine-Logo.webp' ?>"
                         alt="Logo-plugin-WooForgeEngine" width="100" class="uk-border-circle uk-box-shadow-small"
                         style="border-radius: 20%;">
                </div>
                <div class="uk-width-expand">
                    <h1 class="uk-card-title uk-margin-remove-bottom">WooForgeEngine</h1>
                    <p class="uk-text-muted uk-margin-remove-top">
                        افزونه وردپرس برای توسعه و مدیریت امکانات پیشرفته با پشتیبانی از ووکامرس
                    </p>
                </div>
            </div>

            <!-- توضیح درباره پلاگین -->
            <div class="uk-margin-top">
                <p>
                    این افزونه با هدف توسعه و مدیریت قابلیت‌های پیشرفته در وب‌سایت‌های وردپرسی طراحی شده است.
                    امکاناتی همچون سیستم احراز هویت و مدیریت کاربران، خبرنامه، علاقه‌مندی‌ها،
                    مدیریت اسلایدر و بنر، سیستم نظرات، ارسال ایمیل و پیامک و ابزارهای مدیریتی
                    را در اختیار توسعه‌دهندگان قرار می‌دهد. همچنین این افزونه با ساختاری
                    ماژولار و شی‌گرا طراحی شده تا قابلیت‌های مختلف را مستقل از قالب وردپرس
                    مدیریت و توسعه دهد.
                </p>
            </div>


            <!-- آیکون‌های شبکه‌های اجتماعی -->
            <div class="uk-margin-top uk-text-center">
                <a href="https://x.com/d_mahdi47?s=21&t=pX4cCB5VPUGyO1KmoExvuQ" target="_blank"
                   class="uk-icon-button uk-margin-small-right" uk-icon="twitter"></a>
                <a href="https://www.instagram.com/d_mahdi47?igsh=MWd5aDRldDV3ZWhtZQ%3D%3D&utm_source=qr"
                   target="_blank" class="uk-icon-button uk-margin-small-right" uk-icon="instagram"></a>
                <a href="https://github.com/mahdi7800" target="_blank" class="uk-icon-button uk-margin-small-right"
                   uk-icon="github"></a>
                <a href="https://www.linkedin.com/in/mahdi-davoudi-b3754a1b4" target="_blank"
                   class="uk-icon-button uk-margin-small-right" uk-icon="linkedin"></a>
                <a href="mailto:mdavoudi47@shanulwp.ir" target="_blank" class="uk-icon-button uk-margin-small-right"
                   uk-icon="mail"></a>
                <a href="https://shanulwp.ir/" target="_blank" class="uk-icon-button uk-margin-small-right"
                   uk-icon="world"></a>
            </div>

            <div class="uk-margin-large-top">

                <!-- Appreciation Alert -->
                <div class="uk-alert-primary uk-border-rounded uk-padding" uk-alert>
                    <a class="uk-alert-close" uk-close></a>

                    <h4 class="uk-margin-remove-bottom">
                        سپاس و قدردانی
                    </h4>

                    <hr class="uk-divider-small">

                    <p class="uk-text-small uk-margin-remove-bottom">
                        افزونه <strong>WooForgeEngine</strong> توسط
                        <a href="https://shanulwp.ir"
                           class="uk-text-bold"
                           target="_blank"
                           rel="noopener noreferrer">
                            شرکت مهندسی شانول وردپرس
                        </a>
                        توسعه داده شده است.
                        از تمامی کاربران و توسعه‌دهندگانی که از این پروژه استفاده می‌کنند،
                        صمیمانه سپاس‌گزاریم.
                    </p>
                </div>

                <!-- Donation Section -->
                <div class="uk-card uk-card-secondary uk-card-body uk-border-rounded uk-text-center uk-margin-medium-top">

                    <h3 class="uk-card-title uk-margin-small-bottom">
                        حمایت از توسعه پروژه
                    </h3>

                    <p class="uk-text-small">
                        در صورت رضایت از این پروژه، می‌توانید با حمایت مالی خود
                        ما را در ادامه توسعه و بهبود WooForgeEngine همراهی کنید.
                        حمایت شما انگیزه‌ای برای توسعه امکانات بیشتر و ارائه
                        پروژه‌های باکیفیت‌تر خواهد بود.
                    </p>

                    <a href="https://daramet.com/d_mahdi47?webintent&donate=400000&message=thanks"
                       class="uk-button uk-button-danger uk-border-rounded"
                       target="_blank"
                       rel="noopener noreferrer">
                        حمایت از ما ☕
                    </a>

                </div>

            </div>

            <!-- لیست امکانات قالب -->
            <div class="uk-margin-large-top">
                <h3 class="uk-heading-divider">امکانات کلیدی افزونه</h3>

                <ul class="uk-list uk-list-bullet">
                    <li>معماری شی‌گرا و ماژولار برای توسعه و مدیریت قابلیت‌ها</li>
                    <li>سیستم ثبت‌نام، ورود و احراز هویت کاربران</li>
                    <li>سیستم بازیابی رمز عبور و تأیید شماره موبایل با کد یکبار مصرف (OTP)</li>
                    <li>پشتیبانی از سرویس‌های ارسال پیامک</li>
                    <li>سیستم خبرنامه اختصاصی با قابلیت مدیریت مشترکین</li>
                    <li>ارسال ایمیل‌های اطلاع‌رسانی و خبرنامه</li>
                    <li>سیستم علاقه‌مندی محصولات (Wishlist)</li>
                    <li>مدیریت اسلایدرها و بنرهای وب‌سایت</li>
                    <li>سیستم پرسش و پاسخ (FAQ) و مدیریت سؤالات متداول</li>
                    <li>سیستم اعلان‌ها و اطلاع‌رسانی</li>
                    <li>پشتیبانی از کتابخانه JDF برای مدیریت و تبدیل تاریخ‌های شمسی</li>
                    <li>ابزارهای کاربردی اختصاصی برای محصولات WooCommerce</li>
                    <li>پشتیبانی از درخواست‌های Ajax</li>
                    <li>ابزارهای امنیتی و اعتبارسنجی درخواست‌ها</li>
                </ul>
            </div>
            <!-- ناحیه راهنمای تنظیمات مهم -->

            <div class="uk-margin-large-top">

                <h4 class="uk-heading-line">
                    <span>راهنمای پیاده‌سازی و استفاده از قابلیت‌های افزونه</span>
                </h4>

                <ul class="uk-list uk-list-divider uk-text-small">

                    <li>
                        <strong>1. راه‌اندازی سیستم خبرنامه:</strong>
                        برای استفاده از خبرنامه، فرم HTML خود را با شناسه
                        <code>wooen-plugin-newsletter</code>
                        ایجاد کنید. فیلد ایمیل باید شناسه
                        <code>wooen-input-email-newsletter</code>
                        و دکمه ارسال باید شناسه
                        <code>btn_newsletter</code>
                        داشته باشد.
                    </li>

                    <li>
                        <strong>2. راه‌اندازی فرم تماس با ما:</strong>
                        فرم تماس را با شناسه
                        <code>wooen-plugin-contact-us</code>
                        ایجاد کنید. فیلدهای ایمیل، نام، شماره تماس، موضوع و پیام باید به‌ترتیب از کلاس‌های
                        <code>wooen-input-email-contact-us</code>،
                        <code>wooen-input-name-contact-us</code>،
                        <code>wooen-input-phone-contact-us</code>،
                        <code>wooen-input-subject-contact-us</code>
                        و
                        <code>wooen-input-message-contact-us</code>
                        استفاده کنند.
                        دکمه ارسال نیز به شناسه <code>wooen-btn-contact-us</code> نیاز دارد.
                    </li>

                    <li>
                        <strong>3. راه‌اندازی سیستم ورود کاربران:</strong>
                        فرم ورود باید شناسه <code>wooen-singnin-form</code> داشته باشد.
                        فیلد نام کاربری یا ایمیل از کلاس
                        <code>wooen-input-email-or-username</code>
                        و فیلد رمز عبور از کلاس
                        <code>wooen-input-password</code>
                        استفاده می‌کند. برای گزینه مرا به خاطر بسپار نیز شناسه
                        <code>StaySignedIn</code>
                        در نظر گرفته شده است.
                    </li>

                    <li>
                        <strong>4. راه‌اندازی سیستم ثبت‌نام کاربران:</strong>
                        فرم ثبت‌نام باید شناسه <code>wooen-signup-form</code> داشته باشد.
                        فیلدهای نام کامل، ایمیل و رمز عبور باید به‌ترتیب از کلاس‌های
                        <code>input-fullName-signup-form</code>،
                        <code>input-email-signup-form</code>
                        و
                        <code>input-password-signup-form</code>
                        استفاده کنند.
                    </li>

                    <li>
                        <strong>5. تأیید شماره موبایل با کد یکبار مصرف (OTP):</strong>
                        برای ارسال کد تأیید، فرم شماره موبایل باید شناسه
                        <code>wooen-send-code-form</code>
                        داشته باشد. فرم بررسی کد نیز باید شناسه
                        <code>wooen-verify-code-form</code>
                        و فیلد کد تأیید کلاس
                        <code>input-verify-code-signup-form</code>
                        داشته باشد.
                        شماره موبایل تأییدشده نیز از طریق فیلد مخفی با کلاس
                        <code>input-phone_number-signup_form_hidden</code>
                        به فرم ثبت‌نام منتقل می‌شود.
                    </li>

                    <li>
                        <strong>6. راه‌اندازی بازیابی رمز عبور:</strong>
                        فرم بازیابی رمز عبور باید شناسه
                        <code>wooen-password-recovery-form</code>
                        و فیلد ایمیل آن کلاس
                        <code>wooen-input-email-password-recovery</code>
                        داشته باشد.
                    </li>

                    <li>
                        <strong>7. راه‌اندازی تغییر رمز عبور:</strong>
                        فرم تغییر رمز عبور باید شناسه
                        <code>wooen-change-password-form</code>
                        داشته باشد. فیلدهای رمز عبور جدید و تکرار آن باید از کلاس‌های
                        <code>wooen-input-new-password</code>
                        و
                        <code>wooen-input-confirm-password</code>
                        استفاده کنند.
                    </li>

                    <li>
                        <strong>8. تولید رمز عبور تصادفی:</strong>
                        برای استفاده از قابلیت تولید رمز عبور، یک دکمه با شناسه
                        <code>generatePasswordBtn</code>
                        ایجاد کنید. رمز تولیدشده در فیلدی با کلاس
                        <code>password-register</code>
                        قرار می‌گیرد.
                    </li>

                    <li>
                        <strong>9. سیستم علاقه‌مندی محصولات (Wishlist):</strong>
                        برای فعال‌سازی این قابلیت، دکمه علاقه‌مندی باید کلاس
                        <code>bookmark-product</code>
                        داشته باشد و شناسه محصول را در ویژگی
                        <code>data-pid</code>
                        قرار دهید.
                    </li>

                    <li>
                        <strong>10. سیستم نشان‌گذاری مطالب (Bookmark):</strong>
                        برای ثبت مطالب موردعلاقه کاربران، عنصر موردنظر باید شناسه
                        <code>bookmark-post</code>
                        داشته باشد. شناسه مطلب و کاربر نیز از طریق ویژگی‌های
                        <code>data-post-id</code>
                        و
                        <code>data-user-id</code>
                        ارسال می‌شوند.
                    </li>

                    <li>
                        <strong>11. نمایش پیام‌های اطلاع‌رسانی:</strong>
                        پاسخ درخواست‌های Ajax با استفاده از کتابخانه Toast نمایش داده می‌شود.
                        بنابراین ساختار پیام‌های موفقیت و خطا توسط افزونه مدیریت می‌شود.
                    </li>

                    <li>
                        <strong>12. دریافت اطلاعات FAQ:</strong>
                        با استفاده از متد
                        <code>wooen_get_faq_to_front()</code>
                        می‌توانید اطلاعات سؤالات متداول ذخیره‌شده در پنل مدیریت را
                        به‌صورت آرایه دریافت کرده و در بخش Front-end نمایش دهید.
                    </li>

                    <li>
                        <strong>13. دریافت اطلاعات اسلایدر:</strong>
                        با استفاده از متد
                        <code>wooen_get_slider_to_front()</code>
                        می‌توانید اطلاعات اسلایدرهای ثبت‌شده در پنل مدیریت را
                        به‌صورت آرایه دریافت کرده و در قالب نمایش دهید.
                    </li>

                    <li>
                        <strong>14. دریافت اطلاعات بنرها:</strong>
                        با استفاده از متد
                        <code>wooen_get_banner_to_front()</code>
                        می‌توانید اطلاعات بنرهای ثبت‌شده در پنل مدیریت را
                        به‌صورت آرایه دریافت کرده و در بخش Front-end استفاده کنید.
                    </li>

                    <li>
                        <strong>15. دریافت محصولات لیست علاقه‌مندی کاربر:</strong>
                        با استفاده از متد
                        <code>wooen_get_user_wishlist()</code>
                        می‌توانید فهرست محصولات موجود در لیست علاقه‌مندی کاربر واردشده را
                        به‌صورت آرایه دریافت کرده و در بخش Front-end نمایش دهید.
                        در صورتی که کاربر وارد حساب کاربری خود نشده باشد، به صفحه اصلی
                        سایت هدایت می‌شود.
                    </li>

                    <li>
                        <strong>16. دریافت تعداد محصولات لیست علاقه‌مندی:</strong>
                        با استفاده از متد
                        <code>wooen_get_user_count_wishlist()</code>
                        می‌توانید تعداد محصولات موجود در لیست علاقه‌مندی کاربر فعلی را
                        دریافت کنید. خروجی این متد از نوع عدد صحیح (<code>int</code>) است.
                        در صورتی که کاربر وارد حساب کاربری نشده باشد، مقدار صفر برگردانده می‌شود.
                    </li>
                    <li>
                        <strong>17. تبدیل فرمت تاریخ و تقویم:</strong>
                        با استفاده از متد
                        <code>wooen_date()</code>
                        می‌توانید تاریخ میلادی و شمسی را به یکدیگر تبدیل کنید یا فرمت نمایش
                        تاریخ میلادی را تغییر دهید. این متد سه پارامتر دریافت می‌کند:
                        تاریخ ورودی، جداکننده تاریخ (<code>-</code> یا <code>/</code>)
                        و نوع تبدیل تقویم.
                        مقادیر قابل استفاده برای نوع تقویم عبارت‌اند از:
                        <code>g2j</code> برای تبدیل میلادی به شمسی،
                        <code>j2g</code> برای تبدیل شمسی به میلادی و
                        <code>g2g</code> برای نمایش تاریخ میلادی با فرمت دلخواه.
                    </li>

                    <li>
                        <strong>18. نمایش زمان نسبی:</strong>
                        با استفاده از متد
                        <code>wooen_get_time_ago()</code>
                        می‌توانید زمان سپری‌شده از تاریخ ثبت یک رویداد را به‌صورت نسبی نمایش دهید.
                        این متد تاریخ را با فرمت
                        <code>Y-m-d H:i:s</code>
                        دریافت می‌کند و بر اساس تنظیمات تقویم، خروجی را به زبان فارسی
                        (<code>g2j</code>) یا انگلیسی (<code>g2g</code>) برمی‌گرداند.
                        برای مثال، خروجی می‌تواند به شکل «۳ ساعت پیش» یا
                        «3 hours ago» باشد.
                    </li>
                    <li>
                        <strong>19. محاسبه درصد تخفیف محصول:</strong>
                        با استفاده از متد
                        <code>wooen_calculateDiscountPercentage()</code>
                        می‌توانید درصد تخفیف محصول را بر اساس قیمت اصلی و قیمت فروش محاسبه کنید.
                        این متد قیمت اصلی و قیمت تخفیف‌خورده را دریافت کرده و درصد تخفیف
                        را به‌صورت عددی از نوع <code>float</code> برمی‌گرداند.
                        در صورتی که قیمت‌ها معتبر نباشند یا تخفیفی وجود نداشته باشد،
                        مقدار صفر برگردانده می‌شود.
                    </li>

                    <li>
                        <strong>20. نمایش قیمت محصول WooCommerce:</strong>
                        با استفاده از متد
                        <code>wooen_get_product_price()</code>
                        می‌توانید قیمت محصولات عادی، تخفیف‌خورده و متغیر را در قالب نمایش دهید.
                        این متد آبجکت محصول WooCommerce را دریافت می‌کند و امکان تعیین
                        کلاس CSS برای قیمت فعلی و قیمت اصلی را فراهم می‌سازد.
                        خروجی قیمت به‌صورت HTML چاپ می‌شود.
                    </li>

                    <li>
                        <strong>21. نمایش وضعیت موجودی محصول:</strong>
                        با استفاده از متد
                        <code>wooen_get_product_stock_label()</code>
                        می‌توانید وضعیت ناموجود بودن محصول را بررسی و برچسب «ناموجود» را
                        در بخش Front-end نمایش دهید.
                        این متد آبجکت محصول و کلاس CSS موردنظر برای برچسب را دریافت می‌کند.
                        برچسب فقط زمانی نمایش داده می‌شود که محصول موجود نباشد.
                    </li>

                    <li>
                        <strong>22. نمایش برچسب تخفیف محصول:</strong>
                        با استفاده از متد
                        <code>wooen_get_product_discount_label()</code>
                        می‌توانید برچسب تخفیف محصولات را در قالب نمایش دهید.
                        این متد ابتدا درصد تخفیف محصول را محاسبه می‌کند و در صورت وجود
                        تخفیف معتبر، درصد آن را نمایش می‌دهد.
                        در غیر این صورت، اگر محصول در وضعیت فروش ویژه باشد،
                        برچسب «فروش ویژه» نمایش داده می‌شود.
                        همچنین می‌توانید کلاس CSS جداگانه‌ای برای هر نوع برچسب تعیین کنید.
                    </li>
                </ul>

            </div>
        </div>
    </div>
<?php else : ?>
    <div class="uk-container uk-container-small uk-margin-top">
        <div class="uk-card uk-card-default uk-card-body uk-border-rounded uk-box-shadow-medium">

            <!-- لوگو و عنوان قالب -->
            <div class="uk-grid-medium uk-flex-middle" uk-grid>
                <div class="uk-width-auto">
                    <img src="<?php echo WOOEN_PLUGIN_URL . '/assets/admin/img/WooForgeEngine-Logo.webp' ?>"
                         alt="Logo-plugin-WooForgeEngine" width="100" class="uk-border-circle uk-box-shadow-small"
                         style="border-radius: 20%;">
                </div>
                <div class="uk-width-expand">
                    <h1 class="uk-card-title uk-margin-remove-bottom">WooForgeEngine</h1>
                    <p class="uk-text-muted uk-margin-remove-top">
                        WordPress plugin for advanced functionality and WooCommerce integration
                    </p>
                </div>
            </div>

            <!-- توضیح درباره قالب -->
            <div class="uk-margin-top">
                <p>
                    This plugin is designed to develop and manage advanced functionality
                    for WordPress websites. It provides features such as user authentication
                    and management, newsletter subscriptions, wishlists, slider and banner
                    management, comment systems, email and SMS notifications, and various
                    administrative tools. It also follows a modular and object-oriented
                    architecture, allowing developers to manage and extend features
                    independently of the WordPress theme.
                </p>
            </div>


            <!-- آیکون‌های شبکه‌های اجتماعی -->
            <div class="uk-margin-top uk-text-center">
                <a href="https://x.com/d_mahdi47?s=21&t=pX4cCB5VPUGyO1KmoExvuQ" target="_blank"
                   class="uk-icon-button uk-margin-small-right" uk-icon="twitter"></a>
                <a href="https://www.instagram.com/d_mahdi47?igsh=MWd5aDRldDV3ZWhtZQ%3D%3D&utm_source=qr"
                   target="_blank" class="uk-icon-button uk-margin-small-right" uk-icon="instagram"></a>
                <a href="https://github.com/mahdi7800" target="_blank" class="uk-icon-button uk-margin-small-right"
                   uk-icon="github"></a>
                <a href="https://www.linkedin.com/in/mahdi-davoudi-b3754a1b4" target="_blank"
                   class="uk-icon-button uk-margin-small-right" uk-icon="linkedin"></a>
                <a href="mailto:mdavoudi47@shanulwp.ir" target="_blank" class="uk-icon-button uk-margin-small-right"
                   uk-icon="mail"></a>
                <a href="https://shanulwp.ir/" target="_blank" class="uk-icon-button uk-margin-small-right"
                   uk-icon="world"></a>
            </div>

            <div class="uk-margin-large-top">

                <!-- Appreciation Alert -->
                <div class="uk-alert-primary uk-border-rounded uk-padding" uk-alert>
                    <a class="uk-alert-close" uk-close></a>

                    <h4 class="uk-margin-remove-bottom">
                        Acknowledgements
                    </h4>

                    <hr class="uk-divider-small">

                    <p class="uk-text-small uk-margin-remove-bottom">
                        <strong>WooForgeEngine</strong> is developed by
                        <a href="https://shanulwp.ir"
                           class="uk-text-bold"
                           target="_blank"
                           rel="noopener noreferrer">
                            Shanul WordPress Engineering Group
                        </a>.
                        We sincerely appreciate all users and developers
                        who use and support this project.
                    </p>
                </div>

                <!-- Donation Section -->
                <div class="uk-card uk-card-secondary uk-card-body uk-border-rounded uk-text-center uk-margin-medium-top">

                    <h3 class="uk-card-title uk-margin-small-bottom">
                        Support Project Development
                    </h3>

                    <p class="uk-text-small">
                        If you find this project useful, you can support us
                        with a small donation to help continue developing
                        and improving WooForgeEngine.
                        Your support motivates us to build more features
                        and deliver higher-quality projects.
                    </p>

                    <a href="https://daramet.com/d_mahdi47?webintent&donate=600000&message=thanks"
                       class="uk-button uk-button-danger uk-border-rounded"
                       target="_blank"
                       rel="noopener noreferrer">
                        Support Us ☕
                    </a>

                </div>

            </div>


            <!-- لیست امکانات قالب -->
            <div class="uk-margin-large-top">
                <h3 class="uk-heading-divider">Key Plugin Features</h3>

                <ul class="uk-list uk-list-bullet">
                    <li>Object-oriented and modular architecture</li>
                    <li>User registration, login, and authentication system</li>
                    <li>Password recovery and mobile verification using One-Time Passwords (OTP)</li>
                    <li>SMS gateway integration</li>
                    <li>Custom newsletter system with subscriber management</li>
                    <li>Email notifications and newsletter delivery</li>
                    <li>Product wishlist system</li>
                    <li>Website slider and banner management</li>
                    <li>FAQ system for managing frequently asked questions</li>
                    <li>Notification and alert management system</li>
                    <li>JDF library integration for Persian (Jalali) date conversion and management</li>
                    <li>Custom utility functions for WooCommerce products</li>
                    <li>Ajax request support</li>
                </ul>
            </div>
            <!-- ناحیه راهنمای تنظیمات مهم -->

            <div class="uk-margin-large-top">

                <h4 class="uk-heading-line">
                    <span>Implementation and Usage Guide</span>
                </h4>

                <ul class="uk-list uk-list-divider uk-text-small">

                    <li>
                        <strong>1. Newsletter System Setup:</strong>
                        To use the newsletter feature, create an HTML form with the ID
                        <code>wooen-plugin-newsletter</code>.
                        The email input field must have the ID
                        <code>wooen-input-email-newsletter</code>,
                        and the submit button must have the ID
                        <code>btn_newsletter</code>.
                    </li>

                    <li>
                        <strong>2. Contact Form Setup:</strong>
                        Create the contact form with the ID
                        <code>wooen-plugin-contact-us</code>.
                        The email, name, phone number, subject, and message fields must use the following CSS classes, respectively:
                        <code>wooen-input-email-contact-us</code>,
                        <code>wooen-input-name-contact-us</code>,
                        <code>wooen-input-phone-contact-us</code>,
                        <code>wooen-input-subject-contact-us</code>,
                        and
                        <code>wooen-input-message-contact-us</code>.
                        The submit button must have the ID
                        <code>wooen-btn-contact-us</code>.
                    </li>

                    <li>
                        <strong>3. User Login System Setup:</strong>
                        The login form must have the ID
                        <code>wooen-singnin-form</code>.
                        The username or email field must use the CSS class
                        <code>wooen-input-email-or-username</code>,
                        and the password field must use
                        <code>wooen-input-password</code>.
                        The Remember Me option must have the ID
                        <code>StaySignedIn</code>.
                    </li>

                    <li>
                        <strong>4. User Registration System Setup:</strong>
                        The registration form must have the ID
                        <code>wooen-signup-form</code>.
                        The full name, email, and password fields must use the following CSS classes, respectively:
                        <code>input-fullName-signup-form</code>,
                        <code>input-email-signup-form</code>,
                        and
                        <code>input-password-signup-form</code>.
                    </li>

                    <li>
                        <strong>5. Mobile Number Verification Using OTP:</strong>
                        To send a verification code, the phone number form must have the ID
                        <code>wooen-send-code-form</code>.
                        The code verification form must have the ID
                        <code>wooen-verify-code-form</code>,
                        and the verification code input field must use the CSS class
                        <code>input-verify-code-signup-form</code>.
                        The verified phone number is transferred to the registration form through a hidden field using the CSS class
                        <code>input-phone_number-signup_form_hidden</code>.
                    </li>

                    <li>
                        <strong>6. Password Recovery Setup:</strong>
                        The password recovery form must have the ID
                        <code>wooen-password-recovery-form</code>,
                        and its email input field must use the CSS class
                        <code>wooen-input-email-password-recovery</code>.
                    </li>

                    <li>
                        <strong>7. Password Change Setup:</strong>
                        The password change form must have the ID
                        <code>wooen-change-password-form</code>.
                        The new password and password confirmation fields must use the following CSS classes:
                        <code>wooen-input-new-password</code>
                        and
                        <code>wooen-input-confirm-password</code>.
                    </li>

                    <li>
                        <strong>8. Random Password Generation:</strong>
                        To use the password generation feature, create a button with the ID
                        <code>generatePasswordBtn</code>.
                        The generated password will be placed in an input field using the CSS class
                        <code>password-register</code>.
                    </li>

                    <li>
                        <strong>9. Product Wishlist System:</strong>
                        To enable this feature, the wishlist button must use the CSS class
                        <code>bookmark-product</code>,
                        and the product ID must be provided through the
                        <code>data-pid</code>
                        attribute.
                    </li>

                    <li>
                        <strong>10. Post Bookmark System:</strong>
                        To allow users to bookmark their favorite posts, the target element must have the ID
                        <code>bookmark-post</code>.
                        The post ID and user ID are passed through the following attributes:
                        <code>data-post-id</code>
                        and
                        <code>data-user-id</code>.
                    </li>

                    <li>
                        <strong>11. Displaying Notification Messages:</strong>
                        Ajax responses are displayed using the Toast library.
                        Therefore, the plugin handles the display of success and error messages.
                    </li>

                    <li>
                        <strong>12. Retrieving FAQ Data:</strong>
                        Use the
                        <code>wooen_get_faq_to_front()</code>
                        method to retrieve FAQ data saved in the admin panel as an array and display it on the front end.
                    </li>

                    <li>
                        <strong>13. Retrieving Slider Data:</strong>
                        Use the
                        <code>wooen_get_slider_to_front()</code>
                        method to retrieve slider data registered in the admin panel as an array and display it in your theme.
                    </li>

                    <li>
                        <strong>14. Retrieving Banner Data:</strong>
                        Use the
                        <code>wooen_get_banner_to_front()</code>
                        method to retrieve banner data registered in the admin panel as an array and use it on the front end.
                    </li>

                    <li>
                        <strong>15. Retrieving the Current User's Wishlist Products:</strong>
                        Use the
                        <code>wooen_get_user_wishlist()</code>
                        method to retrieve the list of products in the currently logged-in user's wishlist as an array and display them on the front end.
                        If the user is not logged in, they will be redirected to the website's homepage.
                    </li>

                    <li>
                        <strong>16. Retrieving the Number of Wishlist Products:</strong>
                        Use the
                        <code>wooen_get_user_count_wishlist()</code>
                        method to retrieve the number of products in the current user's wishlist.
                        This method returns an integer (<code>int</code>).
                        If the user is not logged in, the method returns zero.
                    </li>

                    <li>
                        <strong>17. Date and Calendar Conversion:</strong>
                        Use the
                        <code>wooen_date()</code>
                        method to convert Gregorian dates to Jalali dates and vice versa, or to change the display format of a Gregorian date.
                        This method accepts three parameters:
                        the input date, the date separator (<code>-</code> or <code>/</code>), and the calendar conversion type.
                        The available calendar conversion options are:
                        <code>g2j</code> for Gregorian-to-Jalali conversion,
                        <code>j2g</code> for Jalali-to-Gregorian conversion, and
                        <code>g2g</code> for displaying a Gregorian date with the specified format.
                    </li>

                    <li>
                        <strong>18. Relative Time Display:</strong>
                        Use the
                        <code>wooen_get_time_ago()</code>
                        method to display the elapsed time since an event occurred in a human-readable relative format.
                        This method accepts a date in the
                        <code>Y-m-d H:i:s</code>
                        format and returns the result in Persian
                        (<code>g2j</code>) or English
                        (<code>g2g</code>), depending on the selected calendar mode.
                        For example, the output can be displayed as "3 hours ago" or "3 days ago".
                    </li>

                    <li>
                        <strong>19. Calculate Product Discount Percentage:</strong>
                        Use the
                        <code>wooen_calculateDiscountPercentage()</code>
                        method to calculate the product discount percentage based on its regular price and sale price.
                        This method accepts the regular price and sale price as parameters and returns the calculated discount percentage as a <code>float</code>.
                        If the prices are invalid or no discount is available, the method returns zero.
                    </li>

                    <li>
                        <strong>20. Display WooCommerce Product Price:</strong>
                        Use the
                        <code>wooen_get_product_price()</code>
                        method to display the prices of regular, sale, and variable products in your theme.
                        This method accepts a WooCommerce product object and allows you to specify CSS classes for the current price and regular price.
                        The formatted price is directly output as HTML.
                    </li>

                    <li>
                        <strong>21. Display Product Stock Status:</strong>
                        Use the
                        <code>wooen_get_product_stock_label()</code>
                        method to check whether a product is out of stock and display an "Out of Stock" label on the front end.
                        This method accepts a WooCommerce product object and a CSS class for the stock status label.
                        The label is displayed only when the product is out of stock.
                    </li>

                    <li>
                        <strong>22. Display Product Discount Label:</strong>
                        Use the
                        <code>wooen_get_product_discount_label()</code>
                        method to display discount labels for WooCommerce products.
                        This method first calculates the product's discount percentage.
                        If a valid discount percentage is available, it displays the discount percentage.
                        Otherwise, if the product is on sale, it displays a "Special Offer" label.
                        You can also specify separate CSS classes for each type of label.
                    </li>

                </ul>

            </div>

        </div>
    </div>
<?php endif; ?>
