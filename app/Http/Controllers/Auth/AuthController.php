<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use Auth;
use Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * @return \Illuminate\View\View
     */
    public function getLogin()
    {
        return view('auth.login');
    }

    /**
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function postLogin()
    {
        $user = Request::get('username');
        $pass = Request::get('password');

        if (Auth::attempt(['username' => $user, 'password' => $pass])) {
            $role = Auth::user()->role;

            if ($role === 'contractor') {
                return redirect()->intended('contractor');
            } elseif ($role === 'administrator') {
                return redirect()->intended('administrator');
            } elseif ($role === 'developer') {
                return redirect()->intended('developer');
            }
        } else {
            return redirect()->intended('/')
                ->withErrors(['login' => 'User and password do not match.']);
        }
    }

    public function getLogout()
    {
        Auth::logout();
        return redirect()->intended('/');
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
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
