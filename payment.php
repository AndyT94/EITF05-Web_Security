<?php
require("includes/navigationbar.php");
?>
<?php
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
if(!isset($_SESSION['total']) || $_SESSION['total'] != 0){
?>
  <html>
  <head>
     <title>Sign-Up</title>
   </head>
    <body id="body-color">
      <div id="Sign In">
         <fieldset style="width:30%"><legend>To pay: <?php echo $_SESSION['total'] ?> SEK</legend>
           <table border="0">
             <tr>
               <form method="POST" action= "payment.php">
                  <td>Enter creditcard number</td><td> <input type="text" name="user" required ></td>
                </tr>
                <tr>
                  <td><input id="button" type="submit" name="submit" value="Pay"></td>
                </tr>
            </form>
          </table>
        </fieldset>
      </div>
    </body>
  </html>


<?php
}
if(isset($_POST['submit'])){
  $_SESSION['credit'] = $_POST['user'];
  $_SESSION['receipt'] = uniqid();
    header("Location: receipt.php");
}
} else {

  echo 'Please sign in';
}

 ?>
