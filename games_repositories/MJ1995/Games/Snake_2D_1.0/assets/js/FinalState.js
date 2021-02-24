var cursors;

//GLOBAL_MOVING_GROUP_CODE

//GLOBAL_MOVING_GROUP_CODE

var FinalState = {

    preload : function() {
//PRELOAD

//BCKGRND
	game.load.image("over_snake", "/games_repositories/MJ1995/Games/Snake_2D_1.0/assets/img/over_snake.png");
//BCKGRND


//PAINTS

//PAINTS


//PRELOAD
    },

    create: function () {

	// Set up a Phaser controller for keyboard input.
    cursors = game.input.keyboard.createCursorKeys();
        
//CREATE

//STBCKGRND
	this.add.button(game.world.centerX, game.world.centerY, 'over_snake', this.nextState, this).anchor.set(0.5);
//STBCKGRND



//PIXELS

//PIXELS



//F_CALL_EVENTS

//F_CALL_EVENTS


//CREATE
    },

    update: function () {
//UPDATE

//F_CALL_UPDATE_FUNC

//F_CALL_UPDATE_FUNC

//UPDATE
    },

	nextState: function(){
//NXTSTATE
	this.state.start('Menu');
//NXTSTATE
    }

};



//EVENTS_FUNCTIONS

//EVENTS_FUNCTIONS