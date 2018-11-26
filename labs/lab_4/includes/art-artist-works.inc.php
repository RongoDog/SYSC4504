<?php 
function outputArtwork($artwork) {
  echo '<th style="padding: 10px">';
  echo '<div class="thumbnail">';
  echo '<img src="images/art/works/square-medium/'.$artwork["ImageFileName"].'.jpg" title='.$artwork['Title'].' alt="" class="img-thumbnail img-responsive">';
  echo '<div class="caption">';
  echo '<a class="btn btn-primary btn-xs" href="#"><span class="glyphicon glyphicon-info-sign"></span> View</a>';
  echo '<button type="button" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-gift"></span> Wish</button>';
  echo '<button type="button" class="btn btn-info btn-xs"><span class="glyphicon glyphicon-shopping-cart"></span> Cart</button>';
  echo '</div>';
  echo '</div>';
  echo '</th>';
}
?>
<h3>Art by <?php echo $artist['FirstName'].' '.$artist['LastName'] ?></h3>  
<div class="row">
  <div class="col-md-3" style="width: 100%">
    <table>
      <tr>
        <?php
          foreach ($artworks as $artwork)
            outputArtwork($artwork)
        ?>
      </tr>
    </table>
  </div>
</div>  <!-- end artist's works row -->