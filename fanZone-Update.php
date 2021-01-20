<?php
  session_start();
  if(!isset($_SESSION["user"])) { # if session does not exist, prompt user to log in
    alert('You must be logged in to access this page.');
    redirect("http://webdev.scs.ryerson.ca/~g3chahal/Raptors/fanZone-LoginSign.php");
  }
  $email = $_SESSION["user"][0];
  $username = $_SESSION["user"][1];
  $password = $_SESSION["user"][2];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="assets/css/navigation.css">
  <link rel="stylesheet" href="assets/css/fanZone-login.css">
  <style>
    #fanZone-btn a:first-child{
      color: #CE1141;
      font-weight: 500;
    }
  </style>
  <title>Fan Zone</title>
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
      <div class="form-container">
        <div class="update">
          <span class="header">Update</span>
          <form action="fanZone-Update.php" method="post">
            <label for=""><?php echo "<span class='input'>$username</span>"; ?></label><br><br>
            <label for="emailReg">Email</label><br>
            <input type="text" name="email" id="emailReg" value="<?php echo $email; ?>"><br>
            <label for="password">Password</label><br>
            <input type="password" name="password" id="password" value="<?php echo $password; ?>"><br>
            <input type="submit" value="Update" name="update" id="submitSign">
          </form>
          <div class="message-container">
    
          <?php
            $mysqli = new mysqli("localhost", "g3chahal", "Cytyoin/", "g3chahal");

            if ($mysqli -> connect_errno) {
              echo "Failed connection to: ".$mysqli -> connect_errno;
              exit();
            }
            //update
            if (isset($_POST['update'])) {;
              $email = $_POST["email"];
              $password = $_POST["password"];
              
              $pattern = "/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,63}$/";
              if (preg_match($pattern, $email) == 0) { //check email
                echo "<span>Enter a valid email</span>";
                //alert("Enter a valid email");
              } 
              elseif (strlen($password) < 5 or strlen($password) > 20) { //check password
                echo "<span>Enter a valid password <br>(Password leght: 5 - 20)</span>";
                //alert("Enter a valid password (Password leght: 5 - 20)");
              } 
              else { //everything is good
                $commandText = 'UPDATE user SET email="'.$email.'", password="'.$password.'" WHERE username="'.$username.'"';
                if ($mysqli->query($commandText) === TRUE) {
                  // alert("New record created successfully");
                } 
                else {
                  alert("Error: " . $sql . "<br>" . $mysqli->error);
                  exit();
                }
                echo "<span>Updated</span>";
                //change user is session
                $_SESSION["user"] = array($email, $username, $password);
                redirect("http://webdev.scs.ryerson.ca/~g3chahal/Raptors/fanZone-Home.php");
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