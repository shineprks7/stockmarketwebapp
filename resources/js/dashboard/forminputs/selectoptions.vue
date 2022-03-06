

<template>

      <div class="" >

        
          
              <v-select 
                                v-model="dataValue"
                                :items="options"
                                :item-text="item => item.displayname"
                                :item-value="item => item.name"
                                 outlined
                                 dense
                                :label="labelNamefromParent"

                               >
                                <template v-slot:label="{label}" >
                                    <span class="input__label">{{label}}  </span>
                               </template>
        
            </v-select>



      </div>





  </template>

  <script>

    export default {

    props:{

        options:Array,

        inputvalue:String,
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