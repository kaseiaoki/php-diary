<?php
 
// $url = 'http://www8.cao.go.jp/chosei/shukujitsu/sonzaisinai.csv';
//

function try_file_get_contents( $url ){

    set_error_handler( function( $severity, $message, $file, $line ) {
        throw new ErrorException( $message, 0, $severity, $file, $line) ;
    } );

    try{
        file_get_contents( $url );
    }catch ( Exception $e ) {
        echo $e->getMessage();
    }

    restore_error_handler();
}
