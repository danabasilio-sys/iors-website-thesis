//=============================================================================
// OpheliaEnigma_DeveloperLink.js
//=============================================================================

/*:
 * @plugindesc Allows the user to link to a specific URL or email
 * at the title screen or during the game.
 *
 * @author OpheliaEnigma
 *
 * @param Title Command Text
 * @desc Text for the new title command option.
 * @default Contact Developer
 *
 * @param Add to Title Screen
 * @desc true to add the new title command option
 * false to not add it.
 * @default true
 *
 * @param Link
 * @desc URL or email address for the new title
 * command option to link to.
 * @default https://opheliaenigma.itch.io/
 * @help
 *
 * Allows the user to link to a specific URL or email at the title screen or
 * during the game. It can be used to link to the developer's site, contact
 * email or the game's page.
 *
 *                      USAGE EXAMPLE:
 *                      --------------
 *
 * This plugin is quite simple. The parameters of the plugin can be set to
 * add a new command option to the title screen below the Options command.
 * On the parameters you can set the text for the command (first parameter)
 * and the link to send the player when he selects the new command (third
 * parameter). Note the second parameter can be set to true or false if you
 * wish to add the command to the title screen or not.
 *
 * The link to send the player can be normal url such as:
 *
 * https://opheliaenigma.itch.io/
 *
 * or an email link that will prompt the machine's default email system
 * and automatically prepare an email to send (it works on any computer
 * and mobiles). An example of a link to an email is:
 *
 * mailto:OpheliaEnigmaUltimateCodergmail.com
 * 
 *
 *                      SCRIPT CALL:
 *                      ------------
 *
 * Either you set the command option on the title screen or not, you can
 * use a script call to link to any link you wish during any moment of the
 * game. The script call is as follows:
 *
 * OpheliaEnigma.DeveloperLink.linkTo("https://opheliaenigma.itch.io/");
 * 
 *                      COPYRIGHT NOTICE:
 *                      -----------------
 *
 * This plugin is free to be used for non-commercial projects, however, for
 * usage on commercial projects please visit https://opheliaenigma.itch.io/
 * and donate the amount specified for this plugin. Any doubt don't hesitate
 * to contact me, OpheliaEnigma, either through the specified link or my
 * email address: OpheliaEnigmaUltimateCoder [at] gmail.com
 */


//=============================================================================
// OpheliaEnigma_DeveloperLink Code
//=============================================================================
var OpheliaEnigma = OpheliaEnigma || {};
OpheliaEnigma.DeveloperLink = (function(){

	// get plugin parameters
	params = PluginManager.parameters('OpheliaEnigma_DeveloperLink');

	var _showCommand = JSON.parse(params["Add to Title Screen"]);
	var _linkText    = params["Link"];
	var _commandText = params["Title Command Text"];
	
	//=============================================================================
	// Scene_Title
	//=============================================================================
	var _STCW = Scene_Title.prototype.createCommandWindow;
	
	Scene_Title.prototype.createCommandWindow = function() {
		_STCW.call(this);
		this._commandWindow.setHandler('DeveloperLink',
	                               linkToTitleMenu.bind(this));
		this.addWindow(this._commandWindow);
	}
	
	//=============================================================================
	// Window_TitleCommand
	//=============================================================================
	var _WTCMC = Window_TitleCommand.prototype.makeCommandList;
	
	Window_TitleCommand.prototype.makeCommandList = function() {
		_WTCMC.call(this);
		if (_showCommand) {
			this.addCommand(_commandText, 'DeveloperLink');
		}
	}
	
	//=============================================================================
	// Public Functions
	//=============================================================================
	var linkTo = function(linkText){
		window.open(linkText);
	}
	
	//=============================================================================
	// Private Functions
	//=============================================================================
	var linkToTitleMenu = function(){
		linkTo(_linkText);
		this.createCommandWindow();
	}
	
	// functions to be exported
	return {
		linkTo : linkTo
	};

})();
