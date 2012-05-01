<div class="page-header" style="padding-left: 20px">
  <h2>Admin Log-in</h2>
</div>

<div class="row">
  <div class="span6" style="padding-left: 20px">

    <script>
    pos = 0;
    $(document).ready(function(){

       $("#login-form").validate({
                   rules: {                 
                       email: {
                           required: true,
                           email: true
                       },
                       password: {
                         minlength: 4
                       }

                   },
                   validClass: "ok",
                   messages: {
                     password: {
                       required: "Password is required."
                     }
                   },
                   submitHandler: function(form){
                     form.submit();
                   }
                  });

    });
    </script>

    <?php if (isset($error)) {?>
      <?php if ($error == "1"):?>
        <div class="alert alert-error">Incorrect username and password.</div>
      <?php endif?>
    <?php } ?>
    
      <form id="login-form" name="login-form" method="post" action="/admin/login">
        <input type="hidden" name="returl" value="/loginform">
        <label>Username</label>
        <input type="text" style="width: 320px" class="focused required" placeholder="username" name="username" id="username" value="<?php if (isset($_POST['username'])){ echo $_POST['username'];} ?>">
        <label>Password</label>
        <input type="password" style="width: 320px" class="focused required" placeholder="password" name="password" id="password">
        <br/>
        <a href="/forget" class="label label-info">Forgot your password?</a>
        <div class="clearfix"></div>
        <br/>
        <button type="submit" class="btn">Log in</button>
        <br/>
      </form>

    
  </div>
</div>