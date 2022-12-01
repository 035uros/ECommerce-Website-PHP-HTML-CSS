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
    <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-WGVF2M0D3Z"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-WGVF2M0D3Z');
</script>
    <meta charset="UTF-8">
    <title>Majice i Duksevi za automobilske entuzijaste - ZIPTIE</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Ukoliko tražite garderobu inspirisanu motivima automobilima, iz auto moto sveta ZIPTIE je pravo mesto za vas! Najkvalitetnije majice i duksevi sa BMW, VW, Audi, JDM motivima. Automobilske majice i auto-moto duksevi su naša ljubav.">
    <meta name="author" content="Uroš Milošević">

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
    <link rel="stylesheet" type="text/css" href="css/home.css">
    <link rel="stylesheet" type="text/css" href="css/style-selector.css">
    <link id="style-main-color" rel="stylesheet" type="text/css" href="css/color/color5.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries-->
    <!-- WARNING: Respond.js doesn't work if you view the page via file://-->
    <!--if lt IE 9
    script(src='https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js')
    script(src='https://oss.maxcdn.com/respond/1.4.2/respond.min.js')
    
    -->
    <script type="text/javascript" src="js/javascript.js"></script>
  </head>
  <body>
    <div class="mv-site">
      <header class="header mv-header-style-2 mv-wrap">
        

        <div class="header-main-nav mv-fixed-enabled">
          <div class="container">
            <div class="container-inner">
              <div class="header-toggle-off-canvas hidden-md hidden-lg">
                <button type="button" class="mv-btn mv-btn-style-5 btn-off-canvas-toggle click-btn-off-canvas-left"><i class="icon fa fa-bars"></i></button>
              </div>
              <!-- .header-toggle-off-canvas-->

              <div class="header-logo"><a href="index.php" title="Motor Vehikal"><img src="images/logo/logo_1.png" alt="logo" class="logo-img img-default image-live-view"/><img src="images/logo/logo_2.png" alt="logo" class="logo-img img-scroll image-live-view"/></a></div>
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
              <a href="index.php?action=delete&id1='.$vrednost["id"].'&b1='.$vrednost["boja"].'&v1='.$vrednost["velicina"].'"  title="Izbaci iz korpe" class="mv-btn mv-btn-style-4 fa fa-close btn-delete-product"></a>
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

      <section class="home-1-slideshow mv-wrap">
        <div id="home-1-slideshow" class="mv-caroufredsel">
          <ul class="mv-slider-wrapper">
            <li class="mv-slider-item"><img src="images/slideshow/slide1.jpg" alt="slide" class="mv-slider-img"/>
              <div class="mv-caption-style-1">
                <div class="container">
                  <div class="caption-1-text-1">OD ENTUZIJASTA</div>
                  <div class="caption-1-text-2">
                    <div class="mv-title-style-1"><img src="images/icon/icon_line_1.png" alt="icon" class="line-left"/><img src="images/icon/icon_line_2.png" alt="icon" class="line-right"/>ZIPTIE</div>
                  </div><a href="product-grid-3.php" class="caption-1-button-1 mv-btn mv-btn-style-1 responsive-btn-1-type-2"><span class="btn-inner"><i class="btn-icon fa fa-cart-plus"></i><span class="btn-text">Započni kupovinu</span></span></a>
                </div>
              </div>
            </li>
            <!-- .mv-slider-item-->

            <li class="mv-slider-item"><img src="images/slideshow/slide2.jpg" alt="slide" class="mv-slider-img"/>
              <div class="mv-caption-style-1">
                <div class="container">
                  <div class="caption-1-text-1">ZA ENTUZIJASTE</div>
                  <div class="caption-1-text-2">
                    <div class="mv-title-style-1"><img src="images/icon/icon_line_1.png" alt="icon" class="line-left"/><img src="images/icon/icon_line_2.png" alt="icon" class="line-right"/>ZIPTIE</div>
                  </div><a href="product-grid-3.php" class="caption-1-button-1 mv-btn mv-btn-style-1 responsive-btn-1-type-2"><span class="btn-inner"><i class="btn-icon fa fa-cart-plus"></i><span class="btn-text">Započni kupovinu</span></span></a>
                </div>
              </div>
            </li>
            <!-- .mv-slider-item-->

            <li class="mv-slider-item"><img src="images/slideshow/slide3.jpg" alt="slide" class="mv-slider-img"/>
              <div class="mv-caption-style-1">
                <div class="container">
                  <div class="caption-1-text-1">NAŠA PRIČA</div>
                  <div class="caption-1-text-2">
                    <div class="mv-title-style-1"><img src="images/icon/icon_line_1.png" alt="icon" class="line-left"/><img src="images/icon/icon_line_2.png" alt="icon" class="line-right"/>ZIPTIE</div>
                  </div><a href="product-grid-3.php" class="caption-1-button-1 mv-btn mv-btn-style-1 responsive-btn-1-type-2"><span class="btn-inner"><i class="btn-icon fa fa-cart-plus"></i><span class="btn-text">Započni kupovinu</span></span></a>
                </div>
              </div>
            </li>
            <!-- .mv-slider-item-->
          </ul>

          <button id="home-1-slideshow-prev" type="button" class="mv-slider-control-btn prev mv-btn mv-btn-style-2"><span class="icon fa fa-angle-left"></span></button>
          <button id="home-1-slideshow-next" type="button" class="mv-slider-control-btn next mv-btn mv-btn-style-2"><span class="icon fa fa-angle-right"></span></button>
        </div>
      </section>
      <!-- .home-1-slideshow-->

      <section class="home-1-highlight mv-wrap">
        <div class="container">
          <div class="mv-block-style-1">
            <div class="row block-1-list">
              <article class="col-xs-6 col-sm-4 item post">
                <div class="item-inner mv-effect-translate-1">
                  <div class="content-thumb">
                    <div class="thumb-inner mv-effect-relative"><a href="product-grid-3.php?k=BMW&t=" title="bembara"><img src="images/kategorije/euro.png" alt="demo" class="mv-effect-item"/></a><a href="product-grid-3.php?k=BMW&t=" title="bembara" class="mv-btn mv-btn-style-25 btn-readmore-plus hidden-xs"><span class="btn-inner"></span></a>

                      <div class="content-message mv-message-style-1">
                        <div class="message-inner"></div>
                      </div>
                    </div>
                  </div>

                  <div class="content-main">
                    <div class="content-name hidden-xs hidden-sm">
                      <div class="name-inner mv-overflow-ellipsis">ZIPTIE</div>
                    </div>
                    <div class="content-text">
                      <div class="content-price">BMW</div>
                      <div class="content-desc"><a href="product-grid-3.php?k=BMW&t=" title="Bembara" class="mv-overflow-ellipsis">Za sve ljubitelje BMW vozila.</a></div>
                    </div>
                  </div>

                  <div class="content-hover">
                    <div class="content-button mv-btn-group text-center">
                      <div class="group-inner">
                        <!--    <button type="button" title="Add To Wishlist" class="mv-btn mv-btn-style-3 responsive-btn-3-type-1 btn-add-to-wishlist"><i class="fa fa-heart-o"></i></button>-->
                        <button type="button" title="BMW" class="mv-btn mv-btn-style-1 responsive-btn-1-type-1" ><a href="product-grid-3.php?k=BMW&t="><span class="btn-inner"><i class="btn-icon fa fa-cart-plus"></i><span class="btn-text" >Pogledaj sve modele</span></span></a></button>
                        <!--    <button type="button" title="Compare" class="mv-btn mv-btn-style-3 responsive-btn-3-type-1 btn-compare"><i class="fa fa-signal"></i></button>-->
                      </div>
                    </div>
                  </div>
                </div>
              </article>

              <article class="col-xs-6 col-sm-4 item post">
                <div class="item-inner mv-effect-translate-1">
                  <div class="content-thumb">
                    <div class="thumb-inner mv-effect-relative"><a href="product-grid-3.php?k=JDM&t=" title="r33"><img src="images/kategorije/jdm.png" alt="demo" class="mv-effect-item"/></a><a href="product-grid-3.php?k=JDM&t=" title="r33" class="mv-btn mv-btn-style-25 btn-readmore-plus hidden-xs"><span class="btn-inner"></span></a>

                      <div class="content-message mv-message-style-1">
                        <div class="message-inner"></div>
                      </div>
                    </div>
                  </div>

                  <div class="content-main">
                    <div class="content-name hidden-xs hidden-sm">
                      <div class="name-inner mv-overflow-ellipsis">ZIPTIE</div>
                    </div>
                    <div class="content-text">
                      <div class="content-price">JDM</div>
                      <div class="content-desc"><a href="product-grid-3.php?k=JDM&t=" title="GTR" class="mv-overflow-ellipsis">Realno, Japanci su najluđi.</a></div>
                    </div>
                  </div>

                  <div class="content-hover">
                    <div class="content-button mv-btn-group text-center">
                      <div class="group-inner">
                       <!--    <button type="button" title="Add To Wishlist" class="mv-btn mv-btn-style-3 responsive-btn-3-type-1 btn-add-to-wishlist"><i class="fa fa-heart-o"></i></button>-->
                       <button type="button" title="JDM" class="mv-btn mv-btn-style-1 responsive-btn-1-type-1" ><a href="product-grid-3.php?k=JDM&t="><span class="btn-inner"><i class="btn-icon fa fa-cart-plus"></i><span class="btn-text" >Pogledaj sve modele</span></span></a></button>
                       <!--    <button type="button" title="Compare" class="mv-btn mv-btn-style-3 responsive-btn-3-type-1 btn-compare"><i class="fa fa-signal"></i></button>-->
                      </div>
                    </div>
                  </div>
                </div>
              </article>

              <article class="col-xs-6 col-sm-4 item post">
                <div class="item-inner mv-effect-translate-1">
                  <div class="content-thumb">
                    <div class="thumb-inner mv-effect-relative"><a href="product-grid-3.php?k=ZIPTIE ORIGINALI&t=" title="felnica"><img src="images/kategorije/ziporg.png" alt="demo" class="mv-effect-item"/></a><a href="product-grid-3.php?k=ZIPTIE ORIGINALI&t=" title="felnica" class="mv-btn mv-btn-style-25 btn-readmore-plus hidden-xs"><span class="btn-inner"></span></a>

                      <div class="content-message mv-message-style-1">
                        <div class="message-inner"></div>
                      </div>
                    </div>
                  </div>

                  <div class="content-main">
                    <div class="content-name hidden-xs hidden-sm">
                      <div class="name-inner mv-overflow-ellipsis">ZIPTIE</div>
                    </div>
                    <div class="content-text">
                      <div class="content-price">ZIPTIE Originali</div>
                      <div class="content-desc"><a href="product-grid-3.php?k=ZIPTIE ORIGINALI&t=" title="ZIPTIE ORIGINALI BATO" class="mv-overflow-ellipsis">ZIPTIE gotivi sve što ima točkove.</a></div>
                    </div>
                  </div>

                  <div class="content-hover">
                    <div class="content-button mv-btn-group text-center">
                      <div class="group-inner">
                      <!--   <button type="button" title="Add To Wishlist" class="mv-btn mv-btn-style-3 responsive-btn-3-type-1 btn-add-to-wishlist"><i class="fa fa-heart-o"></i></button>-->
                      <button type="button" title="BMW" class="mv-btn mv-btn-style-1 responsive-btn-1-type-1" ><a href="product-grid-3.php?k=ZIPTIE ORIGINALI&t="><span class="btn-inner"><i class="btn-icon fa fa-cart-plus"></i><span class="btn-text" >Pogledaj sve modele</span></span></a></button>
                      <!--   <button type="button" title="Compare" class="mv-btn mv-btn-style-3 responsive-btn-3-type-1 btn-compare"><i class="fa fa-signal"></i></button>-->
                      </div>
                    </div>
                  </div>
                </div>
              </article>
            </div>
          </div>
          <!-- .mv-block-style-1-->
        </div>
      </section>
      <!-- .home-1-highlight-->

      <section class="home-1-featured-products mv-wrap">
        <div class="container">
          <div class="featured-title mv-title-style-2">
            <div class="title-2-inner"><img src="images/icon/icon_m.png" alt="icon" class="icon image-live-view"/><span class="main">Najaktivniji smo na Instagramu</span><span class="sub">Ukoliko želiš da budeš u toku sa svim aktuelnostima iz auto zajednice u regionu, najbolja ideja je da nas zapratiš na Instagramu. Između ostalog, čeka te i najzabavniji auto-moto sadržaj!</span></div>
          </div>
          <!-- .featured-title-->

          <!--<div class="featured-main mv-filter-style-1">
            <div class="filter-button mv-btn-group">
              <div class="group-inner">
                <button data-filter=".motor" class="mv-btn mv-btn-style-8 active">motor</button>
                <button data-filter=".helmet" class="mv-btn mv-btn-style-8">helmet</button>
                <button data-filter=".boots" class="mv-btn mv-btn-style-8">boots</button>
                <button data-filter=".protection" class="mv-btn mv-btn-style-8">protection</button>
                <button data-filter=".gear" class="mv-btn mv-btn-style-8">gear</button>
                <button data-filter=".tires" class="mv-btn mv-btn-style-8">tires</button>
              </div>
            </div>
             .filter-button-->

					<div id="instafeed-container" class="instagram" ></div>

							<script src="https://cdn.jsdelivr.net/gh/stevenschobert/instafeed.js@2.0.0rc1/src/instafeed.min.js"></script>
							<script type="text/javascript">
								var userFeed = new Instafeed({
								get: 'ziptie.rs',
								target: "instafeed-container",
								resolution: 'low_resolution',
								limit: 4,
								template: '<a href="{{link}}"><img title="{{caption}}" src="{{image}}" /><div class="slika-overlay"><div class="image_title">{{caption}}</div></div></a>',
								accessToken: 'IGQVJWNEFtUnV0aGdydjIyV1FTNE1ZAVG9jWERMUWJRczR2SjVDN29SNl90cktCVXpIRzVfczJESG5hQkhYbXJnTGNsMUhlbl9CcXRrSExVdlp6UWVVbVRvMmFFVlY2TjdGTkpRMERVTUh0b2gwRTR0OQZDZD'
								
								});
								userFeed.run();
								</script>
								
								
            
      </section>
      <!-- .home-1-featured-products-->




