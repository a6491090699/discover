<?php

namespace App\Http\Controllers;

use App\Models\AdminUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum'])->except(['login']);
    }

    public function login(Request $request)
    {
        if ($a = auth()->attempt($request->only(['password', 'username']))) {
            $user =  AdminUser::where('username', $request->username)->first();
            $token = $user->createToken($user->id);
            return $this->_success(['token'=>$token->plainTextToken ,'userinfo'=>$user]);
        }
        return $this->_fail();
    }

    public function me(Request $request)
    {
        $user = $request->user();
        // dd($user->allPermissions()->toarray());
        $user->allPermissions()->first(function ($permission) use ($request) {
            return $permission->shouldPassThrough($request);
        });
        return $request->user();
    }

    public function logout(Request $request)
    {
        $user = $request->user();

        $user->tokens()->delete();
        return ['success', '成功'];
    }

    public function token(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
            'device_name' => 'required'
        ]);
    
        $user = AdminUser::where('username', $request->username)->first();
    
        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
    
        return $user->createToken($request->device_name)->plainTextToken;
    }
}
