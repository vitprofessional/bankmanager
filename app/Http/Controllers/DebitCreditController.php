<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DebitCredit;

class DebitCreditController extends Controller
{
    public function saveDebitCredit(Request $requ){
        $employee_id = $requ->employeeId;
        $dcId = $requ->dcId;
        if(!empty($dcId)):
            $data   = DebitCredit::find($dcId);
        else:
            $data   = new DebitCredit();
        endif;
        $data->amount       = $requ->amount;  
        $data->details      = $requ->note;  
        $data->txnType      = $requ->txnType;
        $data->employee_id  = $requ->employeeId;
        if($data->save()):
            return back()->with('success','Record successfully saved');
        else:
            return back()->with('error','Record fail to save');
        endif;
    }
    
    public function editDCdata($id){
        $data = DebitCredit::find($id);
        if(isset($data)):
            return view('adminPanel.debitCredit',['data'=>$data]);
        else:
            return back()->with('error','Sorry! No data found with your query');
        endif;
    }
    
    public function delDCdata($id){
        $data = DebitCredit::find($id);
        if(isset($data)):
            $data->delete();
            return back()->with('success','Success! Data delete successful');
        else:
            return back()->with('error','Sorry! Data deletion failed');
        endif;
    }
}
