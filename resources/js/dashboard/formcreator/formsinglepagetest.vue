

<template>

      <v-container class="" >

        
        <div v-if="pageRequirementPass() ">

          <header>

              <div class="d-flex justify-space-around">
                    <div class="page_title_wrap" v-for="page in this.pageurls" :key="page.page">
                        <div>
                           <div class="page_circle d-flex justify-center align-center"> <span>{{page.page }}</span> </div>
                        </div>
                        <div class="mt-4 page_title_default" v-bind:class="page.page == parsedPageNumber ? 'page_title_active':'page_title_inactive'">
                            {{page.title}}
                              
                        </div>



                    </div>

              </div>


          </header>
          <v-divider class="mt-4 mb-7">

          </v-divider>

          <section class="form_wrapper" v-if="this.componentmounted && this.preLoadComplete ? true:false" >
            <main v-for="form in formElementsByPage()" :key="form.uid">
           


             
              <textinput
                    :inputvalue ="form.value"
                    :labelname = "form.label"
                    :formuid= "form.uid" 

                    class="mt-7 input_class_style1"

                    v-if="form.inputtype=='text'"
                     v-on:messageFromText="messageReceivedFromText"

                    />

                <emailinput
                    :inputvalue ="form.value"
                    :labelname = "form.label"
                    :formuid= "form.uid" 

                    class="mt-7 input_class_style1"

                    v-if="form.inputtype=='email'"
                    v-on:messageFromEmail="messageReceivedFromEmail"

                />

                <textinputsingle
                    :inputvalue ="form.value"
                    :labelname = "form.label"
                    :formuid= "form.uid" 

                    class="mt-7 input_class_style1"

                    v-else-if="form.inputtype=='textsingle'"
                     v-on:messageFromText="messageReceivedFromText"

                    />

               <richtext
                    :inputvalue ="form.value"
                    :labelname = "form.label"
                    :formuid= "form.uid" 

                    class="mt-7 "

                    v-else-if="form.inputtype=='richtext'"
                     v-on:messageFromText="messageReceivedFromText"

                    />
              <dateinput
                    :inputvalue ="form.value"
                    :labelname = "form.label"
                    :formuid= "form.uid" 

                    class="mt-7 input_class_style1"

                    v-else-if="form.inputtype=='date'"
                     v-on:messageFromText="messageReceivedFromText"

                    />

              <numberinput
                    :inputvalue ="form.value"
                    :labelname = "form.label"
                    :formuid= "form.uid" 
                    class="mt-7 input_class_style1"

                      v-on:messageFromText="messageReceivedFromText"


                      v-else-if="form.inputtype=='number'"

                    />
                <selectoptions
                      :options  ="form.options ? form.options :[]"
                      :inputvalue ="form.value"

                      :labelname = "form.label"
                      :formuid = "form.uid"
                      v-else-if="form.inputtype=='options'"
                      class="mt-7"

                      v-on:messageFromText="messageReceivedFromText" />

                  <comboboxinput
                      :options  ="form.options ? form.options :[]"
                      :inputvalue ="form.value"

                      :labelname = "form.label"
                      :formuid = "form.uid"
                      v-else-if="form.inputtype=='checkoptions'"
                      class="mt-7"

                      v-on:messageFromText="messageReceivedFromText" />

                      

                      <imageuploader
                    :inputvalue ="form.value"
                    :labelname = "form.label"
                    :uploadurl ="form.uploadurl"
                    :formuid= "form.uid" 

                    class="mt-7 input_class_style1"

                    v-else-if="form.inputtype=='imageuploader'"
                     v-on:messageFromText="messageReceivedFromText"

                    />
                  
                  <div class="error_msg_required"  v-if="fireRequiredFieldError(form)" > {{form.label}} is required </div>


            </main>

             

          </section>

          <v-divider class="mt-4 mb-4">

          </v-divider>

          <footer class="mt-10 pl-16 pr-16 d-flex justify-space-between flex-row-reverse form_submit_wrap">

                <div class="next_button"  v-if="nextButton()" v-on:click="goToNextPage()">
                   NEXT
                </div>

                <div class="finish_button"  v-if="finishButton()" v-on:click="submitFormFinal()" >

                  FINISH

                </div> 
                <div class="previous_button"  v-if="previousButton()" v-on:click="goToPreviousPage()">

                  PREVIOUS

                </div>
            </footer>



          External Data - {{this.externaldata}} </br> </br>
          Required Fields Filled - {{meetRequiredFields()}} </br></br>

          Page Query - {{hasPageQuery()}} </br>

          Query List - {{queryList}} </br>

          Page Requirement -- {{pageRequirementPass()}} </br>

          Satisfy Preload -- {{satisfyPreloadQuery()}} </br>

          Page Urls -- {{this.pageurls}} </br> </br> </br> </br>


          <div style="color:blue"> Page Forms -- </div>
          </br> </br>
           {{this.formElementsByPage()}} </br>

         

          


        </div>

        <div  class="error_page_form d-flex justify-center align-center" v-if="!pageRequirementPass()"> 

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
             inputtype:'options',
             required:true,
             options:[{id:1,name:'mainboard',displayname:'Main Board',haschild:false},
                     {id:2,name:'sme',displayname:'SME IPO',haschild:false},
                   ],
             exportname:'typeofipo',
             page:3,
             externalvalue:false,

                

             },
 

