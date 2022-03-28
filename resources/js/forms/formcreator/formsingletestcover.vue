

<template>

      <div>
          <dynamicsingleform
          
          :formdata = "this.forms"

          :formDynamicQueryFields = "[]"
          submitUrl = "/api/createrecommendation"
          :clearDataOnSubmit ="true"
          displayStyle ="singlepage"
          requestType = "bypage"
          :preLoad = "false"
          preLoadUrl="/api/ipoListingByCompany"
        
          formDisplayTitle = "Create Trading Calls"

          
          />





      </div>





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

import dynamicsingleform from "./formsinglepagetest.vue";



export default {
  components: {
    dynamicsingleform: dynamicsingleform,
    
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
    


   

      forms: [
         {
           uid:1,
             type:'main',
             label:'Call Type?',
             value:'',
             style:'default',
             inputtype:'radiooptions',
             required:true,
             options:[{id:1,name:'buy',displayname:'Buy',haschild:false},
                     {id:2,name:'sell',displayname:'Sell',haschild:false},
                   ],
             exportname:'action',
             page:2,
             externalvalue:false,         

             },
             {
           uid:2,
             type:'main',
             label:'Select Category?',
             value:'',
             style:'default',
             inputtype:'radiooptions',
             required:true,
             options:[{id:1,name:'intraday',displayname:'Intra Day',haschild:false},
                     {id:2,name:'shortterm',displayname:'Short Term',haschild:false},
                     {id:3,name:'futuresandoptions',displayname:'Futures And Options',haschild:false},
                     {id:4,name:'positional',displayname:'Positional',haschild:false},

                   ],
             exportname:'tabname',
             page:2,
             externalvalue:'tabname',         

             },
            
       
                {
           uid:3,
             type:'associate',
             label:'Select Sub Category?',
             value:'',
             style:'default',
             associateParentUid:2,
             displayIfParentValue:'intraday',

             inputtype:'radiooptions',
             required:true,
             options:[{id:1,name:'cash',displayname:'Cash',haschild:false},
                     {id:2,name:'derivatives',displayname:'Derivaties',haschild:false},
                   
                   ],
             exportname:'subtabname',
             page:1,
             externalvalue:'subtabname',   
             condition:[],      

             },
                  {
           uid:4,
             type:'associate',
             label:'Select Sub Category?',
             value:'',
             style:'default',
             associateParentUid:2,
             displayIfParentValue:'futuresandoptions',

             inputtype:'radiooptions',
             required:true,
             options:[{id:1,name:'indexfuture',displayname:'Index Futures',haschild:false},
                     {id:2,name:'stockfuture',displayname:'Stock Futures',haschild:false},
                     {id:3,name:'indexoption',displayname:'Stock Options',haschild:false},
                     {id:4,name:'stockoption',displayname:'Index Options',haschild:false},
                   ],
             exportname:'subtabname',
             page:1,
             externalvalue:'subtabname',   
             condition:[],      

             },
                   {
           uid:5,
             type:'associate',
             label:'Select Sub Category?',
             value:'',
             style:'default',
             associateParentUid:2,
             displayIfParentValue:'positional',

             inputtype:'radiooptions',
             required:true,
             options:[{id:1,name:'indexfuture',displayname:'Index Futures',haschild:false},
                     {id:2,name:'stockfuture',displayname:'Stock Futures',haschild:false},
                     {id:3,name:'indexoption',displayname:'Stock Options',haschild:false},
                     {id:4,name:'stockoption',displayname:'Index Options',haschild:false},
                   ],
             exportname:'subtabname',
             page:1,
             externalvalue:'subtabname',   
             condition:[],      

             },
             {
          uid: 6,
          type: "main",
          label: "Script Name",
          value: '',
          style: "default",
          inputtype: "text",
          uniqueby:'id',
        
         

          required: true,
          options: "",
          exportname: "scrip",
          page: 1,
          externalvalue: "scrip",
          },
           {
          uid: 7,
          type: "main",
          label: "Recommendation Date",
          value: '',
          style: "default",
          inputtype: "date",
          uniqueby:'id',
        
         

          required: true,
          options: "",
          exportname: "recommendationdate",
          page: 1,
          externalvalue: "recommendationdate",
          },
          {
          uid: 8,
          type: "main",
          label: "Price at Staring",
          value: '',
          style: "default",
          inputtype: "text",
          uniqueby:'id',
        
         

          required: true,
          options: "",
          exportname: "entryprice",
          page: 1,
          externalvalue: "entryprice",
          },
          {
          uid: 9,
          type: "main",
          label: "Target 1 Price",
          value: '',
          style: "default",
          inputtype: "text",
          uniqueby:'id',
        
         

          required: true,
          options: "",
          exportname: "target1",
          page: 1,
          externalvalue: "target1",
          },
          {
          uid: 10,
          type: "main",
          label: "Target 2 Price",
          value: '',
          style: "default",
          inputtype: "text",
          uniqueby:'id',
        
         

          required: true,
          options: "",
          exportname: "target2",
          page: 1,
          externalvalue: "target2",
          },
            {
          uid: 11,
          type: "main",
          label: "Stop Loss",
          value: [],
          style: "default",
          inputtype: "text",
    
          required: true,
          options: "",
          exportname: "stoploss",
          page: 1,
          externalvalue: "stoploss",
          },
           {
          uid: 13,
          type: "conditional",
          label: "Lots",
          value: [],
          style: "default",
          inputtype: "text",
          
          condition:function()
          {
            if(this.hasOwnProperty('uid_2') && this.hasOwnProperty('uid_2') )
             {
              if(this.uid_2.value == 'futuresandoptions' || this.uid_2.value =="positional")

              {
                return true;

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
         

          required: true,
          options: "",
          exportname: "lotsize",
          page: 1,
          externalvalue: "lotsize",

          },
          {
          uid:14,
             type:'main',
             label:'Status?',
             value:'',
             style:'default',
             inputtype:'selectoptions',
           
             required:true,
             options:[
                   { id: 1, name: "open", displayname: "Open" },
                   { id: 2, name: "target1", displayname: "Target 1 Achieved" },
                  { id: 3, name: "target2", displayname: "Target 2 Achieved" },
                   { id: 4, name: "loss", displayname: "Stop Loss Triggered" },
                  { id: 5, name: "notinitiated", displayname: "Not Initiated" },
                   { id: 6, name: "closed", displayname: "Closed" },
              ],
             exportname:'status',
             page:1,
             externalvalue:'status',   
             condition:[], 

              } ,
                {
          uid:15,
             type:'main',
             label:'Custom Field?',
             value:'',
             style:'default',
             inputtype:'customslot',
           
             required:true,
             
             exportname:'customslot',
             page:1,
             externalvalue:'customslot',   
             condition:[], 

              } ,

                {
            uid:16,
             type:'main',
             label:'I am dynamic filed?',
             value:'',
             style:'default',
             inputtype:'dynamicselectoptions',

            

             optionPullUrl:'/api/pullcashscriptnames',
             limit:10,
             orderby:'',
             fieldQueryList:{},
             parseFieldsExternal:[{to:'id',from:'id'},{to:'name',from:'scripname'},{to:'displayname',from:'scripname'}],
           
             required:true,
             
             exportname:'dynooptions',
             page:1,
             externalvalue:'dynooptions',   
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