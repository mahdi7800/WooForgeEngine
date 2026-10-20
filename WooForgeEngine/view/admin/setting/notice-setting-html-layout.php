<?php
if (!current_user_can('manage_options')) {
    return;
}
$notice = new Notification();
$notice->wooen_handle_admin_actions();
$noticies = $notice->wooen_select();
//echo '<pre>';
//var_dump($noticies);
//echo '</pre>';
$counter = 1 ;
$message = $notice->get_message();

?>

<div class="uk-container uk-margin-top">
<?php echo $message; ?>
    <div class="uk-flex uk-flex-between uk-flex-middle uk-margin-medium-bottom">

        <div>
            <h5 class="uk-margin-remove uk-text-bold">
                <?php echo esc_html(get_admin_page_title()); ?>
            </h5>

            <p class="uk-text-meta uk-margin-small-top uk-margin-remove-bottom">
                Manage newsletter subscribers
            </p>
        </div>

        <div class="uk-card uk-card-default uk-card-small uk-border-rounded">
            <div class="uk-flex uk-flex-middle uk-flex-center uk-padding-small">

                <div class="uk-margin-small-right">
                    <span uk-icon="icon: users; ratio: 1.2"></span>
                </div>

                <div>
                    <div class="uk-text-meta uk-margin-remove">
                        Subscribers
                    </div>

                    <div class="uk-text-bold uk-text-large uk-margin-remove">
                         <?php echo $notice->wooen_notification_count(); ?>
                    </div>
                </div>

            </div>
            <button
                    type="button"
                    class="btn btn-primary"
                    data-bs-toggle="modal"
                    data-bs-target="#addBannerModal">

                + Add Notice

            </button>
        </div>

    </div>

    <div class="uk-overflow-auto">
        <table class="table align-middle p-4 mb-0 table-hover">
            <thead class="table-dark">
            <tr>
                <th class="border-0 rounded-start">#</th>
                <th class="border-0">type</th>
                <th class="border-0">title</th>
                <th class="border-0">notices Date</th>
                <th class="border-0">message</th>
                <th class="border-0">notices Status</th>
                <th class="border-0">Operation</th>

            </tr>
            </thead>

            <tbody>
            <?php if($noticies):
                foreach($noticies as $notices): ?>

                    <tr>
                        <td><?php echo $counter++; ?></td>
                        <td>
                            <?php echo utility::wooen_get_type_notif((int)$notices['type']); ?>
                        </td>
                        <td class="uk-table-link">
                            <a><?php echo esc_html($notices['title']); ?></a>
                        </td>
                        <td class="uk-text-nowrap"><?php echo utility::wooen_date((string)$notices['created_at'],'/','g2j') ?></td>
                        <td class="text-wrap" style="min-width: 220px; max-width: 320px;">
                            <?php echo esc_html($notices['message']); ?>
                        </td>
                        <td class="uk-text-truncate">
                            <?php if ($notices['status']== 1 ): ?>
                                <span class="badge bg-success">Active</span>
                            <?php else : ?>
                                <span class="badge bg-danger">Inactive</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <div class="newsletter-actions">

                                <a href="<?php echo esc_url(
                                    add_query_arg([
                                        'action' => 'delete',
                                        'id' => $notices['id']
                                    ])
                                ); ?>"
                                   class="btn btn-light btn-round mb-0"
                                   data-bs-toggle="tooltip"
                                   data-bs-placement="top"
                                   title="delete user"
                                   aria-label="Delete user">
                                    <i class="fas fa-trash"></i>
                                </a>
                                <!-- Edit -->
                                <button
                                        type="button"
                                        class="btn btn-light btn-round mb-0"
                                        data-bs-toggle="modal"
                                        data-bs-target="#editNotificationModal"
                                        data-id="<?php echo esc_attr($notices['id']); ?>"
                                        data-title="<?php echo esc_attr($notices['title']); ?>"
                                        data-message="<?php echo esc_attr($notices['message']); ?>"
                                        data-link="<?php echo esc_attr($notices['slug']); ?>"
                                        data-type="<?php echo esc_attr($notices['type']); ?>"
                                        title="Edit Notification"
                                        aria-label="Edit Notification"
                                >
                                    <i class="fas fa-edit"></i>
                                </button>

                                <form method="POST">
                                    <?php wp_nonce_field(
                                        'wooen_update_newsletter_status',
                                        'newsletter_nonce'
                                    ); ?>

                                    <input
                                            type="hidden"
                                            name="newsletter_id"
                                            value="<?php echo esc_attr($notices['id']); ?>"
                                    >

                                    <label class="newsletter-switch">
                                        <input
                                                type="checkbox"
                                                name="newsletter_status"
                                                value="1"
                                                onchange="this.form.submit()"
                                            <?php checked((int) $notices['status'], 1); ?>
                                        >

                                        <span class="newsletter-slider"></span>
                                    </label>
                                </form>

                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7">
                        <div class="alert alert-info">
                            No users have registered yet!
                        </div>
                    </td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>

