<?php
/**
 * The default template for displaying content. Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage luxuryvilla
 */
?>

<?php
$content = get_the_content();

wp_enqueue_script('magnific');
wp_enqueue_style('magnific');
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( has_post_thumbnail() ) : ?>
	<figure class="effect-milo-sh">
	    	<?php the_post_thumbnail( 'full' ); ?>
	    <figcaption>
	    <?php if ( !is_single() ) : ?>
	    <span class="el-grid-more">
	    	<a class="link-wrapper" href="<?php the_permalink(); ?>">
	    		<i class="entypo entypo-list"></i>
	    	</a>
		</span>
		<?php endif; ?>
	    </figcaption>
	</figure>
	<?php endif; ?>

	<div class="article-wrapper">
		<header class="entry-header">
			<div class="article-header-body <?php if(trim($content) == "") echo 'no-border'; ?>">
				<?php if ( !is_single() ) : ?>
				<h2 class="entry-title">
					<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'okthemes' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
				</h2>
				<?php endif; ?>

				<?php if ( is_single() ) : ?>
				<p class="meta"><?php echo gg_posted_on_single();?></p>
				<?php else : ?>
				<p class="meta"><?php echo gg_posted_on();?></p>
				<?php endif; ?>

			</div>
		</header><!-- .entry-header -->

		<?php if ( is_search() ) : ?>
		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->

		<?php elseif ( gg_is_in_vc() && !is_page_template('theme-templates/blog.php') ) : ?>
			<!-- do not display anything -->
		<?php else : ?>
			<?php if(trim($content) != "") : ?>
				<div class="entry-content">
					<?php the_content( __( 'Continue reading', 'okthemes' ) ); ?>
					<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'okthemes' ), 'after' => '</div>' ) ); ?>
				</div><!-- .entry-content -->
			<?php endif; ?>
		<?php endif; ?>

		<?php if ( !gg_is_in_vc() && is_single() ) : ?>
		<footer class="entry-meta">
			<?php echo gg_posted_in();?>
			<?php edit_post_link( __( 'Edit', 'okthemes' ), '<span class="edit-link">', '</span>' ); ?>
		</footer><!-- .entry-meta -->
		<?php endif; ?>
	</div><!-- .article-wrapper -->
</article><!-- #post -->
