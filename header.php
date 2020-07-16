<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Camagru</title>
    <script src="./templates/js/script.js"></script>
    <link rel="stylesheet" href="templates/css/style.css">
    <style>
        body {
            background: #e2e2e2;
            position: relative;
        }
        .nav_bar {
            height: 70px;
            width: 100%;
        }
        .top_bar {
            /* padding-right: 50px; */
            display: flex;
            justify-content: flex-end;
        }
        .nav_bar a {
            color: #e2e2e2;
            margin-left: 3vw;
            text-transform: uppercase;
            letter-spacing: .1vw;
            font-size: 3vw;
            transition: .5s ease all;
            opacity: 1;
            font-family: 'Roboto', sans-serif;
            transform:  translateY(30px);
        }
        @media (min-width: 900px) {
            .nav_bar a {
                font-size: 25px;
            }
        }
        .nav_bar .current_nav::after {
            content: "";
            position: absolute;
            bottom: -3px;
            left: 0;
            height: 2px;
            width: 100%;
            background-color: purple;
            animation: opacit .5s forwards;
        }
        @keyframes opacit {
            0% {
                width: 0;
            }
            100% {
                width: 100%;
            }
        }
        a {
            text-decoration: none;
            /* color: #fff; */
        }
    </style>
<body>
<section class="header">
    <div class="nav_bar">
        <div class="top_bar">
            <!-- <a href="/login.html"><div class="nav_el login">login</div></a>
            <a href="/logout.php"><div class="nav_el logout">logout</div></a>
            <a href="/settings.php"><div class="nav_el settings">settings</div></a>
            <a href="/upload.php"><div class="nav_el upload">upload</div></a>
            <a href="/index.php"><div class="nav_el gallery">gallery</div></a> -->
        </div>
    </div>
</section>