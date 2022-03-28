

<template>

      <div>
          <multipageform
          
          :formdata = "this.forms"

          :dynamicQueryFields = "[]"
          formDisplayName = "CREATE NCD FORM"
          formurl ="/createncdform"
          requestType = "bypage"
          :requiredQueryForPreLoad = "['companyid']"
          preLoadUrl = "/api/ncdListingByCompany"
          pages = 4

          :pageData = "this.pagedata"
        

          
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
    


      pagedata:[{
                     page:1
                     ,
                     url:'/api/createNcdCompany',
                     
                     updatefields:['companyid'],
                     title:'Basic Information',

                     }
                     ,
                     {
                       page:2,
                     url:'/api/createNcdDetails',
                     updatefields:['companyid'],
                     title:'IPO Details',

                     },
                     {
                       page:3,
                       url:'/api/createNcdAllotmentData',
       
                     updatefields:['companyid'],
                     title:'Lots',

                       },
                        {
                       page:4,
                       url:'/api/createNcdAllotmentData',
       
                     updatefields:['companyid'],
                     title:'Allotment Ratios',

                       },
                         {
                       page:5,
                       url:'/api/createNcdAllotmentData',
       
                     updatefields:['companyid'],
                     title:'Allotment Offered',

                       },
                        {
                       page:6,
                       url:'/api/createNcdAllotmentInformation',
       
                     updatefields:['companyid'],
                     title:'Allotment Information',

                       },
                        {
                       page:7,
                       url:'/api/createNcdCompanyAdditionalInfo',
       
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
             label:'NCD Issue Open Date',
             value:'',
             style:'default',
             inputtype:'date',
             required:true,
             options:'',
             exportname:'open_date',
             page:2,
             externalvalue:'ncd_issue_details[0].open_date',

             },
               {
             uid:4,

             type:'main',
             label:'NCD Issue Close Date',
             value:'',
             style:'default',
             inputtype:'date',
             required:true,
             options:'',
             exportname:'close_date',
             page:2,
             externalvalue:'ncd_issue_details[0].close_date',

             },
                 {
             uid:5,
             type:'main',
             label:'NCD Type',
             value:'',
             style:'default',
             inputtype:'text',
             required:true,
             options:'',
             exportname:'security_type',
             page:2,
             externalvalue:'ncd_issue_details[0].security_type',

             },
               {
             uid:6,
             type:'main',
             label:'NCD Price',
             value:0,
             style:'default',
             inputtype:'number',
             required:true,
             options:'',
             exportname:'issue_price',
             page:2,
             externalvalue:'ncd_issue_details[0].issue_price',

             },
             {
            
             uid:7,
             type:'main',
             label:'Face Value of NCD',
             value:0,
             style:'default',
             inputtype:'number',
             required:true,
             options:'',
             exportname:'face_value',
             page:2,
            externalvalue:'ncd_issue_details[0].face_value',

             },
               {
            
             uid:8,
             type:'main',
             label:'Issue Size Base',
             value:0,
             style:'default',
             inputtype:'number',
             required:true,
             options:'',
             exportname:'issue_size_base',
             page:2,
            externalvalue:'ncd_issue_details[0].issue_size_base',

             },
                {
            
             uid:9,
             type:'main',
             label:'Issue Size Shelft',
             value:0,
             style:'default',
             inputtype:'number',
             required:true,
             options:'',
             exportname:'issue_size_shelf',
             page:2,
            externalvalue:'ncd_issue_details[0].issue_size_shelf',

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
             externalvalue:'ncd_issue_details[0].listing_at',

             },
               {
            
             uid:11,
             type:'main',
             label:'Credit Rating',
             value:'',
             style:'default',
             inputtype:'text',
             required:true,
             options:'',
             exportname:'credit_rating',
             page:2,
             externalvalue:'ncd_issue_details[0].credit_rating',

             },
               {
            
             uid:12,
             type:'main',
             label:'Minimum Lot',
             value:'',
             style:'default',
             inputtype:'number',
             required:true,
             options:[],
             exportname:'minimum_lot',
             page:3,
             externalvalue:'lots_and_allotment_infos[0].minimum_lot',

             },
               {
            
             uid:13,
             type:'main',
             label:'Maximum Lots',
             value:'',
             style:'default',
             inputtype:'text',
             required:true,
             options:[],
             exportname:'maximum_lots',
             page:3,
             externalvalue:'lots_and_allotment_infos[0].maximum_lots',

             },
               {
            
             uid:14,
             type:'main',
             label:'QIB/ Category I Allocation Ratio',
             value:'',
             style:'default',
             inputtype:'text',
             required:true,
             options:[],
             exportname:'qib_allocation_ratio',
             page:4,
             externalvalue:'lots_and_allotment_infos[0].qib_allocation_ratio',

             },
  
             
             {
             uid:15,

             type:'main',
             label:'NII Allocation Ratio',
             value:'',
             style:'default',
             inputtype:'text',
             required:true,
             options:'',
             exportname:'nii_allocation_ratio',
             page:4,
             externalvalue:'lots_and_allotment_infos[0].nii_allocation_ratio',

             },
             {
               uid:16,

             type:'main',
             label:'HNI Allocation Ratio',
             value:'',
             style:'default',
             inputtype:'text',
             required:true,
             options:'',
             exportname:'hni_allocation_ratio',
             page:4,
             externalvalue:'lots_and_allotment_infos[0].hni_allocation_ratio',

             },
             {
               uid:17,

             type:'main',
             label:'RII Allocation Ratio',
             value:'',
             style:'default',
             inputtype:'text',
             required:true,
             options:'',
             exportname:'rii_allocation_ratio',
             page:4,
             externalvalue:'lots_and_allotment_infos[0].rii_allocation_ratio',

             },
               {
               uid:18,

             type:'main',
             label:'QIB/Category I Offered',
             value:'',
             style:'default',
             inputtype:'text',
             required:true,
             options:'',
             exportname:'qib_offered',
             page:5,
             externalvalue:'lots_and_allotment_infos[0].qib_offered',

             },
                 {
               uid:19,

             type:'main',
             label:'NII/Category 2 Offered',
             value:'',
             style:'default',
             inputtype:'text',
             required:true,
             options:'',
             exportname:'nii_offered',
             page:5,
             externalvalue:'lots_and_allotment_infos[0].nii_offered',

             },
                {
               uid:20,

             type:'main',
             label:'HNI Offered',
             value:'',
             style:'default',
             inputtype:'text',
             required:true,
             options:'',
             exportname:'hni_offered',
             page:5,
             externalvalue:'lots_and_allotment_infos[0].hni_offered',

             },
                {
               uid:21,

             type:'main',
             label:'RII Offered',
             value:'',
             style:'default',
             inputtype:'text',
             required:true,
             options:'',
             exportname:'rii_offered',
             page:5,
             externalvalue:'lots_and_allotment_infos[0].rii_offered',

             },

                {
               uid:22,

             type:'main',
             label:'Basis of Allotment',
             value:'',
             style:'default',
             inputtype:'text',
             required:true,
             options:'',
             exportname:'basis_of_allotment',
             page:5,
             externalvalue:'lots_and_allotment_infos[0].basis_of_allotment',

             },
                {
               uid:23,

             type:'main',
             label:'Allotment Details',
             value:'',
             style:'default',
             inputtype:'richtext',
             required:true,
             options:'',
             exportname:'allotment_comments',
             page:6,
             externalvalue:'lots_and_allotment_infos[0].allotment_comments',

             },


              
               
              {
            
             uid:24,
             type:'main',
             label:'Company Logo',
             value:'',
             style:'default',
             inputtype:'imageuploader',
             required:false,
             options:'',
             uploadurl:'/api/ncdcompanylogoupload',
             exportname:'',
             page:7,
             externalvalue:'logo_url',

             },
              {
            
             uid:25,
             type:'main',
             label:'Company Address',
             value:'',
             style:'default',
             inputtype:'richtext',
             required:false,
             options:'',
             exportname:'address',
             page:7,
             externalvalue:'address',

             },
               {
            
             uid:26,
             type:'main',
             label:'Email Id',
             value:'',
             style:'default',
             inputtype:'text',
             required:false,
             options:'',
             exportname:'email',
             page:7,
             externalvalue:'email',

             },
             {
            
             uid:27,
             type:'main',
             label:'Phone Number',
             value:'',
             style:'default',
             inputtype:'text',
             required:false,
             options:'',
             exportname:'phone',
             page:7,
             externalvalue:'phone',

             },
                 {
            
             uid:28,
             type:'main',
             label:'Website',
             value:'',
             style:'default',
             inputtype:'text',
             required:false,
             options:'',
             exportname:'website',
             page:7,
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