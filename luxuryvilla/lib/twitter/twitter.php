<?php
require('StormTwitter.class.php');
require('twitter-settings.php');

/* implement getTweets */
function getTweets($count = 20, $username = false, $options = false) {
    $config['key'] = get_option('tdf_consumer_key');
    $config['secret'] = get_option('tdf_consumer_secret');
    $config['token'] = get_option('tdf_access_token');
    $config['token_secret'] = get_option('tdf_access_token_secret');
    $config['screenname'] = get_option('tdf_user_timeline');
    $config['cache_expire'] = intval(get_option('tdf_cache_expire'));
    if ($config['cache_expire'] < 1) $config['cache_expire'] = 3600;
    $config['directory'] = plugin_dir_path(__FILE__);

    $obj = new StormTwitter($config);
    $res = $obj->getTweets($count, $username, $options);
    update_option('tdf_last_error',$obj->st_last_error);
    return $res;
}

function gg_process_tweets($tweet, $username='', $link='#') {
    
    $the_tweet = $tweet['text'];
    $the_tweet_text = $tweet['text'];
    $the_error = isset($tweet['error']);

    if ($the_error != '') {
       $the_tweet = '';
      __return_false();
    }
    else {

        $time = strtotime($tweet['created_at']);
        if ( ( abs( time() - $time) ) < 86400 )
            $h_time = sprintf( __('%s ago','okthemes'), human_time_diff( $time ) );
        else
            $h_time = date(__('Y/m/d','okthemes'), $time);

        $the_tweet = sprintf( __('%s', 'okthemes'),' <span class="post-date"><a class="pull-left" href="'.$link.'" target="blank"><i class="social_twitter"></i>'.$username.'</a><abbr title="' . date(__('Y/m/d H:i:s','okthemes'), $time) . '">' . $h_time . '</abbr></span>' );

        //use the display url
        if(is_array($tweet['entities']['urls'])){
            foreach($tweet['entities']['urls'] as $key => $link){
                  $the_tweet_text = preg_replace('`'.$link['url'].'`','<a href="'.$link['url'].'" target="_blank">'.$link['url'].'</a>', $the_tweet_text);
            }
        }
        //  Hashtags must link to a twitter.com search with the hashtag as the query.
        if(is_array($tweet['entities']['hashtags'])){
            foreach($tweet['entities']['hashtags'] as $key => $hashtag){
                  $the_tweet_text = preg_replace('/#'.$hashtag['text'].'/i','<a href="https://twitter.com/search?q=%23'.$hashtag['text'].'&src=hash" target="_blank">#'.$hashtag['text'].'</a>',
                $the_tweet_text);
            }
        }
        // User_mentions must link to the mentioned user's profile.
        if(is_array($tweet['entities']['user_mentions'])){
            foreach($tweet['entities']['user_mentions'] as $key => $user_mention){
                  $the_tweet_text = preg_replace('/@'.$user_mention['screen_name'].'/i','<a href="http://www.twitter.com/'.$user_mention['screen_name'].'" target="_blank">@'.$user_mention['screen_name'].'</a>',
                $the_tweet_text);
            }
        }

    $the_tweet .= '<span class="twitter-text">'.$the_tweet_text.'</span>';
      
    } //else

    return $the_tweet;
}