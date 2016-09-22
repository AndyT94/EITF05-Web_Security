<?php
class Database {

  public function signup($user, $home_a, $salt, $pass){
    $connection = mysqli_connect('localhost','Admin','password','Eitf05') or die ('Could not connect');
    $stmt = $connection->prepare("INSERT INTO Users (username, homeaddress,salt,password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param('ssss', $user, $home_a, $salt, $pass);
    $stmt -> execute();
  }

  public function getallProducts(){
    $connection = mysqli_connect('localhost','Admin','password','Eitf05') or die ('Could not connect');
    $stmt = $connection->prepare("SELECT * FROM products");
    $stmt->execute();
    return $stmt->get_result();
  }

  public function hasUser($user) {
    $connection = mysqli_connect('localhost','Admin','password','Eitf05') or die ('Could not connect');
    $stmt = $connection->prepare("SELECT * FROM Users WHERE username=?");
    $stmt->bind_param('s', $user);
    $stmt->execute();
    return mysqli_num_rows($stmt->get_result()) > 0;
  }

  public function isAuthenticated($user, $pass) {
    $connection = mysqli_connect('localhost','Admin','password','Eitf05') or die ('Could not connect');
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
    $connection = mysqli_connect('localhost','Admin','password','Eitf05') or die ('Could not connect');
    $stmt = $connection->prepare("SELECT * FROM products WHERE id_product=?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    return $stmt->get_result();
  }
}
 ?>
