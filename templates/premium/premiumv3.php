<?php 
	global $redux_demo;
	$category_icon_code = "";
	$category_icon_color = "";
	$catIcon = "";	
	$classiera_ads_typeOn = false;
	$classieraPrimaryColor = '#b6d91a';
	$premiumSECtitle = '';
	$premiumSECdesc = '';
	$classieraCurrencyTag = '$';
	$featuredCatOn = false;
	$classieraPremiumAdsCount = 9;
	$classieraIconsStyle = 'icon';
	$classiera_cat_child = 'main';
	$classieraFeaturedCategories = '';
	if(isset($redux_demo)){
		$classiera_ads_typeOn = $redux_demo['classiera_ads_type'];
		$classieraPrimaryColor = $redux_demo['color-primary'];
		$premiumSECtitle = $redux_demo['premium-sec-title'];
		$premiumSECdesc = $redux_demo['premium-sec-desc'];	
		$classieraCurrencyTag = $redux_demo['classierapostcurrency'];
		$featuredCatOn = $redux_demo['featured-caton'];
		$classieraPremiumAdsCount = $redux_demo['premium-ads-counter'];
		$classieraIconsStyle = $redux_demo['classiera_cat_icon_img'];	
		$classiera_cat_child = $redux_demo['classiera_cat_child'];
		if(isset($redux_demo['featured-ads-cat'])){
			$classieraFeaturedCategories = $redux_demo['featured-ads-cat'];
		}
	}	
	if($classiera_ads_typeOn == 1){
		$adstypeQuery = array(
			'key' => 'classiera_ads_type',
			'value' => 'sold',
			'compare' => '!='
		);
	}else{
		$adstypeQuery = null;
	}
