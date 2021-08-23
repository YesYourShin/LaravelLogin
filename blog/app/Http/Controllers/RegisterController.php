<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class RegisterController extends Controller
{
    function register (Request $request) {
        
        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');

        // https://dev.jaedong.kim/register-method-of-registercontroller-in-laravel/
        // https://sung-jun.tistory.com/125
        // https://medium.com/sjk5766/laravel-http-post-%EB%A9%94%EC%86%8C%EB%93%9C-page-expired-e3f259de3139

        // $validator = $request->validate([
        //     array (
        //         'name' => ['required', 'string', 'max:255'],
        //         'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        //         'password' => ['required', 'string', 'min:8'],
        //     )
        // ]);

        $validator = Validator::make($request->all(), [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8'],
        ]);

        if ($validator->fails()){
            $messages = $validator->messages();
            return response($messages);
        }
                
        User::create([
            'name' => $name,
            'email' => $email,
            'password' => $password,
        ]);

        // dd($request);
        return response("done");
    }
}
