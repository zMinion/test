<?php
include 'config.php';
include 'functions.php';

if (isset($_POST['picklogo'])) {
    $chooselogo = filter_var($_POST['picklogo'], FILTER_SANITIZE_NUMBER_INT);
    if (isset($_FILES['file']['tmp_name'])) {
        $file = $_FILES['file']['tmp_name'];
    }
    if (isset($_POST['source'])) {
        $source = filter_var($_POST['source'], FILTER_SANITIZE_NUMBER_INT);
    }
    if (isset($_POST['departament'])) {
        $departament = filter_var($_POST['departament'], FILTER_SANITIZE_NUMBER_INT);
    }
    if (isset($_POST['flip'])) {
        $flip = filter_var($_POST['flip'], FILTER_SANITIZE_NUMBER_INT);
    }
    $logo = dirname(__FILE__) . '/logo/' . $chooselogo . '.png';
    
    // Read logo
    $logo = imagecreatefrompng($logo);
    
    // Read file
    $image = imagecreatefromjpeg($file);
    if (!$image) {
        handleError(2);
    }
    // Check width(700->2028px) and height(420->1229px)
    $dimensions = checkDimensions($image, $minwidth, $maxwidth, $minheight, $maxheight);
    // Flip image if required (horizontal)
    if ($flip) {
        $image = flipImage($image, $dimensions[0], $dimensions[1], false, true);
    }
    //  Resize if needed
    if ($dimensions[2]) {
        $logo = resizePng($logo, $dimensions[0], $dimensions[1]);
    }
    // Save stats in database
    if ($image) {
        saveStats($departament, $chooselogo, $source, $flip);
    }
    // Rename the file
    $name = renameImage($_FILES['file']['name'], $source);
    
    // Image download
    imageSave($image, $logo, $dimensions[0], $dimensions[1], $quality, $name, 1);
}

if (isset($_FILES['fileMockup']['tmp_name'])) {
    $file = $_FILES['fileMockup']['tmp_name'];
    if (isset($_POST['source'])) {
        $source = filter_var($_POST['source'], FILTER_SANITIZE_NUMBER_INT);
    }
    $banner = dirname(__FILE__) . '/mockup/ocasion.jpg';
    $mockup = dirname(__FILE__) . '/mockup/ocasion.png';
    $image  = imagecreatefromjpeg($file);
    $banner = imagecreatefromjpeg($banner);
    $mockup = imagecreatefrompng($mockup);
    
    // Rename the file
    $name = renameImage($_FILES['fileMockup']['name'], $source);
    
    // Image download
    combineMockup($image, $banner, $mockup, $quality, $name);
}

if (isset($_POST['text'])) {
    $text = $_POST["text"];
    if (isset($_FILES['files']['tmp_name'])) {
        $files = $_FILES['files']['tmp_name'];
    }
    if (isset($_POST['color'])) {
        $color = filter_var($_POST['color'], FILTER_SANITIZE_NUMBER_INT);
    }
    if (isset($_POST['departament'])) {
        $departament = filter_var($_POST['departament'], FILTER_SANITIZE_NUMBER_INT);
    }
    $names = $_FILES['files']['name'];
    $imagetextgenerated = createText($text, $color, $font, $fontsize, $maxwidth, $maxheight);
    if (count($files) > 1) {
        // Prepare ZipFile
        $zipfile = tempnam("tmp", "zip");
        $zip     = new ZipArchive();
        $zip->open($zipfile, ZipArchive::OVERWRITE);
        foreach ($files as $index => $file) {
            // Read file
            $image = imagecreatefromjpeg($files[$index]);
            if (!$image) {
                handleError(2);
            }
            // Protect original text generated
            $textimage = $imagetextgenerated;
            
            // Check width(700->2028px) and height(420->1229px)
            $dimensions = checkDimensions($image, $minwidth, $maxwidth, $minheight, $maxheight);
            
            //  Resize if needed
            if ($dimensions[2]) {
                $textimage = resizePng($textimage, $dimensions[0], $dimensions[1]);
            }
            // Save stats in database
            if ($image) {
                saveStats($departament, 0, 0, 0, 1, $color);
            }
            // Image save
            ob_start();
            imageSave($image, $textimage, $dimensions[0], $dimensions[1], $quality);
            $i = ob_get_clean();
            
            // Add image in archive
            $zip->addFromString($names[$index], $i);
        }
        
        // Close and download
        $zip->close();
        header('Content-Type: application/zip');
        header('Content-Disposition: attachment; filename="images.zip"');
        readfile($zipfile);
        unlink($zipfile);
    } else {
        $image = imagecreatefromjpeg($files[0]);
        if (!$image) {
            handleError(2);
        }
        // Check width(700->2028px) and height(420->1229px)
        $dimensions = checkDimensions($image, $minwidth, $maxwidth, $minheight, $maxheight);
        
        //  Resize if needed
        if ($dimensions[2]) {
            $textimage = resizePng($textimage, $dimensions[0], $dimensions[1]);
        }
        // Save stats in database
        if ($image) {
            saveStats($departament, 0, 0, 0, 1, $color);
        }
        // Image download
        imageSave($image, $imagetextgenerated, $dimensions[0], $dimensions[1], $quality, $names[0], 1);
    }
}
