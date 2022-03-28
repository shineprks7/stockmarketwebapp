

<template>

      <v-container class="" >

        
        <div v-if="pageRequirementPass() ">

          <header>

              <div class="d-flex justify-space-around">
                    <div class="page_title_wrap" v-for="page in this.pageData" :key="page.page">
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

          <section class="form_wrapper" v-if="this.componentmounted && this.propsCopied && this.preLoadComplete ? true:false" >
            <main v-for="form, index in formElementsByPage()" :key="form.uid">
           


             
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

                    v-else-if="conditionalCheckForm(form, 'textsingle')"
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
                      v-else-if="conditionalCheckForm(form, 'options')"
                      class="mt-7"

                      v-on:messageFromText="messageReceivedFromText" />

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
                    
                  <dynamicselectoptions

                      :inputvalue = "form.value"

                      :labelname = "form.label"
                      :formuid = "form.uid"
                      :optionPullUrl = "form.optionPullUrl"
                      :parseFieldsExternal = "form.parseFieldsExternal"
                      :orderBy = "form.hasOwnProperty('orderBy')?form.orderBy :''"
                      :limit = "form.hasOwnProperty('limit')?form.limit :''"

                      :optionconditions = "form.hasOwnProperty('optionconditions')?form.optionconditions :[]"
                      :uids = "associatedFormData( form.associatedUids, forms)"

                      v-else-if="conditionalCheckForm(form, 'dynamicselectoptions')"
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
                  

                  <div class="error_msg_required"  v-if="fireRequiredFieldError(form)" > This field should not be empty</div>
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

    import dynamicselectoptions from '../forminputs/dynamicselectoptions.vue';

    import emailinput from '../forminputs/emailinput.vue';


     import get from 'lodash/get';
    import formmixins from "../mixins/formmixins"


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
     'dynamicselectoptions':dynamicselectoptions,
     'emailinput':emailinput,

    },
    mixins:[formmixins],


    props:{
     formdata:{
         type:Array,
         required:true
     },
     dynamicQueryFields:{
         type:Array,
         required:true
     },
     formDisplayName:String,
     formurl:{
         type:String,
         required:true
     },
     
    
    
     requestType:String,
     requiredQueryForPreLoad:{
         type:Array,
         required:true,
     },
     preLoadUrl:String,
     pages:{
         type:Number,
         required:true,
     },
     pageData:Array,



    },

    data: function () {
        return {

     
          uids:{},

          optionvaluereceived:'',

          componentmounted:false,
          propsCopied:false,



          externaldata:'',

          preLoadComplete:false,



          requiredfieldmsg:false,
          validationfailedmsg:false,




          forms:[],    
      
          
          
        }
    },
    created()
    {

    
      
       
    },
    mounted()
    {

      this.componentmounted = true;


    this.copyProps();

    this.propsCopied = true;


      this.preLoadData();

    },
    methods:{

      forceUpdateComponent() {
      
      this.$forceUpdate();  
     },
     copyProps:function()
    {
          if(this.forms)
          {
          this.forms = this.formdata;
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


      saveAndNext:function()
      {

          var pagefilters = this.pageData.filter(abc => abc.page == this.parsedPageNumber);


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
      
      
     
      saveAndFinish:function()
      {
         var pagefilters = this.pageData.filter(abc => abc.page == this.parsedPageNumber);


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
                this.saveAndNext();
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
                this.saveAndFinish();
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

      copyValuesFromExternalData: function (resultobj) {
      this.forms.forEach((item, index, arr) => {
        if(this.conditionalFilterForm(item))
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
        goToParticularPage:function(pagenum)
      {

        
           let newquery = { ...this.queryList }; // `{ foo: 'bar' }`

           console.log("New Query "+JSON.stringify(newquery));

           newquery.page = pagenum;


             this.$router.push({ path: this.formurl, query: newquery });
            

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