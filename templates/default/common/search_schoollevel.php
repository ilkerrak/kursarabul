<?php
require_once('../../../common/lib.php');
require_once('../../../common/define.php');

if(isset($_GET['q']) && $_GET['q'] != ''){
    
	$q = $_GET['q'];
    
	$query_schoollevel = db_getSearchRequest($db, 'pm_schoollevel', array('name'), $q, 6, 0, 'lang = '.LANG_ID, '', '', '', 1);
	$result_schoollevel = $db->query($query_schoollevel);
	if($result_schoollevel !== false){
		foreach($result_schoollevel as $row){
			$schoollevel_id	= $row['id'];
			$schoollevel_name = $row['name'];
			
			echo '<a href="#" class="live-search-result" data-id="'.$schoollevel_id.'" data-descr="'.$schoollevel_name.'">'.highlight($schoollevel_name, $q).'</a>';
		}
	}
}
