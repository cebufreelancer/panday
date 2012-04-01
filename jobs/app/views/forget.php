<div class="page-header">
  <h2>Forgot your password</h2>
</div>

<div class="row">
  <div class="span6">

    <script>
    pos = 0;
    $(document).ready(function(){
      $("#email").focus();
       $("#form").validate({
                   rules: {                 
                       title: {
                           required: true,
                           minlength: 5
                       },
                       description: {
                           required: true,
                           minlength: 20
                       },
                      name: {
                           required: true,
                           minlength: 2
                       },
                       address: {
                           required: true,
                           minlength: 5
                       },
                       email: {
                           required: true,
                           email: true
                       },
                       zipcode: {
                           required: true,
                           minlength: 4,
                           maxlength: 4
                       },
                       telno: {
                           required: true,
                           minlength: 8,
                           maxlength: 15
                       },
                       cemail: {
                         equalTo:"#email",
                       },
                       cpassword:{
                           equalTo:"#password",
                           minlength: 6
                       },
                       password: {
                         minlength: 6
                       },
                       city: "required"
                   },
                   validClass: "ok",
                   errorLabelContainer: ".errorBox",
                   wrapper: "p",
                   messages: {
                     password: {
                       required: "Password is required."
                     },
                     cpassword: {
                       required: "Password confirmation field is required.",
                       equalTo: "Entered passwords do not match."
                     },
                     cemail: {
                       equalTo: "Entered email do not match"
                     }
                   },
                   submitHandler: function(form){
                     form.submit();
                   }
                  });




    });
    </script>

    <?php if (isset($error)) {?>
    <div class="alert alert-error"><?php echo $error;?></div>
    <?php } ?>

    <?php if (isset($submitted)) {?>
    <div class="alert alert-success">We have emailed you password reset instructions. Check your email.</div>
    <?php }else{ ?>
    
      <form id="form" name="form" method="post" action="/forget">
        <input type="hidden" name="sent" value="sent">
        <div class="">
          <label> Enter your email address</label>
          <input type="text" name="email" id="email" value="" class="email required input-xxlarge">
          <br/>
          
          <button type="submit" name="Submit" class="btn btn-large btn-primary">Submit</button>
        </div>
      </form>
    <?php } ?>
    
  </div>
</div>