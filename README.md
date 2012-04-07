WordPress Plugin Template
=========================

Meant to be a starting point for WordPress plugins with an emphasis on modular design.

Features
--------
* All files in the ./lib folder are included by the main plugin script
* All reusable, or standardizable, code should live in ./lib
* The stock version of this template contains an empty ./lib folder - it is suggested that you should include the "WordPress Plugin Script Library" as a submodule here as follows (after removing the empty ./lib folder):

	git submodule add git://github.com/jtrussell/WordPress-Plugin-Script-Library.git lib

* Try to avoid bloating your main plugin script with function declarations
* Library files - or classes with all static methods - should be prefixed with "lib-"
* Proper class files should be prefixed with "class-"

Getting your plugin ready
-------------------------
Eventually there will be a configurable deploy script, but for now...

* Do a global find/replace on "tempate_" for "your_plugin_slug_"
* Update _deploy/readme.txt and move it to the root directory
* Delete the _deploy folder
* Update the static attributes at the top of lib/lib-wp.php to match your namespacing preferences