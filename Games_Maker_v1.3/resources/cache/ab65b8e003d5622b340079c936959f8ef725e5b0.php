	<div class="ui inverted huge borderless fixed fluid menu" style="background-color: #38729d;border-bottom-left-radius: 30% !important;border-bottom-right-radius: 30% !important;">
	    <div class="header item" href="#">
	      <a href="<?php echo e(route('home')); ?>"><img class="logo" width="200px" src="<?php echo e(url('img/banner.png')); ?>" /></a>
	    </div>
      <div class="ui simple item">
        <div class="ui red image label" style="font-size: 18px;padding: 8px;width: 250px !important;margin-left:0px;">
          <i class="icon gift"></i>
          <a id="game_state_name" href="<?php echo e(route('buildGame')); ?>"><?php echo e($gameName); ?>: <?php echo e($firstStateName); ?></a>
          <input type="hidden" id="game_name" value="<?php echo e($gameName); ?>">
        </div>
      </div>

      
      <div class="ui simple item">
        <div class="ui label" style="font-size: 20px;padding: 6px;min-width: 120px;margin-left:0px;">
          <i class="icon cube"></i>
          <span id="pixelCordinates">0:0</span>
        </div>
      </div>

      <div class="ui simple item levelGridIcons" style="height: 45px;margin-left: 30px;margin-top: 15px;margin-bottom: 7px;border-radius: 25%;background-color: #0b9c96;">
          <i class="hand point up icon selectedIcon handPointer" data-content="Hand" data-variation="mini" style="margin-left: 15px;font-size: 25px;cursor: pointer;"></i>
          <i class="move icon moveGrid" data-content="Move Grid" data-variation="mini" style="margin-left: 10px;font-size: 25px;cursor: pointer;"></i>
          <i class="sync icon syncGrid" data-content="Original Place" data-variation="mini" style="margin-left: 15px;font-size: 25px;cursor: pointer;"></i>
          <i class="save icon" data-content="Save Level" data-variation="mini" style="margin-left: 15px;font-size: 25px;cursor: pointer;"></i>
      </div>

	    <div class="right menu" style="margin-right: 25px">
        <div class="ui simple dropdown item">
          <?php echo e($_COOKIE['fullname']); ?><i class="dropdown icon"></i>
          <div class="menu">
            <a id="play_game_btn" class="item" href="#">Play Game <i class="game icon green"></i></a>
            <a class="item" href="<?php echo e(route('logout')); ?>">Log Out <i class="lock icon red"></i></a>
          </div>
        </div>
	    </div>
	</div>