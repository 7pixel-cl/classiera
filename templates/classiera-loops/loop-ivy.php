<?php 
	global $redux_demo, $post;
	$category_icon_code = "";
	$category_icon_color = "";
	$classieraCatIcoIMG = "";
	$catIcon = "";
	$catID = "";
	$classieraIconsStyle = 'icon';
	$classiera_cat_child = 'child';
	$classieraCurrencyTag = '$';
	$primaryColor = '#b6d91a';
	$classieraAdsView = 'grid';
	$locShownBy = 'post_location';
	if(isset($redux_demo)){
		$classieraIconsStyle = $redux_demo['classiera_cat_icon_img'];
		$classiera_cat_child = $redux_demo['classiera_cat_child'];
		$classieraCurrencyTag = $redux_demo['classierapostcurrency'];	
		$primaryColor = $redux_demo['color-primary'];
		$classieraAdsView = $redux_demo['home-ads-view'];
		$locShownBy = $redux_demo['location-shown-by'];		
	}	
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
		$category_icon = stripslashes($category_icon_code);
	}
	if(empty($category_icon_color)) {
		$category_icon_color = $primaryColor;
	}
	$post_price = get_post_meta($post->ID, 'post_price', true);
	$post_phone = get_post_meta($post->ID, 'post_phone', true);
	$theTitle = get_the_title();
	$postCatgory = get_the_category( $post->ID );
	$categoryLink = get_category_link($catID);
	$classieraPostAuthor = $post->post_author;
	$classieraAuthorEmail = get_the_author_meta('user_email', $classieraPostAuthor);
	$classiera_ads_type = get_post_meta($post->ID, 'classiera_ads_type', true);
	$post_currency_tag = get_post_meta($post->ID, 'post_currency_tag', true);
	$attachments = get_children(array('post_parent' => $post->ID,
		'post_status' => 'inherit',
		'post_type' => 'attachment',
		'post_mime_type' => 'image',
		'order' => 'ASC',
		'orderby' => 'menu_order ID'
		)
	);
	//print_r($attachments);
?>
<div class="col-lg-4 col-md-4 col-sm-6 match-height item <?php echo classiera_grid_classes(); ?>">
	<div class="classiera-box-div classiera-box-div-v5">
		<figure class="clearfix">
			<a href="<?php echo esc_url(get_the_permalink($post->ID)); ?>">
			<div class="premium-img">
			<?php 
				$classieraFeaturedPost = get_post_meta($post->ID, 'featured_post', true);
				if($classieraFeaturedPost == 1){
					?>
					<div class="featured-tag">
						<span class="left-corner"></span>
						<span class="right-corner"></span>
						<div class="featured">
							<p><?php esc_html_e( 'Featured', 'classiera' ); ?></p>
						</div>
					</div>
					<?php
				}
				?>
				<?php
				if( has_post_thumbnail()){
					$imageurl = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'classiera-370');					
					$thumb_id = get_post_thumbnail_id($post->ID);
					?>
					<img class="img-responsive" src="<?php echo esc_url($imageurl[0]); ?>" alt="<?php echo esc_html($theTitle); ?>">
					<?php
				}elseif(!empty($attachments)){
					$imagecount = 1;
					foreach($attachments as $att_id => $attachment){
						$full_img_url = wp_get_attachment_url($attachment->ID);
						if($imagecount == 1){
						?>
						<img class="img-responsive" src="<?php echo esc_url($full_img_url); ?>" alt="<?php echo esc_html($theTitle); ?>">
						<?php
						}
						$imagecount++;
					}
				}else{
					?>
					<img class="img-responsive" src="<?php echo esc_url(get_template_directory_uri()) . '/images/nothumb.png' ?>" alt="No Thumb"/>
					<?php
				}
			?>
				<span class="hover-posts">
						<span><?php esc_html_e('View Ad', 'classiera'); ?></span>
				</span>
				<?php if(!empty($post_price)){?>
					<span class="price">
						<?php esc_html_e('Price', 'classiera'); ?> : 
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
			</a>
			<div class="detail text-center">
				<?php if(!empty($post_price)){?>
				<span class="price">
					<?php esc_html_e('Price', 'classiera'); ?> : 
					<?php 
					if(is_numeric($post_price)){
						echo classiera_post_price_display($post_currency_tag, $post_price);
					}else{ 
						echo esc_attr($post_price); 
					}
					?>
				</span>
				<?php } ?>
				<div class="box-icon">
					<a href="mailto:<?php echo sanitize_email($classieraAuthorEmail); ?>?subject">
						<i class="fas fa-envelope"></i>
					</a>
					<?php if(!empty($post_phone)){?>
					<a href="tel:<?php echo esc_html($post_phone); ?>"><i class="fas fa-phone"></i></a>
					<?php } ?>
				</div>
				<a href="<?php the_permalink(); ?>" class="btn btn-primary outline btn-style-five"><?php esc_html_e('View Ad', 'classiera'); ?></a>
			</div><!--detail text-center-->
			<figcaption>
				<?php if(!empty($post_price)){?>
				<span class="price visible-xs">
				<?php esc_html_e('Price', 'classiera'); ?> :
					<?php 
					if(is_numeric($post_price)){
						echo classiera_post_price_display($post_currency_tag, $post_price);
					}else{ 
						echo esc_attr($post_price); 
					}
					?>
				</span>
				<?php } ?>
				<h5><a href="<?php the_permalink(); ?>"><?php echo esc_html($theTitle); ?></a></h5>
				<div class="category">
					<span>
					<?php esc_html_e('Category', 'classiera'); ?> : 
					<?php classiera_Display_cat_level($post->ID);?>
					</span>
					<?php $classieraLOC = get_post_meta( $post->ID, $locShownBy, true );?>
					<span><?php esc_html_e('Location', 'classiera'); ?> : 
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>?s=&<?php echo esc_html($locShownBy);?>=<?php echo esc_html($classieraLOC);?>"><?php echo esc_html($classieraLOC); ?></a>
					</span>
				</div>
				<p class="description"><?php echo substr(get_the_excerpt(), 0,260); ?></p>
			</figcaption>
		</figure>
	</div><!--row-->
</div><!--col-lg-4-->