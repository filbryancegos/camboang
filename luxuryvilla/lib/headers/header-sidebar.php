<header class="site-header sidebar col-md-2" role="banner">

<nav role="navigation">
    <div class="navbar navbar-default navbar-static-top">
        <div class="container-fluid">

            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#main-navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>

                <!-- Begin logo -->
                <?php include PARENT_DIR . '/lib/headers/logo.php';?>    
                <!-- End logo -->
            </div>

            <div class="navbar-collapse collapse" id="main-navbar-collapse">
            
                <!-- Begin Main Navigation -->
                <?php
                global $is_nav_mobile; 
                wp_nav_menu(
                    array(
                        'theme_location'    => 'main-menu',
                        'menu_class'        => 'nav '.$is_nav_mobile.' navbar-nav col-md-4',
                        'fallback_cb'       => 'gg_bootstrap_navwalker::fallback',
                        'menu_id'           => 'main-menu',
                        'container'         => false,
                        'walker'            => new gg_bootstrap_navwalker()
                    )
                ); ?>
                <!-- End Main Navigation -->

                <!-- Property select -->
                <?php echo gg_property_select_form(); ?>

                <!-- WPML -->
                <?php if ( 1 == get_theme_mod( 'header_wpml_box') ) : ?>
                <div class="gg-wpml-header pull-left">
                <?php do_action('icl_language_selector'); ?> 
                </div>
                <?php endif; ?>

            </div>

        </div>
    </div>
</nav>

<div class="slideshow-sidebar slideshow-vertical slideshow-sidebar-fixed">
    <?php get_sidebar('vertical'); ?>
</div>

</header>
<!-- End Header. Begin Template Content -->
