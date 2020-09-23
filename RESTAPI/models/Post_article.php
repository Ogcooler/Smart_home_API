<?php
header('Access-Control-Allow-Origin: *');
class Post {
private $conn;
public $id;
public $title;
public $img;
public $descr;
public $shortdescr;
public $authors;
public $dateart;



public function __construct($db){
    $this->conn = $db;
}

public function read() {
    $query = 'SELECT * FROM Articles';

    $stmt = $this->conn->prepare($query);

    $stmt->execute();

    return $stmt;
}

//Получим один дом
public function read_single(){
    $query = 'SELECT * FROM Articles WHERE id = ? LIMIT 0,1';

    $stmt = $this->conn->prepare($query);
    //Bind ID
    $stmt->bindParam(1, $this->id);

    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $this->title = $row['title'];
    $this->img = $row['img'];
    $this->descr = $row['descr'];
    $this->shortdescr = $row['shortdescr'];
    $this->authors = $row['authors'];
    $this->dateart = $row['dateart'];

}

//Добавим новый умный дом

public function create() {
    $query = 'INSERT INTO Articles
    SET
    title = :title,
    img = :img,
    descr = :descr,
    shortdescr = :shortdescr,
    authors = :authors,
    dateart = :dateart';

    $stmt = $this->conn->prepare($query);

    $tmp_file = $_FILES["user_image"]["tmp_name"];
    $img_name = $_FILES["user_image"]["name"];
    $title_key = $_POST["title"];
    $descr_key = $_POST["descr"];
    $short_descr = $_POST["shortdescr"];
    $authors_key = $_POST["authors"];
    $date = date("F j, Y, g:i a");

    $this->title = $title_key;
    $this->descr = $descr_key;
    $this->img = $img_name;
    $this->shortdescr = $short_descr;
    $this->authors = $authors_key;
    $this->dateart = $date;


    $upload_dir = "./artimages/".$img_name;
    move_uploaded_file($tmp_file, $upload_dir);

    //Проверка на теги и html
    $this->title = htmlspecialchars(strip_tags($this->title));
    $this->img = htmlspecialchars(strip_tags($this->img));
    $this->shortdescr = htmlspecialchars(strip_tags($this->shortdescr));
    $this->authors = htmlspecialchars(strip_tags($this->authors));
    $this->dateart = htmlspecialchars(strip_tags($this->dateart));





    //Bind data
    $stmt->bindParam(':title', $this->title);
    $stmt->bindParam(':img', $this->img);
    $stmt->bindParam(':descr', $this->descr);
    $stmt->bindParam(':shortdescr', $this->shortdescr);
    $stmt->bindParam(':authors', $this->authors);
    $stmt->bindParam(':dateart', $this->dateart);

    if($stmt->execute()){
        return true;
    }

    //Вывод ошибки в случае косяка

    printf("Error: %s.\n", $stmt->error);

    return false;
}


public function update(){
  $query = 'UPDATE Articles SET title =:title, descr =:descr, authors =:authors, shortdescr =:shortdescr WHERE id =:id';

  $statment2 = $this->conn->prepare($query);
  $res2 = $statment2->execute([
      ':title' => $this->title,
      ':descr' => $this->descr,
      ':authors' => $this->authors,
      ':shortdescr' => $this->shortdescr,
      ':id' => $this->id,
  ]);

}

public function delete(){

    $query = 'DELETE FROM Articles WHERE id = :id';

    $stmt = $this->conn->prepare($query);

    $this->id = htmlspecialchars(strip_tags($this->id));

    $stmt->bindParam(':id', $this->id);

    if($stmt->execute()){
        return true;
    }

    printf("Error: %s.\n", $stmt->error);

    return false;
}


}
