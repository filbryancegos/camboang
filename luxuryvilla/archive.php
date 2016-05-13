<?php
/**
 * Template for archive posts
 *
 * @package WordPress
 * @subpackage luxuryvilla
 */
get_header(); ?>

<?php

global $blog_img_width, $blog_img_height;

$page_layout = 'with_right_sidebar';
$page_container = 'fullscreen';

$archive_layout = get_theme_mod('archive_page_layout','masonry');
$archive_layout_style = get_theme_mod('archive_page_style','nogap');
$archive_columns = get_theme_mod('archive_page_columns','2');

$page_content_class = 'col-xs-12 col-md-9';
$page_sidebar_class = 'col-xs-12 col-md-3';

switch ($archive_columns) {
    case "4":
       $archive_columns_class = 'col-xs-12 col-sm-6 col-md-3';
    break;
    case "3":
       $archive_columns_class = 'col-xs-12 col-sm-6 col-md-4';
    break;
    case "2":
       $archive_columns_class = 'col-xs-12 col-sm-6 col-md-6';
    break;
    case "1":
       $archive_columns_class = 'col-xs-12 col-sm-6 col-md-12';
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

<?php if (have_posts()) :
// Queue the first post.
the_post(); ?>

<section id="subheader">

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">

                <header class="page-title">
                    <h1>
                        <?php
                        if (is_day()) {
                            printf(__('Daily Archives: %s', 'okthemes'), '<span>' . get_the_date() . '</span>');
                        } elseif (is_month()) {
                            printf(
                                __('Monthly Archives: %s', 'okthemes'),
                                '<span>' . get_the_date(_x('F Y', 'monthly archives date format', 'okthemes')) . '</span>'
                            );
                        } elseif (is_year()) {
                            printf(
                                __('Yearly Archives: %s', 'okthemes'),
                                '<span>' . get_the_date(_x('Y', 'yearly archives date format', 'okthemes')) . '</span>'
                            );
                        } elseif (is_tag()) {
                            printf(__('Tag Archives: %s', 'okthemes'), '<span>' . single_tag_title('', false) . '</span>');
                            // Show an optional tag description
                            $tag_description = tag_description();
                            if ($tag_description) {
                                echo apply_filters(
                                    'tag_archive_meta',
                                    '<div class="tag-archive-meta">' . $tag_description . '</div>'
                                );
                            }
                        } elseif (is_category()) {
                            printf(
                                __('Category Archives: %s', 'okthemes'),
                                '<span>' . single_cat_title('', false) . '</span>'
                            );
                            // Show an optional category description
                            $category_description = category_description();
                            if ($category_description) {
                                echo apply_filters(
                                    'category_archive_meta',
                                    '<div class="category-archive-meta">' . $category_description . '</div>'
                                );
                            }
                        } else {
                            _e('Blog Archives', 'okthemes');
                        }
                        ?>
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

                        <ul class="el-grid <?php if($archive_layout_style == 'nogap') echo 'nogap-cols'; ?>" data-layout-mode="<?php echo esc_attr($archive_layout); ?>" data-gap="<?php echo esc_attr($archive_layout_style); ?>">
                        <?php
                        // Rewind the loop back
                            rewind_posts();
                        ?>
                        <?php while ( have_posts() ) : the_post(); ?>
                            <li class="isotope-item <?php echo esc_attr($archive_columns_class); ?>"><?php get_template_part( 'parts/part', get_post_format() ); ?></li>
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
