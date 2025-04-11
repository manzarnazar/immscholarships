<?php

namespace App\Http\Controllers;

use App\Models\ChineseAbility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class ChineseAbilityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = auth()->user()->id;
        $chineseAbility = ChineseAbility::where('user_id', $userId)->orderBy("created_at", "desc")->paginate(10);
        return view('chinese-ability.index', compact('chineseAbility'));
    }

    public function fetchChineseAbilityData(Request $request)
    {
        $userId = auth()->user()->id;
        $search = $request->get('search', '');
        $entriesPerPage = $request->get('entriesPerPage', 10);


        $query = ChineseAbility::where('user_id', $userId);

        if ($search) {
            $query->where(function ($q) use ($search) {
            $q->where('chinese_level', 'LIKE', "%{$search}%")

            ->orWhere('hsk_score', 'LIKE', "%{$search}%")
            ->orWhere('hskk_grade', 'LIKE', "%{$search}%")
            ->orWhere('hssk_score', 'LIKE', "%{$search}%");
            });
        }

          $chineseAbility =  $query->orderBy('created_at','desc')->paginate($entriesPerPage);

        return response()->json([
            'data' => view('chinese-ability.chinese-ability-data', compact('chineseAbility'))->render(),
            'pagination' => view('layout.components.pagination', ['paginator' => $chineseAbility])->render(),
            'from' => $chineseAbility->firstItem(),
            'to' => $chineseAbility->lastItem(),
            'total' => $chineseAbility->total(),
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $userId = $request->user()->id;

        // Check if a student already exists for this user
        $existingChineseAbility = ChineseAbility::where('user_id', $userId)->first();

        if ($existingChineseAbility) {
            Alert::toast('Chinese Language Ability already exists for this user','error');
            return redirect()->route('chinese-ability');
        }
        return view('chinese-ability.details');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'chinese_level' => 'required|string',

        ]);

        if ($validator->fails()) {
            Alert::toast('All Data Required', 'error');

            return redirect()->back();
        }

        $chineseAbility = new ChineseAbility;

        //ids
        $chineseAbility->id = Str::uuid();
        $chineseAbility->user_id = auth()->id();

        //english ability details
        $chineseAbility->hsk_score = $request->hsk_score;
        $chineseAbility->hssk_score = $request->hssk_score;

        $chineseAbility->chinese_level = $request->chinese_level;
        $chineseAbility->hskk_grade = $request->hskk_grade;


        $chineseAbility->save();

        //return response()->json(['message' => 'Passport Details Saved Successfully.'], 200);
        Alert::toast('Data Saved Successfully!', 'success');

        return redirect()->route('chinese-ability')->with('success', 'Chinese Details Saved');
    }

    /**
     * Display the specified resource.
     */
    public function show(ChineseAbility $chineseAbility)
    {
        return view('chinese-ability.details',compact('chineseAbility'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ChineseAbility $chineseAbility)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ChineseAbility $chineseAbility)
    {
        $validator = Validator::make($request->all(), [
            'chinese_level' => 'required|string',
            'hsk_score' => 'nullable|string',
            'hssk_score' => 'nullable|string',
            'hskk_grade' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            Alert::toast('All Data Required', 'error');

            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Update chinese ability details
        $chineseAbility->chinese_level = $request->chinese_level;
        $chineseAbility->hsk_score = $request->hsk_score;
        $chineseAbility->hssk_score = $request->hssk_score;
        $chineseAbility->hskk_grade = $request->hskk_grade;

        $chineseAbility->save();

        Alert::toast('Data Updated Successfully!', 'success');

        return redirect()->route('chinese-ability')->with('success', 'Chinese Details Updated');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ChineseAbility $chineseAbility)
    {
        //
    }
}
