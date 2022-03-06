

<template>
  <section
    class="d-flex justify-center align-center"
    style="width: 100%; height: 100%"
  >
    <main class="rclist_wrapper">
      <nav class="d-flex align-baseline justify-space-between">
        <div class="d-flex align-center">
          <div
            class="mr-4 main_tab_default"
            v-on:click="
              activateCategory(category);
              getRecommendationDataGeneral();
            "
            v-bind:class="classbindingMainTab(category)"
            v-for="(category, index) in categories"
            :key="index"
          >
            {{ category.name }}
          </div>
        </div>

        <div class="">
          <div class="export_button" v-on:click="exportAsCSV()">
            Export Data
          </div>
        </div>
      </nav>

      <div class="d-flex mt-8 align-center">
        <div class="tab_title mr-5">
          {{ dataSelectedCategoryName }}
        </div>

        <div>
          <section
            class="d-flex mr-5 align-center"
            v-if="togglecheckFutureSubCats()"
          >
            <div class="mr-3" v-for="(futurecat, index) in futuressubcats">
              <span
                class="checkbox_default"
                v-if="!checkActiveFuturesTab(futurecat)"
                v-on:click="addFuturesTabs(futurecat)"
              >
                <img src="/images/checkbox_inactive.png" />
              </span>
              <span
                class="checkbox_default"
                v-if="checkActiveFuturesTab(futurecat)"
                v-on:click="removeFuturesTabs(futurecat)"
              >
                <img src="/images/checkbox_active.png" />
              </span>
              <span>{{ futurecat.name }}</span>
            </div>
          </section>
          <section
            class="d-flex mr-5 align-center"
            v-if="togglecheckIntradaySubCats()"
          >
            <div class="mr-3" v-for="(intradaycat, index) in intradaysubcats">
              <span
                class="checkbox_default"
                v-if="!checkActiveIntradayTab(intradaycat)"
                v-on:click="addIntraDayTabs(intradaycat)"
              >
                <img src="/images/checkbox_inactive.png" />
              </span>
              <span
                class="checkbox_default"
                v-if="checkActiveIntradayTab(intradaycat)"
                v-on:click="removeIntraDayTabs(intradaycat)"
              >
                <img src="/images/checkbox_active.png" />
              </span>

              <span class="subtab_default">{{ intradaycat.name }}</span>
            </div>
          </section>
        </div>
      </div>

      <div class="mt-2">
        <section class="table_header_wrap">
          <div class="d-flex align-center">
            <div class="table_col_default col_date">Date</div>

            <div class="table_col_default col_number">Scrip</div>
            <div class="table_col_default col_number">Action</div>
            <div class="table_col_default col_number">Entry Price</div>

            <div class="table_col_default col_number">Lot Size</div>

            <div class="table_col_default col_number">Target 1</div>

            <div class="table_col_default col_number">Target 2</div>
            <div class="table_col_default col_number">Stop Loss</div>

            <div class="table_col_default">Status</div>

            <div class="ml-4 table_col_default subtab_name_default"></div>
          </div>
        </section>

        <section
          class="table_row_wrap"
          v-for="(list, index) in recommendationlistdata"
          :key="index"
        >
          <div>
            <div class="d-flex align-center">
              <div class="table_col_default col_date">
                {{ formattedDate(list.recommendationdate) }}
              </div>

              <div class="table_col_default col_number scrip_detail">
                {{ list.scrip }}
              </div>
              <div class="table_col_default col_number">{{ list.action }}</div>
              <div class="table_col_default col_number">
                {{ formatIndianCurrency(list.entryprice) }}
              </div>

              <div class="table_col_default col_number">{{ list.lotsize }}</div>

              <div class="table_col_default col_number">
                {{ formatIndianCurrency(list.target1) }}
              </div>

              <div class="table_col_default col_number">
                {{ formatIndianCurrency(list.target2) }}
              </div>
              <div class="table_col_default col_number">
                {{ formatIndianCurrency(list.stoploss) }}
              </div>

              <div class="table_col_default">{{ list.status }}</div>

              <div
                class="ml-4 table_col_default subtab_name_default"
                v-bind:class="classBindingSubTabColumn(list.subtabname)"
              >
                {{ subTabDisplayname(list.subtabname) }}
              </div>
            </div>
          </div>

          <div class="floating_plot_right">
            <div class="floating_wrapper d-flex align-center">
              <div v-on:click="invokeEditor(list)">
                <img src="images/edit.png" />
              </div>
              <div class="ml-4" v-on:click="invokeStatusChanger(list)">
                <img src="images/change2.png" />
              </div>
              <div class="ml-4"><img src="images/open.png" /></div>
            </div>
          </div>

          <v-divider class="mt-3 mb-1"> </v-divider>
        </section>
      </div>

      <aside class="">
        <div
          v-if="statuschangerinvoked"
          class="
            overflay_full overflay_effect
            d-flex
            justify-center
            align-center
          "
        >
          <statuschanger
            :currentstatus="activeStatusChangeData.status"
            :id="activeStatusChangeData.id"
            :scripname="activeStatusChangeData.scrip"
            :tabname="activeStatusChangeData.tabname"
            :subtabname="activeStatusChangeData.subtabname"
          >
          </statuschanger>
        </div>

        <div
          v-if="editorinvoked"
          class="
            overflay_full overflay_effect
            d-flex
            justify-center
            align-center
          "
        >
          <popupeditor :editingdata="activeEditingDataRow"> </popupeditor>
        </div>
      </aside>
    </main>
  </section>
