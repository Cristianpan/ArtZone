<?php

use App\Controllers\CtrlApiFiles;
use App\Controllers\CtrlArtItem;
use App\Controllers\CtrlAuth;
use App\Controllers\CtrlOrderAndSales;
use App\Controllers\CtrlPersonalBlock;
use App\Controllers\CtrlStore;
use App\Controllers\CtrlUserProfile;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

//Auth
$routes->get('/login', [CtrlAuth::class, 'index'], ['as' => 'login']);
$routes->post('/login', [CtrlAuth::class, 'login'], ['as' => 'login']);
$routes->get('/signup', [CtrlAuth::class, 'signupView'], ['as' => 'signup']);
$routes->post('/signup', [CtrlAuth::class, 'signup'], ['as' => 'signup']);
$routes->get('/logout', [CtrlAuth::class, 'logout'], ['as' => 'logout']);

//User
$routes->get("/(:segment)", [CtrlUserProfile::class, 'index/$1'], ['as' => 'user']);
$routes->get("/profile/(:segment)", [CtrlUserProfile::class, 'viewEdit/$1'], ['as' => 'user-edit']);
$routes->post("/profile/(:segment)", [CtrlUserProfile::class, 'edit/$1'], ['as' => 'user-edit']);

//Personal blocks
$routes->post('/profile/(:segment)/personalBlock', [CtrlPersonalBlock::class, 'create/$1'], ['as' => 'personal-block']);
$routes->put('/profile/(:segment)/personalBlock/(:segment)', [CtrlPersonalBlock::class, 'update/$1/$2'], ['as' => 'personal-block']);
$routes->delete('/profile/(:segment)/personalBlock/(:segment)', [CtrlPersonalBlock::class, 'delete/$1/$2'], ['as' => 'personal-block']);

//Orders and sales
$routes->get('/profile/(:segment)/orders', [CtrlOrderAndSales::class, 'viewOrder/$1'], ['as' => 'orders']); 
$routes->get('/profile/(:segment)/sales', [CtrlOrderAndSales::class, 'viewSale/$1'], ['as' => 'sales']); 


//items
$routes->get('/profile/(:segment)/item', [CtrlArtItem::class, 'viewCreate'], ['as' => 'item-create']);
$routes->post('/profile/(:segment)/item', [CtrlArtItem::class, 'create/$1'], ['as' => 'item-create']);
$routes->get('/profile/(:segment)/item/(:segment)', [CtrlArtItem::class, 'viewEdit/$1/$2'], ['as' => 'item-edit']);
$routes->post('/profile/(:segment)/item/(:segment)', [CtrlArtItem::class, 'edit/$1/$2'], ['as' => 'item-edit']);
$routes->get('/profile/(:segment)/item/(:segment)/delete', [CtrlArtItem::class, 'delete/$1/$2'], ['as' => 'item-delete']);


//Shop
$routes->get('/', [CtrlStore::class, 'index'], ['as' => 'store']); 
$routes->get('/store/artItem/(:segment)', [CtrlStore::class, 'viewItem/$1'], ['as'=> 'item']); 
$routes->get('/store/shoppingCart', [CtrlStore::class, 'viewCart'], ['as' => 'shoppingCart']); 
$routes->get('/store/shoppingCart', [CtrlStore::class, 'viewCart'], ['as' => 'shoppingCart']); 
$routes->post('/store/payment', [CtrlStore::class, 'payment'], ['as' => 'shoppingCart']); 


//Api files
$routes->group('api/files', static function ($routes) {
    /** @var \CodeIgniter\Router\RouteCollection $routes */
    $routes->post('process', [CtrlApiFiles::class, 'processTemporalFile']);
    $routes->patch('process', [CtrlApiFiles::class, 'processTemporalFileByChunks']);
    $routes->get('restore', [CtrlApiFiles::class, 'restoreTemporalFile']);
    $routes->get('load', [CtrlApiFiles::class, 'getFileFromServer']);
    $routes->delete('delete', [CtrlApiFiles::class, 'deleteTemporalFile']);
});
