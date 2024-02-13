<?php
function ConvertTo128By128(string $path)
{
    $originalImage = imagecreatefromjpeg($path);
    $newImage = imagecreatetruecolor(128, 128);
    imagecopyresampled($newImage, $originalImage, 0, 0, 0, 0, 128, 128, 370, 370);
    imagejpeg($newImage, $path, 100); 
    imagedestroy($originalImage);
    imagedestroy($newImage);
    
}

