

<template>

      <v-container class="" >

        
        <div  v-if="satisfyInitialQuery()" :key="componentkey">

         

           

          <section class="form_wrapper d-flex align-center" v-if="this.componentmounted && this.propsCopied && this.preLoadComplete ? true:false" >
            <main class="ml-5 mt-3" v-for="form in this.forms" :key="form.uid">
           
             
             
              <textinput
                    :rerender = "rerenderChilds"
                    :inputvalue ="form.value"
                    :labelname = "form.label"
                    :formuid= "form.uid"
                    :style ="form.style ? form.style : {} "

                    :class="form.class? form.class : ''"

                    v-if="conditionalCheckForm(form, 'text')"
                     v-on:messageFromText="messageReceivedFromText"

                    />

                <emailinput
                     :rerender = "rerenderChilds"

                    :inputvalue ="form.value"
                    :labelname = "form.label"
                    :formuid= "form.uid" 

                    :class="form.class? form.class : ''"
                    
                    :style ="form.style ? form.style : {} "
                    v-if="conditionalCheckForm(form, 'email')"
                    v-on:messageFromEmail="messageReceivedFromEmail"

                />

                <textinputsingle
                    :rerender = "rerenderChilds"

                    :inputvalue ="form.value"
                    :labelname = "form.label"
                    :formuid= "form.uid" 

                    :class="form.class? form.class : ''"
                    :style ="form.style ? form.style : {} "

                    v-else-if= "conditionalCheckForm(form, 'textsingle')"
                     v-on:messageFromText="messageReceivedFromText"

                    />

               <richtext
                    :rerender = "rerenderChilds"

                    :inputvalue ="form.value"
                    :labelname = "form.label"
                    :formuid= "form.uid" 

                    :class="form.class ? form.class : ''"
                    :style ="form.style ? form.style : {} "

                    v-else-if="conditionalCheckForm(form, 'richtext')"

                     v-on:messageFromText="messageReceivedFromText"

                    />
              <dateinput
                    :rerender = "rerenderChilds"

                    :inputvalue ="form.value"
                    :labelname = "form.label"
                    :formuid= "form.uid" 

                    :class="form.class ? form.class : ''"
                    :style ="form.style ? form.style : {} "

                    v-else-if="conditionalCheckForm(form, 'date')"
                     v-on:messageFromText="messageReceivedFromText"

                    />

              <numberinput
                    :rerender = "rerenderChilds"

                    :inputvalue ="form.value"
                    :labelname = "form.label"
                    :formuid= "form.uid" 
                    :class="form.class ? form.class : ''"
                    :style ="form.style ? form.style : {} "

                      v-on:messageFromText="messageReceivedFromText"


                      v-else-if="conditionalCheckForm(form, 'number')"

                    />
                <selectoptions
                      :rerender = "rerenderChilds"

                      :options  ="form.options ? form.options :[]"
                      :inputvalue ="form.value"

                      :labelname = "form.label"
                      :formuid = "form.uid"
                      :optionconditions ="form.hasOwnProperty('optionconditions')?form.optionconditions :[]"
                      :uids = "associatedFormData( form.associatedUids, forms)"

                    :class="form.class ? form.class : ''"
                    :style ="form.style ? form.style : {} "
                      v-else-if="form.inputtype=='selectoptions'"

                      v-on:messageFromText="messageReceivedFromText" />

                  <dynamicselectoptions
                      :rerender = "rerenderChilds"

                      :inputvalue ="form.value"

                      :labelname = "form.label"
                      :formuid = "form.uid"
                      :optionPullUrl = "form.optionPullUrl"
                      :parseFieldsExternal = "form.parseFieldsExternal"
                      :orderBy = "form.hasOwnProperty('orderBy')?form.orderBy :''"
                      :limit = "form.hasOwnProperty('limit')?form.limit :''"

                      :optionconditions = "form.hasOwnProperty('optionconditions')?form.optionconditions :[]"
                      :uids = "associatedFormData( form.associatedUids, forms)"

                    :class="form.class ? form.class : ''"
                     :style ="form.style ? form.style : {} "
                      v-else-if="form.inputtype=='dynamicselectoptions'"

                      v-on:messageFromText="messageReceivedFromText" />


                      <optioninput
                      :options  ="form.options ? form.options :[]"
                      :rerender = "rerenderChilds"
                      :inputvalue ="form.value"

                      :labelname = "form.label"
                      :formuid = "form.uid"
                      v-else-if="conditionalCheckForm(form, 'radiooptions')"
                    :class="form.class ? form.class : ''"
                     :style ="form.style ? form.style : {} "

                      v-on:messageFromOption="messageReceivedFromOption" />
                     

                  <comboboxinput
                      :rerender = "rerenderChilds"

                      :options  ="form.options ? form.options :[]"
                      :inputvalue ="form.value"

                      :labelname = "form.label"
                      :formuid = "form.uid"
                      v-else-if="conditionalCheckForm(form, 'checkoptions')"
                    :class="form.class ? form.class : ''"
                     :style ="form.style ? form.style : {} "

                      v-on:messageFromText="messageReceivedFromText" />

                      

                      <imageuploader
                     :rerender = "rerenderChilds"

                    :inputvalue ="form.value"
                    :labelname = "form.label"
                    :uploadurl ="form.uploadurl"
                    :formuid= "form.uid" 

                    :class="form.class ? form.class : ''"
                    :style ="form.style ? form.style : {} "

                    v-else-if="conditionalCheckForm(form, 'imageuploader')"
                     v-on:messageFromText="messageReceivedFromText"

                    />
                      

                      <customoptions-1
                      :options  ="form.options ? form.options :[]"
                      :inputvalue ="form.value"

                      :labelname = "form.label"
                      :formuid = "form.uid"
                      v-else-if="conditionalCheckForm(form, 'customradiooptions1')"
                      class="mt-7"

                      v-on:messageFromOption="messageReceivedFromOption" />
                     <customoptions-2
                      :options  ="form.options ? form.options :[]"
                      :inputvalue ="form.value"

                      :labelname = "form.label"
                      :formuid = "form.uid"
                      v-else-if="conditionalCheckForm(form, 'customradiooptions2')"
                      class="mt-7"

                      v-on:messageFromOption="messageReceivedFromOption" />   
                      <customoptions-3
                      :options  ="form.options ? form.options :[]"
                      :inputvalue ="form.value"

                      :labelname = "form.label"
                      :formuid = "form.uid"
                      v-else-if="conditionalCheckForm(form, 'customradiooptions3')"
                      class="mt-7"

                      v-on:messageFromOption="messageReceivedFromOption" />  

                  
                  <div class="error_msg_required"  v-if="fireRequiredFieldError(form) && conditionalFilterForm(form)" > {{form.label}} is required </div>

                


            </main>

            <div class="ml-5 finish_button"   v-on:click="submitFormFinal()" >

                  Update

              </div> 

              <div class="close_form" v-on:click = "closeInlineForm()">

                  <img  src="images/cancel_red.png" />

              </div>

             

          </section>

          



          


        </div>

        <div  class="error_page_form d-flex justify-center align-center" v-if="!satisfyInitialQuery()"> 

              <div class="error_page_message"> Some Error Occured! </div>

        </div>




      </v-container>





  </template>

  <script>
