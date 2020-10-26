<?php
if($article_alias == '') err404();

$result = $db->query('SELECT * FROM pm_schoollevel WHERE checked = 1 AND lang = '.LANG_ID.' AND alias = '.$db->quote($article_alias));
if($result !== false && $db->last_row_count() > 0){
    
    $schoollevel = $result->fetch(PDO::FETCH_ASSOC);
    
    $schoollevel_id = $schoollevel['id'];
    $article_id = $schoollevel_id;
    $title_tag = $schoollevel['name'].' - '.$title_tag;
    $page_title = $schoollevel['name'];
    $page_subtitle = '';
    $page_alias = $pages[$page_id]['alias'].'/'.text_format($schoollevel['alias']);
    
   
    

check_URI(DOCBASE.$page_alias);

/* ==============================================
 * CSS AND JAVASCRIPT USED IN THIS MODEL
 * ==============================================
 */
$javascripts[] = DOCBASE.'js/plugins/jquery.sharrre-1.3.4/jquery.sharrre-1.3.4.min.js';

$stylesheets[] = array('file' => '//cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.0.0-beta.2.4/assets/owl.carousel.min.css', 'media' => 'all');
$stylesheets[] = array('file' => '//cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.0.0-beta.2.4/assets/owl.theme.default.min.css', 'media' => 'all');
$javascripts[] = '//cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.0.0-beta.2.4/owl.carousel.min.js';

$stylesheets[] = array('file' => DOCBASE.'js/plugins/isotope/css/style.css', 'media' => 'all');
$javascripts[] = '//cdnjs.cloudflare.com/ajax/libs/jquery.isotope/1.5.25/jquery.isotope.min.js';
$javascripts[] = DOCBASE.'js/plugins/isotope/jquery.isotope.sloppy-masonry.min.js';

$stylesheets[] = array('file' => DOCBASE.'js/plugins/lazyloader/lazyloader.css', 'media' => 'all');
$javascripts[] = DOCBASE.'js/plugins/lazyloader/lazyloader.js';

$stylesheets[] = array('file' => '//cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/3.5.5/css/star-rating.min.css', 'media' => 'all');
$javascripts[] = '//cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/3.5.5/js/star-rating.min.js';

$stylesheets[] = array('file' => DOCBASE.'js/plugins/simpleweather/css/simpleweather.css', 'media' => 'all');
$javascripts[] = '//cdn.rawgit.com/monkeecreate/jquery.simpleWeather/master/jquery.simpleWeather.min.js';

require(getFromTemplate('common/send_comment.php', false));

require(getFromTemplate('common/header.php', false)); ?>

<article id="page">
    <?php include(getFromTemplate('common/page_header.php', false)); ?>
    
    <div id="content" class="pt30 pb30">
        <div class="container">
            
            <div class="alert alert-success" style="display:none;"></div>
            <div class="alert alert-danger" style="display:none;"></div>
            
            <div class="row">
                <div class="col-md-8 mb20">
                    <div class="row mb10">
                        <div class="col-sm-12">
                            <h1 class="mb0">
                                <?php echo $schoollevel['name']; ?>
                                <br><small><?php echo $schoollevel['subtitle']; ?></small>
                            </h1>
                        </div>
                    </div>
                    <div class="row mb10">
                        <div class="col-md-12">
                            <div class="owl-carousel owlWrapper" data-items="1" data-autoplay="false" data-dots="true" data-nav="false" data-rtl="<?php echo (RTL_DIR) ? 'true' : 'false'; ?>">
                                <?php
                                if(!empty($schoollevel['video'])){ ?>
                                    <div class="video-container">
                                        <iframe src="<?php echo $schoollevel['video']; ?>" frameborder="0"></iframe>
                                    </div>
                                    <?php
                                }
                                
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="row mb10">
                        <div class="col-md-12" itemprop="description">
                            <?php echo $schoollevel['text']; ?>
                        </div>
                    </div>
                </div>
                <aside class="col-md-4 mb20">
                    <div class="boxed">
                        <div itemscope itemtype="http://schema.org/Corporation">
                            <h3 itemprop="name"><?php echo $schoollevel['name']; ?></h3>
                            <span class="simple-weather" data-location="<?php echo $schoollevel['name']; ?>" data-unit="c"></span>
                        </div>
                        <script type="text/javascript">
                            var locations = [
                                ['<?php echo $schoollevel['name']; ?>']
                            ];
                        </script>
                        <div id="mapWrapper" class="mb30" data-marker="<?php echo getFromTemplate('images/marker.png'); ?>" data-api_key="<?php echo GMAPS_API_KEY; ?>"></div>
                        
                        <?php
                        $id_schoollevel = 0;
                       
                        $result_schoollevel = $db->query('SELECT * FROM pm_schoollevel WHERE id != '.$schoollevel_id.' AND checked = 1 AND lang = '.LANG_ID.' ORDER BY rand() LIMIT 5', PDO::FETCH_ASSOC);
                        if($result_schoollevel !== false && $db->last_row_count() > 0){
                            foreach($result_schoollevel as $i => $row){
                                $id_schoollevel = $row['id'];
                                $schoollevel_name = $row['name'];
                                $schoollevel_alias = $row['alias']; ?>
                                
                                <a href="<?php echo DOCBASE.$page['alias'].'/'.text_format($schoollevel_alias); ?>">
                                   ?>
                                        </div>
                                        <div class="col-xs-8">
                                            <h3 class="mb0"><?php echo $schoollevel_name; ?></h3>
                                           
                                        </div>
                                    </div>
                                </a>
                                <?php
                            } ?>
                            <?php
                        } ?>
                    </div>
                </aside>
            </div>
            <div class="row">
                <?php
                $lz_offset = 1;
                $lz_limit = 9;
                $lz_pages = 0;
                $num_records = 0;
                $hotel_ids = array();
                $result = $db->query('SELECT id FROM pm_hotel WHERE checked = 1 AND lang = '.LANG_ID.' AND id_schoollevel = '.$schoollevel_id);
                if($result !== false){
                    $hotel_ids = $result->fetchAll(PDO::FETCH_COLUMN);
                    $num_records = count($hotel_ids);
                    $lz_pages = ceil($num_records/$lz_limit);
                }
                if($num_records > 0){ ?>
                    <div class="col-md-12">
                        <h2><?php echo $schoollevel['name'].' - '.$num_records.' '.getAltText($texts['HOTEL'], $texts['HOTELS'], $num_records); ?></h2>
                    </div>
                    <div class="clearfix"></div>
                    <div class="isotopeWrapper clearfix isotope lazy-wrapper" data-loader="<?php echo getFromTemplate('common/get_hotels.php'); ?>" data-mode="click" data-limit="<?php echo $lz_limit; ?>" data-pages="<?php echo $lz_pages; ?>" data-more_caption="<?php echo $texts['LOAD_MORE']; ?>" data-is_isotope="true" data-variables="schoollevel=<?php echo $schoollevel_id; ?>">
                        <?php include(getFromTemplate('common/get_hotels.php', false)); ?>
                    </div>
                    <?php
                } ?>
            </div>
            <div class="row">
                <?php
                $lz_offset = 1;
                $lz_limit = 9;
                $lz_pages = 0;
                $num_records = 0;
                $hotel_ids = implode('|', $hotel_ids);
                $result = $db->query('SELECT count(*) FROM pm_activity WHERE checked = 1 AND lang = '.LANG_ID.' AND hotels REGEXP \'[[:<:]]'.$hotel_ids.'[[:>:]]\'');
                if($result !== false){
                    $num_records = $result->fetchColumn(0);
                    $lz_pages = ceil($num_records/$lz_limit);
                }
                if($num_records > 0){ ?>
                    <div class="col-md-12">
                        <h2><?php echo $schoollevel['name'].' - '.$num_records.' '.getAltText($texts['ACTIVITY'], $texts['ACTIVITIES'], $num_records); ?></h2>
                    </div>
                    <div class="clearfix"></div>
                    <div class="isotopeWrapper clearfix isotope lazy-wrapper" data-loader="<?php echo getFromTemplate('common/get_activities.php'); ?>" data-mode="click" data-limit="<?php echo $lz_limit; ?>" data-pages="<?php echo $lz_pages; ?>" data-more_caption="<?php echo $texts['LOAD_MORE']; ?>" data-is_isotope="true" data-variables="page_id=<?php echo $page_id; ?>&page_alias=<?php echo $page['alias']; ?>&hotels=<?php echo $hotel_ids; ?>">
                        <?php include(getFromTemplate('common/get_activities.php', false)); ?>
                    </div>
                    <?php
                } ?>
            </div>
        </div>
    </div>
</article>
