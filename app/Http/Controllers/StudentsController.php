<?php

namespace App\Http\Controllers;

use App\Models\Attachments;
use App\Models\ContactInfoApplicant;
use App\Models\ContactInfoHome;
use App\Models\DegreeEducation;
use App\Models\MasterEducation;
use App\Models\DiplomaEducation;
use App\Models\FinancialSupporter;
use App\Models\Guarantor;
use App\Models\Passports;
use App\Models\SecondaryEducation;
use App\Models\Students;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Hash;
class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        return view('basic-info.index');
    }

    public function fetchStudents(Request $request)
    {
        $userId = auth()->user()->id;
        $search = $request->get('search');
        $entriesPerPage = $request->get('entriesPerPage', 10);

        $query = Students::where('user_id', $userId);

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('first_name', 'LIKE', "%$search%")
                    ->orWhere('last_name', 'LIKE', "%$search%");
            });
        }

        $students = $query->orderBy("created_at", "desc")->paginate($entriesPerPage);

        $data = view('basic-info.student-data', compact('students'))->render();
        $pagination = view('basic-info.pagination', compact('students'))->render();

        return response()->json([
            'data' => $data,
            'pagination' => $pagination,
            'total' => $students->total(),
            'from' => $students->firstItem(),
            'to' => $students->lastItem(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $userId = $request->user()->id;

        // Check if a student already exists for this user
        $existingStudent = Students::where('user_id', $userId)->first();

        if ($existingStudent) {
            Alert::toast('Student already exists for this user','error');
            return redirect()->route('basic-info');
        }
        return view('basic-info.details');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Check if the user already has a student record
        $userRecord = User::find(auth()->id());
        $existingStudent = Students::where('user_id', $userRecord->id)->first();

        if ($existingStudent) {
            Alert::toast('You have already created your details!', 'error');
            return redirect()->back()->with('error', 'You have already created your details!');
        }

        $validator = Validator::make($request->all(), [
            'fname' => 'required|string',
            // 'mname' => 'required|string',
            'lname' => 'required',
            'gender' => 'required',
            'dob' => 'required',
            'country_origin' => 'required',
            'country_of_birth' => 'required',
            'place_of_birth' => 'required',
            'highest_education' => 'required',
            'native_language' => 'required',
            'religion' => 'required',
            'marital_status' => 'required',
            'health_status' => 'required',
            'current_address' => 'required',
            'current_city' => 'required',
            'available_in_china' => 'required',
            'mobile' => 'required',
            'image_path' => 'required|file|image',
        ]);

        if ($validator->fails()) {
            Alert::toast('All data is required!', 'error');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $student = new Students;

        if ($request->hasFile('image_path')) {
            $upload_file = uniqid() . '.' . $request->image_path->extension();
            $request->image_path->move(public_path('images'), $upload_file);
            $image_url = asset('images/' . $upload_file);
            $student->image_path = $image_url;
        }

        $student->id = Str::uuid();
        $student->first_name = $request->fname;
        $student->middle_name = $request->mname;
        $student->last_name = $request->lname;
        $student->gender = $request->gender;
        $student->dob = $request->dob;
        $student->country_origin = $request->country_origin;
        $student->country_of_birth = $request->country_of_birth;
        $student->place_of_birth = $request->place_of_birth;
        $student->chinese_name = $request->chinese_name;
        $student->highest_education = $request->highest_education;
        $student->native_language = $request->native_language;
        $student->religion = $request->religion;
        $student->marital_status = $request->marital_status;
        $student->profession = $request->profession;
        $student->hobby = $request->hobby;
        $student->health_status = $request->health_status;
        $student->current_address = $request->current_address;
        $student->current_city = $request->current_city;
        $student->available_in_china = $request->available_in_china;
        $student->mobile = $request->mobile;

        $student->user_id = $userRecord->id;
        $student->save();

        Alert::toast('Data saved successfully!', 'success');
        return redirect()->route('basic-info')->with('success', 'Personal Details Saved!');
    }



    /**
     * Display the specified resource.
     */
    public function show(Students $student)
    {
        // dd($student);
        return view('basic-info.details',compact('student'));
    }

    public function profile()
    {

        $studentId = auth()->id();
        $student = Students::where('user_id', $studentId)->get(); //get student info
        $passport = Passports::where('user_id', $studentId)->get(); //get passport info
        $secondaryEducation = SecondaryEducation::where('user_id', $studentId)->get(); //get secondary education info
        $diplomaEducation = DiplomaEducation::where('user_id', $studentId)->get(); //get diploma education info
        $degreeEducation = DegreeEducation::where('user_id', $studentId)->get(); //get diploma education info
        $guarantorInfo = Guarantor::where('user_id', $studentId)->get(); //get diploma education info
        $financialSupporter = FinancialSupporter::where('user_id', $studentId)->get(); //get financial supporter education info
        $applicantContact = ContactInfoApplicant::where('user_id', $studentId)->get(); //get financial supporter education info
        $applicantHome = ContactInfoHome::where('user_id', $studentId)->get(); //get financial supporter education info
        $attachments = Attachments::where('user_id', $studentId)->get();

        return view('basic-info.profile', compact('attachments','applicantHome', 'applicantContact', 'student', 'passport', 'secondaryEducation', 'diplomaEducation', 'degreeEducation', 'guarantorInfo', 'financialSupporter'));
    }


    public function updateEducationLevel(Request $request)
{
    
    $request->validate([
        'education_level' => 'required|string',
    ]);

    auth()->user()->update([
        'education_level' => $request->education_level,
    ]);

    return redirect()->route('dashboard.home')->with('success', 'Education level updated successfully!');
}



    public function studentView(Request $request)
    {
        // Fetching the search term and entries per page from the request
        $search = $request->get('search', '');
        $entriesPerPage = $request->get('entriesPerPage', 10);

        // Start building the query for the User model (students only)
        $query = User::where('user_type', 'student');

        // Apply search filters if search term is present
        if ($search) {
            $query->where(function ($q) use ($search) {
                // Search by student name
                $q->where('name', 'LIKE', "%{$search}%")
                  // Search by student email
                  ->orWhere('email', 'LIKE', "%{$search}%");
            });
        }

        // Paginate the results
        $students = $query->orderBy('created_at', 'desc')->paginate($entriesPerPage);

        // If the request is expecting JSON (e.g., AJAX call), return only the data part
        if ($request->ajax()) {
            // Render the table data HTML and pagination HTML
            $html = view('students.partials._table_data', compact('students'))->render();
            $pagination = view('layout.components.pagination', ['paginator' => $students])->render();

            // Return the rendered HTML as a JSON response
            return response()->json([
                'data' => $html,
                'pagination' => $pagination,
                'from' => $students->firstItem(),
                'to' => $students->lastItem(),
                'total' => $students->total()
            ]);
        }

        // If it's not an AJAX request, return the normal view
        return view('students.index', compact('students', 'search', 'entriesPerPage'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Students $students)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Students $student)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'fname' => 'required|string',
            'mname' => 'required|string',
            'lname' => 'required',
            'gender' => 'required',
            'dob' => 'required',
            'country_origin' => 'required',
            'country_of_birth' => 'required',
            'place_of_birth' => 'required',
            'highest_education' => 'required',
            'native_language' => 'required',
            'religion' => 'required',
            'marital_status' => 'required',
            'health_status' => 'required',
            'current_address' => 'required',
            'current_city' => 'required',
            'available_in_china' => 'required',
            'mobile' => 'required',
            'image_path' => 'nullable|file|image',
        ]);

        if ($validator->fails()) {
            Alert::toast('All data is required!', 'error');
            return redirect()->back();
        }

        if ($request->hasFile('image_path')) {
            // Delete the old image if it exists
            if ($student->image_path) {
                $oldImagePath = public_path('images') . '/' . basename($student->image_path);
                if (\File::exists($oldImagePath)) {
                    \File::delete($oldImagePath);
                }
            }

            $upload_file = uniqid() . '.' . $request->image_path->extension();
            $request->image_path->move(public_path('images'), $upload_file);
            $image_url = asset('images/' . $upload_file);
            $student->image_path = $image_url;
            // dd($image_url);
        }
        // dd($request->all());


        $student->first_name = $request->fname;
        $student->middle_name = $request->mname;
        $student->last_name = $request->lname;
        $student->gender = $request->gender;
        $student->dob = $request->dob;
        $student->country_origin = $request->country_origin;
        $student->country_of_birth = $request->country_of_birth;
        $student->place_of_birth = $request->place_of_birth;
        $student->chinese_name = $request->chinese_name;
        $student->highest_education = $request->highest_education;
        $student->native_language = $request->native_language;
        $student->religion = $request->religion;
        $student->marital_status = $request->marital_status;
        $student->profession = $request->profession;
        $student->hobby = $request->hobby;
        $student->health_status = $request->health_status;
        $student->current_address = $request->current_address;
        $student->current_city = $request->current_city;
        $student->available_in_china = $request->available_in_china;
        $student->mobile = $request->mobile;

        $student->save();

        Alert::toast('Data saved successfully!', 'success');
        return redirect()->route('basic-info')->with('success', 'Personal Details Saved!');
    }



    public function updateProfile(Request $request)
{
     
           $validator = Validator::make($request->all(), [
           'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            Alert::toast('All data is required!', 'error');
            return redirect()->back();
        }
    $user = Auth::user();


    $user->name = $request->name;
    $user->email = $request->email;


    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('profile_images', 'public');
        $user->profile_image = $imagePath;
    }

   


    if ($request->hasFile('image')) {
           

            $upload_file = uniqid() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $upload_file);
            $image_url = asset('images/' . $upload_file);
             $user->profile_image  = $image_url;
          
        }

             $user->save();
              Alert::toast('Profile updated successfully!', 'success');
    return redirect()->back()->with('success', 'Profile updated successfully.');
}


    /**
     * Remove the specified resource from storage.
     */
    public function studentdelete($id)
    {
        
          
       $User = User::findOrFail($id); 

    $User->delete();
       Alert::toast('Data saved successfully!', 'success');
        return redirect()->route('admin-students-list')->with('success', 'Delete Successfully!');
    }


 public function updatePasswordView()
    {
      
        return view('basic-info.password_update');
    }


    public function updatePassword(Request $request)
{
   
   

         $validator = Validator::make($request->all(), [
            'current_password' => 'required|string',
                 'new_password' => 'required|string|min:8|confirmed',
        ]);
            if ($validator->fails()) {
       
        foreach ($validator->errors()->all() as $error) {
            Alert::toast($error, 'error');
        }

       
        return redirect()->back()->withErrors($validator)->withInput();
    }
   
    if (!Hash::check($request->current_password, Auth::user()->password)) {
        
         Alert::toast('Current password is incorrect!', 'error');
        return back()->withErrors(['current_password' => 'Current password is incorrect.']);
    }

    Auth::user()->password = Hash::make($request->new_password);
    Auth::user()->save();
      Alert::toast('Password updated successfully!', 'success');
    return redirect()->back()->with('success', 'Password updated successfully.');
}



    // SIde Menu functions
    public static function hasBasicInfo()
    {
        return !is_null(Auth::user()->basicInfo);
    }

    public static function hasPassportInfo()
    {
        return !is_null(Auth::user()->passportInfo);
    }

    public static function hasEnglishAbility()
    {
        return !is_null(Auth::user()->englishAbility);
    }

    public static function hasChineseAbility()
    {
        return !is_null(Auth::user()->chineseAbility);
    }

    public static function hasDegreeEducation()
    {
        return !is_null(Auth::user()->degreeEducation);
    }

         public static function hasMasterEducation()
            {
                   
                return !is_null(Auth::user()->MasterEducation);
            }


    

    public static function hasDiplomaEducation()
    {
        return !is_null(Auth::user()->diplomaEducation);
    }

    public static function hasSecondaryEducation()
    {

        return !is_null(Auth::user()->secondaryEducation);
    }

    public static function hasFamilyBackground()
    {
        return !is_null(Auth::user()->familyBackground);
    }

    public static function hasFinancialSupporter()
    {
        return !is_null(Auth::user()->financialSupporter);
    }

    public static function hasContactInfoApplicant()
    {
        return !is_null(Auth::user()->contactInfoApplicant);
    }

    public static function hasContactInfoHome()
    {
        return !is_null(Auth::user()->contactInfoHome);
    }

    public static function hasAttachments()
    {
        return Auth::user()->attachments()->exists();
    }

    public static function hasProgram()
    {
        return !is_null(Auth::user()->program);
    }

    public static function hasScholarships()
    {
        return Auth::user()->scholarships()->exists();
    }

}
