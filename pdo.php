<?php
require 'db.php';
require 'vendor/autoload.php';
$table = 'test8';
$config = ['settings' => [
    'addContentLengthHeader' => false,
]];
$app = new \Slim\App($config);
$app->add(new \Slim\Middleware\Session([
  'name' => 'my_name',
  'autorefresh' => true,
  'lifetime' => '1 hour'
]));
$app->post('/word_weight',function($request, $response, $args){
    $db_name = $_SESSION['my_name'];
  if ($request->hasHeader('Accept')) {
    $word = $_POST['word'];
    $insert = "insert into $db_name(word) values('$word');";
    try {
        $db = getDB();
        $stmt = $db->query($insert);
        $users = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        $req = $app->request();
    } catch(PDOException $e) {
        echo $e->getMessage();
    }
  }else {
       print_r("get?");
  }
});
$app->post('/word',function($request, $response, $args){
    $db_name = $_SESSION['my_name'];
  if ($request->hasHeader('Accept')) {
    $word = $_POST['word'];
    $w1 = $_POST['w1'];
    $w2 = $_POST['w2'];
    $weight = $w1 * $w2;
    $insert = "insert into $db_name(word,weight) values('$word','$weight');";
    try {
        $db = getDB();
        $stmt = $db->query($insert);
        $users = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        $req = $app->request();
        // print_r($word);
    } catch(PDOException $e) {
        echo $e->getMessage();
    }
  }else {
       print_r("get?");
  }
});

$app->post('/sentence',function($request, $response, $args){
  $db_name = $_SESSION['my_name'];
  $word = $_POST['s'];
  $crate = "CREATE TABLE $db_name LIKE phrasebanks;";
  if ($request->hasHeader('Accept')) {
    $insert = "insert into  $db_name(word) values('$word');";
    try {
        $db = getDB();
        $stmt = $db->query($insert);
        $users = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        $req = $app->request();
    } catch(PDOException $e) {
        echo $e->getMessage();
    }
  }else {
       print_r("get?");
  }
});
$app->get('/table',function($request, $response, $args){
    $sql = "select * from $db_name;";
    try {
        $db = getDB();
        $stmt = $db->query($sql);
        $test = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($test);
    } catch(PDOException $e) {
        echo $e->getMessage();
    }
});

$app->get('/sentence_table',function($request, $response, $args){
    $db_name = $_SESSION['my_name'];
    $sql = "select * from  phrasebank;";
    try {
        $db = getDB();
        $stmt = $db->query($sql);
        $test = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($test);
    } catch(PDOException $e) {
        echo $e->getMessage();
    }
});

$app->get('/count',function($request, $response, $args){
    // $db_name = $_SESSION['my_name'];
    $sql = "SELECT word, COUNT(*) AS Count
    FROM kamimura
    GROUP BY word
    HAVING (COUNT(*) > 1)
    ORDER BY word;";
    try {
        $db = getDB();
        $stmt = $db->query($sql);
        $test = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($test);
    } catch(PDOException $e) {
        echo $e->getMessage();
    }
});

$app->get('/selection',function($request, $response, $args){
  // $db_name = $_SESSION['my_name'];
  $sql = "select * from $db_name;";

  try {
      $db = getDB();
      $stmt = $db->query($sql);
      $test = $stmt->fetchAll(PDO::FETCH_OBJ);
      $db = null;
      $wscoer = null;
      foreach ($test as $a) {
         $array = json_decode(json_encode($a), true);
        // print_r($array);
        if($array['weight']==4){
          $array['weight'] = 8;
        }
        if($array['word'] !="from"){
          if($array['word'] != " " || $array['word'] !=null){
           if(isset($wsocer[$array['word']])){
                   $wsocer[$array['word']] = $wsocer[$array['word']] + 1;
                   // $wsocer[$array['word']] = $wsocer[$array['word']] + $array['weight'];
                  }else{
                    // $wsocer[$array['word']] = $array['weight'];
                    $wsocer[$array['word']] = 1;
                  }
          }
       }
      }
      arsort($wsocer);
      echo json_encode($wsocer);
      $ssocer = null;
      foreach ($wsocer as  $w => $s) {
         // $array = json_decode(json_encode($w), true);
         $db = getDB();
         $selected=" " . $w . " ";
         $sql2 = "SELECT DISTINCT word
               from academic
               where word like '%$selected%'";
         $stmt = $db->prepare($sql2);
         $stmt->execute(array($selected));
         $test2 = $stmt->fetchAll(PDO::FETCH_COLUMN,0);
         $db = null;
         foreach ($test2 as $sentence) {
           if($sentence != " " || $sentence !=null){
            if(isset($ssocer[$sentence])){
              $ssocer[$sentence]= $ssocer[$sentence] + $s;
            }else{
              $ssocer[$sentence] = $s;
            }
          }
        }
      }
      arsort($ssocer);
      $question=array_keys($ssocer);
      // echo json_encode($question);
      // echo json_encode($ssocer);
  } catch(PDOException $e) {
      echo $e->getMessage();
  }
});




$app->post('/name',function($request, $response, $args){
  echo "hoge";
  //
  $name = $_POST['s'];
  $_SESSION['my_name'] = $name;
  $value =  $_SESSION['my_name'];
  $db_name = $_SESSION['my_name'];
  // // $crate = "CREATE TABLE $db_name LIKE phrasebank;";
  $crate = "CREATE TABLE $db_name(
    id INT(2) NOT NULL AUTO_INCREMENT,
    word VARCHAR(64),
    weight INT(2),
    PRIMARY KEY (id))";
  $db = getDB();
  $stmt = $db->query($crate);
  $users = $stmt->fetchAll(PDO::FETCH_OBJ);
  $db = null;
  $req = $app->request();
  // $db_name = $_SESSION['my_name'];
  // $name = "ss";
  // $crate2 = "CREATE TABLE $ss LIKE phrasebank;";
  // $db = getDB();
  // $stmt = $db->query($crate2);
  // $users = $stmt->fetchAll(PDO::FETCH_OBJ);
  // $db = null;
  // $req = $app->request();
});

$app->post('/result',function($request, $response, $args){
    $result = $_POST['r'];
   $insert = "insert into result(word) values('$result');";
    $db = getDB();
    $stmt = $db->query($crate);
    $db = null;

});


$app->run();
