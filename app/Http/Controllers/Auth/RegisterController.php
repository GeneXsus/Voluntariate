<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


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
    protected $redirectTo = RouteServiceProvider::HOME;

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
        $validator=null;

        switch ($data['type']){
            case ('user'):
                $validator=Validator::make($data, [
                    'name' => ['required', 'string', 'max:50'],
                    'subname' => ['required', 'string', 'max:150'],
                    'descriptionEs' => ['required'],
                    'descriptionEn' => ['required'],
                    'location' => ['required', 'string', 'max:100'],
                    'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                    'password' => ['required', 'string', 'min:8', 'confirmed'],
                ]);
                break;
            case ('company'):
                $validator=Validator::make($data, [
                    'center' => ['required', 'string', 'max:150'],
                    'descriptionEs' => ['required'],
                    'descriptionEn' => ['required'],
                    'direction' => ['required'],
                    'location' => ['required', 'string', 'max:100'],
                    'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                    'password' => ['required', 'string', 'min:8', 'confirmed'],
                ]);
                break;
            default:

                $validator=null;
                break;
        }


        return $validator;
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user= null;
        info('#en el create.');
        switch ($data['type']) {
            case ('user'):
                $user = User::create([
                    'name' => $data['name'],
                    'subname' => $data['subname'],
                    'location' => $data['location'],
                    'description' => [
                        'en' => $data['descriptionEn'],
                        'es' => $data['descriptionEs']
                    ],
                    'email' => $data['email'],
                    'password' => Hash::make($data['password']),
                ]);
                $user->assignRole('user');
                if(isset($data['types'])){
                $types=[];
                foreach ($data['types'] as $type) {
                    array_push ($types,$type);
                }

                    $user->preferred()->sync($types);

                }
                break;
            case ('company'):


                $user = User::create([
                    'email' => $data['email'],
                    'center' => $data['center'],
                    'description' => [
                        'en' => $data['descriptionEn'],
                        'es' => $data['descriptionEs']
                    ],
                    'direction' => $data['direction'],

                    'location' => $data['location'],
                    'password' => Hash::make($data['password']),
                ]);


                $user->assignRole('Company');
                break;
        }


        return $user;
    }
}
