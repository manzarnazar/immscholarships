<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Roles;
use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\User;
use App\Models\Refferals;
use App\Models\Wallets;
use App\Models\Transactions;
use App\Models\WithdrawRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\WithdrawRequestMail;
class WithdrawalController extends Controller
{
    
    public function index()
    {

        $withdraw_requests = WithdrawRequest::with('user')->get();

        return view('admin.Withdrawal.index',compact('withdraw_requests'));
    }

            public function updateStatus($id)
        {
            $transaction = WithdrawRequest::findOrFail($id);

            if ($transaction->status === 'pending') {
                $transaction->status = 'complete';
                $transaction->save();
                $amount = $transaction->amount;
                $user = User::where('id',$transaction->user_id)->first();
                
                 Mail::to($user->email)->send(new WithdrawRequestMail($amount));
            }

            Alert::toast('Payment mark completed successfully!','success');
        return redirect()->route('admin-Withdrawal')
            ->with('success', 'Payment mark completed successfully!.');
        }
   
}
