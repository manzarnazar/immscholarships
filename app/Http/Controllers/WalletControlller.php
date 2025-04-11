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
use App\Models\WithdrawRequest;

class WalletControlller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {


     $withdraw_requests = WithdrawRequest::where('user_id', auth()->user()->id)->get();
     $wallet = wallets::where('user_id', auth()->user()->id)->first();

        return view('wallet.index',compact('withdraw_requests','wallet'));
    }

    public function withdraw_view(){

		return view('wallet.withdraw');

    }

   	


    public function submit(Request $request)
    {
    
       
        $request->validate([
            'bank_name' => 'required',
            'name' => 'required',
            'amount' => 'required',
            'acc_no' => 'required',
        ]);


        $wallet = Wallets::where('user_id', auth()->user()->id)->first();

         if ($request->amount > $wallet->balance) {
               
          Alert::toast('You have insufficient balance to withdrawal.','error');
        return redirect()->route('student-wallet')
            ->with('error', 'You have insufficient balance to withdrawal.');
                
            }
       
        WithdrawRequest::create([
            'user_id' => auth()->user()->id,
            'bank_name' => $request->bank_name,
            'name' => $request->name,
            'amount' => $request->amount,
            'email'=>$request->email,
            'acc_no'=>$request->acc_no,
        ]);

         $wallet = Wallets::where('user_id', auth()->user()->id)->first();

         if ($wallet) {
               
                $wallet->balance -= $request->amount; 
                $wallet->save();
            }
       	

       	 Alert::toast('Your withdrawal request has been submitted.','success');
        return redirect()->route('student-wallet')
            ->with('success', 'Your withdrawal request has been submitted.');
       
    }
}




