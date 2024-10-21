<?php
session_start();
include_once("configuration/Configuration.php");
$configuration = new Configuration();
$router = $configuration->getRouter();
echo "<script>console.log('-------principio index--------');</script>";

$rout = isset($_GET['action']) ? $_GET['action'] : " ";
$rout1 = isset($_GET['page']) ? $_GET['page'] : " ";

$router->route($rout1, $rout);

echo "<script>console.log('-------fin index-------');</script>";
