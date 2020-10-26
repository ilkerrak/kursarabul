<?php
/* ==============================================
 * CSS AND JAVASCRIPT USED IN THIS MODEL
 * ==============================================
 */
$stylesheets[] = array('file' => DOCBASE.'js/plugins/royalslider/royalslider.css', 'media' => 'all');
$stylesheets[] = array('file' => DOCBASE.'js/plugins/royalslider/skins/minimal-white/rs-minimal-white.css', 'media' => 'all');
$javascripts[] = DOCBASE.'js/plugins/royalslider/jquery.royalslider.min.js';

$javascripts[] = DOCBASE.'js/plugins/live-search/jquery.liveSearch.js';
                                              
$message = '';

if(isset($_POST["add_to_cart"]))
{
 if(isset($_COOKIE["shopping_cart"]))
 {
  $cookie_data = stripslashes($_COOKIE['shopping_cart']);

  $cart_data = json_decode($cookie_data, true);
 }
 else
 {
  $cart_data = array();
 }

 $item_id_list = array_column($cart_data, 'item_id');

 if(in_array($_POST["hidden_id"], $item_id_list))
 {
  foreach($cart_data as $keys => $values)
  {
   if($cart_data[$keys]["item_id"] == $_POST["hidden_id"])
   {
    $cart_data[$keys]["item_quantity"] = $cart_data[$keys]["item_quantity"] + $_POST["quantity"];
   }
  }
 }
 else
 {
  $item_array = array(
   'item_id'   => $_POST["hidden_id"],
   'item_name'   => $_POST["hidden_name"],
   'item_price'  => $_POST["hidden_price"],
   'item_alias'  => $_POST["hidden_alias"],
   'item_quantity'  => $_POST["quantity"]
  );
  $cart_data[] = $item_array;
 }

 
 $item_data = json_encode($cart_data);
 setcookie('shopping_cart', $item_data, time() + (86400 * 30));
 header("location:?success=1");
}

if(isset($_GET["action"]))
{
 if($_GET["action"] == "delete")
 {
  $cookie_data = stripslashes($_COOKIE['shopping_cart']);
  $cart_data = json_decode($cookie_data, true);
  foreach($cart_data as $keys => $values)
  {
   if($cart_data[$keys]['item_id'] == $_GET["id"])
   {
    unset($cart_data[$keys]);
    $item_data = json_encode($cart_data);
    setcookie("shopping_cart", $item_data, time() + (86400 * 30));
    header("location:?remove=1");
   }
  }
 }
 if($_GET["action"] == "clear")
 {
  setcookie("shopping_cart", "", time() - 3600);
  header("location:?clearall=1");
 }
}

if(isset($_GET["success"]))
{
 $message = '
 <div class="alert alert-success alert-dismissible">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    Favori Eklendi
 </div>
 ';
}

if(isset($_GET["remove"]))
{
 $message = '
 <div class="alert alert-success alert-dismissible">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  Favori Kaldırıldı
 </div>
 ';
}
if(isset($_GET["clearall"]))
{
 $message = '
 <div class="alert alert-success alert-dismissible">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  Favorileriniz Temizlendi
 </div>
 ';
}

require(getFromTemplate('common/header.php', false));

$slide_id = 0;
$result_slide_file = $db->prepare('SELECT * FROM pm_slide_file WHERE id_item = :slide_id AND checked = 1 AND lang = '.DEFAULT_LANG.' AND type = \'image\' AND file != \'\' ORDER BY rank LIMIT 1');
$result_slide_file->bindParam('slide_id', $slide_id);

