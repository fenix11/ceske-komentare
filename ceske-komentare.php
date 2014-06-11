<?php
/*
Plugin Name: České komentáře
Plugin URI: http://blog.doprofilu.cz
Description: Plugin převede všechny řetězce, kde se nachází slovo komentář do správného pádu.
Version: 1.0
License: GPL
Author: FeniXx
Author URI: http://blog.doprofilu.cz
*/
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

function ceske_komentare($output, $number){ if ( $number == 0) $output = 'Žádný komentář';
elseif ($number == 1 )
$output = str_replace('%', number_format_i18n($number), '% komentář');
elseif ($number > 1  and $number < 4 )
$output = str_replace('%', number_format_i18n($number), '% komentáře');
else
$output = str_replace('%', number_format_i18n($number), '% komentářů');

return $output; } 


add_action('comments_number', 'ceske_komentare', 10, 2);

?>
