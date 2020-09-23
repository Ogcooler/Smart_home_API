<?php
header('Access-Control-Allow-Origin: *');
class Post {
private $conn;
private $table = 'Homes';
public $id;
public $title;
public $img;
public $descr;
public $manufacturer;
public $units;
public $cost;
public $place;
public $points;
public $category;
public $manufurl;



public function __construct($db){
    $this->conn = $db;
}

public function read() {
    $query = 'SELECT * FROM Homes';

    $stmt = $this->conn->prepare($query);

    $stmt->execute();

    return $stmt;
}

//Получим один дом
public function read_single(){
    $query = 'SELECT * FROM Homes WHERE id = ? LIMIT 0,1';

    $stmt = $this->conn->prepare($query);
    //Bind ID
    $stmt->bindParam(1, $this->id);

    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $this->title = $row['title'];
    $this->img = $row['img'];
    $this->descr = $row['descr'];
    $this->manufacturer = $row['manufacturer'];
    $this->units = $row['units'];
    $this->cost = $row['cost'];
    $this->place = $row['place'];
    $this->points = $row['points'];
    $this->category = $row['category'];
    $this->manufurl = $row['manufurl'];

}

//Добавим новый умный дом

public function create() {
    $query = 'INSERT INTO Homes
    SET
    title = :title,
    img = :img,
    descr = :descr,
    manufacturer = :manufacturer,
    units = :units,
    cost = :cost,
    place = :place,
    points = :points,
    category = :category,
    manufurl = :manufurl';

    $stmt = $this->conn->prepare($query);

    $tmp_file = $_FILES["user_image"]["tmp_name"];
    $img_name = $_FILES["user_image"]["name"];
    $title_key = $_POST["title"];
    $descr_key = $_POST["descr"];
    $manufacturer_key = $_POST["manufacturer"];
    $units = $_POST["units"];
    $cost = $_POST["cost"];
    $place = $_POST["place"];
    $points = $_POST["points"];
    $category = $_POST["category"];
    $manufurl = $_POST["manufurl"];

    $this->title = $title_key;
    $this->descr = $descr_key;
    $this->manufacturer = $manufacturer_key;
    $this->img = $img_name;
    $this->units = $units;
    $this->cost = $cost;
    $this->place = $place;
    $this->points = $points;
    $this->category = $category;
    $this->manufurl = $manufurl;

    $upload_dir = "./images/".$img_name;
    move_uploaded_file($tmp_file, $upload_dir);

    //Проверка на теги и html
    $this->title = htmlspecialchars(strip_tags($this->title));
    $this->img = htmlspecialchars(strip_tags($this->img));
    $this->descr = htmlspecialchars(strip_tags($this->descr));
    $this->manufacturer = htmlspecialchars(strip_tags($this->manufacturer));
    $this->units = htmlspecialchars(strip_tags($this->units));
    $this->cost = htmlspecialchars(strip_tags($this->cost));
    $this->place = htmlspecialchars(strip_tags($this->place));
    $this->points = htmlspecialchars(strip_tags($this->points));
    $this->category = htmlspecialchars(strip_tags($this->category));
    $this->manufurl = htmlspecialchars(strip_tags($this->manufurl));




    //Bind data
    $stmt->bindParam(':title', $this->title);
    $stmt->bindParam(':img', $this->img);
    $stmt->bindParam(':descr', $this->descr);
    $stmt->bindParam(':manufacturer', $this->manufacturer);
    $stmt->bindParam(':units', $this->units);
    $stmt->bindParam(':cost', $this->cost);
    $stmt->bindParam(':place', $this->place);
    $stmt->bindParam(':points', $this->points);
    $stmt->bindParam(':category', $this->category);
    $stmt->bindParam(':manufurl', $this->manufurl);

    if($stmt->execute()){
        return true;
    }

    //Вывод ошибки в случае косяка

    printf("Error: %s.\n", $stmt->error);

    return false;
}

public function update() {
    $query = 'UPDATE Homes
    SET
    title = :title,
    img = :img,
    descr = :descr,
    manufacturer = :manufacturer,
    units = :units,
    cost = :cost,
    place = :place,
    points = :points,
    category = :category,
    manufurl = :manufurl
    WHERE id = :id';

    $stmt = $this->conn->prepare($query);

    $id = $_POST["id"];
    $tmp_file = $_FILES["user_image"]["tmp_name"];
    $img_name = $_FILES["user_image"]["name"];
    $title_key = $_POST["title"];
    $descr_key = $_POST["descr"];
    $manufacturer_key = $_POST["manufacturer"];
    $units = $_POST["units"];
    $cost = $_POST["cost"];
    $place = $_POST["place"];
    $points = $_POST["points"];
    $category = $_POST["category"];
    $manufurl = $_POST["manufurl"];

    $this->id = $id;
    $this->title = $title_key;
    $this->descr = $descr_key;
    $this->manufacturer = $manufacturer_key;
    $this->img = $img_name;
    $this->units = $units;
    $this->cost = $cost;
    $this->place = $place;
    $this->points = $points;
    $this->category = $category;
    $this->manufurl = $manufurl;

    $upload_dir = "./images/".$img_name;
    move_uploaded_file($tmp_file, $upload_dir);

    //Проверка на теги и html
    $this->title = htmlspecialchars(strip_tags($this->title));
    $this->img = htmlspecialchars(strip_tags($this->img));
    $this->descr = htmlspecialchars(strip_tags($this->descr));
    $this->manufacturer = htmlspecialchars(strip_tags($this->manufacturer));
    $this->units = htmlspecialchars(strip_tags($this->units));
    $this->cost = htmlspecialchars(strip_tags($this->cost));
    $this->place = htmlspecialchars(strip_tags($this->place));
    $this->points = htmlspecialchars(strip_tags($this->points));
    $this->category = htmlspecialchars(strip_tags($this->category));
    $this->id = htmlspecialchars(strip_tags($this->id));
    $this->manufurl = htmlspecialchars(strip_tags($this->manufurl));

    //Bind data
    $stmt->bindParam(':title', $this->title);
    $stmt->bindParam(':img', $this->img);
    $stmt->bindParam(':descr', $this->descr);
    $stmt->bindParam(':manufacturer', $this->manufacturer);
    $stmt->bindParam(':units', $this->units);
    $stmt->bindParam(':cost', $this->cost);
    $stmt->bindParam(':place', $this->place);
    $stmt->bindParam(':points', $this->points);
    $stmt->bindParam(':id', $this->id);
    $stmt->bindParam(':category', $this->category);
    $stmt->bindParam(':manufurl', $this->manufurl);

    if($stmt->execute()){
        return true;
    }

    //Вывод ошибки в случае косяка

    printf("Error: %s.\n", $stmt->error);

    return false;
}

public function delete(){

    $query = 'DELETE FROM Homes WHERE id = :id';

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
