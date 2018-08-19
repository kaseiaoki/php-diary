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

    public $head_coment = '<!-- Usage of azlyrics.com content by any third-party lyrics provider is prohibited by our licensing agreement. Sorry about that. -->';
    public $footer_coment = '<!-- MxM banner -->';

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
            if ( strpos( $line, $this->head_coment ) !== false )  $lyrics_get_flag = true;
            if ( strpos( $line,$this->footer_coment )!== false )  $lyrics_get_flag = false;
            if( $lyrics_get_flag ) $lyrics_array[] = strip_tags( $line );
        }
        foreach ( $lyrics_array AS $k => $v ) {
            if ( empty($v) ) {
            unset( $lyrics_array[$k] );
            }
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

// ctype_alnum  英数字判定
// ctype_alpha  英字判定
// ctype_cntrl  制御文字判定
// ctype_digit  数字判定
// ctype_graph  空白以外の印字可能文字判定
// ctype_lower  小文字判定
// ctype_print  印字可能文字判定　*空白含む
// ctype_punct  空白及び英数字以外文字判定　*ざっくりいうと記号判定
// ctype_space  空白文字判定　*空白文字なので空白以外にもタブとか改行とかも含まれる
// ctype_upper  大文字判定
// ctype_xdigit 16進数判定
