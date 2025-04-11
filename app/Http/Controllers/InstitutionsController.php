<?php

namespace App\Http\Controllers;

use App\Models\Institutions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class InstitutionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    // Fetching the search term and entries per page from the request
    $search = $request->get('search', '');
    $entriesPerPage = $request->get('entriesPerPage', 10);

    // Start building the query for Institutions model
    $query = Institutions::query();

    // Apply search filters if search term is present
    if ($search) {
        $query->where(function ($q) use ($search) {
            $q->where('name', 'LIKE', "%{$search}%")
              ->orWhere('code', 'LIKE', "%{$search}%")
              ->orWhere('country', 'LIKE', "%{$search}%")
              ->orWhere('city', 'LIKE', "%{$search}%")
              ->orWhere('province', 'LIKE', "%{$search}%");
        });
    }

    // Paginate the results
    $institutions = $query->orderBy('created_at', 'desc')->paginate($entriesPerPage);

    // If the request is expecting JSON (e.g., AJAX call), return only the data part
    if ($request->ajax()) {
        $html = view('institutions.partials._table_data', compact('institutions'))->render(); // Renders the table data HTML
        $pagination = view('layout.components.pagination', ['paginator' => $institutions])->render(); // Renders pagination HTML

        // Return the rendered HTML as a JSON response
        return response()->json([
            'data' => $html,
            'pagination' => $pagination,
            'from' => $institutions->firstItem(),
            'to' => $institutions->lastItem(),
            'total' => $institutions->total()
        ]);
    }

    // If it's not an AJAX request, return the normal view
    return view('institutions.index', compact('institutions', 'search', 'entriesPerPage'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("institutions.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'country' => 'required|string',
            'province'=> 'required',
            'city'=> 'required',
            'education_level'=> 'required',
            'duration'=> 'required',
            'timeline'=> 'required',
            'requirements'=> 'required|string',
            'application_fee'=> 'required',
            'ims_fee'=> 'required',
            'scholarship'=> 'required',

        ]);

        if ($validator->fails()) {
            Alert::toast('All data is required!', 'error');
            return redirect()->back();
        }

        $institutions = new Institutions;
        $institutions->id = Str::uuid();
        $institutions->user_id = auth()->id();

        $currentYear = date('Y');
        $count = Institutions::whereYear('created_at', $currentYear)->count();
        $count++;

        $institutionCode = "IMS-INST-$currentYear-" . str_pad($count, 3, '0', STR_PAD_LEFT);


        $institutions->name = $request->name;
        $institutions->country = $request->country;
        $institutions->province = $request->province;
        $institutions->city = $request->city;
        $institutions->code = $institutionCode;

        $institutions->education_level = $request->education_level;
        $institutions->scholarship = html_entity_decode($request->scholarship);

        $institutions->duration = $request->duration;
        $institutions->timeline = html_entity_decode($request->timeline);
        $institutions->requirements = html_entity_decode($request->requirements);

        $institutions->application_fee = html_entity_decode($request->application_fee);
        $institutions->ims_fee = html_entity_decode($request->ims_fee);

        $institutions->save();

        Alert::toast('Data saved successfully!', 'success');

        return redirect()->route('admin-institutions')->with('success','Institutions Created!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        $institution = Institutions::findOrFail($id);
        return view('institutions.view', compact('institution'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $institution = Institutions::findOrFail($id);
        return view('institutions.edit', compact('institution'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $institutions = Institutions::findOrFail($id);
        $institutions->update($request->all());
        Alert::toast('Data Updated successfully!', 'success');
       return redirect()->back()->with('success', 'Institutions updated successfully');
       //return view("institutions.index",compact('institutions'));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $institution = Institutions::findOrFail($id);
        $institution->delete();

        return redirect()->back()->with('success', 'Institution deleted successfully');
    }
}
