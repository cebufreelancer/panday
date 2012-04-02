<div class="page-header">
  <h2>Case details</h2>
</div>

<div class="row">
  <div class="span6">
    <a href="<?php echo ($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : ""; ?>" class="btn btn-small"><i class="icon-chevron-left"></i>Back</a>
    </br></br>
    <div>    
      <label class="checkbox"><strong>Posted on:</strong> <?php echo date("d-m-Y H:i:s", strtotime($case['created_at'])); ?></label>
      <label class="checkbox"><strong>Title:</strong> <?php echo $case['title'];?></label>
      <label class="checkbox"><strong>Description:</strong> <?php echo $case['description'];?></label>
      <label class="checkbox"><strong>Zip code:</strong> <?php echo $case['zipcode'];?></label>
      <label class="checkbox"><strong>Budget:</strong> <?php echo $case['value1'];?></label>
      <label class="checkbox"><strong>Branches:</strong> <?php echo $case['branch_codes'];?></label>        
    </div>
  </div>
</div>
