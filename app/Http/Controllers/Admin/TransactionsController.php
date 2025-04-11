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

class TransactionsController extends Controller
{
    
    public function index()
    {

        $transactions = Transactions::with('user')->get();

        return view('admin.Transactions.index',compact('transactions'));
    }


   
}
