<?php

namespace App\Services;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class DeleteFile
{
    public static function delete(string $file_name, string $directory = '', string $disk = 'local')
    {
        if ($disk == 'public') {
            $path = public_path('storage/' . $directory . '/' . $file_name);
        } else {
            $path = Storage::path($directory . '/' . $file_name);
        }

        if (File::exists($path)) {
            File::delete($path);
            return true;
        }

        return false;
    }
}
