

<template>
  <v-container>
    <div style = "width:850px">
    <rowupdater
    
      :pullUrl="tabledata.pullUrl"
      
      :columnsData = "tabledata.columnsdata"
      :parseFieldsExternal = "tabledata.parseFieldsExternal"
      headerClass = "border_radius_8 pt-2 pb-2 pl-4 pr-4 justify-space-between"
       :headerStyle = "{boxSizing:'border-box', backgroundColor:'#c3eeee' }"

      rowClass ="pt-2 pb-2 pl-4 pr-4 justify-space-between"
      
      :rowStyle = "{boxSizing:'border-box'}"
      :formdata = "formdata"
       :popupEdit = "false"
       popupEditType = "inline"


      v-on:messageFromTable = "handleMessageFromTable"

  


    >
        



    </rowupdater>
    </div>

 <fullviewmodal>

  </fullviewmodal>

    
  </v-container>
</template>

  <script>
import rowupdater from "./table.vue";

import updateformdflex from "./updateformdflex.vue";

import fullviewmodal from "../../components/alerts/fullviewmodal.vue";


export default {
  components: {
    updateformdflex: updateformdflex,
    rowupdater:rowupdater,
    fullviewmodal:fullviewmodal,
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
        pullUrl: "/api/listallleadmanagers",

        limit: 10,



        orderby: "",
        queryList: {},
        parseFieldsExternal: [
          { to: "id", from: "id" },
          { to: "leadmanager", from: "company_name" },
          { to: "iposmanaged", from: "ipocompanies_count" },
          { to: "logourl", from: "logo_url" },

        ],

        columnsdata: [
          {
            cid:1,
            displayname: "Serial No",
            type: "text",


            cellAttributes:{width:'100px'},

            value: function (obj, index) {
              return index + 1;
            },
          },
          {
            cid:2,
            displayname: "",
            type: "image",


            
            cellAttributes:{width:'100px'},

            value:'logourl'
          },
          {
            cid:3,

            displayname: "Lead Manager/Merchant Banker",
            type: "text",

            cellAttributes:{width:'300px', color:'black'},

            value: "leadmanager",
          },
          {
            cid:4,

            displayname: "Total IPOs Managed",

            type: "text",
            width:'200px',
            cellAttributes:{width:'200px',},

            value:'iposmanaged',
          },
          {
            cid:5,

            displayname: "",
      
            type: "editicon",
             
            cellAttributes:{width:'50px'},

            value:'',
          },
           {
            cid:6,

            displayname: "",
      
            type: "linkicon",
            cellAttributes:{width:'50px'},

            value:'',
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
.formpop_inline
{

animation-name: popup;
  
  animation-iteration-count: 1;
    animation-duration: 0.5s;

}

@keyframes popup {
  from {transform: scale(0);}
  to {transform: scale(1);}
}

</style>