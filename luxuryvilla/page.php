<?php
/**
 * Default Page
 *
 * @package WordPress
 * @subpackage luxuryvilla
 */
get_header(); ?>

<?php
$page_layout = get_field('gg_page_layout_select');
$page_container = get_field('gg_page_container_select');

$page_content_class = 'col-xs-12 col-md-9';
$page_sidebar_class = 'col-xs-12 col-md-3';
$page_container_class = 'container-fluid gg-master-container';

switch ($page_container) {
    case "1170":
        $page_container_class = 'container';
        break;
    case "fullscreen":
        $page_container_class = 'container-fluid gg-master-container';
        break;
    case NULL:
        $page_container_class = 'container';
        break;
}

switch ($page_layout) {
    case "with_right_sidebar":
        $page_content_class = 'col-xs-12 col-md-12 pull-left';
        $page_sidebar_class = 'col-xs-12 col-md-3 pull-right';
        break;
    case "with_left_sidebar":
        $page_content_class = 'col-xs-12 col-md-12 pull-right';
        $page_sidebar_class = 'col-xs-12 col-md-3 pull-left';
        break;
    case "no_sidebar":
        $page_content_class = 'col-xs-12 col-md-12';
        break;
    case NULL:
        $page_content_class = 'col-xs-12 col-md-12 pull-left';
        $page_sidebar_class = 'col-xs-12 col-md-3 pull-right';
        break;
}
?>

<?php gg_page_header(); ?>

<?php if ( have_posts() ) : while( have_posts() ) : the_post(); ?>

    <section id="content">
        <div class="<?php echo esc_attr($page_container_class); ?>">
            <div class="row">
                <div class="<?php echo esc_attr($page_content_class); ?>">
                  <div class="container">
                    <?php get_template_part( 'parts/part', 'page' ); ?>
                    <?php comments_template( '', true ); ?>
                  </div>
                </div><!-- /.col-9 col-sm-9 col-lg-9 -->

                <?php /* if ($page_layout !== 'no_sidebar') { ?>
                <div class="<?php echo esc_attr($page_sidebar_class); ?>">
                    <aside class="sidebar-nav">
                        <?php get_sidebar(); ?>
                    </aside>
                    <!--/aside .sidebar-nav -->
                </div><!-- /.col-3 col-sm-3 col-lg-3 -->
                <?php } */?>
            </div>
        </div>
    </section>

<?php endwhile; endif; ?>

<?php get_footer(); ?>
