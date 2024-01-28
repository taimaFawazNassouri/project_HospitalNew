<?php

namespace App\Interfaces\doctor_dashboard;
use Illuminate\Http\Request;


interface InvoicesRepositoryInterface {
    public function index();
    public function review_invoices();
    public function completed_invoices();

}