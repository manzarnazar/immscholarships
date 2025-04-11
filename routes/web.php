<?php

use App\Http\Controllers\ApplyScholarshipController;
use App\Http\Controllers\AttachmentsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChineseAbilityController;
use App\Http\Controllers\ContactInfoApplicantController;
use App\Http\Controllers\ContactInfoHomeController;
use App\Http\Controllers\DegreeEducationController;
use App\Http\Controllers\MasterEducationController;
use App\Http\Controllers\DiplomaEducationController;
use App\Http\Controllers\EducationBackgroundsController;
use App\Http\Controllers\EnglishAbilityController;
use App\Http\Controllers\FamilyBackgroundController;
use App\Http\Controllers\FinancialSupporterController;
use App\Http\Controllers\GuarantorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InstitutionsController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PassportsController;
use App\Http\Controllers\RaveController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\ReferralController;
use App\Http\Controllers\UserReferralController;
use App\Http\Controllers\ScholarshipsController;
use App\Http\Controllers\SecondaryEducationController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\WorkExperienceController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\DarkModeController;
use App\Http\Controllers\ColorSchemeController;
use App\Mail\SendEmailNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Auth\OtpController;
use App\Http\Controllers\WalletControlller;
use App\Http\Controllers\Admin\TransactionsController;
use App\Http\Controllers\Admin\WithdrawalController;
Route::get('/global-search', [SearchController::class, 'search'])->name('global.search');

// Route::get('/', function () {
//     return view('auth.login');
// });

// Route::get('/', [LandingPageController::class,'index'])->name('home-page');

Route::get('dark-mode-switcher', [DarkModeController::class, 'switch'])->name('dark-mode-switcher');
Route::get('color-scheme-switcher/{color_scheme}', [ColorSchemeController::class, 'switch'])->name('color-scheme-switcher');


Route::get('/', function(){
    return view('login.main', [
        'layout' => 'login'
    ]);
});

Route::get('/register', function(){
    return view('login.register', [
        'layout' => 'login'
    ]);
});

// Route::get('/',[AuthenticatesUsers::class,'showLoginForm']);


Route::get('/terms', [LandingPageController::class,'terms'])->name('terms');

Route::get('/scholarship/details/{id}', [LandingPageController::class,'view'])->name('details');





//------ Send Emails
// Route::get('/send-email', function () {

//     Mail::to('salymphp@gmail.com')
//     ->send(new SendEmailNotification());

// });

//Flutterwave payments
Route::post('/pay', [RaveController::class, 'initialize'])->name('pay');
Route::post('/rave/callback', [RaveController::class,'callback'])->name('callback');

Route::get('/payment/home', [RaveController::class,'index'])->name('index');


Auth::routes([
    'verify' => true
]);

//------ Home Screen

Route::get('/xyz', function(){})->name('dashboard-overview-1');

