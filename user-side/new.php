<?php
session_start();

if (!isset($_SESSION['user_data'])) {
    header("Location: login.php");
    exit();
}

$user_data = $_SESSION['user_data'];
$user_details = getUserDetailsFromDb($user_data['user_id']);

function getUserDetailsFromDb($user_id) {
    include 'db_connection.php';

    $sql = "SELECT first_name, middle_name, last_name, gender, unit_floor_street, barangay, contact_no, email_address, bdate FROM user WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user_details = $result->fetch_assoc();

    return $user_details;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    processFormData();
}

function processFormData() {
    include 'db_connection.php';

    // Sanitize and retrieve form data
    $formData = [];
    foreach ($_POST as $key => $value) {
        $formData[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_STRING);
    }

    // Assuming your form fields are named accordingly
    $first_name = $formData['first_name'];
    $middle_name = $formData['middle_name'];
    $last_name = $formData['last_name'];
    $gender = $formData['gender'];
    $unit_floor_street = $formData['unit_floor_street'];
    $barangay = $formData['barangay'];
    $contact_no = $formData['contact_no'];
    $email_address = $formData['email_address'];
    $bdate = $formData['bdate'];
    // Add more fields as necessary

    // Prepare SQL statement to insert data
    $sql = "INSERT INTO scholarship_applications (first_name, middle_name, last_name, gender, unit_floor_street, barangay, contact_no, email_address, bdate) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssss", $first_name, $middle_name, $last_name, $gender, $unit_floor_street, $barangay, $contact_no, $email_address, $bdate);

    if ($stmt->execute()) {
        echo "Application submitted successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <title>City Government of Imus | Dashboard</title>
</head>
<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <aside id="sidebar">
            <div class="h-100">
                <div class="sidebar-img">
                    <img src="../img/Ph_seal_Imus.png" width="100px"  alt="">
                </div>
                <div class="sidebar-usertext">
                    <p><?php echo htmlspecialchars($user_details['first_name']) . " " . htmlspecialchars($user_details['last_name']); ?></p>
                </div>
            </div>
        </aside>

        <div class="content">
            <form id="multiStepForm" method="POST" action="applyscholarship.php">
                <!-- Multi-step form fields -->
                <!-- Example Step 1 -->
                <div class="step">
                    <h2>Step 1: Personal Information</h2>
                    <input type="text" name="first_name" placeholder="First Name" required>
                    <input type="text" name="middle_name" placeholder="Middle Name" required>
                    <input type="text" name="last_name" placeholder="Last Name" required>
                    <input type="text" name="gender" placeholder="Gender" required>
                    <!-- Add more fields as necessary -->
                    <button type="button" class="next-step">Next</button>
                </div>
                <!-- Example Step 2 -->
                <div class="step">
                    <h2>Step 2: Contact Information</h2>
                    <input type="text" name="unit_floor_street" placeholder="Unit/Floor/Street" required>
                    <input type="text" name="barangay" placeholder="Barangay" required>
                    <input type="text" name="contact_no" placeholder="Contact Number" required>
                    <input type="email" name="email_address" placeholder="Email Address" required>
                    <input type="text" name="bdate" placeholder="Birthdate" required>
                    <!-- Add more fields as necessary -->
                    <button type="button" class="prev-step">Previous</button>
                    <button type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        // JavaScript for handling the multi-step form navigation
        const steps = document.querySelectorAll('.step');
        const nextButtons = document.querySelectorAll('.next-step');
        const prevButtons = document.querySelectorAll('.prev-step');
        let currentStep = 0;

        nextButtons.forEach(button => {
            button.addEventListener('click', () => {
                steps[currentStep].style.display = 'none';
                currentStep++;
                steps[currentStep].style.display = 'block';
            });
        });

        prevButtons.forEach(button => {
            button.addEventListener('click', () => {
                steps[currentStep].style.display = 'none';
                currentStep--;
                steps[currentStep].style.display = 'block';
            });
        });

        steps.forEach((step, index) => {
            if (index !== currentStep) {
                step.style.display = 'none';
            }
        });
    </script>
</body>
</html>
