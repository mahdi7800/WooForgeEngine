# WooForge Engine

<p align="center">
  <img src="WooForgeEngine-Logo.webp" alt="WooForge Engine Logo" width="220">
</p>

<p align="center">
  **A Modular WordPress Plugin for Modern Website Functionality**
</p>

<p align="center">
  <a href="https://wordpress.org/">
    <img src="https://img.shields.io/badge/WordPress-Plugin-21759B?logo=wordpress&logoColor=white" alt="WordPress Plugin">
  </a>
  <img src="https://img.shields.io/badge/PHP-8.0%2B-777BB4?logo=php&logoColor=white" alt="PHP 8.0+">
  <img src="https://img.shields.io/badge/Architecture-OOP-555555" alt="OOP">
  <img src="https://img.shields.io/badge/License-GPL--2.0--or--later-blue" alt="GPL License">
</p>

<p align="center">
  <a href="#english">English</a> |
  <a href="#فارسی">فارسی</a>
</p>

---

# English

## Overview

**WooForge Engine** is a modular, object-oriented WordPress plugin designed to provide reusable functionality for custom WordPress themes and websites.

It brings together user authentication, AJAX-powered features, website management tools, communication features, and WooCommerce-related utilities in one organized plugin.

WooForge Engine focuses on functionality rather than presentation. Your theme remains responsible for HTML structure, CSS styling, and the user interface, while the plugin handles the underlying logic and interactions.

## Features

### 1. User Management
- User login with email or username
- User registration
- Password recovery and password changes
- Random password generation
- SMS verification codes
- Optional phone-number registration

### 2. AJAX & Communication
- AJAX-powered form submissions
- Contact form functionality
- Newsletter subscriptions
- New post email notifications
- Custom AJAX response messages

### 3. Website Management
- Banner management
- Slider management
- FAQ management
- Admin settings
- Dashboard widgets and notifications

### 4. WooCommerce Integration
- Product wishlist
- Product discount calculations
- Custom product price output
- Product stock labels
- Product discount labels

### 5. Additional Utilities
- Post bookmarking
- Persian and Gregorian date support
- Relative time formatting
- SMTP configuration
- SMS gateway integration

## Architecture

WooForge Engine follows an object-oriented and modular architecture.

Each feature is organized into separate classes and components to make the code easier to maintain, reuse, and extend.

```text
WooForgeEngine/
│
├── _inc/
│   ├── function/
│   ├── meta-box/
│   ├── setting/
│   ├── theme-setup/
│   └── widget/
│
├── assets/
│   ├── admin/
│   └── front/
│
├── class/
├── helper/
├── lib/
├── trait/
├── utility/
├── view/
│   ├── admin/
│   └── front/
│
├── AutoLoadWooForgeEngine.php
└── CoreWooForgeEngine.php
```

## Requirements

| Requirement | Version |
|---|---|
| PHP | 8.0 or higher |
| WordPress | WordPress installation |
| WooCommerce | Required for WooCommerce-specific features |

**Note:** WooCommerce is not required for the plugin's general WordPress functionality. It is only needed when using WooCommerce-specific features.

## Installation

1. Download or clone this repository.
2. Locate the plugin directory containing `CoreWooForgeEngine.php`.
3. Place that directory inside `wp-content/plugins/`.
4. Open your WordPress dashboard.
5. Navigate to **Plugins**.
6. Activate **WooForge Engine**.

## Theme Integration

WooForge Engine is designed to work alongside custom WordPress themes.

Your theme controls the markup and styling, while the plugin provides the functionality and interactions.

For example, a theme can provide a newsletter form using the following selectors:

| Element | Selector |
|---|---|
| Newsletter form | `#wooen-plugin-newsletter` |
| Email input | `#wooen-input-email-newsletter` |
| Submit button | `#btn_newsletter` |

The plugin's frontend scripts use these selectors to connect the form to its newsletter functionality.

**Important:** Keep the expected IDs and classes when integrating supported frontend features into your theme.

## SMS Integration

WooForge Engine supports the following SMS gateways:

- Melipayamak
- SMS.ir

You can configure the supported gateway and its credentials through the plugin settings.

**External services:** SMS functionality relies on third-party providers. Phone numbers and message content may be transmitted to the selected provider when SMS features are used.

## Development

WooForge Engine uses an object-oriented structure with reusable classes, helpers, utilities, and traits.

The project is designed to be extended and integrated into custom WordPress themes.

