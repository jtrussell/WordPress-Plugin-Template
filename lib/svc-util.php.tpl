<?php
/**
 * Various utility functions
 */
class {{plugin_ns}}_util
{

	// -----------------------------------------------------
	// Redirect to a given url
	// * If headers are already sent tries to use js and
	// 	 provides a link to the target page
	// -----------------------------------------------------
	public static function redirect($url) {
		if(!headers_sent() && false) {
			header("Location: {$url}");
		} else {
			if(strpos($url, "http") === false) {
				$url = site_url($url);
			}
			// JS to perform redirect
			$redirect_markup = "<script type='text/javascript'>\n";
			$redirect_markup .= "window.top.location.href = '{$url}';\n";
			$redirect_markup .= "</script>\n";
			// Style to make sure our redirect link shows up on dark themes
			$redirect_markup .= "<style type='text/css'>\n";
			$redirect_markup .= "body { background: #FFFFFF; }";
			$redirect_markup .= "</style>";
			// Fail safe redirect link
			$redirect_markup .= "<p>Please click <a href='{$url}'>here</a> if your browser does not redirect you.";
			echo $redirect_markup;
		}
		exit();
	}

	// -----------------------------------------------------
	// Returns the url requested by the user
	// -----------------------------------------------------
	public static function requested_url() {
		$url = $_SERVER["REQUEST_URI"];
		$url = site_url($url);
		return $url;
	}

	// -----------------------------------------------------
	// Parses a query string into an array
	// -----------------------------------------------------
	public static function parse_query_string($query_string) {
		assert('is_string($query_string)');
		$res = array();
		foreach(explode('&', $query_string) as $param) {
			$param = explode('=', $param);
			$name = urldecode($param[0]);
			if(count($param) === 1) {
				$value = '';
			} else {
				$value = urldecode($param[1]);
			}
			$res[$name] = $value;
		}
		return $res;
	}

	// -----------------------------------------------------
	// Given a url an array of key=>value pairs, returns an updated
	// url with the key=>pairs added (or updated) as query parameters
	// -----------------------------------------------------
	public static function add_url_parameter($url, $parameter) {
		assert('is_array($parameter)');
		$queryStart = strpos($url, '?');
		if($queryStart === FALSE) {
			$oldQuery = array();
			$url .= '?';
		} else {
			$oldQuery = substr($url, $queryStart + 1);
			if($oldQuery === FALSE) {
				$oldQuery = array();
			} else {
				$oldQuery = self::parseQueryString($oldQuery);
			}
			$url = substr($url, 0, $queryStart + 1);
		}
		$query = array_merge($oldQuery, $parameter);
		$url .= http_build_query($query, '', '&');
		return $url;
	}

}

// -----------------------------------------------------
// Closing PHP tag omitted
// -----------------------------------------------------
