

<template>
  <section
    class="d-flex justify-center align-center"
    style="width: 100%; height: 100%"
  >
    <main class="stock-wrapper">
      <div class="label_style1 mt-4">Select Call Type:</div>

      <div class="mt-4">
        <div class="d-flex">
          <div
            class="selection_buttons_default mr-16"
            v-bind:class="selectionClassDynamic('call', calltype)"
            v-on:click="activationGeneral('call', calltype)"
            v-for="(calltype, index) in calltypes"
            :key="index"
          >
            <div class="d-flex justify-center align-center">
              <span>{{ calltype.name }} </span>
            </div>
          </div>
        </div>
      </div>

      <v-divider class="mt-4 mb-2"> </v-divider>

      <div class="label_style1">Select Category:</div>

      <div class="mt-4">
        <div class="d-flex">
          <div
            class="selection_buttons_default mr-16"
            v-bind:class="selectionClassDynamic('category', category)"
            v-on:click="activationGeneral('category', category)"
            v-for="(category, index) in categories"
            :key="index"
          >
            <div class="d-flex justify-center align-center">
              <span>{{ category.name }} </span>
            </div>
          </div>
        </div>
      </div>

      <v-divider v-if="togglecheckFutureSubCats()" class="mt-4 mb-2">
      </v-divider>

      <section v-if="togglecheckFutureSubCats()">
        <div class="label_style1">Select Subcategory:</div>

        <div class="mt-4">
          <div class="d-flex">
            <div
              class="selection_buttons_default mr-16"
              v-bind:class="selectionClassDynamic('futurecat', futurecat)"
              v-on:click="activationGeneral('futurecat', futurecat)"
              v-for="(futurecat, index) in futuressubcats"
              :key="index"
            >
              <div class="d-flex justify-center align-center">
                <span>{{ futurecat.name }} </span>
              </div>
            </div>
          </div>
        </div>
      </section>

      <v-divider class="mt-4 mb-2" v-if="togglecheckIntradaySubCats()">
      </v-divider>

      <section v-if="togglecheckIntradaySubCats()">
        <div class="label_style1">Select Subcategory</div>

        <div class="mt-4">
          <div class="d-flex">
            <div
              class="selection_buttons_default mr-16"
              v-bind:class="selectionClassDynamic('intradaycat', intradaycat)"
              v-on:click="activationGeneral('intradaycat', intradaycat)"
              v-for="(intradaycat, index) in intradaysubcats"
              :key="index"
            >
              <div class="d-flex justify-center align-center">
                <span>{{ intradaycat.name }} </span>
              </div>
            </div>
          </div>
        </div>
      </section>

      <v-divider class="mt-4 mb-2"> </v-divider>

      <section>
        <div class="d-flex">
          <div class="text_field_medium mr-5">
            <div class="">
              <v-text-field outlined dense color="black" v-model="dataScrip">
                <template v-slot:label>
                  <span style="color: black"> ENTER SCRIP NAME</span>
                </template>
              </v-text-field>
            </div>
          </div>

          <div class="text_field_medium mr-5">
            <div class="">
              <v-select
                v-model="dataStatus"
                :items="statuslist"
                :item-text="(item) => item.displayname"
                :item-value="(item) => item.name"
                outlined
                dense
              >
                <template v-slot:label>
                  <span class="input__label">Status </span>
                </template>
              </v-select>
            </div>
          </div>
          <div class="text_field_medium mr-5">
            <div class="">
              <v-text-field
                outlined
                dense
                color="black"
                v-model="dataRecommendationdate"
                type="date"
              >
                <template v-slot:label>
                  <span style="color: black"> ENTER DATE</span>
                </template>
              </v-text-field>
            </div>
          </div>
        </div>
      </section>

      <section>
        <div class="d-flex">
          <div class="mr-5">
            <div class="">
              <v-text-field dense color="black" v-model="dataEntryPrice">
                <template v-slot:label>
                  <span style="color: black"> ENTRY PRICE</span>
                </template>
              </v-text-field>
            </div>
          </div>
          <div class="mr-5">
            <div class="">
              <v-text-field dense color="black" v-model="dateTarget1">
                <template v-slot:label>
                  <span style="color: black"> ENTER TARGET 1</span>
                </template>
              </v-text-field>
            </div>
          </div>
          <div class="mr-5">
            <div class="">
              <v-text-field dense color="black" v-model="dateTarget2">
                <template v-slot:label>
                  <span style="color: black"> ENTER TARGET 2</span>
                </template>
              </v-text-field>
            </div>
          </div>
          <div class="mr-5" v-if="togglecheckLotsize()">
            <div class="">
              <v-text-field dense color="black" v-model="dataLotSize">
                <template v-slot:label>
                  <span style="color: black"> LOT SIZE</span>
                </template>
              </v-text-field>
            </div>
          </div>
          <div class="mr-5">
            <div class="">
              <v-text-field dense color="black" v-model="dataStoploss">
                <template v-slot:label>
                  <span style="color: black"> STOP LOSS</span>
                </template>
              </v-text-field>
            </div>
          </div>
        </div>
      </section>

      <v-divider class="mt-4 mb-2"> </v-divider>

      <div
        class="mt-5 submit_btn_style1"
        v-if="finalValidation()"
        v-on:click="createRecommendation()"
      >
        CREATE
      </div>
      <div class="mt-5 submit_btn_disabled" v-if="!finalValidation()">
        CREATE
      </div>

      <div>Meet validation : {{ meetValidationSelectedFields() }}</div>
      <div></div>
    </main>

    <div
      v-if="createrequest"
      class="overflay_full overflay_effect d-flex justify-center align-center"
    >
      <div class="d-flex align-center">
        <div class="mr-4"><span class="loading_text">CREATING</span></div>
        <div><img src="/images/Ellipsis_loader2.gif" /></div>
      </div>
    </div>
    <div
      v-if="successrequest"
      class="overflay_full overflay_effect_2 d-flex justify-center align-center"
    >
      <div>
        <div class="success_imgwrap">
          <img src="/images/success_check.png" />
        </div>
        <div class="mt-6 success_text">SUCCESSFULLY CREATED</div>
      </div>
    </div>
  </section>
