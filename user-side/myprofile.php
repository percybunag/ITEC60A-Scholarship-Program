<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_data'])) {
    header("Location: login.php");
    exit();
}

// Get user data from session
$user_data = $_SESSION['user_data'];

// Assuming you have a function to get user details from the database
// Replace `getUserDetailsFromDb` with your actual function to get user details
$user_details = getUserDetailsFromDb($user_data['user_id']);

function getUserDetailsFromDb($user_id) {
    // Database connection (assuming you have a connection script)
    include 'db_connection.php';

    // SQL query to fetch user details
    $sql = "SELECT first_name, middle_name, last_name, gender, unit_floor_street, barangay, contact_no, email_address, bdate FROM user WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user_details = $result->fetch_assoc();

    return $user_details;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <title>City Government of Imus | Admin Dashboard</title>
</head>
<style>
*,
::after,
::before {
    box-sizing: border-box;
}

body {
    font-family: 'Montserrat', sans-serif;
    margin: 0;

}

h3 {
    font-size: 1.2375rem;

}

a {
    cursor: pointer;
    text-decoration: none;
    font-family: 'Montserrat', sans-serif;
}

li {
    list-style: none;
}

/* Layout skeleton */

.wrapper {
    align-items: stretch;
    display: flex;
    width: 100%;
}

#sidebar {
    max-width: 264px;
    min-width: 264px;
    transition: all 0.35s ease-in-out;
    box-shadow: 0 0 35px 0 rgba(49, 57, 66, 0.5);
    z-index: 1111;
    background-color: #053774;

}

/* Sidebar collapse */

#sidebar.collapsed {
    margin-left: -264px;
}

.main {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
    width: 100%;
    overflow: hidden;
    transition: all 0.35s ease-in-out;
}
.sidebar-item:hover{
    background-color: #234875;
}

.sidebar-img {
    padding: 5rem 0rem 2rem 0rem;
    align-items: center;
    justify-content: center;
    display: flex;
}
.sidebar-usertext{
    color: white;
    text-align: center;
    font-weight: 700;
}
.sidebar-nav {
    padding: 0;
    
}
.sidebar-header {
    color: #e9ecef;
    font-size: .75rem;
    padding: 1.5rem 1.5rem .375rem;
}

a.sidebar-link {
    padding: 1rem 1.625rem;
    color: #e9ecef;
    position: relative;
    display: block;
    font-size: 1rem;
    text-align: center;
}
.content {
    flex: 1;
    max-width: 100vw;
    width: 100vw;
}
.navbar{
    background-color: #209C48;
    height: 100px;
}
.first-header{
    margin-bottom: 0px;
    font-size: 20px;
    font-weight: 700;
    color: white;
}
.second-header{
    margin: 0px;
    font-size: 12px;
    font-weight: 600;
    color: white;
}
.third-header{
    margin: 0px;
    font-size: 10px;
    font-weight: 600;
    color: white;
}


.registered {
    padding: 1rem;
    text-align: start;
    color: white;
    background-color: #053774;
    margin-bottom: 1rem;
    border-radius: 15px;
}
.pending {
    padding: 1rem;
    text-align: start;
    color: white;
    background-color: #209C48;
    margin-bottom: 1rem;
    border-radius: 15px;
}
.overall {
    padding: 1rem;
    text-align: start;
    color: white;
    background-color: #053774;
    margin-bottom: 1rem;
    border-radius: 15px;
}
.stats{
    display: flex;
    justify-content: space-between;
}

.rectangle {
    background-color: transparent;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    text-align: start;
    color: #209C48;
    height: 60px;
}

.rectangle h1 {
    font-size: 1.5rem;
    letter-spacing: 0.5px;
    font-weight: 700;
    padding: 15px;   
    
}


@media (max-width: 1000px) {
    .header-text {
        display: none;
    }
    .rectangle h1 {
        font-size: 1rem;
    }
    
}

@media (min-width: 768px) {
    .content {
        width: auto;
    }
}


