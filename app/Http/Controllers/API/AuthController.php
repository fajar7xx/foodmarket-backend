<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * @throws \Exception
     */
    public function login(Request $request)
    {
        try{
            $request->validate([
                'email' => 'email|required',
                'password' => 'required'
           ]);

            //mengecek credentials
            $credentials = request(['email', 'password']);
            if(!Auth::attempt($credentials)){
                return ResponseFormatter::error([
                    'message' => 'Unauthorized',
                    ], 'Authentication Failed', 500);
            }

            //jika hash tidak sesuai maakn beri error
            $user = User::where('email', $request->email)->first();
            if(!Hash::check($request->password, $user->password, [])){
                throw new \Exception('Invalid Credentials');
            }

            //jika berhasil
            $tokenResult = $user->createToken('authToken')->plainTextToken;
            return ResponseFormatter::success([
                'access_token' => $tokenResult,
                'token_type' => 'Bearer',
                'user' => $user
              ], 'Authenticated');
        }catch (\Exception $e){
            return ResponseFormatter::error([
                'message' => 'Something went wrong',
                'error' => $e
                ], 'Authentication Failed', 500);
        }
    }
}
