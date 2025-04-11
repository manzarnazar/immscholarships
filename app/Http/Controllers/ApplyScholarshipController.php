<?php

namespace App\Http\Controllers;

use App\Mail\SendEmailNotification;
use App\Models\ApplyScholarship;
use App\Models\Scholarships;
use App\Models\User;
use App\Notifications\ScholarshipApplicationNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Attachments;
use Illuminate\Support\Facades\Log;
use App\Models\ContactInfoHome;
use App\Models\Transactions;
use App\Models\DiplomaEducation;
use App\Models\FinancialSupporter;
use App\Models\Guarantor;
use App\Models\Settings;
use App\Models\DegreeEducation;
use App\Models\HighSchoolEducation;
use App\Models\SecondaryEducation;
use App\Models\MasterEducation;
use App\Models\ChineseAbility;
use App\Models\EnglishAbility;
use App\Models\Students;
use App\Models\FamilyBackground;
use App\Models\ContactInfoApplicant;
use Illuminate\Support\Facades\Auth;
use App\Notifications\ScholarshipStatusChanged;
use App\Models\Refferals;
use App\Models\Wallets;
use App\Models\Institutions;
class ApplyScholarshipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $applyScholarships = ApplyScholarship::where('student_id', auth()->user()->id)->paginate(10);
        return view("scholarships.mine_new", compact("applyScholarships"));
    }



    public function fetchapplyapplication($id)
    {
      
        $applyScholarships = ApplyScholarship::where('id', $id)->first();
        return view("scholarships.myapplication", compact("applyScholarships"));
    }


    public function admin(Request $request)
    {

        // Fetching the search term and entries per page from the request
        $search = $request->get('search', '');
        $entriesPerPage = $request->get('entriesPerPage', 10);

        // Start building the query for ApplyScholarship model
        $query = ApplyScholarship::query();

        // Apply search filters if search term is present
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('application_id', 'LIKE', "%{$search}%")
                  ->orWhereHas('user', function($query) use ($search) {
                      $query->where('name', 'LIKE', "%{$search}%")
                            ->orWhere('email', 'LIKE', "%{$search}%");
                  })
                  ->orWhere('status', 'LIKE', "%{$search}%");
            });
        }

        // Paginate the results
        $scholarshipList = $query->orderBy('created_at', 'desc')->paginate($entriesPerPage);

        // If the request is expecting JSON (e.g., AJAX call), return only the data part
        if ($request->ajax()) {
            $html = view('scholarships.partials._table_data_admin', compact('scholarshipList'))->render(); // Renders the table data HTML
            $pagination = view('layout.components.pagination', ['paginator' => $scholarshipList])->render(); // Renders pagination HTML

            // Return the rendered HTML as a JSON response
            return response()->json([
                'data' => $html,
                'pagination' => $pagination,
                'from' => $scholarshipList->firstItem(),
                'to' => $scholarshipList->lastItem(),
                'total' => $scholarshipList->total()
            ]);
        }

        // If it's not an AJAX request, return the normal view
        return view('scholarships.admin_new', compact('scholarshipList', 'search', 'entriesPerPage'));
    }





     public function applicationstatus(Request $request,$status = null)
    {
       
        // Fetching the search term and entries per page from the request
        $search = $request->get('search', '');
        $entriesPerPage = $request->get('entriesPerPage', 10);

        // Start building the query for ApplyScholarship model
        $query = ApplyScholarship::query();

                if (!empty($status)) {
            $query->where('status', $status);
        }

        // Apply search filters if search term is present
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('application_id', 'LIKE', "%{$search}%")
                  ->orWhereHas('user', function($query) use ($search) {
                      $query->where('name', 'LIKE', "%{$search}%")
                            ->orWhere('email', 'LIKE', "%{$search}%");
                  })
                  ->orWhere('status', 'LIKE', "%{$search}%");
            });
        }

        // Paginate the results
        $scholarshipList = $query->orderBy('created_at', 'desc')->paginate($entriesPerPage);

        // If the request is expecting JSON (e.g., AJAX call), return only the data part
        if ($request->ajax()) {
            $html = view('scholarships.partials._table_data_admin', compact('scholarshipList'))->render(); // Renders the table data HTML
            $pagination = view('layout.components.pagination', ['paginator' => $scholarshipList])->render(); // Renders pagination HTML

            // Return the rendered HTML as a JSON response
            return response()->json([
                'data' => $html,
                'pagination' => $pagination,
                'from' => $scholarshipList->firstItem(),
                'to' => $scholarshipList->lastItem(),
                'total' => $scholarshipList->total()
            ]);
        }

        // If it's not an AJAX request, return the normal view
        return view('scholarships.admin_applicationstatus', compact('scholarshipList', 'search', 'entriesPerPage','status'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
{
    return view('basic-info.details', [
        'layout' => $request->get('layout', 'side-menu'),
        'student' => null // ✅ This fixes the Blade error
    ]);
}



    /**
     * Store a newly created resource in storage.
     */
    public function store($id)
    {


         $userId = Auth::id();

    // Check required models
    $missingData = [];

    if (!Students::where('user_id', $userId)->exists()) {
        $missingData[] = 'Please Fill Personal information';
    }


    //     if (!EnglishAbility::where('user_id', $userId)->exists()) {
    //     $missingData[] = 'Please Fill English Proficiency information';
    // }
    

    // if (!ChineseAbility::where('user_id', $userId)->exists()) {
    //     $missingData[] = 'Please Fill chinese Proficiency information';
    // } 

    if (!ContactInfoApplicant::where('user_id', $userId)->exists()) {
        $missingData[] = 'Contact information (Applicant)';
    }

          if (!FamilyBackground::where('user_id', $userId)->exists()) {
        $missingData[] = 'Please Fill Family Bacground details';
    }

    $educationLevel  = Auth::user()->education_level ?? null;
        if ($educationLevel == 'Bachelor') {
    //     if (!SecondaryEducation::where('user_id', $userId)->exists()) {
    //     $missingData[] = 'Please Fill Secondary Education education details';
    // }
}
     if ($educationLevel == 'master' || $educationLevel == 'Bachelor') {
         if (!DiplomaEducation::where('user_id', $userId)->exists()) {
        $missingData[] = 'Please Fill High School Education/Diploma education details';
    }
}
     if ($educationLevel == 'master' || $educationLevel == 'PHD') {
    if (!DegreeEducation::where('user_id', $userId)->exists()) {
        $missingData[] = 'Please Fill Degree education details';
    }
}

        if ($educationLevel == 'PHD') {
         if (!MasterEducation::where('user_id', $userId)->exists()) {
                $missingData[] = 'Please Fill Master education details';
            }
        }


         
    // Check for missing attachments
$requiredAttachments = ['study_plan', 'bank_statement', 'recomendation_letter','police_clearance','cv','medical_form','Highest_Transcript']; // List required attachments
$missingAttachments = [];

$attachments = Attachments::where('user_id', $userId)->first();

if (!$attachments) {
    $missingAttachments = $requiredAttachments;
} else {
    foreach ($requiredAttachments as $attachment) {
        if (empty($attachments->$attachment)) {
            $missingAttachments[] = ucfirst(str_replace('_', ' ', $attachment)); // Format text (e.g., 'cv' -> 'Cv')
        }
    }
}

if (!empty($missingAttachments)) {
    $missingData[] = 'Missing Attachments: ' . implode(', ', $missingAttachments);
}

         
 if (count($missingData) > 0) {
        return redirect()->back()->withErrors([
            'message' => 'Please complete the following before applying:<br>' . implode('<br>', $missingData),
        ]);
    }
    // if (!ContactInfoHome::where('user_id', $userId)->exists()) {
    //     $missingData[] = 'Contact information (Home)';
    // }

   

    

    // if (!DiplomaEducation::where('user_id', $userId)->exists()) {
    //     $missingData[] = 'Diploma education details';
    // }

    // if (!FinancialSupporter::where('user_id', $userId)->exists()) {
    //     $missingData[] = 'Financial supporter details';
    // }

    // if (!Guarantor::where('user_id', $userId)->exists()) {
    //     $missingData[] = 'Guarantor information';
    // }


   




        $scholarshipId = $id;
    
       

        //  $institutionCount = Institutions::count();
        $studentId = auth()->user()->id;


          $existingApplication = ApplyScholarship::where('student_id', $studentId)
        ->exists();

    if ($existingApplication) {
        // Redirect back with an error message
          Alert::toast('You have already applied for the course .','error');
        return redirect()->route('student-scholarship-index')
            ->with('error', 'You have already applied for this course .');
    }

     $ScholarshipData =  Scholarships::where('id',$scholarshipId)->first();
      $InstitutionsData =  Institutions::where('id',$ScholarshipData->institution_id)->first();
      $staticApplicationfee ='450';
      if($InstitutionsData->education_level =='PHD'){
        $staticApplicationfee = '650';
      }
      if($InstitutionsData->education_level =='masters'){
        $staticApplicationfee = '550';
      }
    
        $currentYear = date('Y');
        $lastApplication = Scholarships::whereYear('created_at', $currentYear)
    ->latest('id')  // Get the latest entry
    ->value('id');  // Get only the ID

$count = $lastApplication ? ((int) substr($lastApplication, -3)) + 1 : 1;

$applicationID = "IMS-SCH-$currentYear-" . str_pad($count, 3, '0', STR_PAD_LEFT);

        $applyScholarship = new ApplyScholarship();

        //data
        $applyScholarship->id = Str::uuid();
        $applyScholarship->application_id = $applicationID;
        $applyScholarship->student_id = $studentId;
        $applyScholarship->scholarship_id = $scholarshipId;
         $applyScholarship->application_fee =  $staticApplicationfee;
        $studentName = auth()->user()->name;
        $email = auth()->user()->email;

        //$email = "salymphp@gmail.com";
        $imagePath = auth()->user()->basicInfo->image_path ?? '';
     //   Mail::to($email)->send(new SendEmailNotification($studentName,$applicationID));

        $admin = User::where('user_type', 'super-admin')->first();

        $admin->notify(new ScholarshipApplicationNotification($studentName, $applicationID,$imagePath));
        //----- Save Application
        $applyScholarship->save();

        return redirect()->route('student-scholarship-index')->with('success', '');
    }

    /**
     * Display the specified resource.
     */
    public function show(ApplyScholarship $applyScholarship)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ApplyScholarship $applyScholarship)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ApplyScholarship $applyScholarship)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ApplyScholarship $applyScholarship)
    {
        //
    }


    public function getFlutterwaveKeys()
{
    $publicKey = Settings::where('key_s', 'flutterwave_public_key')->value('value');
    $secretKey = Settings::where('key_s', 'flutterwave_secret_key')->value('value');
    $encryptionKey = Settings::where('key_s', 'Encryption_key')->value('value');

    return response()->json([
        'public_key' => $publicKey,
        'secret_key' => $secretKey,
        'encryption_key' => $encryptionKey,
    ]);
}

