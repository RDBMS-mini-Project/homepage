<?php
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
$col = $_GET['col'];
$hos = $_GET['hos'];
$gen = $_GET['gen'];
// Prepare and execute the query
$query = "SELECT * FROM hostel_reg WHERE collage_nearby='$col' AND hostel_type='$hos' AND gender='$gen'";
$result = $con->query($query);
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hostels</title>
  <link rel="icon" href="https://thumbs.dreamstime.com/z/hospital-building-flat-icon-round-colorful-button-clinic-circular-vector-sign-logo-illustration-style-design-95615497.jpg">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body class="py-2">
<nav class="navbar navbar-expand-lg bg-body-tertiary navBarrr mb-5"> 
    <div class="container-lg"> 
      <a class="navbar-brand" href="#intro"><span class="fw-bold display-5 text-secondary"><i class="bi bi-houses-fill"></i> Chathravaas</span></a>       
  </nav>
  <div class="container-lg">
    <div class="row justify-content-center align-items-center">
      <?php
      // Loop through the fetched data and display as cards
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            $image1 = $row['image1'];
            $hostel_id = $row['hostel_id'];
            $owner_id = $row['owner_id'];
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
            <div>
              <div onclick="redirectt(<?php echo $hostel_id;?>, <?php echo $owner_id;?>)">
                <button class="btn btn-primary">View Hostel</button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php
        }
      } else {
        // Display a message when no hostels are found
        echo '<div class="col-md-12 text-center">No Hostel found</div>';
      }
      // Close the database connection
      $con->close();
      ?>
    </div>
  </div>
  <script>
    function redirectt(hos, own) {
      window.location.href = `hosteldetails.php?hos=${hos}&own=${own}`;
    }
  </script>
</body>
</html>
