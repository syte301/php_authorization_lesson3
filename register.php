<?php

session_start();

require "functions.php";

$email = $_POST["email"];
$password = $_POST["password"];

$user = get_user_by_email($email);

if(!empty($user)) {
    set_flash_message("danger", "Этот электронный адрес уже занят другим пользователем.");
      redirect_to("page_register.php");
}

add_user($email, $password);

set_flash_message("success", "Регистрация успешна");

redirect_to("page_login.php");


/*

$email = "jane@example.com";
$password = "secret";

$pdo = new PDO("mysql:host=localhost;dbname=db_auth", "root", "");


$sql =  "SELECT * FROM users WHERE email=:email";
$statement = $pdo->prepare($sql);
$statement->execute(["email" => $email]);
$user = $statement->fetch(PDO::FETCH_ASSOC);

// var_dump($user);die;

if(!empty($user)) {
    $_SESSION["danger"] = "Этот электронный адрес уже занят другим пользователем.";
    header("Location: /php_authorization/page_register.php");
    exit;
}

$sql = "INSERT INTO users (email, password) VALUES (:email, :password)";

$statement = $pdo->prepare($sql);
$statement->execute([
    "email" => $email,
    "password" => password_hash($password, PASSWORD_DEFAULT)
]);


$_SESSION["success"] = "Регистрация успешна";
header("Location: /php_authorization/page_login.php");
exit;
*/
