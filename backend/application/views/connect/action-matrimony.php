<?php
#action-matrimony.php

// change permission query
if(isset($action) && isset($id))
{
    $result = [];

    if($action == "active")
    {
        $query = $this->db->query("UPDATE `matrimony` SET `l_status` = 'inactive' WHERE `l_id`='$id'");

        $result = array(
            "action" => "inactive",
            "id" => $id
        );
    }
    elseif($action == "inactive")
    {
        $query = $this->db->query("UPDATE `matrimony` SET `l_status` = 'active' WHERE `l_id`='$id'");

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
    $query = $this->db->query("DELETE FROM `matrimony` WHERE `l_id`='$id'");
    if($query == true)
    {
        echo $id;
    }
}

// delete query
if(isset($editlisting) && $editlisting != "")
{
    $id = $editlisting;
    
        echo $id;
    exit;
}


// change plan query
if(isset($changeplan) && isset($id))
{
    $action = $changeplan;
    $result = [];

    if($action == "free")
    {
        $query = $this->db->query("UPDATE `matrimony` SET `l_type`='gold' WHERE `l_id`='$id'");

        $result = array(
            "action" => "gold",
            "id" => $id
        );
    }
    elseif($action == "gold")
    {
        $query = $this->db->query("UPDATE `matrimony` SET `l_type`='free' WHERE `l_id`='$id'");

        $result = array(
            "action" => "free",
            "id" => $id
        );
    }

    echo json_encode($result);
}

// change verified query
if(isset($changeverified) && isset($id))
{
    $action = $changeverified;
    $result = [];

    if($action == "0")
    {
        $query = $this->db->query("UPDATE `matrimony` SET `l_verified`='1' WHERE `l_id`='$id'");

        $result = array(
            "action" => "1",
            "id" => $id
        );
    }
    elseif($action == "1")
    {
        $query = $this->db->query("UPDATE `matrimony` SET `l_verified`='0' WHERE `l_id`='$id'");

        $result = array(
            "action" => "0",
            "id" => $id
        );
    }

    echo json_encode($result);
}

// change trusted query
if(isset($changetrusted) && isset($id))
{
    $action = $changetrusted;
    $result = [];

    if($action == "0")
    {
        $query = $this->db->query("UPDATE `matrimony` SET `l_trusted`='1' WHERE `l_id`='$id'");

        $result = array(
            "action" => "1",
            "id" => $id
        );
    }
    elseif($action == "1")
    {
        $query = $this->db->query("UPDATE `matrimony` SET `l_trusted`='0' WHERE `l_id`='$id'");

        $result = array(
            "action" => "0",
            "id" => $id
        );
    }

    echo json_encode($result);
}

?>