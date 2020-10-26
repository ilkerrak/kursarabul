<?php
if(isset($_POST['book']) || (ENABLE_BOOKING_REQUESTS == 1 && isset($_POST['request']))){
    
    if(isset($_SESSION['book'])) unset($_SESSION['book']);
    $num_nights = $_POST['nights'];
    
    $_SESSION['book']['hotel'] = $_POST['hotel'];
    $_SESSION['book']['hotel_id'] = $_POST['id_hotel'];
    $_SESSION['book']['from_date'] = $_POST['from_time'];
    $_SESSION['book']['to_date'] = $_POST['to_time'];
    $_SESSION['book']['nights'] = $num_nights;
    $_SESSION['book']['adults'] = $_POST['adults'];
    $_SESSION['book']['children'] = $_POST['children'];
    $_SESSION['book']['extra_services'] = array();
    $_SESSION['book']['activities'] = array();
    $_SESSION['book']['rooms'] = array();
    
    $_SESSION['book']['total'] = 0;
    
    if(isset($_POST['book'])){
		
		$_SESSION['book']['adults'] = 0;
		$_SESSION['book']['children'] = 0;
        
        $_SESSION['book']['amount_rooms'] = 0;
        $_SESSION['book']['amount_activities'] = 0;
        $_SESSION['book']['amount_services'] = 0;
        
        $_SESSION['book']['duty_free_rooms'] = 0;
        $_SESSION['book']['duty_free_activities'] = 0;
        $_SESSION['book']['duty_free_services'] = 0;
       
        $_SESSION['book']['tax_rooms_amount'] = 0;
        $_SESSION['book']['tax_activities_amount'] = 0;
        $_SESSION['book']['tax_services_amount'] = 0;
        
        $_SESSION['book']['discount'] = 0;
        $_SESSION['book']['discount_type'] = '';
        $_SESSION['book']['discount_amount'] = 0;
        
        $_SESSION['book']['taxes'] = array();
        
        $_SESSION['book']['sessid'] = uniqid();
        
        $num_rooms = 0;
        $num_adults = 0;
        $num_children = 0;
        
        if(isset($_POST['amount']) && is_array($_POST['amount'])){
            foreach($_POST['amount'] as $id_room => $values){
                foreach($values as $i => $value){
                    
                    if(isset($_POST['num_adults'][$id_room][$i]) && isset($_POST['num_children'][$id_room][$i]) && isset($_POST['room_'.$id_room])){
                            
                        $room_title = $_POST['room_'.$id_room];
                        $adults = $_POST['num_adults'][$id_room][$i];
                        $children = $_POST['num_children'][$id_room][$i];
                        $duty_free = $_POST['duty_free'][$id_room][$i];
                        
                        if(is_numeric($adults) && is_numeric($children) && ($adults+$children) > 0 && $value > 0){
                            $num_adults += $adults;
                            $num_rooms++;
                            
                            $data = array();
                            $data['id'] = null;
                            $data['id_room'] = $id_room;
                            $data['from_date'] = $_POST['from_time'];
                            $data['to_date'] = $_POST['to_time'];
                            $data['add_date'] = time();
                            $data['sessid'] = $_SESSION['book']['sessid'];
                            
                            $result_room_lock = db_prepareInsert($db, 'pm_room_lock', $data);
                            $result_room_lock->execute();
                            
                            $_SESSION['book']['rooms'][$id_room][$i]['title'] = $room_title;
                            $_SESSION['book']['rooms'][$id_room][$i]['adults'] = $adults;
                            $_SESSION['book']['rooms'][$id_room][$i]['children'] = $children;
                            $_SESSION['book']['rooms'][$id_room][$i]['amount'] = $value;
                            $_SESSION['book']['rooms'][$id_room][$i]['duty_free'] = $duty_free;
                            $_SESSION['book']['rooms'][$id_room][$i]['tax_rate'] = 0;
                            $_SESSION['book']['rooms'][$id_room][$i]['child_age'] = array();
                            
                            if(isset($_POST['child_age'][$id_room][$i])){
                                foreach($_POST['child_age'][$id_room][$i] as $age){
                                    if($age != '')
                                        $_SESSION['book']['rooms'][$id_room][$i]['child_age'][] = $age;
                                }
                                $children = count($_SESSION['book']['rooms'][$id_room][$i]['child_age']);
                            }
                            $num_children += $children;
                            $_SESSION['book']['rooms'][$id_room][$i]['children'] = $children;
                            
                            $_SESSION['book']['adults'] += $adults;
                            $_SESSION['book']['children'] += $children;
                            
                            $_SESSION['book']['taxes'] = array();
                            
                            if(isset($_POST['taxes'][$id_room][$i])){
                                $taxes = $_POST['taxes'][$id_room][$i];
                                if(is_array($taxes)){
                                    foreach($taxes as $tax_id => $tax_amount){
                                        $_SESSION['book']['tax_rooms_amount'] += $tax_amount;
                                        if(!isset($_SESSION['book']['taxes'][$tax_id]['rooms'])) $_SESSION['book']['taxes'][$tax_id]['rooms'] = 0;
                                        $_SESSION['book']['taxes'][$tax_id]['rooms'] += $tax_amount;
                                    }
                                }
                            }
                            $_SESSION['book']['amount_rooms'] += $value;
                            $_SESSION['book']['duty_free_rooms'] += $duty_free;
                        }
                    }
                }
            }
            $_SESSION['book']['num_rooms'] = $num_rooms;
        }
        
        $tourist_tax = (TOURIST_TAX_TYPE == 'fixed') ? $_SESSION['book']['adults']*$num_nights*TOURIST_TAX : $_SESSION['book']['amount_rooms']*TOURIST_TAX/100;
        
        $_SESSION['book']['tourist_tax'] = (ENABLE_TOURIST_TAX == 1) ? $tourist_tax : 0;
        
        $_SESSION['book']['total'] = $_SESSION['book']['duty_free_rooms']+$_SESSION['book']['tax_rooms_amount']+$_SESSION['book']['tourist_tax'];
        $_SESSION['book']['down_payment'] = (ENABLE_DOWN_PAYMENT == 1 && DOWN_PAYMENT_RATE > 0 && $_SESSION['book']['total'] >= DOWN_PAYMENT_AMOUNT) ? $_SESSION['book']['total']*DOWN_PAYMENT_RATE/100 : 0;
    }
    
    if(isset($_SESSION['book']['id'])) unset($_SESSION['book']['id']);

    $result_activity = $db->query('SELECT * FROM pm_activity WHERE hotels REGEXP \'(^|,)'.$_SESSION['book']['hotel_id'].'(,|$)\' AND checked = 1 AND lang = '.LANG_ID);
    if(isset($_SESSION['book']['activities'])) unset($_SESSION['book']['activities']);
    
    if($result_activity !== false && $db->last_row_count() > 0){
        $_SESSION['book']['activities'] = array();
        header('Location: '.DOCBASE.$sys_pages['booking-activities']['alias']);
    }else
        header('Location: '.DOCBASE.$sys_pages['details']['alias']);
    
    exit();
}