</div>

<!-- =========================================================
     Add Banner Modal
========================================================= -->

<div
        class="modal fade"
        id="addBannerModal"
        tabindex="-1"
        aria-labelledby="addBannerModalLabel"
        aria-hidden="true">

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content">


            <div class="modal-header">

                <h5
                        class="modal-title"
                        id="addBannerModalLabel">

                    Add New Banner

                </h5>


                <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close">
                </button>

            </div>


            <div class="modal-body">


                <!-- Banner Title Guide -->
                <div class="alert alert-primary">

                        <h6 class="alert-heading">
                            Notification Guide
                        </h6>

                        <p class="mb-2">
                            Create a notification by entering a title, message, and
                            selecting the appropriate notification type.
                        </p>

                        <p class="mb-2">
                            Choose the notification type based on its purpose,
                            such as a user update, order notification, payment alert,
                            security notice, or general announcement.
                        </p>

                        <div class="small text-muted">
                            <strong>Tip:</strong>
                            Keep the title short and clear, and make sure the message
                            provides the necessary information to the recipient.
                        </div>
                </div>


                <form method="post">

                    <div class="row g-3">


                        <div class="col-md-12">

                            <label class="form-label">
                                title
                            </label>

                            <input
                                    class="form-control"
                                    type="text"
                                    name="tns_title"
                                    placeholder="Enter title"
                                    required>

                        </div>


                        <div class="col-md-12">

                            <label class="form-label">
                                Message
                            </label>

                            <textarea
                                    class="form-control"
                                    name="tns_message"
                                    placeholder="Enter message "
                                    required>
                            </textarea>

                        </div>


                        <div class="col-md-12">

                            <label class="form-label">
                                Landing Page URL
                            </label>

                            <input
                                    class="form-control"
                                    type="text"
                                    name="tns_link"
                                    placeholder="Enter landing page URL"
                                    >

                        </div>

                        <div class="col-12">
                            <label class="form-label fw-semibold">Notification Type</label>

                            <div class="row g-3">

                                <div class="col-6 col-md-4">
                                    <div class="form-check border rounded-3 p-3 ps-5 h-100">
                                        <input class="form-check-input"
                                               type="radio"
                                               name="tns_type"
                                               id="tns_type_time"
                                               value="1"
                                               required>
                                        <label class="form-check-label" for="tns_type_time">
                                            <i class="bi bi-clock me-1"></i> Time
                                        </label>
                                    </div>
                                </div>

                                <div class="col-6 col-md-4">
                                    <div class="form-check border rounded-3 p-3 ps-5 h-100">
                                        <input class="form-check-input"
                                               type="radio"
                                               name="tns_type"
                                               id="tns_type_news"
                                               value="2">
                                        <label class="form-check-label" for="tns_type_news">
                                            <i class="bi bi-newspaper me-1"></i> News Website
                                        </label>
                                    </div>
                                </div>

                                <div class="col-6 col-md-4">
                                    <div class="form-check border rounded-3 p-3 ps-5 h-100">
                                        <input class="form-check-input"
                                               type="radio"
                                               name="tns_type"
                                               id="tns_type_payment"
                                               value="3">
                                        <label class="form-check-label" for="tns_type_payment">
                                            <i class="bi bi-credit-card me-1"></i> Payment
                                        </label>
                                    </div>
                                </div>

                                <div class="col-6 col-md-4">
                                    <div class="form-check border rounded-3 p-3 ps-5 h-100">
                                        <input class="form-check-input"
                                               type="radio"
                                               name="tns_type"
                                               id="tns_type_user"
                                               value="4">
                                        <label class="form-check-label" for="tns_type_user">
                                            <i class="bi bi-person me-1"></i> User
                                        </label>
                                    </div>
                                </div>

                                <div class="col-6 col-md-4">
                                    <div class="form-check border rounded-3 p-3 ps-5 h-100">
                                        <input class="form-check-input"
                                               type="radio"
                                               name="tns_type"
                                               id="tns_type_order"
                                               value="5">
                                        <label class="form-check-label" for="tns_type_order">
                                            <i class="bi bi-bag-check me-1"></i> Order
                                        </label>
                                    </div>
                                </div>

                                <div class="col-6 col-md-4">
                                    <div class="form-check border rounded-3 p-3 ps-5 h-100">
                                        <input class="form-check-input"
                                               type="radio"
                                               name="tns_type"
                                               id="tns_type_product"
                                               value="6">
                                        <label class="form-check-label" for="tns_type_product">
                                            <i class="bi bi-box-seam me-1"></i> Product
                                        </label>
                                    </div>
                                </div>

                                <div class="col-6 col-md-4">
                                    <div class="form-check border rounded-3 p-3 ps-5 h-100">
                                        <input class="form-check-input"
                                               type="radio"
                                               name="tns_type"
                                               id="tns_type_comment"
                                               value="7">
                                        <label class="form-check-label" for="tns_type_comment">
                                            <i class="bi bi-chat-dots me-1"></i> Comment
                                        </label>
                                    </div>
                                </div>

                                <div class="col-6 col-md-4">
                                    <div class="form-check border rounded-3 p-3 ps-5 h-100">
                                        <input class="form-check-input"
                                               type="radio"
                                               name="tns_type"
                                               id="tns_type_security"
                                               value="8">
                                        <label class="form-check-label" for="tns_type_security">
                                            <i class="bi bi-shield-check me-1"></i> Security
                                        </label>
                                    </div>
                                </div>

                                <div class="col-6 col-md-4">
                                    <div class="form-check border rounded-3 p-3 ps-5 h-100">
                                        <input class="form-check-input"
                                               type="radio"
                                               name="tns_type"
                                               id="tns_type_announcement"
                                               value="9">
                                        <label class="form-check-label" for="tns_type_announcement">
                                            <i class="bi bi-megaphone me-1"></i> Announcement
                                        </label>
                                    </div>
                                </div>

                                <div class="col-6 col-md-4">
                                    <div class="form-check border rounded-3 p-3 ps-5 h-100">
                                        <input class="form-check-input"
                                               type="radio"
                                               name="tns_type"
                                               id="tns_type_system"
                                               value="10">
                                        <label class="form-check-label" for="tns_type_system">
                                            <i class="bi bi-gear me-1"></i> System
                                        </label>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>


                    <div class="mt-4">

                        <?php

                        submit_button(
                            'Save Notice',
                            'primary',
                            'submit',
                            false,
                            ['class' => 'btn btn-primary']

                        );



                        wp_nonce_field(
                            '_nonce_tns_setting_notice',
                            '_nonce_tns_setting_notice'
                        );

                        ?>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

