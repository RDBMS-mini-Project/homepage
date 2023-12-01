<?php
// Connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$database = "chathravaas";

// Connect to the database
$conn = mysqli_connect($servername, $username, $password, $database);

// Check the connection
if (!$conn) {
    die("Sorry, we failed to connect: " . mysqli_connect_error());
}

// Fetch colleges from the database
$sql = "SELECT college_name FROM colleges";
$result = mysqli_query($conn, $sql);

// Array to store college names
$colleges = array();

// Check if data was fetched successfully
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $colleges[] = $row['college_name'];
    }
}
?>



<!DOCTYPE html> 
<html> 
<head> 
  <title>Home Page - Chathravaas</title> 
  <link rel="icon" href="https://thumbs.dreamstime.com/z/hospital-building-flat-icon-round-colorful-button-clinic-circular-vector-sign-logo-illustration-style-design-95615497.jpg"> 
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> 
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">  
 
  <style> 
    section{ 
      padding: 60px 0; 
    } 
 
    .find{ 
      margin-bottom: 6%; 
    } 
 
    .explore{ 
      margin-top: -35%; 
    } 
 
    .navBarrr{ 
      margin-bottom:12%; 
    } 
 
  </style> 
 
</head> 
<body> 
 
  <nav class="navbar navbar-expand-lg bg-body-tertiary navBarrr"> 
    <div class="container-lg"> 
      <a class="navbar-brand" href="#intro"><span class="fw-bold display-5 text-secondary"><i class="bi bi-houses-fill"></i> Chathravaas</span></a> 
 
       
      <!-- toggle Button For mobile Nav --> 
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main-nav" aria-controls="main-nav" aria-expanded="false" aria-label="Toggle navigation"> 
        <span class="navbar-toggler-icon"></span> 
      </button> 
 
 
      <!-- navbar links --> 
      <div class="collapse navbar-collapse justify-content-end align-items-center" id="main-nav"> 
        <ul class="navbar-nav"> 
          <li class="nav-item align-items me-5"> 
            <a class="nav-link btn btn-warning d-block d-nd-inline-block" href="login_page.php">Log in</a> 
          </li> 
          <li class="nav-item align-items"> 
            <a class="nav-link btn btn-warning d-block d-md-inline-block" href="sign-up.html">Register as owner</a> 
          </li> 
        </ul> 
      </div> 
    </div> 
  </nav> 
 
  <div class="container-md"> 
 
    <p class="text-muted display-5 fw-bold find text-center my-5 me-5 ">Find Hostels and PGs which suits you</p> 
    <div class="row justify-content-center align-items-center"> 
     <div class="col-md-4 mb-5"> 
        <div class="justify-content-center" style="width:auto;"> 
          <select id="col" class="form-select form-select-lg mb-3 me-5 " aria-label=".form-select-lg example"> 
            <option selected>Choose College</option> 
            <?php foreach ($colleges as $college) { ?>
              <option value="<?php echo $college; ?>"><?php echo $college; ?></option>
            <?php } ?>
          </select> 
        </div> 
      </div> 
      
     <div class="col-md-3 mb-5"> 
        <div class="justify-content-center" style="width:auto;"> 
          <select id="hos" class="form-select form-select-lg mb-3 me-5 " aria-label=".form-select-lg example"> 
            <option selected>Choose Hostel or PG</option> 
            <option value="1">Hostel</option> 
            <option value="2">Paying Guest</option> 
          </select> 
        </div> 
      </div> 
 
        <div class="col-md-2 mb-5"> 
          <div class="justify-content-center" style="width:auto;"> 
            <select id="gen" class="form-select form-select-lg mb-3 me-5 " aria-label=".form-select-lg example"> 
              <option selected>Choose Gender</option> 
              <option value="1">Men's</option> 
              <option value="2">Women's</option> 
            </select> 
          </div> 
        </div> 
 
      <div onclick="redirect()" class="col-md-2 col-xs-justify-item-center"> 
         <button class="btn btn-lg btn-warning explore">Explore</button> 
      </div> 
      
  </div> 
  </div> 
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> 
</body> 

<script>
  function redirect(){
    const col = document.getElementById('col').value
    const hos = document.getElementById('hos').value
    const gen = document.getElementById('gen').value
    window.location.href = `userdisplay.php?col=${col}&hos=${hos}&gen=${gen}`
  }
</script>
</html>


