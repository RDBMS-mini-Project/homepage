<?php 
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "chathravaas";
    
    $mysqli = new mysqli($servername, $username, $password, $dbname);
    
    // Check connection
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }
    
    $hos = $_GET['hos'];

    $q_del = "delete from hostel_reg where hostel_id = '$hos'";
    $r_del = $mysqli->query($q_del);
    $response = [
        "message" => "Deleted successfully",
    ];

    header("Content-Type: application/json");
    echo json_encode($response);
?>