Route::middleware(['verified', 'education_check'])->group(function () {
    Route::prefix('dashboard')->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard.home');
    Route::get('/program-selection', [App\Http\Controllers\HomeController::class, 'ProgramSelection'])->name('Program.Selection');

    //------ Category
    Route::get('/category/index', [CategoryController::class, 'index'])->name('category-index');
    Route::get('/category/create', [CategoryController::class, 'create'])->name('category-create');
    Route::post('/category-store', [CategoryController::class, 'store'])->name('category-store');


    //------ Basic Informations
    Route::get('/student/basic-info', [StudentsController::class, 'index'])->name('basic-info');
    Route::get('/student/basic-info/profile', [StudentsController::class, 'profile'])->name('basic-info-profile');
    Route::get('/student/basic-info/create', [StudentsController::class, 'create'])->name('basic-info-create');
    Route::post('/student/basic-info/store', [StudentsController::class, 'store'])->name('basic-info-store');
    Route::get('/student/basic-info/details/{student}', [StudentsController::class, 'show'])->name('basic-info-show');
    Route::put('/students/{student}', [StudentsController::class, 'update'])->name('students.update');

        Route::put('/update-profile', [StudentsController::class, 'updateProfile'])->name('admin.updateProfileAdmin');
        Route::any('/change-password', [StudentsController::class, 'updatePasswordView'])->name('updatePassword');
        Route::put('/update-password', [StudentsController::class, 'updatePassword'])->name('SaveupdatePassword');





    Route::get('/ajax/students', [StudentsController::class, 'fetchStudents'])->name('ajax.students');

    //------- Passport Informations
    Route::get('/student/passport-info', [PassportsController::class, 'index'])->name('passport-info');
    Route::get('/student/passport-info/create', [PassportsController::class, 'create'])->name('passport-info-create');
    Route::post('/student/passport-info/store', [PassportsController::class, 'store'])->name('passport-info-store');
    Route::put('/student/passport-info/update/{passport}', [PassportsController::class, 'update'])->name('passports.update');

    Route::get('/ajax/passports', [PassportsController::class, 'fetchPassports'])->name('ajax.passports');
    Route::get('/passports-info/details/{passport}', [PassportsController::class, 'show'])->name('passport-info-show');



    //----- English Ability
    Route::get('/student/english-ability', [EnglishAbilityController::class, 'index'])->name('english-ability');
    Route::get('/student/english-ability/create', [EnglishAbilityController::class, 'create'])->name('english-ability-create');
    Route::post('/student/english-ability/store', [EnglishAbilityController::class, 'store'])->name('english-ability-store');
    Route::put('/student/english-ability/update/{englishAbility}', [EnglishAbilityController::class, 'update'])->name('english-ability-update');

    Route::get('ajax/english-ability', [EnglishAbilityController::class, 'ajaxIndex'])->name('ajax.englishAbility');
    Route::get('student/english-ability/{englishAbility}', [EnglishAbilityController::class, 'show'])->name('english-ability-show');


    //------- Chinese Ability
    Route::get('/student/chinese-ability', [ChineseAbilityController::class, 'index'])->name('chinese-ability');
    Route::get('/student/chinese-ability/create', [ChineseAbilityController::class, 'create'])->name('chinese-ability-create');
    Route::post('/student/chinese-ability/store', [ChineseAbilityController::class, 'store'])->name('chinese-ability-store');
    Route::put('/student/chinese-ability/update/{chineseAbility}', [ChineseAbilityController::class, 'update'])->name('chinese-ability-update');
    Route::get('/student/chinese-ability/show/{chineseAbility}', [ChineseAbilityController::class, 'show'])->name('chinese-ability-show');

    Route::get('/ajax/chineseAbility', [ChineseAbilityController::class, 'fetchChineseAbilityData'])->name('ajax.chineseAbility');


    //------- Education Backgrounds
    Route::get('/student/education-background', [EducationBackgroundsController::class, 'index'])->name('education-background');
    Route::get('/student/education-background/create', [EducationBackgroundsController::class, 'create'])->name('education-background-create');
    Route::post('/student/education-background/store', [EducationBackgroundsController::class, 'store'])->name('education-background-store');


    //------ Working Experience
    Route::get('/student/work-experience', [WorkExperienceController::class, 'index'])->name('work-experience');
    Route::get('/student/work-experience/create', [WorkExperienceController::class, 'create'])->name('work-experience-create');
    Route::post('/student/work-experience/store', [WorkExperienceController::class, 'store'])->name('work-experience-store');

    //------ Family Backgrounds
    Route::get('/student/family-background', [FamilyBackgroundController::class, 'index'])->name('family-background');
    Route::get('/student/family-background/create', [FamilyBackgroundController::class, 'create'])->name('family-background-create');
    Route::post('/student/family-background/store', [FamilyBackgroundController::class, 'store'])->name('family-background-store');

    Route::get('/student/family-background/show/{familyBackground}', [FamilyBackgroundController::class, 'show'])->name('family-background-show');

    Route::get('/ajax/family-background', [FamilyBackgroundController::class, 'fetchFamilyBackgroundData'])->name('ajax.familyBackground');
    Route::put('/family-background/update/{familyBackground}', [FamilyBackgroundController::class, 'update'])->name('family-background-update');



    //------- Financial Supporter
    Route::get('/student/financial-supporter', [FinancialSupporterController::class, 'index'])->name('financial-supporter');
    Route::get('/student/financial-supporter/create', [FinancialSupporterController::class, 'create'])->name('financial-supporter-create');
    Route::post('/student/financial-supporter/store', [FinancialSupporterController::class, 'store'])->name('financial-supporter-store');

    Route::get('/student/financial-supporter/show/{financialSupporter}', [FinancialSupporterController::class, 'show'])->name('financial-supporter-show');

    Route::get('/ajax/financial-supporter', [FinancialSupporterController::class, 'fetchFinancialSupporter'])->name('ajax.financialSupporter');
    Route::put('/financial-supporter/update/{financialSupporter}', [FinancialSupporterController::class, 'update'])->name('financial-supporter-update');


    //------ Guarantor
    Route::get('/student/guarantor', [GuarantorController::class, 'index'])->name('guarantor');
    Route::get('/student/guarantor/create', [GuarantorController::class, 'create'])->name('guarantor-create');
    Route::post('/student/guarantor/store', [GuarantorController::class, 'store'])->name('guarantor-store');

    //---- Contact-Info-Home
    Route::get('/student/contact-info-home', [ContactInfoHomeController::class, 'index'])->name('contact-info-home');
    Route::get('/student/contact-info-home/create', [ContactInfoHomeController::class, 'create'])->name('contact-info-home-create');
    Route::post('/student/contact-info-home/store', [ContactInfoHomeController::class, 'store'])->name('contact-info-home-store');


    Route::get('/student/contact-info-home/show/{contactInfoHome}', [ContactInfoHomeController::class, 'show'])->name('contact-info-home-show');

    Route::get('/ajax/contact-info-home', [ContactInfoHomeController::class, 'fetchContactInfoHome'])->name('ajax.contactInfoHome');
    Route::put('/contact-info-home/update/{contactInfoHome}', [ContactInfoHomeController::class, 'update'])->name('contact-info-home-update');




    //----- Contact-Info-Applicant
    Route::get('/student/contact-info-applicant', [ContactInfoApplicantController::class, 'index'])->name('contact-info-applicant');
    Route::get('/student/contact-info-applicant/create', [ContactInfoApplicantController::class, 'create'])->name('contact-info-applicant-create');
    Route::post('/student/contact-info-applicant/store', [ContactInfoApplicantController::class, 'store'])->name('contact-info-applicant-store');

    Route::get('/student/contact-info-applicant/show/{contactInfoApplicant}', [ContactInfoApplicantController::class, 'show'])->name('contact-info-applicant-show');

    Route::get('/ajax/contact-info-applicant', [ContactInfoApplicantController::class, 'fetchContactInfoApplicant'])->name('ajax.contactInfoApplicant');
    Route::put('/contact-info-applicant/update/{contactInfoApplicant}', [ContactInfoApplicantController::class, 'update'])->name('contact-info-applicant-update');


    //-------- Attachments
    Route::get('/student/attachments/index', [AttachmentsController::class, 'index'])->name('attachments-index');
    Route::get('/student/attachments/create', [AttachmentsController::class, 'create'])->name('attachments-create');
    Route::post('/student/attachments/store', [AttachmentsController::class, 'store'])->name('attachments-store');

    Route::get('/student/attachments/show/{attachments}', [AttachmentsController::class, 'show'])->name('attachments-show');

    Route::get('/ajax/attachments', [AttachmentsController::class, 'fetchAttachments'])->name('ajax.attachments');
    Route::put('/attachments/update/{attachments}', [AttachmentsController::class, 'update'])->name('attachments-update');

    ////student refferal
    Route::get('/student/referral', [UserReferralController::class, 'index'])->name('student-referral');
    //wallet
     Route::get('/student/wallet', [WalletControlller::class, 'index'])->name('student-wallet');
     Route::get('/withdraw', [WalletControlller::class, 'withdraw_view'])->name('withdraw.View');
     Route::post('/withdraw/submit', [WalletControlller::class, 'submit'])->name('withdraw.submit');


    //------ Download Medical Form
    Route::get('/student/attachments/medical-form', [AttachmentsController::class, 'download'])->name('download-medical-form');

     Route::get('/student/attachments/Bachelor-form', [AttachmentsController::class, 'Bachelordownload'])->name('download-Bachelor-form');
      Route::get('/student/attachments/Masters-form', [AttachmentsController::class, 'Mastersdownload'])->name('download-Masters-form');


    //----- Scholarships (Student)
    Route::get('/student/scholarships/all/{type?}', [ScholarshipsController::class, 'all'])->name('student-scholarships'); //filter scholarships
     Route::get('/student/scholarships/Edit/{id}', [ScholarshipsController::class, 'edit'])->name('scholarship-Edit');
     Route::any('/student/scholarships/update/{id}', [ScholarshipsController::class, 'updatedata'])->name('admin-courses-update');

    Route::get('/student/scholarships/view/{id}', [ScholarshipsController::class, 'view'])->name('scholarship-view');

    Route::get('/student/appliedscholarships/view/{id}', [ScholarshipsController::class, 'appliedscholar'])->name('applied-scholarship-view');
    Route::delete('/admin/scholarships/delete/{id}', [ScholarshipsController::class, 'destroy'])->name('scholarships-delete');


    //------ Add Secondary Information
    Route::get('/student/secondary/education', [SecondaryEducationController::class, 'index'])->name('secondary-education');
    Route::get('/student/secondary/education/create', [SecondaryEducationController::class, 'create'])->name('secondary-education-create');
    Route::post('/student/secondary/education/store', [SecondaryEducationController::class, 'store'])->name('secondary-education-store');


    Route::get('/student/secondary/education/show/{secondaryEducation}', [SecondaryEducationController::class, 'show'])->name('secondary-education-show');
    Route::put('/student/secondary/education/update/{secondaryEducation}', [SecondaryEducationController::class, 'update'])->name('secondary-education-update');

    Route::get('/ajax/secondary-education', [SecondaryEducationController::class, 'fetchSecondaryEducation'])->name('ajax.secondary-education');

//---Add Master Information
    Route::get('/student/master/education', [MasterEducationController::class, 'index'])->name('master-education');
 Route::get('/student/master/education/create', [MasterEducationController::class, 'create'])->name('master-education-create');
    Route::post('/student/master/education/store', [MasterEducationController::class, 'store'])->name('master-education-store');

    Route::get('/student/master/education/show/{degree}', [MasterEducationController::class, 'show'])->name('master-education-show');
    Route::put('/student/master/education/update/{degreeEducation}', [MasterEducationController::class, 'update'])->name('master-education-update');

     Route::get('/ajax/master', [MasterEducationController::class, 'fetchDegrees'])->name('ajax.master');

    //------ Add Degree Information
    Route::get('/student/degree/education', [DegreeEducationController::class, 'index'])->name('degree-education');
    Route::get('/student/degree/education/create', [DegreeEducationController::class, 'create'])->name('degree-education-create');
    Route::post('/student/degree/education/store', [DegreeEducationController::class, 'store'])->name('degree-education-store');

    Route::get('/student/degree/education/show/{degree}', [DegreeEducationController::class, 'show'])->name('degree-education-show');
    Route::put('/student/degree/education/update/{degreeEducation}', [DegreeEducationController::class, 'update'])->name('degree-education-update');

    Route::get('/ajax/degrees', [DegreeEducationController::class, 'fetchDegrees'])->name('ajax.degrees');

    //------- Add Highschool/Diploma Information
    Route::get('/student/diploma/education', [DiplomaEducationController::class, 'index'])->name('diploma-education');
    Route::get('/student/diploma/education/create', [DiplomaEducationController::class, 'create'])->name('diploma-education-create');
    Route::post('/student/diploma/education/store', [DiplomaEducationController::class, 'store'])->name('diploma-education-store');


    Route::get('/student/diploma/education/show/{diplomaEducation}', [DiplomaEducationController::class, 'show'])->name('diploma-education-show');
    Route::put('/student/diploma/education/update/{diplomaEducation}', [DiplomaEducationController::class, 'update'])->name('diploma-education-update');


    Route::get('/ajax/diploma', [DiplomaEducationController::class, 'fetchDiploma'])->name('ajax.diploma');



    //------ Apply Scholarships
    Route::any('/student/scholarships/application/{id}', [ApplyScholarshipController::class, 'store'])->name('student-scholarship-store');
    Route::get('/student/scholarships/application', [ApplyScholarshipController::class, 'index'])->name('student-scholarship-index');

     Route::any('/student/scholarships/applyapplication/{id}', [ApplyScholarshipController::class, 'fetchapplyapplication'])->name('view-applyscholarship');   

         Route::any('/student/scholarships/application/reject/{id}', [ApplyScholarshipController::class, 'ReapplyScholarship'])->name('scholarship-Reapply');

    Route::get('/api/flutterwave-keys', [ApplyScholarshipController::class, 'getFlutterwaveKeys']);
    Route::post('/api/save-transaction', [ApplyScholarshipController::class, 'saveTransaction']);
    Route::get('/handle-flutterwave-payment', [ApplyScholarshipController::class, 'handlePayment'])->name('flutterwave.handle-payment');

    //----- Review Profile
    Route::get('/student/review/application/{id}', [ScholarshipsController::class, 'myApplication'])->name('scholar-application-view');

    //------ Approve, Reject Scholarships
    Route::any('/student/review/application/approve/{id}', [ScholarshipsController::class, 'approveScholarship'])->name('scholarship-approve');
    Route::any('/student/review/application/reject/{id}', [ScholarshipsController::class, 'rejectScholarship'])->name('scholarship-reject');


Route::get('/notifications/{id}', [NotificationController::class, 'show'])->name('notification.show');
Route::post('/notifications/{notification}/mark-as-read', [NotificationController::class, 'markAsRead'])->name('notification.markAsRead');



    ///admin routes
    Route::prefix('admin')->middleware(['role:super-admin','otp.check'])->group(function () {

        //------scholarships
    Route::get('/scholarships/application', [ApplyScholarshipController::class, 'admin'])->name('admin-scholarship-index'); 
  
  
    Route::get('/scholarships/index', [ScholarshipsController::class, 'index'])->name('admin-scholarships');
    
    Route::get('/scholarships/create', [ScholarshipsController::class, 'create'])->name('admin-scholarships-create');
    Route::post('/scholarships/store', [ScholarshipsController::class, 'store'])->name('admin-scholarships-store');
    Route::get('/print-scholarships', [ScholarshipsController::class, 'printprogram'])->name('admin-printprogram');
  Route::get('/scholarships/{status?}', [ApplyScholarshipController::class, 'applicationstatus'])->name('admin-scholarship-status');

        //------ Institutions
    Route::get('/institutions', [InstitutionsController::class, 'index'])->name('admin-institutions');
    Route::get('/institutions/create', [InstitutionsController::class, 'create'])->name('admin-institutions-create');
    Route::post('/institutions/store', [InstitutionsController::class, 'store'])->name('admin-institutions-store');

    //delete
    Route::delete('/institutions/delete/{id}', [InstitutionsController::class, 'destroy'])->name('institutions-delete');

    //view
    Route::get('/institutions/view/{id}', [InstitutionsController::class, 'show'])->name('admin-institutions-view');
    Route::get('/institutions/edit/{id}', [InstitutionsController::class, 'edit'])->name('admin-institutions-edit');
    Route::put('/institutions/update/{id}', [InstitutionsController::class, 'update'])->name('admin-institutions-update');



     //----- Students List
    Route::get('/students/list', [StudentsController::class, 'studentView'])->name('admin-students-list');
    Route::delete('/students/delete/{id}', [StudentsController::class, 'studentdelete'])->name('admin-students-delete');



    //------ Users Management
    Route::get('/users/management', [UserManagementController::class, 'index'])->name('admin-users-management');
    Route::get('/users/management/create', [UserManagementController::class, 'create'])->name('admin-users-management-create');
    Route::post('/users/management/store', [UserManagementController::class, 'store'])->name('admin-users-management-store');


    //--------- notifications
    Route::get('/notifications', [NotificationController::class, 'getNotifications'])->name('admin.notifications');
    Route::post('/notifications/{id}/mark-as-read', [NotificationController::class, 'markAsRead']);
    Route::post('/notifications/mark-all-as-read', [NotificationController::class, 'markAllAsRead']);

        //------ Roles
    Route::get('/roles', [RolesController::class, 'index'])->name('admin-roles');
    Route::get('/roles/create', [RolesController::class, 'create'])->name('admin-roles-create');
    Route::post('/roles/store', [RolesController::class, 'store'])->name('admin-roles-store');

    // Refferal
     Route::get('/referral', [ReferralController::class, 'index'])->name('admin-referral');
    Route::post('/refferalamount/update', [ReferralController::class, 'updateReferralAmount'])->name('admin-refferalamount-update');


    // api settings
     Route::get('/settings', [PaymentController::class, 'index'])->name('admin-settings');
    Route::post('/apikey/update', [PaymentController::class, 'updateApiKeys'])->name('admin-apikey-update');
    // transaction
     Route::get('/transaction', [TransactionsController::class, 'index'])->name('admin-transaction');


     //withdrawl
    Route::get('/Withdrawal', [WithdrawalController::class, 'index'])->name('admin-Withdrawal');
        

    
    });
    
  Route::put('/Withdrawal/{id}/update-status', [WithdrawalController::class, 'updateStatus'])
    ->name('transactions.updateStatus');
///end admin routes







});
});
 Route::post('/update-education-level', [StudentsController::class, 'updateEducationLevel'])->name('update-education-level');
