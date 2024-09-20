<?php

function rules() {
    $url =request()->path();
      if(request()->segment(1) === 'backend' && request()->segment(2) !== ''){
          return request()->segment(2);
      }elseif(request()->segment(2) === 'backend' && request()->segment(3) !== ''){
          return request()->segment(3);
      }else{
          return 'Dashboard';
      }

   }


   function lang()
   {
    return  request()->segment(1) == 'ar' ? __('frontend.Arabic'):__('frontend.English');
    
   }
   function flag()
   {
    return  request()->segment(1) == 'ar' ? asset('assets/frontend/img/arabic.png'):asset('assets/frontend/img/language.png');
    
   }

 