<?php
  session_start();
  $_SESSION["user"] = NULL;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="assets/css/navigation.css">
  <link rel="stylesheet" href="assets/css/fanZone-login.css">

  <title>Fan Zone</title>
  <style>
    #fanZone-btn a:first-child{
      color: #CE1141;
      font-weight: 500;
    }
  </style>
</head>
<body>
  <!-- webpage's top navigation -->
  <header>
    <div class="logo-container">
      <a href="home.html" ><img src="assets/images/logo-black.png" alt="" id="logo-btn"></a>
      <strong id="logo-text">TORONTO <br> RAPTORS</strong>
    </div>
    <nav>
      <img src="assets/images/menu.svg" alt="" id="menu-btn">
      <ul class="hide-moblie">
        <li id="fanZone-btn"><a href="fanZone-LoginSign.php">FANZONE</a></li>
        <li id="about-btn">
          <a href="about.html">ABOUT</a>
          <div class="dropdown">
            <img src="assets/images/triangle.svg" alt="" class="triangle">
            <a href="http://webdev.scs.ryerson.ca/~agsimoes/about-franchise.php">Franchise</a>
            <a href="http://webdev.scs.ryerson.ca/~agsimoes/about-team.php">Team</a>
          </div>
        </li>
        <li id="stats-btn">
          <a href="stats.html">STATS</a>
          <div class="dropdown">
            <img src="assets/images/triangle.svg" alt="" class="triangle">
            <a href="season2018_19.php">2018/19</a>
            <a href="season2019_20.php">2019/20</a>
          </div>
        </li>
        <li id="management-btn">
          <a href="management.html">MANAGEMENT</a>
          <div class="dropdown">
            <img src="assets/images/triangle.svg" alt="" class="triangle">
            <a href="president.php">President</a>
            <a href="gmanager.php">General Manager</a>
            <a href="coach.php">Head Coach</a>
          </div>
        </li>
        <li id="merch-btn"><a href="merch.html">MERCH</a></li>
      </ul>
    </nav>
  </header>

  <main>
    <div class="image-container">
      <img src="https://pbs.twimg.com/media/EauSThPXQAAS8yO.jpg:large" alt="">
    </div>

    <div class="right-container">
      <span class="title">Welcome to the FanZone.</span>

      <div class="form-container">
        <div class="register">
          <span class="header">Register</span>
          <form action="fanZone-LoginReg.php" method="post">
            <label for="emailReg">Email</label><br>
            <input type="text" name="email" id="emailReg" placeholder="joedoe@email.com"><br>
            <label for="usernameReg">Username</label><br>
            <input type="text" name="username" id="usernameReg" placeholder="joedoe123"><br>
            <label for="passwordReg">Password</label><br>
            <input type="password" name="password" id="passwordReg"><br>
            <input type="submit" value="Register" name="register" id="submitReg">
            <span id="sigin-text">Already have an account? <a href="http://webdev.scs.ryerson.ca/~g3chahal/Raptors/fanZone-LoginSign.php">Sign In</a></span>
          </form>
          <div class="message-container">
        
          <?php
            $mysqli = new mysqli("localhost", "g3chahal", "Cytyoin/", "g3chahal");

            if ($mysqli -> connect_errno) {
              echo "Failed connection to: ".$mysqli -> connect_errno;
              exit();
            }
            //register
            if (isset($_POST['register'])) {
              $username = $_POST["username"];
              $commandText = 'SELECT * FROM `user` WHERE username="'.$username.'"';
              $result = $mysqli->query($commandText);
              //user doesn't exist
              if ($result -> num_rows == 0) {
                $email = $_POST["email"];
                $password = $_POST["password"];
                
                $pattern = "/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,63}$/";
                if (preg_match($pattern, $email) == 0) { //check email
                  echo "<span>Enter a valid email</span>";
                  //alert("Enter a valid email");
                } 
                elseif (strlen($username) < 5 or strlen($username) > 20) { //check username
                  echo "<span>Enter a valid username <br>(Username length: 5 - 20)</span>";
                  //alert("Enter a valid username (Username length: 5 - 20)");
                } 
                elseif (strlen($password) < 5 or strlen($password) > 20) { //check password
                  echo "<span>Enter a valid password <br>(Password leght: 5 - 20)</span>";
                  //alert("Enter a valid password (Password leght: 5 - 20)");
                } 
                else { //everything is good
                  $commandText = 'INSERT INTO user (email, username, password) VALUES ("'.$email.'", "'.$username.'", "'.$password.'")';
                  if ($mysqli->query($commandText) === TRUE) {
                    // alert("New record created successfully");
                  } 
                  else {
                    alert("Error: " . $sql . "<br>" . $mysqli->error);
                    exit();
                  }
                  //change user is session
                  $_SESSION["user"] = array($email, $username, $password);
                  redirect("http://webdev.scs.ryerson.ca/~g3chahal/Raptors/fanZone-Home.php");
                }
                
              }
              //user does exist
              else {
                echo "<span>Username already exists</span>";
                //alert("Username already exists");
              }
            }

            function alert($msg) {
                echo "<script>alert('$msg');</script>";
                // echo "$msg";
            }
            function redirect($url) {
              ob_start();
              header('Location: '.$url);
              ob_end_flush();
              die();
            }

          ?>
          </div>
        </div>
      </div>
    </div>
  </main>
  <script src="navigation.js"></script>
</body>
</html>