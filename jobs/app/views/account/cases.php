<div class="page-header">
  <h2>My Cases</h2>
</div>

<div class="row">
  <div class="span6">
    
       
    <?php if (isset($_GET['id'])) {?>
      <a href="/account/cases" class="btn btn-small"><i class="icon-chevron-left"></i>Back</a>      
      <div>
        
        <label class="checkbox"><strong>Posted on:</strong> <?php echo date("m-d-Y H:i:s", strtotime($case['created_at'])); ?></label>
        <label class="checkbox"><strong>Title:</strong> <?php echo $case['title'];?></label>
        <label class="checkbox"><strong>Description:</strong> <?php echo $case['description'];?></label>
        <label class="checkbox"><strong>Budget:</strong> <?php echo $case['value1'];?></label>
        <label class="checkbox"><strong>Branches:</strong> <?php echo $case['branch_codes'];?></label>

        <hr>
        <h4> Companies who bought this case : </h4>

        <div class="accordion" id="accordion2">
          <?php for($i=1; $i <= 2; $i++){ ?>
          <div class="accordion-group">
            <div class="accordion-heading">
              <a class="accordion-toggle label label-info" data-toggle="collapse" data-parent="#accordion2" href="#collapse<?php echo $i;?>">
                Company name #<?php echo $i;?>
              </a>
            </div>
            <div id="collapse<?php echo $i;?>" class="accordion-body collapse <?php if ($i==1){ echo "in";}?>" >
              <div class="accordion-inner">
                
                <label class="checkbox"> Email: test@example.com </label>
                <label class="checkbox"> Address: Address here </label>
                <label class="checkbox"> Zip: 1234 </label>
                <label class="checkbox"> City: Copenhagen </label>
                <label class="checkbox"> CVR: 12345678 </label>
                <label class="checkbox"> Website: http://www.example.com </label>
                <label class="checkbox"> Tel. number: 12345678 </label>
                <label class="checkbox"> Branches: Carpenter, Gardener </label>
                
              </div>
            </div>
          </div>
          <?php } ?>
        </div>
        
      </div>

      
      
    <?php }else {?>
    <table class="table">
      <tbody>
        <?php foreach($cases as $c){ ?>
        <tr>
          <td><img class="" src="/assets/images/260x180.gif" alt="" width="80" align="left" style="padding: 0px 5px 5px 0px"></td>
          <td><h5><?php echo $c['title'];?></h5>
          <p><?php echo $c['description'];?></p>
          </td>
          <td>
            <p>Date posted: <?php echo date("m-d-Y", strtotime($c['created_at']));?> </p>
            <p>Estimated price: <?php echo $c['value1']?></p>
            <a href="/account/cases?id=<?php echo $c['id'];?>" class="label label-info">View details</a>
            <span class="badge badge-inverse">2</span>
          </td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
    <?php } ?>
  </div>
</div>
