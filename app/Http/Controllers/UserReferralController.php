<?php

namespace App\Http\Controllers;

use App\Models\Roles;
use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\User;
use App\Models\Refferals;
use App\Models\Wallets;

class UserReferralController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    	$user_refferelcode = auth()->user()->referral_code;
    	$referralLink = env('APP_URL') . "/register?ref=" . $user_refferelcode;
      $referral_amount = Settings::where('key_s','referral_amount')->first();
$referrals = Refferals::join('users', 'refferals.referred_id', '=', 'users.id')
    ->where('refferals.referrer_id', auth()->user()->id) // Ensure 'referrer_id' exists
    ->select('users.*', 'refferals.status', 'refferals.commission')
    ->get();

     $wallet = Wallets::where('user_id', auth()->user()->id)->first();

        return view('Userreferral.index',compact('referral_amount','referralLink','user_refferelcode','referrals','wallet'));
    }


   
}
