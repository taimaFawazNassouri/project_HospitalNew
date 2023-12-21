<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\SectionController;
use App\Http\Controllers\Dashboard\DoctorController;
use App\Http\Controllers\Dashboard\InsuranceController;
use App\Http\Controllers\Dashboard\AmbulanceController;
use App\Http\Controllers\Dashboard\PatientController;
use App\Http\Controllers\Auth\AdminController;
use App\Http\Controllers\Dashboard\SingleServiceController;
use App\Livewire\Counter;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Backend Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
 Route::get('/Dashboard_Admin', [DashboardController::class, 'index']);
 //Route::view('Add_GroupService', 'livewire.include')->middleware(['auth:admin'])->name('Add_GroupService');

 Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){



        //############################ Dashboard user #########################################
        Route::get('/dashboard/user', function () {
            return view('Dashboard.User.index');
        })->middleware(['auth', 'verified'])->name('dashboard.user');
         //############################ end Dashboard user #########################################

        //############################   Dashboard admin #########################################
        
        Route::get('/dashboard/admin', function () {
            return view('Dashboard.Admin.index');
        })->middleware(['auth:admin', 'verified'])->name('dashboard.user');
        Route::post('logout/Admin', [AdminController::class, 'destroy'])->middleware(['auth:admin', 'verified'])->name('logout_admin');

        
        //############################ end Dashboard admin #########################################
        Route::middleware(['auth:admin'])->group(function () {
          //############################ Start Sections #############################################

            Route::resource('Sections', SectionController::class);

            Route::view('Add_GroupService', 'livewire.include')->name('Add_GroupService');


            Livewire::setUpdateRoute(function ($handle) {
                return Route::post('/livewire/update', $handle);
            });
 



          

            
           
            //############################ End Sections #############################################
           //############################ Start Doctors #############################################


            Route::resource('Doctors', DoctorController::class);
            //############################ End Doctors #############################################
            
            //############################   Dashboard update password doctor #########################################
            Route::post('update_password',[DoctorController::class ,'update_password'])->name('update_password');
            Route::post('update_status',[DoctorController::class ,'update_status'])->name('update_status');

            //############################   Dashboard services #########################################
            Route::resource('Single_Service', SingleServiceController::class);
            //############################   Dashboard Group services #########################################
           //############################# insurance route ##########################################
            Route::resource('insurance', InsuranceController::class);

           //############################# end insurance route ######################################
           
           //############################# start ambulance route ######################################
           Route::resource('Ambulance', AmbulanceController::class);
           
           //############################# end ambulance route ######################################
          //############################# start patient route ######################################
          Route::resource('Patients', PatientController::class);

         //############################# end Patients route ######################################




      
        
 

      
      
          

       
        
  
   

 

    
        
    });

     
        
        require __DIR__.'/auth.php';





    });
 