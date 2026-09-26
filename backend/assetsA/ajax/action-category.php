<?php
include("../../dbconnect.php");

// change permission query
if(isset($_POST["action"]) && isset($_POST["id"]))
{
    $action = $_POST["action"];
    $id = $_POST["id"];
    $result = [];

    if($action == "active")
    {
        $query = mysqli_query($conn, "UPDATE `category` SET `c_status`='inactive' WHERE `c_id`='$id'");

        $result = array(
            "action" => "inactive",
            "id" => $id
        );
    }
    elseif($action == "inactive")
    {
        $query = mysqli_query($conn, "UPDATE `category` SET `c_status`='active' WHERE `c_id`='$id'");

        $result = array(
            "action" => "active",
            "id" => $id
        );
    }

    echo json_encode($result);
}


// delete query
if(isset($_POST["deletelisting"]) && $_POST["deletelisting"] != "")
{
    $id = $_POST["deletelisting"];
    $query = mysqli_query($conn, "DELETE FROM `category` WHERE `c_id`='$id'");
    if($query == true)
    {
        echo $id;
    }
}

// delete query
if(isset($_POST["editlisting"]) && $_POST["editlisting"] != "")
{
    $id = $_POST["editlisting"];
    
        echo $id;
    exit;
}


// change plan query
if(isset($_POST["changeplan"]) && isset($_POST["id"]))
{
    $action = $_POST["changeplan"];
    $id = $_POST["id"];
    $result = [];

    if($action == "free")
    {
        $query = mysqli_query($conn, "UPDATE `listing` SET `l_type`='gold' WHERE `l_id`='$id'");

        $result = array(
            "action" => "gold",
            "id" => $id
        );
    }
    elseif($action == "gold")
    {
        $query = mysqli_query($conn, "UPDATE `listing` SET `l_type`='free' WHERE `l_id`='$id'");

        $result = array(
            "action" => "free",
            "id" => $id
        );
    }

    echo json_encode($result);
}
?>