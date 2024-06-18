<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_data'])) {
    header("Location: login.php");
    exit();
}

$user_data = $_SESSION['user_data'];

// Function to get user details from database
function getUserDetailsFromDb($user_id) {
    include 'db_connection.php';

    $sql = "SELECT first_name, middle_name, last_name, gender, unit_floor_street, barangay, contact_no, email_address, bdate FROM user WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user_details = $result->fetch_assoc();

    $stmt->close();
    $conn->close();

    return $user_details;
}

$user_details = getUserDetailsFromDb($user_data['user_id']);

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
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
  />
    <link rel="stylesheet" href="/ITEC60A/user-side/apply.css">
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
                    <h3>Hi, <?php echo htmlspecialchars($user_data['first_name']); ?>!</h3>
                </div>
                <!-- Sidebar Navigation -->
                <ul class="sidebar-nav">
                    <li class="sidebar-header">
                        Interface
                        <hr>
                    </li>
                    <li class="sidebar-item">
                        <a href="dashboard.php" class="sidebar-link">
                            <i class="fa-solid fa-list pe-2"></i>
                            Dashboard
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="applyscholarship.html" class="sidebar-link">
                            <i class="fa-solid fa-user-gear"></i>
                            Apply Scholarship
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link">
                            <i class="fa-regular fa-copy"></i>
                            Scholarship List
                        </a>
                    </li>

                </ul>
            </div>
        </aside>
        <!-- Main Component -->
        <div class="main">
            <nav class="navbar navbar-expand px-3 border-bottom">
                <!-- Button for sidebar toggle -->
                <button class="btn" type="button" data-bs-theme="dark">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="img-icon mx-2">
                    <img src="../img/Ph_seal_Imus.png" width="70px"alt="">
                </div>
                <div class="header-text mx-2">  
                    <div class="first-header">
                    City Government of Imus
                    </div>
                    <div class="second-header">
                    Office of the Scholarship Program
                    </div>
                    <div class="third-header">
                    Imus Municipal Hall, Maestro G., City of Imus, Cavite
                    </div>
                    <div class="third-header">
                    Contact Number: (046) 888 9910
                    </div>
                </div>
                <div class="profile-dropdown">
                    <div onclick="toggle()" class="profile-dropdown-btn">
            
                      <span
                        >Menu
                        <i class="fa-solid fa-angle-down"></i>
                      </span>
                    </div>
            
                    <ul class="profile-dropdown-list">
                      <li class="profile-dropdown-list-item">
                        <a href="myprofile.php">
                          <i class="fa-regular fa-user"></i>
                          My Profile
                        </a>
                      </li>
            
                      <li class="profile-dropdown-list-item">
                        <a href="#">
                          <i class="fa-regular fa-envelope"></i>
                          My Applications
                        </a>
                    </li>
                      <li class="profile-dropdown-list-item">
                        <a href="logout.php">
                          <i class="fa-solid fa-arrow-right-from-bracket"></i>
                          Log out
                        </a>
                      </li>
                    </ul>
                </div>
            </nav>
            <main class="content">
                <div class="rectangle">
                    <p>Dashboard / Apply Scholarship / </p>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="multistep-container">
                                <ul class="active-button">
                                    <li class="active">
                                        <span class="round-btn">1</span>
                                    </li>
                                    <li>
                                        <span class="round-btn">2</span>
                                    </li>
                                    <li>
                                        <span class="round-btn">3</span>
                                    </li>
                                    <li>
                                        <span class="round-btn">4</span>
                                    </li>
                                    <li>
                                        <span class="round-btn">5</span>
                                    </li>
                                </ul>
                                <div class="multistep-form-area p-5 g-3">
                                    <!--Step 1-->
                                    <div class="form-box step active">
                                        <h4>PERSONAL INFORMATION</h4>
                                        <form action="process.php" method="POST">
                                            <div class="row mb-4">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="firstname">First Name</label>
                                                        <input type="text" name="firstname" placeholder="First Name" required
                                                            id="firstname" value=<?php echo htmlspecialchars($user_details['first_name']); ?> class="form-control" required >
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="middlename">Middle Name</label>
                                                        <input type="text" name="middlename" placeholder="Middle Name"
                                                            id="middlename" value=<?php echo htmlspecialchars($user_details['middle_name']); ?> class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="lastname">Last Name</label>
                                                        <input type="text" name="lastname" placeholder="Last Name"
                                                            id="lastname" value=<?php echo htmlspecialchars($user_details['last_name']); ?> class="form-control" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-4">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="gender">Gender</label>
                                                        <select name="gender" id="gender" class="form-control" required>
                                                            <option value="">Select Gender</option>
                                                            <option value="male"<?php echo ($user_details['gender'] == 'Male') ? 'selected' : ''; ?>>Male</option>
                                                            <option value="female"<?php echo ($user_details['gender'] == 'Female') ? 'selected' : ''; ?>>Female</option>
                                                            <option value="other"<?php echo ($user_details['gender'] == 'Other') ? 'selected' : ''; ?>>Other</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="birthdate">Birthdate</label>
                                                        <input type="date" name="birthdate" id="birthdate"
                                                            value="<?php echo htmlspecialchars($user_details['bdate']); ?>" class="form-control" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-4">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="educationalstatus">Educational Status</label>
                                                        <select name="educationalstatus" id="educationalstatus" class="form-control" required>
                                                            <option value="" disabled selected>Select Grade/Year Level</option>
                                                            <option value="G7">Grade 7</option>
                                                            <option value="G8">Grade 8</option>
                                                            <option value="G9">Grade 9</option>
                                                            <option value="G10">Grade 10</option>
                                                            <option value="G11">Grade 11</option>
                                                            <option value="G12">Grade 12</option>
                                                            <option value="1Y">College - First Year</option>
                                                            <option value="2Y">College - Second Year</option>
                                                            <option value="3Y">College - Third Year</option>
                                                            <option value="4Y">College - Fourth Year</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="gwa">General Weighted Average</label>
                                                        <input type="text" name="gwa" placeholder="GWA" id="gwa"
                                                            class="form-control" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-4">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="schoolname">School Name</label>
                                                        <input type="text" name="schoolname"
                                                            placeholder="Name of the School" id="schoolname"
                                                            class="form-control" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="button-row">
                                                <button type="button" name="submit" class="next btn btn-primary">Next</button>
                                            </div>
                                        </form>
                                    <!--Step 2-->
                                    <div class="form-box step">
                                        <h4>RESIDENCY</h4>
                                        <form id="form2"action="">
                                            <div class="row my-4">
                                                <div class="col-md-12 mb-4">
                                                    <div class="form-group">
                                                        <label for="address">Permanent Address</label>
                                                        <input type="email" name="address" placeholder="Address" id="address"
                                                            class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="monthsyears">Date of Residency:</label>
                                                        <input type="month" name="monthyears" id="monthyears" class="form-control" required>
                                                    </div>
                                                </div>                                                
                                            </div>
                                            <div class="row mb-4">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label>Are you and your parents Imus City registered voter/s?</label>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <label class="radio-inline">
                                                                    <input type="radio" name="response" value="yes" >
                                                                    Yes
                                                                </label>        
                                                            </div>
                                                            <div class="col-md-2">     
                                                                <label class="radio-inline">
                                                                    <input type="radio" name="response" value="no">
                                                                    No
                                                                </label>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <label class="radio-inline">
                                                                    <input type="radio" name="response" value="guardian">
                                                                    Guardian
                                                                </label>
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-4">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <label>If yes/guardian, how long(Months)?</label>&nbsp;
                                                            </div>
                                                            <div class="col-md-2">
                                                                Father:
                                                                <input type="number" name="father" id="father" class="form-control">
                                                            </div>
                                                            <div class="col-md-2">
                                                                Mother:
                                                                <input type="number" name="father" id="mother" class="form-control">
                                                            </div>
                                                            <div class="col-md-2">
                                                                Applicant:
                                                                <input type="number" name="father" id="applicant" class="form-control">
                                                            </div>
                                                            <div class="col-md-2">
                                                                Guardian:
                                                                <input type="number" name="father" id="guardian" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-4">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label for="guardian-name">
                                                                    If parents is not present, please indicate the name of Guadian(optional):
                                                                </label>
                                                            </div>
                                                            <div class="col-md-6">
                                                             <input type="text" name="guardian-name" id="guardian-name" placeholder="Enter guardian's name." class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="row mb-4">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <label for="relation-guardian">Relation to the guardian:</label>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <input type="text" name="relation-guardian" id="relation-guardian" placeholder="Enter here  " class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-4">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <label for="address-guardian">Address of the guardian:</label>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <input type="text" name="adress-guardian" id="address-guardian" placeholder="Enter here  " class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-4">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <label for="contact-guardian">Contact Number of the Guardian:</label>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <input type="text" name="contact-guardian" id="contact-guardian" placeholder="Enter here  " class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="button-row">
                                                <button type="button" class="btn btn-primary previous-btn me-2">Previous</button>
                                                <button type="button" class="next btn btn-primary">Next</button>
                                            </div>
      
                                        </form>
                                    </div>
                                    <!--Step 3-->
                                    <div class="form-box step">
                                        <h4>FAMILY BACKGROUND</h4>
                                        <form action="#final" >
                                            <div class="row">
                                                <!-- Father Section -->
                                                <div class="col-md-6">
                                                    <div class="form-section">
                                                        <h1 class="father-header">FATHER</h1>
                                                        <div class="row mb-3">
                                                            <label for="father-name" class="col-sm-4 col-form-label">Name:</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control" id="father-name" name="father_name" required>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <label for="father-homeaddress" class="col-sm-4 col-form-label">Home Address:</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control" id="father-homeaddress" name="father_homeaddress" required>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <label for="father-contactno" class="col-sm-4 col-form-label">Contact No.:</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control" id="father-contactno" name="father_contactno" required>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <label for="father-occupation" class="col-sm-4 col-form-label">Present Occupation:</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control" id="father-occupation" name="father_occupation" required>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <label for="father-officeaddress" class="col-sm-4 col-form-label">Office Address (Optional):</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control" id="father-officeaddress" name="father_officeaddress">
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <label for="father-telno" class="col-sm-4 col-form-label">Tel No.:</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control" id="father-telno" name="father_telno">
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                          <div class="col-sm-3">
                                                              <label for="father-age" class="col-form-label">Age:</label>
                                                          </div>
                                                          <div class="col-sm-3">
                                                              <input type="number" class="form-control" id="father-age" name="father_age" required>
                                                          </div>
                                                          <div class="col-sm-2">
                                                              <label for="father-dob" class="col-form-label">Date of Birth:</label>
                                                          </div>
                                                          <div class="col-sm-4">
                                                              <input type="date" class="form-control" id="father-dob" name="father_dob" required>
                                                          </div>
                                                      </div>                                                                    
                                                        <div class="row mb-3">
                                                            <label for="father-citizenship" class="col-sm-4 col-form-label">Citizenship:</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control" id="father-citizenship" name="father_citizenship" required>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <label for="father-religion" class="col-sm-4 col-form-label">Religion:</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control" id="father-religion" name="father_religion" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Mother Section -->
                                                <div class="col-md-6">
                                                    <div class="form-section">
                                                        <h1 class="mother-header">MOTHER</h1>
                                                        <div class="row mb-3">
                                                            <label for="mother-name" class="col-sm-4 col-form-label">Name:</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control" id="mother-name" name="mother_name" required>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <label for="mother-homeaddress" class="col-sm-4 col-form-label">Home Address:</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control" id="mother-homeaddress" name="mother_homeaddress" required>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <label for="mother-contactno" class="col-sm-4 col-form-label">Contact No.:</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control" id="mother-contactno" name="mother_contactno" required>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <label for="mother-occupation" class="col-sm-4 col-form-label">Present Occupation:</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control" id="mother-occupation" name="mother_occupation" required>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <label for="mother-officeaddress" class="col-sm-4 col-form-label">Office Address (Optional):</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control" id="mother-officeaddress" name="mother_officeaddress">
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <label for="mother-telno" class="col-sm-4 col-form-label">Tel No.:</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control" id="mother-telno" name="mother_telno">
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                          <div class="col-sm-3">
                                                              <label for="father-age" class="col-form-label">Age:</label>
                                                          </div>
                                                          <div class="col-sm-3">
                                                              <input type="number" class="form-control" id="father-age" name="father_age" required>
                                                          </div>
                                                          <div class="col-sm-2">
                                                              <label for="father-dob" class="col-form-label">Date of Birth:</label>
                                                          </div>
                                                          <div class="col-sm-4">
                                                              <input type="date" class="form-control" id="father-dob" name="father_dob" required>
                                                          </div>
                                                      </div>
                                                        <div class="row mb-3">
                                                            <label for="mother-citizenship" class="col-sm-4 col-form-label">Citizenship:</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control" id="mother-citizenship" name="mother_citizenship" required>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <label for="mother-religion" class="col-sm-4 col-form-label">Religion:</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control" id="mother-religion" name="mother_religion" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="button-row">
                                                <button type="button" class="btn btn-primary previous-btn me-2">Previous</button>
                                                <button type="button" class="next btn btn-primary">Next</button>
                                            </div>
                                        </form> 
                                    </div>                        
                                    <!--Step 4-->
                                    <div class="form-box step">
                                        <h4>FILE UPLOAD</h4>
                                        <form action="submit" method="POST">
                                            <div class="row">
                                                <div class="col-12 mb-3">
                                                    <div class="row">
                                                        <div class="col-12 mb-3">
                                                            <div class="row">
                                                                <span class="dark-blue-line"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                                <!-- Certificate of Grades -->
                                                <div class="col-12 mb-3">
                                                    <div class="row align-items-center">
                                                        <div class="col-md-1">
                                                            <input type="checkbox" class="form-check-input" id="fileUploaded1" disabled>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <label class="form-label">Certificate of Grades</label>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="d-flex align-items-center">
                                                                <input type="file" class="form-control-file" id="fileInput1" name="fileInput1" accept="image/*, application/pdf" required>
                                                                <div class="file-preview ms-3">
                                                                    <img id="filePreviewImage1" class="img-fluid" style="max-height: 100px;">
                                                                    <iframe id="filePreviewPDF1" class="embed-responsive-item" style="width: 100px; height: 100px;" frameborder="0"></iframe>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Barangay Clearance -->
                                                <div class="col-12 mb-3">
                                                    <div class="row align-items-center">
                                                        <div class="col-md-1">
                                                            <input type="checkbox" class="form-check-input" id="fileUploaded2" disabled>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label">Barangay Clearance (Updated)</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="d-flex align-items-center">
                                                                <input type="file" class="form-control-file" id="fileInput2" name="fileInput2" accept="image/*, application/pdf" required>
                                                                <div class="file-preview ms-3">
                                                                    <img id="filePreviewImage2" class="img-fluid" style="max-height: 100px;">
                                                                    <iframe id="filePreviewPDF2" class="embed-responsive-item" style="width: 100px; height: 100px;" frameborder="0"></iframe>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                    
                                                <!-- Choose from the type of ID's -->
                                                <div class="col-12 mb-3">
                                                    <div class="row align-items-center">
                                                        <div class="col-md-1">
                                                            <input type="checkbox" class="form-check-input" id="fileUploaded3" disabled>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <label class="form-label">Choose from the type of ID's below (Immediate Family Only)</label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="d-flex align-items-center">
                                                                <input type="file" class="form-control-file" id="fileInput3" name="fileInput3" accept="image/*, application/pdf" required>
                                                                <div class="file-preview ms-3">
                                                                    <img id="filePreviewImage3" class="img-fluid" style="max-height: 100px;">
                                                                    <iframe id="filePreviewPDF3" class="embed-responsive-item" style="width: 100px; height: 100px;" frameborder="0"></iframe>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-1"></div>
                                                        <div class="col-md-11">
                                                            <p class="mb-0 text-muted">(Photocopy of Voter's ID Certification, Voter/s ID, Valid ID of the Parents/Guardian)</p>
                                                        </div>
                                                    </div>
                                                </div>
                    
                                                <!-- Registration Form -->
                                                <div class="col-12 mb-3">
                                                    <div class="row align-items-center">
                                                        <div class="col-md-1">
                                                            <input type="checkbox" class="form-check-input" id="fileUploaded4" disabled>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <label class="form-label">Registration Form</label>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="d-flex align-items-center">
                                                                <input type="file" class="form-control-file" id="fileInput4" name="fileInput4" accept="image/*, application/pdf" required>
                                                                <div class="file-preview ms-3">
                                                                    <img id="filePreviewImage4" class="img-fluid" style="max-height: 100px;">
                                                                    <iframe id="filePreviewPDF4" class="embed-responsive-item" style="width: 100px; height: 100px;" frameborder="0"></iframe>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                    
                                                <!-- Personal Letter -->
                                                <div class="col-12 mb-3">
                                                    <div class="row align-items-center">
                                                        <div class="col-md-1">
                                                            <input type="checkbox" class="form-check-input" id="fileUploaded5" disabled>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label">Personal Letter for Mayor Advincula</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="d-flex align-items-center">
                                                                <input type="file" class="form-control-file" id="fileInput5" name="fileInput5" accept="image/*, application/pdf" required>
                                                                <div class="file-preview ms-3">
                                                                    <img id="filePreviewImage5" class="img-fluid" style="max-height: 100px;">
                                                                    <iframe id="filePreviewPDF5" class="embed-responsive-item" style="width: 100px; height: 100px;" frameborder="0"></iframe>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        <div class="button-row">
                                            <button type="button" class="btn btn-primary previous-btn me-2">Previous</button>
                                            <button type="submit" class="submit btn btn-success">Submit</button>
                                        </div>
                                    </div>
                                </div>
                                <!--LAST PART-->
                                <div class="form-box step" id="final">
                                    <h4>FINISH</h4>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p>Your application has been submitted successfully!</p>
                                        </div>
                                    </div>
                                    <div class="button-row">
                                        <button type="button" class="btn btn-primary dashboard-btn">Go to Dashboard</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="apply.js"></script>
<script>
    let profileDropdownList = document.querySelector(".profile-dropdown-list");
    let btn = document.querySelector(".profile-dropdown-btn");

    let classList = profileDropdownList.classList;

    const toggle = () => classList.toggle("active");

    window.addEventListener("click", function (e) {
    if (!btn.contains(e.target)) classList.remove("active");
    });
</script>

</body>

</html>
