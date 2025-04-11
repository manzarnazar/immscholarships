<?php

namespace App\Http\Controllers;

use App\Models\Passports;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class PassportsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = auth()->user()->id;
        $passports = Passports::where('user_id',$userId)->orderBy("created_at","desc")->paginate(10);
        // dd($passports);
        return view('passport-info.index',compact('passports'));
    }

    public function fetchPassports(Request $request)
{
    $userId = auth()->user()->id;
    $search = $request->input('search');
    $entriesPerPage = $request->input('entriesPerPage', 10);

    $query = Passports::where('user_id', $userId);

    if ($search) {
        $query->where(function($q) use ($search) {
            $q->where('first_name', 'like', "%{$search}%")
              ->orWhere('last_name', 'like', "%{$search}%")
              ->orWhere('passport_number', 'like', "%{$search}%");
        });
    }

    $passports = $query->orderBy("created_at", "desc")->paginate($entriesPerPage);

    return response()->json([
        'data' => view('passport-info.passport-data', compact('passports'))->render(),
        'pagination' => view('passport-info.pagination', compact('passports'))->render(),
        'from' => $passports->firstItem(),
        'to' => $passports->lastItem(),
        'total' => $passports->total()
    ]);
}



    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $userId = $request->user()->id;

        // Check if a student already exists for this user
        $existingPassport = Passports::where('user_id', $userId)->first();

        if ($existingPassport) {
            Alert::toast('Passport already exists for this user','error');
            return redirect()->route('passport-info');
        }
        return view('passport-info.details');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'passport_number' => 'required',
            'expiry_date'=> 'required',
            'issued_date' => 'required',
            'image_path' => 'required',

        ]);

        if ($validator->fails()) {
            Alert::toast('All data is required!', 'error');

            return redirect()->back();
        }

        $passports = new Passports;


        $upload_file = uniqid() . '.' . $request->image_path->extension();
        $request->image_path->move(public_path('images'), $upload_file);
        $image_url = asset('images/' . $upload_file);



        //ids
        $passports->id = Str::uuid();
        $passports->user_id = auth()->id();

        //passport details
        $passports->first_name = $request->first_name;
        $passports->last_name = $request->last_name;
        $passports->passport_number = $request->passport_number;
        $passports->expiry_date = $request->expiry_date;
        $passports->issued_date = $request->issued_date;

        $passports->image_path = $image_url;

        $passports->save();

        //return response()->json(['message' => 'Passport Details Saved Successfully.'], 200);
        Alert::toast('Passport Details Saved','success');
        return redirect()->route('passport-info')->with('success','Passport Details Saved');
    }

    /**
     * Display the specified resource.
     */
    public function show(Passports $passport)
    {
        return view('passport-info.details',compact('passport'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Passports $passports)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Passports $passport)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'passport_number' => 'required',
            'expiry_date'=> 'required',
            'issued_date' => 'required',
            'image_path' => 'nullable|image',
        ]);

        if ($validator->fails()) {
            Alert::toast('All data is required!', 'error');
            return redirect()->back();
        }

        if ($request->hasFile('image_path')) {
            // Handle the new image upload
            $upload_file = uniqid() . '.' . $request->image_path->extension();
            $request->image_path->move(public_path('images'), $upload_file);
            $image_url = asset('images/' . $upload_file);
            $passport->image_path = $image_url;
        }

        // dd($request->all());

        // Update passport details
        $passport->first_name = $request->first_name;
        $passport->last_name = $request->last_name;
        $passport->passport_number = $request->passport_number;
        $passport->expiry_date = $request->expiry_date;
        $passport->issued_date = $request->issued_date;

        $passport->save();
        Alert::toast('Passport Details Saved','success');
        return redirect()->route('passport-info')->with('success','Passport Details Updated Successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Passports $passports)
    {
        //
    }
}
