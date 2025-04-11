<?php

namespace App\Http\Controllers;

use App\Models\Guarantor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class GuarantorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = auth()->user()->id;
        $guarantor = Guarantor::where('user_id',$userId)->orderBy("created_at","desc")->paginate(10);
        return view('guarantor.index',compact('guarantor'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('guarantor.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'relationship' => 'required|string',
            'profession' => 'required',
            'work_institution'=> 'required',
            'country'=> 'required',
            'mobile'=> 'required',
            'email' => 'required',
            'address'=> 'required',
            
        ]);

        if ($validator->fails()) {
            Alert::toast('All data is required!', 'error');

            return redirect()->back();
        }

        $guarantor = new Guarantor;

        //ids
        $guarantor->id = Str::uuid();
        $guarantor->user_id = auth()->id();

        //passport details
        $guarantor->name = $request->name;
        $guarantor->relationship = $request->relationship;
        $guarantor->profession = $request->profession;
        $guarantor->work_institution = $request->work_institution;
        $guarantor->country = $request->country;
        $guarantor->mobile = $request->mobile;
        $guarantor->email = $request->email;
        $guarantor->address = $request->address;

        $guarantor->save();

        Alert::toast('Data saved successfully!', 'success');


        //return response()->json(['message' => 'Passport Details Saved Successfully.'], 200);
        return redirect()->route('guarantor')->with('success','Guarantor Details Saved');
    }

    /**
     * Display the specified resource.
     */
    public function show(Guarantor $guarantor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Guarantor $guarantor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Guarantor $guarantor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Guarantor $guarantor)
    {
        //
    }
}
