<?php 
	global $redux_demo;
	$classieraLocationName = 'post_location';
	$classieraLocationSearch = true;
	$classieraLocationType = 'input';
	$classiera_remove_ajax = false;
	$locShownBy = 'post_location';
	$classieraMaxPrice = 10000;
	$classieraPriceRange = false;
	if(isset($redux_demo)){
		$classieraLocationSearch = $redux_demo['classiera_search_location_on_off'];
		$classieraLocationType = $redux_demo['classiera_search_location_type'];
		$classiera_remove_ajax = $redux_demo['classiera_remove_ajax'];
		$locShownBy = $redux_demo['location-shown-by'];
		$classieraMaxPrice = $redux_demo['classiera_max_price_input'];
		$classieraPriceRange = $redux_demo['classiera_pricerange_on_off'];
	}	
	$startPrice = $classieraMaxPrice*10/100; 
	$secondPrice = $startPrice+$startPrice; 
	$thirdPrice = $startPrice+$secondPrice; 
	$fourthPrice = $startPrice+$thirdPrice; 
	$fivePrice = $startPrice+$fourthPrice; 
	$sixPrice = $startPrice+$fivePrice; 
	$sevenPrice = $startPrice+$sixPrice; 
	$eightPrice = $startPrice+$sevenPrice; 
	$ninePrice = $startPrice+$eightPrice; 
	$tenPrice = $startPrice+$ninePrice;
	global $redux_demo;
	$classieraLocationName = 'post_location';	
	if($locShownBy == 'post_location'){
		$classieraLocationName = 'post_location';
	}elseif($locShownBy == 'post_state'){
		$classieraLocationName = 'post_state';
	}elseif($locShownBy == 'post_city'){
		$classieraLocationName = 'post_city';
	}
