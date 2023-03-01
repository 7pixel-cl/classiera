<section id="classieraDv">
	<div class="container">
		<div class="row">
		<?php 
			$homeAdImg1 = '';		
			$homeAdImglink1 = '';		
			$homeHTMLAds = '';		
			global $redux_demo, $allowed_html;			
			if(isset($redux_demo)){
				$homeAdImg1 = $redux_demo['home_ad1']['url']; 
				$homeAdImglink1 = $redux_demo['home_ad1_url']; 
				$homeHTMLAds = $redux_demo['home_html_ad'];
			}			
			?>
			<div class="col-lg-12 col-md-12 col-sm-12 center-block text-center">
				<p>Espacio Publiciario</p>
				<?php
				if(!empty($homeHTMLAds) || !empty($homeAdImg1)){
					if(!empty($homeHTMLAds)){
						if(function_exists('classiera_escape')) { classiera_escape($homeHTMLAds); }
					}else{
						echo '<a href="'.esc_url($homeAdImglink1).'" target="_blank"><img class="img-responsive" alt="image" src="'.esc_url($homeAdImg1).'" /></a>';
					}
				}
				?>
			</div>
		</div>
	</div>	
</section>