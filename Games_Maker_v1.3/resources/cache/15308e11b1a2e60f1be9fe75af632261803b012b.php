<?php $__env->startSection('title','Paint'); ?>

<?php $__env->startSection('content'); ?>


    <input type="hidden" id="userId" value=<?php echo e($_COOKIE['userId']); ?>>
    <input type="hidden" id="gameId" value=<?php echo e($_COOKIE['gameId']); ?>>
    <input type="hidden" id="userName" value=<?php echo e($_COOKIE['username']); ?>>
    <input type="hidden" id="gameName" value=<?php echo e($gameName); ?>>
    <input type="hidden" id="gameFullName" value=<?php echo e($gameFullName); ?>>





<div class="bgimg" style="background-image: url('<?php echo e(url('img/login_reg.jpg')); ?>');height: 100%">

    <?php echo $__env->make('partials.paint_header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <div class="toc" style="top:0px;width: 200px !important;z-index: -1;bottom: 0px;">
        <div class="ui vertical inverted sticky menu top fixed" style="padding-top: 50px; margin-top: 45px;z-index: -1;overflow-y: auto;bottom: 0px;">
      <div class="ui equal width center aligned padded grid" style="color: #ffffff">
        <div class="row">
            <div class="column">
                <div id="previewImg"></div>
            </div>
        </div>
        <div class="row">
            <button class="eraseAll ui violet button mini" id="eraseAll">Erase All&nbsp;&nbsp;&nbsp;<i class="eraser icon"></i></button>
        </div>
        <div class="row">
          <div class="column">
            <i class="undo large icon hand" id="undo" disabled="disabled" data-content="Undo" data-position="top center" data-variation="mini"></i>
          </div>
          <div class="column">
            <i class="redo repeat large icon hand" id="redo" disabled="disabled" data-content="Redo" data-position="right center" data-variation="mini"></i>
          </div>
        </div>
        <div class="row">
          <div class="column">
            <i class="pencil large icon hand violet isClicked" id="pencil" data-content="Pencil" data-position="top center" data-variation="mini"></i>
          </div>
          <div class="column">
            <i class="eraser large icon hand" id="eraser" data-content="Eraser" data-position="right center" data-variation="mini"></i>
          </div>
        </div>
        <div class="row">
            <div class="column">
                <input type="text" id="colorPicker" style="width: 100px" data-content="Pencil Color" data-position="right center" data-variation="mini">
            </div>
          <div class="column">
            <i class="eye dropper large icon hand" id="eyeDropper" data-content="Eye Dropper" data-position="right center" data-variation="mini"></i>
          </div>
        </div>
          <div class="row">
              <div class="inline field">
                  <label for="game_width" style="color: white">Width</label>
                  <div class="ui slidecontainer right labeled">
                      <input type="range" min="0" max="3" value="0" class="slider" id="grid_width">
                      <span class="ui left violet circular label mini" id="gridWidthVal"></span>
                  </div>
              </div>
          </div>
        <div class="row">
            <div class="column">
                <form id="imageName">
                    <div class="field">
                        <label for="image_name" style="float: left;">Image Name</label>
                        <div class="ui corner labeled input mini" data-content="Image Name" data-position="left center" data-variation="mini">
                            <input type="text" id="image_name" name="image_name" class="gm_req popInput" value="<?php echo e($paint_name); ?>">
                            <div class="ui corner label">
                                <i class="asterisk icon" style="color:#f14141;"></i>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="column">
                <button class="ui violet button small" id="saveToImg">Save As Image</button>
            </div>
        </div>
      </div>
    </div>
</div>

    <input type="hidden" id="paintId" value="<?php echo e($paintId); ?>">
    <div class="ui container pixel-picker-container" id="paintGrid" style="background: transparent;position: absolute;top: 100px;left: 500px;width: 512px;">
        <?php for($i = 0;$i < 32;$i++): ?>
            <div class="pixel-picker-row" data-row-num="<?php echo e($i); ?>">
                <?php for($j = 0;$j < 32;$j++): ?>
                    <div class="pixel-picker-cell row-<?php echo e($i); ?>-cell-<?php echo e($j); ?>" data-row-num="<?php echo e($i); ?>" data-cell-num="<?php echo e($j); ?>" style="background-color: <?php echo e($pixelsColorArr[$i][$j]); ?>"></div>
                <?php endfor; ?>
            </div>
        <?php endfor; ?>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('myScripts'); ?>
<script type="text/javascript" src="<?php echo e(js('paint.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master_page', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>