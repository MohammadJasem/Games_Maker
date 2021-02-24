var cursors;





var objectToMove_apple;


var objectToMove_apple;

var appleSprite_240440;

var objectToMove_apple;
var objectToMove_snake;

var appleSprite_240440;

var objectToMove_apple;
var objectToMove_snake;

var appleSprite_240440;

var objectToMove_apple;
var objectToMove_snake;
//GLOBAL_MOVING_GROUP_CODE
var appleSprite_240440;

var objectToMove_apple;
var objectToMove_snake;
//GLOBAL_MOVING_GROUP_CODE

var StartGame = {

    preload : function() {
//PRELOAD

//BCKGRND
	
//BCKGRND


//PAINTS

	game.load.image("apple", "/games_repositories/MJ1995/Games/Snake_2D_1.0/assets/img/apple.png");
	game.load.image("apple", "/games_repositories/MJ1995/Games/Snake_2D_1.0/assets/img/apple.png");
	game.load.image("apple", "/games_repositories/MJ1995/Games/Snake_2D_1.0/assets/img/apple.png");
	game.load.image("apple", "/games_repositories/MJ1995/Games/Snake_2D_1.0/assets/img/apple.png");
	game.load.image("apple", "/games_repositories/MJ1995/Games/Snake_2D_1.0/assets/img/apple.png");
	game.load.image("apple", "/games_repositories/MJ1995/Games/Snake_2D_1.0/assets/img/apple.png");
	game.load.image("apple", "/games_repositories/MJ1995/Games/Snake_2D_1.0/assets/img/apple.png");
	game.load.image("apple", "/games_repositories/MJ1995/Games/Snake_2D_1.0/assets/img/apple.png");
	game.load.image("snake", "/games_repositories/MJ1995/Games/Snake_2D_1.0/assets/img/snake.png");
	game.load.image("snake", "/games_repositories/MJ1995/Games/Snake_2D_1.0/assets/img/snake.png");
	game.load.image("snake", "/games_repositories/MJ1995/Games/Snake_2D_1.0/assets/img/snake.png");
	game.load.image("snake", "/games_repositories/MJ1995/Games/Snake_2D_1.0/assets/img/snake.png");
//PAINTS


//PRELOAD
    },

    create: function () {

	// Set up a Phaser controller for keyboard input.
    cursors = game.input.keyboard.createCursorKeys();
        
//CREATE

//STBCKGRND
	game.stage.backgroundColor = '#061f27';
//STBCKGRND



//PIXELS

	 appleSprite_240440 = game.add.sprite(440,240,"apple");
	appleSprite_240440.scale.setTo(0.3125, 0.3125);
	textStyle_Key = {font: "bold 25px sans-serif",fill: "#ffd966",align: "center"};
	textStyle_Value = {font:"bold 25px sans-serif",fill: "#ffd966",align: "center" };
	textValue_0460 = game.add.text(460,0,"S",textStyle_Key);
	textStyle_Key = {font: "bold 25px sans-serif",fill: "#ffd966",align: "center"};
	textStyle_Value = {font:"bold 25px sans-serif",fill: "#ffd966",align: "center" };
	textValue_0480 = game.add.text(480,0,"c",textStyle_Key);
	textStyle_Key = {font: "bold 25px sans-serif",fill: "#ffd966",align: "center"};
	textStyle_Value = {font:"bold 25px sans-serif",fill: "#ffd966",align: "center" };
	textValue_0500 = game.add.text(500,0,"o",textStyle_Key);
	textStyle_Key = {font: "bold 25px sans-serif",fill: "#ffd966",align: "center"};
	textStyle_Value = {font:"bold 25px sans-serif",fill: "#ffd966",align: "center" };
	textValue_0520 = game.add.text(520,0,"r",textStyle_Key);
	textStyle_Key = {font: "bold 25px sans-serif",fill: "#ffd966",align: "center"};
	textStyle_Value = {font:"bold 25px sans-serif",fill: "#ffd966",align: "center" };
	textValue_0540 = game.add.text(540,0,"e",textStyle_Key);
	textStyle_Key = {font: "bold 25px sans-serif",fill: "#ffd966",align: "center"};
	textStyle_Value = {font:"bold 25px sans-serif",fill: "#ffd966",align: "center" };
	textValue_0560 = game.add.text(560,0,":",textStyle_Key);
	textStyle_Key = {font: "bold 25px sans-serif",fill: "#ffd966",align: "center"};
	textStyle_Value = {font:"bold 25px sans-serif",fill: "#ffd966",align: "center" };
	textValue_0580 = game.add.text(580,0,"0",textStyle_Key);
	 snakeSprite_80180 = game.add.sprite(180,80,"snake");
	snakeSprite_80180.scale.setTo(0.3125, 0.3125);
	 snakeSprite_100180 = game.add.sprite(180,100,"snake");
	snakeSprite_100180.scale.setTo(0.3125, 0.3125);
	 snakeSprite_120180 = game.add.sprite(180,120,"snake");
	snakeSprite_120180.scale.setTo(0.3125, 0.3125);
	 snakeSprite_140180 = game.add.sprite(180,140,"snake");
	snakeSprite_140180.scale.setTo(0.3125, 0.3125);
//PIXELS



//F_CALL_EVENTS

appleSprite_240440.destroy();
randomPosition_240440();
objectToMove_snake = [snakeSprite_140180,snakeSprite_120180,snakeSprite_100180,snakeSprite_80180];
//F_CALL_EVENTS


//CREATE
    },

    update: function () {
//UPDATE

//F_CALL_UPDATE_FUNC

moving_80180();
//F_CALL_UPDATE_FUNC

//UPDATE
    },

	nextState: function(){
//NXTSTATE
	this.state.start('');
//NXTSTATE
    }

};


