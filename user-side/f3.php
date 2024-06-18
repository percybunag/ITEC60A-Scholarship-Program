<?php
include 'db_connection.php';

if (isset($_GET['token'])) {
    $token = $_GET['token'];
    $query = $conn->prepare("SELECT email FROM password_resets WHERE token = ?");
    $query->bind_param("s", $token);
    $query->execute();
    $result = $query->get_result();
    $msg = "";
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $email = $row['email'];

        if (isset($_POST['submit'])) {
            $new_password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];

            if ($new_password === $confirm_password) {
                // Update the password without hashing
                $update_password = $conn->prepare("UPDATE user SET password = ? WHERE email_address = ?");
                $update_password->bind_param("ss", $new_password, $email);
                if ($update_password->execute()) {
                    // Delete the token after successful password reset
                    $delete_token = $conn->prepare("DELETE FROM password_resets WHERE email = ?");
                    $delete_token->bind_param("s", $email);
                    $delete_token->execute();

                    echo "Password reset successfully!";
                    // Redirect to login page
                    header('Location: login.php');
                    exit();
                } else {
                    echo "Error updating password.";
                }
            } else {
                echo "Passwords do not match.";
            }
        }
    } else {
        $msg = "Invalid or expired token.";
    }
} else {
    $msg = "No token provided.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scholarship Prgoram | Reset Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="icon" type="png" href="img/Ph_seal_Imus.png">
</head>
<style>
    * {
    padding: 0;
    margin: 0;
  }

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

.bg-img{
    background-image: linear-gradient(to right, rgba(32, 156, 72, .6), rgba(32, 156, 72, .6)), url(img/newcityhall.jpg);
    background-repeat: no-repeat;
    background-size: cover;
    background-attachment: fixed;
    background-position: center;
}

.card-body {
    background-color: #EBE6E6;
    border-radius: 15px;
}

.card-body p{
    font-size: medium;
    text-align: center  ;
}
h1{
    font-size: larger;
    font-weight: bold;
}   

.white {
    border: none;
    border-radius: 15px;
  }

form .form-label{
    font-weight: bold;
}

form .form-control {
    border-radius: 10px; 
    border: 1px solid #000000; 
    transition: border-color 0.3s; 
    background-color: #d2d2d2;
  }


.Btn2{
    width: 250px;
    height: 30px;
    background: #053774;
    border: none;
    outline: none;
    border-radius: 8px;
    font-size: small;
    color: white; 
    
}

.container{
    padding-top: 125px;
    padding-bottom: 133px;
    border-radius: 15px;
  }

  .toggle-password {
    position: absolute;
    right: 55px;
    transform: translateY(-50%);
    cursor: pointer;
    padding-bottom: 37px;
  }
  
  .toggle-password img {
    width: 20px;
    height: 20px;
  }
  .error{
    color: red;
    font-weight: 700;
  }
</style>
<body>
<div class="bg-img">
    <div class="container">
        <div class="white card p-4 w-100">
            <div class="container-fluid text-center">
                <img src="img/Ph_seal_Imus.png" alt="img" width="80px">
                <h1>Reset Password</h1><hr>  
            </div>
            <div class="card-body">
                <form method="post">
                    <div class="mb-3">
                        <label for="password" class="form-label">New Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                        <span class="toggle-password">
                            <img src="img/eyes-close.png" id="eyeicon">
                        </span>
                    </div>
                    <div class="mb-3">
                        <label for="confirm_password" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                        <span class="toggle-password">
                            <img src="img/eyes-close.png" id="eyeicon">
                        </span>
                    </div>
                    <p class="error text-center"><?php echo $msg; ?></p>
                    <div class="button-container d-flex justify-content-center align-items-end-3 m-3">
                        <button type="submit" name="submit" class="Btn2 btn btn-primary">Change Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
document.querySelectorAll('.toggle-password').forEach(item => {
    item.addEventListener('click', event => {
        const input = item.previousElementSibling;
        const icon = item.querySelector('img');
        if (input.type === 'password') {
            input.type = 'text';
            icon.src = 'img/eyes-open.png';
        } else {
            input.type = 'password';
            icon.src = 'img/eyes-close.png';
        }
    });
});
</script>
</body>
</html>
