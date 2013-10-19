<?php
/**
 * Add area for content
 *
 * @package     Debug Objects
 * @subpackage  Markup and Hooks for include content
 * @author      Frank B&uuml;ltge
 * @since       2.0.0
 */

if ( ! function_exists( 'add_filter' ) ) {
	echo "Hi there! I'm just a part of plugin, not much I can do when called directly.";
	exit;
}

if ( ! class_exists( 'Debug_Objects_Wrap' ) ) {
	class Debug_Objects_Wrap extends Debug_Objects {
		
		protected static $classobj = NULL;
		
		/**
		 * Handler for the action 'init'. Instantiates this class.
		 * 
		 * @access  public
		 * @return  $classobj
		 */
		public static function init() {
			
			NULL === self::$classobj and self::$classobj = new self();
			
			return self::$classobj;
		}
		
		/**
		 * Include class in plugin and init all functions
		 * 
		 * @access  public
		 * @since   2.0.0
		 * @return  void
		 */
		public function __construct() {
			// not enough right - back
			if ( ! current_user_can( '_debug_objects' ) )
				return;
			
			$options = Debug_Objects_Settings :: return_options();
			
			// check for output on frontend
			if ( isset( $options['frontend'] ) && '1' === $options['frontend']
				 || self::debug_control()
				 ) {
				add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts') );
				add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles') );
				add_action( 'wp_footer', array( $this, 'get_content' ), 9999 );
			}
			// check for output on backend
			if ( isset( $options['backend'] ) && '1' === $options['backend']
				 || self::debug_control()
				 ) {
				add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_styles') );
				add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts') );
				add_action( 'admin_footer', array( $this, 'get_content' ), 9999 );
			}
		}
		
		/**
		 * Enqueue stylesheets on frontend or backend
		 * 
		 * @access  public
		 * @since   2.0.0
		 * @return  void
		 */
		public function enqueue_styles() {
			
			$suffix = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '.dev' : '';
			
			// right path
			$path = str_replace( '/inc/', '', plugin_dir_url( __FILE__ ) );
			
			wp_register_style( 'jquery-ui-css', $path . '/css/jquery-ui-demo.css' );
			
			// check user style
			if ( 'classic' == get_user_option( 'admin_color') )
				wp_register_style( 'jquery-ui-wp', $path . '/css/jquery-ui-classic.css', 'jquery-ui-css' );
			else
				wp_register_style( 'jquery-ui-wp', $path . '/css/jquery-ui-fresh.css', 'jquery-ui-css' );
			
			wp_register_style(
				parent::get_plugin_data() . '_style',
				$path . '/css/style' . $suffix. '.css',
				array( 'jquery-ui-css', 'jquery-ui-wp' ),
				FALSE,
				'screen'
			);
			wp_enqueue_style( parent::get_plugin_data() . '_style' );
			
		}
		
		/**
		 * Enqueue scripts on frontend or backend
		 * 
		 * @access  public
		 * @since   2.0.0
		 * @return  void
		 */
		public function enqueue_scripts( $where ) {
			
			$suffix = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '.dev' : '';
			
			wp_enqueue_script(
				parent::get_plugin_data() . '_script', 
				str_replace( '/inc/', '', plugins_url( 'js/debug_objects' . $suffix. '.js', dirname( __FILE__ ) ) ), 
				array( 'jquery-ui-tabs', parent :: get_plugin_data() . '_cookie_script' ),
				filemtime( 
					str_replace( '/inc/', '', plugin_dir_path( dirname( __FILE__ ) ) . 'js/debug_objects' . $suffix. '.js' )
				),
				TRUE
			);
			wp_enqueue_script(
				parent::get_plugin_data() . '_cookie_script', 
				str_replace( '/inc/', '', plugins_url( 'js/jquery.cookie.js', dirname( __FILE__ ) ) ), 
				array( 'jquery' ),
				filemtime( 
					str_replace( '/inc/', '', plugin_dir_path( dirname( __FILE__ ) ) . 'js/jquery.cookie.js' )
				),
				TRUE
			);
		}
		
		/**
		 * Echo markup for view output
		 * 
		 * @access  public
		 * @since   2.0.0
		 * @return  string
		 */
		public function get_content() {
			?>
			<div id="debugobjects">
				<div id="debugobjectstabs">
					<ul>
					<?php
					/**
					 *  use this filter for include new tabs with content
					$tabs[] = array( 
						'tab' => __( 'Conditional Tags', parent :: get_plugin_data() ),
						'function' => array( __CLASS__, 'get_conditional_tags' )
					);
					*/
					$tabs = apply_filters( 'debug_objects_tabs', $tabs = array() );
					if ( empty( $tabs ) )
						echo '<li>Debug Objects: No active settings.</li>';
					
					foreach( $tabs as $tab ) {
						echo '<li><a href="#' . htmlentities2( tag_escape( $tab['tab'] ) ) . '">' . esc_attr( $tab['tab'] ) . '</a></li>';
					}
					?>
					</ul>
				
					<?php
					foreach( $tabs as $tab ) {
						echo '<div id="' . htmlentities2( tag_escape( $tab['tab'] ) ) . '">';
								call_user_func( array( $tab['function'][0], $tab['function'][1] ) );
								// only with php 5.3 and higher
								//$tab['function'][0] :: $tab['function'][1]();
							do_action( 'debug_objects_function' );
						echo '</div>';
					}
					?>
				</div> <!-- end id=debugobjectstabs -->
			</div> <!-- end id=debugobjects -->
			<br style="clear: both;"/>
			<?php
		}
		
	} // end class
}// end if class exists
