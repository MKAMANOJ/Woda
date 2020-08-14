<?php
/****************************************
 * Authentication of the admin users.
 * **************************************
 */
$this->group(['namespace' => 'Admin\Auth'], function () {
    $this->get('/login', 'LoginController@showLoginForm')->name('login');
    $this->post('/login', 'LoginController@login')->name('admin.login');
    $this->post('/logout', 'LoginController@logout')->name('logout');
    $this->get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
    $this->post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    $this->get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
    $this->post('password/reset', 'ResetPasswordController@reset');
});