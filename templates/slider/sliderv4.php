<?php 
	global $redux_demo;
	$classieraCatSECTitle = '';
	$classieraCatSECDESC = '';
	$classieraCatMenuCount = 6;
	$cat_counter = 6;
	$primaryColor = '#b6d91a';
	$classieraIconsStyle = 'icon';
	$classieraIMGheaderTitle = '';
	$classieraIMGheaderDesc = '';
	$classieraLocationSearch = true;
	$classieraLocationType = 'dropdown';
	$locShownBy = 'post_location';
	$classiera_cats_slider = true;
	$classiera_remove_ajax = false;
	if(isset($redux_demo)){
		$classieraCatSECTitle = $redux_demo['cat-sec-title'];
		$classieraCatSECDESC = $redux_demo['cat-sec-desc'];
		$classieraCatMenuCount = $redux_demo['classiera_cat_menu_count'];
		$cat_counter = $redux_demo['home-cat-counter'];
		$primaryColor = $redux_demo['color-primary'];
		$classieraIconsStyle = $redux_demo['classiera_cat_icon_img'];
		$classieraIMGheaderTitle = $redux_demo['homepage-v2-title'];
		$classieraIMGheaderDesc = $redux_demo['homepage-v2-desc'];		
		$classieraLocationSearch = $redux_demo['classiera_search_location_on_off'];
		$classieraLocationType = $redux_demo['classiera_search_location_type'];
		$locShownBy = $redux_demo['location-shown-by'];
		$classiera_remove_ajax = $redux_demo['classiera_remove_ajax'];
		$classiera_cats_slider = $redux_demo['classiera_cats_slider'];
	}
	$page = get_page($post->ID);
	$current_page_id = $page->ID;
	$page_slider = get_post_meta($current_page_id, 'page_slider', true);
	$category_icon_code = "";
	$category_icon_color = "";
	$catIcon = "";
	$classieraCatIconCode = '';
	$classieraCatIcoIMG = '';
	$classieraCatIconClr = '';	
	$allCatURL = classiera_get_template_url('template-all-categories.php');	
	$classieraLocationName = 'post_location';
	if($locShownBy == 'post_location'){
		$classieraLocationName = 'post_location';
	}elseif($locShownBy == 'post_state'){
		$classieraLocationName = 'post_state';
	}elseif($locShownBy == 'post_city'){
		$classieraLocationName = 'post_city';
	}
