<?php

namespace App\Utils;

use CodeIgniter\Files\File;
use Exception;
use InvalidArgumentException;
use Throwable;


class FileManager
{

    public static function generateFolderId()
    {
        return md5(uniqid(mt_rand(), true));
    }

    public static function getFileFromFolder(string $folderPath)
    {
        try {
            return glob("{$folderPath}/*");
        } catch (Throwable $th) {
            throw new Exception('No se ha encontrado el archivo en la carpeta dada');
        }
    }


    public static function createFolder(string $path)
    {
        try {
            if (! is_dir($path)) {
                mkdir($path, 0777, true);
            }
        } catch (Throwable $th) {
            throw new Exception('Ha ocurrido un error al crear la carpeta');
        }
    }

    public static function moveClientFileToServer(File $file, string $destPath)
    {
        try {
            $file->move($destPath);
        } catch (Throwable $th) {
            throw new Exception('Ha ocurrido un error al guardar el archivo del cliente en el servidor');
        }
    }

    public static function changeDirectoryFolder(string $sourcePath, string $destPath)
    {
        try {
            self::verifyDirectory($sourcePath, 'directorio fuente');

            if (! rename($sourcePath, $destPath)) {
                throw new Exception('Ocurrió un error al mover la carpeta');
            }
        } catch (Throwable $th) {
            throw new Exception('La carpeta no existe o ha ocurrido un error al moverla');
        }
    }

    public static function changeDirectoryCollectionFolder(array $keys)
    {
        try {
            foreach ($keys as $key) {
                $outputFolder = FILES_UPLOAD_DIRECTORY . $key;
                $sourceFolder = FILES_TEMPORAL_DIRECTORY . $key;

                self::verifyDirectory($sourceFolder, 'directorio fuente');
                self::verifyDirectory($outputFolder, 'directorio destino');

                if (! rename($sourceFolder, $outputFolder)) {
                    throw new Exception('Ocurrió un error al mover la carpeta');
                }
            }
        } catch (Throwable $th) {
            throw new Exception($th->getMessage());
        }
    }

    public static function mergeChunckFiles(string $filePath, string $fileData, string $fileOffset)
    {
        try {
            if (! file_exists($filePath)) {
                file_put_contents($filePath, '');
            }

            $fileOpen = fopen($filePath, 'r+b');
            fseek($fileOpen, $fileOffset);
            fwrite($fileOpen, $fileData);
            fclose($fileOpen);

            return filesize($filePath);
        } catch (Throwable $th) {
            throw new Exception('Ha ocurrido un error al procesar el archivo por partes');
        }
    }

    public static function deleteFolderWithContent(string $folderPath)
    {
        try {
            if (is_dir($folderPath)) {
                $files = glob($folderPath . '/*');

                foreach ($files as $file) {
                    is_dir($file) ? static::deleteFolderWithContent($file) : unlink($file);
                }
                rmdir($folderPath);
            }
        } catch (Throwable $th) {
            throw new Exception('Ha ocurrido un error al eliminar la carpeta con su contenido');
        }
    }

    public static function verifyDirectory(string $path, string $directoryType)
    {
        if (! is_dir($path)) {
            throw new InvalidArgumentException("El {$directoryType} [{$path}] no existe o no es una carpeta.");
        }
    }
}