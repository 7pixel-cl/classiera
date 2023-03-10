<?php 
	global $redux_demo;
	$category_icon_code = "";
	$category_icon_color = "";
	$catIcon = "";
	$classieraCatSECTitle = "";	
	$classieraCatSECDESC = "";	
	$cat_counter = 12;	
	$primaryColor = "#b6d91a";	
	$classieraIconsStyle = "icon";	
	$classieraPostCount = false;	
	if(isset($redux_demo)){
		$classieraCatSECTitle = $redux_demo['cat-sec-title'];
		$classieraCatSECDESC = $redux_demo['cat-sec-desc'];
		$cat_counter = $redux_demo['classiera_no_of_cats_all_page'];
		$primaryColor = $redux_demo['color-primary'];
		$classieraIconsStyle = $redux_demo['classiera_cat_icon_img'];
		$classieraPostCount = $redux_demo['classiera_cat_post_counter'];
	}	
	$allCatURL = classiera_get_template_url('template-all-categories.php');		
?>
<section class="section-pad classiera-category-new-v2">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="classiera-category-content">
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
							$classieraCatIconCode = $classieraCatFields[$tag]['category_icon_code'];
							$classieraCatIcoIMG = $classieraCatFields[$tag]['category_image'];
							$classieraCatIconClr = $classieraCatFields[$tag]['category_icon_color'];
							$categoryIMG = $classieraCatFields[$tag]['category_image'];
						}
						$cat = $category->count;
						$catName = $category->term_id;
						$mainID = $catName;
						if(empty($classieraCatIconClr)){
							$iconColor = $primaryColor;
						}else{
							$iconColor = $classieraCatIconClr;
						}
						if(empty($categoryIMG)){
							$classieracatIMG = get_template_directory_uri().'/images/category.png';
						}else{
							$classieracatIMG = $categoryIMG;
						}	
						$current++;
						$allPosts = 0;
						$categoryLink = get_category_link( $category->term_id );
						$categories = get_categories('child_of='.$catName);
						foreach ($categories as $category) {
							$allPosts = $category->category_count;
						}
						$classieraTotalPosts = $allPosts + $cat;
						$category_icon = stripslashes($classieraCatIconCode);
						?>
						<a href="<?php echo esc_url($categoryLink); ?>" class="classiera-category-new-v2-box" data-color="<?php echo esc_html($iconColor); ?>">
							<span class="classiera-category-new-v2-box-img">
								<?php 
								if($classieraIconsStyle == 'icon'){
									?>
									<i class="<?php echo esc_html($category_icon); ?>" style="color:<?php echo esc_html($iconColor); ?>;"></i>
									<?php
								}elseif($classieraIconsStyle == 'img'){
									?>
									<img src="<?php echo esc_url($classieracatIMG); ?>" alt="<?php echo esc_html(get_cat_name( $catName )); ?>">
									<?php
								}
								?>
							</span>
							<h5 class="classiera-category-new-v2-box-title">
								<?php echo esc_html(get_cat_name( $catName )); ?>
							</h5>
						</a>	
						<?php } ?>
				</div><!--classiera-category-content-->
			</div><!--col-lg-12-->
		</div><!--row-->
	</div><!--container-->
</section>