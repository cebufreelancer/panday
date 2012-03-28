

<div class="row" style="background-image: url(/assets/images/main_background.jpg); background-position: 27px 1px; background-repeat: no-repeat; margin-top: 10px">
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
  <div class="span3">

    <form action="/create" method="post" class="well" style="background-color: transparent !important;">
      <fieldset>
          <div class="control-group" >
            <label class="control-label"  for="input01" style="color: white">Headline</label>
            <div class="controls" >
              <input type="text" class="input-large" id="title" name="title" autocomplete="off">
            </div>
          </div>
          <div class="control-group">
            <label class="control-label"   for="input01" style="color: white">Description</label>
            <div class="controls" >
              <textarea class="input-large" id="description" name="description" rows="3" maxlength="250"></textarea>
            </div>
          </div>
          <div class="control-group">
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
            <p>Date posted: <?php echo date("m-d-Y", strtotime($c['created_at']));?></p>
            <p>Estimated price: <?php echo $c['value1']?></p>
            <div style="width: 150px">
              <a href="" onclick="return false" class="btn btn-small btn-warning case_row" data-id="<?php echo $c['id'];?>" price="<?php echo $c['value1'];?>">Add to cart</a>

              <a href="/cases?id=<?php echo $c['id'];?>" class="label label-info">Details</a></div>
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
      <li class="span2" >
        <div class="thumbnailx">
          <img src="/assets/images/260x180.gif" alt="" width="170">
          <div class="" >
            <h5>Title</h5>
            <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
            
          </div>
        </div>
      </li>

      <li class="span2" >
        <div class="thumbnailx">
          <img src="/assets/images/260x180.gif" alt="" width="170">
          <div class="">
            <h5>Title</h5>
            <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>

          </div>
        </div>
      </li>
      <li class="span2" >
        <div class="thumbnailx">
          <img src="/assets/images/260x180.gif" alt="" width="170">
          <div class="" >
            <h5>Title</h5>
            <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>

          </div>
        </div>
      </li>
    </ul> 
  </div>
</div>
