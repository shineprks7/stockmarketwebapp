

<template>

      <div class="" >

        
          
            <v-checkbox
              v-model="thevalue"
             :label="option.displayname"
             :value="option.name"
             v-for="option,index in options"
             :key="index"
             color="indigo"

             >
             
             </v-checkbox>



      </div>





  </template>

  <script>

    export default {

    props:{

        options:Array,

        inputvalue:Array,
        labelname:String,
        formuid:Number,



     
     



    },

    data: function () {
        return {
             thevalue:[],
             labname:'Enter Value Here',
          
        }
    },
    created()
    {

    
      
       
    },
    mounted()
    {
        this.thevalue = this.inputvalue;

    },
    methods:{

     sendDataToMainForm:function()
      {
           this.$emit('messageFromText',this.formuid,this.thevalue);
      },
      

       
       

      
      
    },
    computed:{


      labelNamefromParent()
      { 
          if(this.labelname)
          {
              return this.labelname;
          }
          else
          {
              return "Enter Value Here";
          }

      },
      dataValue:
      {
          get()
          {

             return this.thevalue;
          },
          set(value)
          {
              this.thevalue = value;
          }

      }, 




    },
    watch:
    {
          thevalue: function (newData, oldData) {

            this.sendDataToMainForm();
           },
        

    },
    



}

</script>

<style scoped>

.v-text-field--outlined >>> fieldset
{
    border-color:#000;
}

</style>