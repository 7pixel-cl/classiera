<?php 
	global $redux_demo;
	$classieraLocationSearch = false;
	$classieraLocationType = 'input';
	$locShownBy = 'post_location';
	if(isset($redux_demo)){
		$classieraLocationSearch = $redux_demo['classiera_search_location_on_off'];
		$classieraLocationType = $redux_demo['classiera_search_location_type'];
		$locShownBy = $redux_demo['location-shown-by'];
	}
	$classieraLocationName = 'post_location';	
	if($locShownBy == 'post_location'){
		$classieraLocationName = 'post_location';
	}elseif($locShownBy == 'post_state'){
		$classieraLocationName = 'post_state';
	}elseif($locShownBy == 'post_city'){
		$classieraLocationName = 'post_city';
	}
?>
<section class="minimal_page_search">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 center-auto">
				<form class="minimal_page_search_form" action="<?php echo esc_url(home_url()); ?>" method="get">
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-addon left-addon">
								<i class="zmdi zmdi-border-color"></i>
							</div>
							<input type="text" class="form-control" placeholder="<?php esc_attr_e( 'Enter what are you looking', 'classiera' ); ?>" name="s">
						</div>
					</div><!--form-group-->
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-addon left-addon">
								<i class="zmdi zmdi-pin-drop"></i>
							</div>
							<input type="text" class="form-control" placeholder="<?php esc_attr_e('Please type your location', 'classiera'); ?>" name="<?php echo esc_attr($classieraLocationName); ?>">
						</div>
					</div><!--form-group-->
					<?php 
					if ( function_exists('icl_object_id') ) { 
						do_action( 'wpml_add_language_form_field' );
					}
					?>
					<button type="submit" name="search" value="<?php esc_attr_e( 'Search', 'classiera' ); ?>">
						<i class="fa fa-search"></i>
					</button>
				</form>
			</div><!--col-lg-8-->
		</div><!--row-->
	</div><!--container-->
</section>