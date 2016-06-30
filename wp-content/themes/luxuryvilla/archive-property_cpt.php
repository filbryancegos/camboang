<?php
/**
 * Template for archive posts
 *
 * @package WordPress
 * @subpackage luxuryvilla
 */
get_header(); ?>

<?php $purl = get_post_type_archive_link('property'); ?>

<?php
$adv_page = get_pages(array(
    'meta_key' => '_wp_page_template',
    'meta_value' => 'theme-templates/advanced-search.php'
));

if ($adv_page[0]->ID) {
    $page_layout = get_field('gg_page_layout_select',$adv_page[0]->ID);
    $page_container = get_field('gg_page_container_select',$adv_page[0]->ID);

    $adv_search_layout = get_field('gg_adv_search_layout',$adv_page[0]->ID);
    $adv_search_layout_style = get_field('gg_adv_search_layout_style',$adv_page[0]->ID);
    $adv_search_columns = get_field('gg_adv_search_columns',$adv_page[0]->ID);

} else {
    $page_layout = 'no_sidebar';
    $page_container = '1170';

    $adv_search_layout = 'masonry';
    $adv_search_layout_style = 'gap';
    $adv_search_columns = '2';
}

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
//Enqueue lazyload
wp_enqueue_script( 'lazyload' );

//Enqueue isotope
wp_enqueue_style('isotope-css');
wp_enqueue_script( 'isotope' );

//Enqueue magnific
wp_enqueue_script( 'magnific' );
wp_enqueue_style( 'magnific' );

?>

<section id="subheader">

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">

                <header class="page-title">
                    <?php if ($adv_page[0]->ID) : ?>
                        <h1><?php echo gg_wrap_word(get_the_title($adv_page[0]->ID)); ?></h1>
                    <?php else: ?>
                        <h1><span class="gg-first-word"><?php _e('Advanced','okthemes'); ?></span><?php _e(' Search','okthemes'); ?></h1>
                    <?php endif; ?>
                </header>

            </div><!--/.col-md-12 -->
        </div><!--/.row -->
    </div>
</section>

<?php get_template_part( 'parts/part','advanced-search' ); ?>

<section id="content">
    <div class="<?php echo esc_attr($page_container_class); ?>">
        <div class="row">
            <div class="<?php echo esc_attr($page_content_class); ?>">

                <div class="gg_posts_grid">

                        <?php
                        if ( get_query_var('paged') ) {
                            $paged = get_query_var('paged');
                        } else if ( get_query_var('page') ) {
                            $paged = get_query_var('page');
                        } else {
                            $paged = 1;
                        }

                        $args = array(
                            'post_type' => 'property_cpt',
                            'paged' => $paged
                        );

                        if(isset($_GET['sleeps'])) {
                        if($_GET['sleeps'] >= 1) {
                            $args['meta_query'][] = array(
                                'key' => 'gg_sleeps',
                                'value' => $_GET['sleeps'],
                                'compare' => '>=',
                                'type' => 'numeric'
                            );
                        }
                        }
                        if(isset($_GET['bedrooms'])) {
                        if($_GET['bedrooms'] >= 1) {
                            $args['meta_query'][] = array(
                                'key' => 'gg_bedrooms',
                                'value' => $_GET['bedrooms'],
                                'compare' => '>=',
                                'type' => 'numeric'
                            );
                        }
                        }
                        if(isset($_GET['bathrooms'])) {
                        if($_GET['bathrooms'] >= 1) {
                            $args['meta_query'][] = array(
                                'key' => 'gg_bathrooms',
                                'value' => $_GET['bathrooms'],
                                'compare' => '>=',
                                'type' => 'numeric'
                            );
                        }
                        }
                        if(isset($_GET['city'])) {
                        if($_GET['city'] && $_GET['city'] != '*') {
                            $args['meta_query'][] = array(
                                'key' => 'gg_property_meta_location_city',
                                'value' => $_GET['city'],
                            );
                        }
                        }
                        if(isset($_GET['country'])) {
                        if($_GET['country'] && $_GET['country'] != '*') {
                            $args['meta_query'][] = array(
                                'key' => 'gg_property_meta_location_country',
                                'value' => $_GET['country'],
                            );
                        }
                        }

                        if(isset($_GET['property_type'])) {
                        if($_GET['property_type'] && $_GET['property_type'] != '*') {
                            $args['tax_query'][] = array(
                                'taxonomy' => 'property_category',
                                'field' => 'slug',
                                'terms' => $_GET['property_type']
                            );
                        }
                        }

                        query_posts($args);

                        if(have_posts()):
                        ?>

                        <ul class="el-grid <?php if($adv_search_layout_style == 'nogap') echo 'nogap-cols'; ?>" data-layout-mode="<?php echo esc_attr( $adv_search_layout ); ?>" data-gap="<?php echo esc_attr( $adv_search_layout_style ); ?>">

                        <?php while ( have_posts() ) : the_post(); ?>
                            <li class="<?php echo esc_attr( $adv_search_columns_class ); ?> isotope-item" >
                                <?php get_template_part( 'parts/part','property-area-search' ); ?>
                            </li><!-- // property item column -->
                        <?php endwhile; ?>
                        </ul>

                        <?php if (function_exists("gg_pagination")) {
                            gg_pagination($wp_query->max_num_pages);
                        } ?>

                    <?php else : ?>

                        <?php get_template_part( 'parts/part', 'none' ); ?>

                    <?php endif; // end have_posts() check ?>
                    </div><!--/ .gg_posts_grid-->
                </div>

                <?php if (($page_layout !== 'no_sidebar')) { ?>
                <div class="<?php echo esc_attr($page_sidebar_class); ?>">
                    <aside class="sidebar-nav">
                        <?php get_sidebar(); ?>
                    </aside>
                    <!--/aside .sidebar-nav -->
                </div><!-- /.col-4 col-sm-4 col-lg-4 -->
                <?php } ?>

            </div><!-- /.row -->
        </div><!-- /.row .container -->
    </section>
<?php get_footer(); ?>
