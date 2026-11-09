<?php
$team = new TeamOur();
$team->wooen_handle_admin_actions();
$stmt= $team->wooen_select();
echo '<pre>';
var_dump($stmt);
echo '</pre>';
$message = $team->gat_message();
$count = $team->wooen_team_our_count();
$counter = 1;
?>

<div class="uk-container uk-margin-top">

    <?php echo $message; ?>

    <div class="uk-flex uk-flex-between uk-flex-middle uk-margin-medium-bottom">

        <div>
            <h5 class="uk-margin-remove uk-text-bold">
                <?php echo esc_html(get_admin_page_title()); ?>
            </h5>

            <p class="uk-text-meta uk-margin-small-top uk-margin-remove-bottom">
                مدیریت مشترکین خبرنامه
            </p>
        </div>

        <div class="uk-card uk-card-default uk-card-small uk-border-rounded">
            <div class="uk-flex uk-flex-middle uk-flex-center uk-padding-small">

                <div class="uk-margin-small-right">
                    <span uk-icon="icon: users; ratio: 1.2"></span>
                </div>

                <div>
                    <div class="uk-text-meta uk-margin-remove">
                        تعداد اعضای تیم
                    </div>

                    <div class="uk-text-bold uk-text-large uk-margin-remove">
                        <?php echo esc_html($count); ?>
                    </div>
                </div>

            </div>
        </div>

    </div>


    <div class="uk-overflow-auto">

        <table class="table align-middle p-4 mb-0 table-hover">

            <thead class="table-dark">
            <tr>
                <th class="border-0 rounded-start">#</th>
                <th class="border-0">تصویر کاربر</th>
                <th class="border-0">نام و نام خانوادگی</th>
                <th class="border-0">سمت</th>
                <th class="border-0">ایمیل</th>
                <th class="border-0">تاریخ تولد</th>
                <th class="border-0">تاریخ استخدام</th>
                <th class="border-0">وضعیت استخدام</th>
                <th class="border-0">شبکه های اجتماعی</th>
                <th class="border-0">عملیات</th>
            </tr>
            </thead>

            <tbody>

            <?php if ($stmt): ?>

                <?php foreach ($stmt as $user): ?>

                    <?php
                    $avatar = get_avatar(
                        $user['email'],
                        40,
                        'monsterid',
                        $user['email'],
                        ['class' => 'uk-preserve-width uk-border-circle']
                    );
                    ?>

                    <tr>

                        <td>
                            <?php echo $counter++; ?>
                        </td>

                        <td>
                            <?php echo $avatar; ?>
                        </td>

                        <td class="uk-table-link">
                            <a>
                                <?php echo esc_html(utility::wooen_create_full_name($user['first_name'], $user['last_name'])); ?>
                            </a>
                        </td>
                        <td class="uk-table-link">
                            <a>
                                <?php echo esc_html(utility::wooen_create_position($user['position'])); ?>
                            </a>
                        </td>

                        <td class="uk-table-link">
                            <a>
                                <?php echo esc_html($user['email']); ?>
                            </a>
                        </td>
                        <td class="uk-text-nowrap">
                            <?php echo utility::wooen_date($user['birth_date'], '/', 'g2j'); ?>
                        </td>

                        <td class="uk-text-nowrap">
                            <?php echo utility::wooen_date($user['hire_date'], '/', 'g2g'); ?>
                        </td>

                        <td class="uk-text-truncate">

                            <?php if ($user['status'] == 1): ?>

                                <span class="badge bg-success">
                                    مشغول
                                </span>

                            <?php else: ?>

                                <span class="badge bg-danger">
                                    ترک کار
                                </span>

                            <?php endif; ?>

                        </td>

                        <td>

                            <div class="newsletter-actions">
                                <?php if (!empty($user['social_links']['telegram'])): ?>
                                    <a href="<?php echo esc_url($user['social_links']['telegram']); ?>"
                                       class="btn btn-light btn-round mb-0" target="_blank"
                                       rel="noopener noreferrer" title="Telegram" aria-label="Telegram">
                                        <i class="bi bi-telegram"></i>
                                    </a>
                                <?php endif; ?>

                                <?php if (!empty($user['social_links']['instagram'])): ?>
                                    <a href="<?php echo esc_url($user['social_links']['instagram']); ?>"
                                       class="btn btn-light btn-round mb-0" target="_blank"
                                       rel="noopener noreferrer" title="Instagram" aria-label="Instagram">
                                        <i class="bi bi-instagram"></i>
                                    </a>
                                <?php endif; ?>

                                <?php if (!empty($user['social_links']['linkedin'])): ?>
                                    <a href="<?php echo esc_url($user['social_links']['linkedin']); ?>"
                                       class="btn btn-light btn-round mb-0" target="_blank"
                                       rel="noopener noreferrer" title="LinkedIn" aria-label="LinkedIn">
                                        <i class="bi bi-linkedin"></i>
                                    </a>
                                <?php endif; ?>
                            </div>

                        </td>

                        <td>

                            <div class="newsletter-actions">

                                <!-- حذف مشترک -->
                                <a
                                        href="<?php echo esc_url(
                                            add_query_arg([
                                                'action' => 'delete',
                                                'id'     => $user['id']
                                            ])
                                        ); ?>"
                                        class="btn btn-light btn-round mb-0"
                                        data-bs-toggle="tooltip"
                                        data-bs-placement="top"
                                        title="حذف کاربر"
                                        aria-label="حذف کاربر"
                                >
                                    <i class="fas fa-trash"></i>
                                </a>



                                    <?php
                                    wp_nonce_field(
                                        'wooen_update_newsletter_status',
                                        'newsletter_nonce'
                                    );
                                    ?>

                                    <input
                                            type="hidden"
                                            name="newsletter_id"
                                            value="<?php echo esc_attr($user['id']); ?>"
                                    >

                                    <label class="newsletter-switch">

                                        <input
                                                type="checkbox"
                                                name="newsletter_status"
                                                value="1"
                                                onchange="this.form.submit()"
                                            <?php checked((int) $user['status'], 1); ?>
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
                            هنوز هیچ کاربری در خبرنامه ثبت‌نام نکرده است.
                        </div>

                    </td>
                </tr>

            <?php endif; ?>

            </tbody>

        </table>

    </div>

</div>