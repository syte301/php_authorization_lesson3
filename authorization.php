<?php
// var_dump($_POST);die;

session_start();
require "functions.php";

$email = $_POST["email"];
$password = $_POST["password"];
// var_dump($email);die;


$login = login($email, $password);
// var_dump($login);die;

if (!$login) {
    redirect_to("page_login.php");
}

// var_dump($_SESSION);die;
redirect_to("users.php");

?>
