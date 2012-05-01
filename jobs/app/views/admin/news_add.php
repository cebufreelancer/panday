Add news
<?php if (isset($error)) { ?>
  <div class="alert alert-error">
    <ul>
      <?php foreach($error as $err) {?>
        <li><?php echo $err;?></li>    
      <?php } ?>
    <ul>
  </div>
<?php } ?>
<form action="/admin/news_add" method="post" class="well" enctype="multipart/form-data">
  <input type="hidden" name="submit" value="submit">
  <label>Title</label>
  <input type="text" class="span3" name="title">
  <label>Contents</label>
  <textarea name="contents" class="span6" rows="6"></textarea>
  <label>Image</label>
  <input type="file" name="image">

  <br/>
  <input type="submit" value="Submit" class="btn" />

</form>