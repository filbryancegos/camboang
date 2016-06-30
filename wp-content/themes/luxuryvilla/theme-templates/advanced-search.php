<?php
/**
 * Template Name: Advanced Search Page
 *
 * @package WordPress
 * @subpackage luxuryvilla
 */
get_header(); ?>

<?php

$page_layout = get_field('gg_page_layout_select');
$page_container = get_field('gg_page_container_select');

$adv_search_layout = get_field('gg_adv_search_layout');
$adv_search_layout_style = get_field('gg_adv_search_layout_style');
$adv_search_columns = get_field('gg_adv_search_columns');

$page_content_class = 'col-xs-12 col-md-9';
$page_sidebar_class = 'col-xs-12 col-md-3';

switch ($adv_search_columns) {
    case "4":
       $adv_search_columns_class = 'col-xs-12 col-sm-6 col-md-3';
    break;
    case "3":
       $adv_search_columns_class = 'col-xs-12 col-sm-6 col-md-4';
    break;
    case "2":
       $adv_search_columns_class = 'col-xs-12 col-sm-6 col-md-6';
    break;
    case "1":
       $adv_search_columns_class = 'col-xs-12 col-sm-6 col-md-12';
    break;
    case NULL:
       $$adv_search_columns_class = 'col-xs-12 col-sm-6 col-md-6';
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
<?php get_template_part( 'parts/part','advanced-search' ); ?>

<section id="content">
        <div class="<?php echo esc_attr($page_container_class); ?>">
            <div class="row">
                <div class="<?php echo esc_attr($page_content_class); ?>">

                    <?php
                    //Enqueue lazyload
                    wp_enqueue_script( 'lazyload' );
                    //Enqueue isotope
                    wp_enqueue_style('isotope');
                    wp_enqueue_script( 'isotope' );

                    //Load magnific 
                    wp_enqueue_script('magnific');
                    wp_enqueue_style('magnific');

                    // WP_Query arguments
                    $args = array (
                        'post_type'              => 'property_cpt',
                        'taxonomy'               => 'property_category',
                        'posts_per_page'         => -1, 
                        'ignore_sticky_posts'    => true
                    );

                    // The Query
                    $advanced_search_query = new WP_Query( $args );

                    // The Loop
                    if ( $advanced_search_query->have_posts() ) { ?>

                    <div class="gg_posts_grid">

                        <ul class="el-grid <?php if($adv_search_layout_style == 'nogap') echo 'nogap-cols'; ?>" data-layout-mode="<?php echo esc_attr( $adv_search_layout ); ?>" data-gap="<?php echo esc_attr( $adv_search_layout_style ); ?>">

                            <?php while ( $advanced_search_query->have_posts() ) : $advanced_search_query->the_post(); ?>

                                <li class="<?php echo esc_attr( $adv_search_columns_class ); ?> isotope-item" >
                                    <?php get_template_part( 'parts/part','property-area-search' ); ?>
                                </li><!-- // property item column -->

                            <?php endwhile; ?>
                        </ul>

                    </div><!-- /.gg_posts_grid -->
                    
                    <?php } else { ?>

                    <div class="no-posts-created"> 
                        <h3><?php _e( 'Not Found', 'okthemes' ); ?></h3>  
                        <p><?php _e( 'Sorry, No property posts created yet.', 'okthemes' ); ?></p>  
                    </div>
                    
                    <?php } ?>

                    <?php 
                    // Restore original Post Data    
                    //wp_reset_postdata();
                    ?> 
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