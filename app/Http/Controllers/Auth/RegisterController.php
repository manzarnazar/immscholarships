<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Refferals;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\Settings;
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
    protected $redirectTo = '/dashboard/home';

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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'whatsappNumber' => ['required', 'string','max:15', 'unique:users'],
            'country_origin'=>['required', 'string'],
            'education_level'=>['required', 'string'],
             'referral_code' => ['nullable', 'exists:users,referral_code'],

        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
         $referrer = null;

    if (!empty($data['referral_code'])) {
        $referrer = User::where('referral_code', $data['referral_code'])->first();
    }

        
         $user = User::create([
            'id' => Str::uuid(),
            'name' => $data['name'],
            'email' => $data['email'],
             'country_origin'=>  $data['country_origin'],
            'whatsappNumber' => $data['whatsappNumber'],
            'password' => Hash::make($data['password']),
            'education_level'=>$data['education_level'],
            'status' => $data['status'] ?? 'active', // Example of setting a default value
            'user_type' => $data['user_type'] ?? 'student', // Example of setting a default value
             'referred_by' => $referrer ? $referrer->id : null, // Save the referrer's ID
        ]);

         $referral_amount = Settings::where('key_s','referral_amount')->first();

         if ($referrer) {

        Refferals::create([
            'referrer_id' => $referrer->id,
            'referred_id' => $user->id,
            'status' => 'pending',
            'commission' => $referral_amount->value,
        ]);
    }

     return $user;
    }
}
