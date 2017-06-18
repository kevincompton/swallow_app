<?php

namespace App\Http\Controllers\Auth;

use App\wpCompany;
use App\User;
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

        if(isset($data['wpid'])) {
            $wordpress_id = $data['wpid'];
        } else {

            if($data['category'] == 'edibles') {
                $company = 'company';
            } else {
                $company = 'dispensary';
            }
            
            $wpCompany = wpCompany::create([
                'post_title' => $data['company'],
                'post_type' => $company,
                'post_date' => new DateTime(),
                'post_date_gmt' => new DateTime(),
                'post_modified' => new DateTime(),
                'post_modified_gmt' => new DateTime(),
                'post_content' => '',
                'post_excerpt' => '',
                'to_ping' => '',
                'pinged' => '',
                'post_content_filtered' => ''
            ]);

            $wordpress_id = $wpCompany->id;
        }
        return User::create([
            'name' => $data['name'],
            'company' => $data['company'],
            'category' => $data['category'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'wordpress_id' => $wordpress_id
        ]);
    }
}