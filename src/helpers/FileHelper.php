<?php
namespace DmitriiKoziuk\yii2Base\helpers;

class FileHelper
{
    /**
     * @param string $path
     * @throws \Exception
     */
    public function createDirectoryIfNotExist(string $path): void
    {
        if (! file_exists($path)) {
            if (! mkdir($path, 0755, true)) {
                throw new \Exception("Cant create directory '{$path}'");
            }
        }
    }
}