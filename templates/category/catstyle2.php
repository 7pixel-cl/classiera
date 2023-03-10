<?php 
	global $redux_demo;
	$category_icon_code = "";
	$category_icon_color = "";
	$catIcon = "";
	$classieraCatIconCode = '';
	$classieraCatIcoIMG = '';
	$classieraCatIconClr = '';	
	$classieraCatSECTitle = "";	
	$classieraCatSECDESC = "";	
	$cat_counter = 12;	
	$primaryColor = "#b6d91a";	
	$classieraIconsStyle = "icon";	
	$classieraPostCount = false;	
	if(isset($redux_demo)){
		$classieraCatSECTitle = $redux_demo['cat-sec-title'];
		$classieraCatSECDESC = $redux_demo['cat-sec-desc'];
		$cat_counter = $redux_demo['home-cat-counter'];
		$primaryColor = $redux_demo['color-primary'];
		$classieraIconsStyle = $redux_demo['classiera_cat_icon_img'];
		$classieraPostCount = $redux_demo['classiera_cat_post_counter'];
	}	
	$allCatURL = classiera_get_template_url('template-all-categories.php');	
?>
<section class="section-pad category-v2 border-bottom">
	<?php if(!empty($classieraCatSECTitle)){ ?>
	<div class="section-heading-v1">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-7 center-block">
                    <h3 class="text-uppercase"><?php echo esc_html($classieraCatSECTitle); ?></h3>
					<?php if(!empty($classieraCatSECDESC)){ ?>
                    <p><?php echo esc_html($classieraCatSECDESC); ?></p>
					<?php } ?>
                </div><!--col-lg-7-->
            </div><!--row-->
        </div><!--container-->
    </div><!--section-heading-v1-->
	<?php } ?>
	<div class="container">
		<div class="row">
			<?php 
			$categories = get_terms('category', array(
					'hide_empty' => 0,
					'parent' => 0,
					'number' => $cat_counter,
					'order'=> 'ASC'
				)	
			);
			$current = -1;
			foreach ($categories as $category) {
				$tag = $category->term_id;
				$classieraCatFields = get_option(MY_CATEGORY_FIELDS);
				//print_r($classieraCatFields);
				if (isset($classieraCatFields[$tag])){					
					if(isset($classieraCatFields[$tag]['category_icon_code'])){
						$classieraCatIconCode = $classieraCatFields[$tag]['category_icon_code'];
					}
					if(isset($classieraCatFields[$tag]['category_image'])){
						$classieraCatIcoIMG = $classieraCatFields[$tag]['category_image'];
					}
					if(isset($classieraCatFields[$tag]['category_icon_color'])){
						$classieraCatIconClr = $classieraCatFields[$tag]['category_icon_color'];
					}
				}
				$catCount = $category->count;
				$catName = $category->term_id;
				$mainID = $catName;
				if(empty($classieraCatIconClr)){
					$iconColor = $primaryColor;
				}else{
					$iconColor = $classieraCatIconClr;
				}
				$current++;
				$allPosts = 0;
				$childcategories = get_categories('child_of='.$catName);
				//print_r($childcategories);
				foreach ($childcategories as $category) {
					$allPosts = $category->category_count;
				}
				$classieraTotalPosts = $allPosts + $catCount;
				$category_icon = stripslashes($classieraCatIconCode);
				?>
			<div class="col-lg-4 col-md-4 col-sm-6 match-height">
				<div class="category-box border">
					<div class="category-heading clearfix border-bottom">
						<span class="category-icon-box pull-left flip">                            
							<?php 
							if($classieraIconsStyle == 'icon'){
								?>
								<i class="<?php echo esc_html($category_icon); ?> icon-color" style="color:<?php echo esc_html($iconColor); ?>;"></i>
								<?php
							}elseif($classieraIconsStyle == 'img'){
								?>
								<img src="<?php echo esc_url($classieraCatIcoIMG); ?>" alt="<?php echo esc_html(get_cat_name( $catName )); ?>">
								<?php
							}
							?>
                        </span><!--category-icon-box-->
						<div class="category-heading-content pull-left flip">
                            <h4><?php echo esc_html(get_cat_name( $catName )); ?></h4>
                            <p>
							<?php if($classieraPostCount == 1){?>
								<?php echo esc_attr($catCount); ?>&nbsp;
								<?php esc_html_e( 'ads posted', 'classiera' ); ?>
							<?php }else{?>
								&nbsp;
							<?php } ?>
							</p>
                        </div><!--category-heading-content-->
					</div><!--category-heading-->
					<div class="category-content">
						<ul>
							<?php 
								$args = array(
									'type' => 'post',
									'child_of' => $catName,
									'parent' => $catName,
									'orderby' => 'name',
									'order' => 'ASC',
									'suppress_filters' => false,
									'hide_if_empty' => false,
									'hide_empty' => 0,
									'depth' => 1,
									'hierarchical' => 1,
									'exclude' => '',
									'include' => '',
									'number' => '5',
									'taxonomy' => 'category',
									'pad_counts' => true 
								);								
								$subcategories = get_categories($args);
								foreach($subcategories as $category) {
									$categoryTitle = $category->name;
									$categoryLink = get_category_link( $category->term_id );
									?>
									<li>
										<a href="<?php echo esc_url($categoryLink); ?>" class="av-2" data-color="<?php echo esc_html($iconColor); ?>">
											<i class="fas fa-angle-<?php if(is_rtl()){echo "left";}else{echo "right";}?>"></i><?php echo esc_html($categoryTitle); ?> 
											<span>
											<?php if($classieraPostCount == 1){?>
												(<?php echo esc_attr($category->count) ?>)
											<?php }else{?>
												&nbsp;
											<?php } ?>
											</span>
										</a>
									</li>
									<?php
								}
							?>
						</ul>
						<div class="view-button text-center">
							<a href="<?php echo esc_url(get_category_link( $mainID )); ?>">
								<?php esc_html_e( 'VIEW ALL', 'classiera' ); ?>
								<?php if(is_rtl()){?>
									<i class="fas fa-long-arrow-alt-left right-i"></i>
								<?php }else{ ?>
									<i class="fas fa-long-arrow-alt-right right-i"></i>
								<?php } ?>
							</a>
						</div><!--view-button text-center-->
					</div><!--category-content-->
				</div><!--category-box-->
			</div><!--col-lg-4-->
			<?php } ?>
			<div class="col-lg-12 col-md-12 col-sm-12">
				<div class="view-all text-center">
					<a href="<?php echo esc_url($allCatURL); ?>" class="btn btn-primary round btn-style-two btn-md"><?php esc_html_e( 'View All Categories', 'classiera' ); ?><span><i class="fas fa-sync-alt"></i></span></a>
				</div>
			</div>
		</div>
	</div>
</section>