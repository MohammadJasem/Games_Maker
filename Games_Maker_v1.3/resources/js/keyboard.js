//-------------------------------------------------------------------------------//
function keyboardDialog(){
	var $form = $('#keyboardForm').clone().removeClass('hide');
	var options = {
        isAdd       :   true,
        addTitle    :   'Save',
        addId       :   'saveKeyboardBtn'
    };
	var $dialog = gm_dialog('Game Keys',$form,options);
	getGameKeys($dialog);
	$dialog.find('.keyButton').click(function(){
		$(this).toggleClass('blue');
		$(this).toggleClass('selectedKey');
	});
	$dialog.find('#saveKeyboardBtn').click(function(){
		saveKeys($dialog);
	});
}
//-------------------------------------------------------------------------------//
function saveKeys($dialog){
	if($dialog.find('.selectedKey').length===0)
		$dialog.find('#error').show();
	else{
		$dialog.find('#error').hide();
		var keyButtonArr = [];
		$dialog.find('.keyButton').each(function(){
			var key = {
					keyName 	: 	$(this).attr('data-key'),
					keyCode 	: 	$(this).attr('data-key'),
					keyId 		: 	$(this).attr('key-id')
			}
			if($(this).hasClass('selectedKey'))
				key['active'] = 'T';
			else
				key['active'] = 'F';

			keyButtonArr.push(key);
		});
		$.post('saveGameKeys',{keys:keyButtonArr},function(res){
			gm_closeDialog();
			toastr.success('Game Keys Saved Successfully');
		});
	}
}
//-------------------------------------------------------------------------------//
function getGameKeys($dialog){
	$.post('getGameKeys',{},function(res){
		var resArr = JSON.parse(res);
		var gameKeys = resArr['gameKeys'];
		for(var i=0;i<gameKeys.length;i++){
			var keyName = gameKeys[i]['key_name'];
			var keyId = gameKeys[i]['game_key_id'];
			var active = gameKeys[i]['active'];
			$dialog.find('.keyButton[data-key="'+keyName+'"]').attr('key-id',keyId);
			if(active==='T')
				$dialog.find('.keyButton[data-key="'+keyName+'"]').addClass('selectedKey blue');
		}
	});
}
//-------------------------------------------------------------------------------//
$(function(){
	$('#keys_btn').click(keyboardDialog);
});
//-------------------------------------------------------------------------------//