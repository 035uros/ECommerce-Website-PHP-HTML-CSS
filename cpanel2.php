<?php
/*SELECT SUM((database.tip.cena-IFNULL(if(databasepotrosaca.proizvodi.Boja="crna", database.tip.cena_Crno, database.tip.cena_Belo),0))*databasepotrosaca.proizvodi.Kolicina) AS 'UKUPNAZARADA' FROM proizvodi 
JOIN database.tip on database.tip.nazivTipa = databasepotrosaca.proizvodi.Tip;
SET @ukupnazarada := 'UKUPNAZARADA';
SELECT database.tip.cena, databasepotrosaca.proizvodi.Kolicina, IFNULL(if(databasepotrosaca.proizvodi.Boja="crna", database.tip.cena_Crno, database.tip.cena_Belo),0)  FROM proizvodi 
JOIN database.tip on database.tip.nazivTipa = databasepotrosaca.proizvodi.Tip;
SELECT SUM(cena) AS 'trosak' FROM dodatni_troskovi;
SET @trosak := 'trosak';
SELECT @ukupnazarada 

SELECT (SUM((database.tip.cena-IFNULL(if(databasepotrosaca.proizvodi.Boja="crna", database.tip.cena_Crno, database.tip.cena_Belo),0))*databasepotrosaca.proizvodi.Kolicina) - SUM(dodatni_troskovi.cena)) AS 'UKUPNAZARADA' FROM proizvodi JOIN database.tip on database.tip.nazivTipa = databasepotrosaca.proizvodi.Tip, dodatni_troskovi*/
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
function unoskoda($id, $kod){

  $conn = OpenCon2();
 
  $sql="UPDATE `potrosac` SET `kod` = '$kod' WHERE `potrosac`.`id_Potrosaca` = '$id';";
 
  $conn->query($sql);
 
  $conn->close();
 }

 function unostroska($naziv, $cena){

  $conn = OpenCon2();
  $conn->query("SET NAMES 'utf8'");
  $img=mysqli_fetch_assoc(mysqli_query($conn,'SELECT UUID() AS promenljiva'));
  $id = $img["promenljiva"];

  $sql="INSERT INTO `dodatni_troskovi` (`naziv`, `cena`, `id`, `datum`) VALUES ('$naziv', '$cena', '$id', SYSDATE());";
 
  $conn->query($sql);
 
  $conn->close();
 }

 function brisanjetroska($id){

  $conn = OpenCon2();
 
  $sql="DELETE FROM `dodatni_troskovi` WHERE id='$id'";
 
  $conn->query($sql);
 
  $conn->close();
 }

if (isset($_POST['brisi'])) {
   brisanje($_POST['brisi']);
 }

if (isset($_POST['unesi'])) {
  unoskoda($_POST['unesi'], $_POST['kodovi']);
}

if (isset($_POST['brisitrosak'])) {
  brisanjetroska($_POST['brisitrosak']);
}

