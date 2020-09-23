<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, origin, accept');
header('Access-Control-Max-Age: OPTIONS');
include_once '../../config/Database.php';
include_once '../../models/Post.php';

$database = new Database();
$db = $database->connect();

$post = new Post($db);

// Получаем запощенную строку

$data = json_decode(file_get_contents("php://input"));
$post->id = $data->id;
$post->title = $data->title;
$post->img = $data->img;
$post->descr = $data->descr;
$post->manufacturer = $data->manufacturer;
$post->units = $data->units;
$post->cost = $data->cost;
$post->place = $data->place;
$post->points =  $data->points;
$post->category = $data->category;
$post->manufurl = $manufurl->manufurl;

if($post->create()){
    echo json_encode(
        array('message' => 'Post Created')
    );
} else {
    echo json_encode(
        array('message' => 'Post Not Created')
    );
}
