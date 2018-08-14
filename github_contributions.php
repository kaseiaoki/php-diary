<?php 
require "http_get.php";
echo "username:";
$username = trim( fgets( STDIN ) );  
try{
    $data = http_get( "https://github.com/users/".$username."/contributions" );
    switch ( parse_contributions( $data ) ) {
        case 0:
            echo ":eyes:";
            break;
        case 1:
            echo "::thumbsup:";
            break;
    }
}catch ( Exception $e ) {
    echo $e->getMessage();
}

function parse_contributions( $data ) {
    $today = date( 'Y-m-d' );
    $html_lines = str_replace( array( "\r\n","\r","\n" ), "\n", $data );
    $lines = explode( "\n", $html_lines );
    foreach ( $lines as $line ) {
       if( preg_match( "/.$today./" ,$line ) ){   
        return first_string_between( $line, 'data-count="', '"' );
       }
    }
}

function first_string_between( $haystack, $start, $end ){
    $char = strpos( $haystack, $start );
    if ( $char === false ) {
        return '';
    }
    $char += strlen( $start );
    $len = strpos( $haystack, $end, $char ) - $char;
    return substr( $haystack, $char, $len );
}