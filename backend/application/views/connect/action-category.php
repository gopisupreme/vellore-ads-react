<?php
#action-category.php

// change permission query
if(isset($action) && isset($id))
{
    $result = [];

    if($action == "active")
    {
        $query = $this->db->query("UPDATE `category` SET `c_status`='inactive' WHERE `c_id`='$id'");

        $result = array(
            "action" => "inactive",
            "id" => $id
        );
    }
    elseif($action == "inactive")
    {
        $query = $this->db->query("UPDATE `category` SET `c_status`='active' WHERE `c_id`='$id'");

        $result = array(
            "action" => "active",
            "id" => $id
        );
    }

    echo json_encode($result);
}


// delete query
if(isset($deletelisting) && $deletelisting != "")
{
    $id = $deletelisting;
    $query = $this->db->query("DELETE FROM `category` WHERE `c_id`='$id'");
    if($query == true)
    {
        echo $id;
    }
}

?>