var cursors;








var objectToMove_wall;


var objectToMove_wall;
var objectToMove_dot;


var objectToMove_wall;
var objectToMove_dot;


var objectToMove_wall;
var objectToMove_dot;


var objectToMove_wall;
var objectToMove_dot;


var objectToMove_wall;
var objectToMove_dot;


var objectToMove_wall;
var objectToMove_dot;


var objectToMove_wall;
var objectToMove_dot;


var objectToMove_wall;
var objectToMove_dot;


var objectToMove_wall;
var objectToMove_dot;


var objectToMove_wall;
var objectToMove_dot;


var objectToMove_wall;
var objectToMove_dot;


var objectToMove_wall;
var objectToMove_dot;


var objectToMove_wall;
var objectToMove_dot;


var objectToMove_wall;
var objectToMove_dot;


var objectToMove_wall;
var objectToMove_dot;


var objectToMove_wall;
var objectToMove_dot;


var objectToMove_wall;
var objectToMove_dot;


var objectToMove_wall;
var objectToMove_dot;


var objectToMove_wall;
var objectToMove_dot;


var objectToMove_wall;
var objectToMove_dot;
//GLOBAL_MOVING_GROUP_CODE
var dotSprite_100260;

var objectToMove_wall;
var objectToMove_dot;
var objectToMove_pac_man;
//GLOBAL_MOVING_GROUP_CODE

