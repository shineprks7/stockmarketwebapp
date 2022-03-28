

<template>

      <div>
          <multipageform
          
          :formdata = "this.forms"

          :dynamicQueryFields = "[]"
          formDisplayName = "CREATE RIGHTS FORM"
          formurl ="/createrightsform"
          requestType = "bypage"
          :requiredQueryForPreLoad = "['companyid']"
          preLoadUrl = "/api/rightsListingByCompany"
          pages = 4

          :pageData = "this.pagedata"
        
          formDisplayTitle = "Create Trading Calls"

          
          />





      </div>





  </template>

  <script>


import multipageform from "../../forms/formcreator/multipage.vue";



export default {
  components: {
    multipageform: multipageform,
    
  },


  props: {
    formdata:[Array, Object],
    formDynamicQueryFields:Array,
    formUrl:String,
    displayStyle:String,
    requestType:String,
    queryPreload:[Array,String],
    queryInitialLoad:[Array,String],
    preLoadUrl:String,
    displayName:String,


  },

  data: function () {
    return {
    


      pagedata:[   {
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

                       }],

      

      forms: [
       {
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
    };
  },
  created() {},
  mounted() {
    
  },
  methods: {
    

  },
  computed: {
    
    
  },
  watch: {
    
   

  },
};
</script>

<style scoped>

</style>