<?php
    // $img = $_GET['img'];
    // $extension = pathinfo($img, PATHINFO_EXTENSION);
    // move_uploaded_file($_GET['img'], "1.".$extension);
    // echo $_GET['img'];
    session_start();
    // print_r($_POST);
    include("merge_imgs.php");
    require_once("api/db.php");

    $img = file_get_contents("php://input");
    $img = str_replace('data:image/png;base64,', '', $img);
    $img = str_replace(' ', '+', $img);
    $img = base64_decode($img);
    $author = $_SESSION['name'];
    $image_name = rand(50, 999999);
    $image_name = $image_name.".png";
    if (!file_exists("img")) {
        mkdir("img");
    }
    file_put_contents("img/".$image_name, $img);
    $db->query("INSERT INTO `post` (author, likes, comments, img) VALUES ('$author', 0, 0, '$image_name')");
    // $image = $_FILES['image'];
    // if ($image['size'] > 0 && $image['error'] == 0) {
    //     $author = $_SESSION['name'];
    //     $extension = pathinfo($image['name'], PATHINFO_EXTENSION);
    //     $image_name = rand(50, 999999);
    //     $image_name = $image_name.".".$extension;
    //     move_uploaded_file($image['tmp_name'], $image_name);
    // }
    // $img = base64_decode(split(",", file_get_contents("php://input"))[1]);
    // file_put_contents("1.png", $img);
    // echo file_get_contents("php://input");
    // echo $_FILES['image']['size'];
    // if (isset($_GET["img"]))
    // {
    //     // Get the data
    //     $imageData=$_GET['img'];


    //     $filteredData=substr($imageData, strpos($imageData, ",")+1);

    //     $unencodedData=base64_decode($filteredData);

    //     $random_digit=md5(uniqid(mt_rand(), true));

    //     $fp = fopen( $random_digit.'.png', 'wb' );
    //     fwrite( $fp, $unencodedData);
    //     fclose( $fp );
    //     echo "OK";
    // }
    // echo $_FILES['file'];
    // echo "KO";
?>
