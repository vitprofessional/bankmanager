<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServerConfiguration extends Controller
{
    public function serverConfig(){
        return view('adminPanel.configuration');
    }
}