.personal-info-container {
    background-color: #f0f0f0;
    padding: 40px;
    font-size: 15px;
    border-radius: 20px;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
    width: 80%;
    margin-top: 30px;
    margin-bottom: 30px;
}

.personal-info-container h1{
    margin-left: 0%;
}

.form-label{
    margin-left: 20px;
}

.form-control, .form-select {
    border-radius: 10px;
    border: 1px solid black;
    height: 2rem;
    margin-left: 70px;
}

.form-control:focus, .form-select:focus {
    border-color: #209C48;
    box-shadow: 0 0 5px rgba(32, 156, 72, 0.5);
}

.personal-info-header {
    text-align: left;
    font-size: 1.5em;
    color: #053774;
    font-weight: bold;
    }

.form-section h1 {
    font-size: 1.25em;
    margin-bottom: 15px;
}

.form-label {
    font-weight: bold;
}
/*dropdown*/
.profile-dropdown {
    position: absolute;
    width: 0;
    margin-left: 90%;
  }
  
  .profile-dropdown-btn {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding-right: 1rem;
    font-size: 0.9rem;
    font-weight: 600;
    width: 150px;
    border-radius: 50px;
    color: #fff;

    /* background-color: white;
    box-shadow: var(--shadow); */
  
    cursor: pointer;
    border: 1px solid var(--secondary);
    transition: box-shadow 0.2s ease-in, background-color 0.2s ease-in,
      border 0.3s;
  }
  
  .profile-dropdown-btn:hover {
    background-color: var(--secondary-light-2);
    box-shadow: var(--shadow);
  }
  
  .profile-img {
    position: relative;
    width: 3rem;
    height: 3rem;
    border-radius: 50%;

  }
  
  .profile-img i {
    position: absolute;
    right: 0;
    bottom: 0.3rem;
    font-size: 0.5rem;
    color: var(--green);
  }
  
  .profile-dropdown-btn span {
    margin: 0 0.5rem;
    margin-right: 0;
  }
  
  .profile-dropdown-list {
    position: absolute;
    top: 18px;
    width: 300px;
    right: -70px;
    background-color: #faf0e6;
    border-radius: 10px;
    max-height: 0;
    overflow: hidden;
    box-shadow: var(--shadow);
    transition: max-height 0.5s;
    color: #053774;
  }
  
  .profile-dropdown-list hr {
    border: 0.5px solid var(--green);
  }
  
  .profile-dropdown-list.active {
    max-height: 500px;
  }
  
  .profile-dropdown-list-item {
    padding: 0.5rem 0rem 0.5rem 1rem;
    transition: background-color 0.2s ease-in, padding-left 0.2s;
  }
  
  .profile-dropdown-list-item a {
    display: flex;
    align-items: center;
    text-decoration: none;
    font-size: 0.9rem;
    font-weight: 500;
    color: var(--black);
  }
  
  .profile-dropdown-list-item a i {
    margin-right: 0.8rem;
    font-size: 1.1rem;
    width: 2.3rem;
    height: 2.3rem;
    background-color: var(--secondary);
    color: var(--white);
    line-height: 2.3rem;
    text-align: center;
    margin-right: 1rem;
    border-radius: 50%;
    transition: margin-right 0.3s;
  }
  
  .profile-dropdown-list-item:hover {
    padding-left: 1.5rem;
    background-color: var(--secondary-light);
  }

