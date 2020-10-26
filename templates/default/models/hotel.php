
<?php
if($article_alias == '') err404();

$result = $db->query('SELECT * FROM pm_hotel WHERE checked = 1 AND lang = '.LANG_ID.' AND alias = '.$db->quote($article_alias));
if($result !== false && $db->last_row_count() == 1){

    $hotel = $result->fetch(PDO::FETCH_ASSOC);

    $hotel_id = $hotel['id'];
    $hotel_lat=$hotel['lat'];
    $hotel_lng=$hotel['lng'];
    $article_id = $hotel_id;
    $title_tag = $hotel['title'].' - '.$title_tag;
    $page_title = $hotel['title'];
    $page_subtitle = '';
    $page_alias = $pages[$page_id]['alias'].'/'.text_format($hotel['alias']);
    $page_name = $hotel['title'];

    $result_hotel_file = $db->query('SELECT * FROM pm_hotel_file WHERE id_item = '.$hotel_id.' AND checked = 1 AND lang = '.DEFAULT_LANG.' AND type = \'image\' AND file != \'\' ORDER BY rank LIMIT 1');
    if($result_hotel_file !== false && $db->last_row_count() > 0){

        $row = $result_hotel_file->fetch();

        $file_id = $row['id'];
        $filename = $row['file'];

        if(is_file(SYSBASE.'medias/hotel/medium/'.$file_id.'/'.$filename))
            $page_img = getUrl(true).DOCBASE.'medias/hotel/medium/'.$file_id.'/'.$filename;
    }

}else err404();

check_URI(DOCBASE.$page_alias);

/* ==============================================
 * CSS AND JAVASCRIPT USED IN THIS MODEL
 * ==============================================
 */

$javascripts[] = DOCBASE.'js/plugins/sharrre/jquery.sharrre.min.js';

$javascripts[] = DOCBASE.'js/plugins/jquery.event.calendar/js/jquery.event.calendar.js';
$javascripts[] = DOCBASE.'js/plugins/jquery.event.calendar/js/languages/jquery.event.calendar.'.LANG_TAG.'.js';
$stylesheets[] = array('file' => DOCBASE.'js/plugins/jquery.event.calendar/css/jquery.event.calendar.css', 'media' => 'all');

$stylesheets[] = array('file' => '//cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.0.0-beta.2.4/assets/owl.carousel.min.css', 'media' => 'all');
$stylesheets[] = array('file' => '//cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.0.0-beta.2.4/assets/owl.theme.default.min.css', 'media' => 'all');
$javascripts[] = '//cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.0.0-beta.2.4/owl.carousel.min.js';

$stylesheets[] = array('file' => '//cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/3.5.5/css/star-rating.min.css', 'media' => 'all');
$javascripts[] = '//cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/3.5.5/js/star-rating.min.js';

$stylesheets[] = array('file' => DOCBASE.'js/plugins/isotope/css/style.css', 'media' => 'all');
$javascripts[] = '//cdnjs.cloudflare.com/ajax/libs/jquery.isotope/1.5.25/jquery.isotope.min.js';
$javascripts[] = DOCBASE.'js/plugins/isotope/jquery.isotope.sloppy-masonry.min.js';

$stylesheets[] = array('file' => DOCBASE.'js/plugins/lazyloader/lazyloader.css', 'media' => 'all');
$javascripts[] = DOCBASE.'js/plugins/lazyloader/lazyloader.js';

$javascripts[] = DOCBASE.'js/plugins/live-search/jquery.liveSearch.js';



require(getFromTemplate('common/send_comment.php', false));