?>
<section class="classiera-premium-ads-v3 border-bottom">
	<?php if(!empty($premiumSECtitle)){ ?>
	<div class="section-heading-v1">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8 center-block">
                    <h3 class="text-capitalize"><?php echo esc_html($premiumSECtitle); ?></h3>
					<?php if(!empty($premiumSECdesc)){ ?>
                    <p><?php echo esc_html($premiumSECdesc); ?></p>
					<?php } ?>
                </div>
            </div>
        </div>
    </div>
	<?php } ?>
	<div style="overflow: hidden;">
		<div style="margin-bottom: 40px;">			
			<div id="owl-demo" class="owl-carousel premium-carousel-v3" data-car-length="5" data-items="5" data-loop="true" data-nav="false" data-autoplay="true" data-autoplay-timeout="3000" data-dots="true" data-auto-width="false" data-auto-height="true" data-right="<?php if(is_rtl()){echo "true";}else{ echo "false";}?>" data-responsive-small="1" data-autoplay-hover="true" data-responsive-medium="2" data-responsive-xlarge="5" data-margin="0">
				<?php 				
				if($featuredCatOn == 1){						
					$arags = array(
						'post_type' => 'post',
						'post_status' => 'publish',
						'posts_per_page' => $classieraPremiumAdsCount,
						'cat' => $classieraFeaturedCategories,
						'orderby' => 'rand',
					);
				}else{
					$arags = array(
						'post_type' => 'post',
						'post_status' => 'publish',
						'posts_per_page' => $classieraPremiumAdsCount,
						'orderby' => 'rand',
						'meta_query' => array(
							array(
								'key' => 'featured_post',
								'value' => '1',
								'compare' => '=='
							),
							$adstypeQuery,
						),
					);
				}
				$wp_query = new WP_Query($arags);
				$current = -1;
				while ($wp_query->have_posts()) : $wp_query->the_post();
					$featured_post = get_post_meta($post->ID, 'featured_post', true);
					if($featuredCatOn == 1){
						$featured_post = "1";
					}
					if($featured_post == "1") {
						$current++;
				?>
				<?php 
					$category = get_the_category();
					$catID = $category[0]->cat_ID;
					if ($category[0]->category_parent == 0) {
						$tag = $category[0]->cat_ID;
						$tag_extra_fields = get_option(MY_CATEGORY_FIELDS);
						if (isset($tag_extra_fields[$tag])) {
							if(isset($tag_extra_fields[$tag]['category_icon_code'])){
								$category_icon_code = $tag_extra_fields[$tag]['category_icon_code'];
							}
							if(isset($tag_extra_fields[$tag]['category_icon_color'])){
								$category_icon_color = $tag_extra_fields[$tag]['category_icon_color'];
							}
							if(isset($tag_extra_fields[$tag]['category_image'])){
								$classieraCatIcoIMG = $tag_extra_fields[$tag]['category_image'];
							}
						}
					}elseif(isset($category[1]->category_parent) && $category[1]->category_parent == 0){
						$tag = $category[0]->category_parent;
						$tag_extra_fields = get_option(MY_CATEGORY_FIELDS);
						if (isset($tag_extra_fields[$tag])) {
							if(isset($tag_extra_fields[$tag]['category_icon_code'])){
								$category_icon_code = $tag_extra_fields[$tag]['category_icon_code'];
							}
							if(isset($tag_extra_fields[$tag]['category_icon_color'])){
								$category_icon_color = $tag_extra_fields[$tag]['category_icon_color'];
							}
							if(isset($tag_extra_fields[$tag]['category_image'])){
								$classieraCatIcoIMG = $tag_extra_fields[$tag]['category_image'];
							}
						}
					}else{
						$tag = $category[0]->category_parent;
						$tag_extra_fields = get_option(MY_CATEGORY_FIELDS);
						if (isset($tag_extra_fields[$tag])) {
							if(isset($tag_extra_fields[$tag]['category_icon_code'])){
								$category_icon_code = $tag_extra_fields[$tag]['category_icon_code'];
							}
							if(isset($tag_extra_fields[$tag]['category_icon_color'])){
								$category_icon_color = $tag_extra_fields[$tag]['category_icon_color'];
							}
							if(isset($tag_extra_fields[$tag]['category_image'])){
								$classieraCatIcoIMG = $tag_extra_fields[$tag]['category_image'];
							}
						}
					}					
					if($classiera_cat_child == 'child'){
						foreach ($category as $cat){
							$tag = $cat->cat_ID;
							$tag_extra_fields = get_option(MY_CATEGORY_FIELDS);
							if (isset($tag_extra_fields[$tag])) {
								if(isset($tag_extra_fields[$tag]['category_icon_code'])){
									$category_icon_code = $tag_extra_fields[$tag]['category_icon_code'];
								}
								if(isset($tag_extra_fields[$tag]['category_icon_color'])){
									$category_icon_color = $tag_extra_fields[$tag]['category_icon_color'];
								}
								if(isset($tag_extra_fields[$tag]['category_image'])){
									$classieraCatIcoIMG = $tag_extra_fields[$tag]['category_image'];
								}
							}
						}
					}
					if(!empty($category_icon_code)) {
						$catIcon = stripslashes($category_icon_code);
					}
					if(empty($category_icon_color)) {
						$category_icon_color = $classieraPrimaryColor;
					}
					$postCatgory = get_the_category( $post->ID );
					$categoryLink = get_category_link($catID);
					$classiera_ads_type = get_post_meta($post->ID, 'classiera_ads_type', true);
					$post_currency_tag = get_post_meta($post->ID, 'post_currency_tag', true);
				?>
				<div class="item match-height">
					<figure>
						<div class="premium-img">
							<div class="featured-tag">
								<span class="left-corner"></span>
								<span class="right-corner"></span>
								<div class="featured">
									<p><?php esc_html_e( 'Featured', 'classiera' ); ?></p>
								</div>
							</div><!--featured-tag-->
							<?php 
								if(has_post_thumbnail()){
									$classieraIMGURL = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'classiera-370');
									$thumb_id = get_post_thumbnail_id($post->ID);
									$classieraALT = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
									?>
								<img class="img-responsive" src="<?php echo esc_url($classieraIMGURL[0]); ?>" alt="<?php echo esc_attr($classieraALT);  ?>">	
								<?php
								}else{
									$classieraDafult = get_template_directory_uri() . '/images/nothumb.png';
									?>
									<img class="img-responsive" src="<?php echo esc_url($classieraDafult); ?>" alt="<?php echo get_the_title(); ?>">
									<?php
								}
							?>
							<?php $post_price = get_post_meta($post->ID, 'post_price', true);?>
							<?php if(!empty($post_price)){?>
							<span>
								<?php 
								if(is_numeric($post_price)){
									echo classiera_post_price_display($post_currency_tag, $post_price);
								}else{ 
									echo esc_attr($post_price); 
								}
								?>
							</span>
							<?php } ?>
							<?php if(!empty($classiera_ads_type)){?>
							<span class="classiera-buy-sel">
                            <?php classiera_buy_sell($classiera_ads_type); ?>
                            </span>
							<?php } ?>
						</div><!--premium-img-->
						<figcaption>
							<div class="price">
								<span><i class="far fa-money-bill-alt" aria-hidden="true"></i></span>
								<?php if(!empty($post_price)){?>
								<span class="amount">
									<?php 
									if(is_numeric($post_price)){
										echo classiera_post_price_display($post_currency_tag, $post_price);
									}else{ 
										echo esc_attr($post_price); 
									}
									?>
								</span>
								<?php } ?>
							</div>
							<h5><a href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a></h5>
							<p>
							<?php 
							if($classieraIconsStyle == 'icon'){
								?>
								<i style="color:<?php echo esc_html($category_icon_color); ?>;" class="<?php echo esc_html($catIcon); ?>"></i>
								<?php
							}elseif($classieraIconsStyle == 'img'){
								?>
								<img src="<?php echo esc_url($classieraCatIcoIMG); ?>" alt="<?php echo esc_html(get_cat_name( $catID )); ?>">
								<?php
							}
							?>
								<span>:</span> <a href="<?php echo esc_url($categoryLink); ?>"><?php echo esc_html($postCatgory[0]->name); ?></a>
							</p>
						</figcaption>
					</figure>
				</div>
				<?php } ?>
				<?php endwhile; ?>
				<?php wp_reset_query(); ?>
			</div>
		</div>
		<div class="navText">
			<?php if(is_rtl()){?>
				<a class="next btn btn-primary radius outline btn-sm">
					<i class="icon-right fas fa-chevron-right"></i>
				</a>
				<span><?php esc_html_e( 'Next', 'classiera' ); ?></span>
				<span><?php esc_html_e( 'Previous', 'classiera' ); ?></span>
				<a class="prev btn btn-primary radius outline btn-sm">
					<i class="icon-left fas fa-chevron-left"></i>
				</a>
			<?php }else{ ?>
				<a class="prev btn btn-primary radius outline btn-sm">
					<i class="icon-left fas fa-chevron-left"></i>
				</a>
				<span><?php esc_html_e( 'Previous', 'classiera' ); ?></span>
				<span><?php esc_html_e( 'Next', 'classiera' ); ?></span>
				<a class="next btn btn-primary radius outline btn-sm">
					<i class="icon-right fas fa-chevron-right"></i>
				</a>
			<?php } ?>
			
		</div>
	</div>
</section>