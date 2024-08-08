<?php

namespace App\Helpers;

use Illuminate\Support\Facades\File;

class WorkWithFile
{
    /**
     * Copy file from resources path to another directory
     *
     * @param string $filePath Relative path to file from resource path
     * @param string $pathTo Relative path to directory from storage path
     *
     * @return string|bool Return false in error case and relative path if ok
     */
    public static function copyFile(string $filePath, string $pathTo): bool|string
    {
        $filePath = '/' . $filePath;
        $path = resource_path() . $filePath;
        $baseName = File::basename($path);
        $folderPath = storage_path($pathTo);
        $filePathTo = $folderPath . $baseName;
        $explodedPath = explode('/public/', $filePathTo);
        if (!isset($explodedPath[1]) || empty($explodedPath[1])) {
            return false;
        }

        if (!file_exists($folderPath)) {
            mkdir($folderPath, 0777, true);
        }

        File::copy($path, $filePathTo);

        return $explodedPath[1];
    }
}
