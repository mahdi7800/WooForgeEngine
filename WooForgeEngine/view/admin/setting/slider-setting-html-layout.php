
<?php

if (!current_user_can('manage_options')) {
    return;
}

$sliders = new Slider();
$sliders->wooen_handle_admin_actions();
$home_sliders = $sliders->wooen_get_slider_to_admin();
$message = $sliders->get_message();

?>
<style>

    .wooen-slider-wrapper {
        width: 100%;
        max-width: none;
        margin: 0;
        padding: 20px 20px 20px 0;
        box-sizing: border-box;
    }

    .wooen-slider-wrapper *,
    .wooen-slider-wrapper *::before,
    .wooen-slider-wrapper *::after {
        box-sizing: border-box;
    }

    .wooen-slider-wrapper .card {
        width: 100%;
        max-width: none;
    }

    .wooen-slider-wrapper .table-responsive {
        width: 100%;
    }

    .wooen-slider-wrapper table {
        width: 100%;
        margin-bottom: 0;
    }

    .wooen-slider-image {
        width: 100px;
        height: 60px;
        object-fit: cover;
        display: block;
    }

    .wooen-slider-link {
        word-break: break-word;
    }

    #wpbody-content {
        padding-bottom: 40px;
    }

    @media (max-width: 782px) {

        .wooen-slider-wrapper {
            padding: 15px 10px;
        }

        .wooen-slider-wrapper .table-responsive {
            overflow-x: auto;
        }

    }

</style>
<div class="wooen-slider-wrapper">


    <?php echo $message; ?>

    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h4 class="mb-1">
                <?php echo esc_html(get_admin_page_title()); ?>
            </h4>

            <p class="text-muted mb-0">
                Manage your website slider.
            </p>
        </div>

            <button
                    type="button"
                    class="btn btn-primary"
                    data-bs-toggle="modal"
                    data-bs-target="#modal-add-slider">
                + Add Slider
            </button>

    </div>


    <!-- Slider Table -->
    <div class="card shadow-sm border-0">

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

            <thead class="table-dark">

            <tr>
                <th>#</th>
                <th>Image</th>
                <th>Top Title</th>
                <th>Main Title</th>
                <th>Subtitle</th>
                <th>Landing Page URL</th>
                <th>Actions</th>
            </tr>

            </thead>

            <tbody>

            <?php if (!empty($home_sliders)) : ?>

                <?php $row_number = 1; ?>

                <?php foreach ($home_sliders as $slider) : ?>

                    <tr>

                        <!-- Row Number -->
                        <td>
                            <?php echo $row_number++; ?>
                        </td>


                        <!-- Image -->
                        <td>

                            <div class="overflow-hidden rounded"
                                 style="width: 100px; height: 60px;">

                                <?php

                                $image_sliders = explode('++', $slider['p_image']);

                                $desktop_image_sliders = isset($image_sliders[0])
                                    ? esc_url(trim($image_sliders[0]))
                                    : '';

                                $mobile_image_sliders = isset($image_sliders[1])
                                    ? esc_url(trim($image_sliders[1]))
                                    : $desktop_image_sliders;

                                ?>

                                <img
                                        src="<?php echo $mobile_image_sliders; ?>"
                                        alt="Slider Image"
                                        class="wooen-slider-image rounded"
                                >

                            </div>

                        </td>


                        <!-- Top Title -->
                        <td>
                            <?php echo esc_html($slider['top_title']); ?>
                        </td>


                        <!-- Main Title -->
                        <td>
                            <?php echo esc_html($slider['main_title']); ?>
                        </td>


                        <!-- Subtitle -->
                        <td>
                            <?php echo esc_html($slider['sub_title']); ?>
                        </td>


                        <!-- Landing Page URL -->
                        <td>

                            <a href="<?php echo esc_url($slider['p_thumbnail']); ?>"
                               target="_blank"
                               rel="noopener noreferrer">

                                <?php echo esc_html($slider['p_thumbnail']); ?>

                            </a>

                        </td>


                        <!-- Actions -->
                        <td style="white-space: nowrap;">

                            <!-- Delete -->
                            <a href="<?php echo esc_url(
                                add_query_arg([
                                    'action' => 'delete',
                                    'id'     => $slider['id']
                                ])
                            ); ?>"
                               title="Delete Slider"
                               class="btn btn-light btn-round mb-0">

                                <i class="fas fa-trash"></i>

                            </a>


                            <!-- Edit -->
                            <button
                                    type="button"
                                    class="btn btn-light btn-round mb-0"
                                    data-bs-toggle="modal"
                                    data-bs-target="#edit-slider-modal"
                                    title="Edit Slider"

                                    data-id="<?php echo esc_attr($slider['id']); ?>"
                                    data-top-title="<?php echo esc_attr($slider['top_title']); ?>"
                                    data-main-title="<?php echo esc_attr($slider['main_title']); ?>"
                                    data-sub-title="<?php echo esc_attr($slider['sub_title']); ?>"
                                    data-p-thumbnail="<?php echo esc_attr($slider['p_thumbnail']); ?>"
                                    data-p-image="<?php echo esc_attr($slider['p_image']); ?>">

                                <i class="fas fa-edit"></i>

                            </button>

                        </td>

                    </tr>

                <?php endforeach; ?>

            <?php else : ?>

                <tr>
                    <td colspan="7" class="text-center text-muted py-4">
                        No sliders have been added yet.
                    </td>
                </tr>

            <?php endif; ?>

            </tbody>

        </table>
         </div>
        </div>

    </div>


</div>


<!-- ========================================================= -->
<!-- Add Slider Modal -->
<!-- ========================================================= -->

