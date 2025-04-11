<?php

namespace App\Main;

use App\Http\Controllers\StudentsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SideMenu
{
    /**
     * Check if the authenticated user has entered data for a given menu item.
     *
     * @param string $routeName
     * @return bool
     */
    protected static function hasUserData($routeName)
    {
        $user = Auth::user();

        if (!$user) {
            return false;
        }

        // Check if the user has entered data for the route.
        switch ($routeName) {
            case 'basic-info-create':
                return StudentsController::hasBasicInfo();
            case 'passport-info-create':
                return StudentsController::hasPassportInfo();
            case 'english-ability-create':
                return StudentsController::hasEnglishAbility();
            case 'chinese-ability-create':
                return StudentsController::hasChineseAbility();
            case 'degree-education-create':
                return StudentsController::hasDegreeEducation();
             case 'master-education-create':
                return StudentsController::hasMasterEducation();   
            case 'diploma-education-create':
                return StudentsController::hasDiplomaEducation();
            case 'secondary-education-create':
                return StudentsController::hasSecondaryEducation();
            case 'family-background-create':
                return StudentsController::hasFamilyBackground();
            case 'financial-supporter-create':
                return StudentsController::hasFinancialSupporter();
            case 'contact-info-applicant-create':
                return StudentsController::hasContactInfoApplicant();
            case 'contact-info-home-create':
                return StudentsController::hasContactInfoHome();
            case 'attachments-create':
                return StudentsController::hasAttachments();
            case 'dashboard.home':
                return StudentsController::hasProgram();
            case 'student-scholarship-index':
                return StudentsController::hasScholarships();
            default:
                return false;
        }
    }

    /**
     * List of side menu items.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public static function menu()
    {
        $user = Auth::user();
        $menuItems = [];
        $educationLevel  = Auth::user()->education_level ?? null;

        if ($user && $user->user_type == 'student') {
            $menuItems = [
                 [
                    'icon' => self::hasUserData('dashboard.home') ? 'times-circle' : 'x',
                    'route_name' => 'dashboard.home',
                    'params' => ['layout' => 'side-menu'],
                    'title' => 'Home'
                ],
                [
                    'icon' => self::hasUserData('basic-info-create') ? 'user-check' : 'x',
                    'route_name' => 'basic-info-create',
                    'params' => ['layout' => 'side-menu'],
                    'title' => 'Personal Information'
                ],
                [
                    'icon' => self::hasUserData('passport-info-create') ? 'user-check' : 'x',
                    'route_name' => 'passport-info-create',
                    'params' => [
                        'layout' => 'side-menu',
                    ],
                    'title' => 'Passport Information'
                ],

                [
                    'icon' => self::hasUserData('family-background-create') ? 'user-check' : 'x',
                    'route_name' => 'family-background-create',
                    'params' => ['layout' => 'side-menu'],
                    'title' => 'Family Information'
                ],
                [
                    'icon' => self::hasUserData('contact-info-applicant-create') ? 'user-check' : 'x',
                    'route_name' => 'contact-info-applicant-create',
                    'params' => ['layout' => 'side-menu'],
                    'title' => 'Mailing Address'
                ],

                [
                    'icon' => self::hasUserData('english-ability-create') ? 'user-check' : 'x',
                    'route_name' => 'english-ability-create',
                    'params' => ['layout' => 'side-menu'],
                    'title' => 'English Proficiency'
                ],
                [
                    'icon' => self::hasUserData('chinese-ability-create') ? 'user-check' : 'x',
                    'route_name' => 'chinese-ability-create',
                    'params' => ['layout' => 'side-menu'],
                    'title' => 'Chinese Proficiency'
                ],

                ];
                // [
                //     'icon' => self::hasUserData('secondary-education-create') ? 'user-check' : 'x',
                //     'route_name' => 'secondary-education-create',
                //     'params' => ['layout' => 'side-menu'],
                //     'title' => 'Secondary School Information'
                // ],
                // [
                //     'icon' => self::hasUserData('diploma-education-create') ? 'user-check' : 'x',
                //     'route_name' => 'diploma-education-create',
                //     'params' => ['layout' => 'side-menu'],
                //     'title' => 'High School/Diploma Information',
                //     'education_level' => 'degree'
                // ],
                // [
                //     'icon' => self::hasUserData('degree-education-create') ? 'user-check' : 'x',
                //     'route_name' => 'degree-education-create',
                //     'params' => ['layout' => 'side-menu'],
                //     'title' => 'Degree Information',
                //     'education_level' => 'degree'
                // ],
                // [
                //     'icon' => self::hasUserData('master-education-create') ? 'user-check' : 'x',
                //     'route_name' => 'master-education-create',
                //     'params' => ['layout' => 'side-menu'],
                //     'title' => 'Masters  Information',
                //     'education_level' => 'master',
                // ],

                ///levels
                if ($educationLevel == 'Bachelor') {
    $menuItems[] = [
        'icon' => self::hasUserData('secondary-education-create') ? 'user-check' : 'x',
        'route_name' => 'secondary-education-create',
        'params' => ['layout' => 'side-menu'],
        'title' => 'Secondary School Information'
    ];
}

            if ($educationLevel == 'master' || $educationLevel == 'Bachelor') {
                $menuItems[] = [
                    'icon' => self::hasUserData('diploma-education-create') ? 'user-check' : 'x',
                    'route_name' => 'diploma-education-create',
                    'params' => ['layout' => 'side-menu'],
                    'title' => 'High School/Diploma Information'
                ];
            }

            if ($educationLevel == 'master' || $educationLevel == 'PHD') {
                $menuItems[] = [
                    'icon' => self::hasUserData('degree-education-create') ? 'user-check' : 'x',
                    'route_name' => 'degree-education-create',
                    'params' => ['layout' => 'side-menu'],
                    'title' => 'Degree Information'
                ];
            }

            if ($educationLevel == 'PHD') {
                $menuItems[] = [
                    'icon' => self::hasUserData('master-education-create') ? 'user-check' : 'x',
                    'route_name' => 'master-education-create',
                    'params' => ['layout' => 'side-menu'],
                    'title' => 'Masters Information'
                ];
            }




                 $menuItems[] =[
                    'icon' => self::hasUserData('attachments-create') ? 'user-check' : 'x',
                    'route_name' => 'attachments-create',
                    'params' => ['layout' => 'side-menu'],
                    'title' => 'Attachments'
                ];
                 $menuItems[] =[
                    'icon' => self::hasUserData('Program.Selection') ? 'user-check' : 'x',
                    'route_name' => 'Program.Selection',
                    'params' => ['layout' => 'side-menu'],
                    'title' => 'Program Selection'
                ];
                 $menuItems[] =[
                    'icon' => self::hasUserData('student-scholarship-index') ? 'user-check' : 'x',
                    'route_name' => 'student-scholarship-index',
                    'params' => ['layout' => 'side-menu'],
                    'title' => 'My Application'
                ];
                $menuItems[] = [
                    'icon' => 'sliders',
                    'route_name' => 'student-referral',
                    'params' => ['layout' => 'side-menu'],
                    'title' => 'Refferal'
                ];

                $menuItems[] = [
                    'icon' => 'sliders',
                    'route_name' => 'student-wallet',
                    'params' => ['layout' => 'side-menu'],
                    'title' => 'Wallet'
                ];
            
        }

        // Admin/Staff menu items
        if ($user && in_array($user->user_type, ['staff', 'super-admin', 'admin'])) {
            $menuItems[] = [
                'icon' => 'grid',
                'route_name' => 'dashboard.home',
                'params' => ['layout' => 'side-menu'],
                'title' => 'Dashboard'
            ];

            $menuItems[] = [
                'icon' => 'sliders',
                'route_name' => 'admin-scholarship-index',
                'params' => ['layout' => 'side-menu'],
                'title' => 'Scholarships Applications'
            ];

            $menuItems[] = [
                'icon' => 'box',
                'route_name' => 'admin-institutions',
                'params' => ['layout' => 'side-menu'],
                'title' => 'Institutions List'
            ];

            $menuItems[] = [
                'icon' => 'sliders',
                'route_name' => 'admin-scholarships',
                'params' => ['layout' => 'side-menu'],
                'title' => 'All Programs'
            ];

            if (in_array($user->user_type, ['super-admin', 'admin'])) {
                $menuItems[] = [
                    'icon' => 'user',
                    'route_name' => 'admin-students-list',
                    'params' => ['layout' => 'side-menu'],
                    'title' => 'Registered Students'
                ];

                $menuItems[] = [
                    'icon' => 'users',
                    'route_name' => 'admin-users-management',
                    'params' => ['layout' => 'side-menu'],
                    'title' => 'Staff Management'
                ];

                $menuItems[] = [
                    'icon' => 'users',
                    'route_name' => 'admin-roles',
                    'params' => ['layout' => 'side-menu'],
                    'title' => 'Roles & Permissions'
                ];

                 $menuItems[] = [
                    'icon' => 'sliders',
                    'route_name' => 'admin-referral',
                    'params' => ['layout' => 'side-menu'],
                    'title' => 'Refferal Management'
                ];
                 $menuItems[] = [
                    'icon' => 'sliders',
                    'route_name' => 'admin-settings',
                    'params' => ['layout' => 'side-menu'],
                    'title' => 'API Settings'
                ];
                $menuItems[] = [
                    'icon' => 'sliders',
                    'route_name' => 'admin-transaction',
                    'params' => ['layout' => 'side-menu'],
                    'title' => 'Transactions'
                ];
                 $menuItems[] = [
                    'icon' => 'sliders',
                    'route_name' => 'admin-Withdrawal',
                    'params' => ['layout' => 'side-menu'],
                    'title' => 'Withdrawal Management'
                ];
            }
        }

        return $menuItems;
    }
}
