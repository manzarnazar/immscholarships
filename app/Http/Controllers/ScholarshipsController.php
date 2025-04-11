<?php

namespace App\Http\Controllers;

use App\Models\ApplyScholarship;
use App\Models\Attachments;
use App\Models\ContactInfoApplicant;
use App\Models\ContactInfoHome;
use App\Models\DegreeEducation;
use App\Models\DiplomaEducation;
use App\Models\FinancialSupporter;
use App\Models\Guarantor;
use App\Models\Institutions;
use App\Models\Passports;
use App\Models\Scholarships;
use App\Models\SecondaryEducation;
use App\Models\Students;
use App\Notifications\ScholarshipStatusChanged;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Notification;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\FamilyBackground;
use App\Models\ChineseAbility;
use App\Models\EnglishAbility;
use App\Models\MasterEducation;
class ScholarshipsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Fetching the search term and entries per page from the request
        $search = $request->get('search', '');
        $entriesPerPage = $request->get('entriesPerPage', 10);

        // Start building the query for the Scholarships model
        $query = Scholarships::query();

        // Apply search filters if search term is present
        if ($search) {
            $query->where(function ($q) use ($search) {
                // Search for the scholarship title
                $q->where('title', 'LIKE', "%{$search}%")
                  // Search for the status of the scholarship
                  ->orWhere('status', 'LIKE', "%{$search}%")
                  // Search for the university name via the institution relationship
                  ->orWhereHas('institution', function ($query) use ($search) {
                      $query->where('name', 'LIKE', "%{$search}%");
                  });
            });
        }

        // Paginate the results
        $scholarships = $query->orderBy('created_at', 'desc')->paginate($entriesPerPage);

        // If the request is expecting JSON (e.g., AJAX call), return only the data part
        if ($request->ajax()) {
            // Render the table data HTML and pagination HTML
            $html = view('scholarships.partials._table_data', compact('scholarships'))->render();
            $pagination = view('layout.components.pagination', ['paginator' => $scholarships])->render();

            // Return the rendered HTML as a JSON response
            return response()->json([
                'data' => $html,
                'pagination' => $pagination,
                'from' => $scholarships->firstItem(),
                'to' => $scholarships->lastItem(),
                'total' => $scholarships->total()
            ]);
        }

        // If it's not an AJAX request, return the normal view
        return view('scholarships.index', compact('scholarships', 'search', 'entriesPerPage'));
    }

   public function printprogram(Request $request)
{
    $status = $request->get('status'); 

  
    $scholarships = Scholarships::when($status, function ($query, $status) {
        return $query->where('status', $status);
    })->get();

    return view('scholarships.print-scholarships', compact('scholarships'));
}


   public function all(Request $request, $type = null)
    {
   
        // if (!in_array($type, ['language', 'bachelor', 'masters'])) {
        //     return redirect()->route('home')->withErrors(['message' => 'Invalid scholarship type.']);
        // }

        $search = $request->get('search', '');
        $entriesPerPage = $request->get('entriesPerPage', 10);

        if ($type == 'language') {
            $type = 'language program';
        }
       
        $query = Scholarships::whereHas('institution', function ($query) use ($type) {
            $query->where('education_level', $type);
        });

        $query->where('status', 'AVAILABLE');
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                    ->orWhere('teaching_language', 'LIKE', "%{$search}%")
                    ->orWhereHas('institution', function ($query) use ($search) {
                        $query->where('name', 'LIKE', "%{$search}%")
                            ->orWhere('code', 'LIKE', "%{$search}%");
                    });
            });
        }

        $scholarships = $query->orderBy('created_at', 'desc')->paginate($entriesPerPage);


         // If the request is expecting JSON (e.g., AJAX call), return only the data part
         if ($request->ajax()) {
            // Render the table data HTML and pagination HTML
            $html = view('scholarships.all_data', compact('scholarships'))->render();
            $pagination = view('layout.components.pagination', ['paginator' => $scholarships])->render();

            // Return the rendered HTML as a JSON response
            return response()->json([
                'data' => $html,
                'pagination' => $pagination,
                'from' => $scholarships->firstItem(),
                'to' => $scholarships->lastItem(),
                'total' => $scholarships->total()
            ]);
        }
       
        return view('scholarships.all_new', compact('scholarships', 'type', 'search', 'entriesPerPage'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("scholarships.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'description' => 'required',
            'image_path' => 'required',
            'institution_id' => 'required',
            'teaching_language'=>'required'
        ]);

        if ($validator->fails()) {
            Alert::toast('All data is required!', 'error');

            return redirect()->back()->withErrors($validator)->withInput();
        }


        //------ Get Image path and store in public/images
        $imagePath = $request->file('image_path')->store('public/images');
        $imageUrl = Storage::url($imagePath); //---get image url from db

        $scholarships = new Scholarships;

        //ids
        $scholarships->id = Str::uuid();
        $scholarships->user_id = auth()->id();

        //english ability details
        $scholarships->title = $request->title;
        $scholarships->teaching_language = $request->teaching_language;


        $scholarships->description = html_entity_decode($request->description);
        $scholarships->image_path = $imageUrl; // Save the URL of the image
        $scholarships->institution_id = $request->institution_id;


        $scholarships->save();

        Alert::toast('Scholarship Created!', 'success');

        return redirect()->route('admin-scholarships')->with('success', 'Scholarship Details Saved');
    }


    /**
     * Display the specified resource.
     */
    public function view($id)
    {

        $scholarships = Scholarships::where('id', $id)->first();

        if ($scholarships) {
            // Retrieve the institution ID from the scholarship model
            $instId = $scholarships->institution_id;

            // Fetch the institution details based on the institution ID
            $institution = Institutions::find($instId);

            // Pass the scholarship and institution details to the view
            return view('scholarships.view_new', compact('scholarships', 'institution'));
        } else {
            // Handle case where scholarship with the given ID is not found
            return redirect()->back()->with('error', 'Scholarship not found');
        }
    }


 public function appliedscholar($id)
    {
      
        $scholarships = Scholarships::where('id', $id)->first();

        if ($scholarships) {
            // Retrieve the institution ID from the scholarship model
            $instId = $scholarships->institution_id;

            // Fetch the institution details based on the institution ID
            $institution = Institutions::find($instId);

            // Pass the scholarship and institution details to the view
            return view('scholarships.appliedscholar', compact('scholarships', 'institution'));
        } else {
            // Handle case where scholarship with the given ID is not found
            return redirect()->back()->with('error', 'Scholarship not found');
        }
    }


    public function myApplication($id)
    {
        $scholarApplication = ApplyScholarship::where('id', $id)->get();

        foreach ($scholarApplication as $scholar) {
            $studentId = $scholar->student_id;
        }

        $student = Students::where('user_id', $studentId)->get(); //get student info
        $passport = Passports::where('user_id', $studentId)->get(); //get passport info
        $secondaryEducation = SecondaryEducation::where('user_id', $studentId)->get(); //get secondary education info
        $diplomaEducation = DiplomaEducation::where('user_id', $studentId)->get(); //get diploma education info
        $degreeEducation = DegreeEducation::where('user_id', $studentId)->get(); //get diploma education info
          $MasterEducation = MasterEducation::where('user_id', $studentId)->get(); //get diploma education info
        $guarantorInfo = Guarantor::where('user_id', $studentId)->get(); //get diploma education info
        $financialSupporter = FinancialSupporter::where('user_id', $studentId)->get(); //get financial supporter education info
        $applicantContact = ContactInfoApplicant::where('user_id', $studentId)->get(); //get financial supporter education info
        $applicantHome = ContactInfoHome::where('user_id', $studentId)->get(); //get financial supporter education info

      $FamilyBackground = FamilyBackground::where('user_id', $studentId)->get();
        $ChineseAbility = ChineseAbility::where('user_id', $studentId)->get();
        $EnglishAbility = EnglishAbility::where('user_id', $studentId)->get();
      

       
        $attachments = Attachments::where('user_id', $studentId)->get();

        $applyScholarship = ApplyScholarship::where('student_id', $studentId)->get();



        return view('scholarships.application', compact('applyScholarship','attachments','applicantHome', 'applicantContact', 'scholarApplication', 'student', 'passport', 'secondaryEducation', 'diplomaEducation', 'degreeEducation', 'guarantorInfo', 'financialSupporter','FamilyBackground','ChineseAbility','EnglishAbility','MasterEducation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $course = Scholarships::find($id);

        return view('scholarships.edit', compact('course'));

    }

    public function updatedata(Request $request, $id)
{
  
    $validator = Validator::make($request->all(), [
        'title' => 'required|string',
        'description' => 'required',
        'image_path' => 'nullable|file|mimes:jpg,jpeg,png',
        'institution_id' => 'required',
        'teaching_language' => 'required',
        'status'=>'required'
    ]);

    if ($validator->fails()) {
        Alert::toast('All fields are required!', 'error');

        return redirect()->back()->withErrors($validator)->withInput();
    }

    // Retrieve the scholarship by ID
    $scholarships = Scholarships::findOrFail($id);

    // Update the fields
    $scholarships->title = $request->title;
    $scholarships->teaching_language = $request->teaching_language;
    $scholarships->description = html_entity_decode($request->description);
    $scholarships->institution_id = $request->institution_id;
    $scholarships->status = $request->status;

    // Check if a new image is uploaded
    if ($request->hasFile('image_path')) {
        // Delete the old image if it exists
        if ($scholarships->image_path) {
            $oldImagePath = str_replace('/storage', 'public', $scholarships->image_path);
            Storage::delete($oldImagePath);
        }

        // Store the new image and update the path
        $imagePath = $request->file('image_path')->store('public/images');
        $imageUrl = Storage::url($imagePath);
        $scholarships->image_path = $imageUrl;
    }

    $scholarships->save();

    Alert::toast('Scholarship Updated!', 'success');

    return redirect()->route('admin-scholarships')->with('success', 'Scholarship Details Updated');
}


    public function approveScholarship($id)
    {



        $scholarship = ApplyScholarship::find($id);
        $scholarship->status = 'approved';
        $scholarship->payment_status = 'unpaid';
        $scholarship->save();

        $userId = auth()->user()->id;
        // if($scholarship->student_id == $userId){

        //     //send Email
        //     $studentEmail = auth()->user()->email;

        //    Mail::to($studentEmail)->send("Your Scholarship Application has been approved!");
        // }
        $student = $scholarship->user;  // Access the related user (student)
        $student->notify(  new ScholarshipStatusChanged('approved', $scholarship));


        Alert::toast('Application Approved!', 'success');

        return redirect()->back()->with('success', 'Application Approved');
    }



    public function rejectScholarship(Request $request,$id)
    {
        $reason = $request->input('reason');
        $scholarship = ApplyScholarship::find($id);

        $scholarship->status = 'rejected';

        // Allow null values for rejection_reason
        $scholarship->rejection_reason = $reason ?: null;

        $scholarship->save();

        $student = $scholarship->user;  // Access the related user (student)
        $student->notify(  new ScholarshipStatusChanged('rejected', $scholarship));



        Alert::toast('Application Rejected!', 'success');

        return redirect()->back()->with('success', 'Application Rejected');
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //

        $request->validate([

            'course_title' => 'required|string',
            'status' => 'required|string',

        ]);


        $scholarships = Scholarships::findOrFail($id);
        $scholarships->update($request->all());

        return redirect()
        ->route('admin-scholarship-index')
        ->with('success', 'Scholarship Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $scholarships = Scholarships::findOrFail($id);
        $scholarships->delete();

        return redirect()->back()->with('success', 'Scholarship deleted successfully');
    }
}
