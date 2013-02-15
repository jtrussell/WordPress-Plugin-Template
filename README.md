# WordPress Plugin Template
Meant to be a starting point for WordPress plugins with an emphasis on modular design.

## Features
* All files in the ./lib folder are included by the main plugin script
* All reusable, or standardizable, code should live in ./lib

* Try to avoid bloating your main plugin script with function declarations
* Library files - or classes with all static methods - should be prefixed with "lib-"
* Proper class files should be prefixed with "class-"
* Other php files in the "./lib" folder will not be automatically included

## Getting your plugin ready
To get your module ready for prime time run the setup.php script from the
command line.

```php
php setup.php
```

This script will handle fetching the most up to date library files and class
names and display items are appropriate to your plugin's name. **WARNING** if
you do not run the setup script your plugin probably won't work.

By default scripts are fetched form the
[WordPress-Plugin-Script-Library](https://raw.github.com/jtrussell/WordPress-Plugin-Script-Library/master/)
repo.

### Options
You can configure the `setup.php` routine by making use of the following options:
* `-n`/`--name`: The name of your plugin (you will be prompted to confirm this
	option if you do not specify a value explicitly. e.g. `-n=awesome`.
* `-l`/`--library`: Where to save your library scripts, defaults to "./lib".
* `--downloadLibBranch`: The branch to pull on the script library repo, defaults
	to "master".
