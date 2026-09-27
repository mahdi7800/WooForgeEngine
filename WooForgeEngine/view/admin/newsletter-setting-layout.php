<?php
$newsletter = new newsletter();
$newsletter->wooen_delete();
$newsletter->wooen_update();
$users = $newsletter->wooen_select();
$message = $newsletter->get_message();
$count = $newsletter->wooen_user_count();
$counter = 1;?>


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
                <th class="border-0">Avatar</th>
                <th class="border-0">Email</th>
                <th class="border-0">Subscription Date</th>
                <th class="border-0">Account Status</th>
                <th class="border-0">Newsletter Status</th>
                <th class="border-0">Operation</th>

            </tr>
            </thead>

            <tbody>
            <?php if($users):
            foreach($users as $user): ?>
            <?php $avatar = get_avatar($user['email'],40,'monsterid',$user['email'],['class' => 'uk-preserve-width uk-border-circle']); ?>
              <tr>
                <td><?php echo $counter++; ?></td>
                <td>
                    <?php echo $avatar; ?>
                </td>
                <td class="uk-table-link">
                    <a><?php echo esc_html($user['email']); ?></a>
                </td>
                <td class="uk-text-nowrap"><?php echo utility::wooen_date($user['create at'],'/','g2g') ?></td>
                <td class="uk-text-nowrap">
                    <?php $get_user = get_user_by('email',$user['email']);
                           if ($get_user) :?>
                                <span class="badge bg-success">Registered</span>
                            <?php else :?>
                               <span class="badge bg-danger">Not Registered</span>
                           <?php endif; ?>
                </td>
                <td class="uk-text-truncate">
                    <?php if ($user['status']== 1 ): ?>
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
                                  'id' => $user['ID']
                              ])
                          ); ?>"
                             class="btn btn-light btn-round mb-0"
                             data-bs-toggle="tooltip"
                             data-bs-placement="top"
                             title="delete user"
                             aria-label="Delete user">
                              <i class="fas fa-trash"></i>
                          </a>

                          <form method="POST">
                              <?php wp_nonce_field(
                                  'wooen_update_newsletter_status',
                                  'newsletter_nonce'
                              ); ?>

                              <input
                                      type="hidden"
                                      name="newsletter_id"
                                      value="<?php echo esc_attr($user['ID']); ?>"
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
                            No users have registered yet!
                        </div>
                    </td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>

</div>