$result_slide = $db->query('SELECT * FROM pm_slide WHERE id_page = '.$page_id.' AND checked = 1 AND lang = '.LANG_ID.' ORDER BY rank', PDO::FETCH_ASSOC);
if($result_slide !== false){
	$nb_slides = $db->last_row_count();
	if($nb_slides > 0){ ?>
?>
        
       
	
<section class="hero-section" data-scrollax-parent="true" id="sec1">
<?php
                foreach($result_slide as $i => $row){
                    $slide_id = $row['id'];
                    $slide_legend = $row['legend'];
                    $url_video = $row['url'];
                    $id_page = $row['id_page'];
                    
                    $result_slide_file->execute();
                    
                    if($result_slide_file !== false && $db->last_row_count() == 1){
                        $row = $result_slide_file->fetch();
                        
                        $file_id = $row['id'];
                        $filename = $row['file'];
                        $label = $row['label'];
                        
                        $realpath = SYSBASE.'medias/slide/big/'.$file_id.'/'.$filename;
                        $thumbpath = DOCBASE.'medias/slide/small/'.$file_id.'/'.$filename;
                        $zoompath = DOCBASE.'medias/slide/big/'.$file_id.'/'.$filename;
                            
                        if(is_file($realpath)){ ?>
                        <div class="hero-parallax">
                            <div class="bg"  data-bg="<?php echo $zoompath; ?>" data-scrollax="properties: { translateY: '200px' }"></div>
                            <div class="overlay op7"></div>
                        </div>
                        <?php
                        }
                    }
                } ?>
                        <div class="hero-section-wrap fl-wrap">
                            <div class="container">
                                <div class="home-intro">
                                    <div class="section-title-separator"><span></span></div>
                                    <h2>Kurs Merkezi Rezervasyon</h2>
                                    <span class="section-separator"></span>                                    
                                    <h3>Türkiyedeki bütün kurs merkezlerinin fiyatlarını sizler için listeledik.</h3>
                                </div>
                                <div id="search-home-wrapper">
                                    <div id="search-home" class="container">
                                        <?php include(getFromTemplate('common/search.php', false)); ?>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <div class="header-sec-link">
                            <div class="container"><a href="#sec2" class="custom-scroll-link color-bg"><i class="fal fa-angle-double-down"></i></a></div>
                        </div>
                    </section>
                        <?php }
                        }?>
                        
                    <section id="sec2" style="z-index:-1 !important;">
                        <div class="container">
                        <?php displayWidgets('before_content', $page_id); ?>
                            <div class="section-title">
                                <div class="section-title-separator"><span></span></div>
                                <h2>Popüler Şehirler</h2>
                                <span class="section-separator"></span>
                            </div>
						 </div>
                            <!-- portfolio start -->
                            <?php
            $result_destination = $db->query('SELECT * FROM pm_destination WHERE lang = '.LANG_ID.' AND checked = 1 AND home = 1 AND id = 1 ORDER BY rank');
            if($result_destination !== false){
                $nb_destinations = $db->last_row_count();
                
                if($nb_destinations > 0){ ?>
                            
                    
                            <?php
                            $destination_id = 0;
                            
                            $result_destination_file = $db->prepare('SELECT * FROM pm_destination_file WHERE id_item = :destination_id AND checked = 1 AND lang = '.DEFAULT_LANG.' AND type = \'image\' AND file != \'\' ORDER BY rank LIMIT 1');
                            $result_destination_file->bindParam(':destination_id',$destination_id);
                            
                            $result_rate = $db->prepare('
                                SELECT MIN(ra.price) as min_price
                                FROM pm_rate as ra, pm_hotel as h, pm_destination as d
                                WHERE id_hotel = h.id
                                    AND id_destination = d.id
                                    AND id_destination = :destination_id');
                            $result_rate->bindParam(':destination_id', $destination_id);
                            
                            foreach($result_destination as $i => $row){
                                $destination_id = $row['id'];
                                $destination_name = $row['name'];
                                $destination_subtitle = $row['subtitle'];
                                
                                $destination_alias = DOCBASE.$sys_pages['booking']['alias'].'/'.text_format($row['alias']);
                                
                                $min_price = 0;
                                if($result_rate->execute() !== false && $db->last_row_count() > 0){
                                    $row = $result_rate->fetch();
                                    $price = $row['min_price'];
                                    if($price > 0) $min_price = $price;
                                } ?>
                            
                                <!-- gallery-item-->
                                <?php
                             if($result_destination_file->execute() !== false && $db->last_row_count() == 1){
                                $row = $result_destination_file->fetch(PDO::FETCH_ASSOC);
                                
                                $file_id = $row['id'];
                                $filename = $row['file'];
                                $label = $row['label'];
                                
                                $realpath = SYSBASE.'medias/destination/small/'.$file_id.'/'.$filename;
                                $thumbpath = DOCBASE.'medias/destination/small/'.$file_id.'/'.$filename;
                                $zoompath = DOCBASE.'medias/destination/big/'.$file_id.'/'.$filename;
                                
                                if(is_file($realpath)){
                                    $s = getimagesize($realpath); ?>
                                <div class="gallery-items fl-wrap mr-bot spad home-grid">
                                    <div class="gallery-item">
                                        <div class="grid-item-holder">
                                            <div class="listing-item-grid">
                                            <?php 
                                             $result_nb_hotel = $db->query('SELECT * FROM pm_hotel WHERE lang = '.LANG_ID.' AND checked = 1 AND home = 1 AND id_destination = 1 ORDER BY rank');
                                             $nb_hotel_destination= $db->last_row_count();
                                            
                                            ?>
                                                <div class="listing-counter"><span><?php echo $nb_hotel_destination; ?> </span> Kurs Merkezi</div>
                                                <img  src="<?php echo $thumbpath; ?>">
                                                <div class="listing-item-cat">
                                                    <h3><a href="<?php echo $destination_alias; ?>"><?php echo $destination_name; ?></a></h3>
                                                    <div class="weather-grid"   data-grcity="<?php echo $destination_name; ?>"></div>
                                                    <div class="clearfix"></div>
                                                   
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php 
                                
                                            }
                                        }
                                            ?>
                                            <?php
                                        }        
                        } 
                        }?>
           <?php
            $result_destination = $db->query('SELECT * FROM pm_destination WHERE lang = '.LANG_ID.' AND checked = 1 AND home = 1 AND id = 2 ORDER BY rank   LIMIT 1');
            if($result_destination !== false){
                $nb_destinations = $db->last_row_count();
                
                if($nb_destinations > 0){ ?>
                            
                    
                            <?php
                            $destination_id = 0;
                            
                            $result_destination_file = $db->prepare('SELECT * FROM pm_destination_file WHERE id_item = :destination_id AND checked = 1 AND lang = '.DEFAULT_LANG.' AND type = \'image\' AND file != \'\' ORDER BY rank LIMIT 1');
                            $result_destination_file->bindParam(':destination_id',$destination_id);
                            
                            $result_rate = $db->prepare('
                                SELECT MIN(ra.price) as min_price
                                FROM pm_rate as ra, pm_hotel as h, pm_destination as d
                                WHERE id_hotel = h.id
                                    AND id_destination = d.id
                                    AND id_destination = :destination_id');
                            $result_rate->bindParam(':destination_id', $destination_id);
                            
                            foreach($result_destination as $i => $row){
                                $destination_id = $row['id'];
                                $destination_name = $row['name'];
                                $destination_subtitle = $row['subtitle'];
                                
                                $destination_alias = DOCBASE.$sys_pages['booking']['alias'].'/'.text_format($row['alias']);
                                
                                $min_price = 0;
                                if($result_rate->execute() !== false && $db->last_row_count() > 0){
                                    $row = $result_rate->fetch();
                                    $price = $row['min_price'];
                                    if($price > 0) $min_price = $price;
                                } ?>
                            
                                <!-- gallery-item-->
                                <?php
                             if($result_destination_file->execute() !== false && $db->last_row_count() == 1){
                                $row = $result_destination_file->fetch(PDO::FETCH_ASSOC);
                                
                                $file_id = $row['id'];
                                $filename = $row['file'];
                                $label = $row['label'];
                                
                                $realpath = SYSBASE.'medias/destination/small/'.$file_id.'/'.$filename;
                                $thumbpath = DOCBASE.'medias/destination/small/'.$file_id.'/'.$filename;
                                $zoompath = DOCBASE.'medias/destination/big/'.$file_id.'/'.$filename;
                                
                                if(is_file($realpath)){
                                    $s = getimagesize($realpath); ?>
                                <div class="gallery-item gallery-item-second">
                                    <div class="grid-item-holder">
                                        <div class="listing-item-grid">
                                        <?php 
                                             $result_nb2_hotel = $db->query('SELECT * FROM pm_hotel WHERE lang = '.LANG_ID.' AND checked = 1 AND home = 1 AND id_destination = 2 ORDER BY rank');
                                             $nb2_hotel_destination= $db->last_row_count();
                                            
                                            ?>
                                        <div class="listing-counter"><span><?php echo $nb2_hotel_destination; ?> </span> Kurs Merkezi</div>

                                        <img  src="<?php echo $thumbpath; ?>">
                                            <div class="listing-item-cat">
                                                <h3><a href="<?php echo $destination_alias; ?>"><?php echo $destination_name; ?></a></h3>
                                                <div class="weather-grid"   data-grcity="<?php echo $destination_name; ?>"></div>
                                                <div class="clearfix"></div>
                                               
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                                <?php 
                                
                            }
                           }
                              ?>
                              <?php
                          }        
                         } 
                        }?>
                                
            <?php
            $result_destination = $db->query('SELECT * FROM pm_destination WHERE lang = '.LANG_ID.' AND checked = 1 AND home = 1 AND id = 3 ORDER BY rank LIMIT 1');
            if($result_destination !== false){
                $nb_destinations = $db->last_row_count();
                
                if($nb_destinations > 0){ ?>
                            
                    
                            <?php
                            $destination_id = 0;
                            
                            $result_destination_file = $db->prepare('SELECT * FROM pm_destination_file WHERE id_item = :destination_id AND checked = 1 AND lang = '.DEFAULT_LANG.' AND type = \'image\' AND file != \'\' ORDER BY rank LIMIT 1');
                            $result_destination_file->bindParam(':destination_id',$destination_id);
                            
                            $result_rate = $db->prepare('
                                SELECT MIN(ra.price) as min_price
                                FROM pm_rate as ra, pm_hotel as h, pm_destination as d
                                WHERE id_hotel = h.id
                                    AND id_destination = d.id
                                    AND id_destination = :destination_id');
                            $result_rate->bindParam(':destination_id', $destination_id);
                            
                            foreach($result_destination as $i => $row){
                                $destination_id = $row['id'];
                                $destination_name = $row['name'];
                                $destination_subtitle = $row['subtitle'];
                                
                                $destination_alias = DOCBASE.$sys_pages['booking']['alias'].'/'.text_format($row['alias']);
                                
                                $min_price = 0;
                                if($result_rate->execute() !== false && $db->last_row_count() > 0){
                                    $row = $result_rate->fetch();
                                    $price = $row['min_price'];
                                    if($price > 0) $min_price = $price;
                                } ?>
                            
                                <!-- gallery-item-->
                                <?php
                             if($result_destination_file->execute() !== false && $db->last_row_count() == 1){
                                $row = $result_destination_file->fetch(PDO::FETCH_ASSOC);
                                
                                $file_id = $row['id'];
                                $filename = $row['file'];
                                $label = $row['label'];
                                
                                $realpath = SYSBASE.'medias/destination/small/'.$file_id.'/'.$filename;
                                $thumbpath = DOCBASE.'medias/destination/small/'.$file_id.'/'.$filename;
                                $zoompath = DOCBASE.'medias/destination/big/'.$file_id.'/'.$filename;
                                
                                if(is_file($realpath)){
                                    $s = getimagesize($realpath); ?>
                                <div class="gallery-item">
                                    <div class="grid-item-holder">
                                        <div class="listing-item-grid">
                                        <?php 
                                             $result_nb3_hotel = $db->query('SELECT * FROM pm_hotel WHERE lang = '.LANG_ID.' AND checked = 1 AND home = 1 AND id_destination = 3 ORDER BY rank');
                                             $nb3_hotel_destination= $db->last_row_count();
                                            
                                            ?>
                                            <div class="listing-counter"><span><?php echo $nb3_hotel_destination; ?> </span> Kurs Merkezi</div>
                                            <img  src="<?php echo $thumbpath; ?>"   alt="<?php echo $label; ?>"  itemprop="photo" width="<?php echo $s[0]; ?>" height="<?php echo $s[1]; ?>">
                                            <div class="listing-item-cat">
                                                <h3><a href="<?php echo $destination_alias; ?>"><?php echo $destination_name; ?></a></h3>
                                                <div class="weather-grid"   data-grcity="<?php echo $destination_name; ?>"></div>
                                                <div class="clearfix"></div>
                                               
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php 
                                
                              }
                            }
                                ?>
                                <?php
                            }        
             } 
            }?>
             <?php
            $result_destination = $db->query('SELECT * FROM pm_destination WHERE lang = '.LANG_ID.' AND checked = 1 AND home = 1 AND id = 4 ORDER BY rank LIMIT 1');
            if($result_destination !== false){
                $nb_destinations = $db->last_row_count();
                
                if($nb_destinations > 0){ ?>
                            
                    
                            <?php
                            $destination_id = 0;
                            
                            $result_destination_file = $db->prepare('SELECT * FROM pm_destination_file WHERE id_item = :destination_id AND checked = 1 AND lang = '.DEFAULT_LANG.' AND type = \'image\' AND file != \'\' ORDER BY rank LIMIT 1');
                            $result_destination_file->bindParam(':destination_id',$destination_id);
                            
                            $result_rate = $db->prepare('
                                SELECT MIN(ra.price) as min_price
                                FROM pm_rate as ra, pm_hotel as h, pm_destination as d
                                WHERE id_hotel = h.id
                                    AND id_destination = d.id
                                    AND id_destination = :destination_id');
                            $result_rate->bindParam(':destination_id', $destination_id);
                            
                            foreach($result_destination as $i => $row){
                                $destination_id = $row['id'];
                                $destination_name = $row['name'];
                                $destination_subtitle = $row['subtitle'];
                                
                                $destination_alias = DOCBASE.$sys_pages['booking']['alias'].'/'.text_format($row['alias']);
                                
                                $min_price = 0;
                                if($result_rate->execute() !== false && $db->last_row_count() > 0){
                                    $row = $result_rate->fetch();
                                    $price = $row['min_price'];
                                    if($price > 0) $min_price = $price;
                                } ?>
                            
                                <!-- gallery-item-->
                                <?php
                             if($result_destination_file->execute() !== false && $db->last_row_count() == 1){
                                $row = $result_destination_file->fetch(PDO::FETCH_ASSOC);
                                
                                $file_id = $row['id'];
                                $filename = $row['file'];
                                $label = $row['label'];
                                
                                $realpath = SYSBASE.'medias/destination/small/'.$file_id.'/'.$filename;
                                $thumbpath = DOCBASE.'medias/destination/small/'.$file_id.'/'.$filename;
                                $zoompath = DOCBASE.'medias/destination/big/'.$file_id.'/'.$filename;
                                
                                if(is_file($realpath)){
                                    $s = getimagesize($realpath); ?>
                                <div class="gallery-item">
                                    <div class="grid-item-holder">
                                        <div class="listing-item-grid">
                                        <?php 
                                             $result_nb4_hotel = $db->query('SELECT * FROM pm_hotel WHERE lang = '.LANG_ID.' AND checked = 1 AND home = 1 AND id_destination = 4 ORDER BY rank');
                                             $nb4_hotel_destination= $db->last_row_count();
                                            
                                            ?>
                                            <div class="listing-counter"><span><?php echo $nb4_hotel_destination; ?> </span> Kurs Merkezi</div>
                                            <img  src="<?php echo $thumbpath; ?>"   alt="<?php echo $label; ?>"  itemprop="photo" width="<?php echo $s[0]; ?>" height="<?php echo $s[1]; ?>">
                                            <div class="listing-item-cat">
                                                <h3><a href="<?php echo $destination_alias; ?>"><?php echo $destination_name; ?></a></h3>
                                                <div class="weather-grid"   data-grcity="<?php echo $destination_name; ?>"></div>
                                                <div class="clearfix"></div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php 
                                
                              }
                            }
                                ?>
                                <?php
                            }        
             } 
            }?>
             <?php
            $result_destination = $db->query('SELECT * FROM pm_destination WHERE lang = '.LANG_ID.' AND checked = 1 AND home = 1 AND id = 5 ORDER BY rank LIMIT 1');
            if($result_destination !== false){
                $nb_destinations = $db->last_row_count();
                
                if($nb_destinations > 0){ ?>
                            
                    
                            <?php
                            $destination_id = 0;
                            
                            $result_destination_file = $db->prepare('SELECT * FROM pm_destination_file WHERE id_item = :destination_id AND checked = 1 AND lang = '.DEFAULT_LANG.' AND type = \'image\' AND file != \'\' ORDER BY rank LIMIT 1');
                            $result_destination_file->bindParam(':destination_id',$destination_id);
                            
                            $result_rate = $db->prepare('
                                SELECT MIN(ra.price) as min_price
                                FROM pm_rate as ra, pm_hotel as h, pm_destination as d
                                WHERE id_hotel = h.id
                                    AND id_destination = d.id
                                    AND id_destination = :destination_id');
                            $result_rate->bindParam(':destination_id', $destination_id);
                            
                            foreach($result_destination as $i => $row){
                                $destination_id = $row['id'];
                                $destination_name = $row['name'];
                                $destination_subtitle = $row['subtitle'];

                                
                                $destination_alias = DOCBASE.$sys_pages['booking']['alias'].'/'.text_format($row['alias']);
                                
                                $min_price = 0;
                                if($result_rate->execute() !== false && $db->last_row_count() > 0){
                                    $row = $result_rate->fetch();
                                    $price = $row['min_price'];
                                    if($price > 0) $min_price = $price;
                                } ?>
                            
                                <!-- gallery-item-->
                                <?php
                             if($result_destination_file->execute() !== false && $db->last_row_count() == 1){
                                $row = $result_destination_file->fetch(PDO::FETCH_ASSOC);
                                
                                $file_id = $row['id'];
                                $filename = $row['file'];
                                $label = $row['label'];
                                
                                $realpath = SYSBASE.'medias/destination/small/'.$file_id.'/'.$filename;
                                $thumbpath = DOCBASE.'medias/destination/small/'.$file_id.'/'.$filename;
                                $zoompath = DOCBASE.'medias/destination/big/'.$file_id.'/'.$filename;
                                
                                if(is_file($realpath)){
                                    $s = getimagesize($realpath); ?>
                                <div class="gallery-item">
                                    <div class="grid-item-holder">
                                        <div class="listing-item-grid">
                                        <?php 
                                             $result_nb5_hotel = $db->query('SELECT * FROM pm_hotel WHERE lang = '.LANG_ID.' AND checked = 1 AND home = 1 AND id_destination = 5 ORDER BY rank');
                                             $nb5_hotel_destination= $db->last_row_count();
                                            
                                            ?>
                                            <div class="listing-counter"><span><?php echo $nb5_hotel_destination; ?> </span> Kurs Merkezi</div>
                                            <img  src="<?php echo $thumbpath; ?>"   alt="<?php echo $label; ?>"  itemprop="photo" width="<?php echo $s[0]; ?>" height="<?php echo $s[1]; ?>">
                                            <div class="listing-item-cat">
                                                <h3><a href="<?php echo $destination_alias; ?>"><?php echo $destination_name; ?></a></h3>
                                                <div class="weather-grid"   data-grcity="<?php echo $destination_name; ?>"></div>
                                                <div class="clearfix"></div>
                                               
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php 
                                
                              }
                            }
                                ?>
                                <?php
                            }        
             } 
            }?>
                             
        </div>
                 
                            <!-- portfolio end -->
                            <a href="tr/sehirler" class="btn    color-bg">Tüm Şehirler<i class="fal fa-caret-right"></i></a>
    </section>
<section class="grey-blue-bg">
    <div class="container">
        <?php displayWidgets('before_content', $page_id); ?>
        <div class="section-title">
            <div class="section-title-separator"><span></span></div>
            <h2>
            Kurs Merkezleri
            </h2>
            <span class="section-separator"></span>
            <p> Binlerce kurs merkezinin özelliklerini karşılaştırabilir, fiyatlarını inceleyebilirsiniz. Kurs merkezine karar vermeden önce mutlaka bakmalısınız.</p>
        </div>
    </div>
                    <div class="list-carousel fl-wrap card-listing ">
                            <!--listing-carousel-->
                            <div class="listing-carousel  fl-wrap ">
                                <!--slick-slide-item-->
                                <?php 
                                    $result_hotel = $db->query('SELECT * FROM pm_hotel WHERE lang = '.LANG_ID.' AND checked = 1 AND home = 1 ORDER BY rank');
                                    if($result_hotel !== false){
                                        $nb_hotels = $db->last_row_count();
                                        
                                        $hotel_id = 0;
                                        
                                        $result_hotel_file = $db->prepare('SELECT * FROM pm_hotel_file WHERE id_item = :hotel_id AND checked = 1 AND lang = '.DEFAULT_LANG.' AND type = \'image\' AND file != \'\' ORDER BY rank LIMIT 1');
                                        $result_hotel_file->bindParam(':hotel_id',$hotel_id);
                                        
                                        $result_rate = $db->prepare('SELECT MIN(price) as min_price FROM pm_rate WHERE id_hotel = :hotel_id');
                                        $result_rate->bindParam(':hotel_id', $hotel_id);
                                        
                                        foreach($result_hotel as $i => $row){
                                            $hotel_id = $row['id'];
                                            $hotel_title = $row['title'];
                                            $hotel_subtitle = $row['subtitle'];
                                            $hotel_desc = $row['descr'];
                                            $hotel_state = $row['state'];
                                            $hotel_city = $row['city'];
                                            $hotel_facilities= $row['facilities'];

                                            
                                            $hotel_alias = DOCBASE.$pages[9]['alias'].'/'.text_format($row['alias']);
                                            
                                            $min_price = 0;
                                            if($result_rate->execute() !== false && $db->last_row_count() > 0){
                                                $row = $result_rate->fetch();
                                                $price = $row['min_price'];
                                                if($price > 0) $min_price = $price;
                                            } ?>
                                            
                                ?>
                                <div class="slick-slide-item">
                                    <!-- listing-item  -->
                                    <div class="listing-item">
                                        <article class="geodir-category-listing fl-wrap">
                                            <?php
                                                if($result_hotel_file->execute() !== false && $db->last_row_count() == 1){
                                                    $row = $result_hotel_file->fetch(PDO::FETCH_ASSOC);
                                                    
                                                    $file_id = $row['id'];
                                                    $filename = $row['file'];
                                                    $label = $row['label'];
                                                    
                                                    $realpath = SYSBASE.'medias/hotel/small/'.$file_id.'/'.$filename;
                                                    $thumbpath = DOCBASE.'medias/hotel/small/'.$file_id.'/'.$filename;
                                                    $zoompath = DOCBASE.'medias/hotel/big/'.$file_id.'/'.$filename;
                                                    
                                                    if(is_file($realpath)){
                                                        $s = getimagesize($realpath);
                                             ?>
                                            <div class="geodir-category-img">
                                                <a href="<?php echo $hotel_alias; ?>"><img src="<?php echo $thumbpath; ?>" alt="<?php echo $label; ?>"></a>
                                              
                                                <div class="sale-window">Sale 20%</div>
                                                <div class="geodir-category-opt">
                                                    <div class="listing-rating card-popup-rainingvis" data-starrating2="5"></div>
                                                    <div class="rate-class-name">
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
                                                    }if($nb_comments > 0){  ?>
                                                        <div class="score"><strong><?php echo $nb_comments ?>  Yorum </strong></div>
                                                    <?php }
                                                    else { ?>
                                                        <div class="score"><strong>Yorum Yok </strong></div>
                                                        <?php
                                                    } ?>
                                                        <span>5.0</span>                                             
                                                    </div>
                                                </div>
                                            </div>
                                            <?php 
                                                    }
                                                }?>
                                            <div class="geodir-category-content fl-wrap title-sin_item">
                                                <div class="geodir-category-content-title fl-wrap">
                                                    <div class="geodir-category-content-title-item">
                                                        <h3 class="title-sin_map"><a href="<?php echo $hotel_alias; ?>"><?php echo $hotel_title; ?></a></h3>
                                                        <div class="geodir-category-location fl-wrap"><a href="#" class="map-item"><i class="fal fa-map-marker-alt"></i> <?php echo $hotel_city .' / '. $hotel_state ; ?></a></div>
                                                    </div>
                                                </div>
                                                <p><?php echo $hotel_desc; ?></p>

                                                <ul class="facilities-list fl-wrap">
                                                <?php
                                                    $result_facility = $db->query('SELECT * FROM pm_facility WHERE lang = '.LANG_ID.' AND id IN('.$hotel_facilities.') ORDER BY id LIMIT 5',PDO::FETCH_ASSOC);
                                                    if($result_facility !== false && $db->last_row_count() > 0){
                                                        foreach($result_facility as $i => $row){
                                                            $facility_id 	= $row['id'];
                                                            $facility_name  = $row['name'];
                                                            
                                                            $result_facility_file = $db->query('SELECT * FROM pm_facility_file WHERE id_item = '.$facility_id.' AND checked = 1 AND lang = '.DEFAULT_LANG.' AND type = \'image\' AND file != \'\' ORDER BY rank LIMIT 1',PDO::FETCH_ASSOC);
                                                            if($result_facility_file !== false && $db->last_row_count() == 1){
                                                                $row = $result_facility_file->fetch();
                                                                
                                                                $file_id 	= $row['id'];
                                                                $filename 	= $row['file'];
                                                                $label	 	= $row['label'];
                                                                
                                                                $realpath	= SYSBASE.'medias/facility/big/'.$file_id.'/'.$filename;
                                                                $thumbpath	= DOCBASE.'medias/facility/big/'.$file_id.'/'.$filename;
                                                                    
                                                                if(is_file($realpath)){ ?>
                                                     <li ><img style="filter:opacity(0.5); width:75%;" alt="" title="<?php echo $facility_name?>" src="<?php echo $thumbpath ?>"><span><?php echo $facility_name ?></span> </li>
                                                    <?php 
                                                          }
                                                        }
                                                    }
                                                }
                                                    ?>
                                                </ul>
                                                 <div class="geodir-category-footer fl-wrap">
                                                    <div class="geodir-category-price">Fiyat <span><?php echo formatPrice($min_price*CURRENCY_RATE); ?></span></div>
                                                    <div class="geodir-opt-list">
                                                    <form method="POST" >
                                                    <input type="hidden" name="quantity" value="1" class="form-control" />
                                                    <input type="hidden" name="hidden_name" value="<?php echo $hotel_title; ?>" />
                                                    <input type="hidden" name="hidden_price" value="<?php echo $hotel_city; ?>" />
                                                    <input type="hidden" name="hidden_id" value="<?php echo $hotel_id; ?>" />
                                                    <input type="hidden" name="hidden_alias" value="<?php echo $hotel_alias; ?>" />
                                                    <button style="float:right;border:0px; width:36px;	height:36px;margin-left:5px;background: #ECF6F8;line-height:40px;position:relative;color:#999;border-radius:4px;font-size:15px;" class="geodir-js-favorite" type="submit" id="add_to_cart" name="add_to_cart" style="margin-top:-10px;"><i class="fal fa-heart"><span class="geodir-opt-tooltip">Favori</span></a></button></i>
                                                     </form>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </article>
                                    </div>
                                    <!-- listing-item end -->
                                </div>
                                <?php
                                        }
                                    }
                                
                                ?>
                                <!--slick-slide-item end-->
                            </div>
                            <!--listing-carousel end-->
                            <div class="swiper-button-prev sw-btn"><i class="fal fa-long-arrow-left"></i></div>
                            <div class="swiper-button-next sw-btn"><i class="fal fa-long-arrow-right"></i></div>
                       </div>               

        
        
	
</section>
<section class="parallax-section" data-scrollax-parent="true">
                        <div class="bg"  data-bg="templates/default/img/2.jpg" data-scrollax="properties: { translateY: '100px' }"></div>
                        <div class="overlay op7"></div>
                        <!--container-->
                        <div class="container">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="colomn-text fl-wrap pad-top-column-text_small">
                                        <div class="colomn-text-title">
                                            <h3>Popüler Kurs Merkezleri</h3>
                                            <p></p>
                                            <a href="/tr/kurs-merkezleri" class="btn  color2-bg float-btn">Tümünü gör<i class="fal fa-caret-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <!--light-carousel-wrap-->
                                    <div class="light-carousel-wrap fl-wrap">
                                        <!--light-carousel-->
                                        <div class="light-carousel">
                                        <?php
                                         $result_hotel = $db->query('SELECT * FROM pm_hotel WHERE lang = '.LANG_ID.' AND checked = 1 AND home = 1 AND populer = 1 ORDER BY rank');
                                         if($result_hotel !== false){
                                             $nb_hotels = $db->last_row_count();
                                             
                                             $hotel_id = 0;
                                             
                                             $result_hotel_file = $db->prepare('SELECT * FROM pm_hotel_file WHERE id_item = :hotel_id AND checked = 1 AND lang = '.DEFAULT_LANG.' AND type = \'image\' AND file != \'\' ORDER BY rank LIMIT 1');
                                             $result_hotel_file->bindParam(':hotel_id',$hotel_id);
                                             
                                             $result_rate = $db->prepare('SELECT MIN(price) as min_price FROM pm_rate WHERE id_hotel = :hotel_id');
                                             $result_rate->bindParam(':hotel_id', $hotel_id);
                                             
                                             foreach($result_hotel as $i => $row){
                                                 $hotel_id = $row['id'];
                                                 $hotel_title = $row['title'];
                                                 $hotel_subtitle = $row['subtitle'];
                                                 $hotel_state = $row['state'];
                                                 $hotel_city = $row['city'];
                                                 
                                                 $hotel_alias = DOCBASE.$pages[9]['alias'].'/'.text_format($row['alias']);
                                                 
                                                 $min_price = 0;
                                                 if($result_rate->execute() !== false && $db->last_row_count() > 0){
                                                     $row = $result_rate->fetch();
                                                     $price = $row['min_price'];
                                                     if($price > 0) $min_price = $price;
                                                 } 
                                                 if($result_hotel_file->execute() !== false && $db->last_row_count() == 1){
                                                    $row = $result_hotel_file->fetch(PDO::FETCH_ASSOC);
                                                    
                                                    $file_id = $row['id'];
                                                    $filename = $row['file'];
                                                    $label = $row['label'];
                                                    
                                                    $realpath = SYSBASE.'medias/hotel/small/'.$file_id.'/'.$filename;
                                                    $thumbpath = DOCBASE.'medias/hotel/small/'.$file_id.'/'.$filename;
                                                    $zoompath = DOCBASE.'medias/hotel/big/'.$file_id.'/'.$filename;
                                                    
                                                    if(is_file($realpath)){
                                                        $s = getimagesize($realpath); ?>
                                                 
                                                 
                                            <!-- slick-slide-item -->
                                            
                                            <div class="slick-slide-item">
                                                <div class="hotel-card fl-wrap title-sin_item">
                                                    <div class="geodir-category-img card-post">
                                                        <a href="<?php echo $hotel_alias; ?>"><img src="<?php echo $thumbpath; ?>" alt="<?php echo $label; ?>"itemprop="photo" width="<?php echo $s[0]; ?>" height="<?php echo $s[1]; ?>"></a>
                                                        <div class="listing-counter">Fiyat<strong><?php echo formatPrice($min_price*CURRENCY_RATE); ?></strong></div>
                                                        <div class="sale-window">Sale </div>
                                                        <div class="geodir-category-opt">
                                                            <div class="listing-rating card-popup-rainingvis" data-starrating2="5"></div>
                                                            <h4 class="title-sin_map"><a href="<?php echo $hotel_alias; ?>"><?php echo $hotel_title; ?></a></h4>
                                                            <div class="geodir-category-location"><a href="#" class="single-map-item" data-newlatitude="40.90261483" data-newlongitude="-74.15737152"><i class="fal fa-map-marker-alt"></i>  <?php echo $hotel_city .' / '. $hotel_state ; ?></a></div>
                                                            <div class="rate-class-name">
                                                                <div class="score">8 Reviews </div>
                                                                <span>4.8</span>                                             
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php 
                                                    }
                                                }
                                            }
                                        }
                                            ?>
                                            
                                            <!--slick-slide-item end-->                                            
                                        </div>
                                        <!--light-carousel end-->
                                        <div class="fc-cont  lc-prev"><i class="fal fa-angle-left"></i></div>
                                        <div class="fc-cont  lc-next"><i class="fal fa-angle-right"></i></div>
                                    </div>
                                    <!--light-carousel-wrap end-->
                                </div>
                            </div>
                        </div>
                    </section>
                    <section>
                        <div class="container">
                            <div class="section-title">
                                <div class="section-title-separator"><span></span></div>
                                <h2>Neden Biz</h2>
                                <span class="section-separator"></span>
                                <p></p>
                            </div>
                            <!-- -->
                            <div class="row">
                                <div class="col-md-4">
                                    <!-- process-item-->
                                    <div class="process-item big-pad-pr-item">
                                        <span class="process-count"> </span>
                                        <div class="time-line-icon"><i class="fal fa-headset"></i></div>
                                        <h4><a href="#">En iyi Eğitim Ağı</a></h4>
                                        <p>Birçok ilde yer alan tüm eğitim seviyelerine ait özel ve devlet kurumlarını, öğrencilerin kaliteli bir eğitim alması amacıyla sizin için tarafsız şekilde listeleme hizmeti sunan bir eğitim platformuyuz.</p>
                                    </div>
                                    <!-- process-item end -->
                                </div>
                                <div class="col-md-4">
                                    <!-- process-item-->
                                    <div class="process-item big-pad-pr-item">
                                        <span class="process-count"> </span>
                                        <div class="time-line-icon"><i class="fal fa-gift"></i></div>
                                        <h4> <a href="#">Öğrenci Dostu</a></h4>
                                        <p>Öğrencilerimizin başarılı bir birey haline gelmesindeki önemli bir adım olan okul hayatlarını, kendilerine en uygun kurs merkezinde geçirmelerini sağlamak ve geleceğimizi birlikte inşa etmede bir başlangıç olmak görevini misyon edinmiştir.</p>
                                    </div>
                                    <!-- process-item end -->                                
                                </div>
                                <div class="col-md-4">
                                    <!-- process-item-->
                                    <div class="process-item big-pad-pr-item nodecpre">
                                        <span class="process-count"> </span>
                                        <div class="time-line-icon"><i class="fal fa-credit-card"></i></div>
                                        <h4><a href="#"> Kolay Erişim</a></h4>
                                        <p>Kolay yönetilebilir kullanıcı arayüzü ile internete erişilebilen heryerden istenilen kurs merkezleri karşılaştırılır, incelenir ve destek alınabilir.
Tüm kurs merkezlerinin en güncel bilgilerinin var olmasıyla ziyaretçilerine, beğenilen kurs merkezlerini sınırsız bir şekilde inceleme ve karşılaştırma imkanı sunar.
</p>
                                    </div>
                                    <!-- process-item end -->                                
                                </div>
                            </div>
                            <!--process-wrap   end-->
                            <div class=" single-facts fl-wrap mar-top">
                                <!-- inline-facts -->
                                <div class="inline-facts-wrap">
                                    <div class="inline-facts">
                                        <i class="fal fa-users"></i>
                                        <div class="milestone-counter">
                                            <div class="stats animaper">
                                                <div class="num" data-content="0" data-num="254">154</div>
                                            </div>
                                        </div>
                                        <h6>Öğrenci Sayısı</h6>
                                    </div>
                                </div>
                                <!-- inline-facts end -->
                                <!-- inline-facts  -->
                                <div class="inline-facts-wrap">
                                    <div class="inline-facts">
                                        <i class="fal fa-thumbs-up"></i>
                                        <div class="milestone-counter">
                                            <div class="stats animaper">
                                                <div class="num" data-content="0" data-num="12168">12168</div>
                                            </div>
                                        </div>
                                        <h6>Toplam Ziyaret</h6>
                                    </div>
                                </div>
                                <!-- inline-facts end -->
                                <!-- inline-facts  -->
                                <div class="inline-facts-wrap">
                                    <div class="inline-facts">
                                        <i class="fal fa-award"></i>
                                        <div class="milestone-counter">
                                            <div class="stats animaper">
                                                <div class="num" data-content="0" data-num="172">172</div>
                                            </div>
                                        </div>
                                        <h6>Ön Kayıt </h6>
                                    </div>
                                </div>
                                <!-- inline-facts end -->
                                <!-- inline-facts  -->
                                <div class="inline-facts-wrap">
                                    <div class="inline-facts">
                                        <i class="fal fa-hotel"></i>
                                        <div class="milestone-counter">
                                            <div class="stats animaper">
                                                <div class="num" data-content="0" data-num="732">732</div>
                                            </div>
                                        </div>
                                        <h6>Kurum Sayısı</h6>
                                    </div>
                                </div>
                                <!-- inline-facts end -->
                            </div>
                        </div>
                    </section>
                    <section class="color-bg hidden-section">
                        <div class="wave-bg wave-bg2"></div>
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6">
                                    <!-- -->
                                    <div class="colomn-text  pad-top-column-text fl-wrap">
                                        <div class="colomn-text-title">
                                            <h3>Uygulamamız Çok Yakında</h3>
                                            <p>Mobil Uygulamamız Android ve İOS olarak çok yayında hizmetinizde...</p>
                                            <a href="#" class=" down-btn color3-bg"><i class="fab fa-apple"></i>iPhone</a>
                                            <a href="#" class=" down-btn color3-bg"><i class="fab fa-android"></i>Android</a>
                                        </div>
                                    </div>
                                    <!--process-wrap   end-->                                
                                </div>
                                <div class="col-md-6">
                                    <div class="collage-image">
                                        <img src="/templates/default/img/api.png" class="main-collage-image" alt="">
                                        <div class="images-collage-title color3-bg">KURSARABUL<span></span></div>
                                        <div class="collage-image-min cim_1"><img src="/medias/hotel/small/2/ozel-nisantasi-fen-ve-teknoloji-anadolu-lisesi-1.jpg" alt=""></div>
                                        <div class="collage-image-min cim_2"><img src="/medias/hotel/small/3/img-8413.jpg" alt=""></div>
                                        <div class="collage-image-min cim_3"><img src="/medias/hotel/small/18/logo-nisantasi.png" alt=""></div>
                                        <div class="collage-image-input">Ara <i class="fa fa-search"></i></div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <?php 
                        
                    ?>

                   <section>
                        <div class="container">
                            <div class="section-title">
                                <div class="section-title-separator"><span></span></div>
                                <h2>Yorumlar</h2>
                                <span class="section-separator"></span>
                                <p></p>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <!--slider-carousel-wrap -->
                        <div class="slider-carousel-wrap text-carousel-wrap fl-wrap">
                            <div class="swiper-button-prev sw-btn"><i class="fal fa-long-arrow-left"></i></div>
                            <div class="swiper-button-next sw-btn"><i class="fal fa-long-arrow-right"></i></div>
                            <div class="text-carousel single-carousel fl-wrap">
                                <!--slick-item -->
                                <?php
                                    $result_comments = $db->query('SELECT * FROM pm_comment WHERE  checked = 1  ORDER BY id');
                                    if($result_comments !== false){
                                        $nb_comments = $db->last_row_count();
                                        
                                        $comments_id = 0;
                                        
                                      
                                        foreach($result_comments as $i => $row){
                                            $comment_id = $row['id'];
                                            $comment_name = $row['name'];
                                            $comment_message = $row['msg'];
                                            ?>
                                <div class="slick-item">
                                    <div class="text-carousel-item">
                                        
                                        <div class="listing-rating card-popup-rainingvis" data-starrating2="5"> </div>
                                        <div class="review-owner fl-wrap"><?php echo $comment_name ?>  - <span>Veli</span></div>
                                        <p> "<?php echo $comment_message ?>"</p>
                                        <a href="#" class="testim-link"></a>
                                    </div>
                                </div>
                                <?php 
                                        }
                                    }
                                ?>
                                <!--slick-item end -->
                                <!--slick-item -->
                                <!--item end -->
                            </div>
                        </div>
                        <!--slider-carousel-wrap end-->
                    </section>
                    <section class="parallax-section" data-scrollax-parent="true">
                        <div class="bg"  data-bg="/templates/default/img/image23.jpg" data-scrollax="properties: { translateY: '100px' }"></div>
                        <div class="overlay"></div>
                        <!--container-->
                        <div class="container">
                            <div class="row">
                                <div class="col-md-8">
                                    <!-- column text-->
                                    <div class="colomn-text fl-wrap">
                                        <div class="colomn-text-title">
                                            <h3>Kurs Merkezinizi Eklemek İstermisiniz?</h3>
                                            <p>Öğrencilere Kolay Ulaşmak İçin Lütfen Üye Olunuz.</p>
                                            <div class="btn  color-bg float-btn show-reg-form modal-open">Ekle<i class="fal fa-check"></i></a>
                                        </div>
                                    </div>
                                    <!--column text   end-->
                                </div>
                            </div>
                        </div>
                    </section>
                    <section class=" middle-padding">
                        <div class="container">
                            <div class="section-title">
                                <div class="section-title-separator"><span></span></div>
                                <h2>Bloglar</h2>
                                <span class="section-separator"></span>
                                <p></p>
                            </div>
                            <div class="row home-posts">
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
                                
                                if($nb_articles > 0){           
                            ?>
                              <?php
                        $article_id = 0;
                        $result_article_file = $db->prepare('SELECT * FROM pm_article_file WHERE id_item = :article_id AND checked = 1 AND lang = '.DEFAULT_LANG.' AND type = \'image\' AND file != \'\' ORDER BY rank LIMIT 1');
                        $result_article_file->bindParam(':article_id', $article_id);
                        foreach($result_article as $i => $row){
                            $article_id = $row['id'];
                            $article_title = $row['title'];
                            $article_publish_date = $row['publish_date'];
                            $article_alias = $row['alias'];
                            $char_limit = ($i == 0) ? 1200 : 500;
                            $article_text = strtrunc(strip_tags($row['text'], '<p><br>'), $char_limit, true, '');
                            $article_page = $row['id_page'];
                          ;
                            $hiit =$row['hit'];
                            
                            
                            if(isset($pages[$article_page])){
                                $article_alias = (empty($article_url)) ? DOCBASE.$pages[$article_page]['alias'].'/'.text_format($article_alias) : $article_url;
                                 $target = (strpos($article_alias, 'http') !== false) ? '_blank' : '_self';
                                 if(strpos($article_alias, getUrl(true)) !== false) $target = '_self'; 
                            
                               ?>
                            
                                <div class="col-md-4">  
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
                                    <article class="card-post">
                                        <div class="card-post-img fl-wrap">
                                            <a href="blog-single.html"><img  src="<?php echo $thumbpath; ?>"   alt="<?php echo $label; ?>"></a>
                                        </div>
                                        <?php
                                          }
                                        } ?>
                                        <div class="card-post-content fl-wrap">
                                            <h3><a href="<?php echo $article_alias; ?>"><?php echo $article_title; ?></a></h3>
                                            <p><?php echo $article_text; ?></p>
                                            <div class="post-author"><a href="#"><img src="images/avatar/1.jpg" alt=""><span></span></a></div>
                                            <div class="post-opt">
                                            <?php 
                                            $sorgu = $db->prepare("SELECT * FROM pm_article Where id=:id");
                                            $sorgu->execute(array(
                                            "id" => $id
                                            ));
                                            $islem = $sorgu->fetch(PDO::FETCH_ASSOC);
                                            
                                            ?>
                                                <ul>
                                                    <li><i class="fal fa-calendar"></i> <span><?php echo date('Y-m-d', $article_publish_date);?></span></li>
                                                    <li><i class="fal fa-eye"></i> <span><?php echo $hiit; ?></span></li>
                                                    <li><i class="fal fa-tags"></i> <a href="#">Design</a>  </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </article>
                                    <?php 
                                                  
                                            }
                                    ?>
                                </div>
                            
                            <?php 
                                                    }
                                                }
                                            }
                            
                            ?>
                            </div>
                            <a href="blog.html" class="btn    color-bg ">Tümünü Gör<i class="fal fa-caret-right"></i></a>
                        </div>
                        <div class="section-decor"></div>
                    </section>
