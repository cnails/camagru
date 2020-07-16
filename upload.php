<?php
    session_start();
    if (!$_SESSION['name']) {
        header("Location: index.php");
    }
    require_once("api/db.php");
    include("header.php");
?>
<style>
#contain {
	margin: 0px auto;
	width: 500px;
	height: 375px;
	border: 10px #333 solid;
    margin-top: 25px;
    position: relative;
    display: flex;
    flex-direction: center;
    flex-wrap: wrap;
}
#videoElement {
	width: 500px;
	height: 375px;
	background-color: #666;
}
#canvas {
    position: absolute;
    top: 0;
    left: 0;
    /* width: 0;
    height: 0; */
}
.filters {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    margin-top: 20px;
}
li {
    list-style-type: none;
    width: 130px;
    height: 130px;
}
.btns {
    display: flex;
    justify-content: space-between;
    width: 100%;
}

input[type="file"] {
    display: none;
}
 
.btn_blue {
    border: 1px solid #ccc;
    display: inline-block;
    background-color: blue;
    padding: 6px 12px;
    cursor: pointer;
    border-radius: 5px;
}

.red {
    background-color: red;
}

.post_img {
    width: 100%;
    margin-top: 15px;
    display: flex;
    justify-content: center;
}

.btn_submit {
    background-color: green;
    margin-bottom: 50px;
}

.header {
    min-width: 510px;
}

</style>
<?php if ($_SESSION['name'] && $_SESSION['name'] != ""): ?>
    <a class="nav_el" href="/logout.php"><div class="logout">logout</div></a>
        <a class="nav_el" href="/notifications.php"><div class="settings">notif</div></a>
        <a class="nav_el" href="/liked_post.php"><div class="liked">liked</div></a>
    <a class="nav_el" href="/settings.php"><div class="settings">settings</div></a>
<?php else: ?>
    <a class="nav_el" href="/login.php"><div class="login">login</div></a>
<?php endif; ?>
<img id="img_load" name="img" style="display: none;">
<a class="nav_el" href="/index.php"><div class="gallery">gallery</div></a>
<!-- <form action="#" method="post" name="form" enctype="multipart/form-data"> -->
<!-- <div>
    <input class="btn_image" type="file" name="image">
</div>
<br/> -->
    <!-- <input class="tmp_load" type="file" name="image"> -->
    <!-- <button id="submit" class="btn_submit" type="submit">upload</button> -->
<!-- </form> -->
<div id="contain">
    <video autoplay="true" id="videoElement"></video>
  <canvas id="canvas" width="640" height="480"></canvas>
  <canvas id="canvas" class="clear_canvas" style="display: none;" width="500" height="375"></canvas>
    <div>
        <ul class="filters">
            <li><label><img style="width: 100px;" src="snapshot/rama.png"><input type="radio" name="alpha" value="alphatest1"></label></li>
            <li><label><img style="width: 100px;" src="snapshot/flowers_bot.png"><input type="radio" name="alpha" value="alphatest1"></label></li>
            <li><label><img style="width: 100px;" src="snapshot/sbercat.png"><input type="radio" name="alpha" value="alphatest2"></label></li>
            <li><label><img style="width: 100px;" src="snapshot/sbercat2.png"><input type="radio" name="alpha" value="alphatest3"></label></li>
            <li><label><img style="width: 100px;" src="snapshot/sbercat3.png"><input type="radio" name="alpha" value="alphatest3"></label></li>
            <li><label><img style="width: 100px;" src="snapshot/anime.png"><input type="radio" name="alpha" value="alphatest3"></label></li>
        </ul>
    </div>
    <div class="btns">
        <button id="snap" class="btn_blue" onclick="snap()">Snap Photo</button>
        <button id="del" class="btn_blue red" onclick="del_photo()">Delete Photo</button>
        

<label for="file-upload" class="btn_blue">Download Image</label>
<input id="file-upload" type="file"/>
    <div class="post_img">
        <button id="submit" class="btn_blue btn_submit" type="submit">upload</button>
    </div>
