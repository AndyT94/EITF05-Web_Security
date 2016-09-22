<?php
require("includes/connection.php");
require("includes/navigationbar.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="css/reset.css" />
    <link rel="stylesheet" href="css/style.css" />
    <title>Shop</title>
</head>
<body>
    <div id="container">
        <div id="main">
          <h1> Product List </h1>
          <table>
            <form method="POST" action="products.php">
              <tr>
                  <th> Name </th>
                  <th> Description </th>
                  <th> Price (SEK)</th>
              </tr>
              <?php
                $db = new Database();
                $result = $db->getallProducts();
                while($row = $result -> fetch_assoc()) {
              ?>
              <tr>
                <td><?php echo $row["name"]?></td>
                <td> <?php echo $row["description"]?></td>
                <td> <?php echo $row["price"]?></td>
                <td><button name="submit" name="submit" value= <?php echo $row['id_product']?>>Add to cart</td>
                  <td><button name="remove" name="remove" value= <?php echo $row['id_product']?>>Remove from cart</td>
              </tr>
              <?php
                }
              ?>
            </form>
          </table>
        </div><!--end main-->

        <?php
          if(isset($_POST['submit'])){
            if(!isset($_SESSION['cart'])){
              $_SESSION['cart'] = array();
            }
            if(!isset($_SESSION['cart'][$_POST['submit']])) {
              $_SESSION['cart'][$_POST['submit']] = 1;
            } else {
              $_SESSION['cart'][$_POST['submit']]++;
            }
          }

          if(isset($_POST['remove'])){
            if(!isset($_SESSION['cart'][$_POST['remove']]) || $_SESSION['cart'][$_POST['remove']]<=1) {
              unset($_SESSION['cart'][$_POST['remove']]);
            } else {
              $_SESSION['cart'][$_POST['remove']]--;
            }
          }
        ?>

        <div id="sidebar">
          <h1> Cart </h1>
          <table>
          <tr>
            <th> Product name </th>
            <th> Quantity </th>
            <th> Price (SEK)</th>
          </tr>

          <?php
          if(isset($_SESSION['cart'])) {
            $db = new Database();
            $_SESSION['total'] = 0;
            foreach ($_SESSION['cart'] as $id => $quantity) {
              $result = $db->getIDProduct($id);
              while($row = $result -> fetch_assoc()) {
          ?>
                <tr>
                  <td><?php echo $row["name"]?></td>
                  <td> <?php echo $quantity?></td>
                  <td> <?php echo $row["price"]*$quantity?></td>
                </tr>
            <?php
                $_SESSION['total']+=$row["price"]*$quantity;
              }
            }
          }
          ?>
          <tr>
            <td>Total: <?php echo $_SESSION['total'] ?> SEK</td>
            <td><a href="payment.php">Go to payment</a></td>
          </tr>
        </table>
        </div><!--end sidebar-->
    </div><!--end container-->
</body>
</html>
