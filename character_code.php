<?php
$force_utf8_jp = new force_utf8_jp();
class force_utf8_jp{
    function correct_encoding( $text ) {
        if( mb_check_encoding( $text, 'UTF-8' ) ){
            return $text;
        }else{
            foreach( self::char_code as $code ){
                if( mb_check_encoding( $text, $enc ) ) {
                    $current_encoding = mb_detect_encoding( $text, $enc );
                    $encoded_text = mb_convert_encoding ( $text , 'UTF-8', $current_encoding );
                    return $encoded_text;
                }
                return false;
            }
        }
    }
    const char_code = [
        'UTF-8',
        'UTF-7',
        'ASCII',
        'EUC-JP',
        'eucJP-win',
        'SJIS',
        'SJIS-win',
        'JIS',
        'ISO-2022-JP',
        'Unicode',
        'UTF-16',
        'GBK'
    ];
}