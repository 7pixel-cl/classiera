<?php
/**
 * Template name: Homepage V5 - IVY
 *
 * This is the most generic template file in a WordPress theme and one of the
 * two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage classiera
 * @since classiera 1.0
 */
get_header(); ?>

<?php 
	$page = get_page($post->ID);
	$current_page_id = $page->ID;
	$page_slider = get_post_meta($current_page_id, 'page_slider', true); 
	global $redux_demo;
	$homeLayout = '';
	if(isset($redux_demo)){
		$homeLayout = $redux_demo['opt-homepage-layout-v5']['enabled'];	
	}		
?>
<?php 
if ($homeLayout):
	foreach ($homeLayout as $key=>$value) { 
			switch($key) {
		 
					case 'searchv5': get_template_part( 'templates/searchbar/searchstyle5' );
					break;
					
					case 'banner': get_template_part( 'templates/slider/sliderv2' );
					break;
					
					case 'premiumslider': get_template_part( 'templates/premium/premiumv4' );
					break;
					
					case 'googlemap': get_template_part( 'templates/slider/classiera-header-map' );
					break;
					
					case 'categories': get_template_part( 'templates/category/catstyle5');
					break;
					
					case 'customads': get_template_part( 'templates/customads' );
					break;
					case 'customads2': get_template_part( 'templates/customads2' );
					break;
					case 'customads3': get_template_part( 'templates/customads3' );
					break;
					
					case 'callout': get_template_part( 'templates/callout/callout5' );    
					break;
					
					case 'advertisement': get_template_part( 'templates/adv/advstyle5' );
					break;
					
					case 'location': get_template_part( 'templates/locations/locationsv4' );    
					break;
					
					case 'packages': get_template_part( 'templates/plans/plansv5' );    
					break;
					
					case 'blogs': get_template_part( 'templates/blogs/blogv2' );    
					break;
					
					case 'partners': get_template_part( 'templates/members/memberv5' );    
					break;
					
					case 'contentsection': get_template_part( 'templates/contentsection' );
					break;
					
				}			 
			}		 
	endif;
?>
<?php get_footer(); ?>