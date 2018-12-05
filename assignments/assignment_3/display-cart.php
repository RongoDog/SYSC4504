<?php
require_once("config.php");
$connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
if (mysqli_connect_errno()) {
  die(mysqli_connect_error());
}
$page = $_SERVER['PHP_SELF'];

include 'includes/utils.php';
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["clear"])) {
  if ($_GET["clear"] == "true") {
    checkout();
  }
}

$cartItemArray = array();
if (isset($_COOKIE["cart-artworks"])) {
  $ids = explode("-", $_COOKIE["cart-artworks"]);
  $in_query = join(", ", $ids);
  $sql = "SELECT ImageFileName, MSRP, Title, ArtWorkID FROM artworks WHERE ArtWorkID IN (".$in_query.")";
  $artworks_result = mysqli_query($connection, $sql);
  $artworks = array();
  while ($row = mysqli_fetch_assoc($artworks_result)) {
    array_push($artworks, $row);
  }
  mysqli_free_result($artworks_result);

  foreach($artworks as $artwork) {
    $qty = 1;
    if (isset($_COOKIE["qty-".$artwork["ArtWorkID"]])) {
      $qty = $_COOKIE["qty-".$artwork["ArtWorkID"]];
    }
    array_push($cartItemArray, array(
      "file" => $artwork["ImageFileName"],
      "product" => $artwork["Title"],
      "quantity" => $qty,
      "price" => $artwork["MSRP"],
    ));
  }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Art Store</title>
   <!-- Bootstrap core CSS -->
   <link href="bootstrap3_defaultTheme/dist/css/bootstrap.css" rel="stylesheet">
   <!-- Custom styles for this template -->
   <link href="bootstrap3_defaultTheme/theme.css" rel="stylesheet">
</head>

<body>
  <?php include 'includes/art-header.inc.php';?>
  <div class="container">

    <div class="page-header">
      <h2>View Cart</h2>
    </div>

    <table class="table table-condensed">
      <tr>
          <th>Image</th>
          <th>Product</th>
          <th>Quantity</th>
          <th>Price</th>
          <th>Amount</th>
      </tr>
      <?php 
        function outputCartRow($file, $product, $quantity, $price) {
            echo '<tr>';
            echo '<td><img class="img-thumbnail" src="./images/art/works/square-thumbs/'.$file.'" alt="..."></td>';
            echo '<td>'.$product.'</td>';
            echo '<td>'.$quantity.'</td>';
            echo '<td>'.$price.'</td>';
            echo '<td>'.($price*$quantity).'</td>';
            echo '</tr>';
        }
        $subtotal = 0;
        foreach ($cartItemArray as $key=>$value):
            $subtotal += $value['price']*$value['quantity'];
            outputCartRow($value['file'], $value['product'], $value['quantity'], $value['price']);
        endforeach;
        $tax = number_format($subtotal*0.1, 2);
        $shipping = 0;
        if ($subtotal <= 2000) {
            $shipping = 100;
        }
        $total = $subtotal + $tax + $shipping;
      ?>
      <tr class="success strong">
          <td colspan="4" class="moveRight">Subtotal</td>
          <td >$<?php echo $subtotal ?></td>
      </tr>
      <tr class="active strong">
          <td colspan="4" class="moveRight">Tax</td>
          <td >$<?php echo $tax ?></td>
      </tr>
      <tr class="strong">
          <td colspan="4" class="moveRight">Shipping</td>
          <td >$<?php echo $shipping ?></td>
      </tr>
      <tr class="warning strong text-danger">
          <td colspan="4" class="moveRight">Grand Total</td>
          <td >$<?php echo $total ?></td>
      </tr>
      <tr >
          <td colspan="4" class="moveRight"><button type="button" class="btn btn-primary" >Continue Shopping</button></td>
          <td><button type="button" class="btn btn-success" 
          onclick="window.location.href='display-cart.php?clear=true';">Checkout</button></td>
      </tr>
    </table>
  </div>  <!-- end container -->
  <?php include 'includes/art-footer.inc.php';?>
  <!-- Bootstrap core JavaScript
  ================================================== -->
  <!-- Placed at the end of the document so the pages load faster -->
  <script src="bootstrap3_defaultTheme/assets/js/jquery.js"></script>
  <script src="bootstrap3_defaultTheme/dist/js/bootstrap.min.js"></script>
</body>

</html>
