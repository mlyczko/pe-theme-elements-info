<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

/**
 * Plugin Name: PE Theme Elements Info - get info about sidebars and widgets types
 * Plugin URI: http://pixelemu.com
 * Description: Get info about visible sidebars and widgets types and easily find them in the dashboard in <a href="widgets.php">Appearance -> Widgets</a>
 * Version: 1.0
 * Author: pixelemu.com
 * Author URI: http://www.pixelemu.com
 * Text Domain: pe-check
 * License: http://www.pixelemu.com/license.html PixelEmu Proprietary Use License
 */

if ( !class_exists ( 'PEthemeElementsInfo' ) ) {
	class PEthemeElementsInfo {
		
		static $url;
		
		function __construct() {
			self::$url   = plugin_dir_url( __FILE__ );
			add_action( 'widgets_init', array($this, 'pe_sidebars_check'),999999 );
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue' ) );
			add_action( 'wp_enqueue_scripts', array( $this, 'styles' ) );
		}

		/**
		 * Add scripts
		 */
		public function enqueue() {
			if( ! is_admin() ) {
				//head
				wp_enqueue_script( 'pe-theme-elements-info', self::$url . 'script.js', array('jquery'), false );
			}
		}
		
		/**
		 * Add styles
		 */
		public function styles() {
			if ( !is_admin() ) {
	
				wp_enqueue_style( 'pe-theme-elements-info',  self::$url . 'css/pe-theme-elements-info.css', array(), '1.0' );
				if ( ! (wp_style_is('all.css') ) ) {
					wp_enqueue_style( 'font-awesome-all',  self::$url . 'css/font-awesome/all.css', '', '5.8.1' );
				}
				if ( ! (wp_style_is('v4-shims.css') ) ) {
					wp_enqueue_style( 'font-awesome-v4-shims',  self::$url . 'css/font-awesome/v4-shims.css', '', '5.8.1' );
				}
	
			}
		}
		
		public function pe_sidebars_check() {
			if ( !is_admin() && current_user_can('administrator') ) {
			foreach ( $GLOBALS['wp_registered_sidebars'] as $sidebar ) {
				unregister_sidebar( $sidebar['id'] );
			    register_sidebar( array(
			        'name' => __( $sidebar['id'], 'theme-slug' ),
			        'id' => $sidebar['id'],
			        'before_widget' => '<div id="%1$s" class="widget pe-widget pe-theme-elements-info %2$s">' .
			        '<span class="pe-theme-elements-info-code">
			        	<i class="fa fa-info-circle" aria-hidden="true"></i>
			        	<span class="pe-theme-elements-info-content">
				        	<label>Sidebar:</label> ' . $sidebar['name'] . '<br /> 
				        	<label>Type:</label>
				        	<span class="pe-theme-elements-info-type"></span>
			        	</span>
			        </span>',
					'after_widget'  => '</div>',
					'before_title'  => '<h3 class="pe-title">',
					'after_title'   => '</h3>'
			    ) );
			}
		}
	  }
	}
}
new PEthemeElementsInfo(); ?>