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

<h3>Invoices </h3>

<table class="table">
  <thead>
    <tr>
      <th>Description</th>
      <th>Total</th>
      <th>User</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($invoices as $invoice){?>
      <?php $user = $this->User->find_by_id($invoice['user_id'])?>
    <tr>
      <td width="100"><?php echo $invoice['description'];?></td>
      <td ><?php echo $invoice['total'];?></td>
      <td ><?php echo $invoice['user_id'];?></td>
      <td><?php echo $user['name']?></td>
      <td> 
        <a class="btn" href="/admin/invoiceview?id=<?php echo $invoice['id'];?>">View</a>
      </td>
    </tr>
    <?php } ?>
  </tbody>
</table>