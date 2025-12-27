<?php
	include("header.php");
	include("conn.php");
?>
<div class="box1">
	<h2>All students</h2>
	<!--
	https://getbootstrap.com/docs/5.3/components/buttons/
	btn - base button styling (padding, border-radius)
	btn-primary - blue button
	data-bs-toggle="modal" - opens modal when clicked
	data-bs-target="#exampleModal" - targets specific modal by ID
	-->
	<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
		Add student
	</button>
</div>
<!--
https://getbootstrap.com/docs/5.3/content/tables/
bootstrap things:
table - basic table styling (padding, borders)
table-hover - rows highlight on mouse hoer
table-bordered - adds borders around all cells
table-striped - alternating row colors
-->
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
			// this is an SQL query
			// fetches all records from students table
			$query = "SELECT * FROM `students`";
			// execute the query and store the result
			// https://www.php.net/manual/en/mysqli.query.php
			$result = mysqli_query($connection, $query);

			if (!$result)
				// die() terminates the PHP script immediately and prints an
				// optional message, the period (.) concatenates strings, not
				// a method from a class or OOP syntax
				// https://www.php.net/manual/en/function.exit.php
				// https://www.php.net/manual/en/mysqli.error.php
				die("query failed" . mysqli_error());
			else {
				// fetch one row from the query result as an associative array
				// $row becomes ["id" => 1, "first_name" => "John", "last_name" => "Doe", "age" => 20]
				// loop continues until there are no more rows left
				// https://www.php.net/manual/en/mysqli-result.fetch-assoc.php
				while ($row = mysqli_fetch_assoc($result)) {
					// bootstrap things
					// btn-success - green button
					// btn-danger -red button
					echo "<tr>
							<td>" . $row["id"] . "</td>
							<td>" . $row["first_name"] . "</td>
							<td>" . $row["last_name"] . "</td>
							<td>" . $row["age"] . "</td>
							<td><a href='update.php?id=" . $row["id"] . "' class='btn btn-success'>Update</a></td>
							<td><a href='delete.php?id=" . $row["id"] . "' class='btn btn-danger'>Delete</a></td>
						</tr>";
				}
			}
		?>
	</tbody>
</table>

<?php
	// dissplay success/error messages passed through the URL after CRUD
	// operations, refer to the other files for more details

	// https://www.php.net/manual/en/reserved.variables.get.php
	if (isset($_GET["msg"]))
		echo "<h6>" . $_GET["msg"] . "</h6>";
	if (isset($_GET["insert_msg"]))
		echo "<h6>" . $_GET["insert_msg"] . "</h6>";
	if (isset($_GET["update_msg"]))
		echo "<h6>" . $_GET["update_msg"] . "</h6>";
	if (isset($_GET["delete_msg"]))
		echo "<h6>" . $_GET["delete_msg"] . "</h6>";
?>

<!--
send data to insert.php when submitted
if, for some reason, you need to get the POST variables through PHP, you will do
$_POST["f_name"], $_POST["l_name"], etc., make sure it is the same as the `name`
attributes inside the <input> tags below

looks like this internally:
$_POST = [
	"f_name" => "John",
	"l_name" => "Doe", 
	"age" => "20",
	"add_students" => "Add"
]

https://getbootstrap.com/docs/5.3/components/modal/
modal - base modal styling
fade - smooth fade-in/out animation
tabindex="-1" - removes the element from keyboard tab order
role="dialog" - screen reader accessibility thing, tells that "this is a dialog
				box/popup"
aria-labelledby="exampleModalLabel" - points to modal title for screen readers
aria-hidden="true" - hides the element from screen readers when modal is closed
-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<!--
	modal-dialog - modal content wrapper (centering, width)
	modal-content - modal background/border/shadow
	modal-header - top bar styling
	modal-body - content area padding
	modal-footer - bottom bar styling
	modal-title - header text styling
	-->
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Add student</h5>
				<!--
				btn-close - styled x close button
				data-bs-dismiss="modal" - closes modal when clicked
				-->
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close">
				</button>
			</div>
			<div class="modal-body">
				<form action="insert.php" method="POST">
					<!--
					https://getbootstrap.com/docs/5.3/forms/overview/
					form-group - proper spacing between label + input
					form-control - styled inputs (height, padding, focus
									effects, border-radius)
					-->
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
					<div class="modal-footer">
						<!-- btn-secondary - gray button -->
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
						<input type="submit" class="btn btn-success" name="add_students" value="Add">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<?php include("footer.php"); ?>