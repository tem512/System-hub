<?php 
require_once('../../../initialize.php');
  require_once('../../../classes/DBConnection.php');
  include_once('../../../classes/SystemSettings.php');
    session_start();
    $outgoing_id= $_settings->userdata('unique_id');
    if(isset($outgoing_id)){
        include_once "config.php";
        $outgoing_id = $outgoing_id;
        $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
        $message = mysqli_real_escape_string($conn, $_POST['message']);
        if(!empty($message)){
            $sql = mysqli_query($conn, "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg)
                                        VALUES ({$incoming_id}, {$outgoing_id}, '{$message}')") or die();
        }
    }else{
        header("location: ../login.php");
    }


    
?>