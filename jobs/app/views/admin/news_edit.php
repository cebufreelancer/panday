Edit news
<?php if (isset($error)) { ?>
  <div class="alert alert-error">
    <ul>
      <?php foreach($error as $err) {?>
        <li><?php echo $err;?></li>    
      <?php } ?>
    <ul>
  </div>
<?php } ?>
<form action="/admin/news_edit?id=<?php echo $_GET['id'];?>" method="post" class="well" enctype="multipart/form-data">
  <input type="hidden" name="submit" value="submit">
  <label>Title</label>
  <input type="text" class="span3" name="title" value="<?php echo $news['title'];?>">
  <label>Contents</label>
  <textarea name="contents" class="span6" rows="6"><?php echo $news['contents'];?></textarea>
  <label>Image</label>
  <input type="file" name="image">

  <?php if (file_exists("./assets/news/" . $news['id'] . "/")){ ?>
    <img src="/assets/news/<?php echo $news['id'];?>/<?php echo $news['image'];?>" width="100" height="100">
  <?php } ?>
  <br/>
  <input type="submit" value="Submit" class="btn" />

</form>