<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use Response;
class ApiController extends CallApiController

{
  public static $service_url_static = "http://services.rupeeboss.com/";
    public function vehicle_registration(Request $req){
      	
try {
	    date_default_timezone_set('Asia/Kolkata');
        $time=date('Hi'); 
        if (($time >= "0900") && ($time <= "1900")) {
         // echo "Good Morning";
         $mobile_number = $req['mobile_number'];
      	$vehicle_no=$req['vehicle_no'];
      	Session::put('vehicle_no',$vehicle_no);
      	// print_r($vehicle_no);
      	// $pattern="/^[A-Z]{2}\s[0-9]{2}\s[A-Z]{2}\s[0-9]{4}$/";

      	// preg_match($pattern, $vehicle_no, $matches, PREG_OFFSET_CAPTURE, 3);
      	// print_r($matches);exit();
      	// if ($matches	)
      	//  {
      	//  	echo ('Vehicle Number is valid');
      	 	
      	//  }
      	//  else
      	//  {
       //      echo ('Enter Correct Vehicle Number');
           
      	//  }
      	 $lattitude=$req['lattitude'];
      	 $longitude=$req['longitude'];
      	 $device_token=$req['device_token'];
      	 $query=DB::table('vehicle_registration')

        ->insertGetId(['vehicle_no'=>$req->vehicle_no,
              'mobile_number'=>$req->mobile_number,
              'lattitude'=>$req->lattitude,
              'longitude'=>$req->longitude,
              'device_token'=>$req->device_token,
              'created_at'=>date("Y-m-d H:i:s"),
              'updated_at'=>date("Y-m-d H:i:s")]);
        if($query){
              
        	 $result=json_decode(json_encode(["mobile_number"=>$mobile_number,"vehicle_no"=>$vehicle_no,"vehicle_id"=>$query]));
         return response()->json(array('status' =>0,'message'=>"success",'result'=>$result));
        }
         }else{
         	return response()->json(array('status' =>1,'message'=>"Official hours are over.Try between 9 to 7",'result'=>''));
         } 
        
        
       

         } catch (Exception $e) {
      	return response()->json(array('status' => 1,'err'=>$e->getMessage()));
      }
  }

    public function vehicle_documents(Request $req){
    	$res['status']=0;
        $res['msg']="success";

    	$document_name=$req['document_name'];
    	$vehicle_no=$req['vehicle_no'];
    	
    
    try
    {
       $file=$req->file('doc');
      
       if($file == null){
            throw new \Exception("Upload Document ", 1);
          }
          $destinationPath = 'uploads/app/'.$vehicle_no.'/images/';;
          
          $filename=$document_name.".".$file->getClientOriginalExtension();

          
           
          $file->move($destinationPath,$filename);
         $query=DB::table('vehicle_documents')
            ->insertGetId(['vehicle_no'=>$req->vehicle_no,
              'document_name'=>$req->document_name,
              'doc_path'=>$destinationPath.$filename,
               'type'=>'image',
              'created_at'=>date("Y-m-d H:i:s"),
              'updated_at'=>date("Y-m-d H:i:s")]);
            if ( $query) {
            	return response()->json(array('status' =>0,'message'=>"success"));
            }
    }catch(\Exception $ee){


     return response()->json(array('status' =>1,'message'=>$ee->getMessage()));
    }
 }



   public function vehicle_video_documents(Request $req){
   	$res['status']=0;
    $res['msg']="success";
    $document_name=$req['document_name'];
    
    $vehicle_no=$req['vehicle_no'];
    

    try
    {

       $file=$req->file('video');
        // print_r($file);exit();
       if($file == null){
            throw new \Exception("Upload Video ", 1);
          }
          $destinationPath = 'uploads/app/'.$vehicle_no.'/videos/';
          
          $filename=$document_name.".".$file->getClientOriginalExtension();
         

          
           
          $file->move($destinationPath,$filename);
          $query=DB::table('vehicle_documents')
            ->insertGetId(['vehicle_no'=>$req->vehicle_no,
              'document_name'=>$req->document_name,
              'doc_path'=>$destinationPath.$filename,
              'type'=>'video',
              'created_at'=>date("Y-m-d H:i:s"),
              'updated_at'=>date("Y-m-d H:i:s")]);

    if ( $query) {
            	return response()->json(array('status' =>0,'message'=>"success"));
            }
    }catch(\Exception $ee){


     return response()->json(array('status' =>1,'message'=>$ee->getMessage()));
    }
 }


  