/*

                         {
  
             uid:13,
             type:'main',
             label:'Type of IPO',
             value:'',
             style:'default',
             inputtype:'radiooptions',
             required:true,
             options:[{id:1,name:'mainboard',displayname:'Main Board',haschild:false},
                     {id:2,name:'sme',displayname:'SME IPO',haschild:false},
                   ],
             exportname:'typeofipo',
             page:3,
             externalvalue:false,

                

             },
 

*/

import numberinput from "../../forms/forminputs/numberinput.vue";
import optioninput from "../forms/forminputs/optioninput.vue";
import textinput from "../forminputs/textinput.vue";
import richtext from "../forminputs/richtext.vue";
import dateinput from "../forminputs/dateinput.vue";
import selectoptions from "../forminputs/selectoptions.vue";
import checkboxinput from "../forminputs/checkboxinput.vue";
import comboboxinput from "../forminputs/comboboxinput.vue";

import textinputsingle from "../forminputs/textinputsingle.vue";
import emailinput from "../forminputs/emailinput.vue";

import imageuploader from "../forminputs/imageuploader.vue";

import dynamicselectoptions from "../forminputs/dynamicselectoptions.vue";

import customoptions1 from "../forminputscustom/customoptions1.vue";

import customoptions2 from "../forminputscustom/customoptions2.vue";

import customoptions3 from "../forminputscustom/customoptions3.vue";


import get from "lodash/get";

import formmixins from "../mixins/formmixins"



