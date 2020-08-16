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
    Route::delete('/brands/delete/{id}', ['uses' => 'Procurement\BrandController@delete'])->name('brands.delete');


    Route::get('/purchasemethods', ['uses' => 'Procurement\PurchaseMethodController@index'])->name('purchasemethods.index');
    Route::get('/purchasemethods/create/{type?}/{id?}', ['uses' => 'Procurement\PurchaseMethodController@create'])->name('purchasemethods.create');
    Route::post('/purchasemethods/store', ['uses' => 'Procurement\PurchaseMethodController@store'])->name('purchases.store');
    Route::get('/purchasemethods/{id}/edit', ['uses' => 'Procurement\PurchaseMethodController@edit'])->name('purchasemethods.edit');
    Route::post('/purchasemethods/update', ['uses' => 'Procurement\PurchaseMethodController@update'])->name('purchasemethods.update');
    Route::delete('/purchasemethods/delete/{id}', ['uses' => 'Procurement\PurchaseMethodController@delete'])->name('purchasemethods.delete');

    Route::get('/items/groups', ['uses' => 'Procurement\ItemGroupsController@index'])->name('items.groups.index');
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


    Route::get('/items', ['uses' => 'Procurement\ItemController@index'])->name('items.index');
    Route::get('/items/create/{type?}/{id?}', ['uses' => 'Procurement\ItemController@create'])->name('items.create');
    Route::post('/items/store', ['uses' => 'Procurement\ItemController@store'])->name('items.store');
    Route::get('/items/{id}/edit', ['uses' => 'Procurement\ItemController@edit'])->name('items.edit');
    Route::post('/items/update', ['uses' => 'Procurement\ItemController@update'])->name('items.update');
    Route::delete('/items/delete/{id}', ['uses' => 'Procurement\ItemController@delete'])->name('items.delete');

    Route::get('/screen', ['uses' => 'Procurement\ItemController@screensetting'])->name('screen.index');


    Route::get('/vendors', ['uses' => 'Vendor\VendorController@index'])->name('vendors.index');
    Route::get('/vendors/create/{type?}/{id?}', ['uses' => 'Vendor\VendorController@create'])->name('vendors.create');
    Route::post('/vendors/store', ['uses' => 'Vendor\VendorController@store'])->name('vendors.store');
    Route::get('/vendors/{id}/edit', ['uses' => 'Vendor\VendorController@edit'])->name('vendors.edit');
    Route::post('/vendors/update', ['uses' => 'Vendor\VendorController@update'])->name('vendors.update');
    Route::delete('/vendors/delete/{id}', ['uses' => 'Vendor\VendorController@delete'])->name('vendors.delete');
    Route::delete('/vendors/delete1/{id}', ['uses' => 'Vendor\VendorController@deleteContact'])->name('vendors.deleteContact');

    Route::get('/city/by/{id}', ['uses' => 'Vendor\VendorController@getCity'])->name('city.by.id');
    Route::get('/city/by/state/{id}', ['uses' => 'Vendor\VendorController@getCityByState'])->name('city.by.state.id');
    Route::get('/state/by/country/{id}', ['uses' => 'Vendor\VendorController@getStateByCountry'])->name('state.by.country.id');


    //Route::get('/vendors/query', ['uses' => 'Vendor\VendorQueryController@index'])->name('vendorsquery.index');


    //////////////////////////////////////////////////////////////////////////////
    Route::get('/vendors/report', ['uses' => 'Vendor\VendorQueryController@reportVendors'])->name('vendors.report');
    Route::get('/vendors/report/search', ['uses' => 'Vendor\VendorQueryController@search'])->name('vendors.search');
    Route::get('/vendors/report/reportExportExcel', ['uses' => 'Vendor\VendorQueryController@reportExportExcel'])->name('vendors.reportExportExcel');
    Route::get('/vendors/report/btnReportPDF', ['uses' => 'Vendor\VendorQueryController@reportExportPDF'])->name('vendors.btnReportPDF');


    Route::get('/donors/project/report/search', ['uses' => 'Project\DonorController@search'])->name('donors.project.search');
    Route::get('reports/prepare/{id?}', ['uses' => 'Report\ReportController@prepare'])->name('reports.prepare');
    Route::get('/donors/project/report/btnReportPDF', ['uses' => 'Project\DonorController@reportExportPDF'])->name('donors.project.btnReportPDF');
    Route::get('/donors/project/report/reportExportExcel', ['uses' => 'Project\DonorController@reportExportExcel'])->name('donors.project.reportExportExcel');
    Route::get('reports/{id}/getData', ['uses' => 'Report\ReportController@getReportData'])->name('reports.getData');
    Route::get('reports/updatemaster', ['uses' => 'Report\ReportController@updateMasterUser'])->name('reports.updateMaster');
    Route::get('reports/updatedetailuser', ['uses' => 'Report\ReportController@updateDetailUser'])->name('reports.customize');


    Route::get('/plans/{type?}/{project_id?}/{activity_id?}', ['uses' => 'Procurement\ProcurementPlanController@index'])->name('plans.index');
    Route::get('/plans/project', ['uses' => 'Procurement\ProcurementPlanController@projectplan'])->name('plans.project');
    Route::get('/search/{id}', ['uses' => 'Procurement\ProcurementPlanController@search'])->name('search.id');
    Route::get('/searchAct/{id}/{project}', ['uses' => 'Procurement\ProcurementPlanController@searchAct'])->name('searchAct.id');
    Route::post('/plans/store/{project_id}/{activity_id?}', ['uses' => 'Procurement\ProcurementPlanController@store'])->name('plans.store');
    Route::get('/projectPlan/{id}', ['uses' => 'Procurement\ProcurementPlanController@getProjectPlan'])->name('projectplan.id');
    Route::get('/projectactivity/{project_id}/{activity_id?}', ['uses' => 'Procurement\ProcurementPlanController@getProjectActivityPlan'])->name('plans.activityproject');
    Route::get('/getrelation/{sector}/{service}/{item}/{purchase}', ['uses' => 'Procurement\ProcurementPlanController@getReletionsName'])->name('plans.relationname');
    Route::get('/currency/{id}', ['uses' => 'Procurement\ProcurementPlanController@getCurrency'])->name('currency.id');
    Route::delete('/plans/delete/{id}', ['uses' => 'Procurement\ProcurementPlanController@delete'])->name('plans.delete');
    Route::post('/plans/update/{project_id}/{activity_id?}', ['uses' => 'Procurement\ProcurementPlanController@update'])->name('plans.update');
    Route::get('/plans/export/{export_id}/{project_id}/{activity_id?}/{act?}/{screentype?}', ['uses' => 'Procurement\ProcurementPlanController@export'])->name('plans.export');
    Route::get('/service/by/sector/{id}', ['uses' => 'Procurement\ProcurementPlanController@getServiceBySector'])->name('service.by.sector.id');
    Route::get('/itemgroup/by/sector/{id}', ['uses' => 'Procurement\ProcurementPlanController@getItemGroupBySector'])->name('itemgroup.by.sector.id');
    Route::get('/searchmodal/{id}', ['uses' => 'Procurement\ProcurementPlanController@searchModal'])->name('searchmodal.id');
    Route::get('/tabs', ['uses' => 'Procurement\ProcurementPlanController@tabs'])->name('plans.tabs');
    Route::get('/layout', ['uses' => 'Procurement\ProcurementPlanController@layout'])->name('plans.layout');
    Route::get('/sidebar', ['uses' => 'Procurement\ProcurementPlanController@sidebar'])->name('plans.sidebar');
    Route::get('/tabs2', ['uses' => 'Procurement\ProcurementPlanController@tabs2'])->name('plans.tabs2');
    Route::get('/screen2', ['uses' => 'Procurement\ProcurementPlanController@screen2'])->name('plans.screen2');

    //////////////////////settings screen start/////////////////////////

    Route::get('settings/cities', ['uses' => 'Setting\C\CityController@index', 'as' => 'settings.cities']);
    Route::get('settings/cities/create', ['uses' => 'Setting\C\CityController@getCreate', 'as' => 'settings.cities.create']);
    Route::post('settings/cities/store', ['uses' => 'Setting\C\CityController@store', 'as' => 'settings.cities.store']);
    Route::get('settings/cities/{id}/edit', ['uses' => 'Setting\C\CityController@getEdit', 'as' => 'settings.cities.edit']);
    Route::post('settings/cities/update', ['uses' => 'Setting\C\CityController@update', 'as' => 'settings.cities.update']);
    Route::delete('settings/cities/delete/{id}', ['uses' => 'Setting\C\CityController@delete', 'as' => 'settings.cities.delete']);


    Route::get('settings/currency', ['uses' => 'Setting\C\CurrencyController@index', 'as' => 'settings.currency']);
    Route::get('settings/currency/create', ['uses' => 'Setting\C\CurrencyController@getCreate', 'as' => 'settings.currency.create']);
    Route::post('settings/currency/store', ['uses' => 'Setting\C\CurrencyController@store', 'as' => 'settings.currency.store']);
    Route::get('settings/currency/{id}/edit', ['uses' => 'Setting\C\CurrencyController@getEdit', 'as' => 'settings.currency.edit']);
    Route::post('settings/currency/update', ['uses' => 'Setting\C\CurrencyController@update', 'as' => 'settings.currency.update']);
    Route::delete('settings/currency/delete/{id}', ['uses' => 'Setting\C\CurrencyController@delete', 'as' => 'settings.currency.delete']);


    Route::get('settings/attachment_types', ['uses' => 'Setting\C\AttachmentTypesController@index', 'as' => 'settings.attachment_types']);
    Route::get('settings/attachment_types/create', ['uses' => 'Setting\C\AttachmentTypesController@getCreate', 'as' => 'settings.attachment_types.create']);
    Route::post('settings/attachment_types/store', ['uses' => 'Setting\C\AttachmentTypesController@store', 'as' => 'settings.attachment_types.store']);
    Route::get('settings/attachment_types/{id}/edit', ['uses' => 'Setting\C\AttachmentTypesController@getEdit', 'as' => 'settings.attachment_types.edit']);
    Route::post('settings/attachment_types/update', ['uses' => 'Setting\C\AttachmentTypesController@update', 'as' => 'settings.attachment_types.update']);
    Route::delete('settings/attachment_types/delete/{id}', ['uses' => 'Setting\C\AttachmentTypesController@delete', 'as' => 'settings.attachment_types.delete']);



    Route::get('strategic/index', ['uses' => 'Strategic\StrategicPlanController@index', 'as' => 'strategic.index']);
    Route::get('strategic/create', ['uses' => 'Strategic\StrategicPlanController@create', 'as' => 'strategic.create']);
    Route::post('strategic/store', ['uses' => 'Strategic\StrategicPlanController@store', 'as' => 'strategic.store']);
    Route::get('strategic/{id}/edit', ['uses' => 'Strategic\StrategicPlanController@edit', 'as' => 'strategic.edit']);
    Route::post('strategic/update', ['uses' => 'Strategic\StrategicPlanController@update', 'as' => 'strategic.update']);
    Route::delete('strategic/delete/{id}', ['uses' => 'Strategic\StrategicPlanController@delete', 'as' => 'strategic.delete']);


    Route::get('settings/districts', ['uses' => 'Setting\C\DistrictController@index', 'as' => 'settings.districts']);
    Route::get('settings/districts/create', ['uses' => 'Setting\C\DistrictController@getCreate', 'as' => 'settings.districts.create']);
    Route::post('settings/districts/store', ['uses' => 'Setting\C\DistrictController@store', 'as' => 'settings.districts.store']);
    Route::get('settings/districts/{id}/edit', ['uses' => 'Setting\C\DistrictController@getEdit', 'as' => 'settings.districts.edit']);
    Route::post('settings/districts/update', ['uses' => 'Setting\C\DistrictController@update', 'as' => 'settings.districts.update']);
    Route::delete('settings/districts/delete/{id}', ['uses' => 'Setting\C\DistrictController@delete', 'as' => 'settings.districts.delete']);

    Route::get('settings/incomeRange', ['uses' => 'Setting\IncomeRangeController@index', 'as' => 'settings.incomeRange.index']);
    Route::get('settings/incomeRange/create', ['uses' => 'Setting\IncomeRangeController@create', 'as' => 'settings.incomeRange.create']);
    Route::post('settings/incomeRange/store', ['uses' => 'Setting\IncomeRangeController@store', 'as' => 'settings.incomeRange.store']);
    Route::get('settings/incomeRange/{id}/edit', ['uses' => 'Setting\IncomeRangeController@edit', 'as' => 'settings.incomeRange.edit']);
    Route::post('settings/incomeRange/update', ['uses' => 'Setting\IncomeRangeController@update', 'as' => 'settings.incomeRange.update']);
    Route::delete('settings/incomeRange/delete/{id}', ['uses' => 'Setting\IncomeRangeController@delete', 'as' => 'settings.incomeRange.delete']);

    Route::get('settings/activity_types', ['uses' => 'Setting\C\ActivityTypeController@index', 'as' => 'settings.activity_types']);
    Route::get('settings/activity_types/create', ['uses' => 'Setting\C\ActivityTypeController@getCreate', 'as' => 'settings.activity_types.create']);
    Route::post('settings/activity_types/store', ['uses' => 'Setting\C\ActivityTypeController@store', 'as' => 'settings.activity_types.store']);
    Route::get('settings/activity_types/{id}/edit', ['uses' => 'Setting\C\ActivityTypeController@getEdit', 'as' => 'settings.activity_types.edit']);
    Route::post('settings/activity_types/update', ['uses' => 'Setting\C\ActivityTypeController@update', 'as' => 'settings.activity_types.update']);
    Route::delete('settings/activity_types/delete/{id}', ['uses' => 'Setting\C\ActivityTypeController@delete', 'as' => 'settings.activity_types.delete']);


    Route::get('settings/issues/related', ['uses' => 'Activity\LessonsRelatedController@index', 'as' => 'activity.lessons.related']);
    Route::get('settings/issues/related/create', ['uses' => 'Activity\LessonsRelatedController@getCreate', 'as' => 'activity.lessons.related.create']);
    Route::post('settings/issues/related/store', ['uses' => 'Activity\LessonsRelatedController@store', 'as' => 'activity.lessons.related.store']);
    Route::get('settings/issues/related/{id}/edit', ['uses' => 'Activity\LessonsRelatedController@getEdit', 'as' => 'activity.lessons.related.edit']);
    Route::post('settings/issues/related/update', ['uses' => 'Activity\LessonsRelatedController@update', 'as' => 'activity.lessons.related.update']);
    Route::delete('settings/issues/related/delete/{id}', ['uses' => 'Activity\LessonsRelatedController@delete', 'as' => 'activity.lessons.related.delete']);

    Route::get('settings/issues/type', ['uses' => 'Activity\LessonsTypeController@index', 'as' => 'activity.lessons.type']);
    Route::get('settings/issues/type/create', ['uses' => 'Activity\LessonsTypeController@getCreate', 'as' => 'activity.lessons.type.create']);
    Route::post('settings/issues/type/store', ['uses' => 'Activity\LessonsTypeController@store', 'as' => 'activity.lessons.type.store']);
    Route::get('settings/issues/type/{id}/edit', ['uses' => 'Activity\LessonsTypeController@getEdit', 'as' => 'activity.lessons.type.edit']);
    Route::post('settings/issues/type/update', ['uses' => 'Activity\LessonsTypeController@update', 'as' => 'activity.lessons.type.update']);
    Route::delete('settings/issues/type/delete/{id}', ['uses' => 'Activity\LessonsTypeController@delete', 'as' => 'activity.lessons.type.delete']);


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

    Route::get('/labelsSettings', ['uses' => 'Setting\LabelSettingController@index'])->name('labelsSettings.index');
    Route::post('/labelsSettings', ['uses' => 'Setting\LabelSettingController@index'])->name('labelsSettings.index');

    Route::get('settings/achievement/type', ['uses' => 'Setting\AchievementTypesController@index', 'as' => 'settings.achievement.type']);
    Route::get('settings/achievement/type/create', ['uses' => 'Setting\AchievementTypesController@create', 'as' => 'settings.achievement.type.create']);
    Route::post('settings/achievement/type/store', ['uses' => 'Setting\AchievementTypesController@store', 'as' => 'settings.achievement.type.store']);
    Route::get('settings/achievement/type/{id}/edit', ['uses' => 'Setting\AchievementTypesController@edit', 'as' => 'settings.achievement.type.edit']);
    Route::post('settings/achievement/type/update/{id}', ['uses' => 'Setting\AchievementTypesController@update', 'as' => 'settings.achievement.type.update']);
    Route::delete('settings/achievement/type/delete/{id}', ['uses' => 'Setting\AchievementTypesController@delete', 'as' => 'settings.achievement.type.delete']);
    Route::delete('settings/achievement/metric/delete/{id}', ['uses' => 'Setting\AchievementTypesController@deleteAchievement', 'as' => 'settings.achievement.metric.delete']);




    Route::get('jobtitle/index', ['uses' => 'Project\JobTitleController@index'])->name('project.jobtitle.index');
    Route::get('jobtitle/create', ['uses' => 'Project\JobTitleController@create'])->name('project.jobtitle.create');
    Route::post('/jobtitle/store', ['uses' => 'Project\JobTitleController@store'])->name('project.jobtitle.store');
    Route::get('jobtitle/{id}/edit', ['uses' => 'Project\JobTitleController@edit'])->name('project.jobtitle.edit');
    Route::PUT('/jobtitle/update', ['uses' => 'Project\JobTitleController@update'])->name('project.jobtitle.update');
    Route::DELETE('/jobtitle/{id}', ['uses' => 'Project\JobTitleController@destroy'])->name('project.jobtitle.destroy');

    Route::get('staff/index', ['uses' => 'Project\StaffController@index'])->name('project.staff.index');
    Route::get('staff/create', ['uses' => 'Project\StaffController@create'])->name('project.staff.create');
    Route::post('/staff/store', ['uses' => 'Project\StaffController@store'])->name('project.staff.store');
    Route::get('staff/{id}/edit', ['uses' => 'Project\StaffController@edit'])->name('project.staff.edit');
    Route::PATCH('/staff/update', ['uses' => 'Project\StaffController@update'])->name('project.staff.update');
    Route::DELETE('/staff/{id}', ['uses' => 'Project\StaffController@destroy'])->name('project.staff.destroy');
    Route::get('staff/{id}', ['uses' => 'Project\StaffController@show'])->name('project.staff.show');


    Route::get('projectcategories/index', ['uses' => 'Project\ProjectCategoryController@index'])->name('project.projectcategories.index');
    Route::get('projectcategories/create', ['uses' => 'Project\ProjectCategoryController@create'])->name('project.projectcategories.create');
    Route::post('/projectcategories/store', ['uses' => 'Project\ProjectCategoryController@store'])->name('project.projectcategories.store');
    Route::get('projectcategories/{id}/edit', ['uses' => 'Project\ProjectCategoryController@edit'])->name('project.projectcategories.edit');
    Route::PATCH('/projectcategories/update', ['uses' => 'Project\ProjectCategoryController@update'])->name('project.projectcategories.update');
    Route::DELETE('/projectcategories/{id}', ['uses' => 'Project\ProjectCategoryController@destroy'])->name('project.projectcategories.destroy');

    Route::get('donors/types/index', ['uses' => 'Project\DonorTypeController@index'])->name('project.donors.types.index');
    Route::get('donors/types/create', ['uses' => 'Project\DonorTypeController@create'])->name('project.donors.types.create');
    Route::post('/donors/types/store', ['uses' => 'Project\DonorTypeController@store'])->name('project.donors.types.store');
    Route::get('donors/types/{id}/edit', ['uses' => 'Project\DonorTypeController@edit'])->name('project.donors.types.edit');
    Route::put('/donors/types/update', ['uses' => 'Project\DonorTypeController@update'])->name('project.donors.types.update');
    Route::DELETE('/donors/types/{id}', ['uses' => 'Project\DonorTypeController@destroy'])->name('project.donors.types.destroy');
    Route::get('/donors/types/desc/{id?}', ['uses' => 'Project\DonorTypeController@getDesc'])->name('project.donors.types.desc');

    //////////////////////settings screen end/////////////////////////

});

