<?php
    session_start();
    require "../../conn.php"
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Video Watch Page</title>
  <link rel="stylesheet" href="videoStyles.css" />
</head>
<body>

<header>
    <div class="logo">
      <a href="/devi/LandingPage.php">
        <img src="/devi/logo_youtube.png" alt="YouTube Logo"/>
      </a>
    </div>
    <div class="search-bar">
      <input type="text" placeholder="Search"/>
      <a href="">
        <img src="/devi/search_icon.png" alt="Search Icon"/>
      </a>
    </div>
    <div class="actions">
      <a href="/HasilBima/Notif/NotifReject.php">
        <img src="/devi/notif-icon.png" alt="Notifications" />
      </a>
      <div class="profile-circle">
        
        <a href="<?php if (!isset($_SESSION["email"])) echo "../../HasilBima/Login/EmailRequest.php"; else echo "../Profile/Profile.php"?>">A</a>
      </div>
    </div> 
  </header>

  <main class="video-page">
    <!-- Main Video and Info -->
    <div class="video-main">
      <div class="video-player">
        <video controls>
          <source src="../../<?php echo $_GET["idVideo"];?>" type="video/mp4">
          Your browser does not support HTML5 video.
        </video>
      </div>

      <!-- Uploader Info -->
      <div class="uploader-info">
        <?php
        $myquery = "
        SELECT nama, gambar
        FROM Kanal
        WHERE idKanal = (
          SELECT loc
          FROM Video
          WHERE idVideo=?
        )";
        $stmt = $conn->prepare($myquery);
        $stmt->bind_param("s", $_GET["idVideo"]);   // "s" = string
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = mysqli_fetch_assoc($result ) ) {
          $nama = $row["nama"]; 
          $gmabar = $row["gambar"]; 
          echo "<img src='$gmabar' alt='Uploader Logo' />
            <div>
            <h4>$nama</h4>
            <button class='subscribe'>Subscribe</button>
            </div>";
        } 
        ?>
        
      </div>

      <!-- Video Title -->
      <h2 class="video-title">
      <?php
      $myquery = "
      SELECT judul
      FROM Video
      WHERE idVideo = ?";
    
      $stmt = $conn->prepare($myquery);
      $stmt->bind_param("s", $_GET["idVideo"]);   // "s" = string
      $stmt->execute();
      $result = $stmt->get_result();
      if ($row = mysqli_fetch_assoc($result ) ) {
        $title = $row["judul"];  
        echo "$title";
      } 
      ?>
      </h2>

      <!-- Actions -->
      <div class="video-actions">
        <button>👍 Like</button>
        <button>👎 Dislike</button>
        <button>💬 Comment</button>
      </div>
    </div>

    <!-- Sidebar -->
    <aside class="video-sidebar">
      <h3>Up Next</h3>

      <?php 
      $myquery = "
        SELECT idVideo, judul, thumbnail
        FROM Video
        WHERE isPublished = 1 and idVideo!= ?
        ORDER BY RAND()
        LIMIT 3";
      
      $stmt = $conn->prepare($myquery);
      $stmt->bind_param("s", $_GET["idVideo"]);   // "s" = string
      $stmt->execute();
      $result = $stmt->get_result();
      while ($row = mysqli_fetch_assoc($result ) ) {
        $idVideo = $row["idVideo"];
        $thumb = $row["thumbnail"];
        $title = $row["judul"];
        echo "<div class='suggested-video'>
          <img src='$idVideo' href='../Eric/Video/Video.php?idVideo=$idVideo' alt='Thumbnail' />
          <div>
            <p class='title'>$title</p>
          </div>
          </div>";
      }
      ?>

    </aside>
  </main>

</body>
</html>
