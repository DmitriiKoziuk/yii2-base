<?php
namespace DmitriiKoziuk\yii2Base\helpers;

use DmitriiKoziuk\yii2Base\exceptions\CouldNotCreateDirectoryException;
use DmitriiKoziuk\yii2Base\exceptions\DirectoryNotExistException;

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

    /**
     * @param string $dir
     * @throws DirectoryNotExistException
     */
    public function removeDirectoryRecursively(string $dir): void
    {
        if (is_dir($dir)) {
            $objects = scandir($dir);
            foreach ($objects as $object) {
                if ($object != "." && $object != "..") {
                    if (is_dir($dir."/".$object))
                        $this->removeDirectoryRecursively($dir."/".$object);
                    else
                        unlink($dir."/".$object);
                }
            }
            rmdir($dir);
        } else {
            throw new DirectoryNotExistException("Directory '{$dir}' not exist.");
        }
    }
}