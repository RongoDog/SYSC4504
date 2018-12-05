<h2><?php echo $artwork['Title']?></h2>
<p>By <a href="display-artist.php?id=<?php echo $artist['ArtistID']?>"><?php echo $artist['FirstName']." ".$artist['LastName']?></a></p>
<div class="row">
   <div class="col-md-5">
      <img src="images/art/works/medium/<?php echo $artwork["ImageFileName"]?>.jpg" class="img-thumbnail img-responsive" alt="title here"/>
   </div>
   <div class="col-md-7">
      <p>
        <?php echo $artwork['Description']?>
      </p>
      <p class="price"><?php echo number_format($artwork['MSRP'], 2)?></p>
      <div class="btn-group btn-group-lg">
        <button type="button" class="btn btn-default">
            <a href="#"><span class="glyphicon glyphicon-gift"></span> Add to Wish List</a>  
        </button>
        <button type="button" class="btn btn-default">
          <a href="../display-art-work.php?id=<?php echo $artwork["ArtWorkID"]?>&addToCartId=<?php echo $artwork["ArtWorkID"]?>">
          <span class="glyphicon glyphicon-shopping-cart"></span> Add to Shopping Cart
          </a>
        </button>
      </div>               
      <p>&nbsp;</p>
      <div class="panel panel-default">
        <div class="panel-heading"><h4>Product Details</h4></div>
        <table class="table">
          <tr>
            <th>Date:</th>
            <td><?php echo $artwork["YearOfWork"]?></td>
          </tr>
          <tr>
            <th>Medium:</th>
            <td><?php echo $artwork["Medium"]?></td>
          </tr>  
          <tr>
            <th>Dimensions:</th>
            <td><?php echo $artwork["Width"]?> cm X <?php echo $artwork["Height"]?> cm</td>
          </tr> 
          <tr>
            <th>Home:</th>
            <td><a href="<?php echo $gallery["GalleryWebSite"]?>"></a><?php echo $artwork["OriginalHome"]?></td>
          </tr>  
          <tr>
            <th>Genres:</th>
            <td><?php echo $genre_list?></td>
          </tr> 
          <tr>
            <th>Subjects:</th>
            <td><?php echo $subject_list?></td>
          </tr>     
        </table>
      </div>                              
   </div>  <!-- end col-md-7 -->
</div>  <!-- end row (product info) -->