<section class="home-1-deals-last-week mv-wrap">
        <div data-image-src="images/background/bestseller_pozadina.png" class="deals-last-week-bg mv-parallax">
          <div class="container">
            <div class="deals-last-week-title mv-title-style-2 color-white">
              <div class="title-2-inner"><img src="images/icon/icon_m_2.png" alt="icon" class="icon image-live-view"/><span class="main">Najprodavaniji proizvodi</span><span class="sub">Svi ZIPTIE proizvodi su posebni i pažljivo izrađeni.  <br/>Međutim, neki proizvodi su popularniji od ostalih, pogledajte naše bestseller-e.</span></div>
            </div>
            <!-- .deals-last-week-title-->

            <div class="deals-last-week-main">
              <div class="deals-last-week-list">
                <div class="mv-block-style-2">
                  <div class="row block-2-list">

                  <?php
                  include 'baza_podataka.php';
                  $conn = OpenCon();
                  $conn->query("SET NAMES 'utf8'");

                  
                  $sql = "SELECT * FROM `proizvod` JOIN tip on proizvod.nazivTipa=tip.nazivTipa WHERE proizvodID=10001 OR proizvodID=20002 OR proizvodID=10004 OR proizvodID=20003";
                  $i=0;

                  $result = $conn->query($sql);
                  
                          if ($result->num_rows > 0) {
                              while($row = $result->fetch_assoc()) {
                                $i=$i+1;
                                $slike = explode(";", $row["slike"]);
                              echo '<article class="col-xs-6 col-md-3 item post item-bg-white">
                              <div class="item-inner mv-effect-translate-1">
                                <div class="content-default">
                                  <div class="content-thumb">
                                    <div class="thumb-inner mv-effect-relative"><a href="product-detail.php?b='.intval($row["proizvodID"]).'" title="'.$row["maliNaziv"].'"><img src="'.$slike[0].'" alt="'.$row["maliNaziv"].'" class="mv-effect-item"/></a><a href="product-detail.php?b='.intval($row["proizvodID"]).'" title="'.$row["maliNaziv"].'" class="mv-btn mv-btn-style-25 btn-readmore-plus hidden-xs"><span class="btn-inner"></span></a>
        
                                      <div class="content-message mv-message-style-1">
                                        <div class="message-inner"></div>
                                      </div>
                                    </div>
                                  </div>
        
                                  <div data-rate="true" data-score="5.0" class="content-rate mv-rate text-center">
                                    <div class="rate-inner mv-f-14 text-left">
                                      <div class="stars-wrapper empty-stars"><span class="item-rate"></span><span class="item-rate"></span><span class="item-rate"></span><span class="item-rate"></span><span class="item-rate"></span></div>
                                      <div class="stars-wrapper filled-stars"><span class="item-rate"></span><span class="item-rate"></span><span class="item-rate"></span><span class="item-rate"></span><span class="item-rate"></span></div>
                                    </div>
                                  </div>
                                </div>
        
                                <div class="content-main">
                                  <div class="content-text">
                                    <div class="content-price"><span class="new-price">'.$row["cena"].' RSD</span></div>
                                    <div class="content-desc"><a href="product-detail.php?b='.intval($row["proizvodID"]).'"  title="'.$row["Naziv"].'" class="mv-overflow-ellipsis">'.$row["Naziv"].'</a></div>
                                  </div>
                                </div>
        
                                <div class="content-hover">
                                  <div class="content-button mv-btn-group text-center">
                                    <div class="group-inner">
                                    <button type="button" title="'.$row["maliNaziv"].'" class="mv-btn mv-btn-style-1 responsive-btn-1-type-1" ><a href="product-detail.php?b='.intval($row["proizvodID"]).'"><span class="btn-inner"><i class="btn-icon fa fa-cart-plus"></i><span class="btn-text" >Detalji</span></span></a></button>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </article>';
                              
                        
                            }
                          } 
                      
                                $conn->close();
      


                  ?>

                   
                    <!-- .post-->
                  </div>
                </div>
                <!-- .mv-block-style-2-->
              </div>
            </div>
            <!-- .deals-last-week-main-->
          </div>
        </div>
      </section>
      <!-- .home-1-deals-last-week-->







      <section class="home-1-shop hidden-xs hidden-sm mv-wrap">
        <div class="container">
          <div class="block-list-1">
             <div class="mv-block-style-3">
               <!--<a href="#" class="mv-btn mv-btn-style-1 btn-1-h-40 btn-1-gray responsive-btn-1-type-2 btn-shop-now hidden-xs hidden-sm"><span class="btn-inner"><i class="btn-icon fa fa-cart-plus"></i><span class="btn-text">Saznaj više</span></span></a> -->
              <div class="block-3-list">
                <div class="item">
                  <div class="block-3-title">
                    <div class="main"><a  title="Detalji">Detalji</a></div>
                    <div class="sub">Puno truda je uloženo u svaki ZIPTIE komad garderobe. Brinemo o našoj garderobi kao što brinemo o našim automobilima.</div>
                  </div>
                  <div class="block-3-thumb"><a title="Majica pozadi"><img src="images/demo/pozadi.png" alt="Majica pozadi" class="block-3-thumb-img"/></a></div>
                </div>

                <div class="item">
                  <div class="block-3-thumb"><a  title="Etiketa"><img src="images/demo/etiketa.png" alt="demo" class="block-3-thumb-img hidden-xs hidden-sm"/></a></div>
                  <div class="block-3-title">
                    <div class="main"><a  title="Etiketa">Kvalitet</a></div>
                    <div class="sub">Naša garderoba je izrađena od najfinijeg pamuka a digitalna štampa se pobrinula za dugotrajan kvlatitet motiva na garderobi.</div>
                  </div>
                  <div class="block-3-thumb"><a href="#" title="Alpinestars Bionic Plus"><img src="images/demo/demo_300x400.png" alt="demo" class="block-3-thumb-img hidden-md hidden-lg"/></a></div>
                </div>
              </div>
            </div>
            <!-- .mv-block-style-3-->
          </div>
        </div>
      </section>
      <!-- .home-1-shop-->

     

      

    

      <footer class="footer mv-footer-style-2 mv-wrap">
        <div style="background-image: url(images/background/pozadinafuter.png)" class="footer-bg">
          <div class="container">
            <div class="footer-inner">
              <div id="footerNav" role="tablist" aria-multiselectable="true" class="footer-nav panel-group">
                <div class="row">
                  <div class="col-md-3 footer-nav-col footer-contact" "><a data-toggle="collapse" data-parent="#footerNav" href="#footerContact" aria-expanded="true" aria-controls="footerContact" class="footer-title collapsed">KONTAKT</a>
                    <div id="footerContact" role="tabpanel" class="footer-main collapse">
                      <ul class="mv-ul footer-main-inner list" >
                            <!--  <li class="mv-icon-left-style-1 item">style="float: left; left: 25%;"
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

                  <div class="col-md-3 footer-nav-col footer-about-us"><a data-toggle="collapse" data-parent="#footerNav" href="#footerAboutUs" aria-expanded="false" aria-controls="footerAboutUs" class="footer-title collapsed">O NAMA</a>
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

              <div class="footer-copyright text-center">Copyright &copy; 2022 <a href="/adminlogin.php">ZIPTIE</a> Sva prava zadržana.</div>
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

    <!-- Theme Script-->
    <script type="text/javascript" src="js/main.js"></script>
  </body>
</html>