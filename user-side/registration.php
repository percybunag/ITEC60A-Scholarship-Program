<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registration Form</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="icon" type="png" href="/ITEC60A/img/Ph_seal_Imus.png">
</head>
<style>
  .bg-img {
  background-image: linear-gradient(to right, rgba(32, 156, 72, .6), rgba(32, 156, 72, .6)), url(../img/newcityhall.jpg);
  min-height:100vh;
  background-repeat: no-repeat;
  background-size: cover;
  padding-top: 3rem;
  padding-bottom: 4rem;
}


body {
  font-family: 'Montserrat', sans-serif;
  margin: 0;
  padding: 0;
}

.card {
  border-radius: 15px; 
  border: 1px solid #000000; 
  overflow: hidden; 
  padding: 20px; 
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);

}

form .form-control {
  border-radius: 10px; 
  border: 1px solid #000000; 
  transition: border-color 0.3s; 
  background-color: #d2d2d2;
}

.card .form-control:hover,
.card .form-control:focus {
border-color: rgba(32, 156, 72, .6);
border-width: 3px;
outline: none;
}

.container select.form-select {
  border-radius: 10px;
  border: 1px solid #000000;
  background-color: #d2d2d2;
  transition: border-color 0.3s;
}

.container select.form-select:hover {
  border-color: rgba(32, 156, 72, .6);
  border-width: 3px;
  outline: none;
}

.container{
  margin-top: 4rem;
}

form .form-control, 
form .form-select {
border-radius: 10px !important;
border: 1px solid #000000;
padding: 10px;
}

.btn {
  border-radius: 10px;
}

.copyright{
  font-size: 20px;
  font-family: 'Montserrat', sans-serif;
  color:white;
  align-self:center;
  text-align:center;
  margin-top:50px;
}

</style>
<body>
<?php

include 'db_connection.php';

