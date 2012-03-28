<div class="page-header">
  <h2>Change password</h2>
</div>

<div class="row">
  <div class="span6">

    <script>
    pos = 0;
    $(document).ready(function(){

       $("#changepw-form").validate({
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

    <?php if (isset($changed)) {?>
    <div class="alert alert-success"> Password successfully changed.</div>
    <?php } ?>

    <?php if (isset($changed)) {?>
    <div class="alert alert-success"> Password successfully changed.</div>
    <?php } ?>
    
      <form id="changepw-form" name="changepw-form" method="post" action="/changepw">
        <div class="">
          <label> Current Password: *</label>
          <input type="password" name="curpassword" id="curpassword" value="" class="required input-xxlarge">
          <label> Password: *</label>
          <input type="password" name="password" id="password" value="" class="required input-xxlarge">
          <label> Confirm Password: *</label>
          <input type="password" name="cpassword" id="cpassword" value="" class="required input-xxlarge">
          <br/>
          
          <button type="submit" name="Submit" class="btn btn-large btn-primary">Submit</button>
        </div>
      </form>

    
  </div>
</div>