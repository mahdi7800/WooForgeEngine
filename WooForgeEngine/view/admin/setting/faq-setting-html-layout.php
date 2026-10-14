<?php
if ( ! current_user_can( 'manage_options' ) ) {
    return;
}

$faq = new Faq();
$faq->wooen_handle_admin_actions();
$headers_faq = $faq->select_header();
$faq_details_s = $faq->select_detail();
$message = $faq->get_message();
$count = 1;
?>

<div class="uk-container">
    <?php echo $message; ?>
    <div class="uk-alert-primary" uk-alert> <a href class="uk-alert-close" uk-close></a>
        <p>You can create frequently asked questions about your website from this section.</p>
    </div>



    <!-- فرم اول: ایجاد تیتر -->
    <form method="post">
        <div class="uk-margin">
            <input class="uk-input uk-width-1-2 tnm-headers" name="tnm-headers" type="text" placeholder="Enter the FAQ title or subject." aria-label="uk-width-1-2" required>
        </div> <div class="uk-width-1-1">
            <?php submit_button('Save Title', 'primary', 'submit-faq-header'); ?> <?php wp_nonce_field('_nonce_tnm_setting_faq', '_nonce_tnm_setting_faq'); ?>
        </div>
    </form>

    <?php if(!empty($headers_faq)) : ?>

        <form method="post">
            <div class="uk-margin">
                <div uk-form-custom="target: > * > span:first-child">
                    <select aria-label="Custom controls" name="faq_header_id" required>
                        <option value="">Select a subject</option> <?php foreach($headers_faq as $header_faq) : ?> <option value="<?php echo intval($header_faq['ID']); ?>"> <?php echo esc_html($header_faq['header']); ?> </option> <?php endforeach; ?>
                    </select> <button class="uk-button uk-button-default" type="button" tabindex="-1">
                        <span></span> <span uk-icon="icon: chevron-down"></span>
                    </button>
                </div>
                <a href="#edit-faq-header-modal" uk-toggle uk-tooltip="title: Edit" class="uk-icon-button edit-faq-btn" uk-icon="file-edit" data-id="" data-faq-question="" data-faq-answer="" data-faq-id=""> </a>
            </div>
            <div class="uk-margin"> <input class="uk-input uk-form-width-large faq-question" name="faq-question" id="faq-question" type="text" placeholder="Enter your question here." aria-label="Large" required>
            </div>
            <div class="uk-margin"> <textarea class="uk-textarea faq-answer" name="faq-answer" id="faq-answer" rows="5" placeholder="Enter the answer here." aria-label="Textarea" required></textarea> </div>
            <div class="uk-width-1-1"> <?php submit_button('Save Question & Answer', 'primary', 'submit-faq-details'); ?> <?php wp_nonce_field('_nonce_tnm_setting_faq_details', '_nonce_tnm_setting_faq_details'); ?> </div>
        </form>
    <?php endif; ?>

    <?php if(!empty($faq_details_s)) : ?>

    <table class="table align-middle p-4 mb-0 table-hover">
        <thead class="table-dark">
        <tr>
            <th class="border-0 rounded-start">#</th>
            <th class="border-0">Title & Subject</th>
            <th class="border-0">Question</th>
            <th class="border-0">Answer</th>
            <th class="border-0">Actions</th>
        </tr>
        </thead>
        <tbody class="border-top-0">
        <?php foreach($faq_details_s as $faq_details) : ?>
        <tr>
            <td><?php echo $count++ ?></td>
            <td><?php echo esc_html($faq_details['header']) ?></td>
            <td><?php echo esc_html($faq_details['faq_question']) ?></td>
            <td><?php echo esc_html($faq_details['faq_answer']) ?></td>
            <td class="uk-text-right" style="white-space: nowrap;">
                <div style="display: flex; align-items: center; justify-content: flex-end; flex-direction: row-reverse;gap: 5px;">



                    <a href="#edit-faq-modal"
                       uk-toggle
                       uk-tooltip="title: Edit FAQ"
                       class="btn btn-light btn-round mb-0 edit-faq-btn"
                       data-id="<?php echo esc_attr($faq_details['ID']); ?>"
                       data-faq-question="<?php echo esc_attr($faq_details['faq_question']); ?>"
                       data-faq-answer="<?php echo esc_attr($faq_details['faq_answer']); ?>"
                       data-faq-id="<?php echo esc_attr($faq_details['faq_id']); ?>">

                        <i class="fas fa-edit"></i>

                    </a>
                    <a href="<?php echo esc_url(
                        add_query_arg([
                            'action' => 'delete_detail',
                            'id' => $faq_details['ID']
                        ])
                    ); ?>"
                       class="btn btn-light btn-round mb-0"
                       data-bs-toggle="tooltip"
                       data-bs-placement="top"
                       title="Delete FAQ"
                       aria-label="Delete FAQ">

                        <i class="fas fa-trash"></i>

                    </a>
                </div>
            </td>
        </tr>

        <?php endforeach; ?>
        </tbody>
    </table>
    <?php else :?>
    <div class="alert alert-info">چیزی وجود ندارد!</div>
    <?php endif; ?>
