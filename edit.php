<?php
// Step 1: Connect to the database (Replace DB_CONNECTION_INFO with actual database connection details)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "chathravaas";

$mysqli = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Step 2: Retrieve data from the database
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    if (isset($_GET['hos'])) {
        $hostel_id = $_GET['hos'];
        $query = "SELECT * FROM hostel_reg WHERE hostel_id = $hostel_id";
        $result = $mysqli->query($query);

        if ($result->num_rows > 0) {
            $hostel = $result->fetch_assoc();
        } else {
            echo "Hostel not found.";
            exit;
        }
    } else {
        echo "Invalid request.";
        exit;
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Step 4: Handle form submission and update data
    // Retrieve form input values
    $type = $_POST['type'];
    $gender = $_POST['gender'];
    $collegeNear = $_POST['college'];
    $distance = $_POST['distance'];
    $hostelName = $_POST['hostel-name'];
    $hosteladdress = $_POST['address'];
    $rent = $_POST['rent'];
    $wifi = isset($_POST['wifi']) ? 1 : 0;
    $generator = isset($_POST['generator']) ? 1 : 0;
    $cctv = isset($_POST['cctv']) ? 1 : 0;
    $cleaner = isset($_POST['cleaner']) ? 1 : 0;
    $furniture = isset($_POST['furniture']) ? 1 : 0;
    $parking = isset($_POST['parking']) ? 1 : 0;
    $balcony = isset($_POST['balcony']) ? 1 : 0;




    // Perform data validation and sanitation if needed

    // Update the database with the new values
    $hostel_id = $_POST['hostel_id']; // Assuming you have a hidden field in the form to store the hostel_id
    $query = "UPDATE hostel_reg SET hostel_type = '$type', gender = '$gender', collage_nearby = '$collegeNear',distance = '$distance', hostel_address ='$hosteladdress',rent = '$rent',wifi = '$wifi',generator = '$generator',cctv = '$cctv',cleaner = '$cleaner',furniture = '$furniture',parking = '$parking',balcony = '$balcony' WHERE hostel_id = '$hostel_id'";
    $result = $mysqli->query($query);

    if ($result) {
        // Redirect to the edit page or display a success message
        header('Location: dashboard.php?id=' . $hostel_id);
        exit;
    } else {
        echo "Error updating data: " . $mysqli->error;
        exit;
    }
}

// $mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Page</title>

  <link rel="icon" href="https://thumbs.dreamstime.com/z/hospital-building-flat-icon-round-colorful-button-clinic-circular-vector-sign-logo-illustration-style-design-95615497.jpg">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"> 
</head>
<body class="py-2">
  <nav class="navbar navbar-expand-lg bg-body-tertiary navBarrr">
    <div class="container-lg">
      <a class="navbar-brand" href="#intro"><span class="fw-bold display-5 text-secondary"><i class="bi bi-houses-fill"></i> Chathravaas</span></a>


      <!-- navbar links -->
      <div class="collapse navbar-collapse justify-content-end align-items-center" id="main-nav">
        <ul class="navbar-nav">
          <li onclick="deleteBtn(event, <?php echo $_GET['hos'] ?>)" class="nav-item align-items">
            <button class=" btn btn-warning d-block d-md-inline-block" href="">Delete</button>
          </li>
        </ul>
      </div>
    </div>
  </nav>


  <section>

    <p class="display-5 text-center mt-2 text-muted fw-bold">Update Your Details</p>
    <div class="container-md my-5">
      <div class="row justify-content-center align-items-center ">
        <div class="col-4">
          
<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">

<input type="hidden" name="hostel_id" value="<?php echo $hostel['hostel_id']; ?>">
<!-- Type -->
<div class="form-outline mb-5">
  <label class="fw-bold text-secondary mb-2" for="type">Edit Type :</label>
  <select id="type" name="type" class="form-select form-select-md mb-3 me-5" aria-label=".form-select-lg example">
    <option value="1" <?php echo ($hostel['hostel_type'] === 'Hostel') ? 'selected' : ''; ?>>Hostel</option>
    <option value="2" <?php echo ($hostel['hostel_type'] === 'PG') ? 'selected' : ''; ?>>PG</option>
  </select>
</div>

