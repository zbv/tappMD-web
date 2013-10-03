<?php

add_action( 'widgets_init', 'ads125_widget_box' );
function ads125_widget_box() {
	register_widget( 'ads125_widget' );
}
class ads125_widget extends WP_Widget {
	function ads125_widget() {
		$widget_ops = array( 'classname' => 'ads125-widget', 'description' => 'ADS 125 widget'  );
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'ads125-widget' );
		$this->WP_Widget( 'ads125-widget',CSC_NAME .' ADS 125*125', $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters('widget_title', $instance['title'] );
		$tran_bg = $instance['tran_bg'];
		$new_window = $instance['new_window'];
		$one_column = $instance['one_column'];
		
		
		if( $new_window ) $new_window =' target="_blank" ';
		else $new_window ='';
		
		if( $one_column ) $one_column =' ads-one';
		else $one_column ='';
		
		echo $before_widget;
		
		if( !$tran_bg ){
			
			echo $before_title;
			echo $title ; 
			echo $after_title;
		}?>
		<div class="row">
        
		<?php for($i=1 ; $i<5 ; $i++ ){ ?>
			<?php if( $instance[ 'ads'.$i.'_code' ] ){ ?>
			<div class="span2" style="text-align:center; margin-top:15px; margin-bottom:15px; width:135px">
				<?php echo $instance[ 'ads'.$i.'_code' ]; ?>
			</div>
            
		<?php } elseif( $instance[ 'ads'.$i.'_img' ] ){ ?>
			<div class="span2" style="text-align:center; margin-top:15px; margin-bottom:15px; width:135px">
				<?php if( $instance[ 'ads'.$i.'_url' ] ){ ?><a href="<?php echo $instance[ 'ads'.$i.'_url' ] ?>" <?php echo $new_window ?>><?php } ?>
					<img src=" <?php echo $instance[ 'ads'.$i.'_img' ] ?> " alt="" />
				<?php if( $instance[ 'ads'.$i.'_url' ] ){ ?></a><?php } ?>
			</div>
            
		<?php
			}
		} ?>
        
		</div>
	<?php 
	
			echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['tran_bg'] = strip_tags( $new_instance['tran_bg'] );
		$instance['new_window'] = strip_tags( $new_instance['new_window'] );
		$instance['one_column'] = strip_tags( $new_instance['one_column'] );

		for($i=1 ; $i<5 ; $i++ ){ 
			$instance['ads'.$i.'_img'] = strip_tags( $new_instance['ads'.$i.'_img'] );
			$instance['ads'.$i.'_url'] = strip_tags( $new_instance['ads'.$i.'_url'] );
			$instance['ads'.$i.'_code'] =  $new_instance['ads'.$i.'_code'] ;
		}
		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 
		'title' => ' Advertisement',
		'tran_bg' => '',
		'new_window' => '',
		'one_column' => '',
		'ads1_code'=>'',
		'ads2_code'=>'',
		'ads3_code'=>'',
		'ads4_code'=>'',
		'ads1_img'=>'',
		'ads2_img'=>'',
		'ads3_img'=>'',
		'ads4_img'=>'',
		'ads1_url'=>'',
		'ads2_url'=>'',
		'ads3_url'=>'',
		'ads4_url'=>''
		
		 );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title : </label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'tran_bg' ); ?>">No title widget :</label>
			<input id="<?php echo $this->get_field_id( 'tran_bg' ); ?>" name="<?php echo $this->get_field_name( 'tran_bg' ); ?>" value="true" <?php if( $instance['tran_bg'] ) echo 'checked="checked"'; ?> type="checkbox" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'new_window' ); ?>">Open links in a new window:</label>
			<input id="<?php echo $this->get_field_id( 'new_window' ); ?>" name="<?php echo $this->get_field_name( 'new_window' ); ?>" value="true" <?php if( $instance['new_window'] ) echo 'checked="checked"'; ?> type="checkbox" />
		</p>

		<?php 
		for($i=1 ; $i<5 ; $i++ ){ ?>
		<em style="display:block; border-bottom:1px solid #CCC; margin:20px 0 5px; font-weight:bold">ADS <?php echo $i; ?> :</em>
		<p>
			<label for="<?php echo $this->get_field_id( 'ads'.$i.'_img' ); ?>">Ads <?php echo $i; ?> image path : </label>
			<input id="<?php echo $this->get_field_id( 'ads'.$i.'_img' ); ?>" name="<?php echo $this->get_field_name( 'ads'.$i.'_img' ); ?>" value="<?php echo $instance['ads'.$i.'_img']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'ads'.$i.'_url' ); ?>">Ads <?php echo $i; ?> link : </label>
			<input id="<?php echo $this->get_field_id( 'ads'.$i.'_url' ); ?>" name="<?php echo $this->get_field_name( 'ads'.$i.'_url' ); ?>" value="<?php echo $instance['ads'.$i.'_url']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'ads'.$i.'_code' ); ?>"><strong> OR : </strong> Ads <?php echo $i; ?> adsense code </label>
			<textarea id="<?php echo $this->get_field_id( 'ads'.$i.'_code' ); ?>" name="<?php echo $this->get_field_name( 'ads'.$i.'_code' ); ?>" class="widefat" ><?php echo $instance['ads'.$i.'_code']; ?></textarea>
		</p>
		<?php } ?>
	<?php
	}
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
add_action( 'widgets_init', 'ads300_250_widget_box' );
function ads300_250_widget_box() {
	register_widget( 'ads300_250_widget' );
}
class ads300_250_widget extends WP_Widget {
	function ads300_250_widget() {
		$widget_ops = array( 'classname' => 'ads300_250-widget', 'description' => ''  );
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'ads300_250-widget' );
		$this->WP_Widget( 'ads300_250-widget',CSC_NAME .' ADS 300*250', $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters('widget_title', $instance['title'] );
		$tran_bg = $instance['tran_bg'];
		$new_window = $instance['new_window'];

		
		if( $new_window ) $new_window =' target="_blank" ';
		else $new_window ='';
		
		echo $before_widget;
			
		if( !$tran_bg ){
			
			echo $before_title;
			echo $title ; 
			echo $after_title;
		}?>
		<div class="row">
		<?php $i=1 ; ?>
			<?php if( $instance[ 'ads'.$i.'_code' ] ){ ?>
			<div class="span3" style="text-align:center">
				<?php echo $instance[ 'ads'.$i.'_code' ]; ?>
			</div>
		<?php } elseif( $instance[ 'ads'.$i.'_img' ] ){ ?>
			<div class="span3" style="text-align:center">
				<?php if( $instance[ 'ads'.$i.'_url' ] ){ ?><a href="<?php echo $instance[ 'ads'.$i.'_url' ] ?>" <?php echo $new_window ?>><?php } ?>
					<img src=" <?php echo $instance[ 'ads'.$i.'_img' ] ?> " alt="" />
				<?php if( $instance[ 'ads'.$i.'_url' ] ){ ?></a><?php } ?>
			</div>
		<?php
			}
		?>
		</div>
	<?php 

			echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['tran_bg'] = strip_tags( $new_instance['tran_bg'] );
		$instance['new_window'] = strip_tags( $new_instance['new_window'] );

		$i=1 ;
		$instance['ads'.$i.'_img'] = strip_tags( $new_instance['ads'.$i.'_img'] );
		$instance['ads'.$i.'_url'] = strip_tags( $new_instance['ads'.$i.'_url'] );
		$instance['ads'.$i.'_code'] =  $new_instance['ads'.$i.'_code'] ;
			
		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 
		'title' => ' Advertisement',
		'tran_bg' => '',
		'new_window' => '',
		'ads1_code'=>'',
		'ads1_img'=>'',
		'ads1_url'=>''
		 );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title : </label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'tran_bg' ); ?>">No title widget :</label>
			<input id="<?php echo $this->get_field_id( 'tran_bg' ); ?>" name="<?php echo $this->get_field_name( 'tran_bg' ); ?>" value="true" <?php if( $instance['tran_bg'] ) echo 'checked="checked"'; ?> type="checkbox" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'new_window' ); ?>">Open links in a new window:</label>
			<input id="<?php echo $this->get_field_id( 'new_window' ); ?>" name="<?php echo $this->get_field_name( 'new_window' ); ?>" value="true" <?php if( $instance['new_window'] ) echo 'checked="checked"'; ?> type="checkbox" />
		</p>

		<?php $i=1 ?>
		<em style="display:block; border-bottom:1px solid #CCC; margin:20px 0 5px; font-weight:bold">ADS :</em>
		<p>
			<label for="<?php echo $this->get_field_id( 'ads'.$i.'_img' ); ?>">Ads  image path : </label>
			<input id="<?php echo $this->get_field_id( 'ads'.$i.'_img' ); ?>" name="<?php echo $this->get_field_name( 'ads'.$i.'_img' ); ?>" value="<?php echo $instance['ads'.$i.'_img']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'ads'.$i.'_url' ); ?>">Ads link : </label>
			<input id="<?php echo $this->get_field_id( 'ads'.$i.'_url' ); ?>" name="<?php echo $this->get_field_name( 'ads'.$i.'_url' ); ?>" value="<?php echo $instance['ads'.$i.'_url']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'ads'.$i.'_code' ); ?>"><strong> OR : </strong> Ads adsense code </label>
			<textarea id="<?php echo $this->get_field_id( 'ads'.$i.'_code' ); ?>" name="<?php echo $this->get_field_name( 'ads'.$i.'_code' ); ?>" class="widefat" ><?php echo $instance['ads'.$i.'_code']; ?></textarea>
		</p>
	<?php
	}
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
add_action( 'widgets_init', 'ads468_60_widget_box' );
function ads468_60_widget_box() {
	register_widget( 'ads468_60_widget' );
}
class ads468_60_widget extends WP_Widget {
	function ads468_60_widget() {
		$widget_ops = array( 'classname' => 'ads468_60-widget', 'description' => ''  );
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'ads468_60-widget' );
		$this->WP_Widget( 'ads468_60-widget',CSC_NAME .' ADS 468*60', $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters('widget_title', $instance['title'] );
		$tran_bg = $instance['tran_bg'];
		$new_window = $instance['new_window'];

		
		if( $new_window ) $new_window =' target="_blank" ';
		else $new_window ='';
		
		echo $before_widget;
			
		if( !$tran_bg ){
			
			echo $before_title;
			echo $title ; 
			echo $after_title;
		}?>
        
		<div class="row">
		<?php $i=1 ; ?>
			<?php if( $instance[ 'ads'.$i.'_code' ] ){ ?>
			<div class="span6" style="text-align:center;">
				<?php echo $instance[ 'ads'.$i.'_code' ]; ?>
			</div>
		<?php } elseif( $instance[ 'ads'.$i.'_img' ] ){ ?>
			<div class="span6" style="text-align:center">
				<?php if( $instance[ 'ads'.$i.'_url' ] ){ ?><a href="<?php echo $instance[ 'ads'.$i.'_url' ] ?>" <?php echo $new_window ?>><?php } ?>
					<img src=" <?php echo $instance[ 'ads'.$i.'_img' ] ?> " alt="" />
				<?php if( $instance[ 'ads'.$i.'_url' ] ){ ?></a><?php } ?>
			</div>
		<?php
			}
		?>
		</div>
	<?php 
		//if( !$tran_bg )
			echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['tran_bg'] = strip_tags( $new_instance['tran_bg'] );
		$instance['new_window'] = strip_tags( $new_instance['new_window'] );

		$i=1 ;
		$instance['ads'.$i.'_img'] = strip_tags( $new_instance['ads'.$i.'_img'] );
		$instance['ads'.$i.'_url'] = strip_tags( $new_instance['ads'.$i.'_url'] );
		$instance['ads'.$i.'_code'] =  $new_instance['ads'.$i.'_code'] ;
			
		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 
		'title' => ' Advertisement',
		'tran_bg' => '',
		'new_window' => '',
		'ads1_code'=>'',
		'ads1_img'=>'',
		'ads1_url'=>''
		 );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title : </label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'tran_bg' ); ?>">No title widget :</label>
			<input id="<?php echo $this->get_field_id( 'tran_bg' ); ?>" name="<?php echo $this->get_field_name( 'tran_bg' ); ?>" value="true" <?php if( $instance['tran_bg'] ) echo 'checked="checked"'; ?> type="checkbox" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'new_window' ); ?>">Open links in a new window:</label>
			<input id="<?php echo $this->get_field_id( 'new_window' ); ?>" name="<?php echo $this->get_field_name( 'new_window' ); ?>" value="true" <?php if( $instance['new_window'] ) echo 'checked="checked"'; ?> type="checkbox" />
		</p>

		<?php $i=1 ?>
		<em style="display:block; border-bottom:1px solid #CCC; margin:20px 0 5px; font-weight:bold">ADS :</em>
		<p>
			<label for="<?php echo $this->get_field_id( 'ads'.$i.'_img' ); ?>">Ads  image path : </label>
			<input id="<?php echo $this->get_field_id( 'ads'.$i.'_img' ); ?>" name="<?php echo $this->get_field_name( 'ads'.$i.'_img' ); ?>" value="<?php echo $instance['ads'.$i.'_img']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'ads'.$i.'_url' ); ?>">Ads link : </label>
			<input id="<?php echo $this->get_field_id( 'ads'.$i.'_url' ); ?>" name="<?php echo $this->get_field_name( 'ads'.$i.'_url' ); ?>" value="<?php echo $instance['ads'.$i.'_url']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'ads'.$i.'_code' ); ?>"><strong> OR : </strong> Ads adsense code </label>
			<textarea id="<?php echo $this->get_field_id( 'ads'.$i.'_code' ); ?>" name="<?php echo $this->get_field_name( 'ads'.$i.'_code' ); ?>" class="widefat" ><?php echo $instance['ads'.$i.'_code']; ?></textarea>
		</p>
	<?php
	}
}
?>