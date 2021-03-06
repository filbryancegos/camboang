<?php
/**
 * Description: Default Home template to display loop of blog posts
 *
 * @package WordPress
 * @subpackage luxuryvilla
 */
get_header(); ?>

<?php

//Check if front page is set as "Latest posts"
if ('posts' == get_option( 'show_on_front' )) {
    $page_layout = 'with_right_sidebar';
    $page_container = 'fullscreen';

    $blog_layout = 'masonry';
    $blog_layout_style = 'gap';
    $blog_columns = '2';
} else {
    //Get the ID of the page used for Blog posts
    $page_id = ( 'page' == get_option( 'show_on_front' ) ? get_option( 'page_for_posts' ) : get_the_ID() );

    $page_layout = get_field('gg_page_layout_select', $page_id);
    $page_container = get_field('gg_page_container_select', $page_id);
    $blog_layout = get_field('gg_blog_layout', $page_id);
    $blog_layout_style = get_field('gg_blog_layout_style', $page_id);
    $blog_columns = get_field('gg_blog_columns', $page_id);

    if ($page_layout == NULL)
        $page_layout = 'with_right_sidebar';

    if ($page_container == NULL)
        $page_container = 'fullscreen';

    if ($blog_layout == NULL)
        $blog_layout = 'masonry';

    if ($blog_layout_style == NULL)
        $blog_layout_style = 'gap';

    if ($blog_columns == NULL)
        $blog_columns = '2';
}

$page_content_class = 'col-xs-12 col-md-9';
$page_sidebar_class = 'col-xs-12 col-md-3';

switch ($blog_columns) {
    case "4":
       $blog_columns_class = 'col-xs-12 col-sm-6 col-md-3';
    break;
    case "3":
       $blog_columns_class = 'col-xs-12 col-sm-6 col-md-4';
    break;
    case "2":
       $blog_columns_class = 'col-xs-12 col-sm-6 col-md-6';
    break;
    case "1":
       $blog_columns_class = 'col-xs-12 col-sm-6 col-md-12';
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

<?php gg_page_header();  ?>

<section id="content">
    <div class="<?php echo esc_attr($page_container_class); ?>">
        <div class="row">
            <div class="<?php echo esc_attr($page_content_class); ?>">

                <div class="gg_posts_grid">
                <?php if ( have_posts() ) : ?>
                    <ul class="el-grid <?php if($blog_layout_style == 'nogap') echo 'nogap-cols'; ?>" data-layout-mode="<?php echo esc_attr($blog_layout); ?>" data-gap="<?php echo esc_attr($blog_layout_style); ?>">
                    <?php while ( have_posts() ) : the_post(); ?>
                        <li class="isotope-item <?php echo esc_attr($blog_columns_class); ?>"><?php get_template_part( 'parts/part', get_post_format() ); ?></li>
                    <?php endwhile; ?>
                    </ul>

                    <?php if (function_exists("gg_pagination")) {
                        gg_pagination($wp_query->max_num_pages);
                    } ?>

                <?php else : ?>

                    <?php  get_template_part( 'parts/part', 'none' ); ?>

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

        </div>
    </div>
</section>
<?php get_footer(); ?>
