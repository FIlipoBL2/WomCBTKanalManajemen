<?php
    session_start();
    $serverName = "MEATJERKY\SQLEXPRESS"; //serverName\instanceName
    
    $connectionInfo = array( "Database"=>"master");
    $conn = sqlsrv_connect( $serverName, $connectionInfo);
    $channelId = $_POST["idChannel"];
    $realPass="not real";
    $myquery = "
      SELECT pass
      FROM Kanal
      WHERE idKanal = ?";
      $stmt = sqlsrv_query($conn, $myquery, array( $channelId ));
      if ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) ) {
        $realPass = (string)$row["pass"];
      } 
      if ($realPass=="not real"&& !empty($_POST["pass"])) {
        $channelId == "V". (string)rand();
        $realPass == $_POST["pass"];
        $myquery = "
        Insert Into Kanal (idKanal, isGroup, pass)
        VALUES('$channelId', 0, $realPass)";
      
        sqlsrv_query($conn, $myquery);
        $myquery = "
        Insert Into Pengguna
        VALUES('$email, '$channelId')";
      
        sqlsrv_query($conn, $myquery);
      }
    
    if (!empty($_POST["pass"]) && $realPass == $_POST["pass"]) {
        $_SESSION["channelId"] = $channelId;
        $_SESSION["gambarnya"] = $_POST["gambarnya"];
        $_SESSION["email"] = $_POST["email"];
        header("Location: /devi/LandingPage.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
    <link rel="Stylesheet" href="loginStyles.css" />
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Subscribe</title>
  <?php
  
  ?>
</head>
<body>
  <div class="form-container">
    <h1>Please enter your password</h1>
    <?php
      if (empty($_POST["pass"]))
        echo "<h1> making new Account <h1><br>";
      $imgPath = $_POST["gambarnya"];
      $channelName = $_POST["namaChannel"];
      if (!empty($_POST["pass"]))
        $pass = $_POST["pass"];
      else $pass = '';
      echo "<img src='$imgPath'><br>";
      echo "<h1>$channelName</h1>";
    ?>
    <form id="trial" action="PasswordVerifier.php" method="POST">
      <input name="pass" type="password" id='password' placeholder="your password" required /><br>
      <input type="hidden" name="email" id="email" value="<?php echo $_POST["email"]?>">
      <input type="hidden" name="idChannel" id="idChannel" value="<?php echo $channelId?>">
      <input type="hidden" name="namaChannel" id="namaChannel" value="<?php echo $channelName;?>">
      <input type="hidden" name="gambarnya" id="gambarnya" value = "<?php echo $imgPath?>">  
      <button type="submit">Submit</button>
    </form>
    <?php
    if(!empty($pass)){
        echo "<h1> Wrong Password</h1>";
    }
    ?>
  </div>  

</body>
</html>