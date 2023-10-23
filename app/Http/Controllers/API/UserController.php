<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Str;

class UserController extends BaseController
{

    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function authenticate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
        ]);
 
        if ($validator->fails()) {
            return $this->sendError('Unauthorised.', ['error'=> $validator->errors()]);
        }

        if(Auth::attempt(['email' => $request->username , 'password' => $request->password])){ 
            $user = Auth::user(); 
            $success['user'] =  [
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role ?? null,
            ];
            $success['token'] =  $user->createToken('MyApp')-> accessToken; 
   
            return $this->sendSuccess($success, 'User login successfully.');
        } 
        else{ 
            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
        } 
    }

    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:25',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $data = $request->all();
        $data['role'] = 'public';
        $data['uuid'] = Str::uuid()->toString();
        $data['password'] = bcrypt($data['password']);
        $user = User::create($data);
        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['name'] =  $user->name;
   
        return $this->sendSuccess($success, 'User register successfully.');
    }
}
