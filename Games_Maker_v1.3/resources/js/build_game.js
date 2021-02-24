//---------------------------------------------------------------------------------------------------//
function gm_rangeSilder($cont,sliderId,silderValId){
	var slider = $cont.find('#'+sliderId);
	var output = $cont.find('#'+silderValId);
	output.html(slider.val());
	slider.input(function() {
	    output.html($(this).val());
	    reBuildLevelGrid($cont);
	});
}
//---------------------------------------------------------------------------------------------------//
function reBuildLevelGrid($cont){
	var width = $cont.find('#game_width').val();
	var height = $cont.find('#game_height').val();

	var $levelGrid = $('#levelGrid');
	$levelGrid.find('.pixel-32-cell').addClass('hidden-pixel').removeClass('hvr-reveal');
	var levelGridHtml = '';
	for(var i=1;i<=height;i++){
		for(var j=1;j<=width;j++){
			$levelGrid.find(`.row-${i}-cell-${j}`).removeClass('hidden-pixel').addClass('hvr-reveal');
		}
	}
	getPixelCordinates();
    $('.pixel-32-cell').unbind('click');
    $('.pixel-32-cell').not('.hidden-pixel').click(pixelDialog);
}
//---------------------------------------------------------------------------------------------------//
function fileTypeChanged(fileType,$cont){
	var $gameFile = $cont.find('#gameFile');
	var acceptType = '';
	if(fileType=='IMAGE')
		acceptType = 'image/png, image/jpeg, image/gif, image/jpg , image/bmp';
	else if(fileType=='AUDIO')
		acceptType = 'image/png, image/jpeg, image/gif, image/jpg , image/bmp';
	else if(fileType=='FONT')
		acceptType = 'image/png, image/jpeg, image/gif, image/jpg , image/bmp';
	else
		acceptType = '';

	$gameFile.attr('accept',acceptType);
}
//---------------------------------------------------------------------------------------------------//
function addFilesDialog(){
	var $form = $('#gameFilesForm').clone().removeClass('hide');
	var options = {
        isAdd       :   true,
        addTitle    :   'Save',
        addId       :   'saveFilesBtn'
    };

	$form.find('#gameFile').filepond({
		server: {
	        process: {
	            url: 'uploadUserFile',
	            method: 'POST'
	        },
	    }
	});
	var $dialog = gm_dialog('Game Files',$form,options);
	//==================================================//
	$dialog.find('#fileType').change();
	//==================================================//
	$dialog.find('#saveFilesBtn').click(function(){
		var $form = $dialog.find('form#gameFilesForm');
		gm_form_validation($form,function(){
			var data = $form.serializeArray();
			var fileType = $form.find('#fileType option:selected').text();
			$.post('saveUserFiles',data,function(res){
				gm_closeDialog();
				toastr.success('The '+fileType+' Saved And Added To The Game Successfully');
			});
		});
	});
	//==================================================//
}
//---------------------------------------------------------------------------------------------------//
function setBackgroundDialog(){
	var stateId = $('#currentStateId').val();
	var $form = $('#setBackgroundForm').clone().removeClass('hide');
	var options = {
        isAdd       :   true,
        addTitle    :   'Set Background',
        addId       :   'setGroundBtn'
    };
    var $dialog = gm_dialog('Set Game Background',$form,options);
    $.post('getUserImages',{stateId:stateId},function(res){
		var resArr = JSON.parse(res);
		var stateBckGrnd = resArr['stateBckGrnd'];
		$dialog.find('#imageName').html(resArr['imageSelectHtml']);
		$dialog.find('#imageName').dropdown();
		$dialog.find('#bkGrndType').dropdown();
        setSpectrumOption($dialog.find('#colorPicker'),'sp-light',"#208f19");
		if(stateBckGrnd != ''){
            setTimeout(function () {
                $dialog.find('#bkGrndType').closest('.dropdown').dropdown('set value', stateBckGrnd[0]['img_type']).dropdown();
            }, 100);
            $dialog.find('#img_state_id').val(stateBckGrnd[0]['state_img_id']);
		    if(stateBckGrnd[0]['img_type'] == 'I') {
                $dialog.find('.bckGrndImg').removeClass('hide');
                $dialog.find('.bckGrndClr').addClass('hide');
                setTimeout(function () {
                    $dialog.find('#imageName').closest('.dropdown').dropdown('set value', stateBckGrnd[0]['file_id']).dropdown();
                }, 100);

                if (stateBckGrnd[0]['set_as_btn'] == 'T') {
                    $dialog.find('#setAsbtn').closest('.checkbox').checkbox('check');
                    $.post('getNextState', {stateId: stateId}, function (res) {
                        var resArr = JSON.parse(res);
                        $dialog.find('#nextStateId').val(resArr['statesData']['NextStateId']);
                        var nextStateName = resArr['statesData']['NextStateName'];
                        var currentStateName = resArr['statesData']['currentStateName'];
                        text = 'Now you are in <b>' + currentStateName + '</b> level...after image clicking you will go to next level <b>' + nextStateName + '</b>';
                        $dialog.find('#nxtBckGrnDiv').removeClass('hide');
                        $dialog.find('#nxtBckGrnTxt').html(text);
                    });
                }
            }else{
                setSpectrumOption($dialog.find('#colorPicker'),'sp-light','#'+stateBckGrnd[0]['file_id']);
                $dialog.find('.bckGrndImg').addClass('hide');
                $dialog.find('.bckGrndClr').removeClass('hide');
            }
		}
		$dialog.find('#imageName').change(function(){
			var imagePath = $dialog.find('#imageName option:selected').attr('imagePath');
			$dialog.find('#imagePreview').attr('src',imagePath);
		});
        //===============================================//
        $dialog.find('#bkGrndType').change(function () {
            var type = $(this).val();
            if(type == 'I'){
                $dialog.find('.bckGrndImg').removeClass('hide');
                $dialog.find('.bckGrndClr').addClass('hide');
            }else{
                $dialog.find('.bckGrndImg').addClass('hide');
                $dialog.find('.bckGrndClr').removeClass('hide');
            }
        });
        //===============================================//
        $dialog.find('#setAsbtn').change(function () {
            var checked = $(this).prop('checked');
            if(checked) {
                var text = '';
                $.post('getNextState',{stateId:stateId},function(res) {
                    var resArr = JSON.parse(res);
                    $dialog.find('#nextStateId').val(resArr['statesData']['NextStateId']);
                    var nextStateName = resArr['statesData']['NextStateName'];
                    var currentStateName = resArr['statesData']['currentStateName'];
                    text = 'Now you are in <b>'+currentStateName+'</b> level...after image clicking you will go to next level <b>'+nextStateName+'</b>';
                    $dialog.find('#nxtBckGrnDiv').removeClass('hide');
                    $dialog.find('#nxtBckGrnTxt').html(text);
                });
            }else{
                $dialog.find('#nxtBckGrnDiv').addClass('hide');
                $dialog.find('#nxtBckGrnTxt').html('');
                $dialog.find('#nextStateId').val('');
            }
        });
        //===============================================//
	});
    //===============================================//
    $dialog.find('#setGroundBtn').click(function(){
		var $form = $dialog.find('form#setBackgroundForm');
		gm_form_validation($form,function(){
            var setAsbtn = $dialog.find('#setAsbtn').prop('checked');
            if(setAsbtn)
                setAsbtn = 'T';
            else
                setAsbtn = 'F';
            var stateId = $('#currentStateId').val();
            if($dialog.find('#bkGrndType').val() == 'I')
                var imgId = $dialog.find('#imageName').val();
            else
                var imgId = $dialog.find('#colorPicker').spectrum('get').toHexString();
            var imgType = $dialog.find('#bkGrndType').val();
            var img_state_id = $dialog.find('#img_state_id').val();
			$.post('setStateBackground',{img_state_id:img_state_id,setAsbtn:setAsbtn,imgType:imgType,stateId:stateId,imgId:imgId},function(res){
				gm_closeDialog();
				toastr.success('Operation Done Successfully');
                getStatePixels(stateId);
			});
		});
	});
}
//---------------------------------------------------------------------------------------------------//
function getUserPaints($popUp){
    $.post('getUserPaints',{},function(res){
		var resArr = JSON.parse(res);
		var userpaintsArr = resArr['userpaints'];
		var $sec1 = $popUp.find('#paintsContentSec1');
		var $sec2 = $popUp.find('#paintsContentSec2');
		$popUp.find('.paintRowInfo').remove();
		for(var i=0;i<userpaintsArr.length;i++){
			var paint_colors = userpaintsArr[i]['paint_colors'];
			var $paintRowInfo = $popUp.find('.paintRowInfoTemp').clone().removeClass('paintRowInfoTemp').addClass('paintRowInfo').css('display','');
			$paintRowInfo.find('#paintId').val(userpaintsArr[i]['paint_id']);
			$paintRowInfo.find('.paintName').text(userpaintsArr[i]['paint_name']);
			$paintRowInfo.find('#paintColors').val(paint_colors);

			var rgbArray = paint_colors.split('-');
			var image = getConvertArray2Img(rgbArray,64,64);
            $(image).css('width','32px').css('height','32px');
            $paintRowInfo.find('.imageThumbnail').html(image);

            if(i%2==0)
				$sec1.append($paintRowInfo);
			else
				$sec2.append($paintRowInfo);
		}
		$popUp.find('[data-content]').popup();
        $popUp.find('.deletePaint').click(deletePaint);
        $popUp.find('.editPaint').click(editPaint);
        var remainPaints = 10 - userpaintsArr.length;
        $popUp.find('#paintsCount').val(userpaintsArr.length);
		$popUp.find('#remainPaints').text(remainPaints);
	});
}
//---------------------------------------------------------------------------------------------------//
function editPaint(){
    var $paintRowInfo = $(this).closest('.paintRowInfo');
    var paintId = $paintRowInfo.find('#paintId').val();
    createCookie('paintId',paintId,1);
    window.location.href = 'editPaint';
}
//---------------------------------------------------------------------------------------------------//
function deletePaint(){
    var $paintRowInfo = $(this).closest('.paintRowInfo');
    var paintId = $paintRowInfo.find('#paintId').val();
    var paintName = $paintRowInfo.find('.paintName').text();
    gm_confirm('Delete Paint ['+paintName+']','Are You Sure?',function () {
        $.post('deletePaint',{'paintId':paintId},function(){
            toastr.success('Operation Done Successfully');
        });
    });
}
//---------------------------------------------------------------------------------------------------//
function saveGameSettings(){
    var $form = $(this).parent().find('form');
    var $gmSettingId = $('#gmSettingId');
    var stateId = $('#currentStateId').val();
    gm_form_validation($form,function(){
        var data = $form.serialize();
        $gmSettingId.popup('hide');
        $.post('saveGameSettings',data,function(res){
            $('.pixel-32-cell').unbind('click');
            $('.pixel-32-cell').not('.hidden-pixel').click(pixelDialog);
            toastr.success('Settings Saved successfully');
            getStatePixels(stateId);
        });
    });
}
//---------------------------------------------------------------------------------------------------//
function getGameSettings($popUp){
	$.post('getGameSettings',{},function(res){
		var resArr = JSON.parse(res);
		$popUp.find('#game_width').val(resArr['game_width']);
		$popUp.find('#gameWidthVal').text(resArr['game_width']);
		$popUp.find('#game_height').val(resArr['game_height']);
		$popUp.find('#gameHeightVal').text(resArr['game_height']);
		$popUp.find('#local_storage_name').val(resArr['local_storage_name']);
	});
}
//---------------------------------------------------------------------------------------------------//
function getGameStates($popUp){
	$.post('getGameStates',{},function(res){
		var resArr = JSON.parse(res);
		var gameStatesArr = resArr['gameStates'];
		var $levelCont = $popUp.find('.levelCont');
		$levelCont.find('.stateRowInfo').remove();
		for(var i=0;i<gameStatesArr.length;i++){
			var $stateRowInfo = $popUp.find('.stateRowInfoTemp').clone().removeClass('stateRowInfoTemp').addClass('stateRowInfo').css('display','');
			$stateRowInfo.find('#state_id').val(gameStatesArr[i]['state_id']);
			$stateRowInfo.find('#is_default').val(gameStatesArr[i]['is_default']);
			$stateRowInfo.find('#state_name').val(gameStatesArr[i]['shown_name']);
			$stateRowInfo.find('#state_order').val(gameStatesArr[i]['state_order']);
			if(gameStatesArr[i]['is_default']=='Y'){
				$stateRowInfo.find('#state_order').attr('readonly','readonly');
				$stateRowInfo.find('.deleteState').attr('disabled','disabled');
			}
			$levelCont.append($stateRowInfo);
		}
		$popUp.find('[data-content]').popup();
		$popUp.find('.deleteState').unbind('click').click(confirmDeleteState);
        $popUp.find('.loadState').unbind('click').click(loadState);
		var remainLevels = 5 - gameStatesArr.length;
		$popUp.find('#remainLevels').text(remainLevels);
	});
}
//---------------------------------------------------------------------------------------------------//
function addStateFunc(){
	var $stateForm = $(this).closest('.form');
	var stateCount = $stateForm.find('.stateRowInfo').size();
	if(stateCount<5){
		var $stateRowInfo = $stateForm.find('.stateRowInfoTemp').clone().removeClass('stateRowInfoTemp').addClass('stateRowInfo').css('display','');
		$stateForm.find('.stateRowInfo').last().before($stateRowInfo);
		$stateForm.find('[data-content]').popup();
		initValidation();
		$stateForm.find('.deleteState').unbind('click').click(confirmDeleteState);
        $stateForm.find('.loadState').unbind('click').click(loadState);
		var remainLevels = 5 - $stateForm.find('.stateRowInfo').size();
		$stateForm.find('#remainLevels').text(remainLevels);
	}else{
		gm_alert('Alert','Maximum Levels is 5<br>Please Upgrade Your Account To Add More Levels');
	}
}
//---------------------------------------------------------------------------------------------------//
function loadState(){
    $('.gm-loader').show();
    var $stateRowInfo = $(this).closest('.stateRowInfo');
    var stateId = $stateRowInfo.find('#state_id').val();
    $('#currentStateId').val(stateId);
    $.post('getState',{stateId:stateId},function(res){
        var resArr = JSON.parse(res);
        var stateName = resArr['stateData'][0]['shown_name'];
        var gameName = $('#game_name').val();
        $('#game_state_name').html(gameName+': '+stateName);
        updateWidthHeight();
    }).done(function(){
        setTimeout(function(){
            $('.gm-loader').hide();
        },1500);
    });
}
//---------------------------------------------------------------------------------------------------//
function getStatePixels(stateId) {
    $.post('getStatePixels', {stateId: stateId}, function (res) {
        var resArr = JSON.parse(res);
        var gameWidth = resArr['gameWidth'];
        var gameHeight = resArr['gameHeight'];
        var statePixels = resArr['statePixels'];
        for (var i = 1; i <= gameHeight; i++) {//row , [0 -> 23]
            for (var j = 1; j <= gameWidth; j++) {//cell , [0 -> 48]
                var id = statePixels[i - 1][j - 1]['id'];
                var type = statePixels[i - 1][j - 1]['type'];
                var val = statePixels[i - 1][j - 1]['val'];
                if (type === 'IMG' || type === 'LBL' || type === 'PNT')
                    $('.row-' + i + '-cell-' + j).html(val);
                else
                    $('.row-' + i + '-cell-' + j).html(val);

                $('.row-' + i + '-cell-' + j).attr('pixel-id', id);
            }
        }
        //===============================================//
        $('#levelImg').remove();
        var setAsBtn = resArr['setAsBtn'];
        //===============================================//
        if(resArr['imgPath']!=''){
            var width = gameWidth * 20;
            var height = gameHeight * 20;
            if(setAsBtn==='T')
                $('#levelGrid').prepend('<img id="levelImg" src="'+resArr['imgPath']+'" width="'+width+'" height="'+height+'" style="z-index: 2;position: absolute;">');
            else{
                $('#levelGrid').prepend('<img id="levelImg" src="'+resArr['imgPath']+'" width="'+width+'" height="'+height+'" style="position: absolute;">');                
                $('#levelGrid .pixel-32-cell').not('.hidden-pixel').css('background','transparent');
            }
        }else if(resArr['backgroundColor']!=''){
            $('#levelGrid .pixel-32-cell').not('.hidden-pixel').css('background-color',resArr['backgroundColor']);
        }
    });
}
//---------------------------------------------------------------------------------------------------//
function confirmDeleteState(){
    var $stateForm = $(this).closest('.form');
    var $stateRowInfo = $(this).closest('.stateRowInfo');
    var stateName = $stateRowInfo.find('#state_name').val();
    var stateId = $stateRowInfo.find('#state_id').val();
    if(stateId!=''){
        gm_confirm('Delete ('+stateName+') Game Level','<h3>Are You Sure?</h3>',function(){
            var $gameLevelId = $('#gameLevelId');
            $gameLevelId.popup('hide');
            $.post('deleteGameState',{stateId:stateId},function(res){
                toastr.success('The Game Level Deleted successfully');
                getGameStates($(this).closest('.gmPopUpEle'));
            });
        });
    }else{
        $stateRowInfo.remove();
        var remainLevels = 5 - $stateForm.find('.stateRowInfo').size();
        $stateForm.find('#remainLevels').text(remainLevels);
    }
}
//---------------------------------------------------------------------------------------------------//
function saveGameStates(){
    var $form = $(this).parent().find('form');
    var $gameLevelId = $('#gameLevelId');
    gm_form_validation($form,function(){
        var data = $form.serialize();
        $gameLevelId.popup('hide');
        $.post('saveGameStates',data,function(res){
            toastr.success('Levels Saved successfully');
        });
    });
}
//---------------------------------------------------------------------------------------------------//
function getPixelCordinates(){
	$('.pixel-32-cell').not('.hidden-pixel').unbind('mouseenter mouseleave');
	if($('.levelGridIcons .icon.handPointer').hasClass('selectedIcon')){
		$('.pixel-32-cell').not('.hidden-pixel').hover(function(){
			var row = $(this).attr('data-row-num') - 1;
			var cell = $(this).attr('data-cell-num') - 1;
			$('#pixelCordinates').text(row+':'+cell);
		});
	}
}
//---------------------------------------------------------------------------------------------------//
function levelGridIconsEvents(){
    gm_awesomeCursor($('.pixel-32-cell'),'hand point up',{color:'#999999',hotspot:'top left'});
    $('.levelGridIcons .icon').click(function(){
        var $this = $(this);
        var $levelGrid = $('#levelGrid');
        $('.levelGridIcons .icon.selectedIcon').removeClass('selectedIcon');
        gm_deleteDrag($levelGrid);
        if($this.hasClass('handPointer')){
            $('.pixel-32-cell:not(".hidden-pixel")').addClass('hvr-reveal');
            gm_awesomeCursor($('.pixel-32-cell'),'hand point up',{color:'#999999',hotspot:'top left'});
            $this.addClass('selectedIcon');
        }else if($this.hasClass('moveGrid')){
            $('.hvr-reveal').removeClass('hvr-reveal');
            gm_awesomeCursor($('.pixel-32-cell'),'move',{color:'#999999'});
            gm_dragElement($levelGrid[0]);
            $this.addClass('selectedIcon');
        }else if($this.hasClass('syncGrid')){
            $('.pixel-32-cell:not(".hidden-pixel")').addClass('hvr-reveal');
            gm_awesomeCursor($('.pixel-32-cell'),'hand point up',{color:'#999999',hotspot:'top left'});
            $levelGrid.css('left','250px').css('top','100px');
            $('.levelGridIcons .handPointer').addClass('selectedIcon');
        }
        getPixelCordinates();
    });
}
//---------------------------------------------------------------------------------------------------//
    function pixelDialog(){
        if($('.levelGridIcons .icon.selectedIcon').hasClass('handPointer')){
            var $this = $(this);
            var pixelId = $this.attr('pixel-id');
            var row = $this.attr('data-row-num') - 1;
            var cell = $this.attr('data-cell-num') - 1;
            var $form = $('#pixelForm').clone().removeClass('hide');
            if(pixelId)
                var options = {
                    isEdit          :   true,
                    editTitle       :   'Update',
                    editId          :   'savePixelBtn',
                    size            :   'small'
                };
            else
                var options = {
                    isAdd       :   true,
                    addTitle    :   'Save',
                    addId       :   'savePixelBtn',
                    size        :   'small'
                };

            var $dialog = gm_dialog('Pixel (<i class="icon cube"></i>'+row+':'+cell+') Dialog',$form,options);
            var currentStateId = $('#currentStateId').val();
            $dialog.find('#stateId').val(currentStateId);
            $dialog.find('#row').val(row);
            $dialog.find('#cell').val(cell);
            setSpectrumOption($dialog.find('#textColor'),'sp-light',"#208f19");

            var maxLblLength = 1;
            var tmpCell = (cell + 1 )+1;
            while(true){
                var $nextPixel = $('[data-row-num="'+(row+1)+'"][data-cell-num="'+tmpCell+'"]');
                if($nextPixel.hasClass('hidden-pixel'))
                    break;
                if($nextPixel.html()!=='')
                    break;
                else{
                    maxLblLength++;
                    tmpCell++;
                }
            }

            $dialog.find('#lblContent').attr('maxlength',maxLblLength);

            $dialog.find('#savePixelBtn').click(function(){
                var $form = $dialog.find('form#pixelForm');
                gm_form_validation($form,function(){
                    var data = $form.serialize();
                    var textColor = $dialog.find('#textColor').spectrum('get').toHexString();
                    $.post('savePixel',data+'&textColor='+textColor,function(res){
                        gm_closeDialog();
                        getStatePixels(currentStateId);
                        toastr.success('The Pixel Saved Successfully');
                    });
                });
            });
            getImagesForPixel($dialog);
            getPaintForPixel($dialog);
            $dialog.find('#contentType').change(function(){
                contentTypeChange($(this).val(),$dialog);
            });
            $dialog.find('#eventNameCode').change(function () {
                var groupCode = $dialog.find('#groupCode').val();
                var stateId = $('#currentStateId').val();
                var exceptPxlSameGC = 'T';
                var withHtml = 'T';
                if($(this).val() == 'MOVING_COLLISION') {
                    $dialog.find('.resultPixelDiv').addClass('hide');
                    $dialog.find('.collisiedPixelDiv').removeClass('hide');
                    $.post('getPixels', {pixelId:pixelId,groupCode: groupCode,stateId:stateId,exceptPxlSameGC:exceptPxlSameGC,pixelType:'CLD',withHtml:withHtml}, function (res) {
                        var resArr = JSON.parse(res);
                        $dialog.find('#collisiedPixelCode').html(resArr['pixelsHtml']);
                        $dialog.find('#collisiedPixelCode').dropdown();
                    });
                }else if($(this).val() == 'MOVING_COLLISION_VAR'){
                    $dialog.find('.collisiedPixelDiv,.resultPixelDiv').removeClass('hide');
                    $.post('getPixels', {pixelId:pixelId,groupCode: groupCode,stateId:stateId,exceptPxlSameGC:exceptPxlSameGC,pixelType:'CLD',withHtml:withHtml}, function (res) {
                        var resArr = JSON.parse(res);
                        $dialog.find('#collisiedPixelCode').html(resArr['pixelsHtml']);
                        $dialog.find('#collisiedPixelCode').dropdown();
                    });
                    $.post('getPixels', {pixelId:pixelId,groupCode: groupCode,stateId:stateId,exceptPxlSameGC:exceptPxlSameGC,pixelType:'RLT',withHtml:withHtml}, function (res) {
                        var resArr = JSON.parse(res);
                        $dialog.find('#resultPixelCode').html(resArr['pixelsHtml']);
                        $dialog.find('#resultPixelCode').dropdown();
                    });
                }else{
                    $dialog.find('.collisiedPixelDiv,.resultPixelDiv').addClass('hide');
                }
            });
            if(pixelId){
                getPixelData($dialog,pixelId);
                $dialog.find('.deleteContentDiv').removeClass('hide');
                $dialog.find('#deleteContent').change(function () {
                    var checked = $(this).prop('checked');
                    if(checked) {
                        $dialog.find('#lblContent').not('#deleteContent').attr('disabled','true');
                        $dialog.find('.dropdown').addClass('disabled');
                        $dialog.find('#isDeleteContent').val('T');
                    }else{
                       $dialog.find('#lblContent').removeAttr('disabled');
                       $dialog.find('.dropdown').removeClass('disabled');
                       $dialog.find('#isDeleteContent').val('F');
                    }
                });
            }
        }
    }
