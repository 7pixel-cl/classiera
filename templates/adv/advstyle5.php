<?php 
	global $redux_demo;	
	$classiera_ads_typeOn = false;
	$classieraAdsSecDesc = '';
	$ads_counter = 12;
	$classieraCurrencyTag = '$';
	$classieraFeaturedAdsCounter = 6;
	$classieraIconsStyle = 'icon';
	$classieraAdsView = 'grid';
	if(isset($redux_demo)){
		$classiera_ads_typeOn = $redux_demo['classiera_ads_type'];
		$classieraAdsSecDesc = $redux_demo['ad-desc'];
		$ads_counter = $redux_demo['home-ads-counter'];
		$classieraCurrencyTag = $redux_demo['classierapostcurrency'];
		$classieraFeaturedAdsCounter = $redux_demo['classiera_featured_ads_count'];
		$classieraIconsStyle = $redux_demo['classiera_cat_icon_img'];
		$classieraAdsView = $redux_demo['home-ads-view'];
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
<section class="classiera-advertisement advertisement-v5 section-pad-80 border-bottom">
	<div class="section-heading-v5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8 center-block">
                    <h3 class="text-capitalize"><?php esc_html_e( 'ADVERTISEMENTS', 'classiera' ); ?></h3>
					<?php if(!empty($classieraAdsSecDesc)){ ?>
                    <p><?php echo esc_html($classieraAdsSecDesc); ?></p>
					<?php } ?>
                </div>
            </div>
        </div>
    </div>
	<div class="tab-divs">
		<div class="view-head">
			<div class="container">
				<div class="row">
					<div class="col-lg-6 col-sm-7 col-xs-8">
                        <div class="tab-button">
                            <ul class="nav nav-tabs" role="tablist">								
                                <li role="presentation" class="active">
									<a href="#all" aria-controls="all" role="tab" data-toggle="tab">
										<?php esc_html_e( 'All Ads', 'classiera' ); ?>
										<span class="arrow-down"></span>
									</a>
                                </li>
                                <li role="presentation">                                    
									<a href="#random" aria-controls="random" role="tab" data-toggle="tab">
										<?php esc_html_e( 'Random Ads', 'classiera' ); ?>
										<span class="arrow-down"></span>
									</a>
                                </li>
                                <li role="presentation">                                   
									<a href="#popular" aria-controls="popular" role="tab" data-toggle="tab">
										<?php esc_html_e( 'Popular Ads', 'classiera' ); ?>
										<span class="arrow-down"></span>
									</a>
                                </li>
                            </ul><!--nav nav-tabs-->
                        </div><!--tab-button-->
                    </div><!--col-lg-6 col-sm-8-->
					<div class="col-lg-6 col-sm-5 col-xs-4">
						<div class="view-as text-right flip">
							<a id="grid" class="grid <?php if($classieraAdsView == 'grid'){ echo "active"; }?>" href="#">
								<i class="fas fa-th-large"></i>
							</a>
							<a id="grid" class="grid-medium <?php if($classieraAdsView == 'medium'){ echo "active"; }?>" href="#">
								<i class="fa fa-th"></i>
							</a>
							<a id="list" class="list <?php if($classieraAdsView == 'list'){ echo "active"; }?>" href="#">
								<i class="fas fa-th-list"></i>
							</a>							
                        </div><!--view-as tab-button-->
					</div><!--col-lg-6 col-sm-4 col-xs-12-->
				</div><!--row-->
			</div><!--container-->
		</div><!--view-head-->
		<div class="tab-content">
			<div role="tabpanel" class="tab-pane fade in active" id="all">
				<div class="container">
					<div class="row">
					<!--FeaturedAds-->
					<?php 
						global $paged, $wp_query, $wp;
						$args = wp_parse_args($wp->matched_query);
						if ( !empty ( $args['paged'] ) && 0 == $paged ){
							$wp_query->set('paged', $args['paged']);
							$paged = $args['paged'];
						}
						$featuredPosts = array();
						$arags = array(
							'post_type' => 'post',
							'post_status' => 'publish',
							'posts_per_page' => $classieraFeaturedAdsCounter,
							'paged' => $paged,
							'meta_query' => array(
								array(
									'key' => 'featured_post',
									'value' => '1',
									'compare' => '=='
								),
								$adstypeQuery,
							),
						);
						$wsp_query = new WP_Query($arags);
						while ($wsp_query->have_posts()) : $wsp_query->the_post();
							$featuredPosts[] = $post->ID;
							get_template_part( 'templates/classiera-loops/loop-ivy');
						endwhile;
						wp_reset_postdata();
						wp_reset_query(); ?>
					<!--FeaturedAds-->
					<?php 
						global $paged, $wp_query, $wp;
						$args = wp_parse_args($wp->matched_query);
						if ( !empty ( $args['paged'] ) && 0 == $paged ){
							$wp_query->set('paged', $args['paged']);
							$paged = $args['paged'];
						}
						$arags = array(
							'post_type' => 'post',
							'posts_per_page' => $ads_counter,
							'paged' => $paged,
							'post__not_in' => $featuredPosts,
							'meta_query' => array(
								$adstypeQuery,
							),
						);
						$wsp_query = new WP_Query($arags);
						while ($wsp_query->have_posts()) : $wsp_query->the_post();
							get_template_part( 'templates/classiera-loops/loop-ivy');
						endwhile;
						wp_reset_query();
						wp_reset_postdata(); ?>
					</div><!--row-->
				</div><!--container-->
			</div><!--tabpanel-->
			<div role="tabpanel" class="tab-pane fade" id="random">
				<div class="container">
					<div class="row">
						<?php 
							global $paged, $wp_query, $wp;
							$args = wp_parse_args($wp->matched_query);
							if ( !empty ( $args['paged'] ) && 0 == $paged ) {
								$wp_query->set('paged', $args['paged']);
								$paged = $args['paged'];
							}
							$argas = array(
								'orderby' => 'rand',
								'post_type' => 'post',
								'posts_per_page' => $ads_counter,
								'paged' => $paged,
								'meta_query' => array(
									$adstypeQuery,
								),
							);
							$wdp_query = new WP_Query($argas);
						while ($wdp_query->have_posts()) : $wdp_query->the_post();	
							get_template_part( 'templates/classiera-loops/loop-ivy');
						endwhile;
						wp_reset_query();
						wp_reset_postdata(); ?>
					</div><!--row-->
				</div><!--container-->
			</div><!--tabpanel Random-->
			<div role="tabpanel" class="tab-pane fade" id="popular">
				<div class="container">
					<div class="row">
						<?php 
						global $paged, $wp_query, $wp;
						$args = wp_parse_args($wp->matched_query);
						if ( !empty ( $args['paged'] ) && 0 == $paged ) {
							$wp_query->set('paged', $args['paged']);
							$paged = $args['paged'];
						}						
						$args = array(							
							'post_type' => 'post',
							'posts_per_page' => $ads_counter,							
							'paged' => $paged,
							'meta_key' => 'wpb_post_views_count',
							'orderby' => 'meta_value_num',
							'order' => 'DESC',
							'meta_query' => array(
								$adstypeQuery,
							),
						);
						$wp_popular_query = null;
						$wp_popular_query = new WP_Query( $args );
						while ( $wp_popular_query->have_posts() ) : $wp_popular_query->the_post();
							get_template_part( 'templates/classiera-loops/loop-ivy');
						endwhile;
						wp_reset_query();
						wp_reset_postdata(); ?>
					</div><!--row-->
				</div><!--container-->
			</div><!--tabpanel popular-->
			<?php $viewAllAds = classiera_get_template_url('template-all-posts.php'); ?>
			<div class="view-all text-center">               
				<a href="<?php echo esc_url($viewAllAds); ?>" class="btn btn-primary outline btn-md btn-style-five">
					<?php esc_html_e('View All Ads', 'classiera'); ?>
				</a>
            </div>
		</div><!--tab-content-->
	</div><!--tab-divs-->
</section>