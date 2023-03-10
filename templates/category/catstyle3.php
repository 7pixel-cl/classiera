<?php 
	global $redux_demo;
	$classieraCatIconCode = "";
	$classieraCatIconClr = "";
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
<section class="section-pad category-v3 border-bottom">
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
					if(isset($classieraCatFields[$tag]['category_icon_color'])){
						$classieraCatIconClr = $classieraCatFields[$tag]['category_icon_color'];
					}
					if(isset($classieraCatFields[$tag]['category_image'])){
						$classieraCatIcoIMG = $classieraCatFields[$tag]['category_image'];
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
				$categoryLink = get_category_link( $category->term_id );
				$categories = get_categories('child_of='.$catName);
				foreach ($categories as $category) {
					$allPosts += $category->category_count;
				}
				$classieraTotalPosts = $allPosts + $catCount;
				$category_icon = stripslashes($classieraCatIconCode);
				?>
			<div class="col-lg-4 col-sm-6">
				<div class="category-box border-bottom match-height">
					<div class="category-content">
						<span class="category-icon" style="border: 1px solid <?php echo esc_html($iconColor); ?>">
                            <?php 
							if($classieraIconsStyle == 'icon'){
								?>
								<i style="background:<?php echo esc_html($iconColor); ?>" class="<?php echo esc_html($category_icon); ?>"></i>
								<?php
							}elseif($classieraIconsStyle == 'img'){
								?>
								<img src="<?php echo esc_url($classieraCatIcoIMG); ?>" alt="<?php echo esc_html(get_cat_name( $catName )); ?>">
								<?php
							}
							?>
                        </span>
					</div><!--category-content-->
					<div class="category-content">
						<h4>
						<a href="<?php echo esc_url($categoryLink); ?>">
							<?php echo esc_html(get_cat_name( $catName )); ?>
						</a>
						</h4>
						<?php if($classieraPostCount == 1){?>
							<p><?php echo esc_html($catCount); ?>&nbsp;
							<?php esc_html_e( 'items posted', 'classiera' ); ?></p>
						<?php }?>
						<p class="category-description">
						<?php $desc = category_description( $catName ); ?>
						<?php echo wp_trim_words( $desc, 10, '...' );?>
						</p>
						<a class="view-all" href="<?php echo esc_url(get_category_link( $mainID )); ?>">
							<?php esc_html_e( 'VIEW ALL', 'classiera' ); ?>&nbsp;
							<i class="fas fa-long-arrow-alt-<?php if(is_rtl()){echo "left";}else{echo "right";}?>"></i>
						</a>
					</div><!--category-content-->					
				</div><!--category-box-->
			</div><!--col-lg-4-->
			<?php } ?>
			<div class="col-lg-12 col-md-12 col-sm-12">
				<div class="view-all text-center">
					<a href="<?php echo esc_url($allCatURL); ?>" class="btn btn-primary btn-style-three btn-md"><?php esc_html_e( 'View All Categories', 'classiera' ); ?></a>
				</div>
			</div>
		</div>
	</div>
</section>