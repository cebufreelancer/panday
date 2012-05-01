<?php if (isset($_GET['add'])) {?>
<div class="alert alert-success">
  Successfully added.
</div>  
<?php } ?>

<?php if (isset($_GET['delete'])) {?>
<div class="alert alert-success">
  Successfully deleted.
</div>  
<?php } ?>

<?php if (isset($_GET['update'])) {?>
<div class="alert alert-success">
  Successfully updated.
</div>  
<?php } ?>

<h3>News </h3>
<a href="/admin/news_add" class="btn">Add news</a>


<table class="table">
  <thead>
    <tr>
      <th>Image</th>
      <th>Title</th>
      <th>&nbsp;</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($news as $row){?>
    <tr>
      <td width="100"><img src="/assets/news/<?php echo $row['id'];?>/<?php echo $row['image'];?>" width="100" height="100"></td>
      <td ><?php echo $row['title'];?></td>
      <td> 
        <a class="btn" href="/admin/news_edit?id=<?php echo $row['id'];?>">Edit</a>
        <a class="btn" href="/admin/news_delete?id=<?php echo $row['id'];?>">Delete</a>
      </td>
    </tr>
    <?php } ?>
  </tbody>
</table>