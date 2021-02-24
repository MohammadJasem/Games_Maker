
//OPTIONS
var gameOptions = {};
//OPTIONS


var gameWidth = 80;
var gameHeight = 80;
if( gameOptions.gameWidth)
 	gameWidth = gameOptions.gameWidth;
if( gameOptions.gameHeight)
	gameHeight = gameOptions.gameHeight;

var game = new Phaser.Game(gameWidth,gameHeight,Phaser.AUTO);

//GAME_STATES_ADD
game.state.add('Menu', Menu);
game.state.add('StartGame', StartGame);
game.state.add('FinalState', FinalState);
//GAME_STATES_ADD

//GAME_STATE_START
game.state.start('Menu');
//GAME_STATE_START