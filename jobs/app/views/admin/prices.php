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

<h3>Prices </h3>
<a href="/admin/price_add" class="btn">Add price</a>


<table class="table">
  <thead>
    <tr>
      <th>Word</th>
      <th>price</th>
      <th>&nbsp;</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($prices as $p){?>
    <tr>
      <td width="100"><?php echo $p['label']?></td>
      <td ><?php echo $p['value1'];?></td>
      <td> 
        <a class="btn" href="/admin/price_edit?id=<?php echo $p['id'];?>">Edit</a>
        <a class="btn" href="/admin/price_delete?id=<?php echo $p['id'];?>">Delete</a>
      </td>
    </tr>
    <?php } ?>
  </tbody>
</table>