public function saveTransaction(Request $request)
{
    try {
        // // Log the incoming request
        // Log::info('Accessing saveTransaction endpoint', [
        //     'request_data' => $request->all(),
        // ]);

        $validated = $request->validate([
            'transaction_id' => 'required',
            'tx_ref' => 'required',
            'amount' => 'required|numeric',
            'currency' => 'required|string',
            'applicationId'=> 'nullable|string',
        ]);

        // Save transaction
        Transactions::create([
            'transaction_id' => (string)$validated['transaction_id'],
            'tx_ref' => $validated['tx_ref'],
            'amount' => $validated['amount'],
            'currency' => $validated['currency'],
            'user_id'=>auth()->user()->id,
            'applicationId'=> $validated['applicationId'],
        ]);

        // Log success message
        // Log::info('Transaction saved successfully', [
        //     'transaction_id' => $validated['transaction_id'],
        // ]);

        return response()->json(['success' => true]);
    } catch (\Exception $e) {
        // Log the exception
        Log::error('Error saving transaction', [
            'error_message' => $e->getMessage(),
            'request_data' => $request->all(),
        ]);

        return response()->json(['success' => false, 'message' => 'Failed to save transaction'], 500);
    }
}


    public function handlePayment(Request $request)
{
    $data = $request->all();
    $applyScholarships = ApplyScholarship::where('student_id', auth()->user()->id)->paginate(10);

    if ($data['status'] === 'successful') {

        // ✅ Define $application first
        $application = ApplyScholarship::where('id', $data['applicationId'])->first();

        Transactions::create([
            'transaction_id' => (string)$data['transaction_id'],
            'tx_ref' => $data['tx_ref'],
            'amount' => $application->application_fee, // ✅ Now this will work
            'currency' => 'USD',
            'user_id' => auth()->user()->id,
            'applicationId' => $data['applicationId'],
            'status' => $data['status']
        ]);

        $applicationID = ApplyScholarship::where('id', $data['applicationId'])->where('payment_status', 'unpaid')->first();
        $applicationID->payment_status = 'paid';
        $applicationID->save();

        $Refferal = Refferals::where('referred_id', auth()->user()->id)->first();
        if ($Refferal) {
            $Refferal->status = 'complete';
            $Refferal->save();

            $amount = $Refferal->commission;
            $referrer_user = $Refferal->referrer_id;

            $wallet = Wallets::where('user_id', $referrer_user)->first();
            if ($wallet) {
                $wallet->balance += $amount;
                $wallet->save();
            } else {
                Wallets::create([
                    'user_id' => $referrer_user,
                    'balance' => $amount,
                ]);
            }
        }
    }

    Alert::toast('Payment completed successfully!', 'success');
    return redirect()->route('student-scholarship-index')
        ->with('success', 'Payment completed successfully!');
}




     public function ReapplyScholarship(Request $request,$id)
    {
        $reason = $request->input('reason');
        $scholarship = ApplyScholarship::find($id);


        $scholarship->status = 'pending';
        
        $scholarship->save();

        $student = $scholarship->user;  // Access the related user (student)
         $student->notify(  new ScholarshipStatusChanged('Reapplied', $scholarship));



        Alert::toast('Application Reapplied!', 'success');

        return redirect()->back()->with('success', 'Application Reapplied');
    }

}
