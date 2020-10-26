<?php debug_backtrace() || die ('Direct access not permitted'); ?>
<!DOCTYPE html>
<html lang="<?php echo LANG_TAG; ?>">
<head>
    <meta charset="UTF-8">

    <title><?php echo $title_tag; ?></title>

    <?php
    if(isset($article)) $meta_descr = strtrunc(strip_tags($article['text']), 155);
    elseif($page['descr'] != "") $meta_descr = $page['descr'];
    else $meta_descr = strtrunc(strip_tags($page['text']), 155); ?>

    <meta name="description" content="<?php echo $meta_descr; ?>">
    
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="<?php echo $title_tag; ?>">
    <meta itemprop="description" content="<?php echo $meta_descr; ?>">
    <?php
    if(isset($page_img)){ ?>
        <meta itemprop="image" content="<?php echo $page_img; ?>">
        <?php
    } ?>
    
    <!-- Open Graph data -->
    <meta property="og:title" content="<?php echo $title_tag; ?>">
    <meta property="og:type" content="article">
    <meta property="og:url" content="<?php echo getUrl(); ?>">
    <?php
    if(isset($page_img)){ ?>
        <meta property="og:image" content="<?php echo $page_img; ?>">
        <?php
    } ?>
    <meta property="og:description" content="<?php echo $meta_descr; ?>">
    <meta property="og:site_name" content="<?php echo SITE_TITLE; ?>">
    <?php
    if(isset($publish_date) && isset($edit_date)){ ?>
        <meta property="article:published_time" content="<?php echo date('c', $publish_date); ?>">
        <meta property="article:modified_time" content="<?php echo date('c', $edit_date); ?>">
        <?php
    } ?>
    <?php
    if($article_id > 0){ ?>
        <meta property="article:section" content="<?php echo $page['title']; ?>">
        <?php
    } ?>
    <?php
    if(isset($article_tags) && $article_tags != ''){ ?>
        <meta property="article:tag" content="<?php echo $article_tags; ?>">
        <?php
    } ?>
    <meta property="article:author" content="<?php echo OWNER; ?>">

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@publisher_handle">
    <meta name="twitter:title" content="<?php echo $title_tag; ?>">
    <meta name="twitter:description" content="<?php echo $meta_descr; ?>">
    <meta name="twitter:creator" content="@author_handle">
    <?php
    if(isset($page_img)){ ?>
        <meta name="twitter:image:src" content="<?php echo $page_img; ?>">
        <?php
    } ?>
    
    <meta name="robots" content="<?php if($page['robots'] != "") echo $page['robots']; else echo 'index, follow'; ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <?php
    if(AUTOGEOLOCATE){ ?>
        <meta name="autogeolocate" content="true">
        <?php
    }
    if(GMAPS_API_KEY != ''){ ?>
        <meta name="gmaps_api_key" content="<?php echo GMAPS_API_KEY; ?>">
        <?php
    } ?>
    
    <link rel="icon" type="image/png" href="<?php echo getFromTemplate('images/favicon.png'); ?>">
    <script type="text/javascript">
      function konumuGetir() {
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(konumuGoster);
        } else {
          document.write("Tarayıcınız Geolocation API desteklemiyor.");
        }
      }
      
    
      function konumuGoster(konum) {
          var lat1=konum.coords.latitude;
          var lon1=konum.coords.longitude;
          document.cookie = "lat1="+lat1; 
          document.cookie = "lon1="+lon1; 
      }
      konumuGetir();
