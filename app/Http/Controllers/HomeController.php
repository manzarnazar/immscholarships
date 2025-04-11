<?php

namespace App\Http\Controllers;

use App\Models\ApplyScholarship;
use App\Models\Category;
use App\Models\Institutions;
use App\Models\Scholarships;
use App\Models\Students;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Transactions;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categoryCount = Category::count();
        $studentsCount = User::where('user_type','student')->count();
        $scholarshipsCount = Scholarships::count();

        $studentInfo = Students::where('user_id',auth()->user()->id)->get();

            $applyScholarships = ApplyScholarship::where('student_id', auth()->user()->id) ->with('scholarship') // Load the related scholarship
    ->first();



        $applicationsCountPending = ApplyScholarship::where('student_id',auth()->user()->id)->where('status','pending')->count();
        $applicationsCountApproved = ApplyScholarship::where('student_id',auth()->user()->id)->where('status','approved')->count();

 $ForadminapplicationsCountPending = ApplyScholarship::where('status','pending')->count();
        $ForadminapplicationsCountApproved = ApplyScholarship::where('status','approved')->count();
        $ForadminapplicationsCountRejected = ApplyScholarship::where('status','rejected')->count();

        //registered institutions
        $institutionCount = Institutions::count();

        $applicationsCountPendingUser = ApplyScholarship::where('student_id',auth()->user()->id)->where('status','pending')->count();
        $applicationsCountApprovedUser = ApplyScholarship::where('student_id',auth()->user()->id)->where('status','approved')->count();
        $applicationsCountRejectedUser = ApplyScholarship::where('student_id',auth()->user()->id)->where('status','rejected')->count();

        $applicationsCountUser = ApplyScholarship::where('student_id',auth()->user()->id)->count();
           $totalbalance = Transactions::where('status', 'successful')->sum('amount');

        return view('home.home', compact('institutionCount','ForadminapplicationsCountRejected','applicationsCountRejectedUser','studentInfo','categoryCount','studentsCount','scholarshipsCount','applicationsCountPending','applicationsCountApproved','applicationsCountPendingUser','applicationsCountApprovedUser','applicationsCountUser','applyScholarships','ForadminapplicationsCountPending','ForadminapplicationsCountApproved','totalbalance'));
    }



        public function ProgramSelection()
    {
        $categoryCount = Category::count();
        $studentsCount = User::where('user_type','student')->count();
        $scholarshipsCount = Scholarships::count();

        $studentInfo = Students::where('user_id',auth()->user()->id)->get();

        $applicationsCountPending = ApplyScholarship::where('status','pending')->count();
        $applicationsCountApproved = ApplyScholarship::where('status','approved')->count();

        //registered institutions
        $institutionCount = Institutions::count();

        $applicationsCountPendingUser = ApplyScholarship::where('student_id',auth()->user()->id)->where('status','pending')->count();
        $applicationsCountApprovedUser = ApplyScholarship::where('student_id',auth()->user()->id)->where('status','approved')->count();
        $applicationsCountRejectedUser = ApplyScholarship::where('student_id',auth()->user()->id)->where('status','rejected')->count();

        $applicationsCountUser = ApplyScholarship::where('student_id',auth()->user()->id)->count();


        return view('home.ProgramSelection', compact('institutionCount','applicationsCountRejectedUser','studentInfo','categoryCount','studentsCount','scholarshipsCount','applicationsCountPending','applicationsCountApproved','applicationsCountPendingUser','applicationsCountApprovedUser','applicationsCountUser'));
    }
}
