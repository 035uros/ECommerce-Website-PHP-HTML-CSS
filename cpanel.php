<?php
 
 use PHPMailer as GlobalPHPMailer;
 use PHPMailer\PHPMailer\PHPMailer;
error_reporting(E_ERROR | E_PARSE);
session_start();
 if ($_SESSION["potvrdjenpristup"] != true){
  header( 'location: /index.php' );
 }
//error_reporting(E_ERROR | E_PARSE);
include 'baza_podataka.php';
function brisanje($id){

 $conn = OpenCon2();

 $sql="DELETE FROM proizvodi WHERE proizvodi.id_Potrosaca ='$id'";

 $conn->query($sql);

 $sql="DELETE FROM potrosac WHERE potrosac.id_Potrosaca ='$id'";

 $conn->query($sql);

 $conn->close();
}

if (isset($_POST['brisi'])) {
   brisanje($_POST['brisi']);
 }
 if (isset($_POST['generisi'])) {
   $mysqli = OpenCon2();
   $mysqli->query("SET NAMES 'utf8'");
   $query = "SELECT COUNT(*) AS BROJ FROM potrosac JOIN proizvodi ON potrosac.id_Potrosaca=proizvodi.id_Potrosaca WHERE (SELECT DATE_FORMAT(potrosac.vreme_Narucivanja ,'%d-%m-%y'))=(SELECT DATE_FORMAT(SYSDATE(),'%d-%m-%y')) AND potrosac.verifikovan = 1";
   if ($result = $mysqli->query($query)) {
   while ($row = $result->fetch_assoc()) {
      if($row["BROJ"] == 0){
        echo '<script>alert("Danas nije bilo porudžbina :(")</script>';
      }
      else{
        generisanje();
      }
   }
  }
  $mysqli->close();
}
/** create XML file */ 
function generisanje(){

/*$mysqli = OpenCon2();
$mysqli->query("SET NAMES 'utf8'");
$query = "SELECT Ime, Adresa, broj_Telefona, Drzava, Email, potrosac.id_Potrosaca, Mesto, postanski_Broj, vreme_Narucivanja, proizvodi.Boja, proizvodi.Naziv, proizvodi.Cena, proizvodi.Velicina, proizvodi.Priprema, proizvodi.Primer, proizvodi.Tip, proizvodi.Kolicina, potrosac.ukupna_Cena FROM potrosac JOIN proizvodi ON potrosac.id_Potrosaca=proizvodi.id_Potrosaca WHERE (SELECT DATE_FORMAT(potrosac.vreme_Narucivanja ,'%d-%m-%y'))=(SELECT DATE_FORMAT(SYSDATE(),'%d-%m-%y')) ";
$narudzbina = array();
//CONCAT(Ime , " ", Prezime)as Ime
if ($result = $mysqli->query($query)) {
  

    while ($row = $result->fetch_assoc()) {
       array_push($narudzbina, $row);
    }
    if(count($narudzbina)){
         createXMLfile($narudzbina);
     }

    $result->free();
}

$mysqli->close();*/

require '/home/ziptie/public_html/PHPMailer-6.5.3/src/PHPMailer.php';
  require '/home/ziptie/public_html/PHPMailer-6.5.3/src/SMTP.php';
  require '/home/ziptie/public_html/PHPMailer-6.5.3/src/Exception.php';

$mail = new PHPMailer();
$mail->SMTPDebug = false;
$mail->isSMTP();                            // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';              // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                     // Enable SMTP authentication
$mail->Username = ' '; // your email id
$mail->Password = ' '; // your password
$mail->SMTPSecure = 'tls';                  
$mail->Port = 587;     //587 is used for Outgoing Mail (SMTP) Server.
$mail->setFrom(' ', 'ZIPTIE');
$mail->addAddress(' ');   // Add a recipient
$mail->addBcc(' ');
$mail->isHTML(true);  // Set email format to HTML
$mail->CharSet = 'UTF-8';
$body = createTable();
$mail->Subject = 'Lista kupaca ZIPTIE';
$mail->Body    = $body;
//$mail->addAttachment("/home/ziptie/narudzbine/naruzbine ".date("d-m-Y").".zip");
$mail->send();
/*if(!$mail->send()) {
  echo 'Message was not sent.';
  echo 'Mailer error: ' . $mail->ErrorInfo;
} else {
  echo 'Message has been sent.';
}*/
//array_map('unlink', glob("naruzbine ".date("d-m-Y")."/*.*"));
// rmdir("naruzbine ".date("d-m-Y"));
if (file_exists("/home/ziptie/narudzbine/naruzbine ".date("d-m-Y").".zip")) {
unlink("/home/ziptie/narudzbine/naruzbine ".date("d-m-Y").".zip");
}
global $obavestenjedodaje;
$obavestenjedodaje=1;
}
function createXMLfile($narudzbina){
   $id="strasilo";
   foreach ($narudzbina as $komad) {
    $ime        =  strval($komad['Ime']);
    if (!file_exists("/home/ziptie/narudzbine/naruzbine ". date("d-m-Y"))) {
      mkdir("/home/ziptie/narudzbine/naruzbine ". date("d-m-Y"), 0700, true);}
    if (!file_exists("/home/ziptie/narudzbine/naruzbine ". date("d-m-Y")."/".$ime)) {
      mkdir("/home/ziptie/narudzbine/naruzbine ". date("d-m-Y")."/".$ime, 0700, true);
  }
  
   }
   $dom     = new DOMDocument('1.0', 'utf-8'); 
   
   $dom->preserveWhiteSpace = false;
   $dom->formatOutput = true;

   foreach ($narudzbina as $komad) {

    $ime        =  $komad['Ime'];
    $naziv      =  $komad['Naziv']; 
    $tip  =  $komad['Tip'];  
    $boja     =  $komad['Boja']; 
    $velicina      =  $komad['Velicina']; 
    $kolicina  =  $komad['Kolicina']; 
    $priprema  =  $komad['Priprema']; 
    $primer  =  $komad['Primer'];
    $jedinicnacena        = intval($komad['Cena']); 
      
      
      $filePath = "/home/ziptie/narudzbine/naruzbine ". date("d-m-Y")."/".$ime."/podaci.xml";
      $root      = $dom->createElement('narudzbine');
      
    $narudzbina = $dom->createElement('narudzbina');
    

    if($id!=$komad['id_Potrosaca']){
      $id        =  $komad['id_Potrosaca'];
      $adresa     =  $komad['Adresa']; 
      $postanski      =  $komad['postanski_Broj'];
      $broj    =  $komad['broj_Telefona'];  
      $mesto  =  $komad['Mesto'];  
      $drzava     =  $komad['Drzava']; 
      $ukupno     =  $komad['ukupna_Cena'];
      
     $narudzbina->setAttribute('id', $id);

     $ukupno1     = $dom->createElement('ukupnoNaplatiti', $ukupno); 
     $narudzbina->appendChild($ukupno1); 
     
     $ime1     = $dom->createElement('ime', $ime); 
     $narudzbina->appendChild($ime1); 
     
     $broj1     = $dom->createElement('broj', $broj); 
     $narudzbina->appendChild($broj1); 
     
     $adresa1 = $dom->createElement('adresa', $adresa); 
     $narudzbina->appendChild($adresa1);

     $postanski1 = $dom->createElement('postanski', $postanski); 
     $narudzbina->appendChild($postanski1);
     
     $mesto1 = $dom->createElement('mesto', $mesto); 
     $narudzbina->appendChild($mesto1);

     $drzava1 = $dom->createElement('drzava', $drzava); 
     $narudzbina->appendChild($drzava1);
     
    }
     
     $naziv1 = $dom->createElement('naziv', $naziv); 
     $narudzbina->appendChild($naziv1);
     
     $tip1 = $dom->createElement('tip', $tip); 
     $narudzbina->appendChild($tip1);
     
     $boja1 = $dom->createElement('boja', $boja); 
     $narudzbina->appendChild($boja1);

     $velicina1 = $dom->createElement('velicina', $velicina); 
     $narudzbina->appendChild($velicina1);

     $kolicina1    = $dom->createElement('kolicina', $kolicina); 
     $narudzbina->appendChild($kolicina1); 

     $cena    = $dom->createElement('jedinicnacena', $jedinicnacena*$kolicina); 
     $narudzbina->appendChild($cena); 

     $root->appendChild($narudzbina);
     $dom->appendChild($root);
     $dom->save($filePath); 

    $imagePath = $priprema;
    $newPath = "/home/ziptie/narudzbine/naruzbine ". date("d-m-Y")."/".$ime."/";
    $ext = '.png';
    $newName  = $newPath.$naziv.$ext;
    copy($imagePath , $newName);
    $imagePath = $primer;
    $ext = '.png';
    $newName  = $newPath.$naziv." PRIMER ".$ext;
    copy($imagePath , $newName);
   } 

   $rootPath = realpath("/home/ziptie/narudzbine/naruzbine ".date("d-m-Y"));
// Initialize archive object
$zip = new ZipArchive();
$zip->open("/home/ziptie/narudzbine/naruzbine ".date("d-m-Y").".zip", ZipArchive::CREATE | ZipArchive::OVERWRITE);

// Create recursive directory iterator
/** @var SplFileInfo[] $files */
$files = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($rootPath),
    RecursiveIteratorIterator::LEAVES_ONLY
);

