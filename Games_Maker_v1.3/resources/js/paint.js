//------------------------------------------------------------------------------------//
function changePaintGrid(width){
    var newWidth = Math.pow(2,width);
	var $paintGrid = $('#paintGrid');
	var rowCount = 0;
    var cellCount = 0;
    var classCount = 0;
    var classCount2 = 0;
    var count = 0;
    $paintGrid.find('.pixel-picker-row').each(function () {
        rowCount = rowCount+1;
        $(this).find('.pixel-picker-cell').each(function () {
            cellCount = cellCount+1;
            $(this).css('box-shadow','inset 0px 0px 0 0 rgba(0, 0, 0, 0.2)');
            if(rowCount == 1)
                $(this).css('box-shadow','inset 0px 1px 0 0 rgba(0, 0, 0, 0.2)');
            if(rowCount == newWidth)
                $(this).css('box-shadow','inset 0px -1px 0 0 rgba(0, 0, 0, 0.2)');
            if(cellCount == 1){
                $(this).css('box-shadow', 'inset 1px 0px 0 0 rgba(0, 0, 0, 0.2)');
                classCount = classCount+1;
            }
            if(cellCount == newWidth)
                $(this).css('box-shadow','inset -1px 0px 0 0 rgba(0, 0, 0, 0.2)');
            if(rowCount == 1 && cellCount == 1)
                $(this).css('box-shadow', 'inset 1px 1px 0 0 rgba(0, 0, 0, 0.2)');
            if(rowCount == 1 && cellCount == newWidth)
                $(this).css('box-shadow','inset -1px 0px 0 0 rgba(0, 0, 0, 0.2),inset 0px 1px 0 0 rgba(0, 0, 0, 0.2)');
            if(rowCount == newWidth  && cellCount == 1)
                $(this).css('box-shadow','inset 0px -1px 0 0 rgba(0, 0, 0, 0.2),inset 1px 0px 0 0 rgba(0, 0, 0, 0.2)');
            if(rowCount == newWidth  && cellCount == newWidth)
                $(this).css('box-shadow','inset -1px -1px 0 0 rgba(0, 0, 0, 0.2)');
            if(cellCount == newWidth)
                cellCount = 0;
            if(cellCount <= newWidth){
                $(this).attr('data-classCount',classCount);
            }
        });
        if(rowCount == newWidth){
            rowCount = 0;
            count = count+1;
            classCount2 = classCount;
        }
        classCount = classCount2;
    });
}
//------------------------------------------------------------------------------------//
function setColor() {
    initPixelPicker($('#colorPicker').spectrum('get').toHexString());
}
//------------------------------------------------------------------------------------//
function takeColor(){
    setColor();
    $('#eyeDropper').addClass('isClicked violet');
    $('#eraser,#pencil').removeClass('violet isClicked');
}
//------------------------------------------------------------------------------------//
function takeOColor() {
    $('#paintGrid').mouseup(function (event){
        var target = $(event.target);
        if($('#eyeDropper').hasClass('isClicked') && target.hasClass('pixel-picker-cell')) {
            var color = rgbToHexa(target.css('background-color'));
            setSpectrumOption($('#colorPicker'),'sp-dark',color);
        }
    });
}
//------------------------------------------------------------------------------------//
function rgbToHexa(rgb) {
    rgb = rgb.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);
    function hex(x) {
        return ("0" + parseInt(x).toString(16)).slice(-2);
    }
    return "#" + hex(rgb[1]) + hex(rgb[2]) + hex(rgb[3]);
}
//------------------------------------------------------------------------------------//
function erasePixel(){
    $('#eraser').addClass('isClicked violet');
    $('#pencil,#eyeDropper').removeClass('violet isClicked');
    initPixelPicker('#ffffff');
}
//------------------------------------------------------------------------------------//
function fillPixel(){
    $('#pencil').addClass('isClicked violet');
    $('#eraser,#eyeDropper').removeClass('violet isClicked');
    setColor();
}
//------------------------------------------------------------------------------------//
function initPixelPicker(paletteColor){
    $( ".pixel-picker-cell" ).unbind('mousedown');
    $( ".pixel-picker-cell" ).unbind('mouseup');
    $( ".pixel-picker-cell" ).unbind('mouseenter');
    $('.pixel-picker-container').pixelPicker({palette:[paletteColor]});
}
//------------------------------------------------------------------------------------//
function convertToImage(){
    var rgbArray = [];
    $('#paintGrid .pixel-picker-row').each(function(){
        var rowArr = $(this).find('.pixel-picker-cell').map(function() {
            var rgbArr = rgb2arr($(this).css('background-color'));
            return rgbArr;
        }).get();
        rgbArray = rgbArray.concat(rowArr);
        rgbArray = rgbArray.concat(rowArr);
    });
    var image = getConvertArray2Img(rgbArray,64,64);
    $('#previewImg').html(image);
}
//------------------------------------------------------------------------------------//
function saveAsImage(){
    var $form = $('form#imageName');
    gm_form_validation($form,function(){
        var paintId = $('#paintId').val();
        var paint_name = $('#image_name').val();
        var rgbArray = [] , rgbArr = [];
        var isAdd = 1;
        $('#paintGrid .pixel-picker-row').each(function(){
            var rowArr = $(this).find('.pixel-picker-cell').map(function() {
                rgbArr = rgb2arr($(this).css('background-color'));
                return rgbArr;
            }).get();
            rgbArray = rgbArray.concat(rowArr);
            rgbArray = rgbArray.concat(rowArr);
        });
        if(paintId != '')
            isAdd = 0;
        var paint_colors = rgbArray.join('-');
        var imageSrc = $('#previewImg img').attr('src');
        var data = {
                paintId         :   paintId,
                paint_name      :   paint_name,
                paint_colors    :   paint_colors,
                imageSrc        :   imageSrc,
                isAdd           :   isAdd
        }
        $.post('savePaint2Image',data,function(res){
            toastr.success('Operation Done Successfully');
            location.assign('buildGame');
        });
    });
}
//------------------------------------------------------------------------------------//
$(function(){
    eraseCookie('paintId');
    changePaintGrid(0);
    setSpectrumOption($('#colorPicker'),'sp-dark',"#208f19");
    takeOColor();
    initPixelPicker('#208f19');
    setInterval(convertToImage,500);
    setTimeout(function(){
        $('#pencil').click();      
    },1000);
    //===================================================//
	$('#colorPicker').change(function(){
	    if(!$('#eraser').hasClass('isClicked'))
            setColor();
	});
	$('#eraseAll').click(function(){
	   gm_confirm('Erase All Pixels','Are You Sure?',function(){
	       $('.pixel-picker-cell').css('background-color','rgb(255, 255, 255)');
       });
    });
    //===================================================//
    var slider = $('#grid_width');
    var output = $('#gridWidthVal');
    output.html(slider.val());
    slider.input(function() {
        output.html($(this).val());
        changePaintGrid($(this).val());
    });
    //===================================================//
    $('#eyeDropper').click(function(){
        gm_awesomeCursor($('.pixel-picker-cell'),'eyedropper',{color:'#6435C9'});
        if(!$(this).hasClass('isClicked'))
            takeColor();
    });
    //===================================================//
    $('#eraser').click(function(){
        gm_awesomeCursor($('.pixel-picker-cell'),'eraser',{color:'#6435C9'});
        if(!$(this).hasClass('isClicked'))
            erasePixel();
    });
    //===================================================//
    $('#pencil').click(function(){
        gm_awesomeCursor($('.pixel-picker-cell'),'pencil',{color:'#6435C9'});
        if(!$(this).hasClass('isClicked'))
            fillPixel();
    });
    //===================================================//
    $('#undo').click(function(){
        if(stackEvents.length!=0) {
            var cells = stackEvents.pop();
            if(stackEvents.length==0)
                $('#undo').attr('disabled','disabled');
            //-------------------------------------------------//
            var undoCells = [];
            for(var i=0;i<cells.length;i++){
                var oldColor = cells[i].color;
                var thisColor = $(cells[i].cell).css('background-color');
                $(cells[i].cell).css('background-color', oldColor);
                undoCells.push({'cell':cells[i].cell,'color':thisColor});
            }
            undoEvents.push(undoCells);
            $('#redo').removeAttr('disabled');
        }
    });
    //===================================================//
    $('#redo').click(function(){
        if(undoEvents.length!=0) {
            var cells = undoEvents.pop();
            if(undoEvents.length==0)
                $('#redo').attr('disabled','disabled');
            //-------------------------------------------------//
            var redoCells = [];
            for(var i=0;i<cells.length;i++){
                var oldColor = cells[i].color;
                var thisColor = $(cells[i].cell).css('background-color');
                $(cells[i].cell).css('background-color', oldColor);
                redoCells.push({'cell':cells[i].cell,'color':thisColor});
            }
            stackEvents.push(redoCells);
            $('#undo').removeAttr('disabled');
        }
    });
    //===================================================//
    $('#saveToImg').click(function(){
        saveAsImage();
    });
    //===================================================//
    $('#play_game_btn').click(function(){
        var gamePath = '/games_repositories/'+$('#userName').val()+'/Games/'+$('#gameFullName').val();
        window.open(gamePath,'_blank','width=1250,height=600');
    });
});
//------------------------------------------------------------------------------------//