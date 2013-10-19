<?php
/**
 * Add small screen with informations about queries of WP
 *
 * @package	    Debug Queries
 * @subpackage  Cache
 * @author      Frank Bültge
 * @since       2.0.0
 */

if ( ! function_exists( 'add_action' ) ) {
	echo "Hi there!  I'm just a part of plugin, not much I can do when called directly.";
	exit;
}

if ( ! class_exists( 'Debug_Objects_Query' ) ) {
	
	// disable mySQL Session Cache
	if ( ! defined( 'QUERY_CACHE_TYPE_OFF' ) )
		define( 'QUERY_CACHE_TYPE_OFF', TRUE );
	
	if ( ! defined( 'SAVEQUERIES' ) )
		define( 'SAVEQUERIES', TRUE );
	
	if ( ! defined( 'STACKTRACE' ) )
		define( 'STACKTRACE', FALSE );
	
	//add_action( 'admin_init', array( 'Debug_Objects_Query', 'init' ) );
	
	class Debug_Objects_Query extends Debug_Objects {
		
		private static $replaced_functions = array( 'require_once', 'require', 'include', 'include_once' );
		
		private static $replaced_actions   = array( 'do_action, call_user_func_array' );
		
		/**
		 * Stored Backtrace Data from hooked query
		 * @var   array
		 */
		protected $_query = array();
		
		/**
		 * Stored Backtrace Data from global query
		 * @var   array
		 */
		protected $_queries = array();
		
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
		
		public function __construct() {
			
			if ( ! current_user_can( '_debug_objects' ) )
				return;
			
			add_filter( 'query', array( $this, 'store_queries' ) );
			add_filter( 'debug_objects_tabs', array( $this, 'get_conditional_tab' ) );
		}
		
		/**
		 * Add Tabs and his context to output
		 * 
		 * @param   Array
		 * @return  Array
		 */
		public function get_conditional_tab( $tabs ) {
			
			$tabs[] = array( 
				'tab'      => __( 'Queries' ),
				'function' => array( $this, 'get_queries' )
			);
			
			$tabs[] = array(
				'tab'      => __( 'Plugin Queries' ),
				'function' => array( $this, 'render_data' )
			);
			
			return $tabs;
		}
		
		/**
		 * Sorting of Multidimensional arrays
		 * Only >= PHP 5.3
		 * 
		 * @since   08/18/2013
		 * @see     http://stackoverflow.com/questions/96759/how-do-i-sort-a-multidimensional-array-in-php
		 * @return  Boolean
		 */
		public function make_comparer() {
			// Normalize criteria up front so that the comparer finds everything tidy
			$criteria = func_get_args();
			foreach ($criteria as $index => $criterion) {
				$criteria[$index] = is_array($criterion)
					? array_pad($criterion, 3, null)
					: array($criterion, SORT_ASC, null);
			}
		 
			return function( $first, $second ) use ( $criteria ) {
				foreach ($criteria as $criterion) {
					// How will we compare this round?
					list($column, $sortOrder, $projection) = $criterion;
					$sortOrder = $sortOrder === SORT_DESC ? -1 : 1;
					
					// If a projection was defined project the values now
					if ($projection) {
						$lhs = call_user_func($projection, $first[$column]);
						$rhs = call_user_func($projection, $second[$column]);
					} else {
						$lhs = $first[$column];
						$rhs = $second[$column];
					}
					
					// Do the actual comparison; do not return if equal
					if ($lhs < $rhs) {
						return -1 * $sortOrder;
					} else if ($lhs > $rhs) {
						return 1 * $sortOrder;
					}
				}
				
				return 0; // tiebreakers exhausted, so $first == $second
			};
		}
		
		/**
		 * Sorting of Multidimensional arrays
		 * Hint: Slow and inefficent which to much foreach, usort is a better way
		 * 
		 * @since   08/18/2013
		 * @see     http://stackoverflow.com/questions/2699086/sort-multidimensional-array-by-value-2
		 * @param   Array,  Input array
		 * @param   String of key in array
		 */
		public function aasort( &$array, $key ) {
			
			$sorter = array();
			$ret    = array();
			reset( $array );
			
			foreach( $array as $ii => $va ) {
				$sorter[$ii] = $va[$key];
			}
			asort( $sorter );
			
			foreach( $sorter as $ii => $va ) {
				$ret[$ii] = $array[$ii];
			}
			$array = $ret;
		}
		
		/**
		 * Filters wpdb::query
		 * This filter stores all queries and their backtraces for later use
		 * 
		 * @param string $query
		 * @return string
		 */
		public function store_queries( $query ) {
			
			$trace = debug_backtrace();
			array_splice( $trace, 0, 3 ); // Get rid of the tracer's fingerprint (and wpdb::query)
			$this->_query[] = array( 'query' => $query, 'backtrace' => $trace );
			
			return $query;
		}
		
		/**
		 * Map Plugins to the queries and create array with data
		 * 
		 * @return  Array  All data to query, if is a plugin query
		 */
		public function validate_plugins_to_query() {
			global $wpdb;
			
			// Gather data about existing plugins
			$rootData = array();
			foreach( get_plugins() as $filename => $data ) {
				list($root) = explode( '/', $filename, 2 );
				$root_data[$root] = array_change_key_case($data);
			}
			
			// set var with query data
			$raw_data = $this->_query;
			// clear var
			$this->_query = array();
			
			$query_counter = 0;
			foreach( $raw_data as $key => $data ) {
				
				foreach( $data['backtrace'] as $call ) {
					
					$functionChain[] = ( isset($call['class']) ? "{$call['class']}::" : '' ) . $call['function'];
					
					// same strings in local and web envirement
					$wp_plugin_dir = str_replace( '\\', '/', WP_PLUGIN_DIR );
					if ( ! empty( $call['file'] ) )
						$call['file'] = str_replace( '\\', '/', $call['file'] );
					
					// if is a plugin
					if ( ! empty( $call['file'] ) 
						&& FALSE !== strpos( $call['file'], $wp_plugin_dir )
						&& FALSE === strpos( $call['file'], 'Debug-Objects' )
						) {
						
						// get only the plugin file path, without plugin dir
						list($root) = explode( '/', plugin_basename( $call['file'] ), 2 );
						$file = str_replace( $wp_plugin_dir, '', $call['file'] );
						
						// Make sure the array is set up
						if ( ! isset( $this->_query[$root] ) ) {
							$this->_query[$root] = $root_data[$root];
							$this->_query[$root]['backtrace'] = array();
						}
						
						// Make sure the backtrace for this file is set up
						if ( ! isset( $this->_query[$root]['backtrace'][$file] ) ) {
							$this->_query[$root]['backtrace'][$file] = array();
						} 
						
						$data['time'] = 'FALSE';
						// add time stamp of query
						foreach( $wpdb->queries as $key => $arr ) {
							if ( FALSE !== strpos( $arr[0], $data['query'] ) ) {
								$data['time'] = $arr[1];
							}
						}
						
						// Save parsed data
						$this->_query[$root]['backtrace'][$file][] = array(
							'line'           => $call['line'],
							'query'          => $data['query'],
							'time'           => $data['time'],
							'function_chain' => array_reverse( $functionChain ),
						);
						
						// add 1 to query counter
						$query_counter ++;
					}
					
				}
				
			}
			
			// sorting
			usort( $this->_query, array( $this, 'sort_by_name') );
			$this->_query['query_count'] = $query_counter;
			
			return $this->_query;
		}
		
		/**
		 * Render tracer's data
		 * 
		 * @param array $data
		 */
		public function render_data( $data = NULL ) {
			
			if ( NULL === $data )
				$data = $this->validate_plugins_to_query();
			
			$plugin_count = count( $data ) - 1;
			
			$output = '';
			
			$output .= '<ul>' . "\n";
			$output .= '<li><strong>' . __( 'Plugins Total:' ) . ' ' 
					. $plugin_count . ' ' . '</strong></li>' . "\n";
			$output .= '<li><strong>' . __( 'Queries Total:' ) . ' ' . $data['query_count'] . '</strong></li>' . "\n";
			$output .= '</ul><hr />' . "\n";
			
			// remove counter, not necassary from here
			unset( $data['query_count'] );
			
			$output .= '<ol>' . "\n";
			
			$x = 1;
			foreach( $data as $plugin_data ) {
				$output .= '<li><a href="#anker_' . $x . '">' 
					. $plugin_data['name'] . '</a></li>' . "\n";
				$x ++;
			}
			
			$output .= '</ol><hr />' . "\n";
			
			$x = 1;
			foreach( $data as $plugin_data ) {
				
				$output .= '<h2 id="anker_' . $x . '">' . $x . '. ' . __( 'Plugin:' ) . ' ' . $plugin_data['name'] . '</h2>' . "\n";
				
				foreach( $plugin_data['backtrace'] as $filename => $data ) {
					
					$filename = htmlspecialchars( $filename );
					
					$output .= sprintf('<p><code>%s</code></p>
						<table>
							<tr>
								<th>%s</th>
								<th>%s</th>
							</tr>',
						htmlspecialchars( $filename ),
						__( 'Line' ),
						__( 'Query &amp; Function Chain' )
						);
					
					foreach( $data as $query ) {
						
						$query['query'] = $query['time'] . __( 's' ) . ' / ' 
							. number_format_i18n( sprintf( '%0.1f', $query['time'] * 1000), 1 ) . __( 'ms' ) 
							. '<br><code>' . htmlspecialchars( $query['query'] ) . '</code>';
						// build function chain/backtrace
						$function_chain = implode( ' &#8594; ', $query['function_chain'] );
						
						$output .= '<tr class="alternate">
								<td align="center" valign="center" >' . $query['line'] . '</td>
								<td>' . $query['query'] . '</td>
							</tr>';
							
						if ( STACKTRACE ) {
							$output .= 
								"<tr>
									<td></td>
									<td>$function_chain</td>
								</tr>";
						}
						
					}
					$output .= '</table>' . "\n"	;
					$x ++;
				}
			}
			
			echo $output;
		}
		
		/**
		 * Faux-private function for sorting data
		 * 
		 * @param   array $a
		 * @param   array $b
		 * @return  integer
		 */
		public function sort_by_name( $a, $b ) {
			
			return strcmp( $a['name'], $b['name'] );
		}
		
		/**
		 * Get queries about the globals, incl. all queries
		 * Format the queries for readable output
		 * 
		 * @param   Boolean  Default is True, Use FALSE for return data
		 * @param   String
		 * @return  Mixed, Use SORT_DESC, SORT_ASC for Sorting direction; Use FALSE for deactivate the sorting
		 */
		public function get_queries( $echo = TRUE, $sorting = SORT_DESC ) {
			global $wpdb, $EZSQL_ERROR;
			
			$wpdb->flush();
			
			// @see  http://www.mysqlfaqs.net/mysql-faqs/Speed-Up-Queries/What-is-query-cache-in-MySQL
			// Disable query cache for current client
			if ( QUERY_CACHE_TYPE_OFF )
				mysql_query( "SET SESSION query_cache_type = OFF" );
				// return php warnings on the default Wpd-query
				//$wpdb->query( "SET SESSION query_cache_type = OFF;" );
			
			// save all queries in var
			$this->_queries = $wpdb->queries;
			
			$debug_queries = '';
			$total_query_time = 0;
			$x = 0;
			$total_time = timer_stop( 0, 22 );
			$total_query_time = 0;
			$class = ''; 
			
			if ( ! empty( $this->_queries ) ) {

			$php_time = $total_time - $total_query_time;
			// Create the percentages
			if ( 0 < $total_time ) {
				$mysqlper = number_format_i18n( $total_query_time / $total_time * 100, 2 );
				$phpper   = number_format_i18n( $php_time / $total_time * 100, 2 );
			}
			
				$debug_queries .= '<ul>' . "\n";
				$debug_queries .= '<li><strong>' . __( 'Total:' ) . ' ' 
					. count($this->_queries) . ' ' . __( 'queries' ) 
					. '</strong></li>';
				if ( count($this->_queries) != get_num_queries() ) {
					$debug_queries .= '<li><strong>' . __( 'Total:' ) . ' ' 
						. get_num_queries() . ' ' 
						. __( 'num_queries.' ) . '</strong></li>' . "\n";
					$debug_queries .= '<li class="none_list">' 
						. __( '&raquo; Different values in num_query and query? - please set the constant' ) 
						. ' <code>define(\'SAVEQUERIES\', true);</code>' . __( 'in your' ) . ' <code>wp-config.php</code></li>' . "\n";
				}
				$debug_queries .= '</ul>' . "\n";

				$debug_queries .= '<hr /><ol>' . "\n";
				
				// sort queries from high to low
				// use time value in first subquery, array value 1
				if ( ! empty( $sorting ) || ! $sorting )
					usort( $this->_queries, $this->make_comparer([1, $sorting]) );
				
				foreach ( $this->_queries as $q ) {
					
					$time = $q[1];
					$time_ms = number_format( sprintf('%0.1f', $time * 1000), 1, '.', ',' );
					
					if ( '0.5' <= $time_ms )
						$class = ' high_query_time';
					elseif ( '1.' <= $time_ms )
						$class = ' big_query_time';
					else 
						$class = '';
					
					if ( $x % 2 != 0 )
						$class = ' class="default' . $class . '"';
					else
						$class = ' class="alternate' . $class . '"';
					
					$total_query_time += $time;
					$debug_queries .= '<li' . $class . '><ul>';
					$debug_queries .= '<li class="none_list"><strong>' 
						. __( 'Time:' ) . '</strong> ' 
						. $time_ms . __( 'ms' ) 
						. ' (' . $time . __( 's' ) . ')</li>';
					
					if ( isset($q[1]) && ! empty($time) ) {
						$s = nl2br( esc_html( $q[0] ) );
						$s = trim( preg_replace( '/[[:space:]]+/', ' ', $s) );
						$debug_queries .= '<li class="none_list"><strong>' 
							. __( 'Query:' ) . '</strong> <code>' 
							. $s . '</code></li>';
					}
					
					if ( isset($q[2]) && ! empty( $q[2] ) ) {
						
						$st = explode( ', ', $q[2] );
						$st_array = array_diff( $st, self::$replaced_functions );
						
						foreach ( $st_array as $s ) {
							$markup_st[] = '<code>' . esc_html( $s ) . '</code>';
						}
						
						if ( ! STACKTRACE ) {
							$debug_queries .= '<li class="none_list"><strong>Function:</strong> <code>' 
								. end( $st_array ) . '()</code></li>';
						} else {
							$st = implode( ', ', $markup_st );
							$st = str_replace( self :: $replaced_actions, array( 'do_action' ), $st );
							$debug_queries .= '<li class="none_list"><strong>' 
								. '<a href="http://en.wikipedia.org/wiki/Stack_trace">Stack trace</a>:</strong> ' 
								. $st . '</li>';
						}
					}
					
					$debug_queries .= '</ul></li>' . "\n";
					$x++;
				}
				
				$debug_queries .= '</ol>' . "\n\n";
			
			}
			
			if ( ! empty($EZSQL_ERROR) ) {
				$debug_queries .= '<h3>' . __( 'Database Errors' ) . '</h3>';
				$debug_queries .= '<ol>';
	
				foreach ( $EZSQL_ERROR as $e ) {
					$query = nl2br( esc_html( $e['query'] ) );
					$debug_queries .= "<li>$query<br/><div class='qdebug'>{$e['error_str']}</div></li>\n";
				}
				$debug_queries .= '</ol>';
			}
			
			$php_time = $total_time - $total_query_time;
			// Create the percentages
			if ( 0 < $total_time ) {
				$mysqlper = number_format_i18n( $total_query_time / $total_time * 100, 2 );
				$phpper   = number_format_i18n( $php_time / $total_time * 100, 2 );
			}
			
			$debug_queries .= '<ul>' . "\n";
			$debug_queries .= '<li><strong>' . __( 'Total query time:' ) . ' ' 
				. number_format_i18n( sprintf('%0.1f', $total_query_time * 1000), 1 ) 
				. __( 'ms for' ) . ' ' . count($this->_queries) . ' ' . __( 'queries (' ) 
				. number_format_i18n( $total_query_time, 15 ) . __( 's) ' ). '</strong></li>';
			if ( count($this->_queries) != get_num_queries() ) {
				$debug_queries .= '<li><strong>' . __( 'Total num_query time:' ) . ' ' 
					. timer_stop() . ' ' . __( 'for' ) . ' ' . get_num_queries() . ' ' 
					. __( 'num_queries.' ) . '</strong></li>' . "\n";
				$debug_queries .= '<li class="none_list">' 
					. __( '&raquo; Different values in num_query and query? - please set the constant' ) 
					. ' <code>define(\'SAVEQUERIES\', true);</code>' . __( 'in your' ) . ' <code>wp-config.php</code></li>' . "\n";
			}
			if ( $total_query_time == 0 )
				$debug_queries .= '<li class="none_list">' . __( '&raquo; Query time is null (0)? - please set the constant' ) 
					. ' <code>SAVEQUERIES</code>' . ' ' . __( 'at' ) . ' <code>TRUE</code> ' . __( 'in your' ) 
					. ' <code>wp-config.php</code></li>' . "\n";
			if ( 0 < $total_time )
				$debug_queries .= '<li>' . __( 'Page generated in' ). ' ' 
					. number_format_i18n( sprintf('%0.1f', $total_time * 1000), 1 ) . __( 'ms; (' ) 
					. $total_time . __( 's); ' )
					. $phpper . __( '% PHP' ) . '; ' . $mysqlper 
					. __( '% MySQL' ) . '</li>' . "\n";
			$debug_queries .= '</ul>' . "\n";
			
			if ( $echo )
				echo $debug_queries;
			else
				return $debug_queries;
		}
		
	} // end class
}// end if class exists
