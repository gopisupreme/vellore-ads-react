<?php
include('database_connection.php');
if(isset($_POST["category_id"])) {
    $query = "SELECT DISTINCT(s_title) FROM sub_categories WHERE s_status = '1' AND   s_category = '".$_POST["category_id"]."'  ORDER BY s_id DESC";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    foreach ($result as $row) {

        $output .= '
  <option value='. $row['s_title'] .'>'. $row['s_title'] .'</option>
   ';
    }
}
else
{
    $output = '<h3>No Data Found</h3>';
}
echo $output;
?>
