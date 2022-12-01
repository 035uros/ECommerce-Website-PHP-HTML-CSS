<?php
session_start();


$total=0;


if(isset($_POST["dodajukorpu"])){
  
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
      'slikacrna'   => $_POST['skrivenaslikacrna']
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
      'slikabela'   => $_POST['skrivenaslikabela'],
      'slikacrna'   => $_POST['skrivenaslikacrna']
    );
    $_SESSION["korpa"][0]=$nizproizvoda;
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
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Proizvodi</title>
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
                    <li><a href="about-us.html"><span class="menu-text">O NAMA</span></a></li>
                    <!--<li><a href="contact.html"><span class="menu-text">Kontakt</span></a></li>-->
                   
                  </ul>
                </nav>
                </div>
              </div>
              <!-- .header-main-nav-->

              <div class="header-right-button">
                <div class="header-search">
                   <div class="item-button">
                    <!--<button type="button" data-toggle="modal" data-target="#popupSearch" class="mv-btn mv-btn-style-10 btn-open-field-search"><i class="fa fa-search"></i></button>-->
                    <button type="button" class="mv-btn mv-btn-style-10 btn-open-filter click-btn-off-canvas-right hidden-md hidden-lg"><i class="fa fa-filter mv-f-18"></i></button>
                  </div>
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
        <div data-image-src="images/background/proizvod.png" class="mv-banner-style-1 mv-bg-overlay-dark overlay-0-85 mv-parallax">
          <div class="page-name mv-caption-style-6">
            <div class="container">
              <div class="mv-title-style-9"><span class="main">Proizvodi</span><img src="images/icon/icon_line_polygon_line.png" alt="icon" class="line"/></div>
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
              <li><a id="maliTip">Proizvodi</a></li>
              <li><a id="malaOznaka"></a></li>
            </ul>
          </div>
        </div>
      </section>
      <!-- .main-breadcrumb-->

      <section class="mv-main-body product-grid-3-main mv-bg-gray mv-wrap">
        <div class="container">
          <div class="row mv-content-sidebar">
            <div class="mv-c-s-content col-xs-12 col-md-8 col-lg-9">
              <div class="row mv-list-product-wrapper mv-block-style-9">
                <div class="block-9-list mv-list-product">
                  <?php
                  include 'baza_podataka.php';
                  $conn = OpenCon();
                  $conn->query("SET NAMES 'utf8'");

                  
                  $sql = "SELECT * FROM `proizvod` JOIN tip on proizvod.nazivTipa=tip.nazivTipa";
                  $i=0;
                  
                  if (!empty($_GET['k']) && !empty($_GET['t'])){
                    $kategorija=$_GET['k'];
                    $tip=$_GET['t'];
                    echo '<script type="text/javascript"> '.
                    'document.getElementById("malaOznaka").innerHTML="'.$kategorija.'";'.
                    'document.getElementById("maliTip").innerHTML="'.$tip.'";'.
                    '</script>';
                    $sql = $sql . " WHERE nazivKategorije = '$kategorija' AND proizvod.nazivTipa = '$tip'";
                    
                  }
                  elseif(!empty($_GET['k'])){
                    $kategorija=$_GET['k'];
                    echo '<script type="text/javascript"> '.
                    'document.getElementById("malaOznaka").innerHTML="'.$kategorija.'";'.
                    '</script>';
                    $sql = $sql . " WHERE nazivKategorije = '$kategorija'";
                    echo '<script type="text/javascript"> '.
                    'document.getElementById("maliTip").innerHTML="PROIZVODI";'.
                    '</script>';
                  }
                  elseif (!empty($_GET['t'])){
                    $tip=$_GET['t'];
                    echo '<script type="text/javascript"> '.
                    'document.getElementById("maliTip").innerHTML="'.$tip.'";'.
                    '</script>';
                    $sql = $sql . " AND proizvod.nazivTipa = '$tip'";
                    echo '<script type="text/javascript"> '.
                    'document.getElementById("malaOznaka").innerHTML="SVI PROIZVODI";'.
                    '</script>';
                    
                  }
                  else{
                    echo '<script type="text/javascript"> '.
                    'document.getElementById("maliTip").innerHTML="PROIZVODI";'.
                    'document.getElementById("malaOznaka").innerHTML="SVI PROIZVODI";'.
                    '</script>';
                  }
                  if(!empty($_GET['s'])){
                    $od=$_GET['s'];
                    if($od==1){
                      $od=0;
                      $do=12;
                    }
                    else{
                      $od=0;
                      for($korak=1; $korak < $_GET['s']; $korak++){
                        $od = $od + 12;
                      }
                      $do=12;
                    }
                    $sql = $sql . " LIMIT $od, $do";

                  }
                  else{
                    $sql = $sql . " LIMIT 0, 12";
                  }
                  
                  
                  $result = $conn->query($sql);
                  
                          if ($result->num_rows > 0) {
                              while($row = $result->fetch_assoc()) {
                                $i=$i+1;
                                $slike = explode(";", $row["slike"]);
                              echo '
                              <article class="col-xs-6 col-sm-4 col-md-6 col-lg-4 item item-product-grid-3 post">
                              <div class="item-inner mv-effect-translate-1 mv-box-shadow-gray-1">
                                <div style="background-color: #fff;" class="content-thumb">
                                  <div class="thumb-inner mv-effect-relative"><a href="product-detail.php?b='.intval($row["proizvodID"]).'" title="'.$row["Naziv"].'"><img src="'.$slike[0].'" alt="'.$row["maliNaziv"].'" class="mv-effect-item"/></a><a href="product-detail.php?b='.intval($row["proizvodID"]).'" title="'.$row["Naziv"].'" class="mv-btn mv-btn-style-25 btn-readmore-plus hidden-xs"><span class="btn-inner"></span></a>
                
                                    <div class="content-message mv-message-style-1">
                                      <div class="message-inner"></div>
                                    </div>
                
                                    <!--onclick="$(this).remove()"-->
                                   
                                    <div><img src="images/logo/logo_2.png" height="15%" style="top: 1%;"></div>
                                  </div>
                                </div>
                
                                <div class="content-default">
                                <div class="content-price"><span class="new-price">'.$row["cena"].' RSD</span><!--<span class="old-price">$ 170.99</span>--></div>
                                <div class="content-desc"><a href="product-detail.php?b='.intval($row["proizvodID"]).'" title="'.$row["Naziv"].'" class="mv-overflow-ellipsis">'.$row["Naziv"].'</a></div>
                              </div>
                
                                <div class="content-hover">
                                <div class="content-button mv-btn-group text-center">
                                    <div class="group-inner">
                                      <a href="product-detail.php?b='.intval($row["proizvodID"]).'" class="mv-btn mv-btn-style-1 btn-3-h-40 responsive-btn-3-type-1 "><span class="btn-inner"><i class="btn-icon fa fa-cart-plus"></i><span class="btn-text">Detalji</span></span></a>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </article>'.
                            
                              '</script>';
                              
                        
                      }
                    } else {
                      
                      echo 'Nažalost, nemamo proizvod sa datim karakteristikama u ponudi. ZIPTIE uskoro ide u nabavku pa će potražiti i to.';
                    }
                
                          $conn->close();

                  ?>
                
                </div>
              </div>
              <!-- .mv-list-product-wrapper-->

              <div class="mv-pagination-wrapper">
                <div class="mv-pagination-style-1 has-count-post">
                <div class="count-post mv-title-style-10">Broj stranica: <span class="number" id="brojstranica">0</span> ZIPTIE.</div>
                  <ul class="pagination" id="stranice">
                    <!--<li class="prev"><a href="#">NAZAD</a></li>
                    <li class="active"><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li ><a>3</a></li>
                    <li><a href="#">4</a></li>
                    <li><a href="#">5</a></li>
                    <li class="next"><a href="#">NAPRED</a></li>-->
                  </ul>
                </div>
                <!-- .mv-pagination-style-1-->
              </div>
              <!-- .mv-pagination-wrapper-->
            </div>
            <!-- .mv-c-s-content-->

            <div class="mv-c-s-sidebar col-xs-12 col-md-4 col-lg-3 hidden-xs hidden-sm">
              <div class="mv-c-s-sidebar-inner">
                <!--<div class="mv-aside mv-aside-search">
                  <div class="aside-title mv-title-style-11">search</div>
                  <div class="aside-body">
                    <form method="GET" class="form-aside-search">
                      <div class="mv-inputbox-icon right">
                        <input type="text" name="test138" class="mv-inputbox mv-inputbox-style-2"/>
                        <button type="submit" class="icon mv-btn mv-btn-style-4 fa fa-search"></button>
                      </div>
                    </form>
                  </div>
                </div>-->
                <!-- .mv-aside-search-->

                <!--<div class="mv-aside mv-aside-filter-by-price">
                  <div class="aside-title mv-title-style-11">filter by price</div>
                  <div class="aside-body">
                    <form method="GET" class="form-aside-filter-by-price">
                      <div class="mv-slider-range">
                        <div class="slider-range-wrapper mv-slider-range-style-1">
                          <div class="slider-range"></div>
                        </div>
                        <div class="mv-dp-table align-middle">
                          <div class="mv-dp-table-cell view-values">Price: $<span class="min-value"></span> - $<span class="max-value"></span></div>
                          <div class="mv-dp-table-cell filter-button">
                            <button type="submit" class="mv-btn mv-btn-style-5 btn-5-h-30">filter</button>
                          </div>
                        </div>
                      </div>
                    </form>

                    <nav class="filter-by-price-menu mv-menu-style-1">
                      <ul>
                        <li><a href="#" class="mv-icon-left-style-5">$10 - $50<span class="sub-text">&nbsp; (8)</span></a></li>
                        <li><a href="#" class="mv-icon-left-style-5">$50 - $100<span class="sub-text">&nbsp; (8)</span></a></li>
                        <li><a href="#" class="mv-icon-left-style-5">$100 - $500<span class="sub-text">&nbsp; (3)</span></a></li>
                        <li><a href="#" class="mv-icon-left-style-5">$500 - $1000<span class="sub-text">&nbsp; (16)</span></a></li>
                        <li><a href="#" class="mv-icon-left-style-5">$1000 - $5000<span class="sub-text">&nbsp; (6)</span></a></li>
                      </ul>
                    </nav>
                  </div>
                </div>-->
                <!-- .mv-aside-filter-by-price-->

                <div class="mv-aside mv-aside-product-type">
                  <div class="aside-title mv-title-style-11">Tip proizvoda</div>
                  <div class="aside-body">
                    <nav class="product-type-menu mv-menu-style-1">
                      <ul id="tipovi">
                        <!--<li><a href="#" class="mv-icon-left-style-5">Full Face Helmets<span class="sub-text">&nbsp; (8)</span></a></li>
                        <li><a href="#" class="mv-icon-left-style-5">Flip Up Helmets<span class="sub-text">&nbsp; (3)</span></a></li>
                        <li><a href="#" class="mv-icon-left-style-5">Open Face Helmets<span class="sub-text">&nbsp; (38)</span></a></li>
                        <li><a href="#" class="mv-icon-left-style-5">Adventure Helmets<span class="sub-text">&nbsp; (12)</span></a>
                          <ul class="sub-menu">
                            <li><a href="#" class="mv-icon-left-style-5">AGV Helmets<span class="sub-text">&nbsp; (3)</span></a></li>
                            <li><a href="#" class="mv-icon-left-style-5">Arai Helmets<span class="sub-text">&nbsp; (12)</span></a></li>
                            <li class="active"><a href="#" class="mv-icon-left-style-5">Bell Helmets<span class="sub-text">&nbsp; (8)</span></a></li>
                            <li><a href="#" class="mv-icon-left-style-5">BOX Helmets<span class="sub-text">&nbsp; (15)</span></a></li>
                          </ul>
                        </li>
                        <li><a href="#" class="mv-icon-left-style-5">Trousers<span class="sub-text">&nbsp; (19)</span></a></li>
                        <li><a href="#" class="mv-icon-left-style-5">Dresses<span class="sub-text">&nbsp; (34)</span></a></li>
                        <li><a href="#" class="mv-icon-left-style-5">Shoes<span class="sub-text">&nbsp; (22)</span></a></li>
                        <li><a href="#" class="mv-icon-left-style-5">Accessories<span class="sub-text">&nbsp; (17)</span></a></li>
                        <li><a href="#" class="mv-icon-left-style-5">Sale<span class="sub-text">&nbsp; (3)</span></a></li>
                        <li><a href="#" class="mv-icon-left-style-5"> <strong>View More</strong><span class="sub-text">&nbsp; (50) &nbsp;</span><i class="fa fa-caret-down"></i></a></li>-->
                      </ul>
                    </nav>
                  </div>
                </div>
                <!-- .mv-aside-product-type

                <div class="mv-aside mv-aside-filter-by-size">
                  <div class="aside-title mv-title-style-11">filter by</div>
                  <div class="aside-body">
                    <nav class="filter-by-price-menu mv-menu-style-1">
                      <ul>
                        <li><a href="#" class="mv-icon-left-style-5">Extra Large</a></li>
                        <li><a href="#" class="mv-icon-left-style-5">Extra Small</a></li>
                        <li class="active"><a href="#" class="mv-icon-left-style-5">Large</a></li>
                        <li><a href="#" class="mv-icon-left-style-5">Medium</a></li>
                        <li><a href="#" class="mv-icon-left-style-5">One Size Fits All</a></li>
                        <li><a href="#" class="mv-icon-left-style-5">Small</a></li>
                        <li><a href="#" class="mv-icon-left-style-5">Taille Unique</a></li>
                        <li><a href="#" class="mv-icon-left-style-5">Sale</a></li>
                      </ul>
                    </nav>
                  </div>
                </div>-->
                <!-- .mv-aside-filter-by-size-->

               <!--  <div class="mv-aside mv-aside-size">
                  <div class="aside-title mv-title-style-11">size</div>
                  <div class="aside-body">
                    <nav class="size-list">
                      <div class="mv-btn-group">
                        <div class="group-inner"><a href="#" class="mv-btn mv-btn-style-21">XXL</a><a href="#" class="mv-btn mv-btn-style-21 active">XL</a><a href="#" class="mv-btn mv-btn-style-21">L</a><a href="#" class="mv-btn mv-btn-style-21">M</a><a href="#" class="mv-btn mv-btn-style-21">S</a></div>
                      </div>
                    </nav>
                  </div>
                </div>-->
                <!-- .mv-aside-size-->

                <!--<div class="mv-aside mv-aside-color">
                  <div class="aside-title mv-title-style-11">color</div>
                  <div class="aside-body">
                    <div class="color-list mv-list-inline-style-1 space-10">
                      <ul class="list-inline-1">
                        <li class="active"><a href="#"><span style="background-color: #7bef66;" class="icon-color"></span></a></li>
                        <li><a href="#"><span style="background-color: #ff8888;" class="icon-color"></span></a></li>
                        <li><a href="#"><span style="background-color: #c4dd66;" class="icon-color"></span></a></li>
                        <li><a href="#"><span style="background-color: #94b7f7;" class="icon-color"></span></a></li>
                        <li><a href="#"><span style="background-color: #a3fbff;" class="icon-color"></span></a></li>
                        <li><a href="#"><span style="background-color: #f7fb0d;" class="icon-color"></span></a></li>
                        <li><a href="#"><span style="background-color: #7b7878;" class="icon-color"></span></a></li>
                        <li><a href="#"><span style="background-color: #d041ff;" class="icon-color"></span></a></li>
                        <li><a href="#"><span style="background-color: #fdab14;" class="icon-color"></span></a></li>
                        <li><a href="#"><span style="background-color: #eeeeee" class="icon-color"></span></a></li>
                      </ul>
                    </div>
                  </div>
                </div>-->
                <!-- .mv-aside-color-->

                <!--<div class="mv-aside mv-aside-products">
                  <div class="aside-title mv-title-style-11">products</div>
                  <div class="aside-body">
                    <div class="products-list">
                      <div class="mv-block-style-24">
                        <div class="block-24-list">
                          
                           
                        </div>
                      </div>
                       
                    </div>
                  </div>
                </div>-->
                <!-- .mv-aside-products-->

                <div class="mv-aside mv-aside-tags">
                  <div class="aside-title mv-title-style-11">Oznake</div>
                  <div class="aside-body">
                    <div class="tag-list">
                      <div class="mv-btn-group">
                        <div class="group-inner" id="oznake">
                        <a href="product-grid-3.php?" class="mv-btn mv-btn-style-22">PRIKAŽI SVE</a></div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- .mv-aside-tags-->
              </div>
            </div>
            <!-- .mv-c-s-sidebar-->
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
                  <div class="col-md-3 footer-nav-col footer-contact"  ><a data-toggle="collapse" data-parent="#footerNav" href="#footerContact" aria-expanded="true" aria-controls="footerContact" class="footer-title collapsed">KONTAKT</a>
                    <div id="footerContact" role="tabpanel" class="footer-main collapse">
                      <ul class="mv-ul footer-main-inner list"  >
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

                  <div class="col-md-3 footer-nav-col footer-about-us"  ><a data-toggle="collapse" data-parent="#footerNav" href="#footerAboutUs" aria-expanded="false" aria-controls="footerAboutUs" class="footer-title collapsed">O NAMA</a>
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
              <li><a href="about-us.html"><span class="menu-text">O nama</span></a></li>
            </ul>
          </nav>
        </div>
      </div>
    </div>
    <!-- .off-canvas-wrapper-left-->
    <div class="off-canvas-wrapper-right hidden-md hidden-lg">
        <div class="off-canvas-right">
          <div class="off-canvas-header">
            <button class="btn-close-off-canvas click-close-off-canvas">x</button>
          </div>

            <div class="mv-aside mv-aside-product-type">
              <div class="aside-title mv-title-style-11">product type</div>
              <div class="aside-body">
                <nav class="product-type-menu mv-menu-style-1">
                  
                  <ul>
                    <li><a  class="mv-icon-left-style-5" href="product-grid-3.php?t=Majica&k=">Majice</a></li>
                    <li><a  class="mv-icon-left-style-5" href="product-grid-3.php?t=Majica dugih rukava&k=">Majice dugih rukava</a></li>
                    <li><a  class="mv-icon-left-style-5" href="product-grid-3.php?t=Duks&k=">Duksevi</a></li>
                    <li><a  class="mv-icon-left-style-5" href="product-grid-3.php?t=Aksesoari&k=">Aksesoari</a></li>
                    </ul>
                </nav>
              </div>
            </div>
            <!-- .mv-aside-product-type-->

           
            

            <div class="mv-aside mv-aside-tags">
              <div class="aside-title mv-title-style-11">tags</div>
              <div class="aside-body">
                <div class="tag-list">
                  <div class="mv-btn-group">
                    <div class="group-inner"><a href="#" class="mv-btn mv-btn-style-22">Helmet</a><a href="#" class="mv-btn mv-btn-style-22 active">Gloves</a><a href="#" class="mv-btn mv-btn-style-22">Sercurity</a><a href="#" class="mv-btn mv-btn-style-22">Boots</a><a href="#" class="mv-btn mv-btn-style-22">Clothing</a><a href="#" class="mv-btn mv-btn-style-22">Luggage</a><a href="#" class="mv-btn mv-btn-style-22">Maintenance</a><a href="#" class="mv-btn mv-btn-style-22">Bodywork</a><a href="#" class="mv-btn mv-btn-style-22">Gift</a><a href="#" class="mv-btn mv-btn-style-22">Exhauts</a><a href="#" class="mv-btn mv-btn-style-22">Tyres</a><a href="#" class="mv-btn mv-btn-style-22">Casual Wear</a><a href="#" class="mv-btn mv-btn-style-22">R&G Racing</a></div>
                  </div>
                </div>
              </div>
            </div>
            
            <!-- .mv-aside-tags-->
          </div>
        </div>
      </div>
      <!-- .off-canvas-wrapper-right-->


    <?php
    error_reporting(0);


   // include 'baza_podataka.php';

    $conn = OpenCon();

        $conn->query("SET NAMES 'utf8'");
        $sql1 = "SELECT * FROM `kategorija`";
        $result = $conn->query($sql1);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
              echo '<script type="text/javascript"> '.
              'var tag = document.createElement("a");'.
              '</script>';
              if($kategorija==$row["nazivKategorije"]){
              echo '<script type="text/javascript"> '.
              'tag.className = "mv-btn  mv-btn-style-22 active";'.
              '</script>';}
              else{
                echo '<script type="text/javascript"> '.
              'tag.className = "mv-btn  mv-btn-style-22";'.
              '</script>';
              }
              echo '<script type="text/javascript"> '.
              'tag.setAttribute("id","'.$row["nazivKategorije"].'");'.
              'tag.href="product-grid-3.php?k='.$row["nazivKategorije"].'&t='.$tip.'";'.
              'var text = document.createTextNode("'.$row["nazivKategorije"].'");'.
              'tag.appendChild(text);'.
              'var element = document.getElementById("oznake");'.
              'element.appendChild(tag)'.
              '</script>';
              }
          } else {
            echo 'alert("Greska")';
          }
