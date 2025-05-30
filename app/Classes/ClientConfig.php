<?php

namespace App\Classes;

class ClientConfig
{
    private array $config = [];
    private String $inputName; 

    public function __construct(String $inputName)
    {
        $this->inputName = $inputName;
    }

    public function setClientData (array $dataCliente){
        $this->setFiles($dataCliente[$this->inputName]);
        $this->setDeletedFiles($dataCliente["delete-$this->inputName"] ?? []);
    }

    public function setFiles(array $files = [])
    {
        if (!empty($files) && $files[0] !== "") {
            $this->config['files'] = array_map(function ($folderFile) {
                $sourceType = file_exists(FILES_UPLOAD_DIRECTORY . $folderFile) ? 'local' : 'limbo';
                return [
                    "source" => $folderFile,
                    "options" => [
                        "type" => $sourceType,
                    ]
                ];

            }, $files);
        }
    }

    public function filterNewFilesInInput(array $files)
    {
        $newFiles = [];
        foreach ($files as $folderFile) {
            if (!file_exists(FILES_UPLOAD_DIRECTORY . $folderFile)) {
                $newFiles[] = $folderFile;
            }
        }
        return $newFiles;
    }

    private function setDeletedFiles(array $files)
    {
        if (!empty($files)) {
            $this->config["deleteFiles"] = $files;
        }
    }

    public function getConfig(): array
    {
        return $this->config;
    }
}