//---------------------------------------------------------------------------------------------------//
    function getPixelData($dialog,pixelId){
        var stateId = $('#currentStateId').val();
        $.post('getPixelData',{pixelId:pixelId,stateId:stateId},function(res){
            var resArr = JSON.parse(res);
            var pixelData = resArr['pixelData'];
            var contentType = pixelData[0]['content_type'];
            var groupCode = pixelData[0]['group_code'];
            var textColor = pixelData[0]['text_color'];
            var fontFamily = pixelData[0]['font_family'];
            var content = pixelData[0]['content'];
            $dialog.find('#pixelId').val(pixelData[0]['state_pixel_id']);
            $dialog.find('#contentType').closest('.dropdown').dropdown('set value', contentType).dropdown();
            if(contentType==='IMG'){
                var eventData = resArr['eventData'];
                var eventCode = eventData[0]['event_code'];
                var collisiedPixelCode = eventData[0]['collisied_pixel_id'];
                var resultPixelCode = eventData[0]['result_pixel'];
                $dialog.find('#imgContent').closest('.dropdown').dropdown('set value', content).dropdown();
                $dialog.find('#eventNameCode').closest('.dropdown').dropdown('set value', eventCode).dropdown();
                $dialog.find('#groupCode').val(groupCode);
            }else if(contentType==='PNT'){
                var eventData = resArr['eventData'];
                var eventCode = eventData[0]['event_code'];
                var collisiedPixelCode = eventData[0]['collisied_pixel_id'];
                var resultPixelCode = eventData[0]['result_pixel'];
                setTimeout(function(){
                    $dialog.find('#pntContent').closest('.dropdown').dropdown('set value', content).dropdown();
                    $dialog.find('#eventNameCode').closest('.dropdown').dropdown('set value', eventCode).dropdown();
                    $dialog.find('#groupCode').val(groupCode);
                },100);
            }else{//LBL
                $dialog.find('.eventDiv').addClass('hide');
                $dialog.find('#lblContent').val(content);
                setSpectrumOption($dialog.find('#textColor'),'sp-light',textColor);
                $dialog.find('#eventNameCode').closest('.dropdown').dropdown('set value', eventCode).dropdown();
                $dialog.find('#fontFamily').closest('.dropdown').dropdown('set value', fontFamily).dropdown();
            }
            setTimeout(function(){
                $dialog.find('#collisiedPixelCode').closest('.dropdown').dropdown('set value', collisiedPixelCode).dropdown();
                $dialog.find('#resultPixelCode').closest('.dropdown').dropdown('set value', resultPixelCode).dropdown();
            },300);
        });
    }
