<?php debug_backtrace() || die ("Direct access not permitted"); ?>
<footer class="main-footer">
                <!--subscribe-wrap-->
                <div class="subscribe-wrap color-bg  fl-wrap">
                    <div class="container">
                        <div class="sp-bg"> </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="subscribe-header">
                                    <h3>Bülten</h3>
                                    <p>Yeni bir kurs merkezlerimizden ve kampanyalarımızdan haberdar olmak istermisiniz?Sadece abone olun ve size e-posta ile bilgilendirelim.</p>
                                </div>
                            </div>
                            <div class="col-md-1"></div>
                            <div class="col-md-5">
                                <div class="footer-widget fl-wrap">
                                    <div class="subscribe-widget fl-wrap">
                                        <div class="subcribe-form">
                                            <form id="subscribe">
                                                <input class="enteremail fl-wrap" name="email" id="subscribe-email" placeholder="Mail Adresinizi Giriniz" spellcheck="false" type="text">
                                                <button type="submit" id="subscribe-button" class="subscribe-button"><i class="fas fa-rss-square"></i> Abone Ol</button>
                                                <label for="subscribe-email" class="subscribe-message"></label>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="wave-bg"></div>
                </div>
                <!--subscribe-wrap end -->
                <!--footer-inner-->
                <div class="footer-inner">
                    <div class="container">
                        <!--footer-fw-widget-->
                        
                        <!--footer-fw-widget end-->
                        <div class="row">
                            <!--footer-widget -->
                            <div class="col-md-4">
                                <div class="footer-widget fl-wrap">
                                    <h3>Hakkımızda</h3>
                                    <div class="footer-contacts-widget fl-wrap">
                                        <p> Kurs Merkezi fiyatlarını listeleyerek size en uygun özel kurs merkezini bulmanıza yardımcı olmak için hazırlanmıştır. Herhangi bir konuda öneriniz varsa lütfen iletişim bölümünden iletin.

