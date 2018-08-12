<?php 
// dirname(__FILE__) は以下の記述がされたファイルが存在するディレクトリの絶対パスを取得する
// DIRECTORY_SEPARATOR は OS ごとのデリミタを解決
// 以下の例だと以下の記述がされたファイルの2つ上のディレクトリを表している
$path = dirname(__FILE__).DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..";
// $path だけだと ".." がそのままの文字列として出てしまうので realpath() で変換する
$rpath = new Dotenv\Dotenv(realpath($dotfile));