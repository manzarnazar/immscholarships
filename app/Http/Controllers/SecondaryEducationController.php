<?php

namespace App\Http\Controllers;

use App\Models\SecondaryEducation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;

class SecondaryEducationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $secondaryEducation = SecondaryEducation::where("user_id", auth()->user()->id)->paginate(10);
        return view("education-backgrounds.index", compact("secondaryEducation"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $userId = $request->user()->id;

        // Check if a student already exists for this user
        $existingSecondaryEducation = SecondaryEducation::where('user_id', $userId)->first();

        if ($existingSecondaryEducation) {
            Alert::toast('Secondary Education Data already exists for this user','error');
            return redirect()->route('secondary-education',compact('existingSecondaryEducation'));
        }
        return view("education-backgrounds.details");
    }


    public function fetchSecondaryEducation(Request $request)
{
    $search = $request->input('search');
    $entriesPerPage = $request->input('entriesPerPage', 10);

    $secondaryEducation = SecondaryEducation::where('user_id', auth()->user()->id)
    ->when($search, function ($query, $search) {
        return $query->where(function ($query) use ($search) {
            $query->where('institution_name', 'like', '%' . $search . '%')
                  ->orWhere('major_subject', 'like', '%' . $search . '%');
        });
    })
    ->paginate($entriesPerPage);


    $view = view('education-backgrounds.secondary-data', compact('secondaryEducation'))->render();
    $pagination = view('layout.components.pagination', ['paginator' => $secondaryEducation])->render();

    return response()->json([
        'data' => $view,
        'pagination' => $pagination,
        'from' => $secondaryEducation->firstItem(),
        'to' => $secondaryEducation->lastItem(),
        'total' => $secondaryEducation->total()
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
        $secondaryEducation = new SecondaryEducation;
        $secondaryEducation->id = Str::uuid();
        $secondaryEducation->user_id = $user_id;

        //------ Get Image path and store in public/images
        // $imagePath = $request->file('image_path')->store('public/images');
        // $imageUrl = Storage::url($imagePath); //---get image url from db


        $upload_file = uniqid() . '.' . $request->image_path->extension();
        $request->image_path->move(public_path('images'), $upload_file);
        $image_url = asset('images/' . $upload_file);

        $secondaryEducation->start_date = $request->input('start_date');
        $secondaryEducation->end_date = $request->input('end_date');
        $secondaryEducation->institution_name = $request->input('institution_name');
        $secondaryEducation->country = $request->input('country');
        $secondaryEducation->major_subject = $request->input('major_subject');
        $secondaryEducation->award = $request->input('award');
        $secondaryEducation->image_path = $image_url;

        $secondaryEducation->save();

        Alert::toast('Data saved!', 'success');
        return redirect()->route('secondary-education')->with('success', 'Secondary Education Information Added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(SecondaryEducation $secondaryEducation)
    {
        return view('education-backgrounds.details' , compact('secondaryEducation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SecondaryEducation $secondaryEducation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SecondaryEducation $secondaryEducation)
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
        $secondaryEducation->user_id = $user_id;

        // Format the start_date before saving
        if ($request->has('start_date')) {
            try {
                $secondaryEducation->start_date = Carbon::createFromFormat('Y-m-d', $request->input('start_date'))->format('Y-m-d');
            } catch (\Exception $e) {
                return back()->withErrors(['start_date' => 'Invalid date format. Please use YYYY-MM-DD.']);
            }
        }

        $secondaryEducation->end_date = $request->input('end_date');
        $secondaryEducation->institution_name = $request->input('institution_name');
        $secondaryEducation->country = $request->input('country');
        $secondaryEducation->major_subject = $request->input('major_subject');
        $secondaryEducation->award = $request->input('award');
        $secondaryEducation->study_in_china = $request->input('study_in_china');

        // Handle image upload if present
        if ($request->hasFile('image_path')) {
            $upload_file = uniqid() . '.' . $request->image_path->extension();
            $request->image_path->move(public_path('images'), $upload_file);
            $image_url = asset('images/' . $upload_file);

            // Delete the old image if a new one is uploaded
            if (file_exists(public_path(parse_url($secondaryEducation->image_path, PHP_URL_PATH)))) {
                unlink(public_path(parse_url($secondaryEducation->image_path, PHP_URL_PATH)));
            }

            $secondaryEducation->image_path = $image_url;
        }

        $secondaryEducation->save();

        Alert::toast('Data updated successfully!', 'success');

        return redirect()->route('secondary-education')->with('success', 'Secondary Education Information Updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SecondaryEducation $secondaryEducation)
    {
        //
    }
}
