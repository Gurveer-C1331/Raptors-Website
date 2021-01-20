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
        <div class="signup">
          <span class="header">Sign In</span>
          <form action="fanZone-LoginSign.php" method="post">
            <label for="username">Username</label><br>
            <input type="text" name="username" id="username" placeholder="joedoe123"><br>
            <label for="password">Password</label><br>
            <input type="password" name="password" id="password"><br>
            <input type="submit" value="Sign In" name="sigin" id="submitSign">
            <span id="sigin-text">Don't have an account? <a href="http://webdev.scs.ryerson.ca/~g3chahal/Raptors/fanZone-LoginReg.php">Register</a></span>
          </form>
          <div class="message-container">
    
          <?php
            $mysqli = new mysqli("localhost", "g3chahal", "Cytyoin/", "g3chahal");

            if ($mysqli -> connect_errno) {
              echo "Failed connection to: ".$mysqli -> connect_errno;
              exit();
            }
            //sign in
            if (isset($_POST['sigin'])) {
              $username = $_POST["username"];
              $commandText = 'SELECT * FROM `user` WHERE username="'.$username.'"';
              $result = $mysqli->query($commandText);
              //user doesn't exist
              if ($result -> num_rows == 0) {
                echo "<span>Username doesn't exist</span>";
                //alert("Username does not exist");
              }
              else {
                $row = mysqli_fetch_assoc($result);
                //password incorrect
                if ($row["password"] != $_POST["password"]) {
                  echo "<span>Password incorrect</span>";
                  //alert("Password incorrect");
                }
                //login successful
                else {
                  //change user is session
                  $_SESSION["user"] = array($row["email"], $row["username"], $row["password"]);
                  redirect("http://webdev.scs.ryerson.ca/~g3chahal/Raptors/fanZone-Home.php");
                }
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