export default {
  components: {
    numberinput: numberinput,
    optioninput: optioninput,
    richtext: richtext,
    textinput: textinput,
    dateinput: dateinput,
    selectoptions: selectoptions,
    dynamicselectoptions:dynamicselectoptions,
    checkboxinput: checkboxinput,
    comboboxinput: comboboxinput,
    textinputsingle: textinputsingle,
    imageuploader: imageuploader,
    emailinput: emailinput,
    customoptions1:customoptions1,
    customoptions2:customoptions2,
    customoptions3:customoptions3,
  },

  mixins: [formmixins],

  props: {
    formdata:[Array, Object],
    formDynamicQueryFields:Array,
    formUrl:String,
    displayStyle:String,
    requestType:String,
    preLoad:Boolean,
    queryPreload:[Array,String],
    queryInitialLoad:[Array,String],
    preLoadUrl:String,
    submitUrl:String,
    displayName:String,
    clearDataOnSubmit:Boolean,

    internalFormData:Object,


  },

  data: function () {
    return {

      optionvaluereceived: "not received yet",

      componentmounted: false,
      componentkey:1000,
      propsCopied:false,

      dynamicQueryFields: [],
      formurl: "/dynamicformtest",
      uids:{},

      externaldata: "",
      displaystyle: "singlepage",

      preLoadComplete: false,

      requiredQueryForPreLoad: ["companyid"],
      requiredQueryForInitialLoad:[],


      formname: "ipocreatorform",
      formDisplayName: "CREATE TRADING CALLS",
      pages: 1,
      finalUrl: "",

      requiredfieldmsg: false,

      rerenderChilds:false,


   

      forms:[],
      /*


      */
    };
  },
  
  created() {},
  mounted() {
    this.componentmounted = true;

    this.copyProps();

    this.propsCopied = true;



    this.preLoadData();
  },
  methods: {
    forceUpdateComponent() {
      this.$forceUpdate();
    },
    closeInlineForm()
    {
        this.$emit('closeForm');

    },
    copyProps:function()
    {
          if(this.forms)
          {
          this.forms = this.formdata;
          }

          if(this.formDynamicQueryFields)
          {
           this.dynamicQueryFields = this.formDynamicQueryFields;
          }
           if(this.formDynamicQueryFields)
          {
           this.dynamicQueryFields = this.formDynamicQueryFields;
          }
           if(this.formUrl)
          {
           this.formurl = this.formUrl;
          }
          if(this.displayStyle)
          {
           this.displaystyle = this.displayStyle;
          }
           if(this.queryPreload)
          {
           this.requiredQueryForPreLoad = this.queryPreload;
          }
           if(this.queryInitialLoad)
          {
           this.queryInitialLoad = this.queryInitialLoad;
          }
          
            if(this.displayName)
          {
           this.formDisplayName = this.displayName;
          }

    
    },
    
   
    preLoadData: function () {
      if (this.satisfyPreloadQuery()) {
        //request

        if (this.preLoadUrl) {
          // Axios request

          var requestprops = new Object();
          requestprops.query = this.queryList;

          axios
            .post(this.preLoadUrl, requestprops)
            .then(
              (response) => {
                console.log("response:", response.data);
                this.updaterequest = false;

                if (response.status == 200) {
                  if (response.data[0] == "success") {
                    this.externaldata = { ...response.data[1] };

                    this.copyValuesFromExternalData(this.externaldata);

                    setTimeout(function () {}.bind(this), 1000);
                  } else {
                  }
                } else {
                  console.log("Your request is Unsuccessfull");
                }
              },

              (error) => {
                console.log(error);
              }
            )
            .catch((error) => {
              console.log(error.response);
            });
        }
      } 
      else if(this.internalFormData)
      {
        
        console.log("copying values from internal form");
        this.copyValuesFromExternalData(this.internalFormData);

       
      }
        else {
        this.preLoadComplete = true;
      }
    },


    saveForm: function () {
      

      var requestprops = new Object();



      if (this.formConditionallyFiltered.length > 0) {
        for (var i = 0; i < this.formConditionallyFiltered.length; i++) {
          requestprops[this.formConditionallyFiltered[i].exportname] = this.formConditionallyFiltered[i].value;
        }

        requestprops.query = this.queryList;

        console.log("Request Properties:" + JSON.stringify(requestprops));

        var requrl = this.submitUrl;

        console.log("Request Properties:" + JSON.stringify(requestprops));
        axios
          .post(requrl, requestprops)
          .then(
            (response) => {
              console.log("response:", response.data);
              this.updaterequest = false;

              if (response.status == 200) {
                if (response.data[0] == "success") {

                  alert("SUCCESSFULLY Created");
                  this.requiredfieldmsg = false;
                  if(this.clearDataOnSubmit)
                  {


                     console.log("Clearing Form Data");

                     if(this.rerenderChilds)
                     {
                       this.rerenderChilds = false;
                     } 
                     else
                     {
                       this.rerenderChilds = true;

                     }

                         


                     

                  }
                  else if(this.redirect)
                  {
                    if (response.data[1]) {
                    this.$router.push({ path: "/recommendationlist" });
                    }
                  }

                  setTimeout(function () {}.bind(this), 1000);
                } else {
                }
              } else {
                console.log("Your request is Unsuccessfull");
              }
            },

            (error) => {
              console.log(error);
            }
          )
          .catch((error) => {
            console.log(error.response);
          });
      }
    },
    
    submitFormFinal: function () {
        if (this.meetRequiredFields()) {
          if (this.requestType == "end") {
            console.log("Function is not set Yet");
          } else if (this.requestType == "bypage") {
            this.saveForm();
          }
        } else {
          this.requiredfieldmsg = true;
        }
      
    },
    satisfyPreloadQuery: function () {
      var satisfypreload = "";
      for (var i = 0; i < this.requiredQueryForPreLoad.length; i++) {
        if (this.queryList.hasOwnProperty(this.requiredQueryForPreLoad[i])) {
          satisfypreload = true;
        } else {
          satisfypreload = false;
          break;
        }
      }

      return satisfypreload;
    },
     satisfyInitialQuery: function () {
      var satisfyinitial = "";
      if(this.requiredQueryForInitialLoad.length > 0)
      {
      for (var i = 0; i < this.requiredQueryForInitialLoad.length; i++) {
        if (this.queryList.hasOwnProperty(this.requiredQueryForInitialLoad[i])) {
          satisfyinitial = true;
        } else {
          satisfyinitial = false;
          break;
        }
      }

        return satisfyinitial;

      }
      else
      {
        return true;

      }


    },
    

    

    

    getObjectNames: function (obj) {
      return Object.getOwnPropertyNames(obj).sort();
    },

 
    fireRequiredFieldError: function (forminfo) {
      return forminfo.required == true &&
        forminfo.value == "" &&
        this.requiredfieldmsg
        ? true
        : false;
    },
    

    copyValuesFromExternalData: function (resultobj) {
      this.forms.forEach((item, index, arr) => {
        console.log("looping through forms "+index);
        if(this.conditionalFilterForm(item))
        {
                  console.log("looping through forms "+index+" Passed condition");

        var exvalue = get(resultobj, item.externalvalue);
                  console.log("Exvalue "+exvalue);

        if (exvalue != undefined && exvalue != "") {
          this.forms[index].value = exvalue;

          console.log("object:-" + item.externalvalue + ", Value : " + exvalue);
        }
       
        }
         else
        {
                        console.log("condition failed");
    
        }
      }, this);
      

      this.preLoadComplete = true;
    },

  },
  computed: {
    queryList() {
      return this.$route.query;
    },
    
  },
  watch: {
    
    forms: {
      handler: function (val, oldVal) {
       console.log("Form Value is Changing");
              this.createUidData();

      },
      deep: true
    },
   

  },
};
</script>

