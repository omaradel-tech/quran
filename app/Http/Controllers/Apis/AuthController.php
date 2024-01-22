<?php

namespace App\Http\Controllers\Apis;

use App\Http\Requests\Apis\LoginRequest;
use App\Http\Requests\Apis\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends BaseController
{
    public function login(LoginRequest $request)
    {
        if(Auth::attempt(['email' => $request->email , 'password' => $request->password]))
        {
            $data = new UserResource(auth()->user());
            return $this->success($data );
        }else{
            return $this->error([
                'message' => 'invalid Credientials'
            ]);
        }
    }

    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email'=> $request->email,
            'password'=> $request->password,
            'gender'=> $request->gender,
            'phone'=> $request->phone,
        ]);

        $data = new UserResource($user);

        return $this->success($data);
    }

}
