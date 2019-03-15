<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type:application/json');

include_once('../../config/Database.php');//include_once ile eklediğimiz sayfa ikini eklediğimizde php yorumlayıcısı ikinci eklediğimizi görmezden gelecektir
include_once('../../model/Post.php');

$database=new Database();
$db=$database->connect();

$post=new Post($db);
//id alınıyor isset fonksiyonu değeri olup olmadığını denetliyor.

$post->id=isset($_GET['id']) ? $_GET['id']:die();
//read_single fonksiyonunu çalıştıyoruz ve veriyi getiriyoryz.
$post->read_single();
//bu formatta çağırıyoruz
$post_arr=array(
    'id' => $post->id,
    'title' => $post->title,
    'body' => $post->body,
    'author' => $post->author,
    'category_id' => $post->category_id,
    'category_name' => $post->category_name
);

//sonucu json yap
print_r(json_encode($post_arr));