require(getFromTemplate('common/header.php', false)); ?>

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
<section id="page">

    <?php #include(getFromTemplate('common/page_header.php', false)); ?>
    <div id="wrapper">
                <!-- content-->
                <div class="content">
                    <!--  section  -->
                    <section class="list-single-hero" data-scrollax-parent="true" id="sec1">
                                <?php
                                if($result_hotel_file->execute() !== false && $db->last_row_count() > 0){
                                    $row = $result_hotel_file->fetch(PDO::FETCH_ASSOC);

                                    $file_id = $row['id'];
                                    $filename = $row['file'];
                                    $label = $row['label'];

                                    $realpath = SYSBASE.'medias/hotel/medium/'.$file_id.'/'.$filename;
                                    $thumbpath = DOCBASE.'medias/hotel/medium/'.$file_id.'/'.$filename;
                                    $zoompath = DOCBASE.'medias/hotel/big/'.$file_id.'/'.$filename;

                                    if(is_file($realpath)){
                                ?>
                        <div class="bg par-elem "  data-bg="<?php echo $thumbpath ?>" data-scrollax="properties: { translateY: '30%' }"></div>
                                    <?php }
                                    } ?>
                        <div class="list-single-hero-title fl-wrap">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-7">
                                        <div class="listing-rating-wrap">
                                            <div class="listing-rating card-popup-rainingvis" data-starrating2="5"></div>
                                        </div>
                                        <h2><span> <?php echo $hotel['title']; ?></span></h2>
                                        <div class="list-single-header-contacts fl-wrap">
                                            <ul>
                                                <li><i class="far fa-phone"></i><a  href="#"><?php echo $hotel['phone']; ?></a></li>
                                                <li><i class="far fa-map-marker-alt"></i><a  href="#"><?php echo $hotel['address']; ?></a></li>
                                                <li><i class="far fa-envelope"></i><a  href="#"><?php echo $hotel['email']; ?></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <!--  list-single-hero-details-->
                                        <div class="list-single-hero-details fl-wrap">
                                            <!--  list-single-hero-rating-->
                                            <div class="list-single-hero-rating"><?php
                                            $nb_comments = 0;
                                                $item_type = 'hotel';
                                                $item_id = $hotel_id;
                                                $allow_comment = ALLOW_COMMENTS;
                                                $allow_rating = ALLOW_RATINGS;
                                                if($allow_comment == 1){
                                                    $result_comment = $db->query('SELECT * FROM pm_comment WHERE id_item = '.$item_id.' AND item_type = \''.$item_type.'\' AND checked = 1 ORDER BY add_date DESC');
                                                    if($result_comment !== false)
                                                        $nb_comments = $db->last_row_count();
                                                } ?>

                                        <?php
                                                    if($nb_comments > 0){ ?>

                                                <div class="rate-class-name">
                                                <?php
                                                    $result_rating = $db->query('SELECT count(*) as count_rating, AVG(rating) as avg_rating FROM pm_comment WHERE item_type = \'hotel\' AND id_item = '.$hotel_id.' AND checked = 1 AND rating > 0 AND rating <= 5');
                                                    if($result_rating !== false && $db->last_row_count() == 1){
                                                        $row = $result_rating->fetch();
                                                        $hotel_rating = $row['avg_rating'];
                                                        $count_rating = $row['count_rating'];

                                                        if($hotel_rating > 0 && $hotel_rating <= 5){ ?>
                                                        <?php if($hotel_rating == 5){ ?>
                                                         <div class="score"><strong>Çok İyi</strong> <?php
                                                         }
                                                        if($hotel_rating == 4){ ?>
                                                            <div class="score"><strong> İyi</strong> <?php
                                                            }
                                                        if($hotel_rating == 3){ ?>
                                                          <div class="score"><strong>Normal</strong> <?php
                                                          }
                                                        if($hotel_rating <= 2){ ?>
                                                         <div class="score"><strong>Kötü</strong> <?php
                                                         }
                                                echo $nb_comments;?> Yorum </div>



                                                    <span><?php echo round($hotel_rating); ?></span>

                                                </div>
                                                <?php
                                                        }
                                                    } ?>
                                                    <?php }
                                                    else { ?>
                                                    <div class="score">
                                                        <span><?php echo 'Herhangi bir Yorum Yapılmamıştır.'; ?></span>
                                                    </div>
                                                    <?php }
                                                    ?>
                                                <!-- list-single-hero-rating-list-->

                                                <!-- list-single-hero-rating-list end-->
                                            </div>
                                            <!--  list-single-hero-rating  end-->
                                            <div class="clearfix"></div>
                                            <!-- list-single-hero-links-->
                                            <div class="list-single-hero-links">

                                                <a class="custom-scroll-link lisd-link" href="#sec6"><i class="fal fa-comment-alt-check"></i>Yorum Yap</a>
                                            </div>
                                            <!--  list-single-hero-links end-->
                                        </div>
                                        <!--  list-single-hero-details  end-->
                                    </div>
                                </div>
                                <div class="breadcrumbs-hero-buttom fl-wrap">
                                <?php
                                $min_price = 0;
                                $result_rate = $db->query('
                                    SELECT MIN(ra.price) as min_price
                                    FROM pm_rate as ra, pm_room as ro
                                    WHERE ro.id = id_room AND ro.id_hotel = '.$hotel_id);
                                if($result_rate !== false && $db->last_row_count() > 0){
                                    $row = $result_rate->fetch();
                                    $price = $row['min_price'];
                                    if($price > 0) $min_price = $price;
                                }
                                if($min_price > 0){ ?>
                                    <!-- <div class="breadcrumbs"><a href="#">Home</a><a href="#">Listings</a><a href="#">New York</a><span>Listing Single</span></div> -->
                                    <div class="list-single-hero-price">Fiyat<span><?php echo formatPrice($min_price*CURRENCY_RATE); ?></span></div>
                                    <?php
                                    }
                                  ?>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!--  section  end-->
                    <!--  section  -->
                    <section class="grey-blue-bg small-padding scroll-nav-container">
                        <!--  scroll-nav-wrapper  -->
                        <div class="scroll-nav-wrapper fl-wrap">
                            <div class="hidden-map-container fl-wrap">
                                <input id="pac-input" class="controls fl-wrap controls-mapwn" type="text" placeholder="Yakınlarında Kurs Merkezi Ara ">
                                <div class="map-container">
                                    <div id="singleMap" data-latitude="40.7427837" data-longitude="-73.11445617675781"></div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="container">
                                <nav class="scroll-nav scroll-init">
                                    <ul>
                                        <li><a class="act-scrlink" href="#sec1">Galeri</a></li>
                                        <li><a href="#sec2">Kurs Merkezi Hakkında</a></li>
                                        <li><a href="#sec3">Kurs Merkezinin İmkanları</a></li>
                                        <li><a href="#sec4">Sınıflar</a></li>
                                        <li><a href="#sec5">Yorumlar</a></li>
                                    </ul>
                                </nav>
                                <a href="#" class="show-hidden-map">  <span>Haritada Gör</span> <i class="fal fa-map-marked-alt"></i></a>
                            </div>
                        </div>
                        <!--  scroll-nav-wrapper end  -->
                        <!--   container  -->
                        <div class="container">
                            <!--   row  -->
                            <div class="row">
                                <!--   datails -->
                                <div class="col-md-8">
                                    <div class="list-single-main-container ">
                                        <!-- fixed-scroll-column  -->
                                        <div class="fixed-scroll-column">
                                            <div class="fixed-scroll-column-item fl-wrap">
                                                <div class="showshare sfcs fc-button"><i class="far fa-share-alt"></i><span>Paylaş </span></div>
                                                <div class="share-holder fixed-scroll-column-share-container">
                                                    <div class="share-container  isShare"></div>
                                                </div>
                                                <a class="fc-button custom-scroll-link" href="#sec6"><i class="far fa-comment-alt-check"></i> <span>  Yorum Ekle </span></a>
                                                <a class="fc-button" href="#"><i class="far fa-heart"></i> <span>Kaydet</span></a>
                                                <form action="<?php echo DOCBASE.$sys_pages['booking']['alias']; ?>" method="post">
                                                <input type="hidden" name="hotel_id" value="<?php echo $hotel_id; ?>">
                                                <a class="fc-button" href="<?php echo DOCBASE.$sys_pages['booking']['alias']; ?>" name="check_availabilities"><i class="far fa-bookmark"></i> <span> Rezervasyon  </span></a>
                                                </form>
                                            </div>
                                        </div>
                                        <!-- fixed-scroll-column end   -->
                                        <div class="list-single-main-media fl-wrap" id="sec1">
                                            <!-- gallery-items   -->
                                            <div class="gallery-items grid-small-pad  list-single-gallery three-coulms lightgallery schhol">
                                                <!-- 1 -->
                                                <?php
                                                    $nb_image = 0;
                                                    $result_hotel_file = $db->query('SELECT * FROM pm_hotel_file WHERE id_item = '.$hotel_id.' AND checked = 1 AND lang = '.DEFAULT_LANG.' AND type = \'image\' AND file != \'\' ORDER BY rank LIMIT 0,3');
                                                    $nb_image = $db->last_row_count();


                                                    if($result_hotel_file !== false){

                                                        foreach($result_hotel_file as $i => $row){

                                                            $file_id = $row['id'];
                                                            $filename = $row['file'];
                                                            $label = $row['label'];

                                                            $realpath = SYSBASE.'medias/hotel/big/'.$file_id.'/'.$filename;
                                                            $thumbpath = DOCBASE.'medias/hotel/big/'.$file_id.'/'.$filename;

                                                            if((is_file($realpath)) && ($nb_image < 14 )){


                                                    ?>

                                                <div class="gallery-item"style="height:150px !important;" >
                                                    <div class="grid-item-holder" style="height:150px !important;">

                                                        <div class="box-item">
                                                            <img style="height:150px !important;" src="<?php echo $thumbpath ?>"   alt="">
                                                            <a href="<?php echo $thumbpath ?>" class="gal-link popup-image"><i class="fa fa-search"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                        <?php }
                                                        }
                                                     }

                                                      ?>
                                                      <?php
                                                    $nb_image = 0;
                                                    $result_hotel_file = $db->query('SELECT * FROM pm_hotel_file WHERE id_item = '.$hotel_id.' AND checked = 1 AND lang = '.DEFAULT_LANG.' AND type = \'image\' AND file != \'\' ORDER BY rank LIMIT 3,1');
                                                    $nb_image = $db->last_row_count();


                                                    if($result_hotel_file !== false){

                                                        foreach($result_hotel_file as $i => $row){

                                                            $file_id = $row['id'];
                                                            $filename = $row['file'];
                                                            $label = $row['label'];

                                                            $realpath = SYSBASE.'medias/hotel/big/'.$file_id.'/'.$filename;
                                                            $thumbpath = DOCBASE.'medias/hotel/big/'.$file_id.'/'.$filename;

                                                            if((is_file($realpath)) && ($nb_image < 14 )){


                                                    ?>

                                                <div class="gallery-item gallery-item-second" style="height:300px !important;">
                                                    <div class="grid-item-holder" style="height:300px !important;">

                                                        <div class="box-item">
                                                            <img style="height:300px !important;"src="<?php echo $thumbpath ?>"   alt="">
                                                            <a href="<?php echo $thumbpath ?>" class="gal-link popup-image"><i class="fa fa-search"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                        <?php }
                                                        }
                                                     }

                                                      ?>
                                                <?php
                                                    $nb_image = 0;
                                                    $result_hotel_file = $db->query('SELECT * FROM pm_hotel_file WHERE id_item = '.$hotel_id.' AND checked = 1 AND lang = '.DEFAULT_LANG.' AND type = \'image\' AND file != \'\' ORDER BY rank LIMIT 4,1');
                                                    $nb_image = $db->last_row_count();


                                                    if($result_hotel_file !== false){

                                                        foreach($result_hotel_file as $i => $row){

                                                            $file_id = $row['id'];
                                                            $filename = $row['file'];
                                                            $label = $row['label'];

                                                            $realpath = SYSBASE.'medias/hotel/big/'.$file_id.'/'.$filename;
                                                            $thumbpath = DOCBASE.'medias/hotel/big/'.$file_id.'/'.$filename;

                                                            if((is_file($realpath)) && ($nb_image < 14 )){


                                                    ?>

                                                <div class="gallery-item" style="height:150px !important;">
                                                    <div class="grid-item-holder" style="height:150px !important;">

                                                        <div class="box-item">
                                                            <img style="height:150px !important;"src="<?php echo $thumbpath ?>"   alt="">
                                                            <a href="<?php echo $thumbpath ?>" class="gal-link popup-image"><i class="fa fa-search"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                        <?php }
                                                        }
                                                     }

                                                      ?>
                                                      <?php
                                                    $nb_image = 0;
                                                    $result_hotel_file = $db->query('SELECT * FROM pm_hotel_file WHERE id_item = '.$hotel_id.' AND checked = 1 AND lang = '.DEFAULT_LANG.' AND type = \'image\' AND file != \'\' ORDER BY rank LIMIT 5,1');
                                                    $nb_image = $db->last_row_count();


                                                    if($result_hotel_file !== false){

                                                        foreach($result_hotel_file as $i => $row){

                                                            $file_id = $row['id'];
                                                            $filename = $row['file'];
                                                            $label = $row['label'];

                                                            $realpath = SYSBASE.'medias/hotel/big/'.$file_id.'/'.$filename;
                                                            $thumbpath = DOCBASE.'medias/hotel/big/'.$file_id.'/'.$filename;

                                                            if((is_file($realpath)) && ($nb_image < 14 )){


                                                    ?>

                                                <div class="gallery-item" style="height:150px !important;">
                                                    <div class="grid-item-holder" style="height:150px !important;">

                                                        <div class="box-item">
                                                            <img style="height:150px !important;"src="<?php echo $thumbpath ?>"   alt="">
                                                            <a href="<?php echo $thumbpath ?>" class="gal-link popup-image"><i class="fa fa-search"></i></a>
                                                            <?php
                                                    $nb_image = 0;
                                                    $result_hotel_file = $db->query('SELECT * FROM pm_hotel_file WHERE id_item = '.$hotel_id.' AND checked = 1 AND lang = '.DEFAULT_LANG.' AND type = \'image\' AND file != \'\' ORDER BY rank ');
                                                    $nb_image = $db->last_row_count();


                                                    if($result_hotel_file !== false){

                                                        foreach($result_hotel_file as $i => $row){

                                                            $file_id = $row['id'];
                                                            $filename = $row['file'];
                                                            $label = $row['label'];

                                                            $realpath = SYSBASE.'medias/hotel/big/'.$file_id.'/'.$filename;
                                                            $thumbpath = DOCBASE.'medias/hotel/big/'.$file_id.'/'.$filename;

                                                            if((is_file($realpath)) && ($nb_image < 14 )){


                                                    ?>
                                                            <div class="more-photos-button dynamic-gal"  data-dynamicPath="[{'src': '<?php echo $thumbpath ?>'}]">Diğer <span>Resimler</span><i class="far fa-long-arrow-right"></i></div>
                                                            <?php }
                                                        }
                                                     }

                                                      ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                        <?php }
                                                        }
                                                     }

                                                      ?>


                                                <!-- 7 end -->
                                            </div>
                                            <!-- end gallery items -->
                                        </div>
                                        <!-- list-single-header end -->
                                        <div class="list-single-facts fl-wrap">
                                            <!-- inline-facts -->
                                            <div class="inline-facts-wrap">
                                                <div class="inline-facts">
                                                    <i class="fal fa-school"></i>
                                                    <div class="milestone-counter">
                                                        <div class="stats animaper">
                                                            45
                                                        </div>
                                                    </div>
                                                    <h6></h6>
                                                </div>
                                            </div>
                                            <!-- inline-facts end -->
                                            <!-- inline-facts  -->
                                            <div class="inline-facts-wrap">
                                                <div class="inline-facts">
                                                    <i class="fal fa-users"></i>
                                                    <div class="milestone-counter">
                                                        <div class="stats animaper">
                                                            2557
                                                        </div>
                                                    </div>
                                                    <h6></h6>
                                                </div>
                                            </div>
                                            <!-- inline-facts end -->
                                            <!-- inline-facts -->
                                            <div class="inline-facts-wrap">
                                                <div class="inline-facts">
                                                    <i class="fal fa-book"></i>
                                                    <div class="milestone-counter">
                                                        <div class="stats animaper">
                                                            15
                                                        </div>
                                                    </div>
                                                    <h6></h6>
                                                </div>
                                            </div>
                                            <!-- inline-facts end -->
                                            <!-- inline-facts -->
                                            <div class="inline-facts-wrap">
                                                <div class="inline-facts">
                                                    <i class="fal fa-volleyball-ball"></i>
                                                    <div class="milestone-counter">
                                                        <div class="stats animaper">
                                                            4
                                                        </div>
                                                    </div>
                                                    <h6></h6>
                                                </div>
                                            </div>
                                            <!-- inline-facts end -->
                                        </div>
                                        <!--   list-single-main-item -->
                                        <div class="list-single-main-item fl-wrap"  id="sec2">
                                            <div class="list-single-main-item-title fl-wrap">
                                                <h3>Kurs Merkezi Hakkında </h3>
                                            </div>
                                               <p><?php
                                                echo $hotel['descr'];

                                                $short_text = strtrunc(strip_tags($hotel['descr']), 100);
                                                $site_url = getUrl(); ?></p>
                                            <a href="https://vimeo.com/70851162" class="btn flat-btn color-bg big-btn float-btn image-popup">Video <i class="fal fa-play"></i></a>
                                        </div>
                                        <!--   list-single-main-item end -->
                                        <!--   list-single-main-item -->
                                        <div class="list-single-main-item fl-wrap" id="sec3">
                                            <div class="list-single-main-item-title fl-wrap">
                                                <h3>Fiziksel İmkanlar</h3>
                                        </div>
                                            <div class="listing-features fl-wrap">
                                                <ul>
                                                <?php
                                                    $result_facility = $db->query('SELECT * FROM pm_facility WHERE lang = '.LANG_ID.' AND id IN('.$hotel['facilities'].') ORDER BY id',PDO::FETCH_ASSOC);
                                                    if($result_facility !== false && $db->last_row_count() > 0){
                                                        foreach($result_facility as $i => $row){
                                                            $facility_id 	= $row['id'];
                                                            $facility_name  = $row['name'];
                                                            $facility_category  = $row['category'];

                                                            $result_facility_file = $db->query('SELECT * FROM pm_facility_file WHERE id_item = '.$facility_id.' AND checked = 1 AND lang = '.DEFAULT_LANG.' AND type = \'image\' AND file != \'\' ORDER BY rank LIMIT 1',PDO::FETCH_ASSOC);
                                                            if($result_facility_file !== false && $db->last_row_count() == 1){
                                                                $row = $result_facility_file->fetch();

                                                                $file_id 	= $row['id'];
                                                                $filename 	= $row['file'];
                                                                $label	 	= $row['label'];

                                                                $realpath	= SYSBASE.'medias/facility/big/'.$file_id.'/'.$filename;
                                                                $thumbpath	= DOCBASE.'medias/facility/big/'.$file_id.'/'.$filename;
                                                            if ($facility_category == 'fiziksel'){
                                                                if(is_file($realpath)){ ?>

                                                                        <li>
                                                                        <img alt="<?php echo $facility_name; ?>" title="<?php echo $facility_name; ?>" src="<?php echo $thumbpath; ?>"><?php echo $facility_name; ?>
                                                                        </li>
                                                                         <?php
                                                                }
                                                            }
                                                        }

                                                        }
                                                    } ?>
                                                </ul>
                                            </div>


                                        <div class="list-single-main-item-title fl-wrap">
                                                <h3>Hizmetler</h3>
                                        </div>
                                            <div class="listing-features fl-wrap">
                                                <ul>
                                                <?php
                                                    $result_facility = $db->query('SELECT * FROM pm_facility WHERE lang = '.LANG_ID.' AND id IN('.$hotel['facilities'].') ORDER BY id',PDO::FETCH_ASSOC);
                                                    if($result_facility !== false && $db->last_row_count() > 0){
                                                        foreach($result_facility as $i => $row){
                                                            $facility_id 	= $row['id'];
                                                            $facility_name  = $row['name'];
                                                            $facility_category  = $row['category'];

                                                            $result_facility_file = $db->query('SELECT * FROM pm_facility_file WHERE id_item = '.$facility_id.' AND checked = 1 AND lang = '.DEFAULT_LANG.' AND type = \'image\' AND file != \'\' ORDER BY rank LIMIT 1',PDO::FETCH_ASSOC);
                                                            if($result_facility_file !== false && $db->last_row_count() == 1){
                                                                $row = $result_facility_file->fetch();

                                                                $file_id 	= $row['id'];
                                                                $filename 	= $row['file'];
                                                                $label	 	= $row['label'];

                                                                $realpath	= SYSBASE.'medias/facility/big/'.$file_id.'/'.$filename;
                                                                $thumbpath	= DOCBASE.'medias/facility/big/'.$file_id.'/'.$filename;
                                                            if ($facility_category == 'hizmetler'){
                                                                if(is_file($realpath)){ ?>

                                                                        <li><img alt="<?php echo $facility_name; ?>" title="<?php echo $facility_name; ?>" src="<?php echo $thumbpath; ?>"><?php echo $facility_name; ?>
                                                                        </li>
                                                                               <?php
                                                                }
                                                            }
                                                        }

                                                        }
                                                    } ?>
                                                </ul>
                                            </div>
                                            <div class="list-single-main-item-title fl-wrap">
                                                <h3>Dil Olanakları</h3>
                                            </div>
                                            <div class="listing-features fl-wrap">
                                                <ul>
                                                <?php
                                                    $result_facility = $db->query('SELECT * FROM pm_facility WHERE lang = '.LANG_ID.' AND id IN('.$hotel['facilities'].') ORDER BY id',PDO::FETCH_ASSOC);
                                                    if($result_facility !== false && $db->last_row_count() > 0){
                                                        foreach($result_facility as $i => $row){
                                                            $facility_id 	= $row['id'];
                                                            $facility_name  = $row['name'];
                                                            $facility_category  = $row['category'];

                                                            $result_facility_file = $db->query('SELECT * FROM pm_facility_file WHERE id_item = '.$facility_id.' AND checked = 1 AND lang = '.DEFAULT_LANG.' AND type = \'image\' AND file != \'\' ORDER BY rank LIMIT 1',PDO::FETCH_ASSOC);
                                                            if($result_facility_file !== false && $db->last_row_count() == 1){
                                                                $row = $result_facility_file->fetch();

                                                                $file_id 	= $row['id'];
                                                                $filename 	= $row['file'];
                                                                $label	 	= $row['label'];

                                                                $realpath	= SYSBASE.'medias/facility/big/'.$file_id.'/'.$filename;
                                                                $thumbpath	= DOCBASE.'medias/facility/big/'.$file_id.'/'.$filename;
                                                            if ($facility_category == 'dil'){
                                                                if(is_file($realpath)){ ?>

                                                                        <li>
                                                                        <img alt="<?php echo $facility_name; ?>" title="<?php echo $facility_name; ?>" src="<?php echo $thumbpath; ?>"><?php echo $facility_name; ?>
                                                                        </li>                                                    <?php
                                                                }
                                                            }
                                                        }

                                                        }
                                                    } ?>
                                                </ul>
                                            </div>
                                            <div class="list-single-main-item-title fl-wrap">
                                                <h3>Sanatsal Faaliyetler</h3>
                                            </div>
                                            <div class="listing-features fl-wrap">
                                                <ul>
                                                <?php
                                                    $result_facility = $db->query('SELECT * FROM pm_facility WHERE lang = '.LANG_ID.' AND id IN('.$hotel['facilities'].') ORDER BY id',PDO::FETCH_ASSOC);
                                                    if($result_facility !== false && $db->last_row_count() > 0){
                                                        foreach($result_facility as $i => $row){
                                                            $facility_id 	= $row['id'];
                                                            $facility_name  = $row['name'];
                                                            $facility_category  = $row['category'];

                                                            $result_facility_file = $db->query('SELECT * FROM pm_facility_file WHERE id_item = '.$facility_id.' AND checked = 1 AND lang = '.DEFAULT_LANG.' AND type = \'image\' AND file != \'\' ORDER BY rank LIMIT 1',PDO::FETCH_ASSOC);
                                                            if($result_facility_file !== false && $db->last_row_count() == 1){
                                                                $row = $result_facility_file->fetch();

                                                                $file_id 	= $row['id'];
                                                                $filename 	= $row['file'];
                                                                $label	 	= $row['label'];

                                                                $realpath	= SYSBASE.'medias/facility/big/'.$file_id.'/'.$filename;
                                                                $thumbpath	= DOCBASE.'medias/facility/big/'.$file_id.'/'.$filename;
                                                            if ($facility_category == 'sanatsal'){
                                                                if(is_file($realpath)){ ?>

                                                                            <li>
                                                                            <img alt="<?php echo $facility_name; ?>" title="<?php echo $facility_name; ?>" src="<?php echo $thumbpath; ?>"><?php echo $facility_name; ?>
                                                                        </li>
                                                                            <?php
                                                                }
                                                            }
                                                        }

                                                        }
                                                    } ?>
                                                </ul>
                                            </div>
                                            <div class="list-single-main-item-title fl-wrap">
                                                <h3>Sportif Faaliyetler</h3>
                                             </div>
                                            <div class="listing-features fl-wrap">
                                                <ul>
                                                <?php
                                                $result_facility = $db->query('SELECT * FROM pm_facility WHERE lang = '.LANG_ID.' AND id IN('.$hotel['facilities'].') ORDER BY id',PDO::FETCH_ASSOC);
                                                if($result_facility !== false && $db->last_row_count() > 0){
                                                    foreach($result_facility as $i => $row){
                                                        $facility_id 	= $row['id'];
                                                        $facility_name  = $row['name'];
                                                        $facility_category  = $row['category'];

                                                        $result_facility_file = $db->query('SELECT * FROM pm_facility_file WHERE id_item = '.$facility_id.' AND checked = 1 AND lang = '.DEFAULT_LANG.' AND type = \'image\' AND file != \'\' ORDER BY rank LIMIT 1',PDO::FETCH_ASSOC);
                                                        if($result_facility_file !== false && $db->last_row_count() == 1){
                                                            $row = $result_facility_file->fetch();

                                                            $file_id 	= $row['id'];
                                                            $filename 	= $row['file'];
                                                            $label	 	= $row['label'];

                                                            $realpath	= SYSBASE.'medias/facility/big/'.$file_id.'/'.$filename;
                                                            $thumbpath	= DOCBASE.'medias/facility/big/'.$file_id.'/'.$filename;
                                                        if ($facility_category == 'sportif'){
                                                            if(is_file($realpath)){ ?>

                                                                        <li>
                                                                        <img alt="<?php echo $facility_name; ?>" title="<?php echo $facility_name; ?>" src="<?php echo $thumbpath; ?>"><?php echo $facility_name; ?>
                                                                    </li>
                                                                        <?php
                                                            }
                                                        }
                                                    }

                                                    }
                                                } ?>
                                                </ul>
                                            </div>
                                            <div class="list-single-main-item-title fl-wrap">
                                                <h3>Kulüpler</h3>
                                            </div>
                                            <div class="listing-features fl-wrap">
                                                <ul>
                                                <?php
                                                $result_facility = $db->query('SELECT * FROM pm_facility WHERE lang = '.LANG_ID.' AND id IN('.$hotel['facilities'].') ORDER BY id',PDO::FETCH_ASSOC);
                                                if($result_facility !== false && $db->last_row_count() > 0){
                                                    foreach($result_facility as $i => $row){
                                                        $facility_id 	= $row['id'];
                                                        $facility_name  = $row['name'];
                                                        $facility_category  = $row['category'];

                                                        $result_facility_file = $db->query('SELECT * FROM pm_facility_file WHERE id_item = '.$facility_id.' AND checked = 1 AND lang = '.DEFAULT_LANG.' AND type = \'image\' AND file != \'\' ORDER BY rank LIMIT 1',PDO::FETCH_ASSOC);
                                                        if($result_facility_file !== false && $db->last_row_count() == 1){
                                                            $row = $result_facility_file->fetch();

                                                            $file_id 	= $row['id'];
                                                            $filename 	= $row['file'];
                                                            $label	 	= $row['label'];

                                                            $realpath	= SYSBASE.'medias/facility/big/'.$file_id.'/'.$filename;
                                                            $thumbpath	= DOCBASE.'medias/facility/big/'.$file_id.'/'.$filename;
                                                        if ($facility_category == 'kulupler'){
                                                            if(is_file($realpath)){ ?>

                                                                        <li>
                                                                        <img alt="<?php echo $facility_name; ?>" title="<?php echo $facility_name; ?>" src="<?php echo $thumbpath; ?>"><?php echo $facility_name; ?>
                                                                     </li>
                                                                        <?php
                                                            }
                                                        }
                                                    }

                                                    }
                                                } ?>
                                                </ul>
                                            </div>

                                            <span class="fw-separator"></span>
                                            <div class="list-single-main-item-title no-dec-title fl-wrap">
                                                <h3>Etiketler</h3>
                                            </div>
                                            <div class="list-single-tags tags-stylwrap">

                                            </div>
                                        </div>
                                        <!--   list-single-main-item end -->
                                        <!-- accordion-->
                                        <div class="accordion mar-top">
                                            <a class="toggle act-accordion" href="#"> Neden Bizi Seçmelisiniz?  <span></span></a>
                                            <div class="accordion-inner visible">
                                            <p> <?php echo $hotel['sss1']; ?></p>
                                            </div>
                                            <a class="toggle" href="#">Kurs Merkezimizin Avantajları Nelerdir? <span></span></a>
                                            <div class="accordion-inner">
                                                <p> <?php echo $hotel['sss2']; ?></p>
                                            </div>
                                            <a class="toggle" href="#"> Ödemeler Nasıl Gerçekleşmektedir? <span></span></a>
                                            <div class="accordion-inner">
                                                <p> <?php echo $hotel['sss3']; ?></p>
                                            </div>
                                        </div>
                                        <!-- accordion end -->
                                        <!--   list-single-main-item -->
                                        <div class="list-single-main-item fl-wrap" id="sec4">
                                            <div class="list-single-main-item-title fl-wrap">
                                                <h3>Sınıflar</h3>
                                            </div>
                                            <!--   rooms-container -->
                                            <?php
                                                    $id_facility = 0;
                                                    $result_facility_file = $db->prepare('SELECT * FROM pm_facility_file WHERE id_item = :id_facility AND checked = 1 AND lang = '.DEFAULT_LANG.' AND type = \'image\' AND file != \'\' ORDER BY rank LIMIT 1');
                                                    $result_facility_file->bindParam(':id_facility', $id_facility);

                                                    $room_facilities = '0';
                                                    $result_facility = $db->prepare('SELECT * FROM pm_facility WHERE lang = '.LANG_ID.' AND FIND_IN_SET(id, :room_facilities) ORDER BY rank LIMIT 8');
                                                    $result_facility->bindParam(':room_facilities', $room_facilities);

                                                    $id_room = 0;
                                                    $result_rate = $db->prepare('SELECT MIN(price) as price FROM pm_rate WHERE id_room = :id_room');
                                                    $result_rate->bindParam(':id_room', $id_room);

                                                    $result_room_file = $db->prepare('SELECT * FROM pm_room_file WHERE id_item = :id_room AND checked = 1 AND lang = '.LANG_ID.' AND type = \'image\' AND file != \'\' ORDER BY rank');
                                                    $result_room_file->bindParam(':id_room', $id_room, PDO::PARAM_STR);

                                                    $result_room = $db->query('SELECT * FROM pm_room WHERE id_hotel = '.$hotel_id.' AND checked = 1 AND lang = '.LANG_ID.' ORDER BY rank', PDO::FETCH_ASSOC);
                                                    if($result_room !== false && $db->last_row_count() > 0){ ?>


                                                        <?php
                                                        foreach($result_room as $i => $row){
                                                            $id_room = $row['id'];
                                                            $room_title = $row['title'];
                                                            $room_subtitle = $row['subtitle'];
                                                            $room_descr = $row['descr'];
                                                            $room_alias = $row['alias'];
                                                            $room_facilities = $row['facilities'];
                                                            $max_people = $row['max_people'];
                                                            $room_price = $row['price'];
                                             ?>
                                            <div class="rooms-container fl-wrap">
                                                <!--  rooms-item -->

                                                <div class="rooms-item fl-wrap">
                                                <?php
                                            $result_room_file->execute();
                                            if($result_room_file !== false && $db->last_row_count() > 0){
                                                $row = $result_room_file->fetch(PDO::FETCH_ASSOC);

                                                $file_id = $row['id'];
                                                $filename = $row['file'];
                                                $label = $row['label'];

                                                $realpath = SYSBASE.'medias/room/small/'.$file_id.'/'.$filename;
                                                $thumbpath = DOCBASE.'medias/room/small/'.$file_id.'/'.$filename;

                                                if(is_file($realpath)){ ?>
                                                    <div class="rooms-media">
                                                        <img src="<?php echo $thumbpath; ?>" alt="">
                                                        <div class="dynamic-gal more-photos-button" data-dynamicPath="[{'src': '<?php echo $thumbpath; ?>'}]">  View Gallery <span>3 photos</span> <i class="far fa-long-arrow-right"></i></div>
                                                    </div>
                                                <?php }
                                                } ?>
                                                    <div class="rooms-details">
                                                        <div class="rooms-details-header fl-wrap">
                                                            <?php
                                                            $min_price = $room_price;
                                                            if($result_rate->execute() !== false && $db->last_row_count() > 0){
                                                                $row = $result_rate->fetch();
                                                                $price = $row['price'];
                                                                if($price > 0) $min_price = $price;
                                                            } ?>
                                                            <span class="rooms-price"> <?php echo formatPrice($min_price*CURRENCY_RATE); ?> <strong> / Yıllık</strong></span>
                                                            <h3><?php echo $room_title; ?></h3>

                                                        </div>
                                                        <p><?php echo $room_descr; ?></p>
                                                        <div class="facilities-list fl-wrap">
                                                            <ul>
                                                                <li><i class="fal fa-wifi"></i><span>Free WiFi</span></li>
                                                                <li><i class="fal fa-bath"></i><span>1 Bathroom</span></li>
                                                                <li><i class="fal fa-snowflake"></i><span>Air conditioner</span></li>
                                                                <li><i class="fal fa-tv"></i><span> Tv Inside</span></li>
                                                                <li><i class="fas fa-concierge-bell"></i><span>Breakfast</span></li>
                                                            </ul>
                                                            <a  href="<?php echo getFromTemplate('common/booking-ajax.php', true); ?>"  data-params="room=<?php echo $id_room; ?>" class="btn color-bg ajax-popup-link">Detay<i class="fas fa-caret-right"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--  rooms-item end -->
                                                <!--  rooms-item -->

                                            </div>
                                            <?php
                                                    }
                                                } ?>
                                           <!--   rooms-container end -->
                                        </div>
                                        <!-- list-single-main-item end -->
                                        <!-- list-single-main-item -->
                                        <?php
                                                $nb_comments = 0;
                                                $item_type = 'hotel';
                                                $item_id = $hotel_id;
                                                $allow_comment = ALLOW_COMMENTS;
                                                $allow_rating = ALLOW_RATINGS;
                                                if($allow_comment == 1){
                                                    $result_comment = $db->query('SELECT * FROM pm_comment WHERE id_item = '.$item_id.' AND item_type = \''.$item_type.'\' AND checked = 1 ORDER BY add_date DESC');
                                                    if($result_comment !== false)
                                                        $nb_comments = $db->last_row_count();
                                                } ?>


                                        <!-- list-single-main-item end -->
                                        <!-- list-single-main-item -->
                                        <div class="list-single-main-item fl-wrap" id="sec6">
                                            <div class="list-single-main-item-title fl-wrap">

                                                <h3>Yorum Yap</h3>
                                            </div>
                                            <!-- Add Review Box -->
                                            <?php
                                            if($allow_comment == 1 && $result_comment !== false && $item_id > 0 && isset($item_type)){
                                            ?>
                                            <div id="add-review" class="add-review-box">
                                                <!-- Review Comment -->
                                                <form id="add-comment" class="add-comment  custom-form"   action="<?php echo DOCBASE.$page_alias; ?>" name="rangeCalc" >
                                                    <fieldset>
                                                        <div class="review-score-form fl-wrap">
                                                            <div class="review-range-container">
                                                                <!-- review-range-item-->
                                                                <div class="review-range-item">
                                                                    <div class="range-slider-title">Temizlik</div>
                                                                    <div class="range-slider-wrap ">
                                                                        <input type="text" class="rate-range" data-min="0" data-max="5"  name="rgcl"  data-step="1" value="4">
                                                                    </div>
                                                                </div>
                                                                <!-- review-range-item end -->
                                                                <!-- review-range-item-->
                                                                <div class="review-range-item">
                                                                    <div class="range-slider-title">Ulaşım</div>
                                                                    <div class="range-slider-wrap ">
                                                                        <input type="text" class="rate-range" data-min="0" data-max="5"  name="rgcl"  data-step="1"  value="1">
                                                                    </div>
                                                                </div>
                                                                <!-- review-range-item end -->
                                                                <!-- review-range-item-->
                                                                <div class="review-range-item">
                                                                    <div class="range-slider-title">Öğretmenler</div>
                                                                    <div class="range-slider-wrap ">
                                                                        <input type="text" class="rate-range" data-min="0" data-max="5"  name="rgcl"  data-step="1" value="5" >
                                                                    </div>
                                                                </div>
                                                                <!-- review-range-item end -->
                                                                <!-- review-range-item-->
                                                                <div class="review-range-item">
                                                                    <div class="range-slider-title">Faaliyetler</div>
                                                                    <div class="range-slider-wrap">
                                                                        <input type="text" class="rate-range" data-min="0" data-max="5"  name="rgcl"  data-step="1" value="3">
                                                                    </div>
                                                                </div>
                                                                <!-- review-range-item end -->
                                                            </div>
                                                            <div class="review-total">
                                                                <span><input type="text" name="rg_total" name="rating" data-form="AVG({rgcl})" value="0"></span>
                                                                <strong>Puan</strong>
                                                            </div>
                                                        </div>
                                                        <div class="row">

                                                        <input type="hidden" name="item_type" value="<?php echo $item_type; ?>">
                                                        <input type="hidden" name="item_id" value="<?php echo $item_id; ?>">
                                                            <div class="col-md-6">
                                                                <label><i class="fal fa-user"></i></label>
                                                                <input name="name" type="text" placeholder="Adınız Soyadınız *" value="<?php echo htmlentities($name, ENT_QUOTES, "UTF-8"); ?>"/>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label><i class="fal fa-envelope"></i>  </label>
                                                                <input type="text" name="email" placeholder="Email*" value="<?php echo htmlentities($email, ENT_QUOTES, "UTF-8"); ?>"/>
                                                            </div>
                                                        </div>
                                                        <textarea cols="40" rows="3" name="msg"  placeholder="Yorumunuz:" value="<?php echo htmlentities($msg, ENT_QUOTES, "UTF-8"); ?>"></textarea>
                                                    </fieldset>
                                                     <?php
                                                    if(CAPTCHA_PKEY != '' && CAPTCHA_SKEY != ''){ ?>
                                                        <div class="form-group">
                                                            <div class="input-group mb5"></div>
                                                            <div class="g-recaptcha" data-sitekey="<?php echo CAPTCHA_PKEY; ?>"></div>
                                                        </div>
                                                        <?php
                                                    }
                                                    ?>
                                                    <button class="btn  big-btn flat-btn float-btn color2-bg" style="margin-top:30px" type="submit" name="send_comment">Yorum Gönder <i class="fal fa-paper-plane"></i></button>
                                                </form>
                                            </div>
                                                <?php }?>
                                            <!-- Add Review Box / End -->
                                        </div>
                                        <!-- list-single-main-item end -->
                                    </div>
                                </div>



                                <!--   datails end  -->

                                <!--   sidebar  -->
                                <div class="col-md-4">
                                    <!--box-widget-wrap -->
                                    <div class="box-widget-wrap">
                                        <!--box-widget-item -->

                                        <!--box-widget-item end -->
                                        <!--box-widget-item -->
                                        <!-- <div class="box-widget-item fl-wrap">
                                            <div class="box-widget counter-widget" data-countDate="09/12/2019">
                                                <div class="banner-wdget fl-wrap">
                                                    <div class="overlay"></div>
                                                    <div class="bg"  data-bg="images/bg/1.jpg"></div>
                                                    <div class="banner-wdget-content fl-wrap">
                                                        <h4>Get a discount <span>20%</span> when ordering a room from three days.</h4>
                                                        <div class="countdown fl-wrap">
                                                            <div class="countdown-item">
                                                                <span class="days rot">00</span>
                                                                <p>days</p>
                                                            </div>
                                                            <div class="countdown-item">
                                                                <span class="hours rot">00</span>
                                                                <p>hours </p>
                                                            </div>
                                                            <div class="countdown-item">
                                                                <span class="minutes rot">00</span>
                                                                <p>minutes </p>
                                                            </div>
                                                            <div class="countdown-item">
                                                                <span class="seconds rot">00</span>
                                                                <p>seconds</p>
                                                            </div>
                                                        </div>
                                                        <a href="#">Book Now</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> -->
                                        <!--box-widget-item end -->
                                        <!--box-widget-item -->
                                        <div class="box-widget-item fl-wrap">
                                            <div class="box-widget">
                                                <div class="box-widget-content">
                                                    <div class="box-widget-item-header">
                                                        <h3> İletişim Bilgileri</h3>
                                                    </div>
                                                    <div class="box-widget-list">
                                                        <ul>
                                                            <li><span><i class="fal fa-map-marker"></i> Adress :</span> <a href="#"><?php echo $hotel['address']; ?></a></li>
                                                            <li><span><i class="fal fa-phone"></i> Phone :</span> <a href="#"><?php echo $hotel['phone']; ?></a></li>
                                                            <li><span><i class="fal fa-envelope"></i> Mail :</span> <a href="#"><?php echo $hotel['email']; ?></a></li>
                                                            <li><span><i class="fal fa-browser"></i> Website :</span> <a href="#"><?php echo $hotel['web']; ?></a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="list-widget-social">
                                                        <ul>
                                                            <li><a href="#" target="_blank" ><i class="fab fa-facebook-f"></i></a></li>
                                                            <li><a href="#" target="_blank"><i class="fab fa-twitter"></i></a></li>
                                                            <li><a href="#" target="_blank" ><i class="fab fa-vk"></i></a></li>
                                                            <li><a href="#" target="_blank" ><i class="fab fa-instagram"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--box-widget-item end -->
                                        <!--box-widget-item -->
                                        <div class="box-widget-item fl-wrap">
                                            <div class="box-widget">
                                                <div class="box-widget-content">
                                                    <div class="box-widget-item-header">
                                                        <h3> Fiyat Aralığı </h3>
                                                    </div>
                                                    <?php
                                                        if(isset($db) && $db !== false){


                                                            $result_rate = $db->prepare('SELECT MIN(price) as min_price FROM pm_rate WHERE id_hotel = :id_hotel');
                                                            $result_rate->bindParam(':id_hotel', $id_hotel);

                                                            $result_rate2 = $db->prepare('SELECT MAX(price) as max_price FROM pm_rate WHERE id_hotel = :id_hotel');
                                                            $result_rate2->bindParam(':id_hotel', $id_hotel);
                                                    ?>
                                                    <div class="claim-price-wdget fl-wrap">
                                                    <?php
                                                        $min_price = 0;
                                                        if($result_rate->execute() !== false && $db->last_row_count() > 0){
                                                            $row = $result_rate->fetch();
                                                            $price = $row['min_price'];
                                                            if($price > 0) $min_price = $price;

                                                        }
                                                        $max_price = 0;
                                                        if($result_rate2->execute() !== false && $db->last_row_count() > 0){
                                                            $row = $result_rate2->fetch();
                                                            $price = $row['max_price'];
                                                            if($price > 0) $min_price = $price;
                                                        }
                                                    ?>
                                                        <div class="claim-price-wdget-content fl-wrap">
                                                            <div class="pricerange fl-wrap"><span>Fiyat : </span> <?php echo formatPrice($min_price*CURRENCY_RATE).'-'.formatPrice($max_price*CURRENCY_RATE); ?> </div>

                                                        </div>
                                                    <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--box-widget-item end -->
                                        <!--box-widget-item -->
                                        <div class="box-widget-item fl-wrap">
                                            <div id="weather-widget" class="gradient-bg ideaboxWeather" data-city="New York"></div>
                                        </div>
                                        <!--box-widget-item end -->
                                        <!--box-widget-item end -->
                                        <!--box-widget-item -->
                                        <div class="box-widget-item fl-wrap">
                                            <div class="box-widget widget-posts">
                                                <div class="box-widget-content">
                                                    <div class="box-widget-item-header">
                                                        <h3>Popüler Kurs Merkezleri</h3>
                                                    </div>
                                                    <!--box-image-widget-->
                                                    <?php

                                                    function deneme($lat1, $lon1, $lat2, $lon2, $unit) {
                                                        if (($lat1 == $lat2) && ($lon1 == $lon2)) {
                                                            return 0;
                                                        }
                                                        else {
                                                            $theta = $lon1 - $lon2;
                                                            $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
                                                            $dist = acos($dist);
                                                            $dist = rad2deg($dist);
                                                            $miles = $dist * 60 * 1.1515;
                                                            $unit = strtoupper($unit);

                                                            if ($unit == "K") {
                                                            return ($miles * 1.609344);
                                                            } else if ($unit == "N") {
                                                            return ($miles * 0.8684);
                                                            } else {
                                                            return $miles;
                                                            }
                                                        }
                                                    }
                                                    $lz_offset = 1;
                                                    $lz_limit = 9;
                                                    $lz_pages = 0;
                                                    $num_records = 0;
                                                    $result = $db->query("SELECT count(*) FROM pm_hotel WHERE checked = 1 AND lang = ".LANG_ID);
                                                    if($result !== false){
                                                        $num_records = $result->fetchColumn(0);
                                                        $lz_pages = ceil($num_records/$lz_limit);
                                                    }
                                                    if($num_records > 0){
                                                        if(isset($db) && $db !== false){

                                                            $my_page_alias = $sys_pages['hotels']['alias'];

                                                            $query_hotel = 'SELECT * FROM pm_hotel WHERE lang = '.LANG_ID.' AND checked = 1 AND populer = 1';
                                                            if(isset($destination_id)) $query_hotel .= ' AND id_destination = '.$db->quote($destination_id);
                                                            if(isset($schoollevel_id)) $query_hotel .= ' AND id_schoollevel = '.$db->quote($schoollevel_id);
                                                            $query_hotel .= ' ORDER BY rank LIMIT '.($lz_offset-1)*$lz_limit.', '.$lz_limit;
                                                            $result_hotel = $db->query($query_hotel);

                                                            $id_hotel = 0;

                                                            $result_hotel_file = $db->prepare('SELECT * FROM pm_hotel_file  WHERE id_item = :id_hotel AND checked = 1 AND lang = '.LANG_ID.' AND type = \'image\' AND file != \'\' ORDER BY rank LIMIT 1');
                                                            $result_hotel_file->bindParam(':id_hotel', $id_hotel);

                                                            $result_rate = $db->prepare('SELECT MIN(price) as min_price FROM pm_rate WHERE id_hotel = :id_hotel');
                                                            $result_rate->bindParam(':id_hotel', $id_hotel);

                                                            foreach($result_hotel as $i => $row){

                                                                $id_hotel = $row['id'];
                                                                $hotel_title = $row['title'];
                                                                $hotel_subtitle = $row['subtitle'];
                                                                $hotel_alias = $row['alias'];
                                                                $hotel_lat = $row['lat'];
                                                                $hotel_lng = $row['lng'];
                                                                $hotel_address = $row['id_destination'];
                                                                $hotel_state = $row['state'];
                                                                $hotel_descr = $row['descr'];


                                                                $hotel_alias = DOCBASE.$my_page_alias.'/'.text_format($hotel_alias);


                                                                $lat1=$_COOKIE["lat1"];
                                                                $lon1=$_COOKIE["lon1"];
                                                                $lat2=$hotel_lat;
                                                                $lon2=$hotel_lng;
                                                                $location_echo = round(deneme($lat1, $lon1, $lat2, $lon2, "K"),0);?>

                                                            <div class="box-image-widget">
                                                            <?php
                                                            if($result_hotel_file->execute() !== false && $db->last_row_count() > 0){
                                                                $row = $result_hotel_file->fetch(PDO::FETCH_ASSOC);

                                                                $file_id = $row['id'];
                                                                $filename = $row['file'];
                                                                $label = $row['label'];

                                                                $realpath = SYSBASE.'medias/hotel/medium/'.$file_id.'/'.$filename;
                                                                $thumbpath = DOCBASE.'medias/hotel/medium/'.$file_id.'/'.$filename;
                                                                $zoompath = DOCBASE.'medias/hotel/big/'.$file_id.'/'.$filename;

                                                                if(is_file($realpath)){ ?>
                                                                <div class="box-image-widget-media"><img src="<?php echo $thumbpath ?>" alt="">
                                                                    <a href="<?php echo $hotel_alias ?>" class="color2-bg" target="_blank">Detay</a>
                                                                </div>
                                                                <?php }
                                                                } ?>
                                                                <div class="box-image-widget-details">
                                                                    <h4><?php echo $hotel_title ?> <span><?php echo $location_echo.'km yakınında'; ?></span></h4>

                                                                </div>
                                                            </div>
                                                        <?php }
                                                        }
                                                    }?>
                                                    <!--box-image-widget end -->
                                                    <!--box-image-widget-->
                                                </div>
                                            </div>
                                        </div>
                                        <!--box-widget-item end -->
                                        <!--box-widget-item -->

                                        <!--box-widget-item end -->
                                        <!--box-widget-item -->
                                        <!--box-widget-item end -->
                                    </div>
                                    <!--box-widget-wrap end -->
                                </div>
                                <!--   sidebar end  -->
                            </div>
                            <!--   row end  -->
                        </div>
                        <!--   container  end  -->
                    </section>
                    <!--  section  end-->
                </div>
                <!-- content end-->
                <div class="limit-box fl-wrap"></div>
            </div>



</section>
