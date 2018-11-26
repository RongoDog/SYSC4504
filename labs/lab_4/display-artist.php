<?php
require_once("config.php");
$page = $_SERVER['PHP_SELF'];
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"]) && $_GET["id"] > 0) {
  $id = $_GET['id'];
} else {
  $id = 1;
}
$connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
if (mysqli_connect_errno()) {
  die(mysqli_connect_error());
}
// First we get the artist
$sql = "SELECT * FROM artists WHERE ArtistId=".$id;
$artist_result = mysqli_query($connection, $sql);
$artist = mysqli_fetch_assoc($artist_result);
mysqli_free_result($artist_result);

// Next, we fetch their works.
$sql = "SELECT * FROM artworks WHERE ArtistId=".$id." LIMIT 4";
$artworks_result = mysqli_query($connection, $sql);
$artworks = array();
while ($row = mysqli_fetch_assoc($artworks_result)) {
  array_push($artworks, $row);
}
mysqli_free_result($artworks_result);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chapter 11</title>

    <!-- Bootstrap core CSS  -->
    <link href="bootstrap3_defaultTheme/dist/css/bootstrap.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="bootstrap3_defaultTheme/theme.css" rel="stylesheet">
  </head>
  <body>
    <?php include 'includes/art-header.inc.php';?>
    <div class="container">
      <div class="row">
        <div class="col-md-10">
            <?php include 'includes/art-artist.inc.php';?>
            <p>&nbsp;</p>
            <?php include 'includes/art-artist-works.inc.php';?>
          </div>  <!-- end col-md-10 (main content) -->
          <div class="col-md-2">
            <?php include 'includes/art-right-nav.inc.php';?>
          </div> <!-- end col-md-2 (right navigation) -->
      </div>  <!-- end main row -->
    </div>  <!-- end container -->
    <?php include 'includes/art-footer.inc.php';?>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="bootstrap-3.0.0/assets/js/jquery.js"></script>
    <script src="bootstrap-3.0.0/dist/js/bootstrap.min.js"></script>
  </body>
</html>