*/

import numberinput from "./numberinput.vue";
import optioninput from "./optioninput.vue";
import textinput from "./textinput.vue";
import richtext from "./richtext.vue";
import dateinput from "./dateinput.vue";
import selectoptions from "./selectoptions.vue";
import checkboxinput from "./checkboxinput.vue";
import comboboxinput from "./comboboxinput.vue";

import textinputsingle from "./textinputsingle.vue";
import emailinput from "./emailinput.vue";

import imageuploader from "./imageuploader.vue";

import get from "lodash/get";

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
  },

  props: {},

  data: function () {
    return {
      optionvaluereceived: "not received yet",

      componentmounted: false,

      dynamicQueryFields: [],
      formurl: "/dynamicformtest",

      externaldata: "",
      displaystyle: "multipage",
      requestType: "bypage",

      preLoadComplete: false,

      requiredQueryForPreLoad: ["bucketid"],
      preLoadUrl: "/api/ipoListingByCompany",

      formname: "ipocreatorform",
      formDisplayName: "Create IPO Information",
      pages: 4,
      finalUrl: "",

      requiredfieldmsg: false,

      pageurls: [
        {
          page: 1,
          url: "/api/createIpoCompany",

          updatefields: ["companyid"],
          title: "Basic Information",
        },
        {
          page: 2,
          url: "/api/createIpoDetail",
          updatefields: ["companyid"],
          title: "IPO Details",
        },
        {
          page: 3,
          url: "/api/createIpoLotsandSchedule",

          updatefields: ["companyid"],
          title: "Time Table and Lots",
        },
        {
          page: 4,
          url: "/api/createIpoCompanyAdditionalInfo",

          updatefields: ["companyid"],
          title: "Company Information",
        },
      ],

      /*
 required=['issue_type','open_date','close_date','face_value','issue_price']
    optional = ['issue_price_max','listing_at','offer_for_sale','qib_shares','retail_shares','nii_shares'];
  
  */

      forms: [
        {
          uid: 1,
          type: "main",
          label: "User Names",
          value: [],
          style: "default",
          inputtype: "multichips",
          externalparseArray: [
            {
              value: "name",
              externalobj: "uniquename",
              type: "externalobj",
            },
            {
              value: "id",
              externalobj: "id",
              type: "externalobj",
            },
            {
              value: "displayname",
              externalobj: "name",
              type: "externalobj",
            },
          ],

          required: true,
          options: "",
          exportname: "companyname",
          page: 1,
          externalvalue: "company_name",
        },
      ],
      /*

             $lots = $request->input('lots');


      $min_lot = $request->input('min_lot');
      $max_lot = $request->input('max_lot');
      $min_shares = $request->input('min_shares');
      $max_shares = $request->input('max_shares');
      $min_cut_off = $request->input('min_cut_off');
      $max_cut_off = $request->input('max_cut_off');


      $allotment_date = $request->input('allotment_date');
      $refund_initiation = $request->input('refund_initiation');
      $shares_to_demat = $request->input('shares_to_demat');
      $listing_date = $request->input('listing_date');

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

    createWithNext: function () {
      var pagefilters = this.pageurls.filter(
        (abc) => abc.page == this.parsedPageNumber
      );

      var requestprops = new Object();

      var formsfiltered = this.forms.filter(
        (abc) => abc.page == this.parsedPageNumber
      );

      if (pagefilters.length > 0 && formsfiltered.length > 0) {
        for (var i = 0; i < formsfiltered.length; i++) {
          requestprops[formsfiltered[i].exportname] = formsfiltered[i].value;
        }

        requestprops.query = this.queryList;

        console.log("Request Properties:" + JSON.stringify(requestprops));

        var requrl = pagefilters[0].url;
        axios
          .post(requrl, requestprops)
          .then(
            (response) => {
              console.log("response:", response.data);
              this.updaterequest = false;

              if (response.status == 200) {
                if (response.data[0] == "success") {
                  if (response.data[1]) {
                    var receivedquery = response.data[1];

                    receivedquery.page = this.parsedPageNumber + 1;

                    this.$router.push({
                      path: this.formurl,
                      query: receivedquery,
                    });
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

    createWithFinish: function () {
      var pagefilters = this.pageurls.filter(
        (abc) => abc.page == this.parsedPageNumber
      );

      var requestprops = new Object();

      var formsfiltered = this.forms.filter(
        (abc) => abc.page == this.parsedPageNumber
      );

      if (pagefilters.length > 0 && formsfiltered.length > 0) {
        for (var i = 0; i < formsfiltered.length; i++) {
          requestprops[formsfiltered[i].exportname] = formsfiltered[i].value;
        }

        requestprops.query = this.queryList;

        console.log("Request Properties:" + JSON.stringify(requestprops));

        var requrl = pagefilters[0].url;

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
    updateWithNext: function () {},
    goToPreviousPage: function () {
      let newquery = { ...this.queryList }; // `{ foo: 'bar' }`

      console.log("New Query " + JSON.stringify(newquery));

      newquery.page = this.parsedPageNumber - 1;

      this.$router.push({ path: this.formurl, query: newquery });
    },

    goToNextPage: function () {
      if (this.parsedPageNumber < this.pages) {
        if (this.meetRequiredFieldsByPage()) {
          if (this.requestType == "end") {
            this.requiredfieldmsg = false;

            this.$router.push({
              path: this.formurl,
              query: { page: this.parsedPageNumber + 1 },
            });

            console.log("Went To Next Page");
          } else if (this.requestType == "bypage") {
            this.createWithNext();
          }
        } else {
          this.requiredfieldmsg = true;
        }
      } else {
        console.log("Unable to go To Next Page");
      }
    },
    submitFormFinal: function () {
      if (this.parsedPageNumber == this.pages) {
        if (this.meetRequiredFieldsByPage()) {
          if (this.requestType == "end") {
            console.log("Function is not set Yet");
          } else if (this.requestType == "bypage") {
            this.createWithFinish();
          }
        } else {
          this.requiredfieldmsg = true;
        }
      } else {
        console.log("Unable to go To Next Page");
      }
    },
    satisfyPreloadQuery: function () {
      var satisfypreload = "not defined";
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
    nextButton: function () {
      if (this.pageRequirementPass()) {
        return this.parsedPageNumber < this.pages ? true : false;
      } else {
        return false;
      }
    },
    finishButton: function () {
      if (this.pageRequirementPass()) {
        return this.parsedPageNumber == this.pages ? true : false;
      } else {
        return false;
      }
    },
    previousButton: function () {
      if (this.pageRequirementPass()) {
        return this.parsedPageNumber != 1 ? true : false;
      } else {
        return false;
      }
    },

    pageRequirementPass: function () {
      if (this.pages > 1) {
        if (this.hasPageQuery) {
          return this.queryList.page <= this.pages && this.queryList.page > 0
            ? true
            : false;
        } else {
          return false;
        }
      } else {
        return false;
      }
    },

    formElementsByPage: function () {
      return this.forms.filter((abc) => abc.page == this.queryList.page);
    },

    getObjectNames: function (obj) {
      return Object.getOwnPropertyNames(obj).sort();
    },

    meetRequiredFieldsByPage: function () {
      var parsedpagenum = this.parsedPageNumber;

      var filter = this.forms.filter(
        (abc) =>
          abc.page == parsedpagenum && abc.required == true && abc.value == ""
      );

      if (filter.length > 0 && validationstatus) {
        for (let i = 0; i < filter.length; i++) {
          if (filter[i].hasOwnProperty("validation")) {
            if (filter[i].validation == false) {
              return false;
            }
          }
        }

        return false;
      } else {
        return true;
      }
    },
    meetRequiredFields: function () {
      var filter = this.forms.filter(
        (abc) => abc.required == true && abc.value == ""
      );

      if (filter.length > 0) {
        return false;
      } else {
        return true;
      }
    },
    fireRequiredFieldError: function (forminfo) {
      return forminfo.required == true &&
        forminfo.value == "" &&
        this.requiredfieldmsg
        ? true
        : false;
    },
    messageReceivedFromOption: function (formuid, optionval) {
      this.optionvaluereceived = optionval;

      var filter = this.forms.filter((abc) => abc.uid == formuid);

      if (filter.length > 0) {
        var index = this.forms.indexOf(filter[0]);

        this.forms[index].value = optionval;
      } else {
        console.log("Form ID is not found");
      }
    },
    messageReceivedFromText: function (formuid, value) {
      var filter = this.forms.filter((abc) => abc.uid == formuid);

      if (filter.length > 0) {
        var index = this.forms.indexOf(filter[0]);

        this.forms[index].value = value;
      } else {
        console.log("Form ID is not found");
      }
    },
    messageReceivedFromEmail: function (formuid, value, validation) {
      var filter = this.forms.filter((abc) => abc.uid == formuid);

      if (filter.length > 0) {
        var index = this.forms.indexOf(filter[0]);

        this.forms[index].value = value;
        this.forms[index].validation = validation;
      } else {
        console.log("Form ID is not found");
      }
    },
    hasPageQuery: function () {
      if (this.queryList.hasOwnProperty("page")) {
        return true;
      } else {
        return false;
      }
    },

    copyValuesFromExternalData: function (resultobj) {
      this.forms.forEach((item, index, arr) => {
        var exvalue = get(resultobj, item.externalvalue);

        if (exvalue != undefined && exvalue != "") {
          this.forms[index].value = exvalue;

          console.log("object:-" + item.externalvalue + ", Value : " + exvalue);
        }
      }, this);

      this.preLoadComplete = true;
    },

    manualCopyExternalFormData: function () {},
  },
  computed: {
    queryList() {
      return this.$route.query;
    },
    parsedPageNumber() {
      return parseInt(this.queryList.page);
    },
  },
  watch: {},
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