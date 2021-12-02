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




Route::get('/', function () {
    return redirect()->route('login');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
// Route::get('/view', 'InvoiceController@view')->name('invoice.view');
Route::get('/download/invoice/{id}', 'DefaultController@downloadInvoice')->name('download-invoice-pdf');
Route::get('/download/report/{id}', 'DefaultController@downloadReport')->name('download-report-pdf');
Route::get('/get-email', 'UserController@getEmail')->name('get-email');
Route::post('/setpass', 'UserController@setNewPass')->name('set-pass');
Route::post('/set/new-pass/{id}', 'UserController@setNewPassword')->name('set-new-pass');
Route::group(['middleware'=>'islogin'], function(){


Route::prefix('users')->group(function () {

    Route::get('/view', 'UserController@view')->name('users.view');
    Route::post('/store', 'UserController@store')->name('users.store');
    Route::get('/edit/{id}', 'UserController@edit')->name('users.edit');
    Route::post('/update/{id}', 'UserController@update')->name('users.update');
    Route::get('/delete/{id}', 'UserController@delete')->name('users.delete');
    Route::get('/switch/user/{id}', 'UserController@switchUser')->name('switch-user');
    Route::post('/switch/user-login/{id}', 'UserController@switchUserLogin')->name('switch-user-login');
    Route::get('/redirect/{id}', 'UserController@RedirectToDept')->name('redirect.dept');
    Route::post('/redirect/user/{dept}', 'UserController@RedirectToDeptbyPass')->name('redirect.dept.user');
    Route::get('/redirect/recep/login', 'UserController@RedirectToRecp')->name('rept.login');
    Route::post('/redirect/recep/', 'UserController@RedirectToRecpview')->name('redirect.recep');
    Route::get('/redirect/opd/login', 'UserController@RedirectToOPD')->name('opd.login');
    Route::post('/redirect/opd/', 'UserController@RedirectToOPDview')->name('redirect.opd');
    Route::get('/redirect/opd/view', 'UserController@opdView')->name('opd.view');
    Route::post('upload/report/{id}', 'UserController@ReportUpload')->name('report_file.upload');

});

Route::prefix('depts')->group(function () {

    Route::get('/view', 'DeptController@view')->name('depts.view');
    Route::post('/store', 'DeptController@store')->name('depts.store');
    Route::get('/edit/{id}', 'DeptController@edit')->name('depts.edit');
    Route::post('/update/{id}', 'DeptController@update')->name('depts.update');
    Route::get('/delete/{id}', 'DeptController@delete')->name('depts.delete');
    Route::get('/view/single/dept/{id}','DeptController@DeptView')->name('dept_single.view');
});

Route::prefix('doctors')->group(function () {

    Route::get('/view', 'DoctorController@view')->name('doctors.view');
    Route::post('/store', 'DoctorController@store')->name('doctors.store');
    Route::get('/edit/{id}', 'DoctorController@edit')->name('doctors.edit');
    Route::post('/update/{id}', 'DoctorController@update')->name('doctors.update');
    Route::get('/delete/{id}', 'DoctorController@delete')->name('doctors.delete');
});

Route::prefix('schedules')->group(function () {

    Route::get('/view', 'ScheduleController@view')->name('schedules.view');
    Route::post('/store', 'ScheduleController@store')->name('schedules.store');
    Route::get('/edit/{id}', 'ScheduleController@edit')->name('schedules.edit');
    Route::post('/update/{id}', 'ScheduleController@update')->name('schedules.update');
    Route::get('/delete/{id}', 'ScheduleController@delete')->name('schedules.delete');
});

Route::prefix('testtypes')->group(function () {

    Route::get('/view', 'TesttypeController@view')->name('testtypes.view');
    Route::post('/store', 'TesttypeController@store')->name('testtypes.store');
    Route::get('/edit/{id}', 'TesttypeController@edit')->name('testtypes.edit');
    Route::post('/update/{id}', 'TesttypeController@update')->name('testtypes.update');
    Route::get('/delete/{id}', 'TesttypeController@delete')->name('testtypes.delete');
});



Route::prefix('tests')->group(function () {

    Route::get('/view', 'TestController@view')->name('tests.view');
    Route::get('/add', 'TestController@add')->name('tests.add');
    Route::post('/store', 'TestController@store')->name('tests.store');
    Route::get('/edit/{id}', 'TestController@edit')->name('tests.edit');
    Route::post('/update/{id}', 'TestController@update')->name('tests.update');
    Route::get('/delete/{id}', 'TestController@delete')->name('tests.delete');
    Route::get('/print/list', 'TestController@printTestListPdf')->name('test.print.list');
    
});


Route::prefix('customers')->group(function(){
    
    Route::get('/view', 'CustomerController@view')->name('customers.view');
    Route::get('/add', 'CustomerController@add')->name('customers.add');
    Route::post('/store', 'CustomerController@store')->name('customers.store');
    Route::get('/edit/{id}', 'CustomerController@edit')->name('customers.edit');
    Route::post('/update/{id}', 'CustomerController@update')->name('customers.update');
    Route::get('/delete/{id}', 'CustomerController@delete')->name('customers.delete');
    Route::get('/credit', 'CustomerController@Creditcustomer')->name('customers.credit');
    Route::get('/credit/pdf', 'CustomerController@CreditcustomerPdf')->name('customers.credit.pdf');
    Route::get('/invoice/edit/{invoice_id}', 'CustomerController@editInvoice')->name('customers.edit.invoice');
    Route::post('/invoice/update/{invoice_id}', 'CustomerController@updateInvoice')->name('customers.update.invoice');
    Route::get('/invoice/details/pdf/{invoice_id}', 'CustomerController@invoiceDetailsPdf')->name('invoice.details.pdf');
    Route::get('/paid', 'CustomerController@paidCustomer')->name('customers.paid');
    Route::get('/paid/pdf', 'CustomerController@PaidcustomerPdf')->name('customers.paid.pdf');
 

});

Route::prefix('invoice')->group(function(){
    
    Route::get('/view', 'InvoiceController@view')->name('invoice.view');
    Route::get('/add', 'InvoiceController@add')->name('invoice.add');
    Route::post('/store', 'InvoiceController@store')->name('invoice.store');
    Route::post('/approve/invoice/{id}', 'InvoiceController@approval')->name('invoice.approval');
    Route::get('/pending', 'InvoiceController@pendingList')->name('invoice.pending.list');
    Route::get('/delete/{id}', 'InvoiceController@delete')->name('invoice.delete');
    Route::get('/print/list', 'InvoiceController@printInvoiceListPdf')->name('invoice.print.list');
    Route::get('/print/{id}', 'InvoiceController@printInvoice')->name('invoice.print');
    Route::get('/daily/report', 'InvoiceController@dailyReport')->name('invoice.daily.report');
    Route::post('/update/reportstatus/{id}', 'InvoiceController@updateReportStatus')->name('invoice.update.report');
    Route::post('/send/pending/{id}', 'InvoiceController@sendToPending')->name('send-to-pending');
    Route::get('/daily/report/pdf', 'InvoiceController@dailyReportPdf')->name('invoice.daily.report.pdf');
    Route::get('/monthly/report/pdf', 'InvoiceController@monthlyReportPdf')->name('invoice.monthly.report.pdf');
    Route::get('/invoice-details/edit/{id}', 'InvoiceController@editInvoice')->name('invoice.edit');
    Route::post('/invoice-details/update/{id}', 'InvoiceController@updateInvoice')->name('invoice.update');
    Route::get('/invoice-details/delete/{id}', 'InvoiceController@deleteInvoiceDetails')->name('invoice-details.delete');
    Route::post('/add-more/invoice/{id}', 'InvoiceController@addmoreInvoice')->name('add-more-invoice');
    Route::get('/view-report/{id}', 'InvoiceController@reportView')->name('view-report');
    Route::get('/report/view/{id}', 'InvoiceController@reportgView')->name('report-view');
    Route::post('/store-report/{id}', 'InvoiceController@reportStore')->name('store-report');
    Route::get('/edit-report/{id}', 'InvoiceController@reportEdit')->name('edit-report');
    Route::post('/update-report/{id}', 'InvoiceController@reportUpdate')->name('update-report');
    Route::get('/delete-generated-report/{id}', 'InvoiceController@reportGdelete')->name('delete-generated-report');
    Route::get('/delete-report/{id}', 'InvoiceController@reportDelete')->name('delete-report');
    Route::get('/report/pdf/{id}', 'InvoiceController@reportPdf')->name('report-pdf');
    
});


Route::prefix('profiles')->group(function(){
    
    Route::get('/view', 'ProfileController@view')->name('profiles.view');
    Route::get('/add', 'ProfileController@add')->name('profiles.add');
    Route::post('/store', 'ProfileController@store')->name('profiles.store');
    Route::get('/edit', 'ProfileController@edit')->name('profiles.edit');
    Route::post('/update/{id}', 'ProfileController@update')->name('profiles.update');
    Route::get('/delete/{id}', 'ProfileController@delete')->name('profiles.delete');
    Route::get('/password/view', 'ProfileController@passwordView')->name('profiles.password.view');
    Route::post('/password/update', 'ProfileController@passwordUpdate')->name('profiles.password.update');

}); 

Route::prefix('reports')->group(function(){
    
    Route::get('/view', 'ReportController@view')->name('reports.view');
    Route::get('/add', 'ReportController@add')->name('reports.add');
    Route::post('/store', 'ReportController@store')->name('reports.store');
    Route::get('/edit', 'ReportController@edit')->name('reports.edit');
    Route::post('/update/{id}', 'ReportController@update')->name('reports.update');
    Route::get('/delete/{id}', 'ReportController@delete')->name('reports.delete');
   

});


Route::get('/get-price', 'DefaultController@getPrice')->name('get-price');

});