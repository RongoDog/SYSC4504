<div class="panel panel-primary">
   <div class="panel-heading">
      <h3 class="panel-title">Cart </h3>
   </div>
   <div class="panel-body">
      <?php foreach($cartItemArray as $item): ?>
        <div class="media">
          <a class="pull-left" href="#">
            <img class="media-object" src="<?php echo 'images/art/works/square-medium/'.$item["ImageFileName"].'.jpg' ?>" alt="..." width="32">
          </a>
          <div class="media-body">
            <p class="cartText"><a href="display-art-work.php?id=<?php echo $item["ArtWorkID"]?>"><?php echo $item["Title"]; ?></a></p>
          </div>
        </div> 
      <?php endforeach; ?>   
      <strong class="cartText">Subtotal: <span class="text-warning"><?php echo $subTotal; ?></span></strong>
      <div>
      <button type="button" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-info-sign"></span> Edit</button>
      <button type="button" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-arrow-right"></span> Checkout</button>
      </div>
   </div>
</div>    