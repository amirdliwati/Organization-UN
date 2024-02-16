<?php

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
    return view('/auth/login');
});

Auth::routes();

Route::get('/home', 'Controller@index')->name('home');
Route::get('/', 'Controller@index')->name('homeRoot');

/////////////////////////// Admin //////////////////////////////////
///////  Management Users
Route::get('/RegisterUser', 'Auth\RegisterUserController@register')->name('RgisterGet');
Route::post('/RegisterUser', 'Auth\RegisterUserController@create')->name('RegisterPost');

Route::get('/ViewUsers', 'admin\UserController@view')->name('ViewUsersGet');
Route::get('status-user','admin\UserController@StatusUser');
Route::get('/ViewLogs', 'admin\UserController@ViewLogs')->name('ViewLogsGet');

Route::post('/EditUser/{idUser}', 'admin\UserController@Edit')->name('EditUserPost');
Route::get('/EditUser/{idUser}', 'admin\UserController@Edit')->name('EditUserGet');

/////// Entry Forms
Route::get('/Scholarships', 'admin\FormsController@ViewScholarships')->name('ScholarshipsGet');
Route::get('/CreateScholarships', 'admin\FormsController@CreateScholarships')->name('CreateScholarshipsGet');
Route::post('/CreateScholarships', 'admin\FormsController@CreateScholarships')->name('CreateScholarshipsPost');

Route::get('/Aid', 'admin\FormsController@ViewAid')->name('AidGet');
Route::get('/CreateAid', 'admin\FormsController@CreateAid')->name('CreateAidGet');
Route::post('/CreateAid', 'admin\FormsController@CreateAid')->name('CreateAidPost');

/////// Management Forms
Route::get('/EditScholarshipsAid', 'admin\FormsController@EditScholarshipsAid')->name('EditScholarshipsAidGet');
Route::get('/EditScholarships/{date}/{number}', 'admin\FormsController@EditScholarships')->name('EditScholarshipsGet');
Route::post('/EditScholarships/{date}/{number}', 'admin\FormsController@EditScholarships')->name('EditScholarshipsPost');
Route::get('/EditAid/{date}/{number}', 'admin\FormsController@EditAid')->name('EditAidGet');
Route::post('/EditAid/{date}/{number}', 'admin\FormsController@EditAid')->name('EditAidPost');
Route::post('/ExportScholarships', 'admin\ExportController@ExportScholarships')->name('ExportScholarshipsPost');
Route::post('/ExportAid', 'admin\ExportController@ExportAid')->name('ExportAidPost');

/////// Management Family Books
Route::get('/ViewEditFamilyBooks', 'admin\FormsController@ViewEditFamilyBooks')->name('ViewEditFamilyBooksGet');
Route::get('/EditFamilyBooks/{idFB}', 'admin\FormsController@EditFamilyBooks')->name('EditFamilyBooksGet');
Route::post('/EditFamilyBooks/{idFB}', 'admin\FormsController@EditFamilyBooks')->name('EditFamilyBooksPost');
Route::get('delete-family-book','admin\FormsController@DeleteFamilyBook');
Route::get('/EditStatusFamilyBooks', 'admin\FormsController@EditStatusFamilyBooks')->name('EditStatusFamilyBooksGet');
Route::get('accept-family-book','admin\FormsController@AcceptFamilyBook');
Route::get('pause-family-book','admin\FormsController@PauseFamilyBook');
Route::get('reject-family-book','admin\FormsController@RejectFamilyBook');
Route::post('/NotesFamilyBook/{idFB}', 'admin\FormsController@NotesFamilyBooks')->name('NotesFamilyBooksPost');

/////// Management Visits
Route::get('/CreateVisits', 'admin\VisitsController@CreateVisit')->name('CreateVisitsGet');
Route::post('/CreateVisits', 'admin\VisitsController@CreateVisit')->name('CreateVisitsPost');
Route::get('/ViewVisits', 'admin\VisitsController@Visits')->name('ViewVisitsGet');
Route::get('delete-visit','admin\VisitsController@DeleteVisit');

/////// Reports
Route::get('/CPDRReport', 'admin\ReportsController@ViewCPDRReport')->name('CPDRReportGet');
Route::get('/CPDR/{date}/{number}', 'admin\ReportsController@CPDRReport')->name('CPDRGet');
Route::get('/Report3', 'admin\ReportsController@ViewReport3')->name('Report3Get');
Route::get('/PhoneNumber', 'admin\ReportsController@ViewPhoneNumber')->name('PhoneNumberGet');
Route::get('/FamilyBooksAS', 'admin\ReportASController@FamilyBooksAS')->name('FamilyBooksASGet');
Route::get('/ViewAid/{idFB}', 'admin\ReportASController@ViewAid')->name('ViewAidGet');
Route::get('/ViewScholarship/{idFB}', 'admin\ReportASController@ViewScholarship')->name('ViewScholarshipGet');
Route::get('delete-scholarship','admin\ReportASController@DeleteScholarship');
Route::get('delete-aid','admin\ReportASController@DeleteAid');
Route::get('/ViewScholarshipAid', 'admin\ReportASController@ViewScholarshipAid')->name('ViewScholarshipAidGet');
Route::get('/DetailsAids/{date}/{number}', 'admin\ReportASController@DetailsAids')->name('DetailsAidsAidGet');
Route::get('/DetailsScholarships/{date}/{number}', 'admin\ReportASController@DetailsScholarships')->name('DetailsScholarshipsGet');
Route::get('/RAids/{date}/{number}', 'admin\ReportASController@RAids')->name('RAidsGet');
Route::get('/RScholarships/{date}/{number}', 'admin\ReportASController@RScholarships')->name('RScholarshipsGet');

/////////////////////////// Mutual //////////////////////////////////
/////// Entry Forms
Route::get('/FamilyBooks', 'mutual\FormsController@ViewFamilyBooks')->name('FamilyBooksGet');
Route::get('/CreateFamilyBooks', 'mutual\FormsController@CreateFamilyBooks')->name('CreateFamilyBooksGet');
Route::post('/CreateFamilyBooks', 'mutual\FormsController@CreateFamilyBooks')->name('CreateFamilyBooksPost');


/////////////////////////// Users //////////////////////////////////
/////// Entry Visits
Route::get('/CreateVisit', 'user\VisitsController@CreateVisit')->name('CreateVisitGet');
Route::post('/CreateVisit', 'user\VisitsController@CreateVisit')->name('CreateVisitPost');
Route::get('/Visits', 'user\VisitsController@Visits')->name('VisitsGet');
