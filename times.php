<?php
$greet = function( $name ){
    printf("Hello-> %s\r\n", $name);
};
$times = 5;
range_try( $times, $greet );
function range_try( $times, $func ) {
    $range = range( 1, $times );
    foreach ( $range as $number ) {
        $func( $number );
    }
}