<?php

/*

Plugin Name: Quran live

Description: Quran live Multilanguage translated into 29 languages.

Version: 1.0

Author: Karim Bahmed

Author URI: http://gp-codex.fr

*/


	define( 'QURAN_LIVE_PLUGIN_URL', plugin_dir_path( __FILE__ ) );
	define( 'QURAN_LIVE_BASE', plugin_dir_url( __FILE__ ) );
	add_action('admin_menu' , 'quran_live_admin');



	function quran_live_admin(){

		add_menu_page('Quran Live', 'Quran Live', 'activate_plugins', 'quran_live_admin', 'render_quran_live_admin', ''.QURAN_LIVE_BASE.'icon_quranlive.png', 3); 

		add_action( 'admin_init', 'register_quran_live_options' );	

	}
function render_quran_live_admin(){

include('admin/quran-live-admin.php');

}
	function register_quran_live_options() {

	//register our settings

		register_setting( 'quran-live-options', 'quran_live_recitator');

		register_setting( 'quran-live-options', 'quran_live_languages' );
	} 
	function quran_live_install(){
	//DEFAUT OPTIONS COLORS

		add_option( 'quran_live_languages', 'english', '', 'yes' );

		add_option( 'template_quran_live', 'bg_verse2', '', 'yes' );

		add_option('quran_live_recitator', 'Maher_al_me-aqly', '', 'yes');

	}
	function quran_live_uninstall(){

		// delete options

		delete_option('template_quran_live');
		
		delete_option('tpl_quran_live');
		
		delete_option('background_quranlive_color');
		
		delete_option('quran_live_languages');
		
		delete_option('quran_live_recitator');
		
		delete_option('quranlive_custum_css');

		// delete transients
		
	    delete_transient('quranlive-options');
	}	
	//ACTIVATION PLUGIN INSTALL

	register_activation_hook(__FILE__,'quran_live_install'); 

	//DELETE PLUGIN

	register_uninstall_hook(__FILE__, 'quran_live_uninstall'); 	
	
	//LOAD JS FILE
	
	function quranlive_js_scripts() {
		
		wp_enqueue_script( 'loadquranlive', plugin_dir_url(__FILE__).'/template/js/quranlive_load.js', array('jquery'), '1.0', true );
		wp_enqueue_script( 'quranlive_fullscreen', plugin_dir_url(__FILE__).'/template/js/screenfull.js', array('jquery'), '1.0', true );

		wp_localize_script('loadquranlive', 'ajaxurl', admin_url( 'admin-ajax.php' ) );
		wp_localize_script('loadquranlive', 'livequran', array(
			'pluginsUrl' => plugins_url('quran-live')
		));
	}

	add_action('wp_enqueue_scripts', 'quranlive_js_scripts');
	add_action( 'wp_ajax_qtm_quranlive_load', 'qtm_quranlive_load' );
	add_action( 'wp_ajax_nopriv_qtm_quranlive_load', 'qtm_quranlive_load' );
	add_action( 'wp_ajax_qtm_changelivesura', 'qtm_changelivesura' );
	add_action( 'wp_ajax_nopriv_qtm_changelivesura', 'qtm_changelivesura' );

	
	require(''.QURAN_LIVE_PLUGIN_URL.'/inc/Class_QuranLive.php');
	
	require(''.QURAN_LIVE_PLUGIN_URL.'/inc/function_load_verse.php');	
	
	require(''.QURAN_LIVE_PLUGIN_URL.'/inc/functions_parse_xml.php');
	
	add_shortcode('quran_live', 'quran_live_render');

	function quran_live_render($atts) {
		
		$atts = shortcode_atts(array(
				'lang'  => 'english',
				'cheikh' => 'Shuraym'
				), $atts);
		extract($atts);
		
		require(''.QURAN_LIVE_PLUGIN_URL.'/inc/quran_live_styles.php');
		require(''.QURAN_LIVE_PLUGIN_URL.'/template/template.php');
		Render_Quran_Live::load_sura_quran_live($sura=null,$lang,$cheikh);

	}	
	
	