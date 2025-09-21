<?php

namespace App\Traits;

use Illuminate\Support\Facades\File;

trait FileUploadTrait
{
    public function uploadFile($file): string
    {
        $filename = uniqid() . '_' . hash_file('md5', $file) . '.' . $file->getClientOriginalExtension();
        $uploadPath = base_path('public_html/uploads');
        if (!File::exists($uploadPath)) File::makeDirectory($uploadPath, 0755, true);
        $file->move($uploadPath, $filename);
        return url('uploads/' . $filename);
    }


    public function deleteUploadedFile(?string $fileUrl): bool
    {
        if (!$fileUrl) return false;
        $baseUrl = url('uploads/') . '/';
        if (strpos($fileUrl, $baseUrl) !== 0) return false;
        $relativePath = str_replace($baseUrl, '', $fileUrl);
        $filePath = base_path('public_html/uploads/' . $relativePath);
        return File::exists($filePath) ? unlink($filePath) : false;
    }
}
