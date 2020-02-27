<?php

namespace App\Handlers;

use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ImageUploadHandler
{
    protected $allowedExt = ['png', 'jpg', 'jpeg', 'gif'];

    public function save($file, $folder, $filePrefix, $maxWidth = false)
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

        if ($maxWidth && $extension != 'gif') {
            $this->reduceSize("{$uploadPath}/{$filename}", $maxWidth);
        }

        return [
            'path' => config('app.url') . "/{$folderName}/$filename"
        ];
    }

    public function reduceSize($filePath, $maxWidth)
    {
        $image = Image::make($filePath);

        $image->resize($maxWidth, null, function ($constraint) {
            $constraint->aspectRatio();

            $constraint->upsize();
        });

        $image->save();
    }
}
