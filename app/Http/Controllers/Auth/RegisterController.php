<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\utils\ImageManger;
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
    public function redirectTo()
    {
        return route('Home.index');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(private ImageManger $imageManger){}

        public function showRegistrationForm()
    {
        return view('website.auth.register');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {

        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
'phone' => ['required','string','regex:/^01[0125][0-9]{8}$/','unique:users,phone',
],            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,svg,webp','max:2048'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
             'country_id'=>'required|exists:countries,id',
            'governrate_id'=>'required|exists:governrates,id',
            'city_id'=>'required|exists:cities,id',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @return User
     */
    protected function create(array $data)
    {
        if(isset($data['image'])){

            $data['image']=$this->imageManger->uploadSingeImage('/',$data['image'],'users');
            }
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'image'=>$data['image']?? null,
            'country_id' => $data['country_id'],

            'governrate_id' => $data['governrate_id'],
            'city_id' => $data['city_id'],
            'password' => Hash::make($data['password']),
        ]);
    }
        protected function registered()
    {
    flash()->success('Account created successfully');

    }
}
