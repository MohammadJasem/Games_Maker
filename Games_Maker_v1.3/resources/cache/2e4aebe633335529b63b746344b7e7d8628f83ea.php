<?php $__env->startSection('title','Home'); ?>

<?php $__env->startSection('content'); ?>


<form id="addGameForm" class="hide">
  <div class="ui equal width form">
      <div class="field">
        <label for="game_name">Name</label>
        <div class="ui corner labeled input">
          <input type="text" id="game_name" name="game_name" class="gm_req">
          <?php echo $__env->make('partials.req_star', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>
      </div>
      <div class="fields" style="margin-top: 30px;">
        <div class="field">
          <label for="game_ver">Version</label>
          <div class="ui corner labeled input">
            <input type="text" id="game_ver" name="game_ver" class="gm_req gm_number">
            <?php echo $__env->make('partials.req_star', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
          </div>
        </div>
        <div class="field">
          <label for="dimension">Dimension</label>
          <div class="ui corner labeled input">
            <select id="dimension" name="dimension" class="ui dropdown gm_req" >
              <option value=""></option>
              <option value="2D">2D</option>
              <option value="3D">3D</option>
            </select>
            <?php echo $__env->make('partials.req_star', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
          </div>
        </div>
    </div>

      <div class="fields">
          <div class="field">
              <input type="file" name="gameLogo" id="gameLogo" class="filepond" data-max-file-size="10MB" accept="">
          </div>
      </div>
  </div>
    <br>
    <br>
    <br>
</form>




<div class="bgimg" style="background-image: url('<?php echo e(url('img/login_reg.jpg')); ?>');padding-bottom: 100px;">

  <?php echo $__env->make('partials.home_header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<input type="hidden" id="gamesCount" value="<?php echo e(count($userGames)); ?>">
  <div class="ui container" style="padding-top: 100px">
    <div class="ui segment" style="background: transparent;border: none;">
      <h1 style="color:white;display: inline;">Your Games</h1>
      <div id="newGameId" class="ui green button right labeled icon" style="float:right;margin-left:20px;padding: 17px;">New Game <i class="icon add plus"></i></div>
      <div class="ui gray label" style="float:right;">
          <span class="ui" style="padding-left:10px;">Account Type: <strong style="color:black;">free</strong></span>
          <span class="ui" style="margin-left:10px;margin-right:10px;">Games Remaining: <strong style="color:black;"><?php echo e((3 - count($userGames))); ?> of 3</strong></span>
          <div id="upgradeId" class="ui teal button right labeled icon">Upgrade Now!<i class="upload icon"></i></div>
      </div>
    </div>
  </div>

  <?php for($i=0;$i<count($userGames);$i++): ?>
    <div class="ui container" style="margin-top:50px;width:900px;">
        <div class="ui" style="background-color: #efefef ;border-radius: 20px">
            <span class="ui ribbon label red" style="margin-bottom: 10px;margin-top:20px;margin-left: 14px;"><h2><?php echo e($userGames[$i]['gameFullName']); ?></h2></span>
            <div style="padding: 50px">
                <div class="ui equal width form">
                    <div class="fields">
                        <div class="field">
                            <img src="<?php echo e($userGames[$i]['gameLogoPath']); ?>" class="ui image" style="height: 200px; border: 5px solid #ddd;border-radius: 7px;width: 200px;margin-left: 75px;">
                        </div>
                        <div class="field">
                          <div class="fields">
                            <div id="updateId" class="updateGame ui yellow button left labeled icon" data-gameId="<?php echo e($userGames[$i]['game_id']); ?>" style="margin-left:10px;">
                              Update <i class="icon paste"></i>
                            </div>
                              <div id="editId" class="editGame ui blue button left labeled icon" data-gameId="<?php echo e($userGames[$i]['game_id']); ?>" style="margin-left:10px;">
                                  Build <i class="icon cubes"></i>
                            </div>
                            <div id="deleteGameId" class="deleteGame ui red button left labeled icon" data-gameId="<?php echo e($userGames[$i]['game_id']); ?>" data-gameFullName="<?php echo e($userGames[$i]['gameFullName']); ?>" style="margin-left:10px;">
                              Delete <i class="icon trash"></i>
                            </div>
                          </div>
                          <div class="fields">
                            <div id="playId" class="playGame ui green button left labeled icon" data-gameId="<?php echo e($userGames[$i]['game_id']); ?>" data-gamePath="<?php echo e($userGames[$i]['gamePath']); ?>" style="margin-left:32px;">
                              Play <i class="icon game"></i>
                            </div>
                            <div id="exportGameId" class="exportGame ui grey button left labeled icon" data-gameId="<?php echo e($userGames[$i]['game_id']); ?>" style="margin-left:10px;padding: 10px;">
                              Export Game<i class="icon rocket"></i>
                            </div>
                          </div>
                          <div class="fields">
                            <div class="ui labeled input" style="padding: 10px;">
                              <div class="ui label teal">URL</div>
                              <input type="text" value="<?php echo e($userGames[$i]['gamePath']); ?>">
                            </div>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  <?php endfor; ?>


</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('myScripts'); ?>

<script type="text/javascript" src="<?php echo e(js('home.js')); ?>"></script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master_page', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>