<div class="modal fade"
     id="modal-add-slider"
     tabindex="-1"
     aria-labelledby="modalAddSliderLabel"
     aria-hidden="true">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">

                <h5 class="modal-title" id="modalAddSliderLabel">
                    Add New Slider
                </h5>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close">
                </button>

            </div>


            <!-- Modal Body -->
            <div class="modal-body">

                <form method="post">

                    <!-- Image -->
                    <div class="mb-3">

                        <label for="tns_images" class="form-label">
                            Image URL
                        </label>

                        <input
                                class="form-control"
                                type="text"
                                name="tns_images"
                                id="tns_images"
                                placeholder="Enter image URL"
                                required
                        >

                    </div>


                    <!-- Top Title -->
                    <div class="mb-3">

                        <label for="tns_top_title" class="form-label">
                            Top Title
                        </label>

                        <input
                                class="form-control"
                                type="text"
                                name="tns_top_title"
                                id="tns_top_title"
                                placeholder="Enter top title"
                        >

                    </div>


                    <!-- Main Title -->
                    <div class="mb-3">

                        <label for="tns_main_title" class="form-label">
                            Main Title
                        </label>

                        <input
                                class="form-control"
                                type="text"
                                name="tns_main_title"
                                id="tns_main_title"
                                placeholder="Enter main title"
                                required
                        >

                    </div>


                    <!-- Subtitle -->
                    <div class="mb-3">

                        <label for="tns_sub_title" class="form-label">
                            Subtitle
                        </label>

                        <input
                                class="form-control"
                                type="text"
                                name="tns_sub_title"
                                id="tns_sub_title"
                                placeholder="Enter subtitle"
                        >

                    </div>


                    <!-- Landing Page -->
                    <div class="mb-3">

                        <label for="tns_link" class="form-label">
                            Landing Page URL
                        </label>

                        <input
                                class="form-control"
                                type="text"
                                name="tns_link"
                                id="tns_link"
                                placeholder="Enter landing page URL"
                                required
                        >

                    </div>


                    <!-- Footer -->
                    <div class="d-flex justify-content-end gap-2">

                        <button
                                type="button"
                                class="btn btn-secondary"
                                data-bs-dismiss="modal">
                            Cancel
                        </button>

                        <?php
                        submit_button(
                            'Save Slider',
                            'primary',
                            'submit',
                            false,
                            [
                                'class' => 'btn btn-primary'
                            ]
                        );
                        ?>

                    </div>


                    <?php
                    wp_nonce_field(
                        '_nonce_wooen_edit_slider',
                        '_nonce_wooen_edit_slider'
                    );
                    ?>

                </form>

            </div>

        </div>

    </div>

</div>


<!-- ========================================================= -->
<!-- Edit Slider Modal -->
<!-- ========================================================= -->

<div class="modal fade"
     id="edit-slider-modal"
     tabindex="-1"
     aria-labelledby="editSliderModalLabel"
     aria-hidden="true">

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">

                <h5 class="modal-title" id="editSliderModalLabel">
                    Edit Slider
                </h5>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close">
                </button>

            </div>


            <!-- Modal Body -->
            <div class="modal-body">

                <form method="post">

                    <input
                            type="hidden"
                            name="edit_id"
                            id="edit_id"
                    >


                    <!-- Image -->
                    <div class="mb-3">

                        <label for="edit_tns_images" class="form-label">
                            Image URL
                        </label>

                        <input
                                class="form-control"
                                type="text"
                                name="edit_tns_images"
                                id="edit_tns_images"
                                placeholder="Enter image URL"
                                required
                        >

                    </div>


                    <!-- Top Title -->
                    <div class="mb-3">

                        <label for="edit_tns_top_title" class="form-label">
                            Top Title
                        </label>

                        <input
                                class="form-control"
                                type="text"
                                name="edit_tns_top_title"
                                id="edit_tns_top_title"
                                placeholder="Enter top title"
                        >

                    </div>


                    <!-- Main Title -->
                    <div class="mb-3">

                        <label for="edit_tns_main_title" class="form-label">
                            Main Title
                        </label>

                        <input
                                class="form-control"
                                type="text"
                                name="edit_tns_main_title"
                                id="edit_tns_main_title"
                                placeholder="Enter main title"
                                required
                        >

                    </div>


                    <!-- Subtitle -->
                    <div class="mb-3">

                        <label for="edit_tns_sub_title" class="form-label">
                            Subtitle
                        </label>

                        <input
                                class="form-control"
                                type="text"
                                name="edit_tns_sub_title"
                                id="edit_tns_sub_title"
                                placeholder="Enter subtitle"
                        >

                    </div>


                    <!-- Landing Page -->
                    <div class="mb-3">

                        <label for="edit_tns_link" class="form-label">
                            Landing Page URL
                        </label>

                        <input
                                class="form-control"
                                type="text"
                                name="edit_tns_link"
                                id="edit_tns_link"
                                placeholder="Enter landing page URL"
                                required
                        >

                    </div>


                    <!-- Footer -->
                    <div class="d-flex justify-content-end gap-2">

                        <button
                                type="button"
                                class="btn btn-secondary"
                                data-bs-dismiss="modal">
                            Cancel
                        </button>

                        <?php
                        submit_button(
                            'Save Changes',
                            'primary',
                            'edit_submit',
                            false,
                            [
                                'class' => 'btn btn-primary'
                            ]
                        );
                        ?>

                    </div>


                    <?php
                    wp_nonce_field(
                        '_nonce_wooen_edit_slider',
                        '_nonce_wooen_edit_slider'
                    );
                    ?>

                </form>

            </div>

        </div>

    </div>

</div>

