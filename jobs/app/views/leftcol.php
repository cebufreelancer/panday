<?php if ($this->session->userdata('email')) {?>
<div >&nbsp;</div>
<?php } ?>
<div >&nbsp;</div>

<div class="row">
  <div class="span2">
    
    <?php if (sizeof($news) > 0): ?>
    <h3  style="text-align: center">What's new!</h3>
    <ul class="nav nav-list">
      <?php foreach($news as $n) {?>
      <li>
        <p><img src="/assets/images/sample1.jpg" width="150" ></p>
        <p class=""><?php echo $n['title'];?></p>
        <p><a class="label label-info" href="/news?id=<?php echo $n['id'];?>">View details &raquo;</a></p>
      </li>
      <?php } ?>
    </ul>
    <?php endif ?>
    
  </div>
</div>