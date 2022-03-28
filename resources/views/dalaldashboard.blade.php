
<!DOCTYPE html>
<html>
<head>
	<title>Dashboard</title>


     <meta name="csrf-token" content="{{ csrf_token() }}">
     
     <link href="https://cdn.jsdelivr.net/npm/@mdi/font@6.x/css/materialdesignicons.min.css" rel="stylesheet">
<style>
     body::-webkit-scrollbar {
  width: 4px;
}
 
body::-webkit-scrollbar-track {
  box-shadow: inset 0 0 3px rgba(0, 0, 0, 0.3);
}
 
body::-webkit-scrollbar-thumb {
  background-color: darkgrey;
  outline: 1px solid slategrey;
}

</style>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
 
 <script type="text/javascript">      
       window.myToken =  <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>

       console.log(window.myToken);

       window._asset = "{{ asset('') }}";



     </script>
          <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>   

     <script>
       
     

     </script>



</head>
 

 <body>
    
 <v-app id="app">

     <router-view>

     </router-view>
        
      </v-app>        

      <script src="{{ mix('/js/app.js') }}"></script>


    
 </body>


 </html>