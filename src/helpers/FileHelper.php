<?php
namespace DmitriiKoziuk\yii2Base\helpers;

use DmitriiKoziuk\yii2Base\exceptions\CouldNotCreateDirectoryException;

class FileHelper
{
    /**
     * @param string $path
     * @throws CouldNotCreateDirectoryException
     */
    public function createDirectoryIfNotExist(string $path): void
    {
        if (! file_exists($path)) {
            if (! mkdir($path, 0755, true)) {
                throw new CouldNotCreateDirectoryException("Could not create directory '{$path}'");
            }
        }
    }
}