<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Interfaces\Doctors\DoctorRepositoryInterface;
use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Section;
use App\Models\Image;
use App\Models\Appointment;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $DoctorRepository;
  
    public function __construct(DoctorRepositoryInterface $DoctorRepository)
    {
        $this->Doctor = $DoctorRepository;
    }   
    public function index()
    {
        return $this->Doctor->index();
       
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->Doctor->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDoctorRequest $request)
    {
        return $this->Doctor->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
         return $this->Doctor->edit($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
         return $this->Doctor->update($request);
    }

    public function update_password(Request $request)
    {
        $this->validate($request, [
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6'
        ]);
        return $this->Doctor->update_password($request);

    }
    public function update_status(request $request)
    {
        $this->validate($request, [
            'status' => 'required|in:0,1',
        ]);
        return $this->Doctor->update_status($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
       return $this->Doctor->destroy($request);
    }
}
