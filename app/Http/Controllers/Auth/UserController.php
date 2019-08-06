<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function edit(User $user)
    {
    	$user = Auth::user();

    	return view('auth.profile')->with('user', $user);
    }

    public function update(User $user, Request $request)
    {
    	$request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'about' => ['required', 'string'],
        ]);

    	$user->name = $request->input('name');
    	$user->surname = $request->input('surname');
    	$user->username = $request->input('username');
    	$user->about = $request->input('about');

    	$user->save();

    	return redirect()->back();
    }

    public function password_edit(User $user)
    {
    	$user = Auth::user();

    	return view('auth.password')->with('user', $user);
    }

    public function password_update(User $user, Request $request)
    {
    	$request->validate([
    		'password' => ['required', 'string', 'min:6', 'confirmed'],
    	]);

    	$user->password = Hash::make($request->input('password'));

    	$user->save();

    	return redirect()->back()->with('flash_message', 'Пароль успешно обновлен');
    }

}