$field_notice = array();
$msg_error = '';
$msg_success = '';
$room_stock = 1;
$max_people = 30;
$search_limit = 8;
$search_offset = (isset($_GET['offset']) && is_numeric($_GET['offset'])) ? $_GET['offset'] : 0;

/*********** Num adults ************/
if(isset($_POST['num_adults']) && is_numeric($_POST['num_adults'])) $_SESSION['num_adults'] = $_POST['num_adults'];
elseif(isset($_GET['adults']) && is_numeric($_GET['adults'])) $_SESSION['num_adults'] = $_GET['adults'];
elseif(isset($_SESSION['book']['adults'])) $_SESSION['num_adults'] = $_SESSION['book']['adults'];
elseif(!isset($_SESSION['num_adults'])) $_SESSION['num_adults'] = 1;

/********** Num children ***********/
if(isset($_POST['num_children']) && is_numeric($_POST['num_children'])) $_SESSION['num_children'] = $_POST['num_children'];
elseif(isset($_GET['children']) && is_numeric($_GET['children'])) $_SESSION['num_children'] = $_GET['children'];
elseif(isset($_SESSION['book']['children'])) $_SESSION['num_children'] = $_SESSION['book']['children'];
elseif(!isset($_SESSION['num_children'])) $_SESSION['num_children'] = 0;

