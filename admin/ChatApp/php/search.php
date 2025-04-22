<?php
require_once('../../../initialize.php');
  require_once('../../../classes/DBConnection.php');
  include_once('../../../classes/SystemSettings.php');
session_start();
include_once "config.php";

// Check if searchTerm is set
if(isset($_POST['searchTerm'])){
     $outgoing_id= $_settings->userdata('unique_id');
    //$outgoing_id = $_SESSION['unique_id'];
    $searchTerm = mysqli_real_escape_string($conn, $_POST['searchTerm']);

    $sql = "SELECT * FROM users WHERE NOT unique_id = '{$outgoing_id}' AND (firstname LIKE '%{$searchTerm}%' OR lastname LIKE '%{$searchTerm}%') ";
    $output = "";
    
    // Execute the query
    $query = mysqli_query($conn, $sql);
    
    // Check for errors
    if (!$query) {
        // Query execution failed
        $output .= 'Query error: ' . mysqli_error($conn);
    } else {
        // Check if any rows were returned
        if(mysqli_num_rows($query) > 0){
            include_once "data.php";
        } else {
            $output .= 'No user found related to your search term';
        }
    }
    
    echo $output;
} else {
    echo "Search term not provided";
}
?>
