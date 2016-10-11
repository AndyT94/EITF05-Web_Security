<?php
class Database {

  public function signup($user, $home_a, $salt, $pass){
    $connection = mysqli_connect('localhost','Admin','password','Eitf05') or die ('Could not connect');
    $connection->query("INSERT INTO Users (username, homeaddress,salt,password) VALUES ('$user', '$home_a', '$salt', '$pass')");
//    $stmt = $connection->prepare("INSERT INTO Users (username, homeaddress,salt,password) VALUES (?, ?, ?, ?)");
//    $stmt->bind_param('ssss', $user, $home_a, $salt, $pass);
//    $stmt -> execute();
  }

  public function getallProducts(){
    $connection = mysqli_connect('localhost','Admin','password','Eitf05') or die ('Could not connect');
    $stmt = $connection->query("SELECT * FROM products");
//    $stmt = $connection->prepare("SELECT * FROM products");
//    $stmt->execute();
    return $stmt;
  }

  public function hasUser($user) {
    $connection = mysqli_connect('localhost','Admin','password','Eitf05') or die ('Could not connect');
    $stmt = $connection->query("SELECT * FROM Users WHERE username='$user'");
//    $stmt = $connection->prepare("SELECT * FROM Users WHERE username=?");
//    $stmt->bind_param('s', $user);
//    $stmt->execute();
    return mysqli_num_rows($stmt) > 0;
  }

  public function isAuthenticated($user, $pass) {
    $connection = mysqli_connect('localhost','Admin','password','Eitf05') or die ('Could not connect');
    $res = $connection->query("SELECT salt FROM Users WHERE username COLLATE latin1_general_cs ='$user'");
  //  $stmt->bind_param('s', $user);
  //  $stmt->execute();
//    $res = $stmt->get_result();
    if(mysqli_num_rows($res) > 0) {
//      $hashedPass = hash('sha256',$res->fetch_row()[0].$pass);
      $stmt = $connection->query("SELECT * FROM Users WHERE username='$user' AND password='$pass'");
//      $stmt->bind_param('ss', $user, $hashedPass);
  //    $stmt->execute();
      return mysqli_num_rows($stmt) > 0;
    } else {
      return false;
    }
  }

  public function getIDProduct($id) {
    $connection = mysqli_connect('localhost','Admin','password','Eitf05') or die ('Could not connect');
    $stmt = $connection->query("SELECT * FROM products WHERE id_product='$id'");
//    $stmt = $connection->prepare("SELECT * FROM products WHERE id_product=?");
//    $stmt->bind_param('i', $id);
//    $stmt->execute();
    return $stmt;
  }

  public function getallComments(){
    $connection = mysqli_connect('localhost','Admin','password','Eitf05') or die ('Could not connect');
    $stmt = $connection->query("SELECT * FROM comments");
//    $stmt = $connection->prepare("SELECT * FROM comments");
//    $stmt->execute();
    return $stmt;
  }

  public function postComment($text){
    $connection = mysqli_connect('localhost','Admin','password','Eitf05') or die ('Could not connect');
    $connection->query("INSERT INTO comments (text) VALUES ('$text')");
    //$stmt = $connection->prepare("INSERT INTO comments(text) VALUES(?)");
    //$stmt->bind_param('s',$text);
    //$stmt->execute();

  }
}
 ?>
