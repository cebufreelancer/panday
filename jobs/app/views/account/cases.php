<div class="page-header">
  <h2>My Cases</h2>
</div>

<div class="row">
  <div class="span6">
    
       
    <?php if (isset($_GET['id'])) {?>
      <a href="/account/cases" class="btn btn-small"><i class="icon-chevron-left"></i>Back</a>      
      <div>
        
        <label class="checkbox"><strong>Posted on:</strong> <?php echo date("d-m-Y H:i:s", strtotime($case['created_at'])); ?></label>
        <label class="checkbox"><strong>Title:</strong> <?php echo $case['title'];?></label>
        <label class="checkbox"><strong>Description:</strong> <?php echo $case['description'];?></label>
        <label class="checkbox"><strong>Budget:</strong> <?php echo $case['value1'];?></label>
        <label class="checkbox"><strong>Branches:</strong> <?php echo $case['branch_codes'];?></label>

        <hr>
        
        <?php if (sizeof($companies) > 0) {?>
        <h4> Companies who bought this case : </h4>

        <div class="accordion" id="accordion2">
          <?php $counter = 1; ?>
          <?php foreach($companies as $comp) { ?>
          <div class="accordion-group">
            <div class="accordion-heading">
              <a class="accordion-toggle label label-info" data-toggle="collapse" data-parent="#accordion2" href="#collapse<?php echo $comp['id'];?>">
                <?php $user?>
              </a>
            </div>
            <div id="collapse<?php echo $comp['id'];?>" class="accordion-body collapse <?php if ($counter==1){ echo "in";}?>" >
              <div class="accordion-inner">
                
                <label class="checkbox"> Email: <?php echo $comp['email']?> </label>
                <label class="checkbox"> Address: <?php echo $comp['address']?> </label>
                <label class="checkbox"> Zip: <?php echo $comp['zipcode']?></label>
                <label class="checkbox"> City: <?php echo $comp['city']?> </label>
                <label class="checkbox"> CVR: </label>
                <label class="checkbox"> Website: <?php echo $comp['website'];?> </label>
                <label class="checkbox"> Tel. number: <?php echo $comp['telno']?></label>
                
              </div>
            </div>
          </div>
          <?php 
          $counter ++;
          } ?>
        </div>
        <?php }else{?>
        No one buy this case yet.
        <?php } ?>
        
      </div>

      
      
    <?php }else {?>
    <table class="table">
      <tbody>
        <?php foreach($cases as $c){ ?>
          <?php
          $case_id = $c['id'];
          $res = $this->db->query("select * from invoice_items where case_id = '$case_id'");
          if ($res) {
            $bought = $res->num_rows();
          }else{
            $bought = 0;
          }

          ?>
        <tr>
          <td><img class="" src="/assets/images/260x180.gif" alt="" width="80" align="left" style="padding: 0px 5px 5px 0px"></td>
          <td><h5><?php echo $c['title'];?></h5>
          <p><?php echo $c['description'];?></p>
          </td>
          <td>
            <p>Date posted: <?php echo date("d-m-Y", strtotime($c['created_at']));?> </p>
            <p>Estimated price: <?php echo $c['value1']?></p>
            <?php if ($bought > 0 ): ?>
            <span title="Bought your case" class="badge badge-inverse"><?php echo $bought; ?></span>
            <?php endif ?>
            <a href="/account/cases?id=<?php echo $c['id'];?>" class="label label-info" title="View details">View details</a>
            <?php if ($bought == 0 ): ?>
            <a href="/account/delete?id=<?php echo $c['id'];?>" class="label label-important" title="Delete case">Delete</a>
            <?php endif ?>
          </td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
    <?php } ?>
  </div>
</div>
