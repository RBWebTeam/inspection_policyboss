

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery.validate.min.js"></script>
<div id="fh5co-hero" class="equifax-bg">
    <div class="container">
    <br>
    <div>
    
    </div>
    <div class="col-md-3"></div>
    <div class="col-md-6">
    <form name="equifax_otp_form" id="equifax_otp_form" method="POST">
    {{ csrf_field() }}
    <h2 class="align-center crd-tit">Mobile verification</h2>
    <div class="whit-bg">
    
    <h4 class="text-center h4-text">Enter Your Mobile No. and Get Started</h4>
    <br>
    <img src="images/verification_img.png" class="img-align-center"/>
    <input type="text" name="mobile" id="mobile" placeholder="9XXXX XXXXX" onkeypress="return fnAllowNumeric(event)" maxlength="10" class="eqfx-input"/>

    <a class="btn btn-danger btn-outline with-arrow animate-box fadeInUp animated otp-btn" id="equifax_get_otp">Get OTP<i class="icon-arrow-right"></i></a>
    <span id="mobile_value" style="display: none;color: red;">Phone number should be of 10 digits.</span>
    </div>
    <br>
    </form>
   </div>

   <form name="equifax_verify_form" id="equifax_verify_form" style="display:none" method="POST">
    {{ csrf_field() }}
    <h2 class="align-center crd-tit">Mobile verification</h2>
    <div class="whit-bg">
    
    <h4 class="text-center h4-text">Enter your verification code sent on your number</h4>
    <br>
    <img src="images/verification_img.png" class="img-align-center"/>
    <input type="text" name="verify_otp_equifax" id="verify_otp_equifax" onkeypress="return fnAllowNumeric(event)" required maxlength="6" placeholder="Enter OTP Code" class="eqfx-input"/>

    <a class="btn btn-primary btn-lg btn-view" id="equifax_verify">VERIFY OTP</a>
    <div id="otp_value" style="display: none;color: red;">Otp is of 6 digits.</div>
                           <div id="wrong_otp_value" style="display: none;color: red;">Wrong Otp !!!</div>
                           <div id="waiting_div_otp" style="display: none;color: red;">Please wait ...</div>
    </div>
    <br>
    </form>

    </div>
    </div>

    <script type="text/javascript">
    $('#equifax_get_otp').click(function(event){
      event.preventDefault();
      // alert('okae');
      if (! $('#equifax_otp_form').valid()) {

      } 
      else {
      if(($('#mobile').val().length)<10)
        {
              $('#mobile_value').show();
              return false;
            }
             $('#mobile_value').hide();   

      $.ajax({  
         type: "POST",  
         url: "{{URL::to('vehicle-send-otp')}}",
         data : $('#equifax_otp_form').serialize(),
         success: function(msg){
            console.log(msg);
            if (msg.data==true) 
                {
                $('#equifax_otp_form').hide();
                $('#equifax_verify_form').show();
                } 
                else 
                {
                window.location.href="{{URL::to('went-wrong')}}";
                }
        
        }   
     });
      }
    });

    $("#equifax_verify").click(function(event){
    event.preventDefault();
     
      if (! $('#equifax_verify_form').valid()) {

      }else{
        //var s=$('#'+form).serialize();
       
        if(($('#verify_otp_equifax').val().length)<6)
        {
              $('#otp_value').show();
              return false;
            }

    $('#otp_value').hide();
    $('#wrong_otp_value').hide();
    $('#waiting_div_otp').show();
    $.ajax({  
     type: "POST",  
     url: "{{URL::to('vehicle-verify')}}",
     dataType:"json",
     data : $('#equifax_verify_form').serialize(),
     success: function(msg){
        console.log(msg.data)
        
       if(msg.data=="true"){
        // console.log("yes");
        alert('OTP verified')
        $('#waiting_div_otp').hide();
        window.location.href="{{URL::to('equifax1')}}";

      }else{
        // console.log("no");
        $('#wrong_otp_value').show();
        
      }
    }
  });
}
});
</script>

