<?php
	include("header.php");
	include("conn.php");

	// https://www.php.net/manual/en/function.isset.php
	// get student ID from URL
	// for example, `delete.php?id=5`
	if (isset($_GET["id"])) {
		// this becomes `$id = "5"`
		$id = $_GET["id"];
		// now delete a record from the database that has that ID
		// you know that this is vulnerable to injection lol fix it later
		// don't be surprised when your entire database magically disappears
		$query = "DELETE FROM `students` WHERE `id` = '$id'";
		// https://www.php.net/manual/en/mysqli.query.php
		// execute and check
		$result = mysqli_query($connection, $query);

		if (!$result)
			die("query failed" . mysqli_error());
		else
			// https://www.php.net/manual/en/function.header.php
			// redirects to index.php?delete_msg=Successfully deleted record
			// index.php shows `<h6>Successfully deleted record</h6>` at the
			// bottom
			header("location:index.php?delete_msg=Successfully deleted record");
	}
?>