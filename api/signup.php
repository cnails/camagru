<?php
    session_start();
    require_once("db.php");

    // $query = "SELECT * FROM users WHERE username=? OR email=? LIMIT 1";
    // $stmt = $conn->prepare($query);
    // $stmt->bind_param('ss', $username, $password);
    // if ($stmt->execute()) {
    //     $result = $stmt->get_result();
    //     $user = $result->fetch_assoc();
    
    // $query = "INSERT INTO users SET username=?, email=?, token=?, password=?";
    // $stmt = $conn->prepare($query);
    // $stmt->bind_param('ssss', $username, $email, $token, $password);
    // $result = $stmt->execute();
    // return json_encode("hello");
    
    // $query = "SELECT * FROM `user`";
    // $stmt = $db->query($query);
    // echo $stmt->fetch_assoc();
    require_once("send_email.php");

    if ($_GET['user'] && $_GET['pwd'] && $_GET['email']) {
        $user = $_GET['user'];
        $query = "SELECT * FROM `user` WHERE username='$user' LIMIT 1";
        $stmt = $db->query($query);
        $email = $_GET['email'];
        if (count($stmt->fetch_assoc()) > 0) {
            echo "login";
            return;
        }
        $query = "SELECT * FROM `user` WHERE email='$email' LIMIT 1";
        $stmt = $db->query($query);
        if (count($stmt->fetch_assoc()) > 0) {
            echo "email";
            return;
        }
        // $_SESSION['name'] = $user;
        // $_SESSION['likes'] = array();
        send_email($email, "Click on link for verify your email:<br>http://localhost/api/confirmation.php?token=".$token);
        $pwd = hash('whirlpool', $_GET['pwd']);
        $token = bin2hex(random_bytes(50));
        $_SESSION['token'] = $token;
        $query = "INSERT INTO `user` (username, email, pwd, confirm, token, notif) VALUES ('$user', '$email', '$pwd', 0, '$token', 1)";
        $stmt = $db->query($query);
        echo json_encode(true);
    } else {
        echo json_encode(false);
    }
?>
