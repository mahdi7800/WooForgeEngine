<?php

class SendEmail
{
    public function wooen_get_recent_post()
    {
        $args = [
            'posts_per_page' => 1,
            'post_type' => ['post'],
            'meta_key' => '_wooen_send_post_newsletter',
            'meta_value' => '1',
            'post_status' => 'publish',
            'orderby' => 'post_date',
            'order' => 'DESC'
        ];
        $recent_posts = get_posts($args);
        if ($recent_posts):
            foreach ($recent_posts as $recent_post):

                $cat_id = get_post_meta($recent_post->ID, '_tnw_category_post', true);
                $cat_name = get_the_category_by_ID($cat_id);
                $cat_link = get_category_link($cat_id);
                $cat_html = '<a href=" ' . $cat_link . ' ?>" class="badge text-bg-warning mb-2"><i class="fas fa-circle me-2 small fw-bold"></i> ' . $cat_name . '</a>';

                $id_or_email = get_the_author_meta('email');
                $avatar = get_avatar($id_or_email, '39', 'robohash', get_the_author(), ['class' => 'avatar-img rounded-circle']);
                if (has_post_thumbnail($recent_post->ID)):
                    $image_html = get_the_post_thumbnail($recent_post->ID, 'medium', ['class' => 'rounded-3']);
                endif;
                $excerpt = has_excerpt($recent_post->ID) ? get_the_excerpt($recent_post->ID) : wp_trim_words($recent_post->post_content, 40);
                return '
<div class="card border rounded-3 up-hover p-4 mb-4">
	<div class="row g-3">
		<div class="col-sm-9">
			<!-- Categories -->
			' . $cat_html . ';
				<!-- Title -->
			<h4 class="card-title">
				<a href="' . get_the_permalink($recent_post->ID) . '" class="btn-link text-reset stretched-link">' . $recent_post->post_title . '</a>
			</h4>
			<!-- Card info -->
			<ul class="nav nav-divider align-items-center d-none d-sm-inline-block">
				<li class="nav-item">
					<div class="nav-link">
						<div class="d-flex align-items-center position-relative">
							<div class="avatar avatar-xs">
							' . $avatar . '
		                    </div>
		                    <span class="ms-3">با <a href="#" class="stretched-link text-reset btn-link"> ' . get_the_author() . '</a></span>
						</div>
					</div>
				</li>
				<li class="nav-item"> ' . get_the_date('j ,F Y') . '</li>
                <li class="nav-item"><span class="fa fa-comment"></span>  ' . get_comments_number() . '  </li>
			</ul>
		</div>
		<!-- Detail -->
		<div class="col-md-6 col-lg-4">
			<p>' . $excerpt . '</p>
		</div>
		<!-- Image -->
		<div class="col-md-6 col-lg-3">
			' . $image_html . '
		</div>
	</div>
	</div>
</div>';
            endforeach;
        endif;
    }

    public function wooen_get_contact_layout(string $full_name,string $email,string $title,string $message ,string $phone) :string
    {
        return $email_layout = ' <div style="background-color: #efefef; border: 1px solid #eee; text-align: right"> <p style="font-size: 19px">Sender Name: '.$full_name.'</p> <p style="font-size: 19px">Email Address: '.$email.'</p> <p style="font-size: 19px">Phone Number: '.$phone.'</p> <p style="font-size: 19px">Subject: '.$title.'</p> <p style="font-size: 16px">Message: '.$message.'</p> </div> ';
    }

    public function wooen_send_email_recovery($email , $token)
    {
        $subject = 'Password Recovery';

        $headers = ['Content-Type: text/html; charset=UTF-8'];
        $send_mail = wp_mail($email,$subject,$token.'لینک باز یابی رمز عبور ارسال شد',$headers);
        if  ($send_mail){
            wp_send_json(['success'=>true , 'message'=>'لینک بازیابی کلمه عبور ارسال شد!'],200);
        }else{
            wp_send_json([
                'success' => true,
                'message' => 'ارسال ایمیل کار نمی‌کند، اما لینک بازیابی تولید شد.',
                'recovery_link' => $token
            ], 200);
        }
    }
}