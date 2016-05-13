<?php
/**
 * Template for 404 error page
 *
 * @package WordPress
 * @subpackage luxuryvilla
 */
get_header(); ?>

<section id="subheader">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <header class="page-title">
                    <h1><?php echo get_theme_mod('not_found_page_title', 'Ooops page not found ...'); ?></h1>
                </header>
            </div><!--/.col-md-12 -->
        </div><!--/.row -->
    </div>
</section>

<section id="content">
    <div class="container-fluid">
        <div class="row">

          <div class="col-xs-12 col-md-12">

            <div class="row">
                <div class="col-md-12">
                    <span class="gg-404">404</span>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div class="btn-group btn-group-justified">
                        <a href="javascript:history.go(-1)" class="btn btn-lg btn-primary"><?php _e('Go back', 'okthemes'); ?></a>
                        <a href="<?php echo get_theme_mod('not_found_contact_btn_link', '#'); ?>" class="btn btn-lg btn-default"><?php _e('Contact us', 'okthemes'); ?></a>
                    </div>    
                </div>
            </div>  

            <?php if (get_theme_mod('not_found_page_search', 1) == 1) { ?> 
                <div class="row spacer-top spacer-bottom">
                    <div class="col-xs-12 col-md-12 pull-center">
                        <p class="info-404"><?php echo get_theme_mod('not_found_page_description', 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.'); ?></p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <?php get_template_part( 'searchform' ); ?>  
                    </div>
                </div>
            <?php } ?>

          </div>

        </div><!-- /.row .content -->
    </div><!--/.container -->    
</section>

<?php get_footer();
