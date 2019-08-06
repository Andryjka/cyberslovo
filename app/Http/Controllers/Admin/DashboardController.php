<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Insiders;

class DashboardController extends Controller
{ 
    public function index()
    {
        return view('admin.dashboard');
    }

    public function insidersView()
    {
    	$insiders = Insiders::orderBy('created_at', 'desc')->paginate(10);

    	return view('admin.insiders.index')->with('insiders', $insiders);
    }

     public function insidersDestroy(Request $request){

     	$insider = Insiders::where('id', $request->input('id'))->delete();

        return redirect()->back();
     }
}
