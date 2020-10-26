<?php
if($article_alias == '') err404();

if($article_id > 0){
    
    $title_tag = $article['title'].' - '.$title_tag;
    $page_title = $article['title'];
    $page_subtitle = $article['subtitle'];
    $page_alias = $article['alias'];
    $publish_date = $article['publish_date'];
    $edit_date = $article['edit_date'];
    $hit = $db->prepare("UPDATE pm_article SET hit= hit +1 WHERE id=$article_id");
    $hit->execute(array($id));
    $hiit = $article['hit'];
    
    if(is_null($publish_date)) $publish_date = $article['add_date'];
    if(is_null($edit_date)) $sedit_date = $publish_date;
    
    $result_article_file = $db->query('SELECT * FROM pm_article_file WHERE id_item = '.$article_id.' AND checked = 1 AND lang = '.DEFAULT_LANG.' AND type = \'image\' AND file != \'\' ORDER BY rank LIMIT 1');
    if($result_article_file !== false && $db->last_row_count() > 0){
        
        $row = $result_article_file->fetch();
        
        $file_id = $row['id'];
        $filename = $row['file'];
        
        if(is_file(SYSBASE.'medias/article/medium/'.$file_id.'/'.$filename))
            $page_img = getUrl(true).DOCBASE.'medias/article/medium/'.$file_id.'/'.$filename;
    }
    
    $result_tag = $db->query('SELECT * FROM pm_tag WHERE id IN ('.$article['tags'].') AND checked = 1 AND lang = '.LANG_ID.' ORDER BY rank');
    if($result_tag !== false){
        $nb_tags = $db->last_row_count();
        
        $article_tags = '';
        foreach($result_tag as $i => $row){
            $tag_id = $row['id'];
            $tag_value = $row['value'];

            $article_tags .= $tag_value;
            if($i+1 < $nb_tags) $article_tags .= ', ';
        }
    }
    
}else err404();

check_URI(DOCBASE.$page_alias);

/* ==============================================
 * CSS AND JAVASCRIPT USED IN THIS MODEL
 * ==============================================
 */
$javascripts[] = DOCBASE.'js/plugins/sharrre/jquery.sharrre.min.js';

$stylesheets[] = array('file' => '//cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.0.0-beta.2.4/assets/owl.carousel.min.css', 'media' => 'all');
$stylesheets[] = array('file' => '//cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.0.0-beta.2.4/assets/owl.theme.default.min.css', 'media' => 'all');
$javascripts[] = '//cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.0.0-beta.2.4/owl.carousel.min.js';

$stylesheets[] = array('file' => '//cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/3.5.5/css/star-rating.min.css', 'media' => 'all');
$javascripts[] = '//cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/3.5.5/js/star-rating.min.js';

require(getFromTemplate('common/send_comment.php', false));

require(getFromTemplate('common/header.php', false)); ?>

