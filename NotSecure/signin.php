<?php
  require("includes/connection.php");
  require("includes/navigationbar.php");
?>

<!DOCTYPE HTML>
<html>
<head>
   <title>Sign-Up</title>
 </head>
  <body id="body-color">
    <div id="Sign In">
       <fieldset style="width:30%"><legend>Sign In</legend>
         <table border="0">
           <tr>
             <form method="POST" action= "signin.php">
                <td>UserName</td><td> <input type="text" name="user" required ></td>
              </tr>
              <tr>
                <td>Password</td><td> <input type="password" name="pass" required ></td>
              </tr>
              <tr>
                <td><input id="button" type="submit" name="submit" value="Sign In"></td>
              </tr>
          </form>
        </table>
      </fieldset>
        <?php
          if(isset($_POST['submit'])){
              $db = new Database();
              if($db->isAuthenticated($_POST['user'], $_POST['pass'])) {
                $_SESSION['user'] = $_POST['user'];
                $_SESSION['loggedin'] = true;
                header("Location: products.php");
              } else {
                echo "Wrong username or password!";
              }
          }
        ?>
    </div>
  </body>
</html>
