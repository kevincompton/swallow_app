<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Company;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use DateTime;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

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
            'category' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
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

        if(isset($data['company_id'])) {
            $company_id = $data['company_id'];
            $wordpress_id = \App\Company::find($company_id)->wordpress_id;
        } else {

            $company = Company::create([
                'name' => $data['company'],
                'wordpress_id' => 0,
                'category' => $data['category'],
                'latitude' => 0,
                'longitude' => 0
            ]);

            $company_id = $company->id;
            $wordpress_id = 0;
        }
        return User::create([
            'name' => $data['name'],
            'company' => $data['company'],
            'category' => $data['category'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'company_id' => $company_id,
            'wordpress_id' => $wordpress_id
        ]);
    }
}
