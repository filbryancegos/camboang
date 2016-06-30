<?php
/**
 * Default Post Template
 *
 * @package WordPress
 * @subpackage luxuryvilla
 */
get_header(); ?>

<?php
global $blog_img_width, $blog_img_height;

$page_layout = get_field('gg_page_layout_select');
$page_container = get_field('gg_page_container_select');
$blog_share_box = get_field('gg_post_social_share');

$page_content_class = 'col-xs-12 col-md-9';
$page_sidebar_class = 'col-xs-12 col-md-3';


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
    case NULL:
        $page_content_class = 'col-xs-12 col-md-9 pull-left';
        $page_sidebar_class = 'col-xs-12 col-md-3 pull-right';
        break;          
}

?>

<?php while (have_posts()) : the_post(); ?>

<?php gg_page_header(); ?>

<section id="content">
    <div class="<?php echo esc_attr($page_container_class); ?>">
        <div class="row">
            <div class="<?php echo esc_attr($page_content_class); ?>">

                <?php get_template_part( 'parts/part', get_post_format() ); ?>
                
                <?php endwhile; // end of the loop. ?>
                
                <?php if ( $blog_share_box || $blog_share_box == NULL ) { 
                    get_template_part( 'parts/part', 'socialshare' );
                } ?>

                <?php comments_template( '', true ); ?>

            </div><!-- /.col-9 col-sm-9 col-lg-9 -->

            <?php if (($page_layout !== 'no_sidebar')) { ?>
            <div class="<?php echo esc_attr($page_sidebar_class); ?>">
                <aside class="sidebar-nav">
                    <?php get_sidebar(); ?>
                </aside>
                <!--/aside .sidebar-nav -->
            </div><!-- /.col-4 col-sm-4 col-lg-4 -->
            <?php } ?>

        </div><!-- /.row -->
    </div><!--/.container -->    
</section>

<?php get_footer(); ?>