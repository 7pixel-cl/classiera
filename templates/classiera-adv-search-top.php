<?php 
	global $redux_demo;
	$classieraPriceRange = false;
	$classieraPriceRangeStyle = 'input';
	$postCurrency = '$';
	$classieraMultiCurrency = 'single';
	$classieraTagDefault = 'USD';
	$classieraMaxPrice = 100000;
	$classieraLocationSearch = false;
	$classieraItemCondation = false;
	$locationsStateOn = false;
	$classiera_ads_type = false;
	$classiera_locations_input = 'input';
	$locationsCityOn = false;
	$classieraShowSell = false;
	$classieraShowBuy = false;
	$classieraShowRent = false;
	$classieraShowHire = false;
	$classieraShowFound = false;
	$classieraShowFree = false;
	$classieraShowEvent = false;
	$classieraShowServices = false;
	if(isset($redux_demo)){
		$classieraPriceRange = $redux_demo['classiera_pricerange_on_off'];
		$classieraPriceRangeStyle = $redux_demo['classiera_pricerange_style'];
		$postCurrency = $redux_demo['classierapostcurrency'];
		$classieraMultiCurrency = $redux_demo['classiera_multi_currency'];
		$classieraTagDefault = $redux_demo['classiera_multi_currency_default'];
		$classieraMaxPrice = $redux_demo['classiera_max_price_input'];
		$classieraLocationSearch = $redux_demo['classiera_search_location_on_off'];
		$classieraItemCondation = $redux_demo['adpost-condition'];
		$locationsStateOn = $redux_demo['location_states_on'];
		$classiera_ads_type = $redux_demo['classiera_ads_type'];
		$classiera_locations_input = $redux_demo['classiera_locations_input'];
		$locationsCityOn= $redux_demo['location_city_on'];
		$adsTypeShow = $redux_demo['classiera_ads_type_show'];
		$classieraShowSell = $adsTypeShow[1];
		$classieraShowBuy = $adsTypeShow[2];
		$classieraShowRent = $adsTypeShow[3];
		$classieraShowHire = $adsTypeShow[4];
		$classieraShowFound = $adsTypeShow[5];
		$classieraShowFree = $adsTypeShow[6];
		$classieraShowEvent = $adsTypeShow[7];
		$classieraShowServices = $adsTypeShow[8];
	}
	if($classieraMultiCurrency == 'multi'){
		$classieraPriceTagForSearch = classiera_Display_currency_sign($classieraTagDefault);
	}elseif(!empty($postCurrency) && $classieraMultiCurrency == 'single'){
		$classieraPriceTagForSearch = $postCurrency;
	}
	