</script>
    
    <link rel="stylesheet" href="<?php echo DOCBASE; ?>common/bootstrap/css/bootstrap.min.css">
    <?php
    if(RTL_DIR){ ?>
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-rtl/3.2.0-rc2/css/bootstrap-rtl.min.css">
        <?php
    } ?>
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Open+Sans:300,400,700">
    
    <?php
    //CSS required by the current model
    if(isset($stylesheets)){
        foreach($stylesheets as $stylesheet){ ?>
            <link rel="stylesheet" href="<?php echo $stylesheet['file']; ?>" media="<?php echo $stylesheet['media']; ?>">
            <?php
        }
    } ?>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.min.css">

    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/ui-lightness/jquery-ui.css">
   

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.0/css/all.css" integrity="sha384-REHJTs1r2ErKBuJB0fCK99gCYsVjwxHrSU0N7I1zl9vZbggVJXRMsv/sLlOAGb4M" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo DOCBASE; ?>common/css/shortcodes.css">
    <link rel="stylesheet" href="<?php echo getFromTemplate('css/layout.css'); ?>">
    <link rel="stylesheet" href="<?php echo getFromTemplate('css/colors.css'); ?>" id="colors">
    <link rel="stylesheet" href="<?php echo getFromTemplate('css/main.css'); ?>">
    <link rel="stylesheet" href="<?php echo getFromTemplate('css/custom.css'); ?>">
    
    <script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script> 

    <link rel="stylesheet" href="<?php echo getFromTemplate('css/extracss/cs-style.css');?>">
    <link rel="stylesheet" href="<?php echo getFromTemplate('css/extracss/style.css'); ?>">
    <link rel="stylesheet" href="<?php echo getFromTemplate('css/extracss/color.css'); ?>" id="colors">
    <link rel="stylesheet" href="<?php echo getFromTemplate('css/extracss/plugins.css'); ?>">
    <link rel="stylesheet" href="<?php echo getFromTemplate('css/extracss/reset.css'); ?>">
    <link rel="stylesheet" href="<?php echo getFromTemplate('css/extracss/invoice.css'); ?>">

    <script src="/templates/default/js/scripts.js"></script>
    <script src="/templates/default/js/charts.js"></script>
    <script src="/templates/default/js/dashboard.js"></script>
    <script src="/templates/default/js/jquery.min.js"></script>
    <script src="/templates/default/js/map-add.js"></script>
    <script src="/templates/default/js/map-single.js"></script>
    <script src="/templates/default/js/mapplugins.js"></script>
    <script src="/templates/default/js/maps.js"></script>
    <script src="/templates/default/js/plugins.js"></script>  



    <?php
    if(ANALYTICS_CODE != '' && mb_strstr(ANALYTICS_CODE, '<script') === false)
        echo '<script>'.stripslashes(ANALYTICS_CODE).'</script>';
    else
        echo stripslashes(ANALYTICS_CODE); ?>
</head>
<body id="page-<?php echo $page_id; ?>" itemscope itemtype="http://schema.org/WebPage"<?php if(RTL_DIR) echo ' dir="rtl"'; ?>>

<!-- Schema.org markup for Google+ -->
<meta itemprop="name" content="<?php echo htmlentities($title_tag, ENT_QUOTES); ?>">
<meta itemprop="description" content="<?php echo htmlentities($meta_descr, ENT_QUOTES); ?>">
<?php
if(isset($page_img)){ ?>
    <meta itemprop="image" content="<?php echo $page_img; ?>">
    <?php
} ?>

<div id="loader-wrapper"><div id="loader"></div></div>

