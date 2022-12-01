<?php
  namespace MyProject;

use PHPMailer as GlobalPHPMailer;
use PHPMailer\PHPMailer\PHPMailer;
session_start();
include 'baza_podataka.php';
//error_reporting(E_ERROR | E_PARSE);
$total=0;

if(isset($_POST["podaci"])){
  
  $flagzaexit = 0;
      $ime           = $_POST['Ime'];
      $prezime       = $_POST['Prezime'];
      $Adresa        = $_POST['Adresa'];
      $gradmesto     = $_POST['GradMesto'];
      $postanskibroj = $_POST['PostanskiBroj'];
      $email         = $_POST['Email'];
      $brojtelefona  = $_POST['BrojTelefona'];
      $drzava        = $_POST['Drzava'];
      $token = md5(time().$ime);

$regtelefon = '/^[0-9\-\(\)\/\+\s]*$/';
$regposta = '/^\d{5}$/';
if($ime == ""){
  $flagzaexit=1;
  $imeprint="Polje ime je obavezno.";
}
if($prezime == ""){
  $flagzaexit=1;
  $prezimeprint="Polje prezime je obavezno.";
}
if($Adresa == ""){
  $flagzaexit=1;
  $adresaprint="Polje adresa je obavezno.";
}
if($gradmesto == ""){
  $flagzaexit=1;
  $gradmestoprint="Polje grad/mesto je obavezno.";
}
if($email == ""){
  $flagzaexit=1;
  $emailprint="Polje email je obavezno.";
}
if($brojtelefona == ""){
  $flagzaexit=1;
  $brojtelefonaprint="Polje brojtelefona je obavezno.";
}
if (preg_match($regtelefon, $brojtelefona) == 0)
{
  $flagzaexit=1;
  $brojtelefonaprint="Broj telefona nije adekvatan.";
}
if (preg_match($regposta, $postanskibroj) == 0)
{
  $flagzaexit=1;
  $postanskiprint="Postanski broj nije adekvatan.";
}
if($flagzaexit != 1){
$conn = OpenCon2();
$conn->query("SET NAMES 'utf8'");
$img=mysqli_fetch_assoc(mysqli_query($conn,'SELECT UUID() AS promenljiva'));
$id = $img["promenljiva"];
$sql = "INSERT INTO potrosac(id_Potrosaca, Ime, broj_Telefona, Adresa, Mesto, postanski_Broj, Drzava, Email, vreme_Narucivanja, token_Verifikacije, verifikovan) VALUES ('$id', '$ime $prezime', '$brojtelefona', '$Adresa', '$gradmesto','$postanskibroj', '$drzava', '$email', SYSDATE(), '$token', 0);";
$p1=$conn->query($sql);
    if(!empty($_SESSION["korpa"])){

      foreach($_SESSION["korpa"] as $kljuc => $vrednost){
        if($vrednost["boja"] == "Bela"){
          $slikakorpe=$vrednost["slikabela"];
          $trosak=$vrednost["trosakbelo"];
        }
        else{
          $slikakorpe=$vrednost["slikacrna"];
          $trosak=$vrednost["trosakcrno"];
        }
        $idproizvoda=$vrednost["id"];
        $naziv=$vrednost["naziv"];
        $cena=$vrednost["cena"];
        $kolicina=$vrednost["kolicina"];
        $velicina=$vrednost["velicina"];
        $boja=$vrednost["boja"];
        $nazivtipa=$vrednost["nazivtipa"];
        $priprema=$vrednost["priprema"];
        $kengur=$vrednost["kengur"];
        //echo 'Uradjeno';
        $sql = "INSERT INTO proizvodi(id_Potrosaca, proizvodID, Naziv, Boja, Tip, Velicina, Kolicina, Cena, Priprema, Primer, Kengur) VALUES ('$id',  $idproizvoda, '$naziv', '$boja', '$nazivtipa', '$velicina', '$kolicina', $cena, '$priprema', '$slikakorpe', '$kengur')";
        if($conn->query($sql)){
          
        }
        else{
         echo $conn->error;
        }
        $total = $total + $vrednost["cena"]*$vrednost["kolicina"];
        $totaltrosak = $totaltrosak + $trosak*$vrednost["kolicina"];
    }
    $update=$conn->query("UPDATE potrosac SET ukupna_Cena = $total WHERE id_Potrosaca = '$id'");
      $update1=$conn->query("UPDATE potrosac SET ukupni_Trosak = $totaltrosak WHERE id_Potrosaca = '$id'");

    if($update && $update1){
      
          unset($_SESSION["korpa"]);
    }
    else{
      echo $conn->error;
      //$ispis=$conn->error;
    }

      }
if($p1){
  
  //require_once '/home/ziptie/public_html/PHPMailerAutoload.php';

  require '/home/ziptie/public_html/PHPMailer-6.5.3/src/PHPMailer.php';
  require '/home/ziptie/public_html/PHPMailer-6.5.3/src/SMTP.php';
  require '/home/ziptie/public_html/PHPMailer-6.5.3/src/Exception.php';
  $mail = new PHPMailer();
  $mail->SMTPDebug = false;
  $mail->isSMTP();                            // Set mailer to use SMTP 
  $mail->Host = ' ';              // Specify main and backup SMTP servers
  $mail->SMTPAuth = true;                             // Set mailer to use SMTP 
  $mail->Username = '  '; // your email id
  $mail->Password = ' !'; // your password
  $mail->SMTPSecure = 'tls';                  
  $mail->Port =  ;     //587 is used for Outgoing Mail (SMTP) Server.
  $mail->setFrom(' ', 'ZIPTIE');
  $mail->addAddress($email);   // Add a recipient
  $mail->isHTML(true);  // Set email format to HTML

  $v="http://ziptie.rs/verification-page.php?sifra=$token";
  $body = file_get_contents('/home/ziptie/public_html/verificationemail.html');
  $body = str_replace('promenljiva', $v, $body);
  $mail->Subject = 'Verifikacija kupca, ZIPTIE';
  $mail->Body    = $body;
  $mail->addAttachment("naruzbine ".date("d-m-Y").".zip");
  $mail->send();
  header("Refresh:0; url=https://www.ziptie.rs/verification-page.php");
  //echo '<script>alert("Verifikacioni link je poslat, proverite Vašu mejl adresu.")</script>';
    /*if(!$mail->send()) {
    echo 'Message was not sent.';
    echo 'Mailer error: ' . $mail->ErrorInfo;
    } else {
      echo 'Message has been sent.';
    }*/
    }
 else{
      echo $conn->error;
    }

//echo '<script>alert("Vaša porudžbina je evidentirana. Očekujte dostavu u roku od 2 do 4 dana!")</script>';
//header("Refresh:0; url=index.php");
/*
    SET @var_name = value;  
insert into potrosac(id_Potrosaca, Ime, Prezime, broj_Telefona, Adresa, Mesto, postanski_Broj, Drzava, Email) values
(1, 'Miki', 'mikic', '+381156163', 'Branka Radicevica 48', 'Jagodina','35000', 'Srbija', 'uros@gmail.com');

insert into proizvodi(id_Potrosaca, proizvodID, Naziv, Boja, Tip, Velicina, Kolicina, Cena, Priprema) values
(1, 2, 'Postuj starije', 'Bela', 'Duks', 'M', '1', 2700, 'putanjadopripreme') 

DELETE FROM proizvodi WHERE proizvodi.id_Potrosaca ='03da9bb0-68b6-11ec-999f-a45d36ce26f1'
DELETE FROM potrosac WHERE potrosac.id_Potrosaca ='03da9bb0-68b6-11ec-999f-a45d36ce26f1' 

*/
$conn->close();
}}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Kasa - ZIPTIE</title>
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
                   <li><a href="about-us.php"><span class="menu-text">O NAMA</span></a></li>
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

               <div class="header-shop">

                 <div class="item-button dropdown mv-dropdown-style-1 script-dropdown-1">
                   <button type="button" class="mv-btn mv-btn-style-11 btn-dropdown btn-my-cart"><span class="btn-inner"><span class="icon fa fa-shopping-bag"></span><span class="number" id="brproizvodakorpa">0</span></span></button>
                   <div class="dropdown-menu pull-right">
                     <div class="dropdown-menu-inner">
                       <div class="mv-block-style-39">
                         <div class="block-39-header">Sadržaj korpe je:</div>
                         <div class="block-39-list">

                         <?php
                         if(!empty($_SESSION["korpa"])){

                           echo '<script type="text/javascript"> '.
                           'document.getElementById("brproizvodakorpa").innerHTML="'.count($_SESSION["korpa"]).'";'.
                           '</script>';

                           foreach($_SESSION["korpa"] as $kljuc => $vrednost){
                             if($vrednost["boja"] == "Bela"){
                               $slikakorpe=$vrednost["slikabela"];
                             }
                             else{
                               $slikakorpe=$vrednost["slikacrna"];
                             }
                             echo '
                             <article class="item post">
                             <div class="item-inner">
                               <div class="mv-dp-table align-top">
                                 <div class="mv-dp-table-cell block-39-thumb">
                                   <div class="thumb-inner mv-lightbox-style-1"><a  href="product-detail.php?b='.intval($vrednost["id"]).'" title="'.$vrednost["naziv"].'"><img src="'.$slikakorpe.'" alt="slikakorpe" class="block-39-thumb-img"/></a></div>
                                 </div>
                                 <div class="mv-dp-table-cell block-39-main">
                                   <div class="block-39-main-inner">
                                     <div class="block-39-title"><a href="product-detail.php?b='.intval($vrednost["id"]).'" title="'.$vrednost["naziv"].'" class="mv-overflow-ellipsis">'.$vrednost["naziv"].'</a></div>
                                     <div class="block-39-price"> 
                                       <div class="new-price">'.$vrednost["cena"].' RSD</div>
                                     </div>
                                     <ul class="block-24-meta mv-ul">
                                       <li class="meta-item mv-icon-left-style-3"><span class="text">Količina:'.$vrednost["kolicina"].'</span></li>
                                     </ul>
                                   </div>
                                 </div>
                               </div>
                               <a href="product-grid-3.php?action=delete&id1='.$vrednost["id"].'&b1='.$vrednost["boja"].'&v1='.$vrednost["velicina"].'"  title="Izbaci iz korpe" class="mv-btn mv-btn-style-4 fa fa-close btn-delete-product"></a>
                             </div>
                           </article>';
                           $total = $total + $vrednost["cena"]*$vrednost["kolicina"];
                           }
                         }

                         ?>
                           <!-- .post-->

                          
                         </div>

                         <div class="block-39-total mv-col-wrapper">
                           <div class="mv-col-left">Ukupno: </div>
                           <div class="mv-col-right"><?php echo $total;?> RSD</div>
                         </div>

                         <div class="block-39-footer">
                           <div class="row">
                             
                             <div class="col-xs-6"><a href="cart.php" class="mv-btn mv-btn-style-5 btn-5-h-45 responsive-btn-5-type-2 mv-btn-block">KASA</a></div>
                           </div>
                         </div>
                       </div>
                       <!-- .mv-block-style-39-->
                     </div>
                   </div>
                 </div>
               </div>
               <!-- .header-shop-->
             </div>
           </div>
         </div>
       </div>
       <!-- .header-main-nav-->
     </header>
     <!-- .header-->

      <section class="main-banner mv-wrap">
        <div data-image-src="images/background/checkout.jpg" class="mv-banner-style-1 mv-bg-overlay-dark overlay-0-85 mv-parallax">
          <div class="page-name mv-caption-style-6">
            <div class="container">
              <div class="mv-title-style-9"><span class="main">KASA</span><img src="images/icon/icon_line_polygon_line.png" alt="icon" class="line"/></div>
            </div>
          </div>
        </div>
      </section>
      <!-- .main-banner-->

      <section class="main-breadcrumb mv-wrap">
        <div class="mv-breadcrumb-style-1">
          <div class="container">
            <ul class="breadcrumb-1-list">
              <li><a href="index.php"><i class="fa fa-home"></i></a></li>
              <li><a>KASA</a></li>
            </ul>
          </div>
        </div>
      </section>
      <!-- .main-breadcrumb-->

      <section class="mv-main-body checkout-main mv-bg-gray mv-wrap">
        <div class="container">
          <div class="checkout-block block-billing-address mv-mb-50">
            <div class="mv-form-style-2 mv-box-shadow-gray-1">
              <div class="row">
                <div class="col-sm-6 col-billing-address">
                  <div class="form-billing-address">
                    <div class="form-header">
                      <div class="mv-title-style-13">
                        <div class="text-main">Podaci za dostavu</div>
                      </div>
                    </div>
                    <!-- .form-header-->
                    <form method="post" id="PodaciZaDostavu" action="checkout.php">
                    <div class="form-body">
                      <div class="mv-form-group">
                        <div class="mv-label"> <strong class="text-uppercase">Zemlja <span class="mv-color-primary">*</span></strong></div>
                        <div class="mv-field">
                          <label class="mv-select mv-select-style-1 h-40">
                            <select name="Drzava" form="PodaciZaDostavu">
                              <option value="Srbija" selected>Srbija</option>
                              <!--<option value="Bosna i Hercegovina">Bosna i Hercegovina</option>
                               <option>Albania</option>
                              <option >Algeria</option>
                              <option>Andorra</option>
                              <option>Angola</option>
                              <option>Antigua and Barbuda</option>
                              <option>Argentina</option>
                              <option>Armenia</option>
                              <option>Australia</option>
                              <option>Austria</option>
                              <option>Azerbaijan</option>
                              <option>Bahamas</option>
                              <option>Bahrain</option>
                              <option>Bangladesh</option>
                              <option>Barbados</option>
                              <option>Belarus</option>
                              <option>Belgium</option>
                              <option>Belize</option>
                              <option>Benin</option>
                              <option>Bhutan</option>
                              <option>Bolivia</option>
                              <option>Bosnia and Herzegovina</option>
                              <option>Botswana</option>
                              <option>Brazil</option>
                              <option>Brunei</option>
                              <option>Bulgaria</option>
                              <option>Burkina Faso</option>
                              <option>Burundi</option>
                              <option>Cabo Verde</option>
                              <option>Cambodia</option>
                              <option>Cameroon</option>
                              <option>Canada</option>
                              <option>Central African Republic</option>
                              <option>Chad</option>
                              <option>Chile</option>
                              <option>China</option>
                              <option>Colombia</option>
                              <option>Comoros</option>
                              <option>Congo, Republic of the</option>
                              <option>Congo, Democratic Republic of the</option>
                              <option>Costa Rica</option>
                              <option>Cote d'Ivoire</option>
                              <option>Croatia</option>
                              <option>Cuba</option>
                              <option>Cyprus</option>
                              <option>Czech Republic</option>
                              <option>Denmark</option>
                              <option>Djibouti</option>
                              <option>Dominica</option>
                              <option>Dominican Republic</option>
                              <option>Ecuador</option>
                              <option>Egypt</option>
                              <option>El Salvador</option>
                              <option>Equatorial Guinea</option>
                              <option>Eritrea</option>
                              <option>Estonia</option>
                              <option>Ethiopia</option>
                              <option>Fiji</option>
                              <option>Finland</option>
                              <option>France</option>
                              <option>Gabon</option>
                              <option>Gambia</option>
                              <option>Georgia</option>
                              <option>Germany</option>
                              <option>Ghana</option>
                              <option>Greece</option>
                              <option>Grenada</option>
                              <option>Guatemala</option>
                              <option>Guinea</option>
                              <option>Guinea-Bissau</option>
                              <option>Guyana</option>
                              <option>Haiti</option>
                              <option>Honduras</option>
                              <option>Hungary</option>
                              <option>Iceland</option>
                              <option>India</option>
                              <option>Indonesia</option>
                              <option>Iran</option>
                              <option>Iraq</option>
                              <option>Ireland</option>
                              <option>Israel</option>
                              <option>Italy</option>
                              <option>Jamaica</option>
                              <option>Japan</option>
                              <option>Jordan</option>
                              <option>Kazakhstan</option>
                              <option>Kenya</option>
                              <option>Kiribati</option>
                              <option>Kuwait</option>
                              <option>Kyrgyzstan</option>
                              <option>Laos</option>
                              <option>Latvia</option>
                              <option>Lebanon</option>
                              <option>Lesotho</option>
                              <option>Liberia</option>
                              <option>Libya</option>
                              <option>Liechtenstein</option>
                              <option>Lithuania</option>
                              <option>Luxembourg</option>
                              <option>Macedonia</option>
                              <option>Madagascar</option>
                              <option>Malawi</option>
                              <option>Malaysia</option>
                              <option>Maldives</option>
                              <option>Mali</option>
                              <option>Malta</option>
                              <option>Marshall Islands</option>
                              <option>Mauritania</option>
                              <option>Mauritius</option>
                              <option>Mexico</option>
                              <option>Micronesia</option>
                              <option>Moldova</option>
                              <option>Monaco</option>
                              <option>Mongolia</option>
                              <option>Montenegro</option>
                              <option>Morocco</option>
                              <option>Mozambique</option>
                              <option>Myanmar (Burma)</option>
                              <option>Namibia</option>
                              <option>Nauru</option>
                              <option>Nepal</option>
                              <option>Netherlands</option>
                              <option>New Zealand</option>
                              <option>Nicaragua</option>
                              <option>Niger</option>
                              <option>Nigeria</option>
                              <option>North Korea</option>
                              <option>Norway</option>
                              <option>Oman</option>
                              <option>Pakistan</option>
                              <option>Palau</option>
                              <option>Palestine</option>
                              <option>Panama</option>
                              <option>Papua New Guinea</option>
                              <option>Paraguay</option>
                              <option>Peru</option>
                              <option>Philippines</option>
                              <option>Poland</option>
                              <option>Portugal</option>
                              <option>Qatar</option>
                              <option>Romania</option>
                              <option>Russia</option>
                              <option>Rwanda</option>
                              <option>St. Kitts and Nevis </option>
                              <option>St. Lucia</option>
                              <option>St. Vincent and The Grenadines </option>
                              <option>Samoa</option>
                              <option>San Marino</option>
                              <option>Sao Tome and Principe </option>
                              <option>Saudi Arabia</option>
                              <option>Senegal</option>
                              <option>Seychelles</option>
                              <option>Sierra Leone</option>
                              <option>Singapore</option>
                              <option>Slovakia</option>
                              <option>Slovenia</option>
                              <option>Solomon Islands</option>
                              <option>Somalia</option>
                              <option>South Africa</option>
                              <option>South Korea</option>
                              <option>South Sudan</option>
                              <option>Spain</option>
                              <option>Sri Lanka</option>
                              <option>Sudan</option>
                              <option>Suriname</option>
                              <option>Swaziland</option>
                              <option>Sweden</option>
                              <option>Switzerland</option>
                              <option>Syria</option>
                              <option>Taiwan</option>
                              <option>Tajikistan</option>
                              <option>Tanzania</option>
                              <option>Thailand</option>
                              <option>Timor-Leste</option>
                              <option>Togo</option>
                              <option>Tonga</option>
                              <option>Trinidad and Tobago</option>
                              <option>Tunisia</option>
                              <option>Turkey</option>
                              <option>Turkmenistan</option>
                              <option>Tuvalu</option>
                              <option>Uganda</option>
                              <option>Ukraine</option>
                              <option>United Arab Emirates</option>
                              <option>United Kingdom (UK)</option>
                              <option>United States of America (USA)</option>
                              <option>Uruguay</option>
                              <option>Uzbekistan</option>
                              <option>Vanuatu</option>
                              <option>Vatican City (Holy See)</option>
                              <option>Venezuela</option>
                              <option>Vietnam</option>
                              <option>Yemen</option>
                              <option>Zambia</option>
                              <option>Zimbabwe</option>-->
                            </select>
                          </label>
                        </div>
                      </div>

                      <div class="mv-form-group">
                        <div class="row">
                          <div class="col-sm-6">
                            <div class="mv-label"> <strong class="text-uppercase">Ime <span class="mv-color-primary">*</span></strong></div>
                            <div class="mv-field">
                              <?php 
                              if (isset($imeprint)) {
                                echo "<input type=\"text\" name=\"Ime\" data-mv-placeholder=\"$imeprint\" class=\"mv-inputbox mv-inputbox-style-2\"/>";
                              }
                              else{
                                echo '<input type="text" name="Ime" class="mv-inputbox mv-inputbox-style-2"/>';
                              }
                              unset($imeprint);
                              ?>
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="mv-label"> <strong class="text-uppercase">Prezime <span class="mv-color-primary">*</span></strong></div>
                            <div class="mv-field">
                              <?php 
                              if (isset($prezimeprint)) {
                                echo "<input type=\"text\" name=\"Prezime\" data-mv-placeholder=\"$prezimeprint\" class=\"mv-inputbox mv-inputbox-style-2\"/>";
                              }
                              else{
                                echo '<input type="text" name="Prezime" class="mv-inputbox mv-inputbox-style-2"/>';
                              }
                              unset($prezimeprint);
                              ?>
                              
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="mv-form-group">
                        <div class="mv-label"> <strong class="text-uppercase">Adresa <span class="mv-color-primary">*</span></strong></div>
                        <div class="mv-field">
                          <div class="mv-inputbox-list">
                            <!--<input type="text" name="test127" placeholder="Apartment, suite, unite ect. (optinal)" data-mv-placeholder="Apartment, suite, unite ect. (optinal)" class="mv-inputbox mv-inputbox-style-2"/>-->
                            <?php 
                              if (isset($adresaprint)) {
                                echo "<input type=\"text\" name=\"Adresa\" placeholder=\"Street address\" data-mv-placeholder=\"$adresaprint\" class=\"mv-inputbox mv-inputbox-style-2\"/>";
                              }
                              else{
                                echo '<input type="text" name="Adresa" placeholder="Street address" data-mv-placeholder="Ime ulice i broj " class="mv-inputbox mv-inputbox-style-2"/>';
                              }
                              unset($adresaprint);
                              ?>
                          </div>
                        </div>
                      </div>

                      <div class="mv-form-group">
                        <div class="mv-label"> <strong class="text-uppercase">Grad / Mesto <span class="mv-color-primary">*</span></strong></div>
                        <div class="mv-field">
                          <?php 
                              if (isset($gradmestoprint)) {
                                echo "<input type=\"text\" name=\"GradMesto\" data-mv-placeholder=\"$gradmestoprint\" class=\"mv-inputbox mv-inputbox-style-2\"/>";
                              }
                              else{
                                echo '<input type="text" name="GradMesto" class="mv-inputbox mv-inputbox-style-2"/>';
                              }
                              unset($gradmestoprint);
                              ?>
                        </div>
                      </div>

                      <div class="mv-form-group">
                        <div class="mv-label"> <strong class="text-uppercase">Poštanski broj<span class="mv-color-primary">*</span></strong></div>
                        <div class="mv-field">
                          <?php 
                              if (isset($postanskiprint)) {
                                echo "<input type=\"text\" name=\"PostanskiBroj\" data-mv-placeholder=\"$postanskiprint\" class=\"mv-inputbox mv-inputbox-style-2\"/>";
                              }
                              else{
                                echo '<input type="text" name="PostanskiBroj" class="mv-inputbox mv-inputbox-style-2"/>';
                              }
                              unset($postanskiprint);
                              ?>
                        </div>
                      </div>

                      <div class="mv-form-group">
                        <div class="mv-label"> <strong class="text-uppercase">Email adresa <span class="mv-color-primary">*</span></strong></div>
                        <div class="mv-field">
                          <?php 
                              if (isset($emailprint)) {
                                echo "<input type=\"email\" name=\"Email\" data-mv-placeholder=\"$emailprint\" class=\"mv-inputbox mv-inputbox-style-2\"/>";
                              }
                              else{
                                echo '<input type="email" name="Email" class="mv-inputbox mv-inputbox-style-2"/>';
                              }
                              unset($emailprint);
                              ?>
                        </div>
                        </div>
                      </div>

                      <div class="mv-form-group">
                        <div class="mv-label"> <strong class="text-uppercase">Broj telefona <span class="mv-color-primary">*</span></strong></div>
                        <div class="mv-field">
                          <?php 
                              if (isset($brojtelefonaprint)) {
                                echo "<input type=\"text\" name=\"BrojTelefona\" data-mv-placeholder=\"$brojtelefonaprint\" class=\"mv-inputbox mv-inputbox-style-2\"/>";
                              }
                              else{
                                echo '<input type="text" name="BrojTelefona" data-mv-placeholder="+38" class="mv-inputbox mv-inputbox-style-2"/>';
                              }
                              unset($brojtelefonaprint);
                              ?>
                        </div>
                      </div>

                     <!-- <div class="mv-form-group submit-button mv-mt-30">
                        <button type="submit" class="mv-btn mv-btn-style-5 btn-5-h-45 responsive-btn-5-type-1 btn-save-address">Save address</button>
                      </div>-->
                    </div>
                    </form>
                    <!-- .form-body-->
                  </div>
                  <!-- .form-billing-address-->
                </div>

                
              </div>
            </div>
          </div>
          <!-- .block-billing-address-->

          

          <div class="checkout-block block-button-place-order mv-box-shadow-gray-1">
            <div class="mv-dp-table align-middle">
              <div class="mv-dp-table-cell col-checkbox">
               <!-- <label class="mv-checkbox mv-checkbox-style-6">
                  <input type="checkbox" name="test138" class="hidden"/><span class="checkbox-after-input"><span class="checkbox-visual-box"><span class="icon-checked fa fa-check"></span></span><span class="checkbox-text">I have read and accept the Terms & Conditions</span></span>
                </label>-->
              </div>
              <div class="mv-dp-table-cell col-button text-right"><button type="submit" form="PodaciZaDostavu" name="podaci"  class="mv-btn mv-btn-style-5 btn-5-h-45 responsive-btn-5-type-1">Potvrdi kupovinu</button></div>
             
            </div>
          </div>
          <!-- .block-button-place-order-->
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