//EVENTS_FUNCTIONS


function randomPosition_240440 (){
	var pixelArr = [[460,0],[480,0],[500,0],[520,0],[540,0],[560,0],[580,0],[180,80],[180,100],[180,120],[180,140]];
	var fineToPut = false;
	while(!fineToPut){
		var randomX = Math.floor(Math.random() * 30 ) * 20,
		randomY = Math.floor(Math.random() * 22 ) * 20;
		var fineToPut = true;
		for(var i=0;i<pixelArr.length;i++)
			if(pixelArr[i][0] == randomX && pixelArr[i][1] == randomY)
				fineToPut = false;
		if(fineToPut){
			appleSprite_240440 = game.add.sprite(randomX, randomY, 'apple');
			appleSprite_240440.scale.setTo(0.3125, 0.3125);
		}
	}
}
var resultVar = 0;

var updateDelay = 0;
var new_direction = null;
var direction = 'right';
var addNew = false;
var canMove = true;
var FIXED_OBJECT_CNT_DSTR = [];
var FIXED_OBJECT_CN_DSTR = [];
var moveRandomly = true
function moving_80180() {

	var keys = {esc:'F',space:'F',left:'T',right:'T',up:'T',down:'T'};
	//var keys = {'up':'T','down':'T','right':'T','left':'T'}
	cursors = game.input.keyboard.createCursorKeys();

    if (cursors.right.isDown && (direction!='left'||!moveRandomly) && keys['right'] == 'T')
        new_direction = 'right';
    else if (cursors.left.isDown && (direction!='right'||!moveRandomly) && keys['left'] == 'T')
        new_direction = 'left';
    else if (cursors.up.isDown && (direction!='down'||!moveRandomly) && keys['up'] == 'T')
        new_direction = 'up';
    else if (cursors.down.isDown && (direction!='up'||!moveRandomly) && keys['down'] == 'T')
        new_direction = 'down';
FIXED_OBJECT_CNT_DSTR = [];
FIXED_OBJECT_CN_DSTR = [];
var first = objectToMove_snake[objectToMove_snake.length - 1];

    if(FIXED_OBJECT_CNT_DSTR !=''){
        for (var i = 0; i < FIXED_OBJECT_CNT_DSTR.length; i++) {
            if(direction=='right' && first.y == FIXED_OBJECT_CNT_DSTR[i].y && first.x == FIXED_OBJECT_CNT_DSTR[i].x-20){
                canMove = false;
                break;
            }
            if(((direction=='up' || direction=='down') && new_direction=='right') && first.y == FIXED_OBJECT_CNT_DSTR[i].y && first.x == FIXED_OBJECT_CNT_DSTR[i].x-20){
                canMove = true;
                new_direction = direction;
                break;
            }
            if(direction=='left' && first.y == FIXED_OBJECT_CNT_DSTR[i].y && first.x == FIXED_OBJECT_CNT_DSTR[i].x+20){
                canMove = false;
                break;
            }
            if(((direction=='up' || direction=='down') && new_direction=='left') && first.y == FIXED_OBJECT_CNT_DSTR[i].y && first.x == FIXED_OBJECT_CNT_DSTR[i].x+20){
                canMove = true;
                new_direction = direction;
                break;
            }
            if(direction=='up' && first.y == FIXED_OBJECT_CNT_DSTR[i].y+20 && first.x == FIXED_OBJECT_CNT_DSTR[i].x){
                canMove = false;
                break;
            }
            if(((direction=='right' || direction=='left') && new_direction=='up') && first.y == FIXED_OBJECT_CNT_DSTR[i].y+20 && first.x == FIXED_OBJECT_CNT_DSTR[i].x){
                canMove = true;
                new_direction = direction;
                break;
            }
            if(direction=='down'&& first.y == FIXED_OBJECT_CNT_DSTR[i].y-20 && first.x == FIXED_OBJECT_CNT_DSTR[i].x){
                canMove = false;
                break;
            }
            if(((direction=='right' || direction=='left') && new_direction=='down') && first.y == FIXED_OBJECT_CNT_DSTR[i].y-20 && first.x == FIXED_OBJECT_CNT_DSTR[i].x){
                canMove = true;
                new_direction = direction;
                break;
            }
        }
        if(!canMove && (direction=='right' ||direction=='left' ) && (new_direction == 'up' || new_direction == 'down'))
            canMove = true;
        if(!canMove && (direction=='up' ||direction=='down' ) && (new_direction == 'right' || new_direction == 'left'))
            canMove = true;
    }




    updateDelay++;

   
    if (updateDelay % 15 == 0 && canMove) {

        var firstCell = objectToMove_snake[objectToMove_snake.length - 1],
            lastCell = objectToMove_snake.shift(),
            oldLastCellx = lastCell.x,
            oldLastCelly = lastCell.y;

        if(new_direction){
            direction = new_direction;
            new_direction = null;
        }

        if(direction == 'right'){

            lastCell.x = firstCell.x + 20;
            lastCell.y = firstCell.y;
        }
        else if(direction == 'left'){
            lastCell.x = firstCell.x - 20;
            lastCell.y = firstCell.y;
        }
        else if(direction == 'up'){
            lastCell.x = firstCell.x;
            lastCell.y = firstCell.y - 20;
        }
        else if(direction == 'down'){
            lastCell.x = firstCell.x;
            lastCell.y = firstCell.y + 20;
        }

        objectToMove_snake.push(lastCell);
        firstCell = lastCell;


        if(addNew){
            objectToMove_snake.unshift(game.add.sprite(oldLastCellx, oldLastCelly, 'snake'));
            objectToMove_snake[0].scale.setTo(0.3125, 0.3125);
            addNew = false;
        }
        if(moveRandomly)
            pixelCollisionRandom();
        else
            pixelCollision();
        wallCollision();
        selfColision();
    }

}



