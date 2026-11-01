# WooForge Engine

<p align="center">
  <img src="WooForgeEngine-Logo.webp" alt="WooForge Engine Logo" width="220">
</p>

<p align="center">
  <strong>A Modular WordPress Plugin for Modern Website Functionality</strong>
</p>

<p align="center">
  <a href="https://github.com/mahdi7800/WooForgeEngine">
    <img src="https://img.shields.io/badge/WordPress-Plugin-21759B?logo=wordpress&logoColor=white" alt="WordPress Plugin">
  </a>
  <img src="https://img.shields.io/badge/PHP-8.0%2B-777BB4?logo=php&logoColor=white" alt="PHP 8.0+">
  <img src="https://img.shields.io/badge/Architecture-OOP-555555" alt="OOP">
  <img src="https://img.shields.io/badge/License-GPL--2.0--or--later-blue" alt="GPL License">
</p>

---

## Overview

**WooForge Engine** is a modular WordPress plugin designed to provide reusable functionality for custom WordPress themes and websites.

It brings together user authentication, AJAX-powered features, website utilities, content management tools, and WooCommerce-related functionality in one organized plugin.

The plugin focuses on functionality rather than presentation. Your theme remains responsible for the HTML structure, CSS styling, and overall user interface, while WooForge Engine handles the underlying logic and interactions.

## Features

### User Management
- User login with email or username
- User registration
- Password recovery and password changes
- Random password generation
- SMS verification codes
- Optional phone-number registration

### AJAX & Communication
- AJAX-powered form submissions
- Contact form functionality
- Newsletter subscriptions
- New post email notifications
- Custom AJAX response messages

### Website Management
- Banner management
- Slider management
- FAQ management
- Admin settings
- Dashboard widgets and notifications

### WooCommerce Integration
- Product wishlist
- Product discount calculations
- Custom product price output
- Product stock labels
- Product discount labels

### Additional Utilities
- Post bookmarking
- Persian and Gregorian date support
- Relative time formatting
- SMTP configuration
- SMS gateway integration

## Architecture

WooForge Engine follows an object-oriented and modular structure.

Each feature is organized into its own classes and components to make the code easier to maintain and extend.

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

> WooCommerce is not required for the plugin's general WordPress functionality. It is only needed when using its WooCommerce-specific features.

## Installation

1. Download or clone this repository.
2. Place the plugin folder containing `CoreWooForgeEngine.php` inside `wp-content/plugins/`.
3. Open your WordPress dashboard.
4. Navigate to **Plugins**.
5. Activate **WooForge Engine**.

## Theme Integration

WooForge Engine is designed to work alongside custom WordPress themes.

Your theme controls the markup and styling, while the plugin provides the functionality.

For example, a theme can provide a newsletter form using the following selectors:

| Element | Selector |
|---|---|
| Newsletter form | `#wooen-plugin-newsletter` |
| Email input | `#wooen-input-email-newsletter` |
| Submit button | `#btn_newsletter` |

The plugin's frontend scripts use these selectors to connect the form to its newsletter functionality.

**Important:** Keep the expected IDs and classes when integrating the supported frontend features into your theme.

## SMS Integration

WooForge Engine supports SMS gateway integrations through:

- Melipayamak
- SMS.ir

You can configure the supported gateway and its credentials through the plugin settings.

SMS services are external services. Using them may transmit phone numbers and message content to the selected provider.

## Development

The project uses an object-oriented structure with reusable classes, helper functions, utilities, and traits.

Contributions, bug reports, and suggestions are welcome.

If you find a problem, please open an issue in the repository with enough information to reproduce it.

## License

WooForge Engine is licensed under the **GNU General Public License v2.0 or later**.

See the [LICENSE](LICENSE) file for details.

## Author

**Mahdi Davoodi**

- GitHub: [@mahdi7800](https://github.com/mahdi7800)
- Repository: [WooForge Engine](https://github.com/mahdi7800/WooForgeEngine)

---

<p align="center">
  <strong>WooForge Engine</strong><br>
  <sub>Modular functionality. Cleaner WordPress development.</sub>
</p>
