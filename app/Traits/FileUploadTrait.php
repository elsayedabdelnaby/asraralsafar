<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\UploadedFile;

trait FileUploadTrait
{

    /**
     * @param Request $request
     * @param string $disk
     * @param string $directory
     * @param $file_name
     * @return $this|false|string
     */
    public function verifyAndUpload(UploadedFile $file, string $file_name = '', string $disk = 'local', string $directory = ''): string
    {
        if ($disk == 'public') {
            $path = public_path('storage/' . $directory . '/' . $file_name);
        } else {
            $path = Storage::path($directory . '/' . $file_name);
        }

        if (File::exists($path)) {
            File::delete($path);
        }
        $file_path = Storage::disk($disk)->put($directory, $file);
        $folders = explode('/', $file_path);
        $file_name = end($folders);
        return $file_name;
    }
}
