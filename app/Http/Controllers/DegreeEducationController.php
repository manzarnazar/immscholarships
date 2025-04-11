<?php

namespace App\Http\Controllers;

use App\Models\DegreeEducation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class DegreeEducationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $degree = DegreeEducation::where("user_id", auth()->user()->id)->paginate(10);
        return view("degree.index", compact("degree"));
    }


    public function fetchDegrees(Request $request)
{
    $search = $request->input('search');
    $entriesPerPage = $request->input('entriesPerPage', 10);

    $degree = DegreeEducation::where('user_id',auth()->user()->id)
        ->when($search, function ($query, $search) {
            return $query->where('institution_name', 'like', '%' . $search . '%')
                         ->orWhere('major_subject', 'like', '%' . $search . '%');
        })
        ->paginate($entriesPerPage);

    $view = view('degree.degree-data', compact('degree'))->render();
$pagination = view('layout.components.pagination', ['paginator' => $degree])->render();

    return response()->json([
        'data' => $view,
        'pagination' => $pagination,
        'from' => $degree->firstItem(),
        'to' => $degree->lastItem(),
        'total' => $degree->total()
    ]);
}


    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $userId = $request->user()->id;

        // Check if a student already exists for this user
        $existingDegreeEducation = DegreeEducation::where('user_id', $userId)->first();

        if ($existingDegreeEducation) {
            Alert::toast('Education Degree already exists for this user','error');
            return redirect()->route('degree-education');
        }
        return view("degree.details");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $commonRules = [
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'institution_name' => 'required',
            'country' => 'required',
            'major_subject' => 'required',
            'award' => 'required',
            'image_path' => 'required',

        ];

        $validator = Validator::make($request->all(), $commonRules);

        if ($validator->fails()) {
            Alert::toast('All Data is required!', 'error');

            return redirect()->back();
        }

        $user_id = auth()->id();
        $degreeEducation = new DegreeEducation;
        $degreeEducation->id = Str::uuid();
        $degreeEducation->user_id = $user_id;

        //------ Get Image path and store in public/images
        // $imagePath = $request->file('image_path')->store('public/images');
        // $imageUrl = Storage::url($imagePath); //---get image url from db


        $upload_file = uniqid() . '.' . $request->image_path->extension();
        $request->image_path->move(public_path('images'), $upload_file);
        $image_url = asset('images/' . $upload_file);

        $degreeEducation->start_date = $request->input('start_date');
        $degreeEducation->end_date = $request->input('end_date');
        $degreeEducation->institution_name = $request->input('institution_name');
        $degreeEducation->country = $request->input('country');
        $degreeEducation->major_subject = $request->input('major_subject');
        $degreeEducation->award = $request->input('award');
        $degreeEducation->study_in_china = $request->input('study_in_china');
        $degreeEducation->image_path = $image_url;

        // dd($degreeEducation);

        $degreeEducation->save();

        Alert::toast('Data saved successfully!', 'success');


        return redirect()->route('degree-education')->with('success', 'Degree Education Information Added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(DegreeEducation $degree)
    {
        return view('degree.details', compact('degree'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DegreeEducation $degreeEducation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DegreeEducation $degreeEducation)
    {
        $commonRules = [
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'institution_name' => 'required',
            'country' => 'required',
            'major_subject' => 'required',
            'award' => 'required',
            'image_path' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];

        $validator = Validator::make($request->all(), $commonRules);

        if ($validator->fails()) {
            Alert::toast('All Data is required!', 'error');

            return redirect()->back()->withErrors($validator)->withInput();
        }

        $degreeEducation->start_date = $request->input('start_date');
        $degreeEducation->end_date = $request->input('end_date');
        $degreeEducation->institution_name = $request->input('institution_name');
        $degreeEducation->country = $request->input('country');
        $degreeEducation->major_subject = $request->input('major_subject');
        $degreeEducation->award = $request->input('award');
        $degreeEducation->study_in_china = $request->input('study_in_china');

        // Handle image upload if present
        if ($request->hasFile('image_path')) {
            $upload_file = uniqid() . '.' . $request->image_path->extension();
            $request->image_path->move(public_path('images'), $upload_file);
            $image_url = asset('images/' . $upload_file);

            // Delete the old image if a new one is uploaded
            if (file_exists(public_path(parse_url($degreeEducation->image_path, PHP_URL_PATH)))) {
                unlink(public_path(parse_url($degreeEducation->image_path, PHP_URL_PATH)));
            }

            $degreeEducation->image_path = $image_url;
        }

        $degreeEducation->save();

        Alert::toast('Data updated successfully!', 'success');

        return redirect()->route('degree-education')->with('success', 'Degree Education Information Updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DegreeEducation $degreeEducation)
    {
        //
    }
}
