<?php
session_start();
$total=0;
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>O nama - ZIPTIE</title>
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
                   <li class="mega-columns"><a href="index.php"><span class="menu-text">Po??etna</span></a>
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
                         <div class="block-39-header">Sadr??aj korpe je:</div>
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
                                       <li class="meta-item mv-icon-left-style-3"><span class="text">Koli??ina:'.$vrednost["kolicina"].'</span></li>
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
        <div data-image-src="images/background/about.jpg" class="mv-banner-style-1 mv-bg-overlay-dark overlay-0-85 mv-parallax">
          <div class="page-name mv-caption-style-6">
            <div class="container">
              <div class="mv-title-style-9"><span class="main">O nama</span><img src="images/icon/icon_line_polygon_line.png" alt="icon" class="line"/></div>
            </div>
          </div>
        </div>
      </section>
      <!-- .main-banner-->

      <section class="main-breadcrumb mv-wrap">
        <div class="mv-breadcrumb-style-1">
          <div class="container">
            <ul class="breadcrumb-1-list">
              <li><a href="home.php"><i class="fa fa-home"></i></a></li>
              <li><a>O nama</a></li>
            </ul>
          </div>
        </div>
      </section>
      <!-- .main-breadcrumb-->

      <section class="mv-main-body about-us-main mv-bg-gray mv-wrap">
        <div class="about-us-inner">
          <div class="block-our-story">
            <div class="container">
              <div class="mv-block-style-34 mv-bg-white mv-box-shadow-gray-1">
                <div class="block-34-inner">
                  <div class="block-34-title">
                    <div class="text-main">O nama</div>
                    <div class="text-sub">ZIPTIE</div>
                  </div>
                  <div style="background-image: url(/images/background/about.jpg);" class="block-34-box">
                    <div class="block-34-box-inner mv-col-wrapper">
                      <div class="mv-col-left block-34-thumb"><span style="background-image: url(/images/background/logo.jpg);" class="block-34-thumb-img"></span></div>
                      <div class="mv-col-right block-34-main">
                        <div class="block-34-content">ZIPTIE predstavlja skupinu drugara koja svoju ljubav prema automobilima pretvara u garderobu! Smatramo da ZIPTIE okuplja sve ljude koji imaju najmanje jednu zajedni??ku osobinu - ljubav prema automobilima. Svako ko pazi na svoj auto, provodi sate na sajtovima za polovne automobile i bleji par sati dnevno na YouTubu gledaju??i auto moto sadr??aj - jedan je od nas. Mi volimo auto zajednicu i ??elimo da damo svoj doprinost. Ovo je na?? doprinos.</div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- .mv-block-style-34-->
            </div>
          </div>
          <!-- .block-our-story-->

          
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
                          <p>ZIPTIE predstavlja skupinu entuzijasta koji svoju strast prema automobilima izra??ava kroz garderobu.</p>
                          <p>Svi se divimo ma??inama, njihovom uticaju na istoriju automobila i auto-moto sport - za??to ih ne ovekove??iti garderobom?</p>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- <div class="col-md-3 footer-nav-col footer-faqs"><a data-toggle="collapse" data-parent="#footerNav" href="#footerFaqs" aria-expanded="false" aria-controls="footerFaqs" class="footer-title collapsed">faqs</a>
                    <div id="footerFaqs" role="tabpanel" class="footer-main collapse">
                      <ul class="mv-ul footer-main-inner list">
                        <li class="item mv-icon-left-style-2"><a href="#"><span class="text"><span class="icon"><i class="fa fa-angle-right"></i></span>Kontaktiraj nas</span></a></li>
                        <li class="item mv-icon-left-style-2"><a href="#"><span class="text"><span class="icon"><i class="fa fa-angle-right"></i></span>Povrat garderobe</span></a></li>
                        <li class="item mv-icon-left-style-2"><a href="#"><span class="text"><span class="icon"><i class="fa fa-angle-right"></i></span>Veli??ine</span></a></li>
                        <li class="item mv-icon-left-style-2"><a href="#"><span class="text"><span class="icon"><i class="fa fa-angle-right"></i></span>Dostava</span></a></li>
                        <li class="item mv-icon-left-style-2"><a href="#"><span class="text"><span class="icon"><i class="fa fa-angle-right"></i></span>Pla??anje</span></a></li>
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

              <div class="footer-copyright text-center">Copyright &copy; 2022 ZIPTIE Sva prava zadr??ana.</div>
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
              <li class="mega-columns"><a href="index.php"><span class="menu-text">Po??etna </i></span></a></li>
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