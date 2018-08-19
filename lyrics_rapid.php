<?php 
require "http_get.php";
$time_start = microtime( true );
$doc = new DOMDocument();
$lyrics = new lyrics();
$artist = $argv[1];
$song = $argv[2];
$html = $lyrics->get_lyrics( $artist , $song );
$lyrics_array = $lyrics->parse_lyrics_html( $html );
$lyrics->show_lyrics( $lyrics_array );

$time = microtime( true ) - $time_start;
echo "{$time} 秒";
class lyrics extends DOMDocument{
    /**
     * get_lyrics
     *
     * @access public
     * @param string $artist
     * @param array $song
     * @return array string
     */
    function get_lyrics( string $artist , string $song ) {
        try{
            $url = 'https://www.azlyrics.com/lyrics/'.$artist.'/'.$song.'.html';
            $data = http_get( $url );
            return $data;
        }catch ( Exception $e ) {
            echo $e->getMessage();
        }
    }

    const head_comment = '<!-- Usage of azlyrics.com content by any third-party lyrics provider is prohibited by our licensing agreement. Sorry about that. -->';
    const footer_comment = '<!-- MxM banner -->';

    /**
     * parse_lyrics_html
     *
     * @access public
     * @param array string
     * @return array string
     */

    function parse_lyrics_html( string $html_content ){
        $html_lines = str_replace( array( "\r\n","\r","\n" ), "\n", $html_content );
        $lyrics_lines = firstStringBetween( $html_lines, self::head_comment, self::footer_comment );
        $lyrics_lines_arrays = explode( "\n", $lyrics_lines );
        foreach ( $lyrics_lines_arrays as $line ) {
           $lyrics_array[] = strip_tags( $line );
           if ( empty($v) ) unset( $lyrics_lines_arrays );
        }
        return $lyrics_array;
    }
    /**
     * show_lyrics
     *
     * @access public
     * @param array string
     */

    function show_lyrics( array $array_lyrics ) {
       echo implode( "\n", $array_lyrics) ;
    }
}

function firstStringBetween( $haystack, $start, $end ){
    $char = strpos( $haystack, $start );
    if ( $char === false ) {
        return '';
    }

    $char += strlen( $start );
    $len = strpos( $haystack, $end, $char ) - $char;

    return substr( $haystack, $char, $len );
}

