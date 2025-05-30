<?php

namespace App\Controllers;

use App\Utils\FileManager;
use CodeIgniter\HTTP\Response;
use Throwable;

class CtrlApiFiles extends BaseController
{

    public function getFileFromServer()
    {
        try {
            $fileKey = $this->request->getGet()['file'];
            $fileRoute = FILES_UPLOAD_DIRECTORY . $fileKey;
            $file = FileManager::getFileFromFolder($fileRoute)[0];

            return $this->response->setStatusCode(Response::HTTP_OK)->download($file, null, true);
        } catch (Throwable $th) {
            return $this->response->setStatusCode(Response::HTTP_NOT_FOUND, 'No se ha podido encontrar el archivo');
        }
    }

    public function restoreTemporalFile()
    {
        try {
            $key    = $this->request->getGet()['file'];
            $folder = FILES_TEMPORAL_DIRECTORY . $key;
            $file   = FileManager::getFileFromFolder($folder)[0];

            return $this->response->setStatusCode(Response::HTTP_OK)->download($file, null, true);
        } catch (Throwable $th) {
            return $this->response->setStatusCode(Response::HTTP_NOT_FOUND, 'No se ha podido encontrar el archivo');
        }
    }

    public function processTemporalFile()
    {
        try {
            $inputName = $this->request->header('Input')->getValue();
            $file      = $this->request->getFiles()[$inputName][0] ?? null;
            $key       = FileManager::generateFolderId();
            $folder    = FILES_TEMPORAL_DIRECTORY . $key;
            FileManager::createFolder($folder);
            
            if ($file) {
                FileManager::moveClientFileToServer($file, $folder);
            }

            return $this->response->setStatusCode(Response::HTTP_OK)->setJSON(['key' => $key]);
        } catch (Throwable $th) {
            return $this->response->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR, json_encode('Ha ocurrido un error mientras se cargaba el archivo'));
        }
    }

    public function processTemporalFileByChunks()
    {
        try {
            $key        = $this->request->getGet('patch');
            $fileName   = $this->request->header('Upload-Name')->getValue();
            $fileLength = $this->request->header('Upload-Length')->getValue();
            $fileData   = $this->request->getBody();
            $offset     = $this->request->header('Upload-Offset')->getValue();

            $folder  = FILES_TEMPORAL_DIRECTORY . $key;
            $fileTmp = "{$folder}/{$fileName}";

            $temporalFileLength = FileManager::mergeChunckFiles($fileTmp, $fileData, $offset);

            return $this->response->setStatusCode(Response::HTTP_OK);
        } catch (Throwable $th) {
            return $this->response->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR, json_encode('Ha ocurrido un error mientras se cargaba el archivo'));
        }
    }

    public function deleteTemporalFile()
    {
        try {
            $key    = $this->request->getBody();
            $folder = FILES_TEMPORAL_DIRECTORY . $key;
            FileManager::deleteFolderWithContent($folder);

            return $this->response->setStatusCode(Response::HTTP_OK);
        } catch (Throwable $th) {
            return $this->response->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR, $th->getMessage());
        }
    }
}