//---------------------------------------------------------------------------------------------------//
function updateWidthHeight(){
    $.post('getGameSettings',{},function(res){
        var resArr = JSON.parse(res);
        var gameWidth = resArr['game_width'];
        var gameHeight = resArr['game_height'];
        var levelGridHtml = '';
        for(var i = 1;i <=23;i++){
            levelGridHtml += '<div class="pixel-32-row" data-row-num="'+i+'">';
            for(var j = 1;j <=48;j++){
                if(i>gameHeight||j>gameWidth)
                    levelGridHtml += '<div class="pixel-32-cell row-'+i+'-cell-'+j+' hidden-pixel" data-row-num="'+i+'" data-cell-num="'+j+'"></div>';
                else
                    levelGridHtml += '<div class="pixel-32-cell hvr-reveal row-'+i+'-cell-'+j+'" data-row-num="'+i+'" data-cell-num="'+j+'"></div>';
            }
            levelGridHtml += '</div>';
        }
        $('#levelGrid').html(levelGridHtml);
        getStatePixels($('#currentStateId').val());
        $('.pixel-32-cell').unbind('click');
        $('.pixel-32-cell').not('.hidden-pixel').click(pixelDialog);
        getPixelCordinates();
    });
}
//---------------------------------------------------------------------------------------------------//
    function getPaintForPixel($dialog){
        $.post('getUserPaintsImages',{},function(res){
            var resArr = JSON.parse(res);
            $dialog.find('#pntContent').html(resArr['selectHtml']);
            $dialog.find('#pntContent').dropdown();
            $dialog.find('#pntContent').change(function(){
                var imagePath = $dialog.find('#pntContent option:selected').attr('imagePath');
                $dialog.find('#imagePreview').attr('src',imagePath);
            });
        });
    }
