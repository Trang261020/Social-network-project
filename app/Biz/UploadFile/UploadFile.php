<?php

namespace App\Biz\UploadFile;

use Illuminate\Support\Facades\Storage;

class UploadFile {
    public static function uploadFile ($link, $folder = 'avatar_cover') {
        $file = $link;
        $imageName = time() . '.' . $file->extension();
        Storage::disk('public')->put('/'.$folder.'/' . $imageName, $file->getContent());
        $directory = $folder.'/' . $imageName;
        return $directory;
    }

}
