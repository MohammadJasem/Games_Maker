<!DOCTYPE html>
<html>
<head>
	
	<link rel="icon" href="<?php echo e(url('icon_1.ico')); ?>" type="image/x-icon">
    <link rel="shortcut icon" href="<?php echo e(url('icon_1.ico')); ?>" type="image/x-icon">

	<title><?php echo $__env->yieldContent('title'); ?></title>

	<?php echo $__env->make('layouts._styles', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->yieldContent('myStyles'); ?>

	

</head>
<body style="background-color: rgb(236,240,241)">
	<div class="gm-loader" style="display: none;">
        <div class="preloader">
            <div class="hollow-dots-spinner" :style="spinnerStyle">
                <div class="dot"></div>
                <div class="dot"></div>
                <div class="dot"></div>
            </div>
        </div>
    </div>
	<?php echo $__env->yieldContent('content'); ?>

	<?php echo $__env->make('layouts._scripts', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->yieldContent('myScripts'); ?>

	<?php echo $__env->make('layouts.modal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

</body>
</html>