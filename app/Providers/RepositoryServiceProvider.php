<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\Sections\SectionRepositoryInterface;
use App\Repository\Sections\SectionRepository;
use App\Interfaces\Doctors\DoctorRepositoryInterface;
use App\Repository\Doctors\DoctorRepository;
use App\Interfaces\Services\SingleServiceRepositoryInterface;
use App\Repository\Services\SingleServiceRepository;
use App\Interfaces\Insurances\InsuranceRepositoryInterface;
use App\Repository\Insurances\InsuranceRepository;
use App\Interfaces\Ambulances\AmbulanceRepositoryInterface;
use App\Repository\Ambulances\AmbulanceRepository;
use App\Interfaces\Patients\PatientRepositoryInterface;
use App\Repository\Patients\PatientRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(SectionRepositoryInterface::class ,SectionRepository::class);
        $this->app->bind(DoctorRepositoryInterface::class ,DoctorRepository::class);
        $this->app->bind(SingleServiceRepositoryInterface::class ,SingleServiceRepository::class);
        $this->app->bind(InsuranceRepositoryInterface::class ,InsuranceRepository::class);
        $this->app->bind(AmbulanceRepositoryInterface::class ,AmbulanceRepository::class);
        $this->app->bind(PatientRepositoryInterface::class ,PatientRepository::class);




    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
