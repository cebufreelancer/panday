<div class="page-header">
  <h3><?php echo $new['title'];?></h3>
  <p> 
  <img src="/assets/news/<?php echo $new['id'];?>/<?php echo $new['image'];?>" width="150" align="left" style="padding-right: 6px; padding-bottom: 6px;">
  <?php echo str_replace("\n", "<br/>", $new['contents']);?></p>
</div>