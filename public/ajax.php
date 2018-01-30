<?php
require "../config.php";
require "../common.php";
if (isset($_POST['action'])) {
    if ($_POST['action']) {
      $button_id = $_POST['action'];


// connection to db

    try {
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

// disc from db

merge_files($result[$_POST['action']-1]["content"]);

$zip = new ZipArchive;
if ($zip->open('pic1.zip') === TRUE) {
  $zip->addFile('templates/index.html', 'index.html');
  $zip->close();
  echo 'ok';
} else {
  echo 'failed';
}





      echo $_POST['action'];
      echo $result[$_POST['action']-1]["content"];
    }
}



?>