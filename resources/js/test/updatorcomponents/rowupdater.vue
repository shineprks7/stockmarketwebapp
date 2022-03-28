

<template>
  <div class="">
    <section v-if="loadDataComplete">
      <div
        class="d-flex"
        v-bind:class="headerClass ? headerClass : ''"
        :style="headerStyle ? headerStyle : {}"
      >
        <div
           class=""
           style=""
           :style="cellStyles(column)"
          v-for="column in this.columnsData"
          :key="column.cid"
        >
        {{column.displayname}}
        </div>
      </div>

      <div class="mb-2" v-for="(row, rowindex) in copyTableData" :key="rowindex"      v-on:dblclick="openPopUpEdit(rowindex, row, $event)">
        <div
          
          class="d-flex"
          v-bind:class="rowClass ? rowClass : ''"
          :style="rowStyle ? rowStyle : {}"
           
          v-if = "!row.updaterow"
        >
          <div
            class=""
            style=""
            :style="cellStyles(col)"
            v-for="col in columnsData"
            :key="col.cid"

          >
            <cellelements
              :value="parseValue(col, row, rowindex)"
              :iconurl ="col.iconurl ? col.iconurl :''"
              :redirecturl ="col.redirecturl ? col.redirecturl :''"

              :elementType="col.hasOwnProperty('type') ? col.type :'text'"
              :displayAs="
                col.hasOwnProperty('displayAs') ? col.displayAs : 'text'
              "
              :cellAttributes="
                col.hasOwnProperty('cellAttributes') ? col.cellAttributes : {}
              "
            />
          </div>

        </div>
        <div v-if="row.updaterow">

             <slot name="inlineformupdator" :closeInlineForm =" closePopUpEdit"  :formdata ="{ forms:formdata, rowdata:row, index:rowindex }" >

             </slot>

         </div>
        
      </div>
      <v-divider> </v-divider>
    </section>

  </div>
</template>

  <script>
import get from "lodash/get";

import isobject from "lodash/isObject";

import cellelements from "./cellelements.vue";

export default {
  components: {
    cellelements: cellelements,
  },
  props: {
    parseFieldsExternal: Array,

    pullUrl: String,
    headerClass: String,
    headerStyle: Object,
    rowClass: String,
    rowStyle: Object,
    orderBy: String,
    limit: "",
    queryList: Object,
    formdata:Object,

    columnsData: Array,
    
    propForUpdate:[String,Array],
   
  },

  data: function () {
    return {
      thevalue: "",

      loadDataComplete: false,

      copyTableData: [],

      tabledata: [],

      externaldata:[],


      
    };
  },
  created() {},
  mounted() {
    this.loadTableData();

    this.thevalue = this.inputvalue;

    
  },
  methods: {
    setToDefault: function () {
      this.thevalue = "";
    },
    closePopUpEdit:function(index)
    {
                this.copyTableData[index].updaterow = false;

    },
    openPopUpEdit:function(index, rowobj, event)
    {
      var exobj ={};

      this.copyTableData[index].updaterow = true;

      if(!this.propForUpdate)
      {
        var exobjfilter = this.externaldata.filter(abc => abc.id == rowobj.id);
          if(exobjfilter.length>0)
          {
               exobj = exobjfilter[0];
          }
        
         let bounds = this.getBounds(event);

         this.sendInformationToParent(true, {id:rowobj.id},exobj, bounds);

         
      }
      else
      {
         this.sendInformationToParent(true, {},{}, bounds);

      }
     
    },
    getBounds:function(event)
    {
        var el =  event.currentTarget;

        var bounds = el.getBoundingClientRect();
        let left =  bounds.left;
        let top =  bounds.top;

        return {
           left:left,
           top :top,
        };




    },
    sendInformationToParent: function (popup, updatequery, exObject, bounds) {

      this.$emit("messageFromTable", popup, updatequery, exObject, bounds);
    },

    parseValue: function (colobj, rowobj, index) {
      if (rowobj.value != "") {
        if (typeof colobj.value === "function") {
          let res = colobj.value.apply(colobj, [rowobj, index]);

          return res;
        } if(colobj.value !='' )
        {
          return rowobj[colobj.value];
          
        }else {
          return colobj.value;
        }
      } else {
        return "-";
      }
    },

    loadTableData: function () {
      if (this.pullUrl) {
        // Axios request

        var requestprops = new Object();
        if (this.queryList) {
          requestprops.query = this.queryList;
        }
        if (this.orderBy) {
          requestprops.orderby = this.orderBy;
        }
        if (this.limit) {
          requestprops.orderby = this.limit;
        }

        axios
          .post(this.pullUrl, requestprops)
          .then(
            (response) => {
              console.log("response:", response.data);

              if (response.status == 200) {
                if (response.data[0] == "success") {
                  this.externaldata = response.data[1];

                  this.copyDataFromExternal(this.externaldata);

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

    copyDataFromExternal: function (resultarr) {
      console.log("Started copying");
      if (this.parseFieldsExternal && resultarr) {
        console.log("resultarr and externalparsefields availabe");

        if (Array.isArray(resultarr)) {
          console.log("result array is array obj");

          resultarr.forEach((item, index, arr) => {
            let parsedobj = new Object();
            console.log("going through foreach loop");

            for (let i = 0; i < this.parseFieldsExternal.length; i++) {
              console.log("going through for loop");

              if (
                this.parseFieldsExternal[i].hasOwnProperty("to") &&
                this.parseFieldsExternal[i].hasOwnProperty("from")
              ) {
                console.log("has to and from properties");

                parsedobj[this.parseFieldsExternal[i].to] = get(
                  item,
                  this.parseFieldsExternal[i].from
                );
              }
            }
            parsedobj.updaterow = false;
            console.log("Parse Object:" + JSON.stringify(parsedobj));
            this.tabledata.push(parsedobj);
          }, this);
          this.copyTableData = this.tabledata;
          this.loadDataComplete = true;
        } else {
          console.log("External Data should be an Array :" + resultarr);
        }
      } else {
        console.log(
          "Necessory Information is missing for Parsing Dynamic Options"
        );
      }
    },
    cellStyles(columnobj) {
      if (columnobj.hasOwnProperty("cellAttributes")) {
        let width = columnobj.cellAttributes.hasOwnProperty("width")
          ? columnobj.cellAttributes.width
          : "200px";

        let padding = columnobj.cellAttributes.hasOwnProperty("padding")
          ? columnobj.cellAttributes.padding
          : "0px";

        return {
          width: width,
          padding: padding,
        };
      } else {
        return {};
      }
    },
  },
  computed: {
    dataValue: {
      get() {
        return this.thevalue;
      },
      set(value) {
        this.thevalue = value;
      },
    },
  },
  watch: {
    rerender: function (data, oldData) {
      if (data != oldData) {
      }
    },
  },
};
</script>

<style scoped>
.v-text-field--outlined >>> fieldset {
  border-color: #000;
}
</style>