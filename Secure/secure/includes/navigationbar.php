<?php
  session_start();
  if(!isset($_SESSION['user_token'])) {
    $_SESSION['user_token'] = uniqid();
  }
  if(!isset($_SESSION['failedLogin'])) {
    $_SESSION['failedLogin'] = 0;
  }
  if(!isset($_SESSION['nextLogin'])) {
    $_SESSION['nextLogin'] = time();
  }
?>

<!DOCTYPE html>
<html>
<head>
<style>
body {margin:0;
    font-family: Verdana;
    font-size: 12px;
    color: #444;
  }
ul.topnav {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: #333;
}

ul.topnav li {float: left;}

ul.topnav li a {
  display: inline-block;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  transition: 0.3s;
  font-size: 17px;
}

ul.topnav li a:hover {background-color: #555;}

ul.topnav li.icon {display: none;}

@media screen and (max-width:680px) {
  ul.topnav li:not(:first-child) {display: none;}
  ul.topnav li.icon {
    float: right;
    display: inline-block;
  }
}

@media screen and (max-width:680px) {
  ul.topnav.responsive {position: relative;}
  ul.topnav.responsive li.icon {
    position: absolute;
    right: 0;
    top: 0;
  }
  ul.topnav.responsive li {
    float: none;
    display: inline;
  }
  ul.topnav.responsive li a {
    display: block;
    text-align: left;
  }
}
</style>
</head>
<body>

<ul class="topnav" id="myTopnav">
  <li><a class="active" href="index.php">Home</a></li>
  <li><a href="../products.php">Shop</a></li>
  <?php
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
      echo '<li style="float:right"><a href="../signout.php">Sign out</a></li>';
      echo '<li style="float:right"><a href="">Welcome, '.htmlspecialchars($_SESSION['user'], ENT_QUOTES).'</a></li>';
    } else {
      echo '<li style="float:right"><a href="../signin.php">Sign in</a></li>';
      echo '<li style="float:right"><a href="../signup.php">Sign up</a></li>';
    }
   ?>
</ul>

</body>
</html>