/****** Check in / out date ********/
if(isset($_SESSION['book']['from_date'])) $from_time = $_SESSION['book']['from_date'];
else $from_time = gmtime();

if(isset($_SESSION['book']['to_date'])) $to_time = $_SESSION['book']['to_date'];
else $to_time = gmtime()+86400;

if(isset($_POST['from_date']) && !empty($_POST['from_date'])) $_SESSION['from_date'] = htmlentities($_POST['from_date'], ENT_QUOTES, 'UTF-8');
elseif(isset($_GET['from'])) $_SESSION['from_date'] = gmdate('d/m/Y', gm_strtotime(htmlentities($_GET['from'], ENT_QUOTES, 'UTF-8')));
elseif(!isset($_SESSION['from_date'])) $_SESSION['from_date'] = gmdate('d/m/Y', $from_time);

if(isset($_POST['to_date']) && !empty($_POST['to_date'])) $_SESSION['to_date'] = htmlentities($_POST['to_date'], ENT_QUOTES, 'UTF-8');
elseif(isset($_GET['to'])) $_SESSION['to_date'] = gmdate('d/m/Y', gm_strtotime(htmlentities($_GET['to'], ENT_QUOTES, 'UTF-8')));
elseif(!isset($_SESSION['to_date'])) $_SESSION['to_date'] = gmdate('d/m/Y', $to_time);

/********** Searched hotel *********/
if(isset($_POST['hotel_id']) && is_numeric($_POST['hotel_id'])) $_SESSION['hotel_id'] = $_POST['hotel_id'];
elseif(isset($_GET['hotel']) && is_numeric($_GET['hotel'])) $_SESSION['hotel_id'] = $_GET['hotel'];
elseif(isset($_SESSION['hotel_id']) && is_numeric($_SESSION['hotel_id'])) $_SESSION['hotel_id'] = $_SESSION['hotel_id'];
elseif(!isset($_SESSION['hotel_id'])) $_SESSION['hotel_id'] = 0;

/******* Price range (/night) ******/
$price_min = null;
$price_max = null;
if(isset($_POST['price_range'])) $_SESSION['price_range'] = $_POST['price_range'];
elseif(!isset($_SESSION['price_range'])) $_SESSION['price_range'] = '0-0';

$price_range = explode(' - ', $_SESSION['price_range']);
if(count($price_range) == 2){
    $price_min = number_format($price_range[0]/CURRENCY_RATE, 2, '.', '');
    $price_max = number_format($price_range[1]/CURRENCY_RATE, 2, '.', '');
}

/******* Class range (stars) *******/
$class_min = null;
$class_max = null;
if(isset($_POST['class_range'])) $_SESSION['class_range'] = $_POST['class_range'];
elseif(!isset($_SESSION['class_range'])) $_SESSION['class_range'] = '0-5';

$class_range = explode(' - ', $_SESSION['class_range']);
if(count($class_range) == 2){
    $class_min = number_format($class_range[0], 2, '.', '');
    $class_max = number_format($class_range[1], 2, '.', '');
}

/****** Searched destinatation *****/
if(isset($_POST['destination_id']) && is_numeric($_POST['destination_id'])){
    $_SESSION['destination_id'] = $_POST['destination_id'];
    $destination_name = db_getFieldValue($db, 'pm_destination', 'name', $_SESSION['destination_id']);
}elseif(!isset($_SESSION['destination_id'])){
    $_SESSION['destination_id'] = 0;
    $destination_name = '';
}
/****** Searched destinatation *****/
if(isset($_POST['schoollevel_id']) && is_numeric($_POST['schoollevel_id'])){
    $_SESSION['schoollevel_id'] = $_POST['schoollevel_id'];
    $schoollevel_name = db_getFieldValue($db, 'pm_schoollevel', 'name', $_SESSION['schoollevel_id']);
}elseif(!isset($_SESSION['schoollevel_id'])){
    $_SESSION['schoollevel_id'] = 0;
    $schoollevel_name = '';
}