var StartGame = {

    preload : function() {
//PRELOAD

//BCKGRND
	
//BCKGRND


//PAINTS

	game.load.image("wall", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/wall.png");
	game.load.image("wall", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/wall.png");
	game.load.image("wall", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/wall.png");
	game.load.image("wall", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/wall.png");
	game.load.image("wall", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/wall.png");
	game.load.image("wall", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/wall.png");
	game.load.image("wall", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/wall.png");
	game.load.image("wall", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/wall.png");
	game.load.image("wall", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/wall.png");
	game.load.image("wall", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/wall.png");
	game.load.image("wall", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/wall.png");
	game.load.image("wall", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/wall.png");
	game.load.image("wall", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/wall.png");
	game.load.image("wall", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/wall.png");
	game.load.image("wall", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/wall.png");
	game.load.image("wall", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/wall.png");
	game.load.image("wall", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/wall.png");
	game.load.image("wall", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/wall.png");
	game.load.image("wall", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/wall.png");
	game.load.image("wall", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/wall.png");
	game.load.image("wall", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/wall.png");
	game.load.image("wall", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/wall.png");
	game.load.image("wall", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/wall.png");
	game.load.image("wall", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/wall.png");
	game.load.image("wall", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/wall.png");
	game.load.image("wall", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/wall.png");
	game.load.image("wall", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/wall.png");
	game.load.image("wall", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/wall.png");
	game.load.image("wall", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/wall.png");
	game.load.image("wall", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/wall.png");
	game.load.image("wall", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/wall.png");
	game.load.image("wall", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/wall.png");
	game.load.image("wall", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/wall.png");
	game.load.image("wall", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/wall.png");
	game.load.image("wall", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/wall.png");
	game.load.image("wall", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/wall.png");
	game.load.image("wall", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/wall.png");
	game.load.image("wall", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/wall.png");
	game.load.image("wall", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/wall.png");
	game.load.image("wall", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/wall.png");
	game.load.image("wall", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/wall.png");
	game.load.image("wall", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/wall.png");
	game.load.image("wall", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/wall.png");
	game.load.image("wall", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/wall.png");
	game.load.image("wall", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/wall.png");
	game.load.image("wall", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/wall.png");
	game.load.image("wall", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/wall.png");
	game.load.image("wall", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/wall.png");
	game.load.image("wall", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/wall.png");
	game.load.image("wall", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/wall.png");
	game.load.image("wall", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/wall.png");
	game.load.image("wall", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/wall.png");
	game.load.image("wall", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/wall.png");
	game.load.image("wall", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/wall.png");
	game.load.image("wall", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/wall.png");
	game.load.image("wall", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/wall.png");
	game.load.image("wall", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/wall.png");
	game.load.image("wall", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/wall.png");
	game.load.image("wall", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/wall.png");
	game.load.image("wall", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/wall.png");
	game.load.image("wall", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/wall.png");
	game.load.image("wall", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/wall.png");
	game.load.image("wall", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/wall.png");
	game.load.image("wall", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/wall.png");
	game.load.image("wall", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/wall.png");
	game.load.image("wall", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/wall.png");
	game.load.image("wall", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/wall.png");
	game.load.image("wall", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/wall.png");
	game.load.image("wall", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/wall.png");
	game.load.image("wall", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/wall.png");
	game.load.image("wall", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/wall.png");
	game.load.image("wall", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/wall.png");
	game.load.image("wall", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/wall.png");
	game.load.image("wall", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/wall.png");
	game.load.image("wall", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/wall.png");
	game.load.image("wall", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/wall.png");
	game.load.image("wall", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/wall.png");
	game.load.image("wall", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/wall.png");
	game.load.image("wall", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/wall.png");
	game.load.image("wall", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/wall.png");
	game.load.image("wall", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/wall.png");
	game.load.image("wall", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/wall.png");
	game.load.image("wall", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/wall.png");
	game.load.image("wall", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/wall.png");
	game.load.image("wall", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/wall.png");
	game.load.image("wall", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/wall.png");
	game.load.image("wall", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/wall.png");
	game.load.image("wall", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/wall.png");
	game.load.image("wall", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/wall.png");
	game.load.image("wall", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/wall.png");
	game.load.image("wall", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/wall.png");
	game.load.image("wall", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/wall.png");
	game.load.image("wall", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/wall.png");
	game.load.image("wall", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/wall.png");
	game.load.image("wall", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/wall.png");
	game.load.image("wall", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/wall.png");
	game.load.image("wall", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/wall.png");
	game.load.image("wall", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/wall.png");
	game.load.image("wall", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/wall.png");
	game.load.image("wall", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/wall.png");
	game.load.image("wall", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/wall.png");
	game.load.image("wall", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/wall.png");
	game.load.image("wall", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/wall.png");
	game.load.image("wall", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/wall.png");
	game.load.image("wall", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/wall.png");
	game.load.image("wall", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/wall.png");
	game.load.image("wall", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/wall.png");
	game.load.image("wall", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/wall.png");
	game.load.image("wall", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/wall.png");
	game.load.image("wall", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/wall.png");
	game.load.image("wall", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/wall.png");
	game.load.image("wall", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/wall.png");
	game.load.image("wall", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/wall.png");
	game.load.image("wall", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/wall.png");
	game.load.image("wall", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/wall.png");
	game.load.image("wall", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/wall.png");
	game.load.image("wall", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/wall.png");
	game.load.image("dot", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/dot.png");
	game.load.image("dot", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/dot.png");
	game.load.image("dot", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/dot.png");
	game.load.image("dot", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/dot.png");
	game.load.image("dot", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/dot.png");
	game.load.image("dot", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/dot.png");
	game.load.image("dot", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/dot.png");
	game.load.image("dot", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/dot.png");
	game.load.image("dot", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/dot.png");
	game.load.image("dot", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/dot.png");
	game.load.image("dot", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/dot.png");
	game.load.image("dot", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/dot.png");
	game.load.image("dot", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/dot.png");
	game.load.image("dot", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/dot.png");
	game.load.image("dot", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/dot.png");
	game.load.image("dot", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/dot.png");
	game.load.image("dot", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/dot.png");
	game.load.image("dot", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/dot.png");
	game.load.image("dot", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/dot.png");
	game.load.image("dot", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/dot.png");
	game.load.image("pac_man", "/games_repositories/MJ1995/Games/pac_man_2D_1.0/assets/img/pac_man.png");
//PAINTS


//PRELOAD
    },

    create: function () {

	// Set up a Phaser controller for keyboard input.
    cursors = game.input.keyboard.createCursorKeys();
        
//CREATE

//STBCKGRND
	game.stage.backgroundColor = '#e06666';
//STBCKGRND



//PIXELS

	 wallSprite_0580 = game.add.sprite(580,0,"wall");
	wallSprite_0580.scale.setTo(0.3125, 0.3125);
	 wallSprite_0560 = game.add.sprite(560,0,"wall");
	wallSprite_0560.scale.setTo(0.3125, 0.3125);
	 wallSprite_0540 = game.add.sprite(540,0,"wall");
	wallSprite_0540.scale.setTo(0.3125, 0.3125);
	 wallSprite_0520 = game.add.sprite(520,0,"wall");
	wallSprite_0520.scale.setTo(0.3125, 0.3125);
	 wallSprite_0500 = game.add.sprite(500,0,"wall");
	wallSprite_0500.scale.setTo(0.3125, 0.3125);
	 wallSprite_0480 = game.add.sprite(480,0,"wall");
	wallSprite_0480.scale.setTo(0.3125, 0.3125);
	 wallSprite_0460 = game.add.sprite(460,0,"wall");
	wallSprite_0460.scale.setTo(0.3125, 0.3125);
	 wallSprite_0440 = game.add.sprite(440,0,"wall");
	wallSprite_0440.scale.setTo(0.3125, 0.3125);
	 wallSprite_0420 = game.add.sprite(420,0,"wall");
	wallSprite_0420.scale.setTo(0.3125, 0.3125);
	 wallSprite_0400 = game.add.sprite(400,0,"wall");
	wallSprite_0400.scale.setTo(0.3125, 0.3125);
	 wallSprite_0380 = game.add.sprite(380,0,"wall");
	wallSprite_0380.scale.setTo(0.3125, 0.3125);
	 wallSprite_0360 = game.add.sprite(360,0,"wall");
	wallSprite_0360.scale.setTo(0.3125, 0.3125);
	 wallSprite_0340 = game.add.sprite(340,0,"wall");
	wallSprite_0340.scale.setTo(0.3125, 0.3125);
	 wallSprite_0320 = game.add.sprite(320,0,"wall");
	wallSprite_0320.scale.setTo(0.3125, 0.3125);
	 wallSprite_0300 = game.add.sprite(300,0,"wall");
	wallSprite_0300.scale.setTo(0.3125, 0.3125);
	 wallSprite_0280 = game.add.sprite(280,0,"wall");
	wallSprite_0280.scale.setTo(0.3125, 0.3125);
	 wallSprite_0260 = game.add.sprite(260,0,"wall");
	wallSprite_0260.scale.setTo(0.3125, 0.3125);
	 wallSprite_0240 = game.add.sprite(240,0,"wall");
	wallSprite_0240.scale.setTo(0.3125, 0.3125);
	 wallSprite_0220 = game.add.sprite(220,0,"wall");
	wallSprite_0220.scale.setTo(0.3125, 0.3125);
	 wallSprite_0200 = game.add.sprite(200,0,"wall");
	wallSprite_0200.scale.setTo(0.3125, 0.3125);
	 wallSprite_0180 = game.add.sprite(180,0,"wall");
	wallSprite_0180.scale.setTo(0.3125, 0.3125);
	 wallSprite_0160 = game.add.sprite(160,0,"wall");
	wallSprite_0160.scale.setTo(0.3125, 0.3125);
	 wallSprite_0140 = game.add.sprite(140,0,"wall");
	wallSprite_0140.scale.setTo(0.3125, 0.3125);
	 wallSprite_0120 = game.add.sprite(120,0,"wall");
	wallSprite_0120.scale.setTo(0.3125, 0.3125);
	 wallSprite_0100 = game.add.sprite(100,0,"wall");
	wallSprite_0100.scale.setTo(0.3125, 0.3125);
	 wallSprite_080 = game.add.sprite(80,0,"wall");
	wallSprite_080.scale.setTo(0.3125, 0.3125);
	 wallSprite_060 = game.add.sprite(60,0,"wall");
	wallSprite_060.scale.setTo(0.3125, 0.3125);
	 wallSprite_040 = game.add.sprite(40,0,"wall");
	wallSprite_040.scale.setTo(0.3125, 0.3125);
	 wallSprite_020 = game.add.sprite(20,0,"wall");
	wallSprite_020.scale.setTo(0.3125, 0.3125);
	 wallSprite_00 = game.add.sprite(0,0,"wall");
	wallSprite_00.scale.setTo(0.3125, 0.3125);
	 wallSprite_20580 = game.add.sprite(580,20,"wall");
	wallSprite_20580.scale.setTo(0.3125, 0.3125);
	 wallSprite_40580 = game.add.sprite(580,40,"wall");
	wallSprite_40580.scale.setTo(0.3125, 0.3125);
	 wallSprite_60580 = game.add.sprite(580,60,"wall");
	wallSprite_60580.scale.setTo(0.3125, 0.3125);
	 wallSprite_80580 = game.add.sprite(580,80,"wall");
	wallSprite_80580.scale.setTo(0.3125, 0.3125);
	 wallSprite_100580 = game.add.sprite(580,100,"wall");
	wallSprite_100580.scale.setTo(0.3125, 0.3125);
	 wallSprite_120580 = game.add.sprite(580,120,"wall");
	wallSprite_120580.scale.setTo(0.3125, 0.3125);
	 wallSprite_140580 = game.add.sprite(580,140,"wall");
	wallSprite_140580.scale.setTo(0.3125, 0.3125);
	 wallSprite_160580 = game.add.sprite(580,160,"wall");
	wallSprite_160580.scale.setTo(0.3125, 0.3125);
	 wallSprite_180580 = game.add.sprite(580,180,"wall");
	wallSprite_180580.scale.setTo(0.3125, 0.3125);
	 wallSprite_200580 = game.add.sprite(580,200,"wall");
	wallSprite_200580.scale.setTo(0.3125, 0.3125);
	 wallSprite_220580 = game.add.sprite(580,220,"wall");
	wallSprite_220580.scale.setTo(0.3125, 0.3125);
	 wallSprite_240580 = game.add.sprite(580,240,"wall");
	wallSprite_240580.scale.setTo(0.3125, 0.3125);
	 wallSprite_260580 = game.add.sprite(580,260,"wall");
	wallSprite_260580.scale.setTo(0.3125, 0.3125);
	 wallSprite_280580 = game.add.sprite(580,280,"wall");
	wallSprite_280580.scale.setTo(0.3125, 0.3125);
	 wallSprite_300580 = game.add.sprite(580,300,"wall");
	wallSprite_300580.scale.setTo(0.3125, 0.3125);
	 wallSprite_320580 = game.add.sprite(580,320,"wall");
	wallSprite_320580.scale.setTo(0.3125, 0.3125);
	 wallSprite_340580 = game.add.sprite(580,340,"wall");
	wallSprite_340580.scale.setTo(0.3125, 0.3125);
	 wallSprite_360580 = game.add.sprite(580,360,"wall");
	wallSprite_360580.scale.setTo(0.3125, 0.3125);
	 wallSprite_380580 = game.add.sprite(580,380,"wall");
	wallSprite_380580.scale.setTo(0.3125, 0.3125);
	 wallSprite_400580 = game.add.sprite(580,400,"wall");
	wallSprite_400580.scale.setTo(0.3125, 0.3125);
	 wallSprite_420580 = game.add.sprite(580,420,"wall");
	wallSprite_420580.scale.setTo(0.3125, 0.3125);
	 wallSprite_420560 = game.add.sprite(560,420,"wall");
	wallSprite_420560.scale.setTo(0.3125, 0.3125);
	 wallSprite_420540 = game.add.sprite(540,420,"wall");
	wallSprite_420540.scale.setTo(0.3125, 0.3125);
	 wallSprite_420520 = game.add.sprite(520,420,"wall");
	wallSprite_420520.scale.setTo(0.3125, 0.3125);
	 wallSprite_420500 = game.add.sprite(500,420,"wall");
	wallSprite_420500.scale.setTo(0.3125, 0.3125);
	 wallSprite_420480 = game.add.sprite(480,420,"wall");
	wallSprite_420480.scale.setTo(0.3125, 0.3125);
	 wallSprite_420460 = game.add.sprite(460,420,"wall");
	wallSprite_420460.scale.setTo(0.3125, 0.3125);
	 wallSprite_420440 = game.add.sprite(440,420,"wall");
	wallSprite_420440.scale.setTo(0.3125, 0.3125);
	 wallSprite_420420 = game.add.sprite(420,420,"wall");
	wallSprite_420420.scale.setTo(0.3125, 0.3125);
	 wallSprite_420400 = game.add.sprite(400,420,"wall");
	wallSprite_420400.scale.setTo(0.3125, 0.3125);
	 wallSprite_420380 = game.add.sprite(380,420,"wall");
	wallSprite_420380.scale.setTo(0.3125, 0.3125);
	 wallSprite_420360 = game.add.sprite(360,420,"wall");
	wallSprite_420360.scale.setTo(0.3125, 0.3125);
	 wallSprite_420340 = game.add.sprite(340,420,"wall");
	wallSprite_420340.scale.setTo(0.3125, 0.3125);
	 wallSprite_420320 = game.add.sprite(320,420,"wall");
	wallSprite_420320.scale.setTo(0.3125, 0.3125);
	 wallSprite_420300 = game.add.sprite(300,420,"wall");
	wallSprite_420300.scale.setTo(0.3125, 0.3125);
	 wallSprite_420280 = game.add.sprite(280,420,"wall");
	wallSprite_420280.scale.setTo(0.3125, 0.3125);
	 wallSprite_420260 = game.add.sprite(260,420,"wall");
	wallSprite_420260.scale.setTo(0.3125, 0.3125);
	 wallSprite_420240 = game.add.sprite(240,420,"wall");
	wallSprite_420240.scale.setTo(0.3125, 0.3125);
	 wallSprite_420220 = game.add.sprite(220,420,"wall");
	wallSprite_420220.scale.setTo(0.3125, 0.3125);
	 wallSprite_420200 = game.add.sprite(200,420,"wall");
	wallSprite_420200.scale.setTo(0.3125, 0.3125);
	 wallSprite_420180 = game.add.sprite(180,420,"wall");
	wallSprite_420180.scale.setTo(0.3125, 0.3125);
	 wallSprite_420160 = game.add.sprite(160,420,"wall");
	wallSprite_420160.scale.setTo(0.3125, 0.3125);
	 wallSprite_420140 = game.add.sprite(140,420,"wall");
	wallSprite_420140.scale.setTo(0.3125, 0.3125);
	 wallSprite_420120 = game.add.sprite(120,420,"wall");
	wallSprite_420120.scale.setTo(0.3125, 0.3125);
	 wallSprite_420100 = game.add.sprite(100,420,"wall");
	wallSprite_420100.scale.setTo(0.3125, 0.3125);
	 wallSprite_42080 = game.add.sprite(80,420,"wall");
	wallSprite_42080.scale.setTo(0.3125, 0.3125);
	 wallSprite_42060 = game.add.sprite(60,420,"wall");
	wallSprite_42060.scale.setTo(0.3125, 0.3125);
	 wallSprite_42040 = game.add.sprite(40,420,"wall");
	wallSprite_42040.scale.setTo(0.3125, 0.3125);
	 wallSprite_42020 = game.add.sprite(20,420,"wall");
	wallSprite_42020.scale.setTo(0.3125, 0.3125);
	 wallSprite_4200 = game.add.sprite(0,420,"wall");
	wallSprite_4200.scale.setTo(0.3125, 0.3125);
	 wallSprite_4000 = game.add.sprite(0,400,"wall");
	wallSprite_4000.scale.setTo(0.3125, 0.3125);
	 wallSprite_3800 = game.add.sprite(0,380,"wall");
	wallSprite_3800.scale.setTo(0.3125, 0.3125);
	 wallSprite_3600 = game.add.sprite(0,360,"wall");
	wallSprite_3600.scale.setTo(0.3125, 0.3125);
	 wallSprite_3400 = game.add.sprite(0,340,"wall");
	wallSprite_3400.scale.setTo(0.3125, 0.3125);
	 wallSprite_3200 = game.add.sprite(0,320,"wall");
	wallSprite_3200.scale.setTo(0.3125, 0.3125);
	 wallSprite_3000 = game.add.sprite(0,300,"wall");
	wallSprite_3000.scale.setTo(0.3125, 0.3125);
	 wallSprite_200 = game.add.sprite(0,20,"wall");
	wallSprite_200.scale.setTo(0.3125, 0.3125);
	 wallSprite_400 = game.add.sprite(0,40,"wall");
	wallSprite_400.scale.setTo(0.3125, 0.3125);
	 wallSprite_600 = game.add.sprite(0,60,"wall");
	wallSprite_600.scale.setTo(0.3125, 0.3125);
	 wallSprite_800 = game.add.sprite(0,80,"wall");
	wallSprite_800.scale.setTo(0.3125, 0.3125);
	 wallSprite_1000 = game.add.sprite(0,100,"wall");
	wallSprite_1000.scale.setTo(0.3125, 0.3125);
	 wallSprite_1200 = game.add.sprite(0,120,"wall");
	wallSprite_1200.scale.setTo(0.3125, 0.3125);
	 wallSprite_1400 = game.add.sprite(0,140,"wall");
	wallSprite_1400.scale.setTo(0.3125, 0.3125);
	 wallSprite_1600 = game.add.sprite(0,160,"wall");
	wallSprite_1600.scale.setTo(0.3125, 0.3125);
	 wallSprite_1800 = game.add.sprite(0,180,"wall");
	wallSprite_1800.scale.setTo(0.3125, 0.3125);
	 wallSprite_2000 = game.add.sprite(0,200,"wall");
	wallSprite_2000.scale.setTo(0.3125, 0.3125);
	 wallSprite_2200 = game.add.sprite(0,220,"wall");
	wallSprite_2200.scale.setTo(0.3125, 0.3125);
	 wallSprite_2400 = game.add.sprite(0,240,"wall");
	wallSprite_2400.scale.setTo(0.3125, 0.3125);
	 wallSprite_2600 = game.add.sprite(0,260,"wall");
	wallSprite_2600.scale.setTo(0.3125, 0.3125);
	 wallSprite_2800 = game.add.sprite(0,280,"wall");
	wallSprite_2800.scale.setTo(0.3125, 0.3125);
	 wallSprite_120280 = game.add.sprite(280,120,"wall");
	wallSprite_120280.scale.setTo(0.3125, 0.3125);
	 wallSprite_140280 = game.add.sprite(280,140,"wall");
	wallSprite_140280.scale.setTo(0.3125, 0.3125);
	 wallSprite_160280 = game.add.sprite(280,160,"wall");
	wallSprite_160280.scale.setTo(0.3125, 0.3125);
	 wallSprite_180280 = game.add.sprite(280,180,"wall");
	wallSprite_180280.scale.setTo(0.3125, 0.3125);
	 wallSprite_200280 = game.add.sprite(280,200,"wall");
	wallSprite_200280.scale.setTo(0.3125, 0.3125);
	 wallSprite_220280 = game.add.sprite(280,220,"wall");
	wallSprite_220280.scale.setTo(0.3125, 0.3125);
	 wallSprite_240280 = game.add.sprite(280,240,"wall");
	wallSprite_240280.scale.setTo(0.3125, 0.3125);
	 wallSprite_180300 = game.add.sprite(300,180,"wall");
	wallSprite_180300.scale.setTo(0.3125, 0.3125);
	 wallSprite_180260 = game.add.sprite(260,180,"wall");
	wallSprite_180260.scale.setTo(0.3125, 0.3125);
	 wallSprite_180320 = game.add.sprite(320,180,"wall");
	wallSprite_180320.scale.setTo(0.3125, 0.3125);
	 wallSprite_180240 = game.add.sprite(240,180,"wall");
	wallSprite_180240.scale.setTo(0.3125, 0.3125);
	 wallSprite_180340 = game.add.sprite(340,180,"wall");
	wallSprite_180340.scale.setTo(0.3125, 0.3125);
	 wallSprite_180220 = game.add.sprite(220,180,"wall");
	wallSprite_180220.scale.setTo(0.3125, 0.3125);
	 wallSprite_180360 = game.add.sprite(360,180,"wall");
	wallSprite_180360.scale.setTo(0.3125, 0.3125);
	 wallSprite_100280 = game.add.sprite(280,100,"wall");
	wallSprite_100280.scale.setTo(0.3125, 0.3125);
	 wallSprite_180200 = game.add.sprite(200,180,"wall");
	wallSprite_180200.scale.setTo(0.3125, 0.3125);
	 wallSprite_260280 = game.add.sprite(280,260,"wall");
	wallSprite_260280.scale.setTo(0.3125, 0.3125);
	 dotSprite_160200 = game.add.sprite(200,160,"dot");
	dotSprite_160200.scale.setTo(0.3125, 0.3125);
	 dotSprite_160220 = game.add.sprite(220,160,"dot");
	dotSprite_160220.scale.setTo(0.3125, 0.3125);
	 dotSprite_160240 = game.add.sprite(240,160,"dot");
	dotSprite_160240.scale.setTo(0.3125, 0.3125);
	 dotSprite_160260 = game.add.sprite(260,160,"dot");
	dotSprite_160260.scale.setTo(0.3125, 0.3125);
	 dotSprite_140260 = game.add.sprite(260,140,"dot");
	dotSprite_140260.scale.setTo(0.3125, 0.3125);
	 dotSprite_120260 = game.add.sprite(260,120,"dot");
	dotSprite_120260.scale.setTo(0.3125, 0.3125);
	 dotSprite_100260 = game.add.sprite(260,100,"dot");
	dotSprite_100260.scale.setTo(0.3125, 0.3125);
	 dotSprite_200300 = game.add.sprite(300,200,"dot");
	dotSprite_200300.scale.setTo(0.3125, 0.3125);
	 dotSprite_200320 = game.add.sprite(320,200,"dot");
	dotSprite_200320.scale.setTo(0.3125, 0.3125);
	 dotSprite_220300 = game.add.sprite(300,220,"dot");
	dotSprite_220300.scale.setTo(0.3125, 0.3125);
	 dotSprite_200340 = game.add.sprite(340,200,"dot");
	dotSprite_200340.scale.setTo(0.3125, 0.3125);
	 dotSprite_240300 = game.add.sprite(300,240,"dot");
	dotSprite_240300.scale.setTo(0.3125, 0.3125);
	 dotSprite_200360 = game.add.sprite(360,200,"dot");
	dotSprite_200360.scale.setTo(0.3125, 0.3125);
	 dotSprite_260300 = game.add.sprite(300,260,"dot");
	dotSprite_260300.scale.setTo(0.3125, 0.3125);
	 dotSprite_80500 = game.add.sprite(500,80,"dot");
	dotSprite_80500.scale.setTo(0.3125, 0.3125);
	 dotSprite_100500 = game.add.sprite(500,100,"dot");
	dotSprite_100500.scale.setTo(0.3125, 0.3125);
	 dotSprite_120500 = game.add.sprite(500,120,"dot");
	dotSprite_120500.scale.setTo(0.3125, 0.3125);
	 dotSprite_34080 = game.add.sprite(80,340,"dot");
	dotSprite_34080.scale.setTo(0.3125, 0.3125);
	 dotSprite_32080 = game.add.sprite(80,320,"dot");
	dotSprite_32080.scale.setTo(0.3125, 0.3125);
	 dotSprite_30080 = game.add.sprite(80,300,"dot");
	dotSprite_30080.scale.setTo(0.3125, 0.3125);
	 pac_manSprite_8080 = game.add.sprite(80,80,"pac_man");
	pac_manSprite_8080.scale.setTo(0.3125, 0.3125);
//PIXELS



//F_CALL_EVENTS

objectToMove_pac_man = [pac_manSprite_8080];
//F_CALL_EVENTS


//CREATE
    },

    update: function () {
//UPDATE

//F_CALL_UPDATE_FUNC

moving_8080();
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

var updateDelay = 0;
var new_direction = null;
var direction = 'right';
var addNew = false;
var canMove = true;
var FIXED_OBJECT_CNT_DSTR = [];
var FIXED_OBJECT_CN_DSTR = [];
var moveRandomly = false;
function moving_8080() {

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
FIXED_OBJECT_CNT_DSTR = [wallSprite_420240,wallSprite_420560,wallSprite_420580,wallSprite_420140,wallSprite_4200,wallSprite_42020,wallSprite_42040,wallSprite_42060,wallSprite_42080,wallSprite_420100,wallSprite_420120,wallSprite_420160,wallSprite_420180,wallSprite_420200,wallSprite_420540,wallSprite_420520,wallSprite_420420,wallSprite_420220,wallSprite_420400,wallSprite_420380,wallSprite_420360,wallSprite_420340,wallSprite_420320,wallSprite_420300,wallSprite_420280,wallSprite_420260,wallSprite_420440,wallSprite_420460,wallSprite_420500,wallSprite_420480,wallSprite_400580,wallSprite_4000,wallSprite_3800,wallSprite_380580,wallSprite_360580,wallSprite_3600,wallSprite_340580,wallSprite_3400,wallSprite_3200,wallSprite_320580,wallSprite_300580,wallSprite_3000,wallSprite_2800,wallSprite_280580,wallSprite_2600,wallSprite_260580,wallSprite_260280,wallSprite_240280,wallSprite_2400,wallSprite_240580,wallSprite_220580,wallSprite_2200,wallSprite_220280,wallSprite_200580,wallSprite_200280,wallSprite_2000,wallSprite_180580,wallSprite_180360,wallSprite_180220,wallSprite_180340,wallSprite_180240,wallSprite_180320,wallSprite_180260,wallSprite_180300,wallSprite_1800,wallSprite_180280,wallSprite_180200,wallSprite_1600,wallSprite_160280,wallSprite_160580,wallSprite_140280,wallSprite_1400,wallSprite_140580,wallSprite_120280,wallSprite_1200,wallSprite_120580,wallSprite_1000,wallSprite_100580,wallSprite_100280,wallSprite_80580,wallSprite_800,wallSprite_60580,wallSprite_600,wallSprite_40580,wallSprite_400,wallSprite_200,wallSprite_20580,wallSprite_0160,wallSprite_0360,wallSprite_00,wallSprite_0400,wallSprite_0420,wallSprite_0440,wallSprite_0460,wallSprite_0480,wallSprite_0500,wallSprite_0520,wallSprite_0540,wallSprite_0560,wallSprite_0580,wallSprite_0300,wallSprite_020,wallSprite_040,wallSprite_0140,wallSprite_0180,wallSprite_0120,wallSprite_0100,wallSprite_080,wallSprite_060,wallSprite_0200,wallSprite_0220,wallSprite_0240,wallSprite_0260,wallSprite_0280,wallSprite_0320,wallSprite_0340,wallSprite_0380];
FIXED_OBJECT_CN_DSTR = [dotSprite_34080,dotSprite_32080,dotSprite_30080,dotSprite_260300,dotSprite_240300,dotSprite_220300,dotSprite_200360,dotSprite_200340,dotSprite_200320,dotSprite_200300,dotSprite_160220,dotSprite_160240,dotSprite_160200,dotSprite_160260,dotSprite_140260,dotSprite_120500,dotSprite_120260,dotSprite_100500,dotSprite_100260,dotSprite_80500];
var first = objectToMove_pac_man[objectToMove_pac_man.length - 1];
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

        var firstCell = objectToMove_pac_man[objectToMove_pac_man.length - 1],
            lastCell = objectToMove_pac_man.shift(),
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

        objectToMove_pac_man.push(lastCell);
        firstCell = lastCell;


        if(addNew){
            objectToMove_pac_man.unshift(game.add.sprite(oldLastCellx, oldLastCelly, 'pac_man'));
            objectToMove_pac_man[0].scale.setTo(0.3125, 0.3125);
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
    for(var i = 0; i < objectToMove_pac_man.length; i++)
        if(objectToMove_pac_man[i].x == dotSprite_100260.x && objectToMove_pac_man[i].y == dotSprite_100260.y){
            addNew = true;
            dotSprite_100260.destroy();
            randomPosition_100260();
            // VAR_INC();
        }
}

function pixelCollision() {
    for(var i = 0; i < objectToMove_pac_man.length; i++)
        for(var j = 0; j < FIXED_OBJECT_CN_DSTR.length; j++)
            if(objectToMove_pac_man[i].x == FIXED_OBJECT_CN_DSTR[j].x && objectToMove_pac_man[i].y == FIXED_OBJECT_CN_DSTR[j].y)
                FIXED_OBJECT_CN_DSTR[j].destroy();
}

function selfColision() {
    var head = objectToMove_pac_man[objectToMove_pac_man.length - 1];
    for(var i = 0; i < objectToMove_pac_man.length - 1; i++)
        if(head.x == objectToMove_pac_man[i].x && head.y == objectToMove_pac_man[i].y)
            game.state.start('FinalState');
}

function wallCollision() {
    // if(CAN_OVER){
        var head = objectToMove_pac_man[objectToMove_pac_man.length - 1];
        if(head.x >= 30*20 || head.x < 0 || head.y >= 22*20 || head.y < 0)
            game.state.start('FinalState');
    // }
}
//EVENTS_FUNCTIONS