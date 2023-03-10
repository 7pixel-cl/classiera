<?php 
global $redux_demo, $allowed_html;
$calloutbg = '';
$calloutbgV2 = '';
$calloutTitle = '';
$calloutTitlesecond = '';
$calloutDesc = '';
$calloutBtnTxt = '';
$calloutBtnIcon = '';
$calloutBtnURL = '';
$calloutBtnTxtTwo = '';
$calloutBtnIconTwo = '';
$calloutBtnURLTwo = '';
if(isset($redux_demo)){
	$calloutbg = $redux_demo['callout-bg']['url'];
	$calloutbgV2 = $redux_demo['callout-bg-version2']['url'];
	$calloutTitle = $redux_demo['callout_title'];
	$calloutTitlesecond = $redux_demo['callout_title_second'];
	$calloutDesc = $redux_demo['callout_desc'];
	$calloutBtnTxt = $redux_demo['callout_btn_text'];
	$calloutBtnIcon = $redux_demo['callout_btn_icon_code'];
	$calloutBtnURL = $redux_demo['callout_btn_url'];
	$calloutBtnTxtTwo = $redux_demo['callout_btn_text_two'];
	$calloutBtnIconTwo = $redux_demo['callout_btn_icon_code_two'];
	$calloutBtnURLTwo = $redux_demo['callout_btn_url_two'];
}
$featuredAdsPage = classiera_get_template_url('template-pricing-plans.php');
?>	
<section class="members" style="background-image:url(<?php echo esc_url($calloutbg); ?>)">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="members-text">
                    <h2> <?php if(function_exists('classiera_escape')) { classiera_escape($calloutTitle); } ?> </h2>
                    <h3>
					<?php if(function_exists('classiera_escape')) { classiera_escape($calloutTitlesecond); } ?>
					</h3>
                    <p><?php if(function_exists('classiera_escape')) { classiera_escape($calloutDesc); } ?>
					</p>
                    <a href="<?php echo esc_url($calloutBtnURL); ?>" class="btn sharp btn-primary btn-style-one btn-sm">
						<?php if(is_rtl()){?>
							<?php echo esc_html($calloutBtnTxt); ?>
							<i class="icon-left <?php if(function_exists('classiera_escape')) { classiera_escape($calloutBtnIcon); } ?>"></i>
						<?php }else{ ?>
							<i class="icon-left <?php if(function_exists('classiera_escape')) { classiera_escape($calloutBtnIcon); }?>"></i>
							<?php echo esc_html($calloutBtnTxt); ?>
						<?php } ?>
					</a>
                    <a href="<?php echo esc_url($calloutBtnURLTwo); ?>" class="btn sharp btn-primary btn-style-one btn-sm">
						<?php if(is_rtl()){?>
							<?php echo esc_html($calloutBtnTxtTwo); ?>
							<i class="icon-left <?php if(function_exists('classiera_escape')) { classiera_escape($calloutBtnIconTwo);} ?>"></i>
						<?php }else{ ?>
							<i class="icon-left <?php if(function_exists('classiera_escape')) { classiera_escape($calloutBtnIconTwo); } ?>"></i>
							<?php echo esc_html($calloutBtnTxtTwo); ?>
						<?php } ?>
					</a>
                </div>
            </div>
            <div class="col-lg-6 col-sm-6 hidden-xs hidden-sm">
                <div class="people-img pull-right flip">
                    <img class="img-responsive" src="<?php echo esc_url($calloutbgV2); ?>">
                </div>
            </div>
        </div>
    </div>
</section><!-- /.Memebers -->