/******** Destinatation URL ********/
if($article_alias != ''){
    $result_destination = $db->query('SELECT * FROM pm_destination WHERE checked = 1 AND lang = '.LANG_ID.' AND alias = '.$db->quote($article_alias));
    if($result_destination !== false && $db->last_row_count() > 0){
        $destination = $result_destination->fetch(PDO::FETCH_ASSOC);
        $destination_id = $destination['id'];
        $article_id = $destination_id;
        $destination_name = $destination['name'];
        $title_tag = $destination['title_tag'];
        $page_title = $destination['title'];
        $page_subtitle = $destination['subtitle'];
        $page_alias = $page['alias'].'/'.text_format($destination['alias']);
        $_SESSION['destination_id'] = $destination_id;
    }else err404();
}else{
    if(isset($_SESSION['destination_id'])){
        $result_destination = $db->query('SELECT * FROM pm_destination WHERE checked = 1 AND lang = '.LANG_ID.' AND alias != \'\' AND id = '.$_SESSION['destination_id']);
        if($result_destination !== false && $db->last_row_count() > 0){
            $destination = $result_destination->fetch(PDO::FETCH_ASSOC);
            $page_alias = $page['alias'].'/'.text_format($destination['alias']);
            if($search_offset > 0) $page_alias .= '?offset='.$search_offset;
            header('Location:'.DOCBASE.$page_alias);
            exit();
        }
    }
}

$num_people = $_SESSION['num_adults']+$_SESSION['num_children'];

if(!is_numeric($_SESSION['num_adults'])) $field_notice['num_adults'] = $texts['REQUIRED_FIELD'];
if(!is_numeric($_SESSION['num_children'])) $field_notice['num_children'] = $texts['REQUIRED_FIELD'];

if($_SESSION['from_date'] == '') $field_notice['dates'] = $texts['REQUIRED_FIELD'];
else{
    $time = explode('/', $_SESSION['from_date']);
    if(count($time) == 3) $time = gm_strtotime($time[2].'-'.$time[1].'-'.$time[0].' 00:00:00');
    if(!is_numeric($time)) $field_notice['dates'] = $texts['REQUIRED_FIELD'];
    else $from_time = $time;
}
if($_SESSION['to_date'] == '') $field_notice['dates'] = $texts['REQUIRED_FIELD'];
else{
    $time = explode('/', $_SESSION['to_date']);
    if(count($time) == 3) $time = gm_strtotime($time[2].'-'.$time[1].'-'.$time[0].' 00:00:00');
    if(!is_numeric($time)) $field_notice['dates'] = $texts['REQUIRED_FIELD'];
    else $to_time = $time;
}

$today = gm_strtotime(gmdate('Y').'-'.gmdate('n').'-'.gmdate('j').' 00:00:00');

if($from_time < $today || $to_time < $today || $to_time <= $from_time){
    $from_time = $today;
    $to_time = $today+86400;
    $_SESSION['from_date'] = gmdate('d/m/Y', $from_time);
    $_SESSION['to_date'] = gmdate('d/m/Y', $to_time);
}

if(is_numeric($from_time) && is_numeric($to_time)){
    $num_nights = ($to_time-$from_time)/86400;
}else
    $num_nights = 0;

$hotel_ids = array();
$room_ids = array();

if(count($field_notice) == 0){

   /* if($num_nights <= 0) $msg_error .= $texts['NO_AVAILABILITY'];
    else{
        require_once(getFromTemplate('common/functions.php', false));
        $res_hotel = getRoomsResult($from_time, $to_time, $_SESSION['num_adults'], $_SESSION['num_children']);

        if(empty($res_hotel)) $msg_error .= $texts['NO_AVAILABILITY'];
        else $_SESSION['res_hotel'] = $res_hotel;
    }*/
}

$id_room = 0;

$result_room_rate = $db->prepare('SELECT MIN(price) as min_price FROM pm_rate WHERE id_room = :id_room');
$result_room_rate->bindParam(':id_room', $id_room);

$id_hotel = 0;

$result_budget_room = $db->prepare('SELECT * FROM pm_room WHERE id_hotel = :id_hotel AND checked = 1 AND lang = '.LANG_ID);
$result_budget_room->bindParam(':id_hotel', $id_hotel);

