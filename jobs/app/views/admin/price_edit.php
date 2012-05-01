Edit price
<?php if (isset($error)) { ?>
  <div class="alert alert-error">
    <ul>
      <?php foreach($error as $err) {?>
        <li><?php echo $err;?></li>    
      <?php } ?>
    <ul>
  </div>
<?php } ?>
<form action="/admin/price_edit?id=<?php echo $_GET['id'];?>" method="post" class="well" >
  <input type="hidden" name="submit" value="submit">
  <label>Label</label>
  <input type="text" class="span3" name="label" value="<?php echo $price['label'];?>">
  <label>Price</label>
  <input type="text" class="span3" name="value1" value="<?php echo $price['value1'];?>">

  <br/>
  <input type="submit" value="Update" class="btn" />
  <a href="/admin/prices" class="btn">Cancel</a>

</form>