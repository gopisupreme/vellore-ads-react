<?php
		
  require_once('config.php');
  $sql = 'SELECT * from listing,I_title';
  $statement = $connection->prepare($sql);
  $statement->execute();
  if($statement->rowCount())
  {
    $row_all = $statement->fetchall(PDO::FETCH_ASSOC);
    header('Content-type: application/json');
    echo json_encode($row_all); 		
  }  
  elseif(!$statement->rowCount())
  {
    echo "no rows";
  }
		  
?>