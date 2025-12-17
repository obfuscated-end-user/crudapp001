<?php
	include("header.php");
	include("con.php");

	if (isset($_GET["id"])) {
		$id = $_GET["id"];
		$query = "DELETE FROM `students` WHERE `id` = '$id'";
		$result = mysqli_query($connection, $query);

		if (!$result) {
			die("query failed".mysqli_error());
		} else {
			header("location:index.php?delete_msg=Successfully deleted record");
		}
	}
?>