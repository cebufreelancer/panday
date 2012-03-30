<div class="page-header">
  <h2>My Cart</h2>
</div>

<div class="row">
  <div class="span6">
    <?php if (empty($items)) {?>
      <div class="alert alert-success">Cart is empty.</div>
    <?php }else{ ?>
    <label class="pull-right btn btn-info"><a href="/account/cart-empty">Empty cart</a></label>
    <table class="table">
      <tbody>
        <?php $total = 0; ?>
        <?php foreach($items as $c){ ?>
          <?php
          $total += $c['value1'];
          ?>
        <tr>
          <td><img class="" src="/assets/images/260x180.gif" alt="" width="80" align="left" style="padding: 0px 5px 5px 0px"></td>
          <td><h5><?php echo $c['title'];?></h5>
          <p><?php echo $c['description'];?></p>
          </td>
          <td>
            <p>Date posted: <?php echo date("d-m-Y", strtotime($c['created_at']));?> </p>
            <p>Estimated price: <?php echo $c['value1']?></p>
            <a href="/account/cart-delete?id=<?php echo $c['cid'];?>" class="label label-important">Delete</a>
          </td>
        </tr>
        <?php } ?>
        <tr>
          <td colspan="3">
          <div align="right"><strong>Total: <?php echo number_format($total,2);?></strong></div>
          </td>
        </tr>
      </tbody>
    </table>

    <label class="pull-right btn btn-success"><a href="/account/checkout">Checkout</a></label>

    <?php } ?>
    

  </div>
</div>
