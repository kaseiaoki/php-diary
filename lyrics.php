<?php 
require "http_get.php";
$doc = new DOMDocument();
$lyrics = new lyrics();
$artist = $argv[1];
$song = $argv[2];
$html = $lyrics->get_lyrics( $artist , $song );
$lyrics_array = $lyrics->parse_lyrics_html( $html );
$lyrics->show_lyrics( $lyrics_array );
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
            $url = "https://www.azlyrics.com/lyrics/".$artist."/".$song.".html";
            $data = http_get( $url );
            return $data;
        }catch ( Exception $e ) {
            echo $e->getMessage();
        }
    }

    public $head_coment = "/<!-- Usage of azlyrics.com content by any third-party lyrics provider is prohibited by our licensing agreement. Sorry about that. -->/";
    public $footer_coment ="/<!-- MxM banner -->/";

    /**
     * parse_lyrics_html
     *
     * @access public
     * @param array string
     * @return array string
     */

    function parse_lyrics_html( string $html_content ){
        $html_lines = str_replace( array( "\r\n","\r","\n" ), "\n", $html_content );
        $lines = explode( "\n", $html_lines );
        $lyrics_array = array();
        $lyrics_get_flag = false;
        foreach ( $lines as $line ) {
            if ( preg_match( $this->head_coment, $line ) )  $lyrics_get_flag = true;
            if ( preg_match( $this->footer_coment, $line ) )  $lyrics_get_flag = false;
            if( $lyrics_get_flag ) $lyrics_array[]=strip_tags( $line );
        }
        return array_filter( $lyrics_array, "strlen" );
    }
    /**
     * show_lyrics
     *
     * @access public
     * @param array string
     */

    function show_lyrics( array $array_lyrics ) {
        print_r( implode( "\n", $array_lyrics) );
    }
}