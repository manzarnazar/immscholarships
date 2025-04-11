<?php

namespace App\Http\Controllers;

use App\Models\FinancialSupporter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class FinancialSupporterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = auth()->user()->id;
        $financialSupporter = FinancialSupporter::where('user_id',$userId)->orderBy("created_at","desc")->paginate(10);
        return view('financial-supporter.index',compact('financialSupporter'));
    }

    public function fetchFinancialSupporter(Request $request)
    {
        $userId = auth()->user()->id;
        $search = $request->get('search', '');
        $entriesPerPage = $request->get('entriesPerPage', 10);

        $query = FinancialSupporter::where('user_id',$userId);

        if ($search) {
            $query->where(function ($q) use ($search) {
            $q->where('name', 'LIKE', "%{$search}%")

            ->orWhere('relationship', 'LIKE', "%{$search}%")
            ->orWhere('email', 'LIKE', "%{$search}%")
            ->orWhere('address', 'LIKE', "%{$search}%")
            ->orWhere('profession', 'LIKE', "%{$search}%")
            ->orWhere('work_institution', 'LIKE', "%{$search}%")
            ->orWhere('country', 'LIKE', "%{$search}%")
            ->orWhere('mobile', 'LIKE', "%{$search}%");
            });
    }
          $financialSupporter = $query->orderBy('created_at','desc')->paginate($entriesPerPage);

        return response()->json([
            'data' => view('financial-supporter.financial-supporter-data', compact('financialSupporter'))->render(),
            'pagination' => view('layout.components.pagination', ['paginator' => $financialSupporter])->render(),
            'from' => $financialSupporter->firstItem(),
            'to' => $financialSupporter->lastItem(),
            'total' => $financialSupporter->total(),
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $userId = $request->user()->id;

        // Check if a student already exists for this user
        $existingFinancialSupporter = FinancialSupporter::where('user_id', $userId)->count();

        if ($existingFinancialSupporter >= 2) {
            Alert::toast('Two Family Members already exists for this user','error');
            return redirect()->route('financial-supporter');
        }
        return view('financial-supporter.details');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name.*' => 'required|string',
            'relationship.*' => 'required|string',
            //'profession.*' => 'required',
            //'work_institution.*'=> 'required',
            'country.*'=> 'required',
            'mobile.*'=> 'required',
            'email.*' => 'required|email',
            'address.*'=> 'required',
        ]);

        if ($validator->fails()) {
            Alert::toast('All data is required!', 'error');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        foreach ($request->name as $index => $name) {
            $financialSupporter = new FinancialSupporter;

            //ids
            $financialSupporter->id = Str::uuid();
            $financialSupporter->user_id = auth()->id();

            //passport details
            $financialSupporter->name = $name;
            $financialSupporter->relationship = $request->relationship[$index];
            $financialSupporter->profession = $request->profession[$index];
            $financialSupporter->work_institution = $request->work_institution[$index];
            $financialSupporter->country = $request->country[$index];
            $financialSupporter->mobile = $request->mobile[$index];
            $financialSupporter->email = $request->email[$index];
            $financialSupporter->address = $request->address[$index];

            $financialSupporter->save();
        }

        Alert::toast('Data saved successfully!', 'success');
        return redirect()->route('financial-supporter')->with('success', 'Financial Supporter Details Saved');
    }

    /**
     * Display the specified resource.
     */
    public function show(FinancialSupporter $financialSupporter)
    {
        return view('financial-supporter.details',compact('financialSupporter'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FinancialSupporter $financialSupporter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FinancialSupporter $financialSupporter)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'relationship' => 'required|string',
            'country'=> 'required',
            'mobile'=> 'required',
            'email' => 'required',
            'address'=> 'required',

        ]);

        if ($validator->fails()) {
            Alert::toast('All data is required!', 'error');

            return redirect()->back();
        }



        $financialSupporter->user_id = auth()->id();

        //passport details
        $financialSupporter->name = $request->name;
        $financialSupporter->relationship = $request->relationship;
        $financialSupporter->profession = $request->profession;
        $financialSupporter->work_institution = $request->work_institution;
        $financialSupporter->country = $request->country;
        $financialSupporter->mobile = $request->mobile;
        $financialSupporter->email = $request->email;
        $financialSupporter->address = $request->address;

        $financialSupporter->save();

        Alert::toast('Data saved successfully!', 'success');


        //return response()->json(['message' => 'Passport Details Saved Successfully.'], 200);
        return redirect()->route('financial-supporter')->with('success','Financial Supporter Details Saved');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FinancialSupporter $financialSupporter)
    {
        //
    }
}
