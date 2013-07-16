<?php

	// -----------------------------------------------------
	// Anything in our setup.ini file?
	// - - -
	// Assumes a `setup.ini` file lives next to this script
	// -----------------------------------------------------
	$setupIniFile = "setup.ini";
	$ini = file_exists( $setupIniFile ) ? parse_ini_file( $setupIniFile ) : array();

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

	function opt_val( $opts, $short, $long, $default="" ) {
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

  # Plugin Namespace
	$shortOptions .= "s::";
	$longOptions[] = "namespace::";

  # Plugin URI
	$shortOptions .= "p::";
	$longOptions[] = "puri::";

  # Plugin Version
	$shortOptions .= "v::";
	$longOptions[] = "version::";

  # Author Name
	$shortOptions .= "a::";
	$longOptions[] = "author::";
   
  # Author URI
	$shortOptions .= "u::";
	$longOptions[] = "auri::";

	# Now parse the actual input
	$opts = getopt( $shortOptions, $longOptions );

	// -----------------------------------------------------
	// Initialize some variables
	// -----------------------------------------------------
	$errors = array();
	$dir = __DIR__;
	$base = basename( __DIR__ );

	$name = opt_val( $opts, "n", "name", $base );
  $ns = opt_val( $opts, "s", "namespace", "tpl" );
  $puri = opt_val( $opts, "p", "puri", "http://myplugin.com" );
  $version = opt_val( $opts, "v", "version", "0.0.1" );
  $author_name = opt_val( $opts, "a", "author" );
  $author_uri = opt_val( $opts, "u", "auri", "http://mysite.com" );

	// -----------------------------------------------------
	// Prompt the user for anything we need but don't have
	// -----------------------------------------------------

	# Make sure we're using the right plugin name
	if( $name === $base ) {
		prompt( "What would you like to name your plugin? ($name)" );
		$name = readln( $name );
	}

  prompt( "What would you like to use as an internal namespace (i.e. class prefix) for your plugin? ($ns)" );
  $ns = readln( $ns );

  prompt( "What will be the uri this plugin? ($puri)" );
  $puri = readln( $puri );

  prompt( "What should be in the initial plugin version? ($version)" );
  $version = readln( $version );

  prompt( "What is the author's name? (that's you)" );
  $author_name = readln( "" );

  prompt( "What is the author's uri? ($author_uri)" );
  $author_uri = readln( $author_uri );

	// -----------------------------------------------------
	// Get final confirmation before running the init routines
	// -----------------------------------------------------
	section( "Final Confirmation" );
	writeln( "Plugin will be named: $name" );
  writeln( "Using internal namespaces: $ns" );
  writeln( "Plugin uri: $puri" );
  writeln( "Plugin version: $version" );
  writeln( "Author's name: $author_name" );
  writeln( "Author's uri: $author_uri" );
	prompt( "OK to proceed with setup? (Y/n)" );
	$input = readln( "Y" );
	if( $input !== "y" && $input !== "Y" ) {
		writeln( "Setup canceled." );
		exit;
  }

	// -----------------------------------------------------
	// We've got the green light... lets do this!
	// -----------------------------------------------------
  writeln( "Aite, let's do this." );
		
	// -----------------------------------------------------
	// Run templating
	// -----------------------------------------------------
	if( empty( $errors ) ): // START: templating

		# [implement]
		# Mustache style templating on our plugin files
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
