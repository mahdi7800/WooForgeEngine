
<?php

if (!current_user_can('manage_options')) {
    return;
}

$banners = new Banner();
$banners->wooen_handle_admin_actions();
$home_banners = $banners->wooen_get_banner_to_admin();
$message = $banners->get_message();

?>

<style>

    /*
     * Full Width Banner Settings
     */
    .wooen-banner-wrapper {
        width: 100%;
        max-width: none;
        margin: 0;
        padding: 20px 20px 20px 0;
        box-sizing: border-box;
    }

    .wooen-banner-wrapper *,
    .wooen-banner-wrapper *::before,
    .wooen-banner-wrapper *::after {
        box-sizing: border-box;
    }

    /*
     * Full width card
     */
    .wooen-banner-wrapper .card {
        width: 100%;
        max-width: none;
    }

    /*
     * Full width table
     */
    .wooen-banner-wrapper .table-responsive {
        width: 100%;
    }

    .wooen-banner-wrapper table {
        width: 100%;
        margin-bottom: 0;
    }

    /*
     * Image
     */
    .wooen-banner-image {
        width: 100px;
        height: 60px;
        object-fit: cover;
        display: block;
    }

    /*
     * URL column
     */
    .wooen-banner-link {
        word-break: break-word;
    }

    /*
     * WordPress admin bottom spacing
     */
    #wpbody-content {
        padding-bottom: 40px;
    }

    /*
     * Mobile
     */
    @media (max-width: 782px) {

        .wooen-banner-wrapper {
            padding: 15px 10px;
        }

        .wooen-banner-wrapper .table-responsive {
            overflow-x: auto;
        }

    }

</style>


<div class="wooen-banner-wrapper">

    <?php if (!empty($message)) : ?>

        <?php echo $message; ?>

    <?php endif; ?>


    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h4 class="mb-1">
                <?php echo esc_html(get_admin_page_title()); ?>
            </h4>

            <p class="text-muted mb-0">
                Manage your website banners.
            </p>

        </div>


        <button
                type="button"
                class="btn btn-primary"
                data-bs-toggle="modal"
                data-bs-target="#addBannerModal">

            + Add Banner

        </button>

    </div>


    <!-- Banner Table -->
    <div class="card shadow-sm border-0">

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead class="table-dark">

                    <tr>

                        <th>#</th>

                        <th>
                            Image
                        </th>

                        <th>
                            Banner Title
                        </th>

                        <th>
                            Landing Page URL
                        </th>

                        <th>
                            Actions
                        </th>

                    </tr>

                    </thead>


                    <tbody>

                    <?php if (!empty($home_banners)) : ?>

                        <?php $row_number = 1; ?>

                        <?php foreach ($home_banners as $banner) : ?>

                            <tr>

                                <td>
                                    <?php echo $row_number++; ?>
                                </td>


                                <td>

                                    <img
                                            src="<?php echo esc_url($banner['image_url']); ?>"
                                            alt="Banner image"
                                            class="wooen-banner-image rounded">

                                </td>


                                <td>

                                    <?php echo esc_html($banner['title']); ?>

                                </td>


                                <td class="wooen-banner-link">

                                    <a
                                            href="<?php echo esc_url($banner['link_url']); ?>"
                                            target="_blank"
                                            rel="noopener noreferrer">

                                        <?php echo esc_html($banner['link_url']); ?>

                                    </a>

                                </td>


                                <td>

                                    <div class="d-flex gap-2">

                                        <!-- Delete -->
                                        <a
                                                href="<?php echo esc_url(
                                                    add_query_arg([
                                                        'action' => 'delete',
                                                        'id'     => $banner['id']
                                                    ])
                                                ); ?>"
                                                class="btn btn-light btn-round mb-0"
                                                title="Delete Banner">

                                            <i class="fas fa-trash"></i>

                                        </a>


                                        <!-- Edit -->
                                        <button
                                                type="button"
                                                class="btn btn-light btn-round mb-0"
                                                data-bs-toggle="modal"
                                                data-bs-target="#editBannerModal"
                                                data-id="<?php echo esc_attr($banner['id']); ?>"
                                                data-image="<?php echo esc_attr($banner['image_url']); ?>"
                                                data-title="<?php echo esc_attr($banner['title']); ?>"
                                                data-link="<?php echo esc_attr($banner['link_url']); ?>"
                                                title="Edit Banner">


                                            <i class="fas fa-edit"></i>

                                        </button>

                                    </div>

                                </td>

                            </tr>

                        <?php endforeach; ?>


                    <?php else : ?>

                        <tr>

                            <td
                                    colspan="5"
                                    class="text-center py-4 text-muted">

                                No banners have been added yet.

                            </td>

                        </tr>

                    <?php endif; ?>

                    </tbody>

                </table>

            </div>

        </div>

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
                        Banner Title Guide
                    </h6>

                    <p class="mb-2">

                        The banner title consists of two parts:
                        <strong>Landing Page Name</strong>
                        and
                        <strong>Main Title</strong>.

                    </p>


                    <p class="mb-2">

                        Separate the two parts using the
                        <strong>|</strong>
                        character.

                    </p>


                    <div class="small text-muted">

                        Example:
                        <code>Home Page | Summer Special Discount</code>

                    </div>

                </div>


                <form method="post">

                    <div class="row g-3">


                        <div class="col-md-4">

                            <label class="form-label">
                                Image URL
                            </label>

                            <input
                                    class="form-control"
                                    type="text"
                                    name="tns_image"
                                    placeholder="Enter image URL"
                                    required>

                        </div>


                        <div class="col-md-4">

                            <label class="form-label">
                                Banner Title
                            </label>

                            <input
                                    class="form-control"
                                    type="text"
                                    name="tns_title"
                                    placeholder="Enter banner title"
                                    required>

                        </div>


                        <div class="col-md-4">

                            <label class="form-label">
                                Landing Page URL
                            </label>

                            <input
                                    class="form-control"
                                    type="text"
                                    name="tns_link"
                                    placeholder="Enter landing page URL"
                                    required>

                        </div>

                    </div>


                    <div class="mt-4">

                        <?php

                        submit_button(
                            'Save Banner',
                            'primary',
                            'submit',
                            false,
                            ['class' => 'btn btn-primary']

                        );



                        wp_nonce_field(
                            '_nonce_tns_setting_banner',
                            '_nonce_tns_setting_banner'
                        );

                        ?>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>



