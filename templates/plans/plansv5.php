<?php 
	global $redux_demo;
	$plans_Title = '';
	$plans_desc = '';
	$classieraAdExpiry = 'lifetime';
	$classiera_plans_bg = '';
	$currencyLeftRight = 'left';
	if(isset($redux_demo)){
		$plans_Title = $redux_demo['plans-title'];
		$plans_desc = $redux_demo['plans-desc'];
		$classieraAdExpiry = $redux_demo['ad_expiry'];
		$classiera_plans_bg = $redux_demo['classiera_plans_bg']['url'];
		$currencyLeftRight = $redux_demo['classiera_currency_left_right'];
	}	
	$classieraCartURL = classiera_cart_url();	
	$login = classiera_get_template_url('template-login.php');
	if(empty($login)){
		$login = classiera_get_template_url('template-login-v2.php');
	}
	$current_user = wp_get_current_user();
	$user_ID = $current_user->ID;
?>
<section class="pricing-plan-v5 section-pad-80 pricing-plan-bg" style="background: url('<?php echo esc_url($classiera_plans_bg); ?>') repeat">
	<?php if(!empty($plans_Title)){ ?>
	<div class="section-heading-v5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-9 center-block">
                    <h1><?php echo esc_html($plans_Title); ?></h1>
					<?php if(!empty($plans_desc)){ ?>
                    <p><?php echo esc_html($plans_desc); ?></p>
					<?php } ?>
                </div><!--col-lg-8-->
            </div><!--row-->
        </div><!--container-->
    </div><!--section-heading-v1-->
	<?php } ?>
	<div class="pricing-plan-content">
		<div class="container">
			<div class="row gutter-10">
				<?php					
					$activeClass = "";					
					$classieraPlansType = "";
					global $paged, $wp_query, $wp;
					$args = array(
						'post_type' => 'price_plan',
						'post_status' => 'publish',
						'posts_per_page' => -1,						
					);					
					$wp_query = new WP_Query($args);
					$current = -1;
					$current2 = 0;
				while ($wp_query->have_posts()) : $wp_query->the_post(); $current++; $current2++;
				$popular_plan = get_post_meta($post->ID, 'popular_plan', true);
				$free_plans = get_post_meta($post->ID, 'free_plans', true);
				$wooID = get_post_meta($post->ID, 'woo_id', true);
				$post_price = get_post_meta($post->ID, 'plan_price', true);
				$plan_text = get_post_meta($post->ID, 'plan_text', true);
				$plan_days = get_post_meta($post->ID, 'plan_time', true);
				$planFeaturedTXT = get_post_meta($post->ID, 'plan_free_text', true);
				$planSecureTXT = get_post_meta($post->ID, 'plan_secure_text', true);
				$plan_ads = get_post_meta($post->ID, 'featured_ads', true);
				$regular_ads = get_post_meta($post->ID, 'regular_ads', true);
				if($free_plans == 1){
					$classieraPlansType =  esc_html__( 'Free', 'classiera' );
					$plan_ads = 0;
				}else{
					$classieraPlansType =  esc_html__( 'Featured', 'classiera' );
				}
				$redirect = classiera_Plans_URL($free_plans);
				if($popular_plan == 'true'){
					$activeClass = 'active';
				}
				?>
				<div class="col-lg-3 col-md-3 col-sm-6 match-height price-plan-v5">
					<div class="pricing-plan-box <?php if($popular_plan == 'true'){echo "popular";} ?>">
						<div class="pricing-plan-heading">
							<div class="pricing-plan-heading-content text-left flip">
								<h3><?php the_title(); ?></h3>
								<span>
									<?php 
										if($free_plans == 1){
											if($classieraAdExpiry == 'lifetime'){
												echo  esc_html__('Life Time on Regular Place', 'classiera');
											}else{
												esc_html_e('For', 'classiera');?>&nbsp;
											<?php echo esc_attr($classieraAdExpiry); ?>&nbsp;
											<?php esc_html_e('Days Only', 'classiera');
											}									
										}else{
											?>
											<?php esc_html_e( 'For', 'classiera' ); ?>&nbsp;
											<?php echo esc_attr($plan_days); ?>&nbsp;
											<?php esc_html_e( 'days', 'classiera' ); ?>
											<?php
										}
									?>									
								</span>
							</div>
							<div class="pricing-plan-heading-content text-right flip">
								<h1>
									<?php 
										if($free_plans == 1){
											echo esc_attr($classieraPlansType);
										}else{
											if($currencyLeftRight == 'left'){
												echo classiera_currency_sign().$post_price;
											}else{
												echo esc_attr($post_price).classiera_currency_sign();
											}
										}
									?>
								</h1>
							</div>
						</div>						
						<div class="pricing-plan-text">
							<ul class="fa-ul border-bottom">
                                <li><i class="fa-li zmdi zmdi-check"></i><?php echo esc_html($plan_text); ?></li>
                                <li><i class="fa-li zmdi zmdi-check"></i><?php echo esc_html($planFeaturedTXT); ?></li>
                                <li><i class="fa-li zmdi zmdi-check"></i>
									<?php echo esc_attr($plan_ads) ?>&nbsp;
									<?php esc_html_e( 'Featured ads availability', 'classiera' ); ?>
								</li>
								<li><i class="fa-li zmdi zmdi-check"></i>
									<?php echo esc_attr($regular_ads); ?>&nbsp;
									<?php esc_html_e( 'Regular ads availability', 'classiera' ); ?>
								</li>
                                <li><i class="fa-li zmdi zmdi-check"></i>
									<?php if($free_plans == 1){ ?>
										<?php esc_html_e( 'Life Time on Regular Place', 'classiera' ); ?>
									<?php }else{?>
										<?php esc_html_e( 'For', 'classiera' ); ?>&nbsp;
										<?php echo esc_attr($plan_days); ?>&nbsp;
										<?php esc_html_e( 'days', 'classiera' ); ?>
									<?php } ?>
								</li>
                                <li><i class="fa-li zmdi zmdi-check"></i><?php echo esc_html($planSecureTXT); ?></li>
                            </ul>
						</div>
						<!--FormSection-->
						<form method="post" class="planForm">
							<input type="hidden" name="classiera_nonce" class="classiera_nonce" value="<?php echo wp_create_nonce( 'classiera_nonce' ); ?>">
							<input type="hidden" class="AMT" name="AMT" value="<?php echo esc_attr($post_price); ?>" />
							
							<input type="hidden" class="wooID" name="id" value="<?php echo esc_attr($wooID); ?>" />
							<input type="hidden" class="plan_id" name="plan_id" value="<?php echo esc_attr($post->ID); ?>" />
							
							<input type="hidden" class="CURRENCYCODE" name="CURRENCYCODE" value="<?php echo classiera_currency_sign(); ?>">
							
							<input type="hidden" class="user_ID" name="user_ID" value="<?php echo esc_attr($user_ID); ?>">
							
							<input type="hidden" class="plan_name" name="plan_name" value="<?php the_title(); ?>">
							
							<?php $plan_ads = get_post_meta($post->ID, 'featured_ads', true); ?>
							<input type="hidden" class="plan_ads" name="plan_ads" value="<?php echo esc_attr($plan_ads); ?>">
							<input type="hidden" class="regular_ads" name="regular_ads" value="<?php echo esc_attr($regular_ads); ?>">
							<?php $plan_time = get_post_meta($post->ID, 'plan_time', true); ?>
							<input type="hidden" class="plan_time" name="plan_time" value="<?php echo esc_attr($plan_time); ?>">
							<div class="pricing-plan-button">
							<?php 
							if($free_plans == 1){
								$link = classiera_Plans_URL();
								?>
							<a class="btn btn-primary radius btn-md btn-style-three" href="<?php echo esc_url($link); ?>">
								<?php esc_html_e( 'Post Ad', 'classiera' ); ?>
							</a>	
								<?php
							}else{
								if (is_user_logged_in()){
								?>
							<a rel="nofollow" href="#" data-quantity="1" data-product_id="<?php echo esc_attr($wooID); ?>" data-product_sku="" class="classiera_plan_add_to_cart btn btn-primary radius btn-md btn-style-three">
							<?php esc_html_e( 'Purchase Now', 'classiera' ); ?>
							</a>
								<?php
								}else{
									?>
									<a rel="nofollow" href="<?php echo esc_url($login); ?>" class="btn btn-primary radius btn-md btn-style-three">
									<?php esc_html_e( 'Purchase Now', 'classiera' ); ?>
									</a>
									<?php
								}
							}
							?>
							</div>							
						</form>
						<div class="viewcart pricing-plan-button">
							<a class="btn btn-primary radius btn-md btn-style-three" href="<?php echo esc_url($classieraCartURL); ?>">
							<?php esc_html_e( 'View Cart', 'classiera' ); ?>
							</a>
						</div>
						<!--FormSection-->
					</div><!--pricing-plan-box-->
				</div><!--col-lg-3-->
				<?php endwhile; ?>
				<?php wp_reset_query(); ?>			
			</div><!--row no-gutter-->
		</div><!--container-->
	</div><!--pricing-plan-content-->
</section>