<?php


use App\Http\Controllers\Doctor\DiagnosisController;
use App\Http\Controllers\Doctor\LaboratorieController;
use App\Http\Controllers\Doctor\RayController;
use App\Http\Controllers\Doctor\PatientDetailsController;
use App\Http\Controllers\Doctor\InvoiceController;
use App\Http\Controllers\Auth\DoctorLoginController;
use App\Livewire\Chat\CreateChat;
use App\Livewire\Chat\Main;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| doctor Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ], function () {


    //################################ dashboard doctor ########################################

    Route::get('/dashboard/doctor', function () {
        return view('Dashboard.doctor.dashboard');
    })->middleware(['auth:doctor'])->name('dashboard.doctor');
    Route::post('logout/Doctor', [DoctorLoginController::class, 'destroy'])->middleware(['auth:doctor', 'verified'])->name('logout.doctor');

    //################################ end dashboard doctor #####################################
    Route::middleware(['auth:doctor'])->group(function () {
        Livewire::setUpdateRoute(function ($handle)
        {
            return Route::post('/livewire/update', $handle);
        });
        Route::get('list/patients', CreateChat::class)->name('list.patients');
        Route::get('chat/patients', Main::class)->name('chat.patients');
  
       
       
        Route::prefix('doctor')->group(function () {
            //############################# completed_invoices route ##########################################
            Route::get('completed_invoices', [InvoiceController::class,'completed_invoices'])->name('completed_invoices');
            //############################# end invoices route ################################################

            //############################# review_invoices route ##########################################
            Route::get('review_invoices', [InvoiceController::class,'review_invoices'])->name('review_invoices');
            //############################# end invoices route #############################################

            //############################# invoices route ##########################################
            Route::resource('Invoices', InvoiceController::class);
            //############################# end invoices route ######################################


            //############################# review_invoices route ##########################################
            Route::post('add_review', [DiagnosisController::class,'add_review'])->name('add_review');
            //############################# end invoices route #############################################


            //############################# Diagnostics route ##########################################

            Route::resource('Diagnostics', DiagnosisController::class);

            //############################# end Diagnostics route ######################################


            //############################# rays route ##########################################

            Route::resource('Rays', RayController::class);

            //############################# end rays route ######################################


            //############################# Laboratories route ##########################################

            Route::resource('Laboratories', LaboratorieController::class);

            //############################# end Laboratories route ######################################


            //############################# rays route ##########################################

            Route::get('PatientDetails/{id}', [PatientDetailsController::class,'index'])->name('PatientDetails');

            //############################# end rays route ######################################
            
        
       


        });
     
       
        
        Route::get('/404', function () {
            return view('Dashboard.404');
        })->name('404');
    });
    require __DIR__ . '/auth.php';


});