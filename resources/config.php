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

defined("DB_HOST") ? null : define("DB_HOST", "localhost.000webhost.com");

defined("DB_USER") ? null : define("DB_USER","id18386800_janee");

defined("DB_PASS") ? null : define("DB_PASS", "wbgy2ZsBgGXHF%tH");

defined("DB_NAME") ? null : define("DB_NAME",  "id18386800_ymc353");

define("DB_SET_CHARSET", "utf-8");

$db = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);

// if ($db) {
//    echo "Connected!";
//  } else {
//    echo "Connection Failed";
//  }
 
 require_once("functions.php");
?>