</template>

  <script>
export default {
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
        { id: 4, name: "Positional", aname: "positional" },
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

      activecalltype: "",
      activecategory: "",

      statuslist: [
        { id: 1, name: "open", displayname: "Open" },
        { id: 2, name: "target1", displayname: "Target 1 Achieved" },
        { id: 3, name: "target2", displayname: "Target 2 Achieved" },
        { id: 4, name: "loss", displayname: "Stop Loss Triggered" },
        { id: 5, name: "notinitiated", displayname: "Not Initiated" },
        { id: 6, name: "closed", displayname: "Closed" },
      ],

      scrip: "",
      entryprice: "",
      target1: "",
      target2: "",
      stoploss: "",
      lotsize: "",
      status: "",

      validetionattempt: false,

      createrequest: false,
      successrequest: false,
      erroraftercreation: false,
      recommendationdate: "",

      validation: {
        category: false,
        call: false,
        futurescat: false,
        intradaycat: false,

        scrip: false,
        entryprice: false,
        target1: false,
        target2: false,
        stoploss: false,
        lotsize: false,
        status: false,
      },
    };
  },
  created() {},
  mounted() {
    this.onloaddate();
  },
  methods: {
    onloaddate: function () {
      const date = new Date();
      date.setDate(date.getDate());

      var n = date.toISOString().substr(0, 10);

      this.recommendationdate = n;
    },
    emptyData: function () {
      this.activeintraday = "";
      this.activefuturecat = "";
      this.activecalltype = "";
      this.activecategory = "";

      this.scrip = "";
      this.entryprice = "";
      this.target1 = "";
      this.target2 = "";
      this.stoploss = "";
      this.lotsize = "";
      this.status = "";
    },
    validateFields: function () {
      this.validation.scrip = this.scrip != "" ? true : false;
      this.validation.entryprice = this.entryprice != "" ? true : false;
      this.validation.target1 = this.target1 != "" ? true : false;
      this.validation.target2 = this.target2 != "" ? true : false;
      this.validation.stoploss = this.stoploss != "" ? true : false;
      this.validation.lotsize = this.lotsize != "" ? true : false;
      this.validation.status = this.status != "" ? true : false;

      this.validation.category = this.category != "" ? true : false;
      this.validation.call = this.call != "" ? true : false;
      this.validation.futurescat = this.futurescat != "" ? true : false;
      this.validation.intradaycat = this.intradaycat != "" ? true : false;
    },

    createRecommendation: function () {
      this.createrequest = true;

      axios
        .post("/api/createrecommendation", {
          scrip: this.dataScrip,
          action: this.dateSelectedCall,
          entryprice: this.entryprice,
          target1: this.target1,
          target2: this.target2,
          stoploss: this.stoploss,
          status: this.status,
          lotsize: this.lotsize,
          tabname: this.dateSelectedCategory,
          subtabname: this.dataSubTabName,
          recommendationdate: this.recommendationdate,
        })
        .then(
          (response) => {
            this.createrequest = false;

            console.log("response:", response.data);
            if (response.status == 200) {
              if (response.data[0] == "success") {
                console.log("Success Fully Created");
                this.emptyData();

                this.successrequest = true;

                setTimeout(
                  function () {
                    this.successrequest = false;
                  }.bind(this),
                  1000
                );
              }
            } else {
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
    activateCalltype: function (call) {
      this.activecalltype = call.id;
    },
    activateCategory: function (category) {
      this.activecategory = category.id;
    },
    activateIntradayCat: function (category) {
      this.activeintraday = category.id;
    },
    activateFuturesCat: function (category) {
      this.activefuturecat = category.id;
    },

    activationGeneral: function (type, value) {
      if (type == "futurecat") {
        this.activefuturecat = value.id;
      } else if (type == "intradaycat") {
        this.activeintraday = value.id;
      } else if (type == "category") {
        this.activecategory = value.id;
      } else if (type == "call") {
        this.activecalltype = value.id;
      } else {
      }
    },
    checkActiveItemGeneral: function (type, value) {
      if (type == "futurecat") {
        return this.activefuturecat == value.id ? true : false;
      } else if (type == "intradaycat") {
        return this.activeintraday == value.id ? true : false;
      } else if (type == "category") {
        return this.activecategory == value.id ? true : false;
      } else if (type == "call") {
        return this.activecalltype == value.id ? true : false;
      } else {
      }
    },

    selectionClassDynamic: function (type, value) {
      var isactive = this.checkActiveItemGeneral(type, value);

      if (isactive) {
        return "selection_buttons_active";
      } else {
        return "selection_buttons_inactive";
      }
    },

    togglecheckIntradaySubCats: function () {
      return this.activecategory == 1 ? true : false;
    },
    togglecheckFutureSubCats: function () {
      return this.activecategory == 3 || this.activecategory == 4
        ? true
        : false;
    },

    togglecheckLotsize: function () {
      return this.activecategory == 3 ? true : false;
    },
    finalValidation: function () {
      this.validateFields();

      if (this.meetValidationFields()) {
        return true;
      } else {
        return false;
      }
    },
    meetValidationSelectedFields: function () {
      if (this.activecategory != "" && this.activateCalltype != "") {
        if (this.activateCategory == "1") {
          return this.activateIntradayCat != "" ? true : false;
        } else if (this.activateCategory == "2") {
          return true;
        } else if (this.activateCategory == "3") {
          return this.activefuturecat != "" ? true : false;
        } else {
          return false;
        }
      } else {
        return false;
      }
    },
    meetValidationFields: function () {
      if (this.activecategory == "3") {
        if (
          this.validation.lotsize &&
          this.validation.scrip &&
          this.validation.status &&
          this.validation.stoploss &&
          this.validation.entryprice &&
          this.validation.target1 &&
          this.validation.target2
        ) {
          return true;
        } else {
          return false;
        }
      } else {
        if (
          this.validation.scrip &&
          this.validation.status &&
          this.validation.stoploss &&
          this.validation.entryprice &&
          this.validation.target1 &&
          this.validation.target2
        ) {
          return true;
        } else {
          return false;
        }
      }
    },
  },
  computed: {
    routesubmenu() {
      return this.$route.params.submenu;
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
    dateSelectedCall() {
      var filteredvalues = this.calltypes.filter(
        (abc) => abc.id == this.activecalltype
      );
      if (filteredvalues.length > 0) {
        return filteredvalues[0].aname;
      } else {
        return "";
      }
    },
    dataSelectedFuture() {
      var filteredvalues = this.futuressubcats.filter(
        (abc) => abc.id == this.activefuturecat
      );
      if (filteredvalues.length > 0) {
        return filteredvalues[0].aname;
      } else {
        return "";
      }
    },
    dataSubTabName() {
      if (this.activecategory == 1) {
        return this.dataSelectedIntraday;
      } else if (this.activecategory == 3) {
        return this.dataSelectedFuture;
      } else {
        return "";
      }
    },
    dataSelectedIntraday() {
      var filteredvalues = this.intradaysubcats.filter(
        (abc) => abc.id == this.activeintraday
      );
      if (filteredvalues.length > 0) {
        return filteredvalues[0].aname;
      } else {
        return "";
      }
    },

    dataRecommendationdate: {
      get() {
        return this.recommendationdate;
      },
      set(value) {
        this.recommendationdate = value;
      },
    },
    dateTarget1: {
      get() {
        return this.target1;
      },
      set(value) {
        this.target1 = value;
      },
    },
    dateTarget2: {
      get() {
        return this.target2;
      },
      set(value) {
        this.target2 = value;
      },
    },
    dataStoploss: {
      get() {
        return this.stoploss;
      },
      set(value) {
        this.stoploss = value;
      },
    },
    dataLotSize: {
      get() {
        return this.lotsize;
      },
      set(value) {
        this.lotsize = value;
      },
    },
    dataEntryPrice: {
      get() {
        return this.entryprice;
      },
      set(value) {
        this.entryprice = value;
      },
    },
    dataScrip: {
      get() {
        return this.scrip;
      },
      set(value) {
        this.scrip = value;
      },
    },
    dataStatus: {
      get() {
        return this.status;
      },
      set(value) {
        this.status = value;
      },
    },
  },
};
</script>

<style scoped>
.v-text-field--outlined >>> fieldset {
  border-color: #000;
}
.stock-wrapper {
  font-family: "Poppins", sans-serif;

  width: 1100px;
  height: auto;
  min-height: 650px;
}
.submit_btn_style1 {
  width: 250px;
  padding: 6px;
  text-align: center;
  font-size: 21px;
  margin-left: auto;
  margin-right: auto;

  background: linear-gradient(
    268.29deg,
    #3a0cbd 5.98%,
    rgba(150, 30, 169, 0.7) 100%
  );
  color: white;
  border: 1px solid #000000;
  border-radius: 30px;
  cursor: pointer;
}
.submit_btn_disabled {
  width: 250px;
  padding: 6px;
  text-align: center;
  font-size: 21px;

  margin-left: auto;
  margin-right: auto;

  background: linear-gradient(
    268.29deg,
    #3a0cbd 5.98%,
    rgba(150, 30, 169, 0.7) 100%
  );
  color: white;
  border: 1px solid #000000;

  border-radius: 30px;
  cursor: not-allowed;
  opacity: 0.6;
}
.label_style1 {
  font-style: normal;
  font-weight: 500;
  font-size: 15px;
  line-height: 20px;

  color: #47ad63;
}
.selection_buttons_default {
  width: 241px;
  font-size: 15px;
  padding: 4px;
  box-sizing: border-box;
  border-radius: 20px;
  font-weight: 600;
}
.selection_buttons_active {
  background: #47ad63;
  border: 1px solid #47ad63;
  color: #fff;
  background: linear-gradient(
    268.57deg,
    #55715d 5.26%,
    rgba(89, 69, 73, 0.5) 100%
  );
}

.selection_buttons_inactive {
  background: #fff;
  border: 1px solid #47ad63;
  color: #000;
}

.textboxwrapper_style1 {
  width: 250px;
  height: auto;
  border: 1px solid #47ad63;
  box-sizing: border-box;
}
.textbox_style1 {
  padding: 5px;

  padding-left: 10px;
  padding-right: 10px;
  width: 100%;
  height: 100%;
  color: #000;
  font-size: 18px;
  font-weight: 600;

  box-sizing: border-box;
}
.textbox_style1 {
  outline: 0;
}
.textbox_style1::focus {
  outline: 0;
}

.textboxwrapper_style2 {
  width: 200px;
  border: 1px solid #47ad63;
  box-sizing: border-box;
}
.textbox_style2 {
  padding: 5px;

  padding-left: 10px;
  padding-right: 10px;
  width: 100%;
  height: 100%;
  color: #000;
  font-size: 18px;

  box-sizing: border-box;
}
.textbox_style2 {
  outline: 0;
}
.textbox_style2::focus {
  outline: 0;
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
.overflay_effect_2 {
  background-color: rgba(255, 255, 255, 1);
}
.loading_text {
  font-size: 35px;
  color: #4f43af;
  font-weight: 700;
}
.success_imgwrap {
  text-align: center;
}
.success_text {
  text-align: center;

  font-size: 30px;
  color: #3c64ee;
}

.text_field_medium {
  width: 250px;
}
</style>