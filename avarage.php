<?php

$one = 1;
$two = 2;
$three =3;

print_r( average( $one, $two , $three ) );
print_r( median( $one, $two , $three ) );
/**
 * show_average
 * @param $item int 
 * @return int
 */
function average( ...$items ){
    if(count( $items ) === 0 ){
        return 0;
    }else {
        return array_sum( $items ) / count( $items );
    }
}

 function median( ...$item ){
    sort( $item );
    if (count( $item ) % 2 == 0){
        return ( ( $item [ ( count( $item )/ 2 ) -1 ] + $item[ ( ( count( $item ) /2 ) ) ] ) /2 );
    }else{
        return ( $item[ floor( count( $item )/2 ) ] );
    }
}