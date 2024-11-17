<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait FileUpload
{
    public static function uploadImage($imageFile)
    {
        $allowedFileTypes = ['jpg', 'jpeg', 'png'];

        if ($imageFile) {
            if (!in_array($imageFile->getClientOriginalExtension(), $allowedFileTypes)) {
                throw new \Exception('Invalid file type');
            }

            $imageFileName = time() . '_' . $imageFile->getClientOriginalName();
            return Storage::disk('public')->putFileAs("photos", $imageFile, $imageFileName);
        }
    }
}