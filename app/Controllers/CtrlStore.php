<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Errors\InvalidDataInputException;
use App\Models\ArtItem;
use App\Models\Order;
use App\Utils\FilterHtml;
use App\Validators\DataClientValidation;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\HTTP\Response;

class CtrlStore extends BaseController
{

    public function index()
    {
        $search = trim($this->request->getGet('search') ?? '');

        if ($search) {
            $items = (new ArtItem())->getItemsByLike($search);
        } else {
            $items = (new ArtItem())->getAllItems();
        }

        if ($search && empty($items)) {
            $response = [
                'title' => 'Sin resultados de busqueda',
                'message' => 'No se ha encontrado alguna coincidencia con su busqueda realizada',
                'type' => "success",
            ];

            session()->setFlashdata('response', $response);            
        }
        
        session()->setFlashdata('search', $search);
        return view("pages/store/index", ['items' => $items]);
    }

    public function viewPayment()
    {
        return view("pages/store/payment");
    }

    public function viewCart()
    {
        return view("pages/store/cart");
    }

    public function viewItem(String $artItemId)
    {
        $artItem = (new ArtItem())->getItemById($artItemId);

        if (is_null($artItem)) {
            throw PageNotFoundException::forPageNotFound();
        }

        return view("pages/store/item", ['artItem' => $artItem]);
    }

    public function payment()
    {

        try {
            $data = $this->request->getJSON(true);

            $validator = new DataClientValidation();
            $validator->validateInputs($data['details']);

            $data['details'] = FilterHtml::filterHtml($data['details']); 

            (new Order())->createOrder($data);

            $reponse = [
                'ok' => true,
                'message' => "La compra ha sido realizada con éxito",
                "body" => []
            ];

            return $this->response->setJSON($reponse)->setStatusCode(Response::HTTP_OK);
        } catch (InvalidDataInputException $th) {
            $reponse = [
                'ok' => false,
                'message' => "Verifique que haya proporcionado todos los datos correctamente.",
                "body" => $th->getErros(),
            ];
            return $this->response->setJSON($reponse)->setStatusCode(Response::HTTP_BAD_REQUEST);
        } catch (\Throwable $th) {
            $reponse = [
                'ok' => false,
                'message' => "Ha ocurrido un error al realizar la compra, porfavor intente nuevamente.",
                "body" => []
            ];
            return $this->response->setJSON($reponse)->setStatusCode(Response::HTTP_BAD_REQUEST);
        }
    }
}
