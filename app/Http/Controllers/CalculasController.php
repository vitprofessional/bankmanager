<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BankCapital;
use App\Models\BankEmployee;
use Session;

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
        $data   = BankCapital::find($id);
        return view('adminPanel.home',['data'=>$data,'capitalId'=>$id]);
    }
    
    public function saveCalculas(Request $requ){
        $employee_id        = $requ->employeeId;

        $data = new BankCapital();
        $data->ob           = $requ->liquid;
        $data->cb           = $requ->handCash;
        $data->employee_id  = $requ->employee_id;
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
    
    public function bankEmployee(){
        if(Session::has('superAdmin')):
            $employeeType = 1;
            $employeeId = BankEmployee::find(Session::get('superAdmin'))->id;
        elseif(Session::has('generalAdmin')):
            $employeeType = 2;
            $employeeId = BankEmployee::find(Session::get('generalAdmin'))->id;
        elseif(Session::has('manager')):
            $employeeType = 3;
            $employeeId = BankEmployee::find(Session::get('manager'))->id;
        else:
            $employeeType = 4;
            $employeeId = BankEmployee::find(Session::get('cashier'))->id;
        endif;


        $profile = BankEmployee::find($employeeId);
        if($profile->profileType == 1):
            $bankEmployee = BankEmployee::orderBy('id','desc')->get();
            return view('adminPanel.createEmployee',['data'=>$bankEmployee]);
        elseif($profile->profileType == 2 || profile->profileType == 3):
            $bankEmployee = BankEmployee::where(['creator'=>$employee_id])->orderBy('id','desc')->get();
            return view('adminPanel.createEmployee',['data'=>$bankEmployee]);
        else:
            return "<div class='alert alert-info'>Sorry! you are not eligable to view this page</div>";
        endif;
    }

    public function employeeRegister(Request $requ){
        $data = new BankEmployee();
        $data->name         = $requ->employeeName;
        $data->email        = $requ->employeeMail;
        $data->employeeId   = $requ->loginId;
        $hashPass           = Hash::make($requ->loginPass);
        $data->password     = $hashPass;
        if($data->save()):
            return back()->with('success','Success! Employee details saved successfully');
        else:
            return back()->with('error','Sorry! Employee details failed to save');
        endif;
    }
}
