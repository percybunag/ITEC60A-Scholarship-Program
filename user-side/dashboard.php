<?php
session_start();

if (!isset($_SESSION['user_data'])) {
  header("Location: login.php");
  exit();
}
$user_data = $_SESSION['user_data'];
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
    <link rel="stylesheet" href="dashboard.css">
</head>
<style>
    
</style>
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
                    <h1>Dashboard/Overview</h1>
                </div>
                
                <div class="container">
              
                    <div class="row mt-5 stats">
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="approved">
                                <p class="header">Available &emsp; &emsp;<i class="fa-solid fa-check"></i></p>
                                <p>Program Status</p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="registered">
                                <p class="header2">2023-2024  &emsp; &emsp;<i class="fa-solid fa-calendar-days"></i></p>
                                <p>Current Scholarship Year</p>
                            </div>
                        </div>  
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="pending">
                                <p class="header3"><?php echo htmlspecialchars($user_data['user_id']); ?> &emsp; &emsp;   <i class="fa-regular fa-window-restore"></i></p>
                                <p>Applicant Number</p>
                            </div>
                        </div>
                    </div>
                    <!-- New Cards Section -->
                    <div class="row mt-5">
                        <div class="col-lg-6">
                          <div class="card">
                            <h1>News and Updates</h1><hr>
                    
                            <h1>Schedule of Scholarship for 2023-2024</h1>
                            <ul>
                                <li>1st Batch Applicants  - January 20 - March 20, 2024 </li>
                                <li>2nd Batch Applicants  - May 20 - July 20, 2024 </li>
                                <li>2nd Batch Applicants  - May 20 - July 20, 2024 </li>
                            </ul>
                            <h1> Scholarship Form</h1>
                            <uL>
                                <li>To finish Scholarship form go to interface and click Apply Scholarship</li>
                            </uL>
                            <h1> Qualified  Applicants per Batch for 2023-2024</h1>
                                <ul>
                                <li>1st Batch Applicants  - January 20 - March 20, 2024 </li>
                                <li>2nd Batch Applicants  - May 20 - July 20, 2024 </li>
                                <li>2nd Batch Applicants  - May 20 - July 20, 2024 </li>
                                </ul>
                        </div>
                        
                    </div>
                    <div class="charts">
                        <div class="chart">
                          <div class="chart" id="doughnut-chart">
                            <h2>Applications</h2><hr>
                            <canvas id="doughnut"></canvas>
                          </div>
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
        <script>
            const toggler = document.querySelector(".btn");
            toggler.addEventListener("click",function(){
                document.querySelector("#sidebar").classList.toggle("collapsed");
            });
        </script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="dashboard.js"></script>
</body>

</html>