?>
<form method="get" action="<?php echo esc_url(home_url()); ?>" class="ce_cform">
	<h3 class="ce_cform__heading">
		<?php esc_html_e( 'Advanced Search', 'classiera' ); ?>
	</h3>
	<div class="ce_form_grid">
		<?php if($classieraItemCondation == 1){ ?>
		<div class="ce_form_grid__col">
			<label class="ce_cform__label" for="ce_filter">
				<?php esc_html_e( 'Condition', 'classiera' ); ?>
			</label>
			<div class="inner-addon right-addon">
				<i class="right-addon form-icon fa fa-sort"></i>
				<select class="ce_form_control form-control form-control-sm" id="ce_filter" name="item-condition">
					<option value="All" selected>
						<?php esc_html_e( 'All', 'classiera' ); ?>
					</option>
					<option value="new">
						<?php esc_html_e( 'New', 'classiera' ); ?>
					</option>
					<option value="used">
					   <?php esc_html_e( 'Used : Like New', 'classiera' ); ?>
					</option>					<option value="used_gc">
					   <?php esc_html_e( 'Used : Good Condition', 'classiera' ); ?>
					</option>					<option value="used_fc">
					   <?php esc_html_e( 'Used : Fair Condition', 'classiera' ); ?>
					</option>
				</select>
			</div><!--inner-addon-->
		</div><!--ce_form_grid__col-->
		<?php } ?>
		<!--Keywords-->
		<div class="ce_form_grid__col">
			<label class="ce_cform__label" for="ce_keyword">
				<?php esc_html_e( 'Keywords', 'classiera' ); ?>
			</label>
			<div class="inner-addon right-addon">
				<i class="right-addon form-icon fa fa-search"></i>
				<input id="ce_keyword" type="search" name="s" class="form-control form-control-sm" placeholder="<?php esc_attr_e( 'Enter Keyword', 'classiera' ); ?>">
			</div><!--inner-addon-->
		</div><!--ce_form_grid__col-->
		<!--Keywords-->
		<!--Locations-->
	<?php if($classieraLocationSearch == 1){?>
		<!--Country-->
		<div class="ce_form_grid__col">
			<label class="ce_cform__label" for="ce_location">
				<?php esc_html_e( 'Location', 'classiera' ); ?>
			</label>
			<div class="inner-addon right-addon">
				<i class="right-addon form-icon fa fa-sort"></i>
				<select class="ce_form_control form-control form-control-sm" id="post_location" name="post_location">
				<?php
				$args = array(
					'post_type' => 'countries',
					'posts_per_page'   => -1,
					'orderby'          => 'title',
					'order'            => 'ASC',
					'post_status'      => 'publish',
					'suppress_filters' => false 
				);
				$country = get_posts($args);
				if(!empty($country)){
				?>
					<option value="-1" selected disabled>
						<?php esc_html_e('Select Country', 'classiera'); ?>
					</option>
					<?php foreach( $country as $singleCountry ){?>
					<option value="<?php echo esc_attr($singleCountry->ID); ?>">
						<?php echo esc_html($singleCountry->post_title); ?>
					</option>
					<?php } ?>
				<?php } wp_reset_postdata();?>
				</select>
			</div><!--inner-addon-->
		</div><!--ce_form_grid__col-->
		<!--Select State-->
		<?php if($locationsStateOn == 1){?>
			<?php if($classiera_locations_input == 'input'){ ?>
			<div class="ce_form_grid__col">
				<label class="ce_cform__label" for="post_state">
					<?php esc_attr_e( 'States', 'classiera' ); ?>
				</label>
				<div class="inner-addon right-addon">
					<i class="right-addon form-icon fa fa-search"></i>
					<input id="post_state" type="search" name="post_state" class="form-control form-control-sm" placeholder="<?php esc_attr_e( 'Enter your state name.', 'classiera' ); ?>">
				</div><!--inner-addon-->
			</div><!--ce_form_grid__col-->
			<?php }else{ ?>
			<div class="ce_form_grid__col">
				<label class="ce_cform__label" for="post_state">
					<?php esc_attr_e( 'States', 'classiera' ); ?>
				</label>
				<div class="inner-addon right-addon">
					<i class="right-addon form-icon fa fa-sort"></i>
					<select class="ce_form_control form-control form-control-sm" id="post_state">
						<option value="">
							<?php esc_html_e('Select State', 'classiera'); ?>
						</option>
					</select>
				</div><!--inner-addon-->
			</div><!--ce_form_grid__col-->
			<?php } ?>
		<?php } ?>
		<!--Select State-->
		<!--Select City-->
		<?php if($locationsCityOn == 1){?>
			<?php if($classiera_locations_input == 'input'){ ?>
			<div class="ce_form_grid__col">
				<label class="ce_cform__label" for="post_city">
					<?php esc_attr_e( 'Cities', 'classiera' ); ?>
				</label>
				<div class="inner-addon right-addon">
					<i class="right-addon form-icon fa fa-search"></i>
					<input id="post_city" type="search" name="post_city" class="form-control form-control-sm" placeholder="<?php esc_attr_e( 'Enter your city name.', 'classiera' ); ?>">
				</div><!--inner-addon-->
			</div><!--ce_form_grid__col-->
			<?php }else{ ?>
			<div class="ce_form_grid__col">
				<label class="ce_cform__label" for="post_city">
					<?php esc_attr_e( 'Cities', 'classiera' ); ?>
				</label>
				<div class="inner-addon right-addon">
					<i class="right-addon form-icon fa fa-sort"></i>
					<select class="ce_form_control form-control form-control-sm" id="post_city">
						<option value="">
							<?php esc_html_e('Select City', 'classiera'); ?>
						</option>
					</select>
				</div><!--inner-addon-->
			</div><!--ce_form_grid__col-->
			<?php } ?>
		<?php } ?>
		<!--Select City-->
	<?php } ?>
		<!--Locations-->
		<!--Parent Categories-->
		<div class="ce_form_grid__col">
			<label class="ce_cform__label" for="main_cat">
				<?php esc_html_e( 'Categories', 'classiera' ); ?>
			</label>
			<div class="inner-addon right-addon">
				<i class="right-addon form-icon fa fa-sort"></i>
				<select class="ce_form_control form-control form-control-sm" id="main_cat" name="category_name">
					<option value="" disabled selected>
						<?php esc_html_e('Select Category..', 'classiera') ?>
					</option>
					<?php
					$argscat = array(
						'hide_empty' => 0,
						'parent' => 0,
						'order' => 'ASC',
					);
					$categories = get_categories($argscat);
					foreach ($categories as $cat){
						if($cat->category_parent == 0){
							$catID = $cat->cat_ID;
							?>
							<option value="<?php echo esc_attr($cat->slug); ?>">
								<?php echo esc_attr($cat->cat_name); ?>
							</option>
							<?php
						}
					}
					unset($argscat);
					?>
				</select>
			</div><!--inner-addon-->
		</div><!--ce_form_grid__col-->
		<!--Select Sub Category-->
		<div class="ce_form_grid__col classiera_adv_subcat">
			<label class="ce_cform__label" for="sub_cat">
				<?php esc_html_e( 'Sub Categories', 'classiera' ); ?>
			</label>
			<div class="inner-addon right-addon">
				<i class="right-addon form-icon fa fa-sort"></i>
				<select class="ce_form_control form-control form-control-sm" id="sub_cat" name="sub_cat" disabled="disabled">
				</select>
			</div><!--inner-addon-->
		</div><!--ce_form_grid__col-->
		<!--Third Level Category-->
		<div class="ce_form_grid__col classiera_adv_subsubcat">
			<label class="ce_cform__label" for="sub_sub_cat">
				<?php esc_html_e( 'Sub Categories', 'classiera' ); ?>
			</label>
			<div class="inner-addon right-addon">
				<i class="right-addon form-icon fa fa-sort"></i>
				<select class="ce_form_control form-control form-control-sm" id="sub_sub_cat" name="sub_sub_cat" disabled="disabled">
				</select>
			</div><!--inner-addon-->
		</div><!--ce_form_grid__col-->
		<!--End Categories-->
		<!--Select Ads Type-->
	<?php if($classiera_ads_type == 1){?>
		<div class="ce_form_grid__col">
			<label class="ce_cform__label" for="classiera_ads_type">
				<?php esc_html_e( 'Type of Ad', 'classiera' ); ?>
			</label>
			<div class="inner-addon right-addon">
				<i class="right-addon form-icon fa fa-sort"></i>
				<select class="ce_form_control form-control form-control-sm" id="classiera_ads_type" name="classiera_ads_type">
					<option value="All" selected>
						<?php esc_html_e( 'All', 'classiera' ); ?>
					</option>
					<?php if($classieraShowSell == 1){ ?>
					<option value="sell">
						<?php esc_html_e( 'For Sale', 'classiera' ); ?>
					</option>
					<?php } ?>
					<?php if($classieraShowBuy == 1){ ?>
					<option value="buy">
						<?php esc_html_e( 'Wanted', 'classiera' ); ?>
					</option>
					<?php } ?>
					<?php if($classieraShowRent == 1){ ?>
					<option value="rent">
						<?php esc_html_e( 'For Rent', 'classiera' ); ?>
					</option>
					<?php } ?>
					<?php if($classieraShowHire == 1){ ?>
					<option value="hire">
						<?php esc_html_e( 'For hire', 'classiera' ); ?>
					</option>
					<?php } ?>
					<?php if($classieraShowFound == 1){ ?>
					<option value="lostfound">
						<?php esc_html_e( 'Lost & Found', 'classiera' ); ?>
					</option>
					<?php } ?>
					<?php if($classieraShowFree == 1){ ?>
					<option value="free">
						<?php esc_html_e( 'Free', 'classiera' ); ?>
					</option>
					<?php } ?>
					<?php if($classieraShowEvent == 1){ ?>
					<option value="event">
						<?php esc_html_e( 'Event', 'classiera' ); ?>
					</option>
					<?php } ?>
					<?php if($classieraShowServices == 1){ ?>
					<option value="service">
						<?php esc_html_e( 'Professional service', 'classiera' ); ?>
					</option>
					<?php } ?>
				</select>
			</div><!--inner-addon-->
		</div><!--ce_form_grid__col-->
	<?php } ?>
		<!--Select Ads Type-->
		<!--Price Range-->
		<?php if($classieraPriceRange == 1){?>
		<?php 
		if (!empty($postCurrency) && $classieraMultiCurrency == 'single'){
			$currencySign = $postCurrency;
		}elseif($classieraMultiCurrency == 'multi'){
			$currencySign = classiera_Display_currency_sign($classieraTagDefault);
		}else{
			$currencySign = "&dollar;";
		}
		?>
		<div class="ce_form_grid__col">
			<div class="range-slider">
				<p class="ce_form__label">
				  <label for="amount"><?php esc_html_e( 'Price range', 'classiera' ); ?>:</label>
				  <input data-cursign="<?php echo sprintf($currencySign); ?>" type="text" id="amount" readonly style="border:0; color:#f6931f; font-weight:bold;">
				</p>					 
				<div id="slider-range"></div>
				<input type="hidden" id="classieraMaxPrice" value="<?php echo esc_attr($classieraMaxPrice); ?>">
				<input type="hidden" id="range-first-val" name="search_min_price" value="">
				<input type="hidden" id="range-second-val" name="search_max_price" value="">
			</div>
		</div>
		<?php } ?>
		<!--Price Range-->
	</div><!--ce_form_grid-->
	<!--CustomFields-->
	<div class="classiera_adv_cf_fields classiera_cf_grid"></div>
	<!--CustomFields-->	
	<div class="ce_form_button">
		<?php 
		if ( function_exists('icl_object_id') ) { 
			do_action( 'wpml_add_language_form_field' );
		}
		?>
		<input type="hidden" class="classiera_nonce" value="<?php echo wp_create_nonce( 'classiera_nonce' ); ?>">
		<button type="submit" name="search" class="btn btn-primary sharp btn-sm btn-style-one btn-block" value="<?php esc_attr_e( 'Search', 'classiera') ?>">
			<?php esc_html_e( 'Search', 'classiera') ?>
		</button>
	</div><!--ce_form_button-->
</form>