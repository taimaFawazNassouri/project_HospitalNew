<?php

namespace App\Interfaces\doctor_dashboard;
use Illuminate\Http\Request;


interface DiagnosisRepositoryInterface {
    public function store($request);
    public function show($id);
    public function add_review($request);



}