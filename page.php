<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that other
 * 'pages' on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage classiera
 * @since classiera 1.0
 */

get_header();
 ?>

<?php 

	$page = get_page($post->ID);
	$current_page_id = $page->ID;
	$page_slider = get_post_meta($current_page_id, 'page_slider', true); 
	$page_custom_title = get_post_meta($current_page_id, 'page_custom_title', true);

	global $redux_demo;
	$caticoncolor="";
	$category_icon_code ="";
	$category_icon="";
	$category_icon_color="";
	$classieraSearchStyle = 1;
	$classieraCompany = false;
	$classiera_page_search = true;
	$classieraComments = true;
	if(isset($redux_demo)){
		$classieraSearchStyle = $redux_demo['classiera_search_style'];
		$classieraPartnersStyle = $redux_demo['classiera_partners_style'];		
		$classieraCompany = $redux_demo['partners-on'];
		$classieraComments = $redux_demo['classiera_sing_post_comments'];
		$classiera_page_search = $redux_demo['classiera_page_search'];
	}		
?>

<?php 
if($page_slider == "LayerSlider") {
	get_template_part( 'templates/slider/sliderv1' );
}
?>
<?php 
	//Search Styles//
if($classiera_page_search == true){
	if($classieraSearchStyle == 1){
		get_template_part( 'templates/searchbar/searchstyle1' );
	}elseif($classieraSearchStyle == 2){
		get_template_part( 'templates/searchbar/searchstyle2' );
	}elseif($classieraSearchStyle == 3){
		get_template_part( 'templates/searchbar/searchstyle3' );
	}elseif($classieraSearchStyle == 4){
		get_template_part( 'templates/searchbar/searchstyle4' );
	}elseif($classieraSearchStyle == 5){
		get_template_part( 'templates/searchbar/searchstyle5' );
	}elseif($classieraSearchStyle == 6){
		get_template_part( 'templates/searchbar/searchstyle6' );
	}elseif($classieraSearchStyle == 7){
		get_template_part( 'templates/searchbar/searchstyle7' );
	}
}
?>
<!--PageContent-->
<section class="inner-page-content border-bottom">
	<div class="container">
		<!-- breadcrumb -->
		<?php classiera_breadcrumbs();?>		
		<!-- breadcrumb -->
		<div class="row">
			<div class="<?php if ( is_active_sidebar( 'pages' ) ) {echo "col-md-8 col-lg-9";}else{ echo "col-lg-12 col-md-9 mx-auto"; }?>">
				<article class="article-content">
					<h3><?php the_title(); ?></h3>
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					<?php the_content(); ?>
					<?php endwhile; endif; ?>
				</article>
				<!--comments-->
				<?php
					$defaults = array(
						'before'           => '<p>' . __( 'Pages:' , 'classiera'),
						'after'            => '</p>',
						'link_before'      => '',
						'link_after'       => '',
						'next_or_number'   => 'number',
						'separator'        => ' ',
						'nextpagelink'     => __( 'Next page', 'classiera'),
						'previouspagelink' => __( 'Previous page', 'classiera'),
						'pagelink'         => '%',
						'echo'             => 1
					);
					wp_link_pages( $defaults );
				?>
				<!--comments-->
					<?php if($classieraComments == 1){?>
					<?php if ( comments_open()) { ?>
					<div class="border-section border comments">
						<h4 class="border-section-heading text-uppercase"><?php esc_html_e( 'Comments', 'classiera' ); ?></h4>
						<?php 
						$file ='';
						$separate_comments ='';
						comments_template( $file, $separate_comments );
						?>
					</div>
					<?php } ?>
					<?php } ?>
					<!--comments-->
				<div class="hidden">
					<?php comment_form(); ?>
				</div>
				<!--comments-->
			</div><!--col-md-8 col-lg-9-->
			<?php if ( is_active_sidebar( 'pages' )) { ?>
			<div class="col-md-4 col-lg-3">
				<aside class="sidebar">
					<div class="row">						
						<?php 
						if ( is_active_sidebar( 'pages' ) ) {
							get_sidebar('pages');
						}
						?>
					</div>
				</aside>
			</div><!--col-md-4 col-lg-3-->
			<?php } ?>
		</div><!--row-->
	</div>
</section>
<!--PageContent-->
<!-- Company Section Start-->
<?php	
	if($classieraCompany == 1){
		if($classieraPartnersStyle == 1){
			get_template_part('templates/members/memberv1');
		}elseif($classieraPartnersStyle == 2){
			get_template_part('templates/members/memberv2');
		}elseif($classieraPartnersStyle == 3){
			get_template_part('templates/members/memberv3');
		}elseif($classieraPartnersStyle == 4){
			get_template_part('templates/members/memberv4');
		}elseif($classieraPartnersStyle == 5){
			get_template_part('templates/members/memberv5');
		}elseif($classieraPartnersStyle == 6){
			get_template_part('templates/members/memberv6');
		}
	}
?>
<!-- Company Section End-->	
<?php get_footer(); ?>