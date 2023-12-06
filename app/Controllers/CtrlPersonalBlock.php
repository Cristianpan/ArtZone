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

            return $this->response->setJSON(['ok' => true, 'body' => $body])->setStatusCode(201);

        } catch (InvalidDataInputException $th) {
            return $this->response->setJSON(['ok' => false, 'body' => $th->getErros()])->setStatusCode(400);
        } catch (\Throwable $th){
            return $this->response->setJSON($th);
        }
    }

    public function update(String $userId, String $personalBlockId){   

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
                throw new PersonalBlockNotFoundException('No existe el bloque personalizado');

            }

            $dataPersonalBlock = FilterHtml::filterHtml($dataPersonalBlock); 

            $personalBlock->update($personalBlockId, $dataPersonalBlock);

            $body = [
                'personalBlockId' => $personalBlockId,
                'userId' => $userId,
                'title' => $dataPersonalBlock['title'],
                'description' => $dataPersonalBlock['description']
            ];
            return $this->response->setJSON(['ok' => true, 'body' => $body])->setStatusCode(Response::HTTP_OK); 
        } catch (InvalidDataInputException $th) {
            return $this->response->setJSON(['ok' => false, 'body' => $th->getErros()])->setStatusCode(Response::HTTP_BAD_REQUEST);
        } catch(PersonalBlockNotFoundException $th){
            return $this->response->setJSON([
                'ok' => false, 
                'body' => [
                    'personalBlockNotFound'=> $th->getMessage()
                ]
            ]);
        }
    }

    public function delete(String $userId, String $personalBlockId){
        try {  
            $personalBlock = new PersonalBlock();
            $foundBlock = $personalBlock
                ->where('personalBlockId', $personalBlockId)
                ->where('userId', $userId)
                ->first();
    
            if ($foundBlock == null) {
                throw new PersonalBlockNotFoundException('No existe el bloque personalizado');
            }
    
            $personalBlock->delete($personalBlockId);
    
            $body = [
                'personalBlockId' => $personalBlockId,
            ];
    
            return $this->response->setJSON(['ok' => true, 'body' => $body])->setStatusCode(Response::HTTP_OK);
        } catch (PersonalBlockNotFoundException $th) {
            return $this->response->setJSON([
                'ok' => false,
                'body' => [
                    'personalBlockNotFound' => $th->getMessage()
                ]
            ]);
        }

    }
}
