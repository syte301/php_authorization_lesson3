<?php

// session_start();

function is_not_logged_in()
{
    if (!isset($_SESSION['email']))
            return true;
        else
            return false;
}

function login($email, $password) {    //loggedIn()
    $pdo = new PDO("mysql:host=localhost;dbname=db_auth", "root", "");

    $sql =  "SELECT * FROM users WHERE email=:email";
    $user = get_user_by_email($email);

    if (empty($user) or !(password_verify($password, $user['password']))) {
    //if (empty($user)) {
        set_flash_message("danger","Такого пользователя не существует");
        // var_dump(set_flash_message());
        return false;
    }
    //authorization user code
    $_SESSION['email'] = $email;
    return true;
}

function get_user_by_email($email) {
  $pdo = new PDO("mysql:host=localhost;dbname=db_auth", "root", "");

  $sql =  "SELECT * FROM users WHERE email=:email";

  $statement = $pdo->prepare($sql);
  $statement->execute(["email" => $email]);
  $user = $statement->fetch(PDO::FETCH_ASSOC);
  //var_dump($user['password']);die;
  return $user;
}

function set_flash_message($name, $message) {
    $_SESSION[$name] = $message;
}

function redirect_to($path) {
    header("Location: {$path}");
    exit;
}

function add_user($email, $password) {
    $pdo = new PDO("mysql:host=localhost;dbname=db_auth", "root", "");

    $sql = "INSERT INTO users (email, password) VALUES (:email, :password)";

    $statement = $pdo->prepare($sql);
    $result = $statement->execute([
        "email" => $email,
        "password" => password_hash($password, PASSWORD_DEFAULT)
    ]);

    return $pdo->lastInsertId();
}

function display_flash_message($name) {
      if(isset($_SESSION[$name])) {
          echo "<div class=\"alert alert-{$name} text-dark\" role=\"alert\">{$_SESSION[$name]}</div>";
          unset($_SESSION[$name]);
      }

}



?>
