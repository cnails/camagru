<?php
    session_start();
    require_once("db.php");

    if ($_GET['user'] && $_GET['pwd']) {
        $user = $_GET['user'];
        $pwd = hash('whirlpool', $_GET['pwd']);
        // $query = ;
        $s = $db->prepare("SELECT * FROM `user` WHERE username=? and pwd=? LIMIT 1");
        $s->bind_param("ss", $user, $pwd);
        $s->execute();
        $result = $s->get_result();
        $res = mysqli_num_rows($result);
        $result = $result->fetch_assoc();
        $s->close();
        if (!$res) {
            echo json_encode(false);
            return;
        }
        $_SESSION['name'] = $user;
        $_SESSION['id'] = $result['id'];
        $_SESSION['likes'] = array();
        echo json_encode(true);
    } else {
        echo json_encode(false);
    }    
?>
