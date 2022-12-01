<?php
error_reporting(E_ERROR | E_PARSE);
include 'baza_podataka.php';
session_start();
$conn = OpenCon();
$obavestenjedodaje=0;
$nijepopunjeno = 0;

$total=0;
$conn->query("SET NAMES 'utf8'");
$id=$_GET['b'];

$sql = $conn->prepare('SELECT * FROM proizvod, tip WHERE proizvod.proizvodID = ? AND tip.nazivTipa=proizvod.nazivTipa LIMIT 1');
$sql->bind_param('i', $id); // 's' specifies the variable type => 'string'
$sql->execute();
$result = $sql->get_result();
//$result = $conn->query($sql);            
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $slike = explode(";", $row["slike"]);
    $cena=$row["cena"];
    $tip=$row["nazivTipa"];
    $naziv =$row["Naziv"];
    $slikabela=$slike[1];
    $slikacrna=$slike[0];
    $priprema=$slike[2];
    $cenabelo=$row["cena_Belo"];
    $cenacrno=$row["cena_Crno"];
  }
}
$conn->close();
if(isset($_POST["dodajukorpu"])){
  $flag=0;
if(isset($_POST['boja']) && isset($_POST['Velicina']) || $tip =='Aksesoari'){
  $i=1;
  if($_POST['boja'] == NULL || $_POST['Velicina'] == NULL){
    if($tip != 'Aksesoari'){
    $i=0;
  }
  }
if($i==1){
  if(isset($_SESSION["korpa"])){
    $pozicija= count($_SESSION["korpa"]);
    $nizproizvoda=array(
      'id'          => $_GET['b'],
      'naziv'       => $_POST['skrivennaziv'],
      'cena'        => $_POST['skrivenacena'],
      'kolicina'    => $_POST['brojkomada'],
      'boja'        => $_POST['boja'],
      'velicina'    => $_POST['Velicina'],
      'slikabela'   => $_POST['skrivenaslikabela'],
      'nazivtipa'   => $_POST['nazivtipa'],
      'slikacrna'   => $_POST['skrivenaslikacrna'],
      'priprema'   => $_POST['priprema'],
      'kengur'   => $_POST['kengur'],
      'trosakcrno'   => $_POST['skrivenacenacrno'],
      'trosakbelo'   => $_POST['skrivenacenabelo']
    );
    $_SESSION["korpa"][$pozicija]=$nizproizvoda;

  }
  else{
    $nizproizvoda=array(
      'id'          => $_GET['b'],
      'naziv'       => $_POST['skrivennaziv'],
      'cena'        => $_POST['skrivenacena'],
      'kolicina'    => $_POST['brojkomada'],
      'boja'        => $_POST['boja'],
      'velicina'    => $_POST['Velicina'],
      'nazivtipa'   => $_POST['nazivtipa'],
      'slikabela'   => $_POST['skrivenaslikabela'],
      'slikacrna'   => $_POST['skrivenaslikacrna'],
      'priprema'   => $_POST['priprema'],
      'kengur'   => $_POST['kengur'],
      'trosakcrno'   => $_POST['skrivenacenacrno'],
      'trosakbelo'   => $_POST['skrivenacenabelo']
    );
    $_SESSION["korpa"][0]=$nizproizvoda;
  }
  $obavestenjedodaje=1;
}
}else{
  $nijepopunjeno = 1;
  //echo '<script>alert("Polja veličina i boja su obavezna!")</script>';
}

}
if(isset($_GET["action"])){
  if($_GET["action"]=="delete"){
    foreach($_SESSION["korpa"] as $kljucevi => $vrednosti){
      if($vrednosti["id"] == $_GET["id1"] && $vrednosti["boja"] == $_GET["b1"] && $vrednosti["velicina"] == $_GET["v1"]){
        unset($_SESSION["korpa"] [$kljucevi]);
      }

    }
  }
}
?>
<!DOCTYPE html>
<html >
  <head >
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Detalji o proizvodu</title>
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
                               <a href="product-detail.php?action=delete&id1='.$vrednost["id"].'&b1='.$vrednost["boja"].'&v1='.$vrednost["velicina"].'&b='.$vrednost["id"].'"  title="Izbaci iz korpe" class="mv-btn mv-btn-style-4 fa fa-close btn-delete-product"></a>
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
        <div data-image-src="images/background/proizvod.png" class="mv-banner-style-1 mv-bg-overlay-dark overlay-0-85 mv-parallax">
          <div class="page-name mv-caption-style-6">
            <div class="container">
              <div class="mv-title-style-9"><span class="main">O Proizvodu</span><img src="images/icon/icon_line_polygon_line.png" alt="icon" class="line"/></div>
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
              <li><a href="product-grid-3.php">Proizvodi</a></li>
              <li><a id="malinaziv">PROIZVOD</a></li>
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
      Proizvod dodat u korpu.
      </div> ';
      }
      if($nijepopunjeno==1){
        echo '
        <div class="alert" style="background-color: #aa0601;;" >
        <span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span>
        Polja veličina i boja su obavezna.
        </div> ';
      }
      ?>
      

      <section class="mv-main-body product-detail-main mv-bg-gray mv-wrap">
        <div class="container">
          <div class="post">
            <div class="block-info mv-box-shadow-gray-1">
              <div class="mv-block-style-27">
                <div class="mv-col-wrapper">
                  <div class="mv-col-left block-27-col-slider">
                    <div class="mv-block-style-26">
                      <div class="product-detail-slider mv-slick-slide mv-lightbox-style-1">
                        <div class="block-26-gallery-main">
                          <div class="slider gallery-main">
                            <div class="slick-slide">
                              <div class="slick-slide-inner"><a style="background-color:white;" id="vvslika1" href="" title="" class="mv-lightbox-item"><img id="vslika1" src="images/proizvodi/e30/HoodieBlack.png" style="background-color:white;" alt="crno" class="block-26-main-img"/></a></div>
                            </div>
                            <!-- .slick-slide-->

                            <div class="slick-slide">
                              <div class="slick-slide-inner"><a style="background-color:white;" id="vvslika2" href="" title="" class="mv-lightbox-item"><img id="vslika2" src="images/proizvodi/e30/HoodieWhite.png" style="background-color:white;" alt="belo" class="block-26-main-img"/></a></div>
                            </div>
                            <!-- .slick-slide-->

                            
                            <!-- .slick-slide-->

                            <div class="slick-slide">
                              <div class="slick-slide-inner"><a id="vvslika4" href="" title="" class="mv-lightbox-item"><img id="vslika4" src="images/proizvodi/univerzalni/deklaracija.png" alt="deklaracija" class="block-26-main-img"/></a></div>
                            </div>
                            <!-- .slick-slide-->

                            <div class="slick-slide">
                              <div class="slick-slide-inner"><a id="vvpozadibelo" href="" title="" class="mv-lightbox-item"><img id="vpozadibelo" src="images/proizvodi/univerzalni/duksbelipozadi.png" alt="belopozadi" class="block-26-main-img"/></a></div>
                            </div>
                            <!-- .slick-slide-->

                            <div class="slick-slide">
                              <div class="slick-slide-inner"><a id="vvpozadicrno" href="" title="" class="mv-lightbox-item"><img id="vpozadicrno" src="images/proizvodi/univerzalni/dukscrnipozadi.png" alt="crnopozadi" class="block-26-main-img"/></a></div>
                            </div>
                            <!-- .slick-slide-->

                            <div class="slick-slide">
                              <div class="slick-slide-inner"><a id="vvzakard" href="" title="" class="mv-lightbox-item"><img id="vzakard" src="images/proizvodi/univerzalni/etiketaduks.png" alt="etiketa" class="block-26-main-img"/></a></div>
                            </div>
                            <!-- .slick-slide-->

                           

                          </div>
                        </div>
                        <!-- .block-26-gallery-main-->

                        <div class="block-26-gallery-thumbs">
                          <div class="block-26-gallery-thumbs-inner">
                            <div class="slider gallery-thumbs">
                              <div class="slick-slide">
                                <div class="slick-slide-inner mv-box-shadow-gray-2" style="background-color:white;"><img id="slika1" style="background-color:white;" src="images/proizvodi/e30/HoodieBlack.png" alt="crno" class="block-26-thumbs-img"/></div>
                              </div>

                              <div class="slick-slide">
                                <div class="slick-slide-inner mv-box-shadow-gray-2" style="background-color:white;"><img id="slika2" style="background-color:white;" src="images/proizvodi/e30/HoodieWhite.png" alt="belo" class="block-26-thumbs-img"/></div>
                              </div>

                              

                              <div class="slick-slide">
                                <div class="slick-slide-inner mv-box-shadow-gray-2"><img id="slika4" src="images/proizvodi/univerzalni/deklaracija.png" alt="deklaracija" class="block-26-thumbs-img"/></div>
                              </div>

                              <div class="slick-slide">
                                <div class="slick-slide-inner mv-box-shadow-gray-2"><img id="pozadibelo" src="images/proizvodi/univerzalni/duksbelipozadi.png" alt="belopozadi" class="block-26-thumbs-img"/></div>
                              </div>

                              <div class="slick-slide">
                                <div class="slick-slide-inner mv-box-shadow-gray-2"><img id="pozadicrno" src="images/proizvodi/univerzalni/dukscrnipozadi.png" alt="crnopozadi" class="block-26-thumbs-img"/></div>
                              </div>

                              <div class="slick-slide">
                                <div class="slick-slide-inner mv-box-shadow-gray-2"><img id="zakard" src="images/proizvodi/univerzalni/etiketaduks.png" alt="etiketa" class="block-26-thumbs-img"/></div>
                              </div>
                            </div>

                            <div class="slick-slide-control"></div>
                          </div>
                        </div>
                        <!-- .block-26-gallery-thumbs-->
                      </div>
                      <!-- .product-detail-slider-->
                    </div>
                    <!-- .mv-block-style-26-->

                    <!-- // POPUST
                      <div onclick="$(this).remove()" class="block-27-sale-off mv-label-style-2 text-center">
                      <div class="label-2-inner">
                        <ul class="label-2-ul">
                          <li class="number">-25%</li>
                          <li class="text">sale</li>
                        </ul>
                      </div>
                    </div>-->

                  <!--SLICICA ISPOD POPUSTA
                    <div><img src="images/demo/demo_120x40.png" alt="demo" onclick="$(this).remove()" class="block-27-logo"/></div>-->
                  </div>

                  <div class="mv-col-right block-27-col-info">
                    <div class="col-info-inner">
                      <div class="block-27-info">
                        <div id="velikinaziv" class="block-27-title">NAZIV PROIZVODA</div>

                        <div class="block-27-price">
                          <div id="glavnacena" class="new-price">CENA</div><span > RSD</span>
                          <!-- <div class="old-price">$127,99</div> -->
                        </div>

                        <div id="miniopis" class="block-27-desc">Mini opis, tipa Duks sa natpisom e30.</div>

                        <div class="block-27-table-info">
                          <form method="post" id="dodavanjeproizvoda">
                          
                            <table>
                              <?php 

                              if($tip != 'Aksesoari'){
                                echo'
                              <tr>
                                <td>Odaberi veličinu:</td>
                                <td>
                                  <div class="radio" required="required">  
                                  <input type="radio" class="radio__input" value="2" name="Velicina" id="dva" required="required">
                                  <label style="padding-left:0;"class="mv-btn mv-btn-style-8" for="dva">2</label>
                                  <input type="radio" class="radio__input" value="4" name="Velicina" id="cetiri" required="required">
                                  <label class="mv-btn mv-btn-style-8" for="cetiri">4</label>
                                  <input type="radio" class="radio__input" value="6" name="Velicina" id="sest" required="required">
                                  <label class="mv-btn mv-btn-style-8" for="sest">6</label>
                                  <input type="radio" class="radio__input" value="8" name="Velicina" id="osam" required="required">
                                  <label class="mv-btn mv-btn-style-8" for="osam">8</label>
                                  <input type="radio" class="radio__input" value="10" name="Velicina" id="deset" required="required">
                                  <label class="mv-btn mv-btn-style-8" for="deset">10</label>
                                  <input type="radio" class="radio__input" value="12" name="Velicina" id="dvanaest" required="required">
                                  <label class="mv-btn mv-btn-style-8" for="dvanaest">12</label>
                                  <input type="radio" class="radio__input" value="XS" name="Velicina" id="cetrnaest" required="required">
                                  <label class="mv-btn mv-btn-style-8" for="cetrnaest">14</label>
                                </div>
                                </td>
                                
                              </tr>
                              <tr>
                              <td></td>
                              <td>
                                <div class="radio" required="required"> 
                                  <input type="radio" class="radio__input" value="S" name="Velicina" id="S" required="required">
                                  <label style="padding-left:0;"class="mv-btn mv-btn-style-8" for="S">S</label>
                                  <input type="radio" class="radio__input" value="M" name="Velicina" id="M" required="required">
                                  <label class="mv-btn mv-btn-style-8" for="M">M</label>
                                  <input type="radio" class="radio__input" value="L" name="Velicina" id="L" required="required">
                                  <label class="mv-btn mv-btn-style-8" for="L">L</label>
                                  <input type="radio" class="radio__input" value="XL" name="Velicina" id="XL" required="required">
                                  <label class="mv-btn mv-btn-style-8" for="XL">XL</label>
                                  <input type="radio" class="radio__input" value="2XL" name="Velicina" id="XXL" required="required">
                                  <label class="mv-btn mv-btn-style-8" for="XXL">2XL</label>
                                  <input type="radio" class="radio__input" value="3XL" name="Velicina" id="XXXL" required="required">
                                  <label class="mv-btn mv-btn-style-8" for="XXXL">3XL</label>
                                  <input type="radio" class="radio__input" value="4XL" name="Velicina" id="4XL" required="required">
                                  <label class="mv-btn mv-btn-style-8" for="4XL">4XL</label>
                                </div>
                                </td>
                              </tr>
                              <tr>
                              
    
                                <td>Boja:</td>
                                <td>
                                <div class="radio">
                                <input type="radio" class="radio__input" value="Crna" name="boja" id="crna" >
                                <label style="background-color: #222222;" class="icon-color" for="crna"></label>
                                <input type="radio" class="radio__input" value="Bela" name="boja" id="bela">
                                <label style="background-color: #eeeeee;" class="icon-color" for="bela"></label>
                                </div>
                                </td>
                              </tr>';
                              }

                              ?>
                              <tr>
                                <td>Količina:</td>
                                <td>
                                  <div class="mv-spinner-style-1 input-quantity-wrapper">
                                    <input type="text" name="brojkomada" value="1" class="mv-inputbox mv-only-numeric input-quantity-product-detail" required>
                                  </div>
                                </td>
                              </tr>
                              <tr>
                                
                                  <?php
                                  if ($tip == 'Duks'){
                                    echo '<td><label class="form-check-input" for="kengur">Kengur <br>džep?</label></td>
                                    <td><input class="form-check-input" type="checkbox" id="kengur" name="kengur" value="Da"></td>';
                                  }
                                  ?>
                                
                              
                                <input type="hidden" name="skrivenacenabelo" value="<?php echo $cenabelo; ?>"/>
                                <input type="hidden" name="skrivenacenacrno" value="<?php echo $cenacrno; ?>"/>
                                <input type="hidden" name="skrivenacena" value="<?php echo $cena; ?>"/>
                                <input type="hidden" name="skrivennaziv" value="<?php echo $naziv; ?>"/>
                                <input type="hidden" name="skrivenaslikabela" value="<?php echo $slikabela; ?>"/>
                                <input type="hidden" name="skrivenaslikacrna" value="<?php echo $slikacrna; ?>"/>
                                <input type="hidden" name="priprema" value="<?php echo $priprema; ?>"/>
                                <input type="hidden" name="nazivtipa" value="<?php echo $tip; ?>"/>
                                <input type="hidden" name="b" value="<?php echo intval($id); ?>"/>
                              </tr>
                              <tr>
                                <td>Oznake: </td>
                                <td>
                                  <div class="mv-list-inline-style-2">
                                    <ul class="list-inline-2">
                                      <li><a id="tag1" class="mv-btn">BMW</a></li>
                                      <li><a id="tag2" class="mv-btn">EURO</a></li>
                                    </ul>
                                  </div>
                                </td>
                              </tr>
                            </table>
                          </form>
                        </div>
                      </div>
          
                      <!-- .block-27-info-->

                      <!-- <div class="block-27-message content-message mv-message-style-1">
                        <div class="message-inner"></div>
                      </div>
                      .block-27-message-->
                    </div>

                    <div class="block-27-button">
                      <div class="mv-dp-table align-middle">
                        <div class="mv-dp-table-cell">
                          <div class="mv-btn-group text-left">
                            <div class="group-inner">
                              <button type="submit" form="dodavanjeproizvoda" name="dodajukorpu" class="mv-btn mv-btn-style-1 btn-1-h-50 responsive-btn-1-type-3 btn-add-to-cart"><span class="btn-inner"><i class="btn-icon fa fa-cart-plus"></i><span class="btn-text">dodaj u korpu</span></span></button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- .mv-block-style-27-->
            </div>
            <!-- .block-info-->

            <div class="row block-info-more">
              <div class="col-sm-6 col-specification">
                <div class="specification-main mv-tab-style-3 mv-box-shadow-gray-1 mv-bg-white">
                  <ul role="tablist" class="tab-list nav nav-tabs">
                    <li role="presentation" class="active"><a href="#tab31" aria-controls="tab31" role="tab" data-toggle="tab">Opis</a></li>
                    <li role="presentation"><a href="#tab32" aria-controls="tab32" role="tab" data-toggle="tab">Specifikacija</a></li>
                    <li role="presentation" id="spec" class=""><a href="#tab33" aria-controls="tab33" role="tab" data-toggle="tab">Tablica veličina</a></li>
                  </ul>

                  <div class="tab-content">
                    <div id="tab31" role="tabpanel" class="tab-pane active">
                      <p id="velikiopispasus1">Ovde sam zamislio da ide neki zabavan opis za svaki dizajn. Tipa:</p>
                      <p id="velikiopispasus2">E30 - san svakog dečaka koji u suštini nije ni imao prilike da iskusi ništa nalik sportskom autu.</p>
                    </div>
                    <div id="tab32" role="tabpanel" class="tab-pane">
                      <p id="specifikacijapasus1">Ovde može da ide specifikacija majica/dukseva.</p>
                      <p id="specifikacijapasus2">Tipa: roko pamuk 300gr/m2 umbro singl, oprati na 30 stepeni sa izvrnutom štampom itd itd</p>
                    </div>
                    <div id="tab33" role="tabpanel" class="tab-pane">
                      

                    <table class="table">
                       <tr class="text-center">
                       <td class="text-left">Veličina</td>
                       <td>2</td>
                       <td>4</td>
                       <td>6</td>
                       <td>8</td>
                       <td>10</td>
                       <td>12</td>
                       <td>14</td>
                       <!--<td>XS</td>
                        <td>S</td>
                        <td>M</td>
                        <td>L</td>
                        <td>XL</td>
                        <td>XXL</td>
                        <td>XXXL</td>
                        <td>XXXXL</td>-->
                        </tr>


                       <?php
                      // include 'baza_podataka.php';
    
                      $dbhost = "localhost";
     $dbuser = " ";
     $dbpass = " ";
     $db = " ";
     $conn = mysqli_connect($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
                   
                      $conn->query("SET NAMES 'utf8'");
                      $id=substr($_GET['b'], 0, 1);
                      if($id == 1 || $id == 2 || $id == 3){
                      //$sql = "SELECT * FROM velicine WHERE velicine.velicinaID =  $id";
                      //$result = $conn->query($sql);

                      $sql = $conn->prepare('SELECT * FROM velicine WHERE velicine.velicinaID = ?');
                      $sql->bind_param('i', $id); // 's' specifies the variable type => 'string'
                      $sql->execute();
                      $result = $sql->get_result();

                      while ($row = $result->fetch_assoc()) {
                        if($row["dvanaest"] == NULL){
                          $dvanes=array("X","X","X");
                        }
                        else{
                          $dvanes = explode(";", $row["dvanaest"]);
                        }
                        if($row["cetrnaest"] == NULL){
                          $cetrnes=array("X","X","X");
                        }
                        else{
                          $cetrnes = explode(";", $row["cetrnaest"]);
                        }
                        if($row["deset"] == NULL){
                          $deset=array("X","X","X");
                        }
                        else{
                          $deset = explode(";", $row["deset"]);
                        }
                        if($row["osam"] == NULL){
                          $osam=array("X","X","X");
                        }
                        else{
                          $osam = explode(";", $row["osam"]);
                        }
                        if($row["sest"] == NULL){
                          $sest=array("X","X","X");
                        }
                        else{
                          $sest = explode(";", $row["sest"]);
                        }
                        if($row["cetiri"] == NULL){
                          $cetiri=array("X","X","X");
                        }
                        else{
                          $cetiri = explode(";", $row["cetiri"]);
                        }
                        if($row["dva"] == NULL){
                          $dva=array("X","X","X");
                        }
                        else{
                          $dva = explode(";", $row["dva"]);
                        }
                        echo '<tr class="text-center">'.
                        '<td class="text-left">Širina</td>'.
                        '<td>'.$dva[0].'</td>'.
                        '<td>'.$cetiri[0].'</td>'.
                        '<td>'.$sest[0].'</td>'.
                        '<td>'.$osam[0].'</td>'.
                        '<td>'.$deset[0].'</td>'.
                        '<td>'.$dvanes[0].'</td>'.
                        '<td>'.$cetrnes[0].'</td>'.
                        '</tr><tr class="text-center">'.
                        '<td class="text-left">Dužina</td>'.
                        '<td>'.$dva[1].'</td>'.
                        '<td>'.$cetiri[1].'</td>'.
                        '<td>'.$sest[1].'</td>'.
                        '<td>'.$osam[1].'</td>'.
                        '<td>'.$deset[1].'</td>'.
                        '<td>'.$dvanes[1].'</td>'.
                        '<td>'.$cetrnes[1].'</td>'.
                        '</tr>';
                        if($id != 2){
                        echo '<tr class="text-center">'.
                        '<td class="text-left">Dužina rukava</td>'.
                        '<td>'.$dva[2].'</td>'.
                        '<td>'.$cetiri[2].'</td>'.
                        '<td>'.$sest[2].'</td>'.
                        '<td>'.$osam[2].'</td>'.
                        '<td>'.$deset[2].'</td>'.
                        '<td>'.$dvanes[2].'</td>'.
                        '<td>'.$cetrnes[2].'</td>'.
                        '</tr>';
                        }
                      }}
                      else{
                        echo '<script>'.
                        'document.getElementById("spec").classList.add("hide")'.
                        '</script>';
                        
                      }
                     
                     // $conn->close();

                        ?>
                        </table>

                        <table class="table">
                       <tr class="text-center">
                       <td class="text-left">Veličina</td>
                       <td>XS</td>
                        <td>S</td>
                        <td>M</td>
                        <td>L</td>
                        <td>XL</td>
                        <td>2XL</td>
                        <td>3XL</td>
                        <td>4XL</td>
                        </tr>


                       <?php
                      // include 'baza_podataka.php';
    
                      $conn->query("SET NAMES 'utf8'");
                      $id=substr($_GET['b'], 0, 1);
                      if($id == 1 || $id == 2 || $id == 3){
                      //$sql = "SELECT * FROM velicine WHERE velicine.velicinaID =  $id";
                      //$result = $conn->query($sql);

                      $sql = $conn->prepare('SELECT * FROM velicine WHERE velicine.velicinaID = ?');
                      $sql->bind_param('i', $id); // 's' specifies the variable type => 'string'
                      $sql->execute();
                      $result = $sql->get_result();

                      while ($row = $result->fetch_assoc()) {
                        if($row["XS"] == NULL){
                          $XS=array("X","X","X");
                        }
                        else{
                          $XS = explode(";", $row["XS"]);
                        }
                        if($row["S"] == NULL){
                          $S=array("X","X","X");
                        }
                        else{
                          $S = explode(";", $row["S"]);
                        }
                        if($row["M"] == NULL){
                          $M=array("X","X","X");
                        }
                        else{
                          $M = explode(";", $row["M"]);
                        }
                        if($row["L"] == NULL){
                          $L=array("X","X","X");
                        }
                        else{
                          $L = explode(";", $row["L"]);
                        }
                        if($row["XL"] == NULL){
                          $XL=array("X","X","X");
                        }
                        else{
                          $XL = explode(";", $row["XL"]);
                        }
                        if($row["XXL"] == NULL){
                          $XXL=array("X","X","X");
                        }
                        else{
                          $XXL = explode(";", $row["XXL"]);
                        }
                        if($row["XXXL"] == NULL){
                          $XXXL=array("X","X","X");
                        }
                        else{
                          $XXXL = explode(";", $row["XXXL"]);
                        }
                        if($row["4XL"] == NULL){
                          $X4L=array("X","X","X");
                        }
                        else{
                          $X4L = explode(";", $row["4XL"]);
                        }
                        echo '<tr class="text-center">'.
                        '<td class="text-left">Širina</td>'.
                        '<td>'.$XS[0].'</td>'.
                        '<td>'.$S[0].'</td>'.
                        '<td>'.$M[0].'</td>'.
                        '<td>'.$L[0].'</td>'.
                        '<td>'.$XL[0].'</td>'.
                        '<td>'.$XXL[0].'</td>'.
                        '<td>'.$XXXL[0].'</td>'.
                        '<td>'.$X4L[0].'</td>'.
                        '</tr><tr class="text-center">'.
                        '<td class="text-left">Dužina</td>'.
                        '<td>'.$XS[1].'</td>'.
                        '<td>'.$S[1].'</td>'.
                        '<td>'.$M[1].'</td>'.
                        '<td>'.$L[1].'</td>'.
                        '<td>'.$XL[1].'</td>'.
                        '<td>'.$XXL[1].'</td>'.
                        '<td>'.$XXXL[1].'</td>'.
                        '<td>'.$X4L[1].'</td>'.
                        '</tr>';
                        if($id != 2){
                        echo '<tr class="text-center">'.
                        '<td class="text-left">Dužina rukava</td>'.
                        '<td>'.$XS[2].'</td>'.
                        '<td>'.$S[2].'</td>'.
                        '<td>'.$M[2].'</td>'.
                        '<td>'.$L[2].'</td>'.
                        '<td>'.$XL[2].'</td>'.
                        '<td>'.$XXL[2].'</td>'.
                        '<td>'.$XXXL[2].'</td>'.
                        '<td>'.$X4L[2].'</td>'.
                        '</tr>';
                        }
                      }}
                      else{
                        echo '<script>'.
                        'document.getElementById("spec").classList.add("hide")'.
                        '</script>';
                        
                      }
                     
                      $conn->close();

                        ?>
                        </table>

                    </div>
                  </div>
                </div>
                <!-- .specification-main-->
              </div>

              
            </div>
            <!-- .block-info-more-->
          </div>
          <!-- .post-->
        </div>
      </section>
      <!-- .mv-main-body-->

      <section class="product-detail-related mv-wrap">
        <div class="container">
          <div class="related-title mv-title-style-3">
            <div class="title-3-text"><span class="behind">ZIPTIE ZIPTIE ZIPTIE</span><span class="main">Možda ti se svidi</span></div>
          </div>
          <!-- .related-title-->

          <?php


    
    
$conn = OpenCon();

    $conn->query("SET NAMES 'utf8'");
    $id=$_GET['b'];
    //$sql = "SELECT * FROM proizvod, tip WHERE proizvod.proizvodID =  $id AND tip.nazivTipa=proizvod.nazivTipa LIMIT 1";
    //$result = $conn->query($sql);            
    $sql = $conn->prepare('SELECT * FROM proizvod, tip WHERE proizvod.proizvodID = ? AND tip.nazivTipa=proizvod.nazivTipa LIMIT 1');
    $sql->bind_param('i', $id); // 's' specifies the variable type => 'string'
    $sql->execute();
    $result = $sql->get_result();
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
          $slike = explode(";", $row["slike"]);
          $slike1 = explode(";", $row["slikeUniverzalne"]);
          $specifikacija = explode(";", $row["specifikacija"]);
          $vOpis = explode(";", $row["velikiOpis"]);
          echo '<script type="text/javascript"> '.
          'document.getElementById("specifikacijapasus1").innerHTML="'.$specifikacija[0].'";'.
          'document.getElementById("specifikacijapasus2").innerHTML="'.$specifikacija[1].'";'.
          'document.getElementById("glavnacena").innerHTML="'.$row["cena"].'";'.
          'document.getElementById("tag2").innerHTML="'.$row["nazivTipa"].'";'.
          'var b = document.getElementById("tag2");'.
          'b.href = "product-grid-3.php?t='.$row["nazivTipa"].'";'.
          'document.getElementById("tag1").innerHTML="'.$row["nazivKategorije"].'";'.
          'var a = document.getElementById("tag1");'.
          'a.href = "product-grid-3.php?k='.$row["nazivKategorije"].'";'.
          'document.getElementById("malinaziv").innerHTML="'.$row["maliNaziv"].'";'.
          'document.getElementById("velikinaziv").innerHTML="'.$row["Naziv"].'";'.
          'document.getElementById("miniopis").innerHTML="'.$row["maliOpis"].'";'.
          'document.getElementById("velikiopispasus1").innerHTML="'.$vOpis[0].'";'.
          'document.getElementById("velikiopispasus2").innerHTML="'.$vOpis[1].'";'.
          'document.getElementById("slika1").src="'.$slike[0].'";'.
          'document.getElementById("slika2").src="'.$slike[1].'";'.
          'document.getElementById("vslika1").src="'.$slike[0].'";'.
          'document.getElementById("vvslika1").href="'.$slike[0].'";'.
          'document.getElementById("vslika2").src="'.$slike[1].'";'.
          'document.getElementById("vvslika2").href="'.$slike[1].'";'.       
          'document.getElementById("pozadibelo").src="'.$slike1[0].'";'.
          'document.getElementById("pozadicrno").src="'.$slike1[1].'";'.
          'document.getElementById("zakard").src="'.$slike1[2].'";'.
          'document.getElementById("slika4").src="'.$slike1[3].'";'.
          'document.getElementById("vpozadibelo").src="'.$slike1[0].'";'.
          'document.getElementById("vvpozadibelo").href="'.$slike1[0].'";'.
          'document.getElementById("vpozadicrno").src="'.$slike1[1].'";'.
          'document.getElementById("vvpozadicrno").href="'.$slike1[1].'";'.
          'document.getElementById("vzakard").src="'.$slike1[2].'";'.
          'document.getElementById("vvzakard").href="'.$slike1[2].'";'.
          'document.getElementById("vslika4").src="'.$slike1[3].'";'.
          'document.getElementById("vvslika4").href="'.$slike1[3].'";'.
          '</script>';
          preporuceni($row["nazivKategorije"]);
        }
      } else {
        echo 'alert("Sifra nije pronadjena")';
      }


      $conn->close();
