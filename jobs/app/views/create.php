
<div class="page-header">
  <h2>Create a new case</h2>
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

<ul class="nav nav-tabs">
  <li class="active header-step" title="0">
    <a href="#">Beskriv din opgave</a>
  </li>
  <li id="two" class="header-step" title="1"><a href="#" >Indtast kontakinfo</a></li>
  <li id="three" class="header-step" title="2" summary="true"><a href="#">Godkend & send</a></li>
</ul>
<div>
  <form id="case-form" name="case-form" method="post" action="/create_case">
    <div class='step'>
      <label> Title *</label>
      <input type="text" name="title" value="<?php if (isset($_POST['title'])){echo $_POST['title'];}?>" id="title" class="required input-xxlarge">
      <label> Description  *</label>
      <textarea  name="description" id="description" class="required input-xxlarge" rows="2" maxlength="250"><?php if (isset($_POST['description'])){echo $_POST['description'];} ?></textarea>
      <label> Budget * </label>
      <select class="required input-xxlarge" id="budget_id" name="budget_id">
        <option value="">Select budget </option>
        <?php foreach($prices as $p){?>
        <option value="<?php echo $p['id'];?>"><?php echo $p['label'];?></option>
        <?php } ?>
      </select>

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
      <button type="button" class="btn btn-large btn-primary next"  direction="next">Next step</button>
    </div>

    <div class="step hide">
      <label> Name *</label>
      <input type="text" name="name" id="name" value="<?php if($user){ echo $user['name'];}?>" class="required input-xxlarge">
      <label> Address *</label>
      <input type="text" name="address" id="address" value="<?php if($user){ echo $user['address'];}?>" class="required input-xxlarge">
      <label> Zip code *</label>
      <input type="text" name="zipcode" id="zipcode" value="<?php if($user){ echo $user['zipcode'];}?>" class="required input-xxlarge">
      <label> City *</label>
      <input type="text" name="city" id="city" value="<?php if($user){ echo $user['city'];}?>" class="required input-xxlarge">
      <label> Email *</label>
      <input type="text" name="email" id="email" value="<?php if($user){ echo $user['email'];}?>" class="required email input-xxlarge">
      <label> Confirm Email *</label>
      <input type="text" name="cemail" id="cemail" value="<?php if($user){ echo $user['email'];}?>" class="required email input-xxlarge">

      <label> Tel. Number *</label>
      <input type="text" name="telno" id="telno" value="<?php if($user){ echo $user['telno'];}?>" class="required input-xxlarge">
      <?php if (!$user): ?>
      <label> Password: *</label>
      <input type="password" name="password" id="password" value="" class="required input-xxlarge">
      <label> Confirm Password: *</label>
      <input type="password" name="cpassword" id="cpassword" value="" class="required input-xxlarge">
      <?php endif; ?>
      <br/>
      <button type="button" class="btn btn-large next" direction="prev">Prev</button>
      <button type="button" class="btn btn-large btn-primary next" summary="true" direction="next">Next</button>
    </div>
    
    <div class="step hide">
      <label> <strong>Title:</strong> <span class="vtitle"></span></label>
      <label> <strong>Description:</strong> <span class="vdescription"></span></label>
      <label> <strong>Budget:</strong> <span class="vbudget"></span></label>
      <label> <strong>Branches:</strong> <span class="vbranches"></span></label>
      <label> <strong>Name:</strong> <span class="vname"></span></label>
      <label> <strong>Address:</strong> <span class="vaddress"></span></label>
      <label> <strong>Zip Code:</strong> <span class="vzipcode"></span></label>
      <label> <strong>City:</strong> <span class="vcity"></span></label>
      <label> <strong>Email:</strong> <span class="vemail"></span></label>
      <label> <strong>Tel. Number:</strong><span class="vtelno"></span></label>
      <br/>
      <input type="checkbox" name="agree" id="agree" class='required'> Agree
      <label for="agree" generated=false class="error"></label>
      <br/>
      <button type="button" class="btn btn-large next" direction="prev">Prev</button>
      <button type="submit" class="btn btn-large btn-primary">Submit</button>
    </div>
    
  </form>
</div>