<?php
if(ENABLE_COOKIES_NOTICE == 1 && !isset($_COOKIE['cookies_enabled'])){ ?>
    <div id="cookies-notice">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <?php echo $texts['COOKIES_NOTICE']; ?>
                    <button class="btn btn-success btn-xs">OK</button>
                </div>
            </div>
        </div>
    </div>
    <?php
} ?>
<header class="main-header">
                <!-- header-top-->
                <div class="header-top fl-wrap">
                    <div class="container">
                        <div class="logo-holder">
                            <a href="index.html"><img src="images/logo.png" alt=""></a>
                        </div>
                        <a href="dashboard-add-listing.html" class="add-hotel">Add Your Hotel <span><i class="far fa-plus"></i></span></a>                     
                        <div class="show-reg-form modal-open"><i class="fa fa-sign-in"></i>Sign In</div>
                        <div class="lang-wrap">
                            <div class="show-lang"><img src="images/lan/1.png" alt=""> <span>Eng</span><i class="fa fa-caret-down"></i></div>
                            <ul class="lang-tooltip green-bg">
                                <li><a href="#"><img src="images/lan/4.png" alt=""> De</a></li>
                                <li><a href="#"><img src="images/lan/5.png" alt=""> It</a></li>
                                <li><a href="#"><img src="images/lan/2.png" alt=""> Fr</a></li>
                                <li><a href="#"><img src="images/lan/3.png" alt=""> Es</a></li>
                            </ul>
                        </div>
                        <div class="currency-wrap">
                            <div class="show-currency-tooltip"><i class="fas fa-dollar-sign"></i> <span>USD <i class="fa fa-caret-down"></i> </span></div>
                            <ul class="currency-tooltip">
                                <li><a href="#"><i class="far fa-euro-sign"></i> EUR</a></li>
                                <li><a href="#"><i class="far fa-pound-sign"></i> GBP</a></li>
                                <li><a href="#"><i class="far fa-ruble-sign"></i>RUR</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- header-top end-->
                <!-- header-inner-->
                <div class="header-inner fl-wrap">
                    <div class="container">
                        <div class="show-search-button"><span>Search</span> <i class="fas fa-search"></i> </div>
                        <div class="wishlist-link"><i class="fal fa-heart"></i><span class="wl_counter">3</span></div>
                        <div class="header-user-menu">
                            <div class="header-user-name">
                                <span><img src="images/avatar/1.jpg" alt=""></span>
                                My account
                            </div>
                            <ul>
                                <li><a href="dashboard-myprofile.html"> Edit profile</a></li>
                                <li><a href="dashboard-add-listing.html"> Add Listing</a></li>
                                <li><a href="dashboard-bookings.html">  Bookings  </a></li>
                                <li><a href="dashboard-review.html"> Reviews </a></li>
                                <li><a href="#">Log Out</a></li>
                            </ul>
                        </div>
                        <div class="home-btn"><a href="index.html"><i class="fas fa-home"></i></a></div>
                        <!-- nav-button-wrap-->
                        <div class="nav-button-wrap color-bg">
                            <div class="nav-button">
                                <span></span><span></span><span></span>
                            </div>
                        </div>
                        <!-- nav-button-wrap end-->
                        <!--  navigation -->
                        <div class="nav-holder main-menu">
                            <nav>
                                <ul>
                                    <li>
                                        <a href="#">Home <i class="fas fa-caret-down"></i></a>
                                        <!--second level -->
                                        <ul>
                                            <li><a href="index.html">Parallax Image</a></li>
                                            <li><a href="index2.html">Slider</a></li>
                                            <li><a href="index3.html">Video</a></li>
                                            <li><a href="index4.html">Slideshow</a></li>
                                        </ul>
                                        <!--second level end-->
                                    </li>
                                    <li>
                                        <a href="#">Listings <i class="fas fa-caret-down"></i></a>
                                        <!--second level -->
                                        <ul>
                                            <li><a href="listing.html">Column map</a></li>
                                            <li><a href="listing6.html">Column map 2</a></li>
                                            <li><a href="listing2.html">Fullwidth Map</a></li>
                                            <li><a href="listing3.html">Fullwidth Map 2</a></li>
                                            <li><a href="listing4.html">Without Map</a></li>
                                            <li><a href="listing5.html">Without Map 2</a></li>
                                            <li>
                                                <a href="#">Single <i class="fas fa-caret-down"></i></a>
                                                <!--third  level  -->
                                                <ul>
                                                    <li><a href="listing-single.html">Style 1</a></li>
                                                    <li><a href="listing-single2.html">Style 2</a></li>
                                                    <li><a href="listing-single3.html">Style 3</a></li>
                                                    <li><a href="listing-single4.html">Style 4</a></li>
                                                </ul>
                                                <!--third  level end-->
                                            </li>
                                        </ul>
                                        <!--second level end-->
                                    </li>
                                    <li>
                                        <a href="blog.html">News</a>
                                    </li>
                                    <li>
                                        <a href="#" class="act-link">Pages <i class="fas fa-caret-down"></i></a>
                                        <!--second level -->
                                        <ul>
                                            <li><a href="about.html">About</a></li>
                                            <li><a href="contacts.html">Contacts</a></li>
                                            <li><a href="author-single.html">User single</a></li>
                                            <li><a href="help.html">Help FAQ</a></li>
                                            <li><a href="pricing-tables.html">Pricing</a></li>
                                            <li><a href="booking-single.html">Booking</a></li>
                                            <li><a href="dashboard.html">User Dashboard</a></li>
                                            <li><a href="blog2.html">Blog Classik</a></li>
                                            <li><a href="blog-single.html">Blog Single</a></li>
                                            <li><a href="dashboard-add-listing.html">Add Listing</a></li>
                                            <li><a href="404.html">404</a></li>
                                            <li><a href="invoice.html">Invoice</a></li>
                                            <li><a href="coming-soon.html">Coming Soon</a></li>
                                        </ul>
                                        <!--second level end-->
                                    </li>
                                </ul>
                            </nav>
                        </div>
                        <!-- navigation  end -->
                        <!-- wishlist-wrap-->            
                        <div class="wishlist-wrap scrollbar-inner novis_wishlist">
                            <div class="box-widget-content">
                                <div class="widget-posts fl-wrap">
                                    <ul>
                                        <li class="clearfix">
                                            <a href="#"  class="widget-posts-img"><img src="images/gal/1.jpg" class="respimg" alt=""></a>
                                            <div class="widget-posts-descr">
                                                <a href="#" title="">Park Central</a>
                                                <div class="listing-rating card-popup-rainingvis" data-starrating2="5"></div>
                                                <div class="geodir-category-location fl-wrap"><a href="#"><i class="fas fa-map-marker-alt"></i> 40 JOURNAL SQUARE PLAZA, NJ, US</a></div>
                                                <span class="rooms-price">$80 <strong> /  Awg</strong></span>
                                            </div>
                                        </li>
                                        <li class="clearfix">
                                            <a href="#"  class="widget-posts-img"><img src="images/gal/1.jpg" class="respimg" alt=""></a>
                                            <div class="widget-posts-descr">
                                                <a href="#" title="">Holiday Home</a>
                                                <div class="listing-rating card-popup-rainingvis" data-starrating2="3"></div>
                                                <div class="geodir-category-location fl-wrap"><a href="#"><i class="fas fa-map-marker-alt"></i> 75 PRINCE ST, NY, USA</a></div>
                                                <span class="rooms-price">$50 <strong> /   Awg</strong></span>
                                            </div>
                                        </li>
                                        <li class="clearfix">
                                            <a href="#"  class="widget-posts-img"><img src="images/gal/1.jpg" class="respimg" alt=""></a>
                                            <div class="widget-posts-descr">
                                                <a href="#" title="">Moonlight Hotel</a>
                                                <div class="listing-rating card-popup-rainingvis" data-starrating2="4"></div>
                                                <div class="geodir-category-location fl-wrap"><a href="#"><i class="fas fa-map-marker-alt"></i>  70 BRIGHT ST NEW YORK, USA</a></div>
                                                <span class="rooms-price">$105 <strong> /  Awg</strong></span>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- wishlist-wrap end--> 
                    </div>
                </div>
                <!-- header-inner end-->
                <!-- header-search -->
                <div class="header-search vis-search">
                    <div class="container">
                        <div class="row">
                            <!-- header-search-input-item -->
                            <div class="col-sm-4">
                                <div class="header-search-input-item fl-wrap location autocomplete-container">
                                    <label>Destination or Hotel Name</label>
                                    <span class="header-search-input-item-icon"><i class="fal fa-map-marker-alt"></i></span>
                                    <input type="text" placeholder="Location" class="autocomplete-input" id="autocompleteid" value=""/>
                                    <a href="#"><i class="fal fa-dot-circle"></i></a>
                                </div>
                            </div>
                            <!-- header-search-input-item end -->
                            <!-- header-search-input-item -->
                            <div class="col-sm-3">
                                <div class="header-search-input-item fl-wrap date-parent">
                                    <label>Date In-Out </label>
                                    <span class="header-search-input-item-icon"><i class="fal fa-calendar-check"></i></span>
                                    <input type="text" placeholder="When" name="header-search"   value=""/>
                                </div>
                            </div>
                            <!-- header-search-input-item end -->                             
                            <!-- header-search-input-item -->
                            <div class="col-sm-3">
                                <div class="header-search-input-item fl-wrap">
                                    <div class="quantity-item">
                                        <label>Rooms</label>
                                        <div class="quantity">
                                            <input type="number" min="1" max="3" step="1" value="1">
                                        </div>
                                    </div>
                                    <div class="quantity-item">
                                        <label>Adults</label>
                                        <div class="quantity">
                                            <input type="number" min="1" max="3" step="1" value="1">
                                        </div>
                                    </div>
                                    <div class="quantity-item">
                                        <label>Children</label>
                                        <div class="quantity">
                                            <input type="number" min="0" max="3" step="1" value="0">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- header-search-input-item end -->                             
                            <!-- header-search-input-item -->
                            <div class="col-sm-2">
                                <div class="header-search-input-item fl-wrap">
                                    <button class="header-search-button" onclick="window.location.href='listing.html'">Search <i class="far fa-search"></i></button>
                                </div>
                            </div>
                            <!-- header-search-input-item end -->                                                          
                        </div>
                    </div>
                    <div class="close-header-search"><i class="fal fa-angle-double-up"></i></div>
                </div>
                <!-- header-search  end -->
            </header>





