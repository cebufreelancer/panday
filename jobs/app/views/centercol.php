<div >&nbsp;</div>
<div class="row" style="background-image: url(/assets/images/main_background.jpg); background-position: 27px 5px; background-repeat: no-repeat; margin-top: 0px;">
  <div class="span3">
    <div style="margin: 20px; color: white">
      <h3> Fa 3 gratis </h3>
      <ul>
        <li> Donec id elit non mi porta gravida at eget </li>
        <li> Donec id elit non mi porta gravida at eget </li>
        <li> Donec id elit non mi porta gravida at eget </li>
      </ul>
    </div>
  </div>

  <div class="span3" >
    <form action="/create" method="post" name="case" id="case" class="well" style="background-color: transparent !important; padding-top: 20px !important">
      <fieldset>
          <div class="control-group" style="margin-bottom: 3px !important">
            <label class="control-label"  for="input01" style="color: white">Headline</label>
            <div class="controls" >
              <input type="text" class="required input-large" id="title" name="title" autocomplete="off">
            </div>
          </div>
          <div class="control-group" style="margin-bottom: 3px !important">
            <label class="control-label"   for="input01" style="color: white">Description</label>
            <div class="controls" >
              <textarea class="required input-large" id="description" name="description" rows="2" maxlength="250"></textarea>
            </div>
          </div>
          <div class="control-group" style="margin-bottom: 3px !important">
            <div class="controls" >
              <button class="btn btn-small btn-primary">Opret en byggeopgave</button>
            </div>
          </div>

        </fieldset>
    </form>

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
            <p>Date posted: <?php echo date("d-m-Y", strtotime($c['created_at']));?></p>
            <p>Estimated price: <?php echo $c['value1']?></p>
            <div style="width: 150px">
              <?php if ($this->session->userdata('email')){ ?>
                <?php if ($this->session->userdata('company')) {?>
                <a href="" onclick="return false" class="btn btn-small btn-warning case_row" data-id="<?php echo $c['id'];?>" price="<?php echo $c['value1'];?>">Add to cart</a>
                <?php } ?>
              <?php }else{ ?>
              <a href="" onclick="return false" class="btn btn-small btn-warning case_row" data-id="<?php echo $c['id'];?>" price="<?php echo $c['value1'];?>">Add to cart</a>
              <?php } ?>
              <a href="/details?id=<?php echo $c['id'];?>" class="label label-info">Details</a>
              </div>
          </td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
    <div class='pull-right'><a href="/cases">View all >></a> </div>
  </div>
</div>

<hr>


<div class="row">
  <div class="span6">
    <ul class="thumbnails">
      <?php if (sizeof($news) > 2){?>
        <?php $cnt = 1;?>
        <?php foreach($news as $n){?>
          <?php if ($cnt > 2){?>
          <li class="span2" >
            <div class="thumbnailx">
              <img src="/assets/news/<?php echo $n['id'];?>/<?php echo $n['image'];?>" alt="" width="170">
              <div class="">
                <h5><?php echo $n['title'];?></h5>
                <p><?php echo $n['contents'];?></p>
              </div>
            </div>
          </li>
        <?php }
          $cnt++;
        }
        ?>
      <?php } ?>

    </ul> 
  </div>
</div>
