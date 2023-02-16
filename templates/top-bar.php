<?php 
	global $redux_demo;
	$classieraNavClass = '';
	$classieraColSM = '';
	$classieraColSM2 = '';
	$classieraContainer = 'container';
	$classieraRow = 'row';
	$classieraColLG = 'col-lg-6';
	$classieraColLG2 = 'col-lg-6';
	$classieraColMD = 'col-md-6';
	$classieraColMD2 = 'col-md-6';
	$classieraTopBar = '';
	/*==========================
	Classiera : Get Theme Options saved values
	===========================*/
	$classieraLogo = '';
	$classieraContactEmail = '';
	$classieraContactPhone = '';
	$classieraFacebook = '';
	$classieraTwitter = '';
	$classieraDribbble = '';
	$classieraFlickr = '';
	$classieraGithub = '';
	$classieraPinterest = '';
	$classieraYouTube = '';
	$classieraGoogle = '';
	$classieraLinkedin = '';
	$classieraInstagram = '';
	$classieraVimeo = '';
	$classieraVK = '';
	$classieraOK = '';
	$classieraNavStyle = 1;
	if(isset($redux_demo)){
		$classieraLogo = $redux_demo['logo']['url'];
		$classieraContactEmail = $redux_demo['contact-email'];
		$classieraContactPhone = $redux_demo['contact-phone'];
		$classieraFacebook = $redux_demo['facebook-link'];
		$classieraTwitter = $redux_demo['twitter-link'];
		$classieraDribbble = $redux_demo['dribbble-link'];
		$classieraFlickr = $redux_demo['flickr-link'];
		$classieraGithub = $redux_demo['github-link'];
		$classieraPinterest = $redux_demo['pinterest-link'];	
		$classieraYouTube = $redux_demo['youtube-link'];
		$classieraGoogle = $redux_demo['google-plus-link'];
		$classieraLinkedin = $redux_demo['linkedin-link'];
		$classieraInstagram = $redux_demo['instagram-link'];
		$classieraVimeo = $redux_demo['vimeo-link'];
		$classieraVK = $redux_demo['vk-link'];
		$classieraOK = $redux_demo['odnoklassniki-link'];	
		$classieraNavStyle = $redux_demo['nav-style'];
	}		
	/*==========================
	Classiera : Get Template URL with template name.
	===========================*/
	$classieraProfileURL = classiera_get_template_url('template-profile.php');	
	$classieraSubmitPost = classiera_get_template_url('template-submit-ads.php');	
	if(empty($classieraSubmitPost)){
		$classieraSubmitPost = classiera_get_template_url('template-submit-ads-v2.php');
	}	
	$classieraLoginURL = classiera_get_template_url('template-login.php');
	if(empty($classieraLoginURL)){
		$classieraLoginURL = classiera_get_template_url('template-login-v2.php');
	}
	$classieraRegisterURL = classiera_get_template_url('template-register.php');
	if(empty($classieraRegisterURL)){
		$classieraRegisterURL = classiera_get_template_url('template-login-v2.php');
	}
	/*==========================
	Classiera : Define classes on layout base
	===========================*/
	if($classieraNavStyle == 1){
		$classieraColSM = 'col-sm-6';
		$classieraColSM2 = 'col-sm-6';
		$classieraContainer = 'container';
		$classieraRow = 'row';
		$classieraTopBar = true;
	}elseif($classieraNavStyle == 2){
		$classieraNavClass = 'topBar-v2';
		$classieraContainer = 'container';
		$classieraRow = 'row';
		$classieraColSM = 'col-sm-3';
		$classieraColSM2 = 'col-sm-9';
		$classieraColLG = 'col-lg-3';
		$classieraColLG2 = 'col-lg-9';
		$classieraColMD = 'col-md-3';
		$classieraColMD2 = 'col-md-9';
		$classieraTopBar = true;
	}elseif($classieraNavStyle == 3){
		$classieraNavClass = 'topBar-v3';
		$classieraContainer = 'container-fluid';
		$classieraRow = 'row-fluid';
		$classieraColSM = 'col-sm-8';
		$classieraColSM2 = 'col-sm-4';
		$classieraTopBar = true;
	}elseif($classieraNavStyle == 4){
		$classieraNavClass = 'topBar-v4';
		$classieraContainer = 'container';
		$classieraRow = 'row';
		$classieraColSM = 'col-sm-7';
		$classieraColLG = 'col-lg-6';
		$classieraColLG2 = 'col-lg-6';
		$classieraColSM2 = 'col-sm-5';
		$classieraTopBar = true;
	}elseif($classieraNavStyle == 5){
		$classieraNavClass = 'topBar-v4';
		$classieraTopBar = true;
	}elseif($classieraNavStyle == 6){
		$classieraTopBar = false;
	}elseif($classieraNavStyle == 7){
		$classieraTopBar = false;
	}
	if($classieraTopBar == true){
?>
<section class="topBar <?php echo esc_attr( $classieraNavClass ); ?> hidden-xs">
	<div class="<?php echo esc_attr( $classieraContainer ); ?>">
		<div class="<?php echo esc_attr( $classieraRow ); ?>">
			<div class="<?php echo esc_attr( $classieraColLG ); ?> <?php echo esc_attr( $classieraColMD ); ?> <?php echo esc_attr( $classieraColSM ); ?>">
			<?php if($classieraNavStyle == 1){?>
				<div class="contact-info">
					<?php if(!empty($classieraContactEmail)){?>
					<span>
						<i class="fas fa-envelope"></i>						
						<?php echo sanitize_email( $classieraContactEmail ); ?>
					</span>
					<?php } ?>
					<?php if(!empty($classieraContactPhone)){?>
					<span>
						<i class="fas fa-phone-square"></i>						
						<?php echo esc_html( $classieraContactPhone ); ?>
					</span>
					<?php } ?>
				</div>
			<?php }elseif($classieraNavStyle == 2){?>
				<div class="logo">					
					<a href="<?php echo esc_url(home_url()); ?>">
						<?php if(empty($classieraLogo)){?>
							<img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/logo.png" alt="<?php bloginfo( 'name' ); ?>">
						<?php }else{ ?>
							<img src="<?php echo esc_url( $classieraLogo ); ?>" alt="<?php bloginfo( 'name' ); ?>">
						<?php } ?>
					</a>
				</div>
			<?php }elseif($classieraNavStyle == 3){ ?>
				<p>
					<?php esc_html_e( 'Support', 'classiera' ); ?>:
					<span><i class="fas fa-envelope-square"></i><?php echo sanitize_email( $classieraContactEmail ); ?></span>
					<span><i class="fas fa-phone-square"></i><?php echo esc_html( $classieraContactPhone ); ?></span>
				</p>
			<?php }elseif($classieraNavStyle == 4){?>
				<div class="contact-info">
					<ul class="list-inline">
						<?php if(!empty($classieraContactEmail)){?>
						<li>
							<?php esc_html_e( 'Email', 'classiera' ); ?>: 
							<span><?php echo sanitize_email( $classieraContactEmail ); ?></span>
						</li>
						<?php } ?>
						<?php if(!empty($classieraContactPhone)){?>
						<li>
							<?php esc_html_e( 'Call', 'classiera' ); ?>: 
							<span><?php echo esc_html( $classieraContactPhone ); ?></span>
						</li>
						<?php } ?>
					</ul>
				</div>
			<?php } ?>
			</div>
			<div class="<?php echo esc_attr( $classieraColLG2 ); ?> <?php echo esc_attr( $classieraColMD2 ); ?> <?php echo esc_attr( $classieraColSM2 ); ?>">
			<?php if($classieraNavStyle == 1){?>	
				<div class="login-info text-right flip">
					<?php if(is_user_logged_in()){?>
						<a href="<?php echo esc_url( $classieraProfileURL ); ?>"><?php esc_html_e( 'My Account', 'classiera' ); ?></a>
						<a href="<?php echo wp_logout_url(get_option('siteurl')); ?>" class="register">
							<i class="fas fa-power-off"></i>
							<?php esc_html_e( 'Log out', 'classiera' ); ?>
						</a>
					<?php }else{?>
						<a href="<?php echo esc_url( $classieraLoginURL ); ?>"><?php esc_html_e( 'Login', 'classiera' ); ?></a>
						<a href="<?php echo esc_url( $classieraRegisterURL ); ?>" class="register">
							<i class="fas fa-user-alt"></i>
							<?php esc_html_e( 'Get Registered', 'classiera' ); ?>
						</a>
					<?php } ?>
				</div>
			<?php }elseif($classieraNavStyle == 2){?>
				<div class="topBar-v2-icons text-right flip">
					<span><?php esc_html_e( 'Follow Us', 'classiera' ); ?> :</span>
					<span class="top-icons">
						<?php if(!empty($classieraFacebook)){?>
						<a href="<?php echo esc_url( $classieraFacebook ); ?>" class="social-icon-v2 rounded" target="_blank">
							<i class="fab fa-facebook-f"></i>
						</a>
						<?php } ?>
						<?php if(!empty($classieraTwitter)){?>
						<a href="<?php echo esc_url( $classieraTwitter ); ?>" class="social-icon-v2 rounded" target="_blank">
							<i class="fab fa-twitter"></i>
						</a>
						<?php } ?>
						<?php if(!empty($classieraInstagram)){?>
						<a href="<?php echo esc_url( $classieraInstagram ); ?>" class="social-icon-v2 rounded" target="_blank">
							<i class="fab fa-instagram"></i>
						</a>
						<?php } ?>
						
						<?php if(!empty($classieraDribbble)){?>
						<a href="<?php echo esc_url( $classieraDribbble ); ?>" class="social-icon-v2 rounded" target="_blank">
							<i class="fab fa-dribbble"></i>
						</a>
						<?php } ?>
						<?php if(!empty($classieraFlickr)){?>
						<a href="<?php echo esc_url( $classieraFlickr ); ?>" class="social-icon-v2 rounded" target="_blank">
							<i class="fab fa-flickr"></i>
						</a>
						<?php } ?>
						<?php if(!empty($classieraGithub)){?>
						<a href="<?php echo esc_url( $classieraGithub ); ?>" class="social-icon-v2 rounded" target="_blank">
							<i class="fab fa-github-alt"></i>
						</a>
						<?php } ?>
						<?php if(!empty($classieraPinterest)){?>
						<a href="<?php echo esc_url( $classieraPinterest ); ?>" class="social-icon-v2 rounded" target="_blank">
							<i class="fab fa-pinterest-p"></i>
						</a>
						<?php } ?>
						<?php if(!empty($classieraYouTube)){?>
						<a href="<?php echo esc_url( $classieraYouTube ); ?>" class="social-icon-v2 rounded" target="_blank">
							<i class="fab fa-youtube"></i>
						</a>
						<?php } ?>
						<?php if(!empty($classieraGoogle)){?>
						<a href="<?php echo esc_url( $classieraGoogle ); ?>" class="social-icon-v2 rounded" target="_blank">
							<i class="fab fa-google-plus-g"></i>
						</a>
						<?php } ?>
						<?php if(!empty($classieraLinkedin)){?>
						<a href="<?php echo esc_url( $classieraLinkedin ); ?>" class="social-icon-v2 rounded" target="_blank">
							<i class="fab fa-linkedin-in"></i>
						</a>
						<?php } ?>
						<?php if(!empty($classieraVimeo)){?>
						<a href="<?php echo esc_url( $classieraVimeo ); ?>" class="social-icon-v2 rounded" target="_blank">
							<i class="fab fa-vimeo-v"></i>
						</a>
						<?php } ?>
						<?php if(!empty($classieraVK)){?>
						<a href="<?php echo esc_url( $classieraVK ); ?>" class="social-icon-v2 rounded" target="_blank">
							<i class="fab fa-vk"></i>
						</a>
						<?php } ?>
						<?php if(!empty($classieraOK)){?>
						<a href="<?php echo esc_url( $classieraOK ); ?>" class="social-icon-v2 rounded" target="_blank">
							<i class="fab fa-odnoklassniki"></i>
						</a>
						<?php } ?>
					</span>
					<?php if(is_user_logged_in()){?>
						<a href="<?php echo esc_url( $classieraProfileURL ); ?>" class="btn btn-primary round btn-md btn-style-two">
							<?php esc_html_e( 'My Account', 'classiera' ); ?>
							<span><i class="fas fa-lock"></i></span>
						</a>
						<?php if(!empty($classieraSubmitPost)){ ?>
						<a href="<?php echo esc_url( $classieraSubmitPost ); ?>" class="btn btn-primary round btn-md btn-style-two">
							<?php esc_html_e( 'Submit Ad', 'classiera' ); ?>
							<span><i class="fas fa-plus"></i></span>
						</a>
						<?php } ?>
						<a href="<?php echo wp_logout_url(get_option('siteurl')); ?>" class="btn btn-primary round btn-md btn-style-two">
							<?php esc_html_e( 'Log out', 'classiera' ); ?>
							<span><i class="fas fa-lock"></i></span>
						</a>
					<?php }else{ ?>
						<a href="<?php echo esc_url( $classieraLoginURL ); ?>" class="btn btn-primary round btn-md btn-style-two">
							<?php esc_html_e( 'Login', 'classiera' ); ?>
							<span><i class="fas fa-lock"></i></span>
						</a>
						<a href="<?php echo esc_url( $classieraRegisterURL ); ?>" class="btn btn-primary round btn-md btn-style-two">
							<?php esc_html_e( 'Get Registered', 'classiera' ); ?>
							<span><i class="far fa-edit"></i></span>
						</a>
						<?php if(!empty($classieraSubmitPost)){ ?>
                        <a href="<?php echo esc_url( $classieraSubmitPost ); ?>" class="btn btn-primary round btn-md btn-style-two">
							<?php esc_html_e( 'Submit Ad', 'classiera' ); ?>
							<span><i class="fas fa-plus"></i></span>
						</a>
						<?php } ?>
					<?php } ?>
					<!--LoginButton-->
				</div>
			<?php }elseif($classieraNavStyle == 3){?>
				<div class="login-info text-right text-uppercase flip">
					<?php if(is_user_logged_in()){?>
						<a href="<?php echo esc_url( $classieraProfileURL ); ?>"><?php esc_html_e( 'My Account', 'classiera' ); ?></a>
						<a href="<?php echo wp_logout_url(get_option('siteurl')); ?>">
							<?php esc_html_e( 'Log out', 'classiera' ); ?>
						</a>
					<?php }else{?>
						<a href="<?php echo esc_url( $classieraLoginURL ); ?>"><?php esc_html_e( 'Login', 'classiera' ); ?></a>
						<a href="<?php echo esc_url( $classieraRegisterURL ); ?>">							
							<?php esc_html_e( 'Get Registered', 'classiera' ); ?>
						</a>
					<?php } ?>
				</div>
			<?php }elseif($classieraNavStyle == 4){ ?>
				<div class="follow">
					<ul class="login pull-right flip">
						<?php if(is_user_logged_in()){?>
						<li>
							<a href="<?php echo esc_url( $classieraProfileURL ); ?>">
								<i class="fas fa-user"></i>
								<?php esc_html_e( 'My Account', 'classiera' ); ?>
							</a>
						</li>
						<?php }else{?>
						<li>
							<a href="<?php echo esc_url( $classieraLoginURL ); ?>">
								<i class="fas fa-sign-in-alt"></i>
								<?php esc_html_e( 'Login', 'classiera' ); ?>
							</a>
						</li>
						<?php } ?>
					</ul>
					<ul class="list-inline pull-right flip">
						<li><span><?php esc_html_e( 'Follow Us', 'classiera' ); ?> : </span></li>
						<?php if(!empty($classieraFacebook)){?>
						<li><a href="<?php echo esc_url( $classieraFacebook ); ?>" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
						<?php } ?>
						<?php if(!empty($classieraTwitter)){?>
						<li><a href="<?php echo esc_url( $classieraTwitter ); ?>" target="_blank"><i class="fab fa-twitter"></i></a></li>
						<?php } ?>
						<?php if(!empty($classieraGoogle)){?>
						<li><a href="<?php echo esc_url( $classieraGoogle ); ?>" target="_blank"><i class="fab fa-google-plus-g"></i></a></li>
						<?php } ?>
						<?php if(!empty($classieraInstagram)){?>
						<li><a href="<?php echo esc_url( $classieraInstagram ); ?>" target="_blank"><i class="fab fa-instagram"></i></a></li>
						<?php } ?>						
						<?php if(!empty($classieraDribbble)){?>
						<li><a href="<?php echo esc_url( $classieraDribbble ); ?>" target="_blank"><i class="fab fa-dribbble"></i></a></li>
						<?php } ?>
						<?php if(!empty($classieraFlickr)){?>
						<li><a href="<?php echo esc_url( $classieraFlickr ); ?>" target="_blank"><i class="fab fa-flickr"></i></a></li>
						<?php } ?>
						<?php if(!empty($classieraGithub)){?>
						<li><a href="<?php echo esc_url( $classieraGithub ); ?>" target="_blank"><i class="fab fa-github-alt"></i></a></li>
						<?php } ?>
						<?php if(!empty($classieraPinterest)){?>
						<li><a href="<?php echo esc_url( $classieraPinterest ); ?>" target="_blank"><i class="fab fa-pinterest-p"></i></a></li>
						<?php } ?>
						<?php if(!empty($classieraYouTube)){?>
						<li><a href="<?php echo esc_url( $classieraYouTube ); ?>" target="_blank"><i class="fab fa-youtube"></i></a></li>
						<?php } ?>
						<?php if(!empty($classieraLinkedin)){?>
						<li><a href="<?php echo esc_url( $classieraLinkedin ); ?>" target="_blank"><i class="fab fa-linkedin-in"></i></a></li>
						<?php } ?>
						<?php if(!empty($classieraVimeo)){?>
						<li><a href="<?php echo esc_url( $classieraVimeo ); ?>" target="_blank"><i class="fab fa-vimeo-v"></i></a></li>
						<?php } ?>
						<?php if(!empty($classieraVK)){?>
						<li><a href="<?php echo esc_url( $classieraVK ); ?>" target="_blank"><i class="fab fa-vk"></i></a></li>
						<?php } ?>
						<?php if(!empty($classieraOK)){?>
						<li><a href="<?php echo esc_url( $classieraOK ); ?>" target="_blank"><i class="fab fa-odnoklassniki"></i></a></li>
						<?php } ?>
					</ul>
				</div>
			<?php } ?>
			</div>
		</div>
	</div>
</section><!-- /.topBar -->
	<?php } ?>