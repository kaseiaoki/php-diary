<?php 
require "http_get.php";
echo "username:";
$username = trim( fgets( STDIN ) );  
try{
    $data = http_get( "https://github.com/users/".$username."/contributions" );
    if( parse_contributions( $data ) == "0" ) {
        echo ":eyes:";
    }else {
        echo ":thumbsup:";
    }
}catch ( Exception $e ) {
    echo $e->getMessage();
}

function parse_contributions( $data ) {
    $today = date( 'Y-m-d' );
    $html_lines = str_replace( array( "\r\n","\r","\n" ), "\n", $data );
    $lines = explode( "\n", $html_lines );
    foreach ( $lines as $line ) {
        if ( preg_match("/data-count=\"([0-9]+)\" data-date=\"$today\"/", $line, $matches) ) {
            return $matches[1];
        }
    }
}

function first_string_between( $str, $start, $end ){
    $char = strpos( $str, $start );
    if ( $char === false ) {
        return '';
    }
    $char += strlen( $start );
    $len = strpos( $str, $end, $char ) - $char;
    return substr( $str, $char, $len );
}