function sanitizeInput($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

$error = "";
$success = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = sanitizeInput($_POST["firstName"]);
    $middleName = sanitizeInput($_POST["middleName"]);
    $lastName = sanitizeInput($_POST["lastName"]);
    $emailAddress = sanitizeInput($_POST["emailAddress"]);
    $gender = sanitizeInput($_POST["gender"]);
    $contactNumber = sanitizeInput($_POST["contactNumber"]);
    $address = sanitizeInput($_POST["address"]);
    $password = sanitizeInput($_POST["Password"]);
    $confirmPassword = sanitizeInput($_POST["ConfirmPassword"]);
    $birthdate = sanitizeInput($_POST["birthdate"]);
    $barangay = sanitizeInput($_POST["barangay"]);

    if ($password !== $confirmPassword) {
        $error = "Passwords do not match.";
    } else {
        $stmt = $conn->prepare("INSERT INTO user (first_name, middle_name, last_name, gender, unit_floor_street, barangay, contact_no, email_address, bdate, `password`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssssss", $firstName, $middleName, $lastName, $gender, $address, $barangay, $contactNumber, $emailAddress, $birthdate, $password);

        if ($stmt->execute()) {
            $success = "Registration successful!";
        } else {
            $error = "Error: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
    }
}
?>
  <div class="bg-img">
    <div class="container">
      <div class="card p-4">
        <center><img src="/ITEC60A/img/Ph_seal_Imus.png" alt="" class="justify-content-center" width="90px"></center>
        <h1 class="text-center mb-3">REGISTRATION</h1>
        <form action="registration.php" method="post">
          <div class="row">
            <!-- Top Layer: First Name, Middle Name, Last Name -->
            <div class="col-12 mb-3">
              <div class="row">
                <div class="col-md-4">
                  <label for="firstName" class="form-label">First Name:</label>
                  <input type="text" class="form-control" id="firstName" name="firstName" placeholder="John" required>
                </div>
                <div class="col-md-4">
                  <label for="middleName" class="form-label">Middle Name:</label>
                  <input type="text" class="form-control" id="middleName" name="middleName" placeholder="Paul" required>
                </div>
                <div class="col-md-4">
                  <label for="lastName" class="form-label">Last Name:</label>
                  <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Doe" required>
                </div>
              </div>
            </div>
            
            <!-- Left Column -->
            <div class="col-md-6">
              <div class="mb-3">
                <label for="emailAddress" class="form-label">Email Address:</label>
                <input type="email" class="form-control" id="emailAddress" name="emailAddress" placeholder="Johndoe@gmail.com">
              </div>
              <div class="mb-3">
                <label for="gender" class="form-label">Gender:</label>
                <select class="form-select" id="gender" name="gender" required>
                  <option value="" selected disabled>Select your gender</option>
                  <option value="Male">Male</option>
                  <option value="Female">Female</option>
                  <option value="Other">Other</option>
                </select>
              </div>
              <div class="mb-3">
                <label for="contactNumber" class="form-label">Contact Number:</label>
                <input type="tel" class="form-control" id="contactNumber" name="contactNumber" placeholder="+1234567890" required pattern="[0-9]+" oninput="validateNumberInput(event)">
              </div>
              <div class="mb-3">
                <label for="address" class="form-label">Unit/Floor/Street:</label>
                <input type="text" class="form-control" id="address" name="address" placeholder="1234 Main St">
              </div>
            </div>
            
            <!-- Right Column -->
            <div class="col-md-6">
              <div class="mb-3">
                <label for="Password" class="form-label">Password:</label>
                <input type="password" class="form-control" id="Password" name="Password" placeholder="Password" required>
              </div>
              <div class="mb-3">
                <label for="confirmPassword" class="form-label">Confirm Password:</label>
                <input type="password" class="form-control" id="confirmPassword" name="ConfirmPassword" placeholder="Confirm Password" required>
              </div>
              <div class="mb-3">
                <label for="birthdate" class="form-label">Birthdate:</label>
                <input type="date" class="form-control" id="birthdate" name="birthdate" required>
              </div>              
              <div class="mb-3">
                <label for="barangay" class="form-label">Barangay:</label>
                <select class="form-select" id="barangay" name="barangay" required>
                  <option value="" selected disabled>Select your barangay</option>
                  <option value="Alapan I-A">Alapan I-A</option>
                  <option value="Alapan I-B">Alapan I-B</option>
                  <option value="Alapan I-C">Alapan I-C</option>
                  <option value="Alapan II-A">Alapan II-A</option>
                  <option value="Alapan II-B">Alapan II-B</option>
                  <option value="Bucandala I">Bucandala I</option>
                  <option value="Bucandala II">Bucandala II</option>
                  <option value="Bucandala III">Bucandala III</option>
                  <option value="Bucandala IV">Bucandala IV</option>
                  <option value="Bucandala V">Bucandala V</option>
                  <option value="Carsadang Bago I">Carsadang Bago I</option>
                  <option value="Carsadang Bago II">Carsadang Bago II</option>
                  <option value="Pag-Asa I">Pag-Asa I</option>
                  <option value="Pag-Asa II">Pag-Asa II</option>
                  <option value="Pag-Asa III">Pag-Asa III</option>
                  <option value="Medicion I-A">Medicion I-A</option>
                  <option value="Medicion I-B">Medicion I-B</option>
                  <option value="Medicion I-C">Medicion I-C</option>
                  <option value="Medicion I-D">Medicion I-D</option>
                  <option value="Medicion II-A">Medicion II-A</option>
                  <option value="Medicion II-B">Medicion II-B</option>
                  <option value="Medicion II-C">Medicion II-C</option>
                  <option value="Medicion II-D">Medicion II-D</option>
                  <option value="Medicion II-E">Medicion II-E</option>
                  <option value="Medicion II-F">Medicion II-F</option>
                  <option value="Anabu I-A">Anabu I-A</option>
                  <option value="Anabu I-B">Anabu I-B</option>
                  <option value="Anabu I-C">Anabu I-C</option>
                  <option value="Anabu I-D">Anabu I-D</option>
                  <option value="Anabu I-E">Anabu I-E</option>
                  <option value="Anabu I-F">Anabu I-F</option>
                  <option value="Anabu I-G">Anabu I-G</option>
                  <option value="Anabu II-A">Anabu II-A</option>
                  <option value="Anabu II-B">Anabu II-B</option>
                  <option value="Anabu II-C">Anabu II-C</option>
                  <option value="Anabu II-D">Anabu II-D</option>
                  <option value="Anabu II-E">Anabu II-E</option>
                  <option value="Anabu II-F">Anabu II-F</option>
                  <option value="Bayan Luma I">Bayan Luma I</option>
                  <option value="Bayan Luma II">Bayan Luma II</option>
                  <option value="Bayan Luma III">Bayan Luma III</option>
                  <option value="Bayan Luma IV">Bayan Luma IV</option>
                  <option value="Bayan Luma V">Bayan Luma V</option>
                  <option value="Bayan Luma VI">Bayan Luma VI</option>
                  <option value="Bayan Luma VII">Bayan Luma VII</option>
                  <option value="Bayan Luma VIII">Bayan Luma VIII</option>
                  <option value="Bayan Luma IX">Bayan Luma IX</option>
                  <option value="Bagong Silang">Bagong Silang</option>
                  <option value="Magdalo">Magdalo</option>
                  <option value="Maharlika">Maharlika</option>
                  <option value="Mariano Espeleta I">Mariano Espeleta I</option>
                  <option value="Mariano Espeleta II">Mariano Espeleta II</option>
                  <option value="Mariano Espeleta III">Mariano Espeleta III</option>
                  <option value="Pinagbuklod">Pinagbuklod</option>
                  <option value="Pasong Buaya I">Pasong Buaya I</option>
                  <option value="Pasong Buaya II">Pasong Buaya II</option>
                  <option value="Buhay Na Tubig">Buhay Na Tubig</option>
                  <option value="Palico I">Palico I</option>
                  <option value="Palico II">Palico II</option>
                  <option value="Palico III">Palico III</option>
                  <option value="Palico IV">Palico IV</option>
                  <option value="Tanzang Luma I">Tanzang Luma I</option>
                  <option value="Tanzang Luma II">Tanzang Luma II</option>
                  <option value="Tanzang Luma III">Tanzang Luma III</option>
                  <option value="Tanzang Luma IV">Tanzang Luma IV</option>
                  <option value="Tanzang Luma V">Tanzang Luma V</option>
                  <option value="Tanzang Luma VI">Tanzang Luma VI</option>
                  <option value="Poblacion I-A">Poblacion I-A</option>
                  <option value="Poblacion I-B">Poblacion I-B</option>
                  <option value="Poblacion I-C">Poblacion I-C</option>
                  <option value="Poblacion II-A">Poblacion II-A</option>
                  <option value="Poblacion II-B">Poblacion II-B</option>
                  <option value="Poblacion III-A">Poblacion III-A</option>
                  <option value="Poblacion III-B">Poblacion III-B</option>
                  <option value="Poblacion IV-A">Poblacion IV-A</option>
                  <option value="Poblacion IV-B">Poblacion IV-B</option>
                  <option value="Poblacion IV-C">Poblacion IV-C</option>
                  <option value="Poblacion IV-D">Poblacion IV-D</option>
                  <option value="Toclong I-A">Toclong I-A</option>
                  <option value="Toclong I-B">Toclong I-B</option>
                  <option value="Toclong I-C">Toclong I-C</option>
                  <option value="Toclong II-A">Toclong II-A</option>
                  <option value="Toclong II-B">Toclong II-B</option>
                  <option value="Malagasang I-A">Malagasang I-A</option>
                  <option value="Malagasang I-B">Malagasang I-B</option>
                  <option value="Malagasang I-C">Malagasang I-C</option>
                  <option value="Malagasang I-D">Malagasang I-D</option>
                  <option value="Malagasang I-E">Malagasang I-E</option>
                  <option value="Malagasang I-F">Malagasang I-F</option>
                  <option value="Malagasang I-G">Malagasang I-G</option>
                  <option value="Malagasang II-A">Malagasang II-A</option>
                  <option value="Malagasang II-B">Malagasang II-B</option>
                  <option value="Malagasang II-C">Malagasang II-C</option>
                  <option value="Malagasang II-D">Malagasang II-D</option>
                  <option value="Malagasang II-E">Malagasang II-E</option>
                  <option value="Malagasang II-F">Malagasang II-F</option>
                  <option value="Malagasang II-G">Malagasang II-G</option>
                </select>
              </div>
            </div>
          </div>
          <?php if (!empty($error)): ?>
            <div class="alert alert-danger text-center" role="alert">
              <?php echo $error; ?>
            </div>
          <?php elseif (!empty($success)): ?>
            <div class="alert alert-success text-center" role="alert">
              <?php echo $success; ?>
            </div>
          <?php endif; ?>
          <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-primary me-2">Sign Up</button>
            <a href="login.php" class="btn btn-secondary">Cancel</a>
          </div>
        </form>
      </div>
      <p class="copyright">City of Imus | Office of Scholarship Program © 2024 All Rights Reserved Terms of Use and Privacy Policy</p>
    </div>
  </div>
  <script>
    function validateNumberInput(event) {
      const input = event.target;
      input.value = input.value.replace(/[^0-9]/g, '');
    }
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
