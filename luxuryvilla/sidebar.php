<?php
/**
 * Sidebar logic
 *
 * @package WordPress
 * @subpackage luxuryvilla
 */
?>

<?php 
if (function_exists('dynamic_sidebar')) {
	
	if( is_page_template('theme-templates/areas-var2.php') ) {
		
		$dynamic_sidebar = 'sidebar-areas-page-gallery';

	} elseif( is_page_template('theme-templates/gallery.php') ) {
		
		$dynamic_sidebar = 'sidebar-gallery-page';

	} elseif( is_search() ) {
		
		$dynamic_sidebar = 'sidebar-search';			

	} elseif( is_single() || is_home() || is_category() || is_archive() ) {
		
		$dynamic_sidebar = 'sidebar-posts';

	} else { //else default sidebar
		
		$dynamic_sidebar = 'sidebar-page';

	}
}
?>

<?php if ( is_active_sidebar( $dynamic_sidebar ) ) : ?>
    <?php dynamic_sidebar( $dynamic_sidebar ); ?>
<?php else: ?>
	<div class="widget">
		<h4 class="widget-title"><span class="gg-first-word">Configure</span> Widgets</h4>
		<p>The widgets are not configured. <a href="<?php echo admin_url( 'widgets.php' ); ?>"><strong>Click here</strong></a> to go to your admin screen and configure them.</p>
	</div>
<?php endif; ?>