<?php


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



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

Route::group(array('as' => 'admin.','prefix' => 'admin'),function(){
    Route::get('/wp-system', 'Admin\Auth\LoginController@showLoginForm')->name('login');
    Route::post('/wp-system', 'Admin\Auth\LoginController@login');
    Route::get('/logout', 'Admin\Auth\LoginController@logout')->name('logout');
});
Route::group(array('as' => 'admin.','prefix' => 'admin','middleware' => ['auth','activity_log']),function(){
    Route::any('/ckfinder/connector', '\CKSource\CKFinderBridge\Controller\CKFinderController@requestAction')->name('ckfinder_connector');
    Route::any('/ckfinder/browser', '\CKSource\CKFinderBridge\Controller\CKFinderController@browserAction')->name('ckfinder_browser');
    Route::any('/ckfinder/product-acc-connector/{id}', '\CKSource\CKFinderBridge\Controller\CKFinderController@requestAction')->name('ckfinder_connector_acc')->middleware('ckfinder');
    Route::any('/ckfinder/product-acc-browser/{id}', '\CKSource\CKFinderBridge\Controller\CKFinderController@browserAction')->name('ckfinder_browser_acc')->middleware('ckfinder');
    Route::get('/test', 'Admin\TestController@index');
    Route::resource('guest','Admin\GuestController');
    Route::get('/dashboard', 'Admin\IndexController@index')->name('index');
    Route::get('clear-cache',function(){
        \Cache::flush();
        return redirect()->back()->with('success',__('Xóa cache thành công !'));
    })->name('clear-cache');

});
