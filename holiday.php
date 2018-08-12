<?php
require 'http_get.php';
$today = date( 'Y-m-d' );
$is_holiday = is_Holidays( $today ) ? "yes" : "no";

print_r( $is_holiday );

/**
 * is_Holidays
 *
 * @access public
 * @param string date
 * @return bool
 * @see http_get.php
 */

function is_Holidays( $day ) {
  $url = 'http://www8.cao.go.jp/chosei/shukujitsu/syukujitsu_kyujitsu.csv';
  $data = http_get( $url );

  $data_utf8 = mb_convert_encoding( $data, 'UTF-8', 'SJIS' );
  var_dump( $data_utf8 );
  $data_lf = str_replace( array( "\r\n","\r","\n" ), "\n", $data_utf8 );
  $lines = explode( "\n", $data_lf );

  foreach ( $lines as $line ) {
    $columns = explode( ",", $line );
    $holiday = trim( $columns[0] );
    if( $holiday == $day ) {
        return true;
    }
  }
  return false;
}