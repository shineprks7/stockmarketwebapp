

<template>

      <v-container class="" >

        
        <div  v-if="satisfyInitialQuery()">

          <header>

              <span class=""> {{formDisplayName}} </span>


          </header>
          <v-divider class="mt-4 mb-7">

          </v-divider>


          <section class="form_wrapper" v-if="this.componentmounted && this.preLoadComplete ? true:false" >
            <main v-for="form in this.forms" :key="form.uid">
           
             
             
              <textinput
                    :inputvalue ="form.value"
                    :labelname = "form.label"
                    :formuid= "form.uid" 

                    class="mt-7 input_class_style1"

                    v-if="conditionalCheckForm(form, 'text')"
                     v-on:messageFromText="messageReceivedFromText"

                    />

                <emailinput
                    :inputvalue ="form.value"
                    :labelname = "form.label"
                    :formuid= "form.uid" 

                    class="mt-7 input_class_style1"

                    v-if="conditionalCheckForm(form, 'email')"
                    v-on:messageFromEmail="messageReceivedFromEmail"

                />

                <textinputsingle
                    :inputvalue ="form.value"
                    :labelname = "form.label"
                    :formuid= "form.uid" 

                    class="mt-7 input_class_style1"

                    v-else-if= "conditionalCheckForm(form, 'textsingle')"
                     v-on:messageFromText="messageReceivedFromText"

                    />

               <richtext
                    :inputvalue ="form.value"
                    :labelname = "form.label"
                    :formuid= "form.uid" 

                    class="mt-7 "

                    v-else-if="conditionalCheckForm(form, 'richtext')"

                     v-on:messageFromText="messageReceivedFromText"

                    />
              <dateinput
                    :inputvalue ="form.value"
                    :labelname = "form.label"
                    :formuid= "form.uid" 

                    class="mt-7 input_class_style1"

                    v-else-if="conditionalCheckForm(form, 'date')"
                     v-on:messageFromText="messageReceivedFromText"

                    />

              <numberinput
                    :inputvalue ="form.value"
                    :labelname = "form.label"
                    :formuid= "form.uid" 
                    class="mt-7 input_class_style1"

                      v-on:messageFromText="messageReceivedFromText"


                      v-else-if="conditionalCheckForm(form, 'number')"

                    />
                <selectoptions
                      :options  ="form.options ? form.options :[]"
                      :inputvalue ="form.value"

                      :labelname = "form.label"
                      :formuid = "form.uid"
                      :optionconditions ="form.optionconditions"
                      :uids = "associatedFormData( form.associatedUids, forms)"

                      v-else-if="form.inputtype=='selectoptions'"
                      class="mt-7"

                      v-on:messageFromText="messageReceivedFromText" />

                      <optioninput
                      :options  ="form.options ? form.options :[]"
                      :inputvalue ="form.value"

                      :labelname = "form.label"
                      :formuid = "form.uid"
                      v-else-if="conditionalCheckForm(form, 'radiooptions')"
                      class="mt-7"

                      v-on:messageFromOption="messageReceivedFromOption" />
                     

                  <comboboxinput
                      :options  ="form.options ? form.options :[]"
                      :inputvalue ="form.value"

                      :labelname = "form.label"
                      :formuid = "form.uid"
                      v-else-if="conditionalCheckForm(form, 'checkoptions')"
                      class="mt-7"

                      v-on:messageFromText="messageReceivedFromText" />

                      

                      <imageuploader
                    :inputvalue ="form.value"
                    :labelname = "form.label"
                    :uploadurl ="form.uploadurl"
                    :formuid= "form.uid" 

                    class="mt-7 input_class_style1"

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

             

          </section>

          <v-divider class="mt-4 mb-4">

          </v-divider>

          <footer class="mt-10 pl-16 pr-16 d-flex justify-space-between flex-row-reverse form_submit_wrap">

              

                <div class="finish_button"   v-on:click="submitFormFinal()" >

                  SUBMIT

                </div> 
                
            </footer>



          


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

import numberinput from "../forminputs/numberinput.vue";
import optioninput from "../forminputs/optioninput.vue";
import textinput from "../forminputs/textinput.vue";
import richtext from "../forminputs/richtext.vue";
import dateinput from "../forminputs/dateinput.vue";
import selectoptions from "../forminputs/selectoptions.vue";
import checkboxinput from "../forminputs/checkboxinput.vue";
import comboboxinput from "../forminputs/comboboxinput.vue";

import textinputsingle from "../forminputs/textinputsingle.vue";
import emailinput from "../forminputs/emailinput.vue";

