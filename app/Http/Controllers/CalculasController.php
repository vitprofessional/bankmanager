<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BankCapital;

class CalculasController extends Controller
{
    public function index(){
        $dateToday  = date('Y-m-d');
        $data   = BankCapital::whereDate('created_at',$dateToday)->first();
        return view('adminPanel.home',['data'=>$data]);
    }
    
    public function editCalculas($id){
        // $capitalId  = $id;
        $dateToday  = date('Y-m-d');
        $data   = BankCapital::whereDate('created_at',$dateToday)->first();
        return view('adminPanel.home',['data'=>$data,'capitalId'=>$id]);
    }
    
    public function saveCalculas(Request $requ){
        $data = new BankCapital();
        $data->ob   = $requ->liquid;
        $data->cb   = $requ->handCash;
        if($data->save()):
            return back()->with('success','Capital details saved successfully');
        else:
            return back()->with('error','Sorry! There was an error. Please try later');
        endif;            
    }
    
    public function updateCalculas(Request $requ){
        $data               = BankCapital::find($requ->capitalId);
        $data->ob           = $requ->liquid;
        $data->cb           = $requ->handCash;
        $data->lastBalance  = $requ->lastBalance;
        if($data->save()):
            return back()->with('success','Capital details update successfully');
        else:
            return back()->with('error','Sorry! There was an error. Please try later');
        endif;            
    }
    
    public function debitCredit(){
        return view('adminPanel.debitCredit');
    }
}