?>


          
              <?php
              function preporuceni($kategorija){
                  $conn = OpenCon();
                  $conn->query("SET NAMES 'utf8'");

                  
                  //$sql = "SELECT * FROM `proizvod` JOIN tip on proizvod.nazivTipa=tip.nazivTipa WHERE nazivKategorije='$kategorija' OR proizvod.nazivTipa='Aksesoari' ORDER BY RAND() LIMIT 4";
                  //$result = $conn->query($sql);
                  $sql = $conn->prepare("SELECT * FROM `proizvod` JOIN tip on proizvod.nazivTipa=tip.nazivTipa WHERE nazivKategorije= ? OR proizvod.nazivTipa='Aksesoari' ORDER BY RAND() LIMIT 4");
                  $sql->bind_param('s', $kategorija); // 's' specifies the variable type => 'string'
                  $sql->execute();
                  $result = $sql->get_result();

                  
                          if ($result->num_rows > 0) {
                            echo '<div class="related-main">
                            <div class="related-list mv-block-style-9">
                            <div class="block-9-list">';
                              while($row = $result->fetch_assoc()) {
                                $slike = explode(";", $row["slike"]);
                              echo '
                            <article class="col-xs-6 col-sm-4 col-md-3 item post">
                              <div class="item-inner mv-effect-translate-1">
                                <div class="content-thumb">
                                  <div class="thumb-inner mv-effect-relative"><a href="product-detail.php?b='.intval($row["proizvodID"]).'" title="'.$row["maliNaziv"].'"><img src="'.$slike[0].'" alt="'.$row["maliNaziv"].'" class="mv-effect-item"/></a>
            
                                    <!-- <div onclick="$(this).remove()" class="content-sale-off mv-label-style-2 text-center">
                                      <div class="label-2-inner">
                                        <ul class="label-2-ul">
                                          <li class="number">-25%</li>
                                          <li class="text">sale</li>
                                        </ul>
                                      </div>
                                    </div>-->
            
                                    <div class="content-message mv-message-style-1">
                                      <div class="message-inner"></div>
                                    </div>
                                  </div>
            
                                  <div class="content-hover">
                                    <div class="content-button mv-btn-group text-center">
                                      <div class="group-inner">
                                        <button type="button" class="mv-btn mv-btn-style-1 btn-3-h-40 responsive-btn-3-type-1"><a href="product-detail.php?b='.intval($row["proizvodID"]).'"><span class="btn-inner"><i class="btn-icon fa fa-cart-plus"></i><span class="btn-text">Pogledaj</span></span></a></button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
            
                                <div class="content-default">
                                  <div class="content-price"><span class="new-price">'.$row["cena"].' RSD</span><!--<span class="old-price">$ 170.99</span>--></div>
                                  <div class="content-desc"><a href="product-detail.php?b='.intval($row["proizvodID"]).'" title="'.$row["Naziv"].'" class="mv-overflow-ellipsis">'.$row["Naziv"].'</a></div>
                                </div>
                              </div>
                            </article>';

                              }
                              echo '
                              <!-- .post-->
                              </div>
                            </div>
                          </div>';
                            }
                          }

                 ?>
               

                
        </div>
      </section>
      <!-- .product-detail-related-->

      
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
      <!-- .footer-->

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