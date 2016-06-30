<?php
/**
 * The dynamically generated footer sidebar
 */
?>

<?php
// count the active widgets to determine column sizes
$footerwidgets = is_active_sidebar('sidebar-footer-first') + is_active_sidebar('sidebar-footer-second');
// default
$footergrid_first = "col-md-12";
$footergrid_second = "col-md-12";
// if only one
if ($footerwidgets == "1") {
$footergrid_first = "col-md-12";
$footergrid_second = "col-md-12";
// if two, split in half
} elseif ($footerwidgets == "2") {
$footergrid_first = "col-md-3";
$footergrid_second = "col-md-9";
}

?>

<?php if ($footerwidgets) : ?>

<div class="footer-widgets-holder">
	<div class="row">

		<?php if (is_active_sidebar('sidebar-footer-first')) : ?>
		<div class="<?php echo esc_attr($footergrid_first);?>">
			<?php dynamic_sidebar('sidebar-footer-first'); ?>
		</div>
		<?php endif;?>

		<?php if (is_active_sidebar('sidebar-footer-second')) : ?>
		<div class="<?php echo esc_attr($footergrid_second); ?>">
			  <?php  dynamic_sidebar('sidebar-footer-second'); ?>
		</div>
		<!-- <div class="">
			<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d125585.12087263295!2d123.77625470383597!3d10.37901307153652!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33a999258dcd2dfd%3A0x4c34030cdbd33507!2sCebu+City%2C+6000+Cebu!5e0!3m2!1sen!2sph!4v1458719850141" width="1404" height="500" frameborder="0" style="border:0" allowfullscreen></iframe>
		</div> -->
		<div class="clearfix visible-sm"></div>
		<?php endif;?>

	</div>
</div>

<?php endif;?>
