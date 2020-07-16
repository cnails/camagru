<?php
    session_start();
    if (!$_SESSION['name']) {
        header("Location: index.php");
    }
    require_once("api/db.php");

    $liked_post = $_SESSION['likes'];
    $posts = $db->query("SELECT * FROM `post`");

    include("header.php");
?>
<?php if ($_SESSION['name'] && $_SESSION['name'] != ""): ?>
        <a class="nav_el" href="/logout.php"><div class="logout">logout</div></a>
        <a class="nav_el" href="/notifications.php"><div class="settings">notif</div></a>
        <a class="nav_el" href="/settings.php"><div class="settings">settings</div></a>
        <a class="nav_el" href="/upload.php"><div class="upload">upload</div></a>
    <?php else: ?>
        <a class="nav_el" href="/login.php"><div class="login">login</div></a>
    <?php endif; ?>
    <a class="nav_el" href="/index.php"><div class="gallery">gallery</div></a>
<section class="posts">
    <div class="container">
        <?php
            foreach($liked_post as $id):
                foreach($posts as $post) {
                    if ($post['id'] == $id) {
                    break;
                }
            }
            ?>
        <div class="post" id="post_<?php echo $post['id']?>">
            <div class="post_header">
                <div class="author"><?php echo htmlentities($post['author'])?></div>
            </div>
            <img src="img/<?php echo $post['img']?>" alt="img">
            <div class="info">
                <div class="info_like">
                    <img class="like<?php if (in_array($post['id'], $_SESSION['likes'])) {echo " liked";}?>" src="templates/icons/like.png" alt="like">
                    <span><?php echo $post['likes']?></span>
                </div>
                <div class="info_comment">
                    <img src="templates/icons/comment.png" alt="like">
                    <span><?php echo $post['comments']?></span>
                </div>
            </div>
        </div>
        <?php endforeach;?>
    </div>
</section>

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
</script>
