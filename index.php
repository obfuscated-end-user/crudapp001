<?php
	include("header.php");
	include("conn.php");
?>
<div class="box1">
	<h2>All students</h2>
	<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Add student</button>
</div>
<table class="table table-hover table-bordered table-striped">
	<thead>
		<tr>
			<th>ID</th>
			<th>First name</th>
			<th>Last name</th>
			<th>Age</th>
			<th>Update</th>
			<th>Delete</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$query = "SELECT * FROM `students`";
			$result = mysqli_query($connection, $query);

			if (!$result) {
				die("query failed".mysqli_error());
			} else {
				while($row = mysqli_fetch_assoc($result)) {
					?>
						<tr>
							<td><?php echo $row["id"]; ?></td>
							<td><?php echo $row["first_name"]; ?></td>
							<td><?php echo $row["last_name"]; ?></td>
							<td><?php echo $row["age"]; ?></td>
							<td><a href="update.php?id=<?php echo $row["id"]; ?>" class="btn btn-success">Update</a></td>
							<td><a href="delete.php?id=<?php echo $row["id"]; ?>" class="btn btn-danger">Delete</a></td>
						</tr>
					<?php
				}
			}
			/*
					echo "<tr>";
					echo "<td>" . $row["id"] . "</td>";
					echo "<td>" . $row["first_name"] . "</td>";
					echo "<td>" . $row["last_name"] . "</td>";
					echo "<td>" . $row["age"] . "</td>";
					echo "<td><a href=\"update.php?id=" . $row["id"] . " class=\"btn btn-success\">Update</a></td>";
					echo "<td><a href=\"delete.php?id=" . $row["id"] . " class=\"btn btn-danger\">Delete</a></td>";
					echo "</tr>";
			
			*/
		?>
	</tbody>
</table>

<?php
	if (isset($_GET["msg"])) {
		echo "<h6>" . $_GET["msg"] . "</h6>";
	}
	if (isset($_GET["insert_msg"])) {
		echo "<h6>" . $_GET["insert_msg"] . "</h6>";
	}
	if (isset($_GET["update_msg"])) {
		echo "<h6>" . $_GET["update_msg"] . "</h6>";
	}
	if (isset($_GET["delete_msg"])) {
		echo "<h6>" . $_GET["delete_msg"] . "</h6>";
	}
?>

<form action="insert.php" method="POST">
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Add student</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close">
				</button>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="f_name">First name</label>
						<input type="text" name="f_name" class="form-control">
					</div>
					<div class="form-group">
						<label for="l_name">Last name</label>
						<input type="text" name="l_name" class="form-control">
					</div>
					<div class="form-group">
						<label for="age">Age</label>
						<input type="number" name="age" class="form-control">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
					<input type="submit" class="btn btn-success" name="add_students" value="Add">
				</div>
			</div>
		</div>
	</div>
</form>
<?php include("footer.php"); ?>