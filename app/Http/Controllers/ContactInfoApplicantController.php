<?php

namespace App\Http\Controllers;

use App\Models\ContactInfoApplicant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class ContactInfoApplicantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = auth()->user()->id;
        $contactInfoApplicant = ContactInfoApplicant::where('user_id',$userId)->orderBy("created_at","desc")->paginate(10);
        return view('contact-info-applicant.index',compact('contactInfoApplicant'));
    }

    public function fetchContactInfoApplicant(Request $request)
    {
        $userId = auth()->user()->id;
        $search = $request->get('search', '');
        $entriesPerPage = $request->get('entriesPerPage', 10);

        $query = ContactInfoApplicant::where('user_id',$userId);


        if ($search) {
            $query->where(function ($q) use ($search) {
            $q->where('email', 'LIKE', "%{$search}%")
            ->orWhere('phone', 'LIKE', "%{$search}%")
            ->orWhere('physical_address', 'LIKE', "%{$search}%")
            ->orWhere('postcode', 'LIKE', "%{$search}%");
            });
        }

        $contactInfoApplicant = $query->orderBy('created_at','desc')->paginate($entriesPerPage);
        return response()->json([
            'data' => view('contact-info-applicant.contact-info-applicant-data', compact('contactInfoApplicant'))->render(),
            'pagination' => view('layout.components.pagination', ['paginator' => $contactInfoApplicant])->render(),
            'from' => $contactInfoApplicant->firstItem(),
            'to' => $contactInfoApplicant->lastItem(),
            'total' => $contactInfoApplicant->total(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $userId = $request->user()->id;

        // Check if a student already exists for this user
        $existingContactInfo = ContactInfoApplicant::where('user_id', $userId)->first();

        if ($existingContactInfo) {
            Alert::toast('Mailing Address already exists for this user','error');
            return redirect()->route('contact-info-applicant');
        }
        return view('contact-info-applicant.details');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'phone' => 'required',
            'telephone' => 'required',
            //'postcode' => 'required',
            'email'=> 'required',
            'physical_address'=> 'required',

        ]);

        if ($validator->fails()) {
            Alert::toast('All Data Required', 'error');
            return redirect()->back();
        }

        $applicantInfo = new ContactInfoApplicant;

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

        Alert::toast('Applicant Contact Details Saved', 'success');

        //return response()->json(['message' => 'Passport Details Saved Successfully.'], 200);
        return redirect()->route('contact-info-applicant')->with('success','Applicant Contact Details Saved');
    }

    /**
     * Display the specified resource.
     */
    public function show(ContactInfoApplicant $contactInfoApplicant)
    {
        return view('contact-info-applicant.details',compact('contactInfoApplicant'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ContactInfoApplicant $contactInfoApplicant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ContactInfoApplicant $contactInfoApplicant)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required',
            'telephone' => 'required',
            //'postcode' => 'required',
            'email'=> 'required',
            'physical_address'=> 'required',

        ]);

        if ($validator->fails()) {
            Alert::toast('All Data Required', 'error');
            return redirect()->back();
        }


        $contactInfoApplicant->user_id = auth()->id();

        //passport details
        $contactInfoApplicant->phone = $request->phone;
        $contactInfoApplicant->telephone = $request->telephone;
        $contactInfoApplicant->postcode = $request->postcode;
        $contactInfoApplicant->email = $request->email;
        $contactInfoApplicant->physical_address = $request->physical_address;


        $contactInfoApplicant->save();

        Alert::toast('Applicant Contact Details Saved', 'success');

        //return response()->json(['message' => 'Passport Details Saved Successfully.'], 200);
        return redirect()->route('contact-info-applicant')->with('success','Applicant Contact Details Saved');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ContactInfoApplicant $contactInfoApplicant)
    {
        //
    }
}
