<?php
namespace DmitriiKoziuk\yii2Base\tests\unit\helpers;

use Codeception\Test\Unit;
use DmitriiKoziuk\yii2Base\exceptions\DirectoryNotExistException;
use DmitriiKoziuk\yii2Base\helpers\FileHelper;

class FileHelperTest extends Unit
{
    /**
     * @param string $directoryName
     * @dataProvider dataProviderTestCreateDirectoryIfNotExist
     * @throws \DmitriiKoziuk\yii2Base\exceptions\CouldNotCreateDirectoryException
     */
    public function testCreateDirectoryIfNotExist(string $directoryName): void
    {
        $outputDirectory = codecept_output_dir();
        $directoryPath = $outputDirectory . $directoryName;
        $fileHelper = new FileHelper();
        $fileHelper->createDirectoryIfNotExist($directoryPath);
    }

    public function dataProviderTestCreateDirectoryIfNotExist()
    {
        return [
            "create directory 'new-directory'" => ['new-directory'],
            "create subdirectory 'new-directory/sub-directory'" => ['new-directory/sub-directory'],
            "create directory chain first/second/third" => ['first/second/third'],
        ];
    }

    /**
     * @param string $directoryName
     * @dataProvider dataProviderTestRemoveDirectoryRecursive
     * @throws DirectoryNotExistException
     */
    public function testRemoveDirectoryRecursive(string $directoryName): void
    {
        $outputDirectory = codecept_output_dir();
        $directoryPath = $outputDirectory . $directoryName;
        $fileHelper = new FileHelper();
        $fileHelper->removeDirectoryRecursively($directoryPath);
    }

    /**
     * @dataProvider dataProviderTestRemoveDirectoryRecursive
     * @param string $directoryName
     * @throws DirectoryNotExistException
     */
    public function testRemoveDirectoryRecursiveException(string $directoryName): void
    {
        $this->expectException(DirectoryNotExistException::class);
        $fileHelper = new FileHelper();
        $fileHelper->removeDirectoryRecursively($directoryName);
    }

    public function dataProviderTestRemoveDirectoryRecursive()
    {
        return [
            'new-directory' => ['new-directory'],
            'first' => ['first'],
        ];
    }
}