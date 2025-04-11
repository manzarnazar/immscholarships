<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class UserManagementController extends Controller
{
    public function index(Request $request)
    {
        // Fetching the search term and entries per page from the request
        $search = $request->get('search', '');
        $entriesPerPage = $request->get('entriesPerPage', 10);

        // Start building the query for the User model where 'user_type' is 'admin'
        $query = User::where('user_type', 'admin')->orWhere('user_type','staff');

        // Apply search filters if search term is present
        if ($search) {
            $query->where(function ($q) use ($search) {
                // Search for staff by name and email
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%");
            });
        }

        // Paginate the results
        $staff = $query->orderBy('created_at', 'desc')->paginate($entriesPerPage);

        // If the request is expecting JSON (e.g., AJAX call), return only the data part
        if ($request->ajax()) {
            // Render the table data HTML and pagination HTML
            $html = view('users-management.partials._table_data', compact('staff'))->render();
            $pagination = view('layout.components.pagination', ['paginator' => $staff])->render();

            // Return the rendered HTML as a JSON response
            return response()->json([
                'data' => $html,
                'pagination' => $pagination,
                'from' => $staff->firstItem(),
                'to' => $staff->lastItem(),
                'total' => $staff->total()
            ]);
        }

        // If it's not an AJAX request, return the normal view
        return view('users-management.index', compact('staff', 'search', 'entriesPerPage'));
    }


    public function create(){
        return view("users-management.create");
    }

    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password'=> 'required|min:8',
            'user_type'=> 'required|string',

        ]);

        if ($validator->fails()) {
            Alert::toast('All data is required!', 'error');
            return redirect()->back();
        }

        $user = new User;
        $user->id = Str::uuid();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->user_type = $request->user_type;
        $user->password = Hash::make($request->password);
        $user->save();

        Alert::toast('Staff Created!', 'success');
        return redirect()->route('admin-users-management')->with('success','Staff Created Successfully!');
    }
}
