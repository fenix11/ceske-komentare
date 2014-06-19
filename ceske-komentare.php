<?php
/*
Plugin Name:       České komentáře
Plugin URI:        https://github.com/fenix11/ceske-komentare
Description:       Plugin automaticky správně nastaví skloňování českých komentářů na webu.
Version:           1.0
Author:            fenixx
Author URI:        http://blog.doprofilu.cz
License:           GNU General Public License v2
License URI:       http://www.gnu.org/licenses/gpl-2.0.html
Domain Path:       /jazyky
Text Domain:       ceske-komentare
GitHub Plugin URI: https://github.com/fenix11/ceske-komentare
GitHub Branch:     master
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
