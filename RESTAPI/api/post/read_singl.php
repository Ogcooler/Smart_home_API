<?php header('Access-Control-Allow-Origin: *');
header('Access-Control-Max-Age: OPTIONS');


include_once '../../config/Database.php';
include_once '../../models/Post.php';

$database = new Database();
$db = $database->connect();

$post = new Post($db);

//Получаем объект умного дома

$post = new Post($db);

//Получаем ID
$post->id = isset($_GET['id']) ? $_GET['id'] : die('Что-то не то');

// Получаем post
$post->read_single();

$post_arr = array(
    'id' => $post->id,
    'title' => $post->title,
    'img' => $post->img,
    'descr' => $post->descr,
    'manufacturer' => $post->manufacturer,
    'units' => $post->units,
    'cost' => $post->cost,
    'place' => $post->place,
    'points' => $post->points,
    'category' => $post->category,
    'manufurl' => $post->manufurl

);

print_r(json_encode($post_arr, JSON_UNESCAPED_UNICODE));