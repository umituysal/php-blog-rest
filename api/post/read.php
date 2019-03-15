<?php 
  
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../model/Post.php';

  // database tabımla ve baglan
  $database = new Database();
  $db = $database->connect();
  // blog post class olustur.
  $post = new Post($db);
  // post class read fonksiyonunu calıstır
  $result = $post->read();
  // satırdaki verilerin sayısını döndürür
  $num = $result->rowCount();
  // kontrolünü yapıyoruz
  if($num > 0) {
    // Post array
    $posts_arr = array();
    // bürün verileri row atar
    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
       // POST ile gelen değerleri değişken olarak kullanmamızı sağlar.
      extract($row);
      $post_item = array(
        'id' => $id,
        'title' => $title,
        'body' => html_entity_decode($body),
        'author' => $author,
        'category_id' => $category_id,
        'category_name' => $category_name
      );
      // post_itemdeki verileri posts_arr ye ekler 
      array_push($posts_arr, $post_item);
     
    }
    // burada json cıktı dönüstürür.
    echo json_encode($posts_arr);
  } else {
    
    echo json_encode(
      array('message' => 'veri post edilmedi')
    );
  }
