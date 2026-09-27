<?php
add_action('wp_ajax_wooen_bookmark_post',  'wooen_bookmark_post');

function wooen_bookmark_post(): void
{
    if ( !is_user_logged_in() ) {
        wp_send_json( [ 'error' => true, 'message' => 'لطفا اول وارد شوید!!' ], 403 );
    }
    if ( ! isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'wooen_nonce') ) {
        die( 'access denied' );
    }

    $post_id = intval( $_POST['post_id'] );
    $user_id =intval( $_POST['user_id'] );
    is_user_liked_post($user_id, $post_id);
    if (!metadata_exists('user',$user_id,'_wooen_bookmark_post_ids')) {
        $meta_value[] = $post_id;
        add_user_meta( $user_id, '_wooen_bookmark_post_ids', $meta_value );
    }else{
        $current_meta_value = get_user_meta( $user_id, '_wooen_bookmark_post_ids', true );
        $current_meta_value[]= $post_id;
        update_user_meta( $user_id, '_wooen_bookmark_post_ids', $current_meta_value );
    }
    add_to_like_counter( $post_id );

}
function is_user_liked_post($user_id,$post_id): void
{
    $user_liked_post_ids = get_user_meta($user_id,'_wooen_bookmark_post_ids',true);
    foreach ($user_liked_post_ids as $value) {
        if ($value == $post_id) {
            wp_send_json([
                'error'=>true,
                'message'=>'شما قبلا این مطلب را لایک کرده اید!'
            ],403);
        }
    }
}

function add_to_like_counter($post_id): void
{
    if (!metadata_exists('post',$post_id,'_wooen_bookmark_number')) {
        add_post_meta( $post_id, '_wooen_bookmark_number',1);
    }else{
        $bookmark_number = get_post_meta( $post_id, '_wooen_bookmark_number', true );
        $bookmark_number++;
        update_post_meta( $post_id, '_wooen_bookmark_number', $bookmark_number );
    }
}