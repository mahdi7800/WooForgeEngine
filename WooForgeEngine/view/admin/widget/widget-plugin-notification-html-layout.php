<?php
if (!current_user_can('manage_options')) {
    return;
}
?>

<style>
    #notification_widget {
        min-width: 0;
        max-width: 100%;
        box-sizing: border-box;
    }

    #notification_widget .inside {
        margin: 0;
        padding: 12px;
        min-width: 0;
        box-sizing: border-box;
    }

    #notification_widget .wooen-notification-widget,
    #notification_widget .wooen-notification-widget .card,
    #notification_widget .wooen-notification-widget .card-header,
    #notification_widget .wooen-notification-widget .card-body,
    #notification_widget .wooen-notification-widget .card-footer {
        width: 100%;
        max-width: 100%;
        min-width: 0;
        box-sizing: border-box;
    }

    #notification_widget .wooen-notification-widget .row {
        display: flex;
        flex-wrap: wrap;
        width: 100%;
        margin-right: 0;
        margin-left: 0;
    }

    #notification_widget .wooen-notification-widget .row > .col-12 {
        width: 100%;
        max-width: 100%;
        min-width: 0;
        box-sizing: border-box;
    }

    #notification_widget .wooen-notification-widget .custom-scrollbar {
        width: 100%;
        max-width: 100%;
        min-width: 0;
        height: 350px;
        overflow-y: auto;
        overflow-x: hidden;
        box-sizing: border-box;
    }

    #notification_widget .wooen-notification-widget hr {
        width: 100%;
        box-sizing: border-box;
    }

    #notification_widget .wooen-notification-widget .dropdown-menu {
        z-index: 100000;
    }

    #notification_widget .wooen-notification-widget .stretched-link {
        overflow-wrap: anywhere;
    }
</style>
<?php
$notice = new Notification();
$noticies = $notice->wooen_select();
?>
<div class="wooen-notification-widget">

    <!-- Notice board START -->
    <div class="card border h-100">

        <!-- Card header -->
        <div class="card-header border-bottom d-flex justify-content-between align-items-center p-3">
            <h5 class="card-header-title mb-0">Notice board</h5>

            <!-- Dropdown button -->
            <div class="dropdown text-end">
                <a href="#"
                   class="btn border-0 p-0 mb-0"
                   role="button"
                   id="wooenDropdownShare"
                   data-bs-toggle="dropdown"
                   aria-expanded="false">
                    <i class="bi bi-three-dots fa-fw"></i>
                </a>

                <ul class="dropdown-menu dropdown-w-sm dropdown-menu-end min-w-auto shadow rounded"
                    aria-labelledby="wooenDropdownShare">
                    <li>
                        <a class="dropdown-item" href="#">
                            <i class="bi bi-pencil-square fa-fw me-2"></i>Edit
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="#">
                            <i class="bi bi-trash fa-fw me-2"></i>Remove
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Card body START -->
        <div class="card-body p-3">

            <!-- Scroll container -->
            <div class="custom-scrollbar">

                <div class="row g-0">

                <?php if($noticies) : ?>
                     <?php foreach($noticies as $notice) : ?>
                       <!-- Notice board item 1 -->
                       <div class="col-12">
                            <div class="d-flex justify-content-between position-relative">
                            <div class="d-sm-flex">

                                <?php echo utility::wooen_get_type_notif((int)$notice['type']); ?>

                                <div class="ms-0 ms-sm-3 mt-2 mt-sm-0">
                                    <h6 class="mb-0 mr-3">
                                        <a href="#" class="stretched-link"><?php echo esc_html($notice['title']); ?></a>
                                    </h6>
                                    <p class="mb-0 ml-3">
                                        <?php echo esc_html(PostExcerpt::wooen_message_notices_excerpt_more($notice['message'])); ?>
                                    </p>
                                    <span class="small"><?php echo utility::wooen_get_time_ago($notice['created_at'],'g2j') ?></span>
                                </div>
                            </div>
                        </div>
                       </div>

                      <div class="col-12">
                           <hr class="my-3">
                      </div>
                     <?php endforeach; ?>
                    <?php else : ?>
                            <div class="alert alert-info">empty nothings</div>
                     <?php endif; ?>
                </div>
                <!-- Row END -->

            </div>
            <!-- Scroll container END -->

        </div>
        <!-- Card body END -->

        <!-- Card footer -->
        <div class="card-footer border-top text-center p-3">
            <a href="<?php echo esc_url(site_url('/wp-admin/admin.php?page=setting_shop_tab_eight')) ?>">View all Notice List</a>
        </div>

    </div>
    <!-- Notice board END -->

</div>