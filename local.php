<?php
    session_start();
    $link = "http://localhost/api/confirmation.php?token=".$_SESSION['token'];
    echo "function 'mail' dont work on localhost, there's link for confirm your mail - <a href='$link'>click</a>";
?>