</div>


<!-- Modal Update FAQ -->
<div id="edit-faq-modal" uk-modal>
    <div class="uk-modal-dialog uk-modal-body">

        <button class="uk-modal-close-default" type="button" uk-close></button>

        <h2 class="uk-modal-title">Edit FAQ</h2>

        <form method="post" class="uk-grid-small" uk-grid>

            <?php wp_nonce_field('_nonce_tns_edit_faq','_nonce_tns_edit_faq'); ?>
            <input type="hidden" name="edit_id" id="edit_id">

            <!-- Select Topic -->
            <div class="uk-width-1-1">
                <select class="uk-select" name="faq_header_id_update" id="edit_faq_header" required>
                    <option value="">Select Topic</option>
                    <?php foreach($headers_faq as $header): ?>
                        <option value="<?= intval($header['ID']); ?>">
                            <?= esc_html($header['header']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Question -->
            <div class="uk-width-1-1">
                <input class="uk-input"
                       name="faq-question-update"
                       id="faq-question-update"
                       type="text"
                       value=""
                       placeholder="Enter your question"
                       required>
            </div>

            <!-- Answer -->
            <div class="uk-width-1-1">
                <textarea class="uk-textarea"
                          name="faq-answer-update"
                          id="faq-answer-update"
                          rows="10"
                          placeholder="Enter the answer"
                          required></textarea>
            </div>

            <!-- Save Button -->
            <div class="uk-width-1-1">
                <?php submit_button('Save Changes', 'primary', 'edit_submit_faq'); ?>
            </div>

        </form>
    </div>
</div>


<!-- Modal DELETE FAQ HEADER -->
<div id="edit-faq-header-modal" uk-modal>
    <div class="uk-modal-dialog uk-modal-body">

        <button class="uk-modal-close-default" type="button" uk-close></button>

        <h2 class="uk-modal-title">FAQ Topics</h2>

        <table class="uk-table uk-table-middle uk-table-divider">
            <thead>
            <tr>
                <th class="uk-width-small">#</th>
                <th class="uk-width-small">Title & Topic</th>
                <th>Actions</th>
            </tr>
            </thead>

            <?php $count = 1; ?>

            <?php foreach($headers_faq as $header_faq) : ?>

                <tbody>
                <tr>
                    <td><?php echo $count++; ?></td>

                    <td>
                        <?php echo esc_html($header_faq['header']); ?>
                    </td>

                    <td class="uk-text-right" style="white-space: nowrap;">

                        <a href="<?php echo esc_url(
                            add_query_arg([
                                'action' => 'delete_header',
                                'id' => $header_faq['ID']
                            ])
                        ); ?>"
                           uk-tooltip="title: Delete Topic"
                           name="tns-delete-details"
                           class="uk-icon-button tns-delete-details"
                           uk-icon="trash"
                           style="margin-left: 5px;">
                        </a>

                    </td>
                </tr>
                </tbody>

            <?php endforeach; ?>

        </table>
    </div>
</div>

