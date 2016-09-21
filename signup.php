<?php
  require("includes/connection.php");
  require("includes/navigationbar.php");
?>

<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" href="css/style.css" />
   <title>Sign-Up</title>
 </head>
  <body id="body-color">
    <div id="Sign-Up">
       <fieldset style="width:30%"><legend>Registration Form</legend>
         <table border="0">
           <tr>
             <form method="POST" action= "signup.php">
                <td>UserName</td><td> <input type="text" name="user" required ></td>
              </tr>
              <tr>
                <td>Home Address</td><td> <input type="text" name="homeaddress" required ></td>
              </tr>
              <tr>
                <td>Password</td><td> <input type="password" name="pass" required ></td>
              </tr>
              <tr>
                <td>Confirm Password </td><td><input type="password" name="cpass" required ></td>
              </tr>
              <tr>
                <td><input id="button" type="submit" name="submit" value="Sign-Up" required></td>
              </tr>
          </form>
        </table>
      </fieldset>
        <?php
          if(isset($_POST['submit'])){
            if($_POST['user']== "" || $_POST['homeaddress']== "" ||$_POST['pass']== "" ||$_POST['cpass']== ""){
              echo "error: Fill in empty fields";
            } else if($_POST['pass']!= $_POST['cpass']) {
              echo "error: Password does not match";
            } else {
              $db = new Database();
              if($db->hasUser($_POST['user'])) {
                echo "Username already exists!";
              } else {
                $salt = uniqid();
                $password = hash('sha256',$salt.$_POST['pass']);
                $db->signup($_POST['user'],$_POST['homeaddress'],$salt,$password);
                echo "Registration successful!";
              }
            }
          }
        ?>
    </div>
  </body>
</html>
