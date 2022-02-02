<?php 

// ob_start();

session_start();
// session_destroy();

defined("DS") ? null : define("DS", DIRECTORY_SEPARATOR);

defined("TEMPLATE") ? null : define("TEMPLATE", __DIR__ . DS . "templates");


// defined("DB_HOST") ? null : define("DB_HOST", "ymc353.encs.concordia.ca");
// 
// defined("DB_USER") ? null : define("DB_USER","ymc353_2");
// 
// defined("DB_PASS") ? null : define("DB_PASS", "AbcdE123");
// 
// defined("DB_NAME") ? null : define("DB_NAME",  "ymc353_2");

defined("DB_HOST") ? null : define("DB_HOST", "ec2-44-195-16-34.compute-1.amazonaws.com");

defined("DB_USER") ? null : define("DB_USER","eyhhpnihwnhsvr");

defined("DB_PASS") ? null : define("DB_PASS", "2926bca9fa22a7f9428896d38eb91a728c2e3264dead404ff67c1612ffef3237");

defined("DB_NAME") ? null : define("DB_NAME",  "d92ptmmvlfb5jc");

define("DB_SET_CHARSET", "utf-8");

$db = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);

// if ($db) {
//    echo "Connected!";
//  } else {
//    echo "Connection Failed";
//  }
 
 require_once("functions.php");
?>
