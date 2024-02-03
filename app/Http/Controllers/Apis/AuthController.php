<?php

namespace App\Http\Controllers\Apis;

use App\Http\Requests\Apis\LoginRequest;
use App\Http\Requests\Apis\ProfileUpdateRequest;
use App\Http\Requests\Apis\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
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
        $imagePath = null;

        if($request->hasFile('image'))
        {
            $image = $request->file('image');
            $filename = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('images'), $filename);
            $imagePath = 'images/' . $filename;
        }

        $user = User::create([
            'name' => $request->name,
            'email'=> $request->email,
            'password'=> $request->password,
            'gender'=> $request->gender,
            'phone'=> $request->phone,
            'image_path' => $imagePath
        ]);

        $data = new UserResource($user);

        return $this->success($data);
    }

    public function profile(Request $request)
    {
        $data = new UserResource(auth()->user());
        return $this->success($data);
    }

    public function updateProfile(ProfileUpdateRequest $request)
    {
        $imagePath = null;

        if($request->hasFile('image'))
        {
            $image = $request->file('image');
            $filename = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('images'), $filename);
            $imagePath = 'images/' . $filename;
        }
    /** @var \App\Models\User $user **/
        $user = auth()->user();

        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->name = $request->name;
        $user->image_path = $imagePath ?? $user->image_path;
        $user->gender = $request->gender;
        $user->save();

        $data = new UserResource($user);

        return $this->success($data, 'Updated Successfully');
    }
}
