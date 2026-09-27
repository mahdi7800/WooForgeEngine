jQuery(document).ready(function ($) {
   // NEWSLETTER
    $('#wooen-plugin-newsletter').on('submit', function (e) {

        e.preventDefault();
        let el = $(this);
        let email = $('#wooen-input-email-newsletter').val();

        $.ajax({
            url: ajax.ajaxurl,
            type: 'POST',
            dataType: 'json',
            data: {
                action: 'wooen_newsletter',
                nonce: ajax._nonce,
                email: email
            },
            beforeSend: function () {
                $('#btn_newsletter span').text('Submitting...');
                $('#btn_newsletter').prop('disabled', true);
            },
            success: function (response) {
                if (response.success) {
                    $.toast({
                        text: response.message, // Text that is to be shown in the toast
                        heading: 'success', // Optional heading to be shown on the toast
                        icon: 'success', // Type of toast icon
                        showHideTransition: 'fade', // fade, slide or plain
                        allowToastClose: true, // Boolean value true or false
                        hideAfter: 3000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
                        stack: false, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
                        position: 'top-right', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values
                        textAlign: 'left',  // Text alignment i.e. left, right or center
                        loader: true,  // Whether to show loader or not. True by default
                        loaderBg: '#9EC600',  // Background color of the toast loader
                        beforeShow: function () {
                        }, // will be triggered before the toast is shown
                        afterShown: function () {
                        }, // will be triggered after the toat has been shown
                        beforeHide: function () {
                        }, // will be triggered before the toast gets hidden
                        afterHidden: function () {
                        }  // will be triggered after the toast has been hidden
                    });
                }
            },
            error: function (error) {
                if (error && error.responseJSON && error.responseJSON.message){
                    $.toast({
                        text: error.responseJSON.message, // استفاده از پیام خطا به صورت داینامیک
                        heading: 'خطا', // عنوان پیام
                        icon: 'error',
                        showHideTransition: 'fade',
                        allowToastClose: true,
                        hideAfter: 3000,
                        stack: 5,
                        position: 'top-right',
                        textAlign: 'left',
                        loader: true,
                        loaderBg: '#9EC600'
                    });
                }
            },
            complete: function () {
                $('#btn_newsletter span').text('Subscribe');
                $('#btn_newsletter').prop('disabled', false);
            }
        });

    });
   // CONTACT-US
    $('#wooen-plugin-contact-us').on('submit', function (e) {
        e.preventDefault();

        let email = $('.wooen-input-email-contact-us').val();
        let name = $('.wooen-input-name-contact-us').val();
        let phone = $('.wooen-input-phone-contact-us').val();
        let subject = $('.wooen-input-subject-contact-us').val();
        let message = $('.wooen-input-message-contact-us').val();

        $.ajax({
            url: ajax.ajaxurl,
            type: 'POST',
            dataType: 'json',
            data: {
                action: 'wooen_contact_us',
                nonce: ajax._nonce,
                email: email,
                name: name,
                phone: phone,
                subject: subject,
                message: message,
            },
            beforeSend: function () {
                $('#wooen-btn-contact-us').prop('disabled', true).text('Sending...');
            },
            success: function (response) {
                if (response.success){
                    $.toast({
                        text: response.message, // Text that is to be shown in the toast
                        heading: 'success', // Optional heading to be shown on the toast
                        icon: 'success', // Type of toast icon
                        showHideTransition: 'fade', // fade, slide or plain
                        allowToastClose: true, // Boolean value true or false
                        hideAfter: 3000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
                        stack: false, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
                        position: 'top-right', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values
                        textAlign: 'left',  // Text alignment i.e. left, right or center
                        loader: true,  // Whether to show loader or not. True by default
                        loaderBg: '#9EC600',  // Background color of the toast loader
                        beforeShow: function () {}, // will be triggered before the toast is shown
                        afterShown: function () {}, // will be triggered after the toat has been shown
                        beforeHide: function () {}, // will be triggered before the toast gets hidden
                        afterHidden: function () {}  // will be triggered after the toast has been hidden
                    });
                }
            },
            error: function (error) {
                if (error && error.responseJSON && error.responseJSON.message){
                    $.toast({
                        text: error.responseJSON.message, // استفاده از پیام خطا به صورت داینامیک
                        heading: 'error', // عنوان پیام
                        icon: 'error',
                        showHideTransition: 'fade',
                        allowToastClose: true,
                        hideAfter: 3000,
                        stack: 5,
                        position: 'top-right',
                        textAlign: 'left',
                        loader: true,
                        loaderBg: '#9EC600'
                    });
                }
            },
            complete: function () {
                $('#wooen-btn-contact-us').prop('disabled', false).text('Send Message');
            }
        });
    })
    // BOOKMARK-POSTS
    $('#bookmark-post').on('click', function (e) {
            e.preventDefault();
            let $this = $(this);
            let post_id = $this.data('post-id');
            let user_id = $this.data('user-id');
            $.ajax({
                url: ajax.ajaxurl,
                type: 'POST',
                dataType: 'json',
                data: {
                    action: 'wooen_bookmark_post',
                    nonce: ajax._nonce,
                    post_id: post_id,
                    user_id : user_id
                },
                beforeSend: function () {

                },
                success: function (response) {
                    if (response.success){
                        $.toast({
                            text: response.message, // Text that is to be shown in the toast
                            heading: 'success', // Optional heading to be shown on the toast
                            icon: 'success', // Type of toast icon
                            showHideTransition: 'fade', // fade, slide or plain
                            allowToastClose: true, // Boolean value true or false
                            hideAfter: 3000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
                            stack: false, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
                            position: 'top-right', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values
                            textAlign: 'left',  // Text alignment i.e. left, right or center
                            loader: true,  // Whether to show loader or not. True by default
                            loaderBg: '#9EC600',  // Background color of the toast loader
                            beforeShow: function () {}, // will be triggered before the toast is shown
                            afterShown: function () {}, // will be triggered after the toat has been shown
                            beforeHide: function () {}, // will be triggered before the toast gets hidden
                            afterHidden: function () {}  // will be triggered after the toast has been hidden
                        });

                    }
                },
                error: function (error) {
                    if (error && error.responseJSON && error.responseJSON.message){
                        $.toast({
                            text: error.responseJSON.message, // استفاده از پیام خطا به صورت داینامیک
                            heading: 'error', // عنوان پیام
                            icon: 'error',
                            showHideTransition: 'fade',
                            allowToastClose: true,
                            hideAfter: 3000,
                            stack: 5,
                            position: 'top-right',
                            textAlign: 'left',
                            loader: true,
                            loaderBg: '#9EC600'
                        });
                    }
                },
                complete: function () {
                }
            });
    })
    // SIGN-IN
    $('#wooen-singnin-form').on('submit', function (e) {
        e.preventDefault();
        let emailOrUsername = $('.wooen-input-email-or-username').val();
        let password = $('.wooen-input-password').val();
        let remember_me = jQuery('#StaySignedIn').is(':checked') ? 'true' : 'false';

        $.ajax({
            url: ajax.ajaxurl,
            type: 'POST',
            dataType: 'json',
            data: {
                action: 'wooen_signing',
                nonce: ajax._nonce,
                emailOrUsername: emailOrUsername,
                password : password,
                remember_me : remember_me
            },
            beforeSend: function () {

            },
            success: function (response) {
                if (response.success){
                    $.toast({
                        text: response.message, // Text that is to be shown in the toast
                        heading: 'success', // Optional heading to be shown on the toast
                        icon: 'success', // Type of toast icon
                        showHideTransition: 'fade', // fade, slide or plain
                        allowToastClose: true, // Boolean value true or false
                        hideAfter: 3000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
                        stack: false, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
                        position: 'top-right', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values
                        textAlign: 'left',  // Text alignment i.e. left, right or center
                        loader: true,  // Whether to show loader or not. True by default
                        loaderBg: '#9EC600',  // Background color of the toast loader
                        beforeShow: function () {}, // will be triggered before the toast is shown
                        afterShown: function () {}, // will be triggered after the toat has been shown
                        beforeHide: function () {}, // will be triggered before the toast gets hidden
                        afterHidden: function () {}  // will be triggered after the toast has been hidden
                    });
                    if (response.redirect_url) {
                        window.location.href = response.redirect_url;
                    }
                }
            },
            error: function (error) {
                if (error && error.responseJSON && error.responseJSON.message){
                    $.toast({
                        text: error.responseJSON.message, // استفاده از پیام خطا به صورت داینامیک
                        heading: 'error', // عنوان پیام
                        icon: 'error',
                        showHideTransition: 'fade',
                        allowToastClose: true,
                        hideAfter: 3000,
                        stack: 5,
                        position: 'top-right',
                        textAlign: 'left',
                        loader: true,
                        loaderBg: '#9EC600'
                    });
                }
            },
            complete: function () {
            }
        });

    })
    // SIGN UP
    $('#wooen-signup-form').on('submit', function (e) {
        e.preventDefault();
        let full_name = $('.input-fullName-signup-form').val();
        let email= $('.input-email-signup-form').val();
        let  password = $('.input-password-signup-form').val();
        let phone_number= $('.input-phone_number-signup_form_hidden').val();
        $.ajax({
            url: ajax.ajaxurl,
            type: 'POST',
            dataType: 'json',
            data: {
                action: 'wooen_signup',
                nonce: ajax._nonce,
                full_name : full_name,
                email: email,
                password: password,
                phone_number : phone_number
            },
            beforeSend: function () {

            },
            success: function (response) {
                if (response.success){
                    $.toast({
                        text: response.message, // Text that is to be shown in the toast
                        heading: 'success', // Optional heading to be shown on the toast
                        icon: 'success', // Type of toast icon
                        showHideTransition: 'fade', // fade, slide or plain
                        allowToastClose: true, // Boolean value true or false
                        hideAfter: 3000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
                        stack: false, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
                        position: 'top-right', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values
                        textAlign: 'left',  // Text alignment i.e. left, right or center
                        loader: true,  // Whether to show loader or not. True by default
                        loaderBg: '#9EC600',  // Background color of the toast loader
                        beforeShow: function () {}, // will be triggered before the toast is shown
                        afterShown: function () {}, // will be triggered after the toat has been shown
                        beforeHide: function () {}, // will be triggered before the toast gets hidden
                        afterHidden: function () {}  // will be triggered after the toast has been hidden
                    });
                }
                if (response.redirect_url) {
                    window.location.href = response.redirect_url;
                }
            },
            error: function (error) {
                if (error && error.responseJSON && error.responseJSON.message){
                    $.toast({
                        text: error.responseJSON.message, // استفاده از پیام خطا به صورت داینامیک
                        heading: 'error', // عنوان پیام
                        icon: 'error',
                        showHideTransition: 'fade',
                        allowToastClose: true,
                        hideAfter: 3000,
                        stack: 5,
                        position: 'top-right',
                        textAlign: 'left',
                        loader: true,
                        loaderBg: '#9EC600'
                    });
                }
            },
            complete: function () {
            }
        });
    })
    // SEND-CODE-VERIFICATION-FOR-SMS
    $('#wooen-send-code-form').on('submit', function (e) {
        e.preventDefault();
        let phone_number = $('.input-phone-signup-form').val();
        $.ajax({
            url: ajax.ajaxurl,
            type: 'POST',
            dataType: 'json',
            data: {
                action: 'wooen_send_code',
                nonce: ajax._nonce,
                phone_number : phone_number
            },
            beforeSend: function () {

            },
            success: function (response) {
                if (response.success){
                    $.toast({
                        text: response.message, // Text that is to be shown in the toast
                        heading: 'success', // Optional heading to be shown on the toast
                        icon: 'success', // Type of toast icon
                        showHideTransition: 'fade', // fade, slide or plain
                        allowToastClose: true, // Boolean value true or false
                        hideAfter: 3000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
                        stack: false, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
                        position: 'top-right', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values
                        textAlign: 'left',  // Text alignment i.e. left, right or center
                        loader: true,  // Whether to show loader or not. True by default
                        loaderBg: '#9EC600',  // Background color of the toast loader
                        beforeShow: function () {}, // will be triggered before the toast is shown
                        afterShown: function () {}, // will be triggered after the toat has been shown
                        beforeHide: function () {}, // will be triggered before the toast gets hidden
                        afterHidden: function () {}  // will be triggered after the toast has been hidden
                    });
                }
                $('#wooen-send-code-form').hide();
                $('#wooen-verify-code-form').show();
                $('.input-phone_number-signup_form_hidden').val(phone_number);
            },
            error: function (error) {
                if (error && error.responseJSON && error.responseJSON.message){
                    $.toast({
                        text: error.responseJSON.message, // استفاده از پیام خطا به صورت داینامیک
                        heading: 'error', // عنوان پیام
                        icon: 'error',
                        showHideTransition: 'fade',
                        allowToastClose: true,
                        hideAfter: 3000,
                        stack: 5,
                        position: 'top-right',
                        textAlign: 'left',
                        loader: true,
                        loaderBg: '#9EC600'
                    });
                }
            },
            complete: function () {
            }
        });
    })
    // VERIFICATION_CODE
    $('#wooen-verify-code-form').on('submit', function (e) {
        e.preventDefault();
        let verified = $('.input-verify-code-signup-form').val();
        let phone_number = $('.input-phone_number-signup_form_hidden').val();
        $.ajax({
            url: ajax.ajaxurl,
            type: 'POST',
            dataType: 'json',
            data: {
                action: 'wooen_verification_code_check',
                nonce: ajax._nonce,
                verified : verified,
                phone_number : phone_number
            },
            beforeSend: function () {

            },
            success: function (response) {
                if (response.success){
                    $.toast({
                        text: response.message, // Text that is to be shown in the toast
                        heading: 'success', // Optional heading to be shown on the toast
                        icon: 'success', // Type of toast icon
                        showHideTransition: 'fade', // fade, slide or plain
                        allowToastClose: true, // Boolean value true or false
                        hideAfter: 3000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
                        stack: false, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
                        position: 'top-right', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values
                        textAlign: 'left',  // Text alignment i.e. left, right or center
                        loader: true,  // Whether to show loader or not. True by default
                        loaderBg: '#9EC600',  // Background color of the toast loader
                        beforeShow: function () {}, // will be triggered before the toast is shown
                        afterShown: function () {}, // will be triggered after the toat has been shown
                        beforeHide: function () {}, // will be triggered before the toast gets hidden
                        afterHidden: function () {}  // will be triggered after the toast has been hidden
                    });
                }
                $('#wooen-verify-code-form').hide();
                $('#wooen-signup-form').show();
                $('.input-phone_number-signup_form_hidden').val(phone_number);
            },
            error: function (error) {
                if (error && error.responseJSON && error.responseJSON.message){
                    $.toast({
                        text: error.responseJSON.message, // استفاده از پیام خطا به صورت داینامیک
                        heading: 'error', // عنوان پیام
                        icon: 'error',
                        showHideTransition: 'fade',
                        allowToastClose: true,
                        hideAfter: 3000,
                        stack: 5,
                        position: 'top-right',
                        textAlign: 'left',
                        loader: true,
                        loaderBg: '#9EC600'
                    });
                }
            },
            complete: function () {

            }
        });
    })
    // PASSWORD-RECOVERY
    $('#wooen-password-recovery-form').on('submit', function (e) {
        e.preventDefault();
        let email = $('.wooen-input-email-password-recovery').val();
        $.ajax({
            url: ajax.ajaxurl,
            type: 'POST',
            dataType: 'json',
            data: {
                action: 'wooen_password_recovery',
                nonce: ajax._nonce,
                email: email
            },
            beforeSend: function () {

            },
            success: function (response) {
                if (response.success){
                    $.toast({
                        text: response.message, // Text that is to be shown in the toast
                        heading: 'success', // Optional heading to be shown on the toast
                        icon: 'success', // Type of toast icon
                        showHideTransition: 'fade', // fade, slide or plain
                        allowToastClose: true, // Boolean value true or false
                        hideAfter: 3000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
                        stack: false, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
                        position: 'top-right', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values
                        textAlign: 'left',  // Text alignment i.e. left, right or center
                        loader: true,  // Whether to show loader or not. True by default
                        loaderBg: '#9EC600',  // Background color of the toast loader
                        beforeShow: function () {}, // will be triggered before the toast is shown
                        afterShown: function () {}, // will be triggered after the toat has been shown
                        beforeHide: function () {}, // will be triggered before the toast gets hidden
                        afterHidden: function () {}  // will be triggered after the toast has been hidden
                    });
                }
            },
            error: function (error) {
                if (error && error.responseJSON && error.responseJSON.message){
                    $.toast({
                        text: error.responseJSON.message, // استفاده از پیام خطا به صورت داینامیک
                        heading: 'error', // عنوان پیام
                        icon: 'error',
                        showHideTransition: 'fade',
                        allowToastClose: true,
                        hideAfter: 3000,
                        stack: 5,
                        position: 'top-right',
                        textAlign: 'left',
                        loader: true,
                        loaderBg: '#9EC600'
                    });
                }
            },
            complete: function () {
            }
        });
    })
    // CHANGE-PASSWORD
    $('#wooen-change-password-form').on('submit', function (e) {
        e.preventDefault();
        let new_password = $('.wooen-input-new-password').val();
        let confirm_password = $('.wooen-input-confirm-password').val();
        let token_cr = $('token_cr').val();
        $.ajax({
            url: ajax.ajaxurl,
            type: 'POST',
            dataType: 'json',
            data: {
                action: 'wooen_password_recovery',
                nonce: ajax._nonce,
                new_password : new_password,
                confirm_password : confirm_password,
                token_cr : token_cr
            },
            beforeSend: function () {

            },
            success: function (response) {
                if (response.success){
                    $.toast({
                        text: response.message, // Text that is to be shown in the toast
                        heading: 'success', // Optional heading to be shown on the toast
                        icon: 'success', // Type of toast icon
                        showHideTransition: 'fade', // fade, slide or plain
                        allowToastClose: true, // Boolean value true or false
                        hideAfter: 3000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
                        stack: false, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
                        position: 'top-right', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values
                        textAlign: 'left',  // Text alignment i.e. left, right or center
                        loader: true,  // Whether to show loader or not. True by default
                        loaderBg: '#9EC600',  // Background color of the toast loader
                        beforeShow: function () {}, // will be triggered before the toast is shown
                        afterShown: function () {}, // will be triggered after the toat has been shown
                        beforeHide: function () {}, // will be triggered before the toast gets hidden
                        afterHidden: function () {}  // will be triggered after the toast has been hidden
                    });
                }
            },
            error: function (error) {
                if (error && error.responseJSON && error.responseJSON.message){
                    $.toast({
                        text: error.responseJSON.message, // استفاده از پیام خطا به صورت داینامیک
                        heading: 'error', // عنوان پیام
                        icon: 'error',
                        showHideTransition: 'fade',
                        allowToastClose: true,
                        hideAfter: 3000,
                        stack: 5,
                        position: 'top-right',
                        textAlign: 'left',
                        loader: true,
                        loaderBg: '#9EC600'
                    });
                }
            },
            complete: function () {
            }
        });
    })
    // GenerateRandomString
    $('#generatePasswordBtn').on('click',function (e) {
        e.preventDefault();

        $.ajax({
            url: ajax.ajaxurl,
            type: 'POST',
            datatype: 'json',
            data: {
                action: 'wooen_random_password',
                nonce: ajax._nonce,

            },
            beforeSend: function () {
            },
            success: function (response) {
                if (response.success){
                    $('.password-register').val(response.password);
                    $.toast({
                        text: response.message, // Text that is to be shown in the toast
                        heading: 'باموفقیت', // Optional heading to be shown on the toast
                        icon: 'success', // Type of toast icon
                        showHideTransition: 'fade', // fade, slide or plain
                        allowToastClose: true, // Boolean value true or false
                        hideAfter: 3000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
                        stack: false, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
                        position: 'top-left', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values
                        textAlign: 'right',  // Text alignment i.e. left, right or center
                        loader: true,  // Whether to show loader or not. True by default
                        loaderBg: '#9EC600',  // Background color of the toast loader
                        beforeShow: function () {}, // will be triggered before the toast is shown
                        afterShown: function () {}, // will be triggered after the toat has been shown
                        beforeHide: function () {}, // will be triggered before the toast gets hidden
                        afterHidden: function () {}  // will be triggered after the toast has been hidden
                    });
                }

            },
            error: function (error) {
                if (error && error.responseJSON && error.responseJSON.message){
                    $.toast({
                        text: error.responseJSON.message, // استفاده از پیام خطا به صورت داینامیک
                        heading: 'خطا', // عنوان پیام
                        icon: 'error',
                        showHideTransition: 'fade',
                        allowToastClose: true,
                        hideAfter: 3000,
                        stack: 5,
                        position: 'top-left',
                        textAlign: 'right',
                        loader: true,
                        loaderBg: '#9EC600'
                    });
                }
            },
            complete: function () {
            }
        })


    })
    // Wishlist
    $('.bookmark-product').on('click', function (e) {
        e.preventDefault();
        let $this = $(this);
        let proudct_id = $this.data('pid');
        $.ajax({
            url: ajax.ajaxurl,
            type: 'POST',
            datatype: 'json',
            data: {
                action: 'wooen_Wishlist',
                nonce: ajax._nonce,
                proudct_id  : proudct_id
            },
            beforeSend: function () {
            },
            success: function (response) {

                    $.toast({
                        text: response.message, // Text that is to be shown in the toast
                        heading: 'باموفقیت', // Optional heading to be shown on the toast
                        icon: 'success', // Type of toast icon
                        showHideTransition: 'fade', // fade, slide or plain
                        allowToastClose: true, // Boolean value true or false
                        hideAfter: 3000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
                        stack: false, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
                        position: 'top-left', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values
                        textAlign: 'right',  // Text alignment i.e. left, right or center
                        loader: true,  // Whether to show loader or not. True by default
                        loaderBg: '#9EC600',  // Background color of the toast loader
                        beforeShow: function () {}, // will be triggered before the toast is shown
                        afterShown: function () {}, // will be triggered after the toat has been shown
                        beforeHide: function () {}, // will be triggered before the toast gets hidden
                        afterHidden: function () {}  // will be triggered after the toast has been hidden
                    });
            },
            error: function (error) {
                if (error && error.responseJSON && error.responseJSON.message){
                    $.toast({
                        text: error.responseJSON.message, // استفاده از پیام خطا به صورت داینامیک
                        heading: 'خطا', // عنوان پیام
                        icon: 'error',
                        showHideTransition: 'fade',
                        allowToastClose: true,
                        hideAfter: 3000,
                        stack: 5,
                        position: 'top-left',
                        textAlign: 'right',
                        loader: true,
                        loaderBg: '#9EC600'
                    });
                }
            },
            complete: function () {
            }
        })
    })
});