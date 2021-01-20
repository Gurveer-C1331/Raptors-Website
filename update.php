<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/update.css">
    <link rel="stylesheet" href="assets/css/navigation.css">
    <title>Update Vote</title>
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
    <?php
        session_start(); # start session
        if(!isset($_SESSION["user"])) { # if session does not exist, prompt user to log in
            die("<script>alert('You must be logged in to access this page.')</script>");
        }

        $email = $_SESSION["user"][0]; # session info
        $username = $_SESSION["user"][1];

        $vote = $_GET["player"];
        $sql_servername = "localhost"; # server info
        $sql_username = "g3chahal";
        $sql_password = "Cytyoin/";
        $mysql = new mysqli($sql_servername, $sql_username, $sql_password, $sql_username) or die("<script>alert('Vote Upload Failed')</script>");
        $q = "INSERT INTO votes (id, vote) VALUES (\"$username\", \"$vote\")";  
        if($mysql->query("SELECT * FROM votes WHERE (id='$username')")->num_rows == 1) {
            $mysql->query("UPDATE votes SET vote='$vote' WHERE id='$username'");
        }else {
            $mysql->query("INSERT INTO votes (id, vote) VALUES ('$username', '$vote')");
        }
        echo "<h1>Successfully updated vote!</h1>"
    ?>
    <a href='http://webdev.scs.ryerson.ca/~nkadovic/fanVoting.php'>Go Back</a>
</body>
</html>