<?php
session_start();
// Connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$database = "chathravaas";

// Connect to the database
$conn = mysqli_connect($servername, $username, $password, $database);

// Check the connection
if (!$conn) 
{
    die("Sorry, we failed to connect: " . mysqli_connect_error());
} 
else 
{
    // Fetch colleges from the database
    $collegeQuery = "SELECT college_name FROM colleges";
    $collegeResult = mysqli_query($conn, $collegeQuery);

    // Array to store college names
    $colleges = array();

    // Check if data was fetched successfully
    if (mysqli_num_rows($collegeResult) > 0) {
        while ($row = mysqli_fetch_assoc($collegeResult)) {
            $colleges[] = $row['college_name'];
        }
    }
}

$type = '';
$gender = '';
$collegeNear = '';
$distance = '';
$hostelName = '';
$hosteladdress = '';
$rent = '';
$wifi = '';
$generator = '';
$cctv = '';
$cleaner = '';
$furniture = '';
$parking = '';
$balcony = '';
$image1 = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $type = $_POST['type'];
    $gender = $_POST['gender'];
    $collegeNear = $_POST['college-near'];
    $distance = $_POST['distance'];
    $hostelName = $_POST['hostelName'];
    $hosteladdress = $_POST['address'];
    $rent = $_POST['rent'];
    $wifi = isset($_POST['wifi']) ? 1 : 0;
    $generator = isset($_POST['generator']) ? 1 : 0;
    $cctv = isset($_POST['cctv']) ? 1 : 0;
    $cleaner = isset($_POST['cleaner']) ? 1 : 0;
    $furniture = isset($_POST['furniture']) ? 1 : 0;
    $parking = isset($_POST['parking']) ? 1 : 0;
    $balcony = isset($_POST['balcony']) ? 1 : 0;

    // Connection parameters
   // $servername = "localhost";
   // $username = "root";
   // $password = "";
   // $database = "chathravaas";
    
    // Connect to the database
    $conn = mysqli_connect($servername, $username, $password, $database);

    // Check the connection
    if (!$conn) 
    {
        die("Sorry, we failed to connect: " . mysqli_connect_error());
    } 
    else 
    {
        // Submitting to the database
        $owner_id = $_SESSION['owner_id'];
        $sql = "INSERT INTO hostel_reg (owner_id, hostel_type, gender, collage_nearby, distance, hostel_name, hostel_address, rent, wifi, generator, cctv, cleaner, furniture, parking, balcony) VALUES ('$owner_id', '$type', '$gender', '$collegeNear', '$distance', '$hostelName', '$hosteladdress', '$rent', '$wifi', '$generator', '$cctv', '$cleaner', '$furniture', '$parking', '$balcony')";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success</strong> Your data has been submitted successfully.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        } else {
            echo "DB not created successfully ----->" . mysqli_error($conn);
        }

        // Fetch colleges from the database
        $collegeQuery = "SELECT college_name FROM colleges";
        $collegeResult = mysqli_query($conn, $collegeQuery);

        // Array to store college names
        $colleges = array();

        // Check if data was fetched successfully
        if (mysqli_num_rows($collegeResult) > 0) {
            while ($row = mysqli_fetch_assoc($collegeResult)) {
                $colleges[] = $row['college_name'];
            }
        }        
    }

    // Function to handle image upload and database update
    function handleImageUpload($inputName, $hostelName, $conn) {
        if (isset($_FILES[$inputName])) {
            $file = $_FILES[$inputName];
        
            // Check if file upload was successful
            if ($file['error'] === UPLOAD_ERR_OK) {
                $uploadDir = "C:/xampp/htdocs/Chatravaas/Loc/";
                $filename = uniqid() . '_' . basename($file['name']);
                $destination = $uploadDir . $filename;
        
                // Move the uploaded file to the destination folder
                if (move_uploaded_file($file['tmp_name'], $destination)) {
                    // Update the corresponding image column in the database
                    $columnName = $inputName === 'image1' ? 'image1' : (
                        $inputName === 'image2' ? 'image2' : (
                            $inputName === 'image3' ? 'image3' : (
                                $inputName === 'image4' ? 'image4' : 'image5'
                            )
                        )
                    );
        
                    $sql = "UPDATE hostel_reg SET $columnName = '$filename' WHERE hostel_name = '$hostelName'";
                    if ($conn->query($sql) === TRUE) {
                        return 'Image uploaded and stored in the database successfully.';
                    } else {
                        return 'Error: ' . $sql . '<br>' . $conn->error;
                    }
                } else {
                    return 'Error: Failed to move uploaded file.';
                }
            } else {
                return 'Error: File upload failed with error code ' . $file['error'];
            }
        }

        return '';
    }
    $image1 = handleImageUpload('image1', $hostelName, $conn);
    $image2 = handleImageUpload('image2', $hostelName, $conn);
    $image3 = handleImageUpload('image3', $hostelName, $conn);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Details Page</title>

  <link rel="icon" href="https://thumbs.dreamstime.com/z/hospital-building-flat-icon-round-colorful-button-clinic-circular-vector-sign-logo-illustration-style-design-95615497.jpg">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"> 
