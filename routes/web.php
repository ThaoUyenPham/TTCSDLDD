<?php

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomesController;
use App\Http\Controllers\MapsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ListPermissionController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\SystemGeoController;
use App\Http\Controllers\TopAdsController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\ErrorsController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\IntroduceController;
use App\Http\Controllers\NativeSRSController;
// use App\Http\Controllers\DeleteController;
use App\Http\Controllers\AdsController;
use App\Http\Controllers\LocalLang;

Route::get("/",function(){
    return redirect()->route('home');
});
Route::prefix('errors')->group(function () {
    Route::get("/notfound",[ErrorsController::class,"notfound"])->name("notfound");

    Route::get("/notpermission",[ErrorsController::class,"notpermission"])->name("notpermission");
});
Route::middleware('load.category.client')->prefix('client')->group(function () {
  
    Route::get("/locale/{lang}",[LocalLang::class,"setLocale"])->name('lang');

    Route::get("/",[HomesController::class,"index"])->name("home");

    Route::prefix('map')->group(function () {

        Route::get("/map-{id?}-stnmttg.html",[MapsController::class,"map"])->name("map");

        Route::post("/map.html",[MapsController::class,"loadMapClient"])->name("load.map.client");

        Route::post("/loadmap",[MapsController::class,"loadMapCategory"])->name("loadlist.map.client");

        Route::post("/convertCORS",[NativeSRSController::class,"convertCORS"])->name("convertCORS");

        //detail map
        Route::get("/categoryMap/{id?}",[MapsController::class,"detailsCategoryMap"])->name("categoryMap.client");
    })->middleware(['role:view']);
 
    Route::prefix('contact')->group(function () {
        Route::get("/",[ContactController::class,"createContact"])->name("contact.client");
        Route::post("/save",[ContactController::class,"saveContact"])->name("save.contact.client");
    });
     
    Route::prefix('district')->group(function () {
        Route::get("/load{id?}.html",[DistrictController::class,"loadDistrictZoom"])->name("load.district.client");
    });

    Route::prefix('user')->group(function () {

        Route::get("/login",[UsersController::class,"siginClient"])->name("login")->middleware('auth.checklogin');

        Route::post("/login",[UsersController::class,"login"])->name('signAccount');

        Route::get("/logout",[UsersController::class,"logout"])->name("logout");

        Route::get("/changeaccount",[UsersController::class,"viewAccountClient"])->name("view.account.client");

        Route::get("/changepassword",[UsersController::class,"viewChangePasswordClient"])->name("view.pass.client");

        Route::put("/changeaccount",[UsersController::class,"changeAccountClient"])->name("change.account.client");

        Route::put("/changepassword",[UsersController::class,"changePasswordClient"])->name("change.password.client");

        Route::get("/get-list-permission",[UsersController::class,"getListPermission"])->name("get.listpermission.client");
        
    });
    
    Route::prefix('introduce')->group(function () {
        Route::get("/",[IntroduceController::class,"index"])->name("introduce.client");
    });
});

