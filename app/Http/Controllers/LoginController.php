<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function CreateUser(Request $request)
    {
        $email = $request->get('email');
        $password = $request->get('password');
        $name = $request->get('name');
        $previousUser = User::where('email', $email)->first();
        if ($previousUser) {
            return [
                'success' => false,
                'data' => null,
                'message' => "Email {$email} đã được sử dụng!"
            ];
        }
        $userModel = User::create(array(
            'email' => $email,
            'password' => Hash::make($password),
            'name' => $name
        ));
        if ($userModel->wasRecentlyCreated) {
            return [
                'success' => true,
                'data' => $userModel
            ];
        }
        return [
            'success' => false,
            'data' => null,
            'message' => "Have an error!"
        ];
    }

    public function Login(Request $request)
    {
        $email = $request->get('email');
        $password = $request->get('password');
        $data=[
            'email'=>$email,
            'password'=>$password,
        ];
        if(Auth::attempt($data)){
            $user = Auth::user();
            return [
                'success' => true,
                 'user' => $user
            ];
        }
            return [
                'success' => false,
            ];
        }
}
