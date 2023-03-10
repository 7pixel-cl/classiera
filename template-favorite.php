<?php
/**
 * Template name: Favorite Ads
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage classiera
 * @since classiera 1.0
 */
if ( !is_user_logged_in() ) { 
	$login = classiera_get_template_url('template-login.php');
	if(empty($login)){
		$login = classiera_get_template_url('template-login-v2.php');
	}
	wp_redirect( $login ); exit;
}
get_header(); 
if(isset($_POST['unfavorite'])){
	$author_id = sanitize_text_field($_POST['author_id']);
	$post_id = sanitize_text_field($_POST['post_id']);
	echo classiera_authors_unfavorite($author_id, $post_id);	
}
global $current_user, $user_id, $redux_demo;
wp_get_current_user();
$user_info = get_userdata($user_ID);
$user_id = $current_user->ID; // You can set $user_id to any users, but this gets the current users ID.
$edit = classiera_get_template_url('template-edit-profile.php');
$pagepermalink = get_permalink($post->ID);
$profile = classiera_get_template_url('template-profile.php');
$all_adds = classiera_get_template_url('template-user-all-ads.php');
$allFavourite = classiera_get_template_url('template-favorite.php');
$classieraPartnersStyle = 1;
$classieraCurrencyTag = '$';
$classieraCompany = true;
if(isset($redux_demo)){
	$classieraPartnersStyle = $redux_demo['classiera_partners_style'];
	$classieraCurrencyTag = $redux_demo['classierapostcurrency'];
	$classieraCompany = $redux_demo['partners-on'];
}
$newPostAds = classiera_get_template_url('template-submit-ads.php');
if(empty($newPostAds)){
	$newPostAds = classiera_get_template_url('template-submit-ads-v2.php');
}
$caticoncolor="";
$category_icon_code ="";
$category_icon="";
$category_icon_color="";
$page = get_page($post->ID);
$current_page_id = $page->ID;	
$page_custom_title = get_post_meta($current_page_id, 'page_custom_title', true); ?>
<section class="user-pages section-gray-bg">
	<div class="container">
		<div class="row">
			<div class="col-lg-3 col-md-4">
			<?php get_template_part( 'templates/profile/userabout' );?>
			</div><!--col-lg-3-->
			<div class="col-lg-9 col-md-8 user-content-height">
				<div class="user-detail-section section-bg-white">
					<!-- favorite ads -->
					<div class="user-ads favorite-ads">
						<h4 class="user-detail-section-heading text-uppercase">
						<?php esc_html_e("Favorite Ads", 'classiera') ?>
						</h4>
						<?php 
							global $paged, $wp_query, $wp;
							$args = wp_parse_args($wp->matched_query);
							if ( !empty ( $args['paged'] ) && 0 == $paged ) {
								$wp_query->set('paged', $args['paged']);
								$paged = $args['paged'];
							}							
							global $current_user;
							wp_get_current_user();
							$user_id = $current_user->ID;
							$favoritearray = classiera_authors_all_favorite($user_id);							
							if(!empty($favoritearray)){
								$args = array(
								   'post_type' => 'post',
								   'post__in' => $favoritearray,
								);
								// The Query
								$wp_query = new WP_Query( $args );								
						?>
						<?php while ($wp_query->have_posts()) : $wp_query->the_post();?>
						<?php 
						$post_currency_tag = get_post_meta($post->ID, 'post_currency_tag', true);
						$post_user_ID = $post->post_author;
						$authorName = get_the_author_meta('display_name', $post_user_ID );
						$post_price = get_post_meta($post->ID, 'post_price', true);
						?>
						<!--singlepost-->
						<div class="media border-bottom">
                            <div class="media-left">
								<?php if ( has_post_thumbnail()) {?>
								<?php $imgURL = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full');?>
                                <img class="media-object" src="<?php echo esc_url( $imgURL[0] ); ?>" alt="<?php echo esc_url( get_the_title()); ?>">
								<?php } ?>
                            </div><!--media-left-->
                            <div class="media-body">
                                <h5 class="media-heading">
									<a href="<?php echo esc_url( the_permalink()); ?>">
										<?php echo esc_html( get_the_title()); ?>
									</a>
								</h5>
                                <p>
									<?php ; ?>
                                    <span>
                                        <i class="fas fa-user"></i>
										<?php echo esc_attr($authorName); ?>
                                    </span>
									<?php $dateFormat = get_option( 'date_format' );?>
                                    <span class="classiera_pdate">
                                        <i class="far fa-clock"></i>
                                        <?php echo get_the_date($dateFormat); ?>
                                    </span>
                                </p>
                            </div><!--media-body-->
                            <div class="media-right">
								<?php   ?>
                                <h4>
									<?php 
									if(is_numeric($post_price)){
										echo classiera_post_price_display($post_currency_tag, $post_price);
									}else{ 
										echo esc_attr($post_price); 
									}
									?>
								</h4>
                                <?php echo classiera_authors_favorite_remove($user_id, $post->ID);?>
                            </div><!--media-right-->
                        </div><!--media border-bottom-->
						<!--singlepost-->
						<?php endwhile; ?>
						<?php									
						  if(function_exists('classiera_pagination')){
							classiera_pagination();
						  }
						?>
						<?php wp_reset_query(); ?>	
						<?php }else{ ?>
							<p><?php esc_html_e("You do not have any favorite ad yet!", 'classiera') ?></p>
						<?php }?>
					</div><!--user-ads-->
					
					<!-- favorite ads -->
				</div><!--user-detail-->
			</div><!--col-lg-9-->
		</div><!--row-->
	</div><!--container-->
</section><!--user-pages-->
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