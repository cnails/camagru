<?php
    function merge($top_file, $bottom_file) {        
        $top = imagecreatefrompng($top_file);
        $bottom = imagecreatefrompng($bottom_file);
        
        // get current width/height
        list($top_width, $top_height) = getimagesize($top_file);
        list($bottom_width, $bottom_height) = getimagesize($bottom_file);
        
        // compute new width/height
        $new_width = $top_width;
        $new_height = $top_height;
        
        // create new image and merge
        imagealphablending($top, true);
        imagesavealpha($top, true);
        imagecopyresized($top, $bottom, 0, 0, 0, 0, $top_width, $top_height, $bottom_width, $bottom_height);
        // imagecopy($top, $bottom, 0, 0, 0, 0, $bottom_width, $bottom_height);
        
        // save to file
        imagepng($top, 'merged_image.png');
    }
?>
