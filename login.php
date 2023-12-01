<?php
session_start();

// Replace these variables with your actual database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "chathravaas";

// Create a connection
$con = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Assuming you have a form submission to handle login
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["user-name"];
    $password = $_POST["pass"];

    // Validate username and password against the database (you should implement this part)

    // Assuming the login is successful, fetch the owner's information from the database
    // Use prepared statements to avoid SQL injection
    $query = "SELECT owner_id, owner_name FROM owner_reg WHERE user_name = ? AND password = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $owner_id = $row["owner_id"];
        $owner_name = $row["owner_name"];

        // Start the session and store the owner's information
        $_SESSION["logged_in"] = true;
        $_SESSION["owner_id"] = $owner_id;
        $_SESSION["owner_name"] = $owner_name;

        // Redirect to the dashboard or any other page after successful login
        header("Location: dashboard.php");
        exit();
    } else {
        // Handle invalid login credentials
        // For simplicity, you can redirect back to the login page with an error message
        header("Location: login_page.php?error=1"); // Add any query parameter you need for error handling
        exit();
    }
}

// Close the database connection
$con->close();
?>
