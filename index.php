
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPORUAL Event Management</title>
    <link rel="stylesheet" href="style.css">

</head>

<body>
    <header>
        <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; </span>
          <!-- SIDE BAR -->
          <div id="mySidenav" class="sidenav">
              <span class="closebtn" onclick="closeNav()">&times;</span>
              <br><Br>
              <br><br>
              <a href="pages/addevent.php">Add Event</a>
              <br>
              <a href="pages/addulsc.php">Add ULSC</a>
              <br>
              <a href="pages/addadmin.php">Add Admin</a>
          </div>
  
          <div class="logo">
              <br><br>
              <img src="assets/images/charusat.png" alt="Logo 1">
  
          </div>
          <h1>Spoural Event Management System</h1>
  
          <div class="logo">
  
              <img src="assets/images/ulsc.png" alt="Logo 2">
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

    <section class="hero" id="home">
        <h1>Welcome to the World of Sports Management</h1>
    </section>

    <section class="about" id="about">
        <h2>About Us</h2>
        <p>Our sports event management system helps you organize, manage, and track sports events effortlessly. From
            registrations to score tracking, we've got it covered!</p>
    </section>

    <section class="features" id="features">
        <h2>Features</h2>
        <div class="feature-grid">
            <div class="feature">
                <h3>Event Scheduling</h3>
                <p>Plan and schedule your events efficiently with our intuitive tools.</p>
            </div>
            <div class="feature">
                <h3>Registration Management</h3>
                <p>Allow participants to register seamlessly online.</p>
            </div>
            <div class="feature">
                <h3>Live Score Tracking</h3>
                <p>Track scores live during events with real-time updates.</p>
            </div>
        </div>
    </section>

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