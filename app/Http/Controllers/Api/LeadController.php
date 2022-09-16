<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Lead;

class LeadController extends Controller
{
    public function store(Request $request){
        $data = $request->all();

        //Salvo i dati nel db

        $new_lead = new Lead();
        $new_lead->fill($data);
        $new_lead->save();

        return response()->json([
            'success'=> true,
        ]);
    }
}
