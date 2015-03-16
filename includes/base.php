<?php
/**
 * A base plugin for all CFO plugins to extend from
 *
 * from danielbachhuber
 *
 * 1) To use, simply create your own plugin that extends this class.
 * 2) You can define 'setup_globals', 'includes', 'setup_actions' methods to perform each step.
 * 3) Lastly, at the end of your plugin file, load the plugin with some code like this:
 *
 * function A_Plugin() {
 *     return A_Plugin::get_instance();
 * }
 * add_action( 'plugins_loaded', 'A_Plugin' );
 */
if (!class_exists('A_Plugin')){
  class A_Plugin {
  	protected $data;
  	protected static $instances;
  	public static function get_instance() {
  		$class = get_called_class();
  		if ( ! isset( static::$instances[$class] ) ) {
  			$instance = new $class;
  			// Standard setup methods
  			foreach( array( 'setup_globals', 'includes', 'setup_actions' ) as $method ) {
  				if ( method_exists( $instance, $method ) )
  					$instance->$method();
  			}
  			self::$instances[$class] = $instance;
  		}
  		return self::$instances[$class];
  	}
  	private function __construct() {
  		/** Prevent the class from being loaded more than once **/
  	}
  	public function __isset( $key ) {
  		return isset( $this->data[$key] );
  	}
  	public function __get( $key ) {
  		return isset( $this->data[$key] ) ? $this->data[$key] : null;
  	}
  	public function __set( $key, $value ) {
  		$this->data[$key] = $value;
  	}
  	/**
  	 * Get a given view (if it exists)
  	 *
  	 * @param string     $view      The slug of the view
  	 * @return string
  	 */
  	public function get_view( $view, $vars = array() ) {
  		if ( isset( $this->template_dir ) )
  			$template_dir = $this->template_dir;
  		else
  			$template_dir = $this->plugin_dir . '/inc/templates/';
  		$view_file = $template_dir . $view . '.tpl.php';
  		if ( ! file_exists( $view_file ) )
  			return '';
  		extract( $vars, EXTR_SKIP );
  		ob_start();
  		include $view_file;
  		return ob_get_clean();
  	}
  }
}