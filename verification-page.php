<?php
session_start();
include 'baza_podataka.php';
$total=0;
$totaltrosak=0;
if(isset($_GET['sifra'])){
  $sifra=$_GET['sifra'];
  $conn = OpenCon2();
  $conn->query("SET NAMES 'utf8'");

  $sql="SELECT verifikovan, token_Verifikacije FROM potrosac WHERE verifikovan = 0 AND token_Verifikacije = '$sifra' LIMIT 1";
  $conn->query($sql);

  $rezultat = $conn->query($sql); 
  if($rezultat->num_rows == 1){
    $update=$conn->query("UPDATE potrosac SET verifikovan = 1 WHERE token_Verifikacije = '$sifra' LIMIT 1");

    if($update){
      $conn->close();
      $ispis="Verifikacija usepšna. Očekujte paket kroz 2 - 4 radna dana.";
      }
    
  }else{
    $ispis="Ova porudžbina je već verifikovana ili nije validna, nova porudžbina se odbija. Ukoliko želite da prijavite grešku pišite nam na office.ziptie@gmail.com";
  }

}
else{
  $ispis="Zahtev za verifikaciju poslat, proverite Vaš mejl. Ukoliko želite da prijavite grešku pišite nam na office.ziptie@gmail.com";
}


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Verifikacija porudžbine</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Favicon-->
    <link rel="shortcut icon" href="images/icon/favicon2.ico" type="image/x-icon">

    <!-- Web Fonts-->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Varela+Round">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Montserrat:400,700">

    <!-- Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="libs/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="libs/font-awesome/css/font-awesome.min.css">

    <!-- Theme CSS-->
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/style-selector.css">
    <link id="style-main-color" rel="stylesheet" type="text/css" href="css/color/color1.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries-->
    <!-- WARNING: Respond.js doesn't work if you view the page via file://-->
    <!--if lt IE 9
    script(src='https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js')
    script(src='https://oss.maxcdn.com/respond/1.4.2/respond.min.js')
    
    -->
  </head>
  <body>
    <div class="mv-site">
      <div class="error-page">
        <div style="background-image: url(images/background/verification.jpg);" class="error-page-bg">
          <div class="error-page-inner">
            <div class="error-overlay"></div>
            <div class="error-main">
              <div class="error-message">
                <div class="message-text-1">Verifikacija</div>
                <div class="message-text-2"><?php echo $ispis;?></div><img src="images/icon/icon_line_polygon_line.png" alt="icon" class="message-img-1">
              </div>
              <!-- .error-message-->

              <!--<div class="error-404"><img src="images/other/404.png" alt="icon"></div>
              .error-404-->
              <?php
              echo '<div class="error-button"><a href="index.php" class="btn-back">Povratak na glavnu stranu.</a></div>';
              
              ?>
              
              <!-- .error-button-->
            </div>
          </div>
        </div>
      </div>
      <!-- .error-page-->
    </div>
    <!-- .mv-site-->

    <!-- Vendor jQuery-->
    <script type="text/javascript" src="libs/jquery/jquery-2.1.4.min.js"></script>
    <script type="text/javascript" src="libs/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="libs/jquery-cookie/jquery.cookie.min.js"></script>

    
    <script type="text/javascript" src="js/main.js"></script>
  </body>
</html>