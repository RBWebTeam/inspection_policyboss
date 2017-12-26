<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Session;
use File;
use Response;
class imagegalaryController extends Controller
{

	public function imagegalary()
	{
		return View ('imagegalary');
	}
	 public function get_Vehicle_details()
    {
    	$query = DB:: table('vehicle_documents')-> get();
    	return View("imagegalary",['query'=>$query]);
    }
}