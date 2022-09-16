<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Lead;
use Illuminate\Support\Facades\Validator;  //importo la classe Validator perchè essendo nel front-end devo fare una manually-creating-validator. Non posso usare la funzione di validazione usata nel backend, e js è troppo facilmente hackerabile

class LeadController extends Controller
{
    public function store(Request $request){
        // Leggo i dati inviati
        $data = $request->all();
            // Valido i dati
            $validator = Validator::make($data,[
                'name' => 'required|max:255',
                'email'=> 'required|max:255',
                'message'=> 'required|max:60000',
            ]);
            // Se la validazione fallisce
            if($validator->fails()){
            // Torno in json success => false, e ricavo gli errori
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ]);
            }

        //Salvo i dati nel db
        $new_lead = new Lead();
        $new_lead->fill($data);
        $new_lead->save();

        return response()->json([
            'success'=> true,
        ]);
    }
}
