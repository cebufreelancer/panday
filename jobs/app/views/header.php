<!DOCTYPE html>
<html lang="en">
  <head>
    <meta content='text/html; charset=utf-8' http-equiv='Content-Type' />
    <title>Company name - <?php echo $title; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="/assets/css/bootstrap.css" rel="stylesheet">
    <link href="/assets/stylesheets/custom.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
    </style>

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <script type="text/javascript" src="/assets/javascripts/jquery.js"></script>
    <script type="text/javascript" src="/assets/javascripts/jquery.cookie.js"></script>
    <script type="text/javascript" src="/assets/javascripts/jquery.validate.js"></script>
    <script type="text/javascript" src="/assets/javascripts/site.js"></script>

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="../assets/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">
  </head>

  <body>


    <div class='topbar'>
       <div class='header'>
         <div class='container'>
           <a class='brand' href='/' title=''>
             <img alt='Jobs Logo' height='30' src='/assets/images/company-logo.png' width='116' />
           </a>
           <h1 class='site-title'>
             <a href='/' title='Online jobs'>
               Jobs
             </a>
           </h1>

           <ul class='navc'>
             <li>
               <a class='<?php if ($active == ""){ echo "active"; }?>' href='<?php echo base_url(); ?>'>
                 Home
               </a>
             </li>
             <li>
               <a class='<?php if ($active == "cases"){ echo "active"; }?>' href='<?php echo base_url(); ?>cases'>
                 Cases
               </a>
             </li>
             <li>
               <a class='<?php if ($active == "create"){ echo "active"; }?>' href='<?php echo base_url(); ?>create'>
                 Create new cases
               </a>
             </li>
             <li>
               <a class='<?php if ($active == "companies"){ echo "active"; }?>' href='<?php echo base_url(); ?>companies'>
                 Companies
               </a>
             </li>
             <li>
               <a class='<?php if ($active == "about"){ echo "active"; }?>' href='<?php echo base_url(); ?>about'>
                 About us
               </a>
             </li>
             <li>
               <a class='<?php if ($active == "contactus"){ echo "active"; }?>' data-toggle="modal" href="#myModal" >
                 Contact Us
               </a>
             </li>
             
             <?php
             $CI =& get_instance();
             if ($CI->session->userdata('email')):
             ?>
             <li>
               <div class="btn-group">
                 <button class="btn" onclick="location.replace('/account')">Account</button>
                 <button class="btn dropdown-toggle" data-toggle="dropdown">
                   <span class="caret"></span>
                 </button>
                 <ul class="dropdown-menu">
                   <li style="width:90%"><a href="/account">Account</a></li>
                   <li style="width:90%"><a href="/account/cases">My Cases</a></li>

                   <?php if ($this->session->userdata('company')): ?>                     
                   <li style="width:90%"><a href="/account/cart">My Cart</a></li>
                   <?php endif ?>
                   <li style="width:90%"><a href="/account/changepw">Change Password</a></li>
                   <li style="width:90%"><a href="/account/bought">Bought</a></li>
                   <li class='divider'></li>
                   <li style="width:90%"><a href="/logout">Log-out</a></li>
                 </ul>
               </div>
             </li>
            <?php endif; ?>
             
           </ul>
                  
           
           
         </div>
       </div>
     </div>

<script>
$(document).ready(function(){
  $("#contact-form").validate({
    submitHandler: function(form){
      $("#contact-content").empty();
      $("#contact-content").append("Message successfully submitted.");
      $.ajax({
        type: 'POST',
        url: '/contactus',
        data: $(form).serializeArray(),
        success: function(data){
          
        }
      });
      return false;
    }
  });
});
</script>

     <div id="myModal" class="modal hide fade" style="display: none; ">
                 <div class="modal-header">
                   <a class="close" data-dismiss="modal">X</a>
                   <h3>Contact us</h3>
                 </div>
                 <div class="modal-body" id="contact-content">
                   <h4>Please fill in the form below.</h4>
                   
                   <form class="well" action="/contactus" method="post" name="contact-form" id='contact-form'>
                     <label>Name: </label>
                     <input type="text" name="con_name" id="con_name" class="required span3" >
                     <label>Email: </label>
                     <input type="text" name="con_email" id="con_email" class="required email span3" >
                     <label>Message: </label>
                     <textarea name="con_message" class="required span3" cols="5" rows="6"></textarea>
                     <div class="modal-footer span4 pull-left">
                       <a href="#" class="btn" data-dismiss="modal">Close</a>
                       <button type="submit" class="btn btn-primary">Send message</button>
                     </div>

                   </form>
                 </div>
                 
               </div>