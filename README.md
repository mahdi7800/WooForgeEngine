=== WooForge Engine ===

Tags: ajax, contact-form, newsletter, user-management, woocommerce
Requires PHP: 8.0
Stable tag: 1.0.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/old-licenses/gpl-2.0.html

A modular WordPress plugin for user management, AJAX-powered functionality, and WooCommerce integration.

== Description ==

WooForge Engine is an object-oriented WordPress plugin that provides reusable website functionality while keeping application logic separate from the theme's presentation layer.

It includes user authentication, AJAX-powered interactions, newsletter subscriptions, contact forms, content management tools, SMS integration, and WooCommerce-related utilities.

The plugin uses predefined HTML IDs and CSS classes to connect its front-end functionality to WordPress themes. Theme developers can build their own markup and integrate it with the plugin without relying on shortcodes for the documented features.

= Features =

**User Authentication**
* User login with email or username.
* User registration.
* Password recovery and password changing.
* Random password generation.
* SMS verification code generation and validation.
* Optional phone-number registration support.

**Communication**
* Contact form functionality.
* Newsletter subscriptions.
* New post email notifications.
* SMTP configuration.
* AJAX response messages and notifications.

**Interactive Features**
* WooCommerce product wishlist.
* Post bookmarking.

**Content Management**
* Banner management.
* Slider management.
* FAQ management.
* Administration settings.
* Dashboard widgets and notifications.

**SMS Integration**
* Melipayamak SMS gateway.
* SMS.ir gateway.
* SMS verification workflows.

**Utility Functions**
* Gregorian and Jalali date conversion.
* Relative time formatting.
* Random password and verification-code generation.
* WooCommerce discount calculation.
* WooCommerce product price output.
* Product stock-status labels.
* Product discount labels.

= WooCommerce Integration =

WooCommerce is needed for store-specific functionality, including product wishlist features and product utility methods.

General WordPress functionality is separate from these WooCommerce integrations.

== Installation ==

1. Upload the `WooForge Engine` plugin folder to the `/wp-content/plugins/` directory, or install the plugin through the WordPress Plugins screen when available.
2. Activate **WooForge Engine** through the **Plugins** menu in WordPress.
3. Open the plugin administration settings.
4. Configure the required email and SMS settings if you intend to use those services.
5. Implement the required HTML elements in your theme for the front-end features you want to use.

== Theme Integration ==

WooForge Engine separates application logic from theme presentation.

The theme provides the required HTML elements, while the plugin's JavaScript identifies them through predefined IDs and CSS classes and handles the related AJAX requests.

The current implementation does not rely on shortcodes for these integrations.

= Newsletter Form Example =

Add the following markup to your theme:

<pre>
<form id="wooen-plugin-newsletter">
    <input
        type="email"
        id="wooen-input-email-newsletter"
        placeholder="Email address"
        required
    >

    <button type="submit" id="btn_newsletter">
        Subscribe
    </button>
</form>
</pre>

The plugin detects these selectors and handles newsletter subscription requests through AJAX.

Keep the required IDs and classes unchanged when implementing the integration.

== Frequently Asked Questions ==

= Does WooForge Engine require WooCommerce? =

WooCommerce is required for WooCommerce-specific features, such as product wishlist functionality and product utility methods. General WordPress features are separate from these integrations.

= Does the plugin use shortcodes? =

The current front-end integration uses theme-provided HTML elements and predefined JavaScript selectors rather than shortcodes.

= Can I use the plugin with a custom WordPress theme? =

Yes. Theme developers can add the required HTML markup and selectors to their theme templates.

= Which SMS providers are supported? =

The current implementation includes integrations for Melipayamak and SMS.ir. An active account and valid credentials from the selected provider are required.

= Does the plugin send emails? =

Yes. The plugin uses WordPress email functionality for messages and newsletter notifications. SMTP settings are available for email configuration.

= Where can I report bugs or request features? =

Please use the plugin's GitHub issue tracker:
https://github.com/mahdi7800/WooForgeEngine/issues

== External Services ==

WooForge Engine can connect to external services when the corresponding features are configured and used.

= Melipayamak =

When the Melipayamak SMS gateway is selected and an SMS operation is performed, the plugin sends SMS-related information, including the recipient phone number and message or verification data, to the Melipayamak API.

Service: https://www.melipayamak.com/

= SMS.ir =

When the SMS.ir gateway is selected and an SMS operation is performed, the plugin sends SMS-related information, including the recipient phone number and message or verification data, to the SMS.ir API.

Service: https://sms.ir/

The use of these services is optional and depends on the administrator's configuration.

== Changelog ==

= 1.0.0 =
* Initial release.

== Upgrade Notice ==

= 1.0.0 =
Initial release of WooForge Engine.
