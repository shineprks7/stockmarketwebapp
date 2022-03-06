

<template>

      <v-container class="" >

        
        <div v-if="pageRequirementPass() ">

          <header>

              <div class="d-flex justify-space-around">
                    <div class="page_title_wrap" v-for="page in this.pageurls" :key="page.page">
                        <div>
                           <div v-if="meetRequiredFieldsByPreviousPage(page.page)"  v-on:click="goToParticularPage(page.page)" class="page_circle d-flex justify-center align-center" v-bind:class="page.page == parsedPageNumber ? 'page_circle_active':'page_circle_inactive'"> <span>{{page.page }}</span> </div>

                           <div v-if="!meetRequiredFieldsByPreviousPage(page.page)"  class="page_circle page_circle_disabled d-flex justify-center align-center" > <span>{{page.page }}</span> </div>

                           
                        </div>
                        <div v-if="pages < 6"  class="mt-4 page_title_default" v-bind:class="page.page == parsedPageNumber ? 'page_title_active':'page_title_inactive'">
                            {{page.title}}
                              
                        </div>
                        <div v-if="pages > 5 && parsedPageNumber == page.page"  class="mt-4 page_title_default" v-bind:class="page.page == parsedPageNumber ? 'page_title_active':'page_title_inactive'">
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
                  <div class="error_msg_validation"  v-if="fireValidationError(form)" > {{form.hasOwnProperty('validationMsg') ? form.validationMsg : 'Validation Error Occured' }} </div>
              
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
     
    import numberinput from '../forminputs/numberinput.vue';
    import optioninput from '../forminputs/optioninput.vue';
    import textinput from '../forminputs/textinput.vue';
    import richtext from '../forminputs/richtext.vue';
    import dateinput from '../forminputs/dateinput.vue';
    import selectoptions from '../forminputs/selectoptions.vue';
    import checkboxinput from '../forminputs/checkboxinput.vue';
    import comboboxinput from '../forminputs/comboboxinput.vue';

    import textinputsingle from '../forminputs/textinputsingle.vue';

    import imageuploader from '../forminputs/imageuploader.vue';
    import emailinput from '../forminputs/emailinput.vue';

     import get from 'lodash/get';


    export default {

      components:{

     'numberinput':numberinput,
     'optioninput':optioninput,
     'richtext':richtext,
     'textinput':textinput,
     'dateinput':dateinput,
     'selectoptions':selectoptions,
     'checkboxinput':checkboxinput,
     'comboboxinput':comboboxinput,
     'textinputsingle':textinputsingle,
     'imageuploader':imageuploader,
     'emailinput':emailinput,

    },


    props:{
     
     



    },

    data: function () {
        return {


          optionvaluereceived:'not received yet',

          componentmounted:false,

          dynamicQueryFields:[],

          formurl:"/createrightsform",

          externaldata:'',
          displaystyle:'multipage',
          requestType:'bypage',

          preLoadComplete:false,

          requiredQueryForPreLoad:['companyid'],
          preLoadUrl:'/api/rightsListingByCompany',

          formname:'ipocreatorform',
          formDisplayName:'Create Rights Issue Information',
          pages:4,
          finalUrl:'',

          requiredfieldmsg:false,

          validationfailedmsg:false,

          pageurls:[{
                     page:1
                     ,
                     url:'/api/createRightsCompany',
                     
                     updatefields:['companyid'],
                     title:'Rights Issue Basic Information',
                     skipable:false,
                     datasaved:false,

                     }
                     ,
                     {
                       page:2,
                     url:'/api/createRightsDetails',
                     updatefields:['companyid'],
                     title:'Rights Issue Details',
                     skipable:false,
                     datasaved:false,

                     },
                     {
                       page:3,
                       url:'/api/createRightsAllotmentData',
       
                     updatefields:['companyid'],
                     title:'Allotment Data',
                     skipable:false,
                     datasaved:false,

                       },
                        {
                       page:4,
                       url:'/api/createRightsCompanyAdditionalInfo',
       
                     updatefields:['companyid'],
                     title:'Company Information',
                     skipable:false,
                     datasaved:false,

                       },
                 
                       
                       ],

/*
 required=['issue_type','open_date','close_date','face_value','issue_price']
    optional = ['issue_price_max','listing_at','offer_for_sale','qib_shares','retail_shares','nii_shares'];
  
  */

          forms:[{
             uid:1,
             type:'main',
             label:'Enter Company Name',
             value:'',
             style:'default',
             inputtype:'textsingle',
             required:true,
             options:'',
             exportname:'companyname',
             page:1,
             externalvalue:'company_name',
             },
             {
             uid:2,
             type:'main',
             label:'Enter Details of Company',
             value:'',
             style:'default',
             inputtype:'richtext',
             required:true,
             options:'',
             exportname:'about',
             page:1,
             externalvalue:'about',

             },
             {
             uid:3,

             type:'main',
             label:'Rights Issue Open Date',
             value:'',
             style:'default',
             inputtype:'date',
             required:true,
             options:'',
             exportname:'open_date',
             page:2,
             externalvalue:'right_issue_details[0].open_date',

             },
               {
             uid:4,

             type:'main',
             label:'Rights Issue Close Date',
             value:'',
             style:'default',
             inputtype:'date',
             required:true,
             options:'',
             exportname:'close_date',
             page:2,
             externalvalue:'right_issue_details[0].close_date',

             },
                 {
             uid:5,
             type:'main',
             label:'Security Name',
             value:'',
             style:'default',
             inputtype:'text',
             required:true,
             options:'',
             exportname:'security_name',
             page:2,
             externalvalue:'right_issue_details[0].security_name',

             },
               {
             uid:6,
             type:'main',
             label:'Rights Price',
             value:0,
             style:'default',
             inputtype:'number',
             required:true,
             options:'',
             exportname:'issue_price',
             page:2,
             externalvalue:'right_issue_details[0].issue_price',

             },
             {
            
             uid:7,
             type:'main',
             label:'Face Value of Rights',
             value:0,
             style:'default',
             inputtype:'number',
             required:true,
             options:'',
             exportname:'face_value',
             page:2,
            externalvalue:'right_issue_details[0].face_value',

             },
               {
            
             uid:8,
             type:'main',
             label:'Issue Size (Shares)',
             value:0,
             style:'default',
             inputtype:'number',
             required:true,
             options:'',
             exportname:'issue_size_shares',
             page:2,
            externalvalue:'right_issue_details[0].issue_size_shares',

             },
                {
            
             uid:9,
             type:'main',
             label:'Issue Size (Amount)',
             value:0,
             style:'default',
             inputtype:'number',
             required:true,
             options:'',
             exportname:'issue_size_amount',
             page:2,
            externalvalue:'right_issue_details[0].issue_size_amount',

             },
             
           
            {
            
             uid:10,
             type:'main',
             label:'Listing At',
             value:'',
             style:'default',
             inputtype:'text',
             required:true,
             options:[{id:1,name:'nse',displayname:'NSE',haschild:false},
                     {id:2,name:'bse',displayname:'BSE',haschild:false},
                   ],
             exportname:'listing_at',
             page:2,
             externalvalue:'right_issue_details[0].listing_at',

             },
               {
            
             uid:11,
             type:'main',
             label:'Market Lot',
             value:'',
             style:'default',
             inputtype:'text',
             required:true,
             options:'',
             exportname:'market_lot',
             page:3,
             externalvalue:'rights_allot_details[0].market_lot',

             },
               {
            
             uid:12,
             type:'main',
             label:'Lots',
             value:'',
             style:'default',
             inputtype:'number',
             required:true,
             options:[],
             exportname:'lots',
             page:3,
             externalvalue:'rights_allot_details[0].lots',

             },
               {
            
             uid:13,
             type:'main',
             label:'Payment Terms',
             value:'',
             style:'default',
             inputtype:'text',
             required:true,
             options:[],
             exportname:'terms_payment',
             page:3,
             externalvalue:'rights_allot_details[0].terms_payment',

             },
               {
            
             uid:14,
             type:'main',
             label:'Entitlement',
             value:'',
             style:'default',
             inputtype:'text',
             required:true,
             options:[],
             exportname:'entitlement',
             page:3,
             externalvalue:'rights_allot_details[0].entitlement',

             },
  
             
             {
             uid:15,

             type:'main',
             label:'Recorded Date',
             value:'',
             style:'default',
             inputtype:'date',
             required:true,
             options:'',
             exportname:'record_date',
             page:3,
             externalvalue:'rights_allot_details[0].record_date',

             },
             {
               uid:16,

             type:'main',
             label:'Date of Allotment',
             value:'',
             style:'default',
             inputtype:'date',
             required:true,
             options:'',
             exportname:'date_of_allotment',
             page:3,
             externalvalue:'rights_allot_details[0].date_of_allotment',

             },
             {
               uid:17,

             type:'main',
             label:'Renunciation Date',
             value:'',
             style:'default',
             inputtype:'date',
             required:true,
             options:'',
             exportname:'rii_allocation_ratio',
             page:3,
             externalvalue:'rights_allot_details[0].renunciation_date',

             },
              
              
               
              {
            
             uid:18,
             type:'main',
             label:'Company Logo',
             value:'',
             style:'default',
             inputtype:'imageuploader',
             required:false,
             options:'',
             uploadurl:'/api/rightscompanylogoupload',
             exportname:'',
             page:4,
             externalvalue:'logo_url',

             },
              {
            
             uid:19,
             type:'main',
             label:'Company Address',
             value:'',
             style:'default',
             inputtype:'richtext',
             required:false,
             options:'',
             exportname:'address',
             page:4,
             externalvalue:'address',

             },
               {
            
             uid:20,
             type:'main',
             label:'Email Id',
             value:'',
             style:'default',
             inputtype:'email',
             required:true,
             options:'',
             exportname:'email',
             page:4,
             externalvalue:'email',
             validation:false,
             validationMsg:'Email Id is not Valid',

             },
             {
            
             uid:21,
             type:'main',
             label:'Phone Number',
             value:'',
             style:'default',
             inputtype:'text',
             required:true,
             options:'',
             exportname:'phone',
             page:4,
             externalvalue:'phone',

             },
                 {
            
             uid:22,
             type:'main',
             label:'Website',
             value:'',
             style:'default',
             inputtype:'text',
             required:false,
             options:'',
             exportname:'website',
             page:4,
             externalvalue:'website',

             }
             
             ],    
             /*

           

      */

          
          
        }
    },
    created()
    {

    
      
       
    },
    mounted()
    {

      this.componentmounted = true;


      this.preLoadData();

    },
    methods:{

      forceUpdateComponent() {
      
      this.$forceUpdate();  
     },
      preLoadData:function()
      {
        if(this.satisfyPreloadQuery())
        {

          //request 
         
         if(this.preLoadUrl)
         {
          
          // Axios request 

             var requestprops = new Object();
             requestprops.query= this.queryList;


               axios.post(this.preLoadUrl, requestprops
         
                )
                 .then((response) => { 
                  console.log("response:",response.data)
                  this.updaterequest = false;

                  if(response.status==200)
                    {
    

                       if(response.data[0]=="success")
                       {       

                      
                          this.externaldata = {...response.data[1]};

                          this.copyValuesFromExternalData(this.externaldata);

                          setTimeout(function()
                           {


                            }.bind(this),1000);

                        }
                   
                        else
                        {

                        }
                 

                    }
                    else
                    {


                     console.log("Your request is Unsuccessfull");   

                      
                    }
    
                }, 
        
                 (error)=> {
                 console.log(error)

                  }
      
                  )
                 .catch(error => {
                  console.log(error.response)
                  });



                  }

        }
        else
        {
          this.preLoadComplete = true;
        }

      },


      createWithNext:function()
      {

          var pagefilters = this.pageurls.filter(abc => abc.page == this.parsedPageNumber);


          var requestprops = new Object();


          var formsfiltered =  this.forms.filter(abc => abc.page == this.parsedPageNumber);


        

          if(pagefilters.length>0 && formsfiltered.length>0)
          {

            
            for(var i=0;i<formsfiltered.length;i++)
            {
             requestprops[formsfiltered[i].exportname] = formsfiltered[i].value;
            
            }
           

             requestprops.query= this.queryList;


         console.log("Request Properties:"+JSON.stringify(requestprops));
          
          var requrl = pagefilters[0].url;
          axios.post(requrl,requestprops
         
          )
          .then((response) => { 
          console.log("response:",response.data)
               this.updaterequest = false;

               if(response.status==200)
                 {
    

                    if(response.data[0]=="success")
                   {       

          

                      if(response.data[1])
                      {

                        var receivedquery = response.data[1];

                        receivedquery.page = this.parsedPageNumber+1;


                       this.$router.push({ path: this.formurl, query: receivedquery });
                        


                      }

                        setTimeout(function()
                        {


                        }.bind(this),1000);

                   }
                   
                   else
                   {

                   }
                 

                }
                else
                {


                  console.log("Your request is Unsuccessfull");   

                      
                 }
    
            }, 
        
               (error)=> {
             console.log(error)

              }
      
              )
        .catch(error => {
         console.log(error.response)
        });

        }

      },
      
      
     
      createWithFinish:function()
      {
         var pagefilters = this.pageurls.filter(abc => abc.page == this.parsedPageNumber);


          var requestprops = new Object();


          var formsfiltered =  this.forms.filter(abc => abc.page == this.parsedPageNumber);


        

          if(pagefilters.length>0 && formsfiltered.length>0)
          {

            
            for(var i=0;i<formsfiltered.length;i++)
            {
             requestprops[formsfiltered[i].exportname] = formsfiltered[i].value;
            
            }
           

             requestprops.query= this.queryList;


         console.log("Request Properties:"+JSON.stringify(requestprops));
          
          var requrl = pagefilters[0].url;

          console.log("Request Properties:"+JSON.stringify(requestprops));
          axios.post(requrl,requestprops
         
          )
          .then((response) => { 
          console.log("response:",response.data)
               this.updaterequest = false;

               if(response.status==200)
                 {
    

                    if(response.data[0]=="success")
                   {       

          

                      if(response.data[1])
                      {

                    

                       this.$router.push({ path: '/recommendationlist'});


                      }

                        setTimeout(function()
                        {


                        }.bind(this),1000);

                   }
                   
                   else
                   {

                   }
                 

                }
                else
                {


                  console.log("Your request is Unsuccessfull");   

                      
                 }
    
            }, 
        
               (error)=> {
             console.log(error)

              }
      
              )
        .catch(error => {
         console.log(error.response)
        });

        }

      },
      updateWithNext:function()
      {

      },
      goToPreviousPage:function()
      {

        
           let newquery = { ...this.queryList }; // `{ foo: 'bar' }`

           console.log("New Query "+JSON.stringify(newquery));

           newquery.page = this.parsedPageNumber-1;


             this.$router.push({ path: this.formurl, query: newquery });
            

      },
      goToParticularPage:function(pagenum)
      {

        
           let newquery = { ...this.queryList }; // `{ foo: 'bar' }`

           console.log("New Query "+JSON.stringify(newquery));

           newquery.page = pagenum;


             this.$router.push({ path: this.formurl, query: newquery });
            

      },

      
      goToNextPage:function()
      {

       
        
         if(this.parsedPageNumber < this.pages)
         {
             if(this.meetRequiredFieldsByPage())
            {

              if(this.requestType=="end")
              {
              this.requiredfieldmsg = false;

             this.$router.push({ path: this.formurl, query: { page: this.parsedPageNumber+1 } });

              console.log("Went To Next Page");
              }
              else if(this.requestType=="bypage")
              {
                this.createWithNext();
              }
            }
            else
            {
                            this.requiredfieldmsg = true;


            }

         }
         else
         {
           console.log("Unable to go To Next Page");
         }


      },
      submitFormFinal:function()
      {
           if(this.parsedPageNumber == this.pages)
         {
             if(this.meetRequiredFieldsByPage())
            {

              if(this.requestType=="end")
              {


              console.log("Function is not set Yet");
              }
              else if(this.requestType=="bypage")
              {
                this.createWithFinish();
              }
            }
            else
            {
                            this.requiredfieldmsg = true;


            }

         }
         else
         {
           console.log("Unable to go To Next Page");
         }



      },
      satisfyPreloadQuery:function()
      {
         var satisfypreload = 'not defined';

         for(var i=0; i<this.requiredQueryForPreLoad.length; i++)
         {

            if(this.queryList.hasOwnProperty(this.requiredQueryForPreLoad[i]))
            {
              satisfypreload = true;

            }
            else
            {
              satisfypreload = false;
              break;
            }

         }

         return satisfypreload;

      },
      nextButton:function()
      { 
        if(this.pageRequirementPass())
        {
        return this.parsedPageNumber < this.pages ? true : false;
        }
        else
        {
          return false;
        }

      },
      finishButton:function()
      { 
        if(this.pageRequirementPass())
        {
        return this.parsedPageNumber == this.pages ? true : false;
        }
        else
        {
          return false;
        }

      },
       previousButton:function()
      { 
        if(this.pageRequirementPass())
        {
        return this.parsedPageNumber != 1 ? true : false;
        }
        else
        {
          return false;
        }

      },
     
      pageRequirementPass:function()
      {
         
               
         if(this.pages>1)
         {

              if(this.hasPageQuery)
              {

                  return this.queryList.page <= this.pages && this.queryList.page > 0 ? true : false;

              }
              else
              {

                return false;

              }

           
         }
         else
         {
             return false;

         }
            

            


      },
      
      formElementsByPage:function()
      {

         return this.forms.filter(abc => abc.page == this.queryList.page);


      },

      getObjectNames:function(obj)
      {
          
          return Object.getOwnPropertyNames(obj).sort();

      },

       meetRequiredFieldsByPage:function()
      {

        var parsedpagenum = this.parsedPageNumber;

        var filter = this.forms.filter(abc => abc.page == parsedpagenum  && abc.required == true && abc.value == "");

         if(filter.length > 0 )
         {
           

            return false;
         }
         else
         {
             for(let i=0; i<this.forms.length; i++)
             {
                if(this.forms[i].hasOwnProperty('validation')){

                       if(this.forms[i].validation == false)
                       {
                         this.validationfailedmsg = true;
                         return false;
                         
                       }
                }

             }
                 
                 this.validationfailedmsg = false;

                        return true;

         }
        
             
      },
        meetRequiredFieldsByPreviousPage:function(pagenum)
      {

        
        if(pagenum > 1)
        {
        var filter = this.forms.filter(abc => abc.page == (pagenum-1)  && abc.required == true && abc.value == "");

         if(filter.length > 0 )
         {
            return false;
         }
         else
         {
            return true;
         }
        }
        else
        {
           return true;
        }

             
      },
      meetRequiredFields:function()
      {

        var filter = this.forms.filter(abc => abc.required == true && abc.value == "");

         if(filter.length > 0 )
         {
            return false;
         }
         else
         {
            return true;
         }
             
      },
      fireRequiredFieldError:function(forminfo)
      {

        return forminfo.required == true && forminfo.value =="" && this.requiredfieldmsg ? true : false;
           

      },
        fireValidationError:function(forminfo)
      {

        return forminfo.value !="" && this.validationfailedmsg && (forminfo.hasOwnProperty('validation') ? !forminfo.validation  : false )  ? true : false;

      },
      messageReceivedFromOption:function(formuid, optionval)
      {


         this.optionvaluereceived = optionval;

         var filter = this.forms.filter(abc => abc.uid == formuid);

         if(filter.length>0)
         {

      
             var index = this.forms.indexOf(filter[0]);

             this.forms[index].value = optionval;

         }
         else
         {
           console.log("Form ID is not found");
         }
          
      },
      messageReceivedFromText:function(formuid, value)
      {



         var filter = this.forms.filter(abc => abc.uid == formuid);

         if(filter.length>0)
         {

      
             var index = this.forms.indexOf(filter[0]);

             this.forms[index].value = value;

         }
         else
         {
           console.log("Form ID is not found");
         }
          
      },
      messageReceivedFromEmail:function(formuid, value,validation)
      {



         var filter = this.forms.filter(abc => abc.uid == formuid);

         if(filter.length>0)
         {

      
             var index = this.forms.indexOf(filter[0]);

             this.forms[index].value = value;
             if(this.forms[index].hasOwnProperty('validation'))
             {
             this.forms[index].validation = validation;
             }

         }
         else
         {
           console.log("Form ID is not found");
         }
          
      },
      hasPageQuery:function()
      {

         if(this.queryList.hasOwnProperty('page'))
         {
           return true;
         }
         else
         {
           return false;
         }

      },

      copyValuesFromExternalData:function(resultobj)
      {
          this.forms.forEach((item, index,arr) =>

          {
            var exvalue = get(resultobj,item.externalvalue);
          
                     


            if(exvalue!= undefined &&  exvalue !="")
            {
             this.forms[index].value = exvalue;

                console.log("object:-"+item.externalvalue+", Value : "+exvalue);
            }
            

          },this
          
          );

        this.preLoadComplete = true;


      },
      
      manualCopyExternalFormData:function()
      {


      },
       

      
      
    },
    computed:{
        
        queryList()
        {
          return this.$route.query;
        },
         parsedPageNumber()
        {
              return parseInt(this.queryList.page);
        },
       




    },
    watch:
    {
     
        

    },
    



}

