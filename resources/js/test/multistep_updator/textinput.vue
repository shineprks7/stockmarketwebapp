

<template>

      <div class="" >

        
            <v-text-field
                                        
                dense
                color="black"
                v-model= "dataValue"
                :label="labelNamefromParent"
                
            >
 
                    <template v-slot:label="{label}">
 
                        <span style="color:black"> {{label}} </span>

 
                     </template>
            </v-text-field>



      </div>





  </template>

  <script>

    export default {

    props:{

        inputvalue:[String,Array,Number],
        labelname:String,
        formuid:Number,



     
     



    },

    data: function () {
        return {
             thevalue:'',
             labname:'Enter Value Here',
          
        }
    },
    created()
    {

    
      
       
    },
    mounted()
    {


         if(typeof this.inputvalue != 'string')

        {
         
              this.thevalue = this.inputvalue.toString();
        }
        else
        {
              this.thevalue = this.inputvalue;
        }
        
        

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