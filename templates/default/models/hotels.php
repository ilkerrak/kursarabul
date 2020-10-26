<?php
$stylesheets[] = array("file" => DOCBASE."js/plugins/isotope/css/style.css", "media" => "all");
$javascripts[] = DOCBASE."js/plugins/isotope/jquery.isotope.min.js";
$javascripts[] = DOCBASE."js/plugins/isotope/jquery.isotope.sloppy-masonry.min.js";

$stylesheets[] = array("file" => DOCBASE."js/plugins/lazyloader/lazyloader.css", "media" => "all");
$javascripts[] = DOCBASE."js/plugins/lazyloader/lazyloader.js";


require(getFromTemplate("common/header.php", false)); ?>
<script type="text/javascript" src="http://code.jquery.com/ui/1.10.1/jquery-ui.min.js"></script>

<script>
        $(function(){

            var $search = $('#autocompleteid3');

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
    
            <style>
                
                .ui-autocomplete li a span{
                    
                    cursor:pointer;
                    background-color:#fff;
                    font-size:13px;
                    float:left;
                    
                }
                .ui-autocomplete li a span.state{
                   
                    margin-left:20px;
                }
                .ui-autocomplete li a span.username{
                    font-size:15px;
                    float:left;
                    
                }
                .ui-autocomplete li a span.icon{
                    font-size:15px;
                    float:left;
                    color:orange;
                    
                }
                
                
                
            
            
            </style>
                <!-- content-->
                <div class="content">
                    <!--  section  -->
                    <section class="parallax-section single-par" data-scrollax-parent="true">
                        <div class="bg par-elem "  data-bg="/medias/slide/big/7/res1.jpg"></div>
                        <div class="overlay"></div>
                        <div class="container">
                            <div class="section-title center-align big-title">
                                <div class="section-title-separator"><span></span></div>
                                <h2><span>Kurs Merkezleri</span></h2>
                                <span class="section-separator"></span>
                               
                            </div>
                        </div>
                        <div class="header-sec-link">
                            <div class="container"><a href="#sec1" class="custom-scroll-link color-bg"><i class="fal fa-angle-double-down"></i></a></div>
                        </div>
                    </section>
                    <?php
                    if($article_id == 0){
                        $page_title = $page['title'];
                        $page_subtitle = $page['subtitle'];
                        $page_name = $page['name']; ?>
                        
                        <?php
                    }
                    ?>
                   
                    
                    <?php
                    foreach($breadcrumbs as $id_parent){
                        if(isset($pages[$id_parent])){
                            $parent = $pages[$id_parent]; ?>
                            <a href="<?php echo DOCBASE.$parent['alias']; ?>" title="<?php echo $parent['title']; ?>"><?php echo $parent['name']; ?></a>
                            <?php
                        }
                    }
                    if($article_id > 0){ ?>
                        <a href="<?php echo DOCBASE.$page['alias']; ?>" title="<?php echo $page['title']; ?>"><?php echo $page['name']; ?></a>
                        <?php
                    } ?>
                    <!--  section  end-->
                    <div class="breadcrumbs-fs fl-wrap">
                        <div class="container">
                            

                            <div class="breadcrumbs fl-wrap"><a href="<?php echo DOCBASE.trim(LANG_ALIAS, "/"); ?>" title="<?php echo $homepage['title']; ?>"><?php echo $homepage['name']; ?></a><a href="<?php echo DOCBASE.$page['alias']; ?>"><?php echo $page_name; ?></a></div>
                        </div>
                    </div>
                    <!--  section-->
                    <section class="grey-blue-bg small-padding" id="sec1">
                        <div class="container">
                            <div class="row">
                                <!--filter sidebar -->
                                <div class="col-md-4">
                                    <div class="mobile-list-controls fl-wrap">
                                        <div class="mlc show-list-wrap-search fl-wrap"><i class="fal fa-filter"></i> Filter</div>
                                    </div>
                                    <div class="fl-wrap filter-sidebar_item fixed-bar">
                                    
                                        <div class="filter-sidebar fl-wrap lws_mobile">
                                        <form action="<?php echo DOCBASE.$sys_pages['booking']['alias']; ?>" method="post" class="booking-search">
                                        <?php
                                                    if(isset($hotel_id)){ ?>
                                                        <input type="hidden" name="hotel_id" value="<?php echo $hotel_id; ?>">
                                                        <?php
                                                    } ?>
                                            <div class="col-list-search-input-item fl-wrap location autocomplete-container">
                                                <label>Kurs Merkezi</label>
                                                <span class="header-search-input-item-icon"><i class="fal fa-school"></i></span>
                                                <input type="text" placeholder="Aradığınız Kurs Merkezini Giriniz" class="autocomplete-input pac-target-input" id="autocompleteid3" value=""/>
                                                
                                            </div>
                                            <?php
                                            $nb_search_destinations = 0;
                                            $result_search_destination = $db->query('SELECT * FROM pm_destination WHERE checked = 1 AND lang = '.LANG_ID);
                                            if($result_search_destination !== false){
                                                $nb_search_destinations = $db->last_row_count();
                                                if($nb_search_destinations > 0){ ?>
                                            <!--col-list-search-input-item -->
                                            <div class="col-list-search-input-item in-loc-dec fl-wrap not-vis-arrow">
                                                <label>Şehir</label>
                                                <?php
                                                        $result_search_destination = $result_search_destination->fetchAll(PDO::FETCH_ASSOC);
                                                        if(count($result_search_destination) > 10){ ?>
                                                        <input type="text" name="destination_name"  class="autocomplete-input" data-wrapper="result-destinations" data-target="destination_id" data-url="<?php echo getFromTemplate('common/search_destinations.php'); ?>" value="<?php echo $destination_name; ?>" placeholder="<?php echo $texts['DESTINATION']; ?>"  value=""/>
                                                        <input type="hidden" name="destination_id" id="destination_id" value="<?php echo $_SESSION['destination_id']; ?>">
                                                            <?php
                                                        }else{
                                                            ?>
                                                <div class="listsearch-input-item">
                                                
                                                    <select data-placeholder="City" name="destination_id"class="chosen-select" >
                                                    <option value="0"><?php echo 'Şehirler'; ?></option>
                                                    <?php
                                                        foreach($result_search_destination as $row){
                                                            $selected = (isset($_SESSION['destination_id']) && $_SESSION['destination_id'] == $row['id']) ? ' selected="selected"' : '';
                                                            echo '<option value="'.$row['id'].'"'.$selected.'>'.$row['name'].'</option>';
                                                        } 
                                                    ?>
                                                    </select>
                                                </div>
                                                <?php }
                                                    ?>
                                            </div>
                                                    <?php }
                                                    }?>
                                            <!--col-list-search-input-item end-->                      
                                            <!--col-list-search-input-item -->
                                            
                                            <!--col-list-search-input-item end-->
                                            <!--col-list-search-input-item -->
                                            <?php
                                            $nb_search_schoollevels = 0;
                                            $result_search_schoollevel = $db->query('SELECT * FROM pm_schoollevel WHERE checked = 1 AND lang = '.LANG_ID);
                                            if($result_search_schoollevel !== false){
                                                $nb_search_schoollevels = $db->last_row_count();
                                                if($nb_search_schoollevels > 0){ ?>
                                            <div class="col-list-search-input-item in-loc-dec date-container  fl-wrap">
                                                <label>Okul düzeyi </label>
                                                <?php
                                                         $result_search_schoollevel = $result_search_schoollevel->fetchAll(PDO::FETCH_ASSOC);
                                                                if(count($result_search_schoollevel) > 10){ ?>
                                                                                <input type="text" name="schoollevel_name" class="form-control" data-wrapper="result-schoollevels" data-target="schoollevel_id" data-url="<?php echo getFromTemplate('common/search_schoollevels.php'); ?>" value="<?php echo $schoollevel_name; ?>" placeholder="<?php echo $texts['schoollevel']; ?>">
                                                                                <input type="hidden" name="schoollevel_id" id="schoollevel_id" value="<?php echo $_SESSION['schoollevel_id']; ?>">
                                                                                <?php
                                                                            }else{ ?>
                                                <span class="header-search-input-item-icon"><i class="fal fa-calendar-check"></i></span>
                                                <div class="listsearch-input-item ">
                                                                                <select name="schoollevel_id" class="chosen-select no-search-select">
                                                                                    <option value="0"><?php echo 'Kurs Türleri'; ?></option>
                                                                                    <?php
                                                                                    foreach($result_search_schoollevel as $row){
                                                                                        $selected = (isset($_SESSION['schoollevel_id']) && $_SESSION['schoollevel_id'] == $row['id']) ? ' selected="selected"' : '';
                                                                                        echo '<option value="'.$row['id'].'"'.$selected.'>'.$row['name'].'</option>';
                                                                                    } ?>
                                                                                </select>
                                                                                </div>
                                                                            <?php 
                                                                        
                                                                        }?>
                                            </div>
                                                <?php  }
                                                }?>
                                            <!--col-list-search-input-item end-->
                                            <!--col-list-search-input-item -->
                                            
                                                                                    
                                            <div class="col-list-search-input-item fl-wrap">
                                       
                                            <?php
                                                $result_rate = $db->query('SELECT MAX(price) as max_price FROM pm_rate');
                                                if($result_rate !== false && $db->last_row_count() > 0){
                                                    $row = $result_rate->fetch();
                                                    $max_price = $row['max_price']*($_SESSION['num_children']+$_SESSION['num_adults']);
                                                    if($max_price > 0){
                                                        if(!isset($price_min) || is_null($price_min)) $price_min = 0;
                                                        if(!isset($price_max) || is_null($price_max)) $price_max = $max_price; ?>
                                                <div class="range-slider-title">Fiyat Aralığı (₺)</div>
                                                <div class="nouislider-wrapper">
                                                    <div class="nouislider" data-min="0" data-max="<?php echo number_format(ceil($max_price)*CURRENCY_RATE, 0, '.', ''); ?>" data-start="<?php echo '['.number_format(floor($price_min)*CURRENCY_RATE, 0, '.', '').','.number_format(ceil($price_max)*CURRENCY_RATE, 0, '.', '').']'; ?>" data-step="10" data-direction="<?php echo RTL_DIR; ?>" data-input="price_range"></div>
                                                    <input type="text" name="price_range" class="slider-target" id="price_range" value="" readonly="readonly" size="15">
                                                </div>
                                            </div>
                                                    <?php } 
                                                    }?>
                                            <!--col-list-search-input-item end-->                                        
                                            <!--col-list-search-input-item -->
                                             <div class="col-list-search-input-item fl-wrap">
                                                <label>Puan Aralığı</label>
                                                <div class="search-opt-container fl-wrap">
                                                <?php

                                                    $query = "SELECT * FROM pm_comment WHERE item_type='hotel' AND checked = '1' ORDER BY rating DESC LIMIT 3";
                                                    $statement = $db->prepare($query);
                                                    $statement->execute();
                                                    $result = $statement->fetchAll();
                                                    foreach($result as $row)
                                                    {
                                                    ?>
                                                    <!-- Checkboxes -->
                                                    <ul class="fl-wrap filter-tags">
                                                        <li class="five-star-rating">
                                                            <input id="rating" type="checkbox" name="rating">
                                                            <label for="rating"><span class="listing-rating card-popup-rainingvis" data-starrating2="<?php echo $row['rating']; ?>"><span><?php echo $row['rating'].' Puan'; ?></span></span></label>
                                                        </li>
                                                       
                                                       
                                                    </ul>
                                                    <?php } ?>
                                                    <!-- Checkboxes end -->
                                                </div>
                                            </div>
                                            
                                            <button name="check_availabilities" class="btn    color-bg">Kurs Merkezi Ara<i class="fal fa-caret-right"></i><button>
                                            <!--col-list-search-input-item end-->  
                                            <!--col-list-search-input-item  -->                                         
                                           
                                            <!--col-list-search-input-item end--> 
                                        </form>
                                        </div>
                                    </div>
                                </div>
                              
                               
                                

                                <!--filter sidebar end-->
                                <!--listing -->
                                <div class="col-md-8">
                                    <!--col-list-wrap -->
                                    <div class="col-list-wrap fw-col-list-wrap post-container">
                                        <!-- list-main-wrap-->
                                        <div class="list-main-wrap fl-wrap card-listing">
                                            <div class="listing-item-container init-grid-items fl-wrap">
                                               
                                                <!-- listing-item  -->
                                                    <?php
                                                    $lz_offset = 1;
                                                    $lz_limit = 9;
                                                    $lz_pages = 0;
                                                    $num_records = 0;
                                                    $result = $db->query("SELECT count(*) FROM pm_hotel WHERE checked = 1 AND lang = ".LANG_ID);
                                                    if($result !== false){
                                                        $num_records = $result->fetchColumn(0);
                                                        $lz_pages = ceil($num_records/$lz_limit);
                                                    }
                                                    if($num_records > 0){ ?>
                                                
                                                <?php include(getFromTemplate("common/get_hotels.php", false)); ?>
                                                
                                                    <?php } ?>
                                                <!-- listing-item end -->
                                                <!-- listing-item  -->
                                               
                                            </div>
                                            <!-- listing-item-container end-->
                                            <a class="load-more-button" href="#">Daha Fazla <i class=""></i> </a>
                                        </div>
                                        <!-- list-main-wrap end-->
                                    </div>
                                    <!--col-list-wrap end -->
                                </div>
                                <!--listing  end-->
                            </div>
                            <!--row end-->
                        </div>
                        <div class="limit-box fl-wrap"></div>
                    </section>
                </div>
                
            