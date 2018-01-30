<?php

/**
 * Function to query information based on 
 * a parameter: in this case, location.
 *
 */

	
	try 
	{	
		require "../config.php";
		require "../common.php";

		$connection = new PDO($dsn, $username, $password, $options);

		$sql = "SELECT * 
						FROM users";

		$firstname = $_POST['firstname'];

		$statement = $connection->prepare($sql);
		$statement->bindParam(':firstname', $firstname, PDO::PARAM_STR);
		$statement->execute();

		$result = $statement->fetchAll();
	}
	
	catch(PDOException $error) 
	{
		echo $sql . "<br>" . $error->getMessage();
	}

?>

<?php require "templates/header.php"; ?>
		
<?php  

	if ($result && $statement->rowCount() > 0) 
	{ ?>
		<h2>Results</h2>

		<table>
			<thead>
				<tr>
					<th>#</th>
					<th>Username</th>
					<th>Theme</th>
					<th>Email</th>
					<th>Date</th>
					<th>Content</th>
					<th>Download</th>
				</tr>
			</thead>
			<tbody>
	<?php 
		foreach ($result as $row) 
		{
			?>
			<tr>
				<td><?php echo escape($row["id"]); ?></td>
				<td><?php echo escape($row["firstname"]); ?></td>
				<td><?php echo escape($row["theme"]); ?></td>
				<td><?php echo escape($row["email"]); ?></td>
				<td><?php echo escape($row["date"]); ?></td>
				<td>
					<textarea readonly rows="4" cols="50">
					<?php echo escape($row["content"]); ?>
					</textarea>
				</td>
				<td><button type="button" id=<?php echo $row["id"]; ?>> download </button></td>
			</tr>
		<?php 
		} ?>
		</tbody>
	</table>
	<?php 
	} 
	else 
	{ ?>
		<blockquote>No results found for <?php echo escape($_POST['firstname']); ?>.</blockquote>
	<?php
	} 
?> 


<a href="index.php">Back to home</a>

<?php
console_log($result[0]["content"]);

?>

<a href="pic1.zip">Save</a>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="scripts/scripts.js"></script>
<?php require "templates/footer.php"; ?>