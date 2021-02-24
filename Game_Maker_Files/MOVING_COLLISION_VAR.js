var resultVar = 0;

var updateDelay = 0;
var new_direction = null;
var direction = 'right';
var addNew = false;
var canMove = true;
var FIXED_OBJECT_CNT_DSTR = [];
var FIXED_OBJECT_CN_DSTR = [];
//DEF_RAND
function MOVING() {

	//GAME_KEYS
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
//DEF_FIXED_OBJECT_CNT_DSTR
//DEF_FIXED_OBJECT_CN_DSTR
var first = OBJECT_TO_MOVE_GROUP[OBJECT_TO_MOVE_GROUP.length - 1];

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

        var firstCell = OBJECT_TO_MOVE_GROUP[OBJECT_TO_MOVE_GROUP.length - 1],
            lastCell = OBJECT_TO_MOVE_GROUP.shift(),
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

        OBJECT_TO_MOVE_GROUP.push(lastCell);
        firstCell = lastCell;


        if(addNew){
            OBJECT_TO_MOVE_GROUP.unshift(game.add.sprite(oldLastCellx, oldLastCelly, 'OBJECT_TO_MOVE_CLONE'));
            OBJECT_TO_MOVE_GROUP[0].scale.setTo(0.3125, 0.3125);
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
    for(var i = 0; i < OBJECT_TO_MOVE_GROUP.length; i++)
        if(OBJECT_TO_MOVE_GROUP[i].x == COLLISIED_PIXEL.x && OBJECT_TO_MOVE_GROUP[i].y == COLLISIED_PIXEL.y){
            addNew = true;
            COLLISIED_PIXEL.destroy();
            RANDOM_POSITION();
            resultVar++;
            RESULT_PIXEL.text = resultVar.toString();
        }
}

function pixelCollision() {
    for(var i = 0; i < OBJECT_TO_MOVE_GROUP.length; i++)
        for(var j = 0; j < FIXED_OBJECT_CN_DSTR.length; j++)
            if(OBJECT_TO_MOVE_GROUP[i].x == FIXED_OBJECT_CN_DSTR[j].x && OBJECT_TO_MOVE_GROUP[i].y == FIXED_OBJECT_CN_DSTR[j].y){
                FIXED_OBJECT_CN_DSTR[j].destroy();
                resultVar++;
                RESULT_PIXEL.text = resultVar.toString();
            }
}

function selfColision() {
    var head = OBJECT_TO_MOVE_GROUP[OBJECT_TO_MOVE_GROUP.length - 1];
    for(var i = 0; i < OBJECT_TO_MOVE_GROUP.length - 1; i++)
        if(head.x == OBJECT_TO_MOVE_GROUP[i].x && head.y == OBJECT_TO_MOVE_GROUP[i].y)
            game.state.start('FinalState');
}

function wallCollision() {
    // if(CAN_OVER){
        var head = OBJECT_TO_MOVE_GROUP[OBJECT_TO_MOVE_GROUP.length - 1];
        if(head.x >= GAME_WIDTH*20 || head.x < 0 || head.y >= GAME_HIEGHT*20 || head.y < 0)
            game.state.start('FinalState');
    // }
}