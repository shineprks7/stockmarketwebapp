

<template>
  <div class="">
    <div class="mb-2" v-for="(row, rowindex) in rowData" :key="rowindex">
      <div class="d-flex flex-wrap">
        <div
          class=""
          :style="columnStyle(colindex)"
          v-for="(col, colindex) in row.columndata"
          :key="colindex"
        >

          <cellitemrowgroup :cellData="col"  :externalData = "externaldata"/>
        </div>
      </div>
    </div>
    
  </div>
</template>

  <script>
import theme1styles from "../themes/themedata1.js";

import cellitemrowgroup from "./cellitemrowgroup.vue";

import isobject from "lodash/isObject";

import get from 'lodash/get';


export default {
  components: {
    'cellitemrowgroup': cellitemrowgroup,
  },
  mixins: [theme1styles],

  props: {
    elementid: [Number, String],
    rowData: {
      type: Array,
      requred: true,
    },
    columnData: {
      type: Array,
      requred: true,
    },

    requiredQueryForPreLoad: {
      type: Array,
      required: true,
    },
    preLoadUrl: String,

    preLoad: {
      type: Boolean,
      required: true,
    },
  },

  data: function () {
    return {
      externaldata: {},

      rows: [],
      preLoadComplete: false,

    };
  },
  created() {},
  mounted() {
    if (this.rowData) {
      this.rows = this.rowData;
    }

    if (this.preLoad) {
      this.preLoadExternalData();

    }
  },
  methods: {
    satisfyPreloadQuery: function () {
      var satisfypreload = "";
      for (var i = 0; i < this.requiredQueryForPreLoad.length; i++) {
        if (this.queryList.hasOwnProperty(this.requiredQueryForPreLoad[i])) {
          satisfypreload = true;
        } else {
          satisfypreload = false;
          break;
        }
      }

      return satisfypreload;
    },
    preLoadExternalData: function () {
      if (this.satisfyPreloadQuery()) {
        //request

        if (this.preLoadUrl) {
          // Axios request

          var requestprops = new Object();
          requestprops.query = this.queryList;


          axios
            .post(this.preLoadUrl, requestprops)
            .then(
              (response) => {
                console.log("response:", response.data);

                console.log("requestpros: "+ JSON.stringify(requestprops));

                if (response.status == 200) {
                  if (response.data[0] == "success") {
                    this.externaldata = { ...response.data[1] };

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
      } else {
        this.preLoadComplete = true;
      }
    },
    columnStyle: function (index) {
      if (this.columnData.length > index) {
        var thestyleobj = isobject(this.columnData[index])
          ? this.columnData[index].hasOwnProperty("style")
            ? this.columnData[index].style
            : { width: "250px" }
          : { width: "250px" };

        return thestyleobj;
      } else {
        return { width: "250px" };
      }
    },
    columnClass: function (index) {},
  },
  computed: {
    queryList()
        {
          return this.$route.query;
        },
  },
  watch: {},
};
</script>

<style scoped>
</style>