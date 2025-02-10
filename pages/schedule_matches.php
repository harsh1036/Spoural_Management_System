 <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPORUAL Event Management</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card { text-align: center; padding: 20px; }
        .btn-green { background-color: #28a745; color: white; }
        .btn-green:hover { background-color: #218838; }
        .table th, .table td { text-align: center; }
    </style>
</head>
<body>
    <header>
        <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; </span>
          <!-- SIDE BAR -->
          <div id="mySidenav" class="sidenav">
              <span class="closebtn" onclick="closeNav()">&times;</span>
              <br><Br>
              <br><br>
              <a href="admindashboard.php">Dashboard</a>
                <br>
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
                      <i class="fas fa-sign-out-alt"></i> Sign-Out
                  </a>
              </div>
          </div>
      </header>
   <!-- Schedule Matches Section -->
   <div class="container mt-5 main-content">
    <h4 class="mb-4">Schedule Matches</h4>
    <form class="mb-4">
        <div class="row mb-3">
            <div class="col-md-3">
                <label class="form-label">Match Type</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="matchType" value="sports" checked>
                    <label class="form-check-label">Sports</label>
                </div>
            </div>
            <div class="col-md-3">
                <label class="form-label">Sport Name</label>
                <input type="text" class="form-control" placeholder="Enter Sport Name">
            </div>
            <div class="col-md-3">
                <label class="form-label">Team 1 Name</label>
                <input type="text" class="form-control" placeholder="Enter Team 1">
            </div>
            <div class="col-md-3">
                <label class="form-label">Team 2 Name</label>
                <input type="text" class="form-control" placeholder="Enter Team 2">
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <label class="form-label">Match Date</label>
                <input type="date" class="form-control">
            </div>
            <div class="col-md-2">
                <label class="form-label">Match Time</label>
                <input type="time" class="form-control">
            </div>
            <div class="col-md-3">
                <label class="form-label">Location</label>
                <input type="text" class="form-control" placeholder="Enter Location">
            </div>
            <center>
            <div class="col-md-2">
                <br><br><br>
                <button class="btn btn-green w-100">Add Match</button>
            </div></center>
        </div>
    </form>
</div>
  <!--SIDEBAR JAVASCRIPT-->
  <script >
      
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

  