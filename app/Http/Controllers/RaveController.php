<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use KingFlamez\Rave\Facades\Rave;

//use the Rave Facadeuse Rave;
class RaveController extends Controller
{
    /**
     * Initialize Rave payment process
     * @return void
     */ public function initialize()
    {
        //This initializes payment and redirects to the payment gateway//The initialize method takes the parameter of the redirect URL
        Rave::initialize(route('callback'));
    }
    /**
     * Obtain Rave callback information
     * @return void
     */ public function callback()
    {
        $data = Rave::verifyTransaction(request()->txref);
        dd($data);  // view the data response
        if ($data->status == 'success') {

            //do something to your database
        } else {
            //return invalid payment
        }
    }

    public function index(){
        return view('payments.index');
    }
}