//---------------------------------------------------------------------------------------------------//
    function getImagesForPixel($dialog){
        $.post('getUserImages',{},function(res){
            var resArr = JSON.parse(res);
            $dialog.find('#imgContent').html(resArr['imageSelectHtml']);
            $dialog.find('#imgContent').dropdown();
            $dialog.find('#imgContent').change(function(){
                var imagePath = $dialog.find('#imgContent option:selected').attr('imagePath');
                $dialog.find('#imagePreview').attr('src',imagePath);
            });
        });
    }
//---------------------------------------------------------------------------------------------------//
    function contentTypeChange(type,$dialog){
        if(type==='IMG'){
            $dialog.find('.imgContentDiv,.groupCodeDiv').removeClass('hide');
            $dialog.find('.lblContentDiv,.pntContentDiv').addClass('hide');
            $dialog.find('#pntContent').dropdown('clear');
            $dialog.find('#imagePreview').attr('src','');
            $dialog.find('#lblContent').val('');
            $dialog.find('.eventDiv').removeClass('hide');
        }else if(type==='PNT'){
            $dialog.find('.pntContentDiv,.groupCodeDiv').removeClass('hide');
            $dialog.find('.lblContentDiv,.imgContentDiv').addClass('hide');
            $dialog.find('#imgContent').dropdown('clear');
            $dialog.find('#imagePreview').attr('src','');
            $dialog.find('#lblContent').val('');
            $dialog.find('.eventDiv').removeClass('hide');
        }else{//LBL
            $dialog.find('.imgContentDiv,.pntContentDiv,.groupCodeDiv').addClass('hide');
            $dialog.find('#imgContent,#pntContent').dropdown('clear');
            $dialog.find('#imagePreview').attr('src','');
            $dialog.find('#groupCode').val('');
            $dialog.find('.lblContentDiv').removeClass('hide');
            $dialog.find('.eventDiv').addClass('hide');
            $dialog.find('.collisiedPixelDiv').addClass('hide');
            $dialog.find('.resultPixelDiv').addClass('hide');
        }
    }