if (isset($_POST['nazivtroska'])) {
 unostroska($_POST['nazivtroska'], $_POST['cenatroska']);
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
                   <li><a href="about-us.html"><span class="menu-text">O nama</span></a></li>
                   <!--<li><a href="contact.html"><span class="menu-text">Kontakt</span></a></li>-->
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
        <h1 style="text-align:center; padding-top:3%; padding-bottom:3%;"> Porudžbine za mesec</h1>
        <div class="align-middle">
              <div>
              <div >
              <form action="cpanel2.php" method="post" id="meseci">
              <div class="radio" required="required" >
                                  <input type="radio" class="radio__input" value="1" name="mesec" id="Januar" required="required">
                                  <label style="padding-left:0;"class="mv-btn mv-btn-style-8" for="Januar">Januar</label>
                                  <input type="radio" class="radio__input" value="2" name="mesec" id="Februar" required="required">
                                  <label class="mv-btn mv-btn-style-8" for="Februar">Februar</label>
                                  <input type="radio" class="radio__input" value="3" name="mesec" id="Mart" required="required">
                                  <label class="mv-btn mv-btn-style-8" for="Mart">Mart</label>
                                  <input type="radio" class="radio__input" value="4" name="mesec" id="April" required="required">
                                  <label class="mv-btn mv-btn-style-8" for="April">April</label>
                                  <input type="radio" class="radio__input" value="5" name="mesec" id="Maj" required="required">
                                  <label class="mv-btn mv-btn-style-8" for="Maj">Maj</label>
                                  <input type="radio" class="radio__input" value="6" name="mesec" id="Jun" required="required">
                                  <label class="mv-btn mv-btn-style-8" for="Jun">Jun</label>
                                  <input type="radio" class="radio__input" value="7" name="mesec" id="Jul" required="required">
                                  <label class="mv-btn mv-btn-style-8" for="Jul">Jul</label>
                                  <input type="radio" class="radio__input" value="8" name="mesec" id="Avgust" required="required">
                                  <label class="mv-btn mv-btn-style-8" for="Avgust">Avgust</label>
                                  <input type="radio" class="radio__input" value="9" name="mesec" id="Septembar" required="required">
                                  <label class="mv-btn mv-btn-style-8" for="Septembar">Septembar</label>
                                  <input type="radio" class="radio__input" value="10" name="mesec" id="Novembar" required="required">
                                  <label class="mv-btn mv-btn-style-8" for="Novembar">Novembar</label>
                                  <input type="radio" class="radio__input" value="11" name="mesec" id="Oktobar" required="required">
                                  <label class="mv-btn mv-btn-style-8" for="Oktobar">Oktobar</label>
                                  <input type="radio" class="radio__input" value="12" name="mesec" id="Decembar" required="required">
                                  <label class="mv-btn mv-btn-style-8" for="Decembar">Decembar</label>
                                </div>

              </form>
              <button type="submit" value="Postavi mesec" name="meseci" class="mv-btn mv-btn-style-5 btn-5-h-45 responsive-btn-5-type-1" form="meseci">Odaberi mesec</button></div>
              </div>
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
                    <th style="width:100px">Naplaćeno</th>
                    <th style="width:110px">Kod za dostavu</th>
                    <th style="width:110px"></th>
                    <th style="width:110px"></th>
                  </tr>
                </thead>

        <?php 

         $conn = OpenCon2();
         $conn->query("SET NAMES 'utf8'");
         if (isset($_POST['mesec'])) {
           $mesec=$_POST['mesec'];
          $sql="SELECT * FROM potrosac JOIN proizvodi ON potrosac.id_Potrosaca=proizvodi.id_Potrosaca WHERE MONTH(vreme_Narucivanja)= $mesec AND  YEAR(vreme_Narucivanja)=  YEAR(SYSDATE()) AND potrosac.verifikovan = 1";
       
        }
        else{
          $sql="SELECT * FROM potrosac JOIN proizvodi ON potrosac.id_Potrosaca=proizvodi.id_Potrosaca WHERE MONTH(vreme_Narucivanja)=  MONTH(SYSDATE()) AND  YEAR(vreme_Narucivanja)=  YEAR(SYSDATE()) AND potrosac.verifikovan = 1";
        }
    
     
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
             echo '<td>'. $red["ukupna_Cena"]. '</td>';
             if($red["kod"]==NULL){
              echo '<form method="post"><td><input type="text" name="kodovi" data-mv-placeholder="Kod" class="mv-inputbox mv-inputbox-style-2"/></td>';
              echo '<td><button class="mv-btn mv-btn-style-5 btn-5-h-45 responsive-btn-5-type-1" name="unesi" value="'. $red["id_Potrosaca"]. '">Unesi</button></td></form>';
              echo '<form method="post"><td><button class="mv-btn mv-btn-style-5 btn-5-h-45 responsive-btn-5-type-1" name="brisi" onclick="return confirm(\'Sigurno, nakon brisanja nema povratka informacija?\')" value="'. $red["id_Potrosaca"]. '">Obriši</button></td></form>';

             }
             else{
              echo '<form method="post"><td><input type="text" name="kodovi" value="'. $red["kod"]. '" class="mv-inputbox mv-inputbox-style-2"/></td>';
              echo '<td><button class="mv-btn mv-btn-style-5 btn-5-h-45 responsive-btn-5-type-1" name="unesi" value="'. $red["id_Potrosaca"]. '">Izmeni</button></td></form>';
              echo '<form method="post"><td><button class="mv-btn mv-btn-style-5 btn-5-h-45 responsive-btn-5-type-1" name="brisi" onclick="return confirm(\'Sigurno, nakon brisanja nema povratka informacija?\')" value="'. $red["id_Potrosaca"]. '">Obriši</button></td></form>';
            }
        }
         }
         $conn->close();
         ?>
        </tr>
    </table>
    </div>
    <div >
            
        </div>
      </section>
      <!-- .mv-main-body-->

      <h1>Dodatni troškovi</h1>
      <section class="mv-main-body login-main mv-bg-gray mv-wrap">
        <div style="padding:15px;">
          
        <div class="wishlist-inner mv-bg-white mv-box-shadow-gray-1">
            <div class="mv-table-responsive">
              <table class="mv-table-style-3">
              <thead>
                  <tr>
                    <th style="width:90px">Naziv</th>
                    <th style="width:90px">Cena</th>
                    <th style="width:110px"></th>
                    <th style="width:110px"></th>
                  </tr>
                </thead>

        <?php 

         $conn = OpenCon2();
         $conn->query("SET NAMES 'utf8'");
         if (isset($_POST['mesec'])) {
           $mesec=$_POST['mesec'];
          $sql="SELECT * FROM dodatni_troskovi WHERE MONTH(datum)= $mesec AND  YEAR(datum) =  YEAR(SYSDATE())";
       
        }
        else{
          $sql="SELECT * FROM dodatni_troskovi";
        }
    
     
         $rezultat=$conn->query($sql);
         echo "<tr>";
         if($rezultat->num_rows > 0){
         while($red = $rezultat->fetch_assoc()){
             
             if($red["naziv"]==NULL){
              echo '<form method="post"><td><input type="text" name="nazivtroska" data-mv-placeholder="Naziv" class="mv-inputbox mv-inputbox-style-2"/></td>';
              echo '<td><input type="text" name="cenatroska" data-mv-placeholder="Cena" class="mv-inputbox mv-inputbox-style-2"/></td>';
              echo '<td><button class="mv-btn mv-btn-style-5 btn-5-h-45 responsive-btn-5-type-1" name="unesi" value="'. $red["naziv"]. '">Unesi</button></td></form>';
              echo '<form method="post"><td><button class="mv-btn mv-btn-style-5 btn-5-h-45 responsive-btn-5-type-1" name="brisitrosak" onclick="return confirm(\'Sigurno, nakon brisanja nema povratka informacija?\')" value="'. $red["id"]. '">Obriši</button></td></form></tr>';

             }
             else{
              echo '<form method="post"><td><input type="text" name="nazivtroska" value="'. $red["naziv"]. '" class="mv-inputbox mv-inputbox-style-2"/></td>';
              echo '<td><input type="text" name="cenatroska" value="'. $red["cena"]. '" class="mv-inputbox mv-inputbox-style-2"/></td>';
              echo '<td></td></form>';
              echo '<form method="post"><td><button class="mv-btn mv-btn-style-5 btn-5-h-45 responsive-btn-5-type-1" name="brisitrosak" onclick="return confirm(\'Sigurno, nakon brisanja nema povratka informacija?\')" value="'. $red["id"]. '">Obriši</button></td></form></tr>';
            }
            
        }
        
         }
         echo '<form method="post"><td><input type="text" name="nazivtroska" data-mv-placeholder="Naziv" class="mv-inputbox mv-inputbox-style-2"/></td>';
              echo '<td><input type="text" name="cenatroska" data-mv-placeholder="Cena" class="mv-inputbox mv-inputbox-style-2"/></td>';
              echo '<td><button class="mv-btn mv-btn-style-5 btn-5-h-45 responsive-btn-5-type-1" name="unesi" value="Unos">Unesi</button></td></form>';
              echo '<td></td></tr>';
         $conn->close();
         ?>
        </tr>
    </table>
    </div>

      </section>
      <!-- .mv-main-body-->

      <h1>Zarada</h1>
      <section class="mv-main-body login-main mv-bg-gray mv-wrap">
        <div style="padding:15px;">
          
        <div class="wishlist-inner mv-bg-white mv-box-shadow-gray-1">
            <div class="mv-table-responsive">
              <table class="mv-table-style-3">
              <thead>
                  <tr>
                    <th style="width:90px">Mesec</th>
                    <th style="width:90px">Iznos</th>
                  </tr>
                </thead>

        <?php 

         $conn2 = OpenCon();
         $conn = OpenCon2();
         $conn->query("SET NAMES 'utf8'");
         if (isset($_POST['mesec'])) {
           $mesec=$_POST['mesec'];
          $sql="SELECT SUM(ukupna_Cena) AS cena, SUM(ukupni_Trosak) AS trosak FROM potrosac WHERE YEAR(potrosac.vreme_Narucivanja) = YEAR(SYSDATE()) AND MONTH(potrosac.vreme_Narucivanja) = $mesec AND potrosac.verifikovan = 1;";
          $sql1="SELECT SUM(cena) AS dodatnitrosak FROM dodatni_troskovi WHERE YEAR(dodatni_troskovi.datum) = YEAR(SYSDATE()) AND MONTH(dodatni_troskovi.datum) = $mesec AND potrosac.verifikovan = 1;";
        }
        else{
          $mesec="Trenutni mesec";
          $sql="SELECT SUM(ukupna_Cena) AS cena, SUM(ukupni_Trosak) AS trosak FROM potrosac WHERE YEAR(potrosac.vreme_Narucivanja) = YEAR(SYSDATE()) AND MONTH(potrosac.vreme_Narucivanja) = MONTH(SYSDATE()) AND potrosac.verifikovan = 1;";
          $sql1="SELECT SUM(cena) AS dodatnitrosak FROM dodatni_troskovi WHERE YEAR(dodatni_troskovi.datum) = YEAR(SYSDATE()) AND MONTH(dodatni_troskovi.datum) = MONTH(SYSDATE()) AND potrosac.verifikovan = 1;";
        }
         $rezultat=$conn->query($sql);

         $rezultat1=$conn->query($sql1);
         if($rezultat1->num_rows > 0){
          while($red = $rezultat1->fetch_assoc()){
            $dodatnitrosak=$red["dodatnitrosak"];
          }
        }
         echo "<tr>";
         if($rezultat->num_rows > 0){
         while($red = $rezultat->fetch_assoc()){
             $zarada=$red["cena"]-$red["trosak"]-$dodatnitrosak;
              echo '<td>'.$mesec.'</td>';
              echo '<td>'.$zarada.'</td>';
        }
        
         }
         $conn->close();
         ?>
        </tr>
    </table>
    </div>

      </section>
     

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
              <li><a href="about-us.html"><span class="menu-text">O nama</span></a></li>
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
