<?php
/*
 * Latest Tweets
 */


add_action( 'widgets_init', 'csc_tweets_widgets' );

function csc_tweets_widgets() {
	register_widget( 'csc_Tweet_Widget' );
}

class csc_tweet_widget extends WP_Widget {

	function csc_Tweet_Widget() {
	

		$widget_ops = array( 'classname' => 'tweet_widget', 'description' => 'A widget that displays your latest tweets.' );


		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'csc_tweet_widget' );


		$this->WP_Widget( 'csc_tweet_widget', CSC_NAME .'  Latest Tweets', $widget_ops, $control_ops );
	}

	
//widget output
			function widget($args, $instance) {
				extract($args);
				if(!empty($instance['title'])){ $title = apply_filters( 'widget_title', $instance['title'] ); }
				
				
		        $postcount = $instance['postcount'];
		        $tweettext = $instance['tweettext'];
                $cachetime = $instance['cachetime'];
				
				
				
				$twitter_username 		= csc_option('csc_twitter_username');
		        $consumer_key 			= csc_option('csc_twitter_consumer_key');
		        $consumer_secret		= csc_option('csc_twitter_consumer_secret');
		        $access_token 			= csc_option('csc_twitter_access_token');
		        $access_token_secret 	= csc_option('csc_twitter_access_token_secret');
				
				
				echo $before_widget;
								
				if ( ! empty( $title ) ){ echo $before_title . $title . $after_title; }

				
					//check settings and die if not set
						if(empty($consumer_key) || empty($consumer_secret) || empty($access_token) || empty($access_token_secret) || empty($cachetime) || empty($twitter_username)){
							echo '<strong>Please fill all widget settings!</strong>' . $after_widget;
							return;
						}
					
										
					//check if cache needs update
						$tp_twitter_plugin_last_cache_time = get_option('tp_twitter_plugin_last_cache_time');
						$diff = time() - $tp_twitter_plugin_last_cache_time;
						$crt = $cachetime * 3600;
						
					 //	yes, it needs update			
						if($diff >= $crt || empty($tp_twitter_plugin_last_cache_time)){
							
							//if(!require_once('twitteroauth.php')){ 
//								echo '<strong>Couldn\'t find twitteroauth.php!</strong>' . $after_widget;
//								return;
//							}
														
							function getConnectionWithAccessToken($cons_key, $cons_secret, $oauth_token, $oauth_token_secret) {
							  $connection = new TwitterOAuth($cons_key, $cons_secret, $oauth_token, $oauth_token_secret);
							  return $connection;
							}
							  
							  							  
							$connection = getConnectionWithAccessToken($consumer_key , $consumer_secret , $access_token , $access_token_secret);
							$tweets = $connection->get("https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=".$twitter_username."&count=10") or die('Couldn\'t retrieve tweets! Wrong username?');
							
														
							if(!empty($tweets->errors)){
								if($tweets->errors[0]->message == 'Invalid or expired token'){
									echo '<strong>'.$tweets->errors[0]->message.'!</strong><br />You\'ll need to regenerate it <a href=\"https://dev.twitter.com/apps\" target="_blank">here</a>!' . $after_widget;
								}else{
									echo '<strong>'.$tweets->errors[0]->message.'</strong>' . $after_widget;
								}
								return;
							}
							
							for($i = 0;$i <= count($tweets); $i++){
								if(!empty($tweets[$i])){
									$tweets_array[$i]['created_at'] = $tweets[$i]->created_at;
									$tweets_array[$i]['text'] = $tweets[$i]->text;			
									$tweets_array[$i]['status_id'] = $tweets[$i]->id_str;			
								}	
							}							
							
							//save tweets to wp option 		
								update_option('tp_twitter_plugin_tweets',serialize($tweets_array));							
								update_option('tp_twitter_plugin_last_cache_time',time());
								
							echo '<!-- twitter cache has been updated! -->';
						}
						
						
							
					
					$tp_twitter_plugin_tweets = maybe_unserialize(get_option('tp_twitter_plugin_tweets'));
					if(!empty($tp_twitter_plugin_tweets)){
						print '
						 <div class="tweets">
							<ul>';
							$fctr = '1';
							foreach($tp_twitter_plugin_tweets as $tweet){								
								print '<li><span>'.convert_links($tweet['text']).'</span><br /><a class="twitter_time" target="_blank" href="http://twitter.com/'.$twitter_username.'/statuses/'.$tweet['status_id'].'">'.relative_time($tweet['created_at']).'</a></li>';
								if($fctr == $instance['postcount']){ break; }
								$fctr++;
							}
						
						print '
							</ul>
							<a href="http://twitter.com/'.$twitter_username.'" class="follow-us">'.$tweettext.'</a>
						</div>';
					}
				
				
				
				echo $after_widget;
			}
			
		
		//save widget settings 
			function update($new_instance, $old_instance) {				
				$instance = array();
				$instance['title'] = strip_tags( $new_instance['title'] );
				$instance['postcount'] = strip_tags( $new_instance['postcount'] );
                $instance['cachetime'] = strip_tags( $new_instance['cachetime'] );
		        $instance['tweettext'] = strip_tags( $new_instance['tweettext'] );


				//if($old_instance['username'] != $new_instance['username']){
//					delete_option('tp_twitter_plugin_last_cache_time');
//				}
				
				return $instance;
			}
			
			
		//widget settings form	
			function form($instance) {
				$defaults = array(
		'title' => 'Our Latest Tweets',
		'postcount' => '4',
		'cachetime' => '1',
		'tweettext' => 'Follow on Twitter',
		);
				$instance = wp_parse_args( (array) $instance, $defaults );?>
				
				
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php echo 'Title:'; ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
        <p><em style="color:red;">Make sure you Setup Twitter API OAuth settings : Theme Panel -> Twitter API OAuth</em></p>
		
		<!-- Postcount: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'postcount' ); ?>"><?php echo 'Number of tweets: '; ?></label>
			<input class="small-text" id="<?php echo $this->get_field_id( 'postcount' ); ?>" name="<?php echo $this->get_field_name( 'postcount' ); ?>" value="<?php echo $instance['postcount']; ?>" />
		</p>
        
        <p>
        <label for="<?php echo $this->get_field_id( 'cachetime' ); ?>"><?php echo 'Cache Tweets in every: '; ?></label>
         <input id="<?php echo $this->get_field_id( 'cachetime' ); ?>" name="<?php echo $this->get_field_name( 'cachetime' ); ?>" value="<?php echo $instance['cachetime']; ?>"  class="small-text" />hours</p>	           
		
		<!-- Tweettext: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'tweettext' ); ?>"><?php echo 'Follow Text: '; ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'tweettext' ); ?>" name="<?php echo $this->get_field_name( 'tweettext' ); ?>" value="<?php echo $instance['tweettext']; ?>" />
		</p>
				
<?php 
 }
}?>
