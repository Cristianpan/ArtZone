<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Errors\ArtItemNotFoundException;
use App\Errors\InvalidDataInputException;
use App\Errors\UnauthorizedActionException;
use App\Models\ArtItem;
use App\Validators\ArtItemValidation;
use Throwable;

class CtrlArtCatalog extends BaseController
{
    public function index()
    {
        return view("pages/catalog/index");
    }
    public function viewCreate()
    {
        return view("pages/catalog/create");
    }

    public function viewEdit()
    {
        return view("pages/catalog/create");
    }

    public function create(String $userId)
    {
        try {
            $itemData = $this->request->getPost();
    
            $artItemValidation = new ArtItemValidation();
            $artItemValidation->validateInputs($itemData);
    
            $artItem = new ArtItem();
            $itemData['userId'] = $userId; 
    
            $artItemId = $artItem->insert($itemData);
    
            $response = [
                'title' => '¡Creación exitosa!',
                'message' => 'Los datos de su obra de arte han sido guardados con éxito',
                'type' => "success",
            ];
            return redirect()->to("/user/$userId/catalog")->with('response', $response);
    
        } catch (InvalidDataInputException $th) {
            return redirect()->to("/user/$userId/catalog/create")->withInput();
    
        } catch (\Throwable $th) {
            $response = [
                'title' => '¡Ops! Ha ocurrido un error',
                'message' => 'Ha ocurrido un error al guardar los datos de la obra, por favor intente nuevamente.',
                'type' => "error",
            ];
            return redirect()->to("/user/$userId/catalog/create")->withInput()->with('response', $response);
        }
    }
    
    

    public function edit(String $userId, String $artItemId)
    {
        try {
            $itemData = $this->request->getPost();

            $artItemValidation = new  ArtItemValidation();
            $artItemValidation ->validateInputs($itemData);

            $foundArtItem = (new ArtItem())->find($artItemId);
            
            if(!$foundArtItem){
                throw new ArtItemNotFoundException('El artículo no existe');
            }

            if ($foundArtItem['userId'] !== $userId) {
                throw new UnauthorizedActionException('No tiene permisos para eliminar este artículo.');
            }

            (new ArtItem())->update($artItemId, $itemData);

            $response = [
                'title' => '¡Actualización exitosa!',
                'message' => 'Los datos de su obra han sido actualizados con exito',
                'type' => "success",
            ];
            return redirect()->to("/user/$userId/catalog")->with('response', $response);
        } catch (ArtItemNotFoundException|InvalidDataInputException $th) {
            return redirect()->to("/user/$userId/catalog/edit/$artItemId")->withInput();
        } catch (\Throwable $th) {
            $response = [
                'title' => '¡Ops! Ha ocurrido un error',
                'message' => 'Ha ocurrido un error al actualizar los datos de la obra, por favor intente nuevamente.',
                'type' => "error",
            ];
            return redirect()->to("/user/$userId/catalog/edit/$artItemId")->withInput()->with('response', $response);
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
            return redirect()->to("/user/$userId/catalog")->with('response', $response);

        } catch (ArtItemNotFoundException|UnauthorizedActionException $th) {
            $response = [
                'title' => '¡Ops! Ha ocurrido un error',
                'message' => $th->getMessage(),
                'type' => "error",
            ];
            return redirect()->to("/user/$userId/catalog/edit/$artItemId")->with('response', $response);

        }catch (\Throwable $th) {
            $response = [
                'title' => '¡Ops! Ha ocurrido un error',
                'message' => 'Ha ocurrido un error al eliminar la obra, por favor intente nuevamente.',
                'type' => "error",
            ];
            return redirect()->to("/user/$userId/catalog/edit/$artItemId")->with('response', $response);
        }
    }
}
