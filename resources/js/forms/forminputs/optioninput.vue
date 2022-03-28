

<template>

      <div class="" >
         <div class="mt-3 label_default_style1"> {{this.labelname}} </div>

         <v-divider class="mt-3 mb-4"> </v-divider>

         <div class="d-flex">

             <div class="option_button_default d-flex align-center justify-center mr-16" v-on:click="optionActivate(option)" v-bind:class="optionClassDynamic(option)"  v-for="option, index in options" :key="index">

                  <div>

                       {{option.displayname}}


                  </div>
                   
               
                


             </div>
         </div>


        Rerender -{{this.rerender}}
            


      </div>





  </template>

  <script>

    export default {

    props:{

        options:Array,
        labelname:String,
        formuid:[Number,String],
        inputvalue:String,
        parseOptionConditions:Array,

        uids:Array,
        rerender:Boolean,
        required:Boolean,
   
        




     
     



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

     setToDefault:function()
     {
         console.log("emptying data data");
               this.activeoption = "";

     },
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
        rerender:function(data, oldData)
        {
             if(data != oldData)
             {
                 this.setToDefault();
             }

        },

    },
    



}

</script>

<style scoped>

.option_button_default
{
 width: 250px;
font-size: 15px;
padding:5px;
box-sizing: border-box;
border-radius: 20px;
font-weight:600;
text-align: center;

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
   color:rgb(80, 67, 67);
    font-size:16px;

    font-weight:600;

}

</style>