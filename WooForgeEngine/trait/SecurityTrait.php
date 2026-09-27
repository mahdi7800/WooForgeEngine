<?php

trait SecurityTrait
{

    /**
     * Verifies the AJAX security nonce.
     *
     * Terminates the request with a 403 response when the nonce
     * is missing or invalid.
     *
     * @since 1.0.0
     *
     * @return void
     */
    protected function wooen_verifyNonce(): void
    {
        if (
            !isset($_POST['nonce']) ||
            !wp_verify_nonce($_POST['nonce'], 'wooen_nonce')
        ) {
            wp_send_json([
                'error'   => true,
                'message' => 'Unauthorized request.'
            ], 403);
        }
    }
}