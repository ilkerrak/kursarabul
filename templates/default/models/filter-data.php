<?php


$stylesheets[] = array("file" => DOCBASE."js/plugins/isotope/css/style.css", "media" => "all");
$javascripts[] = DOCBASE."js/plugins/isotope/jquery.isotope.min.js";
$javascripts[] = DOCBASE."js/plugins/isotope/jquery.isotope.sloppy-masonry.min.js";

$stylesheets[] = array("file" => DOCBASE."js/plugins/lazyloader/lazyloader.css", "media" => "all");
$javascripts[] = DOCBASE."js/plugins/lazyloader/lazyloader.js";


 ?>
<script type="text/javascript" src="http://code.jquery.com/ui/1.10.1/jquery-ui.min.js"></script>


<?php
$result = $db->query('SELECT * FROM pm_hotel WHERE checked = 1 AND lang = '.LANG_ID.' AND alias = '.$db->quote($article_alias));
if($result !== false && $db->last_row_count() == 1){
    
    $hotel = $result->fetch(PDO::FETCH_ASSOC);
    
    $hotel_id = $hotel['id'];
    $article_id = $hotel_id;
    $title_tag = $hotel['title'].' - '.$title_tag;
    $page_title = $hotel['title'];
    $page_subtitle = '';
    $page_alias = $pages[$page_id]['alias'].'/'.text_format($hotel['alias']);
    
    $result_hotel_file = $db->query('SELECT * FROM pm_hotel_file WHERE id_item = '.$hotel_id.' AND checked = 1 AND lang = '.DEFAULT_LANG.' AND type = \'image\' AND file != \'\' ORDER BY rank LIMIT 1');
    if($result_hotel_file !== false && $db->last_row_count() > 0){
        
        $row = $result_hotel_file->fetch();
        
        $file_id = $row['id'];
        $filename = $row['file'];
        
        if(is_file(SYSBASE.'medias/hotel/medium/'.$file_id.'/'.$filename))
            $page_img = getUrl(true).DOCBASE.'medias/hotel/medium/'.$file_id.'/'.$filename;
    }
    
}




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
$html = '';
if(!isset($lz_offset)) $lz_offset = 1;
if(!isset($lz_limit)) $lz_limit = 30;
if(isset($_POST['ajax']) && $_POST['ajax'] == 1){
    
    require_once('../../../common/lib.php');
    require_once('../../../common/define.php');

    if(isset($_POST['offset']) && is_numeric($_POST['offset'])
    && isset($_POST['limit']) && is_numeric($_POST['limit'])){
        $lz_offset = $_POST['offset'];
        $lz_limit =	$_POST['limit'];
    }
    if(isset($_POST['destination']) && is_numeric($_POST['destination'])) $destination_id = $_POST['destination'];
    if(isset($_POST['schoollevel']) && is_numeric($_POST['schoollevel'])) $schoollevel_id = $_POST['schoollevel'];
}
if(isset($db) && $db !== false){
    
    $my_page_alias = $sys_pages['hotels']['alias'];

    $query_hotel = 'SELECT * FROM pm_hotel WHERE lang = '.LANG_ID.' AND checked = 1';
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
        $hotel_facilities= $row['facilities'];
        
        $hotel_alias = DOCBASE.$my_page_alias.'/'.text_format($hotel_alias);
        

        $lat1=$_COOKIE["lat1"]; 
        $lon1=$_COOKIE["lon1"];
        $lat2=$hotel_lat;
        $lon2=$hotel_lng;
        $location_echo = round(deneme($lat1, $lon1, $lat2, $lon2, "K"),0);
        


if(isset($_POST["action"]))
{
 $query = "
  SELECT * FROM ph_hotel WHERE checked = '1' ";

 }
 if(isset($_POST["city"]))
 {
  $cityfilter = implode("','", $_POST["city"]);
  $query .= "
   AND name IN('".$cityfilter."')
  ";
 }


 $statement = $db->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 $total_row = $statement->rowCount();
 $output = '';
 if($total_row > 0)
 {
  foreach($result as $row)
  {
   $output .= '
   <div class="listing-item">
   <article class="geodir-category-listing fl-wrap">
   <div class="geodir-category-img">';
   if($result_hotel_file->execute() !== false && $db->last_row_count() > 0){
       $row = $result_hotel_file->fetch(PDO::FETCH_ASSOC);
       
       $file_id = $row['id'];
       $filename = $row['file'];
       $label = $row['label'];
       
       $realpath = SYSBASE.'medias/hotel/medium/'.$file_id.'/'.$filename;
       $thumbpath = DOCBASE.'medias/hotel/medium/'.$file_id.'/'.$filename;
       $zoompath = DOCBASE.'medias/hotel/big/'.$file_id.'/'.$filename;
       
       if(is_file($realpath)){
       $html .= '
       <a href="'.$hotel_alias.'"><img src="'.$thumbpath.'" alt="'.$label.'"></a>
       <div class="listing-avatar"><a href="'.$hotel_alias.'"><img src="'.$thumbpath.'" alt="'.$hotel_title.'"></a>
           <span class="avatar-tooltip">Added By  <strong>'.$hotel_title.'</strong></span>
       </div>';
           }
       } 
    
       $html .= '
       <div class="sale-window"><i style="padding-right:5px;" class="fal fa-map-marker-alt"></i>'.$location_echo.' km yakınında</div>
       <div class="geodir-category-opt">
           <div class="listing-rating card-popup-rainingvis" data-starrating2="5"></div>
           <div class="rate-class-name">';
           $nb_comments = 0;
           $item_type = 'hotel';
           $item_id = $id_hotel;
           $allow_comment = ALLOW_COMMENTS;
           $allow_rating = ALLOW_RATINGS;
           if($allow_comment == 1){
               $result_comment = $db->query('SELECT * FROM pm_comment WHERE id_item = '.$item_id.' AND item_type = \''.$item_type.'\' AND checked = 1 ORDER BY add_date DESC');
               if($result_comment !== false)
                   $nb_comments = $db->last_row_count();
           }if($nb_comments > 0){ 
               $html .= '<div class="score"><strong>'.$nb_comments.' Yorum </strong></div>'; 
           }else{
               $html .= '<div class="score"><strong>Yorum Yok </strong></div>';
               }
               $html .= '<span>5.0</span>                                             
           </div>
       </div>
   </div>
   <div class="geodir-category-content fl-wrap title-sin_item">
       <div class="geodir-category-content-title fl-wrap">
           <div class="geodir-category-content-title-item">
               <h3 class="title-sin_map"><a href="'.$hotel_alias.'">'.$hotel_title.'</a></h3>';
              
                  
                   $result_destinations = $db->prepare('SELECT * FROM pm_hotel as h INNER JOIN pm_destination as d ON h.id_destination = d.id WHERE  checked = 1  ORDER BY id');
                    foreach($result_destinations as $row){
                       $des_name=$row['name'];
                   $html.='
                   <div class="geodir-category-location fl-wrap"><a href="#" class="map-item"><i class="fal fa-map-marker-alt"> '.$hotel_state.'</i> </a></div>';
                    }
               $html.='   
           </div>
       </div>
       <p>'.$hotel_descr.'</p>
       <ul class="facilities-list fl-wrap">';
       $result = $db->query('SELECT * FROM pm_hotel WHERE checked = 1 AND lang = '.LANG_ID.' AND alias = '.$db->quote($article_alias));
       
                       $result_facility = $db->query('SELECT * FROM pm_facility WHERE lang = '.LANG_ID.' AND id IN('.$hotel_facilities.') ORDER BY id LIMIT 5' ,PDO::FETCH_ASSOC);
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
                                       
                                   if(is_file($realpath)){ 
$html.='
           <li><img style="filter:opacity(0.5); width:75%;" alt="" title="'.$facility_name.'" src="'.$thumbpath.'"> <span>'.$facility_name.'</span></li>';         
                             }
                               }
                           }
                       }
       $html.='</ul><div class="geodir-category-footer fl-wrap">';
       $min_price = 0;
       if($result_rate->execute() !== false && $db->last_row_count() > 0){
           $row = $result_rate->fetch();
           $price = $row['min_price'];
           if($price > 0) $min_price = $price;
       }
       $html .= '
           <div class="geodir-category-price">Fiyat <span>'.formatPrice($min_price*CURRENCY_RATE).'</span></div>
           <div class="geodir-opt-list">
               <a href="#" class="single-map-item" data-newlatitude="40.72956781" data-newlongitude="-73.99726866"><i class="fal fa-map-marker-alt"></i><span class="geodir-opt-tooltip">On the map</span></a>
               <a href="#" class="geodir-js-favorite"><i class="fal fa-heart"></i><span class="geodir-opt-tooltip">Save</span></a>
               <a href="#" class="geodir-js-booking"><i class="fal fa-exchange"></i><span class="geodir-opt-tooltip">Find Directions</span></a>
           </div>
       </div>
   </div>
</article>
</div>
   ';
    }

  }
  else
  {
   $output = '<h3>No Data Found</h3>';
  }
  echo $output;
}
}



?>
