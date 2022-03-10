//=======================================================================
// Social Media Buttons Plugin (RMMV v1.3) v2.0
//=======================================================================
// * The  Social Media Buttons plugin is a simple plugin to add  social
//	 media buttons  to the Title Screen.  Clicking on them opens  a new
//	 window with their respective URLs displayed.
//
//   This was inspired by Yanfly's excellent "External Links" plugin. I
//	 You can  also use  the plugin  to display a  web page  in-game  by
//	 calling a Plugin Command and the URL in an event.
//
//   This was inspired by Yanfly's excellent "External Links" plugin. I
//   integrated it into "Adventures of Tryggr", then into "Otherworld",
//   but wrote my own to trim out some of the superfluous code and make
//   it more compatible with "Otherworld"'s menu.
//
//	 So based on that same principle, I decided to add a separate block
//	 on the Title Screen to contain  "Otherworld"'s Twitter account and
//	 official  blogsite,  as well as  RPG  Maker  Times Facebook  page,
//	 rather than putting them in the main menu, to declutter it. I then
//	 adapted it for more general use.
//
//	 The  plugin only  has 5 social media  buttons (Twitter,  Facebook,
//	 YouTube, Pinterest and Website) displayed on the Title Screen, but
//   more may be added over time.  You have a choice on whether to open
//   the links in a separate game window or in your default browser.
//
//       * © 2016-2020, Companion Wulf
//
//========================================================================
// CW_SocialMediaButtons.js
//========================================================================