$hidden_hotels = array();
$hidden_rooms = array();
$room_prices = array();
$hotel_prices = array();
$result_budget_hotel = $db->query('SELECT * FROM pm_hotel WHERE checked = 1 AND lang = '.LANG_ID);
if($result_budget_hotel !== false){
    foreach($result_budget_hotel as $i => $row){
        $id_hotel = $row['id'];
        $hotel_min_price = 0;
        $hotel_max_price = 0;
        $result_budget_room->execute();
        if($result_budget_room !== false){
            foreach($result_budget_room as $row){
                
                $id_room = $row['id'];
                $room_price = $row['price'];
                $max_people = $row['max_people'];
                $min_people = $row['min_people'];
                $max_adults = $row['max_adults'];
                $max_children = $row['max_children'];
                
                if(!isset($res_hotel[$id_hotel][$id_room])
                || isset($res_hotel[$id_hotel][$id_room]['error'])
                || ($_SESSION['num_adults']+$_SESSION['num_children'] > $max_people)
                || ($_SESSION['num_adults']+$_SESSION['num_children'] < $min_people)
                || ($_SESSION['num_adults'] > $max_adults)
                || ($_SESSION['num_children'] > $max_children)){
                    $amount = $room_price;
                    $result_room_rate->execute();
                    if($result_room_rate !== false && $db->last_row_count() > 0){
                        $row = $result_room_rate->fetch();
                        if($row['min_price'] > 0) $amount = $row['min_price'];
                    }
                    $full_price = 0;
                    $type = $texts['NIGHT'];
                    $price_night = $amount;
                }else{
                    $amount = $res_hotel[$id_hotel][$id_room]['amount']+$res_hotel[$id_hotel][$id_room]['fixed_sup'];
                    $full_price = $res_hotel[$id_hotel][$id_room]['full_price']+$res_hotel[$id_hotel][$id_room]['fixed_sup'];
                    $type = $num_nights.' '.$texts['NIGHTS'];
                    $price_night = $amount/$num_nights;
                }
                
                if((!empty($price_min) && $price_night < $price_min) || (!empty($price_max) && $price_night > $price_max)) $hidden_rooms[] = $id_room;
                else{
                    $room_prices[$id_room]['amount'] = $amount;
                    $room_prices[$id_room]['full_price'] = $full_price;
                    $room_prices[$id_room]['type'] = $type;
                }
                if(empty($hotel_min_price) || $price_night < $hotel_min_price) $hotel_min_price = $price_night;
                if(empty($hotel_max_price) || $price_night > $hotel_max_price) $hotel_max_price = $price_night;
            }
        } 
        if((!empty($price_min) && $hotel_max_price < $price_min) || (!empty($price_max) && $hotel_min_price > $price_max)) $hidden_hotels[] = $id_hotel;
        $hotel_prices[$id_hotel] = $hotel_min_price;
    }
}

$result_rating = $db->prepare('SELECT AVG(rating) as avg_rating FROM pm_comment WHERE item_type = \'hotel\' AND id_item = :id_hotel AND checked = 1 AND rating > 0 AND rating <= 5');
$result_rating->bindParam(':id_hotel', $id_hotel);
                
$id_facility = 0;
$result_facility_file = $db->prepare('SELECT * FROM pm_facility_file WHERE id_item = :id_facility AND checked = 1 AND lang = '.DEFAULT_LANG.' AND type = \'image\' AND file != \'\' ORDER BY rank LIMIT 1');
$result_facility_file->bindParam(':id_facility', $id_facility);

$room_facilities = '0';
$result_room_facilities = $db->prepare('SELECT * FROM pm_facility WHERE lang = '.LANG_ID.' AND FIND_IN_SET(id, :room_facilities) ORDER BY rank LIMIT 18');
$result_room_facilities->bindParam(':room_facilities', $room_facilities);

$hotel_facilities = '0';
$result_hotel_facilities = $db->prepare('SELECT * FROM pm_facility WHERE lang = '.LANG_ID.' AND FIND_IN_SET(id, :hotel_facilities) ORDER BY rank LIMIT 8');
$result_hotel_facilities->bindParam(':hotel_facilities', $hotel_facilities);

