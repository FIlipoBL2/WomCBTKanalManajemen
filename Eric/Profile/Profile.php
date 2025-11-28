<?php
  require "../../conn.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>YouTube Channel Analytics Clone</title>
  <link rel="stylesheet" href="profileStyles.css" />
</head>
<body>

<header>
    <div class="logo">
      <a href="../../devi/LandingPage.php">
        <img src="/devi/logo_youtube.png" alt="YouTube Logo" />
      </a>
    </div>
    <div class="search-bar">
      <input type="text" placeholder="Search" />
      <a href="">
        <img src="/devi/search_icon.png" alt="Search Icon" />
      </a>
    </div>
    <div class="actions">
      <a href="">
        <img src="/devi/notif-icon.png" alt="Notifications" />
      </a>
      <div class="profile-circle">
        <a href="">A</a>
      </div>
    </div>
  </header>

  <div class="channel-banner"></div>

  <section class="channel-info">
    <img src="/Eric/Images/iseng.jpg" alt="Channel Avatar" />
    <div class="text">
      <?php
      $myquery = "
      SELECT nama, dscp
      FROM Kanal
      WHERE idKanal = ?";
      $stmt = sqlsrv_query($conn, $myquery, array( $_SESSION["channelId"] ));
      if ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) ) {
        $namaChannel = $row["nama"];
        $desc = $row["dscp"];
        echo "<h2>$namaChannel</h2>
              <p>$desc</p>";
      } 
      ?>
      
    </div>
  </section>

  <section class="channel-actions">
    <a href="/index.php">

      <button>logout</button>
    </a>
  <button onclick="uploadProfilePicture()">Upload Profile Picture</button>
  <button onclick="changeDescription()">Change Description</button>
  <button onclick="uploadVideo()">Upload Video</button>
  <button onclick="inviteCollaborator()">Invite</button>
  </section>

  <main class="analytics-container">
    <section class="analytics-summary">
      <div class="summary-box">
        <h3>Views (Last 28 days)</h3>
        <p>456,789</p>
      </div>
      <div class="summary-box">
        <h3>Watch Time (Hours)</h3>
        <p>12,345</p>
      </div>
      <div class="summary-box">
        <h3>Subscribers</h3>
        <p>+1,234</p>
      </div>
    </section>

    <section class="top-videos">
      <h2>Top Performing Videos</h2>

      <div class="video-card">
        <img src="https://via.placeholder.com/160x90" alt="Video Thumbnail" />
        <div class="video-info">
          <h4>How to Clone YouTube in HTML & CSS</h4>
          <p>123K views • 10K watch time hrs</p>
        </div>
      </div>

      <div class="video-card">
        <img src="https://via.placeholder.com/160x90" alt="Video Thumbnail" />
        <div class="video-info">
          <h4>Learn CSS Grid in 5 Minutes</h4>
          <p>98K views • 8K watch time hrs</p>
        </div>
      </div>

    </section>
  </main>

</body>
</html>
