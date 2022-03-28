

<template>

      <v-container class="" >

        
        <div v-if="pageRequirementPass() ">
        <header class="header_edit_form mt-4 mb-4">

           {{this.formDisplayName}}
            

        </header>
        <v-divider class="mb-4 mt-4">
        </v-divider>
        <v-row>
          <v-col cols="4">

              <div class="sidebar_form_updater">
                    <div class="page_title_wrap mt-8" v-for="page in this.pageurls" :key="page.page">
                       
                        <div  >
                            <span  class=" page_title_default" v-on:click="pageNavigationFormEditor(page.page)"  v-bind:class="page.page == parsedPageNumber ? 'page_title_active':'page_title_inactive'"> {{page.title}} </span>
                              
                        </div>

                      



                    </div>

              </div>


          </v-col>
          
          <v-col cols="8" class="body_editor">
          <div class="form_wrapper" v-if="this.componentmounted && this.preLoadComplete ? true:false" >
            <main v-for="form, index in formElementsByPage()" :key="form.uid">
           


             
              <textinput
                    :inputvalue ="form.value"
                    :labelname = "form.label"
                    :formuid= "form.uid" 

                    class="mt-7 input_class_style1"

                    v-if="form.inputtype=='text'"
                     v-on:messageFromText="messageReceivedFromText"

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

             

          </div>

          <div class="update_success_msg mt-12" v-show="successMessageTriggered">

             <span><img src="/images/check.png"  style="width:22px;height:22px"/>  </span> Updated Successfully

          </div>

          <v-divider class="mt-8 mb-4">

          </v-divider>


          <footer class="mt-10 pl-16 pr-16 d-flex justify-space-between flex-row-reverse form_submit_wrap">

                <div class="next_button"   v-on:click="updateFormEditor()">
                   UPDATE
                </div>

               
            </footer>

            </v-col> 

          


         </v-row>

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
     
    import numberinput from '../../forms/forminputs/numberinput.vue';
    import optioninput from '../../forms/forminputs/optioninput.vue';
    import textinput from '../../forms/forminputs/textinput.vue';
    import richtext from '../../forms/forminputs/richtext.vue';
    import dateinput from '../../forms/forminputs/dateinput.vue';
    import selectoptions from '../../forms/forminputs/selectoptions.vue';
    import checkboxinput from '../../forms/forminputs/checkboxinput.vue';
    import comboboxinput from '../../forms/forminputs/comboboxinput.vue';

    import textinputsingle from '../../forms/forminputs/textinputsingle.vue';

    import imageuploader from '../../forms/forminputs/imageuploader.vue';


    

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

    },


    props:{
     
     



    },

    data: function () {
        return {

          successMessageTriggered:false,

          optionvaluereceived:'not received yet',

          componentmounted:false,

          dynamicQueryFields:[],

          externaldata:'',
          displaystyle:'multipage',
          requestType:'bypage',

          preLoadComplete:false,

          requiredQueryForPreLoad:['companyid'],
          preLoadUrl:'/api/ipoListingByCompany',

          formname:'ipocreatorform',
          formDisplayName:'EDIT IPO INFORMATION',
          pages:4,
          finalUrl:'',

          requiredfieldmsg:false,

          pageurls:[{
                     page:1
                     ,
                     url:'/api/createIpoCompany',
                     
                     updatefields:['companyid'],
                     title:'Basic Information',

                     }
                     ,
                     {
                       page:2,
                     url:'/api/createIpoDetail',
                     updatefields:['companyid'],
                     title:'IPO Details',

                     },
                     {
                       page:3,
                       url:'/api/createIpoLotsandSchedule',
       
                     updatefields:['companyid'],
                     title:'Time Table and Lots',

                       },
                        {
                       page:4,
                       url:'/api/createIpoCompanyAdditionalInfo',
       
                     updatefields:['companyid'],
                     title:'Company Information',

                       }],

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
             label:'IPO Issue Open Date',
             value:'',
             style:'default',
             inputtype:'date',
             required:true,
             options:'',
             exportname:'open_date',
             page:2,
             externalvalue:'ipo_details[0].open_date',

             },
               {
             uid:4,

             type:'main',
             label:'IPO Issue Close Date',
             value:'',
             style:'default',
             inputtype:'date',
             required:true,
             options:'',
             exportname:'close_date',
             page:2,
             externalvalue:'ipo_details[0].close_date',

             },
                 {
             uid:5,
             type:'main',
             label:'Issue Type',
             value:'',
             style:'default',
             inputtype:'text',
             required:true,
             options:'',
             exportname:'issue_type',
             page:2,
             externalvalue:'ipo_details[0].issue_type',

             },
               {
             uid:6,
             type:'main',
             label:'IPO Price',
             value:0,
             style:'default',
             inputtype:'number',
             required:true,
             options:'',
             exportname:'issue_price',
             page:2,
             externalvalue:'ipo_details[0].issue_price',

             },
             {
            
             uid:7,
             type:'main',
             label:'Face Value of IPO',
             value:0,
             style:'default',
             inputtype:'number',
             required:true,
             options:'',
             exportname:'face_value',
             page:2,
            externalvalue:'ipo_details[0].face_value',

             },
           
            {
            
             uid:8,
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
             externalvalue:'ipo_details[0].listing_at',

             },
               {
            
             uid:9,
             type:'main',
             label:'Offer For Sale',
             value:'',
             style:'default',
             inputtype:'text',
             required:true,
             options:'',
             exportname:'offer_for_sale',
             page:2,
             externalvalue:'ipo_details[0].offer_for_sale',

             },
               {
            
             uid:10,
             type:'main',
             label:'QIB Shares',
             value:'',
             style:'default',
             inputtype:'text',
             required:true,
             options:[],
             exportname:'qib_shares',
             page:2,
             externalvalue:'ipo_details[0].qib_shares',

             },
               {
            
             uid:11,
             type:'main',
             label:'Retail Shares',
             value:'',
             style:'default',
             inputtype:'text',
             required:true,
             options:[],
             exportname:'retail_shares',
             page:2,
             externalvalue:'ipo_details[0].retail_shares',

             },
               {
            
             uid:12,
             type:'main',
             label:'NII Shares',
             value:'',
             style:'default',
             inputtype:'text',
             required:true,
             options:[],
             exportname:'nii_shares',
             page:2,
             externalvalue:'ipo_details[0].nii_shares',

             },
  
             
             {
             uid:13,

             type:'main',
             label:'Allotment Date',
             value:'',
             style:'default',
             inputtype:'date',
             required:true,
             options:'',
             exportname:'allotment_date',
             page:3,
             externalvalue:'ipo_time_tables[0].allotment_date',

             },
             {
               uid:14,

             type:'main',
             label:'Refund Initiation Date',
             value:'',
             style:'default',
             inputtype:'date',
             required:true,
             options:'',
             exportname:'refund_initiation',
             page:3,
             externalvalue:'ipo_time_tables[0].refund_initiation',

             },
             {
               uid:15,

             type:'main',
             label:'Shares to Demat Account Date',
             value:'',
             style:'default',
             inputtype:'date',
             required:true,
             options:'',
             exportname:'shares_to_demat',
             page:3,
             externalvalue:'ipo_time_tables[0].shares_to_demat',

             },
               {
               uid:16,

             type:'main',
             label:'Listing Date',
             value:'',
             style:'default',
             inputtype:'date',
             required:true,
             options:'',
             exportname:'listing_date',
             page:3,
             externalvalue:'ipo_time_tables[0].listing_date',

             },
                 {
               uid:17,

             type:'main',
             label:'Lots',
             value:'',
             style:'default',
             inputtype:'text',
             required:true,
             options:'',
             exportname:'lots',
             page:3,
             externalvalue:'ipo_lot_informations[0].lots',

             },
                {
               uid:18,

             type:'main',
             label:'Minimum Lots',
             value:'',
             style:'default',
             inputtype:'text',
             required:true,
             options:'',
             exportname:'min_lot',
             page:3,
             externalvalue:'ipo_lot_informations[0].min_lot',

             },
                {
               uid:19,

             type:'main',
             label:'Maximum Lot',
             value:'',
             style:'default',
             inputtype:'text',
             required:true,
             options:'',
             exportname:'max_lot',
             page:3,
             externalvalue:'ipo_lot_informations[0].max_lot',

             },
                {
               uid:20,

             type:'main',
             label:'Minimum Shares',
             value:'',
             style:'default',
             inputtype:'text',
             required:true,
             options:'',
             exportname:'min_shares',
             page:3,
             externalvalue:'ipo_lot_informations[0].min_shares',

             },
               {
               uid:21,

             type:'main',
             label:'Maximum Shares',
             value:'',
             style:'default',
             inputtype:'text',
             required:true,
             options:'',
             exportname:'max_shares',
             page:3,
             externalvalue:'ipo_lot_informations[0].max_shares',

             },
               {
               uid:22,

             type:'main',
             label:'Minimum Cut Off Amout',
             value:'',
             style:'default',
             inputtype:'text',
             required:false,
             options:'',
             exportname:'min_cut_off',
             page:3,
             externalvalue:'ipo_lot_informations[0].min_cut_off',

             },
                {
               uid:23,

             type:'main',
             label:'Maximum Cut Off Amout',
             value:'',
             style:'default',
             inputtype:'text',
             required:false,
             options:'',
             exportname:'max_cut_off',
             page:3,
             externalvalue:'ipo_lot_informations[0].max_cut_off',

             },

              {
            
             uid:24,
             type:'main',
             label:'Subscription Link',
             value:'',
             style:'default',
             inputtype:'text',
             required:false,
             options:'',
             exportname:'subscriptionlink',
             page:3,
             externalvalue:'',

             },
              {
            
             uid:25,
             type:'main',
             label:'Company Logo',
             value:'',
             style:'default',
             inputtype:'imageuploader',
             required:false,
             options:'',
             uploadurl:'/api/ipocompanylogoupload',
             exportname:'',
             page:4,
             externalvalue:'logo_url',

             },
              {
            
             uid:26,
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
            
             uid:27,
             type:'main',
             label:'Email Id',
             value:'',
             style:'default',
             inputtype:'text',
             required:false,
             options:'',
             exportname:'email',
             page:4,
             externalvalue:'email',

             },
             {
            
             uid:28,
             type:'main',
             label:'Phone Number',
             value:'',
             style:'default',
             inputtype:'text',
             required:false,
             options:'',
             exportname:'phone',
             page:4,
             externalvalue:'phone',

             },
                 {
            
             uid:29,
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
     pageNavigationFormEditor:function(pagenum)
     {
        if(this.queryList.page != pagenum)
        {
        let newquery = { ...this.queryList }; // `{ foo: 'bar' }`

        console.log("New Query "+JSON.stringify(newquery));

        newquery.page = pagenum;


             this.$router.push({ path: '/editipo', query: newquery });

        }

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


      updateFormPage:function()
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

          

                     
                       this.successMessageTriggered = true;

                        setTimeout(function()
                        {
                      
                       this.successMessageTriggered = false;


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


             this.$router.push({ path: '/dynamicformtest', query: newquery });
            

      },

      
      updateFormEditor:function()
      {

       
        
        
             if(this.meetRequiredFieldsByPage())
            {

              
              
                this.updateFormPage();
              
            }
            else
            {
                            this.requiredfieldmsg = true;


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
         for(var i=0;i<this.requiredQueryForPreLoad.length;i++)
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
.header_edit_form
{
  text-align:center;
  font-size:25px;
  font-weight:bold;

}
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
.input_class_style1
{
  width:500px;
}
.form_wrapper
{
  width:700px;
}

 .page_title_default
 {
   font-size:20px;
   padding:5px;
   border-radius:10px;
   

 }
 .page_title_active
 {
   background-color:#3325D3;
   color:#fff;


 }
 .page_title_inactive
 {
   color:#000;
   
 }
 .sidebar_form_updater
 {
    position:sticky;
    top:0px;
    left:0px; 
    border-right:2px solid #ddd;
   
 }
 
 .update_success_msg
 {
   color:#d1a03d;
   text-align:center;

   font-style:italic;

 }
 

</style>