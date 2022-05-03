<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Response;
use Exception;
use App\Models\User;

class RegistrationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'password_confirmation'=>'required|string|min:6|same:password'
        ]);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @author XXX
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        try {

            //check validations
            $validator = $this->validator($request->all());

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors(), 'message' => VALID_DATA_REGISTER], 422);
            }

            $requestData = $request->all();

            $user = User::create([
                'name' => $requestData['name'],
                'email' => $requestData['email'],
                'password' => Hash::make($requestData['password'])
            ]);

            if ($user) {
                $token = $user->createToken(APP_TOKEN)->accessToken;
                return response()->json(['user' => $user, 'access_token' => $token, 'message' => REGISTER_SUCCESS], 200);
            } else {
                return response()->json(['message' => SOMETHING_ERROR], 422);
            }

        } catch (\Exception $ex) {
            return response()->json(['message' => SOMETHING_ERROR], 422);
        }
    }
}
