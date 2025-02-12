<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPORUAL Event Management</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>
    <header>
        <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; </span>
          <!-- SIDE BAR -->
          <div id="mySidenav" class="sidenav">
              <span class="closebtn" onclick="closeNav()">&times;</span>
              <br><Br>
              <br><br>
              <a href="addevent.php">Add Event</a>
              <br>
              <a href="addulsc.php">Add ULSC</a>
              <br>
              <a href="addadmin.php">Add Admin</a>
              <br>
              <a href="schedule_matches.php">Add Schedule</a>
          </div>
  
          <div class="logo">
              <br><br>
              <img src="../assets/images/charusat.png" alt="Logo 1">
  
          </div>
          <h1>Spoural Event Management System</h1>
  
          <div class="logo">
  
              <img src="../assets/images/ulsc.png" alt="Logo 2">
          </div>
  
          <!--LOGOUT-->
          <div class="dropdown">
              <button class="dropdown-trigger">
                  Harsh <i class="fas fa-caret-down"></i>
              </button>
              <div class="dropdown-menu">
                  <a href="#" class="dropdown-item">
                      <i class="fas fa-user"></i> My Profile
                  </a>
  
                  <hr>
                  <a href="#" class="dropdown-item">
                    <a href="ulsc_logout.php" class="dropdown-item"><i class="fas fa-sign-out-alt"></i> Sign-Out</a>
                  </a>
              </div>
          </div>
      </header>


        <div class="container mt-4">
            <!-- Statistics Cards -->
            <div class="row text-center">
                <div class="col-md-3">
                    <div class="card">
                        <h3>15</h3>
                        <p>Total Events</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <h3>230</h3>
                        <p>Total ULSC</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <h3>12</h3>
                        <p>Pending Approvals</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <h3>5</h3>
                        <p>Total Admin</p>
                    </div>
                </div>
            </div>

            <!-- View Scheduled Matches -->
            <h4 class="mt-4">View Scheduled Matches</h4>
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Match Type</th>
                        <th>Sport Name</th>
                        <th>Team 1</th>
                        <th>Team 2</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Location</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Sports</td>
                        <td>Football</td>
                        <td>Team A</td>
                        <td>Team B</td>
                        <td>10-03-2025</td>
                        <td>05:00 PM</td>
                        <td>Main Stadium</td>
                    </tr>
                </tbody>
            </table>

            <!-- Manage Events Table -->
            <h4 class="mt-4">Manage Events</h4>
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Event Name</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Location</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Cricket Tournament</td>
                        <td>12-02-2025</td>
                        <td>03:00 PM</td>
                        <td>Main Ground</td>
                        <td>Scheduled</td>
                        <td>
                            <button class="btn btn-success">Edit</button>
                            <button class="btn btn-danger">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>

        </div>
       

    <footer>
        <p>&copy; 2025 Sports Event Management System. All Rights Reserved.</p>
    </footer>
      
<!--SIDEBAR JAVASCRIPT-->
<script>

   function openNav() {
       document.getElementById("mySidenav").style.width = "250px";
       document.querySelector(".main-content").style.marginLeft = "250px";
   }
   function closeNav() {
       document.getElementById("mySidenav").style.width = "0";
       document.querySelector(".main-content").style.marginLeft = "0";
   }
   
   

</script>

</body>

</html>