Route::prefix('admin')->middleware(['role:super,admin'])->group(function () {
  
    Route::prefix('home')->group(function () {

        Route::get("/",[HomesController::class,"admin"])->name("admin");
        
        Route::get('/piechart/{year?}', [HomesController::class,'pieChart'])->name('piechart.admin');// bieu do tròn

        Route::get("/columnchart",[HomesController::class,"columnChart"])->name("columnchart.admin"); // biểu đồ cột
    });
    Route::get("/loadparentcategory",[HomesController::class,"loadParentCategory"])->name('loadparentcategory');

    Route::prefix('category')->group(function () {

        Route::get("/",[CategoryController::class,"index"])->name("index.category");

        Route::get('/edit-{id}-stnmt.html', [CategoryController::class, 'editCategory'])->name('edit.category');

        Route::put('/edit-{id}-stnmt.html', [CategoryController::class, 'updateCategory'])->name('update.category');

        Route::put("/detele-{id}-stnmt.html",[CategoryController::class,"destroyCategory"])->name("delete.category");

        Route::post("/",[CategoryController::class,"loadCategory"])->name("load.category");

        Route::get("/create",[CategoryController::class,"create"])->name("create.category");

        Route::post("/create",[CategoryController::class,"saveCategory"])->name("save.category");
        
    });
    Route::prefix('systemgeo')->group(function () {

        Route::get("/",[SystemGeoController::class,"index"])->name("index.systemgeo");

        Route::get('/edit-{id}-stnmt.html', [SystemGeoController::class, 'editSystemGeo'])->name('edit.systemgeo');

        Route::put('/edit-{id}-stnmt.html', [SystemGeoController::class, 'updateSystemGeo'])->name('update.systemgeo');

        Route::put("/detele-{id}-stnmt.html",[SystemGeoController::class,"destroySystemGeo"])->name("delete.systemgeo");

        Route::post("/",[SystemGeoController::class,"loadSystemGeo"])->name("load_index.systemgeo");

        Route::post("/checksys",[SystemGeoController::class,"checkIsset"])->name("checkisset.systemgeo");

        Route::get("/create",[SystemGeoController::class,"create"])->name("create.systemgeo");

        Route::post("/create",[SystemGeoController::class,"saveSystemGeo"])->name("save.systemgeo");
        
    });
    Route::prefix('topads')->group(function () {

        Route::get("/",[TopAdsController::class,"index"])->name("index.topads");

        Route::get('/edit-{id}-stnmt.html', [TopAdsController::class, 'editTopAds'])->name('edit.topads');

        Route::put('/edit-{id}-stnmt.html', [TopAdsController::class, 'updateTopAds'])->name('update.topads');

        Route::put("/detele-{id}-stnmt.html",[TopAdsController::class,"destroyTopAds"])->name("delete.topads");

        Route::post("/",[TopAdsController::class,"loadTopAds"])->name("load_index.topads");;

        Route::get("/create",[TopAdsController::class,"createTopAds"])->name("create.topads");

        Route::post("/create",[TopAdsController::class,"saveTopAds"])->name("save.topads");
        
    });
    Route::prefix('contact')->group(function () {

        Route::get("/",[ContactController::class,"index"])->name("index.contact");

        Route::get('/edit-{id}-stnmt.html', [ContactController::class, 'infoContact'])->name('edit.contact');

        Route::put("/detele-{id}-stnmt.html",[ContactController::class,"destroyContact"])->name("delete.contact"); 

        Route::post("/loadContact",[ContactController::class,"loadContact"])->name("load.contact");
    });
    Route::prefix('nativeSRS')->group(function () {

        Route::get("/",[NativeSRSController::class,"index"])->name("index.nativesrs");

        Route::get('/edit-{id}-stnmt.html', [NativeSRSController::class, 'editNativeSRS'])->name('edit.nativesrs');
        Route::put('/edit-{id}-stnmt.html', [NativeSRSController::class, 'updateNativeSRS'])->name('update.nativesrs');
        Route::get('/create.html', [NativeSRSController::class, 'createNativeSRS'])->name('create.nativesrs');
        Route::post('/save.html', [NativeSRSController::class, 'saveNativeSRS'])->name('save.nativesrs');
       
        Route::delete("/detele-{id}-stnmt.html",[NativeSRSController::class,"destroyNativeSRS"])->name("delete.nativesrs"); 

        Route::post("/loadNativeSRS",[NativeSRSController::class,"loadNativeSRS"])->name("load.nativesrs");
    });
    Route::prefix('map')->group(function () {

        Route::post("/loadgeoserver",[MapsController::class,"loadGeoServer"])->name("loadgeoserver.map");
     
        Route::get("/",[MapsController::class,"index"])->name("index.map");

        Route::post("/",[MapsController::class,"loadMap"])->name("load.map");

        Route::get("/create",[MapsController::class,"createMap"])->name("create.map");

        Route::post("/create",[MapsController::class,"saveMap"])->name("save.map");

        Route::get('/edit-{id}-stnmt.html', [MapsController::class, 'editMap'])->name('edit.map');

        Route::post('/edit-{id}-stnmt.html', [MapsController::class, 'updateMap'])->name('update.map');

        Route::put('/detele-{id}-stnmt.html', [MapsController::class, 'destroyMap'])->name('delete.map');

        Route::put("/delete-layermap",[MapsController::class,"destroyLayerMap"])->name("delete.layermap");

        // Route::put("/test",[MapsController::class,"test"])->name("test.map");
    });
    Route::prefix('district')->group(function () {

        Route::get("/",[DistrictController::class,"indexAdmin"])->name("index.district.admin");

        Route::post("/loaddistrict",[DistrictController::class,"loadDistrictAdmin"])->name("load.district.admin");

        Route::get('/edit-{id?}-stnmt.html', [DistrictController::class, 'editDistrictAdmin'])->name('edit.district.admin');

        Route::put('/edit-{id?}-stnmt.html', [DistrictController::class, 'updateDistrict'])->name('update.district.admin');

    });
    Route::prefix('ads')->group(function () {

        Route::get("/",[AdsController::class,"index"])->name("index.ads.admin");

        Route::post("/",[AdsController::class,"loadAds"])->name("load.ads.admin");

        Route::get("/create",[AdsController::class,"create"])->name("create.ads.admin");

        Route::post("/create",[AdsController::class,"saveAds"])->name("save.ads.admin");
        
        Route::get('/edit-{id?}-stnmt.html', [AdsController::class, 'editAds'])->name('edit.ads.admin');

        Route::post('/edit-{id?}-stnmt.html', [AdsController::class, 'updateAds'])->name('update.ads.admin');

        Route::put("/detele-{id?}-stnmt.html",[AdsController::class,"destroyAds"])->name("delete.ads.admin");
    });
});
Route::prefix('superadmin')->middleware(['role:super'])->group(function () {

    Route::prefix('permission')->group(function () {

        Route::get("/",[PermissionController::class,"index"])->name("index.permission");    

        Route::get("/create",[PermissionController::class,"createPermission"])->name("create.permission");

        Route::post("/create",[PermissionController::class,"savePermission"])->name("save.permission");

        Route::post("/loadpermission",[PermissionController::class,"loadPermission"])->name("loadAdmin.permission");

        Route::get('/edit-{id?}-stnmt.html', [PermissionController::class, 'editPermission'])->name('edit.permission');

        Route::put("/detele-{id?}-stnmt.html",[PermissionController::class,"destroyPermission"])->name("delete.permission");

        Route::put('/edit-{id?}-stnmt.html', [PermissionController::class, 'updatePermission'])->name('update.permission');

    });
    Route::prefix('user')->group(function () {

        Route::get("/",[UsersController::class,"indexAdmin"])->name("index.users");

        Route::get("/create",[UsersController::class,"createUsers"])->name("create.users");

        Route::post("/save",[UsersController::class,"saveUsers"])->name("save.users");
        
        Route::post("/load",[UsersController::class,"loadUsersAdmin"])->name("load.users");

        Route::get('/edit-{id?}-stnmt.html', [UsersController::class, 'editUsers'])->name('edit.users');

        Route::put('/edit-{id?}-stnmt.html', [UsersController::class, 'updateUsers'])->name('update.users');

        Route::put("/detele-{id?}-stnmt.html",[UsersController::class,"destroyUser"])->name("delete.users");

        // Route::post("/",[SystemGeoController::class,"loadSystemGeo"])->name("load_index.systemgeo");

        Route::post("/checkusername",[UsersController::class,"checkIsset"])->name("check.users");

        Route::put("/reset-{id?}-html5",[UsersController::class,"resetUsers"])->name("reset.users");


        Route::get("/changeaccount",[UsersController::class,"viewAccountAdmin"])->name("view.account.admin");

        Route::get("/changepassword",[UsersController::class,"viewChangePasswordAdmin"])->name("view.pass.admin");

        Route::put("/changeaccount",[UsersController::class,"changeAccountClient"])->name("change.account.admin");

        Route::put("/changepassword",[UsersController::class,"changePasswordClient"])->name("change.password.admin");
        
    });
    Route::prefix('listpermission')->group(function () {

        Route::post("/load/{id?}",[ListPermissionController::class,"loadPermissionUser"])->name("load.listpermission");

        Route::put("/delete",[ListPermissionController::class,"deletelist"])->name("delete.listpermission");

    });
});