function pixelCollisionRandom() {
    for(var i = 0; i < objectToMove_snake.length; i++)
        if(objectToMove_snake[i].x == appleSprite_240440.x && objectToMove_snake[i].y == appleSprite_240440.y){
            addNew = true;
            appleSprite_240440.destroy();
            randomPosition_240440();
            resultVar++;
            textValue_0580.text = resultVar.toString();
        }
}

function pixelCollision() {
    for(var i = 0; i < objectToMove_snake.length; i++)
        for(var j = 0; j < FIXED_OBJECT_CN_DSTR.length; j++)
            if(objectToMove_snake[i].x == FIXED_OBJECT_CN_DSTR[j].x && objectToMove_snake[i].y == FIXED_OBJECT_CN_DSTR[j].y){
                FIXED_OBJECT_CN_DSTR[j].destroy();
                resultVar++;
                textValue_0580.text = resultVar.toString();
            }
}

function selfColision() {
    var head = objectToMove_snake[objectToMove_snake.length - 1];
    for(var i = 0; i < objectToMove_snake.length - 1; i++)
        if(head.x == objectToMove_snake[i].x && head.y == objectToMove_snake[i].y)
            game.state.start('FinalState');
}

function wallCollision() {
    // if(CAN_OVER){
        var head = objectToMove_snake[objectToMove_snake.length - 1];
        if(head.x >= 30*20 || head.x < 0 || head.y >= 22*20 || head.y < 0)
            game.state.start('FinalState');
    // }
}
//EVENTS_FUNCTIONS