<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ImageService
{
    /**
     * Upload a file and return the filename.
     *
     * @param UploadedFile $file
     * @param string $path
     * @return string
     */
    public function upload(UploadedFile $file, string $path): string
    {
        $fileName = hexdec(uniqid()) . '.' . $file->getClientOriginalExtension();
        $file->storeAs($path, $fileName);

        return $fileName;
    }

    /**
     * Delete a file from storage.
     *
     * @param string|null $fileName
     * @param string $path
     * @return void
     */
    public function delete(?string $fileName, string $path): void
    {
        if ($fileName && Storage::exists($path . $fileName)) {
            Storage::delete($path . $fileName);
        }
    }

    /**
     * Handle updating an image: delete old one, upload new one.
     *
     * @param UploadedFile|null $newFile
     * @param string|null $oldFileName
     * @param string $path
     * @return string|null Returns new filename if uploaded, otherwise null (or old filename if you prefer logic adjustment)
     */
    public function update(?UploadedFile $newFile, ?string $oldFileName, string $path): ?string
    {
        if (!$newFile) {
            return null;
        }

        if ($oldFileName) {
            $this->delete($oldFileName, $path);
        }

        return $this->upload($newFile, $path);
    }
}
