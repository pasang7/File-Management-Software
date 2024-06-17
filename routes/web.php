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

//Auth::routes();

Route::get('/phpinfo', function() {
    return phpinfo();
});

Route::group(['prefix' => 'system'], function ($router) {
    $router->get('login', 'Auth\SuperAdminLoginController@showLoginForm')->name('superadmin.login');
    $router->post('login', 'Auth\SuperAdminLoginController@login')->name('superadmin.login');
    $router->get('logout', 'Auth\SuperAdminLoginController@logout')->name('superadmin.logout');

});
Route::group(['middleware' => 'superadmin', 'prefix' => 'super-admin'], function ($router) {
    $router->get('/dashboard', 'SuperAdmin\Dashboard\DashboardController@index')->name('superadmin.dashboard');
    $router->get('notifications', 'SuperAdmin\Dashboard\DashboardController@allNotifications')->name('view.all-notification');
    $router->get('mark-as-read/{user_id}', 'SuperAdmin\Dashboard\DashboardController@markAsReadNotification')->name('mark.read');
    $router->get('mark-as-unread/{user_id}', 'SuperAdmin\Dashboard\DashboardController@markAsUnReadNotification')->name('mark.unread');
    /*Change Password Routes*/
    $router->get('user/change-password', ['uses' => 'SuperAdmin\User\UserController@updateCredentialForm'])->name('user.change-password-form');
    $router->post('user/change-password', ['uses' => 'SuperAdmin\User\UserController@updateCredential'])->name('user.change-password');
    /*User Routes*/
    $router->get('user/search', ['uses' => 'SuperAdmin\User\UserController@search'])->name('user.search');
    $router->resource('user','SuperAdmin\User\UserController')->except(['show']);
    $router->post('user/{id}/update', ['uses' => 'SuperAdmin\User\UserController@update'])->name('user.update');
    $router->get('user/{id}/destroy', ['uses' => 'SuperAdmin\User\UserController@destroy'])->name('user.destroy');
    /*Upload Profile Routes*/
    $router->get('user/profile-setting/{id}', ['uses' => 'SuperAdmin\User\UserController@updateProfileForm'])->name('user.profile-setting-form');
    $router->post('user/profile/{id}', ['uses' => 'SuperAdmin\User\UserController@updateProfile'])->name('user.profile.setting');

    /*Client Routes*/
    $router->get('client/search', ['uses' => 'SuperAdmin\User\ClientController@search'])->name('client.search');
    $router->resource('client','SuperAdmin\User\ClientController')->except(['show']);
//    $router->get('client-list','SuperAdmin\User\ClientController@clientIndex')->name('all.client');
    $router->post('client/{id}/update', ['uses' => 'SuperAdmin\User\ClientController@update'])->name('client.update');
    $router->get('client/{id}/destroy', ['uses' => 'SuperAdmin\User\ClientController@destroy'])->name('client.destroy');
    $router->post('client-change-password', ['uses' => 'SuperAdmin\User\ClientController@changePassword'])->name('client-change.password');
    $router->post('client-update-password', ['uses' => 'SuperAdmin\User\ClientController@updatePassword'])->name('client-update.password');
    $router->get('reset-client-password/{clientId}', ['uses' => 'SuperAdmin\User\ClientController@resetClientPassword'])->name('reset-client-password');

    /*Staff Routes*/
    $router->get('staff/search', ['uses' => 'SuperAdmin\User\StaffController@search'])->name('staff.search');
    $router->resource('staff','SuperAdmin\User\StaffController')->except(['show']);
    $router->post('staff/{id}/update', ['uses' => 'SuperAdmin\User\StaffController@update'])->name('staff.update');
    $router->get('staff/{id}/destroy', ['uses' => 'SuperAdmin\User\StaffController@destroy'])->name('staff.destroy');
    $router->post('staff-change-password', ['uses' => 'SuperAdmin\User\StaffController@changePassword'])->name('staff-change.password');
    $router->post('staff-update-password', ['uses' => 'SuperAdmin\User\StaffController@updatePassword'])->name('staff-update.password');
    $router->get('reset-staff-password/{staffId}', ['uses' => 'SuperAdmin\User\StaffController@resetStaffPassword'])->name('reset-staff-password');

    /*Folder Routes*/
    $router->get('folder', ['uses' => 'SuperAdmin\Folder\FolderController@index'])->name('folder.index');
    $router->get('folder/parent/{id}',['uses' => 'SuperAdmin\Folder\FolderController@parent'])->name('folder.parent.index');
    $router->get('folder/create/{id?}', ['uses' => 'SuperAdmin\Folder\FolderController@create'])->name('folder.create');
    $router->post('folder/store', ['uses' => 'SuperAdmin\Folder\FolderController@store'])->name('folder.store');
    $router->get('folder/{id}/edit', ['uses' => 'SuperAdmin\Folder\FolderController@edit'])->name('folder.edit');
    $router->post('folder/{id}/update', ['uses' => 'SuperAdmin\Folder\FolderController@update'])->name('folder.update');
    $router->get('folder/{id}/destroy', ['uses' => 'SuperAdmin\Folder\FolderController@destroy'])->name('folder.destroy');
    $router->get('folder/search', ['uses' => 'SuperAdmin\Folder\FolderController@search'])->name('folder.search');
    $router->get('folderByClient/{id}', ['uses' => 'SuperAdmin\Folder\FolderController@foldersByClient'])->name('folder-by-client');
    $router->get('filesByFolder/{id}', ['uses' => 'SuperAdmin\Folder\FolderController@filesByFolder'])->name('files-by-folder');

    /*File Routes*/
    $router->get('file/search', ['uses' => 'SuperAdmin\File\FileController@search'])->name('file.search');
    $router->resource('file','SuperAdmin\File\FileController')->except(['show']);
    $router->get('my-files','SuperAdmin\File\FileController@myFileIndex')->name('myfile.index');
    $router->get('subfolder/{id}/{clientId}','SuperAdmin\File\FileController@parent')->name('otherfile.parent');
    $router->get('other-files/','SuperAdmin\File\FileController@otherFileIndex')->name('otherfile.index');
    $router->get('other-files/{id}','SuperAdmin\File\FileController@otherFileList')->name('otherfile.list');
    $router->get('other-files/{clientId}/create','SuperAdmin\File\FileController@relatedClientFileCreate')->name('otherfile.create');

    $router->post('file/{id}/update', ['uses' => 'SuperAdmin\File\FileController@update'])->name('file.update');
    $router->get('file/{id}/destroy', ['uses' => 'SuperAdmin\File\FileController@destroy'])->name('file.destroy');
    $router->get('file/archive', ['uses' => 'SuperAdmin\File\FileController@archive'])->name('file.archive');
    $router->get('file/restore/{id}', ['uses' => 'SuperAdmin\File\FileController@restoreArchive'])->name('file.restore');
    $router->get('file/{id}/permanent-delete', ['uses' => 'SuperAdmin\File\FileController@deleteArchive'])->name('file.permanent.delete');
    $router->get('file-notifications/{notification_id}/{file_id}', 'SuperAdmin\File\FileController@readFile')->name('file-read-view');
    
    $router->get('file/multiple/create',['uses' => 'SuperAdmin\File\FileController@multipleFileCreate'])->name('file.multiple.create');
    $router->post('file/multiple/store',['uses' => 'SuperAdmin\File\FileController@multipleFileStore'])->name('file.multiple.store');

    /* Review */
    $router->resource('review','SuperAdmin\File\FileReviewController')->except(['show']);
    $router->get('file-review/{fileId}',['uses' => 'SuperAdmin\File\FileReviewController@reviewForm'])->name('file-review.create');
    $router->get('review-details/{fileId}',['uses' => 'SuperAdmin\File\FileReviewController@show'])->name('review.details');
    
    /*ChatRoom Routes*/
    $router->get('chatroom/search', ['uses' => 'SuperAdmin\Chatroom\ChatroomController@search'])->name('chatroom.search');
    $router->resource('chatroom','SuperAdmin\Chatroom\ChatroomController')->except(['show']);
    $router->post('chatroom/{id}/update', ['uses' => 'SuperAdmin\Chatroom\ChatroomController@update'])->name('chatroom.update');
    $router->get('chatroom/{id}/destroy', ['uses' => 'SuperAdmin\Chatroom\ChatroomController@destroy'])->name('chatroom.destroy');
    $router->get('chatroom/message/{id}', ['uses' => 'SuperAdmin\Chatroom\ChatroomController@conversation'])->name('chatroom.conversation');
    $router->post('send-chat', ['uses' => 'SuperAdmin\Chatroom\ChatroomController@sendChat'])->name('chatroom.send');

    /* Menu */
    $router->resource('nav','SuperAdmin\Menu\NavController')->except(['show']);
    $router->get('nav/parent/{id}',['uses' => 'SuperAdmin\Menu\NavController@parent'])->name('nav.parent.index');
    $router->get('nav/create/{id?}', ['uses' => 'SuperAdmin\Menu\NavController@create'])->name('nav.create');
    $router->post('nav/{id}/update', ['uses' => 'SuperAdmin\Menu\NavController@update'])->name('nav.update');
    $router->get('nav/{id}/destroy', ['uses' => 'SuperAdmin\Menu\NavController@destroy'])->name('nav.destroy');
    $router->get('nav/search', ['uses' => 'SuperAdmin\Menu\NavController@search'])->name('nav.search');
    $router->post('nav/change-type-create', ['uses' => 'SuperAdmin\Menu\NavController@ChangeTypeCreate'])->name('nav.change-type-create');
    $router->post('nav/change-type-update', ['uses' => 'SuperAdmin\Menu\NavController@ChangeTypeUpdate'])->name('nav.change-type-update');
    
   
    /*Site Settings Routes*/
    $router->get('site-setting/{id}/edit', ['uses' => 'SuperAdmin\SiteSetting\SiteSettingController@edit'])->name('site-setting.edit');
    $router->post('site-setting/{id}/update', ['uses' => 'SuperAdmin\SiteSetting\SiteSettingController@update'])->name('site-settings.update');
   
    /*Ajax Call for Status And Delete Action*/
    $router->post('change-status',['uses' => 'Api\ActionApiController@updateStatus'])->name('change.status');
    $router->post('action-delete',['uses' => 'Api\ActionApiController@deletePost'])->name('delete.post');

    /*Ajax Call for Sort table*/
    $router->post('ajax/sortable',['uses' => 'Api\SortableController@sortable'])->name('ajax.sortable');

    Route::get('/clear-cache', function() {
        Artisan::call('optimize:clear');
        Alert::success('Success !!!');
        return redirect()->route('superadmin.dashboard');
    });

    $router->get('system-logs', ['uses' => 'SuperAdmin\SiteSetting\SiteSettingController@systemLog'])->name('system.logs');

});

/*Front End Routes*/
Route::get('/', 'FrontEnd\Home\HomeController@index')->name('home.index');

Route::get('/verify/{email}/{remember_token}/{pw}', 'SuperAdmin\User\ClientController@verifyCustomer')->name('verify.customer');
