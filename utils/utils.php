<?php
function ConvertTo128By128(string $path)
{
    list($originalWidth, $originalHeight) = getimagesize($path);
    $originalImage = imagecreatefromjpeg($path);
    $newImage = imagecreatetruecolor(128, 128);
    imagecopyresampled($newImage, $originalImage, 0, 0, 0, 0, 128, 128, $originalWidth, $originalHeight);
    if (file_exists($path)) {
        unlink($path);
    }
    imagejpeg($newImage, $path);
    imagedestroy($originalImage);
    imagedestroy($newImage);
}
?>