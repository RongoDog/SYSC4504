<?php
require_once("config.php");
$page = $_SERVER['PHP_SELF'];
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"]) && $_GET["id"] > 0) {
  $id = $_GET['id'];
} else {
  $id = 1;
}

include 'includes/utils.php';
addToCart();

$connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
if (mysqli_connect_errno()) {
  die(mysqli_connect_error());
}
// First we get the artwork
$sql = "SELECT * FROM artworks WHERE ArtworkId=".$id;
$artwork_result = mysqli_query($connection, $sql);
$artwork = mysqli_fetch_assoc($artwork_result);
mysqli_free_result($artwork_result);

// Next, we get the genres
$sql = "SELECT g.GenreName FROM Artworks a INNER JOIN ArtworkGenres ag ON a.ArtWorkId=ag.ArtWorkId INNER JOIN Genres g ON g.GenreId=ag.GenreId WHERE a.ArtWorkId=".$id;
$genres_result = mysqli_query($connection, $sql);
$genres = array();
while ($row = mysqli_fetch_assoc($genres_result)) {
  array_push($genres, $row);
}
mysqli_free_result($genres_result);

$genre_map = function($genre) {
  return $genre['GenreName'];
};
$genre_strings = array_map($genre_map, $genres);
$genre_list = join(", ", $genre_strings);

// Next, we get the subjects
$sql = "SELECT s.SubjectName FROM Artworks a INNER JOIN ArtWorkSubjects aws ON a.ArtWorkId=aws.ArtWorkId INNER JOIN Subjects s ON s.SubjectId=aws.SubjectId WHERE a.ArtWorkId=".$id;
$subjects_result = mysqli_query($connection, $sql);
$subjects = array();
while ($row = mysqli_fetch_assoc($subjects_result)) {
  array_push($subjects, $row);
}
mysqli_free_result($subjects_result);

$subject_map = function($subject) {
  return $subject['SubjectName'];
};
$subject_strings = array_map($subject_map, $subjects);
$subject_list = join(", ", $subject_strings);

// Next, we get the artist
$sql = "SELECT * FROM artists WHERE ArtistID=".$artwork["ArtistID"];
$artist_result = mysqli_query($connection, $sql);
$artist = mysqli_fetch_assoc($artist_result);
mysqli_free_result($artist_result);

// Next, we fetch their other works.
$sql = "SELECT * FROM artworks WHERE ArtistID=".$artwork["ArtistID"];
$artworks_result = mysqli_query($connection, $sql);
$artworks = array();
while ($row = mysqli_fetch_assoc($artworks_result)) {
  array_push($artworks, $row);
}
mysqli_free_result($artworks_result);

// Next, we get the gallery
$sql = "SELECT * FROM galleries WHERE GalleryID=".$artwork["GalleryID"];
$gallery_result = mysqli_query($connection, $sql);
$gallery = mysqli_fetch_assoc($gallery_result);
mysqli_free_result($gallery_result);

// Finally, we get the current cart item and subtotal
$cartItemArray = array();
$subTotal = 0;
if (isset($_COOKIE["cart-artworks"])) {
  $ids = explode("-", $_COOKIE["cart-artworks"]);
  $in_query = join(", ", $ids);
  $sql = "SELECT ImageFileName, MSRP, Title, ArtWorkID FROM artworks WHERE ArtWorkID IN (".$in_query.")";
  $artworks_result = mysqli_query($connection, $sql);
  while ($row = mysqli_fetch_assoc($artworks_result)) {
    array_push($cartItemArray, $row);
  }
  mysqli_free_result($artworks_result);
  foreach($cartItemArray as $cartItem) {
    $qty = 1;
    if (isset($_COOKIE["qty-".$cartItem["ArtWorkID"]])) {
      $qty = $_COOKIE["qty-".$cartItem["ArtWorkID"]];
    }
    $subTotal = $subTotal + $qty * $cartItem["MSRP"];
  }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Art Store</title>
    <!-- Bootstrap core CSS  -->    
    <link href="bootstrap3_defaultTheme/dist/css/bootstrap.css" rel="stylesheet"> 
    <!-- Custom styles for this template -->
    <link href="bootstrap3_defaultTheme/theme.css" rel="stylesheet">
  </head>

<body>

<?php include 'includes/art-header.inc.php'; ?>

<div class="container">
   <div class="row">
      <div class="col-md-10">
        <?php include 'includes/art-artwork.inc.php'; ?>
        <?php include 'includes/art-artist-works.inc.php'; ?>
      </div>  <!-- end col-md-10 (main content) -->
      <div class="col-md-2">   
         <?php include 'includes/art-shopping-cart.inc.php'; ?>
         <?php include 'includes/art-right-nav.inc.php'; ?>
      </div> <!-- end col-md-2 (right navigation) -->           
   </div>  <!-- end main row --> 
</div>  <!-- end container -->

<?php include 'includes/art-footer.inc.php'; ?>
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<link href="bootstrap3_defaultTheme/dist/css/bootstrap.css" rel="stylesheet"> 
<!-- Custom styles for this template -->
<link href="bootstrap3_defaultTheme/theme.css" rel="stylesheet">
</body>
</html>
