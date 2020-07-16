<?php
    session_start();
    require_once("api/db.php");

    if ($_GET['id']) {
        $id = $_GET['id'];
        $post = $db->query("SELECT * FROM `post` WHERE id='$id' LIMIT 1")->fetch_assoc();
        if (!$post) {
            header("Location: index.php");
        }
        $comments = $db->query("SELECT * FROM `comments` WHERE post_id='$id'");
    } else {
        header("Location: index.php");
    }
    include("header.php");
    ?>
    <?php if ($_SESSION['name'] && $_SESSION['name'] != ""): ?>
        <a class="nav_el" href="/logout.php"><div class="logout">logout</div></a>
        <a class="nav_el" href="/settings.php"><div class="settings">settings</div></a>
        <a class="nav_el" href="/liked_post.php"><div class="liked">liked</div></a>
        <a class="nav_el" href="/upload.php"><div class="upload">upload</div></a>
    <?php else: ?>
        <a class="nav_el" href="/login.php"><div class="login">login</div></a>
    <?php endif; ?>
    <a class="nav_el" href="/index.php"><div class="gallery">gallery</div></a>
    <style>
        .comments {
            margin-top: 10px;
        }
        .comments input {
            margin-top: 10px;
        }
        .comment {
            padding: 3px;
            margin-top: 5px;
            width: 100%;
            background-color: rgba(0, 0 ,0, .2);
        }
        .del_btn {
    position: absolute;
    top: 5px;
    right: 5px;
    border: 1px solid #ccc;
    display: inline-block;
    background-color: red;
    padding: 6px 12px;
    cursor: pointer;
    border-radius: 5px;
    opacity: .3;
}

.del_btn:hover {
    opacity: .9;
}@media screen and (max-width: 700px) {
    .del_btn {
        opacity: .9;
    }}
        </style>
        <div class="invis author_name"><?php echo htmlentities($_SESSION['name'])?></div>
<section class="posts">
        <div class="container">
<div class="post" id="post_<?php echo $post['id']?>">
    <div class="post_header">
        <div class="author"><?php echo htmlentities($post['author'])?></div>
    </div>
    <img src="img/<?php echo $post['img']?>" alt="img">
    <?php if ($post['author'] == $_SESSION['name']) { echo "<div class='del_btn'>X</div>";}?>
    <div class="info_like">
        <img class="like<?php if (in_array($post['id'], $_SESSION['likes'])) {echo " liked";} if (!$_SESSION['name']) {echo " enemy";}?>" src="templates/icons/like.png" alt="like">
        <span><?php echo $post['likes']?></span>
    </div>
    </div>
<div class="comments">
    <div class="coms">
    <?php
        if ($comments):
    ?>
    <?php foreach($comments as $com): ?>
        <div class="comment">
            <span class="author"><?php echo htmlentities($com['author'])?> |</span>
            <?php echo htmlentities($com['data'])?>
        </div>
    <?php endforeach;?>
    <?php endif; ?>
    </div>
    <?php if ($_SESSION['name']): ?>
    <form action="#">
        <input type="text">
        <input type="submit" value="SEND">
    </form>
    <?php endif; ?>
    <!-- <input type="text"> -->
</div>
    </div>
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
        var like_elems = document.querySelectorAll(".post");
        var id = like_elems[0].id.split("_")[1];
        like_elems.forEach(elem => {
        elem.addEventListener("click", function(e) {
            if (e.target.classList.contains("like")) {
                var qty = this.querySelector("span");
                this.querySelector(".info_like img").classList.toggle("liked");
                if (this.querySelector(".info_like img").classList.contains("liked")) {
                    qty.innerHTML = parseInt(qty.innerHTML) + 1;
                    SendRequest("get", "api/likes.php", "action=append&post_id=" + id, () => {});
                } else {
                    qty.innerHTML = parseInt(qty.innerHTML) - 1;
                    SendRequest("get", "api/likes.php", "action=delete&post_id=" + id, () => {});
                }
            } else if (e.target.classList.contains("del_btn")) {
                    console.log("del");
                    SendRequest("get", "api/del_post.php", "id=" + id, () => {});
                    window.location.href="index.php";
            } 
                // else {
                // window.location.href = "post.php?id=" + id;
            // }
        });
        function appendComment(author, data) {
            var com = document.createElement("div");
            var span = document.createElement("span");
            com.classList.add("comment");
            span.classList.add("author");
            span.innerHTML = author + " | ";
            com.innerHTML = data;
            com.prepend(span);
            document.querySelector(".coms").appendChild(com);
        }
        document.addEventListener("submit", function(e) {
            e.preventDefault();
            console.log(e.target);
            var data = e.target.querySelector("input").value;
            var author_name = document.querySelector(".author_name").innerHTML;
            // var name = 
            e.target.querySelector("input").value = "";
            SendRequest("get", "api/add_comment.php", "id=" + id + "&data=" + data + "&author=" + author_name, function (e) {
                console.log(e.response);
            });
            appendComment(author_name, data);
        });
    });
    </script>
    </html>
