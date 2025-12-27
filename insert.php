<?php
	// refer to index.php, this only runs when "Add" button is clicked
	if (isset($_POST["add_students"])) {
		// you can also include w/o parentheses, idk if this is how it should be
		// done
		include "conn.php";

		// get form data
		$f_name = $_POST["f_name"];
		$l_name = $_POST["l_name"];
		$age = $_POST["age"];

		// checks if first name is blank
		// you can do this too with last name but i'm too lazy
		if ($f_name == "" || empty($f_name))
			// redirect with error message if empty
			header("location:index.php?msg=First name is required");
		else {
			// insert into students (specify columns) with values in that order
			// SQL injection vulnerability here lol
			$query = "INSERT INTO `students` (`first_name`, `last_name`, `age`) VALUES ('$f_name', '$l_name', '$age')";

			$result = mysqli_query($connection, $query);

			if (!$result)
				die("Query failed".mysqli_error($connection));
			else
				header("location:index.php?insert_msg=Added successfully");
		}
	}
?>