</template>

  <script>
import statuschanger from "./statuschanger.vue";
import popupeditor from "./popupeditor.vue";

import moment from "moment";

export default {
  components: {
    statuschanger: statuschanger,
    popupeditor: popupeditor,
  },

  data: function () {
    return {
      calltypes: [
        { id: 1, name: "BUY", aname: "buy" },
        { id: 2, name: "SELL", aname: "sell" },
      ],
      categories: [
        { id: 1, name: "Intra Day", aname: "intraday" },
        { id: 2, name: "Short Term", aname: "shortterm" },
        { id: 3, name: "Futures and Options", aname: "futuresandoptions" },
        { id: 4, name: "Not Specified", aname: "null" },
      ],

      intradaysubcats: [
        { id: 1, name: "Cash", aname: "intradaycash" },
        { id: 2, name: "Derivatives", aname: "intradayderivatives" },
      ],

      activeintraday: "",

      futuressubcats: [
        { id: 1, name: "Index Futures", aname: "indexfutures" },
        { id: 2, name: "Stock Futures", aname: "stockfutures" },
        { id: 3, name: "Index Options", aname: "indexoptions" },
        { id: 4, name: "Stock Options", aname: "stockoptions" },
      ],

      activefuturecat: "",

      activecategory: "1",

      activeIntraDayTabs: [
        { id: 1, name: "Cash", aname: "intradaycash" },
        { id: 2, name: "Derivatives", aname: "intradayderivatives" },
      ],
      activeFuturesTabs: [
        { id: 1, name: "Index Futures", aname: "indexfutures" },
        { id: 2, name: "Stock Futures", aname: "stockfutures" },
        { id: 3, name: "Index Options", aname: "indexoptions" },
        { id: 4, name: "Stock Options", aname: "stockoptions" },
      ],

      intradaydata: [],
      futuresdata: [],
      shortimedata: [],
      unknowdata: [],

      recommendationlistdata: [],

      activeStatusChangeRow: "",
      activeEditingDataRow: {
        id: "",
      },
    };
  },
  created() {},
  mounted() {
    this.getRecommendationDataGeneral();
  },
  methods: {
    formatIndianCurrency: function (value) {
      return value.toLocaleString("en-in", {
        style: "currency",
        currency: "INR",
      });
    },
    formattedDate: function (value) {
      return moment(value).format("Do MMM, YY");
    },
    getRecommendationDataGeneral: function () {
      axios
        .post("/api/getrecommendationlistgeneral", {
          tabname: this.dateSelectedCategory,
          subtablist: this.dataSubTabList,
          status: "",
          fromdate: "",
          todate: "",
        })
        .then(
          (response) => {
            console.log("response:", response.data);
            if (response.status == 200) {
              if (response.data[0] == "success") {
                console.log("Success ");

                this.recommendationlistdata = response.data[1];
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
    },

    activateCategory: function (value) {
      this.activecategory = value.id;
    },
    classbindingMainTab: function (value) {
      return this.activecategory == value.id
        ? "main_tab_active"
        : "main_tab_inactive";
    },

    activateCategory: function (value) {
      this.activecategory = value.id;
    },
    addIntraDayTabs: function (value) {
      var filteredvalues = this.activeIntraDayTabs.filter(
        (abc) => abc.id == value.id
      );

      if (filteredvalues.length < 1) {
        this.activeIntraDayTabs.push(value);
      }
    },
    removeIntraDayTabs: function (value) {
      var filteredvalues = this.activeIntraDayTabs.filter(
        (abc) => abc.id == value.id
      );

      if (filteredvalues.length > 0) {
        var index = this.activeIntraDayTabs.indexOf(filteredvalues[0]);

        this.activeIntraDayTabs.splice(index, 1);
      }
    },
    addFuturesTabs: function (value) {
      var filteredvalues = this.activeFuturesTabs.filter(
        (abc) => abc.id == value.id
      );

      if (filteredvalues.length < 1) {
        this.activeFuturesTabs.push(value);
      }
    },
    removeFuturesTabs: function (value) {
      var filteredvalues = this.activeFuturesTabs.filter(
        (abc) => abc.id == value.id
      );

      if (filteredvalues.length > 0) {
        var index = this.activeFuturesTabs.indexOf(filteredvalues[0]);

        this.activeFuturesTabs.splice(index, 1);
      }
    },

    togglecheckIntradaySubCats: function () {
      return this.activecategory == 1 ? true : false;
    },
    togglecheckFutureSubCats: function () {
      return this.activecategory == 3 ? true : false;
    },
    checkActiveFuturesTab: function (value) {
      var filteredvalues = this.activeFuturesTabs.filter(
        (abc) => abc.id == value.id
      );

      if (filteredvalues.length > 0) {
        return true;
      } else {
        return false;
      }
    },
    checkActiveIntradayTab: function (value) {
      var filteredvalues = this.activeIntraDayTabs.filter(
        (abc) => abc.id == value.id
      );

      if (filteredvalues.length > 0) {
        return true;
      } else {
        return false;
      }
    },
    subTabDisplayname: function (value) {
      if (value == "intradaycash") {
        return "Cash";
      } else if (value == "intradayderivatives") {
        return "Derivatives";
      } else if (value == "indexfutures") {
        return "Index Futures";
      } else if (value == "stockfutures") {
        return "Stock Futures";
      } else if (value == "indexoptions") {
        return "Index Options";
      } else if (value == "stockoptions") {
        return "Stock Options";
      }
    },
    classBindingSubTabColumn: function (value) {
      if (value == "intradaycash") {
        return "subtab_name_style1";
      } else if (value == "intradayderivatives") {
        return "subtab_name_style2";
      } else if (value == "indexfutures") {
        return "subtab_name_style1";
      } else if (value == "stockfutures") {
        return "subtab_name_style2";
      } else if (value == "indexoptions") {
        return "subtab_name_style3";
      } else if (value == "stockoptions") {
        return "subtab_name_style4";
      }
    },
    invokeStatusChanger: function (value) {
      this.activeStatusChangeRow = value;

      this.$store.commit("stockrecommendationsstore/invokestatuschange", true);
    },
    invokeEditor: function (value) {
      this.activeEditingDataRow = value;

      this.$store.commit("stockrecommendationsstore/invokeeditor", true);
    },
  },
  computed: {
    statuschangerinvoked() {
      return this.$store.state.stockrecommendationsstore.statuschangerinvoked;
    },
    editorinvoked() {
      return this.$store.state.stockrecommendationsstore.editorinvoked;
    },
    activeStatusChangeData() {
      if (this.activeStatusChangeRow != "") {
        return this.activeStatusChangeRow;
      } else {
        return { id: "", status: "", script: "", subtabname: "", tabname: "" };
      }
    },

    dataSelectedCategoryName() {
      var filteredvalues = this.categories.filter(
        (abc) => abc.id == this.activecategory
      );
      if (filteredvalues.length > 0) {
        return filteredvalues[0].name;
      } else {
        return "";
      }
    },
    dateSelectedCategory() {
      var filteredvalues = this.categories.filter(
        (abc) => abc.id == this.activecategory
      );
      if (filteredvalues.length > 0) {
        return filteredvalues[0].aname;
      } else {
        return "";
      }
    },
    dataSubTabList() {
      if (this.activecategory == 1) {
        return this.activeIntraDayTabs;
      } else if (this.activecategory == 3) {
        return this.activeFuturesTabs;
      } else {
        return "";
      }
    },
    exportAsCSV: function () {
      //define the heading for each row of the data
      var csv =
        "Date,Scrip,Action,Entry Price,Lot Size,Target 1,Target 2,Stop Loss,Status\n";

      //merge the data with CSV
      /*
                    csvFileData.forEach(function(row) {
                     csv += row.join(',');
                      csv += "\n";
                   });

                   */

      if (this.recommendationlistdata.length > 0) {
        for (var i = 0; i < this.recommendationlistdata.length; i++) {
          csv += this.recommendationlistdata[i].recommendationdate + ",";
          csv += this.recommendationlistdata[i].scrip + ",";
          csv += this.recommendationlistdata[i].action + ",";
          csv += this.recommendationlistdata[i].entryprice + ",";
          csv += this.recommendationlistdata[i].lotsize + ",";
          csv += this.recommendationlistdata[i].target1 + ",";
          csv += this.recommendationlistdata[i].target2 + ",";

          csv += this.recommendationlistdata[i].stoploss + ",";
          csv += this.recommendationlistdata[i].status + ",";
          csv += "\n";
        }
      }

      //display the created CSV data on the web browser
      /*
                    document.write(csv);
                  */

      var hiddenElement = document.createElement("a");
      hiddenElement.href = "data:text/csv;charset=utf-8," + encodeURI(csv);
      hiddenElement.target = "_blank";

      //provide the name for the CSV file to be downloaded
      hiddenElement.download = "TradingCalls.csv";
      hiddenElement.click();
    },
  },
  watch: {
    activeIntraDayTabs: function (newData, oldData) {
      this.getRecommendationDataGeneral();
    },
    activeFuturesTabs: function (newData, oldData) {
      this.getRecommendationDataGeneral();
    },
    statuschangerinvoked: function (newData, oldData) {
      this.getRecommendationDataGeneral();
    },
    editorinvoked: function (newData, oldData) {
      this.getRecommendationDataGeneral();
    },
  },
};
</script>

<style scoped>
.rclist_wrapper {
  min-width: 1000px;
}
.export_button {
  font-family: Poppins;
  text-align: center;
  width: 150px;

  font-size: 12px;

  background-color: #827cce;
  color: #fff;
  padding: 5px;
}

.main_tab_default {
}
.main_tab_inactive {
  font-family: Poppins;

  font-weight: normal;
  font-size: 14px;
  line-height: 16px;

  color: #c5a4a4;
}
.main_tab_active {
  font-family: Poppins;

  font-weight: 600;
  font-size: 14px;
  line-height: 16px;
  color: #827cce;
}
.main_tab_active::after {
  top: -100%;
  transform: translate(0, -110%);
  width: 100%;
  height: 1.5px;
  background-color: #827cce;
}

.tab_title {
  font-family: Roboto;
  font-style: normal;
  font-weight: 600;
  font-size: 17px;
  line-height: 20px;

  color: #000000;
}
.checkbox_default {
  position: relative;
  top: 3px;
}
.subtab_default {
  font-weight: normal;
  font-size: 14px;
  line-height: 16px;

  color: #744f4f;
}

.table_header_wrap {
  padding: 5px;
  padding-top: 8px;
  padding-bottom: 8px;

  background: #c3eeee;

  border-radius: 10px;
  box-sizing: border-box;
}
.table_row_wrap {
  padding: 5px;
  padding-top: 8px;
  padding-bottom: 8px;

  background: #fff;
  color: #000;
  box-sizing: border-box;
  transform: rotate(0deg);
}

.table_col_default {
  font-weight: normal;
  font-size: 14px;
  line-height: 16px;

  color: #533232;
}
.col_date {
  width: 120px;
}
.col_number {
  width: 100px;
}
.scrip_detail {
  color: #8753f8;
  font-weight: bold;
}
.subtab_name_default {
  border-radius: 5px;
  padding: 4px;
  padding-top: 6px;
  padding-bottom: 6px;
  width: 120px;
  font-size: 14px;
  display: inline-block;
  text-align: center;
}
.subtab_name_style1 {
  background-color: #fe5d26;
  color: #fff;
}
.subtab_name_style2 {
  background-color: #283d3b;
  color: #fff;
}
.subtab_name_style3 {
  background-color: #197278;
  color: #fff;
}
.subtab_name_style4 {
  background-color: #197278;

  color: #fff;
}
.floating_plot_right {
  position: absolute;
  right: -10px;
  top: 50%;
}
.floating_wrapper {
  width: auto;
  padding-left: 5px;
  transform: translate(101%, -70%);
}
.overflay_effect {
  background-color: rgba(255, 255, 255, 0.7);
}
.overflay_full {
  width: 100vw;
  height: 100vh;
  position: fixed;
  z-index: 1000;
  top: 0;
  left: 0;
}
</style>