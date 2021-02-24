//----------------------------------------------------------------------------//
function openAddGameDialog(){
	var $form = $('#addGameForm').clone().removeClass('hide');
	var options = {
        isAdd       :   true,
        addTitle    :   'Save',
        addId       :   'addGameBtn'
    };
    $form.find('#gameLogo').filepond({
        server: {
            process: {
                url: 'uploadGameLogo',
                method: 'POST'
            },
        }
    });
	var $dialog = gm_dialog('Add Game',$form,options);
	$dialog.find('#addGameBtn').click(function(){
		var $form = $dialog.find('form#addGameForm');
		gm_form_validation($form,function(){
			var data = $form.serialize();
			$.post('addGame',data,function(res){
				var resArr = JSON.parse(res);
				if(resArr['exist']=='Y')
					gm_alert('Alert',"The Game exist.<br>With the same (Name , Version , Dimension)");
				else{
					createCookie('gameId',resArr['gameId'],1);
					gm_closeDialog();
					toastr.success('The Game Was Saved successfully');
				}
			}).done(function(){
                window.location.href = 'buildGame';
			});
		});
	});
}
//----------------------------------------------------------------------------//
function confirmDeleteGame(){
	var gameFullName = $(this).attr('data-gameFullName');
	var gameId = $(this).attr('data-gameId');
	gm_confirm('Delete ('+gameFullName+') Game','<h3>Are You Sure?</h3>',function(){
		$.post('deleteGame',{gameId:gameId},function(res){
			gm_closeDialog();
			toastr.success('The Game Was Deleted successfully');
		}).done(function(){
			window.location.href = 'home';
		});
	});
}

//----------------------------------------------------------------------------//
function updateGame(){
	var gameId = $(this).attr('data-gameId');
	var $form = $('#addGameForm').clone().removeClass('hide');
	var options = {
        isEdit       :   true,
        editTitle    :   'Update',
        editId       :   'updateGameBtn'
    };
    $form.find('#gameLogo').filepond({
        server: {
            process: {
                url: 'uploadGameLogo',
                method: 'POST'
            },
        }
    });
	var $dialog = gm_dialog('Update Game',$form,options);
	$.post('getGame',{gameId:gameId},function(res){
		var resArr = JSON.parse(res);
		$dialog.find('#game_name').val(resArr['game_name']);
		$dialog.find('#game_ver').val(resArr['game_ver']);
		$dialog.find('#dimension').val(resArr['dimension']);
		gm_uiDropdown();
	});
	$dialog.find('#updateGameBtn').click(function(){
		var $form = $dialog.find('form#addGameForm');
		gm_form_validation($form,function(){
			var data = $form.serialize();
			$.post('updateGame',data+'&gameId='+gameId,function(res){
				var resArr = JSON.parse(res);
				if(resArr['exist']=='Y')
					gm_alert('Alert',"The Game exist.<br>With the same (Name , Version , Dimension)");
				else{
					gm_closeDialog();
					toastr.success('The Game Was Updated successfully');
				}
			}).done(function(){
				// window.location.href = 'home';
                window.location.reload(true);
			});
		});
	});
}
//----------------------------------------------------------------------------//
function playGame(){
	var gamePath = $(this).attr('data-gamePath');
	window.open(gamePath,'_blank','width=1250,height=600');
}
//----------------------------------------------------------------------------//
function exportGame(){
    var gameId = $(this).attr('data-gameId');
    $.post('exportGame','gameId='+gameId,function(res) {
        toastr.success('The Game Was Exported successfully');
    });
}
//----------------------------------------------------------------------------//
$(function(){
    $('#newGameId').click(function () {
		var gamesCount = $('#gamesCount').val();
		if(gamesCount<3)
			openAddGameDialog();
		else
            gm_alert('Alert','Maximum Games is 3<br>Please Upgrade Your Account To Make More Games');
    });
    $('.updateGame').click(updateGame);
    $('#upgradeId').click(function () {
        gm_alert('Upgrade Account','Soon That Will Be Available');
    });
    $('.playGame').click(playGame);
	$('.editGame').click(function(){
		createCookie('gameId',$(this).attr('data-gameId'),1);
		window.location.href = 'buildGame';
	});
	$('.deleteGame').click(confirmDeleteGame);
	$('.exportGame').click(exportGame);

});