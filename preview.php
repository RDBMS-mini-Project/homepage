<?php

//connection DB
$servername = "localhost";
$username = "root";
$password = "";
$database = "chathravaas";

$conn = mysqli_connect($servername, $username, $password, $database);

// Check the connection
if (!$conn) 
{
    die("Sorry, we failed to connect: " . mysqli_connect_error());
} 
else 
{
    $hostel = $_GET['hos'];
    $query="SELECT * FROM hostel_reg WHERE hostel_id=$hostel";
    $result = mysqli_query($conn, $query);
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Show details button</title>
  <link rel="icon" href="https://thumbs.dreamstime.com/z/hospital-building-flat-icon-round-colorful-button-clinic-circular-vector-sign-logo-illustration-style-design-95615497.jpg">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"> 
  <script src="https://kit.fontawesome.com/53df15e087.js" crossorigin="anonymous"></script>
</head>

<body>

  <nav class="navbar navbar-expand-lg bg-body-tertiary mb-5 bavBarr">
    <div class="container-lg">
      <a class="navbar-brand" href="#intro"><span class="fw-bold display-5 text-secondary"><i class="bi bi-houses-fill"></i> Chathravaas</span></a>
    </div>
  </nav>

  <div class="container-md">
    <div class="row justify-content-center align-items-center">
    <?php
        $row = mysqli_fetch_assoc($result);
        $image1 = $row['image1'];
        $image2 = $row['image2'];
        $image3 = $row['image3'];
        $hostel_id = $row['hostel_id'];
        $hostel_name = $row['hostel_name'];
        $rent = $row['rent'];
        $distance = $row['distance'];
        $address = $row['hostel_address'];
        $gender = $row['gender'];
        $wifi = $row['wifi'];
        $generator = $row['generator'];
        $cctv = $row['cctv'];
        $cleaner = $row['cleaner'];
        $furniture = $row['furniture'];
        $parking = $row['parking'];
        $balcony = $row['balcony'];

      ?>

      <div class="col-md-8">

        <!-- Image Slide -->
        <div id="carouselExampleIndicators" class="carousel slide">
          <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
          </div>
          <div class="carousel-inner rounded-4 shadow">
            <div class="carousel-item active">
              <img  src="Loc/<?php echo $image1; ?>" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
              <img  src="Loc/<?php echo $image2; ?>" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
              <img src="Loc/<?php echo $image3; ?>" class="d-block w-100" alt="...">
            </div>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>

      </div>
    </div>
    <div class="row justify-content-center align-items-center">
    <div class="col-md-7 justify-content-start align-items-start">
    <div class="card my-4 shadow">
        <div class="card-body text-center">
            <!-- Row inside Card -->
            <div class="row">
                <?php if ($gender == 1) { ?>
                    <div class="col-md-6 text-start"><h5 class="d-inline-flex p-1 border border-warning rounded-2 ">Men's</h5></div>
                <?php } elseif ($gender == 2) { ?>
                    <div class="col-md-6 text-start"><h5 class="d-inline-flex p-1 border border-warning rounded-2 ">Women's</h5></div>
                <?php } ?>
                <div class="col-md-6 text-end"><h5>&#x20b9;<?php echo $rent; ?>/Month</h5></div>
            </div>
            <hr>
            <h5 class="mb-3"><?php echo $hostel_name; ?></h5>
            <p class="text-muted mb-4"><?php echo $address; ?></p>
        </div>
    </div>
</div>

    </div>
<!-- FACILITIES -->
<div class="row justify-content-center align-items-center mb-5">
    <div class="col-md-7">
        <div class="card mb-4 shadow">
            <div class="card-body text-center">
                <h4 class="text-start">Facilities</h4>
                <p class="text-muted text-start">Provided by hostel</p>
                <div class="row g-5">

                    <?php if ($wifi == 1) { ?>
                        <div class="col-md-4">
                            <span class="h5 fw-bold d-block"> WiFi </span><span class="display-6"><i class="fa-solid fa-wifi"></i></span>
                        </div>
                    <?php } ?>

                    <?php if ($cctv == 1) { ?>
                        <div class="col-md-4">
                            <span class="h5 fw-bold  d-block"> CCTV </span><span class="display-6"><i class="fa-solid fa-video"></i></span>
                        </div>
                    <?php } ?>

                    <?php if ($cleaner == 1) { ?>
                        <div class="col-md-4">
                            <span class="h5 fw-bold  d-block"> Cleaning </span><span class="display-6 "><i class="fa-solid fa-broom"></i></span>
                        </div>
                    <?php } ?>

                    <?php if ($furniture == 1) { ?>
                        <div class="col-md-4">
                            <span class="h5 fw-bold  d-block"> Furniture </span><span class="display-6"><i class="fa-solid fa-couch"></i></span>
                        </div>
                    <?php } ?>

                    <?php if ($parking == 1) { ?>
                        <div class="col-md-4">
                            <span class="h5 fw-bold  d-block"> Car Parking </span><span class="display-6"><i class="fa-solid fa-square-parking"></i></span>
                        </div>
                    <?php } ?>

                    <?php if ($generator == 1) { ?>
                        <div class="col-md-4 mb-5">
                            <span class="h5 fw-bold  d-block">Generator</span><span class="display-6"><i class="fa-solid fa-plug-circle-bolt"></i></span>
                        </div>
                    <?php } ?>

                </div>
            </div>
        </div>

    </div>
</div>
</div>
  <footer class="mt-5 p-5 bg-body-tertiary">

  </footer>
 
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

</body>
</html>







    