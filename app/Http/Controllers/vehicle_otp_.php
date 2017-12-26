      public function vehicle_send_otp(Request $req){
    // print_r($req->mobile);exit();
    $otp=123456;
    // $otp = mt_rand(100000, 999999);
    Session::put('temp_contact', $req['mobile']);
    $post_data='{"mobNo":"'.$req['mobile'].'","msgData":"your otp is '.$otp.' - RupeeBoss.com",
                "source":"WEB"}';
            // $url = "http://beta.services.rupeeboss.com/LoginDtls.svc/xmlservice/sendSMS";
               $url = $this::$service_url_static."LoginDtls.svc/xmlservice/sendSMS";
            $result=$this->call_json_data_api($url,$post_data);
            $http_result=$result['http_result'];
            $error=$result['error'];
            $obj = json_decode($http_result);
            // statusId response 0 for success, 1 for failure
            
            if($obj->{'statusId'}==0){
                return Response::json(array(
                            'data' => true,
                        ));
            }else{
                return Response::json(array(
                            'data' => false,
                        ));
            }
        
        }

    public function vehicle_verify_otp(Request $req){
    $phone = Session::get('temp_contact');
    $express_otp=$req->verify_otp;
    //print_r($express_otp);
    //print_r($phone);
        
          Session::put('contact',$phone);
          if(Session::get('temp_contact'))
          {
          return Response::json(array(
                            'data' => "true",
                        ));
           }else{
          return Response::json(array(
                            'data' => "false",
                        ));
        }
 }