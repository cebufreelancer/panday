<div class="page-header">
  <h2>Registration for Companies</h2>
</div>

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
               
   

   $(".next").click(function(i) {
     console.log("here");
     
     if ($(this).attr("direction") == "next") {
       var valid = true;
        $($(".step").get(pos)).children().each(function(data){
            if($(this).attr("name"))
            {
              if(!$(this).valid()){valid = false;}
            }
        });
        
        if ($(this).attr("value") == "Opret din opgave") {
        }
        else if ($(this).attr("summary") == "true") {
          console.log('summary true');
          $("#summary").text("");
            if(valid == true)
            {
              console.log("fadeout1")
                pos++;
                $(".step").fadeOut(100);
                $($(".step").get(pos)).fadeIn(300);
            }
        }else {
         if(valid == true)
            {
              console.log("fadeout2");
              console.log(pos);
              pos++;
              console.log(pos);
              $(".step").fadeOut(100);
              $($(".step").get(pos)).fadeIn(300);
              console.log(pos);
            }
        }

        
     }else{
       console.log("fadeout3");
       pos--;
       $(".step").fadeOut(100);
       $($(".step").get(pos)).fadeIn(300);      
     }

     
     if(pos == 0){
       $($(".header-step").get(pos)).addClass("active");
       $($(".header-step").get(1)).removeClass("active");
       $($(".header-step").get(2)).removeClass("active");
     }else if(pos == 1) {
       $($(".header-step").get(1)).addClass("active");
       $($(".header-step").get(0)).removeClass("active");
       $($(".header-step").get(2)).removeClass("active");
     }else if (pos == 2) {
       $(".vtitle").text($("#title").val());
       $(".vdescription").text($("#description").val());
       $(".vbudget").text($("#budget_id option:selected").text());
       $(".vname").text($("#name").val());
       $(".vaddress").text($("#address").val());
       $(".vzipcode").text($("#zipcode").val());
       $(".vcity").text($("#city").val());
       $(".vemail").text($("#email").val());
       $(".vtelno").text($("#telno").val());
       branches = "";
       $(".branches").each(function(){
         if (this.checked == true) {
           branches = this.value + "," + branches;
         }
       });
       $(".vbranches").text(branches);
       
       $($(".header-step").get(2)).addClass("active");
       $($(".header-step").get(0)).removeClass("active");
       $($(".header-step").get(1)).removeClass("active");
     }
   });
   
});
 
</script>
<div>
  <?php if (validation_errors()) {?>
  <div class="alert alert-error">
    <a class="close" data-dismiss="alert">X</a>
    <?php echo validation_errors(); ?>
  </div>
  <?php }?>
  
  
  <form id="case-form" name="case-form" method="post" action="/register">
    <input type="hidden" name="sent" value="sent">
      <label> Company name *</label>
      <input type="text" name="company_name" value="<?php if (isset($_POST['company_name'])) echo $_POST['company_name'];?>" id="company_name" class="required input-xlarge">
      <label> Description  *</label>
      <textarea  name="description" id="description" class="required input-xxlarge" rows="2" maxlength="250"><?php if (isset($_POST['description'])){echo $_POST['description'];} ?></textarea>
      <label> Address *</label>
      <input type="text" name="address" id="address" value="<?php if (isset($_POST['address'])) echo $_POST['address'];?>" class="required input-xxlarge">
      <label> Zip code *</label>
      <input type="text" name="zipcode" id="zipcode" value="<?php if (isset($_POST['zipcode'])) echo $_POST['zipcode'];?>" class="required input-xxlarge">
      <label> City *</label>
      <input type="text" name="city" id="city" value="<?php if (isset($_POST['city'])) echo $_POST['city'];?>" class="required input-xxlarge">

      <label> Contact Person  *</label>
      <input type="text" name="contact_person" value="<?php if (isset($_POST['contact_person'])) echo $_POST['contact_person'];?>" id="contact_person" class="required input-xlarge">
      <label> CVR Number  *</label>
      <input type="text" name="cvrnumber" value="<?php if (isset($_POST['cvrnumber'])) echo $_POST['cvrnumber'];?>" id="cvrnumber" class="required input-xlarge">
      <label> Telephone Number:  *</label>
      <input type="text" name="telno" value="<?php if (isset($_POST['telno'])) echo $_POST['telno'];?>" id="telno" class="required input-xlarge">
      <label> Website URL:  *</label>
      <input type="text" name="website" value="<?php if (isset($_POST['website'])) echo $_POST['website'];?>" id="website" class=" input-xlarge">


      <label>Branches</label>
      <?php foreach($branches as $b){ ?>
      <label for="<?php echo $b['code'];?>" class="checkbox" style="display: inline-block !important; padding-right: 10px">
        <input type="checkbox" value="<?php echo $b['code'];?>" id="<?php echo $b['code'];?>" name="branches[]" class="branches required">
        <?php echo $b['name'];?>
      </label>
      <?php } ?>
      <br/>
      <label for="branches[]" generated=false class="error"></label>
      <br/>

      <h4> Login Information </h4>
      <label> Email *</label>
      <input type="text" name="email" id="email" value="<?php if (isset($_POST['email'])) echo $_POST['email'];?>" class="required email input-xxlarge">
      <label> Confirm Email *</label>
      <input type="text" name="cemail" id="cemail" value="<?php if (isset($_POST['cemail'])) echo $_POST['cemail'];?>" class="required email input-xxlarge">
        
      <label> Password: *</label>
      <input type="password" name="password" id="password" value="" class="required input-xxlarge">
      <label> Confirm Password: *</label>
      <input type="password" name="cpassword" id="cpassword" value="" class="required input-xxlarge">

      <br/>

      <input type="checkbox" name="agree" id="agree" class='required'> Agree
      <label for="agree" generated=false class="error"></label>
      <br/>
      <button data-loading-text="submitting..."  type="submit" class="btn btn-large btn-primary" autocomplete="off">Register</button>
    
  </form>
</div>

