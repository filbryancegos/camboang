<?php
/**
 * Default Page Header
 *
 * @package WordPress
 * @subpackage luxuryvilla
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>"/>
    <?php if (get_theme_mod('favicon_logo')) { ?>
        <link rel="shortcut icon" href="<?php  echo get_theme_mod('favicon_logo'); ?>">
    <?php } ?>

    <!--[if IE]>
      <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!--[if lte IE 9 ]>
      <link href="<?php echo get_template_directory_uri() . '/styles/ie.css'; ?>" rel="stylesheet" type="text/css">
    <![endif]-->
    <?php wp_head(); ?>
    <link href="/wp-content/themes/luxuryvilla/stylesheets/app.css" rel="stylesheet">
</head>
<body <?php body_class(); ?>>

<!-- Site border -->
<div id="site-border-left"></div>
<div id="site-border-right"></div>
<div id="site-border-top"></div>
<div id="site-border-bottom"></div>

<!-- Preloader -->
<?php if( 1 == get_theme_mod( 'site_preloader', 1 ) ) : ?>
<div id="ip-container">

<div class="ip-header">
  <div class="ip-loader">
  </div>
</div>

<div id="loader" class="pageload-overlay" data-opening="M 0,0 80,-10 80,60 0,70 0,0" data-closing="M 0,-10 80,-20 80,-10 0,0 0,-10"></div><!-- /pageload-overlay -->
<?php endif; ?>

<?php
if (
  is_page_template('theme-templates/homepage-var3.php') ||
  is_page_template('theme-templates/homepage-var4.php') ||
  is_page_template('theme-templates/homepage-var5.php') ||
  'vertical' == get_theme_mod( 'layout_style', 'horizontal' )
  ) {
  include PARENT_DIR . '/lib/headers/header-sidebar.php';
} else {
  include PARENT_DIR . '/lib/headers/header-default.php';
}

if ('vertical' == get_theme_mod( 'layout_style', 'horizontal' ))
  echo '<div class="holder-vertical-layout col-md-10 col-md-offset-2">';

?>
