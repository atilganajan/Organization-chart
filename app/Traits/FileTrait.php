<?php

namespace App\Traits;

use Illuminate\Support\Facades\File;

trait FileTrait
{
    protected function createfile($file)
    {
        $imagesFolder = 'images';
        if (!file_exists($imagesFolder)) {
            mkdir($imagesFolder, 0777, true);
        }

        $filename = time() . '_' . rand(1, 1000) . '_' . $file->getClientOriginalName();

        $file->move($imagesFolder, $filename);

        return $imagesFolder . '/' . $filename;
    }


    protected function updateFile($file, $oldFile)
    {
        $imagesFolder = 'images';

        if ($oldFile && file_exists($oldFile)) {
            File::delete($oldFile);
        }

        $filename = time() . '_' . rand(1, 1000) . '_' . $file->getClientOriginalName();

        $file->move($imagesFolder, $filename);

        return $imagesFolder . '/' . $filename;
    }

}
