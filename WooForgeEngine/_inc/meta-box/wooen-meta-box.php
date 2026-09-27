<?php
add_action('add_meta_boxes','wooen_add_meta_box_send_post_newsletter');

function wooen_add_meta_box_send_post_newsletter(): void
{
	add_meta_box(
            'wooen_send_post_newsletter'
        ,'Newsletter'
        ,'wooen_send_post_newsletter_layout'
		,'post',
		'normal',
		'high'
    );
}
function wooen_send_post_newsletter_layout($post): void
{
   $send_newsletter = get_post_meta($post->ID,'_wooen_send_post_newsletter',true);
   wp_nonce_field('wooen_nonce_send_post_newsletter_action','wooen_nonce_send_post_newsletter_action'); ?>
    <div>
        <label>
            <input name="send_post_newsletter" type="checkbox" value="1" <?php checked($send_newsletter , 1) ?>>
            <span>
                Send this post to newsletter subscribers
            </span>
        </label>
        <p class="description">
            Enable this option to send this post to all active newsletter subscribers.
        </p>
    </div>

<?php }

add_action('save_post','wooen_send_post_newsletter_save_post');

function wooen_send_post_newsletter_save_post($post_id): void
{
	// Verify nonce
	if (!isset($_POST['wooen_nonce_send_post_newsletter_action']) || !wp_verify_nonce($_POST['wooen_nonce_send_post_newsletter_action'], 'wooen_nonce_send_post_newsletter_action')) {
		return;
	}

	// Check autosave
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return;
	}

	// Check permissions
	if (!current_user_can('edit_post', $post_id)) {
		return;
	}

	// Save or delete meta
	if (isset($_POST['send_post_newsletter'])) {
		update_post_meta($post_id, '_wooen_send_post_newsletter', 1);
	} else {
		update_post_meta($post_id, '_wooen_send_post_newsletter', 0);
	}
}


add_action('add_meta_boxes', 'wooen_add_meta_box_popular');

function wooen_add_meta_box_popular(): void
{
    add_meta_box(
        'wooen_add_meta_box_popular',
        'محبوب ترین محصول شما',
        'wooen_add_meta_box_popular_layout',
        'product',
        'normal',
        'high'
    );
}
function wooen_add_meta_box_popular_layout($post): void
{
    $show_popular = get_post_meta($post->ID, '_wooen_check_popular', true);
    wp_nonce_field('wooen_nonce_popular_action', 'wooen_nonce_popular_action');
    ?>
    <div>
        <label>
            <input type="checkbox" name="show_popular" value="1" <?php checked($show_popular, 1); ?>>
            <span>محبوب ترین محصول از دید شما آن را انتخاب کنید!</span>
        </label>
    </div>
    <?php
}

add_action('save_post', 'wooen_add_meta_box_popular_save_post');

function wooen_add_meta_box_popular_save_post($post_id): void
{
    // Verify nonce
    if (!isset($_POST['wooen_nonce_popular_action']) || !wp_verify_nonce($_POST['wooen_nonce_popular_action'], 'tns_nonce_popular_action')) {
        return;
    }

    // Check autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // Check permissions
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    // Save or delete meta
    if (isset($_POST['show_popular'])) {
        update_post_meta($post_id, '_wooen_check_popular', 1);
    } else {
        update_post_meta($post_id, '_wooen_check_popular', 0);
    }
}