Bug reports, suggestions, and contributions are welcome. Please open an issue in the repository and provide enough information to reproduce any reported problem.

## License

WooForge Engine is licensed under the **GNU General Public License v2.0 or later**.

See the [LICENSE](LICENSE) file for details.

## Author

**Mahdi Davoodi**

- GitHub: [@mahdi7800](https://github.com/mahdi7800)
- Repository: [WooForge Engine](https://github.com/mahdi7800/WooForgeEngine)

## Support the Project

If you find WooForge Engine useful, consider supporting its development.

Your support helps improve the project, maintain existing features, and develop new functionality.

<p align="center">
  <a href="https://daramet.com/d_mahdi47?webintent&donate=600000&message=thanks">
    <strong>❤️ Support WooForge Engine</strong>
  </a>
</p>

---

# فارسی

## معرفی

**WooForge Engine** یک افزونه ماژولار و شیءگرا برای وردپرس است که با هدف فراهم‌کردن قابلیت‌های کاربردی و قابل استفاده مجدد برای قالب‌ها و وب‌سایت‌های وردپرسی توسعه داده شده است.

این افزونه مجموعه‌ای از امکانات مختلف مانند مدیریت کاربران، قابلیت‌های مبتنی بر AJAX، ابزارهای مدیریت وب‌سایت، سیستم‌های ارتباطی و امکانات مرتبط با ووکامرس را در قالب یک افزونه منظم ارائه می‌دهد.

تمرکز WooForge Engine روی منطق و عملکرد است، نه طراحی ظاهری. قالب وردپرس مسئول ساختار HTML، استایل‌های CSS و رابط کاربری است و افزونه وظیفه مدیریت منطق، پردازش درخواست‌ها و تعاملات را بر عهده دارد.

## امکانات

### ۱. مدیریت کاربران
- ورود کاربران با ایمیل یا نام کاربری
- ثبت‌نام کاربران
- بازیابی و تغییر رمز عبور
- تولید رمز عبور تصادفی
- ارسال و اعتبارسنجی کد تأیید پیامکی
- امکان ثبت‌نام با شماره موبایل

### ۲. ارتباطات و درخواست‌های AJAX
- پردازش فرم‌ها با AJAX
- سیستم فرم تماس با ما
- عضویت در خبرنامه
- ارسال ایمیل اطلاع‌رسانی هنگام انتشار مطالب جدید
- نمایش پیام‌های سفارشی برای پاسخ درخواست‌های AJAX

### ۳. مدیریت وب‌سایت
- مدیریت بنرها
- مدیریت اسلایدرها
- مدیریت پرسش‌های متداول (FAQ)
- تنظیمات مدیریتی افزونه
- ابزارک‌ها و اعلان‌های پیشخوان وردپرس

### ۴. یکپارچگی با WooCommerce
- سیستم علاقه‌مندی محصولات
- محاسبه درصد تخفیف محصولات
- نمایش سفارشی قیمت محصولات
- نمایش وضعیت موجودی محصولات
- نمایش برچسب تخفیف محصولات

### ۵. ابزارهای کاربردی
- نشان‌گذاری مطالب (Bookmark)
- پشتیبانی از تاریخ شمسی و میلادی
- نمایش زمان نسبی انتشار مطالب
- تنظیمات SMTP
- یکپارچگی با سرویس‌های پیامکی

## ساختار و معماری

WooForge Engine بر اساس معماری شیءگرا و ساختار ماژولار توسعه داده شده است.

هر قابلیت در کلاس‌ها و بخش‌های جداگانه سازمان‌دهی شده تا نگهداری، استفاده مجدد و توسعه کد ساده‌تر باشد.

```text
WooForgeEngine/
│
├── _inc/
│   ├── function/
│   ├── meta-box/
│   ├── setting/
│   ├── theme-setup/
│   └── widget/
│
├── assets/
│   ├── admin/
│   └── front/
│
├── class/
├── helper/
├── lib/
├── trait/
├── utility/
├── view/
│   ├── admin/
│   └── front/
│
├── AutoLoadWooForgeEngine.php
└── CoreWooForgeEngine.php
```

## پیش‌نیازها

| پیش‌نیاز | نسخه |
|---|---|
| PHP | نسخه 8.0 یا بالاتر |
| WordPress | نصب وردپرس |
| WooCommerce | برای استفاده از امکانات اختصاصی ووکامرس |

**نکته:** برای استفاده از امکانات عمومی افزونه نیازی به نصب ووکامرس نیست. ووکامرس فقط برای قابلیت‌های مرتبط با محصولات و امکانات فروشگاهی مورد نیاز است.

## نصب و راه‌اندازی

۱. مخزن پروژه را دانلود یا Clone کنید.

۲. پوشه‌ای را که فایل `CoreWooForgeEngine.php` در آن قرار دارد پیدا کنید.

۳. پوشه افزونه را در مسیر زیر قرار دهید:

```text
wp-content/plugins/
```

۴. وارد پیشخوان وردپرس شوید.

۵. به بخش **افزونه‌ها** بروید.

۶. افزونه **WooForge Engine** را فعال کنید.

## یکپارچگی با قالب وردپرس

WooForge Engine برای استفاده در کنار قالب‌های اختصاصی وردپرس طراحی شده است.

در این ساختار، قالب مسئول تولید HTML و مدیریت ظاهر رابط کاربری است و افزونه امکانات و عملکرد مورد نیاز را فراهم می‌کند.

برای مثال، قالب می‌تواند فرم خبرنامه را با استفاده از شناسه‌ها و کلاس‌های زیر ایجاد کند:

| بخش | شناسه یا کلاس |
|---|---|
| فرم خبرنامه | `#wooen-plugin-newsletter` |
| فیلد ایمیل | `#wooen-input-email-newsletter` |
| دکمه ارسال | `#btn_newsletter` |

اسکریپت‌های سمت کاربر افزونه با استفاده از این شناسه‌ها و کلاس‌ها، فرم را به سیستم خبرنامه متصل می‌کنند.

**نکته مهم:** هنگام پیاده‌سازی قابلیت‌های پشتیبانی‌شده در قالب، شناسه‌ها و کلاس‌های مورد انتظار افزونه را تغییر ندهید.

## یکپارچگی با سرویس پیامکی

WooForge Engine از درگاه‌های پیامکی زیر پشتیبانی می‌کند:

- ملی پیامک (Melipayamak)
- SMS.ir

امکان انتخاب سرویس پیامکی و تنظیم اطلاعات اتصال آن از طریق تنظیمات افزونه فراهم شده است.

**سرویس‌های خارجی:** قابلیت‌های پیامکی به سرویس‌دهندگان شخص ثالث وابسته هستند. هنگام استفاده از این قابلیت‌ها، شماره تلفن و محتوای پیام ممکن است به سرویس‌دهنده انتخاب‌شده ارسال شود.

## توسعه و مشارکت

WooForge Engine با استفاده از ساختار شیءگرا و اجزای قابل استفاده مجدد شامل کلاس‌ها، Helperها، Utilityها و Traitها توسعه داده شده است.

این ساختار با هدف توسعه‌پذیری و یکپارچگی بهتر با قالب‌های اختصاصی وردپرس طراحی شده است.

اگر باگ یا مشکلی در افزونه مشاهده کردید، می‌توانید آن را در بخش Issues مخزن GitHub گزارش دهید.

همچنین پیشنهادها و مشارکت‌های توسعه‌دهندگان برای بهبود پروژه استقبال می‌شود.

## مجوز انتشار

این افزونه تحت مجوز **GNU General Public License نسخه 2.0 یا بالاتر** منتشر شده است.

برای اطلاعات بیشتر، فایل [LICENSE](LICENSE) را مطالعه کنید.

## توسعه‌دهنده

**Mahdi Davoodi**

- گیت‌هاب: [@mahdi7800](https://github.com/mahdi7800)
- مخزن پروژه: [WooForge Engine](https://github.com/mahdi7800/WooForgeEngine)

## حمایت از پروژه

اگر WooForge Engine برای شما مفید بوده و از آن در پروژه‌های خود استفاده می‌کنید، می‌توانید با حمایت مالی به توسعه و بهبود آن کمک کنید.

حمایت شما به نگهداری پروژه، توسعه قابلیت‌های جدید و بهبود امکانات فعلی کمک می‌کند.

<p align="center">
  <a href="https://daramet.com/d_mahdi47?webintent&donate=600000&message=thanks">
    <strong>❤️ حمایت مالی از WooForge Engine</strong>
  </a>
</p>

---

<p align="center">
  **WooForge Engine**
  <br>
  <sub>Modular functionality. Cleaner WordPress development.</sub>
  <br>
  <sub>قابلیت‌های ماژولار، توسعه تمیزتر وردپرس</sub>
</p>
