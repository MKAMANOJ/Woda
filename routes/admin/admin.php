<?php

/****************************************
 * Dashboard module.
 * **************************************
 */
$this->get('/', ['as' => 'admin.index', 'uses' => 'AdminController@index']);

/****************************************
 * Email Templates and and email template module.
 * **************************************
 */
$this->group(['namespace' => 'EmailTemplate'], function () {
    $this->get('/email-template/getEmailTemplateForDataTable', ['as'   => 'email-template.getEmailTemplateForDataTable',
                                                                'uses' => 'EmailTemplateController@getEmailTemplateForDataTable']);
    $this->resource('/email-template', 'EmailTemplateController', ['except' => "destroy"]);
});

/****************************************
 * Home module.
 * **************************************
 */
$this->group(['namespace' => 'Home'], function () {
    $this->get('/home/edit', ['as'   => 'home.edit',
                                      'uses' => 'HomePageController@edit']);
    $this->patch('/home/update', ['as'   => 'home.update',
                                          'uses' => 'HomePageController@update']);
});

/****************************************
 * Waste Bus Routine module.
 * **************************************
 */
$this->group(['namespace' => 'WasteBusRoutine'], function () {
    $this->get('/waste-bus-routine/edit', ['as'   => 'waste-bus-routine.edit',
                                      'uses' => 'WasteBusRoutineController@edit']);
    $this->patch('/waste-bus-routine/update', ['as'   => 'waste-bus-routine.update',
                                          'uses' => 'WasteBusRoutineController@update']);
});

/****************************************
 * Introduction info module.
 * **************************************
 */
$this->group(['namespace' => 'Introduction'], function () {
    $this->get('/introduction/edit', ['as'   => 'introduction.edit',
                                      'uses' => 'IntroductionController@edit']);
    $this->patch('/introduction/update', ['as'   => 'introduction.update',
                                          'uses' => 'IntroductionController@update']);
});

/****************************************
 * Important Phone Number module
 * **************************************
 */
$this->group(['namespace' => 'PhoneNumber'], function () {
  $this->get('/phone-numbers/get-all-phone-numbers', ['as'   => 'phone-numbers.getAllPhoneNumbers',
                                               'uses' => 'PhoneNumberController@getAllForDataTable']);
  $this->resource('phone-numbers', 'PhoneNumberController');
});

/****************************************
 * Important WebsiteLink module
 * **************************************
 */
$this->group(['namespace' => 'WebsiteLink'], function () {
  $this->get('/website-links/get-all-website-links', ['as'   => 'website-links.getAllWebsiteLinks',
                                               'uses' => 'WebsiteLinkController@getAllForDataTable']);
  $this->resource('website-links', 'WebsiteLinkController');
});

/****************************************
 * About App info module.
 * **************************************
 */
$this->group(['namespace' => 'AboutApp'], function () {
    $this->get('/about-app/edit', ['as'   => 'about-app.edit',
                                   'uses' => 'AboutAppController@edit']);
    $this->patch('/about-app/update', ['as'   => 'about-app.update',
                                       'uses' => 'AboutAppController@update']);
});

/****************************************
 * Gallery Module
 * **************************************
 */
$this->group(['namespace' => 'Gallery'], function () {
    $this->get('/gallery/get-all-categories', ['as'   => 'gallery.getAllCategories',
                                               'uses' => 'GalleryCategoryController@getAllCategoriesForDataTable']);
    $this->get('/gallery/categories', ['as'   => 'gallery.categories',
                                       'uses' => 'GalleryCategoryController@index']);
    $this->get('/gallery/categories/create', ['as'   => 'gallery.categories.create',
                                              'uses' => 'GalleryCategoryController@create']);
    $this->post('/gallery/categories/store', ['as'   => 'gallery.categories.store',
                                              'uses' => 'GalleryCategoryController@store']);
    $this->get('/gallery/categories/{id}', ['as'   => 'gallery.categories.show',
                                            'uses' => 'GalleryCategoryController@show']);
    $this->get('/gallery/categories/{id}/edit', ['as'   => 'gallery.categories.edit',
                                                 'uses' => 'GalleryCategoryController@edit']);
    $this->patch('/gallery/categories/{id}/update', ['as'   => 'gallery.categories.update',
                                                     'uses' => 'GalleryCategoryController@update']);
    $this->delete('/gallery/categories/{id}', ['as'   => 'gallery.categories.destroy',
                                               'uses' => 'GalleryCategoryController@destroy']);

    $this->resource('gallery-image', 'GalleryImageController', ['except' => ['index']]);
});