</head>
<body class="bg-body-tertiary py-2">

<nav class="navbar navbar-expand-lg bg-body-tertiary navBarrr mb-5"> 
  <div class="container-lg"> 
    <a class="navbar-brand" href="index.php"><span class="fw-bold display-5 text-secondary"><i class="bi bi-houses-fill"></i> Chathravaas</span></a>  
        
</nav>

  <section>
    <p class="display-5 text-center mt-2 text-muted fw-bold">Fill Up Your Details...</p>
    <div class="container-md bg-body-tertiary my-5">
      <div class="row justify-content-center align-items-center">
        <div class="col-4">
          <form method="POST" enctype="multipart/form-data">
            <!-- Type -->
            <div class="form-outline mb-5">
              <select name="type" class="form-select form-select-md mb-3 me-5" aria-label=".form-select-lg example">
                <option selected>Choose Type</option>
                <option value="1">Hostel</option>
                <option value="2">PG</option>
              </select>
            </div>
            <!-- Gender -->
            <div class="form-outline mb-5">
              <select name="gender" class="form-select form-select-md mb-3 me-5" aria-label=".form-select-lg example">
                <option selected>Choose Gender</option>
                <option value="1">Men's</option>
                <option value="2">Women's</option>
              </select>
            </div>
            <!-- Nearby college -->
            <div class="form-outline mb-5">
              <select name="college-near" class="form-select form-select-md mb-3 me-5" aria-label=".form-select-lg example">
                <option selected>Choose Nearby College</option>
                <?php foreach ($colleges as $college) { ?>
                  <option value="<?php echo $college; ?>"><?php echo $college; ?></option>
                <?php } ?>
              </select>
            </div>
            <!-- Distance from college -->
            <div class="form-outline mb-5">
              <input name="distance" type="number" id="distance" class="form-control" placeholder="Distance in km" required>
            </div>
            <!-- Hostel Name -->
            <div class="form-outline mb-5">
              <input name="hostelName" type="text" id="hostel-name" class="form-control" placeholder="Hostel Name" required>
            </div>
            <!-- Address -->
            <div class="form-outline mb-5">
              <input name="address" type="text" id="address" class="form-control" placeholder="Hostel Address" required>
            </div>
            <!-- Rent -->
            <div class="form-outline mb-5">
              <input name="rent" type="number" id="rent" class="form-control" placeholder="Rent" required>
            </div>
            <!-- Facilities -->
            <div class="form-outline mb-5">
              <p class="text-secondary">Select Facilities Provided</p>
              <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                <input name="wifi" type="checkbox" class="btn-check" id="btncheck1" autocomplete="off">
                <label class="btn btn-outline-warning" for="btncheck1">WiFi</label>
                <input name="generator" type="checkbox" class="btn-check" id="btncheck2" autocomplete="off">
                <label class="btn btn-outline-warning" for="btncheck2">Generator</label>
                <input name="cctv" type="checkbox" class="btn-check" id="btncheck3" autocomplete="off">
                <label class="btn btn-outline-warning" for="btncheck3">CCTV</label>
                <input name="cleaner" type="checkbox" class="btn-check" id="btncheck4" autocomplete="off">
                <label class="btn btn-outline-warning" for="btncheck4">Cleaner</label>
                <input name="furniture" type="checkbox" class="btn-check" id="btncheck5" autocomplete="off">
                <label class="btn btn-outline-warning" for="btncheck5">Furniture</label>
                <input name="parking" type="checkbox" class="btn-check" id="btncheck6" autocomplete="off">
                <label class="btn btn-outline-warning" for="btncheck6">Parking</label>
                <input name="balcony" type="checkbox" class="btn-check" id="btncheck7" autocomplete="off">
                <label class="btn btn-outline-warning" for="btncheck7">Balcony</label>
              </div>
            </div>
            <!-- Images -->
            <div class="form-outline mb-1">
              <p class="text-secondary">Upload Hostel Photos</p>
              <input name="image1" type="file" id="image1" class="form-control" required>
            </div>
            <div class="form-outline mb-1">  
              <input name="image2" type="file" id="image2" class="form-control" required>
            </div>
            <div class="form-outline mb-1">
              <input name="image3" type="file" id="image3" class="form-control" required>
            </div>
            <div class="row mb-4">
              <div class="col d-flex justify-content-center">
                <!-- Sign-Up button -->
                <button class="btn btn-warning btn-block mb-4 mx-5" type="submit"><span class="fw-bold text-white">Upload</span></button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
</body>
</html>