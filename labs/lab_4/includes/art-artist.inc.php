<h2><?php echo $artist['FirstName'].' '.$artist['LastName'] ?></h2>
<div class="row">
  <div class="col-md-5">
    <img src="images/art/artists/medium/<?php echo $id?>.jpg" 
        class="img-thumbnail img-responsive" 
        alt=<?php echo $artist['Name'] ?> 
        title=<?php echo $artist['Name'] ?>
      />
  </div>
  <div class="col-md-7">
    <p><?php echo $artist['Details'] ?></p>
    <div class="btn-group btn-group-lg">
      <button type="button" class="btn btn-default">
          <a href="#"><span class="glyphicon glyphicon-heart"></span> Add to Favorites List</a>
      </button>
    </div>
    <p>&nbsp;</p>
    <div class="panel panel-default">
      <div class="panel-heading"><h4>Artist Details</h4></div>
      <table class="table">
        <tr>
          <th>Date:</th>
          <td><?php echo $artist['YearOfBirth'].'-'.$artist['YearOfDeath'] ?></td>
        </tr>
        <tr>
          <th>Nationality:</th>
          <td><?php echo $artist['Nationality'] ?></td>
        </tr>
        <tr>
          <th>More Info:</th>
          <td><?php echo '<a href='.$artist['ArtistLink'].'>'.$artist['ArtistLink'].'</a>' ?></td>
        </tr>
      </table>
    </div>
  </div>  <!-- end col-md-7 -->
</div>  <!-- end row (product info) -->