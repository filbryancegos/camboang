<?php
/**
 * Footer
 *
 * @package WordPress
 * @subpackage luxuryvilla
 */
?>
        <?php
        if( 1 == get_theme_mod( 'footer_widgets' , 1) ) {
            if (!is_page_template('theme-templates/homepage-var1.php') &&
                !is_singular('property_cpt')  &&
                !is_page_template('theme-templates/homepage-var3.php') &&
                !is_page_template('theme-templates/homepage-var4.php') &&
                !is_page_template('theme-templates/homepage-var5.php')
                ) {
        ?>
            <footer class="site-footer">
                <div class="container-fluid">
                    <?php get_sidebar("footer"); ?>
                </div><!-- /container -->
            </footer>
        <?php } } ?>

        <?php
        if ('vertical' == get_theme_mod( 'layout_style', 'horizontal' ))
            echo '</div>';
        ?>

    <?php if( 1 == get_theme_mod( 'site_preloader', 1 ) ) : ?>
    </div><!-- /#ip-container -->
    <?php endif; ?>

        <?php if (get_theme_mod('custom_js') != '') { ?>
            <script type="text/javascript">
                //<![CDATA[
                    <?php echo stripslashes(get_theme_mod('custom_js')); ?>
                //]]>
            </script>
        <?php } ?>

        <?php wp_footer(); ?>
    </body>
</html>