?>
<section class="classiera-static-slider-v2">
	<div class="container">
		<div class="row">
			<div class="classiera-static-slider-content text-center">
				<h1><?php if(function_exists('classiera_escape')) { classiera_escape($classieraIMGheaderTitle); } ?></h1>
				<h2><?php if(function_exists('classiera_escape')) { classiera_escape($classieraIMGheaderDesc); } ?></h2>
			</div>
		</div>
	</div><!--container-->
	<section class="search-section search-section-v6 search-section-v7">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<form data-toggle="validator" role="search" class="search-form search-form-v2 form-inline" action="<?php echo esc_url(home_url()); ?>" method="get">
						<div class="form-v6-bg">
							<div class="form-group clearfix">
								<div class="inner-addon left-addon right-addon">
									<i class="form-icon form-icon-size-small left-form-icon zmdi zmdi-sort-amount-desc"></i>
									<i class="form-icon form-icon-size-small fas fa-sort"></i>
									<select class="form-control form-control-lg" data-placeholder="<?php esc_attr_e('Select Category..', 'classiera'); ?>" name="category_name" id="ajaxSelectCat">
										<option value="" selected disabled><?php esc_html_e('All Categories', 'classiera'); ?></option>
										<?php 
										$args = array(
											'hierarchical' => '0',
											'hide_empty' => '0'
										);
										$categories = get_categories($args);
										foreach ($categories as $cat) {
											if($cat->category_parent == 0){
												$catID = $cat->cat_ID;
												?>
											<option value="<?php echo esc_attr($cat->slug); ?>">
												<?php echo esc_html($cat->cat_name); ?>
											</option>	
												<?php
												$args2 = array(
													'hide_empty' => '0',
													'parent' => $catID
												);
												$categories = get_categories($args2);
												foreach($categories as $cat){
													?>
												<option value="<?php echo esc_attr($cat->slug); ?>">- 
													<?php echo esc_html($cat->cat_name); ?>
												</option>	
													<?php
												}
											}
										}
										?>
									</select>
								</div>
							</div><!--form-group-->
							<div class="form-group classieraAjaxInput">
								<div class="input-group inner-addon left-addon">
									<i class="form-icon form-icon-size-small left-form-icon zmdi zmdi-border-color"></i>
									<input type="text" <?php if($classiera_remove_ajax == 1){ ?>id="classieraSearchAJax" <?php } ?> name="s" class="form-control form-control-lg" placeholder="<?php esc_attr_e( 'Enter keyword...', 'classiera' ); ?>" data-error="<?php esc_attr_e( 'Please Type some words..!', 'classiera' ); ?>">
									<div class="help-block with-errors"></div>
									<span class="classieraSearchLoader"><img src="<?php echo esc_url(get_template_directory_uri()).'/images/loader.gif' ?>" alt="classiera loader"></span>
									<div class="classieraAjaxResult"></div>
								</div>
							</div><!--form-group-->
							<!--Searchlocation-->
							<?php if($classieraLocationSearch == 1){?>
							<div class="form-group">
								<div class="input-group inner-addon left-addon">
									<i class="form-icon form-icon-size-small left-form-icon zmdi zmdi-pin-drop"></i>
									<?php if($classieraLocationType == 'input'):?>
										<input type="text" id="getCity" name="<?php echo esc_attr($classieraLocationName); ?>" class="form-control form-control-lg" placeholder="<?php esc_attr_e('Please type your location', 'classiera'); ?>">
										<a id="getLocation" href="#" class="form-icon form-icon-size-small" title="<?php esc_attr_e('Click here to get your own location', 'classiera'); ?>">
											<i class="fas fa-crosshairs"></i>
										</a>
									<?php elseif($classieraLocationType == 'dropdown'):?>
									<!--Locations dropdown-->	
										<?php get_template_part( 'templates/classiera-locations-dropdown' );?>
										<!--Locations dropdown-->
									<?php endif; ?>
								</div>
							</div><!--form-group-->
							<?php } ?>
							<!--Searchlocation-->
							<?php 
							if ( function_exists('icl_object_id') ) { 
								do_action( 'wpml_add_language_form_field' );
							}
							?>
							<input type="hidden" name="classiera_nonce" class="classiera_nonce" value="<?php echo wp_create_nonce( 'classiera_nonce' ); ?>">
							<div class="form-group">
								<button type="submit" name="search" value="<?php esc_attr_e( 'Search', 'classiera' ); ?>"><?php esc_html_e( 'Search', 'classiera' ); ?></button>
							</div><!--form-group-->
						</div><!--form-v6-bg-->
					</form>
				</div><!--col-md-12-->
			</div><!--row-->
		</div><!--container-->
	</section><!--search-section-->
	<!-- category slider box -->
	<?php if($classiera_cats_slider == 1){?>
	<div class="category-slider-small-box outline-box text-center">
		<ul class="list-inline list-unstyled">
			<?php 
			$categories = get_terms('category', array(
					'hide_empty' => 0,
					'parent' => 0,
					'number' => $classieraCatMenuCount,
					'order'=> 'ASC'
				)	
			);
			$current = 1;
			foreach ($categories as $category) {
				$tag = $category->term_id;
				$classieraCatFields = get_option(MY_CATEGORY_FIELDS);
				if(isset($classieraCatFields[$tag])){
					$classieraCatIconCode = $classieraCatFields[$tag]['category_icon_code'];
					$classieraCatIcoIMG = $classieraCatFields[$tag]['category_image'];
					$classieraCatIconClr = $classieraCatFields[$tag]['category_icon_color'];						
				}
				$cat = $category->count;
				$catName = $category->term_id;
				$mainID = $catName;
				if(empty($classieraCatIconClr)){
					$iconColor = $primaryColor;
				}else{
					$iconColor = $classieraCatIconClr;
				}
				$allPosts = 0;
				$categoryLink = get_category_link( $category->term_id );
				$categories = get_categories('child_of='.$catName);
				foreach($categories as $category){
					$allPosts += $category->category_count;
				}
				$classieraTotalPosts = $allPosts + $cat;
				$category_icon = stripslashes($classieraCatIconCode);
				if($current <= $classieraCatMenuCount){
					?>
					<li>
						<a class="match-height" href="<?php echo esc_url($categoryLink); ?>">
							<?php 
							if($classieraIconsStyle == 'icon'){
								?>
								<i class="<?php echo esc_html($category_icon); ?>"></i>
								<?php
							}elseif($classieraIconsStyle == 'img'){
								?>
								<img src="<?php echo esc_url($classieraCatIcoIMG); ?>">
								<?php
							}
							?>
							<p><?php echo get_cat_name( $catName ); ?></p>
						</a>
					</li>
					<?php
				}
				$current++;
			}
			?>
		</ul>
	</div>
	<?php } ?>
	<!-- category slider box -->
</section><!--classiera-simple-bg-slider-->