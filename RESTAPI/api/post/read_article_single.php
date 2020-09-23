<?php header('Access-Control-Allow-Origin: *');
header('Access-Control-Max-Age: OPTIONS');


include_once '../../config/Database.php';
include_once '../../models/Post_article.php';

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
    'shortdescr' => $post->shortdescr,
    'authors' => $post->authors,
    'dateart' => $post->dateart

);

print_r(json_encode($post_arr, JSON_UNESCAPED_UNICODE));