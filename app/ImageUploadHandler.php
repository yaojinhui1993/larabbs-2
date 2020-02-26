<?php

namespace App\Handlers;

use Illuminate\Support\Str;

class ImageUploadHandler
{

    protected $allowedExt = ['png', 'jpg', 'jpeg', 'gif'];

    public function save($file, $folder, $filePrefix)
    {
        $timestamps = time();
        $random = Str::random(10);
        $date = date('Ym/d', $timestamps);
        $folderName = "uploads/images/{$folder}/{$date}";

        $uploadPath = public_path($folderName);

        $extension = strtolower($file->getClientOriginalExtension()) ?: 'png';

        $filename = "{$filePrefix}_{$timestamps}_{$random}.$extension";

        if (! in_array($extension, $this->allowedExt)) {
            return false;
        }

        $file->move($uploadPath, $filename);

        return [
            'path' => config('app.url') . "/{$folderName}/$filename"
        ];
    }
}
