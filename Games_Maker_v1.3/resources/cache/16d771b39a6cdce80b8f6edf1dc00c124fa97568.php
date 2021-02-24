<form id="eventsForm" class="hide">
	<div class="ui equal width form">
		<div class="fields">
			<div class="field">
				<label for="eventNameCode">Event</label>
                <div class="ui corner labeled input">
                    <select id="eventNameCode" name="eventNameCode" class="ui dropdown gm_req">
                        <option value=""></option>
                        <option value="RNDM_PSN">Random Position</option>
                        <option value="VAR">Varaible</option>
                        <option value="PXL_CLSN">Pixel Collision</option>
                    </select>
                    <?php echo $__env->make('partials.req_star', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </div>
			</div>
			<div class="field" style="text-align: center;">
				<div class="ui icon labeled teal button" style="margin-top: 22px;width: 30%;">
					Add<i class="icon plus"></i>
				</div>
			</div>
		</div>
	</div>
	<div class="ui horizontal divider">
		<i class="icon puzzle blue" style="font-size: 30px;"></i>
  	</div>



	<div class="ui three top attached steps">
	  <div class="active step">
	    <i class="bolt icon red"></i>
	    <div class="content">
	      <div class="title">Random Position</div>
	      <div class="description">Pixel Random Position</div>
	    </div>
	  </div>
	  <div class="step">
	    <i class="cube icon grey"></i>
	    <div class="content">
	      <div class="title">Pixel</div>
	      <div class="description">Pixel Cordinates</div>
	    </div>
	  </div>
	  <div class="step">
	    <i class="bolt icon red"></i>
	    <div class="content">
	      <div class="title">Pixel</div>
	      <div class="description">Pixel Collision</div>
	    </div>
	  </div>
	</div>
	
	<div class="ui attached segment">
	  <p>aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa</p>
	  <p>aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa</p>
	  <p>aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa</p>
	  <p>aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa</p>
	</div>
</form>