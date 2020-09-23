<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT, POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, origin, accept');

include_once '../../config/Database.php';
include_once '../../models/Post_article.php';

$database = new Database();
$db = $database->connect();

$posted = new Post($db);

// Получаем запощенную строку

$data = json_decode(file_get_contents("php://input"));


  $posted->id = $data->id;
  $posted->title = $data->title;
  $posted->descr = $data->descr;
  $posted->authors = $data->authors;
  $posted->shortdescr = $data->shortdescr;





if($posted->update()){
    echo json_encode(
        array('message' => $posted->descr)
    );
} else {

    echo json_encode(
        array('message' => "Good")
    );
}
