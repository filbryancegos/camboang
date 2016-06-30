<?php
/**
 * Adds gg_bwMap_Widget widget.
 */
class gg_bwMap_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'gg_bwmap_widget', // Base ID
			__('BW map Widget', 'okthemes'), // Name
			array( 'description' => __( 'Black and White Image map Widget', 'okthemes' ), 'classname' => 'bwmap', ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 */
	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );
		$latitude = ! empty( $instance['latitude'] ) ? $instance['latitude'] : '';
		$longitude = ! empty( $instance['longitude'] ) ? $instance['longitude'] : '';
		$zoom = ! empty( $instance['zoom'] ) ? $instance['zoom'] : '10';

		echo wp_kses_post($args['before_widget']);

		if ( ! empty( $title ) )
			echo wp_kses_post($args['before_title'] . $title . $args['after_title']);

		//Enqueue scripts
		wp_enqueue_script('google-map-api');
		wp_enqueue_script('maplace');
		$map_marker = get_template_directory_uri() .'/images/map-marker.png';
		?>

		<!-- Map script -->
		<script type="text/javascript">
		var $j = jQuery.noConflict();
		$j(document).ready(function(){
		var LocsC = [
		    {
		        lat: <?php echo esc_html($latitude); ?>,
		        lon: <?php echo esc_html($longitude); ?>,
		        icon : '<?php echo esc_url($map_marker); ?>',
		        zoom: <?php echo esc_html($zoom); ?>,
		    },
		];

		var bw = new Maplace({
		    locations: LocsC,
		    map_div: '#bwmap-map',
		    map_options: {
		    	draggable : false,
		    	disableDefaultUI: true,
		    	scrollwheel : false,
		    },
		    styles: {
		        'LightGrey': [{"featureType":"water","elementType":"geometry.fill","stylers":[{"color":"#d3d3d3"}]},{"featureType":"transit","stylers":[{"color":"#808080"},{"visibility":"off"}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"visibility":"on"},{"color":"#b3b3b3"}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#ffffff"}]},{"featureType":"road.local","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#ffffff"},{"weight":1.8}]},{"featureType":"road.local","elementType":"geometry.stroke","stylers":[{"color":"#d7d7d7"}]},{"featureType":"poi","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#ebebeb"}]},{"featureType":"administrative","elementType":"geometry","stylers":[{"color":"#a7a7a7"}]},{"featureType":"road.arterial","elementType":"geometry.fill","stylers":[{"color":"#ffffff"}]},{"featureType":"road.arterial","elementType":"geometry.fill","stylers":[{"color":"#ffffff"}]},{"featureType":"landscape","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#efefef"}]},{"featureType":"road","elementType":"labels.text.fill","stylers":[{"color":"#696969"}]},{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"visibility":"on"},{"color":"#737373"}]},{"featureType":"poi","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"poi","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"road.arterial","elementType":"geometry.stroke","stylers":[{"color":"#d6d6d6"}]},{"featureType":"road","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{},{"featureType":"poi","elementType":"geometry.fill","stylers":[{"color":"#dadada"}]}]
		    },
		});

		bw.Load();
		});

		</script>

		<!-- Map holder -->
		<div id="bwmap-map"></div>

		<?php 
		echo wp_kses_post($args['after_widget']);
	}
	

	/**
	 * Back-end widget form.
	 */
	public function form( $instance ) {
		
		$instance = wp_parse_args( (array) $instance, array( 'title' => __( 'Contact us', 'okthemes' ), 'latitude' => '51.5060573', 'longitude' => '-0.1296257','zoom' => '10') );

		$title = isset( $instance['title'] ) ? $instance['title'] : __( 'Contact us', 'okthemes' );
		$latitude = isset( $instance['latitude'] ) ? $instance['latitude'] : '';
		$longitude = isset( $instance['longitude'] ) ? $instance['longitude'] : '';
		$zoom = isset( $instance['zoom'] ) ? $instance['zoom'] : '10';

		?>
		
		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php _e('Title:', 'okthemes'); ?></label>
			<input type="text" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php echo esc_attr($instance['title']); ?>" class="widefat" />
		</p>
		
		<!-- Latitude: Text Input -->
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'latitude' )); ?>"><?php _e('Latitude:', 'okthemes'); ?></label>
			<input type="text" id="<?php echo esc_attr($this->get_field_id( 'latitude' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'latitude' )); ?>" value="<?php echo esc_attr($instance['latitude']); ?>" class="widefat" />
		</p>
		
		<!-- Longitude: Text Input -->
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'longitude' )); ?>"><?php _e('Longitude:', 'okthemes'); ?></label>
			<input type="text" id="<?php echo esc_attr($this->get_field_id( 'longitude' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'longitude' )); ?>" value="<?php echo esc_attr($instance['longitude']); ?>" class="widefat" />
		</p>

		<!-- Zoom: Text Input -->
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'zoom' )); ?>"><?php _e('Zoom:', 'okthemes'); ?></label>
			<input type="text" id="<?php echo esc_attr($this->get_field_id( 'zoom' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'zoom' )); ?>" value="<?php echo esc_attr($instance['zoom']); ?>" class="widefat" />
		</p>

		<?php 
	}


	/**
	 * Sanitize widget form values as they are saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();

		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['latitude'] =  $new_instance['latitude'];
		$instance['longitude'] =  $new_instance['longitude'];
		$instance['zoom'] =  $new_instance['zoom'];
		
		return $instance;
	}


} // class gg_bwMap_Widget

// register gg_bwMap_Widget 
function register_gg_bwmap_widget() {
    register_widget( 'gg_bwMap_Widget' );
}
add_action( 'widgets_init', 'register_gg_bwmap_widget' );