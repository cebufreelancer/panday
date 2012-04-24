
<?php
$url = "http://" . $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"]. $_SERVER['PHP_SELF'];

$date_url = $url . "?sortby=date";
$price_url = $url . "?sortby=price";


?>
<div class="page-header">
  <h2>List of Cases</h2>
</div>

<div class="row">
  <div class="span6">
    
    <form method="get" action="/cases">
      <input type="text" name="q" placeholder="Type here..." autocomplete="off" value="<?php if (isset($_GET['q'])) { echo $_GET['q'];}?>" style="width: 300px">
      <ul class="breadcrumb">
        <?php foreach($branches as $b){ ?>
          <li style="width: 120px"> <input type="checkbox" name="branches[]" id="<?php echo $b['code'];?>" value="<?php echo $b['code']; ?>" <?php if(isset($_GET['branches']) && in_array($b['code'], $_GET['branches'])) { echo "checked"; } ?> > <?php echo $b['name']?> </li>
        <?php } ?>
      </ul>
      <label>From zipcode: <input type="text" name="from_zipcode" placeholder="enter zipcode" value="<?php if (isset($_GET['from_zipcode'])){ echo $_GET['from_zipcode']; }?>" style="width: 100px; display: inline-block">
      To zipcode: <input type="text" name="to_zipcode" placeholder="enter zipcode" value="<?php if (isset($_GET['to_zipcode'])){ echo $_GET['to_zipcode']; }?>" style="width: 100px; display: inline-block"></label>
      <button type="submit" class="btn">Search</button>
    </form>
  </div>
</div>

<div class="row">
  <div class="span6">
    <ul class="breadcrumb pull-right">
      <li> Order by:  </li>
      <li> <a href="<?php echo $date_url; ?>"><span class="label">Date</span></a></li>
      <li> <a href="<?php echo $price_url; ?>"><span class="label">Price</span></a></li>
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
                <!--<a href="/?error=2" class="btn btn-small btn-warning " data-id="<?php echo $c['id'];?>" price="<?php echo $c['value1'];?>">Add to cart</a> -->
                <a href="" onclick="return false" class="btn btn-small btn-warning case_row" data-id="<?php echo $c['id'];?>" price="<?php echo $c['value1'];?>">Add to cart</a>
              <?php } ?>
              <a href="/details?id=<?php echo $c['id'];?>" class="label label-info">Details</a></div>
          </td>
        </tr>
        <?php } ?>
      </tbody>
    </table>

    <?php

    $totalpages = round($total_rows / 10);
    $querystring = "?";
    foreach($_GET as $key => $val){
      if ($key != "page") {
        $querystring .= $key . "=" . $val . "&";
      }
    }

    $curpage = (isset($_GET['page'])) ? $_GET['page'] : "1";
    if (isset($_GET['page'])){
      $npage = $_GET['page'] + 1;
      $bpage = $_GET['page'] - 1;
    }else{
      $npage = 2;
      $bpage = 1;
    }
    
    $next_url = $url .$querystring . "page=" . $npage;
    $back_url = $url .$querystring . "page=" . $bpage;

    ?>
    <?php if ($totalpages > 1) { ?>
      <?php if ($curpage != 1){ ?>
      <a href="<?php echo $back_url;  ?>"> Back </a>
      <?php } ?>
      <?php if (($total_rows/10) != $curpage) {?> |
      <a href="<?php echo $next_url;  ?>">Next </a>
      <?php } ?>
    <?Php } ?>
  </div>
</div>