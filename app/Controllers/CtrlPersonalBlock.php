<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Errors\InvalidDataInputException;
use App\Errors\PersonalBlockNotFoundException;
use App\Models\PersonalBlock;
use App\Utils\FilterHtml;
use App\Validators\PersonalBlockValidation;
use CodeIgniter\HTTP\Response;
use Faker\Core\Uuid;

class CtrlPersonalBlock extends BaseController
{
    public function create(String $userId)
    {
        try {
            $dataPersonalBlock = json_decode($this->request->getBody(), true);
            $personalBlockValidation = new PersonalBlockValidation();
            $personalBlockValidation->validateInputs($dataPersonalBlock);

            $personalBlock = new PersonalBlock();
            $dataPersonalBlock['userId'] = $userId;
            $dataPersonalBlock['personalBlockId'] = (new Uuid())->uuid3();

            $dataPersonalBlock = FilterHtml::filterHtml($dataPersonalBlock);
            $personalBlock->insert($dataPersonalBlock);

            $body = [
                'personalBlockId' => $dataPersonalBlock['personalBlockId'],
                'userId' => $userId,
                'title' => $dataPersonalBlock['title'],
                'description' => $dataPersonalBlock['description']
            ];

            return $this->response->setJSON(['ok' => true, 'message' => 'Tu historia ha sido creada con éxito. Continua creando más para que todos te conozcan mejor', 'body' => $body])->setStatusCode(Response::HTTP_OK);
        } catch (InvalidDataInputException $th) {
            return $this->response->setJSON(['ok' => false, 'message' => 'No se ha podido actualizar tu historia. Verifica que los datos sean correctos', 'body' => $th->getErros()])->setStatusCode(Response::HTTP_BAD_REQUEST);
        } catch (\Throwable $th) {
            return $this->response->setJSON([
                'ok' => false,
                'message' => "Ha ocurrido un error al crear tu historia. Por favor intenta nuevamente.",
                'body' => []
            ]);
        }
    }

    public function update(String $userId, String $personalBlockId)
    {

        try {
            $dataPersonalBlock = json_decode($this->request->getBody(), true);
            $personalBlockValidation = new PersonalBlockValidation();
            $personalBlockValidation->validateInputs($dataPersonalBlock);

            $personalBlock = new PersonalBlock();
            $foundBlock = $personalBlock
                ->where('personalBlockId', $personalBlockId)
                ->where('userId', $userId)
                ->first();

            if ($foundBlock == null) {
                throw new PersonalBlockNotFoundException('No se ha encontrado la historia que desea actualizar');
            }

            $dataPersonalBlock = FilterHtml::filterHtml($dataPersonalBlock);

            $personalBlock->update($personalBlockId, $dataPersonalBlock);

            $body = [
                'personalBlockId' => $personalBlockId,
                'userId' => $userId,
                'title' => $dataPersonalBlock['title'],
                'description' => $dataPersonalBlock['description']
            ];
            return $this->response->setJSON(['ok' => true, 'message' => 'Tu historia ha sido actualizada con éxito. Continua creando más para que todos te conozcan mejor', 'body' => $body])->setStatusCode(Response::HTTP_OK);
        } catch (InvalidDataInputException $th) {
            return $this->response->setJSON(['ok' => false, 'message' => 'No se ha podido actualizar tu historia. Verifica que los datos sean correctos', 'body' => $th->getErros()])->setStatusCode(Response::HTTP_BAD_REQUEST);
        } catch (PersonalBlockNotFoundException $th) {
            return $this->response->setJSON([
                'ok' => false,
                'message' => $th->getMessage(),
                'body' => []
            ]);
        }
    }

    public function delete(String $userId, String $personalBlockId)
    {
        try {
            $personalBlock = new PersonalBlock();
            $foundBlock = $personalBlock
                ->where('personalBlockId', $personalBlockId)
                ->where('userId', $userId)
                ->first();

            if ($foundBlock == null) {
                throw new PersonalBlockNotFoundException('No se ha encontrado la historia que desea eliminar');
            }

            $personalBlock->delete($personalBlockId);

            $body = [
                'personalBlockId' => $personalBlockId,
            ];

            return $this->response->setJSON(['ok' => true, 'message' => 'Tu historia ha sido eliminada con exito, ¡recuerda crear nuevas historias para que te conozcan mejor!', 'body' => $body])->setStatusCode(Response::HTTP_OK);
        } catch (PersonalBlockNotFoundException $th) {
            return $this->response->setJSON([
                'ok' => false,
                'message' => $th->getMessage(),
                'body' => []
            ]);
        }
    }
}