<div
        class="modal fade"
        id="editNotificationModal"
        tabindex="-1"
        aria-labelledby="editNotificationModalLabel"
        aria-hidden="true"
>
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5
                        class="modal-title"
                        id="editNotificationModalLabel"
                >
                    Edit Notification
                </h5>

                <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                ></button>
            </div>

            <div class="modal-body">

                <form method="post">

                    <input
                            type="hidden"
                            name="notification_id"
                            id="edit_notification_id"
                    >

                    <div class="row g-3">

                        <div class="col-12">
                            <label
                                    for="edit_notification_title"
                                    class="form-label"
                            >
                                Title
                            </label>

                            <input
                                    type="text"
                                    class="form-control"
                                    name="tns_title"
                                    id="edit_notification_title"
                                    placeholder="Enter notification title"
                                    required
                            >
                        </div>

                        <div class="col-12">
                            <label
                                    for="edit_notification_message"
                                    class="form-label"
                            >
                                Message
                            </label>

                            <textarea
                                    class="form-control"
                                    name="tns_message"
                                    id="edit_notification_message"
                                    rows="4"
                                    placeholder="Enter notification message"
                                    required
                            ></textarea>
                        </div>

                        <div class="col-12">
                            <label
                                    for="edit_notification_link"
                                    class="form-label"
                            >
                                Landing Page URL
                            </label>

                            <input
                                    type="url"
                                    class="form-control"
                                    name="tns_link"
                                    id="edit_notification_link"
                                    placeholder="https://example.com"
                            >
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-semibold">
                                Notification Type
                            </label>

                            <div class="row g-3">

                                <?php
                                $notification_types = [
                                    1  => ['Time', 'bi-clock'],
                                    2  => ['News Website', 'bi-newspaper'],
                                    3  => ['Payment', 'bi-credit-card'],
                                    4  => ['User', 'bi-person'],
                                    5  => ['Order', 'bi-bag-check'],
                                    6  => ['Product', 'bi-box-seam'],
                                    7  => ['Comment', 'bi-chat-dots'],
                                    8  => ['Security', 'bi-shield-check'],
                                    9  => ['Announcement', 'bi-megaphone'],
                                    10 => ['System', 'bi-gear'],
                                ];

                                foreach ($notification_types as $type_id => $type_data) :
                                    $radio_id = 'edit_notification_type_' . $type_id;
                                    ?>

                                    <div class="col-6 col-md-4">
                                        <div class="form-check border rounded-3 p-3 ps-5 h-100">

                                            <input
                                                    class="form-check-input"
                                                    type="radio"
                                                    name="tns_type"
                                                    id="<?php echo esc_attr($radio_id); ?>"
                                                    value="<?php echo esc_attr($type_id); ?>"
                                                    required
                                            >

                                            <label
                                                    class="form-check-label"
                                                    for="<?php echo esc_attr($radio_id); ?>"
                                            >
                                                <i class="bi <?php echo esc_attr($type_data[1]); ?> me-1"></i>
                                                <?php echo esc_html($type_data[0]); ?>
                                            </label>

                                        </div>
                                    </div>

                                <?php endforeach; ?>

                            </div>
                        </div>

                    </div>

                    <div class="mt-4 d-flex justify-content-end gap-2">

                        <button
                                type="button"
                                class="btn btn-light"
                                data-bs-dismiss="modal"
                        >
                            Cancel
                        </button>

                        <button
                                type="submit"
                                name="wooen_update_notification"
                                value="1"
                                class="btn btn-primary"
                        >
                            Update Notification
                        </button>

                    </div>

                    <?php
                    wp_nonce_field(
                        'wooen_update_notification',
                        'wooen_update_notification_nonce'
                    );
                    ?>

                </form>

            </div>
        </div>
    </div>
</div>
