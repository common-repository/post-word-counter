<?php
namespace PostWordCounter\Frontend;

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Post_Word_Counter
 * @subpackage Post_Word_Counter/public
 * @author     Mrinal Haque <mrinalhaque99@gmail.com>
 */
class Frontend {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.1
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.1
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    	1.1
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.1
	 */
	public function enqueue_styles() {

		/**
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		// wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'assets/css/wp-admin-vue.build.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.1
	 */
	public function enqueue_scripts() {

		/**
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		// wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'assets/js/wp-admin-vue.build.js', array( 'jquery' ), $this->version, false );

	}

	/**
     * Condition to show the statistics.
     * @param mixed $content
     */
    public function is_pwc_content( $content ) {

        if ( is_main_query() AND is_single() AND 
        ( get_option( 'pwc_word_count', '1' ) OR 
        get_option( 'pwc_character_count', '1' ) OR 
        get_option( 'pwc_read_time', '1' ) ) ) {
            return $this->pwc_content_show( $content );
        }
        return $content;
    }

	/**
     * Statistics show on the single page content.
     * @param mixed $content
     */
    public function pwc_content_show( $content ) {

        $html = '<div class="pwc-content-wrap"><h3>'. get_option( 'pwc_headline', esc_html__( 'Information', 'pwc' ) ) .'</h3><p>';

        /**
         * Count words when word count checkbox or read time checkbox on. 
         * Any option need to count word
         */
        if ( get_option( 'pwc_word_count', '1' ) OR get_option( 'pwc_read_time', '1' ) ) {
            $word_count = str_word_count( strip_tags( $content ) );
        }
        
        // Add word count
        if ( get_option( 'pwc_word_count', '1' ) ) {
            $word_counter_prefix = apply_filters( 'pwc_word_counter_prefix', get_option( 'pwc_word_counter_prefix', __( 'Words:', 'pwc' ) ) );
            $word_counter_postfix = apply_filters( 'pwc_word_counter_postfix', get_option( 'pwc_word_counter_postfix', '' ) );

            if ( strlen( get_option( 'pwc_word_filter' ) ) > 0 ) {
                $word_filters = preg_split( '/\r\n|\r|\n/', get_option( 'pwc_word_filter' ) );
                $word_filters = array_filter( $word_filters );
                $word_filters_length = count( $word_filters );

                $filtered_content = '';
                if ( $word_filters_length > 0 ) {
                    foreach ( $word_filters as $word_filter ) {
                        $filtered_content .= str_replace( $word_filter, ' ', strip_tags( $content ) );
                    }
                }

                $filtered_word_count = str_word_count( $filtered_content );
                $html .= $word_counter_prefix . ' <span>' . $filtered_word_count . '</span> ' . $word_counter_postfix . '<br/>';
            } else {
                $html .= $word_counter_prefix . ' <span>' . $word_count . '</span> ' . $word_counter_postfix . '<br/>';
            }
            
        }

        // Add character count
        if ( get_option( 'pwc_character_count', '1' ) ) {
            $character_counter_prefix = apply_filters( 'pwc_character_counter_prefix', get_option( 'pwc_character_counter_prefix', __( 'Characters:', 'pwc' ) ) );
            $character_counter_postfix = apply_filters( 'pwc_character_counter_postfix', get_option( 'pwc_character_counter_postfix', '' ) );
            $character_count = strlen( strip_tags( $content ) );
            $html .= $character_counter_prefix . ' <span>' . $character_count . '</span> ' . $character_counter_postfix . '<br/>';
        }

        // Add read time
        if ( get_option( 'pwc_read_time', '1' ) ) {
            $read_time_prefix = apply_filters( 'pwc_read_time_prefix', get_option( 'pwc_read_time_prefix', __( 'Reading time:', 'pwc' ) ) );
            $read_time_postfix = apply_filters( 'pwc_read_time_postfix', get_option( 'pwc_read_time_postfix', '' ) );
            $read_time = ceil( $word_count / get_option( 'pwc_read_time_per_minute', '225' ) );
            $html .= $read_time_prefix . ' <span>' . $read_time . '</span> ' . $read_time_postfix;
        }
        
        $html  .= '</p></div>';

        // Show statistics at desired location
        if ( get_option( 'pwc_location', '0' ) === '0' ) {
            return $html . $content; 
        }
        return $content . $html;
    }

}
