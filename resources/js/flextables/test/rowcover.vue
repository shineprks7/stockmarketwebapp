

<template>
  <v-container>
    <div style = "width:650px">
    <rowupdater
    
      :pullUrl="tabledata.pullUrl"
      
      :columnsData = "tabledata.columnsdata"
      :parseFieldsExternal = "tabledata.parseFieldsExternal"
      headerClass = "border_radius_8 pt-2 pb-2 pl-4 pr-4 justify-space-between"
       :headerStyle = "{boxSizing:'border-box', backgroundColor:'#c3eeee' }"

      rowClass ="pt-2 pb-2 pl-4 pr-4 justify-space-between"
      
      :rowStyle = "{boxSizing:'border-box'}"
      :formdata = "formdata"
      :popupEdit = "true"
      popupEditType = "inline"

      v-on:messageFromTable = "handleMessageFromTable"

  


    >
        <template v-slot:inlineformupdator = "slotprops">
          
         
          
          <updateformdflex
              class ="inlineform_test"
              :formdata = "slotprops.formdata.forms.forms"
              :formDynamicQueryFields="[]"
              submitUrl="/api/createrecommendation"
              :requiredQueryForInitialLoad ="[]"
              :requiredQueryForPreLoad = "[]"
              :clearDataOnSubmit="true"
             
              :preLoad="false"
              preLoadUrl="/api/ipoListingByCompany"
              formDisplayTitle="Update Script Names"
              :internalFormData = "slotprops.formdata.rowdata"
              v-on:closeForm = "slotprops.closeInlineForm(slotprops.formdata.index)"
              />
            
            
          
            
            

      
      </template>



    </rowupdater>
    </div>


    
  </v-container>
</template>

  <script>
import rowupdater from "./table.vue";

import updateformdflex from "./updateformdflex.vue";



export default {
  components: {
    updateformdflex: updateformdflex,
    rowupdater:rowupdater,
  },

  props: {
    
  },

  data: function () {
    return {
      inlinepopup:false,
      inlinepopupstyle:{
        left:'50px',
        top:'100px'


      },
      tabledata: {
        pullUrl: "/api/pullcashscriptnames",

        limit: 10,



        orderby: "",
        queryList: {},
        parseFieldsExternal: [
          { to: "id", from: "id" },
          { to: "scripname", from: "scripname" },
          { to: "scriptype", from: "scriptype" },
        ],

        columnsdata: [
          {
            cid:1,
            displayname: "Serial No",
            type: "text",


            width:'100px',
            cellAttributes:{},

            value: function (obj, index) {
              return index + 1;
            },
          },
          {
            cid:2,

            displayname: "Script Name",
            type: "text",

            cellAttributes:{ color:'blue'},

            value: "scripname",
          },
          {
            cid:3,

            displayname: "Script Type",

            type: "button",
            width:'120px',
            cellAttributes:{},

            value: function (obj, index) {
              if (obj.scriptype == "eqcash") {
                  return "Equity Cash"
              } else {
                return "-";
              }
            },
          },
          
        ],


        
      },
      
      formdata:{
        forms:[
            {  uid:1,
             type:'main',
             label:'Script Name',
             value:'',
             style:{width:'200px'},
             class:'mr-2',
             inputtype:'text',
             required:true,
             
             exportname:'scripname',
             page:1,
             externalvalue:'scripname',         

             },
             {
           uid:2,
             type:'main',
             label:'Script Type?',
             value:'',
             style:{width:'200px'},
             class:'mr-2',

             inputtype:'selectoptions',
             required:true,
             options:[{id:1,name:'eqcash',displayname:'Equity Cash',haschild:false},
                      {id:2,name:'futuresandoptions',displayname:'Futures and Options',haschild:false}
                     
                   ],
             exportname:'scriptype',
             page:1,
             externalvalue:'scriptype',         

             }],

      }

      /*


      */
    };
  },
  created() {},
  mounted() {},
  methods: {
    handleMessageFromTable:function(popup, updatequery, exobj, bounds)
    {
      
      this.inlinepopupstyle.left = bounds.left+"px";
      this.inlinepopupstyle.top = bounds.top+"px";

      this.inlinepopup = popup;

     



    }
  },
  computed: {},
  watch: {},
};
</script>

<style>
.border_radius_8
{
 border-radius: 8px;
}
.inlineform_test
{
box-shadow: 0 1px 1px 0 rgba(0, 0, 0, 0.05), 0 1px 2px 0 rgba(0,0,0,0.1), 0 2px 20px 0 rgba(0,0,0, 0.2); 
  animation-name: popup;
  animation-iteration-count: 1;
    animation-duration: 0.5s;

}

@keyframes popup {
  from {transform: scale(0);}
  to {transform: scale(1);}
}

</style>