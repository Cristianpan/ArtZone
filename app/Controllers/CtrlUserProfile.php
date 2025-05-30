<?php

namespace App\Controllers;

use App\Classes\ClientConfig;
use App\Controllers\BaseController;
use App\Errors\InvalidDataInputException;
use App\Models\ArtItem;
use App\Models\Occupation;
use App\Models\PersonalBlock;
use App\Models\User;
use App\Models\UserDetails;
use App\Utils\FileManager;
use App\Utils\FilterHtml;
use App\Validators\UserEditValidation;

class CtrlUserProfile extends BaseController
{
    private $configImageBackground;
    private $configImageProfile;

    public function __construct()
    {
        $this->configImageBackground = new ClientConfig("imageBackground");
        $this->configImageProfile = new ClientConfig("imageProfile");
    }

    public function index(String $userId)
    {
        $userData = (new User())->getUserData($userId);

        return view("pages/user/index", [
            'userData' => $userData,
        ]);
    }

    public function viewEdit(String $userId)
    {
        $occupations = (new Occupation())->findAll();
        $personalBlocks = (new PersonalBlock())->where('userId', $userId)->findAll();
        $userData = (new User())->where('userId', $userId)->first();
        $userDetails = (new UserDetails())->where('userId', $userId)->first();
        $items = (new ArtItem())->select('artItemId, isSold, image,userId,shortDescription')->where('userId', $userId)->findAll();


        if (session()->has('clientData')) {
            $clientData = session()->get('clientData');
            $this->configImageBackground->setClientData($clientData);
            $this->configImageProfile->setClientData($clientData);
        } else {
            $this->configImageBackground->setFiles([$userDetails['imageBackground'] ?? '']);
            $this->configImageProfile->setFiles([$userDetails['imageProfile'] ?? '']);
        }

        return view("pages/user/edit", [
            'occupations' => $occupations,
            'personalBlocks' => $personalBlocks,
            'userData' => $userData,
            'userDetails' => $userDetails,
            'imageBackground' => $this->configImageBackground->getConfig(),
            'imageProfile' => $this->configImageProfile->getConfig(),
            'items' => $items
        ]);
    }

    public function edit(String $userId)
    {
        try {
            $userData = $this->request->getPost();
            $validator = new UserEditValidation();
            $validator->validateInputs($userData);
            $validator->validateEmail($userData['email']);

            $userData = FilterHtml::filterHtml($userData); 

            (new User())->update($userId, $userData);

            $usertDataToSave = [
                'userId' => $userId,
                'userDetailId' => $userData['userDetailId'],
                'description' => $this->request->getPost('description'),
                'cardNumber' => $this->request->getPost('cardNumber'),
                'occupationId' => $this->request->getPost('occupationId'),
                'imageBackground' => $this->request->getPost('imageBackground')[0],
                'imageProfile' => $this->request->getPost('imageProfile')[0],
            ];

            (new UserDetails())->save($usertDataToSave);

            session()->set('user', [
                'userId' => $userId,
                'name' => $userData['name'],
                'email' => $userData['email'],
                'userImage' => $this->request->getPost('imageProfile')[0],
            ]);

            if (file_exists(FILES_TEMPORAL_DIRECTORY . $userData['imageProfile'][0])) {
                FileManager::changeDirectoryFolder(FILES_TEMPORAL_DIRECTORY . $userData['imageProfile'][0], FILES_UPLOAD_DIRECTORY . $userData['imageProfile'][0]);
            }

            if (file_exists(FILES_TEMPORAL_DIRECTORY . $userData['imageBackground'][0])) {
                FileManager::changeDirectoryFolder(FILES_TEMPORAL_DIRECTORY . $userData['imageBackground'][0], FILES_UPLOAD_DIRECTORY . $userData['imageBackground'][0]);
            }

            if (isset($user['delete-imageBackground'][0])) {
                FileManager::deleteFolderWithContent($userData['delete-imageBackground'][0]);
            }

            if (isset($user['delete-imageProfile'][0])) {
                FileManager::deleteFolderWithContent($userData['delete-imageProfile'][0]);
            }

            $response = [
                'title' => 'Actualización exitosa',
                'message' => 'Los datos del usuario han sido actualizados correctamente.',
                'type' => 'success'
            ];
            return redirect()->to("profile/$userId")->with('response', $response);
        } catch (InvalidDataInputException $th) {
            session()->setFlashdata('clientData', $this->request->getPost());
            return redirect()->to("/profile/$userId")->withInput();
        }
    }
}
