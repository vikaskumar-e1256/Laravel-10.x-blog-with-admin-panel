<?php

namespace App\Utilities;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\Image;

class ImageHandler
{
    /**
     * Upload images and return an array of image IDs.
     *
     * @param \Illuminate\Http\UploadedFile|array $files
     * @param string $directory
     * @param int $imageableId
     * @param string $imageableType
     * @param array $additionalData
     * @return array
     */
    public static function uploadImages($files, $directory = 'images', $imageableId, $imageableType, $additionalData = [])
    {
        $imageIds = [];

        if (!is_array($files)) {
            $files = [$files];
        }

        foreach ($files as $file) {
            $originalName = $file->getClientOriginalName();
            // Replace spaces with underscores
            $cleanedName = str_replace(' ', '_', $originalName);
            // Generate the filename with UUID and cleaned original name
            $filename = Str::uuid() . '_' . $cleanedName;
            $file->storeAs($directory, $filename, 'public');

            // Create a new image record in the database with morph relationship and additional data
            $image = Image::create([
                'filename' => $filename,
                'imageable_id' => $imageableId,
                'imageable_type' => $imageableType,
                'alt_text' => $additionalData['alt_text'] ?? null,
                'caption' => $additionalData['caption'] ?? null,
                'description' => $additionalData['description'] ?? null,
                'order' => $additionalData['order'] ?? null,
                'is_visible' => $additionalData['is_visible'] ?? true,
                'uploaded_by' => $additionalData['uploaded_by'] ?? null,
            ]);

            $imageIds[] = $image->id;
        }

        return $imageIds;
    }

    /**
     * Delete an image or images and their records from the database.
     *
     * @param int|array $imageIds
     * @param string|array $filenames
     * @return bool
     */
    public static function deleteImages($imageIds, $filenames)
    {
        if (!is_array($imageIds)) {
            $imageIds = [$imageIds];
        }

        if (!is_array($filenames)) {
            $filenames = [$filenames];
        }

        foreach ($imageIds as $key => $imageId) {
            $image = Image::find($imageId);

            if ($image) {
                // Delete from storage
                Storage::disk('public')->delete('images/' . $filenames[$key]);

                // Delete from database
                $image->delete();
            }
        }

        return true;
    }
}
