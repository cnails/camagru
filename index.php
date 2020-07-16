<?php
    session_start();
    include("header.php");
    require_once("api/db.php");
    // include("config/setup.php");
    
    $clear = 0;
    if ($_GET['page']) {
        $n_page = $_GET['page'];
    } else {
        $n_page = 1;
    }
    if ($n_page < 1)
    $n_page = 1;
    $qty_posts = mysqli_num_rows($db->query("SELECT * FROM `post`"));
    $qty_posts_per_page = 6;
    $start = ($n_page - 1) * $qty_posts_per_page;
    $posts = $db->query("SELECT * FROM `post` ORDER BY id DESC LIMIT ".$start.','.$qty_posts_per_page);
?>
<style>
    .first_look {
        text-align: center;
        line-height: 30px;
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
}

@media screen and (max-width: 700px) {
    .del_btn {
        opacity: .9;
    }
    .info {
        position: relative;
        display: flex;
        opacity: 1;
        bottom: 0;
        height: auto;
    }
    .info_comment {
        position: relative;
        margin-left: 5px;
    }
    .post:hover .info {
        bottom: 0;
    }
}

</style>
    <?php if ($_SESSION['name'] && $_SESSION['name'] != ""): ?>
        <a class="nav_el" href="/logout.php"><div class="logout">logout</div></a>
        <a class="nav_el" href="/notifications.php"><div class="settings">notif</div></a>
        <a class="nav_el" href="/liked_post.php"><div class="liked">liked</div></a>
        <a class="nav_el" href="/upload.php"><div class="upload">upload</div></a>
    <?php else: ?>
        <a class="nav_el" href="/login.php"><div class="login">login</div></a>
    <?php endif; ?>
    <!-- <a class="nav_el" href="/index.php"><div class="gallery">gallery</div></a> -->
    <section class="posts">
        <div class="container">
         <?php if ($posts):?>
            <?php foreach ($posts as $post):?>
            <?php $clear=1; ?>
            <div class="post" id="post_<?php echo $post['id']?>">
                <div class="post_header">
                    <div class="author"><?php echo htmlentities($post['author'])?></div>
                </div>
                <img src="img/<?php echo $post['img']?>" alt="img">
                <?php if ($post['author'] == $_SESSION['name']) { echo "<div class='del_btn'>X</div>";}?>
                <div class="info">
                    <div class="info_like">
                        <img class="like<?php if (in_array($post['id'], $_SESSION['likes'])) {echo " liked";} if (!$_SESSION['name']) {echo " enemy";}?>" src="templates/icons/like.png" alt="like">
                        <span><?php echo $post['likes']?></span>
                    </div>
                    <div class="info_comment">
                        <img src="templates/icons/comment.png" alt="like">
                        <span><?php echo $post['comments']?></span>
                    </div>
                </div>
            </div>
            <?php endforeach;?>
            <?php endif; ?>
            <?php if (!$clear) {echo "<div class='first_look'>There's nothing here yet :(</br><a style='color: black; text-decoration: underline;' href='upload.php'>Publicate</a> first post</div>";} ?>
            <div style="position: absolute; bottom: 0; width: 100%; left: 0px; text-align: center;" class="page_slider_main">
                <div class="page_slider">
                    <?php if ($n_page > 1):?>
                    <a style="color: black;" href="<?php echo '?page='.($n_page - 1)?>"><?php echo $n_page - 1?></a>
                    <span> | </span>
                    <?php endif; ?>
                    <label><?php echo $n_page?></label>
                    <?php if (($qty_posts - $qty_posts_per_page * $n_page) > 0): ?>
                    <span> | </span>
                    <a style="color: black;" href="<?php echo '?page='.($n_page + 1)?>"><?php echo $n_page + 1?></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
    <!-- <section class="footer">
        
    </section> -->
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
    like_elems.forEach(elem => {
        elem.addEventListener("click", function(e) {
            var id = this.id.split("_")[1];
            if (e.target.classList.contains("like")) {
                var qty = this.querySelector("span");
                if (!this.querySelector(".info_like img").classList.contains("enemy")) {
                    this.querySelector(".info_like img").classList.toggle("liked");
                    if (this.querySelector(".info_like img").classList.contains("liked")) {
                        qty.innerHTML = parseInt(qty.innerHTML) + 1;
                        SendRequest("get", "api/likes.php", "action=append&post_id=" + id, () => {});
                    } else {
                        qty.innerHTML = parseInt(qty.innerHTML) - 1;
                        SendRequest("get", "api/likes.php", "action=delete&post_id=" + id, () => {});
                    }
                }
            } else if (e.target.classList.contains("del_btn")) {
                SendRequest("get", "api/del_post.php", "id=" + id, () => {});
                this.remove();
            } else {
                window.location.href = "post.php?id=" + id;
            }
        });
    });
</script>
</html>