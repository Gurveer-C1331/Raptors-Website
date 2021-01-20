<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="assets/images/logo-red.png" type="image/png">
  <link rel="stylesheet" href="assets/css/jerseys.css">
  <link rel="stylesheet" href="assets/css/navigation.css">
  <title>Merch</title>
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
    <div>
      <!-- gallery portion of the content -->
      <div class="gallery">
        <img src="assets/images/arrow-left-black.svg" alt="" id="left-arrow-1" class="arrows left">
        <div class="gallery-images" id="gallery">
          <!-- retrieving the image names needed to display on this page -->
          <?php
            $mysqli = new mysqli("localhost", "USERNAME", "PASSWORD", "USERNAME");

            if ($mysqli -> connect_errno) {
              echo "Failed connection to: ".$mysqli -> connect_errno;
              exit();
            }
            $commandText = "SELECT * FROM `jersey` WHERE name='icon'";
            $result = $mysqli->query($commandText);
            if ($result) {
              $count = 0;
              $images = array();
              while ($row = mysqli_fetch_assoc($result)) {
                  array_push($images, $row['location']);
                  $count++;
              }
                // displaying the first image while hding te rest
                foreach ($images as $value) {
                  if ($value == $images[0]) {echo "<img src='assets/images/merch/$value' alt=''>";}
                  else {echo "<img src='assets/images/merch/$value' alt='' class='hide-image'>";}
                }

            $result -> close();
            }
          ?>
        </div>
        <img src="assets/images/arrow-right-black.svg" alt="" id="right-arrow-1" class="arrows right">
      </div>
    
      <div id="circle-container">
        <!-- generating the appropriate amount of cicrle indictors for the gallery -->
        <!-- amount based on the # of images being displayed -->
        <?php
          for ($i = 0; $i < $count; $i++) {
            if ($i == 0) {echo "<span class='circle' onclick='currentImage($i)'></span>";}
            else {echo "<span class='circle circle-hide' onclick='currentImage($i)'></span>";}
          }
        ?>
      </div>
    </div>
    
    <!-- text portion of the content -->
    <div class="text-container-odd">
      <div class="title-text-odd">
        <span class="big-title-text">ICON</span>
        <span class="small-title-text">Edition</span>
      </div>
      <div class="description-text-odd">
        <span>An embodiment of the Raptor. Calculated. Always hunting. Marked by the untamed North, with impact always visible.</span>
      </div>
      <div class="button-container-odd">
        <a href="https://shop.realsports.ca/products/the-association-edition" class="realSports-btn-odd">Real Sports Shop</a>
      </div>
    </div>
  </main>

  <script src="navigation.js"></script>
  <script src="merch.js"></script>
</body>
</html>
