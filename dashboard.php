<?php
session_start();

// Check if the owner is logged in
if (!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] !== true) {
    // If the owner is not logged in, redirect to the login page
    header("Location: login_page.php");
    exit();
}

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

// Get the owner_id of the logged-in owner
$owner_id = $_SESSION["owner_id"];

// Prepare and execute the query to fetch hostels belonging to the logged-in owner
$query = "SELECT * FROM hostel_reg WHERE owner_id = $owner_id";
$result = $con->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Head content as before -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"> 
</head>
<body class="py-2">

<nav class="navbar navbar-expand-lg bg-body-tertiary navBarrr"> 
    <div class="container-lg"> 
      <a class="navbar-brand" href="#intro"><span class="fw-bold display-5 text-secondary"><i class="bi bi-houses-fill"></i> Chathravaas</span></a> 
   <!-- navbar links --> 
      <div class="collapse navbar-collapse justify-content-end align-items-center" id="main-nav"> 
        <ul class="navbar-nav">  
          <li class="nav-item align-items"> 
            <a class="btn btn-warning d-block d-md-inline-block" href="datacollect.php">Create Hostel</a> 
          </li> 
        </ul> 
      </div> 
    </div> 
  </nav>

  <div class="container-lg">
    <div class="row justify-content-center align-items-center">
        <?php
        // Check if any hostels are found for the owner
        if ($result->num_rows === 0) {
            // If no hostels found, display the message
            ?>
            <div class="col-md-12">
                <p class="text-center">No Hostel Found, Click  Create Hostel Button</p>
            </div>
            <?php
        } else {
            // Loop through the fetched data and display as cards
            while ($row = $result->fetch_assoc()) {
                $hostel_id = $row['hostel_id']; // Add this line to get the hostel_id
                $image1 = $row['image1'];
                $hostel_name = $row['hostel_name'];
                $rent = $row['rent'];
                $distance = $row['distance'];
                ?>
                <!-- Card -->
                <div class="col-md-3 g-4">
                    <div class="card" style="width: 18rem;">
                        <img src="Loc/<?php echo $image1; ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $hostel_name; ?></h5>
                            <p class="card-text">Rent: <?php echo $rent; ?></p>
                            <p class="card-text">Distance: <?php echo $distance; ?></p>
                            <div class="d-inline" onclick="redirectt(<?php echo $hostel_id; ?>)">
                                <button class="btn btn-primary">Preview</button>
                            </div>
                            <div class="d-inline" onclick="redirecttt(<?php echo $hostel_id; ?>)">
                                <button class="btn btn-primary">Edit</button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
        }
        // Close the database connection
        $con->close();
        ?>
    </div>
</div>
</body>
<script>
    function redirectt(hos) {
        window.location.href = `preview.php?hos=${hos}`
    }
    function redirecttt(hos) {
        window.location.href = `edit.php?hos=${hos}`
    }
</script>

</html>
