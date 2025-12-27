<?php
	// go to http://localhost/phpmyadmin to view the database

	// define 4 constants
	// https://www.php.net/manual/en/language.constants.php
	define("HOSTNAME", "localhost");
	define("USERNAME", "root");
	define("PASSWORD", "");
	define("DATABASE", "crud_application001");

	// call this function with the defined constants to establish a connection
	// to the MySQL server and select the specified database
	// https://stackoverflow.com/questions/15707696/new-mysqli-vs-mysqli-connect
	$connection = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE);

	// check if connection failed
	// this won't be reached if connection succeeds
	if (!$connection)
		// https://www.php.net/manual/en/function.exit.php
		die("Connection failed: " . mysqli_connect_error());
?>