?>
<section class="search-section search-section-v4">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<form data-toggle="validator" role="search" class="search-form search-form-v2 form-inline" action="<?php echo esc_url(home_url()); ?>" method="get">
					<div class="form-group">
						<!--Searchkeyword-->
						<div class="form-icon inner-addon left-addon classieraAjaxInput">
							<i class="form-icon form-icon-size-small fas fa-search"></i>
							<input type="text" name="s" <?php if($classiera_remove_ajax == 1){ ?>id="classieraSearchAJax" <?php } ?> class="form-control form-control-sm" placeholder="<?php esc_attr_e( 'Enter keyword...', 'classiera' ); ?>" data-error="<?php esc_attr_e( 'Please Type some words..!', 'classiera' ); ?>">
							<div class="help-block with-errors"></div>
							<span class="classieraSearchLoader"><img src="<?php echo esc_url(get_template_directory_uri()).'/images/loader.gif' ?>" alt="classiera loader"></span>
							<div class="classieraAjaxResult"></div>
						</div>
						<!--Searchkeyword-->
					</div>
					<!--Select Category-->
					<div class="form-group clearfix">
						<div class="inner-addon left-addon right-addon">
							<i class="form-icon form-icon-size-small left-form-icon fas fa-bars"></i>
							<i class="form-icon form-icon-size-small fas fa-sort"></i>
							<select class="form-control form-control-sm" data-placeholder="<?php esc_attr_e('Select Category..', 'classiera'); ?>" name="category_name" id="ajaxSelectCat">
								<option value="" selected><?php esc_html_e('All Categories', 'classiera'); ?></option>
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
					</div>
					<!--Select Category-->
					<!--Locations-->
					<?php if($classieraLocationSearch == 1){?>
					<div class="form-group">
                       <div class="form-icon inner-addon left-addon">
							<i class="form-icon form-icon-size-small fas fa-map-marker-alt"></i>
							<?php if($classieraLocationType == 'input'):?>
								<input type="text" id="getCity" name="<?php echo esc_attr($classieraLocationName); ?>" class="form-control form-control-sm" placeholder="<?php esc_attr_e('Please type location', 'classiera'); ?>">
								<a id="getLocation" href="#" class="form-icon form-icon-size-small" title="<?php esc_attr_e('Click here to get your own location', 'classiera'); ?>">
									<i class="fas fa-crosshairs"></i>
								</a>
							<?php elseif($classieraLocationType == 'dropdown'):?>
							<!--Locations dropdown-->	
								<?php get_template_part( 'templates/classiera-locations-dropdown' );?>
								<!--Locations dropdown-->
							<?php endif; ?>
                        </div>
                    </div>
					<?php } ?>
					<!--Locations-->
					<!--PriceRange-->
					<div class="form-group clearfix">
						<div class="inner-addon left-addon right-addon">
							<i class="form-icon form-icon-size-small left-form-icon fas fa-dollar-sign"></i>
							<i class="form-icon form-icon-size-small fas fa-sort"></i>
							<select class="form-control form-control-sm" data-placeholder="<?php esc_attr_e('Select price range', 'classiera'); ?>" name="price_range">
								<option value="-1" selected disabled><?php esc_html_e('select price range', 'classiera'); ?></option>
								<option value="<?php echo "0,".$startPrice; ?>">0 - <?php echo esc_attr($startPrice); ?>
								</option>
								<option value="<?php echo esc_attr($startPrice).','.esc_attr($secondPrice); ?>">
									<?php echo esc_attr($startPrice+1); ?> - <?php echo esc_attr($secondPrice); ?>
								</option>
								<option value="<?php echo esc_attr($secondPrice).','.esc_attr($thirdPrice); ?>">
									<?php echo esc_attr($secondPrice+1); ?> - <?php echo esc_attr($thirdPrice); ?>
								</option>
								<option value="<?php echo esc_attr($thirdPrice).','.esc_attr($fourthPrice); ?>">
									<?php echo esc_attr($thirdPrice+1); ?> - <?php echo esc_attr($fourthPrice); ?>
								</option>
								<option value="<?php echo esc_attr($fourthPrice).','.esc_attr($fivePrice); ?>">
									<?php echo esc_attr($fourthPrice+1); ?> - <?php echo esc_attr($fivePrice); ?>
								</option>
								<option value="<?php echo esc_attr($fivePrice).','.esc_attr($sixPrice); ?>">
									<?php echo esc_attr($fivePrice+1); ?> - <?php echo esc_attr($sixPrice); ?>
								</option>
								<option value="<?php echo esc_attr($sixPrice).','.esc_attr($sevenPrice); ?>">
									<?php echo esc_attr($sixPrice+1); ?> - <?php echo esc_attr($sevenPrice); ?>
								</option>
								<option value="<?php echo esc_attr($sevenPrice).','.esc_attr($eightPrice); ?>">
									<?php echo esc_attr($sevenPrice+1); ?> - <?php echo esc_attr($eightPrice); ?>
								</option>
								<option value="<?php echo esc_attr($eightPrice).','.esc_attr($ninePrice); ?>">
									<?php echo esc_attr($eightPrice+1); ?> - <?php echo esc_attr($ninePrice); ?>
								</option>
								<option value="<?php echo esc_attr($ninePrice).','.esc_attr($classieraMaxPrice); ?>">
									<?php echo esc_attr($ninePrice+1); ?> - <?php echo esc_attr($classieraMaxPrice); ?>
								</option>
							</select>
						</div>
					</div>
					<!--PriceRange-->
					<?php 
					if ( function_exists('icl_object_id') ) { 
						do_action( 'wpml_add_language_form_field' );
					}
					?>
					<input type="hidden" class="classiera_nonce" value="<?php echo wp_create_nonce( 'classiera_nonce' ); ?>">
                    <button class="btn btn-primary" type="submit" name="search" value="Search"><?php esc_html_e( 'Search', 'classiera' ); ?></button>
				</form>
			</div><!--col-md-12-->
		</div><!--row-->
	</div><!--container-->
</section><!--search-section-->