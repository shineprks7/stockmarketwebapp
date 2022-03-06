

<template>

      <div>
         
        <div class="wrapper_login_panel d-flex justify-center align-center" >



             <div class="login_form_default">
                 <div class="title_form" > <span class="title_text" > LOGIN </span></div>

                 <v-divider color="white" class="mt-3 mb-3" > </v-divider>
                 <div class="mt-4 d-flex align-center textbox_wrapper_default">
                      <div class="mr-2" >
                         <img class="input_icon_default" src="images/email_black.png"/>
                      </div>
                      <div >
                      <input type="text"  v-model="dataEmail" class="textbox_default" placeholder="Enter Your Email Id" />
                      </div>

                 </div>
                 <div  class="mt-3 mb-2 validation_error_msg">
                      <span v-if="this.email != '' && !this.emailValidation && this.loginattempt"> Email Id is not Valid</span>
                      <span v-if="this.email==''&&this.loginattempt"> Email should not be empty </span>
                  </div>

                  <div class="mt-1 d-flex align-center textbox_wrapper_default">
                      <div class="mr-2">
                         <img class="input_icon_default" src="images/lock_open.png"/>
                      </div>
                      <div  >
                      <input type="password"  v-model="dataPassword" class="textbox_default" placeholder="Enter password" />
                       </div>
                 </div>
                 <div class="mt-3 mb-2 validation_error_msg">
                      <span v-if="this.password != ''  && !this.passWordValidation && this.loginattempt"  > Password must have atleast 7 Characters</span>
                      <span v-if="this.password==''&&this.loginattempt"> Password should not be empty </span>

                      <span v-if="externalError"> Unable to Login. Please try again.</span>

                  </div>
                

                 


                  <div class="mt-2 d-flex align-center justify-center submit_button_default" v-on:click="senddata()">
                      <div class="d-flex align-center">
                    
                          <div > Sign In  </div>
                          <div class="ml-3">  <img class="submit_icon_default" src="images/login_white.png" /> </div>

                       </div>


                  </div>




             </div>

          



        
         



        </div>
      </div>




  </template>

  <script>

    export default {

    data: function () {
        return {
            loginattempt:false,

            email:'',
            password:'',
            errorMessage:false,
            emailValidation:false,
            passWordValidation:false,
            externalError:false,
          
        }
    },
    created()
    {
      
       
    },
    methods:{
       validateemail:function()
          {
            var mailformat =/(?:[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])/;
            if(this.email.match(mailformat))
            {
               this.emailValidation = true

            }
           else
           {

            this.emailValidation = false
           
           }
        },
        validatepassword:function()
        {
            this.passWordValidation =  this.password.length>6 ? true : false ;
        },
        senddata:function()
		 {
			
		  	this.loginattempt = true;
      
    
				
		   if(this.emailValidation==true &&  this.passWordValidation)
       {

         console.log("trying to Login");

			    axios.post('/loginstaff',
            {
             
				     
				     email:this.dataEmail,
             password:this.dataPassword,
				      
				
            }
             )
			     .then((response) => { 
               console.log("response:",response.data)
			           
			
               if(response.data=="success")
               {
                 window.location.replace("http://127.0.0.1:8000/dashboard#/recommendationlist");
     

               }

		        	    

                 }, 
                
			           (error)=> {
                     console.log(error)
                     this.externalError = true;
   

    
                   }
              
		   	       );

                
			
        }
        
          
			
		},
		


      
    }
    ,
    computed:{

        routesubmenu()
        {
         return this.$route.params.submenu;
  
        },
        dataEmail:
        {
          get()
          {

             return this.email;

          },
          set(value)
          { 
            this.email = value;

          }

        },
         dataPassword:
        {
          get()
          {

             return this.password;

          },
          set(value)
          { 
            this.password = value;

          }

        },
       

    },
    watch:{
        email:function(data1, data2)
        {
              this.validateemail();
        },
        password:function(data1,data2)
        {
            this.validatepassword();
        },

    }



}

</script>

<style scoped>

.bg_style1
{

    
}
.validation_error_msg
{
  min-height: 50px;
  width:100%;
  color:#BEED38;

}
.login_form_default
{
 width:400px;
 padding:25px;
 box-sizing:border-box;  
 background-color:#67524F;
 border-radius: 20px;
 padding-left:50px;
 padding-right:50px;
}
.wrapper_login_panel
{
  width:100vw;
  height:100vh;
  background-color:#3F3230;
}
.textbox_wrapper_default
{
  background:#fff;
  border-radius: 5px;
  margin-left:auto;
  margin-right:auto;
  padding-left:5px;
  box-sizing: border-box;

}
.textbox_default
{
  padding-top:6px;
  padding-bottom:6px;
  padding-left:12px;
  box-sizing:borderbox;
  width:100%;
  outline:0;

}
.textbox_default::focus
{
  outline:0;
}
.submit_button_default
{
   padding-top:10px;
  padding-bottom:10px;
  padding-left:20px;
  box-sizing:borderbox;
  text-align:center;
  background:#FE1111;
  color:#fff;
  border-radius: 5px;
  margin-left:auto;
  margin-right:auto;
  font-size:20px;



}
.title_form
{
  text-align:center;
  font-size:20px;
  font-weight:bold;
  
}
.title_text
{
  color:#fff;
  
}
.input_icon_default
{
  width:20px;
  height: 20px;
}
.submit_icon_default
{
  width:16px;
  height: 16px;

}


</style>