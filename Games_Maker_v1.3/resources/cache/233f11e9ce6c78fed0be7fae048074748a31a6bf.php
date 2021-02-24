<?php $__env->startSection('title','Welcome'); ?>

<?php $__env->startSection('content'); ?>


<div class="bgimg" style="background-image: url('<?php echo e(url('img/welcome_1.jpg')); ?>');height: 100%">
	<div class="ui container" style="padding-top: 30px">
		<div class="ui secondary  menu">
			<div class="right menu">
	    		<a href="<?php echo e(route('login')); ?>" class="ui teal button item">
			      <span style="font-size: 18px;color:white;"><b>Login</b></span>
			    </a>
			    <a href="<?php echo e(route('register')); ?>" class="ui button item">
			      <span style="font-size: 18px;color:white;"><b>Register</b></span>
			    </a>
	  		</div>
		</div>
	</div>
</div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master_page', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>