<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Scholarship Program | Login</title>
  <link rel="stylesheet" href="loginphp.css">
  <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<?php
   $servername = "localhost";
   $username = "root";
   $password = "";
   $dbname = "db_scholarship";

   $conn = new mysqli($servername, $username, $password, $dbname);

   if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
   }

   $msg = ""; 

   if (isset($_POST["submit"])) {
     $email_add = $_POST["username"];
     $password = $_POST["password"];

     $stmt = $conn->prepare("SELECT email_address, `password` FROM user WHERE email_address = ? AND `password` = ?");
     $stmt->bind_param("ss", $email_add, $password);
     $stmt->execute();

     $stmt->store_result();

     if ($stmt->num_rows > 0) {
       header("Location: dashboard.html");
       exit();
     } else {
       $msg = "Invalid Credentials";
     }

     $stmt->close();
   }

   $conn->close();
 ?>
  <div class="bg-img">
      <div class="container">
          <div class="white card p-4 w-100">
              <div class="container-fluid text-center">
                  <a href="index.html">
                      <img src="img/Ph_seal_Imus.png" class="img-fluid p-2" alt="">
                  </a>
                  <h1 class="text-header">Member Login</h1>
              </div>
              <div class="card-body">
                  <form action="" method="post">
                      <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                      </div>
                      <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                        <span class="toggle-password">
                          <img src="img/eyes-close.png" id="eyeicon">
                        </span>
                      </div>
                      <div class="row d-flex">
                        <div class="col-md-6 d-flex justify-content-start">Don't have account yet?
                          <a href="registration.php">Register Here!</a>
                        </div>
                        <div class="right-content col-md-6 d-flex justify-content-end ">Forgot your password?
                          <a href="forgetpass.php">Retrieve it here!</a>
                        </div>
                      </div>
                      <br>
                      <p class="error text-center"><?php echo $msg; ?></p>
                      <div class="button-container">
                          <button type="submit" name="submit" class="Btn2">Login</button><br>
                        </div>
                    </form>
              </div>
          </div>
      </div>
      <div class=" footer-container d-flex justify-content-center text-center p-4">
        <div class="col-md">City of Imus | Office of Scholarship Program © 2024 All Rights Reserved Terms of Use and Privacy Policy</div>
      </div>
  </div>
  
<script>
let eyeicon = document.getElementById("eyeicon");
let password = document.getElementById("password");

eyeicon.onclick = function(){
    if(password.type == "password"){
        password.type = "text";
        eyeicon.src = "img/eyes-open.png";
    }else{
        password.type = "password";
        eyeicon.src = "img/eyes-close.png";
    }
}
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>