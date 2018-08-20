<?php

class github_contributions{
    public function get_github_contributions( $username ) {
        try{
            $data = http_get( "https://github.com/users/".$username."/contributions" );
            if( parse_contributions( $data ) == "0" ) {
                return ":eyes:";
            }else {
                return ":thumbsup:";
            }
        }catch ( Exception $e ) {
            return $e->getMessage();
        }
    }
    
    function parse_contributions( $data ) {
        $today = date( 'Y-m-d' );
        $html_lines = str_replace( array( "\r\n","\r","\n" ), "\n", $data );
        $lines = explode( "\n", $html_lines );
        $date_data = array();
        foreach ( $lines as $line ) {
            if( preg_match("/data-date=\"(.*)\"/", $line, $matches ) ){
                $date = $matches[1] ;
                if( preg_match("/data-count=\"([0-9]+)\"/", $line, $matches ) ) {
                    $data = intval( $matches[1] );
                    $date_data += array( $date => $data );
                }
            }
        }
        return $date_data;
    }

    function show_contributions() {
        echo "username:";
        $username = trim( fgets( STDIN ) );  
        $array_contributions = $this->get_github_contributions( $username );
        var_dump( $array_contributions );
    }
}