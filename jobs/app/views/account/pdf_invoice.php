<table width="780px">
  <tr >
    <td width="500px"><img src="<?php echo $this->config->base_url(); ?>/assets/images/logo.png"></td>
    <td width="170px">
    Our Company Inc <br/>
    www.company.com
    </td>
  </tr>
  
  <tr>
    <td>
    <?php echo $user['name']; ?><br/>
    <?php echo $user['address'];?> <br/>
    Attn: <?php echo $user['contact_person'];?> <br/>
    </td>
    <td>
    Invoice No.:  <?php echo $invoice['id']?> <br/>
    Invoice Date: <?php echo date("d-m-Y", strtotime($invoice['created_at']))?> <br/>
    </td>
  </tr>
  
  <tr>
    <td> Product description </td>
    <td> Amount in DKK</td>
  </tr>
  <tr>
    <td> </td>
    <td> </td>
  </td>
  

  <?php foreach($invoice_items as $item){?>
  <tr>
    <td><?php echo $item['description']?></td>
    <td>DKK <?php echo $item['price']?></td>
  </tr>
  <?php } ?>

  <tr >
    <td height="10">&nbsp;</td>
    <td> </td>
  </td>
  <tr>
    <td><strong>TOTAL Invoice amount in DKK:</strong></td>
    <td><strong>DKK <?php echo $invoice['total']?></strong></td>
  </tr>

  <tr>
    <td style="border-top: solid 1px #ccc">TAX 25%</td>
    <td style="border-top: solid 1px #ccc">DKK <?php echo ($invoice['total'] * .25) ?></td>
  </tr>
  
          
</table>