Route::post('verify/otp', [OtpController::class, 'verifyOtp'])->name('verifyadmin.otp');
  Route::get('/otp', [OtpController::class, 'showOtpForm'])->name('admin.otp');
// Theme routes
Route::middleware('auth')->group(function() {

     // Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    // Route::get('/', [PageController::class, 'dashboardOverview1'])->name('dashboard-overview-1');
    Route::get('dashboard-overview-2-page', [PageController::class, 'dashboardOverview2'])->name('dashboard-overview-2');
    Route::get('dashboard-overview-3-page', [PageController::class, 'dashboardOverview3'])->name('dashboard-overview-3');
    Route::get('inbox-page', [PageController::class, 'inbox'])->name('inbox');
    Route::get('file-manager-page', [PageController::class, 'fileManager'])->name('file-manager');
    Route::get('point-of-sale-page', [PageController::class, 'pointOfSale'])->name('point-of-sale');
    Route::get('chat-page', [PageController::class, 'chat'])->name('chat');
    Route::get('post-page', [PageController::class, 'post'])->name('post');
    Route::get('calendar-page', [PageController::class, 'calendar'])->name('calendar');
    Route::get('crud-data-list-page', [PageController::class, 'crudDataList'])->name('crud-data-list');
    Route::get('crud-form-page', [PageController::class, 'crudForm'])->name('crud-form');
    Route::get('users-layout-1-page', [PageController::class, 'usersLayout1'])->name('users-layout-1');
    Route::get('users-layout-2-page', [PageController::class, 'usersLayout2'])->name('users-layout-2');
    Route::get('users-layout-3-page', [PageController::class, 'usersLayout3'])->name('users-layout-3');
    Route::get('profile-overview-1-page', [PageController::class, 'profileOverview1'])->name('profile-overview-1');
    Route::get('profile-overview-2-page', [PageController::class, 'profileOverview2'])->name('profile-overview-2');
    Route::get('profile-overview-3-page', [PageController::class, 'profileOverview3'])->name('profile-overview-3');
    Route::get('wizard-layout-1-page', [PageController::class, 'wizardLayout1'])->name('wizard-layout-1');
    Route::get('wizard-layout-2-page', [PageController::class, 'wizardLayout2'])->name('wizard-layout-2');
    Route::get('wizard-layout-3-page', [PageController::class, 'wizardLayout3'])->name('wizard-layout-3');
    Route::get('blog-layout-1-page', [PageController::class, 'blogLayout1'])->name('blog-layout-1');
    Route::get('blog-layout-2-page', [PageController::class, 'blogLayout2'])->name('blog-layout-2');
    Route::get('blog-layout-3-page', [PageController::class, 'blogLayout3'])->name('blog-layout-3');
    Route::get('pricing-layout-1-page', [PageController::class, 'pricingLayout1'])->name('pricing-layout-1');
    Route::get('pricing-layout-2-page', [PageController::class, 'pricingLayout2'])->name('pricing-layout-2');
    Route::get('invoice-layout-1-page', [PageController::class, 'invoiceLayout1'])->name('invoice-layout-1');
    Route::get('invoice-layout-2-page', [PageController::class, 'invoiceLayout2'])->name('invoice-layout-2');
    Route::get('faq-layout-1-page', [PageController::class, 'faqLayout1'])->name('faq-layout-1');
    Route::get('faq-layout-2-page', [PageController::class, 'faqLayout2'])->name('faq-layout-2');
    Route::get('faq-layout-3-page', [PageController::class, 'faqLayout3'])->name('faq-layout-3');
    // Route::get('login-page', [PageController::class, 'login'])->name('login');
    // Route::get('register-page', [PageController::class, 'register'])->name('register');
    Route::get('error-page-page', [PageController::class, 'errorPage'])->name('error-page');
    Route::get('update-profile-page', [PageController::class, 'updateProfile'])->name('update-profile');
    Route::get('change-password-page', [PageController::class, 'changePassword'])->name('change-password');
    Route::get('regular-table-page', [PageController::class, 'regularTable'])->name('regular-table');
    Route::get('tabulator-page', [PageController::class, 'tabulator'])->name('tabulator');
    Route::get('modal-page', [PageController::class, 'modal'])->name('modal');
    Route::get('slide-over-page', [PageController::class, 'slideOver'])->name('slide-over');
    Route::get('notification-page', [PageController::class, 'notification'])->name('notification');
    Route::get('accordion-page', [PageController::class, 'accordion'])->name('accordion');
    Route::get('button-page', [PageController::class, 'button'])->name('button');
    Route::get('alert-page', [PageController::class, 'alert'])->name('alert');
    Route::get('progress-bar-page', [PageController::class, 'progressBar'])->name('progress-bar');
    Route::get('tooltip-page', [PageController::class, 'tooltip'])->name('tooltip');
    Route::get('dropdown-page', [PageController::class, 'dropdown'])->name('dropdown');
    Route::get('typography-page', [PageController::class, 'typography'])->name('typography');
    Route::get('icon-page', [PageController::class, 'icon'])->name('icon');
    Route::get('loading-icon-page', [PageController::class, 'loadingIcon'])->name('loading-icon');
    Route::get('regular-form-page', [PageController::class, 'regularForm'])->name('regular-form');
    Route::get('datepicker-page', [PageController::class, 'datepicker'])->name('datepicker');
    Route::get('tom-select-page', [PageController::class, 'tomSelect'])->name('tom-select');
    Route::get('file-upload-page', [PageController::class, 'fileUpload'])->name('file-upload');
    Route::get('wysiwyg-editor-classic', [PageController::class, 'wysiwygEditorClassic'])->name('wysiwyg-editor-classic');
    Route::get('wysiwyg-editor-inline', [PageController::class, 'wysiwygEditorInline'])->name('wysiwyg-editor-inline');
    Route::get('wysiwyg-editor-balloon', [PageController::class, 'wysiwygEditorBalloon'])->name('wysiwyg-editor-balloon');
    Route::get('wysiwyg-editor-balloon-block', [PageController::class, 'wysiwygEditorBalloonBlock'])->name('wysiwyg-editor-balloon-block');
    Route::get('wysiwyg-editor-document', [PageController::class, 'wysiwygEditorDocument'])->name('wysiwyg-editor-document');
    Route::get('validation-page', [PageController::class, 'validation'])->name('validation');
    Route::get('chart-page', [PageController::class, 'chart'])->name('chart');
    Route::get('slider-page', [PageController::class, 'slider'])->name('slider');
    Route::get('image-zoom-page', [PageController::class, 'imageZoom'])->name('image-zoom');
});
    

Route::get('/migrate',function(){
    \Artisan::call('migrate'); 
    dd('migrate');
});

Route::get('/seed',function(){
\Artisan::call('db:seed'); 
dd('seed');
});

Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    return "Cache cleared!";
});