
<!DOCTYPE html>
<html>
<head>
	<title>Generate PDF</title>
     <meta name="csrf-token" content="{{ csrf_token() }}">

     <link rel="stylesheet" href="{{ asset('css/form1.css') }}">
     <script src="{{ asset('js2/vue/vue.js') }}"></script>
     <script src="{{ asset('js2/vue/vuex.js') }}"></script>
     <script src="{{ mix('js/app.js') }}"></script>
     <script type="text/javascript">      
       window.myToken =  <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>

       console.log(window.myToken);




     </script>
     <script>
       
     

     </script>

     <script src="{{ asset('js2/store/index.js') }}"></script>
     <script src="{{ asset('js2/components/loginstaffcomponent.js') }}"></script>
   


</head>
 

 <body>
    
 <div id="app" >

 </div>
    
 </body>
 <script src="{{ asset('js2/loginstaff.js') }}"></script>

 </html>