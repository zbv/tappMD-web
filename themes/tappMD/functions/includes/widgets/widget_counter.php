<?php

add_action('widgets_init', 'csc_soc_counter_widgets');

function csc_soc_counter_widgets()
{
	register_widget('csc_Social_Counter_Widget');
}

class csc_Social_Counter_Widget extends WP_Widget {
	
	function csc_Social_Counter_Widget()
	{
		$widget_ops = array('classname' => 'csc_social_counter', 'description' => 'Counter of twitter followers , facebook fans , rss subscribes.');

		$control_ops = array('width' => 250, 'height' => 350, 'id_base' => 'csc_social_counter-widget');

		$this->WP_Widget('csc_social_counter-widget', CSC_NAME .' Social Counter', $widget_ops, $control_ops);
	}
	
	function widget($args, $instance)
	{
		$youtube_url = $instance['youtube'] ;
		$vimeo_url = $instance['vimeo'] ;
		$dribbble_url = $instance['dribbble'];
		extract($args);

		echo $before_widget;
		?>
		<?php
		if($instance['title']) {
			echo $before_title.$instance['title'].$after_title;
		}
		?>
		
		<?php if($instance['fb_id']): ?>
		<?php
		$interval = 10000;

		if($_SERVER['REQUEST_TIME'] > get_option('csc_facebook_cache_time')) {
			
			$input['facebook'] = str_replace('http://www.facebook.com/', '', $instance['fb_id']);
			$urlFacebook = wp_remote_get("http://graph.facebook.com/" . $input['facebook']);
			$facebookAccount = json_decode($urlFacebook['body']);
			
			
			if($facebookAccount->likes >= 1) {
				update_option('csc_facebook_cache_time', $_SERVER['REQUEST_TIME'] + $interval);
				update_option('csc_facebook_followers', $facebookAccount->likes);
				update_option('csc_facebook_link', $facebookAccount->link);
			}
		}
		?>
        
		<?php endif; ?>

		<?php
		$count = 0;
		if($instance) {
			foreach($instance as $i) {
				if($i) {
					$count++;
				}
			};
		}
		?>
        <?php if($instance['twitter_id']): ?>
         <?php $twitter = csc_followers_count();?>
        <?php endif;?>
        <div class="row">
        <div class="span3">
		<ul class="counter-widget <?php echo $id; ?>-counter-widget">
			
			<?php 
			if($instance['twitter_id']): ?>
			<li class="tw">
            <a href="<?php echo $twitter['page_url']?>" class="twitter" target="_blank">
            <span><?php echo $twitter['followers_count'] ?></span>
            <em><?php _e('Followers','csc-themewp') ?></em>
            </a>
            </li>
			<?php endif; ?>
            <?php 
			if($instance['fb_id']): ?>
			<li class="fb">
            <a href="<?php echo get_option('csc_facebook_link'); ?>" class="facebook" target="_blank">
            <span><?php echo get_option('csc_facebook_followers'); ?></span>
            <em><?php _e('Fans','csc-themewp') ?></em>
            </a>
            </li>
			<?php endif; ?>
            <?php if( $instance['vimeo'] ):
					$vimeo = csc_vimeo( $vimeo_url ); ?>
				<li class="vo">
					<a href="<?php echo $vimeo_url ?>" target="_blank">
						<span><?php echo $vimeo ?></span>
						<em><?php _e('Subscribers' ,'csc-themewp') ?></em>
					</a>
				</li>
			<?php endif; ?>
            <?php if($instance['youtube'] ):
					$youtube = csc_youtube( $youtube_url ); ?>
				<li class="yt">
					<a href="<?php echo $youtube_url ?>" target="_blank">
						<span><?php echo  $youtube ?></span>
						<em><?php _e('Subscribers' ,'csc-themewp' ) ?></em>
					</a>
				</li>
			<?php endif; ?>
			<?php if($instance['dribbble'] ):
					$dribbble = csc_dribbble( $dribbble_url ); ?>
				<li class="de">
					<a href="<?php echo $dribbble_url ?>" target="_blank">
						<span><?php echo $dribbble  ?></span>
						<em><?php _e('Followers' ,'csc-themewp') ?></em>
					</a>
				</li>
			<?php endif; ?>
            
			
            <li class="rss">
            <a href="<?php bloginfo('rss2_url'); ?>" class="rss">
            <span>RSS</span>
            <em><?php _e('Subscribe to RSS Feed','csc-themewp') ?></em>
            </a>
            </li>
            
            
		</ul>
        </div>
        </div>
		<?php
		
		echo $after_widget;
	}
	
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;

		$instance['title'] = $new_instance['title'];
		$instance['fb_id'] = $new_instance['fb_id'];
		$instance['twitter_id'] = $new_instance['twitter_id'];
		$instance['youtube'] = $new_instance['youtube'] ;
		$instance['vimeo'] =  $new_instance['vimeo'] ;
		$instance['dribbble'] =  $new_instance['dribbble'] ;

		return $instance;
	}

	function form($instance)
	{
		$defaults = array(
		'title' => 'Counter', 
		'fb_id' => '', 
		'twitter_id' => '',
		'youtube' => '',
		'vimeo' => '',
		'dribbble' => '',
		
		);
		$instance = wp_parse_args((array) $instance, $defaults); ?>
        
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">Title:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
		</p>

		<p><em style="color:red;">Make sure you Setup Twitter API OAuth settings : Theme Panel -> Twitter API OAuth</em></p>
        <p>
			<label for="<?php echo $this->get_field_id('twitter_id'); ?>">Enable Twitter Counter:</label>
            <input type="checkbox" id="<?php echo $this->get_field_id('twitter_id'); ?>" name="<?php echo $this->get_field_name('twitter_id'); ?>" value="true" <?php if( $instance['twitter_id'] ) echo 'checked="checked"'; ?> /></p>

        <p>
			<label for="<?php echo $this->get_field_id('fb_id'); ?>">Facebook Name or ID:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('fb_id'); ?>" name="<?php echo $this->get_field_name('fb_id'); ?>" value="<?php echo $instance['fb_id']; ?>" />
		<small>Ex: "themeforest" or "219169531505337"</small>
		</p>
        
        <p>
			<label for="<?php echo $this->get_field_id( 'youtube' ); ?>">Youtube Channel URL : </label>
			<input id="<?php echo $this->get_field_id( 'youtube' ); ?>" name="<?php echo $this->get_field_name( 'youtube' ); ?>" value="<?php echo $instance['youtube']; ?>" class="widefat" style="width: 216px;" />
			<small>Ex:  http://www.youtube.com/user/username </small>

		</p>
        <p>
			<label for="<?php echo $this->get_field_id( 'vimeo' ); ?>">Vimeo Channel URL : </label>
			<input id="<?php echo $this->get_field_id( 'vimeo' ); ?>" name="<?php echo $this->get_field_name( 'vimeo' ); ?>" value="<?php echo $instance['vimeo']; ?>" class="widefat" type="text" />
			<small>Ex: http://vimeo.com/channels/username </small>

		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'dribbble' ); ?>">dribbble Page URL : </label>
			<input id="<?php echo $this->get_field_id( 'dribbble' ); ?>" name="<?php echo $this->get_field_name( 'dribbble' ); ?>" value="<?php echo $instance['dribbble']; ?>" class="widefat" type="text" />
			<small>Ex: http://dribbble.com/username</small>

		</p>

	<?php }
}
?>