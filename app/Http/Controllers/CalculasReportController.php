<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BankCapital;
use App\Models\DebitCredit;
// use 

class CalculasReportController extends Controller
{
    public function generateReport(){
        return view('adminPanel.reportGenerate');
    }
    
    public function getData(Request $requ){
        $employee_id    = $requ->employeeId;
        $cDate          = date_create($requ->reportDate);
        $dateToday      = date_format($cDate,'Y-m-d');
        
        $data   = BankCapital::whereDate('created_at',$dateToday)->where(['employee_id'=>$employee_id])->first();

        $debit  = DebitCredit::whereDate('created_at',$dateToday)->where(['employee_id'=>$employee_id])->where(['txnType'=>'Debit','employee_id'=>$employee_id])->orderBy('id','DESC')->get();

        $credit = DebitCredit::whereDate('created_at',$dateToday)->where(['txnType'=>'Credit','employee_id'=>$employee_id])->orderBy('id','DESC')->get();

        $creditTotal    = $credit->sum('amount');
        $debitTotal     = $debit->sum('amount');

        return view('adminPanel.reportGenerate',['data'=>$data,'debit'=>$debit,'credit'=>$credit,'creditTotal'=>$creditTotal,'debitTotal'=>$debitTotal,'reportDate'=>$requ->reportDate,'reportDate'=>$dateToday]);
    }
}
