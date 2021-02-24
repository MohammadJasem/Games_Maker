<?php $__env->startSection('title','Register'); ?>

<?php $__env->startSection('content'); ?>

<div class="bgimg" style="background-image: url('<?php echo e(url('img/login_reg.jpg')); ?>');height: 100%">
	<div class="ui grid" style="padding-top: 5%;">
		<div class="seven wide centered column">
			<form method="post" action="registerUser">
				<div class="ui form segment">
					<?php if(isset($errorMsg)&&$errorMsg!=''): ?>
					    <div class="ui error visible message">
					    	<div class="header"><?php echo e($errorMsg); ?></div>
					    </div>
				    <?php endif; ?>
				  <p>Let's go ahead and get you signed up.</p>
				  <div class="two fields">
				    <div class="field">
				    	<label>First Name</label>
				    	<div class="ui corner labeled input">
				    		<?php if(isset($data['firstname'])): ?>
				      			<input type="text" name="firstname" value="<?php echo e($data['firstname']); ?>" placeholder="First Name">
			      			<?php else: ?>
				      			<input type="text" name="firstname" value="" placeholder="First Name">
			      			<?php endif; ?>
			      			<?php echo $__env->make('partials.req_star', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			  			</div>
			  			<?php if(isset($errors['firstname'])): ?>
							<label id="firstname-error" class="error" for="firstname"><?php echo e($errors['firstname']); ?></label>
						<?php endif; ?>
				    </div>
				    <div class="field">
				      	<label>Last Name</label>
				      	<div class="ui corner labeled input">
				    		<?php if(isset($data['lastname'])): ?>
				      			<input type="text" name="lastname" value="<?php echo e($data['lastname']); ?>" placeholder="Last Name">
			      			<?php else: ?>
				      			<input type="text" name="lastname" value="" placeholder="Last Name">
			      			<?php endif; ?>
			      			<?php echo $__env->make('partials.req_star', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			  			</div>
			  			<?php if(isset($errors['lastname'])): ?>
							<label id="lastname-error" class="error" for="lastname"><?php echo e($errors['lastname']); ?></label>
						<?php endif; ?>
				    </div>
				  </div>
				  <div class="field">
					<label>Username</label>
					<div class="ui corner labeled input">
			    		<?php if(isset($data['username'])): ?>
			      			<input type="text" name="username" value="<?php echo e($data['username']); ?>" placeholder="User Name">
		      			<?php else: ?>
			      			<input type="text" name="username" value="" placeholder="User Name">
		      			<?php endif; ?>
		      			<?php echo $__env->make('partials.req_star', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		  			</div>
		  			<?php if(isset($errors['username'])): ?>
						<label id="username-error" class="error" for="username"><?php echo e($errors['username']); ?></label>
					<?php endif; ?>
				  </div>
				  <div class="field">
					<label>Password</label>
					<div class="ui corner labeled input">
				    	<input name="password" type="password">
				    	<?php echo $__env->make('partials.req_star', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
				    </div>
				    <?php if(isset($errors['password'])): ?>
						<label id="password-error" class="error" for="password"><?php echo e($errors['password']); ?></label>
					<?php endif; ?>
				  </div>
				  <div class="field">
					<label>Confirm Password</label>
					<div class="ui corner labeled input">
				    	<input name="confirm_password" type="password">
				    	<?php echo $__env->make('partials.req_star', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
				    </div>
				    <?php if(isset($errors['confirm_password'])): ?>
						<label id="confirm_password-error" class="error" for="confirm_password"><?php echo e($errors['confirm_password']); ?></label>
					<?php endif; ?>
				  </div>
				  <div class="inline field">
				    <div class="ui checkbox">
				      <input name="terms" type="checkbox">
				      <label>I agree to the terms and conditions</label>
				    </div>
				  </div>
				  <button class="ui blue submit button" type="submit">Register</button>
				  <span class="ui">I'm already have an account. <a href="<?php echo e(route('login')); ?>">Login</a></span>
				</div>
			</form>
		</div>
	</div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master_page', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>