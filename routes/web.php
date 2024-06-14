<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\myMiddleware;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware(myMiddleware::class);

// Invoices Routes

Route::get('/show_invoices', 'InvoiceController@show_invoices')->name('show_invoices');
Route::get('/add_invoice', 'InvoiceController@add_invoice')->name('add_invoice');
Route::post('/store_invoice', 'InvoiceController@store_invoice')->name('store_invoice');
Route::post('/delete_invoice', 'InvoiceController@delete_invoice')->name('delete_invoice');
Route::get('/ajaxFunc/{id}', 'InvoiceController@ajaxFunc')->name('ajaxFunc');
Route::post('/detail_invoice', 'InvoiceController@detail_invoice')->name('detail_invoice');
Route::post('/edit_invoice', 'InvoiceController@edit_invoice')->name('edit_invoice');
Route::post('/store_edit_invoice', 'InvoiceController@store_edit_invoice')->name('store_edit_invoice');
Route::post('/store_change_value_status', 'InvoiceController@store_change_value_status')->name('store_change_value_status');
Route::post('/change_value_status', 'InvoiceController@change_value_status')->name('change_value_status');
Route::post('/To_archieve', 'InvoiceController@To_archieve')->name('To_archieve');
Route::post('/From_archieve', 'InvoiceController@From_archieve')->name('From_archieve');
Route::get('/views_archieve', 'InvoiceController@views_archieve')->name('views_archieve');
Route::post('/print_invoice', 'InvoiceController@print_invoice')->name('print_invoice');


Route::get('/invoice_export', 'InvoiceController@invoice_export')->name('invoice_export');

Route::get('/show_reports', 'ReportController@show_reports')->name('show_reports');
Route::post('/number_search', 'ReportController@number_search')->name('number_search');
Route::post('/type_search', 'ReportController@type_search')->name('type_search');


Route::get('/show_customer_reports', 'ReportController@show_customer_reports')->name('show_customer_reports');
Route::post('/customer_search', 'ReportController@customer_search')->name('customer_search');
// Route::post('/type_search', 'ReportController@type_search')->name('type_search');

// Route::get('/show_ntified_invoice', 'ReportController@show_ntified_invoice')->name('show_ntified_invoice');




// Sections Routes

Route::get('/show_sections', 'SectionController@show_sections')->name('show_sections');
Route::post('/add_sections', 'SectionController@add_sections')->name('add_sections');
Route::post('/delete_section', 'SectionController@delete_section')->name('delete_section');
Route::post('/edit_sections', 'SectionController@edit_sections')->name('edit_sections');


// Products Routes

Route::get('/show_products', 'ProductController@show_products')->name('show_products');
Route::post('/add_products', 'ProductController@add_products')->name('add_products');
Route::post('/delete_product', 'ProductController@delete_product')->name('delete_product');
Route::post('/edit_products', 'ProductController@edit_products')->name('edit_products');

// Attachments Routes
Route::post('/show_attachment', 'InvoiceAttachmentController@show_attachment')->name('show_attachment');
Route::post('/download_attachment', 'InvoiceAttachmentController@download_attachment')->name('download_attachment');
Route::post('/delete_attachment', 'InvoiceAttachmentController@delete_attachment')->name('delete_attachment');
Route::post('/add_new_attachment', 'InvoiceAttachmentController@add_new_attachment')->name('add_new_attachment');




//Permission Routes
Route::group(['middleware' => ['auth']], function () {
    Route::resource('roles', 'RoleController');
    Route::resource('users', 'UserController');

});