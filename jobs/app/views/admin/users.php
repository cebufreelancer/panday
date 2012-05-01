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


<?php if (isset($_GET['t'])) {?>
<h3>Companies </h3>  
  <a class="btn" href="/admin/users?t=c">All Companies</a>
  <a class="btn" href="/admin/users?t=c&s=1">Activated Companies</a>
  <a class="btn" href="/admin/users?t=c&s=0">Not Activated Companies</a>
<?php } else {?>
<h3>Users </h3>  
<a class="btn" href="/admin/users">All Users</a>
<a class="btn" href="/admin/users?s=1">Activated Users</a>
<a class="btn" href="/admin/users?s=0">Not Activated Users</a>
<?php } ?>

<table class="table">
  <thead>
    <tr>
      <th>Name</th>
      <th>Email</th>
      <th>Zipcode</th>
      <th>City</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($users as $user){?>
    <tr>
      <td width="100"><?php echo $user['name'];?></td>
      <td ><?php echo $user['email'];?></td>
      <td ><?php echo $user['zipcode'];?></td>
      <td ><?php echo $user['city'];?></td>
      <td> 
        <a class="btn" href="/admin/userview?id=<?php echo $user['id'];?>">View</a>
      </td>
    </tr>
    <?php } ?>
  </tbody>
</table>