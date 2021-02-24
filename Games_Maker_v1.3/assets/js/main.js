//-----------------------------------------------------------------//
jQuery.fn.input = function(fn) {
	var $this = this;
	return fn
		?
			$this.bind({
				'input.input': function(event) {
					$this.unbind('keydown.input');
					fn.call(this, event);
				},
				'keydown.input': function(event) {
					fn.call(this, event);
				}
			})
		:
			$this.trigger('keydown.input');
};
//-----------------------------------------------------------------//
var pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0 , elmnt = '';
function gm_dragElement(dragEle) {
	elmnt = dragEle;
	if (document.getElementById(elmnt.id + "header")) {
	/* if present, the header is where you move the DIV from:*/
		document.getElementById(elmnt.id + "header").onmousedown = dragMouseDown;
	} else {
	/* otherwise, move the DIV from anywhere inside the DIV:*/
		elmnt.addEventListener('mousedown', dragMouseDown, false);
		// elmnt.onmousedown = dragMouseDown;
	}
}

function dragMouseDown(e) {
	e = e || window.event;
	e.preventDefault();
	// get the mouse cursor position at startup:
	pos3 = e.clientX;
	pos4 = e.clientY;
	document.onmouseup = closeDragElement;
	// call a function whenever the cursor moves:
	document.onmousemove = elementDrag;
}

function elementDrag(e) {
	e = e || window.event;
	e.preventDefault();
	// calculate the new cursor position:
	pos1 = pos3 - e.clientX;
	pos2 = pos4 - e.clientY;
	pos3 = e.clientX;
	pos4 = e.clientY;
	// set the element's new position:
	elmnt.style.top = (elmnt.offsetTop - pos2) + "px";
	elmnt.style.left = (elmnt.offsetLeft - pos1) + "px";
}

