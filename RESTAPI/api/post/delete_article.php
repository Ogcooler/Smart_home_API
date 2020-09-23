<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, origin, accept');
header('Access-Control-Max-Age: OPTIONS');
include_once '../../config/Database.php';
include_once '../../models/Post_article.php';

$database = new Database();
$db = $database->connect();

$post = new Post($db);

// Получаем запощенную строку

$data = json_decode(file_get_contents("php://input"));
$post->id = $data->id;


if($post->delete()){
    echo json_encode(
        array('message' => 'Post deleted')
    );
} else {
    echo json_encode(
        array('message' => 'Something wrong. Dont fuck up bro')
    );
}