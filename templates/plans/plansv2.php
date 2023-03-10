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
<section class="pricing-plan-v2 section-pad section-gray-bg">
	<?php if(!empty($plans_Title)){ ?>
	<div class="section-heading-v1">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8 center-block">
                    <h3><?php echo esc_html($plans_Title); ?></h3>
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
			<div class="row">
				<?php					
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
				}else{
					$classieraPlansType = get_the_title();
				}
				$redirect = classiera_Plans_URL($free_plans);
				?>
				<div class="col-lg-3 col-md-3 col-sm-6 match-height price-plan-v2">
					<div class="pricing-plan-box border <?php if($popular_plan == 'true'){echo "popular";} ?>">
						<?php if($popular_plan == 'true'){
							?>
							<div class="featured-tag-v2">
								<p><?php esc_html_e('Most Popular', 'classiera') ?></p>
							</div>
							<?php
						}?>
						<div class="pricing-plan-price text-center">
							<h1>
								<?php 
									if($free_plans == 1){
										if($currencyLeftRight == 'left'){
											echo classiera_currency_sign()."0.00";
										}else{
											echo "0.00".classiera_currency_sign();
										}										
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
						<div class="pricing-plan-heading text-center clearfix">
							<h4><?php echo esc_html($classieraPlansType); ?></h4>
							<p>							
							<?php 
								if($free_plans == 1){
									if($classieraAdExpiry == 'lifetime'){
										echo  esc_html__('For Life Time', 'classiera');
									}else{
										esc_html_e('For', 'classiera');?>&nbsp;
										<?php echo esc_attr($classieraAdExpiry); ?>&nbsp;
										<?php esc_html_e('Days Only', 'classiera');
									}									
								}else{
									?>
									<?php esc_html_e('For', 'classiera'); ?>&nbsp;
									<?php echo esc_attr($plan_days); ?>&nbsp;
									<?php esc_html_e('Day Only', 'classiera'); ?>
									<?php
								}
							?>
							</p>
						</div><!--pricing-plan-heading-->
						
						<div class="pricing-plan-text text-center">
							<ul>
                                <li><?php echo esc_html($plan_text); ?></li>
                                <li><?php echo esc_html($planFeaturedTXT); ?></li>
                                <li>
									<?php echo esc_attr($plan_ads) ?>&nbsp;
									<?php esc_html_e( 'Featured ads availability', 'classiera' ); ?>
								</li>
								<li>
									<?php echo esc_attr($regular_ads) ?>&nbsp;
									<?php esc_html_e( 'Regular ads availability', 'classiera' ); ?>
								</li>
                                <li>
									<?php 
										if($free_plans == 1){
											echo esc_html__('For Life Time', 'classiera');
										}else{
											?>
											<?php esc_html_e('For', 'classiera') ?>&nbsp;
											<?php echo esc_attr($plan_days); ?>&nbsp;
											<?php esc_html_e('Day Only', 'classiera') ?>
											<?php
										}
									?>
								</li>
                                <li><?php echo esc_html($planSecureTXT); ?></li>
                            </ul>
						</div><!--pricing-plan-text-->
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
							<div class="pricing-plan-button text-center">
							<?php 
							if($free_plans == 1){
								$link = classiera_Plans_URL();
								?>
							<a class="btn btn-primary round btn-md btn-style-two" href="<?php echo esc_url($link); ?>">
								<span><i class="fas fa-plus"></i></span>
								<?php esc_html_e( 'Post Ad', 'classiera' ); ?>
							</a>	
								<?php
							}else{
								if (is_user_logged_in()){
								?>
							<a rel="nofollow" href="#" data-quantity="1" data-product_id="<?php echo esc_attr($wooID); ?>" data-product_sku="" class="classiera_plan_add_to_cart btn btn-primary round btn-md btn-style-two button">
							<span><i class="fas fa-plus"></i></span>
							<?php esc_html_e( 'Purchase Now', 'classiera' ); ?>
							</a>
								<?php
								}else{
									?>
									<a rel="nofollow" href="<?php echo esc_url($login); ?>" class="btn btn-primary round btn-md btn-style-two button">
									<span><i class="fas fa-plus"></i></span>
									<?php esc_html_e( 'Purchase Now', 'classiera' ); ?>
									</a>
									<?php
								}
							}
							?>
							</div>							
						</form>
						<div class="viewcart text-center">							
							<a class="btn btn-primary round btn-md btn-style-two" href="<?php echo esc_url($classieraCartURL); ?>">
							<span><i class="fas fa-plus"></i></span>
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