 public function vehicle_inspection_details(Request $req){
    $status=0;
    $msg="success";
    $vehicle_no=$req['vehicle_no'];
    $vehicle_condition=$req['vehicle_condition'];
    $vehicle_id=$req['vehicle_id'];
    
     try {
     	$query=DB::table('inspection_details_front_rear')
            ->insertGetId(['vehicle_no'=>$req->vehicle_no,
               'vehicle_id'=>$req->vehicle_id,
              'front_bumper'=>$req->front_bumper,
              'grill'=>$req->grill,
              'head_lamp_lt'=>$req->head_lamp_lt,
              'head_lamp_rt'=>$req->head_lamp_rt,
              'indicator_light_lt'=>$req->indicator_light_lt,
              'indicator_light_rt'=>$req->indicator_light_rt,
              'fog_light_lt'=>$req->fog_light_lt,
              'fog_light_rt'=>$req->fog_light_rt,
              'front_panel'=>$req->front_panel,
              'bonnet'=>$req->bonnet,
              'left_apron'=>$req->left_apron,
              'right_apron'=>$req->right_apron,
              'dicky'=>$req->dicky,
              'rear_bumper'=>$req->rear_bumper,
              'tail_lamp_lt'=>$req->tail_lamp_lt,
              'tail_lamp_rt'=>$req->tail_lamp_rt,
              'vehicle_condition'=>$req->vehicle_condition,
              'created_at'=>date("Y-m-d H:i:s"),
              'updated_at'=>date("Y-m-d H:i:s")]);

            $query1=DB::table('inspection_details_glass')
            ->insertGetId(['vehicle_no'=>$req->vehicle_no,
            	'vehicle_id'=>$req->vehicle_id,
              'back_glass'=>$req->back_glass,
              'glass_laminated'=>$req->glass_laminated,
              'rf_door_glass'=>$req->rf_door_glass,
              'rr_door_glass'=>$req->rr_door_glass,
              'lf_door_glass'=>$req->lf_door_glass,
              'lr_door_glass'=>$req->lr_door_glass,
              'rim'=>$req->rim,
              'under_carriage'=>$req->under_carriage,
              'vehicle_condition'=>$req->vehicle_condition,
              'created_at'=>date("Y-m-d H:i:s"),
              'updated_at'=>date("Y-m-d H:i:s")]);

            $query2=DB::table('inspection_details_left')
            ->insertGetId(['vehicle_no'=>$req->vehicle_no,
            	'vehicle_id'=>$req->vehicle_id,
              'lt_front_fender'=>$req->lt_front_fender,
              'lt_front_door'=>$req->lt_front_door,
              'lt_rear_door'=>$req->lt_rear_door,
              'lt_running_board'=>$req->lt_running_board,
              'lt_pillar_door'=>$req->lt_pillar_door,
              'lt_pillar_center'=>$req->lt_pillar_center,
              'lt_pillar_rear'=>$req->lt_pillar_rear,
              'lt_qtr_panel'=>$req->lt_qtr_panel,
              'vehicle_condition'=>$req->vehicle_condition,
              'created_at'=>date("Y-m-d H:i:s"),
              'updated_at'=>date("Y-m-d H:i:s")]);

            $query3=DB::table('inspection_details_right')
            ->insertGetId(['vehicle_no'=>$req->vehicle_no,
            	'vehicle_id'=>$req->vehicle_id,
              'rt_qtr_panel'=>$req->rt_qtr_panel,
              'rt_rear_door'=>$req->rt_rear_door,
              'rt_front_door'=>$req->rt_front_door,
              'rt_front_pillar_A'=>$req->rt_front_pillar_A,
              'rt_center_pillar_B'=>$req->rt_center_pillar_B,
              'rt_rear_pillar_C'=>$req->rt_rear_pillar_C,
              'rt_running_board'=>$req->rt_running_board,
              'rt_front_fender'=>$req->rt_front_fender,
              'floor'=>$req->floor,
              'rear_view_mirror_lt'=>$req->rear_view_mirror_lt,
              'rear_view_mirror_rt'=>$req->rear_view_mirror_rt,
              'tyres'=>$req->tyres,
              'vehicle_condition'=>$req->vehicle_condition,
              'created_at'=>date("Y-m-d H:i:s"),
              'updated_at'=>date("Y-m-d H:i:s")]);

             $query4=DB::table('tyre_make_and dot_num')
            ->insertGetId(['vehicle_no'=>$req->vehicle_no,
            	'vehicle_id'=>$req->vehicle_id,
              'lt_rear_tyre'=>$req->lt_rear_tyre,
              'lt_front_tyre'=>$req->lt_front_tyre,
              'rt_rear_tyre'=>$req->rt_rear_tyre,
              'rt_front_tyre'=>$req->rt_front_tyre,
              'vehicle_condition'=>$req->vehicle_condition,
              'created_at'=>date("Y-m-d H:i:s"),
              'updated_at'=>date("Y-m-d H:i:s")]);

            if (!$query) {
            	$msg+="\n Note:data is not inserted in inspection_details_front_rear";
            }
            if (!$query1) {
            	$msg+="\n Note:data is not inserted in inspection_details_glass";
            } 
            if (!$query2) {
            	$msg+="\n Note:data is not inserted in inspection_details_left";
            }if (!$query3) {
            	$msg+="\n Note:data is not inserted in inspection_details_right";
            }if (!$query4) {
            	$msg+="\n Note:data is not inserted in tyre_make_and dot_num";
            }

            $query5=DB::table('vehicle_part_master')
            ->insertGetId([
              'vehicle_id'=>$req->vehicle_id,
              'front_rear_id'=>$query,
              'left_id'=>$query1,
              'right_id'=>$query2,
              'tyre_id'=>$query3,
              'glass_id'=>$query4,
              'created_at'=>date("Y-m-d H:i:s"),
              'updated_at'=>date("Y-m-d H:i:s")]);
           
     } catch (Exception $e) {
     	$msg=$ee->getMessage();
     }
     return response()->json(array('status' =>$status,'message'=>$msg,"front_rear_id"=>$query,"left_id"=>$query1,"right_id"=>$query2,"tyre_id"=>$query3,"glass_id"=>$query4,));
   }
  

