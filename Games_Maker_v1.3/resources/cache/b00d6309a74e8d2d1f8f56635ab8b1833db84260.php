  <div class="ui inverted huge borderless fixed fluid menu" style="background-color: #38729d;border-bottom-left-radius: 30% !important;border-bottom-right-radius: 30% !important;">
    <div class="header item" href="#">
      <a href="<?php echo e(route('home')); ?>"><img class="logo" width="200px" src="<?php echo e(url('img/banner.png')); ?>" /></a>
    </div>
    
    <div class="right menu" style="margin-right: 25px">
        <div class="ui simple dropdown item">
          <?php echo e($_COOKIE['fullname']); ?><i class="dropdown icon"></i>
          <div class="menu">
            <a class="item" href="<?php echo e(route('logout')); ?>">Log Out <i class="lock icon red"></i></a>
          </div>
        </div>
    </div>
  </div>