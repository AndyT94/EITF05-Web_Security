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
}
 ?>