  // public function vehicle_verification(){
  //   return view('vehicle-verification');
  // }

   public function vehicle_inspection_otp(Request $req){
      $status=0;
      $msg="success";
      try {
        $otp=123456;
      // $otp = mt_rand(100000, 999999);
            Session::put('temp_contact', $req['mobile']);
            // print_r(Session::get('temp_contact'));exit();
            $post_data='{"mobNo":"'.$req['mobile'].'","msgData":"your otp is '.$otp.' - RupeeBoss.com",
                        "source":"WEB"}';
            // $url = "http://beta.services.rupeeboss.com/LoginDtls.svc/xmlservice/sendSMS";
            // $url = $this::$service_url_static."LoginDtls.svc/xmlservice/sendSMS";
            // $result=$this->call_json_data_api($url,$post_data);
            // $http_result=$result['http_result'];
            // $error=$result['error'];
            // $obj = json_decode($http_result);
            // print_r($post_data);exit();
            // statusId response 0 for success, 1 for failure

            $query=DB::table('vehicle_inspection_otp')
            ->insertGetId(['mobile_no'=>$req->mobile,
              'otp'=>$otp,
              'created_at'=>date("Y-m-d H:i:s"),
              'updated_at'=>date("Y-m-d H:i:s")]);
            
            if ($query) {
              return response()->json(array('status' =>0,'message'=>"success"));
            }
      } catch (Exception $ee) {
        return response()->json(array('status' =>1,'message'=>$ee->getMessage()));
      }
      
    }
    


   

   public function vehicle_inspection_verify_otp(Request $req){
    $phone = Session::get('temp_contact');
   
    $express_otp=$req->verify_otp;
     // print_r($express_otp);exit();
    
    
        
          Session::put('contact',$phone);
          if(Session::get('temp_contact'))
          {
          return Response::json(array(
                            'status' => "success",
                        ));
           }else{
          return Response::json(array(
                            'status' => "fail",
                        ));
        }
      }

 //       public function vehicle_send_otp(Request $req){
 //    // print_r($req->mobile);exit();
 //    $otp=123456;
 //    // $otp = mt_rand(100000, 999999);
 //    Session::put('temp_contact', $req['mobile']);
 //    $post_data='{"mobNo":"'.$req['mobile'].'","msgData":"your otp is '.$otp.' - RupeeBoss.com",
 //                "source":"WEB"}';
 //            // $url = "http://beta.services.rupeeboss.com/LoginDtls.svc/xmlservice/sendSMS";
 //               $url = $this::$service_url_static."LoginDtls.svc/xmlservice/sendSMS";
 //            $result=$this->call_json_data_api($url,$post_data);
 //            $http_result=$result['http_result'];
 //            $error=$result['error'];
 //            $obj = json_decode($http_result);
 //            // statusId response 0 for success, 1 for failure
            
 //            if($obj->{'statusId'}==0){
 //                return Response::json(array(
 //                            'data' => true,
 //                        ));
 //            }else{
 //                return Response::json(array(
 //                            'data' => false,
 //                        ));
 //            }
        
 //        }

 //    public function vehicle_verify_otp(Request $req){
 //    $phone = Session::get('temp_contact');
 //    $express_otp=$req->verify_otp;
 //    //print_r($express_otp);
 //    //print_r($phone);
        
 //          Session::put('contact',$phone);
 //          if(Session::get('temp_contact'))
 //          {
 //          return Response::json(array(
 //                            'data' => "true",
 //                        ));
 //           }else{
 //          return Response::json(array(
 //                            'data' => "false",
 //                        ));
 //        }
 // }
        

}
