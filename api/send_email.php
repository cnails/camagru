<?php
    function send_email($email, $data) {
        mail($email, "Camagru info", $data, "From: admin@localhost.ru");
    }
?>
