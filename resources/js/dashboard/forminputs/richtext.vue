

<template>

      <div class="" >

         <div class="mb-6">
                <div class="custom_label_style1">
                         {{labelNamefromParent}}
                </div>

        </div>
        <quill-editor
    ref="myQuillEditor"
    v-model="content"
    :options="editorOption"
    @blur="onEditorBlur($event)"
    @focus="onEditorFocus($event)"
    @ready="onEditorReady($event)"
  />



      </div>





  </template>

  <script>

  import Quill from 'quill'

import 'quill/dist/quill.core.css'
import 'quill/dist/quill.snow.css'
import 'quill/dist/quill.bubble.css'

import { quillEditor } from 'vue-quill-editor'

    export default {
    components: {
    quillEditor
    },

    props:{

        inputvalue:String,
        labelname:String,
        formuid:Number,



     
     



    },

    data: function () {
        return {
             thevalue:'',
             labname:'Enter Value Here',
             content:'<h2>I am Example</h2>',
             editorOption: {
          // Some Quill options...
              
          
          
             },
        }
    },
    created()
    {

    
      
       
    },
    mounted()
    {
        this.content = this.inputvalue;

    },
    methods:{

     sendDataToMainForm:function()
      {
           this.$emit('messageFromText',this.formuid,this.content);
      },

       onEditorBlur(quill) {
        console.log('editor blur!', quill)
      },
      onEditorFocus(quill) {
        console.log('editor focus!', quill)
      },
      onEditorReady(quill) {
        console.log('editor ready!', quill)
      },
      onEditorChange({ quill, html, text }) {
        console.log('editor change!', quill, html, text)
        this.content = html
      }
      

       
       

      
      
    },
    computed:{

       editor() {
        return this.$refs.myQuillEditor.quill
      },

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
          content: function (newData, oldData) {

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

.custom_label_style1
{
    color:#F64444;
    font-size:21px;

}

</style>