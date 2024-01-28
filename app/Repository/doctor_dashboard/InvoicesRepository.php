<?php


namespace App\Repository\doctor_dashboard;
use App\Interfaces\doctor_dashboard\InvoicesRepositoryInterface;
use App\Models\Invoice;
use Illuminate\Support\Facades\Auth;




class InvoicesRepository implements InvoicesRepositoryInterface{
    public function index(){
      $invoices= Invoice::where('doctor_id', Auth::user()->id)->where('invoice_status',1)->get();
      return view('Dashboard.doctor.invoices.index',compact('invoices'));
    }
    public function review_invoices(){
      $invoices = Invoice::where('doctor_id', Auth::user()->id)->where('invoice_status',2)->get();
      return view('Dashboard.doctor.invoices.review_invoices',compact('invoices'));
    }
    public function completed_invoices(){
      $invoices = Invoice::where('doctor_id', Auth::user()->id)->where('invoice_status',3)->get();
      return view('Dashboard.doctor.invoices.completed_invoices',compact('invoices'));
    }
}