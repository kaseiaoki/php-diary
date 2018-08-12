<?php 
/**
 * http_Get
 *
 * @access public
 * @param string url
 * @return 
 * @see holiday.php ..etc
 */
function http_get($url)
{
    $option = [
        CURLOPT_RETURNTRANSFER => true, 
    ];

    $curl = curl_init( $url );
    curl_setopt_array( $curl, $option );

    $data = curl_exec($curl);
    $info = curl_getinfo($curl);

    if ( $info['http_code'] !== 200 ) {
        return false;
    } else {
        return $data;
    }
}