<?php
/**
 * Adds gg_Twitter_Widget widget.
 */
require_once PARENT_DIR . '/lib/twitter/twitter.php';

class TwitterFeedWidget extends WP_Widget {
  
  function __construct() {
      parent::__construct(
          // base ID of the widget
          'TwitterFeedWidget',
          // name of the widget
          __('Twitter Widget', 'okthemes' ),
          // widget options
          array (
              'description' => __( 'Twitter Widget', 'okthemes' ),
              'classname' => 'twitter-widget',
          )
      );
  }

  function form($instance) {
    //displays widget form in admin dashboard
    $defaults = array (
      'title' => 'Tweets',
      'username' => '',
      'link' => '#',
      'limit' => 3
    );
    $instance = wp_parse_args((array) $instance, $defaults );?>
    
    <p>Title: <input class="widefat" name="<?php echo $this->get_field_name('title');?>" type="text" value="<?php echo esc_attr($instance['title']) ?>"/></p>
        <p>Username: <input class="widefat" name="<?php echo $this->get_field_name('username');?>" type="text" value="<?php echo esc_attr($instance['username']); ?>"/></p>
        <p>Twitter Link: <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'C' ); ?>" name="<?php echo $this->get_field_name( 'link' ); ?>" value="<?php echo esc_url($instance['link']); ?>" /></p>
        <p>Limit:
        <select id="<?php echo $this->get_field_id( 'limit' ); ?>" name="<?php echo $this->get_field_name( 'limit' ); ?>">
          
          <?php for( $i = 1; $i <= 20; $i++ ) : $selected = ( $instance['limit'] == $i ) ? ' selected="selected"' : '' ?>
          <option value="<?php echo $i ?>"<?php echo $selected ?>><?php echo $i ?></option>
          <?php endfor ?>
        
        </select></p>                
     
<?php }
  function widget($args, $instance) {
    //displays the widget
     extract ($args);
     //var_dump($instance);
     $title =   $instance['title'];
     $link =   $instance['link'];
    
     echo $before_widget;
     if (!empty($title)) {
      echo $before_title . $title .$after_title;
     }

     echo '<ul>';
     
     $tweets = getTweets($instance['limit'], $instance['username']);
      if(is_array($tweets)){
        foreach($tweets as $tweet){
          $the_tweet = gg_process_tweets($tweet, $instance['username'], $link);
          if ($the_tweet) {
            echo '<li>'.$the_tweet.'</li>';
          }
          else {
            echo '<li class="notweets">No tweets found</li>';
            break;
          }
        }
      }
     
     
     echo '</ul>';

     echo $after_widget;
  }
  function update($new_instance, $old_instance) {
    //save widdget settings
    $instance = $old_instance;
    $instance['title'] = strip_tags($new_instance['title']);
    $instance['username'] = strip_tags($new_instance['username']);
    $instance['link'] =  $new_instance['link'];
    $instance['limit'] = strip_tags( $new_instance['limit'] );
    return $instance;
    
  }
}

// register gg_Twitter_Widget 
function register_gg_twitter_widget() {
    register_widget( 'TwitterFeedWidget' );
}
add_action( 'widgets_init', 'register_gg_twitter_widget' );