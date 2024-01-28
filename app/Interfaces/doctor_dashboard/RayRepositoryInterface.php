<?php

namespace App\Interfaces\doctor_dashboard;
use Illuminate\Http\Request;


interface RayRepositoryInterface {
    public function store($request);
    public function update($id,$request);
    public function destroy($id);
}