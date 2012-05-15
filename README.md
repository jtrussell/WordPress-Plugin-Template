WordPress Plugin Template
=========================

Meant to be a starting point for WordPress plugins with an emphasis on modular design.

Features
--------
* All files in the ./lib folder are included by the main plugin script
* All reusable, or standardizable, code should live in ./lib
* The stock version of this template contains a ./lib folder with a number of
	php libaries that will be useful for many scripts, this is actually just a
	submodule which you can add to your other plugins using
~~~
git submodule add git://github.com/jtrussell/WordPress-Plugin-Script-Library.git lib
~~~

* Try to avoid bloating your main plugin script with function declarations
* Library files - or classes with all static methods - should be prefixed with "lib-"
* Proper class files should be prefixed with "class-"
* Other php files in the "./lib" folder will not be automatically included

Getting your plugin ready
-------------------------
Eventually there will be a configurable deploy script, but for now...

* Do a global find/replace on "template_" for "your_plugin_slug_"
* Update _deploy/readme.txt and move it to the root directory
* Delete the _deploy folder
* Update the static attributes at the top of lib/lib-wp.php to match your namespacing preferences