import imageuploader from "../forminputs/imageuploader.vue";

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

  props: {},

  data: function () {
    return {
      optionvaluereceived: "not received yet",

      componentmounted: false,

      dynamicQueryFields: [],
      formurl: "/dynamicformtest",

      externaldata: "",
      displaystyle: "singlepage",
      requestType: "bypage",

      preLoadComplete: false,

      requiredQueryForPreLoad: ["companyid"],
      requiredQueryForInitialLoad:[],

      preLoadUrl: "/api/ipoListingByCompany",

      formname: "ipocreatorform",
      formDisplayName: "Change Profile Name",
      pages: 1,
      finalUrl: "",

      requiredfieldmsg: false,

      copyOfForms:[],

   

      forms: [
        

                  {
           uid:1,
             type:'main',
             label:'Select Geneder?',
             value:'',
             style:'default',
             inputtype:'radiooptions',
             required:true,
             options:[{id:1,name:'male',displayname:'Male',haschild:false},
                     {id:2,name:'female',displayname:'Female',haschild:false},
                     
                   ],
             exportname:'gender',
             page:1,
             externalvalue:'gender',   
             condition:[],      

             },
                      {
             uid:2,
             type:'main',
             label:'Select From Age?',
             value:'',
             style:'default',
             filteroption:true,
             associatedUids:[1,3],
             optionconditions:[
                {
                type:'ifthen',
                condition:[{get:'uid_1.value'}, '=','male'], 
                true:[{getEl:'name'},'>=', 21] ,
                false:[{getEl:'name'}, '>=', 18]
   
                },
                {
                  type:'filter',

                 condition:[{getEl:'name'},'<=', {get:'uid_3.value'}], 
                
                }],

             inputtype:'selectoptions',
             required:true,
             options:[{id:1,name:18,displayname:'18',haschild:false},
                     {id:2,name:19,displayname:'19',haschild:false},
                    {id:2,name:20,displayname:'20',haschild:false},
                    {id:3,name:21,displayname:'21',haschild:false},
                    {id:4,name:22,displayname:'22',haschild:false},
                    {id:5,name:23,displayname:'23',haschild:false},
                    {id:6,name:24,displayname:'24',haschild:false},
                    {id:7,name:25,displayname:'25',haschild:false},
                    {id:8,name:26,displayname:'26',haschild:false},
                    {id:9,name:27,displayname:'27',haschild:false},
                    {id:10,name:28,displayname:'28',haschild:false},
                    {id:11,name:29,displayname:'29',haschild:false},
                    {id:12,name:30,displayname:'30',haschild:false},
                    {id:13,name:31,displayname:'31',haschild:false},
                    {id:14,name:32,displayname:'32',haschild:false},
                    {id:15,name:33,displayname:'33',haschild:false},
                    {id:16,name:34,displayname:'34',haschild:false},
                    {id:17,name:35,displayname:'35',haschild:false},
                    {id:18,name:36,displayname:'36',haschild:false}

                   ],
             exportname:'fromage',
             page:1,
             externalvalue:'fromage',   
             condition:[],      

             },

                        {
           uid:3,
             type:'main',
             label:'Select To Age?',
             value:'',
             style:'default',
             inputtype:'selectoptions',
              associatedUids:[1,2],
             optionconditions:[
                {
                type:'ifthen',
                condition:[{get:'uid_1.value'}, '=','male'], 
                true:[{getEl:'name'},'>=', 21] ,
                false:[{getEl:'name'}, '>=', 18]
   
                },
                {
                  type:'filter',

                 condition:[{getEl:'name'},'>=', {get:'uid_2.value'}], 
                
                }],
             required:true,
             options:[
                  {id:1,name:18,displayname:'18',haschild:false},
                     {id:2,name:19,displayname:'19',haschild:false},
                    {id:2,name:20,displayname:'20',haschild:false},
                    {id:3,name:21,displayname:'21',haschild:false},
                    {id:4,name:22,displayname:'22',haschild:false},
                    {id:5,name:23,displayname:'23',haschild:false},
                    {id:6,name:24,displayname:'24',haschild:false},
                    {id:7,name:25,displayname:'25',haschild:false},
                    {id:8,name:26,displayname:'26',haschild:false},
                    {id:9,name:27,displayname:'27',haschild:false},
                    {id:10,name:28,displayname:'28',haschild:false},
                    {id:11,name:29,displayname:'29',haschild:false},
                    {id:12,name:30,displayname:'30',haschild:false},
                    {id:13,name:31,displayname:'31',haschild:false},
                    {id:14,name:32,displayname:'32',haschild:false},
                    {id:15,name:33,displayname:'33',haschild:false},
                    {id:16,name:34,displayname:'34',haschild:false},
                    {id:17,name:35,displayname:'35',haschild:false},
                    {id:18,name:36,displayname:'36',haschild:false}
                     
                   ],
             exportname:'toage',
             page:1,
             externalvalue:'toage',   
             condition:[], 

              }  
            

        


        
        
      ],
      /*


      */
    };
  },
  created() {},
  mounted() {
    this.componentmounted = true;

    this.preLoadData();
  },
  methods: {
    forceUpdateComponent() {
      this.$forceUpdate();
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
      } else {
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

        var requrl = this.finalUrl;

        console.log("Request Properties:" + JSON.stringify(requestprops));
        axios
          .post(requrl, requestprops)
          .then(
            (response) => {
              console.log("response:", response.data);
              this.updaterequest = false;

              if (response.status == 200) {
                if (response.data[0] == "success") {
                  if (response.data[1]) {
                    this.$router.push({ path: "/recommendationlist" });
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
        if(this.conditionalCheckForm(item))
        {
        var exvalue = get(resultobj, item.externalvalue);

        if (exvalue != undefined && exvalue != "") {
          this.forms[index].value = exvalue;

          console.log("object:-" + item.externalvalue + ", Value : " + exvalue);
        }
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
    forms:function(data1, data2)
    {
       this.copyForm();
    }
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
.input_class_style1 {
  width: 500px;
}
.form_wrapper {
  width: 700px;
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
</style>