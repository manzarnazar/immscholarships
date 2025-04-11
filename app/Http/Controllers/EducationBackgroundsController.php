<?php

namespace App\Http\Controllers;

use App\Models\DegreeEducation;
use App\Models\DiplomaEducation;
use App\Models\EducationBackgrounds;
use App\Models\HighSchoolEducation;
use App\Models\SecondaryEducation;
use App\Models\Students;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class EducationBackgroundsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //get highest level of education for student
        $studentLevel = Students::pluck('highest_education')->first();
        return view('education-backgrounds.index', compact('studentLevel'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $studentLevel = Students::pluck('highest_education')->first();
        return view('education-backgrounds.create', compact('studentLevel'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        // Validation Rules
        $commonRules = [
            's_start_date' => 'required|date',
            's_end_date' => 'required|date',
            's_institution_name' => 'required',
            's_country' => 'required',
            's_course' => 'required',
            's_award' => 'required',
            'dip_start_date' => 'required|date',
            'dip_end_date' => 'required|date',
            'dip_institution_name' => 'required',
            'dip_country' => 'required',
            'dip_course' => 'required',
            'dip_award' => 'required',
        ];

        $validator = Validator::make($request->all(), $commonRules);

        if ($validator->fails()) {
            return redirect()->back();
        }

        $user_id = auth()->id();
        $secondaryEducation = new SecondaryEducation;
        $secondaryEducation->id = Str::uuid();
        $secondaryEducation->user_id = $user_id;

        $secondaryEducation->start_date = $request->input('s_start_date');
        $secondaryEducation->end_date = $request->input('s_end_date');
        $secondaryEducation->institution_name = $request->input('s_institution_name');
        $secondaryEducation->country = $request->input('s_country');
        $secondaryEducation->major_subject = $request->input('s_course');
        $secondaryEducation->award = $request->input('s_award');

        $secondaryEducation->save();

        if ($request->education_level == 'degree') {
            $validator = Validator::make($request->all(), [
                'h_start_date' => 'required|date',
                'h_end_date' => 'required|date',
                'h_institution_name' => 'required',
                'h_country' => 'required',
                'h_course' => 'required',
                'h_award' => 'required',
                'dip_start_date' => 'required|date',
                'dip_end_date' => 'required|date',
                'dip_institution_name' => 'required',
                'dip_country' => 'required',
                'dip_course' => 'required',
                'dip_award' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect()->back();
            }

            // Insert Degree Education
            $degreeEducation = new DegreeEducation;
            $degreeEducation->id = Str::uuid();
            $degreeEducation->user_id = $user_id;
            $degreeEducation->start_date = $request->input('h_start_date');
            $degreeEducation->end_date = $request->input('h_end_date');
            $degreeEducation->institution_name = $request->input('h_institution_name');
            $degreeEducation->country = $request->input('h_country');
            $degreeEducation->major_subject = $request->input('h_course');
            $degreeEducation->award = $request->input('h_award');
            $degreeEducation->save();

            // Insert High School Education
            $highEducation = new HighSchoolEducation;
            $highEducation->id = Str::uuid();
            $highEducation->user_id = $user_id;
            $highEducation->start_date = $request->input('dip_start_date');
            $highEducation->end_date = $request->input('dip_end_date');
            $highEducation->institution_name = $request->input('dip_institution_name');
            $highEducation->country = $request->input('dip_country');
            $highEducation->major_subject = $request->input('dip_course');
            $highEducation->award = $request->input('dip_award');
            $highEducation->save();

            return redirect()->route('education-background')->with('success', 'Education Information Saved!');
        } elseif ($request->education_level == 'high-school') {
            $validator = Validator::make($request->all(), [
                // Validation rules for DiplomaEducation
                'dip_start_date' => 'required|date',
                'dip_end_date' => 'required|date',
                'dip_institution_name' => 'required',
                'dip_country' => 'required',
                'dip_course' => 'required',
                'dip_award' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect()->back();
            }

            // Insert Diploma Education
            $diplomaEducation = new DiplomaEducation;
            $diplomaEducation->id = Str::uuid();
            $diplomaEducation->user_id = $user_id;
            $diplomaEducation->start_date = $request->input('dip_start_date');
            $diplomaEducation->end_date = $request->input('dip_end_date');
            $diplomaEducation->institution_name = $request->input('dip_institution_name');
            $diplomaEducation->country = $request->input('dip_country');
            $diplomaEducation->major_subject = $request->input('dip_course');
            $diplomaEducation->award = $request->input('dip_award');
            $diplomaEducation->save();

            return redirect()->route('education-background')->with('success', 'Education Information Saved!');
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(EducationBackgrounds $educationBackgrounds)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EducationBackgrounds $educationBackgrounds)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EducationBackgrounds $educationBackgrounds)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EducationBackgrounds $educationBackgrounds)
    {
        //
    }
}