</>
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

    var video=document.querySelector('video');
    var canvas=document.querySelector('canvas');
    var clear_canvas=document.querySelector('.clear_canvas');
    var context=canvas.getContext('2d');
    var context_clr = clear_canvas.getContext('2d');
    var w,h,ratio, w1, h1;
    var tmp_load = document.querySelector(".tmp_load");
    var img = document.querySelector('#img_load');

    var snaped = false;
    var video = document.querySelector("#videoElement");
    var photo = new Image();
    // var photo;
    var del_btn = document.querySelector("#del");
    del_btn.style.display = "none";

    window.addEventListener('load', function() {
        document.querySelector('input[type="file"]').addEventListener('change', function() {
            if (this.files && this.files[0]) {
                img.src = URL.createObjectURL(this.files[0]); // set src to blob url
                img.onload = imageIsLoaded;
                return;
            }
        });
    });
    function imageIsLoaded() {
        photo.src = this.src;
        img.src = this.src;
        context.fillRect(0,0,w,h);
        context.drawImage(photo,0,0,w,h);
        context_clr.fillRect(0,0,w,h);
        context_clr.drawImage(photo,0,0,w,h);
        if (image_png) {
            src = image_png.src.split("/");
            src = src[src.length - 1];
        if (src == "flowers_bot.png") {
            context.drawImage(image_png, 0, h - 200, 200, 200);
        } else if (src == "sbercat.png" || src == "sbercat2.png" || src == "sbercat3.png") {
            context.drawImage(image_png, w - 140,h - 150,100,110);
        } else {
            context.drawImage(image_png,0,0,w,h);
        }
        // context.drawImage(image_png,0,0,w,h);
    }
        snaped = true;
        del_btn.style.display = "inline-block";
        return;
    }

    if (navigator.mediaDevices.getUserMedia) {
    navigator.mediaDevices.getUserMedia({ video: true })
        .then(function (stream) {
        video.srcObject = stream;
        })
        .catch(function (error) {
        console.log("Something went wrong!");
        });
    }


  video.addEventListener('loadedmetadata', function() {
    ratio = video.videoWidth/video.videoHeight;
    w = video.videoWidth-140;
    h = parseInt(w/ratio,10);
    canvas.width = w;
    canvas.height = h;
  },false);
  var image_png = false;
  function snap() {
    canvas.style.display = "inline-block";
    context.fillRect(0,0,w,h);
    context.drawImage(video,0,0,w,h);
    context_clr.fillRect(0,0,w,h);
    context_clr.drawImage(video,0,0,w,h);
    // tmp_load.setAttribute("value", canvas.toDataURL("image/png"));
    // tmp_load.value = canvas.toDataURL("image/png");
    // console.log(tmp_load);
    // console.log
    // console.log(context.srcObject);
    photo.src = canvas.toDataURL("image/png");
    img.src = photo.src;
    if (image_png) {
        src = image_png.src.split("/");
        src = src[src.length - 1];
        if (src == "flowers_bot.png") {
            context.drawImage(image_png, 0, h - 200, 200, 200);
        } else if (src == "sbercat.png" || src == "sbercat2.png" || src == "sbercat3.png") {
            context.drawImage(image_png, w - 140,h - 150,100,110);
        } else {
            context.drawImage(image_png,0,0,w,h);
        }
        // context.drawImage(image_png,0,0,w,h);
    }
    snaped = true;
    del_btn.style.display = "inline-block";
  }
  function del_photo() {
    snaped = false;
    canvas.style.display = "none";
    del_btn.style.display = "none";
  }
  function change_snap(src) {
    image_png = new Image();
    image_png.src = src;
    src = src.split("/");
    src = src[src.length - 1];
    if (snaped) {
        context.fillRect(0,0,w,h);
        context.drawImage(photo,0,0,w,h);
        context_clr.fillRect(0,0,w,h);
        context_clr.drawImage(photo,0,0,w,h);
        if (src == "flowers_bot.png") {
            context.drawImage(image_png, 0, h - 200, 200, 200);
        } else if (src == "sbercat.png" || src == "sbercat2.png" || src == "sbercat3.png") {
            context.drawImage(image_png, w - 140,h - 150,100,110);
        } else {
            context.drawImage(image_png,0,0,w,h);
        }
    }
  }
  document.querySelectorAll("[type='radio']").forEach(elem => {
    elem.addEventListener("change", function(e) {
        change_snap(this.parentElement.querySelector("img").src)
    })
  });
  document.querySelector("#submit").addEventListener("click", function(e) {
        e.preventDefault();
        if (snaped) {
            var canvasData = canvas.toDataURL("image/png");
            // SendRequest("get", "upload_img.php", "img=" + canvasData, function(e) {
            //     console.log(e.response);
            // });
            var ajax = new XMLHttpRequest();
            // console.log(document.forms);
            // var form = new FormData(document.forms[0]);
            // console.log(form);
            // console.log(document.forms);
            ajax.open("POST",'upload_img.php',true);
            ajax.setRequestHeader('Content-Type', 'application/upload');
            ajax.send(canvasData);
        }
    });
</script>