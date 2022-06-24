<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       $validate = Validator::make($request->all(), [
        'username'=>"required", 
        'password'=> 'required'
       ]);

       if ($validate->fails()) {
        
        return response()->json(['errors'=> $validate->errors()], 200);
       }else{
            // CHECK FOR USERNAME AVAILABILITY 
            $user = DB::select("SELECT * FROM users WHERE username=?", [$request->username]);
            

            
            if (!empty($user)) {
                if (password_verify($request->password, $user[0]->password)) {
                    $loggedUser = $user[0];
                    
                    $nLogged = [
                        'email'=>$loggedUser->email, 
                        'id'=>$loggedUser->id, 
                        'name'=>$loggedUser->name, 
                        'username'=>$loggedUser->username
                    ];
                    $message = [
                        'success'=>"Login Successfully", 
                        'logged_user'=> $nLogged
                        
                    ];
                    return response()->json($message, 200);
                }else{
                    return response()->json(['error'=>"Invalid Password"], 200);
                }
            }else{
                return response()->json(['error'=>"Invalid Username"], 200);

                // CHECK USER DATAILS

            }
        
           
            
       }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
