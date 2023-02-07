<?php


use controller\Controller;
require_once 'autoload.php';
//echo '<pre>'; print_r(implode('-----',array_keys($_POST))); echo '</pre>';
//echo implode(',', array_keys($_POST));
//echo implode(",", $_POST);

$controller = new Controller;
$controller->handleRequest();
//print_r($rs);
?>