foreach ($files as $name => $file)
{
    // Skip directories (they would be added automatically)
    if (!$file->isDir())
    {
        // Get real and relative path for current file
        $filePath = $file->getRealPath();
        $relativePath = substr($filePath, strlen($rootPath) + 1);

        // Add current file to archive
        $zip->addFile($filePath, $relativePath);
    }
}

// Zip archive will be created only after closing object
$zip->close();
/* KOD ZA SKINDANJE ZIP FAJLA
header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename='.basename("naruzbine ".date("d-m-Y").".zip"));
header('Content-Transfer-Encoding: binary');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize("naruzbine ".date("d-m-Y").".zip"));
readfile("naruzbine ".date("d-m-Y").".zip");*/

 } 

 function createTable(){
   $temp=file_get_contents('mejlsaporudzbinama.html');
   $podacitabele = '<>';

  $mysqli = OpenCon2();
  $mysqli->query("SET NAMES 'utf8'");
  $query = "SELECT Ime, Adresa, broj_Telefona, Drzava, Email, potrosac.id_Potrosaca, Mesto, postanski_Broj, vreme_Narucivanja, proizvodi.Boja, proizvodi.Naziv, proizvodi.Cena, proizvodi.Velicina, proizvodi.Priprema, proizvodi.Primer, proizvodi.Tip, proizvodi.Kengur, proizvodi.Kolicina, potrosac.ukupna_Cena FROM potrosac JOIN proizvodi ON potrosac.id_Potrosaca=proizvodi.id_Potrosaca WHERE (SELECT DATE_FORMAT(potrosac.vreme_Narucivanja ,'%d-%m-%y'))=(SELECT DATE_FORMAT(SYSDATE(),'%d-%m-%y')) AND potrosac.verifikovan = 1";
  $podacitabele = '<table id="customers">';
  if ($result = $mysqli->query($query)) {

  
  while ($row = $result->fetch_assoc()) {
    if($row["Velicina"] == 'S' || $row["Velicina"] == 'M' || $row["Velicina"] == 'L' || $row["Velicina"] == 'XL' || $row["Velicina"] == 'XXL' || $row["Velicina"] == 'XXXL' || $row["Velicina"] == '4XL'){
      $pol = "Muski";
    }
    else{
      $pol = "Deciji";
    }
    if($row["Tip"] == 'Duks'){
      if($row["Kengur"] == 'Da'){
        $tip="Duksevi / Kapuljača džep";
      }
      else{
        $tip="Duksevi / Kapuljača";
      }
    }
    else if($row["Tip"] == 'Majica'){
      $tip="Majice / Kratki rukav";
    }else if($row["Tip"] == 'Majica dugih rukava'){
      $tip="Majice / Dugi rukav";
    }
    else{
      $tip=$row["Tip"];
    }
    $ime = explode(" ", $row["Ime"]);
    $podacitabele .= '<tr><td>'.$row["vreme_Narucivanja"].'</td><td>'.$row["Kolicina"].'</td><td>'.$row["Boja"].'</td><td>'.$pol.'</td><td>'.$row["Velicina"].'</td><td>'.$tip.'</td><td></td><td>'.$row["Naziv"].'</td><td></td><td></td><td></td><td>'.$ime[0].'</td><td>'.$ime[1].'</td><td>'.$row["Adresa"].'</td><td></td><td></td><td></td><td>'.$row["Mesto"].'</td><td>'.$row["postanski_Broj"].'</td><td>'.$row["Drzava"].'</td><td>'.$row["broj_Telefona"].'</td><td>'.$row["Email"].'</td><td>'.intval($row["Cena"]).'</td></tr>';
  }
  
  $podacitabele .= '</table>';
}
$mysqli->close();
$temp = str_replace(array('{::}'), $podacitabele, $temp);
  return $temp;//aa
 }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Kontrolna tabla</title>
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
    <link rel="stylesheet" type="text/css" href="libs/jquery-ui/jquery-ui.min.css">
    <link rel="stylesheet" type="text/css" href="libs/superfish-menu/css/superfish.min.css">
    <link rel="stylesheet" type="text/css" href="libs/slick-sider/slick.min.css">
    <link rel="stylesheet" type="text/css" href="libs/slick-sider/slick-theme.min.css">
    <link rel="stylesheet" type="text/css" href="libs/swiper-sider/dist/css/swiper.min.css">
    <link rel="stylesheet" type="text/css" href="libs/magnific-popup/dist/magnific-popup.min.css">

    <!-- Theme CSS-->
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/shortcodes.css">
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
    <header class="header mv-header-style-1 mv-wrap">
        

        <div class="header-main-nav mv-fixed-enabled">
         <div class="container">
           <div class="container-inner">
             <div class="header-toggle-off-canvas hidden-md hidden-lg">
               <button type="button" class="mv-btn mv-btn-style-5 btn-off-canvas-toggle click-btn-off-canvas-left"><i class="icon fa fa-bars"></i></button>
             </div>
             <!-- .header-toggle-off-canvas-->

             <div class="header-logo"><a href="index.php" title="Motor Vehikal"><img src="images/logo/logo_2.png" alt="logo" class="logo-img img-default image-live-view"/><img src="images/logo/logo_2.png" alt="logo" class="logo-img img-scroll image-live-view"/></a></div>
             <!-- .header-logo-->

             <div class="main-nav-wrapper hidden-xs hidden-sm">
               <div style="float:left; padding-left: 240px;">
               <nav class="main-nav">
                 <ul class="nav sf-menu">
                   <li class="mega-columns"><a href="index.php"><span class="menu-text">Početna</span></a>
                   </li>
                   <li><a href="#"><span class="menu-text">Proizvodi <i class="menu-icon fa fa-angle-down"></i></span></a>
                     <ul>
                       <li><a href="product-grid-3.php?t=Majica&k=">Majice</a></li>
                       <li><a href="product-grid-3.php?t=Majica dugih rukava&k=">Majice dugih rukava</a></li>
                       <li><a href="product-grid-3.php?t=Duks&k=">Duksevi</a></li>
                       <li><a href="product-grid-3.php?t=Aksesoari&k=">Aksesoari</a></li>
                     </ul>
                   </li>
                   <li><a href="#"><span class="menu-text">Kupovina <i class="menu-icon fa fa-angle-down"></i></span></a>
                     <ul>
                       <li><a href="cart.php">Korpa</a></li>
                       <li><a href="checkout.php">Kasa</a></li>
                       <!-- <li><a href="track-your-order.html">Track Your Order</a></li>-->
                       <!--<li><a href="cart-empty.html">Cart Empty</a></li>-->
                     </ul>
                   </li>
                   <!--<li><a href="#"><span class="menu-text">Blog <i class="menu-icon fa fa-angle-down"></i></span></a>
                     <ul>
                       <li><a href="blog-list.html">Blog List</a></li>
                       <li><a href="blog-grid-2.html">Blog Grid 2</a></li>
                       <li><a href="blog-grid-3-no-sb.html">Blog Grid 3 No Sidebar</a></li>
                       <li><a href="blog-grid-3-mansory-no-sb.html">Blog Grid 3 Mansory No Sidebar</a></li>
                       <li><a href="blog-detail.html">Blog Detail</a></li>
                     </ul>
                   </li>-->
                   <li><a href="about-us.php"><span class="menu-text">O nama</span></a></li>
                    <li><a href="#"><span class="menu-text">Kontrolna tabla <i class="menu-icon fa fa-angle-down"></i></span></a>
                     <ul>
                       <li><a href="cpanel.php">Dnevni izveštaj</a></li>
                       <li><a href="cpanel2.php">Mesečni izveštaj</a></li>
                       <!-- <li><a href="track-your-order.html">Track Your Order</a></li>-->
                       <!--<li><a href="cart-empty.html">Cart Empty</a></li>-->
                     </ul>
                   <!--<li><a href="contact.html"><span class="menu-text">Kontakt</span></a></li>-->
                  
                 </ul>
               </nav>
               </div>
             </div>
             <!-- .header-main-nav-->

             <div class="header-right-button">
               <div class="header-search">
                 <!-- <div class="item-button">
                   <button type="button" data-toggle="modal" data-target="#popupSearch" class="mv-btn mv-btn-style-10 btn-open-field-search"><i class="fa fa-search"></i></button>
                   <button type="button" class="mv-btn mv-btn-style-10 btn-open-filter click-btn-off-canvas-right hidden-md hidden-lg"><i class="fa fa-filter mv-f-18"></i></button>
                 </div>-->
               </div>
               <!-- .header-search-->

               
             </div>
           </div>
         </div>
       </div>
       <!-- .header-main-nav-->
     </header>
     <!-- .header-->

      <section class="main-banner mv-wrap">
        <div data-image-src="images/background/login.jpg" class="mv-banner-style-1 mv-bg-overlay-dark overlay-0-85 mv-parallax">
          <div class="page-name mv-caption-style-6">
            <div class="container">
              <div class="mv-title-style-9"><span class="main">Kontrolna tabla</span><img src="images/icon/icon_line_polygon_line.png" alt="icon" class="line"/></div>
            </div>
          </div>
        </div>
      </section>
      <!-- .main-banner-->

      <section class="main-breadcrumb mv-wrap">
        <div class="mv-breadcrumb-style-1">
          <div class="container">
            <ul class="breadcrumb-1-list">
              <li><a href="home.html"><i class="fa fa-home"></i></a></li>
              <li><a>Kontrolna tabla</a></li>
            </ul>
          </div>
        </div>
      </section>
      <!-- .main-breadcrumb-->
      <?php 
      if($obavestenjedodaje==1){
      echo '
      <div class="alert">
      <span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span>
      Generisano i poslato.
      </div> ';
      }
      ?>

      <section class="mv-main-body login-main mv-bg-gray mv-wrap">
        <div style="padding:15px;">
          
        <div class="wishlist-inner mv-bg-white mv-box-shadow-gray-1">
            <div class="mv-table-responsive">
              <table class="mv-table-style-3">
              <thead>
                  <tr>
                    <th style="width:90px">Ime, Prezime, Datum</th>
                    <th style="width:90px">Broj Telefona</th>
                    <th style="width:90px">Adresa</th>
                    <th style="width:90px">Postanski broj</th>
                    <th style="width:90px">Mesto</th>
                    <th style="width:90px">Drzava</th>
                    <th style="width:90px">Email</th>
                    <th style="width:90px">Naziv</th>
                    <th style="width:90px">Tip</th>
                    <th style="width:90px">Boja</th>
                    <th style="width:90px">Veličina</th>
                    <th style="width:90px">Količina</th>
                    <th style="width:110px"></th>
                  </tr>
                </thead>

        <?php 

         $conn = OpenCon2();
         $conn->query("SET NAMES 'utf8'");
    
         $sql="SELECT * FROM potrosac JOIN proizvodi ON potrosac.id_Potrosaca=proizvodi.id_Potrosaca WHERE (SELECT DATE_FORMAT(potrosac.vreme_Narucivanja ,'%d-%m-%y'))= (SELECT DATE_FORMAT(SYSDATE(),'%d-%m-%y')) AND potrosac.verifikovan = 1";
     
         $rezultat=$conn->query($sql);
     
         if($rezultat->num_rows > 0){
         while($red = $rezultat->fetch_assoc()){
             echo "<tr>";
             echo '<td>'. $red["Ime"]. ' '. $red["vreme_Narucivanja"]. '</td>';
             echo '<td>'. $red["broj_Telefona"]. '</td>';
             echo '<td>'. $red["Adresa"]. '</td>';
             echo '<td>'. $red["postanski_Broj"]. '</td>';
             echo '<td>'. $red["Mesto"]. '</td>';
             echo '<td>'. $red["Drzava"]. '</td>';
             echo '<td>'. $red["Email"]. '</td>';
             echo '<td>'. $red["Naziv"]. '</td>';
             echo '<td>'. $red["Tip"]. '</td>';
             echo '<td>'. $red["Boja"]. '</td>';
             echo '<td>'. $red["Velicina"]. '</td>';
             echo '<td>'. $red["Kolicina"]. '</td>';
             echo '<form method="post"><td><button class="mv-btn mv-btn-style-5 btn-5-h-45 responsive-btn-5-type-1" name="brisi" onclick="return confirm(\'Sigurno, nakon brisanja nema povratka informacija?\')" value="'. $red["id_Potrosaca"]. '">Obrisi</button></td></form>';
         }
         }
         $conn->close();
         ?>
        </tr>
    </table>
    </div>
    <div class="checkout-block block-button-place-order mv-box-shadow-gray-1">
            <div class="mv-dp-table align-middle">
              <div class="mv-dp-table-cell col-checkbox">
              <div class="mv-dp-table-cell col-button text-right">
              <form action="cpanel.php" method="post">
                <button type="submit" value="Generisi poruzbine" name="generisi" class="mv-btn mv-btn-style-5 btn-5-h-45 responsive-btn-5-type-1">Generiši porudžbenicu</button></div>
              </form>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- .mv-main-body-->

     

      <footer class="footer mv-footer-style-2 mv-wrap">
        <div style="background-image: url(images/background/pozadinafuter.png)" class="footer-bg">
          <div class="container">
            <div class="footer-inner">
              <div id="footerNav" role="tablist" aria-multiselectable="true" class="footer-nav panel-group">
                <div class="row">
                  <div class="col-md-3 footer-nav-col footer-contact" ><a data-toggle="collapse" data-parent="#footerNav" href="#footerContact" aria-expanded="true" aria-controls="footerContact" class="footer-title collapsed">KONTAKT</a>
                    <div id="footerContact" role="tabpanel" class="footer-main collapse">
                      <ul class="mv-ul footer-main-inner list" >
                            <!--  <li class="mv-icon-left-style-1 item">
                          <div class="mv-dp-table align-middle">
                            <div class="mv-dp-table-cell icon"><i class="icon-fa fa fa-map-marker mv-f-22 mv-color-primary"></i></div>
                            <div class="mv-dp-table-cell text">123 Sky Tower address name, Los Algeles</div>
                          </div>
                        </li>-->
                        <li class="mv-icon-left-style-1 item">
                          <div class="mv-dp-table align-middle">
                            <div class="mv-dp-table-cell icon"><i class="icon-fa fa fa-mobile mv-f-26 mv-color-primary"></i></div>
                            <div class="mv-dp-table-cell text">Kontakt telefoni: </br>+381 61 734 79 03 </br>+381 61 411 10 02</div>
                          </div>
                        </li>
                        <li class="mv-icon-left-style-1 item">
                          <div class="mv-dp-table align-middle">
                            <div class="mv-dp-table-cell icon"><i class="icon-fa fa fa-envelope-o mv-f-20 mv-color-primary"></i></div>
                            <div class="mv-dp-table-cell text">email:<a href="mailto:office.ziptie@gmail.com"> office.ziptie@gmail.com</a></div>
                          </div>
                        </li>
                      </ul>
                    </div>
                  </div>

                  <div class="col-md-3 footer-nav-col footer-about-us" ><a data-toggle="collapse" data-parent="#footerNav" href="#footerAboutUs" aria-expanded="false" aria-controls="footerAboutUs" class="footer-title collapsed">O NAMA</a>
                    <div id="footerAboutUs" role="tabpanel" class="footer-main collapse">
                      <div class="footer-main-inner">
                        <div class="about-us-content">
                          <p>ZIPTIE predstavlja skupinu entuzijasta koji svoju strast prema automobilima izražava kroz garderobu.</p>
                          <p>Svi se divimo mašinama, njihovom uticaju na istoriju automobila i auto-moto sport - zašto ih ne ovekovečiti garderobom?</p>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- <div class="col-md-3 footer-nav-col footer-faqs"><a data-toggle="collapse" data-parent="#footerNav" href="#footerFaqs" aria-expanded="false" aria-controls="footerFaqs" class="footer-title collapsed">faqs</a>
                    <div id="footerFaqs" role="tabpanel" class="footer-main collapse">
                      <ul class="mv-ul footer-main-inner list">
                        <li class="item mv-icon-left-style-2"><a href="#"><span class="text"><span class="icon"><i class="fa fa-angle-right"></i></span>Kontaktiraj nas</span></a></li>
                        <li class="item mv-icon-left-style-2"><a href="#"><span class="text"><span class="icon"><i class="fa fa-angle-right"></i></span>Povrat garderobe</span></a></li>
                        <li class="item mv-icon-left-style-2"><a href="#"><span class="text"><span class="icon"><i class="fa fa-angle-right"></i></span>Veličine</span></a></li>
                        <li class="item mv-icon-left-style-2"><a href="#"><span class="text"><span class="icon"><i class="fa fa-angle-right"></i></span>Dostava</span></a></li>
                        <li class="item mv-icon-left-style-2"><a href="#"><span class="text"><span class="icon"><i class="fa fa-angle-right"></i></span>Plaćanje</span></a></li>
                      </ul>
                    </div>
                  </div>

                  <div class="col-md-3 footer-nav-col footer-order-tracking"><a data-toggle="collapse" data-parent="#footerNav" href="#footerOrderTracking" aria-expanded="false" aria-controls="footerOrderTracking" class="footer-title collapsed">order tracking</a>
                    <div id="footerOrderTracking" role="tabpanel" class="footer-main collapse">
                      <ul class="mv-ul footer-main-inner list">
                        <li class="item mv-icon-left-style-2"><a href="#"><span class="text"><span class="icon"><i class="fa fa-angle-right"></i></span>About us</span></a></li>
                        <li class="item mv-icon-left-style-2"><a href="#"><span class="text"><span class="icon"><i class="fa fa-angle-right"></i></span>Returns</span></a></li>
                        <li class="item mv-icon-left-style-2"><a href="#"><span class="text"><span class="icon"><i class="fa fa-angle-right"></i></span>Contact us</span></a></li>
                        <li class="item mv-icon-left-style-2"><a href="#"><span class="text"><span class="icon"><i class="fa fa-angle-right"></i></span>Term & Conditions</span></a></li>
                        <li class="item mv-icon-left-style-2"><a href="#"><span class="text"><span class="icon"><i class="fa fa-angle-right"></i></span>Privacy Policy</span></a></li>
                      </ul>
                    </div>
                  </div>-->
                </div>
              </div>
              <!-- .footer-nav-->

               <!--<div class="footer-payment">
                <ul class="mv-ul list">
                  <li class="item"><a href="#"><img src="images/icon/icon_paypal.png" alt="icon"/></a></li>
                  <li class="item"><a href="#"><img src="images/icon/icon_master_card.png" alt="icon"/></a></li>
                  <li class="item"><a href="#"><img src="images/icon/icon_american_express.png" alt="icon"/></a></li>
                  <li class="item"><a href="#"><img src="images/icon/icon_visa.png" alt="icon"/></a></li>
                </ul>
              </div>-->
              <!-- .footer-payment-->

              <div class="footer-copyright text-center">Copyright &copy; 2022 ZIPTIE Sva prava zadržana.</div>
              <!-- .footer-copyright-->
            </div>
          </div>
        </div>

        <button type="button" class="mv-btn mv-btn-style-17 mv-back-to-top fixed-right-bottom"><i class="btn-icon fa fa-long-arrow-up"></i></button>
      </footer>

      <div class="off-canvas-wrapper-left hidden-md hidden-lg">
      <div class="off-canvas-left">
        <div class="off-canvas-header">
          <button class="btn-close-off-canvas click-close-off-canvas">x</button>
        </div>
        <div class="off-canvas-body">
          <nav class="main-nav">
            <ul class="nav sf-menu expand-all">
              <li class="mega-columns"><a href="index.php"><span class="menu-text">Početna </i></span></a></li>
              <li><a href="product-grid-3.php"><span class="menu-text">Proizvodi <i class="menu-icon fa fa-angle-down"></i></span></a>
                <ul>
                <li><a href="product-grid-3.php?t=Majica&k=">Majice</a></li>
                        <li><a href="product-grid-3.php?t=Majica dugih rukava&k=">Majice dugih rukava</a></li>
                        <li><a href="product-grid-3.php?t=Duks&k=">Duksevi</a></li>
                        <li><a href="product-grid-3.php?t=Aksesoari&k=">Aksesoari</a></li>
                </ul>
              </li>
              <li><a href="product-grid-3.php"><span class="menu-text">Kupovina <i class="menu-icon fa fa-angle-down"></i></span></a>
                <ul>
                    <li><a href="cart.php">Korpa</a></li>
                    <li><a href="checkout.php">Kasa</a></li>
                </ul>
              </li>
              <!-- <li><a href="#"><span class="menu-text">Blog <i class="menu-icon fa fa-angle-down"></i></span></a>
                <ul>
                  <li><a href="blog-list.html">Blog List</a></li>
                  <li><a href="blog-grid-2.html">Blog Grid 2</a></li>
                  <li><a href="blog-grid-3-no-sb.html">Blog Grid 3 No Sidebar</a></li>
                  <li><a href="blog-grid-3-mansory-no-sb.html">Blog Grid 3 Mansory No Sidebar</a></li>
                  <li><a href="blog-detail.html">Blog Detail</a></li>
                </ul>
              </li>-->
              <li><a href="about-us.php"><span class="menu-text">O nama</span></a></li>
              <li><a href="#"><span class="menu-text">Kontrolna tabla <i class="menu-icon fa fa-angle-down"></i></span></a>
                     <ul>
                       <li><a href="cpanel.php">Dnevni izveštaj</a></li>
                       <li><a href="cpanel2.php">Mesečni izveštaj</a></li>
                       <!-- <li><a href="track-your-order.html">Track Your Order</a></li>-->
                       <!--<li><a href="cart-empty.html">Cart Empty</a></li>-->
                     </ul>
                   </li>
            </ul>
          </nav>
        </div>
      </div>
    </div>
    <!-- .off-canvas-wrapper-left-->

    
  </div>
  <!-- .mv-site-->



    <!-- Vendor jQuery-->
    <script type="text/javascript" src="libs/jquery/jquery-2.1.4.min.js"></script>
    <script type="text/javascript" src="libs/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="libs/smoothscroll/SmoothScroll.min.js"></script>
    <script type="text/javascript" src="libs/superfish-menu/js/superfish.min.js"></script>
    <script type="text/javascript" src="libs/jquery-ui/jquery-ui.min.js"></script>
    <script type="text/javascript" src="libs/jquery-ui/external/touch-punch/jquery.ui.touch-punch.min.js"></script>
    <script type="text/javascript" src="libs/jquery-ui/external/jquery.mousewheel.min.js"></script>
    <script type="text/javascript" src="libs/parallax/parallax.min.js"></script>
    <script type="text/javascript" src="libs/jquery-countto/jquery.countTo.min.js"></script>
    <script type="text/javascript" src="libs/jquery-appear/jquery.appear.min.js"></script>
    <script type="text/javascript" src="libs/as-pie-progress/jquery-asPieProgress.min.js"></script>
    <script type="text/javascript" src="libs/caroufredsel/helper-plugins/jquery.touchSwipe.min.js"></script>
    <script type="text/javascript" src="libs/caroufredsel/jquery.carouFredSel-6.2.1-packed.js"></script>
    <script type="text/javascript" src="libs/isotope/isotope.pkgd.min.js"></script>
    <script type="text/javascript" src="libs/isotope/fit-columns.min.js"></script>
    <script type="text/javascript" src="libs/slick-sider/slick.min.js"></script>
    <script type="text/javascript" src="libs/lwt-countdown/jquery.lwtCountdown-1.0.min.js"></script>
    <script type="text/javascript" src="libs/swiper-sider/dist/js/swiper.min.js"></script>
    <script type="text/javascript" src="libs/magnific-popup/dist/jquery.magnific-popup.min.js"></script>
    <script type="text/javascript" src="libs/jplayer/dist/jplayer/jquery.jplayer.min.js"></script>
    <script type="text/javascript" src="libs/jquery-cookie/jquery.cookie.min.js"></script>

    <script type="text/javascript" src="js/main.js"></script>
  </body>
</html>