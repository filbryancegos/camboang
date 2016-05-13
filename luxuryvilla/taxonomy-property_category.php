<?php
/**
 * Template for displaying property archives
 *
 * @package WordPress
 * @subpackage luxuryvilla
 */
get_header(); ?>

<?php
global $property_archive_columns_class;

$page_layout = 'no_sidebar';
$page_container = 'fullscreen';

$property_archive_layout = get_theme_mod('property_archive_layout','masonry');
$property_archive_layout_style = get_theme_mod('property_archive_style','nogap');
$property_archive_columns = get_theme_mod('property_archive_columns','2');

$page_content_class = 'col-xs-12 col-md-9';
$page_sidebar_class = 'col-xs-12 col-md-3';

switch ($property_archive_columns) {
    case "4":
       $property_archive_columns_class = 'col-xs-12 col-sm-6 col-md-3';
    break;
    case "3":
       $property_archive_columns_class = 'col-xs-12 col-sm-6 col-md-4';
    break;
    case "2":
       $property_archive_columns_class = 'col-xs-12 col-sm-6 col-md-6';
    break;
    case "1":
       $property_archive_columns_class = 'col-xs-12 col-sm-6 col-md-12';
    break;
}

switch ($page_container) {
    case "1170":
        $page_container_class = 'container';
        break;
    case "fullscreen":
        $page_container_class = 'container-fluid gg-master-container';
        break;
}

switch ($page_layout) {
    case "with_right_sidebar":
        $page_content_class = 'col-xs-12 col-md-9 pull-left';
        $page_sidebar_class = 'col-xs-12 col-md-3 pull-right';
        break;
    case "with_left_sidebar":
        $page_content_class = 'col-xs-12 col-md-9 pull-right';
        $page_sidebar_class = 'col-xs-12 col-md-3 pull-left';
        break;
    case "no_sidebar":
        $page_content_class = 'col-xs-12 col-md-12';
        break;        
}

?>

<?php gg_page_header(); ?>

<?php if (have_posts()) :
// Queue the first post.
the_post(); ?>

<section id="subheader">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <header class="page-title">
                    <h1><?php echo gg_wrap_word(get_the_title()); ?></h1>
                </header>
            </div><!--/.col-md-12 -->
        </div><!--/.row -->
    </div>
</section>

<section id="content">
        <div class="<?php echo esc_attr($page_container_class); ?>">
            <div class="row">
                <div class="<?php echo esc_attr($page_content_class); ?>">

                    <?php
                    //Enqueue isotope
                    wp_enqueue_style('isotope');
                    wp_enqueue_script( 'isotope' );

                    //Load magnific 
                    wp_enqueue_script('magnific');
                    wp_enqueue_style('magnific');

                    ?>

                    <div class="gg_posts_grid">

                        <ul class="el-grid <?php if($property_archive_layout_style == 'nogap') echo 'nogap-cols'; ?>" data-layout-mode="<?php echo esc_attr( $property_archive_layout ); ?>" data-gap="<?php echo esc_attr( $property_archive_layout_style ); ?>">
                        	<?php
	                        // Rewind the loop back
	                            rewind_posts();
	                        ?>
                            <?php while ( have_posts() ) : the_post(); ?>

                                <li class="<?php echo esc_attr( $property_archive_columns_class ); ?> isotope-item" >
                                    <?php get_template_part( 'parts/part','property-area' ); ?>
                                </li><!-- // property item column -->

                            <?php endwhile; ?>
                        </ul>

                        <?php if (function_exists("gg_pagination")) {
                            gg_pagination($wp_query->max_num_pages);
                        } ?>

                    </div><!-- /.gg_posts_grid -->
                    
                    <?php else : ?>

                    <div class="no-posts-created"> 
                        <h3><?php _e( 'Not Found', 'okthemes' ); ?></h3>  
                        <p><?php _e( 'Sorry, No property posts created yet.', 'okthemes' ); ?></p>  
                    </div>
                    
                	<?php endif; // end have_posts() check ?>
                </div>

            <?php if ($page_layout !== 'no_sidebar') { ?>
            <div class="<?php echo esc_attr( $page_sidebar_class ); ?>">
                <aside class="sidebar-nav">
                    <?php get_sidebar(); ?>
                </aside>
                <!--/aside .sidebar-nav -->
            </div><!-- /.col-3 col-sm-3 col-lg-3 -->
            <?php } ?>

        </div>
    </div>    
</section>

<?php 
// Restore original Post Data    
wp_reset_postdata();
?>
<?php get_footer(); ?>