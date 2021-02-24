var updateDelay = 0;
var new_direction = null;
var direction = 'right';
var addNew = false;
var canMove = true;
var FIXED_OBJECT_CNT_DSTR = [];
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
var first = OBJECT_TO_MOVE_GROUP[OBJECT_TO_MOVE_GROUP.length - 1];

    if(FIXED_OBJECT_CNT_DSTR !=''){console.log(FIXED_OBJECT_CNT_DSTR[0].y)
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
            OBJECT_TO_MOVE_GROUP.unshift(game.add.sprite(oldLastCellx, oldLastCelly, 'OBJECT_TO_MOVE_GROUP'));
            addNew = false;
        }


//MOVING_CALLING_CALL

//MOVING_CALLING_CALL
    }

}