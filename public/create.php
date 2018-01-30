<?php

/**
 * Use an HTML form to create a new entry in the
 * users table.
 *
 */


if (isset($_POST['submit']))
{
	
	require "../config.php";
	require "../common.php";

	try 
	{
		$connection = new PDO($dsn, $username, $password, $options);
		$date = new DateTime();
		$date_string =  $date->format('Y-m-d H:i:s');
		$new_user = array(
			"firstname" => $_POST['firstname'],
			"theme"  => $_POST['theme'],
			"email"     => $_POST['email'],
			"content"  => $_POST['content'],
			"date" => $date_string
		);

		$sql = sprintf(
				"INSERT INTO %s (%s) values (%s)",
				"users",
				implode(", ", array_keys($new_user)),
				":" . implode(", :", array_keys($new_user))
		);
		
		$statement = $connection->prepare($sql);
		$statement->execute($new_user);
	}

	catch(PDOException $error) 
	{
		echo $sql . "<br>" . $error->getMessage();
	}
	
}
?>

<?php require "templates/header.php"; ?>

<?php 
if (isset($_POST['submit']) && $statement) 
{ ?>
	<blockquote><?php echo $_POST['firstname']; ?> successfully added.</blockquote>
<?php 
} ?>

<h2>Add a user</h2>

<form id="create-record" method="post">
	<label for="firstname">Username</label>
	<input type="text" name="firstname" id="firstname">
	<label for="theme">Theme</label>
	<input type="text" name="theme" id="theme">
	<label for="email">Email Address</label>
	<input type="text" name="email" id="email">
	<label for="content">Content</label>
	<textarea form="create-record" name="content" id="content" rows="4" cols="50">
	At w3schools.com you will learn how to make a website. We offer free tutorials in all web development technologies.
	</textarea>
	<br>
	<input type="submit" name="submit" value="Submit">
</form>

<a href="index.php">Back to home</a>

<?php require "templates/footer.php"; ?>