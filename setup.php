<?php
	
	// -----------------------------------------------------
	// We'll be doing a lot of echos + line breaks
	// -----------------------------------------------------
	function write( $msg ) {
		echo $msg;
	}

	function writeln( $msg="" ) {
		echo PHP_EOL . $msg;
	}

	function section( $title ) {
		writeln();
		writeln( $title );
		writeln( "-------------------------------" );
	}

	// -----------------------------------------------------
	// You best not be trying to run this script from your browser
	// -----------------------------------------------------
	if( !defined( "STDIN" ) ) {
		writeln( "This script must be run from the command line." );
		writeln( "Exiting now." );
		exit;
	}

	// -----------------------------------------------------
	// We may need to ask for some stuffs
	// -----------------------------------------------------
	function prompt( $msg ) {
		fwrite( STDOUT, PHP_EOL . $msg . " " );
	}

	function readln( $default="" ) {
		$val = trim( fgets( STDIN ) );
		if( strlen( $val ) > 0 ) {
			return $val;
		}
		return $default;
	}

	function optVal( $opts, $short, $long, $default="" ) {
		if( $short && isset( $opts[$short] ) ) { return $opts[$short]; }
		if( $long && isset( $opts[$long] ) ) { return $opts[$long]; }
		return $default;
	}

	// -----------------------------------------------------
	// Read in any args passed to us
	// -----------------------------------------------------
	$shortOptions = "";
	$longOptions = array();

	# Plugin Name
	$shortOptions .= "n::";
	$longOptions[] = "name::";

	# Now parse the actual input
	$opts = getopt( $shortOptions, $longOptions );

	// -----------------------------------------------------
	// Initialize some variables
	// -----------------------------------------------------
	$errors = array();
	$dir = __DIR__;
	$lib = $dir . "/lib";
	$base = basename( __DIR__ );
	$name = optVal( $opts, "n", "name", $base );
	$downloadLibs = array(
		"lib-io",
		"lib-ui",
		"lib-util",
		"lib-wp"
	);

	# Where to get library scripts from
	$downloadLibBranch = optVal( $opts, false, "downloadLibBranch", "master" );
	$downloadLibRoot = "https://raw.github.com/jtrussell/WordPress-Plugin-Script-Library/" . $downloadLibBranch;

	// -----------------------------------------------------
	// Prompt the user for anything we need but don't have
	// -----------------------------------------------------

	# Make sure we're using the right plugin name
	if( $name === $base ) {
		prompt( "What would you like to name your plugin? ($name)" );
		$name = readln( $name );
	}

	# Should we fetch our lib scripts? (probably)
	section( "Library Scripts" );
	prompt( "Should I fetch fresh copies of *all* library scripts? (Y/n)" );
	$input = readln( "Y" );
	# If not check on each script individually
	if( $input !== "Y" && $input !== "y" ) {
		$scriptsTMP = array();
		foreach( $downloadLibs as $script ) {
			prompt( "--> Should I fetch a fresh copy of $script? (Y/n)" );
			$input = readln( "Y" );
			if( $input === "Y" || $input === "y" ) {
				$scriptsTMP[] = $script;
			}
		}
		$downloadLibs = $scriptsTMP;
	}

	// -----------------------------------------------------
	// Get final confirmation before running the init routines
	// -----------------------------------------------------
	section( "Final Confirmation" );
	writeln( "Plugin will be named: $name" );
	writeln( "Fetch library scripts: " . ( empty( $downloadLibs ) ? "(none)" : implode( ", ", $downloadLibs ) ) );
	prompt( "OK to proceed with setup? (Y/n)" );
	$input = readln( "Y" );
	if( $input !== "y" && $input !== "Y" ) {
		writeln( "Setup canceled." );
		exit;
	}

	// -----------------------------------------------------
	// We've got the green light... lets do this!
	// -----------------------------------------------------

	// -----------------------------------------------------
	// Fetch library scripts - must be done before templating
	// -----------------------------------------------------
	if( empty( $errors ) ): // START: library fetching
	if( !empty( $downloadLibs ) ) {
		section( "Fetching library scripts" );
		# Create our lib directory if it doesn't exist
		if( file_exists( $lib ) ) {
			if( !is_dir( $lib ) ) {
				$errors[] = "$lib must be a directory, not a file.";
			}
		} else {
			if( !mkdir( $lib, 0777, true ) ) {
				$errors[] = "Failed to create $lib do you have sufficient privileges to create this directory?";
			}
		}
		# Download each script
		foreach( $downloadLibs as $script ) {
			writeln( "--> Fetching $script... " );
			$contents = file_get_contents( "$downloadLibRoot/$script.php" );
			if( FALSE === $contents ) {
				$errors[] = "Could not fetch library script: $script";
			} else {
				if( FALSE === file_put_contents( "$lib/$script.php", $contents ) ) {
					$errors[] = "Could not write file $lib/$script.php";
				} else {
					write( "done." );
				}
			}
		}
	}
	endif; // END: library fetching
		
	// -----------------------------------------------------
	// Run templating
	// -----------------------------------------------------
	if( empty( $errors ) ): // START: templating

		# [implement]
		# Mustache style templating on our library scripts and plugin files
		# [/implement]

	endif; // END: templating

	// -----------------------------------------------------
	// Woohoo! All done
	// -----------------------------------------------------
	section( "Done" );
	if( empty( $errors ) ) {
		writeln( "Finished without errors" );
	} else {
		foreach( $errors as $err ) {
			writeln( "ERROR: $err" );
		}
	}
