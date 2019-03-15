<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');// Ajax’la data gönderirken X-Requested-With diye bir header da gönderiyor

include_once '../../config/Database.php';
include_once '../../model/Post.php';

$database=new Database();
$db=$database->connect();

$post=new Post($db);

$data=json_decode(file_get_contents("php://input"));

$post->title=$data->title;
$post->body=$data->body;
$post->author=$data->author;
$post->category_id=$data->category_id;

if($post->create()){
    echo json_encode(
        array('message'=>'veri oluşturuldu.')
    );
}else {
    echo json_encode(
        array('message','veri olusturulamadı')
    );    
}