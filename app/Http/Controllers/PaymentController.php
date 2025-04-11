<?php

namespace App\Http\Controllers;
use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
class PaymentController extends Controller
{
     public function index()
    {
        
      $flutterwave_public_key = Settings::where('key_s', 'flutterwave_public_key')->first();
      $flutterwave_secret_key = Settings::where('key_s', 'flutterwave_secret_key')->first();
      $Encryption_key = Settings::where('key_s', 'Encryption_key')->first();
      return view('Settings.index',compact('flutterwave_public_key','flutterwave_secret_key','Encryption_key'));
    }



    public function updateApiKeys(Request $request)
{
    $validated = $request->validate([
        'flutterwave_public_key' => 'required|string',
        'flutterwave_secret_key' => 'required|string',
        'flutterwave_encrypt_key' => 'required|string',
    ]);

    
    $flutterwave_public_key = Settings::where('key_s', 'flutterwave_public_key')->first();
    $flutterwave_public_key->value = $request->input('flutterwave_public_key');
    $flutterwave_public_key->save();

    $flutterwave_secret_key = Settings::where('key_s', 'flutterwave_secret_key')->first();
    $flutterwave_secret_key->value = $request->input('flutterwave_secret_key');
    $flutterwave_secret_key->save();

    $flutterwave_encrypt_key = Settings::where('key_s', 'Encryption_key')->first();
    $flutterwave_encrypt_key->value = $request->input('flutterwave_encrypt_key');
    $flutterwave_encrypt_key->save();

    Alert::toast('API keys updated successfully!', 'success');
    
    return redirect()->route('admin-settings')->with('success', 'API keys updated successfully!');
}
}
