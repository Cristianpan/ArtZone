<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Errors\InvalidDataInputException;
use App\Models\User;
use App\Models\UserDetails;
use App\Utils\FilterHtml;
use App\Validators\LoginValidation;
use App\Validators\SignupValidation;
use Faker\Core\Uuid;

class CtrlAuth extends BaseController
{
    public function index()
    {
        return view("pages/auth/index");
    }

    public function signupView()
    {

        return view("pages/auth/signup");
    }

    public function signup()
    {
        try {
            $userData = $this->request->getPost();
            $signupValidator =  new SignupValidation();
            $signupValidator->validateInputs($userData);
            $userData = FilterHtml::filterHtml($userData); 

            $userData['userId'] = (new Uuid())->uuid3();

            (new User())->insert($userData);


            session()->set('user', [
                'userId' => $userData['userId'],
                'name' => $userData['name'],
                'email' => $userData['email'],
                'userImage' => '',
            ]);

            $response = [
                'title' => '¡Bienvenido a Art Zone!',
                'message' => '!Gracias por haberte registrado con nosotros¡ Ahora disfruta de las magníficas obras que tenemos para ti',
                'type' => 'success'
            ];

            return redirect()->to("/")->with('response', $response);
        } catch (InvalidDataInputException $th) {
            return redirect()->to('signup')->withInput();
        } catch (\Throwable $th) {
            $response = [
                'title' => 'Oops! Ha ocurrido un error',
                'message' => 'Ha ocurrido un error al guardar los datos del usuario, por favor intente nuevamente',
                'type' => 'error',
            ];
            return redirect()->to('signup')->withInput()->with('response', $response);
        }
    }

    public function login()
    {
        try {
            $userData = $this->request->getPost();
            $loginValidator = new LoginValidation();
            $loginValidator->validateInputs($userData);

            $user = (new User())->select('users.userId, name, imageProfile, email, password')->join('userDetails', 'users.userId = userDetails.userId', 'left')->where('email', $userData['email'])->first();
            $loginValidator->validateCredentials($user, $userData['password']);

            session()->set('user', [
                'userId' => $user['userId'],
                'name' => $user['name'],
                'email' => $user['email'],
                'userImage' => $user['imageProfile'] ? $user['imageProfile'] : ''
            ]);

            return redirect()->to("/");
        } catch (InvalidDataInputException $th) {
            return redirect()->to('login')->withInput();
        } catch (\Throwable $th) {
            $response = [
                'title' => 'Oops! Ha ocurrido un error',
                'message' => 'Ha ocurrido un error al iniciar sesión, por favor intente nuevamente',
                'type' => 'error',
            ];
            return redirect()->to('login')->withInput()->with('response', $response);
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to("login");
    }
}