/*:
 @plugindesc Add social media buttons to the Title Screen.
 @author Companion Wulf

 @param Show Twitter
 @desc Toggles Twitter button ON/OFF.
 @default ON

 @param Twitter Action
 @desc The action/behaviour type of the Twitter button (Screen Name, User ID or Follow).
 @default Screen Name

 @param Twitter ID
 @desc Your Twitter Username or User ID.
 @default CompanionWulf

 @param ----------------------------------------------------------

 @param Show Facebook
 @desc Toggles Facebook button ON/OFF.
 @default ON

 @param Facebook Page Name
 @desc The name of your project's Facebook page.
 @default RPGMakerTimes

 @param ----------------------------------------------------------

 @param Show YouTube
 @desc Toggles YouTube button ON/OFF.
 @default ON

 @param YouTube Action
 @desc The action/behaviour type of the YouTube button (User, Channel, Custom URL, Video or Playlist).
 @default User

 @param YouTube Ref
 @desc Your YouTube Username, Channel ID, Custom URL, Video ID or Playlst ID.
 @default Ferewulf

 @param ----------------------------------------------------------

 @param Show Pinterest
 @desc Toggles Pinterest button ON/OFF.
 @default ON

 @param Pinterest Username
 @desc Your username at Pinterest.
 @default CompanionWulf

 @param Pinterest Action
 @desc The action/behaviour type of the Pinterest button (User, Board Name or Search).
 @default User

 @param Pinterest Ref
 @desc Your Pinterest Board Name or a search term.
 @default rpg-maker

 @param ----------------------------------------------------------

 @param Show Website
 @desc Toggles Website button ON/OFF.
 @default ON

 @param Website URL
 @desc The URL to show your website.
 @default http://blog.rpgmakertimes.info

 @param ----------------------------------------------------------

 @param Display Method
 @desc Choose to display in a Window or Browser
 @default Window

 @param ----------------------------------------------------------

 @param Icons
 @desc The list of icons to use for the social media buttons.
 @default Twitter, Facebook, YouTube, Pinterest, Website

 @help
 The "Social Media Buttons" plugin  has five options: Twitter, Facebook,
 Pinterest, YouTube  and Website. The icons are dynamically  centered at
 the bottom of the Title Screen. Corresponding links will open in either
 a window or a browser.

 I've tried to make this Help  section as comprehensive as possible, but
 a video tutorial is also available here:

    https://youtu.be/4wEEafk3gRE

 (The video is for v1.6, so it's out-of-date.  I'll upload a new updated
 version some time later.)

 NOTE: If  playing in  a browser, the URL might not  open if you  have a
 popup blocker,  so make sure you make an exception for the  site you're
 playing on. In Windows versions,  a new window will open to display the
 website.


 ==============================================================
  * TWITTER *
 ==============================================================
 These are the settings for sharing Twitter accounts via your games.

 --------------------------------------------------------------
  Show Twitter
 --------------------------------------------------------------
 This setting turns the Twitter button ON or OFF (you can also use
 TRUE/FALSE or YES/NO).

 --------------------------------------------------------------
  Twitter Action
 --------------------------------------------------------------
 You can use one of three options: Screen Name, User ID or Follow.

 Screen Name - The user name of the Twitter account you'd like players
    to visit.

 User ID - The unique identifier of the Twitter account.

    To find your User ID, go to https://tweeterid.com/ and enter the Twitter
    "handle" to find the User ID number (or vice versa).

    Alternatively, log into your Twitter account and go into "Settings", then
    under "Your Twitter Data", your User ID is right under your Username. (You
    will need to reenter your password to access this area.)

 Follow - Enables players to follow your Twitter account directly from within
    RPG Maker MV, whether in a window or browser. As long as the "Twitter ID"
    section is set correctly, this will automatically use the Screen Name or
    User ID.

 --------------------------------------------------------------
  Twitter ID
 --------------------------------------------------------------
 This sets the Username or User ID for the Twitter account you wish to use.
 It's used in conjunction with the "Twitter Action" setting.

 For example, my Twitter handle is @CompanionWulf, so I'd set Twitter Action
 to "Screen Name" and this setting to "CompanionWulf". This will then display
 my "RPG Maker Times" account there.

 Bear in mind, however, that Usernames change often, so either you can update
 this setting. A better option would be to use the User ID, as it's unique to
 each account whatever the Username may be.

 ==============================================================
  * FACEBOOK *
 ==============================================================
 These are the settings for sharing a Facebook page from within RMMV.

 --------------------------------------------------------------
  Show Facebook
 --------------------------------------------------------------
 Show (ON) or hide (OFF) the Facebook button on the Title Screen (you can
 also use TRUE/FALSE or YES/NO).

 --------------------------------------------------------------
  Facebook Page Name
 --------------------------------------------------------------
 This is the page name reference to display your Facebook page.

 For example, my Facebook page link is:

    https://www.facebook.com/RPGMakerTimes/

 so I'd put "RPGMakerTimes" here, and then clicking on the button will go
 to my "RPG Maker Times & Projects" page.

 ==============================================================
  * YOUTUBE *
 ==============================================================
 These options are to display sharing something from YouTube.

 --------------------------------------------------------------
  Show YouTube
 --------------------------------------------------------------
 Show (ON/YES/TRUE) or hide (OFF/NO/FALSE) the YouTube button on the Title
 Screen.

 --------------------------------------------------------------
  YouTube Action
 --------------------------------------------------------------
 This is the behaviour type for the YouTube button. The available options
 are: User, Channel, Custom URL, Video or Playlist.

 --------------------------------------------------------------
  YouTube Ref
 --------------------------------------------------------------
 This provides the information for the "YouTube Action" setting. You don't
 need the full URL, just the identifying information.

 Username - The username you use for your main YouTube profile.

    Mine is "ferewulf". When you type

      https://www.youtube.com/ferewulf

    My YouTube profile loads, displaying all of the videos I've created.

 Channel ID - The ID reference of your video channel.

    When you click on "My Channel" at YouTube, the channel page with all its
    videos will load. The part of the URL we're interested in for this section
    contains upper and lower case letters and numbers.

 Custom URL - YouTube allows a custom URL (also sometimes referred to as a
    Vanity URL).

    To find your custom URL, click on your account Settings, then on "Channel
    status and features" and you should see your Custom URL there. (If you
    haven't set one up yet, you should be able to from here too.)

    For example, mine is "CompanionWulf", so that's what I'd use.

 Video ID - The ID for the video you want to play in the window or browser.

    This is the part of the URL with upper/lower case letters and numbers. You
    can either obtain it with "Share" or from the main URL after "watch?v=".

 Playlist ID - The ID of the playlist you'd like to feature.

    When you put videos into playlists, each one has a rather long and unique
    identifier comprising upper/lower case letters and numbers. It's the part
    after "playlist?list=" (minus any other parameters).

 ==============================================================
  * PINTEREST *
 ==============================================================
 These are the settings for sharing your Pinterest account.

 --------------------------------------------------------------
  Show Pinterest
 --------------------------------------------------------------
 Show (ON/YES/TRUE) or hide (OFF/NO/FALSE) the Pinterest button on the
 Title Screen.

 --------------------------------------------------------------
  Pinterest Username
 --------------------------------------------------------------
 This is your username at Pinterest. This will take visitors to your default
 profile page containing all your pins and boards.

 --------------------------------------------------------------
  Pinterest Action
 --------------------------------------------------------------
 This is the behavior type to display the Pinterest links. The options are:
 User, Board Name or Search.

 --------------------------------------------------------------
  Pinterest Ref
 --------------------------------------------------------------
 This is where you provide reference information for the "Pinterest Action"
 parameter.

 User - Your username at Pinterest.

    This should be set in the "Pinterest Username" parameter.

 Pinterest Ref - The extra information required for "Pinterest Action",

    Board Name - If you want to share a specific board, set the "Pinterest
      Action" parameter to "Board Name" and in this section put the name of
      the board from the last part of its URL.

      Make sure the "Pinterest Username" parameter is set properly for this
      to work. Or leaving this blank will display your normal profile.

      Note: Visitors will most likely need to log into Pinterest to view some
      of the pins, depending on your settings there.

    Search - This is the search term or keywords you want to display.

      You can type in full search terms, including spaces. Pinterest will then
      search for all keywords you type in.

 ==============================================================
  * WEBSITE *
 ==============================================================
 These options set the website URL you'd like visitors to go to when they click
 the button.

 --------------------------------------------------------------
  Show Website
 --------------------------------------------------------------
 This turns the Website icon ON or OFF (or YES/NO or TRUE/FALSE).

 --------------------------------------------------------------
  Website URL
 --------------------------------------------------------------
 This is for setting your full website address. When the button
 is clicked, it'll open in a window or browser depending on your settings in
 the "Display Method" parameter.

 ==============================================================
  * DISPLAY METHOD *
 ==============================================================
 This selects how to display the "Website URL". Options are: Window or Browser.

 Window - Displays the website in a separate window through RMMV.

 Browser - Opens the link in your default browser instead of a window.

 ==============================================================
  * ICONS *
 ==============================================================
 These are the icons you want to use for your social media buttons, separated
 by commas (in order): Twitter, Facebook, Pinterest, YouTube and Website.

 The recommended size is 32x32.

 Save these in the "Pictures" folder. If you use your own icons, be sure to
 change the settings here to match the filenames you use. (There's no need
 to add extensions.)

 ==============================================================
  * TERMS & CONDITIONS OF USE *
 ==============================================================
 This plugin is free to use under CC BY-NC 4.0, but please refer to
 the RPG Maker Times blogsite for other details, including for
 commercial use.

 Credit "Companion Wulf" or "RPG Maker Times" if using this plugin
 in your projects.

	For all Terms of Use, visit: https://gnometreasure.com/terms-of-use
*/

