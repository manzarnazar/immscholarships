<?php

namespace App\Http\Controllers;

use App\Models\Attachments;
use App\Models\Students;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Response;
use RealRashid\SweetAlert\Facades\Alert;

class AttachmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $studentLevel = Students::pluck('highest_education')->first();

        return view("attachments.index_new", compact('studentLevel'));
    }

    public function fetchAttachments(Request $request)
{
    $userId = auth()->user()->id;
    $search = $request->get('search', '');
    $entriesPerPage = $request->get('entriesPerPage', 10);

    $query = Attachments::where('user_id', $userId);

    if ($search) {
        $query->where(function ($q) use ($search) {
            $q->where('study_plan', 'LIKE', "%{$search}%")
                ->orWhere('bank_statement', 'LIKE', "%{$search}%")
                ->orWhere('recomendation_letter', 'LIKE', "%{$search}%")
                ->orWhere('police_clearance', 'LIKE', "%{$search}%")
                ->orWhere('physical_exam', 'LIKE', "%{$search}%")
                ->orWhere('cv', 'LIKE', "%{$search}%")
                ->orWhere('medical_form', 'LIKE', "%{$search}%");
        });
    }

    $attachments = $query->orderBy('created_at', 'desc')->paginate($entriesPerPage);

    return response()->json([
        'data' => view('attachments.attachments-data', compact('attachments'))->render(),
        'pagination' => view('layout.components.pagination', ['paginator' => $attachments])->render(),
        'from' => $attachments->firstItem(),
        'to' => $attachments->lastItem(),
        'total' => $attachments->total(),
    ]);
}


    public function download(){
          $filePath = public_path('medical-report.pdf');
      
        return Response::download($filePath);
    }

    public function Bachelordownload(){
        $filePath = public_path('Bachelor-form.docx');
        return Response::download($filePath);
    }

    public function Mastersdownload(){
        $filePath = public_path('Masters-form.docx');
        return Response::download($filePath);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $studentLevel = Students::pluck('highest_education')->first();
          $attachment = Attachments::where('user_id', auth()->user()->id)->first();
     
        return view("attachments.details", compact("studentLevel",'attachment'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $commonRules = [
            'study_plan' => 'file|mimes:pdf|max:5000',
            'bank_statement' => 'file|mimes:pdf|max:5000',
            'recomendation_letter' => 'file|max:5000',
            'police_clearance' => 'file|max:5000',
            'cv' => 'file|max:5000',
            'physical_exam' => 'nullable|file|max:5000',
            'medical_form' => 'file|max:5000',
            'Chinese_Certificate' => 'nullable|file|mimes:pdf|max:5000',
            'English_Certificate' => 'nullable|file|mimes:pdf|max:5000',
            'Achievements_Certificate' => 'nullable|file|mimes:pdf|max:5000',
            'Highest_Transcript'=> 'file|mimes:pdf|max:5000',
        ];



        $validator = Validator::make($request->all(), $commonRules);

        if ($validator->fails()) {
 $errors = $validator->errors();

            Alert::toast('All Documents Required', 'error');

           return redirect()->back()->withErrors($errors)->withInput();


        }


        $user_id = auth()->id();
        $attachments = new Attachments;
        $attachments->id = Str::uuid();
        $attachments->user_id = $user_id;

      

        //---- studyplan
        $studyPlanUrl = null;
if ($request->hasFile('study_plan')) {
        $upload_file = uniqid() . '.' . $request->study_plan->extension();
        $request->study_plan->move(public_path('images'), $upload_file);
        $studyPlanUrl = asset('images/' . $upload_file);
}
        //----- Bank statement
 $bankStatementUrl = null;
if ($request->hasFile('bank_statement')) {
        $bankStatement = uniqid() . '.' . $request->bank_statement->extension();
        $request->bank_statement->move(public_path('images'), $bankStatement);
        $bankStatementUrl = asset('images/' . $bankStatement);
}
        //------rLetter
 $rLetterUrl = null;
if ($request->hasFile('recomendation_letter')) {
        $rLetter = uniqid() . '.' . $request->recomendation_letter->extension();
        $request->recomendation_letter->move(public_path('images'), $rLetter);
        $rLetterUrl = asset('images/' . $rLetter);
}
        //--------- police clearance
         $policeClearanceUrl = null;
if ($request->hasFile('police_clearance')) {
        $policeClearance = uniqid() . '.' . $request->police_clearance->extension();
        $request->police_clearance->move(public_path('images'), $policeClearance);
        $policeClearanceUrl = asset('images/' . $policeClearance);
}
        //----study cv
         $studentCvUrl = null;
if ($request->hasFile('cv')) {
        $studentCv = uniqid() . '.' . $request->cv->extension();
        $request->cv->move(public_path('images'), $studentCv);
        $studentCvUrl = asset('images/' . $studentCv);
}
        //---- physical exam
        // $physicalExam = uniqid() . '.' . $request->physical_exam->extension();
        // $request->physical_exam->move(public_path('images'), $physicalExam);
        // $physicalExamUrl = asset('images/' . $physicalExam);


        //---- medical form
         $medicalFormUrl = null;
if ($request->hasFile('medical_form')) {
        $medicalForm = uniqid() . '.' . $request->medical_form->extension();
        $request->medical_form->move(public_path('images'), $medicalForm);
        $medicalFormUrl = asset('images/' . $medicalForm);

}
// Highest_Transcript
                 $Highest_TranscriptFormUrl = null;
if ($request->hasFile('Highest_Transcript')) {
         $Highest_Transcript = uniqid() . '.' . $request->Highest_Transcript->extension();
        $request->Highest_Transcript->move(public_path('images'), $Highest_Transcript);
        $Highest_TranscriptFormUrl = asset('images/' . $Highest_Transcript);

}
         //---- Chinese_Certificate form
       
$Chinese_CertificateUrl = null;
if ($request->hasFile('Chinese_Certificate')) {
        $Chinese_Certificate = uniqid() . '.' . $request->Chinese_Certificate->extension();
        $request->Chinese_Certificate->move(public_path('images'), $Chinese_Certificate);
        $Chinese_CertificateUrl = asset('images/' . $Chinese_Certificate);
}

         //---- English_Certificate form
$English_CertificateUrl = null;
if ($request->hasFile('English_Certificate')) {
        $English_Certificate = uniqid() . '.' . $request->English_Certificate->extension();
        $request->English_Certificate->move(public_path('images'), $English_Certificate);
        $English_CertificateUrl = asset('images/' . $English_Certificate);
}

         //---- Achievements_Certificate form
$Achievements_CertificateUrl = null;
if ($request->hasFile('Achievements_Certificate')) {
        $Achievements_Certificate = uniqid() . '.' . $request->Achievements_Certificate->extension();
        $request->Achievements_Certificate->move(public_path('images'), $Achievements_Certificate);
        $Achievements_CertificateUrl = asset('images/' . $Achievements_Certificate);
}


        // $studyPlanUrl = Storage::url($studyPlan);
        // $bankStatementUrl = Storage::url($bankStatement);
        // $rLetterUrl = Storage::url($rLetter);
        // $policeClearanceUrl = Storage::url($policeClearance);
        // $studentCvUrl = Storage::url($studentCv);
        // $physicalExamUrl = Storage::url($physicalExam);
        // $medicalFormUrl = Storage::url($medicalForm);


        //save url to DB
        $attachments->study_plan = $studyPlanUrl;
        $attachments->police_clearance = $policeClearanceUrl;
        $attachments->cv = $studentCvUrl;

        $attachments->bank_statement = $bankStatementUrl;
        // $attachments->physical_exam = $physicalExamUrl;
        $attachments->recomendation_letter = $rLetterUrl;
        $attachments->medical_form = $medicalFormUrl;
        $attachments->Chinese_Certificate = $Chinese_CertificateUrl;
        $attachments->English_Certificate = $English_CertificateUrl;
        $attachments->Achievements_Certificate = $Achievements_CertificateUrl;
        $attachments->Highest_Transcript=$Highest_TranscriptFormUrl;


        $attachments->save();

        Alert::toast('Data saved successfully', 'success');


        return redirect()->route('attachments-create')->with('success', 'Attachment Uploaded Successfully!');


    }

    /**
     * Display the specified resource.
     */
    public function show(Attachments $attachments)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Attachments $attachments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Attachments $attachments)
    {

    $commonRules = [
        'study_plan' => 'nullable|file|mimes:pdf|max:5000',
        'bank_statement' => 'nullable|file|mimes:pdf|max:5000',
        'recomendation_letter' => 'nullable|file|max:5000',
        'police_clearance' => 'nullable|file|max:5000',
        'cv' => 'nullable|file|max:5000',
        'physical_exam' => 'nullable|file|max:5000',
        'medical_form' => 'nullable|file|max:5000',
        'Chinese_Certificate' => 'nullable|file|max:5000',
        'English_Certificate' => 'nullable|file|max:5000',
        'Achievements_Certificate' => 'nullable|file|max:5000',
        'Highest_Transcript' => 'nullable|file|mimes:pdf|max:5000',
    ];

    $validator = Validator::make($request->all(), $commonRules);

    if ($validator->fails()) {
        // dd($validator->errors()->toArray()); // Get errors in an array format
        Alert::toast('Invalid document format or size.', 'error');
        return redirect()->back();
    }
    $id=$attachments->id;

    $attachments = Attachments::findOrFail($id);
    
    $uploadPath = public_path('images');

    // Handle file uploads only if a new file is provided
    if ($request->hasFile('study_plan')) {
        $upload_file = uniqid() . '.' . $request->study_plan->extension();
        $request->study_plan->move($uploadPath, $upload_file);
        $attachments->study_plan = asset('images/' . $upload_file);
    }

    if ($request->hasFile('bank_statement')) {
        $bankStatement = uniqid() . '.' . $request->bank_statement->extension();
        $request->bank_statement->move($uploadPath, $bankStatement);
        $attachments->bank_statement = asset('images/' . $bankStatement);
    }

    if ($request->hasFile('recomendation_letter')) {
        $rLetter = uniqid() . '.' . $request->recomendation_letter->extension();
        $request->recomendation_letter->move($uploadPath, $rLetter);
        $attachments->recomendation_letter = asset('images/' . $rLetter);
    }

    if ($request->hasFile('police_clearance')) {
        $policeClearance = uniqid() . '.' . $request->police_clearance->extension();
        $request->police_clearance->move($uploadPath, $policeClearance);
        $attachments->police_clearance = asset('images/' . $policeClearance);
    }

    if ($request->hasFile('cv')) {
        $studentCv = uniqid() . '.' . $request->cv->extension();
        $request->cv->move($uploadPath, $studentCv);
        $attachments->cv = asset('images/' . $studentCv);
    }

    if ($request->hasFile('medical_form')) {
        $medicalForm = uniqid() . '.' . $request->medical_form->extension();
        $request->medical_form->move($uploadPath, $medicalForm);
        $attachments->medical_form = asset('images/' . $medicalForm);
    }


 if ($request->hasFile('Highest_Transcript')) {
        $Highest_Transcript = uniqid() . '.' . $request->Highest_Transcript->extension();
        $request->Highest_Transcript->move($uploadPath, $Highest_Transcript);
        $attachments->Highest_Transcript = asset('images/' . $Highest_Transcript);
    }


    if ($request->hasFile('Chinese_Certificate')) {
        $Chinese_Certificate = uniqid() . '.' . $request->Chinese_Certificate->extension();
        $request->Chinese_Certificate->move($uploadPath, $Chinese_Certificate);
        $attachments->Chinese_Certificate = asset('images/' . $Chinese_Certificate);
    }

    if ($request->hasFile('English_Certificate')) {
        $English_Certificate = uniqid() . '.' . $request->English_Certificate->extension();
        $request->English_Certificate->move($uploadPath, $English_Certificate);
        $attachments->English_Certificate = asset('images/' . $English_Certificate);
    }

    if ($request->hasFile('Achievements_Certificate')) {
        $Achievements_Certificate = uniqid() . '.' . $request->Achievements_Certificate->extension();
        $request->Achievements_Certificate->move($uploadPath, $Achievements_Certificate);
        $attachments->Achievements_Certificate = asset('images/' . $Achievements_Certificate);
    }

    $attachments->save();

    Alert::toast('Data updated successfully', 'success');

    return redirect()->route('attachments-create')->with('success', 'Attachment Updated Successfully!');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attachments $attachments)
    {
        //
    }
}
