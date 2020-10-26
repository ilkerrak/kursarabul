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

    $query_schoollevel = 'SELECT * FROM pm_schoollevel WHERE lang = '.LANG_ID.' AND checked = 1';
    $query_schoollevel .= ' ORDER BY rank LIMIT '.($lz_offset-1)*$lz_limit.', '.$lz_limit;
    $result_schoollevel = $db->query($query_schoollevel);

    $schoollevel_id = 0;

    $result_schoollevel_file = $db->prepare('SELECT * FROM pm_schoollevel_file WHERE id_item = :schoollevel_id AND checked = 1 AND lang = '.LANG_ID.' AND type = \'image\' AND file != \'\' ORDER BY rank LIMIT 1');
    $result_schoollevel_file->bindParam(':schoollevel_id', $schoollevel_id);
    
    $result_rate = $db->prepare('
        SELECT MIN(ra.price) as min_price
        FROM pm_rate as ra, pm_hotel as h, pm_schoollevel as d
        WHERE id_hotel = h.id
            AND id_schoollevel = d.id
            AND id_schoollevel = :schoollevel_id');
    $result_rate->bindParam(':schoollevel_id', $schoollevel_id);

    foreach($result_schoollevel as $i => $row){
                                
        $schoollevel_id = $row['id'];
        $schoollevel_name = $row['name'];
        $schoollevel_title = $row['title'];
        $schoollevel_alias = $row['alias'];
        
        $schoollevel_alias = DOCBASE.$my_page_alias.'/'.text_format($schoollevel_alias);
        
       
    }
    if(isset($_POST['ajax']) && $_POST['ajax'] == 1)
        echo json_encode(array('html' => $html));
    else
        echo $html;
}
