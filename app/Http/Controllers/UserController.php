<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        

        return User::all();
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

         //
         $validator = Validator::make($request->all(), [
            'name' => 'required',
            'username' => 'required|unique:users',
            'email'=>'required|unique:users', 
            'password' => 'required'
        ]);
 
        if ($validator->fails()) {
            $errorMessage = $validator->errors();
            return response()->json($errorMessage, 206);
        }

        $user = new User; 

        $user->name = $request->name; 
        $user->username = $request->username; 
        $user->password = Hash::make($request->password); 
        $user->email = $request->email; 
            
        if ($user->save()) {
             return response()->json(['message'=>'Account Created Successfully'], 201);
        }

        

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id); 

        if ($user) {
            return $user; 
        }else{
            return response()->json(["message"=>"User not found"], 404);
        }
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
        $user = User::find($id); 

        if ($user !== NULL) {
            $user->delete();

            return response()->json(['message'=>"Account Deleted Successfully"], 200); 

        }else{
            return response()->json(["message"=>"Unable to find user"], 404);
            
        }
        
    }
}
