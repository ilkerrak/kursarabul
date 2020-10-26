<?php try {
    $db = new PDO('mysql:host=localhost;dbname=u9414702_kursmerkezi;charset=utf8', 'u9414702_kursmerkezi', 'fgGJ$3LEl%Fg');
} catch (PDOException $e ){
    die($e->getMessage());
}

$term = $_GET['term'];

$query = $db->query('SELECT * FROM pm_hotel
WHERE lang=4 and checked = 1 and title LIKE "%' . $term . '%"', PDO::FETCH_ASSOC);

if ( $query->rowCount() ){

    $data = array();

    foreach ( $query as $row ){
        $data[] = array(
            'value' => $row['title'] ,
            'hotel_adi'=> $row['title'],
            'hotel_id' => $row['lang'],
            'alias' => $row['alias'],
            'city' => $row['city'],
            'state' => $row['state'],
            'id_destination' => $row['id_destination'],
           
        );
    }

    echo json_encode($data);

}
?>