$query_room = 'SELECT * FROM pm_room WHERE id_hotel = :id_hotel AND checked = 1 AND lang = '.LANG_ID;
if(!empty($hidden_rooms)) $query_room .= ' AND id NOT IN('.implode(',', $hidden_rooms).')';
$query_room .= ' ORDER BY';
if(!empty($room_ids)) $query_room .= ' CASE WHEN id IN('.implode(',', $room_ids).') THEN 3 ELSE 4 END,';
$query_room .= ' rank';
$result_room = $db->prepare($query_room);
$result_room->bindParam(':id_hotel', $id_hotel);

$result_room_file = $db->prepare('SELECT * FROM pm_room_file WHERE id_item = :id_room AND checked = 1 AND lang = '.LANG_ID.' AND type = \'image\' AND file != \'\' ORDER BY rank');
$result_room_file->bindParam(':id_room', $id_room);

$result_hotel_file = $db->prepare('SELECT * FROM pm_hotel_file WHERE id_item = :id_hotel AND checked = 1 AND lang = '.LANG_ID.' AND type = \'image\' AND file != \'\' ORDER BY rank LIMIT 1');
$result_hotel_file->bindParam(':id_hotel', $id_hotel);

$query_hotel = 'SELECT * FROM pm_hotel WHERE checked = 1 AND lang = '.LANG_ID;
if($_SESSION['destination_id'] > 0) $query_hotel .= ' AND id_destination = '.$_SESSION['destination_id'];
if($_SESSION['schoollevel_id'] > 0) $query_hotel .= ' AND id_schoollevel = '.$_SESSION['schoollevel_id'];
if(!empty($class_min)) $query_hotel .= ' AND class >= '.$class_min;
if(!empty($class_max)) $query_hotel .= ' AND class <= '.$class_max;
if(isset($_GET['hotel']) && is_numeric($_GET['hotel'])) $query_hotel .= ' AND id = '.$_GET['hotel'];
if(!empty($hidden_hotels)) $query_hotel .= ' AND id NOT IN('.implode(',', $hidden_hotels).')';
$query_hotel .= ' ORDER BY';
if($_SESSION['hotel_id'] != 0 && !isset($_GET['hotel'])) $query_hotel .= ' CASE WHEN id = '.$_SESSION['hotel_id'].' THEN 1 ELSE 4 END,';
if(!empty($hotel_ids)) $query_hotel .= ' CASE WHEN id IN('.implode(',', $hotel_ids).') THEN 3 ELSE 4 END,';
$query_hotel .= ' rank';

$num_results = 0;
$result_hotel = $db->query($query_hotel);
if($result_hotel !== false){
    $num_results = $db->last_row_count();
    
    $visible_hotels = $result_hotel->fetchAll(PDO::FETCH_COLUMN, 0);
    if(!empty($visible_hotels)){
        $visible_hotels = array_intersect_key($hotel_prices, array_flip($visible_hotels));
        $subtitle = str_replace('{min_price}', formatPrice(min($visible_hotels)*CURRENCY_RATE), $texts['BEST_RATES_SUBTITLE']);
        if($article_id > 0) $page_subtitle = $subtitle;
        else $page['subtitle'] = $subtitle;
    }
}

$query_hotel .= ' LIMIT '.$search_limit.' OFFSET '.$search_offset;

$result_hotel = $db->query($query_hotel);

if($result_hotel !== false && $db->last_row_count() == 0){
    $msg_error .= $texts['NO_HOTEL_FOUND'];
    if($destination_name != '') $msg_error .= ' '.$texts['FOR'].' <b>'.$destination_name.'</b>';
}

$query_destination = 'SELECT * FROM pm_destination WHERE';
if($_SESSION['destination_id'] > 0) $query_destination .= ' id != '.$_SESSION['destination_id'].' AND';
$query_destination .= ' checked = 1 AND lang = '.LANG_ID.' ORDER BY rand() LIMIT 5';

$nb_destinations = 0;
$result_destination = $db->query($query_destination, PDO::FETCH_ASSOC);
if($result_destination !== false)
    $nb_destinations = $db->last_row_count();

if(isset($_GET['action'])){
	if(isset($_SESSION['book'])) unset($_SESSION['book']);
    if($_GET['action'] == 'confirm')
        $msg_success .= $texts['PAYMENT_SUCCESS_NOTICE'];
    elseif($_GET['action'] == 'cancel')
        $msg_error .= $texts['PAYMENT_CANCEL_NOTICE'];
}

