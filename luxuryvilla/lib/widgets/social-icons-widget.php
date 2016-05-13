<?php
/**
 * Adds gg_Social_Icons_Widget widget.
 */
class gg_Social_Icons_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'gg_social_icons_widget', // Base ID
			__('Social Icons Widget', 'okthemes'), // Name
			array( 'description' => __( 'Display a list of social icons', 'okthemes' ), 'classname' => 'social-icons', ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 */
	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );

		echo wp_kses_post($args['before_widget']);

		if ( ! empty( $title ) )
			echo wp_kses_post($args['before_title'] . $title . $args['after_title']);
		?>

		<div class="social-icons-widget">
			<ul class="list-inline">
				<?php if(get_theme_mod('rss_link')): ?>
                <li><a class="symbol social-rss" title="circlerss" href="<?php echo esc_url(get_theme_mod('rss_link')); ?>" target="_blank"></a></li>
                <?php endif; ?>
                <?php if(get_theme_mod('facebook_link')): ?>
                <li><a class="symbol social-facebook" title="circlefacebook" href="https://www.facebook.com/" target="_blank"></a></li>
                <?php endif; ?>
                <?php if(get_theme_mod('twitter_link','okwpthemes')): ?>
                <li><a class="symbol social-twitter" title="circletwitter" href="https://twitter.com/" target="_blank"></a></li>
                <?php endif; ?>
                <?php if(get_theme_mod('skype_link')): ?>
                <li><a class="symbol social-skype" title="circleskype" href="<?php echo esc_url(get_theme_mod('skype_link')); ?>" target="_blank"></a></li>
                <?php endif; ?>
                <?php if(get_theme_mod('vimeo_link')): ?>
                <li><a class="symbol social-vimeo" title="circlevimeo" href="<?php echo esc_url(get_theme_mod('vimeo_link')); ?>" target="_blank"></a></li>
                <?php endif; ?>
                <?php if(get_theme_mod('linkedin_link')): ?>
                <li><a class="symbol social-linkedin" title="circlelinkedin" href="<?php echo esc_url(get_theme_mod('linkedin_link')); ?>" target="_blank"></a></li>
                <?php endif; ?>
                <?php if(get_theme_mod('dribble_link')): ?>
                <li><a class="symbol social-dribble" title="circledribble" href="<?php echo esc_url(get_theme_mod('dribble_link')); ?>" target="_blank"></a></li>
                <?php endif; ?>
                <?php if(get_theme_mod('forrst_link')): ?>
                <li><a class="symbol social-forrst" title="circleforrst" href="<?php echo esc_url(get_theme_mod('forrst_link')); ?>" target="_blank"></a></li>
                <?php endif; ?>
                <?php if(get_theme_mod('flickr_link')): ?>
                <li><a class="symbol social-flickr" title="circleflickr" href="<?php echo esc_url(get_theme_mod('flickr_link')); ?>" target="_blank"></a></li>
                <?php endif; ?>
                <?php if(get_theme_mod('google_link')): ?>
                <li><a class="symbol social-google" title="circlegoogleplus" href="<?php echo esc_url(get_theme_mod('google_link')); ?>" target="_blank"></a></li>
                <?php endif; ?>
                <?php if(get_theme_mod('youtube_link')): ?>
                <li><a class="symbol social-youtube" title="circleyoutube" href="<?php echo esc_url(get_theme_mod('youtube_link')); ?>" target="_blank"></a></li>
                <?php endif; ?>
                <?php if(get_theme_mod('tumblr_link')): ?>
                <li><a class="symbol social-tumblr" title="circletumblr" href="<?php echo esc_url(get_theme_mod('tumblr_link')); ?>" target="_blank"></a></li>
                <?php endif; ?>
                <?php if(get_theme_mod('pinterest_link')): ?>
                <li><a class="symbol social-pinterest" title="circlepinterest" href="<?php echo esc_url(get_theme_mod('pinterest_link')); ?>" target="_blank"></a></li>
                <?php endif; ?>
                <?php if(get_theme_mod('deviantart_link')): ?>
                <li><a class="symbol social-deviantart" title="circledeviantart" href="<?php echo esc_url(get_theme_mod('deviantart_link')); ?>" target="_blank"></a></li>
                <?php endif; ?>
                <?php if(get_theme_mod('foursquare_link')): ?>
                <li><a class="symbol social-foursquare" title="circlefoursquare" href="<?php echo esc_url(get_theme_mod('foursquare_link')); ?>" target="_blank"></a></li>
                <?php endif; ?>
                <?php if(get_theme_mod('github_link')): ?>
                <li><a class="symbol social-github" title="circlegithub" href="<?php echo esc_url(get_theme_mod('github_link')); ?>" target="_blank"></a></li>
                <?php endif; ?>
                <?php if(get_theme_mod('instagram_link')): ?>
                <li><a class="symbol social-instagram" title="circleinstagram" href="<?php echo esc_url(get_theme_mod('instagram_link')); ?>" target="_blank"></a></li>
                <?php endif; ?>
			</ul>

		<div class="clearfix"></div>
		</div>

		<?php
		echo wp_kses_post($args['after_widget']);
	}


	/**
	 * Back-end widget form.
	 */
	public function form( $instance ) {

		$title = isset( $instance['title'] ) ? $instance['title'] : __( 'Contact us', 'okthemes' );

		?>
		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php _e('Title:', 'okthemes'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php echo esc_attr($instance['title']); ?>" type="text" class="widefat" />
		</p>

		<?php
	}


	/**
	 * Sanitize widget form values as they are saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();

		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

		return $instance;
	}


} // class gg_Social_Icons_Widget

// register gg_Social_Icons_Widget
function register_gg_social_icons_widget() {
    register_widget( 'gg_Social_Icons_Widget' );
}
add_action( 'widgets_init', 'register_gg_social_icons_widget' );
