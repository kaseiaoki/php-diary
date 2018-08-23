<?php
$greet = function(){
    printf("Hello\r\n");
};
$test = 'test';
$times = 5;

$range_try = new range_try();
$range_try->range_try_function( $times, $greet );
$range_try->range_try_function( $times, function () { 
    echo 'Hello'."\n"; 
});
class range_try {
    function range_try_function( $times, $func ) {
        $range = range( 1, $times );
        foreach ( $range as $number ) {
            $func();
        }
    }
}