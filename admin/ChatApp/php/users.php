<?php
require_once('../../../initialize.php');
  require_once('../../../classes/DBConnection.php');
  include_once('../../../classes/SystemSettings.php');
    session_start();
    include_once "config.php";
    $outgoing_id = $_settings->userdata('unique_id');
    $sql = "SELECT * FROM users WHERE NOT unique_id = {$outgoing_id} ORDER BY id DESC";
    $query = mysqli_query($conn, $sql);
    $output = "";
    if(mysqli_num_rows($query) == 0){
        $output .= "No users are available to chat";
    }elseif(mysqli_num_rows($query) > 0){
        include_once "data.php";
    }
    echo $output;
?>