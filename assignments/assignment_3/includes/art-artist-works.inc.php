<?php 
function outputArtwork($artwork) {
  echo '<th style="padding: 10px">';
  echo '<div class="thumbnail">';
  echo '<img src="images/art/works/square-medium/'.$artwork["ImageFileName"].'.jpg" title='.$artwork['Title'].' alt="" class="img-thumbnail img-responsive">';
  echo '<div class="caption">';
  echo '<a class="btn btn-primary btn-xs" href="../display-art-work.php?id='.$artwork["ArtWorkID"].'">';
  echo '<span class="glyphicon glyphicon-info-sign"></span> View</a>';
  echo '<button type="button" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-gift"></span> Wish</button>';
  echo "<button type=\"button\" class=\"btn btn-info btn-xs\" onclick=\"
  var req = new XMLHttpRequest();
  req.open('GET', '../add-to-cart.php?addToCartId=".$artwork["ArtWorkID"]."');
  req.send();\">
  <span class=\"glyphicon glyphicon-shopping-cart\"></span> Cart</button>";
  echo '</div>';
  echo '</div>';
  echo '</th>';
}

function outputArtRow($works) {
  echo '<div class="row">';
  echo '<div class="col-md-3" style="width: 100%">';
  echo '<table>';
  echo '<tr>';
  foreach ($works as $key=>$value) {
    outputArtwork($value);
  }
  echo '</tr>';
  echo '</table>';
  echo '</div>';
  echo '</div>';
}
?>


<h3>Art by <?php echo $artist['FirstName'].' '.$artist['LastName'] ?></h3> 
<?php
  $chunks = array_chunk($artworks, 4);
  foreach ($chunks as $key=>$value) {
    outputArtRow($value);
  }
?>