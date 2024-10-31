<?php
/**
* Plugin Name: Post Word Counter
* Plugin URI: https://mrinalbd.com
* Description: An intuitive and attractive system to show the statistics about post.
* Author: Mrinal Haque
* Author URI: https://mrinalbd.com/
* Version: 1.1
* License: GPLv3
* License URI: https://www.gnu.org/licenses/old-licenses/gpl-3.0.html
* Text Domain: pwc
* Domain Path: /languages
*/
/*
Post Word Counter is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
any later version.

Post Word Counter is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with Post Word Counter.
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
    exit;
}

/**
 * Define plugin constants
 */
define( 'PWC_MAIN_FILE', __FILE__ );
define( 'PWC_VERSION', '1.1' );
define( 'PWC_TEXTDOMAIN', 'pwc');

function activation() {
	require plugin_dir_path( __FILE__ ) . 'includes/Activator.php';
	PostWordCounter\Includes\Activator::activate();
}
function deactivation() {
	require plugin_dir_path( __FILE__ ) . 'includes/Deactivator.php';
	PostWordCounter\Includes\Deactivator::deactivate();
}
register_activation_hook( __FILE__, 'activation' );
register_deactivation_hook( __FILE__, 'deactivation' );

add_action( 'init', function(){
	if ( ! defined( 'Post_Word_Counter_Plugin_Loaded' ) ) {
		require plugin_dir_path( __FILE__ ) . 'includes/Controller.php';
		new PostWordCounter\Includes\Controller();
    }
});