</script>

<style scoped>
.error_page_form
{
  width:100%;
  height:100vh;
  
}
.error_page_message
{
  font-size:25px;
  font-weight:bold;
  color:blue;
}
.form_submit_wrap
{

}
.next_button
{
  width:200px;
  padding:6px;
  background:blue;
  color:#fff;
  background: linear-gradient(267.55deg, #F52B2B 0%, rgba(112, 39, 230, 0.59) 100%);
border-radius: 30px;
text-align:center;

}
.finish_button
{
  width:200px;
  padding:6px;
  color:#fff;
  background:#A44C0C;
border-radius: 30px;
text-align:center;

}
.previous_button
{
   width:200px;
  padding:6px;
  background:blue;
  color:#fff;
  background: linear-gradient(267.55deg, #F52B2B 0%, rgba(112, 39, 230, 0.59) 100%);
  border-radius: 30px;
 text-align:center;

}
.error_msg_required
{
  color:red;
  font-size:18px;
}
.error_msg_validation
{
  color:red;
  font-size:18px;

}
.input_class_style1
{
  width:500px;
}
.form_wrapper
{
  width:700px;
}
.page_circle
{
  width:50px;
  height:50px;
  font-size:20px;
  border-radius:50%;
  margin-left:auto;
  margin-right:auto;

 }
 .page_circle_disabled
 {
   background-color:#ddd;
color:#fff;


 }
 .page_circle_active
 {

background-color:#3325D3;
color:#fff;

 }
 .page_circle_inactive
 {
background-color:#97C516;
color:#ddd;


 }
 .page_title_default
 {
   text-align:center;
   font-size:20px;
   

 }
 .page_title_active
 {
   color:#3325D3;


 }
 .page_title_inactive
 {
   color:#000;
   
 }

</style>