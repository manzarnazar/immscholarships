<?php

namespace App\Http\Controllers;

use App\Models\EnglishAbility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class EnglishAbilityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = auth()->user()->id;
        $englishAbility = EnglishAbility::where('user_id',$userId)->orderBy("created_at","desc")->paginate(10);
        return view('english-ability.index', compact('englishAbility'));
    }


    public function ajaxIndex(Request $request)
{
    $userId = auth()->user()->id;
    $search = $request->input('search');
    $entriesPerPage = $request->input('entriesPerPage', 10);

    $query = EnglishAbility::where('user_id', $userId);

    if ($search) {
        $query->where(function ($q) use ($search) {
            $q->where('english_level', 'like', "%{$search}%")
              ->orWhere('toefl', 'like', "%{$search}%")
              ->orWhere('ielts', 'like', "%{$search}%")
              ->orWhere('gre', 'like', "%{$search}%")
              ->orWhere('gmat', 'like', "%{$search}%")
              ->orWhere('other', 'like', "%{$search}%");
        });
    }

    $englishAbility = $query->orderBy('created_at', 'desc')->paginate($entriesPerPage);

    return response()->json([
        'data' => view('english-ability.english-ability-data', compact('englishAbility'))->render(),
        'pagination' => view('layout.components.pagination', ['paginator' => $englishAbility])->render(),
        'from' => $englishAbility->firstItem(),
        'to' => $englishAbility->lastItem(),
        'total' => $englishAbility->total()
    ]);
}


    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $userId = $request->user()->id;

        // Check if a student already exists for this user
        $existingEnglishAbility = EnglishAbility::where('user_id', $userId)->first();

        if ($existingEnglishAbility) {
            Alert::toast('English Language Ability already exists for this user','error');
            return redirect()->route('english-ability');
        }
        return view('english-ability.details');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'english_level' => 'required|string',

        ]);

        if ($validator->fails()) {
            Alert::toast('All data is required!', 'error');

            return redirect()->back();
        }

        $englishAbility = new EnglishAbility;

        //ids
        $englishAbility->id = Str::uuid();
        $englishAbility->user_id = auth()->id();

        //english ability details
        $englishAbility->toefl = $request->toefl;
        $englishAbility->english_level = $request->english_level;
        $englishAbility->ielts = $request->ielts;
        $englishAbility->gre = $request->gre;
        $englishAbility->gmat = $request->gmat;
        $englishAbility->other = $request->other;

        $englishAbility->save();

        Alert::toast('Data Saved Successfully!', 'success');

        //return response()->json(['message' => 'Passport Details Saved Successfully.'], 200);
        return redirect()->route('english-ability')->with('success','English Details Saved');
    }

    /**
     * Display the specified resource.
     */
    public function show(EnglishAbility $englishAbility)
    {
        return view('english-ability.details',compact('englishAbility'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EnglishAbility $englishAbility)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EnglishAbility $englishAbility)
    {
        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'english_level' => 'required|string',
            'toefl' => 'nullable|string',
            'ielts' => 'nullable|string',
            'gre' => 'nullable|string',
            'gmat' => 'nullable|string',
            'other' => 'nullable|string',
        ]);

        // If validation fails, return with an error message
        if ($validator->fails()) {
            Alert::toast('All required data must be provided!', 'error');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Update the English Ability details
        $englishAbility->english_level = $request->english_level;
        $englishAbility->toefl = $request->toefl;
        $englishAbility->ielts = $request->ielts;
        $englishAbility->gre = $request->gre;
        $englishAbility->gmat = $request->gmat;
        $englishAbility->other = $request->other;

        // Save the updated English Ability details
        $englishAbility->save();

        // Notify the user and redirect them back to the list of English Abilities
        Alert::toast('English Ability details updated successfully!', 'success');
        return redirect()->route('english-ability')->with('success', 'English Ability details updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EnglishAbility $englishAbility)
    {
        //
    }
}
