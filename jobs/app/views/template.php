<?php require_once('header.php'); ?>

    <div class="container">
      <div class="row">
        <div class="span2">
          <?php require_once('leftcol.php'); ?>
        </div>

        <div class="span6">
          <?php if ($this->session->userdata('email')) {?>
            <div >&nbsp;</div>
          <?php } ?>
          
          <?php $this->load->view($content_view); ?>
        </div>

       
        <div class="span2">
          <?php if ( isset($active) && $active != "loginform" ) { ?>
            <?php require_once("rightcol.php"); ?>
          <?php }?>
        </div>
      </div>

      <hr>
      <footer>
        <p>&copy; Jobs Company 2012</p>
      </footer>

    </div>


    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="/assets/js/bootstrap-transition.js"></script>
    <script src="/assets/js/bootstrap-alert.js"></script>
    <script src="/assets/js/bootstrap-modal.js"></script>
    <script src="/assets/js/bootstrap-dropdown.js"></script>
    <script src="/assets/js/bootstrap-scrollspy.js"></script>
    <script src="/assets/js/bootstrap-tab.js"></script>
    <script src="/assets/js/bootstrap-tooltip.js"></script>
    <script src="/assets/js/bootstrap-popover.js"></script>
    <script src="/assets/js/bootstrap-button.js"></script>
    <script src="/assets/js/bootstrap-collapse.js"></script>
    <script src="/assets/js/bootstrap-carousel.js"></script>
    <script src="/assets/js/bootstrap-typeahead.js"></script>

  </body>
</html>