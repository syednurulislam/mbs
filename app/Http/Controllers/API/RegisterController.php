<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\DBModels\User;
use App\DBModels\NotificationType;
use Illuminate\Support\Facades\Auth;
use Validator;

class RegisterController extends BaseController
{

    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['name'] =  $user->name;

        return $this->sendResponse($success, 'User register successfully.');
    }

    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $user = Auth::user();
            $success['token'] =  $user->createToken('MyApp')-> accessToken;
            $success['name'] =  $user->name;


            $obja = new \stdClass();
            $obja->token = $user->createToken('MyApp')-> accessToken;
            $obja->isLogin = true;
            $obja->user = $user;
            $obja->accountBalance = 0;


            // Token = tokenString,
            // IsLogin = true,
            // User = users.Select(o => new { o.Email, UserName = o.FirstName, o.LastName }).FirstOrDefault(),
            // AccountBalance = accountBalance


            return $this->sendResponse($obja, 'User login successfully.', NotificationType::Success);
        }
        else{
            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised'], NotificationType::Error);
        }
    }
}
