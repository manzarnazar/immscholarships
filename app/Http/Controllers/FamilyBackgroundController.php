<?php

namespace App\Http\Controllers;

use App\Models\FamilyBackground;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class FamilyBackgroundController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = auth()->user()->id;
        $familyBackgrounds = FamilyBackground::where('user_id',$userId)->orderBy("created_at","desc")->paginate(10);
        return view('family-background.index',compact('familyBackgrounds'));
    }

    public function fetchFamilyBackgroundData(Request $request)
    {
        $userId = auth()->user()->id;
        $search = $request->get('search', '');
        $entriesPerPage = $request->get('entriesPerPage', 10);

        $query = FamilyBackground::where('user_id',$userId);

        if ($search) {
            $query->where(function ($q) use ($search) {
            $q->where('name', 'LIKE', "%{$search}%")
            ->orWhere('relationship', 'LIKE', "%{$search}%")
            ->orWhere('profession', 'LIKE', "%{$search}%")
            ->orWhere('work_institution', 'LIKE', "%{$search}%")
            ->orWhere('country', 'LIKE', "%{$search}%")
            ->orWhere('mobile', 'LIKE', "%{$search}%");
        });
    }
            $familyBackgrounds = $query->orderBy('created_at','desc')->paginate($entriesPerPage);


        return response()->json([
            'data' => view('family-background.family-background-data', compact('familyBackgrounds'))->render(),
            'pagination' => view('layout.components.pagination', ['paginator' => $familyBackgrounds])->render(),
            'from' => $familyBackgrounds->firstItem(),
            'to' => $familyBackgrounds->lastItem(),
            'total' => $familyBackgrounds->total(),
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $userId = $request->user()->id;

        // Check if a student already exists for this user
        $existingFamilyBackground = FamilyBackground::where('user_id', $userId)->first();

        if ($existingFamilyBackground) {
            Alert::toast('Family Background Data already exists for this user','error');
            return redirect()->route('family-background');
        }
        return view('family-background.details');
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'name' => 'required|string',
    //         'relationship' => 'required|string',
    //         //'profession' => 'required',
    //         //'work_institution'=> 'required',
    //         'country'=> 'required',
    //         'mobile'=> 'required',

    //     ]);

    //     if ($validator->fails()) {
    //         Alert::toast('All Data is required!', 'error');

    //         return redirect()->back();
    //     }

    //     $familyBackgrounds = new FamilyBackground;

    //     //ids
    //     $familyBackgrounds->id = Str::uuid();
    //     $familyBackgrounds->user_id = auth()->id();

    //     //passport details
    //     $familyBackgrounds->name = $request->name;
    //     $familyBackgrounds->relationship = $request->relationship;
    //     $familyBackgrounds->profession = $request->profession;
    //     $familyBackgrounds->work_institution = $request->work_institution;
    //     $familyBackgrounds->country = $request->country;
    //     $familyBackgrounds->mobile = $request->mobile;

    //     $familyBackgrounds->save();

    //     Alert::toast('Data saved successfully!', 'success');


    //     //return response()->json(['message' => 'Passport Details Saved Successfully.'], 200);
    //     return redirect()->route('family-background')->with('success','Family Background Details Saved');
    // }

        public function store(Request $request)
{
    $validator = Validator::make($request->all(), [
        'name.*' => 'required|string',
        'relationship.*' => 'required|string',
        //'profession.*' => 'required|string',
       // 'work_institution.*' => 'required|string',
        'country.*' => 'required|string',
        'mobile.*' => 'required|string',
    ]);

    if ($validator->fails()) {
        Alert::toast('All Data is required!', 'error');
        return redirect()->back();
    }

    $user_id = auth()->id();
        if (count($request->name) < 2) {
     Alert::toast('Please add at least two family members.', 'error');
  return redirect()->back()
    ->withErrors(['family_members' => 'Please add at least two family members.'])
    ->withInput();
}
  foreach ($request->name as $key => $name) {
        $familyBackground = new FamilyBackground;

        $familyBackground->id = Str::uuid();
        $familyBackground->user_id = $user_id;
        $familyBackground->name = $name;
        $familyBackground->relationship = $request->relationship[$key];
        $familyBackground->profession = $request->profession[$key];
        $familyBackground->work_institution = $request->work_institution[$key];
        $familyBackground->country = $request->country[$key];
        $familyBackground->mobile = $request->mobile[$key];

        $familyBackground->save();
    }

    Alert::toast('Data saved successfully!', 'success');
    return redirect()->route('family-background')->with('success', 'Family Background Details Saved');
}

    /**
     * Display the specified resource.
     */
    public function show(FamilyBackground $familyBackground)
    {
        return view('family-background.details',compact('familyBackground'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FamilyBackground $familyBackground)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FamilyBackground $familyBackground)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'relationship' => 'required|string',
            'country' => 'required|string',
            'mobile' => 'required|string',
        ]);

        if ($validator->fails()) {
            Alert::toast('All Data is required!', 'error');
            return redirect()->back();
        }

             $user_id = auth()->id();



            $familyBackground->id = Str::uuid();
            $familyBackground->user_id = $user_id;
            $familyBackground->name = $request->name;
            $familyBackground->relationship = $request->relationship;
            $familyBackground->profession = $request->profession;
            $familyBackground->work_institution = $request->work_institution;
            $familyBackground->country = $request->country;
            $familyBackground->mobile = $request->mobile;

            $familyBackground->save();


        Alert::toast('Data saved successfully!', 'success');
        return redirect()->route('family-background')->with('success', 'Family Background Details Saved');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FamilyBackground $familyBackground)
    {
        //
    }
}
