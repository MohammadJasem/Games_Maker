<?php $__env->startSection('title','Login'); ?>

<?php $__env->startSection('content'); ?>

<div class="bgimg" style="background-image: url('<?php echo e(url('img/login_reg.jpg')); ?>');">
	<div class="ui grid" style="padding-top: 12%;">
		<div class="six wide centered column">
			<form method="post" action="loginUser">
				<div class="ui form segment">
					<?php if(isset($errorMsg)&&$errorMsg!=''): ?>
					    <div class="ui error visible message">
					    	<div class="header"><?php echo e($errorMsg); ?></div>
					    </div>
				    <?php endif; ?>
				    <div class="field">
				        <label for="username">Username</label>
				        <div class="ui corner labeled input">
				        	<?php if(isset($data['username'])): ?>
				        		<input type="text" name="username" placeholder="Username" value="<?php echo e($data['username']); ?>" >
				        	<?php else: ?>
				        		<input type="text" name="username" placeholder="Username" >
				        	<?php endif; ?>
						  <?php echo $__env->make('partials.req_star', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
						</div>
						<?php if(isset($errors['username'])): ?>
							<label id="username-error" class="error" for="username"><?php echo e($errors['username']); ?></label>
						<?php endif; ?>
				    </div>
				    <div class="field">
				        <label for="password">Password</label>
				        <div class="ui corner labeled input">
						  <input name="password" type="password">
						  <?php echo $__env->make('partials.req_star', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
						</div>
						<?php if(isset($errors['password'])): ?>
							<label id="password-error" class="error" for="password"><?php echo e($errors['password']); ?></label>
						<?php endif; ?>
				    </div>
				   
				    <button class="ui blue submit button" type="submit">Login</button>
			  		<span class="ui">I don't have an account. <a href="<?php echo e(route('register')); ?>">Create an account</a></span>
				</div>
			</form>
		</div>
	</div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master_page', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>