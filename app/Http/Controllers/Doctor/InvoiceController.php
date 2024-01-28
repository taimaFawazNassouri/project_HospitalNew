<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\doctor_dashboard\InvoicesRepositoryInterface;


class InvoiceController extends Controller
{
    private $InvoiceRepository;
  
    public function __construct(InvoicesRepositoryInterface $InvoiceRepository)
    {
        $this->Invoice = $InvoiceRepository;
    }  
    public function index()
    {
        return $this->Invoice->index();
    }
    public function review_invoices()
    {
        return $this->Invoice->review_invoices();
    }
    public function completed_invoices()
    {
        return $this->Invoice->completed_invoices();
    }

    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        //
    }

    
    public function show(string $id)
    {
        //
    }

    
    public function edit(string $id)
    {
        //
    }

   
    public function update(Request $request, string $id)
    {
        //
    }

   
    public function destroy(string $id)
    {
        //
    }
}
