<?php
namespace App\services;

class Media{

public static function upload($image ,$dir){
    $newImageName = $image->hashName();
    $image->move(public_path("images\{$dir}"), $newImageName);

return $newImageName;

}

public  static function delete($image){

if(file_exists($image)){
    unlink($image);
    return true;
}

return false;
}

}
