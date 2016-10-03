
<?php
require("includes/navigationbar.php");
require("includes/connection.php");
?>

<div class="well col-xs-10 col-sm-10 col-md-6 col-xs-offset-1 col-sm-offset-1 col-md-offset-3">
            <div class="row">

                <div class="col-xs-6 col-sm-6 col-md-6 text-right">
                    <p>
                        <em>Date: <?php echo  date("Y/m/d")?></em>
                    </p>
                    <p>
                        <em>Receipt #: <?php echo $_SESSION['receipt'] ?></em>
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="text-center">
                    <h1>Receipt</h1>
                </div>
                </span>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>#</th>
                            <th class="text-center">Total</th>
                        </tr>
                    </thead>
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
                      ?>
                      <tr>
                        <td><b>Total:</b> <?php echo $_SESSION['total']?> SEK</td>
                      </tr>
                      <?php
                    }

                    ?>


                </table>
            </div>
        </div>
    </div>