<!-- Gender -->
<div class="form-outline mb-5">
  <label class="fw-bold text-secondary mb-2" for="gender">Edit Gender :</label>
  <select id="gender" name="gender" class="form-select form-select-md mb-3 me-5" aria-label=".form-select-lg example">
    <option value="1" <?php echo ($hostel['gender'] === 'Men') ? 'selected' : ''; ?>>Men</option>
    <option value="2" <?php echo ($hostel['gender'] === 'Women') ? 'selected' : ''; ?>>Women</option>
  </select>
</div>

<!--nearby college -->
<div class="form-outline mb-5">
  <label class="fw-bold text-secondary mb-2" for="college">Edit College Nearby :</label>
  <select id="college" name="college" class="form-select form-select-md mb-3 me-5" aria-label=".form-select-lg example">
  <?php
    $college_name = $hostel['collage_nearby'];
    echo "<option value='$college_name'>$college_name</option>";
    $q_hostel = "SELECT * from colleges where college_name != '$college_name'";
    $r_hostel = $mysqli->query($q_hostel);
    while($row = $r_hostel->fetch_assoc()){
        $college_name = $row['college_name'];
        echo "<option value='$college_name'>$college_name</option>";
    }
  ?>
</select>
</div>

<!--Distance from college -->
<div class="form-outline mb-5">
  <label class="fw-bold text-secondary mb-2" for="distance">Edit Distance in km :</label>
  <input type="number" id="distance" name="distance" class="form-control" placeholder="Distance in km" required value="<?php echo $hostel['distance']; ?>">
</div>

<!--Hostel Name -->
<div class="form-outline mb-5">
  <label class="fw-bold text-secondary mb-2" for="hostel-name">Edit Hostel Name :</label>
  <input type="text" id="hostel-name" name="hostel-name" class="form-control" placeholder="Hostel name" required value="<?php echo $hostel['hostel_name']; ?>">
</div>

<!-- Address -->
<div class="form-outline mb-5">
  <label class="fw-bold text-secondary mb-2" for="address">Edit Hostel Address :</label>
  <input type="text" id="address" name="address" class="form-control" placeholder="Hostel Address" required value="<?php echo $hostel['hostel_address']; ?>"></div>

<!--Rent -->
<div class="form-outline mb-5">
  <label class="fw-bold text-secondary mb-2" for="rent">Edit Rent :</label>
  <input type="number" id="rent" name="rent" class="form-control" placeholder="Rent" required value="<?php echo $hostel['rent']; ?>">
</div>

<!--Facilities -->
<div class="form-outline mb-5">
  <p class="text-secondary fw-bold">Select Facilities Provided : </p>
  <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
    <input type="checkbox" name="wifi" class="btn-check" id="btncheck1" autocomplete="off">
    <label class="btn btn-outline-warning" for="btncheck1">WiFi</label>
  
    <input type="checkbox" name="generator" class="btn-check" id="btncheck2" autocomplete="off" >
    <label class="btn btn-outline-warning" for="btncheck2">Generator</label>
  
    <input type="checkbox" name="cctv" class="btn-check" id="btncheck3" autocomplete="off">
    <label class="btn btn-outline-warning" for="btncheck3">CCTV</label>

    <input type="checkbox" name="cleaner" class="btn-check" id="btncheck4" autocomplete="off">
    <label class="btn btn-outline-warning" for="btncheck4">Cleaner</label>

    <input type="checkbox" name="furniture" class="btn-check" id="btncheck5" autocomplete="off">
    <label class="btn btn-outline-warning" for="btncheck5">Furniture</label>

    <input type="checkbox" name="parking" class="btn-check" id="btncheck6" autocomplete="off">
    <label class="btn btn-outline-warning" for="btncheck6">Parking</label>

    <input type="checkbox" name="balcony" class="btn-check" id="btncheck7" autocomplete="off">
    <label class="btn btn-outline-warning" for="btncheck7">Balcony</label>
  </div>
  
</div>
            

                            
               <!-- Sign-Up button -->
                   
            <div class="col d-flex justify-content-center">   
            <button type="submit" class="btn btn-warning btn-block mb-4 mx-5 mt-5" href="#" role="button"><span class="fw-bold text-white">Update</span></button>
          </div>

          </form>

        </div>
      </div>
    </div>

  </section>
</body>
<script>
    function deleteBtn(event, hos){
        console.log(hos)
        event.preventDefault()
            fetch(`delete.php?hos=${hos}`, {
                method: "GET"
            },
            )
            .then(response => response.json())
                .then(data => {
                    window.location.href = 'dashboard.php'
                    // console.log('done')
                })
                .catch(error => {
                    console.error(error);
                });
        console.log(hos)
    }
</script>
</html>