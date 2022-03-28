

<template>

      <div class="" >
         <div class="mt-3 label_default_style1"> {{this.labelname}} </div>

         <v-divider class="mt-3 mb-4"> </v-divider>

         <div class="d-flex">

             <div class="option_button_default mr-16" v-on:click="optionActivate(option)" v-bind:class="optionClassDynamic(option)"  v-for="option, index in options" :key="index">

                  <div>

                       <div> 
                           
                           <img  v-if="optionActive" class="" :src="options.activeimgurl"/>
                           <img   v-if="!optionActive"  class="" :src="options.inactiveimgurl"/>

                       </div>
                       <div class="mt-2">
                           {{option.displayname}}
                       </div>
                    


                  </div>
                   
               
                


             </div>
         </div>

        
            



      </div>





  </template>

  <script>

    export default {

    props:{

        options:Array,
        labelname:String,
        formuid:Number,
        inputvalue:String,



     
     



    },

    data: function () {
        return {

            activeoption:'',


          
        }
    },
    created()
    {


      
       
    },
    mounted()
    {
               this.activeoption = this.inputvalue;

    },
    methods:{


      sendDataToMainForm:function()
      {
           this.$emit('messageFromOption',this.formuid,this.activeoption);
      },
      optionClassDynamic:function(opt)
      {
         
           if(this.activeoption == opt.name)

           {
               return "option_button_active";
           }
           else
           {

                 return "option_button_inactive";

           }

      },
      optionActive:function(opt)
      {
         
           if(this.activeoption == opt.name)

           {
               return true;
           }
           else
           {

                 return false;

           }

      },
      optionActivate:function(opt)
      {
           
           this.activeoption = opt.name;

      },

      

       
       

      
      
    },
    computed:{

     




    },
    watch:
    {
        activeoption: function (newData, oldData) {

            this.sendDataToMainForm();
           },

    },
    



}

</script>

<style scoped>

.option_button_default
{
 width: 150px;
font-size: 15px;
padding:4px;
box-sizing: border-box;
border-radius: 20px;
font-weight:600;
}
.option_button_active
{
 background: #47AD63;
border: 1px solid #47AD63;
color:#fff;
background: linear-gradient(268.57deg, #55715D 5.26%, rgba(89, 69, 73, 0.5) 100%);

}

.option_button_inactive
{
 background: #fff;
border: 1px solid #47AD63;
color:#000;

}
.label_default_style1
{
    font-style: normal;
font-weight: 500;
font-size: 15px;
line-height: 20px;

color: #47AD63;

}

</style>