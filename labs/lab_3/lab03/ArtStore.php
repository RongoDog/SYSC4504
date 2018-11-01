<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Chapter 8</title>

   <!-- Bootstrap core CSS -->
   <link href="bootstrap3_defaultTheme/dist/css/bootstrap.css" rel="stylesheet">

   <!-- Custom styles for this template -->
   <link href="chapter08-project02.css" rel="stylesheet">

   <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
   <!--[if lt IE 9]>
   <script src="bootstrap3_defaultTheme/assets/js/html5shiv.js"></script>
   <script src="bootstrap3_defaultTheme/assets/js/respond.min.js"></script>
   <![endif]-->
</head>

<body>
  <?php include 'art-header.inc.php';?>
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
            echo '<td><img class="img-thumbnail" src="images/art/tiny/'.$file.'" alt="..."></td>';
            echo '<td>'.$product.'</td>';
            echo '<td>'.$quantity.'</td>';
            echo '<td>'.$price.'</td>';
            echo '<td>'.($price*$quantity).'</td>';
            echo '</tr>';
        }
        include 'art-data.php';
        $cartItemArray = array(
            array(
                "file" => $file1,
                "product" => $product1,
                "quantity" => $quantity1,
                "price" => $price1,
            ),
            array(
                "file" => $file2,
                "product" => $product2,
                "quantity" => $quantity2,
                "price" => $price2,
            ),
        );
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
          <td><button type="button" class="btn btn-success" >Checkout</button></td>
      </tr>
    </table>
  </div>  <!-- end container -->
  <?php include 'art-footer.inc.php';?>
  <!-- Bootstrap core JavaScript
  ================================================== -->
  <!-- Placed at the end of the document so the pages load faster -->
  <script src="bootstrap3_defaultTheme/assets/js/jquery.js"></script>
  <script src="bootstrap3_defaultTheme/dist/js/bootstrap.min.js"></script>
</body>

</html>
