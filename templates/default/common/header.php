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

<script>
        $(function(){

            var $search = $('#autocompleteid5');

            $search.autocomplete({
                source: '/templates/default/common/api.php',
                /*focus: function(event, ui){
                    $search.val(ui.item.title);
                },*/
                select: function(event, ui){
                    window.location.href = '/tr/kurs-merkezleri/' + ui.item.alias;
                }
            });

            $search.data('ui-autocomplete')._renderItem = function( ul, item ){

                var $li = $('<li>');

                $li.html('<a href="#">' +
                '<span class="icon"><i class="fal fa-school"></i></span>' +      
                '<span class="state">' + item.city+ ' - </span>' + 
                '<span class="username">' + item.value + '</span>'+
                       
                        '</a>');

                return $li.appendTo(ul);

            };

        });
    </script>
    
    <!-- <link rel="stylesheet" href="<?php echo DOCBASE; ?>common/bootstrap/css/bootstrap.min.css"> -->
    <!-- <?php
    if(RTL_DIR){ ?>
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-rtl/3.2.0-rc2/css/bootstrap-rtl.min.css">
        <?php
    } ?>
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Open+Sans:300,400,700"> -->
    
    <?php
    //CSS required by the current model
    if(isset($stylesheets)){
        foreach($stylesheets as $stylesheet){ ?>
            <link rel="stylesheet" href="<?php echo $stylesheet['file']; ?>" media="<?php echo $stylesheet['media']; ?>">
            <?php
        }
    } ?>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.min.css">

   

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.0/css/all.css" integrity="sha384-REHJTs1r2ErKBuJB0fCK99gCYsVjwxHrSU0N7I1zl9vZbggVJXRMsv/sLlOAGb4M" crossorigin="anonymous">
    
    <script type="text/javascript" src="http://code.jquery.com/ui/1.10.1/jquery-ui.min.js"></script>

    <script src="http://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>    

     <link rel="stylesheet" href="<?php echo getFromTemplate('css/extracss/style.css'); ?>">
     <link rel="stylesheet" href="<?php echo getFromTemplate('css/extracss/cs-style.css');?>">
   
    <link rel="stylesheet" href="<?php echo getFromTemplate('css/extracss/color.css'); ?>">
    <link rel="stylesheet" href="<?php echo getFromTemplate('css/extracss/plugins.css'); ?>">
    <link rel="stylesheet" href="<?php echo getFromTemplate('css/extracss/reset.css'); ?>">
    <link rel="stylesheet" href="<?php echo getFromTemplate('css/extracss/invoice.css'); ?>">
    <link rel="stylesheet" href="/js/plugins/no-ui-slider/mouislider.css">
    <link rel="stylesheet" href="/js/plugins/no-ui-slider/nouislider.min.css">



    

    
    <script type="text/javascript" src="/templates/default/js/dashboard.js"></script>
    <script type="text/javascript" src="/templates/default/js/mapp-add.js"></script>
    <script type="text/javascript" src="/templates/default/js/mapplugins.js"></script>
    <script type="text/javascript" src="/templates/default/js/maps.js"></script>
    
    <script type="text/javascript" src="/templates/default/js/map-single.js"></script>
    <script type="text/javascript" src="/templates/default/js/charts.js"></script>
    <script type="text/javascript" src="/templates/default/js/jquery.min.js"></script>
    <script type="text/javascript" src="/templates/default/js/plugins.js"></script>
    <script type="text/javascript" src="/templates/default/js/scripts.js"></script>
    <script type="text/javascript" src="/js/plugins/no-ui-slider/nouislider.js"></script>
    <script type="text/javascript" src="/js/plugins/no-ui-slider/nouislider.min.js"></script>
    <script type="text/javascript" src="/js/plugins/no-ui-slider/wNumb.js"></script>
    <script type="text/javascript" src="/js/custom.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC_dRXvweumOlfDtYgvWRN4_LYwNeNoExo&libraries=places&callback=gmaps_callback"></script> 

        


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
                <!-- header-top -->
                <div class="header-top fl-wrap">
                    <div class="container">
                        <div class="logo-holder">
                        <a href="/"><img src="<?php echo getFromTemplate('images/logo.png'); ?>" alt="<?php echo SITE_TITLE; ?>"></a>

                        </div>
                        <div class="add-hotel show-reg-form modal-open">Kurs Merkezinizi Ekleyin <span><i class="fal fa-plus"></i></span></div>                     
                        <div class="show-reg-form modal-open"><i class="fal fa-sign-in"></i>Giriş Yap</div>
                        <?php
                    if(LANG_ENABLED){
                        if(count($langs) > 0){ ?>
                        <div class="lang-wrap">
                            <div class="show-lang"><span><?php echo $langs[LANG_TAG]['title']; ?></span><i class="fal fa-caret-down"></i></div>
                            <ul class="lang-tooltip green-bg">
                            <?php
                                        foreach($langs as $row){
                                            $title_lang = $row['title']; ?>
                                <li><a href="<?php echo DOCBASE.$row['tag']; ?>"><img src="<?php echo $row['file']; ?>" alt="<?php echo $title_lang; ?>"> <?php echo $title_lang; ?></a></li>
                                <?php
                                        } ?>
                            </ul>
                        </div>
                        <?php }
                        }
                    ?>
                    </div>
                </div>
                <!-- header-top end -->
                <!-- header-inner -->
                <div class="header-inner fl-wrap">
                    <div class="container">
                        <div class="show-search-button"><span>Ara</span> <i class="fas fa-search"></i> </div>
                        <div class="wishlist-link"><i class="fal fa-heart"></i><span class="wl_counter">
                            <?php
                            if(isset($_COOKIE["shopping_cart"])){
                                $cookie_data = stripslashes($_COOKIE['shopping_cart']);
                                $cart_data = json_decode($cookie_data, true);
                            ?>
                            
                        <?php echo count($cart_data); ?>
                            <?php }
                            else echo '0'?> 
                            </span></div>
                        <div class="header-user-menu">
                            
                            <div class="header-user-name">
                               
                            <?php
                                            if($_SESSION['user']['login'] != '') echo $_SESSION['user']['login'];
                                            else echo $_SESSION['user']['email']; ?>
                            </div>
                           <ul>
                           <?php
                                        if($_SESSION['user']['type'] == 'registered'){ ?>
                                <li><a href="<?php echo DOCBASE.$sys_pages['account']['alias']; ?>"> <?php echo $sys_pages['account']['name']; ?></a></li>
                                <?php
                                        } ?>
                                <li><a href="#" class="sendAjaxForm" data-action="<?php echo DOCBASE; ?>templates/<?php echo TEMPLATE; ?>/common/register/logout.php" data-refresh="true"><?php echo $texts['LOG_OUT']; ?></a></li>
                            </ul>
                        </div>
                       
                        <div class="home-btn"><a href="/"><i class="fas fa-home"></i></a></div>
                        <!-- nav-button-wrap -->
                        <div class="nav-button-wrap color-bg">
                            <div class="nav-button">
                                <span></span><span></span><span></span>
                            </div>
                        </div>
                        <!-- nav-button-wrap end -->
                        <!--  navigation -->
                        
                        <div class="nav-holder main-menu">
                            <nav>
                                <ul>
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
                                            <i class="fas fa-caret-down"></i>
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
                            </nav>
                        </div>
                        <!-- navigation  end -->
                        <!-- wishlist-wrap -->            
                        <div class="wishlist-wrap scrollbar-inner novis_wishlist">
                            <div class="box-widget-content">
                                <div class="widget-posts fl-wrap">
                                <meta charset="UTF-8">
                                <?php echo $message; ?>
                                <a href="?action=clear"><b>Tümünü Sil</b></a>
                                    <ul>
                                    <?php
                                        if(isset($_COOKIE["shopping_cart"]))
                                        {
                                            $total = 0;
                                            $cookie_data = stripslashes($_COOKIE['shopping_cart']);
                                            $cart_data = json_decode($cookie_data, true);
                                            foreach($cart_data as $keys => $values)
                                            {
                                        ?>     
                                        <li class="clearfix">
                                            <div class="widget-posts-descr">
                                                <a href="<?php echo $values["item_alias"]; ?>" title=""><?php echo $values["item_name"]; ?></a>
                                                <div class="listing-rating card-popup-rainingvis" data-starrating2="5"></div>
                                                <div class="geodir-category-location fl-wrap"><a href="#"><i class="fas fa-map-marker-alt"></i><?php echo $values["item_price"]; ?></a></div>
                                                <span class="rooms-price"></strong></span>
                                                <a href="?action=delete&id=<?php echo $values["item_id"]; ?>"><i class="fas fa-trash-alt"></i></a>
                                            </div>
                                            </li>
                                            <?php }
                                            
                                }
                                else{
                                    echo '
                                    <tr>
                                     <td colspan="5" align="center">Favori Yok</td>
                                    </tr>
                                    ';
                                }?>
                                    </ul>
                                </div>
                            </div>
                        </div> 
                        <!-- wishlist-wrap end --> 
                    </div>
                </div>
                <!-- header-inner end -->
                <!-- header-search -->
                <div class="header-search vis-search">
                    <div class="container">
                        <div class="row">
                            <!-- header-search-input-item -->
                            <div class="main-search-input fl-wrap">
                                     <?php
                                        $nb_search_destinations = 0;
                                        $result_search_destination = $db->query('SELECT * FROM pm_destination WHERE checked = 1 AND lang = '.LANG_ID);
                                        if($result_search_destination !== false){
                                            $nb_search_destinations = $db->last_row_count();
                                            if($nb_search_destinations > 0){ ?>
                                        <div class="main-search-input-item location" >
                                            <span class="inpt_dec"><i class="fas fa-map-marker"></i></span>
                                            <?php
                                            $result_search_destination = $result_search_destination->fetchAll(PDO::FETCH_ASSOC);
                                            if(count($result_search_destination) > 10){ ?>
                                            <input type="text" name="destination_name"  class="autocomplete-input" data-wrapper="result-destinations" data-target="destination_id" data-url="<?php echo getFromTemplate('common/search_destinations.php'); ?>" value="<?php echo $destination_name; ?>" placeholder="<?php echo $texts['DESTINATION']; ?>"  value=""/>
                                            <input type="hidden" name="destination_id" id="destination_id" value="<?php echo $_SESSION['destination_id']; ?>">
                                                <?php
                                            }else{
                                                ?>
                                                <div class="listsearch-input-item ">
                                                    <select name="destination_id" data-placeholder="City" name="destination_id" class="chosen-select">
                                                        <option value="0"><?php echo 'Şehirler'; ?></option>
                                                        <?php
                                                        foreach($result_search_destination as $row){
                                                            $selected = (isset($_SESSION['destination_id']) && $_SESSION['destination_id'] == $row['id']) ? ' selected="selected"' : '';
                                                            echo '<option value="'.$row['id'].'"'.$selected.'>'.$row['name'].'</option>';
                                                        } ?>
                                                    </select>
                                                </div>  
                                                    <?php
                                                } ?>
                                            
                                        </div>
                                        
                                                <?php 
                                                }
                                            }?>
                                        
                                        
                                        <div class="main-search-input-item main-date-parent main-search-input-item_small">
                                            <span class="inpt_dec"><i class="fas fa-calendar-check"></i></span> <input  style="background-color:#f7f9fb;" type="text" placeholder="Aradığınız Kurs Merkezini Yazın"  id="autocompleteid4"   value=""/>
                                        </div>

                                        
                                        
                                        <?php
                                            $nb_search_schoollevels = 0;
                                            $result_search_schoollevel = $db->query('SELECT * FROM pm_schoollevel WHERE checked = 1 AND lang = '.LANG_ID);
                                            if($result_search_schoollevel !== false){
                                                $nb_search_schoollevels = $db->last_row_count();
                                                if($nb_search_schoollevels > 0){ ?>
                                        <div class="main-search-input-item location" >
                                        <span class="inpt_dec"><i class="fas fa-map-marker"></i></span></i>
                                                <?php
                                                         $result_search_schoollevel = $result_search_schoollevel->fetchAll(PDO::FETCH_ASSOC);
                                                                if(count($result_search_schoollevel) > 10){ ?>
                                                                                <input type="text" name="schoollevel_name" class="form-control" data-wrapper="result-schoollevels" data-target="schoollevel_id" data-url="<?php echo getFromTemplate('common/search_schoollevels.php'); ?>" value="<?php echo $schoollevel_name; ?>" placeholder="<?php echo $texts['schoollevel']; ?>">
                                                                                <input type="hidden" name="schoollevel_id" id="schoollevel_id" value="<?php echo $_SESSION['schoollevel_id']; ?>">
                                                                                <?php
                                                                            }else{ ?>
                                                                             <div class="listsearch-input-item ">
                                                                                <select  data-placeholder="City" name="destination_id" name="schoollevel_id" class="chosen-select no-search-select">
                                                                                    <?php
                                                                                    foreach($result_search_schoollevel as $row){
                                                                                        $selected = (isset($_SESSION['schoollevel_id']) && $_SESSION['schoollevel_id'] == $row['id']) ? ' selected="selected"' : '';
                                                                                        echo '<option value="'.$row['id'].'"'.$selected.'>'.$row['name'].'</option>';
                                                                                    } ?>
                                                                                </select>
                                                                                </div>
                                                                                <?php
                                                                            } ?>
                                                                        </div> 
                                                                        <button class="main-search-button color2-bg" name="check_availabilities">Kurs Merkezi Ara <i class="fas fa-search"></i></button>
                                                                    </div>
                                                                </div>
                                                                <?php
                                                    }
                                                } ?>
                                        </div>
                                    
                                </div>
                            </div>
                            <!-- header-search-input-item end -->                             
                            <!-- header-search-input-item -->
                            
                            <!-- header-search-input-item end -->                                                          
                        </div>
                    </div>
                    <div class="close-header-search"><i class="fal fa-angle-double-up"></i></div>
                </div>
                <!-- header-search  end -->
            </header>
            <div class="map-modal-wrap">
                <div class="map-modal-wrap-overlay"></div>
                <div class="map-modal-item">
                    <div class="map-modal-container fl-wrap">
                        <div class="map-modal fl-wrap">
                            <div id="singleMap" data-latitude="40.7" data-longitude="-73.1"></div>
                        </div>
                        <h3><i class="fal fa-location-arrow"></i><a href="#">Kurs Merkezi</a></h3>
                        <input id="pac-input" class="controls fl-wrap controls-mapwn" type="text" placeholder="">
                        <div class="map-modal-close"><i class="fal fa-times"></i></div>
                    </div>
                </div>
            </div>
            <!--map-modal end -->            
            <!--register form -->
            <div class="main-register-wrap modal">
                <div class="reg-overlay"></div>
                <div class="main-register-holder">
                    <div class="main-register fl-wrap">
                        <div class="close-reg color-bg"><i class="fal fa-times"></i></div>
                        <ul class="tabs-menu">
                            <li class="current"><a href="#tab-1"><i class="fal fa-sign-in-alt"></i> Giriş Yap</a></li>
                            <li><a href="#tab-2"><i class="fal fa-user-plus"></i> Kayıt Ol</a></li>
                        </ul>
                        <!--tabs -->                       
                        <div id="tabs-container">
                            <div class="tab">
                                <!--tab -->
                                <div id="tab-1" class="tab-content">
                                    <h3>Giriş Yap <span>KURSARA<strong>BUL</strong></span></h3>
                                    <div class="custom-form">
                                        <div class="login-form">
                                            <form method="post" action="<?php echo DOCBASE.$page['alias']; ?>" class="ajax-form">
                                                <div class="alert alert-success" style="display:none;"></div>
                                                <div class="alert alert-danger" style="display:none;"></div>
                                                <div class="form-group">
                                                   
                                                        <label>Kullanıcı Adı veya Email <span>*</span> </label>
                                                        <input type="text" class="form-control" name="user" value="" placeholder="Kullanıcı Adı veya Email *">
                                                    
                                                    <div class="field-notice" rel="user"></div>
                                                </div>
                                                <div class="form-group">
                                                   
                                                        <label>Şifre <span>*</span> </label>
                                                        <input type="password" class="form-control" name="pass" value="" placeholder="Şifre *">
                                                   
                                                    <div class="field-notice" rel="pass"></div>
                                                </div>
                                                <div class="row">
                                                    
                                                    <div class="col-sm-12">
                                                        <a href="#" class="log-submit-btn color-bg sendAjaxForm" data-action="<?php echo getFromTemplate('common/register/login.php'); ?>" data-refresh="true"><i class="fas fa-fw fa-power-off"></i> <?php echo $texts['LOG_IN']; ?></a>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="open-pass-form">
                                            <a href="#">Şifremi Unuttum</a>
                                        </div>
                                    </div>
                                </div>
                                <!--tab end -->
                                <!--tab -->
                                
                                <div class="tab">
                                    <div id="tab-2" class="tab-content">
                                        <h3>Kayıt Ol <span>KURSARA<strong>BUL</strong></span></h3>
                                        <div class="custom-form">
                                        <form method="post" action="<?php echo DOCBASE.$page['alias']; ?>" class="ajax-form">
                                        <div class="alert alert-success" style="display:none;"></div>
                                        <div class="alert alert-danger" style="display:none;"></div>
                                        <input type="hidden" name="signup_type" value="quick" class="noreset">
                                        <input type="hidden" name="signup_redirect" value="<?php echo getUrl(true).DOCBASE.$sys_pages['account']['alias']; ?>" class="noreset">
                                        <div class="form-group">
                                            
                                                <label>Kullanıcı Adı <span>*</span> </label>
                                                <input type="text" class="form-control" name="username" value="" placeholder="Kullanıcı Adı *">
                                            
                                            <div class="field-notice" rel="username"></div>
                                        </div>
                                        <div class="form-group">
                                           
                                                <label>Email <span>*</span></label>
                                                <input type="text" class="form-control" name="email" value="" placeholder="Email *">
                                           
                                            <div class="field-notice" rel="email"></div>
                                        </div>
                                        <div class="form-group">
                                            
                                                <label >Şifre <span>*</span></label>
                                                <input type="password" class="form-control" name="password" value="" placeholder="Şifre *">
                                          
                                            <div class="field-notice" rel="password"></div>
                                        </div>
                                        <div class="form-group">
                                           
                                                <label >Şifre Doğrula <span>*</span></label>
                                                <input type="password" class="form-control" name="password_confirm" value="" placeholder="Şifre Doğrula *">
                                          
                                            <div class="field-notice" rel="password_confirm"></div>
                                        </div>
                                        <div class="form-group">
                                            <input type="radio" name="hotel_owner" id="hotel_owner_1" value="1"> Yöneticiyim &nbsp;
                                            <input type="radio" name="hotel_owner" id="hotel_owner_0" value="0"> Ziyaretçiyim
                                        </div>
                                       
                                        <div class="row mb10">
                                            
                                            <div class="col-sm-12 text-right">
                                                <a href="#" class="btn color-bg sendAjaxForm" data-action="<?php echo getFromTemplate('common/register/signup.php'); ?>" data-clear="true"><?php echo $texts['SIGN_UP']; ?></a>
                                            </div>
                                        </div>
                                    </form>
                                        </div>
                                    </div>
                                </div>
                                </div>
                                <!--tab end -->
                            </div>
                            <!--tabs end -->
                            
                            <!-- <div class="soc-log fl-wrap">
                                <p>For faster login or register use your social account.</p>
                                <a href="#" class="facebook-log"><i class="fab fa-facebook-f"></i>Connect with Facebook</a>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