<article itemscope itemtype="http://schema.org/BlogPosting" itemprop="mainEntity" id="page">
   
    <div id="wrapper">
                <!-- content-->
                <div class="content">
                    <!--  section  -->
                    <section class="color-bg middle-padding ">
                        <div class="wave-bg wave-bg2"></div>
                        <div class="container">
                            <div class="flat-title-wrap">
                                <h2><span><?php echo $page_title ?></span></h2>
                                <span class="section-separator"></span>
                                <h4>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut nec tincidunt arcu, sit amet fermentum sem.</h4>
                            </div>
                        </div>
                    </section>
                    <!--  section  end-->
                    <div class="breadcrumbs-fs fl-wrap">
                        <div class="container">
                            <div class="breadcrumbs fl-wrap"><a href="#">Anasayfa</a><a href="/">Blog</a><span><?php echo $page_title ?></span></div>
                        </div>
                    </div>
                    <!-- section-->
                    <section  id="sec1" class="middle-padding grey-blue-bg">
                        <div class="container">
                            <div class="row">
                                    <?php
                                    $nb_comments = 0;
                                    $item_type = 'article';
                                    $item_id = $article_id;
                                    $allow_comment = $article['comment'];
                                    $allow_rating = $article['rating'];
                                    if($allow_comment == 1){
                                        $result_comment = $db->query('SELECT * FROM pm_comment WHERE id_item = '.$item_id.' AND item_type = \''.$item_type.'\' AND checked = 1 ORDER BY add_date DESC');
                                        if($result_comment !== false)
                                            $nb_comments = $db->last_row_count();
                                    }
                                    ?>
                                <!--blog content -->
                                <div class="col-md-8">
                                    <!--post-container -->
                                    <div class="post-container fl-wrap">
                                        <!-- article> --> 
                                        <article class="post-article">
                                            <div class="list-single-main-media fl-wrap">
                                                <div class="single-slider-wrapper fl-wrap">
                                                <?php 
                                                $result_article_file = $db->query('SELECT * FROM pm_article_file WHERE id_item = '.$article_id.' AND checked = 1 AND lang = '.DEFAULT_LANG.' AND type = \'image\' AND file != \'\' ORDER BY rank');
                                                if($result_article_file !== false){
                                                    
                                                    foreach($result_article_file as $i => $row){
                                                    
                                                        $file_id = $row['id'];
                                                        $filename = $row['file'];
                                                        $label = $row['label'];
                                                                                                                
                                                        $realpath = SYSBASE.'medias/article/big/'.$file_id.'/'.$filename;
                                                        $thumbpath = DOCBASE.'medias/article/big/'.$file_id.'/'.$filename;
                                                        
                                                        if(is_file($realpath)){
                                                            $size = getimagesize($realpath);
                                                            $w = $size[0];
                                                            $h = $size[1]; ?>
                                                            
                                                            
                                                    <div class="single-slider fl-wrap"  >
                                                        <div class="slick-slide-item"><img src="<?php echo $thumbpath; ?>" alt="<?php echo $label; ?>" itemprop="url" height="<?php echo $h; ?>" width="<?php echo $w; ?>"></div>
                                                        <meta itemprop="height" content="<?php echo $h; ?>">
                                                        <meta itemprop="width" content="<?php echo $w; ?>">
                                                    </div>  
                                                    <div class="swiper-button-prev sw-btn"><i class="fal fa-long-arrow-left"></i></div>
                                                    <div class="swiper-button-next sw-btn"><i class="fal fa-long-arrow-right"></i></div>
                                                        <?php
                                                        }
                                                    }
                                                } ?>
                                                    
                                                    
                                                </div>
                                            </div>
                                            <div class="list-single-main-item fl-wrap">
                                                <div class="list-single-main-item-title fl-wrap">
                                                    <h3><?php echo $article['title']; ?></h3>
                                                    <p>
                                                    <?php echo $article['text']; ?>
                                                    </p>
                                                    <?php
                                                        $result_users = $db->query('SELECT * FROM pm_user WHERE id IN('.$article['users'].')');
                                                        if($result_users->execute() != false){
                                                            foreach($result_users as $user_article){ ?>
                                                <div class="post-author"><span><?php echo $user_article['login']; ?></span></a></div>
                                               <?php
                                                    }
                                                }
                                                ?>
                                                <div class="post-opt">
                                                    <ul>
                                                        <li><i class="fal fa-calendar"></i> <span><?php echo (!RTL_DIR) ? strftime(DATE_FORMAT, $publish_date) : strftime('%F', $publish_date); ?></span></li>
                                                        <li><i class="fal fa-eye"></i> <span><?php echo $hiit; ?></span></li>
                                                       
                                                        <li><i class="fal fa-tags"></i> ---<a href="#"></li>
                                                      
                                                    </ul>
                                                </div>
                                                <span class="fw-separator"></span>
                                                <div class="list-single-main-item-title fl-wrap">
                                                    <h3>Tags</h3>
                                                </div>
                                                <?php if(isset($article_tags) && $article_tags != ""){ ?>
                                                <div class="list-single-tags tags-stylwrap blog-tags">
                                                    <a href="#"><?php echo $article_tags; ?></a>
                                                                                                                              
                                                </div>
                                                <?php } ?>
                                                <span class="fw-separator"></span>
                                                <?php
                                                    function get_articles_page($id_page){
                                                        global $articles;
                                                        $my_articles = array();
                                                        foreach($articles as $id_article => $article){
                                                            if($article['id_page'] == $id_page)
                                                                $my_articles[$id_article] = $article;
                                                        }
                                                        return $my_articles;
                                                    }
                                                    
                                                    $my_articles = get_articles_page($page_id);
                                                    
                                                    while(strval(key($my_articles)) != strval($article_id) && key($my_articles) != null) next($my_articles);
                                                    
                                                    $prev_article = prev($my_articles);
                                                    if($prev_article !== false) next($my_articles);
                                                    else reset($my_articles);
                                                    $next_article = next($my_articles); ?>
                                                <div class="post-nav fl-wrap">
                                                <?php
                                                    if($prev_article === false){ ?>
                                                        <a href="<?php echo DOCBASE.$prev_article['alias']; ?>" class="post-link prev-post-link"><i class="fal fa-angle-left"></i>Önceki <span class="clearfix"><?php $prev_article['title']; ?></span></a>
                                                    <?php }
                                                    if($next_article === false){ ?>
                                                        <a href="<?php echo DOCBASE.$next_article['alias']; ?>" class="post-link next-post-link"><i class="fal fa-angle-right"></i>Next<span class="clearfix">Dedicated to Results</span></a>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                            <!-- list-single-main-item -->   
                                            <?php
                                               
                                                $nb_comments = 0;
                                                $item_type = 'article';
                                                $item_id = $article_id;
                                                $allow_comment = $article['comment'];
                                                $allow_rating = $article['rating'];
                                                if($allow_comment == 1){
                                                    $result_comment = $db->query('SELECT * FROM pm_comment WHERE id_item = '.$item_id.' AND item_type = \''.$item_type.'\' AND checked = 1 ORDER BY add_date DESC');
                                                    if($result_comment !== false)
                                                        $nb_comments = $db->last_row_count();
                                                 ?> 
                                            <div class="list-single-main-item fl-wrap" id="sec5">
                                            <?php
                                                    if($nb_comments > 0){ ?>
                                                <div class="list-single-main-item-title fl-wrap">
                                                    <h3>Yorumlar -  <span> <?php
                                                echo "(".$nb_comments.")";?> </span></h3>
                                                </div>
                                                <?php }?>
                                                <?php
                                                foreach($result_comment as $i => $row){ ?> 
                                                <div class="reviews-comments-wrap">
                                                    <!-- reviews-comments-item -->  
                                                    <div class="reviews-comments-item">
                                                        <div class="review-comments-avatar">
                                                            <img src="images/avatar/1.jpg" alt=""> 
                                                        </div>
                                                        <div class="reviews-comments-item-text">
                                                            <h4><a href="#"><?php echo $row['name']; ?></a></h4>
                                                            <div class="clearfix"></div>
                                                            <p>"  <?php echo nl2br($row['msg']); ?> "</p>
                                                            <div class="reviews-comments-item-date"><span><i class="far fa-calendar-check"></i><?php echo (!RTL_DIR) ? strftime(DATE_FORMAT, $row['add_date']) : strftime("%F", $row['add_date']); ?></span><a href="#"><i class="fal fa-reply"></i> Reply</a></div>
                                                        </div>
                                                    </div>
                                                    <!--reviews-comments-item end-->                                                                  
                                                </div>
                                                <?php }?>
                                                <?php }?>
                                            </div>
                                            <!-- list-single-main-item end -->   
                                            <!-- list-single-main-item -->   
                                            <div class="list-single-main-item fl-wrap" id="sec6">
                                                <div class="list-single-main-item-title fl-wrap">
                                                    <h3>Yorum Ekle</h3>
                                                </div>
                                                <?php 
                                            if($allow_comment == 1 && $result_comment !== false && $item_id > 0 && isset($item_type)){
                                            ?>
                                                <!-- Add Review Box -->
                                                <div id="add-review" class="add-review-box">
                                                    <!-- Review Comment -->
                                                    <form id="add-comment" class="add-comment  custom-form"  action="<?php echo DOCBASE.$page_alias; ?>" name="rangeCalc" >
                                                        <fieldset>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <label><i class="fal fa-user"></i></label>
                                                                    <input type="text" placeholder="Adınız *" name="name" value="<?php echo htmlentities($name, ENT_QUOTES, "UTF-8"); ?>"/>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label><i class="fal fa-envelope"></i>  </label>
                                                                    <input type="text" name="email" placeholder="Email Adresiniz*" value="<?php echo htmlentities($email, ENT_QUOTES, "UTF-8"); ?>"/>
                                                                </div>
                                                            </div>
                                                            <textarea cols="40" rows="3" placeholder="Yorumunuz:" name="msg" value="<?php echo htmlentities($msg, ENT_QUOTES, "UTF-8"); ?>"></textarea>
                                                        </fieldset>
                                                        <button class="btn  no-shdow-btn float-btn color2-bg" style="margin-top:30px" name="send_comment">Submit Comment<i class="fal fa-paper-plane"></i></button>
                                                    </form>
                                                </div>
                                            <?php }?>
                                                <!-- Add Review Box / End -->
                                            </div>
                                            <!-- list-single-main-item end -->                                             
                                        </article>
                                        <!-- article end -->                                
                                    </div>
                                    <!--post-container end -->  
                                </div>
                                
                                <!-- blog content end -->
                                <!--   sidebar  -->
                                <div class="col-md-4">
                                    <!--box-widget-wrap -->  
                                    <div class="box-widget-wrap fl-wrap fixed-bar">
                                        <!--box-widget-item -->
                                        <div class="box-widget-item fl-wrap">
                                            <div class="box-widget">
                                                <div class="box-widget-content">
                                                    <div class="box-widget-item-header">
                                                        <h3> Ara </h3>
                                                    </div>
                                                    <div class="search-widget">
                                                        <form action="#" class="fl-wrap">
                                                            <input name="se" id="se" type="text" class="search" placeholder="Search.." value="Ara..." />
                                                            <button class="search-submit color2-bg" id="submit_btn"><i class="fal fa-search transition"></i> </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--box-widget-item end -->                          
                                        <!--box-widget-item -->
                                        
                                        
                                        <div class="box-widget-item fl-wrap">
                                            <div class="box-widget widget-posts">
                                                <div class="box-widget-content">
                                                    <div class="box-widget-item-header">
                                                        <h3>Populer Bloglar</h3>
                                                    </div>
                                                    <?php
                                                        $i = 0;
                                                        foreach($pages[$page_id]['articles'] as $id => $row){
                                                            if($id != $article_id){
                                                                if($i++ >= 10) break; ?>
                                                    <!--box-image-widget-->

                                                    <div class="box-image-widget">
                                                    
                                                        <div class="box-image-widget-media"><img src="</medias/hotel/small/<?php echo $thumbpath; ?>" alt="">
                                                            <a href="<?php echo DOCBASE.$row['alias']; ?>" class="color-bg">Detay</a>
                                                        </div>
                                                            
                                                        <div class="box-image-widget-details">
                                                            <h4><?php echo $row['title']; ?></h4>
                                                            <p>Integer tincidunt. Aliquam lorem ante, dapibus in, viverra quis...</p>
                                                            <span class="widget-posts-date"><i class="fal fa-calendar"></i><?php echo (!RTL_DIR) ? strftime(DATE_FORMAT, $publish_date) : strftime('%F', $publish_date); ?> </span>
                                                        </div>
                                                    </div>
                                                            <?php } 
                                                            }?>

                                                   
                                                    <!--box-image-widget end -->                                                   	
                                                    <!--box-image-widget-->
                                                    
                                                    <!--box-image-widget end -->                                                         
                                                </div>
                                            </div>
                                        </div>
                                        <!--box-widget-item end -->                                         
                                        <!--box-widget-item -->
                                        <!-- <div class="box-widget-item fl-wrap">
                                            <div class="box-widget">
                                                <div class="box-widget-content">
                                                    <div class="box-widget-item-header">
                                                        <h3>Tags </h3>
                                                    </div>
                                                    <div class="list-single-tags tags-stylwrap  sb-tags">
                                                        <a href="#">Event</a>
                                                        <a href="#">Design</a>
                                                        <a href="#">Photography</a>
                                                        <a href="#">Trends</a>
                                                        <a href="#">Video</a>
                                                        <a href="#">News</a>                                                                               
                                                    </div>
                                                </div>
                                            </div>
                                        </div> -->
                                        <!--box-widget-item end -->                                       
                                        <!--box-widget-item -->
                                       
                                        <!-- <div class="box-widget-item fl-wrap">
                                            <div class="box-widget">
                                                <div class="box-widget-content">
                                                    <div class="box-widget-item-header">
                                                        <h3> Categories</h3>
                                                    </div>
                                                    <ul class="cat-item">
                                                        <li><a href="#">Standard</a> <span>3</span></li>
                                                        <li><a href="#">Video</a> <span>6 </span></li>
                                                        <li><a href="#">Gallery</a> <span>12 </span></li>
                                                        <li><a href="#">Quotes</a> <span>4</span></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div> -->
                                        <!--box-widget-item end -->                             
                                    </div>
                                    <!--box-widget-wrap end -->  
                                </div>
                                <!--   sidebar end  -->
                            </div>
                        </div>
                        <div class="limit-box fl-wrap"></div>
                    </section>
                    <!-- section end -->
                </div>
                <!-- content end-->
            </div>
                    
                   
                </div>
                <?php
                if(!empty($widgetsRight)){ ?>
                    <div class="col-sm-4">
                        <?php displayWidgets('right', $page_id); ?>
                    </div>
                    <?php
                } ?>
            </div>
        </div>
    </div>
</article>
