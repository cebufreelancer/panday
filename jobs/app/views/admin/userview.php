<h3><?php echo $user['name']?></h3>

<table class='table'>
  <tr>
    <td>Email: </td>
    <td><?php echo $user['email'];?></td>
  </tr>
  <tr>
    <td>Address: </td>
    <td><?php echo $user['address'];?></td>
  </tr>
  <tr>
    <td>Zipcode: </td>
    <td><?php echo $user['zipcode'];?></td>
  </tr>
  <tr>
    <td>City: </td>
    <td><?php echo $user['city'];?></td>
  </tr>
  <tr>
    <td>Tel. No.: </td>
    <td><?php echo $user['telno'];?></td>
  </tr>
</table>

<a href="/admin/users" class="btn"> <i class="icon-chevron-left"></i>Back </a>