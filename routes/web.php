<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

$this->group(['namespace' => 'Frontend'], function () {
	$this->get('en','HomeController@english')->name('en');
	$this->get('np','HomeController@nepali')->name('np');

	$this->get('/', 'HomeController@index')->name('frontend.home');
	$this->get('/about', 'AboutController@index')->name('frontend.about');
	$this->get('/oraganizational_chart', 'OrganizationalChartController@index')->name('frontend.oraganizational_chart');
	$this->get('/staff', 'StaffController@index')->name('frontend.staff');
	$this->get('/gallery', 'GalleryController@index')->name('frontend.gallery');
	$this->get('/gallery/{gallery}', 'GalleryController@show')->name('frontend.images');
	$this->get('/file/{fileSlug}', 'FileController@index')->name('frontend.file');
	$this->get('/file/{fileSlug}/{file_id}', 'FileController@show')->name('frontend.file_detail');
	$this->get('/downloads', 'DownloadController@index')->name('frontend.download');
	$this->get('/contact-us', 'ContactUsController@index')->name('frontend.contact-us');
	$this->post('/send-message', 'ContactUsController@sendMessage')->name('frontend.send-message');
});