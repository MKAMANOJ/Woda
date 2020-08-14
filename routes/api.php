<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

$this->resource('device-token', 'DeviceTokenController', ['only' => 'store']);

$this->get('/menus', ['as' => 'api.allMenus', 'uses' => 'MenuController@index']);

$this->get('/gallery-categories', ['as' => 'api.allGalleryCategories', 'uses' => 'GalleryController@getAllCategories']);
$this->get('/gallery/category/{id}/images', ['as' => 'api.allImagesOfACategory', 'uses' => 'GalleryController@getAllImagesOfACategory']);

$this->get('/file-categories', ['as' => 'api.allFileCategories', 'uses' => 'FileController@getAllFileCategories']);
$this->get('/file/category/{id}/files', ['as' => 'api.allFilesOfACategory', 'uses' => 'FileController@getAllFilesOfACategory']);
