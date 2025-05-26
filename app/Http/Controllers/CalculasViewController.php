<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BankEmployee;
use Hash;
use Session;

class CalculasViewController extends Controller
{
    public function index(){
        $check  = BankEmployee::all();
        return view('adminPanel.login',['allemployee'=>$check]);
    }
    public function registerCalculas(Request $requ){
        $data = new BankEmployee();
        $data->name         = $requ->employeeName;
        $data->email        = $requ->employeeMail;
        $data->employeeId   = $requ->loginId;
        $hashPass           = Hash::make($requ->loginPass);
        $data->password     = $hashPass;
        $data->profileType  = 1;
        if($data->save()):
            return back()->with('success','Success! Employee details saved successfully');
        else:
            return back()->with('error','Sorry! Employee details failed to save');
        endif;
    }
    public function loginCalculas(Request $requ){
        $data = BankEmployee::where(['employeeId'=>$requ->loginId])->first();
        if(isset($data)):
            $hashPass   = $data->password;
            if(Hash::check($requ->loginPass,$hashPass)):
                if($data->profileType == 1):
                    session()->put('superAdmin', $data->id);
                elseif($data->profileType == 2):
                    session()->put('generalAdmin', $data->id);
                elseif($data->profileType == 3):
                    session()->put('manager', $data->id);
                else:
                    session()->put('cashier', $data->id);
                endif;
                return redirect(route('home'));
            else:
                return back()->with('error','Sorry! Wrong password provided');
            endif;
        else:
            return back()->with('error','Sorry! Employee details not found');
        endif;
    }
    
    public function logoutCalculas(){
        session()->flush();
        session()->regenerate();
        return redirect(route('calculasLogin'))->with('error','Logout successful');
    }
}
