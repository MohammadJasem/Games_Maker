
function RANDOM_POSITION (){
	//PIXEL_ARR
	var fineToPut = false;
	while(!fineToPut){
		var randomX = Math.floor(Math.random() * GAME_WIDTH ) * 20,
		randomY = Math.floor(Math.random() * GAME_HIEGHT ) * 20;
		var fineToPut = true;
		for(var i=0;i<pixelArr.length;i++)
			if(pixelArr[i][0] == randomX && pixelArr[i][1] == randomY)
				fineToPut = false;
		if(fineToPut){
			PIXEL_SPRITE_VAR = game.add.sprite(randomX, randomY, 'PIXEL_SPRITE_NAME');
			PIXEL_SPRITE_VAR.scale.setTo(0.3125, 0.3125);
		}
	}
}