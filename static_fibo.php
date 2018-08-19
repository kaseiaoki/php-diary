
<?php

function fibonacci( $n ){
    
    if ($n == 0 or $n == 1) {
        return 1;
    }

    return fibonacci( $n - 1 ) + fibonacci( $n - 2 );
}

function fibonacci2( $n ) {
    static $result = [];
    if ( isset( $result[$n] ) ) {
        return $result[$n];
    }

    if ( $n == 0 or $n == 1 ) {
        return 1;
    }

    $result[$n] = fibonacci2( $n - 1 ) + fibonacci2( $n - 2 );

    return $result[$n];
}

function testFunc(){
    static $num = 0;
    $num++;
    echo __FUNCTION__ . $num . PHP_EOL;
}

class Test1{
    public static function testStaticMethod()
    {
        static $num = 0;
        $num++;
        echo __METHOD__ . $num . PHP_EOL;
    }
}

Test1::testStaticMethod();
Test1::testStaticMethod();
Test1::testStaticMethod();

class Test1{
	public static function count1(){
		$num = 0;
		++$num;
		return $num;
	}
	public static function count2(){
		static $num = 0;
		++$num;
		return $num;
	}
}