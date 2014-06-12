<?php
/*
Plugin Name:       České komentáře
Plugin URI:        https://github.com/fenix11/ceske-komentare
Description:       A plugin to automatically update GitHub or Bitbucket hosted plugins and themes into WordPress. Plugin class based upon <a href="https://github.com/codepress/github-plugin-updater">codepress/github-plugin-updater</a>. Theme class based upon <a href="https://github.com/WordPress-Phoenix/whitelabel-framework">Whitelabel Framework</a> modifications.
Version:           1.8
Author:            fenixx
License:           GNU General Public License v2
License URI:       http://www.gnu.org/licenses/gpl-2.0.html
Domain Path:       /languages
Text Domain:       ceske-komentare
GitHub Plugin URI: https://github.com/fenix11/ceske-komentare
GitHub Branch:     master
*/
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// Load base classes and Launch
if ( is_admin() && ( ! defined( 'DOING_AJAX' ) || ! DOING_AJAX ) ) {
	if ( ! class_exists( 'GitHub_Updater' ) ) {
		require_once 'includes/class-github-updater.php';
		require_once 'includes/class-github-api.php';
		require_once 'includes/class-bitbucket-api.php';
	}
	if ( ! class_exists( 'GitHub_Plugin_Updater' ) ) {
		require_once 'includes/class-plugin-updater.php';
		new GitHub_Plugin_Updater;
	}
	if ( ! class_exists( 'GitHub_Theme_Updater' ) ) {
		require_once 'includes/class-theme-updater.php';
		new GitHub_Theme_Updater;
	}
}

function pridat() {

    // Activation code here...
	add_option( 'pocet0', 'Žádný komentář', '', 'yes' );
	add_option( 'pocet1', '1 komentář', '', 'yes' );
	add_option( 'pocet2', '% komentáře', '', 'yes' );
	update_option( 'pocet5', '% komentářů', '', 'yes' );
}
register_activation_hook( __FILE__, 'pridat' );

$pocet0=get_option('pocet0');
$pocet1=get_option('pocet1');
$pocet2=get_option('pocet2');
$pocet5=get_option('pocet5');

add_action( 'admin_menu', 'register_my_custom_menu_page' );

function register_my_custom_menu_page(){
    add_menu_page( 'Administrace - české komentáře', 'České komentáře', 'manage_options', 'custompage', 'my_custom_menu_page', 'dashicons-format-status', 59 ); 
}

function my_custom_menu_page(){
echo '<h1>Administrace</h1>';
   include('nastaveni.php');
}

function ceske_komentare($output, $number ){
global $pocet0,$pocet1,$pocet2,$pocet5;
if ( $number == 0) $output = $pocet0;
elseif ($number == 1 )
$output = str_replace('%', number_format_i18n($number), $pocet1);
elseif ($number > 1  and $number < 4 )
$output = str_replace('%', number_format_i18n($number), $pocet2);
else
$output = str_replace('%', number_format_i18n($number), $pocet5);

return $output; } 


add_action('comments_number', 'ceske_komentare', 10, 2);

?>
