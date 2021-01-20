<?php
  session_start();
  if(!isset($_SESSION["user"])) { # if session does not exist, prompt user to log in
    alert('You must be logged in to access this page.');
    redirect("http://webdev.scs.ryerson.ca/~g3chahal/Raptors/fanZone-LoginSign.php");
  }
  $email = $_SESSION["user"][0];
  $username = $_SESSION["user"][1];
  // $password = $_SESSION["user"][2];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="assets/css/navigation.css">
  <link rel="stylesheet" href="assets/css/fanZone-home.css">

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
    <?php echo "<span class='title'>Welcome $username</span>"; ?>
    <div class="account-container">
      <img src="assets/images/user_logo.svg" alt="">
      <span class="label">Username: <?php echo "<span class='input'>$username</span>"; ?></span>
      <span class="label">Email: <?php echo "<span class='input'>$email</span>"; ?></span>
      <span class="label">Password: <span class="input">......</span></span>
    </div>

    <div class="button-container">
      <form action="fanZone-Home.php" method="post">
        <input type="submit" value="Update" name="update" id="update-btn">
        <input type="submit" value="Delete" name="delete" id="delete">
      </form>
    </div>

    <span id="vote-title">Fan Votes</span>
    <div class="vote-container">
      <a href="fanZone-Voting.php" id="vote-btn">Vote</a>
    </div>
    
    <?php
      $mysqli = new mysqli("localhost", "g3chahal", "Cytyoin/", "g3chahal");

      if ($mysqli -> connect_errno) {
        echo "Failed connection to: ".$mysqli -> connect_errno;
        exit();
      }

      //delete
      if (isset($_POST['delete'])) {
        $commandText = 'DELETE FROM `user` WHERE username="'.$username.'"';
        $result = $mysqli->query($commandText);
        //change user is session
        $_SESSION["user"] = NULL;
        redirect("http://webdev.scs.ryerson.ca/~g3chahal/Raptors/home.html");
      }

      //update
      if (isset($_POST['update'])) {
        redirect("http://webdev.scs.ryerson.ca/~g3chahal/Raptors/fanZone-Update.php");
      }
      
      function alert($msg) {
          echo "<script>alert('$msg');</script>";
          //echo "$msg";
      }
      function redirect($url) {
        ob_start();
        header('Location: '.$url);
        ob_end_flush();
        die();
      }

    ?>
  </main>
  <script src="navigation.js"></script>
  <script src="fanZone.js"></script>
</body>
</html>