</p>
                                        <ul  class="footer-contacts fl-wrap">
                                            <?php $result_adress = $db->query('SELECT * FROM pm_social WHERE checked = 1 ORDER BY rank'); ?>
                                            <li><span><i class="fal fa-envelope"></i> E-Mail :</span><a href="#" target="_blank"><?php echo EMAIL; ?></a></li>
                                            <li> <span><i class="fal fa-map-marker-alt"></i> Adres :</span><a href="#" target="_blank"><?php echo nl2br(ADDRESS); ?></a></li>
                                            <li><span><i class="fal fa-phone"></i> Telefon :</span><a href="#"><?php echo PHONE; ?></a></li>
                                        </ul>
                                        <div class="footer-social">
                                            <span>Bizi Takip Edin: </span>
                                            <ul>
                                                <li><a href="https://facebook.com/" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                                                <li><a href="https://twitter.com" target="_blank"><i class="fab fa-twitter"></i></a></li>
                                                <li><a href="https://instagram.com" target="_blank"><i class="fab fa-instagram"></i></a></li>
                                                <li><a href="#" target="_blank"><i class="fab fa-vk"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--footer-widget end-->
                            <!--footer-widget -->
                            <div class="col-md-4">
                                <div class="footer-widget fl-wrap">
                                    <h3>Bloglar</h3>
                                    <?php
                                    
                                    $result_article = $db->query('SELECT *
                                FROM pm_article
                                WHERE (id_page = '.$page_id.' OR home = 1)
                                    AND checked = 1
                                    AND (publish_date IS NULL || publish_date <= '.time().')
                                    AND (unpublish_date IS NULL || unpublish_date > '.time().')
                                    AND lang = '.LANG_ID.'
                                    AND (show_langs IS NULL || show_langs = \'\' || show_langs REGEXP \'(^|,)'.LANG_ID.'(,|$)\')
                                    AND (hide_langs IS NULL || hide_langs = \'\' || hide_langs NOT REGEXP \'(^|,)'.LANG_ID.'(,|$)\')
                                ORDER BY rank');
                                    if($result_article !== false){
                                        $nb_articles = $db->last_row_count();
                                        
                                        if($nb_articles > 0){ ?>
                                            
                                                    <div class="widget-posts fl-wrap">
                                                        <?php
                                                        $article_id = 0;
                                                        $result_article_file = $db->prepare('SELECT * FROM pm_article_file WHERE id_item = :article_id AND checked = 1 AND lang = '.DEFAULT_LANG.' AND type = \'image\' AND file != \'\' ORDER BY id ASC LIMIT 3');
                                                        $result_article_file->bindParam(':article_id', $article_id);
                                                        foreach($result_article as $i => $row){
                                                            $article_id = $row['id'];
                                                            $article_title = $row['title'];
                                                            $article_publish_date = $row['publish_date'];
                                                            $article_alias = $row['alias'];
                                                            $char_limit = ($i == 0) ? 1200 : 500;
                                                            $article_text = strtrunc(strip_tags($row['text'], '<p><br>'), $char_limit, true, '');
                                                            $article_page = $row['id_page'];
                                                            
                                                            if(isset($pages[$article_page])){
                                                            
                                                                $article_alias = (empty($article_url)) ? DOCBASE.$pages[$article_page]['alias'].'/'.text_format($article_alias) : $article_url;
                                                                $target = (strpos($article_alias, 'http') !== false) ? '_blank' : '_self';
                                                                if(strpos($article_alias, getUrl(true)) !== false) $target = '_self'; ?>
                                                                
                                                                    <ul>
                                                                    <?php
                                                                            if($result_article_file->execute() !== false && $db->last_row_count() == 1){
                                                                                $row = $result_article_file->fetch(PDO::FETCH_ASSOC);
                                                                                
                                                                                $file_id = $row['id'];
                                                                                $filename = $row['file'];
                                                                                $label = $row['label'];
                                                                                
                                                                                $realpath = SYSBASE.'medias/article/big/'.$file_id.'/'.$filename;
                                                                                $thumbpath = DOCBASE.'medias/article/big/'.$file_id.'/'.$filename;
                                                                                $zoompath = DOCBASE.'medias/article/big/'.$file_id.'/'.$filename;
                                                                                
                                                                                if(is_file($realpath)){
                                                                                    $s = getimagesize($realpath); ?>
                                                                        <li class="clearfix">
                                                                                                    
                                                                            <a href="#"  class="widget-posts-img"><img src="<?php echo $thumbpath; ?>" class="respimg" alt=""></a>
                                                                            <?php 
                                                                                    }
                                                                                 } ?>
                                                                            <div class="widget-posts-descr">
                                                                                <a href="#" title=""><?php echo $article_title; ?></a>
                                                                                <span class="widget-posts-date"> <?php echo date('Y-m-d', $article_publish_date);?> </span>
                                                                            </div>
                                                                                    

                                                                        </li>
                                                                        
                                                                    </ul>
                                                                    <?php
                                                                }
                                                             } ?>
                                                                </div>
                                                                
                                </div>
                            </div>
                            <?php
                                                                }
                                                             } ?>
                            <!--footer-widget end-->
                            <!--footer-widget -->
                            <div class="col-md-4">
                                <div class="footer-widget fl-wrap">
                                    <h3>Twitter</h3>
                                    <div id="footer-twiit" class="fl-wrap"></div>
                                    <a href="https://twitter.com/edugineer" class="twitter-link" target="_blank">Takip Et</a>
                                </div>
                            </div>
                            <!--footer-widget end-->
                        </div>
                        <div class="clearfix"></div>
                        <!--footer-widget -->
                        <div class="footer-widget">
                            <div class="row">
                                <div class="col-md-4"><a class="contact-btn color-bg" href="tr/iletisim">Bize Ulaşın<i class="fal fa-envelope"></i></a></div>
                                <div class="col-md-8">
                                    <div class="customer-support-widget fl-wrap">
                                        <h4>Destek Hattı : </h4>
                                        <a href="tel:2124324566" class="cs-mumber">(0212)432 45 66</a>
                                        <a href="tel:+2124324566" class="cs-mumber-button color2-bg">Destek <i class="fal fa-phone-volume"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--footer-widget end -->
                    </div>
                </div>
                <!--footer-inner end -->
                <div class="footer-bg">
                </div>
                <!--sub-footer-->
                <div class="sub-footer">
                    <div class="container">
                        <div class="copyright"> &#169; Edugineer 2020 .  Bütün Hakları Saklıdır.</div>
                        <div class="subfooter-lang">
                            
                            
                        </div>
                        <div class="subfooter-nav">
                            <ul>
                                <li><a href="#">Kullanım Sözleşmesi</a></li>
                                <li><a href="#">Güvenlik Sözleşmesi</a></li>
                                <li><a href="#">Blog</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!--sub-footer end -->
            </footer>

<?php
$result_popup = $db->query('SELECT * FROM pm_popup
                            WHERE lang = '.LANG_ID.'
                                AND checked = 1 
                                AND (publish_date IS NULL || publish_date <= '.time().')
                                AND (unpublish_date IS NULL || unpublish_date > '.time().')
                                AND (allpages = 1 OR pages REGEXP \'(^|,)'.$page_id.'(,|$)\')
                            LIMIT 1');
if($result_popup !== false && $db->last_row_count() > 0){
    $row = $result_popup->fetch();
    
    $id_popup = $row['id'];
    
    if(!isset($_SESSION['popup_'.$id_popup])){
        $popup_content = $row['content'];
        $popup_bg = $row['background'];
        
        $_SESSION['popup_'.$id_popup] = 1; ?>
        
        <a class="popup-modal hide" href="#popup-<?php echo $id_popup; ?>"></a>
        
        <div id="popup-<?php echo $id_popup; ?>" class="white-popup-block mfp-hide"<?php if(!empty($popup_bg)) echo ' style="background-color:'.$popup_bg.';"'; ?>>
            <div class="fluid-container">
                <div class="row">
                    <div class="col-md-12">
                        <?php echo $popup_content; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
} ?>

<?php
if(isset($_SESSION['book'])
 && $page_id != $sys_pages['booking-activities']['id']
 && $page_id != $sys_pages['details']['id']
 && $page_id != $sys_pages['summary']['id']
 && $page_id != $sys_pages['payment']['id']
 && isset($_SESSION['book']['rooms'])
 && count($_SESSION['book']['rooms']) > 0){ ?>
	<div id="booking-cart" class="alert alert-dismissible">
        <form method="post" class="ajax-form">
            <a href="#" class="close sendAjaxForm" data-action="<?php echo getFromTemplate('common/cancel_booking.php'); ?>" data-dismiss="alert" aria-label="close">&times;</a>
            <?php
            if(isset($_SESSION['book']['rooms']) && count($_SESSION['book']['rooms']) > 0){
                $rooms = array_keys($_SESSION['book']['rooms']);
                $id_room = array_shift($rooms);
                $result_room_file = $db->query('SELECT * FROM pm_room_file WHERE id_item = '.$id_room.' AND checked = 1 AND lang = '.LANG_ID.' AND type = \'image\' AND file != \'\' ORDER BY rank');
                if($result_room_file !== false && $db->last_row_count() > 0){
                    $row = $result_room_file->fetch(PDO::FETCH_ASSOC);

                    $file_id = $row['id'];
                    $filename = $row['file'];
                    $label = $row['label'];

                    $realpath = SYSBASE.'medias/room/small/'.$file_id.'/'.$filename;
                    $thumbpath = DOCBASE.'medias/room/small/'.$file_id.'/'.$filename;
                    $zoompath = DOCBASE.'medias/room/big/'.$file_id.'/'.$filename;

                    if(is_file($realpath)){
                        $s = getimagesize($realpath); ?>
                        <div class="img-container sm pull-left">
                            <img alt="<?php echo $label; ?>" src="<?php echo $thumbpath; ?>">
                        </div>
                        <?php
                    }
                }
            }
            $step = (isset($_SESSION['book']['step'])) ? $_SESSION['book']['step'] : 'details'; ?>
            <a href="<?php echo DOCBASE.$sys_pages[$step]['alias']; ?>" class="alert-link"><?php echo $texts['COMPLETE_YOUR_BOOKING']; ?></a><br>
            <small><?php echo gmstrftime(DATE_FORMAT, $_SESSION['book']['from_date']); ?> <i class="fas fa-fw fa-arrow-right"></i> <?php echo gmstrftime(DATE_FORMAT, $_SESSION['book']['to_date']); ?></small><br>
			<?php if(isset($_SESSION['book']['num_rooms'])) echo $_SESSION['book']['num_rooms'].' '.getAltText($texts['ROOM'], $texts['ROOMS'], $_SESSION['book']['num_rooms']); ?>
            <b><?php if($_SESSION['book']['total'] > 0) echo ' - '.formatPrice($_SESSION['book']['total']); ?></b>
            <div class="clearfix"></div>
        </form>
	</div>
	<?php
} ?>

<a href="#" id="toTop"><i class="fas fa-fw fa-angle-up"></i></a>

<!--[if lt IE 9]>
    <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.5/js/bootstrap-select.min.js"></script>
<script src="//rawgit.com/tuupola/jquery_lazyload/2.x/lazyload.min.js"></script>
<script src="<?php echo DOCBASE; ?>common/js/modernizr-2.6.1.min.js"></script>
<script src="https://use.fontawesome.com/releases/v5.12.0/js/all.js" integrity="sha384-S+e0w/GqyDFzOU88KBBRbedIB4IMF55OzWmROqS6nlDcXlEaV8PcFi4DHZYfDk4Y" crossorigin="anonymous"></script>

<script>
    Modernizr.load({
        load : [
            '//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js',
            '//cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js',
            '//code.jquery.com/ui/1.11.4/jquery-ui.js',
            <?php if(LANG_TAG != "en") : ?>'//rawgit.com/jquery/jquery-ui/master/ui/i18n/datepicker-<?php echo LANG_TAG; ?>.js',<?php endif; ?>
            '//cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js',
            '//cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js',
            '//cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js',
            
            //Javascripts required by the current model
            <?php if(isset($javascripts)) foreach($javascripts as $javascript) echo "'".$javascript."',\n"; ?>
            
            '//cdnjs.cloudflare.com/ajax/libs/jquery.imagesloaded/2.1.0/jquery.imagesloaded.min.js',
            '<?php echo DOCBASE; ?>js/plugins/imagefill/js/jquery-imagefill.js',
            '<?php echo DOCBASE; ?>js/plugins/toucheeffect/toucheffects.js',
            '//use.fontawesome.com/releases/v5.0.3/js/all.js'
        ],
        complete : function(){
            Modernizr.load({
                load : [
                    '<?php echo DOCBASE; ?>common/js/custom.js',
                    '<?php echo DOCBASE; ?>js/custom.js'
                ]
            });
        }
    });
    
    $(function(){
		<?php
		if(ENABLE_ICAL && ENABLE_AUTO_ICAL_SYNC){ ?>
			$.ajax({
				url: '<?php echo DOCBASE; ?>includes/icalendar/ical_import.php',
				type: 'POST',
				data: 'ical_sync_mode=auto'
			});
			<?php
		}
        if(isset($msg_error) && $msg_error != ""){ ?>
            var msg_error = '<?php echo preg_replace("/(\r\n|\n|\r)/","",nl2br($msg_error)); ?>';
            if(msg_error != '') $('.alert-danger').html(msg_error).slideDown();
            <?php
        }
        if(isset($msg_success) && $msg_success != ""){ ?>
            var msg_success = '<?php echo preg_replace("/(\r\n|\n|\r)/","",nl2br($msg_success)); ?>';
            if(msg_success != '') $('.alert-success').html(msg_success).slideDown();
            <?php
        }
        if(isset($field_notice) && !empty($field_notice))
            foreach($field_notice as $field => $notice) echo "$('.field-notice[rel=\"".$field."\"]').html('".$notice."').fadeIn('slow').parent().addClass('alert alert-danger');\n"; ?>
    });
</script>
<script src='https://www.google.com/recaptcha/api.js?hl=<?php echo LANG_TAG; ?>'></script>
</body>
</html>
