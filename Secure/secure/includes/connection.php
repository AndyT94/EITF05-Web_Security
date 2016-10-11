<?php
class Database {

  public function signup($user, $home_a, $salt, $pass){
    $config = parse_ini_file('../private/config.ini');
    $connection = mysqli_connect($config['servername'], $config['username'], $config['password'], $config['dbname']) or die ('Could not connect');
    $stmt = $connection->prepare("INSERT INTO Users (username, homeaddress,salt,password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param('ssss', $user, $home_a, $salt, $pass);
    $stmt -> execute();
  }

  public function getallProducts(){
    $config = parse_ini_file('../private/config.ini');
    $connection = mysqli_connect($config['servername'], $config['username'], $config['password'], $config['dbname']) or die ('Could not connect');
    $stmt = $connection->prepare("SELECT * FROM products");
    $stmt->execute();
    return $stmt->get_result();
  }

  public function hasUser($user) {
    $config = parse_ini_file('../private/config.ini');
    $connection = mysqli_connect($config['servername'], $config['username'], $config['password'], $config['dbname']) or die ('Could not connect');
    $stmt = $connection->prepare("SELECT * FROM Users WHERE username=?");
    $stmt->bind_param('s', $user);
    $stmt->execute();
    return mysqli_num_rows($stmt->get_result()) > 0;
  }

  public function isAuthenticated($user, $pass) {
    $config = parse_ini_file('../private/config.ini');
    $connection = mysqli_connect($config['servername'], $config['username'], $config['password'], $config['dbname']) or die ('Could not connect');
    $stmt = $connection->prepare("SELECT salt FROM Users WHERE username=?");
    $stmt->bind_param('s', $user);
    $stmt->execute();
    $res = $stmt->get_result();
    if(mysqli_num_rows($res) > 0) {
      $hashedPass = hash('sha256',$res->fetch_row()[0].$pass);
      $stmt = $connection->prepare("SELECT * FROM Users WHERE username=? AND password=?");
      $stmt->bind_param('ss', $user, $hashedPass);
      $stmt->execute();
      return mysqli_num_rows($stmt->get_result()) > 0;
    } else {
      return false;
    }
  }

  public function getIDProduct($id) {
    $config = parse_ini_file('../private/config.ini');
    $connection = mysqli_connect($config['servername'], $config['username'], $config['password'], $config['dbname']) or die ('Could not connect');
    $stmt = $connection->prepare("SELECT * FROM products WHERE id_product=?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    return $stmt->get_result();
  }

  public function getallComments(){
    $config = parse_ini_file('../private/config.ini');
    $connection = mysqli_connect($config['servername'], $config['username'], $config['password'], $config['dbname']) or die ('Could not connect');
    $stmt = $connection->prepare("SELECT * FROM comments");
    $stmt->execute();
    return $stmt->get_result();
  }

  public function postComment($text){
    $config = parse_ini_file('../private/config.ini');
    $connection = mysqli_connect($config['servername'], $config['username'], $config['password'], $config['dbname']) or die ('Could not connect');
    $stmt = $connection->prepare("INSERT INTO comments(text) VALUES(?)");
    $stmt->bind_param('s',$text);
    $stmt->execute();

  }
}
 ?>
