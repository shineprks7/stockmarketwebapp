

<template>

      <div>
          <multipageform
          
          :formdata = "this.forms"

          :dynamicQueryFields = "[]"
          formDisplayName = "CREATE IPO FORM"
          formurl ="/createipoform"
          requestType = "bypage"
          :requiredQueryForPreLoad = "['companyid']"
          preLoadUrl = "/api/ipoListingByCompany"
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
                     page:1,
                     
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

             },
                 {
            uid:30,
             type:'main',
             label:'Lead Manager?',
             value:'',
             style:'default',
             inputtype:'dynamicselectoptions',

            

             optionPullUrl:'/api/listallleadmanagers',
             limit:10,
             orderby:'',
             fieldQueryList:{},
             parseFieldsExternal:[{to:'name',from:'id'},{to:'displayname',from:'company_name'}],
           
             required:true,
             
             exportname:'leadmanagerid',
             page:4,
             externalvalue:'ipo_leadmanager[0].id',   
             condition:[], 

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