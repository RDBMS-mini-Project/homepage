<!DOCTYPE html> 
<html lang="en"> 
<head> 
  <meta charset="UTF-8"> 
  <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
  <title>login</title> 
 
  <link rel="icon" href="https://thumbs.dreamstime.com/z/hospital-building-flat-icon-round-colorful-button-clinic-circular-vector-sign-logo-illustration-style-design-95615497.jpg"> 
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> 
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">  
</head> 
<body class="bg-body-tertiary py-5"> 

  <nav class="navbar navbar-expand-lg bg-body-tertiary navBarrr mb-5"> 
    <div class="container-lg"> 
      <a class="navbar-brand" href="index.php"><span class="fw-bold display-5 text-secondary"><i class="bi bi-houses-fill"></i> Chathravaas</span></a>  
          
  </nav>
  <section> 
 
    <p class="display-5 text-center mt-5 text-muted fw-bold">Login</p> 
 
    <div class="container-md bg-body-tertiary my-5 py-5"> 
      <div class="row justify-content-center align-items-center "> 
        <div class="col-4"> 
           
          <form action="login.php" method="post"> 
            <!-- Email input --> 
            <div class="form-outline mb-5"> 
              <input type="text" id="user-name" name="user-name" class="form-control" placeholder="User Name" /> 
            </div> 
           
            <!-- Password input --> 
            <div class="form-outline mb-5"> 
              <input type="password" id="password" name="pass" class="form-control" placeholder="Password" /> 
            </div> 
           
             
            <div class="row mb-4"> 
              <div class="col d-flex justify-content-center"> 
                 
              </div> 
           
           
            <!-- Login button --> 
            <button type="submit" name="save" class="btn btn-warning btn-block mb-4" href="/chatravaas/login.php" ><span class="fw-bold text-white">Log In</span></button> 
            <!-- Register buttons --> 
            <div class="text-center"> 
              <p>Not a member? <a href="sign-up.html">Register</a></p> 
            </div> 
          </form> 
 
        </div> 
      </div> 
    </div> 
 
  </section> 
</body> 

</html>