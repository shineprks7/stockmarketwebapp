

<template>

      <div class="" >

        
          

             <v-combobox
          v-model="thevalue"
          :items="options"
          :item-text="item => item.displayname"
          :item-value="item => item.name"
          :label="labelname"
          multiple
          outlined
          dense
          chips
        ></v-combobox>



      </div>





  </template>

  <script>

    export default {

    props:{

        options:Array,

        inputvalue:Array,
        labelname:String,
        formuid:[Number,String],
        rerender:Boolean,



     
     



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
     setToDefault:function()
     {
               this.thevalue = [];

     }, 
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

.v-text-field--outlined >>> fieldset
{
    border-color:#000;
}

</style>