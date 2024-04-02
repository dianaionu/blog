<?php
session_start();

define('ROOT_PATH',  dirname(__FILE__));
define('BASE_URL',  'http://localhost/php-blog/');

//db connect
$conn = mysqli_connect('localhost','root', '', 'blog_db');

if(!$conn) {
    die('cannot connect');
}
?>