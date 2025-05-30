<?php

namespace App\Controllers;

use App\Classes\ClientConfig;
use App\Controllers\BaseController;
use App\Errors\ArtItemNotFoundException;
use App\Errors\InvalidDataInputException;
use App\Errors\UnauthorizedActionException;
use App\Models\ArtItem;
use App\Models\ArtStyle;
use App\Models\ArtType;
use App\Utils\FileManager;
use App\Utils\FilterHtml;
use App\Validators\ArtItemValidation;
use Throwable;


class CtrlArtItem extends BaseController
{
    private $configArtItems;

    public function __construct()
    {
        $this->configArtItems = new ClientConfig('artItemFile');
    }

    public function index()
    {
        return view("pages/art/item");
    }

    public function viewCreate()
    {
        if (session()->has('clientData')) {
            $this->configArtItems->setClientData(session()->get('clientData'));
        }

        return view("pages/item/create", [
            'artStyles' => (new ArtStyle())->getArtStyles(),
            'artTypes' => (new ArtType())->getArtTypes(),
            'artItemFiles' => $this->configArtItems->getConfig(),
        ]);
    }

    public function viewEdit(String $userId, String $artItemId)
    {
        $item = (new ArtItem())->find($artItemId);

        if(!$item){
            return redirect()->to("/profile/$userId")->with("response", [
                'title' => "Oops!",
                'message' => "No se ha encontrado la página solicitada",
                'type' => "succes"
            ]);
        }

        if ($item['userId'] !== $userId) {
            return redirect()->to("/profile/$userId")->with("response", [
                'title' => "Oops!",
                'message' => "Parece que no cuentas con permisos para acceder a esta página",
                'type' => "succes"
            ]);
        }

        if (session()->has('clientData')) {
            $this->configArtItems->setClientData(session()->get('clientData'));
        } else {
            $this->configArtItems->setFiles([$item['image'] ?? '']);
        }

        return view("pages/item/edit", [
            'artStyles' => (new ArtStyle())->findAll(),
            'artTypes' => (new ArtType())->findAll(),
            'item' => $item,
            'artItemFiles' => $this->configArtItems->getConfig(),
        ]);
    }

    public function create(String $userId)
    {
        try {
            $itemData = $this->request->getPost();

            $artItemValidation = new ArtItemValidation();
            $artItemValidation->validateInputs($itemData);

            $itemData = FilterHtml::filterHtml($itemData);

            $itemData['userId'] = $userId;
            $itemData['image'] = $itemData['artItemFile'][0];

            (new ArtItem())->insert($itemData);
            FileManager::changeDirectoryFolder(FILES_TEMPORAL_DIRECTORY . $itemData['image'],  FILES_UPLOAD_DIRECTORY . $itemData['image']);

            $response = [
                'title' => '¡Creación exitosa!',
                'message' => 'Los datos de su obra de arte han sido guardados con éxito',
                'type' => "success",
            ];
            return redirect()->to("/profile/$userId")->with('response', $response);
        } catch (InvalidDataInputException $th) {
            session()->setFlashdata('clientData', $this->request->getPost());
            return redirect()->to("/profile/$userId/item")->withInput();
        } catch (Throwable $th) {
            session()->setFlashdata('clientData', $this->request->getPost());
            $response = [
                'title' => '¡Ops! Ha ocurrido un error',
                'message' => 'Ha ocurrido un error al guardar los datos de la obra, por favor intente nuevamente.',
                'type' => "error",
            ];
            return redirect()->to("/profile/$userId/item")->withInput()->with('response', $response);
        }
    }

    public function edit(String $userId, String $artItemId)
    {
        try {
            $itemData = $this->request->getPost();

            $artItemValidation = new  ArtItemValidation();
            $artItemValidation->validateInputs($itemData);
            $itemData = FilterHtml::filterHtml($itemData);

            $foundArtItem = (new ArtItem())->find($artItemId);

            if (!$foundArtItem) {
                throw new ArtItemNotFoundException('Parece que la obra que estas buscando ya no existe');
            }

            if ($foundArtItem['userId'] !== $userId) {
                throw new UnauthorizedActionException('No tiene permisos para eliminar esta obra.');
            }

            $itemData['image'] = $itemData['artItemFile'][0];

            (new ArtItem())->update($artItemId, $itemData);

            if (file_exists(FILES_TEMPORAL_DIRECTORY. $itemData['image'])){
                FileManager::changeDirectoryFolder(FILES_TEMPORAL_DIRECTORY . $itemData['image'], FILES_UPLOAD_DIRECTORY . $itemData['image']);
            }

            if (isset($itemData['delete-artItemFile'][0])){
                FileManager::deleteFolderWithContent($itemData['delete-artItemFile'][0]);
            }

            $response = [
                'title' => '¡Actualización exitosa!',
                'message' => 'Los datos de su obra han sido actualizados con exito',
                'type' => "success",
            ];
            
            return redirect()->to("/profile/$userId")->with('response', $response);
        } catch (InvalidDataInputException $th) {
            session()->setFlashdata('clientData', $this->request->getPost());
            return redirect()->to("/profile/$userId/item/$artItemId")->withInput();
        } catch (ArtItemNotFoundException | UnauthorizedActionException $th) {
            $response = [
                'title' => '¡Ops! Ha ocurrido un error',
                'message' => $th->getMessage(),
                'type' => "error",
            ];
            return redirect()->to("/profile/$userId")->with('response', $response);
        } catch (Throwable $th) {
            $response = [
                'title' => '¡Ops! Ha ocurrido un error',
                'message' => 'Ha ocurrido un error al actualizar los datos de la obra, por favor intente nuevamente.',
                'type' => "error",
            ];
            session()->setFlashdata('clientData', $this->request->getPost());
            return redirect()->to("/profile/$userId/item/$artItemId")->withInput()->with('response', $response);
        }
    }

    public function delete(String $userId, String $artItemId)
    {
        try {
            $artItemModel = new ArtItem();
            $artItem = $artItemModel->find($artItemId);
            if (!$artItem) {
                throw new ArtItemNotFoundException('El artículo no existe');
            }

            if ($artItem['userId'] !== $userId) {
                throw new UnauthorizedActionException('No tiene permisos para eliminar este artículo.');
            }
            
            $artItemModel->delete($artItemId);
            
            $response = [
                'title' => '¡Eliminación exitosa!',
                'message' => 'Los datos de la obra han sido eliminados correctamente',
                'type' => "success",
            ];
            
            return redirect()->to("/profile/$userId")->with('response', $response);
        } catch (ArtItemNotFoundException | UnauthorizedActionException $th) {
            $response = [
                'title' => '¡Ops! Ha ocurrido un error',
                'message' => $th->getMessage(),
                'type' => "error",
            ];
            return redirect()->to("/profile/$userId")->with('response', $response);
        } catch (Throwable $th) {
            $response = [
                'title' => '¡Ops! Ha ocurrido un error',
                'message' => 'Ha ocurrido un error al eliminar la obra, por favor intente nuevamente.',
                'type' => "error",
            ];
            return redirect()->to("/profile/$userId/item/$artItemId")->with('response', $response);
        }
    }
}
