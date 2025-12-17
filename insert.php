<?php
if (isset($_POST["add_students"])) {
	include "conn.php";

	$f_name = $_POST["f_name"];
	$l_name = $_POST["l_name"];
	$age = $_POST["age"];

	if ($f_name == "" || empty($f_name)) {
		header("location:index.php?msg=First name is required");
	} else {
		$query = "INSERT INTO `students` (`first_name`, `last_name`, `age`) VALUES ('$f_name', '$l_name', '$age')";

		$result = mysqli_query($connection, $query);

		if (!$result) {
			die("Query failed".mysqli_error($connection));
		} else {
			header("location:index.php?insert_msg=Added successfully");
		}
	}

	/* $query = "INSERT INTO `students` (`first_name`, `last_name`, `age`) VALUES ('$f_name', '$l_name', '$age')";
	$result = mysqli_query($connection, $query);

	if (!$result) {
		die("Query failed: " . mysqli_error($connection));
	} else {
		header("Location: index.php");
		exit();
	} */
}
?>