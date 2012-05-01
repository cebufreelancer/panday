<div>&nbsp;</div>

<div class="row">
  <div class="span6">

    <table>
      <tr>
        <td width="82%">Invoice Number: <?php echo $invoice['id']?></td>
        <td><a href="/admin/pdf?id=<?php echo $_GET['id'];?>" class="label">Download PDF</a></td>
      </tr>

      <tr>
        <td>Invoice Date: <?php echo date("d-m-Y", strtotime($invoice['created_at']))?></td>
        <td></td>
      </tr>
    </table>
    
    <br/>
    <table class="table" >
      <tr>
        <td><strong>Description</strong></td>
        <td></td>
        <td><strong>Amount in DKK:</strong></td>
      </tr>
      
      <?php foreach($items as $item){?>
      <tr>
        <td><?php echo $item['description']?></td>
        <td>DKK</td>
        <td><?php echo $item['price']?></td>
      </tr>
      <?php } ?>

      <tr>
        <td>TOTAL Invoice amount in DKK:</td>
        <td>DKK</td>
        <td><?php echo $invoice['total']?></td>
      </tr>

      <tr>
        <td style="border-top: solid 1px #ccc">TAX 25%</td>
        <td style="border-top: solid 1px #ccc">DKK</td>
        <td style="border-top: solid 1px #ccc"><?php echo ($invoice['total'] * .25) ?></td>
      </tr>

    </table>
  </div>
</div>
