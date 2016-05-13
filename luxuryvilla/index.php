<?php
/**
 * Description: Default Index template to display loop of blog posts
 *
 * @package WordPress
 * @subpackage luxuryvilla
 */
get_header(); ?>

<?php
$page_layout = 'with_right_sidebar';
$page_container = '1170';

$blog_layout = 'masonry';
$blog_layout_style = 'gap';
$blog_columns = '2';

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

<?php gg_page_header(); ?>

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

        </div>
    </div>    
</section>
<?php get_footer(); ?>