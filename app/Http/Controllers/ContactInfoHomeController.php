<?php

namespace App\Http\Controllers;

use App\Models\ContactInfoHome;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class ContactInfoHomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = auth()->user()->id;
        $contactInfoHome = ContactInfoHome::where('user_id',$userId)->orderBy("created_at","desc")->paginate(10);
        return view('contact-info-home.index',compact('contactInfoHome'));
    }


    public function fetchContactInfoHome(Request $request)
    {
        $userId = auth()->user()->id;
        $search = $request->get('search', '');
        $entriesPerPage = $request->get('entriesPerPage', 10);

        $query = ContactInfoHome::where('user_id',$userId);


        if ($search) {
            $query->where(function ($q) use ($search) {
            $q->where('email', 'LIKE', "%{$search}%")
            ->orWhere('phone', 'LIKE', "%{$search}%")
            ->orWhere('physical_address', 'LIKE', "%{$search}%")
            ->orWhere('postcode', 'LIKE', "%{$search}%");
            });
        }

        $contactInfoHome = $query->orderBy('created_at','desc')->paginate($entriesPerPage);
        return response()->json([
            'data' => view('contact-info-home.contact-info-home-data', compact('contactInfoHome'))->render(),
            'pagination' => view('layout.components.pagination', ['paginator' => $contactInfoHome])->render(),
            'from' => $contactInfoHome->firstItem(),
            'to' => $contactInfoHome->lastItem(),
            'total' => $contactInfoHome->total(),
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $userId = $request->user()->id;

        // Check if a student already exists for this user
        $existingContactInfoHome = ContactInfoHome::where('user_id', $userId)->first();

        if ($existingContactInfoHome) {
            Alert::toast('Contact Info Home already exists for this user','error');
            return redirect()->route('contact-info-home');
        }
        return view('contact-info-home.details');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required',
            'telephone' => 'required',
            //'postcode' => 'required',
            'email'=> 'required',
            'physical_address'=> 'required',

        ]);

        if ($validator->fails()) {

            Alert::toast('All Data is required', 'error');
            return redirect()->back();
        }

        $applicantInfo = new ContactInfoHome;

        //ids
        $applicantInfo->id = Str::uuid();
        $applicantInfo->user_id = auth()->id();

        //passport details
        $applicantInfo->phone = $request->phone;
        $applicantInfo->telephone = $request->telephone;
        $applicantInfo->postcode = $request->postcode;
        $applicantInfo->email = $request->email;
        $applicantInfo->physical_address = $request->physical_address;


        $applicantInfo->save();

        //return response()->json(['message' => 'Passport Details Saved Successfully.'], 200);
        Alert::toast('Applicant Contact Details Saved', 'success');

        return redirect()->route('contact-info-home')->with('success','Applicant Contact Details Saved');
    }

    /**
     * Display the specified resource.
     */
    public function show(ContactInfoHome $contactInfoHome)
    {
        return view('contact-info-home.details', compact('contactInfoHome'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ContactInfoHome $contactInfoHome)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ContactInfoHome $contactInfoHome)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required',
            'telephone' => 'required',
            //'postcode' => 'required',
            'email'=> 'required',
            'physical_address'=> 'required',

        ]);

        if ($validator->fails()) {

            Alert::toast('All Data is required', 'error');
            return redirect()->back();
        }

        $contactInfoHome->user_id = auth()->id();

        //passport details
        $contactInfoHome->phone = $request->phone;
        $contactInfoHome->telephone = $request->telephone;
        $contactInfoHome->postcode = $request->postcode;
        $contactInfoHome->email = $request->email;
        $contactInfoHome->physical_address = $request->physical_address;


        $contactInfoHome->save();

        //return response()->json(['message' => 'Passport Details Saved Successfully.'], 200);
        Alert::toast('Applicant Contact Details Saved', 'success');

        return redirect()->route('contact-info-home')->with('success','Applicant Contact Details Saved');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ContactInfoHome $contactInfoHome)
    {
        //
    }
}