<style scoped>
.error_page_form {
  width: 100%;
  height: 100vh;
}
.error_page_message {
  font-size: 25px;
  font-weight: bold;
  color: blue;
}
.form_submit_wrap {
}
.next_button {
  width: 200px;
  padding: 6px;
  background: blue;
  color: #fff;
  background: linear-gradient(
    267.55deg,
    #f52b2b 0%,
    rgba(112, 39, 230, 0.59) 100%
  );
  border-radius: 30px;
  text-align: center;
}
.finish_button {
  width: 200px;
  padding: 6px;
  color: #fff;
  background: #a44c0c;
  border-radius: 30px;
  text-align: center;
}
.previous_button {
  width: 200px;
  padding: 6px;
  background: blue;
  color: #fff;
  background: linear-gradient(
    267.55deg,
    #f52b2b 0%,
    rgba(112, 39, 230, 0.59) 100%
  );
  border-radius: 30px;
  text-align: center;
}
.error_msg_required {
  color: red;
  font-size: 18px;
}

.form_wrapper {
  transform: rotate(0deg);
}
.page_circle {
  width: 50px;
  height: 50px;
  font-size: 20px;
  border-radius: 50%;
  background-color: #97c516;
  margin-left: auto;
  margin-right: auto;
}
.page_title_default {
  text-align: center;
  font-size: 20px;
}
.page_title_active {
  color: #3325d3;
}
.page_title_inactive {
  color: #000;
}
.close_form
{
  width:30px;
  height:30px;
  position:absolute;
  right:-25px;
  top:-25px;
  background:white;
  border-radius: 50%;
}
.close_form img
{
  max-width:100%;
  max-height: 100%;
}
</style>