/****************************************
 * Staffs module.
 * **************************************
 */
$this->group(['namespace' => 'Staff'], function () {
    $this->get('/staff/data', ['as' => 'staff.getAllForDataTable', 'uses' => 'StaffController@getAllForDataTable']);
    $this->resource('/staff', 'StaffController');
});

/****************************************
 * File Module
 * **************************************
 */
$this->group(['namespace' => 'File'], function () {
    $this->get('/file/get-all-categories', ['as'   => 'file.getAllCategories',
                                            'uses' => 'FileCategoryController@getAllCategoriesForDataTable']);
    $this->get('/file/categories', ['as'   => 'file.categories',
                                    'uses' => 'FileCategoryController@index']);
    $this->get('/file/categories/create', ['as'   => 'file.categories.create',
                                           'uses' => 'FileCategoryController@create']);
    $this->post('/file/categories/store', ['as'   => 'file.categories.store',
                                           'uses' => 'FileCategoryController@store']);
    $this->get('/file/categories/{id}', ['as'   => 'file.categories.show',
                                         'uses' => 'FileCategoryController@show']);
    $this->get('/file/categories/{id}/edit', ['as'   => 'file.categories.edit',
                                              'uses' => 'FileCategoryController@edit']);
    $this->patch('/file/categories/{id}/update', ['as'   => 'file.categories.update',
                                                  'uses' => 'FileCategoryController@update']);
    $this->delete('/file/categories/{id}', ['as'   => 'file.categories.destroy',
                                            'uses' => 'FileCategoryController@destroy']);

    $this->resource('uploaded-file', 'UploadedFileController', ['except' => ['index']]);

    $this->resource('news', 'NewsController');
    $this->resource('citizen-charter', 'CitizenCharterController');
    $this->resource('download', 'DownloadController');
    $this->resource('public-procurement', 'PublicProcurementController');
    $this->resource('planning-project', 'PlanningProjectController');
    $this->resource('budget-program', 'BudgetProgramController');
    $this->resource('tax-fee', 'TaxFeeController');
    $this->resource('law-regulation', 'LawRegulationController', ['except' => ['show']]);
    $this->resource('ward-profile', 'WardProfileController', ['except' => ['show']]);
    $this->resource('report', 'ReportController', ['except' => ['show']]);
});


/****************************************
 * Contact us info module.
 * **************************************
 */
$this->group(['namespace' => 'ContactUsInfo'], function () {
    $this->get('/contact-us-info/edit', ['as'   => 'contact-us-info.edit',
                                         'uses' => 'ContactUsInfoController@edit']);
    $this->patch('/contact-us-info/update', ['as'   => 'contact-us-info.update',
                                             'uses' => 'ContactUsInfoController@update']);
});

/****************************************
 * Push Notification module
 * **************************************
 */
$this->group(['namespace' => 'PushNotification'], function () {
    $this->resource('push-notification', 'PushNotificationController', ['only' => ['create', 'store']]);
});

/****************************************
 * Important Contact Module
 * **************************************
 */
$this->group(['namespace' => 'ImportantContact'], function () {
    $this->get('/important-contact/get-all-categories', ['as'   => 'important-contact.getAllCategories',
                                                         'uses' => 'ImportantContactCategoryController@getAllCategoriesForDataTable']);
    $this->get('/important-contact/categories', ['as'   => 'important-contact.categories',
                                                 'uses' => 'ImportantContactCategoryController@index']);
    $this->get('/important-contact/categories/create', ['as'   => 'important-contact.categories.create',
                                                        'uses' => 'ImportantContactCategoryController@create']);
    $this->post('/important-contact/categories/store', ['as'   => 'important-contact.categories.store',
                                                        'uses' => 'ImportantContactCategoryController@store']);
    $this->get('/important-contact/categories/{id}', ['as'   => 'important-contact.categories.show',
                                                      'uses' => 'ImportantContactCategoryController@show']);
    $this->get('/important-contact/categories/{id}/edit', ['as'   => 'important-contact.categories.edit',
                                                           'uses' => 'ImportantContactCategoryController@edit']);
    $this->patch('/important-contact/categories/{id}/update', ['as'   => 'important-contact.categories.update',
                                                               'uses' => 'ImportantContactCategoryController@update']);
    $this->delete('/important-contact/categories/{id}', ['as'   => 'important-contact.categories.destroy',
                                                         'uses' => 'ImportantContactCategoryController@destroy']);

    $this->resource('important-contact', 'ImportantContactController');
});
