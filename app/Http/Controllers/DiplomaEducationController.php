<?php

namespace App\Http\Controllers;

use App\Models\DiplomaEducation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class DiplomaEducationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $diploma = DiplomaEducation::where("user_id", auth()->user()->id)->paginate(10);
        return view("diploma.index", compact("diploma"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $userId = $request->user()->id;

        // Check if a student already exists for this user
        $existingDiploma = DiplomaEducation::where('user_id', $userId)->first();

        if ($existingDiploma) {
            Alert::toast('Diploma already exists for this user','error');
             return redirect()->route('diploma-education');
        }
        return view("diploma.details");
    }



    public function fetchDiploma(Request $request)
{
    $search = $request->input('search');
    $entriesPerPage = $request->input('entriesPerPage', 10);

    $diploma = DiplomaEducation::where('user_id',auth()->user()->id)
        ->when($search, function ($query, $search) {
            return $query->where('institution_name', 'like', '%' . $search . '%')
                         ->orWhere('major_subject', 'like', '%' . $search . '%');
        })
        ->paginate($entriesPerPage);

    $view = view('diploma.diploma-data', compact('diploma'))->render();
    $pagination = view('layout.components.pagination', ['paginator' => $diploma])->render();

    return response()->json([
        'data' => $view,
        'pagination' => $pagination,
        'from' => $diploma->firstItem(),
        'to' => $diploma->lastItem(),
        'total' => $diploma->total()
    ]);
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
            Alert::toast('All data is required!', 'error');
            return redirect()->back();
        }

        $user_id = auth()->id();
        $diplomaEducation = new DiplomaEducation;
        $diplomaEducation->id = Str::uuid();
        $diplomaEducation->user_id = $user_id;

        //------ Get Image path and store in public/images
        // $imagePath = $request->file('image_path')->store('public/images');
        // $imageUrl = Storage::url($imagePath); //---get image url from db

          $upload_file = uniqid() . '.' . $request->image_path->extension();
        $request->image_path->move(public_path('images'), $upload_file);
        $image_url = asset('images/' . $upload_file);

        $diplomaEducation->start_date = $request->input('start_date');
        $diplomaEducation->end_date = $request->input('end_date');
        $diplomaEducation->institution_name = $request->input('institution_name');
        $diplomaEducation->country = $request->input('country');
        $diplomaEducation->major_subject = $request->input('major_subject');
        $diplomaEducation->award = $request->input('award');
        $diplomaEducation->image_path = $image_url;

        $diplomaEducation->save();

        Alert::toast('Data saved successfully!', 'success');


        return redirect()->route('diploma-education')->with('success', 'Diploma Education Information Added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(DiplomaEducation $diplomaEducation)
    {
        return view('diploma.details',compact('diplomaEducation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DiplomaEducation $diplomaEducation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DiplomaEducation $diplomaEducation)
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

        $user_id = auth()->id();
        $diplomaEducation->user_id = $user_id;

        $diplomaEducation->start_date = $request->input('start_date');
        $diplomaEducation->end_date = $request->input('end_date');
        $diplomaEducation->institution_name = $request->input('institution_name');
        $diplomaEducation->country = $request->input('country');
        $diplomaEducation->major_subject = $request->input('major_subject');
        $diplomaEducation->award = $request->input('award');
        $diplomaEducation->study_in_china = $request->input('study_in_china');

        // Handle image upload if present
        if ($request->hasFile('image_path')) {
            $upload_file = uniqid() . '.' . $request->image_path->extension();
            $request->image_path->move(public_path('images'), $upload_file);
            $image_url = asset('images/' . $upload_file);

            // Delete the old image if a new one is uploaded
            if (file_exists(public_path(parse_url($diplomaEducation->image_path, PHP_URL_PATH)))) {
                unlink(public_path(parse_url($diplomaEducation->image_path, PHP_URL_PATH)));
            }

            $diplomaEducation->image_path = $image_url;
        }

        $diplomaEducation->save();

        Alert::toast('Data updated successfully!', 'success');

        return redirect()->route('diploma-education')->with('success', 'Degree Education Information Updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DiplomaEducation $diplomaEducation)
    {
        //
    }
}
