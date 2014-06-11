<?php
/*
Plugin Name: České komentáře
Plugin URI: http://blog.doprofilu.cz
Description: Plugin převede všechny řetězce, kde se nachází slovo komentář do správného pádu. v 1.1 Lze nastavit vlastní řetězce.
Version: 1.1
License: GPL
Author: FeniXx
Author URI: http://blog.doprofilu.cz
*/
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
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
