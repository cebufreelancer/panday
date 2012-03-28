<script>
ncart = 0;
</script>
<div id="cart" onclick="location.replace('/account/cart');" style="margin-top: 8px">
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



<?php
$CI =& get_instance();
?>

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

<h3 class="">Login here</h3>
<?php if (isset($_GET['error'])) {?>
  <?php if ($_GET['error'] == "1"):?>
    <div class="alert alert-error">Incorrect username and password.</div>
  <?php endif?>
  <?php if ($_GET['error'] == "2"):?>
    <div class="alert alert-error">Please login to add items to cart.</div>
  <?php endif?>  
<?php } ?>
<form action="/login" class="well" id="login-form" name="login-form" method="post">
  <label>Email address</label>
  <input type="text" style="width: 120px" class="focused required" placeholder="email" name="email" id="email">
  <label>Password</label>
  <input type="password" style="width: 120px" class="focused required" placeholder="password" name="password" id="password">
  <a href="#" class="label label-info">Forget your password?</a>
  <div class="clearfix"></div>
  <br/>
  <button type="submit" class="btn">Log in</button>
  <br/>
</form>

  <?php
  require 'facebook.php';

  $facebook = new Facebook(array(
    'appId'  => '252289671527818',
    'secret' => 'e84ed389e3767b233c8b144069bf78f5',
  ));

  // Get User ID
  $user = $facebook->getUser();
  
  if ($user) {
    try {
      // Proceed knowing you have a logged in user who's authenticated.
      $user_profile = $facebook->api('/me');
    } catch (FacebookApiException $e) {
      error_log($e);
      $user = null;
    }
  }
  
  if ($user) {
    $logoutUrl = $facebook->getLogoutUrl();
  } else {
    $loginUrl = $facebook->getLoginUrl();
  }
  
 
  ?>
  
  <?php if ($user): ?>
    <a href="<?php echo $logoutUrl; ?>">Logout</a>
  <?php else: ?>
    <div>
      <a class="btn" href="<?php echo $loginUrl; ?>">Login with Facebook</a>
    </div>
  <?php endif ?>
  
  <?php if ($user): ?>
    <h3>You</h3>
    <img src="https://graph.facebook.com/<?php echo $user; ?>/picture">
    <pre><?php print_r($user_profile); ?></pre>

  <?php endif ?>
<?php endif ?>


<div class="well">Facebook page</div>
<div class="well">Ads</div>
<div class="well">Ads</div>