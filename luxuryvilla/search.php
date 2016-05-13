<?php
/**
 * Search Results Template
 *
 * @package WordPress
 * @subpackage luxuryvilla
 */
get_header(); ?>

<?php

global $blog_img_width, $blog_img_height;

$page_layout = 'with_right_sidebar';
$page_container = 'fullscreen';

$search_layout = get_theme_mod('search_page_layout','masonry');
$search_layout_style = get_theme_mod('search_page_style','gap');
$search_columns = get_theme_mod('search_page_columns','2');

$page_content_class = 'col-xs-12 col-md-9';
$page_sidebar_class = 'col-xs-12 col-md-3';

switch ($search_columns) {
    case "4":
       $search_columns_class = 'col-xs-12 col-sm-6 col-md-3';
    break;
    case "3":
       $search_columns_class = 'col-xs-12 col-sm-6 col-md-4';
    break;
    case "2":
       $search_columns_class = 'col-xs-12 col-sm-6 col-md-6';
    break;
    case "1":
       $search_columns_class = 'col-xs-12 col-sm-6 col-md-12';
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
                    <h1>
                        <?php if (have_posts()) : ?>
                            <?php printf( __('Search Results for: %s', 'okthemes'),'<span>' . get_search_query() . '</span>'); ?>
                        <?php else: ?>
                            <?php _e( 'Nothing Found', 'okthemes' ); ?>
                        <?php endif; ?>
                    </h1>
                </header>
            </div><!--/.col-md-12 -->
        </div><!--/.row -->
    </div>
</section>

<section id="content">
    <div class="<?php echo esc_attr($page_container_class); ?>">
        <div class="row">
            
            <div class="<?php echo esc_attr($page_content_class); ?>">
            
            <div class="gg_posts_grid">    
        		<ul class="el-grid <?php if($search_layout_style == 'nogap') echo 'nogap-cols'; ?>" data-layout-mode="<?php echo esc_attr($search_layout); ?>" data-gap="<?php echo esc_attr($search_layout_style); ?>">
                <?php while ( have_posts() ) : the_post(); ?>
                    <li class="isotope-item <?php echo esc_attr($search_columns_class); ?>"><?php get_template_part( 'parts/part', get_post_format() ); ?></li>
                <?php endwhile; ?>
                </ul>
            </div>

            <?php if (!have_posts()) : ?>

            <article id="post-0" class="post no-results not-found">
                <div class="article-wrapper">
                    <div class="entry-content">
                        <p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'okthemes' ); ?></p>
                        <?php get_search_form(); ?>
                    </div><!-- .entry-content -->
                </div>
            </article><!-- #post-0 -->

            <?php endif; ?>

            <?php if (function_exists("gg_pagination")) {
                gg_pagination($wp_query->max_num_pages);
            } ?>

            </div>

            <?php if (($page_layout !== 'no_sidebar')) { ?>
            <div class="<?php echo esc_attr($page_sidebar_class); ?>">
                <aside class="sidebar-nav">
                    <?php get_sidebar(); ?>
                </aside>
                <!--/aside .sidebar-nav -->
            </div><!-- /.col-4 col-sm-4 col-lg-4 -->
            <?php } ?>

    </div><!-- /.row .content -->
</div><!--/.container -->    
</section>

<?php get_footer(); ?>