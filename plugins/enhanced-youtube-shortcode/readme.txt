=== Enhanced YouTube Shortcode ===
Contributors: Le-Pixel-Solitaire
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=erick%40pixel%2dsolitaire%2ecom&lc=CA&item_name=Le%20Pixel%20Solitaire&currency_code=CAD&bn=PP%2dDonationsBF%3abtn_donate_SM%2egif%3aNonHosted
Tags: youtube, video, player, shortcode, custom, link, clip
Requires at least: 3.1
Tested up to: 3.9.1
Stable tag: 2.0.1

A quick & simple way to include YouTube videos in your Wordpress posts with a neat centralized options panel to manage the player's output.


== Description ==

The "**Enhanced YouTube Shortcode**" plugin provides a quick & easy way to use a custom *YouTube&copy;* player in your posts and/or pages without having to get your hands dirty in the source codes! The main advantage over the way *Wordpress* is working this out is the possibility of changing the display of all players in one single spot instead of having to do it manually at every places it has been set. But most importantly: it's fun and good for you! (*check out the screenshot for a sample of all offered options!*)

Now with **more than 10 parameters** available through a simple configuration page (*reach it from the Settings Menu*), the code that is generated always allows scripting access and forces the use of the ActionScript 3 engine (*see **Other Notes** for limitations*). It has been initially created on a *Wordpress 3.2.1* live installation & recently tested on a *Wordpress 3.9.1* live installation with success, according to the specifications of the official [YouTube Embed Player API Parameters](http://code.google.com/intl/fr-CA/apis/youtube/player_parameters.html "YouTube Embedded Player Parameters - Google Code").

There are a couple of things on the **To Do** list (*see **Other Notes***) & the developer is back on track with this project so you can expect a major upgrade soon (*summer 2014*)!


== Installation ==

For a manual installation, follow these quick steps:

1.  Extract the **/enhanced-youtube-shortcode/** folder from the downloaded file.

2.  Upload this extracted folder & its content in your *Wordpress* plugins directory.

3.  Go to "**Plugins => Enhanced YouTube Shortcode**" to activate the plugin.

4.  Go to "**Settings => Enhanced YouTube**" to tweak the player options.

5.  Now use  **[youtube_video id="uAOLzRhKF9c"]** kind of shortcode.


== Frequently Asked Questions ==


= I just want to try your plugin: does it leaves traces everywhere? =

No, after an usual uninstall inside the admin area of Wordpress the saved values are erased from the database.

= I'm using *Internet Explorer 6* and the settings page just looks awful... =

Oh, I'm *soooo* sorry for you. *Really*. Maybe it's time for you to give up, don't you think?

= You're a french speaking bloke, *right*? So where is the translation? =

It's quite simple: I'm learning how to do it properly... The french language is on its way now: you can expect it in a near future.

= I got a specific question related to this plugin... What could I do? =

Why not posting your request in this forum:

[wordpress.org/support/forum/plugins-and-hacks](http://wordpress.org/support/forum/plugins-and-hacks "WordPress › Support » Plugins and Hacks")

...and don't forget to add in your title: **[Plugin: Enhanced YouTube Shortcode]**

= I think you're a genius & I want you to be the father of my children. =

*Well*... If you're actually a sexy blond woman with lot of money and a big car I believe we can form a real complete couple: I offer quite the opposite...


== Screenshots ==

1. **Plugin admin page** with the options panel (***top***) & the reminder about how to use the shortcode (***bottom***).


== Upgrade Notice ==

= 2.0.1 =
MINOR UPDATE: Code optimisation/preparation for next major upgrade (*v3*), slight UI revisions & updated information (*mainly for the Wordpress.org repository*). PLEASE UPGRADE.


== Changelog ==

= 2.0.1 =
* Code optimisation/preparation for next major upgrade (*v3*)
* Slight UI revisions
* Updated information (mainly for the Wordpress.org repository)

= 2.0 =
* New user interface
* New «related videos» feature
* Minor bugs fixed

= 1.9.1 =
* Minor HTML errors fixed
* Translation preparation
* Visual update

= 1.9 =
* New «infos before playing» feature
* Visual & core files dissociation
* Source code processing

= 1.8 =
* New «Theme» feature
* Code generation refinement
* Version 2.0 groundwork

= 1.7 =
* New «Autoplay» & «Force HD» features
* Options panel visual adjustments
* Minor logical improvments

= 1.6 =
* New «hide YouTube logo» feature
* Fix an «Options output» bug
* Plugin's class encapsulation
* Performance tweaks

= 1.5 =
* Initial public release.

= 1.4 =
* Bugs repair / visual modifications.

= 1.3 =
* Possibility to modify and save new player options.

= 1.2 =
* Addition of a page to display the settings & how to.

= 1.1 =
* Translation of the manual code into a plugin form.

= 1.0 =
* The core is released as a manual inclusion into the "*functions.php*" page.


== Limitations ==

* **Internet Explorer is not a natural friend of YouTube...** Every versions of this browser, *from 6 all the way up to 9*, have different bugs & even more ways to deal with YouTube videos. So in order to push a video to everyone this plugin will provide a player to Internet Explorer effectively but without other parameters than width & height. All the rest will be the default state of a "*regular*" YouTube video player. A future version should solve those issues by serving an all javascript player to this browser.
 
* The tests on *Wordpress 3.9.1* were quick, some features may be not working but this should not affect the plugin responsiveness. All bases will be covered in the next major release of the plugin (*v3*).

* Some *Wordpress* themes that already have a bunch of shortcodes may cause conflicts with this one. Usually a quick look in the doc of your theme & you'll find a way of injecting "*raw*" codes in your post without triggering any presets options.


== TO DO ==

**In the plan for the next major upgrade** (*v3*) **:**
 
*  Rewrite the core of the display functions. 

*  A simpler/quicker way of inserting the shortcode. 

*  HTML5 implementation.

**In the back of my mind...**
 
*  Develop some «height & width» presets.

*  Google Analytics integration.

*  Take over the world. 

Not necessarily in that order...


== License ==

This plugin (*and all its related files*) falls under the **[GNU GENERAL PUBLIC LICENSE v3](http://www.gnu.org/licenses/gpl-3.0.txt "GNU General Public License - Version 3")**. 