$query_schoollevel = 'SELECT * FROM pm_schoollevel WHERE';
if($_SESSION['schoollevel_id'] > 0) $query_schoollevel .= ' id != '.$_SESSION['schoollevel_id'].' AND';
$query_schoollevel .= ' checked = 1 AND lang = '.LANG_ID.' ORDER BY rand() LIMIT 5';

$nb_schoollevels = 0;
$result_schoollevel = $db->query($query_schoollevel, PDO::FETCH_ASSOC);
if($result_schoollevel !== false)
    $nb_schoollevels = $db->last_row_count();

if(isset($_GET['action'])){
	if(isset($_SESSION['book'])) unset($_SESSION['book']);
    if($_GET['action'] == 'confirm')
        $msg_success .= $texts['PAYMENT_SUCCESS_NOTICE'];
    elseif($_GET['action'] == 'cancel')
        $msg_error .= $texts['PAYMENT_CANCEL_NOTICE'];
}
?>
                                                <div class="ajax-modal-wrap fl-wrap">
                                                    <div class="ajax-modal-close"><i class="fal fa-times"></i></div>
                                                    <!--ajax-modal-item-->
                                                    <div class="ajax-modal-item fl-wrap">
                                                        <div class="ajax-modal-media fl-wrap">
                                                            <img src="images/gal/1.jpg" alt="">
                                                            <div class="ajax-modal-title">
                                                                <div class="section-title-separator"><span></span></div>
                                                                Standard Family Room
                                                            </div>
                                                            <div class="ajax-modal-photos-btn dynamic-gal" data-dynamicPath="[{'src': 'images/gal/slider/1.jpg'}, {'src': 'images/gal/slider/1.jpg'},{'src': 'images/gal/slider/1.jpg'}]">Photos (<span>3</span>)</div>
                                                        </div>
                                                        <div class="ajax-modal-list fl-wrap">
                                                            <ul>
                                                                <li>
                                                                    <i class="fal fa-user-alt"></i>
                                                                    <h5><span>3</span> Persons</h5>
                                                                </li>
                                                                <li>
                                                                    <i class="fal fa-chalkboard"></i>
                                                                    <h5><span>52</span> Ft²</h5>
                                                                </li>
                                                                <li>
                                                                    <i class="fal fa-bath"></i>
                                                                    <h5><span>1</span> Bathroom</h5>
                                                                </li>
                                                                <li>
                                                                    <i class="fal fa-hand-holding-usd"></i>
                                                                    <h5><span>81$</span> / Per Night</h5>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="ajax-modal-details fl-wrap">
                                                            <!--ajax-modal-details-box-->
                                                            <div class="ajax-modal-details-box">
                                                                <h3>Details</h3>
                                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in pulvinar neque. Nulla finibus lobortis pulvinar. Donec a consectetur nulla. Nulla posuere sapien vitae lectus suscipit, et pulvinar nisi tincidunt. Aliquam erat volutpat. Curabitur convallis fringilla diam sed aliquam. Sed tempor iaculis massa faucibus feugiat. In fermentum facilisis massa, a consequat purus viverra.</p>
                                                            </div>
                                                            <!--ajax-modal-details-box end-->
                                                            <!--ajax-modal-details-box-->
                                                            <div class="ajax-modal-details-box">
                                                                <h3>Room Amenities</h3>
                                                                <div class="listing-features fl-wrap">
                                                                    <ul>
                                                                        <li><i class="fal fa-wifi"></i> Free WiFi</li>
                                                                        <li><i class="fas fa-glass-martini-alt"></i> Mini Bar</li>
                                                                        <li><i class="fal fa-snowflake"></i>Air Conditioner</li>
                                                                        <li><i class="fal fa-tv"></i><span>Tv Inside</li>
                                                                        <li><i class="fal fa-concierge-bell"></i> Breakfast</li>
                                                                        <li><i class="fal fa-paw"></i> Pet Friendly</li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <!--ajax-modal-details-box end-->
                                                            <a href="booking-single.html" class="btn float-btn color2-bg">Book Now<i class="fas fa-caret-right"></i></a>                            
                                                        </div>
                                                    </div>
                                                    <!--ajax-modal-item-->
                                                </div>
                                                <!--ajax-modal-wrap end --> 
                                                    