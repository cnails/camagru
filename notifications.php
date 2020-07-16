<?php

    include("api/db.php");

    session_start();

    include("header.php");

    if ($_SESSION['name']) {
        $id = $_SESSION['id'];
        $notifs = $db->query("SELECT * FROM `notif` WHERE `user_id`='$id'");
    } else {
        header("Location: index.php");
    }
    ?>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">

<style>

.notifs {
    padding: 20px;
}

.notif_comment
{
    min-width: 400px;
    height: 60px;
    display: flex;
    margin-top: 30px;
    padding-left: 20px;
    font-family: 'Montserrat', sans-serif;
    background-color: rgba(0, 0, 0, 0.3);
    font-weight: 700;
    color: #e2e2e2;
    transition: .5s ease;
    align-items: center;
}
.notif_comment:hover {
    transform: scale(1.02);
}
</style>

<div class="notifs">
<?php
    foreach($notifs as $notif):
?>
    <a href="post.php?id=<?php echo $notif['post_id'] ?>">
        <div class="notif_comment">
            <?php echo htmlentities($notif['author']) ?> | <?php echo htmlentities($notif['data']) ?>
        </div>
    </a>
<?php endforeach; ?>
</div>

<a class="nav_el" href="/logout.php"><div class="logout">logout</div></a>
<a class="nav_el" href="/settings.php"><div class="settings">settings</div></a>
<a class="nav_el" href="/liked_post.php"><div class="liked">liked</div></a>
<a class="nav_el" href="/upload.php"><div class="upload">upload</div></a>

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
