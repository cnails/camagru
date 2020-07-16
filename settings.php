<?php
    session_start();

    if (!$_SESSION['name']) {
        header("Location: index.php");
    }

    require_once("api/db.php");
    include("header.php");

    $name = $_SESSION['name'];
    $res = $db->query("SELECT * FROM `user` WHERE username='$name'")->fetch_assoc();
    $notif = $res['notif'];
?>

<style>
    p {
        display: inline-block;
    }
    .cont {
        text-align: center;
        padding-top: 50px;
    }
    .form {
        position: relative;
        display: flex;
        justify-content: center;
    }
    </style>

    <a class="nav_el" href="/logout.php"><div class="logout">logout</div></a>
        <a class="nav_el" href="/notifications.php"><div class="settings">notif</div></a>
    <a class="nav_el" href="/upload.php"><div class="upload">upload</div></a>
<a class="nav_el" href="/index.php"><div class="gallery">gallery</div></a>

<body>
    <div class="form sign_up_bx">
        <div class="form_bx new_form">
        <h2>Change Notification</h2>
    <form action="#" class="notif" method="post">
    <div>
        <p>would like to be notified of new comments to your post?</p>
        <input type="checkbox" <?php if ($notif) { echo "checked"; }?>>
    </div>
    <div class="center_align">
        <button id="submit" class="btn_submit" type="submit">change</button>
    </div>
</form>
</div>
</div>
    <div class="form sign_up_bx">
        <div class="form_bx">
            <form>
                <h2>Change Password</h2>
                <input class="old_pwd" type="password" name="" placeholder="Old Password">
                <p class="notice wrong invis">wrong password</p>
                <input class="new_pwd" type="password" name="" placeholder="New Password">
                <p class="notice min_len pwd invis">password length must be at least 7 characters</p>
                <p class="notice cappital pwd invis">password must contain at least one capital letter</p>
                <input class="second_password" type="password" name="" placeholder="Confirm Password">
                <p class="notice match invis">passwords don't match</p>
                <p class="notice good invis" style="color: green">password changed</p>
                <div class="center_align">
                <input type="submit" name="" value="change">
                </div>
            </form>
        </div>
    </div>
    <!-- <form action="#" class="change_pwd" method="post">
        
    </form> -->
    
<!-- TODO: CHANGE PASSWORD -->
</body>

<script>
     document.querySelectorAll(".nav_el").forEach(elem => {
        document.querySelector(".top_bar").appendChild(elem);
        elem.addEventListener("mouseover", function(e) {
            this.classList.add("current_nav");
        });
        elem.addEventListener("mouseout", function(e) {
            this.classList.remove("current_nav");
        });
    });
    document.querySelector("form.notif").addEventListener("submit", function(e) {
        var checked = this.querySelector("input").checked;
        // e.preventDefault();
        if (checked) {
            SendRequest("get", "api/change_notif.php", "action=add", function(e) {
                // console.log(e.response);
            });
        } else {
            SendRequest("get", "api/change_notif.php", "action=del", function(e) {
                // console.log(e.response);
            });
        }
    });
    document.querySelector(".sign_up_bx input[type='submit']").addEventListener("click", function(e) {
            e.preventDefault();
            let flag = true;
            let old_password = document.querySelector(".old_pwd");
            let password = document.querySelector(".new_pwd");
            let second_password = document.querySelector(".sign_up_bx .second_password");
            document.querySelector(".sign_up_bx .notice.min_len.pwd").classList.add("invis");
            document.querySelector(".sign_up_bx .notice.cappital").classList.add("invis");
            document.querySelector(".sign_up_bx .notice.match").classList.add("invis");
            document.querySelector(".notice.wrong").classList.add("invis");
            document.querySelector(".notice.good").classList.add("invis");
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
                SendRequest("get", "api/change_pwd.php", "old_pwd=" + old_password.value + '&new_pwd=' + password.value, function(e) {
                    // console.log(e.response);
                    var resp = JSON.parse(e.response);
                    if (resp == false) {
                        document.querySelector(".notice.wrong").classList.remove("invis");
                    }
                    if (resp == true) {
                        document.querySelector(".notice.good").classList.remove("invis");
                    }
                    // if (resp === true) {
                    //     window.location.href = "/index.php";
                    // }
                });
            }
        });
</script>
