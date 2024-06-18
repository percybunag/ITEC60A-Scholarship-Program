<?php
include 'db_connection.php';

if (isset($_POST['submit'])) {
    $mailrequest = $_POST['email'];
    $check_email = mysqli_query($conn, "SELECT email_address FROM user_info WHERE email_address='$mailrequest'");
    $res = mysqli_num_rows($check_email);
    if ($res > 0) {
        $token = bin2hex(random_bytes(50));
        $insert_token = $conn->prepare("INSERT INTO password_resets (email, token) VALUES (?, ?)");
        $insert_token->bind_param("ss", $mailrequest, $token);
        $insert_token->execute();

        $reset_link = "http://localhost/ITEC60A-master/f3.php?token=" . $token;

        $message = '
        <div>
            <p><b>Hello!</b></p>
            <p>You are receiving this email because we received a password reset request for your account.</p>
            <br>
            <p><a href="' . $reset_link . '">Reset Password</a></p>
            <br>
            <p>If you did not request a password reset, no further action is required.</p>
        </div>';

        include_once("../phpmailer/class.phpmailer.php");
        include_once("../phpmailer/class.smtp.php");

        $mail = new PHPMailer;
        $mail->IsSMTP();
        $mail->SMTPAuth = true;                 
        $mail->SMTPSecure = "tls";      
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587; 
        $mail->Username = "percybunag.gg@gmail.com";
        $mail->Password = "jiin fvnb gseq qrnh";
        $mail->FromName = "City of Imus Scholarship Program";
        $mail->AddAddress($mailrequest);
        $mail->Subject = "Reset Password";
        $mail->isHTML(true);
        $mail->Body = $message;

        if ($mail->send()) {
            header('Location: f2.html'); 
            exit();
        } else {
            $msg = "Mailer Error: " . $mail->ErrorInfo;
        }
    } else {
        $msg = "We can't find a user with that email address";
    }
}
?>
<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scholarship Program | Forget Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="icon" type="png" href="img/Ph_seal_Imus.png">
</head>
<style>
    * {
  padding: 0;
  margin: 0;
}

.bg-img {
  background-image: linear-gradient(to right, rgba(32, 156, 72, .6), rgba(32, 156, 72, .6)), url(../img/newcityhall.jpg);
  background-repeat: no-repeat;
  background-size: cover;
  background-attachment: fixed;
  background-position: center;
  min-height: 100vh;
  width: 100%;
}

.card-body {
  background-color: #EBE6E6;
  border-radius: 15px;
}

.card-body p {
  font-size: medium;
  text-align: center;
}

h1 {
  font-size: larger;
  font-weight: bold;
}

.white {
  border: none;
  border-radius: 15px;
}

form .form-label {
  font-weight: bold;
}

form .form-control {
  border-radius: 10px;
  border: 1px solid #000000;
  transition: border-color 0.3s;
  background-color: #d2d2d2;
}

.Btn1 {
  width: 85px;
  height: 30px;
  background: #D9D9D9;
  border: none;
  outline: none;
  border-radius: 8px;
  font-size: small;
  color: black;
}

.Btn2 {
  width: 85px;
  height: 30px;
  background: #053774;
  border: none;
  outline: none;
  border-radius: 8px;
  font-size: small;
  color: white;
  
}

.container {
  padding-top: 125px;
  padding-bottom: 133px;
}

/* Responsive design for different screen sizes */
@media (max-width: 576px) {
  .bg-img {
      min-height: 170vh;
  }
}

@media (min-width: 577px) and (max-width: 760px) {
  .bg-img {
      min-height: 160vh;
  }
}

@media (min-width: 761px) {
  .bg-img {
      min-height: 100vh;
  }
}

</style>
<body>
<div>
    <div class="bg-img">
      <div class="container">
        <div class="white card p-4 w-100">
            <div class="container-fluid text-center">
                <img src="/ITEC60A/img/Ph_seal_Imus.png" alt="img" width="80px">
                <h1>Find your Account</h1><hr>  
            </div>
            <div class="card-body">
                <p>Please enter your email address so we can send a recovery link to your account.</p>
                <form method="post">
                    <div class="mb-3">
                        <label class="form-label">Email Address:</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="button-container d-flex justify-content-end align-items-end-3 m-3">
                        <a href="login.php" class="Btn1 btn btn-secondary me-2">Cancel</a>
                        <button type="submit" name="submit" class="Btn2 btn btn-primary">Search</button>
                    </div>
                </form>
                <?php if(isset($msg)) { echo '<div class="alert alert-info mt-3">'.$msg.'</div>'; } ?>
            </div>
        </div>
    </div>
</div>
</body>
</html>
