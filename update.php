<?php
	include("header.php");
	include("conn.php");

	if (isset($_GET["id"])) {
		$id = $_GET["id"];
		$query = "SELECT * FROM `students` WHERE `id` = '$id'";
		$result = mysqli_query($connection, $query);

		if (!$result) {
			die("query failed".mysqli_error());
		} else {
			$row = mysqli_fetch_assoc($result);
		}
	}

	// remember that this should have the same value as indicated in name attribute
	if (isset($_POST["update_student"])) {
		if (isset($_GET["id_new"])) {
			$id_new = $_GET["id_new"];
		}
		$f_name = $_POST["f_name"];
		$l_name = $_POST["l_name"];
		$age = $_POST["age"];

		$query = "UPDATE `students` SET `first_name` = '$f_name', `last_name` = '$l_name', `age` = '$age' WHERE `id` = '$id_new'";
		$result = mysqli_query($connection, $query);

		if (!$result) {
			die("query failed".mysqli_error());
		} else {
			header("location:index.php?update_msg=Successfully updated data");
		}
	}
?>
<form action="update.php?id_new=<?php echo $id;?>" method="post">
	<div class="form-group">
		<label for="f_name">First name</label>
		<input type="text" name="f_name" class="form-control" value="<?php echo $row["first_name"]?>">
	</div>
	<div class="form-group">
		<label for="l_name">Last name</label>
		<input type="text" name="l_name" class="form-control" value="<?php echo $row["last_name"]?>">
	</div>
	<div class="form-group">
		<label for="age">Age</label>
		<input type="number" name="age" class="form-control" value="<?php echo $row["age"]?>">
	</div>
	<!-- here -->
	<input type="submit" class="btn btn-success" name="update_student" value="Update student">
</form>
<?php
	include("footer.php");
?>