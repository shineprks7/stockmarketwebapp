

<template>

      <div>
         
        <div class="dashboard_body ">
         <v-app-bar
           elevation="4"
           color="#fff"
           class="appbar_default"
          >  
          <v-app-bar-nav-icon v-on:click="toggleNavMenu()"  ></v-app-bar-nav-icon>

         <v-toolbar-title class="toolbar_title">DALAL MONEY</v-toolbar-title>

          <v-spacer></v-spacer>
         
          <div><topnavigation/> </div>
          <div class="appbar_cus_spacer"> </div>
          <div class="right_plot d-flex align-center"> 
            <ul class="mr-2  profile_default" > 
                <div class="profile_circle d-flex align-center justify-center" >{{currentUserInitial}}  </div>
              
               <li class="hover_block_wrapper"> 
                   <div class="hover_block">
                      <div > Upload Profile Photo </div>

                       <div class="mt-2"> Change Profile Name </div>

                       <div class="mt-2"> Change Password </div>
                       <v-divider class="mt-2 mb-2"> </v-divider>
                       <div class="mt-1 d-flex align-center" style="cursor:pointer" v-on:click="logoutSession()"> 
                          
                            <div class="mr-2 d-flex justify-center align-center ">  
                                 <img class="login_icon" src="images/power_off.png" /> 
                          
                            </div>
   
                            <div>Logout </div>
                          
                           
                       </div>  
                    </div>

               </li>
              
              </ul> 
            <div class="toolbar_title_2">Hi, {{userName}} </div>
          </div>



        
             <div class="navwrapper_default" v-show="showsidebarmenu">
                <navmenus />
              </div>

         
         </v-app-bar>
         

          <div class="mt-10">
                  <router-view > </router-view>

          </div>


      





        </div>
        <footer class="d-flex justify-center" >

              <div class="copyright_plot">

                    <v-divider class="mb-4 mt-4"> </v-divider>

                     <div class="copyright_text">
                         Copyright &copy; DALALMONEY.COM

                     </div>

              </div>

             

        </footer>

      </div>




  </template>

  <script>

    import navmenus from '../navigation/navigationmain.vue';
    import topnavigation from '../navigation/topnavigation.vue';

    export default {
      components:{
       'navmenus':navmenus,
       'topnavigation':topnavigation,
      },

    data: function () {
        return {

           shownavmenu:false,
            
          
        }
    },
    created()
    {
      
       
    },
    mounted()
    {
       this.getCurrentUser();
    },
    methods:{
  
      closeNavMenu:function(arg1)
      {
                
        this.$store.commit('indexstore/closeSideBarMenu');


      },
      toggleNavMenu:function()
      {
        
        this.$store.commit('indexstore/toggleSideBarMenu');

          

      },
      getCurrentUser:function()


      {

        axios.get('/getcurrentuserstaff',{

        }).then((response) =>{
        
           if(response.data[0]=="success")
           {
           this.$store.commit('indexstore/updatecurrentuser',response.data[1]);
           }
           else if(response.data[0]=="guest")
           {
              this.$store.commit('indexstore/updatecurrentuser',response.data[1]);

              this.$store.commit('indexstore/updateloginstatus',false);
              
    
           }
           else
           {
               window.location.replace("http://127.0.0.1:8000/dashboard#/stafflogin");
  
           }
        },
        (error) =>
        {

               console.log("Error");
        }
        
        
        );
           
      },
        logoutSession:function()
		 {
			
			    axios.get('/logoutstaff',
            {
       
				
            }
             )
			     .then((response) => { 
               console.log("response:",response.data)
			           
			
               if(response.data=="success")
               {
                 window.location.replace("http://127.0.0.1:8000/dashboard#/stafflogin");
     

               }

		        	    

                 }, 
                
			           (error)=> {
                     console.log(error)
   

    
                   }
              
		   	       );
			
 		},
		


      
      
    }
    ,
    computed:{

        userName()
        {
              return this.$store.state.indexstore.currentuser;
        },
        currentUserInitial()
        {
              return this.userName!=""? this.userName.charAt(0).toUpperCase() : "G";
        },
        showsidebarmenu()
        {

            return this.$store.state.indexstore.showsidebarmenu;

        },
        routesubmenu()
        {
         return this.$route.params.submenu;
  
        },
       

    }



}

</script>

<style scoped>
.appbar_cus_spacer
{
  width:200px;
}
.nav_bar_default
{
  background: #FFFFFF;
box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);

}

.dashboard_body
{
  width:100%;
  box-sizing:border-box;
  min-height:850px;
  height:auto;
  padding-bottom:100px;
  font-family: Poppins;

}
.toolbar_title
{
    font-family: Poppins;

  font-size:18px;
  font-weight:700;
  letter-spacing:1.2px;
}
.copyright_plot
{
  width:700px;

}
.copyright_text
{
  color:brown;
  font-size:18px;
  text-align:center;
  font-family: Poppins;
  
}
.appbar_default
{
  transform:rotate(0deg);
      z-index:10000;

 }
.navwrapper_default
{
    position:absolute;
    top:100%;
    left:0px;
    

}
.right_plot
{

}
.profile_default
{
  transform:rotate(0deg);
  list-style-type: none;
   margin-top:0; 
   margin-bottom: 0; 
   margin-left: 0; 
   margin-right: 0; 
   height: 100%;

}
.profile_circle
{
  font-size: 18px;
  border-radius:50%;
  background-color: chocolate;
  color:#FFFFFF;
  width:40px;
  height: 40px;
  

}
.toolbar_title_2
{
  color:navy;
  font-size:20px;
  
}
.hover_block_wrapper
{
  
   position: absolute;
   top:100%;
   left:0;
    
   transform: translate(-40%,0%);
   padding-top:10px;


}
.hover_block
{
background: white;
  min-width:200px;
   padding:25px;
   box-sizing: border-box;
   color:#000;
   font-size:15px;
     border:1.2px solid #ddd;


}
.profile_default .hover_block_wrapper
{
  display: none;
}
.profile_default:hover .hover_block_wrapper
{
  display: block;
}
.login_icon
{
  width:13px;
  height: 13px;
}


</style>