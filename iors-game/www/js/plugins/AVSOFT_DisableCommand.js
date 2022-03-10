//=============================================================================
 /*:
 * @plugindesc Allows you to hide command from the Window Menu
 * @author Avsoft Studio
 * 
 * @param Save Enable
 * @type boolean
 * @on YES
 * @off NO
 * @desc Do you wish to keep the save command?
 * NO - false     YES - true
 * @default false
 * 
 * @param Formation Enable
 * @type boolean
 * @on YES
 * @off NO
 * @desc Do you wish to keep the formation command?
 * NO - false   YES - true
 * @default false
 * 
 * @param GameEnd Enable
 * @type boolean
 * @on YES
 * @off NO
 * @desc Do you wish to keep the GameEnd command?
 * NO - false   YES - true
 * @default false
 * 
 * @param GameEnd Command Name
 * @type string
 * @desc Name of the return title command if you delete GameEnd command
 * @default GameEnd
 *  
 * @help
 * ==========================================================================
 * ============================How to use it ?===============================
 * ==========================================================================
 * Just put this plugin into your game project and that's all !
 * You have the access to the plugin.
 * 
 * This plugin is compatible with any other type of plugin that you will have
 * in your game project.
 * However, try to put it at the beginning of the plugin's list in order to
 * avoid conflict
 * 
 * Warning : 
 * If for a reason or another thing, there are conflicts between this
 * plugin and other plugins that you use in you game project. Please contact
 * us via the different possible way with all the information that can be
 * useful (Name of the plugins, etc...)
 * We will try to correct these conflicts as soon as possible if we can.
 * ==========================================================================
 * =================================Changelog================================
 * ==========================================================================
 * Version 1.00 :
 *  - Finished plugin
 */

var Avsoft = Avsoft || {};
Avsoft.Param = Avsoft.Param || {};
Avsoft.LINK = Avsoft.LINK || {};
Avsoft.LINK.version = 1.00;

Avsoft.Parameters = PluginManager.parameters('AVSOFT_DisableCommand');
Avsoft.Param.saveEnable = String(Avsoft.Parameters['Save Enable']);
Avsoft.Param.formationEnable =  String(Avsoft.Parameters['Formation Enable']);
Avsoft.Param.gameEndEnable =  String(Avsoft.Parameters['GameEnd Enable']);
Avsoft.Param.nameGameEndCommand = String(Avsoft.Parameters['GameEnd Command Name']);

console.log(Avsoft.Param.saveEnable);

Window_MenuCommand.prototype.makeCommandList = function() {
    this.addMainCommands();
    if(Avsoft.Param.formationEnable === 'true'){ this.addFormationCommand(); }
    this.addOriginalCommands();
    this.addOptionsCommand();
    if(Avsoft.Param.saveEnable === 'true'){ this.addSaveCommand(); }
    if(Avsoft.Param.gameEndEnable === 'true'){ 
        this.addGameEndCommand(); 
    } else {
        this.addReturnTitleCommand();
    }
};

Window_MenuCommand.prototype.addReturnTitleCommand = function(){
    var enabled = this.isGameEndEnabled();
    this.addCommand(Avsoft.Param.nameGameEndCommand, 'gameEnd', enabled);
}

Avsoft.LINK.Scene_Menu_CreateCommandWindow = Scene_Menu.prototype.createCommandWindow;
Scene_Menu.prototype.createCommandWindow = function() {
    Avsoft.LINK.Scene_Menu_CreateCommandWindow.call(this);
    this._commandWindow.setHandler('gameEnd', this.returnTitleCommand.bind(this));
}

Scene_Menu.prototype.returnTitleCommand = function() {
    this.fadeOutAll();
    SceneManager.goto(Scene_Title);
}