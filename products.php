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

    <title>Shopping cart</title>

</head>

<body>

    <div id="container">

        <div id="main">
          <h1> Product List </h1>
          <table>
              <tr>
                  <th> Name </th>
                  <th> Description </th>
                  <th> Price </th>
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
                <td><a href="#"> Add to cart</a></td>

              </tr>

              <?php

                }
               ?>

          </table>

        </div><!--end main-->

        <div id="sidebar">

        </div><!--end sidebar-->

    </div><!--end container-->

</body>
</html>
