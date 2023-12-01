

<?php
//declare
$userName='';
$pass='';
$confirmPassword='';
$phoneNumber='';
$ownerName='';

// Step 1: Establish a database connection
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'chathravaas';

$conn = mysqli_connect($host, $username, $password, $database);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Step 2: Retrieve form data
    $userName = $_POST['user-name'];
    $pass = $_POST['password'];
    $confirmPassword = $_POST['confirm-password'];
    $phoneNumber = $_POST['phone-number'];
    $ownerName = $_POST['owner-name'];

    // Step 3: Validate and sanitize the data
    // Perform your validation and sanitization logic here
    // ...

    // Step 4: Insert the data into the database
    $query = "INSERT INTO owner_reg (user_name, password, phone_number, owner_name) 
              VALUES ('$userName', '$pass', '$phoneNumber', '$ownerName')";
    $result = mysqli_query($conn, $query);

    if ($result) {
        // Data inserted successfully
        echo "Data inserted successfully.";
    } else {
        // Failed to insert data
        echo "Error: " . mysqli_error($conn);
    }
}

// Step 5: Close the database connection
mysqli_close($conn);
?>
