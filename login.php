<?php session_start();
    if ($_SESSION['name']) {
        header("Location: index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Camagru</title>
    <link href="https://fonts.googleapis.com/css2?family=Notable&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./templates/css/style.css">
    <script src="templates/js/script.js"></script>
    <style>

        .filt {
            position: relative;
            filter: url(#filt);
            width: 100%;
            height: 100%;
        }
        .pointer {
            z-index: 1000;
            position: absolute;
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background-image: linear-gradient(aqua, bisque);
            box-shadow: 0 0 190px aquamarine;
        }
        #pointer_2 {
            width: 70px;
            height: 70px;
        }
        .bubble {
            z-index: 3;
            position: absolute;
            width: 70px;
            height: 70px;
            box-shadow: 0 0 100px aquamarine;
            background-image: linear-gradient(aqua, bisque);
            border-radius: 50%;
        }
         .btn_span {
            z-index: 100;
            position: absolute;
            background: purple;
            box-shadow: 0 0 100px purple;
            transform: translate(-50%, -50%);
            pointer-events: none;
            border-radius: 50%;
            animation: animate 1s linear infinite;   
        }
        .container.active .btn_span {
            background: #ffee22;

        }
        @keyframes animate {
            0% {
                width: 0;
                height: 0;
                opacity: 0.7;
            }
            100% {
                height: 1000px;
                width: 1000px;
                opacity: 0;
                background: red;
            }
        }
        .b1 {
            width: 90px;
            height: 90px;
            animation: bubble_1 20s infinite;
            /* animation-delay: 1s; */
        }
        .b2 {
            background-image: linear-gradient(to left, aqua, bisque);
            animation: bubble_2 18s infinite;
            /* animation-delay: 2s; */
        }
        .b3 {
            animation: bubble_3 20s infinite;
            animation-delay: .3s;
        }
        .b4 {
            background-image: linear-gradient(to left, aqua, bisque);
            width: 120px;
            height: 120px;
            animation: bubble_4 16s infinite;
            animation-delay: .7s;
        }
        .b5 {
            background-image: linear-gradient(to left, aqua, bisque);
            width: 100px;
            height: 100px;
            animation: bubble_5 15s infinite;
            /* animation-delay: 5s; */
        }
        .b6 {
            background-image: linear-gradient(to right, aqua, bisque);
            width: 80px;
            height: 80px;
            animation: bubble_6 17s infinite;
        }
        @keyframes bubble_1 {
            0% {
                top: 200px;
                left: 300px;
            }
            25% {
                top: 120px;
                left: 40px;
            }
            50% {
                top: 10px;
                left: 10px;
            }
            100% {
                top: 200px;
                left: 300px;
            }
        }
        @keyframes bubble_2 {
            0% {
                top: 330px;
                left: 20px;
            }
            25% {
                top: 20px;
                left: 200px;
            }
            50% {
                top: 140px;
                left: 180px;
            }
            100% {
                top: 330px;
                left: 20px;
            }
        }
        @keyframes bubble_4 {
            0% {
                top: 20px;
                left: 70px;
            }
            25% {
                top: 250px;
                left: 300px;
            }
            50% {
                top: 440px;
                left: 180px;
            }
            100% {
                top: 20px;
                left: 70px;
            }
        }
        @keyframes bubble_3 {
            0% {
                top: 40px;
                left: 0px;
            }
            50% {
                top: 300px;
                left: 200px;
            }
            100% {
                top: 40px;
                left: 0px;
            }
        }
        @keyframes bubble_5 {
            0% {
                top: 410px;
                left: 100px;
            }
            25% {
                top: 300px;
                left: 150px;
            }
            50% {
                top: 400px;
                left: 20px;
            }
            100% {
                top: 410px;
                left: 100px;
            }
        }
        @keyframes bubble_6 {
            0% {
                top: 10px;
                left: 200px;
            }
            25% {
                top: 25px;
                left: 100px;
            }
            50% {
                top: 10px;
                left: 20px;
            }
            100% {
                top: 10px;
                left: 200px;
            }
        }
        .block p {
            z-index: 100;
            position: relative;
        }
        * {
            /* display: none; */
        }
    </style>
</head>
<body>
    <section>
        <div class="container">
            <div class="form sign_in_bx">
                <div class="block">
                    <div class="filt">
                        <div class="bubble b4"></div>
                        <div class="bubble b1"></div>
                        <div class="bubble b2"></div>
                        <div class="bubble b3"></div>
                        <div class="bubble b5"></div>
                        <div class="bubble b6"></div>
                        <!-- <div class="pointer"></div> -->
                        <div class="pointer" id="pointer_1"></div>
                        <div class="pointer" id="pointer_2"></div>
                        <!-- <div class="pointer" id="pointer_3"></div>
                        <div class="pointer" id="pointer_4"></div>
                        <div class="pointer" id="pointer_5"></div> -->
                    </div>
                </div>
                <div class="form_bx">
                    <form>
                        <h2>Sign in</h2>
                        <input type="text" name="" placeholder="Username">
                        <input type="password" name="" placeholder="Password">
                        <p class="notice invis no_match">login or password incorrect</p>
                        <input type="submit" name="" value="Login">
                        <p class="signup">Don't have an account? <a onclick="func();" href="#">Sign Up.</a></p>
                    </form>
                </div>
            </div>
            
            <div class="form sign_up_bx">
                <div class="form_bx">
                    <form>
                        <h2>Create an account</h2>
                        <input type="text" name="" placeholder="Username">
                        <p class="notice min_len user invis">username length must be at least 3 characters</p>
                        <p class="notice min_len user invis busy">this username is busy</p>
                        <input type="email" name="" placeholder="Email Address">
                        <p class="notice email invis">incorrect email address</p>
                        <p class="notice email invis busy">this email address is busy</p>
                        <input type="password" name="" placeholder="Password">
                        <p class="notice min_len pwd invis">password length must be at least 7 characters</p>
                        <p class="notice cappital pwd invis">password must contain at least one capital letter</p>
                        <input class="second_password" type="password" name="" placeholder="Confirm Password">
                        <p class="notice match invis">passwords don't match</p>
                        <input type="submit" name="" value="Sign Up">
                        <p class="signup">Already have an account? <a onclick="func();" href="#">Sign In.</a></p>
                    </form>
                </div>
                <div class="block">
                    <div class="filt sec">
                        <div class="bubble b4"></div>
                        <div class="bubble b1"></div>
                        <div class="bubble b2"></div>
                        <div class="bubble b3"></div>
                        <div class="bubble b5"></div>
                        <div class="bubble b6"></div>
                        <div class="pointer" id="pointer_1"></div>
                        <div class="pointer" id="pointer_2"></div>
                        <div class="pointer" id="pointer_3"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <svg>
        <filter id="filt">
            <feGaussianBlur in="SourceGraphic" stdDeviation="13"/>
            <feColorMatrix
            values= "
            1 0 0 0 0
                0 1 0 0 0
                0 0 1 0 0
                0 0 0 15 -8
                "
                />
            </filter>
        </svg>
        <script type="text/javascript">
        active = false;
        function func() {
            var cont = document.querySelector(".container");
            cont.classList.toggle('active');
            if (active)
                active = false;
            else
                active = true;
        }
        document.querySelector(".sign_in_bx .block").addEventListener("mousemove", function(e) {
            var target = e.target.closest('.filt');
            try {
                var targetCoords = target.getBoundingClientRect();
                var x = e.clientX - targetCoords.left;
                var y = e.clientY - targetCoords.top;
                var pointer = document.querySelector(".pointer");
                pointer.style.top = y - 40 + "px";
                pointer.style.left = x - 40 + "px";
            } catch {
                
            }
        });
        document.querySelector(".sign_up_bx .block").addEventListener("mousemove", function(e) {
            var target = e.target.closest('.filt.sec');
            try {
                var targetCoords = target.getBoundingClientRect();
                var x = e.clientX - targetCoords.left;
                var y = e.clientY - targetCoords.top;
                var pointer = document.querySelector(".sec .pointer");
                pointer.style.top = y - 40 + "px";
                pointer.style.left = x - 40 + "px";
            } catch {
                
            }
        });
        document.querySelector(".sign_up_bx .block").addEventListener("click", function(e) {
            var target = e.target.closest('.filt.sec');
            var targetCoords = target.getBoundingClientRect();
            var x = e.clientX - targetCoords.left;
            var y = e.clientY - targetCoords.top;
            
            let span = document.createElement("span");
            span.classList.add("btn_span");
            span.style.left = x + "px";
            span.style.top = y + "px";
            document.querySelector(".filt.sec").appendChild(span);
            setTimeout(() => { span.remove() }, 1000);
        });
        document.querySelector(".sign_in_bx .block").addEventListener("click", function(e) {
                var target = e.target.closest('.filt');
                var targetCoords = target.getBoundingClientRect();
                var x = e.clientX - targetCoords.left;
                var y = e.clientY - targetCoords.top;
                
                let span = document.createElement("span");
                span.classList.add("btn_span");
                span.style.left = x + "px";
                span.style.top = y + "px";
                document.querySelector(".filt").appendChild(span);
                setTimeout(() => { span.remove() }, 1000);
            });
        document.querySelector(".sign_in_bx input[type='submit']").addEventListener("click", function(e) {
            e.preventDefault();
            let flag = true;
            let username = document.querySelector(".sign_in_bx input[type='text']");
            let password = document.querySelector(".sign_in_bx input[type='password']");
            document.querySelector(".notice.no_match").classList.add("invis");
            if (flag) {
                SendRequest("get", "api/signin.php", "user=" + username.value + "&pwd=" + password.value, function(e) {
                    var resp = JSON.parse(e.response);
                    if (resp === true) {
                        window.location.href = "/index.php";
                    } else {
                        document.querySelector(".notice.no_match").classList.remove("invis");
                    }
                });
            }
        });
        document.querySelector(".sign_up_bx input[type='submit']").addEventListener("click", function(e) {
            e.preventDefault();
            let flag = true;
            let username = document.querySelector(".sign_up_bx input[type='text']");
            let password = document.querySelector(".sign_up_bx input[type='password']");
            let second_password = document.querySelector(".sign_up_bx .second_password");
            let email = document.querySelector(".sign_up_bx [type='email']");
            document.querySelector(".sign_up_bx .notice.min_len.pwd").classList.add("invis");
            document.querySelector(".sign_up_bx .notice.min_len.user").classList.add("invis");
            document.querySelector(".sign_up_bx .notice.cappital").classList.add("invis");
            document.querySelector(".sign_up_bx .notice.match").classList.add("invis");
            document.querySelector(".sign_up_bx .notice.email").classList.add("invis");
            document.querySelector(".notice.user.busy").classList.add("invis");
            document.querySelector(".notice.email.busy").classList.add("invis");
            if (/.+@.+\..+/.test(email.value) === false) {
                document.querySelector(".sign_up_bx .notice.email").classList.remove("invis");
                flag = false;
            }
            if (username.value.length < 3) {
                document.querySelector(".sign_up_bx .notice.min_len.user").classList.remove("invis");
                flag = false;
            }
            if (second_password.value !== password.value) {
                document.querySelector(".sign_up_bx .notice.match").classList.remove("invis");
                flag = false;
            }
            if (password.value.length < 7) {
                document.querySelector(".sign_up_bx .notice.min_len.pwd").classList.remove("invis");
                flag = false;
                return;
            }
            if ((/^(?=.*[A-Z])[A-Za-z\d]{7,}$/).test(password.value) === false) {
                document.querySelector(".sign_up_bx .notice.cappital").classList.remove("invis");
                flag = false;
            }
            if (flag) {
                SendRequest("get", "api/signup.php", "user=" + username.value + "&pwd=" + password.value + '&email=' + email.value, function(e) {
                    // console.log(e.response);
                    var resp = e.response;
                    if (resp === "login") {
                        document.querySelector(".notice.user.busy").classList.remove("invis");
                    }
                    if (resp === "email") {
                        document.querySelector(".notice.email.busy").classList.remove("invis");
                    }
                    if (resp == "true" && !document.location.href.split("//")[1].startsWith("localhost")) {
                        window.location.href = "/index.php";
                    } else {
                        window.location.href = "/local.php";
                    }
                });
            }
        });
        </script>
</body>
</html>