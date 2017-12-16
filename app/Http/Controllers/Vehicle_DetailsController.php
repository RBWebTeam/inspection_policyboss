<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Session;
use File;
use Response;
class Vehicle_DetailsController extends Controller
{
	public function Vehicle_details()
	{
	return View('Vehicle_details');
	}
    public function table_details()
	{
	return View('table');
	}


    public function getVehicle_details()
    {
    	$query = DB:: table('rb_main.vehicle_documents')->get();
    	return View("Vehicle_details",['query'=>$query]);
    }
     public function get_Vehicle_details()
    {
    	$query = DB:: table('rb_main.vehicle_documents')->get();
    	return View("table",['query'=>$query]);
    }
}