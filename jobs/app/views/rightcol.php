<?php
$CI =& get_instance();
?>
<?php if ($this->session->userdata('email')) {?>
<div >&nbsp;</div>
<?php } ?>
<div >&nbsp;</div>
  <script>
  ncart = 0;
  </script>
  <div id="cart" onclick="location.replace('/account/cart');" style="margin-top: 8px; cursor:pointer" onmouseover="$(this).css('text-decoration', 'underline')" onmouseout="$(this).css('text-decoration', 'none')">
    <i class="icon-shopping-cart"></i>
    <span>
    <?php

    if ($this->session->userdata('company')) {
      $cart_items = $this->Cart->mycart($this->session->userdata('id'));
    }else{
      $query = $this->db->query("select * from carts where cart_session='" . $this->session->userdata('cart_session') . "'"); 
      $cart_items = $query->result_array();
    }
    if (sizeof($cart_items) > 0) {
    ?>
    <?php echo sizeof($cart_items) ?> items.

    <?php }else{?>
     Your cart is empty
    <?php }?>
    </span>
  </div>





<?php if (!$CI->session->userdata('email')):?>
  <script>
  $(function() {
    $("#login-form").validate({
       submitHandler: function(form){
         form.submit();
       }
    });
  });
  </script>

  <?php
  require 'facebook.php';

  $facebook = new Facebook(array(
    'appId'  => '252289671527818',
    'secret' => 'e84ed389e3767b233c8b144069bf78f5',
  ));


  // Get User ID
  $fbuser = $facebook->getUser();
  
  if ($fbuser) {
    try {
      // Proceed knowing you have a logged in user who's authenticated.
      $user_profile = $facebook->api('/me');
    } catch (FacebookApiException $e) {
      error_log($e);
      $fbuser = null;
    }
  }
  
  if ($fbuser) {
    $logoutUrl = $facebook->getLogoutUrl();
  } else {
    $loginUrl = $facebook->getLoginUrl();
  }

 
  ?>

  <h3 class=""  style="text-align: center">Login here</h3>
  <?php if (isset($_GET['error'])) {?>
    <?php if ($_GET['error'] == "1"):?>
      <div class="alert alert-error">Incorrect username and password.</div>
    <?php endif?>
    <?php if ($_GET['error'] == "2"):?>
      <div class="alert alert-error">Please login to add items to cart.</div>
    <?php endif?>  
  <?php } ?>
  <form action="/login" class="well" style="padding:10px !important" id="login-form" name="login-form" method="post">
    <label>Email address</label>
    <input type="text" style="width: 120px" class="focused required" placeholder="email" name="email" id="email">
    <label>Password</label>
    <input type="password" style="width: 120px" class="focused required" placeholder="password" name="password" id="password">
    <a href="/forget" class="label label-info">Forgot your password?</a>
    <div class="clearfix"></div>
    <br/>
    <button type="submit" class="btn">Log in</button>
    <br/>
    <?php if ($fbuser): ?>
      <a href="<?php echo $logoutUrl; ?>">Logout</a>
    <?php else: ?>
      <a class="btn" href="<?php echo $loginUrl; ?>">Login with Facebook</a>
    <?php endif ?>  
  </form>
  
<?php endif ?>



<div class="well">Facebook page</div>
<div class="well">Ads</div>
<div class="well">Ads</div>
