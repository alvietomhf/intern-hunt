<?php

namespace App\Http\Controllers\Auth;

use App\Biography;
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
        if($data['status'] == 'siswa'){
            return Validator::make($data, [
                'name' => ['required', 'string', 'max:255'],
                'username' => ['required', 'string', 'min:5', 'max:15', 'unique:users', 'alpha_dash'],
                'address' => ['required', 'string', 'max:255'],
                'phone' => ['required', 'string', 'min:10', 'max:15'],
                'schname' => ['required', 'string', 'max:255'],
                'department' => ['required', 'string', 'max:255'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'image' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            ]);
        }
        if($data['status'] == 'guru'){
            return Validator::make($data, [
                'name' => ['required', 'string', 'max:255'],
                'username' => ['required', 'string', 'min:5', 'max:15', 'unique:users', 'alpha_dash'],
                'address' => ['required', 'string', 'max:255'],
                'phone' => ['required', 'string', 'min:10', 'max:15'],
                'schname' => ['required', 'string', 'max:255'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'image' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            ]);
        }
        if($data['status'] == 'industri'){
            return Validator::make($data, [
                'name' => ['required', 'string', 'max:255'],
                'username' => ['required', 'string', 'min:5', 'max:15', 'unique:users', 'alpha_dash'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'image' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            ]);
        }
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $input = [
            'name' => $data['name'],
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
        ];

        if($data['image']){
            $input['image'] = rand().'.'.$data['image']->getClientOriginalExtension();
            
            $data['image']->move(public_path('uploads/images/'), $input['image']);
        }

        if($data['status'] == 'siswa'){
            $input['schname'] = $data['schname'];
            $input['department'] = $data['department'];
            $input['address'] = $data['address'];
            $input['phone'] = $data['phone'];
        }

        if($data['status'] == 'guru'){
            $input['schname'] = $data['schname'];
            $input['address'] = $data['address'];
            $input['phone'] = $data['phone'];
        }

        $user = User::create($input);
        $user->assignRole($data['status']);
        if($user->hasRole('industri')){
            Biography::create([
                'user_id' => $user->id
            ]);
        }

        return $user;
    }
}
