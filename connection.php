<?php

class Database {
private $connection;



public function signup($user,$home_a,$salt,$pass){
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

}

 ?>