var SMButtons = SMButtons || {}, SMB = SMButtons;

/**
 ═════════════════════════════════════
  SOCIAL MEDIA BUTTONS - MAIN CORE
 ═════════════════════════════════════
**/

(function($, undefined) {

	/**
	 ═════════════════════════════════════
	  VARIABLES: INTERNAL USE ONLY
	 ═════════════════════════════════════
	**/
	$.SocialMediaButtons = {
		Version: 	1.7,
		Build: 		13.11,
		Copyright: 	'© 2016-2020, Companion Wulf',
		MVBuild: 	1.6,
		Error: 		['Social Media Button Plugin Error', 'You have RPG Maker MV version '+Utils.RPGMAKER_VERSION+'.<br><br>You appear to have an older version, so the Social Media Button plugin may be incompatible and errors may occur. Please update your copy of RMMV before using this plugin.']
	};


	/**
	 ═════════════════════════════════════
	  FUNCTION: PRINT ERROR
	 ═════════════════════════════════════
	**/
	$.printError = function(e1, e2) { Graphics.printError(e1, e2); };


	/**
	 ═════════════════════════════════════
	  FUNCTION: TO BOOLEAN
	 ═════════════════════════════════════
	**/
	$.toBoolean = function(string) {
		switch(string.toLowerCase()) {
			case 'true': case 'on': case 'yes': return true; break;
			case 'false': case 'off': case 'no': return false; break;
			default: return false; break;
		}
	};


	/**
	 ═════════════════════════════════════
	  FUNCTION: TO ARRAY
	 ═════════════════════════════════════
	**/
	$.toArray = function(string) { return string.split(/\s*,\s*/).filter(function(idx) { return idx; }); };


	/**
	 ═════════════════════════════════════
	  FUNCTION: OPEN URL
	 ═════════════════════════════════════
	**/
	$.openUrl = function(uri, method) {
		method = method || 'Window';
		switch(method.toUpperCase()) {
			case 'WINDOW': var urlWin = window.open(uri); break;
			case 'BROWSER': var gui = require('nw.gui'); gui.Shell.openExternal(uri); break;
			default: var urlWin = window.open(uri); break;
		}
	};

	/**
	 ═════════════════════════════════════
	  STRING FUNCTION: IS USER ID?
	 ═════════════════════════════════════
	**/
	$.isUserId = function(txt) { if (txt.match(/^[0-9]+$/)) { return true } else { return false}; };

  $.popup = function(str) { alert(str); };

	$.bWidth = 0;


	/**
	 ═════════════════════════════════════
	  PLUGIN MANAGER
	 ═════════════════════════════════════
	**/
	(function($) {
		SMB.Params = $.parameters('CW_SocialMediaButtons');
    // * TWITTER
		SMB.twitterToggle = SMButtons.toBoolean(SMB.Params['Show Twitter'] || 'ON');
		SMB.twitterIntent = String(SMB.Params['Twitter Action'] || 'Screen Name');
		SMB.twitterIntentSettings = String(SMB.Params['Twitter ID'] || 'Twitter');
    // * FACEBOOK
    SMB.facebookToggle = SMButtons.toBoolean(SMB.Params['Show Facebook'] || 'ON');
    SMB.facebookPage= String(SMB.Params['Facebook Page Name'] || 'RPGMakerTimes');
    // * YOUTUBE
    SMB.youtubeToggle = SMButtons.toBoolean(SMB.Params['Show YouTube'] || 'ON');
    SMB.youtubeAction = String(SMB.Params['YouTube Action'] || 'User');
    SMB.youtubeID = String(SMB.Params['YouTube Ref'] || 'Ferewulf');
    // * PINTEREST
    SMB.pinterestToggle = SMButtons.toBoolean(SMB.Params['Show Pinterest'] || 'ON');
    SMB.pinterestUsername = String(SMB.Params['Pinterest Username'] || 'CompanionWulf');
    SMB.pinterestAction = String(SMB.Params['Pinterest Action'] || 'User');
    SMB.pinterestID = String(SMB.Params['Pinterest Ref'] || 'CompanionWulf');
    // * WEBSITE
    SMB.websiteToggle = SMButtons.toBoolean(SMB.Params['Show Website'] || 'ON');
    SMB.websiteUrl = String(SMB.Params['Website URL'] || 'http://blog.rpgmakertimes.info');

		SMB.showIcons = SMButtons.toArray(SMB.Params['Icons']);
	})(PluginManager);


	/**
	 ═════════════════════════════════════
	  SCENE BOOT
	 ═════════════════════════════════════
	**/
	(function($) {
		SMB.CW_alias__Scene_Boot_start = $.prototype.start;
		$.prototype.start = function() {
			(Utils.RPGMAKER_VERSION < SMB.SocialMediaButtons.MVBuild.toString()) ? SMButtons.printError(SMB.SocialMediaButtons.Error[0], SMB.SocialMediaButtons.Error[1]) : SMB.CW_alias__Scene_Boot_start.call(this);
		};
	})(Scene_Boot);



	/**
	 ═════════════════════════════════════
	  SCENE TITLE
	 ═════════════════════════════════════
	**/
	(function($) {
    SMB.CW_alias__Scene_Title_create = $.prototype.create;
    $.prototype.create = function() {
      SMB.CW_alias__Scene_Title_create.call(this);
      this.createButtons();
    };

    $.prototype.createButtons = function() {
      this._twitterButton = new Sprite_Button(), this._twitterButton.bitmap = ImageManager.loadPicture(SMB.showIcons[0]);
      this._facebookButton = new Sprite_Button(), this._facebookButton.bitmap = ImageManager.loadPicture(SMB.showIcons[1]);
      this._youtubeButton = new Sprite_Button(), this._youtubeButton.bitmap = ImageManager.loadPicture(SMB.showIcons[2]);
      this._pinterestButton = new Sprite_Button(), this._pinterestButton.bitmap = ImageManager.loadPicture(SMB.showIcons[3]);
      this._websiteButton = new Sprite_Button(), this._websiteButton.bitmap = ImageManager.loadPicture(SMB.showIcons[4]);

      if (SMB.twitterToggle) this.addChild(this._twitterButton);
      if (SMB.facebookToggle) this.addChild(this._facebookButton);
      if (SMB.youtubeToggle) this.addChild(this._youtubeButton);
      if (SMB.pinterestToggle) this.addChild(this._pinterestButton);
        if (SMB.websiteToggle) this.addChild(this._websiteButton);

      this._twitterButton.setClickHandler(this.visitTwitter.bind(this));
      this._facebookButton.setClickHandler(this.visitFacebook.bind(this));
      this._youtubeButton.setClickHandler(this.visitYouTube.bind(this));
      this._pinterestButton.setClickHandler(this.visitPinterest.bind(this));
      this._websiteButton.setClickHandler(this.visitWebsite.bind(this));

      this.positionBlock((Graphics.width / 2.5) - SMB.bWidth, 570);
    };

    $.prototype.positionBlock = function(x, y) {
      if (SMB.twitterToggle) this._twitterButton.x = x += 34, this._twitterButton.y = y, SMB.bWidth += 34;
      if (SMB.facebookToggle) this._facebookButton.x = x += 34, this._facebookButton.y = y, SMB.bWidth += 34;
      if (SMB.youtubeToggle) this._youtubeButton.x = x += 34, this._youtubeButton.y = y, SMB.bWidth += 34;
      if (SMB.pinterestToggle) this._pinterestButton.x = x += 34, this._pinterestButton.y = y, SMB.bWidth += 34;
      if (SMB.websiteToggle) this._websiteButton.x = x += 34, this._websiteButton.y = y, SMB.bWidth += 34;
    };

    $.prototype.visitTwitter = function() {
      switch (SMB.twitterIntent.toLowerCase()) {
        case 'screen name': var text = 'user?screen_name='; break;
        case 'user id': var text = (SMButtons.isUserId(SMB.twitterIntentSettings) ? 'user?user_id=' : SMButtons.popup('User ID is not valid.')); break;
        case 'follow': SMB.isUserId(SMB.twitterIntentSettings) ? txt = 'user_id=' : txt = 'screen_name='; text = 'follow?' + txt; break;
        default: var text = 'user?screen_name='; break;
      }
      SMB.openUrl('https://twitter.com/intent/' + text + SMB.twitterIntentSettings, SMB.displayMethod) ;
    };

    $.prototype.visitFacebook = function() {
      SMB.openUrl('https://facebook.com/' + SMB.facebookPage, SMB.displayMethod);
    };

    $.prototype.visitYouTube = function() {
      switch (SMB.youtubeAction.toLowerCase()) {
        case 'user': var text = 'user/'; break;
        case 'channel': var text = 'channel/'; break;
        case 'custom url': var text = 'c/'; break;
        case 'video': var text = 'watch?v='; break;
        case 'playlist': var text = 'playlist?list='; break;
      }
      SMB.openUrl('https://www.youtube.com/' + text + SMB.youtubeID, SMB.displayMethod);
    };

    $.prototype.visitPinterest = function() {
      switch (SMB.pinterestAction.toLowerCase()) {
        case 'user': var text = SMB.pinterestUsername; break;
        case 'board name': var text = SMB.pinterestUsername + '/' + SMB.pinterestAccount; break;
        case 'search': var text = 'search/pins/?q=' + SMB.pinterestID; break;
      }
      SMB.openUrl('https://pinterest.com/' + text);
    };

    $.prototype.visitWebsite = function() {
      SMB.openUrl(SMB.websiteUrl, SMB.displayMethod);
    };
  })(Scene_Title);


})(SMButtons || {});
