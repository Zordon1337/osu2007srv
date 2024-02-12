<?php
function ConvertTo128By128(string $path)
{
    if (exif_imagetype($path) !== IMAGETYPE_JPEG) {
        return false;
    }
    $originalImage = @imagecreatefromjpeg($path);
    if (!$originalImage) {
        return false;
    }
    list($originalWidth, $originalHeight) = getimagesize($path);
    $aspectRatio = $originalWidth / $originalHeight;
    $newWidth = 128;
    $newHeight = 128;
    if ($aspectRatio > 1) {
        $newHeight = $newWidth / $aspectRatio;
    } else {
        $newWidth = $newHeight * $aspectRatio;
    }
    $newImage = imagecreatetruecolor($newWidth, $newHeight);
    if (!$newImage) {
        imagedestroy($originalImage);
        return false;
    }
    imagecopyresampled($newImage, $originalImage, 0, 0, 0, 0, $newWidth, $newHeight, $originalWidth, $originalHeight);
    if (file_exists($path)) {
        unlink($path);
    }
    imagejpeg($newImage, $path);
    imagedestroy($originalImage);
    imagedestroy($newImage);
    return true;
}

?>