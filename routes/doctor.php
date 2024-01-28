<?php
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Doctor\InvoiceController;
use App\Http\Controllers\Doctor\DiagnosisController;
use App\Http\Controllers\Doctor\RayController;
use App\Http\Controllers\Doctor\PatientDetailsController;
use App\Http\Controllers\Doctor\LaboratorieController;


use App\Http\Controllers\Auth\DoctorLoginController;


use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| doctor Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


 Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){



      

        //############################   Dashboard doctor #########################################
        
        Route::get('/dashboard/doctor', function () {
            return view('Dashboard.doctor.dashboard');
        })->middleware(['auth:doctor', 'verified'])->name('dashboard.user');
        Route::post('logout/Doctor', [DoctorLoginController::class, 'destroy'])->middleware(['auth:doctor', 'verified'])->name('logout.doctor');


        //############################ end Dashboard doctor #########################################


        Route::middleware(['auth:doctor'])->group(function () {

           Route::prefix('doctor')->group(function(){
               
                //##################### invoices review_invoices route #######################################################
                Route::get('review_invoices',[InvoiceController::class,'review_invoices'])->name('review_invoices');
                //##################### invoices completed_invoices route #######################################################
                Route::get('completed_invoices',[InvoiceController::class,'completed_invoices'])->name('completed_invoices');

                //##################### invoices route ###################################################
                Route::resource('invoices', InvoiceController::class);
                //#####################  end invoices route ###################################################

                //##################### invoices add_review route ###################################################
                Route::post('add_review',[DiagnosisController::class,'add_review'])->name('add_review');
               //#####################  end invoices add_review route ###################################################

                //##################### diagnosis route #######################################################
                Route::resource('Diagnostics', DiagnosisController::class);
                //##################### diagnosis route #######################################################

                //##################### rays route #######################################################
                Route::resource('Rays', RayController::class);
                //##################### rays route #######################################################

               //##################### patientdetails route ###################################################
               Route::get('PatientDetails/{id}', [PatientDetailsController::class,'index'])->name('PatientDetails');
               //##################### end patientdetails route ###################################################
               Route::resource('Laboratories', LaboratorieController::class);



               
           });
           
             
          
        });

     
        
        require __DIR__.'/auth.php';





    });
 