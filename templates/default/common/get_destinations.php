<?php
/**
 * Script called (Ajax) on scroll or click
 * loads more content with Lazy Loader
 */
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
}
    
if(isset($db) && $db !== false){
    
    $my_page_alias = $sys_pages['booking']['alias'];

    $query_destination = 'SELECT * FROM pm_destination WHERE lang = '.LANG_ID.' AND checked = 1';
    $query_destination .= ' ORDER BY rank LIMIT '.($lz_offset-1)*$lz_limit.', '.$lz_limit;
    $result_destination = $db->query($query_destination);

    $destination_id = 0;

    $result_destination_file = $db->prepare('SELECT * FROM pm_destination_file WHERE id_item = :destination_id AND checked = 1 AND lang = '.LANG_ID.' AND type = \'image\' AND file != \'\' ORDER BY rank ');
    $result_destination_file->bindParam(':destination_id', $destination_id);
    
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
        $destination_title = $row['title'];
        $destination_alias = $row['alias'];
        $destination_descr = $row['descr'];
        
        $destination_alias = DOCBASE.$my_page_alias.'/'.text_format($destination_alias);
        
        $html .= '
        <div class="listing-item has_two_column has_one_column">
        <article class="geodir-category-listing fl-wrap">
        <div class="geodir-category-img">';
        if($result_destination_file->execute() !== false && $db->last_row_count() > 0){
            $row = $result_destination_file->fetch(PDO::FETCH_ASSOC);
            
            $file_id = $row['id'];
            $filename = $row['file'];
            $label = $row['label'];
            
            $realpath = SYSBASE.'medias/destination/medium/'.$file_id.'/'.$filename;
            $thumbpath = DOCBASE.'medias/destination/medium/'.$file_id.'/'.$filename;
            $zoompath = DOCBASE.'medias/destination/big/'.$file_id.'/'.$filename;
            
            if(is_file($realpath)){
            $html .= '
            <a href="'.$destination_alias.'"><img src="'.$thumbpath.'" alt="'.$label.'"></a>
            <div class="listing-avatar"><a href="'.$destination_alias.'"><img src="'.$thumbpath.'" alt="'.$destination_name.'"></a>
                <span class="avatar-tooltip"> <strong>'.$destination_name.'</strong></span>
            </div>';
                }
            }       
            $html .= '
           
            
        </div>
        <div class="geodir-category-content fl-wrap title-sin_item">
            <div class="geodir-category-content-title fl-wrap">
                <div class="geodir-category-content-title-item">
                    <h3 class="title-sin_map"><a href="'.$destination_alias.'">'.$destination_name.'</a></h3>
                    <div class="geodir-category-location fl-wrap"><a href="#" class="map-item"></a></div>
                </div>
            </div>
            <p>'.$destination_descr.'</p>
            
            <div class="geodir-category-footer fl-wrap">';
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
    </div>';
    }
    if(isset($_POST['ajax']) && $_POST['ajax'] == 1)
        echo json_encode(array('html' => $html));
    else
        echo $html;
}
