<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Response;
use Exception;

class LoginController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => 'required|string|email',
            'password' => 'required|string|min:6'
        ]);
    }

    /**
     * Handle a login request for the application.
     * @param  Request $request [description]
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        try {

            //check validations
            $validator = $this->validator($request->all());

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors(), 'message' => VALID_DATA_REGISTER], 422);
            }

            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) { 
                $user = Auth::user(); 
                $token =  $user->createToken('MyApp')->accessToken; 
                
                return response()->json(['user' => $user, 'access_token' => $token, 'message' => LOGIN_SUCCESS], 200);
            } else { 
                return response()->json(['message' => UNAUTHORISED], 422);
            } 

        } catch (\Exception $ex) {
            return response()->json(['message' => SOMETHING_ERROR], 422);
        }
    }

    /**
     * [logout description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function logout(Request $request)
    {
        try {

            $accessToken = Auth::user()->token();
            $token = $request->user()->tokens->find($accessToken);
            $token->revoke();

            return response()->json(['message' => LOGOUT_SUCCESS], 200);

        } catch (\Exception $ex) {
            return response()->json(['message' => SOMETHING_ERROR], 422);
        }
    }
}
