//-------------------------------------------------------------------------------//
function eventNameChange($dialog,$this){
	var eventNameCode = $this.val();
	switch(eventNameCode){
		case 'RNDM_PSN':
			getRndmPsnProp();
			hideEventProp();
		break;
		case 'VAR':
			hideEventProp();
		break;
		case 'PXL_CLSN':
			hideEventProp();
		break;
		
		default:
			hideEventProp();
		break;
	}
}
//-------------------------------------------------------------------------------//
function hideEventProp(){
	
}
//-------------------------------------------------------------------------------//
$(function(){
	$('#events_btn').click(function(){
		var $form = $('#eventsForm').clone().removeClass('hide');
		var options = {
	        isAdd       :   true,
	        addTitle    :   'Save',
	        addId       :   'saveEventsBtn',
	        size		: 	'large'
	    };
		var $dialog = gm_dialog('Game Events',$form,options);
		$dialog.find('#eventNameCode').change(function(){
			eventNameChange($dialog,$(this));
		});
	});
});
//-------------------------------------------------------------------------------//