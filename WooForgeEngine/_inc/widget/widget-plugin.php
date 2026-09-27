<?php

add_action('wp_dashboard_setup', 'wooen_widget_plugin');

function wooen_widget_plugin(): void
{
    wp_add_dashboard_widget(
        'vip_widget',
        __('Shanul WordPress', 'woo-forge-engine'),
        'wooen_widget_plugin_html',
        '',
        '',
        'side',
        'high'
    );
}

function wooen_widget_plugin_html(): void
{
    ?>

    <div class="container-fluid p-0">

        <div
                class="card border-0 shadow-sm overflow-hidden"
                style="border-radius: 14px;"
        >

            <!-- Header -->
            <div
                    class="text-white p-4"
                    style="
                    background: linear-gradient(135deg, #0073aa, #005177);
                "
            >

                <div class="d-flex align-items-center gap-3">

                    <div
                            class="d-flex align-items-center justify-content-center bg-white text-primary rounded-circle"
                            style="
                            width: 55px;
                            height: 55px;
                            font-size: 24px;
                        "
                    >
                        W
                    </div>

                    <div>

                        <div class="text-white-50 small mb-1">
                            <?php esc_html_e('WordPress Development', 'woo-forge-engine'); ?>
                        </div>

                        <h3 class="text-white fw-bold mb-0">
                            <?php esc_html_e('Shanul WordPress', 'woo-forge-engine'); ?>
                        </h3>

                    </div>

                </div>

            </div>


            <!-- Content -->
            <div class="card-body p-4">

                <p
                        class="fw-bold mb-2"
                        style="
                        color: #1d2327;
                        font-size: 17px;
                    "
                >
                    <?php esc_html_e('Developed & Maintained by Shanul WordPress', 'woo-forge-engine'); ?>
                </p>


                <p
                        class="mb-3"
                        style="
                        color: #646970;
                        line-height: 1.8;
                    "
                >
                    <?php esc_html_e(
                        'This plugin is developed and maintained by',
                        'woo-forge-engine'
                    ); ?>

                    <strong style="color: #1d2327;">
                        <?php esc_html_e('Shanul WordPress', 'woo-forge-engine'); ?>
                    </strong>.
                </p>


                <div
                        class="p-3 mb-4 rounded-3"
                        style="
                        background: #f0f6fc;
                        border-left: 4px solid #0073aa;
                    "
                >

                    <span
                            style="
                            color: #3c434a;
                            line-height: 1.8;
                        "
                    >
                        <?php esc_html_e(
                            'Your support helps us continue developing and improving our WordPress products.',
                            'woo-forge-engine'
                        ); ?>
                    </span>

                </div>


                <!-- Donation -->
                <div
                        class="d-flex align-items-center justify-content-between flex-wrap gap-3"
                >

                    <div>

                        <small class="d-block text-muted mb-1">
                            <?php esc_html_e(
                                'Support WordPress Development',
                                'woo-forge-engine'
                            ); ?>
                        </small>

                        <strong style="color: #1d2327;">
                            <?php esc_html_e(
                                'Help us build better WordPress tools 🚀',
                                'woo-forge-engine'
                            ); ?>
                        </strong>

                    </div>


                    <a
                            href="https://daramet.com/d_mahdi47?webintent&donate=300000&message=thanks
"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="btn btn-primary px-4 py-2 fw-semibold shadow-sm"
                            style="
                            background-color: #0073aa;
                            border-color: #0073aa;
                            border-radius: 8px;
                        "
                    >
                        <?php esc_html_e('❤️ Support Us', 'woo-forge-engine'); ?>
                    </a>

                </div>

            </div>

        </div>

    </div>

    <?php
}