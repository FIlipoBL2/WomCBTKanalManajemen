<?php
    $serverName = "MEATJERKY\SQLEXPRESS"; //serverName\instanceName
    
    $connectionInfo = array( "Database"=>"master");
    $conn = sqlsrv_connect( $serverName, $connectionInfo);
    
?>

<!DOCTYPE html>
<html lang="en">
    <link rel="Stylesheet" href="loginStyles.css" />
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Subscribe</title>
  <script src="ChannelChooser.js"></script>
</head>
<body>
  <div class="form-container">
    <h1>Which channel are you logging into?</h1>
    <div id = personalChannel>
      <h1>Your Personal Channel</h1>
      <?php
      $email = $_POST["email"];
      $myquery = "
      SELECT idKanal, gambar
      FROM Kanal
      Where idKanal = (
      SELECT idKanalPribadi
      FROM pengguna
        WHERE email = ?
        )";
        $stmt = sqlsrv_query($conn, $myquery, array( $email ));
        $targetImg = 'default.jpg';
        $channelId = 'null';
        if ( $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) ) {
          $targetImg = $row['gambar'];
          $channelId = $row['idKanal'];
        } 
        echo "<img src='/$targetImg' id='$channelId' alt='User Image'><br>";
      ?>
    </div>
    <div id="groupChannels">
      <?php
      $myquery = "
      SELECT idKanal,gambar, nama
      FROM Kanal
      WHERE idKanal in (
	    SELECT idKanal
	    FROM PosisiPenggunaGroup
	    WHERE email = ?)";
        $stmt = sqlsrv_query($conn, $myquery, array( $email ));
        $found = false;
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
          $found = true;
          $imgPath = $row["gambar"];
          $channelId = $row["idKanal"];
          $channelName = $row["nama"];
          echo "<div><img src='/$imgPath' id='$channelId' alt='User Image'><br><h3>$channelName</h3></div>";
          echo $imgPath;
        }
        sqlsrv_close($conn);
      ?>
    </div>
  </div>
</body>
<form id="channelForm" action="PasswordVerifier.php" method="POST" style="display:none;">
  <input type="hidden" name="email" id="email" value ="<?php echo $email;?>">
  <input type="hidden" name="idChannel" id="idChannel">
  <input type="hidden" name="namaChannel" id="namaChannel">
  <input type="hidden" name="gambarnya" id="gambarnya">  
</form>
</html>