<div class="page-header">
  <h2>My Account</h2>
</div>

<div class="row">
  <div class="span6">

    <script>
    pos = 0;
    $(document).ready(function(){

       $("#case-form").validate({
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

    <?php if (isset($_GET['updated'])): ?>
    <div class="alert alert-success">
      <a class="close" data-dismiss="alert">×</a>
      Successfully updated.
    </div>
    <?php endif ?>

      <form id="case-form" name="case-form" method="post" action="/account/update">
        <div class="">
          <label> Name *</label>
          <input type="text" name="name" id="name" value="<?php if($user){ echo $user['name'];}?>" class="required input-xxlarge">
          <label> Address *</label>
          <input type="text" name="address" id="address" value="<?php if($user){ echo $user['address'];}?>" class="required input-xxlarge">
          <label> Zip code *</label>
          <input type="text" name="zipcode" id="zipcode" value="<?php if($user){ echo $user['zipcode'];}?>" class="required input-xxlarge">
          <label> City *</label>
          <input type="text" name="city" id="city" value="<?php if($user){ echo $user['city'];}?>" class="required input-xxlarge">
          <label> Email *</label>
          <input type="text" name="email" id="email" value="<?php if($user){ echo $user['email'];}?>" class="required email input-xxlarge" readonly>

          <label> Tel. Number *</label>
          <input type="text" name="telno" id="telno" value="<?php if($user){ echo $user['telno'];}?>" class="required input-xxlarge">
                    <br/>
          
          <button type="submit" class="btn btn-large btn-primary">Submit</button>
        </div>
      </form>

    
  </div>
</div>