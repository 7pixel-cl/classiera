<?php
global $redux_demo;
if(isset($redux_demo['classiera_exclude_user'])){
	$excludeCatsUsers = $redux_demo['classiera_exclude_user'];
}else{
	$excludeCatsUsers = array();
}
if(isset($redux_demo['classiera_exclude_categories'])){
	$excludeCats = $redux_demo['classiera_exclude_categories'];
}else{
	$excludeCats = array();
}
$current_user = wp_get_current_user();
?>
<!--Category-->
<div class="form-main-section classiera-post-cat">
	<div class="classiera-post-main-cat">
		<h4 class="classiera-post-inner-heading">
			<?php esc_html_e('Ad Category', 'classiera') ?> :
		</h4>
		<!--parent category-->
		<?php 
		if(is_array($excludeCatsUsers) && array_intersect($excludeCatsUsers, $current_user->roles )){
			$argscat = array(
				'hide_empty' => 0,
				'parent' => 0,
				'order' => 'ASC',
				'exclude' => $excludeCats,
			);
		}else{
			$argscat = array(
				'hide_empty' => 0,
				'parent' => 0,
				'order' => 'ASC',
			);
		}									
		$categories = get_terms('category', $argscat);
		?>
		<div class="form-group">
			<label class="col-sm-3 text-left flip">
				<?php esc_html_e('Select category', 'classiera') ?>:
				<span>*</span>
			</label>
			<div class="col-sm-9">
				<div class="inner-addon right-addon input-group">
					<div class="input-group-addon">
						<i class="fas fa-sort"></i>
					</div><!--input-group-addon-->
					<i class="form-icon right-form-icon fas fa-angle-down"></i>
					<select name="classiera-main-cat-field" id="classiera-main-cat-field" class="form-control form-control-md">
					<option selected disabled>
						<?php esc_html_e('Select category', 'classiera') ?>
					</option>
					<?php foreach ($categories as $category){
					$termID = $category->term_id;
					?>
					<option value="<?php echo esc_attr($termID); ?>">
						<?php echo esc_html(get_cat_name( $termID )); ?>
					</option>
					<?php } ?>
					</select>
				</div><!--inner-addon-->
			</div><!--col-sm-6-->
		</div><!--form-group-->
		<!--Sub category-->
		<div class="form-group hidden">
			<label class="col-sm-3 text-left flip">
				<?php esc_html_e('Select a Sub Category', 'classiera') ?>:
			</label>
			<div class="col-sm-9">
				<div class="inner-addon right-addon input-group">
					<div class="input-group-addon">
						<i class="fas fa-sort"></i>
					</div><!--input-group-addon-->
					<i class="form-icon right-form-icon fas fa-angle-down"></i>
					<select name="classiera-sub-cat-field" id="classiera-sub-cat-field" class="form-control form-control-md">
					</select>
				</div><!--inner-addon-->
			</div><!--col-sm-6-->
		</div><!--form-group-->
		<!--Sub category-->								
		<!--Sub Sub category-->	
		<div class="form-group hidden">
			<label class="col-sm-3 text-left flip">
				<?php esc_html_e('Select a Sub Category', 'classiera') ?>:
			</label>
			<div class="col-sm-9">
				<div class="inner-addon right-addon input-group">
					<div class="input-group-addon">
						<i class="fas fa-sort"></i>
					</div><!--input-group-addon-->
					<i class="form-icon right-form-icon fas fa-angle-down"></i>
					<select name="classiera_third_cat" id="classiera_third_cat" class="form-control form-control-md">
					</select>
				</div><!--inner-addon-->
			</div><!--col-sm-6-->
		</div><!--form-group-->
		<!--Sub Sub category-->	
	</div><!--classiera-post-main-cat-->
</div>
<!--Category-->