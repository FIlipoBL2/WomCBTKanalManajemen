<?php require '../conn.php'?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>YouTube UI</title>
  <link rel="stylesheet" href="landingPageStyles.css"/>
</head>
<body>
  <header>
    <div class="logo">
      <a href="LandingPage.php">
        <img src="logo_youtube.png" alt="YouTube Logo"/>
      </a>
    </div>
    <div class="search-bar">
      <input type="text" placeholder="Search"/>
      <a href="">
        <img src="search_icon.png" alt="Search Icon"/>
      </a>
    </div>
    <div class="actions">
      <a href="../HasilBima/Notif/NotifReject.php">
        <img src="notif-icon.png" alt="Notifications" />
      </a>
      <div class="profile-circle">
        <a href="<?php if (!isset($_SESSION["email"])) echo "../HasilBima/Login/EmailRequest.php"; else echo "../Eric/Profile/Profile.php"?>">
          <img src = "<?php echo $imgSrc?>">
        </a>
        
      </div>
    </div>
  </header>

  <main>
    <?php 
    $myquery = "
      SELECT idVideo, judul, thumbnail
      FROM Video
      WHERE isPublished = 1
      ORDER BY RAND()
      LIMIT 3"
    ;
    
    $hasil = mysqli_query($conn, $myquery);
    while ($row = mysqli_fetch_assoc($hasil) ) {
        $idVideo = $row["idVideo"];
        $thumb = $row["thumbnail"];
        $title = $row["judul"];
        echo "<div class='video'>
        <div class='thumbnail'>
            <a href='../Eric/Video/Video.php?idVideo=$idVideo'>
                <img src='$thumb' alt='Thumbnail'/>
            </a>
        </div>
        <div class='video-title'>$title</div>
        </div>";
    }
    ?>
  </main>
</body>
</html>
