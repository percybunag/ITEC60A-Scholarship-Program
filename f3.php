<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_scholarship";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

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
    <title>Reset Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="f3.css">
    <link rel="icon" type="png" href="img/Ph_seal_Imus.png">
</head>
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
