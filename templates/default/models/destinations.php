<?php
$stylesheets[] = array('file' => DOCBASE.'js/plugins/isotope/css/style.css', 'media' => 'all');
$javascripts[] = DOCBASE.'js/plugins/isotope/jquery.isotope.min.js';
$javascripts[] = DOCBASE.'js/plugins/isotope/jquery.isotope.sloppy-masonry.min.js';

$stylesheets[] = array('file' => DOCBASE.'js/plugins/lazyloader/lazyloader.css', 'media' => 'all');
$javascripts[] = DOCBASE.'js/plugins/lazyloader/lazyloader.js';

require(getFromTemplate('common/header.php', false)); ?>

<div class="content">
                    <!--  section  -->
                    <section class="parallax-section single-par" data-scrollax-parent="true">
                        <div class="bg par-elem "  data-bg="images/bg/1.jpg"></div>
                        <div class="overlay"></div>
                        <div class="container">
                            <div class="section-title center-align big-title">
                                <div class="section-title-separator"><span></span></div>
                                <h2><span>Şehirler</span></h2>
                                <span class="section-separator"></span>
                                <h4>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut nec tincidunt arcu, sit amet fermentum sem.</h4>
                            </div>
                        </div>
                        <div class="header-sec-link">
                            <div class="container"><a href="#sec1" class="custom-scroll-link color-bg"><i class="fal fa-angle-double-down"></i></a></div>
                        </div>
                    </section>
                    <!--  section  end-->
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
                                
                                <!--filter sidebar end-->
                                <!--listing -->
                                <div class="col-md-12">
                                    <!--col-list-wrap -->
                                    <div class="col-list-wrap fw-col-list-wrap post-container">
                                        <!-- list-main-wrap-->
                                        <div class="list-main-wrap fl-wrap card-listing">
                                            <!-- list-main-wrap-opt-->
                                            <div class="list-main-wrap-opt fl-wrap">
                                                
                                                <!-- price-opt-->
                                               
                                                <!-- price-opt end-->
                                                <!-- price-opt-->
                                               
                                                <!-- price-opt end-->                               
                                            </div>
                                            <!-- list-main-wrap-opt end-->
                                            <!-- listing-item-container -->
                                            <div class="listing-item-container init-grid-items fl-wrap">
                                               
                                                <!-- listing-item  -->
                                                <?php
                                                $lz_offset = 1;
                                                $lz_limit = 9;
                                                $lz_pages = 0;
                                                $num_records = 0;
                                                $result = $db->query('SELECT count(*) FROM pm_destination WHERE checked = 1 AND lang = '.LANG_ID);
                                                if($result !== false){
                                                    $num_records = $result->fetchColumn(0);
                                                    $lz_pages = ceil($num_records/$lz_limit);
                                                }
                                                if($num_records > 0){ ?>
                                                
                                                <?php include(getFromTemplate('common/get_destinations.php', false)); ?>
                                                
                                                    <?php } ?>
                                                <!-- listing-item end -->
                                                <!-- listing-item  -->
                                               
                                            </div>
                                            <!-- listing-item-container end-->
                                            <a class="load-more-button" href="#">Load more <i class="fal fa-spinner"></i> </a>
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

