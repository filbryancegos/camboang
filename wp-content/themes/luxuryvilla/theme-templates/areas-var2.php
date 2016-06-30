<?php
/**
 * Template Name: Areas Page - Gallery
 *
 * @package WordPress
 * @subpackage luxuryvilla
 */
get_header(); ?>

<?php

global $gallery_columns_class;

$page_layout = get_field('gg_page_layout_select');
$page_container = get_field('gg_page_container_select');

$gallery_layout = get_field('gg_areas_gallery_layout');
$gallery_layout_style = get_field('gg_areas_gallery_layout_style');
$gallery_columns = get_field('gg_areas_gallery_columns');

$page_content_class = 'col-xs-12 col-md-9';
$page_sidebar_class = 'col-xs-12 col-md-3';

switch ($gallery_columns) {
    case "4":
       $gallery_columns_class = 'col-xs-12 col-sm-6 col-md-3';
    break;
    case "3":
       $gallery_columns_class = 'col-xs-12 col-sm-6 col-md-4';
    break;
    case "2":
       $gallery_columns_class = 'col-xs-12 col-sm-6 col-md-6';
    break;
    case "1":
       $gallery_columns_class = 'col-xs-12 col-sm-6 col-md-12';
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

<section id="content">
        <div class="<?php echo esc_attr($page_container_class); ?>">
            <div class="row">
                <div class="<?php echo esc_attr($page_content_class); ?>">

                    <?php
                    //Enqueue lazyload
                    if ( 1 == get_theme_mod( 'lazyload') ) :
                    wp_enqueue_script( 'lazyload' );
                    endif;
                    
                    //Enqueue isotope
                    wp_enqueue_style('isotope');
                    wp_enqueue_script( 'isotope' );

                    //Load magnific 
                    wp_enqueue_script('magnific');
                    wp_enqueue_style('magnific');

                    $paged = get_query_var('paged') ? get_query_var('paged') : 1;

                    $exclude_field = get_field('gg_exclude_properties');

                    if ($exclude_field) {
                        $exclude_ids = array_values($exclude_field);
                    } else {
                        $exclude_ids = '';
                    }

                    // WP_Query arguments
                    $args = array (
                        'post_type'              => 'property_cpt',
                        'taxonomy'               => 'property_category',
                        'posts_per_page'         => -1, 
                        'ignore_sticky_posts'    => true,
                        'post__not_in'           => $exclude_ids
                    );

                    // The Query
                    $property_areas_query = new WP_Query( $args );

                    // The Loop
                    if ( $property_areas_query->have_posts() ) { ?>

                    <div class="gg_posts_grid">

                        <div class="filter-wrapper">
                            <ul class="categories_filter clearfix nav nav-pills">
                                <li class="active"><a href="#" data-filter="*"><?php echo __("All", "okthemes"); ?></a></li>

                                <?php
                                $terms = get_terms('property_category');
                                foreach ( $terms as $term ) {
                                    echo '<li><a data-filter=".grid-cat-'.$term->slug.'">' . $term->name . ' </a></li>';
                                }
                                ?>
                            </ul>
                        </div>

                        <ul class="el-grid <?php if($gallery_layout_style == 'nogap') echo 'nogap-cols'; ?>" data-layout-mode="<?php echo esc_attr( $gallery_layout ); ?>" data-gap="<?php echo esc_attr( $gallery_layout_style ); ?>">

                            <?php while ( $property_areas_query->have_posts() ) : $property_areas_query->the_post(); ?>

                                <li class="<?php echo esc_attr( $gallery_columns_class ); ?> isotope-item <?php echo gg_tax_terms_slug('property_category');?>" >
                                    <?php get_template_part( 'parts/part','property-area' ); ?>
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