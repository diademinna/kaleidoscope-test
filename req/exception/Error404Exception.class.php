<?php
class Error404Exception extends Exception {
	function __construct(){
		header("HTTP/1.0 404 Not Found");
    echo "404. Page Not Found.";
    exit();
	}
}