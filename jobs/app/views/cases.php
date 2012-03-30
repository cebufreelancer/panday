<div class="page-header">
  <h2>List of Cases</h2>
</div>

<div class="row">
  <div class="span3">
    <ul class="breadcrumb">
      <li> <input type="checkbox"> Carpenter </li>
      <li> <input type="checkbox"> Plumber </li>
      <li> <input type="checkbox"> Painter </li>
      <li> <input type="checkbox"> Gartner </li>
      <li> <input type="checkbox"> Bricklayer </li>
      <li> <input type="checkbox"> Others </li>
    </ul>
  </div>
  <div class="span3">
    <ul class="breadcrumb">
      <li> Order by:  </li>
      <li> <span class="label">Date</span></li>
      <li> <span class="label">Price</span> </li>
      <li> <span class="label">Estimated Price</span> </li>
    </ul>    
  </div>
</div>

<div class="row">
  <div class="span6">

    
    <table class="table">
      <tbody>
        <?php foreach($cases as $c){ ?>
        <tr>
          <td><img class="" src="/assets/images/260x180.gif" alt="" width="80" align="left" style="padding: 0px 5px 5px 0px"></td>
          <td><h5><?php echo $c['title'];?></h5>
          <p><?php echo $c['description'];?></p>
          </td>
          <td>
            <p>Date posted: <?php echo date("d-m-Y", strtotime($c['created_at']));?> </p>
            <p>Estimated price: <?php echo $c['value1']?></p>
            <div style="width: 150px">
              <?php if ($this->session->userdata('email')){ ?>
                <?php if ($this->session->userdata('company')) {?>
                  <a href="" onclick="return false" class="btn btn-small btn-warning case_row" data-id="<?php echo $c['id'];?>" price="<?php echo $c['value1'];?>">Add to cart</a>
                <?php } ?>
              <?php }else{ ?>
                <a href="/?error=2" class="btn btn-small btn-warning " data-id="<?php echo $c['id'];?>" price="<?php echo $c['value1'];?>">Add to cart</a>
              <?php } ?>
              <a href="/details?id=<?php echo $c['id'];?>" class="label label-info">Details</a></div>
          </td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
    
  </div>
</div>