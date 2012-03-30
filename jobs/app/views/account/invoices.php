<div class="page-header">
  <h2>Invoices</h2>
</div>

<div class="row">
  <div class="span6">
    
    <table class="table">
      <tbody>
        <?php foreach($invoices as $inv){ ?>
        <tr>
          <td><?php echo $inv['description']?></td>
          <td><?php echo $inv['total'];?></td>
          <td>
            <p>Date created: <?php echo date("d-m-Y", strtotime($inv['created_at']));?> </p>
          </td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
    
  </div>
</div>