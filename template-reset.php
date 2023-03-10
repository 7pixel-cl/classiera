<?php
/**
 * Template name: Reset Password Page
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage classiera
 * @since classiera 1.0
 */

if ( is_user_logged_in() ) {
	$profile = classiera_get_template_url('template-profile.php');
	wp_redirect( $profile ); exit;
}
global $resetSuccess;
if (!$user_ID) {
	if($_POST['submit'] == 'Reset'){		
		// First, make sure the email address is set
		if ( isset( $_POST['email'] ) && ! empty( $_POST['email'] ) ) {

		  	// Next, sanitize the data
		  	$email_addr = trim( strip_tags( stripslashes( $_POST['email'] ) ) );			
		  	$user = get_user_by( 'email', $email_addr );			
			$userEmail = $email_addr;
		  	$user_ID = $user->ID;
			$userName = $user->user_login;
			
		  	if( !empty($user_ID)) {
				$new_password = wp_generate_password( 12, false ); 
				if ( isset($new_password) ) {
					wp_set_password( $new_password, $user_ID );					
					classiera_reset_password($new_password, $userName, $userEmail);					
					$message =  esc_html__( 'Check your email for the new password. If you don&rsquo;t see it in the inbox, check your spam/junk folder.', 'classiera' );					
					$resetSuccess = 1;
				}
		    } else {		      	
				$message =  esc_html__( 'There is no user associated with this email address.', 'classiera' );
		    } // end if/else
		} else {			
			$message =  esc_html__( 'Email should not be empty.', 'classiera' );
		}
	}
}

get_header(); ?>
<?php 
	$page = get_page($post->ID);
	$current_page_id = $page->ID;
?>
<!-- page content -->
<section class="inner-page-content border-bottom top-pad-50">
	<div class="login-register login-register-v1">
		<div class="container">
			<div class="row">
				<div class="col-lg-10 col-md-11 col-sm-12 center-block">
					<?php if($_POST){?>
					<div class="alert alert-danger" role="alert">
					  <?php echo esc_attr($message); ?>
					</div>
					<?php } ?>
					<div class="row">
						<div class="col-lg-12">
							<div class="classiera-login-register-heading border-bottom text-center">
                                <h3 class="text-uppercase"><?php esc_html_e('Reset Your Password', 'classiera') ?></h3>
                            </div>
						</div><!--col-lg-12-->
					</div><!--row-->
					<div class="row">
						<div class="col-lg-8 col-sm-10 col-md-8 center-block">
							<form data-toggle="validator" role="form" method="POST" id="myform" enctype="multipart/form-data">
								<div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-4 col-sm-4 single-label">
                                            <label for="username"><?php esc_html_e( 'Your Email', 'classiera' ); ?> : <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-lg-8 col-sm-8">
                                            <div class="inner-addon left-addon">
                                                <i class="left-addon form-icon fas fa-lock"></i>
                                                <input type="text" id="username" name="email" class="form-control form-control-md sharp-edge" placeholder="<?php esc_attr_e( 'Type Your Email', 'classiera' ); ?>" data-error="<?php esc_attr_e( 'Email required', 'classiera' ); ?>" required>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div><!--Email div-->
								<div class="col-lg-8 col-sm-8 pull-right flip">
                                    <div class="form-group">
										<input type="hidden" id="submit" name="submit" value="Reset" />	
										<button class="btn btn-primary sharp btn-md btn-style-one" id="edit-submit" name="op" value="Reset" type="submit"><?php esc_html_e('Reset Password', 'classiera') ?></button>
                                    </div>
                                </div><!--Email div-->
							</form>
						</div>
					</div><!--row-->
				</div><!--col-lg-10-->
			</div><!--row-->
		</div><!--container-->
	</div><!--login-register login-register-v1-->
</section>
<!-- Company Section Start-->
<?php 
	global $redux_demo;
	$classieraCompany = false;	
	$classieraPartnersStyle = false;	
	if(isset($redux_demo)){
		$classieraCompany = $redux_demo['partners-on'];
		$classieraPartnersStyle = $redux_demo['classiera_partners_style'];
	}	
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