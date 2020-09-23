<?php header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Max-Age: OPTIONS');
// Headers


include_once '../../config/Database.php';
include_once '../../models/Post.php';

$database = new Database();
$db = $database->connect();

$post = new Post($db);
//запрос на вывод умных домов
$result = $post->read();
//получить кол-во умных домов
$num = $result->rowCount();

if($num > 0){

    $posts_arr = array();
    $posts_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $post_item = array(
            'id' => $id,
            'title' => $title,
            'img' => $img,
            'descr' => $descr,
            'manufacturer' => $manufacturer,
            'units' => $units,
            'cost' => $cost,
            'place' => $place,
            'points' => $points,
            'category' => $category,
            'manufurl' => $manufurl
        );
        
        array_push($posts_arr['data'], $post_item);
    }

    
    echo json_encode($posts_arr, JSON_UNESCAPED_UNICODE); 
} else {
    echo json_encode(
        array('message' => 'No Posts Found')
    );

    


}