</style>
<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <aside id="sidebar">
            <div class="h-100">
                <div class="sidebar-img">
                    <img src="../img/Ph_seal_Imus.png" width="100px" alt="">
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
                        <a href="applyscholarship.php" class="sidebar-link">
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
                    <img src="../img/Ph_seal_Imus.png" width="70px" alt="">
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
                      <span>
                        Menu
                        <i class="fa-solid fa-angle-down"></i>
                      </span>
                    </div>
                    <ul class="profile-dropdown-list">
                      <li class="profile-dropdown-list-item">
                        <a href="#">
                          <i class="fa-regular fa-user"></i>
                          Edit Profile
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
                    <h1>My Profile</h1>
                </div>
                <div class="container d-flex justify-content-center mt-5">
                    <div class="card g-4 personal-info-container">
                        <h1 class="mb-3 personal-info-header">PERSONAL DETAILS</h1>
                        <form action="/submit_scholarship" method="post">
                            <div class="row">
                                <!-- Profile Section -->
                                <div class="col-10 mb-3">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label for="first_name" class="form-label">First Name:</label>
                                        </div>
                                        <div class="col-md-9 d-flex justify-content-center">
                                            <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo htmlspecialchars($user_details['first_name']); ?>" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-10 mb-3">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label for="middle_name" class="form-label">Middle Name:</label>
                                        </div>
                                        <div class="col-md-9 d-flex justify-content-center">
                                            <input type="text" class="form-control" id="middle_name" name="middle_name" value="<?php echo htmlspecialchars($user_details['middle_name']); ?>" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-10 mb-3">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label for="last_name" class="form-label">Last Name:</label>
                                        </div>
                                        <div class="col-md-9 d-flex justify-content-center">
                                            <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo htmlspecialchars($user_details['last_name']); ?>" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-10 mb-3">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label for="gender" class="form-label">Gender:</label>
                                        </div>
                                        <div class="col-md-9 d-flex justify-content-center">
                                            <input type="text" class="form-control" id="gender" name="gender" value="<?php echo htmlspecialchars($user_details['gender']); ?>" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-10 mb-3">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label for="unit_floor_street" class="form-label">Unit/Floor/Street:</label>
                                        </div>
                                        <div class="col-md-9 d-flex justify-content-center">
                                            <input type="text" class="form-control" id="unit_floor_street" name="unit_floor_street" value="<?php echo htmlspecialchars($user_details['unit_floor_street']); ?>" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-10 mb-3">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label for="barangay" class="form-label">Barangay:</label>
                                        </div>
                                        <div class="col-md-9 d-flex justify-content-center">
                                            <input type="text" class="form-control" id="barangay" name="barangay" value="<?php echo htmlspecialchars($user_details['barangay']); ?>" disabled>
                                        </div>
                                    </div>   
                                </div>
                                <div class="col-10 mb-3">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label for="contact_no" class="form-label">Contact Number:</label>
                                        </div>
                                        <div class="col-md-9 d-flex justify-content-center">
                                            <input type="text" class="form-control" id="contact_no" name="contact_no" value="<?php echo htmlspecialchars($user_details['contact_no']); ?>" disabled>
                                        </div>
                                    </div>   
                                </div>
                                <div class="col-10 mb-3">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label for="email_address" class="form-label">Email Address:</label>
                                        </div>
                                        <div class="col-md-9 d-flex justify-content-center">
                                            <input type="text" class="form-control" id="email_address" name="email_address" value="<?php echo htmlspecialchars($user_details['email_address']); ?>" disabled>
                                        </div>
                                    </div>   
                                </div>
                                <div class="col-10 mb-3">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label for="bdate" class="form-label">Birth Date:</label>
                                        </div>
                                        <div class="col-md-9 d-flex justify-content-center">
                                            <input type="text" class="form-control" id="bdate" name="bdate" value="<?php echo htmlspecialchars($user_details['bdate']); ?>" disabled>
                                        </div>
                                    </div>   
                                </div>
                            </div>     
                        </form>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        let profileDropdownList = document.querySelector(".profile-dropdown-list");
        let btn = document.querySelector(".profile-dropdown-btn");

        let classList = profileDropdownList.classList;

        const toggle = () => classList.toggle("active");

        window.addEventListener("click", function (e) {
            if (!btn.contains(e.target)) classList.remove("active");
        });
    </script>
    <script>
            const toggler = document.querySelector(".btn");
            toggler.addEventListener("click",function(){
                document.querySelector("#sidebar").classList.toggle("collapsed");
            });
    </script>
</body>
</html>
