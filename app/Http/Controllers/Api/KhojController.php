<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KhojModel;
use Illuminate\Support\Facades\Auth;

class KhojController extends Controller
{
    

    // khoj api method call 
    // response with true or false value 
    public function khoj(Request $request){
        
        $request->validate([

            'input_values' => 'required',
            'search_value' => 'required',
           
        ]);

        // making string array
        $array = explode(",",$request->input_values);

        // sorting the array in descending order
        rsort($array);

        // make decending sorting array to string
        $input_values = implode(",",$array);

        $khoj = new KhojModel();

        $khoj->user_id = Auth::user()->id;
        $khoj->input_values = $input_values;

        // saving data to database
        $khoj->save();


        // searching the data with search value 
        foreach ($array as  $value) {
            
            if($value == $request->search_value){
                // if value found break the loop and return response
                $data = [
                    "status" => "success",
                    "message" => "Element Found",
                ];
                break;
            }else{
                // if value not found 
                $data = [
                    "status" => "error",
                    "message" => "Element Not Found",
                ];
            }
        }

        // return json response 
        return response()->json($data);
    }


    // get all input values from table that saved by authenticated user
    public function getAllInput(){

        // geting user id 
        $userid = Auth::user()->id;

        // geting all khojmodel where user id is authenticated user 
        $values = KhojModel::where('user_id',$userid)->get();

        // declaire a empty array
        $payloads = [
            
        ];

        // if data found
        if($values){
            foreach ($values as  $value) {

                // setting up array data dispay
               $payload = [
                   "timestamp" => $value->created_at . $value->updated_at,
                   "input_values" =>  $value->input_values,
               ];

            // pushing each payload to payloads array
            array_push($payloads , $payload);
            }

            // dispaying data
            $data = [
                "status" => "success",
                "user_id" => $userid,
                "payload" => $payloads,
            ];
        }else{
            // if data not found
            $data =[
                "status" => "error",
                "message" => "No input values found for you"
            ];
        }

        return response()->json($data);
    
    }
}