<!-- =========================================================
     Edit Banner Modal
========================================================= -->

<div
        class="modal fade"
        id="editBannerModal"
        tabindex="-1"
        aria-labelledby="editBannerModalLabel"
        aria-hidden="true">

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content">


            <div class="modal-header">

                <h5
                        class="modal-title"
                        id="editBannerModalLabel">

                    Edit Banner

                </h5>


                <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close">
                </button>

            </div>


            <div class="modal-body">

                <form method="post">


                    <input
                            type="hidden"
                            name="edit_id"
                            id="edit_id">


                    <div class="row g-3">


                        <div class="col-md-4">

                            <label class="form-label">
                                Image URL
                            </label>

                            <input
                                    class="form-control"
                                    type="text"
                                    name="edit_image"
                                    id="edit_image"
                                    placeholder="Enter image URL"
                                    required>

                        </div>


                        <div class="col-md-4">

                            <label class="form-label">
                                Banner Title
                            </label>

                            <input
                                    class="form-control"
                                    type="text"
                                    name="edit_title"
                                    id="edit_title"
                                    placeholder="Enter banner title"
                                    required>

                        </div>


                        <div class="col-md-4">

                            <label class="form-label">
                                Landing Page URL
                            </label>

                            <input
                                    class="form-control"
                                    type="text"
                                    name="edit_link"
                                    id="edit_link"
                                    placeholder="Enter landing page URL"
                                    required>

                        </div>

                    </div>


                    <div class="mt-4">

                        <?php

                        submit_button(
                            'Save Changes',
                            'primary',
                            'edit_submit',
                            false,
                            ['class' => 'btn btn-primary']
                        );


                        wp_nonce_field(
                            '_nonce_tns_edit_banner',
                            '_nonce_tns_edit_banner'
                        );

                        ?>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