//<li><a href="#" class="mv-icon-left-style-5">Full Face Helmets<span class="sub-text">&nbsp; (8)</span></a></li>

$sql2 = "SELECT * FROM `tip`";
$result = $conn->query($sql2);

        if ($result->num_rows > 0) {
         // output data of each row
            while($row = $result->fetch_assoc()) {
            echo '<script type="text/javascript"> '.
            'var li = document.createElement("li");'.
            'var tag = document.createElement("a");'.
            'tag.href="product-grid-3.php?t='.$row["nazivTipa"].'&k='.$kategorija.'";'.
            'tag.className = "mv-icon-left-style-5";'.
            'var text = document.createTextNode("'.$row["nazivTipa"].'");'.
            'tag.appendChild(text);'.
            'li.appendChild(tag);'.
            'var element = document.getElementById("tipovi");'.
            'element.appendChild(li)'.
            '</script>';
      
    }
  } else {
    echo 'alert("Greska")';
  }
  $sql3 = "SELECT COUNT(proizvodID) as broj FROM proizvod";

  if (!empty($_GET['k']) && !empty($_GET['t'])){
    $kategorija=$_GET['k'];
    $tip=$_GET['t'];
    $sql3 = $sql3 . " WHERE nazivTipa  = '$tip' AND nazivKategorije = '$kategorija'";
    
  }
  elseif(!empty($_GET['k'])){
    $kategorija=$_GET['k'];
    $sql3 = $sql3 . " WHERE nazivKategorije = '$kategorija'";
  }
  elseif (!empty($_GET['t'])){
    $tip=$_GET['t'];
    $sql3 = $sql3 . " WHERE nazivTipa  = '$tip'";
    
  }

  $result =$conn->query($sql3);
  $broj = $result->fetch_assoc();

  if(!empty($_GET['s'])){
    $c = $_GET['s'];
  }else{
    $c=1;
  }
  
    $b =ceil((int)$broj['broj']/12);

    if($c==1){
      $pre=1;
    }
    else{
      $pre=$c-1;
    }
    if($c==$b){
      $next=$b;
    }
    else{
      $next=$c+1;
    }
        if ($b > 0) {
          echo '<script type="text/javascript"> '.
              'var li = document.createElement("li");'.
              'li.className = "prev";'.
              'var tag = document.createElement("a");'.
              'tag.href="product-grid-3.php?k='.$kategorija.'&t='.$tip.'&s='.$pre.'";'.
              'var text = document.createTextNode("NAZAD");'.
              'tag.appendChild(text);'.
              'li.appendChild(tag);'.
              'var element = document.getElementById("stranice");'.
              'element.appendChild(li)'.
              '</script>';
          for ($i = $c-2; $i <= $c+2; $i++){
            if($i >= 1 && $i <= $b){
              echo '<script type="text/javascript"> '.
              'var li = document.createElement("li");'.
              '</script>';
              if($c == $i){
                echo '<script type="text/javascript"> '.
                'li.className = "active";'.
                '</script>';
              }
              echo '<script type="text/javascript"> '.
              'var tag = document.createElement("a");'.
              'tag.href="product-grid-3.php?k='.$kategorija.'&t='.$tip.'&s='.$i.'";'.
              'var text = document.createTextNode("'.$i.'");'.
              'tag.appendChild(text);'.
              'li.appendChild(tag);'.
              'var element = document.getElementById("stranice");'.
              'element.appendChild(li)'.
              '</script>';
            }}
    echo '<script type="text/javascript"> '.
              'var li = document.createElement("li");'.
              'li.className = "next";'.
              'var tag = document.createElement("a");'.
              'tag.href="product-grid-3.php?k='.$kategorija.'&t='.$tip.'&s='.$next.'";'.
              'var text = document.createTextNode("SLEDEĆA");'.
              'tag.appendChild(text);'.
              'li.appendChild(tag);'.
              'var element = document.getElementById("stranice");'.
              'element.appendChild(li)'.
              '</script>';
  } 
  echo '<script>document.getElementById("brojstranica").innerHTML = "'.$b.'";</script>';
  $conn->close();

    ?>
    <div class="off-canvas-wrapper-right hidden-md hidden-lg">
        <div class="off-canvas-right">
          <div class="off-canvas-header">
            <button class="btn-close-off-canvas click-close-off-canvas">x</button>
          </div>

            <div class="mv-aside mv-aside-product-type">
              <div class="aside-title mv-title-style-11">Tip proizvoda</div>
              <div class="aside-body">
                <nav class="product-type-menu mv-menu-style-1">
                  
                  <ul>
                    <li><a  class="mv-icon-left-style-5" href="product-grid-3.php?t=Majica&k=">Majice</a></li>
                    <li><a  class="mv-icon-left-style-5" href="product-grid-3.php?t=Majica dugih rukava&k=">Majice dugih rukava</a></li>
                    <li><a  class="mv-icon-left-style-5" href="product-grid-3.php?t=Duks&k=">Duksevi</a></li>
                    <li><a  class="mv-icon-left-style-5" href="product-grid-3.php?t=Aksesoari&k=">Aksesoari</a></li>
                    </ul>
                </nav>
              </div>
            </div>
            <!-- .mv-aside-product-type-->

           
            

            <div class="mv-aside mv-aside-tags">
                  <div class="aside-title mv-title-style-11">Oznake</div>
                  <div class="aside-body">
                    <div class="tag-list">
                      <div class="mv-btn-group">
                        <div class="group-inner" id="oznake1">
                        <a href="product-grid-3.php?" class="mv-btn mv-btn-style-22">PRIKAŽI SVE</a></div>
                      </div>
                    </div>
                  </div>
                </div>
            <!-- .mv-aside-tags-->
          </div>
        </div>
      </div>
      <!-- .off-canvas-wrapper-right-->
</div>
<?php
    error_reporting(0);


   // include 'baza_podataka.php';

    $conn = OpenCon();

        $conn->query("SET NAMES 'utf8'");
        $sql1 = "SELECT * FROM `kategorija`";
        $result = $conn->query($sql1);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
              echo '<script type="text/javascript"> '.
              'var tag = document.createElement("a");'.
              '</script>';
              if($kategorija==$row["nazivKategorije"]){
              echo '<script type="text/javascript"> '.
              'tag.className = "mv-btn  mv-btn-style-22 active";'.
              '</script>';}
              else{
                echo '<script type="text/javascript"> '.
              'tag.className = "mv-btn  mv-btn-style-22";'.
              '</script>';
              }
              echo '<script type="text/javascript"> '.
              'tag.setAttribute("id","'.$row["nazivKategorije"].'");'.
              'tag.href="product-grid-3.php?k='.$row["nazivKategorije"].'&t='.$tip.'";'.
              'var text = document.createTextNode("'.$row["nazivKategorije"].'");'.
              'tag.appendChild(text);'.
              'var element = document.getElementById("oznake1");'.
              'element.appendChild(tag)'.
              '</script>';
              }
          } else {
            echo 'alert("Greska")';
          }
          ?>

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