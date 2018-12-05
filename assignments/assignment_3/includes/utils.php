<?php
// This function clears the cart
function checkout() {
if (isset($_COOKIE["cart-artworks"])) {
    $ids = explode("-", $_COOKIE["cart-artworks"]);
    foreach ($ids as $id) {
      setcookie("qty-".$id, 1, 1);
    }
    setcookie("cart-artworks", 1, 1);
  }
}
// This function adds an item to the cart
function addToCart() {
  if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["addToCartId"])) {
    if (isset($_COOKIE["cart-artworks"])) {
      $ids = explode("-", $_COOKIE["cart-artworks"]);
      if (in_array((string) $_GET["addToCartId"], $ids)) {
        if (isset($_COOKIE["qty-".$_GET["addToCartId"]])) {
          setcookie("qty-".$_GET["addToCartId"], $_COOKIE["qty-".$_GET["addToCartId"]]+1, $expiryTime);
        } else {
          setcookie("qty-".$_GET["addToCartId"], 1, $expiryTime);
        }
      } else {
        array_push($ids, $_GET["addToCartId"]);
        setcookie("cart-artworks", join("-", $ids), $expiryTime);
        setcookie("qty-".$_GET["addToCartId"], 1, $expiryTime);
      }
    } else {
      setcookie("cart-artworks", $_GET["addToCartId"], $expiryTime);
      setcookie("qty-".$_GET["addToCartId"], 1, $expiryTime);
    }
  }
}
?>