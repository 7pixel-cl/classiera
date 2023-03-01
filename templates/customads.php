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
				<label class='banner-ad-label-top'>Espacio Publiciario</label>
				<?php
				if(!empty($homeHTMLAds) || !empty($homeAdImg1)){
					if(!empty($homeHTMLAds)){
						if(function_exists('classiera_escape')) { classiera_escape($homeHTMLAds); }
					}else{
						echo '<a href="'.esc_url($homeAdImglink1).'" target="_blank"><img class="img-responsive" alt="image" src="'.esc_url($homeAdImg1).'" /></a>';
					}
				}
				?>
						<a href="https://api.whatsapp.com/send?phone=56953535153&text=Hola,+estoy+interesado+en+publicitar+en+Necesito+en+Villarrica" target="_blank">Anuncia con nosotros >
									<i class="fab fa-whatsapp"></i> 
								</a>
			</div>
		</div>
	</div>	
</section>