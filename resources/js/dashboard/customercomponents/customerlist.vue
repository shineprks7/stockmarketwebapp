

<template>

      <v-container class="" >



            <div  class="user_card_default" v-for="customer in customerlist" :key="customer">


             {{customer}}



            </div>

         




      </v-container>





  </template>

  <script>

    export default {

    props:{
     currentaction:String,
     id:Number,
     



    },

    data: function () {
        return {


         actionlist:[{id:1,name:'buy',displayname:'BUY'},{id:2,name:'sell',displayname:'SELL'}],

         newaction:'',

         updaterequest:false,
         updatesuccess:false,

         customerlist:[],
   


            


          
        }
    },
    created()
    {

    
      
       
    },
    mounted()
    {

    },
    methods:{

       updateAction:function()
       {
           this.updaterequest = true;
          axios.post('/api/updaterecommendationaction',
          {  
          
           id:this.id,
           action:this.newActionComputed,
           

           }
          )
          .then((response) => { 
          console.log("response:",response.data)
               this.updaterequest = false;

               if(response.status==200)
                 {
    

                    if(response.data[0]=="success")
                   {       

                       console.log("Success ");   
                        this.updatesuccess = true;

                        setTimeout(function()
                        {

                           this.closeEditor();

                        }.bind(this),1000);

                   }
                   
                   else
                   {

                   }
                 

                }
                else
                {


                  console.log("Your request is Unsuccessfull");   

                      
                 }
    
            }, 
        
               (error)=> {
             console.log(error)

              }
      
              )
        .catch(error => {
         console.log(error.response)
        });
  

       },
       


       activateNewAction:function(value)
       {

              this.newaction = value.name;

       },
       
       classBindingAction:function(value)
       {

           return this.newActionComputed== value ? "tab_status_active" : "tab_status_inactive"; 

       },

      
         closeEditor:function()
        {
            
            this.$store.commit("stockrecommendationsstore/invokeeditor",false);


        },
       
       

      
      
    },
    computed:{

        actionFromParent()
        {
            return this.currentaction;
        },
         newActionComputed:function()
       {
           if(this.newaction != "")
           {
               return this.newaction;
           }
           else
           {
               return this.actionFromParent;
           }

       },




    },
    watch:
    {
        

    },
    



}

</script>

<style scoped>

.user_card_default
{
    padding:10px;
    box-sizing:border-box;
}

</style>