//---------------------------------------------------------------------------------------------------//
$(function(){
	getPixelCordinates();
	levelGridIconsEvents();
    getStatePixels($('#currentStateId').val());

	$('#files_btn').click(addFilesDialog);
	$('#background_btn').click(setBackgroundDialog);
	$('#paint_btn').click(getUserPaints);
	//==============================================================//
    $('.pixel-32-cell').unbind('click');
    $('.pixel-32-cell').not('.hidden-pixel').click(pixelDialog);
	//==============================================================//
	var $gmSettingId = $('#gmSettingId');
	var $form = $('#gameSettingsForm').clone().removeClass('hide');
    gm_popOver($gmSettingId,'Game Settings',$form[0].outerHTML,{okId:'okSettingId',cancelCallback:'updateWidthHeight'},function(popUpClass){
		var $popUp = $('.'+popUpClass);
		gm_rangeSilder($popUp,'game_width','gameWidthVal');
		gm_rangeSilder($popUp,'game_height','gameHeightVal');

		getGameSettings($popUp);
        $popUp.find('#okSettingId').unbind('click').click(saveGameSettings);
	});
	//==============================================================//
	var $gameLevelId = $('#gameLevelId');
	var $form = $('#stateForm').clone().removeClass('hide');
	var options = {okId:'okStateId'};
	gm_popOver($gameLevelId,'Game Levels',$form[0].outerHTML,options,function(popUpClass){
		var $popUp = $('.'+popUpClass);
		$popUp.find('#addStateId').unbind('click').click(addStateFunc);
		getGameStates($popUp);
        $popUp.find('#okStateId').unbind('click').click(saveGameStates);
	});
	//==============================================================//
	var $paintObjId = $('#paintObjId');
	var $form = $('#paintsForm').clone().removeClass('hide');
	var options = {okId:'okPaintId'};
	gm_popOver($paintObjId,'User Paints',$form[0].outerHTML,options,function(popUpClass){
		var $popUp = $('.'+popUpClass);
		$popUp.find('#addPaintId').unbind('click').click(function(){
			var paintsCount = $popUp.find('#paintsCount').val();
			if(paintsCount<=10)
				window.location.href = 'paint';
			else
	            gm_alert('Alert','Maximum Paints is 10<br>Please Upgrade Your Account To Make More Paints');
		});
		getUserPaints($popUp);
        $popUp.find('#okPaintId').click(function(){
            $paintObjId.popup('hide');
        });
	});
    //==============================================================//
//-------------------------------------------------------------------//
	$('#play_game_btn').click(function(){
		var gamePath = '/games_repositories/'+$('#userName').val()+'/Games/'+$('#gameFullName').val();
		window.open(gamePath,'_blank','width=1250,height=600');
	});
});