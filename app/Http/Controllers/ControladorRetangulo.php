<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Retangulo;

class ControladorRetangulo extends Controller
{
    public function store(Request $request)
    {
        $ret = new Retangulo();
        $ret->ladoH = $request->input("ladoH");
        $ret->ladoB = $request->input("ladoB");
        $ret->save();
        return "salvo";    
    }
}
