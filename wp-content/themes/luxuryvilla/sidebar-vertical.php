<?php
/**
 * Sidebar logic
 *
 * @package WordPress
 * @subpackage luxuryvilla
 */
?>

<?php if ( is_active_sidebar( 'sidebar-homepage' ) ) : ?>
    <?php dynamic_sidebar( 'sidebar-homepage' ); ?>
<?php else: ?>
	<div class="widget">
		<h4 class="widget-title"><span class="gg-first-word">Configure</span> Widgets</h4>
		<p>The widgets are not configured. <a href="<?php echo admin_url( 'widgets.php' ); ?>"><strong>Click here</strong></a> to go to your admin screen and configure them.</p>
	</div>
<?php endif; ?>