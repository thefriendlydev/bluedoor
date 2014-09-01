# RogersHometownHockeyTheme

This theme has been designed and coded by [Online Clarity](http://onlineclarity.ca) to use for [Bluedoor Inc](http://bluedoorinc.com) main website.

### Requirements

* **PHP 5.4** or greater
* **MySQL 5.0** or greater
* The **mod_rewrite** Apache module
* A recent version of **WordPress**
* A writable .htaccess file in your root WordPress folder

### Installation (Developers)

* `cd /wordpress/wp-content`
* `git clone git@github.com:twg/rogers-hth-theme.git`
* Required plugins have been included in the repo

### Development

We've done our best to setup an efficient workflow using [Gulp.js](http://gulpjs.com/) and [Bower](http://bower.io/). You'll need to have `npm` installed before getting started. Development requires an understanding of the following commands:

* `npm install` - Install development dependencies
* `gulp watch` - Starts the Grunt task that builds css and js. Also has a livereload server running
* `gulp vendor-js vendor-css` - Concats and minifies Bower dependencies into a single `plugin.min.js` file. These dependencies are declared in the `Gulpfile.js`. To add a new plugin we recommend installing it with Bower and then declaring it in the gulp file.