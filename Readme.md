## Miembros del equipo

| Name | <!-- --> |
|--------|-|
|Gamboa Nieto, Pablo|<img src="./team/ProfilePicPablo2.jpeg" width="120" height="150">|
|Pan Zaldivar, Cristian David| <img src="./team/cristianPan.jpeg" width="120" height="150"> |
|Quevedo Zaldivar, Luis Jonathan| <img src="./team/Luis.jpeg" width="120" height="150">|
|Vazquéz Rodríguez, Diana Carolina| <img src="./team/DianaVazquez.png" width="120" height="120"> |

## Estructura del proyecto

![artzone-logo](https://i.imgur.com/CrwsAB7.png)

Art Zone es un proyecto para el curso de desarrollo web. 

## Apps

# ArtZone

- [app/](app)
  - [Classes/](app\Classes)
  - [Config/](app\Config)
    - [Boot/](app\Config\Boot)
  - [Controllers/](app\Controllers)
  - [Database/](app\Database)
    - [Migrations/](app\Database\Migrations)
    - [Seeds/](app\Database\Seeds)
  - [Errors/](app\Errors)
  - [Filters/](app\Filters)
  - [Helpers/](app\Helpers)
  - [Language/](app\Language)
    - [en/](app\Language\en)
  - [Libraries/](app\Libraries)
  - [Models/](app\Models)
  - [RulesValidation/](app\RulesValidation)
  - [ThirdParty/](app\ThirdParty)
  - [Utils/](app\Utils)
  - [Validators/](app\Validators)
  - [Views/](app\Views)
    - [components/](app\Views\components)
    - [errors/](app\Views\errors)
      - [alerts/](app\Views\errors\alerts)
      - [cli/](app\Views\errors\cli)
      - [html/](app\Views\errors\html)
    - [pages/](app\Views\pages)
      - [art/](app\Views\pages\art)
      - [auth/](app\Views\pages\auth)
      - [catalog/](app\Views\pages\catalog)
      - [shop/](app\Views\pages\shop)
      - [user/](app\Views\pages\user)
    - [templates/](app\Views\templates)
  - [.htaccess](app.htaccess)
  - [Common.php](app\Common.php)
  - [index.html](app\index.html)
- [public/](public)
  - [assets/](public\assets)
    - [fonts/](public\assets\fonts)
    - [images/](public\assets\images)
      - [cart/](public\assets\images\cart)
      - [ejemp/](public\assets\images\ejemp)
      - [gallery/](public\assets\images\gallery)
  - [.htaccess](public.htaccess)
  - [favicon.ico](public\favicon.ico)
  - [index.php](public\index.php)
  - [robots.txt](public\robots.txt)
- [src/](src)
  - [js/](src\js)
  - [sass/](src\sass)
    - [base/](src\sass\base)
    - [components/](src\sass\components)
    - [pages/](src\sass\pages)
    - [plugins/](src\sass\plugins)
- [tests/](tests)
  - [_support/](tests\_support)
    - [Database/](tests\_support\Database)
      - [Migrations/](tests\_support\Database\Migrations)
      - [Seeds/](tests\_support\Database\Seeds)
    - [Libraries/](tests\_support\Libraries)
    - [Models/](tests\_support\Models)
  - [database/](tests\database)
  - [session/](tests\session)
  - [unit/](tests\unit)
  - [README.md](tests\README.md)
- [writable/](writable)
  - [cache/](writable\cache)
  - [debugbar/](writable\debugbar)
  - [logs/](writable\logs)
  - [session/](writable\session)
  - [uploads/](writable\uploads)
  - [.htaccess](writable\.htaccess)
- [.env.example](.env.example)
- [.gitignore](.gitignore)
- [builds](builds)
- [composer.json](composer.json)
- [composer.lock](composer.lock)
- [gulpfile.js](gulpfile.js)
- [LICENSE](LICENSE)
- [package-lock.json](package-lock.json)
- [package.json](package.json)
- [phpunit.xml.dist](phpunit.xml.dist)
- [preload.php](preload.php)
- [Readme.md](Readme.md)
- [spark](spark)
  

## Para comenzar

### Requisitos previos
- **Composer** Asegúrate de tener [Composer](https://getcomposer.org/) instalado y funcionando en tu computadora.
- **Node** Asegúrate de tener [Node](https://nodejs.org/es) instalado y funcionando en tu computadora.

### Instalación
| Comando            | Descripción                                                                                                                                                                               |
| ------------------ | :---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| `composer install` | Esto instalará todos los paquetes necesarios en la carpeta `vendor`. Si recibes algún error al ejecutar el comando `composer install`, no te preocupes, por favor continúa con: `composer update` |
| `npm install`      | Esto instalará todos los paquetes necesarios en la carpeta `node_modules`.        

### Desarrollo
Utiliza `npm run dev` para poder compilar todos los recursos necesarios para el correcto funcionamiento del proyecto.

### Compilación
Utiliza `npm run build` para poder compilar todos los recursos necesarios para el correcto funcionamiento del proyecto. Esto es útil si deseas compilar los recursos para producción.

### Local
Utiliza `php spark serve` para ejecutar el proyecto localmente. El servidor de desarrollo es accesible en http://localhost:8080.
=======
|Gamboa Nieto, Pablo|<img src="https://i.postimg.cc/CR9hD5f8/Profile-Pic-Pablo2.jpg" width="120" height="150">|
|Pan Zaldivar, Cristian David| <img src="https://i.postimg.cc/mtX2L8L8/cristian-Pan.jpg" width="120" height="150"> |
|Quevedo Zaldivar, Luis Jonathan| <img src="https://i.postimg.cc/hJxS0n95/Luis.jpg" width="120" height="150">|
|Vazquéz Rodríguez, Diana Carolina| <img src="https://i.postimg.cc/pmmVpzyx/Diana-Vazquez.png" width="120" height="120"> |

## Getting Started

### Prerequisites
- **Composer** Make sure to have the [Composer](https://getcomposer.org/) installed & running on your computer.
- **Node** Make sure to have [Node](https://nodejs.org/es) installed & running on your computer. 

### Installation
| Command            | Description                                                                                                                                                                               |
| ------------------ | :---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| `composer install` | This would install all the required packages in the `vendor` folder. If you getting any error when running composer install command, don't worry please continue with : `composer update` |
| `npm install`      | This would install all the required packages in the `node_modules` folder        

### Dev
Use `npm run dev` to be able to compile all the assets that are necessary for a correct functionality of the project. 
of the project. 

### Build
Use `npm run build` to be able to compile all the assets that are necessary for a correct functionality of the project. This is useful if you want to compile the assets for production.

### Local
Use `php spark serve` to run the project locally. The development server is accessible at http://localhost:8080.  
