

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
        formuid:[Number,String],
        rerender:Boolean,



     
     



    },

    data: function () {
        return {
             thevalue:'',
             validstatus:false,
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
             this.validateEmail();

        }
        else
        {
              this.thevalue = this.inputvalue;

              this.validateEmail();
        }
        
        

    },
    methods:{
     setToDefault:function()
     {
               this.thevalue = "";

     }, 
     sendDataToMainForm:function()
      {
           this.$emit('messageFromEmail',this.formuid,this.thevalue, this.validstatus);
      },

      validateEmail:function()
      {

            var mailformat =/(?:[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])/;
            if(this.thevalue.match(mailformat))
            {
               this.validstatus = true;

            }
           else
           {

            this.validstatus = false ;
           
           }
      }
      

       
       

      
      
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
            this.validateEmail();

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