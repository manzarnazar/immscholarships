<?php

namespace App\Http\Controllers;

use App\Models\Roles;
use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Refferals;

class ReferralController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    	$totalReferrals = Refferals::count();

      $referral_amount = Settings::where('key_s','referral_amount')->first();

      $referrals = Refferals::join('users as referrers', 'refferals.referrer_id', '=', 'referrers.id')
    ->join('users as referred_users', 'refferals.referred_id', '=', 'referred_users.id')
    ->select(
        'referrers.name as referrer_name', 
        'referrers.email as referrer_email', 
        'referred_users.name as referred_name', 
        'referred_users.email as referred_email',
        'refferals.created_at as referral_date'
    )
    ->get();


      
        return view('referral.index',compact('referral_amount','totalReferrals','referrals'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('roles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
	public function updateReferralAmount(Request $request)
	{
				
			   
	Settings::updateOrCreate(['key_s' => 'referral_amount'], ['value' => $request->referral_amount]);
	 Alert::toast('Referral amount updated successfully!', 'success');
      return redirect()->route('admin-referral')->with('success','Referral amount updated successfully!');
			   
		}

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',


        ]);

        if ($validator->fails()) {
            Alert::toast('All data is required!', 'error');

            return redirect()->back();
        }

        $roles = new Roles;
        $roles->name = $request->name;
        $roles->id = Str::uuid();
        $roles->user_id = auth()->id();

        $roles->save();

        Alert::toast('Role created!', 'success');

        return redirect()->route('admin-roles')->with('success','Role Created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Roles $roles)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Roles $roles)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Roles $roles)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Roles $roles)
    {
        //
    }
}
