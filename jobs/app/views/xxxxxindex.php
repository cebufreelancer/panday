<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Bootstrap, from Twitter</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->

    <link href="../assets/css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
    </style>
    <link href="../assets/css/bootstrap-responsivexx.css" rel="stylesheet">

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="../assets/ico/favicon.ico">

    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">
  </head>

  <body>

    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">

          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="#"><img src="../assets/images/company-logo.png"></a>
          <div class="nav-collapse">
            <ul class="nav">
              <li class="active"><a  href='<?php echo base_url(); ?>'>Home</a></li>              
              <li>
                <a class='' href='<?php echo base_url(); ?>cases'>
                  Cases
                </a>
              </li>
              <li>
                <a class='' href='<?php echo base_url(); ?>create'>
                  Create new cases
                </a>
              </li>
              <li>
                <a class='' href='<?php echo base_url(); ?>reference'>
                  Reference
                </a>
              </li>
              <li>
                <a class='' href='<?php echo base_url(); ?>about'>
                  About us
                </a>
              </li>
              <li>
                <a class='' href='<?php echo base_url(); ?>contactus' >
                  Contact Us
                </a>
              </li>
              
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>

    </div>

    <div class="container">

      <!-- Main hero unit for a primary marketing message or call to action -->

      <section>
      <div class="row">
        <div class="span2">
          <h3>What's new!</h3>

          <ul class="thumbnails">
            <li class="span2">
              <div class="thumbnail">
                <img src="/assets/images/sample1.jpg" >
                <div class="caption">
                  <h5>Title here</h5>
                  <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus.</p>
                  <p><a href="#" class="label label-info">more</a></p>
                </div>
              </div>
            </li>
            <li class="span2">
              <div class="thumbnail">
                <img src="/assets/images/sample1.jpg" >
                <div class="caption">
                  <h5>Title here</h5>
                  <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus.</p>
                  <p><a href="#" class="label label-info">more</a></p>
                </div>
              </div>
            </li>
          </ul>          
        </div>


        
        <div class="span8">
          <div class="row">
            <div class="span3">
              <h3> Fa 3 gratis </h3>
              <ul>
                <li> Donec id elit non mi porta gravida at eget </li>
                <li> Donec id elit non mi porta gravida at eget </li>
                <li> Donec id elit non mi porta gravida at eget </li>
              </ul>
            </div>
            <div class="span3">
              <form class="form-horizontal ">
                <fieldset>
                    <div class="control-group">
                      <label class="control-label"  for="input01">Headline</label>
                      <div class="controls" >
                        <input type="text" class="input-medium" id="input01">
                      </div>
                    </div>
                    <div class="control-group">
                      <label class="control-label"  for="input01">Description</label>
                      <div class="controls" >
                        <textarea class="input-medium" id="input01" rows="4"></textarea>
                      </div>
                    </div>
                    <div class="control-group">
                      <div class="controls" >
                        <button class="btn btn-primary">Opret en byggeopgave</button>
                      </div>
                    </div>

                  </fieldset>
              </form>
            </div>
          </div>
        </div>



       
        <div class="span2">
          <h3 class="">Login here</h3>
          <form class="well">
            <label>Email address</label>
            <input type="text" class="focused input-small" placeholder="email">
            <label>Password</label>
            <input type="text" class="focused input-small" placeholder="password">
            <a href="#" class="label label-info">Forget your password?</a>
            <div class="clearfix"></div>
            <br/>
            <button type="submit" class="btn">Log in</button>
          </form>
          
          <?php
          require '/Users/admin/Sites/jobs/app/facebook-php-sdk/src/facebook.php';

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
        </div>
        
        
      </div>
      </section>

      <hr>

      <footer>
        <p>&copy; Company 2012</p>
      </footer>

    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

    <script src="../assets/js/jquery.js"></script>
    <script src="../assets/js/bootstrap-transition.js"></script>
    <script src="../assets/js/bootstrap-alert.js"></script>
    <script src="../assets/js/bootstrap-modal.js"></script>
    <script src="../assets/js/bootstrap-dropdown.js"></script>
    <script src="../assets/js/bootstrap-scrollspy.js"></script>

    <script src="../assets/js/bootstrap-tab.js"></script>
    <script src="../assets/js/bootstrap-tooltip.js"></script>
    <script src="../assets/js/bootstrap-popover.js"></script>
    <script src="../assets/js/bootstrap-button.js"></script>
    <script src="../assets/js/bootstrap-collapse.js"></script>
    <script src="../assets/js/bootstrap-carousel.js"></script>

    <script src="../assets/js/bootstrap-typeahead.js"></script>

  </body>
</html>
