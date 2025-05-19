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
        $cDate      = date_create($requ->reportDate);
        $dateToday  = date_format($cDate,'Y-m-d');
        $data   = BankCapital::whereDate('created_at',$dateToday)->first();
        $debit = DebitCredit::whereDate('created_at',$dateToday)->where(['txnType'=>'Debit'])->orderBy('id','DESC')->get();
        $credit = DebitCredit::whereDate('created_at',$dateToday)->where(['txnType'=>'Credit'])->orderBy('id','DESC')->get();
        $creditTotal    = $credit->sum('amount');
        $debitTotal     = $debit->sum('amount');
        return view('adminPanel.reportGenerate',['data'=>$data,'debit'=>$debit,'credit'=>$credit,'creditTotal'=>$creditTotal,'debitTotal'=>$debitTotal,'reportDate'=>$requ->reportDate,'reportDate'=>$dateToday]);
    }
}