function closeDragElement() {
	/* stop moving when mouse button is released:*/
	document.onmouseup = null;
	document.onmousemove = null;
}
//-----------------------------------------------------------------//
function gm_deleteDrag($elmnt){
	$elmnt[0].removeEventListener('mousedown', dragMouseDown, false);
}
//-----------------------------------------------------------------//
$(function(){
	$('[data-content]').popup();
	gm_init_toastr();
	initValidation();
});
//-----------------------------------------------------------------//
// $cont: where the cursor will change to icon
// icon: cursor icon (font awesome icon) like [pencil , brush , eye , ....]
// options: like (icon , color , size )
$.fn.awesomeCursor.defaults.hotspot = 'bottom left';
function gm_awesomeCursor($cont,icon,options){
	$cont.awesomeCursor(icon,options);
}
//-----------------------------------------------------------------//
function gm_init_toastr(){
	toastr.options.closeMethod = 'fadeOut';
	toastr.options.closeEasing = 'swing';
	toastr.options.timeOut = 4000; // How long the toast will display without user interaction
	toastr.options.extendedTimeOut = 4000; // How long the toast will display after a user hovers over it
	toastr.options.progressBar = true;
}
//-----------------------------------------------------------------//
function gm_popOver($popOverBtn,title,content,options,callback){
	var popUpCount = 0;
	if($('body .gmPopUpEle').size())
		popUpCount = $('body .gmPopUpEle').size();

	var popUpClass = 'gmPopUp-'+popUpCount;
	var popOverContent = '';
		popOverContent += '<div class="ui popup top center transition hidden gmPopUpEle '+popUpClass+'" data-variation="inverted" style="border-radius:0px 20px;background-color: #202123">'+
							'<span class="ui ribbon label teal" style="margin-bottom: 10px;">'+title+'</span>'+
							'<div class="ui" style="padding: 10px;background-color: #363d44 ;margin: 10px;border-radius: 8px;">';
		popOverContent += content;
		popOverContent += 	'</div>';
		popOverContent += 	'<div id="cancelId" class="ui inverted green button mini">Cancel</div>'+
    						'<div id="'+options.okId+'" class="ui inverted red button mini">Ok</div>';
		popOverContent += '</div>';

	$('body').append(popOverContent);
	$popOverBtn.popup({
	    popup : '.'+popUpClass,
	    on    : 'click',
	    variation: 'inverted',
	    exclusive: true,
	    closable: false,
	    position: 'top center',
	    onShow: function(){
	    	callback(popUpClass);
	    	$('body .gmPopUpEle').find('[data-content]').popup();
	    },
	    onVisible: function(){
    		$('body .gmPopUpEle #cancelId').unbind('click').click(function(){
    			if(options.cancelCallback)
    				eval(options.cancelCallback+'();');
    			
				$popOverBtn.popup('hide');
    		});
    		initValidation();
	    }
  	});
}
//-----------------------------------------------------------------//
function gm_dialog(title,content,options){
	var $modal = $('.gmModal').clone().removeClass('hide gmModal');
	$modal.addClass('opened_Modal');
	$modal.find('.headerTitle').html(title);
	$modal.find('.content').html(content);
    if(options.size){
        $modal.addClass(options.size);// mini , small , big , large
    }
	//=================================================//
	var buttons = '';
	if(options.isAdd) {
		buttons = '<div id="' + options.addId + '" class="ui inverted green right labeled icon button">' + options.addTitle + '<i class="save icon"></i></div>';
		buttons += '<div class="ui inverted red right labeled icon button closeModal">Cancel<i class="close icon"></i></div>';
	}
	if(options.isEdit){
		buttons = '<div id="' + options.editId + '" class="ui inverted green right labeled icon button">' + options.editTitle + '<i class="paste icon"></i></div>';
		buttons += '<div class="ui inverted red right labeled icon button closeModal">Cancel<i class="close icon"></i></div>';
	}
	if(options.isConfirm){
		buttons = '<div id="' + options.yesId + '" class="ui inverted green right labeled icon button">Yes<i class="checkmark icon"></i></div>';
		buttons += '<div class="ui inverted red right labeled icon button closeModal">No<i class="close icon"></i></div>';
	}
	if(options.isOk)
		buttons = '<div id="okId" class="ui inverted red right labeled icon button closeModal">Ok<i class="checkmark icon"></i></div>';
	//=================================================//
	$modal.find('.actions').html(buttons);
	$modal.modal({
		'onShow'	: 	initModal,
		closable:  false,
		autofocus: false,
	}).drags({
			handle:".header",
			selected:$('.ui.modal.opened_Modal')
		});
	$modal.modal('show');
    setTimeout(function(){$modal.find('[data-content]').popup();},500);
	$modal.find('.closeModal').click(gm_closeDialog);

	return $modal;
}
//-----------------------------------------------------------------//
function gm_confirm(title,content,callback){
	var options = {
			isConfirm		:	true,
			yesId			:	'gm_yes_confrim',
	};
	var $modal = gm_dialog(title,content,options);
	$modal.addClass('tiny');
	$modal.find('#gm_yes_confrim').click(function(){
		callback();
		gm_closeDialog();
	});
	return $modal;
}
//-----------------------------------------------------------------//
//-------------------------------------------------------------------------------------//
function setSpectrumOption($obj,theme,color){
	$obj.spectrum('destroy');
    $obj.spectrum({
        theme: theme,  // "sp-dark" Or you can use "sp-light"
        color: color,  // default value
        preferredFormat: "hex",
        showPalette: true,
        allowEmpty: true,
        showInitial: true,
        showInput: true,
        showAlpha: true,
        togglePaletteOnly: true,
        palette: [
            ["#000","#444","#666","#999","#ccc","#eee","#f3f3f3","#fff"],
            ["#f00","#f90","#ff0","#0f0","#0ff","#00f","#90f","#f0f"],
            ["#f4cccc","#fce5cd","#fff2cc","#d9ead3","#d0e0e3","#cfe2f3","#d9d2e9","#ead1dc"],
            ["#ea9999","#f9cb9c","#ffe599","#b6d7a8","#a2c4c9","#9fc5e8","#b4a7d6","#d5a6bd"],
            ["#e06666","#f6b26b","#ffd966","#93c47d","#76a5af","#6fa8dc","#8e7cc3","#c27ba0"],
            ["#c00","#e69138","#f1c232","#6aa84f","#45818e","#3d85c6","#674ea7","#a64d79"],
            ["#900","#b45f06","#bf9000","#38761d","#134f5c","#0b5394","#351c75","#741b47"],
            ["#600","#783f04","#7f6000","#274e13","#0c343d","#073763","#20124d","#061f27"]
        ]
    });
}
//-----------------------------------------------------------------//
function gm_alert(title,message){
	var $modal = gm_dialog(title,message,{isOk:true});
	$modal.addClass('mini');
	return $modal;
}
//-----------------------------------------------------------------//
function gm_closeDialog(){
	$('.opened_Modal').modal('hide');
	setTimeout(function(){
		$('.opened_Modal').remove();
	},200);
}
//-----------------------------------------------------------------//
function initModal(){
	gm_uiDropdown();
	initValidation();
}
//-----------------------------------------------------------------//
function gm_uiDropdown(){
	$('.ui.dropdown').dropdown();
}
//-----------------------------------------------------------------//
function initValidation () {
	$.validator.addClassRules({
		gm_number : {
			number: true
		},
		gm_req:{
			required: true,
		},
		gm_email:{
			email: true
		},
		gm_password:{
			minlength: 5
		}
	});	
	$.validator.setDefaults({ 
	    errorPlacement: function (error, element) {
	    	// $(element).parent().parent().append(error); // if there is no (.field)
	    	$(element).parents('.field').append(error);
	    }
	});
}
//-----------------------------------------------------------------//
function gm_form_validation($form,onValidFunction){
    var isValid = $form.valid();
    var selectVal = $form.find('.dropdown.gm_req').find('select').val();
    if(!selectVal)
        $form.find('.dropdown.gm_req').parents('.field').append('<label id="select-error" class="error" for="select">This field is required.</label>');

    if(isValid){
        if($form.find('.dropdown.gm_req').find('select').length!==0){
            if(selectVal)
                onValidFunction();
        }else
            onValidFunction();
    }
}
//-----------------------------------------------------------------//
function createCookie(name, value, days) {
	if (days) {
		var date = new Date();
		date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
		var expires = "; expires=" + date.toGMTString();
	}
	else var expires = "";               

	document.cookie = name + "=" + value + expires + "; path=/";
}
//-----------------------------------------------------------------//
function readCookie(name) {
	var nameEQ = name + "=";
	var ca = document.cookie.split(';');
	for (var i = 0; i < ca.length; i++) {
		var c = ca[i];
		while (c.charAt(0) == ' ') c = c.substring(1, c.length);
		if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
	}
	return null;
}
//-----------------------------------------------------------------//
function eraseCookie(name) {
	createCookie(name, "", -1);
}
//-----------------------------------------------------------------//
(function ($) {
	$.fn.drags = function (opt) {

		opt = $.extend({
			handle: "",
			selected: "",
			cursor: "move"
		}, opt);

		var $selected = opt.selected;
		var $elements = (opt.handle === "") ? this : this.find(opt.handle);

		$elements.css('cursor', opt.cursor).on("mousedown", function (e) {
			var pos_y = $selected.offset().top - e.pageY;
			var pos_x = $selected.offset().left - e.pageX;

			$(document).on("mousemove", function (e) {
				//if(e.pageY>80) {
					//console.log('e.pageY: ' + e.pageY + '         ,e.pageX: ' + e.pageX);
					$selected.offset({
						top: e.pageY + pos_y,
						left: e.pageX + pos_x
					});
				//}else{
				//	$selected.offset({
				//		left: e.pageX + pos_x
				//	});
				//}
			}).on("mouseup", function () {
				$(this).off("mousemove"); // Unbind events from document
			});
			e.preventDefault(); // disable selection
		});

		return this;

	};
})(jQuery);
//-----------------------------------------------------------------//