<header class="main-header">


    <div id="mainHeader">
        <div class="container-fluid">
			<div id="secondMenu">
                <ul class="nav navbar-nav">
                    <li class="primary btn-nav">
                        <?php
                        if(isset($_SESSION['user'])){ ?>
                            <form method="post" action="<?php echo DOCBASE.$page['alias']; ?>" class="ajax-form">
                                <div class="dropdown">
                                    <a class="firstLevel dropdown-toggle" data-toggle="dropdown" href="#">
                                        <i class="fas fa-fw fa-user"></i>
                                        <span class="hidden-sm hidden-md">
                                            <?php
                                            if($_SESSION['user']['login'] != '') echo $_SESSION['user']['login'];
                                            else echo $_SESSION['user']['email']; ?>
                                        </span>
                                        <span class="fas fa-fw fa-caret-down"></span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-right" role="menu" id="user-menu">
                                        <?php
                                        if($_SESSION['user']['type'] == 'registered'){ ?>
                                            <li><a href="<?php echo DOCBASE.$sys_pages['account']['alias']; ?>"><i class="fas fa-fw fa-user"></i> <?php echo $sys_pages['account']['name']; ?></a></li>
                                            <?php
                                        } ?>
                                        <li><a href="#" class="sendAjaxForm" data-action="<?php echo DOCBASE; ?>templates/<?php echo TEMPLATE; ?>/common/register/logout.php" data-refresh="true"><i class="fas fa-fw fa-power-off"></i> <?php echo $texts['LOG_OUT']; ?></a></li>
                                    </ul>
                                </div>
                            </form>
                            <?php
                        }else{ ?>
                            <a class="popup-modal firstLevel" href="#user-popup">
                                <i class="fas fa-fw fa-power-off"></i>
                            </a>
                            <?php
                        } ?>
                    </li>
                    <?php
                    if(LANG_ENABLED){
                        if(count($langs) > 0){ ?>
                            <li class="primary btn-nav">
                                <div class="dropdown">
                                    <a class="firstLevel dropdown-toggle" data-toggle="dropdown" href="#">
                                        <img src="<?php echo $langs[LANG_TAG]['file']; ?>" alt="<?php echo $langs[LANG_TAG]['title']; ?>"><span class="hidden-sm hidden-md"> <?php echo $langs[LANG_TAG]['title']; ?></span> <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                        <?php
                                        foreach($langs as $row){
                                            $title_lang = $row['title']; ?>
                                            <li>
                                                <a href="<?php echo DOCBASE.$row['tag']; ?>">
                                                    <img src="<?php echo $row['file']; ?>" alt="<?php echo $title_lang; ?>"> <?php echo $title_lang; ?>
                                                </a>
                                            </li>
                                            <?php
                                        } ?>
                                    </ul>
                                </div>
                            </li>
                            <?php
                        }
                    }
                    if(CURRENCY_ENABLED){
                        if(count($currencies) > 0){ ?>
                            <li class="primary btn-nav">
                                <div class="dropdown">
                                    <a class="firstLevel dropdown-toggle" data-toggle="dropdown" href="#">
                                        <span><?php echo CURRENCY_CODE; ?></span><span class="hidden-sm hidden-md"> <?php echo CURRENCY_SIGN; ?></span> <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                        <?php
                                        foreach($currencies as $row){ ?>
                                            <li>
                                                <a href="<?php echo getUrl(); ?>" data-action="<?php echo DOCBASE.'includes/change_currency.php'; ?>?curr=<?php echo $row['id']; ?>" class="ajax-link<?php if(!isset($_SESSION['currency']['code'])) echo ' currency-'.$row['code']; ?>">
                                                    <?php echo $row['code'].' '.$row['sign']; ?>
                                                </a>
                                            </li>
                                            <?php
                                        } ?>
                                    </ul>
                                </div>
                            </li>
                            <?php
                        }
                    } ?>
                    <li class="primary btn-nav">
                        <div class="dropdown">
                            <a class="firstLevel dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="fas fa-fw fa-search"></i> <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                <li>
                                    <?php $csrf_token = get_token('search'); ?>

                                    <form method="post" action="<?php echo DOCBASE.$sys_pages['search']['alias']; ?>" class="form-inline">
                                        <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
                                        <div class="input-group searchWrapper">
                                            <input type="text" class="form-control" name="global-search" placeholder="<?php echo $texts['SEARCH']; ?>">
                                            <span class="input-group-btn">
                                                <button type="submit" class="btn btn-primary" name="send"><i class="fas fa-fw fa-search"></i></button>
                                            </span>
                                        </div>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
                <div id="user-popup" class="white-popup-block mfp-hide">
                    <div class="fluid-container">
                        <!--<div class="row">
                            <div class="col-xs-12 mb20 text-center">
                                <a class="btn fblogin" href="#"><i class="fas fa-fw fa-facebook"></i> <?php echo $texts['LOG_IN_WITH_FACEBOOK']; ?></a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 mb20 text-center">
                                - <?php echo $texts['OR']; ?> -
                            </div>
                        </div>-->
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="login-form">
                                    <form method="post" action="<?php echo DOCBASE.$page['alias']; ?>" class="ajax-form">
                                        <div class="alert alert-success" style="display:none;"></div>
                                        <div class="alert alert-danger" style="display:none;"></div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fas fa-fw fa-user"></i></div>
                                                <input type="text" class="form-control" name="user" value="" placeholder="<?php echo $texts['USERNAME'].' '.strtolower($texts['OR']).' '.$texts['EMAIL']; ?> *">
                                            </div>
                                            <div class="field-notice" rel="user"></div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fas fa-fw fa-lock"></i></div>
                                                <input type="password" class="form-control" name="pass" value="" placeholder="<?php echo $texts['PASSWORD']; ?> *">
                                            </div>
                                            <div class="field-notice" rel="pass"></div>
                                        </div>
                                        <div class="row mb10">
                                            <div class="col-sm-7 text-left">
                                                <a class="open-pass-form" href="#"><?php echo $texts['FORGOTTEN_PASSWORD']; ?></a><br>
                                                <a class="open-signup-form" href="#"><?php echo $texts['I_SIGN_UP']; ?></a>
                                            </div>
                                            <div class="col-sm-5 text-right">
                                                <a href="#" class="btn btn-default sendAjaxForm" data-action="<?php echo getFromTemplate('common/register/login.php'); ?>" data-refresh="true"><i class="fas fa-fw fa-power-off"></i> <?php echo $texts['LOG_IN']; ?></a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="signup-form">
                                    <form method="post" action="<?php echo DOCBASE.$page['alias']; ?>" class="ajax-form">
                                        <div class="alert alert-success" style="display:none;"></div>
                                        <div class="alert alert-danger" style="display:none;"></div>
                                        <input type="hidden" name="signup_type" value="quick" class="noreset">
                                        <input type="hidden" name="signup_redirect" value="<?php echo getUrl(true).DOCBASE.$sys_pages['account']['alias']; ?>" class="noreset">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fas fa-fw fa-user"></i></div>
                                                <input type="text" class="form-control" name="username" value="" placeholder="<?php echo $texts['USERNAME']; ?> *">
                                            </div>
                                            <div class="field-notice" rel="username"></div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fas fa-fw fa-envelope"></i></div>
                                                <input type="text" class="form-control" name="email" value="" placeholder="<?php echo $texts['EMAIL']; ?> *">
                                            </div>
                                            <div class="field-notice" rel="email"></div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fas fa-fw fa-lock"></i></div>
                                                <input type="password" class="form-control" name="password" value="" placeholder="<?php echo $texts['PASSWORD']; ?> *">
                                            </div>
                                            <div class="field-notice" rel="password"></div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fas fa-fw fa-lock"></i></div>
                                                <input type="password" class="form-control" name="password_confirm" value="" placeholder="<?php echo $texts['PASSWORD_CONFIRM']; ?> *">
                                            </div>
                                            <div class="field-notice" rel="password_confirm"></div>
                                        </div>
                                        <div class="form-group">
                                            <input type="radio" name="hotel_owner" id="hotel_owner_1" value="1"> <label for="hotel_owner_1"><?php echo $texts['I_AM_HOTEL_OWNER']; ?></label> &nbsp;
                                            <input type="radio" name="hotel_owner" id="hotel_owner_0" value="0"> <label for="hotel_owner_0"><?php echo $texts['I_AM_TRAVELER']; ?></label>
                                        </div>
                                        <div class="row mb10">
                                            <div class="col-sm-7 text-left">
                                                <a class="open-login-form" href="#"><?php echo $texts['ALREADY_HAVE_ACCOUNT']; ?></a>
                                            </div>
                                            <div class="col-sm-5 text-right">
                                                <a href="#" class="btn btn-default sendAjaxForm" data-action="<?php echo getFromTemplate('common/register/signup.php'); ?>" data-clear="true"><i class="fas fa-fw fa-power-off"></i> <?php echo $texts['SIGN_UP']; ?></a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="pass-form">
                                    <form method="post" action="<?php echo DOCBASE.$page['alias']; ?>" class="ajax-form">
                                        <div class="alert alert-success" style="display:none;"></div>
                                        <div class="alert alert-danger" style="display:none;"></div>
                                        <p><?php echo $texts['NEW_PASSWORD_NOTICE']; ?></p>
                                            
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fas fa-fw fa-envelope"></i></div>
                                                <input type="text" class="form-control" name="email" value="" placeholder="<?php echo $texts['EMAIL']; ?> *">
                                            </div>
                                            <div class="field-notice" rel="email"></div>
                                        </div>
                                        <div class="row mb10">
                                            <div class="col-sm-7 text-left">
                                                <a class="open-login-form" href="#"><?php echo $texts['LOG_IN']; ?></a><br>
                                                <a class="open-signup-form" href="#"><?php echo $texts['I_SIGN_UP']; ?></a>
                                            </div>
                                            <div class="col-sm-5 text-right">
                                                <a href="#" class="btn btn-default sendAjaxForm" data-action="<?php echo getFromTemplate('common/register/reset.php'); ?>" data-refresh="false"><i class="fas fa-fw fa-power-off"></i> <?php echo $texts['NEW_PASSWORD']; ?></a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="mainMenu" class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <?php
                    function subMenu($id_parent, $menu)
                    { ?>
                        <span class="dropdown-btn visible-xs"></span>
                        <ul class="subMenu">
                            <?php
                            foreach($menu as $nav_id => $nav){
                                if($nav['id_parent'] == $id_parent){ ?>
                                    <li>
                                        <?php
                                        $hasChildNav = has_child_nav($nav_id, $menu); ?>
                                        <a class="<?php if($hasChildNav) echo 'hasSubMenu'; ?>" href="<?php echo $nav['href']; ?>" target="<?php echo $nav['target']; ?>" title="<?php echo $nav['title']; ?>"><?php echo $nav['name']; ?></a>
                                        <?php if($hasChildNav) subMenu($nav_id, $menu); ?>
                                    </li>
                                    <?php
                                }
                            } ?>
                        </ul>
                        <?php
                    }
                    
                    $top_nav_id = get_top_nav_id($menus['main']);
                    foreach($menus['main'] as $nav_id => $nav){
                        if(empty($nav['id_parent']) || @$menus['main'][$nav['id_parent']]['id_item'] == $homepage['id']){ ?>
                            <li class="primary nav-<?php echo $nav_id; ?>">
                                <?php
                                if($nav['item_type'] == 'page' && $pages[$nav['id_item']]['home'] == 1){ ?>
                                    <a class="firstLevel<?php if($ishome) echo ' active'; ?>" href="<?php echo DOCBASE.trim(LANG_ALIAS, '/'); ?>" title="<?php echo $nav['title']; ?>"><?php echo $nav['name']; ?></a>
                                    <?php
                                }else{
                                    $hasChildNav = has_child_nav($nav_id, $menus['main']); ?>
                                    <a class="dropdown-toggle disabled firstLevel<?php if($hasChildNav) echo ' hasSubMenu'; if($top_nav_id == $nav_id) echo ' active'; ?>" href="<?php echo $nav['href']; ?>" target="<?php echo $nav['target']; ?>" title="<?php echo $nav['title']; ?>">
                                        <?php
                                        echo $nav['name'];
                                        if($hasChildNav){ ?>
                                            <i class="fa fa-fw fa-angle-down hidden-xs"></i>
                                            <?php
                                        } ?>
                                    </a>
                                    <?php if($hasChildNav) subMenu($nav_id, $menus['main']);
                                } ?>
                            </li>
                            <?php
                        }
                    } ?>
                </ul>
            </div>
            <div class="navbar navbar-default">
                <div class="navbar-header">
                    <a class="navbar-brand" href="<?php echo DOCBASE.trim(LANG_ALIAS, '/'); ?>" title="<?php echo $homepage['title']; ?>"><img src="<?php echo getFromTemplate('images/logo.png'); ?>" alt="<?php echo SITE_TITLE; ?>"></a>
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</header>-->
