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

//Route::get('/', function () {
//    return view('welcome');
//});


Auth::routes();

Route::get('/test', function () {
    config([
        'app.locale' => 'ar'
    ]);
    dd(config('app.locale'));
})->name('login.block');


Route::get('permission/user/logout', ['uses' => 'Permission\UserController@logout'])->name('permission.user.get.logout');


Route::get('permission/user/changepassword', ['uses' => 'Permission\UserController@createChangePassword'])->name('permission.user.createChangePassword');
Route::post('/permission/user/storechangepassword', ['uses' => 'Permission\UserController@storeChangePassword'])->name('permission.user.storeChangePassword');


Route::group(['middleware' => ['PasswordChangeFlag']], function () {


    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/permission/group', ['uses' => 'Permission\GroupController@index', 'as' => 'permission.group.index']);
    Route::post('/permission/group/store', ['uses' => 'Permission\GroupController@store'])->name('permission.group.store');
    Route::get('/permission/group/{id}/edit', ['uses' => 'Permission\GroupController@edit'])->name('permission.group.edit');
    Route::put('/permission/group/update/{id}', ['uses' => 'Permission\GroupController@update'])->name('permission.group.update');
    Route::get('/permission/usergroup/{user_id?}', ['uses' => 'Permission\GroupController@userGroup'])->name('permission.group.userGroup');
    Route::post('/permission/grantusergroup', ['uses' => 'Permission\GroupController@grantUserGroup'])->name('permission.group.grantUserGroup');
    Route::get('/permission/grouprow/{user_id?}', ['uses' => 'Permission\GroupController@GroupRow'])->name('permission.group.GroupRow');
    Route::get('/permission/groupforuser/{user_id?}', ['uses' => 'Permission\GroupController@groupForUser'])->name('permission.group.groupForUser');

    Route::get('permission/user/index', ['uses' => 'Permission\UserController@index'])->name('permission.user.index');
    Route::get('permission/user/create', ['uses' => 'Permission\UserController@create'])->name('permission.user.create');
    Route::post('/permission/user/store', ['uses' => 'Permission\UserController@store'])->name('permission.user.store');
    Route::get('permission/user/{id}/edit', ['uses' => 'Permission\UserController@edit'])->name('permission.user.edit');
    Route::put('/permission/user/update', ['uses' => 'Permission\UserController@update'])->name('permission.user.update');
    Route::post('permission/user/updateDataPerms', ['uses' => 'Permission\UserController@updateDataPerms'])->name('permission.user.updateDataPerms');
    Route::get('permission/user/editmyprofile', ['uses' => 'Permission\UserController@editMyProfile'])->name('permission.user.editMyProfile');
    Route::post('permission/user/updatemyprofile', ['uses' => 'Permission\UserController@updateMyProfile'])->name('permission.user.updateMyProfile');
    Route::get('permission/user/showMyProfile', ['uses' => 'Permission\UserController@showMyProfile'])->name('permission.user.showMyProfile');

    Route::post('permission/user/status', ['uses' => 'Permission\UserController@userStatus'])->name('permission.user.userstatus');
    Route::post('user/change/language', ['uses' => 'Permission\UserController@changeLang'])->name('permission.user.change.language');


    Route::get('permission/{type}/{id}', ['uses' => 'Permission\PermissionController@index'])->name('permission.permission.index');

    Route::post('permission/user/grant/', ['uses' => 'Permission\PermissionController@grantUser'])->name('permission.permission.grantUser');
    Route::post('/permission/group/grant', ['uses' => 'Permission\PermissionController@grantGroup'])->name('permission.permission.grantGroup');

    Route::get('permission/staff/ajax/{id?}', ['uses' => 'Permission\UserController@staff_ajax'])->name('permission.user.staff_ajax');

    Route::get('permission/screen/index/{module_id?}', ['uses' => 'Permission\ScreenController@index'])->name('permission.screen.index');
    Route::get('permission/screen/screenuser/{screen_id?}', ['uses' => 'Permission\ScreenController@screenUser'])->name('permission.screen.screenuser');
    Route::get('permission/screen/screencommand/{screen_id?}/{user_id?}', ['uses' => 'Permission\ScreenController@screenCommand'])->name('permission.screen.screencommand');

    Route::get('setting/label/index', ['uses' => 'Setting\LabelController@index'])->name('setting.label.index');
    Route::get('setting/label/create/{screen_id}/{lang_id}', ['uses' => 'Setting\LabelController@create'])->name('setting.label.create');
    Route::post('setting/label/store', ['uses' => 'Setting\LabelController@store'])->name('setting.label.store');
    Route::get('setting/main/label/{lang_id}', ['uses' => 'Setting\LabelController@create_labels'])->name('setting.label.create_labels');

    Route::get('setting/message/index', ['uses' => 'Setting\MessageController@index'])->name('setting.message.index');
    Route::get('setting/message/create/{id}', ['uses' => 'Setting\MessageController@create'])->name('setting.message.create');
    Route::post('setting/message/store', ['uses' => 'Setting\MessageController@store'])->name('setting.message.store');

    Route::get('settings/general', ['uses' => 'Setting\SettingController@index', 'as' => 'settings.index']);
    Route::post('settings/general/store', ['uses' => 'Setting\SettingController@update_', 'as' => 'settings.store']);
    //////////////////////////new setting screen/////////////////////////////
    Route::get('/oppsources', ['uses' => 'Setting\Opportunity\OppSourceController@index'])->name('oppsources.index');
    Route::get('/oppsources/create/{type?}/{id?}', ['uses' => 'Setting\Opportunity\OppSourceController@create'])->name('oppsources.create');
    Route::post('/oppsources/store', ['uses' => 'Setting\Opportunity\OppSourceController@store'])->name('oppsources.store');
    Route::get('/oppsources/{id}/edit', ['uses' => 'Setting\Opportunity\OppSourceController@edit'])->name('oppsources.edit');
    Route::post('/oppsources/update', ['uses' => 'Setting\Opportunity\OppSourceController@update'])->name('oppsources.update');
    Route::delete('/oppsources/delete/{id}', ['uses' => 'Setting\Opportunity\OppSourceController@delete'])->name('oppsources.delete');

    Route::get('/documents/settings', ['uses' => 'Setting\Opportunity\DocumentController@index'])->name('settings.documents.index');
    Route::get('/documents/settings/create/{type?}/{id?}', ['uses' => 'Setting\Opportunity\DocumentController@create'])->name('settings.documents.create');
    Route::post('/documents/settings/store', ['uses' => 'Setting\Opportunity\DocumentController@store'])->name('settings.documents.store');
    Route::get('/documents/settings/{interface_id}/{attach_id}/edit', ['uses' => 'Setting\Opportunity\DocumentController@edit'])->name('settings.documents.edit');
    Route::post('/documents/settings/update', ['uses' => 'Setting\Opportunity\DocumentController@update'])->name('settings.documents.update');
    Route::delete('/documents/settings/delete/{interface_id}/{attach_id}', ['uses' => 'Setting\Opportunity\DocumentController@delete'])->name('settings.documents.delete');

    Route::get('/interfaces', ['uses' => 'Setting\Opportunity\InterfaceController@index'])->name('interfaces.index');
    Route::get('/interfaces/create/{type?}/{id?}', ['uses' => 'Setting\Opportunity\InterfaceController@create'])->name('interfaces.create');
    Route::post('/interfaces/store', ['uses' => 'Setting\Opportunity\InterfaceController@store'])->name('interfaces.store');
    Route::get('/interfaces/{id}/edit', ['uses' => 'Setting\Opportunity\InterfaceController@edit'])->name('interfaces.edit');
    Route::post('/interfaces/update', ['uses' => 'Setting\Opportunity\InterfaceController@update'])->name('interfaces.update');
    Route::delete('/interfaces/delete/{id}', ['uses' => 'Setting\Opportunity\InterfaceController@delete'])->name('interfaces.delete');

    Route::get('/optstatuses', ['uses' => 'Setting\Opportunity\OppStatusController@index'])->name('optstatuses.index');
    Route::get('/optstatuses/create/{type?}/{id?}', ['uses' => 'Setting\Opportunity\OppStatusController@create'])->name('optstatuses.create');
    Route::post('/optstatuses/store', ['uses' => 'Setting\Opportunity\OppStatusController@store'])->name('optstatuses.store');
    Route::get('/optstatuses/{id}/edit', ['uses' => 'Setting\Opportunity\OppStatusController@edit'])->name('optstatuses.edit');
    Route::post('/optstatuses/update', ['uses' => 'Setting\Opportunity\OppStatusController@update'])->name('optstatuses.update');
    Route::delete('/optstatuses/delete/{id}', ['uses' => 'Setting\Opportunity\OppStatusController@delete'])->name('optstatuses.delete');


    Route::get('/sectors', ['uses' => 'Procurement\SectorController@index'])->name('sectors.index');
    Route::get('/sectors/create/{type?}/{id?}', ['uses' => 'Procurement\SectorController@create'])->name('sectors.create');
    Route::post('/sectors/store', ['uses' => 'Procurement\SectorController@store'])->name('sectors.store');
    Route::get('/sectors/{id}/edit', ['uses' => 'Procurement\SectorController@edit'])->name('sectors.edit');
    Route::post('/sectors/update', ['uses' => 'Procurement\SectorController@update'])->name('sectors.update');
    Route::delete('/sectors/delete/{id}', ['uses' => 'Procurement\SectorController@delete'])->name('sectors.delete');


    Route::get('/units', ['uses' => 'Procurement\UnitsController@index'])->name('units.index');
    Route::get('/units/create/{type?}/{id?}', ['uses' => 'Procurement\UnitsController@create'])->name('units.create');
    Route::post('/units/store', ['uses' => 'Procurement\UnitsController@store'])->name('units.store');
    Route::get('/units/{id}/edit', ['uses' => 'Procurement\UnitsController@edit'])->name('units.edit');
    Route::post('/units/update', ['uses' => 'Procurement\UnitsController@update'])->name('units.update');
    Route::delete('/units/delete/{id}', ['uses' => 'Procurement\UnitsController@delete'])->name('units.delete');



    Route::get('/brands', ['uses' => 'Procurement\BrandController@index'])->name('brands.index');
    Route::get('/brands/create/{type?}/{id?}', ['uses' => 'Procurement\BrandController@create'])->name('brands.create');
    Route::post('/brands/store', ['uses' => 'Procurement\BrandController@store'])->name('brands.store');
    Route::get('/brands/{id}/edit', ['uses' => 'Procurement\BrandController@edit'])->name('brands.edit');
    Route::post('/brands/update', ['uses' => 'Procurement\BrandController@update'])->name('brands.update');
    Route::delete('/brands/delete/{id}', ['uses' => 'Procurement\BrandsController@delete'])->name('brands.delete');


    Route::get('/purchasemethods', ['uses' => 'Procurement\PurchaseMethodController@index'])->name('purchasemethods.index');
    Route::get('/purchasemethods/create/{type?}/{id?}', ['uses' => 'Procurement\PurchaseMethodController@create'])->name('purchasemethods.create');
    Route::post('/purchasemethods/store', ['uses' => 'Procurement\PurchaseMethodController@store'])->name('purchases.store');
    Route::get('/purchasemethods/{id}/edit', ['uses' => 'Procurement\PurchaseMethodController@edit'])->name('purchasemethods.edit');
    Route::post('/purchasemethods/update', ['uses' => 'Procurement\PurchaseMethodController@update'])->name('purchasemethods.update');
    Route::delete('/purchasemethods/delete/{id}', ['uses' => 'Procurement\PurchaseMethodController@delete'])->name('purchasemethods.delete');

    Route::get('/items/groups', ['uses' => 'Procurement\ItemGroupsController@index'])->name('items.index');
    Route::get('/items/groups/create/{type?}/{id?}', ['uses' => 'Procurement\ItemGroupsController@create'])->name('item.groups.create');
    Route::post('/item/groups/store', ['uses' => 'Procurement\ItemGroupsController@store'])->name('item.groups.store');
    Route::get('/item/groups/{id}/edit', ['uses' => 'Procurement\ItemGroupsController@edit'])->name('item.groups.edit');
    Route::post('/item/groups/update', ['uses' => 'Procurement\ItemGroupsController@update'])->name('item.groups.update');
    Route::delete('/item/groups/delete/{id}', ['uses' => 'Procurement\ItemGroupsController@delete'])->name('item.groups.delete');


    Route::get('/services', ['uses' => 'Procurement\ServiceController@index'])->name('services.index');
    Route::get('/services/create/{type?}/{id?}', ['uses' => 'Procurement\ServiceController@create'])->name('services.create');
    Route::post('/services/store', ['uses' => 'Procurement\ServiceController@store'])->name('services.store');
    Route::get('/services/{id}/edit', ['uses' => 'Procurement\ServiceController@edit'])->name('services.edit');
    Route::post('/services/update', ['uses' => 'Procurement\ServiceController@update'])->name('services.update');
    Route::delete('/services/delete/{id}', ['uses' => 'Procurement\ServiceController@delete'])->name('services.delete');
});

