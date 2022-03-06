"use strict";
(self["webpackChunk"] = self["webpackChunk"] || []).push([["resources_js_dashboard_stockrecommendationcomponents_createstockrecommendation_vue"],{

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/dashboard/stockrecommendationcomponents/createstockrecommendation.vue?vue&type=script&lang=js&":
/*!*************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/dashboard/stockrecommendationcomponents/createstockrecommendation.vue?vue&type=script&lang=js& ***!
  \*************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  data: function data() {
    return {
      calltypes: [{
        id: 1,
        name: "BUY",
        aname: "buy"
      }, {
        id: 2,
        name: "SELL",
        aname: "sell"
      }],
      categories: [{
        id: 1,
        name: "Intra Day",
        aname: "intraday"
      }, {
        id: 2,
        name: "Short Term",
        aname: "shortterm"
      }, {
        id: 3,
        name: "Futures and Options",
        aname: "futuresandoptions"
      }, {
        id: 4,
        name: "Positional",
        aname: "positional"
      }],
      intradaysubcats: [{
        id: 1,
        name: "Cash",
        aname: "intradaycash"
      }, {
        id: 2,
        name: "Derivatives",
        aname: "intradayderivatives"
      }],
      activeintraday: "",
      futuressubcats: [{
        id: 1,
        name: "Index Futures",
        aname: "indexfutures"
      }, {
        id: 2,
        name: "Stock Futures",
        aname: "stockfutures"
      }, {
        id: 3,
        name: "Index Options",
        aname: "indexoptions"
      }, {
        id: 4,
        name: "Stock Options",
        aname: "stockoptions"
      }],
      activefuturecat: "",
      activecalltype: "",
      activecategory: "",
      statuslist: [{
        id: 1,
        name: "open",
        displayname: "Open"
      }, {
        id: 2,
        name: "target1",
        displayname: "Target 1 Achieved"
      }, {
        id: 3,
        name: "target2",
        displayname: "Target 2 Achieved"
      }, {
        id: 4,
        name: "loss",
        displayname: "Stop Loss Triggered"
      }, {
        id: 5,
        name: "notinitiated",
        displayname: "Not Initiated"
      }, {
        id: 6,
        name: "closed",
        displayname: "Closed"
      }],
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
        status: false
      }
    };
  },
  created: function created() {},
  mounted: function mounted() {
    this.onloaddate();
  },
  methods: {
    onloaddate: function onloaddate() {
      var date = new Date();
      date.setDate(date.getDate());
      var n = date.toISOString().substr(0, 10);
      this.recommendationdate = n;
    },
    emptyData: function emptyData() {
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
    validateFields: function validateFields() {
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
    createRecommendation: function createRecommendation() {
      var _this = this;

      this.createrequest = true;
      axios.post("/api/createrecommendation", {
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
        recommendationdate: this.recommendationdate
      }).then(function (response) {
        _this.createrequest = false;
        console.log("response:", response.data);

        if (response.status == 200) {
          if (response.data[0] == "success") {
            console.log("Success Fully Created");

            _this.emptyData();

            _this.successrequest = true;
            setTimeout(function () {
              this.successrequest = false;
            }.bind(_this), 1000);
          }
        } else {}
      }, function (error) {
        console.log(error);
      })["catch"](function (error) {
        console.log(error.response);
      });
    },
    activateCalltype: function activateCalltype(call) {
      this.activecalltype = call.id;
    },
    activateCategory: function activateCategory(category) {
      this.activecategory = category.id;
    },
    activateIntradayCat: function activateIntradayCat(category) {
      this.activeintraday = category.id;
    },
    activateFuturesCat: function activateFuturesCat(category) {
      this.activefuturecat = category.id;
    },
    activationGeneral: function activationGeneral(type, value) {
      if (type == "futurecat") {
        this.activefuturecat = value.id;
      } else if (type == "intradaycat") {
        this.activeintraday = value.id;
      } else if (type == "category") {
        this.activecategory = value.id;
      } else if (type == "call") {
        this.activecalltype = value.id;
      } else {}
    },
    checkActiveItemGeneral: function checkActiveItemGeneral(type, value) {
      if (type == "futurecat") {
        return this.activefuturecat == value.id ? true : false;
      } else if (type == "intradaycat") {
        return this.activeintraday == value.id ? true : false;
      } else if (type == "category") {
        return this.activecategory == value.id ? true : false;
      } else if (type == "call") {
        return this.activecalltype == value.id ? true : false;
      } else {}
    },
    selectionClassDynamic: function selectionClassDynamic(type, value) {
      var isactive = this.checkActiveItemGeneral(type, value);

      if (isactive) {
        return "selection_buttons_active";
      } else {
        return "selection_buttons_inactive";
      }
    },
    togglecheckIntradaySubCats: function togglecheckIntradaySubCats() {
      return this.activecategory == 1 ? true : false;
    },
    togglecheckFutureSubCats: function togglecheckFutureSubCats() {
      return this.activecategory == 3 || this.activecategory == 4 ? true : false;
    },
    togglecheckLotsize: function togglecheckLotsize() {
      return this.activecategory == 3 ? true : false;
    },
    finalValidation: function finalValidation() {
      this.validateFields();

      if (this.meetValidationFields()) {
        return true;
      } else {
        return false;
      }
    },
    meetValidationSelectedFields: function meetValidationSelectedFields() {
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
    meetValidationFields: function meetValidationFields() {
      if (this.activecategory == "3") {
        if (this.validation.lotsize && this.validation.scrip && this.validation.status && this.validation.stoploss && this.validation.entryprice && this.validation.target1 && this.validation.target2) {
          return true;
        } else {
          return false;
        }
      } else {
        if (this.validation.scrip && this.validation.status && this.validation.stoploss && this.validation.entryprice && this.validation.target1 && this.validation.target2) {
          return true;
        } else {
          return false;
        }
      }
    }
  },
  computed: {
    routesubmenu: function routesubmenu() {
      return this.$route.params.submenu;
    },
    dateSelectedCategory: function dateSelectedCategory() {
      var _this2 = this;

      var filteredvalues = this.categories.filter(function (abc) {
        return abc.id == _this2.activecategory;
      });

      if (filteredvalues.length > 0) {
        return filteredvalues[0].aname;
      } else {
        return "";
      }
    },
    dateSelectedCall: function dateSelectedCall() {
      var _this3 = this;

      var filteredvalues = this.calltypes.filter(function (abc) {
        return abc.id == _this3.activecalltype;
      });

      if (filteredvalues.length > 0) {
        return filteredvalues[0].aname;
      } else {
        return "";
      }
    },
    dataSelectedFuture: function dataSelectedFuture() {
      var _this4 = this;

      var filteredvalues = this.futuressubcats.filter(function (abc) {
        return abc.id == _this4.activefuturecat;
      });

      if (filteredvalues.length > 0) {
        return filteredvalues[0].aname;
      } else {
        return "";
      }
    },
    dataSubTabName: function dataSubTabName() {
      if (this.activecategory == 1) {
        return this.dataSelectedIntraday;
      } else if (this.activecategory == 3) {
        return this.dataSelectedFuture;
      } else {
        return "";
      }
    },
    dataSelectedIntraday: function dataSelectedIntraday() {
      var _this5 = this;

      var filteredvalues = this.intradaysubcats.filter(function (abc) {
        return abc.id == _this5.activeintraday;
      });

      if (filteredvalues.length > 0) {
        return filteredvalues[0].aname;
      } else {
        return "";
      }
    },
    dataRecommendationdate: {
      get: function get() {
        return this.recommendationdate;
      },
      set: function set(value) {
        this.recommendationdate = value;
      }
    },
    dateTarget1: {
      get: function get() {
        return this.target1;
      },
      set: function set(value) {
        this.target1 = value;
      }
    },
    dateTarget2: {
      get: function get() {
        return this.target2;
      },
      set: function set(value) {
        this.target2 = value;
      }
    },
    dataStoploss: {
      get: function get() {
        return this.stoploss;
      },
      set: function set(value) {
        this.stoploss = value;
      }
    },
    dataLotSize: {
      get: function get() {
        return this.lotsize;
      },
      set: function set(value) {
        this.lotsize = value;
      }
    },
    dataEntryPrice: {
      get: function get() {
        return this.entryprice;
      },
      set: function set(value) {
        this.entryprice = value;
      }
    },
    dataScrip: {
      get: function get() {
        return this.scrip;
      },
      set: function set(value) {
        this.scrip = value;
      }
    },
    dataStatus: {
      get: function get() {
        return this.status;
      },
      set: function set(value) {
        this.status = value;
      }
    }
  }
});

/***/ }),

/***/ "./node_modules/css-loader/dist/cjs.js??clonedRuleSet-9[0].rules[0].use[1]!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9[0].rules[0].use[2]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/dashboard/stockrecommendationcomponents/createstockrecommendation.vue?vue&type=style&index=0&id=ea55de40&scoped=true&lang=css&":
/*!*********************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/css-loader/dist/cjs.js??clonedRuleSet-9[0].rules[0].use[1]!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9[0].rules[0].use[2]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/dashboard/stockrecommendationcomponents/createstockrecommendation.vue?vue&type=style&index=0&id=ea55de40&scoped=true&lang=css& ***!
  \*********************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../../../node_modules/css-loader/dist/runtime/api.js */ "./node_modules/css-loader/dist/runtime/api.js");
/* harmony import */ var _node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_0__);
// Imports

var ___CSS_LOADER_EXPORT___ = _node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_0___default()(function(i){return i[1]});
// Module
___CSS_LOADER_EXPORT___.push([module.id, "\n.v-text-field--outlined[data-v-ea55de40] fieldset {\r\n  border-color: #000;\n}\n.stock-wrapper[data-v-ea55de40] {\r\n  font-family: \"Poppins\", sans-serif;\r\n\r\n  width: 1100px;\r\n  height: auto;\r\n  min-height: 650px;\n}\n.submit_btn_style1[data-v-ea55de40] {\r\n  width: 250px;\r\n  padding: 6px;\r\n  text-align: center;\r\n  font-size: 21px;\r\n  margin-left: auto;\r\n  margin-right: auto;\r\n\r\n  background: linear-gradient(\r\n    268.29deg,\r\n    #3a0cbd 5.98%,\r\n    rgba(150, 30, 169, 0.7) 100%\r\n  );\r\n  color: white;\r\n  border: 1px solid #000000;\r\n  border-radius: 30px;\r\n  cursor: pointer;\n}\n.submit_btn_disabled[data-v-ea55de40] {\r\n  width: 250px;\r\n  padding: 6px;\r\n  text-align: center;\r\n  font-size: 21px;\r\n\r\n  margin-left: auto;\r\n  margin-right: auto;\r\n\r\n  background: linear-gradient(\r\n    268.29deg,\r\n    #3a0cbd 5.98%,\r\n    rgba(150, 30, 169, 0.7) 100%\r\n  );\r\n  color: white;\r\n  border: 1px solid #000000;\r\n\r\n  border-radius: 30px;\r\n  cursor: not-allowed;\r\n  opacity: 0.6;\n}\n.label_style1[data-v-ea55de40] {\r\n  font-style: normal;\r\n  font-weight: 500;\r\n  font-size: 15px;\r\n  line-height: 20px;\r\n\r\n  color: #47ad63;\n}\n.selection_buttons_default[data-v-ea55de40] {\r\n  width: 241px;\r\n  font-size: 15px;\r\n  padding: 4px;\r\n  box-sizing: border-box;\r\n  border-radius: 20px;\r\n  font-weight: 600;\n}\n.selection_buttons_active[data-v-ea55de40] {\r\n  background: #47ad63;\r\n  border: 1px solid #47ad63;\r\n  color: #fff;\r\n  background: linear-gradient(\r\n    268.57deg,\r\n    #55715d 5.26%,\r\n    rgba(89, 69, 73, 0.5) 100%\r\n  );\n}\n.selection_buttons_inactive[data-v-ea55de40] {\r\n  background: #fff;\r\n  border: 1px solid #47ad63;\r\n  color: #000;\n}\n.textboxwrapper_style1[data-v-ea55de40] {\r\n  width: 250px;\r\n  height: auto;\r\n  border: 1px solid #47ad63;\r\n  box-sizing: border-box;\n}\n.textbox_style1[data-v-ea55de40] {\r\n  padding: 5px;\r\n\r\n  padding-left: 10px;\r\n  padding-right: 10px;\r\n  width: 100%;\r\n  height: 100%;\r\n  color: #000;\r\n  font-size: 18px;\r\n  font-weight: 600;\r\n\r\n  box-sizing: border-box;\n}\n.textbox_style1[data-v-ea55de40] {\r\n  outline: 0;\n}\n.textbox_style1[data-v-ea55de40]::focus {\r\n  outline: 0;\n}\n.textboxwrapper_style2[data-v-ea55de40] {\r\n  width: 200px;\r\n  border: 1px solid #47ad63;\r\n  box-sizing: border-box;\n}\n.textbox_style2[data-v-ea55de40] {\r\n  padding: 5px;\r\n\r\n  padding-left: 10px;\r\n  padding-right: 10px;\r\n  width: 100%;\r\n  height: 100%;\r\n  color: #000;\r\n  font-size: 18px;\r\n\r\n  box-sizing: border-box;\n}\n.textbox_style2[data-v-ea55de40] {\r\n  outline: 0;\n}\n.textbox_style2[data-v-ea55de40]::focus {\r\n  outline: 0;\n}\n.overflay_effect[data-v-ea55de40] {\r\n  background-color: rgba(255, 255, 255, 0.7);\n}\n.overflay_full[data-v-ea55de40] {\r\n  width: 100vw;\r\n  height: 100vh;\r\n  position: fixed;\r\n  z-index: 1000;\r\n  top: 0;\r\n  left: 0;\n}\n.overflay_effect_2[data-v-ea55de40] {\r\n  background-color: rgba(255, 255, 255, 1);\n}\n.loading_text[data-v-ea55de40] {\r\n  font-size: 35px;\r\n  color: #4f43af;\r\n  font-weight: 700;\n}\n.success_imgwrap[data-v-ea55de40] {\r\n  text-align: center;\n}\n.success_text[data-v-ea55de40] {\r\n  text-align: center;\r\n\r\n  font-size: 30px;\r\n  color: #3c64ee;\n}\n.text_field_medium[data-v-ea55de40] {\r\n  width: 250px;\n}\r\n", ""]);
// Exports
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (___CSS_LOADER_EXPORT___);


/***/ }),

/***/ "./node_modules/style-loader/dist/cjs.js!./node_modules/css-loader/dist/cjs.js??clonedRuleSet-9[0].rules[0].use[1]!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9[0].rules[0].use[2]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/dashboard/stockrecommendationcomponents/createstockrecommendation.vue?vue&type=style&index=0&id=ea55de40&scoped=true&lang=css&":
/*!*************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/style-loader/dist/cjs.js!./node_modules/css-loader/dist/cjs.js??clonedRuleSet-9[0].rules[0].use[1]!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9[0].rules[0].use[2]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/dashboard/stockrecommendationcomponents/createstockrecommendation.vue?vue&type=style&index=0&id=ea55de40&scoped=true&lang=css& ***!
  \*************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! !../../../../node_modules/style-loader/dist/runtime/injectStylesIntoStyleTag.js */ "./node_modules/style-loader/dist/runtime/injectStylesIntoStyleTag.js");
/* harmony import */ var _node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _node_modules_css_loader_dist_cjs_js_clonedRuleSet_9_0_rules_0_use_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_9_0_rules_0_use_2_node_modules_vue_loader_lib_index_js_vue_loader_options_createstockrecommendation_vue_vue_type_style_index_0_id_ea55de40_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! !!../../../../node_modules/css-loader/dist/cjs.js??clonedRuleSet-9[0].rules[0].use[1]!../../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9[0].rules[0].use[2]!../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./createstockrecommendation.vue?vue&type=style&index=0&id=ea55de40&scoped=true&lang=css& */ "./node_modules/css-loader/dist/cjs.js??clonedRuleSet-9[0].rules[0].use[1]!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9[0].rules[0].use[2]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/dashboard/stockrecommendationcomponents/createstockrecommendation.vue?vue&type=style&index=0&id=ea55de40&scoped=true&lang=css&");

            

var options = {};

options.insert = "head";
options.singleton = false;

var update = _node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0___default()(_node_modules_css_loader_dist_cjs_js_clonedRuleSet_9_0_rules_0_use_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_9_0_rules_0_use_2_node_modules_vue_loader_lib_index_js_vue_loader_options_createstockrecommendation_vue_vue_type_style_index_0_id_ea55de40_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_1__["default"], options);



/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_node_modules_css_loader_dist_cjs_js_clonedRuleSet_9_0_rules_0_use_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_9_0_rules_0_use_2_node_modules_vue_loader_lib_index_js_vue_loader_options_createstockrecommendation_vue_vue_type_style_index_0_id_ea55de40_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_1__["default"].locals || {});

/***/ }),

/***/ "./resources/js/dashboard/stockrecommendationcomponents/createstockrecommendation.vue":
/*!********************************************************************************************!*\
  !*** ./resources/js/dashboard/stockrecommendationcomponents/createstockrecommendation.vue ***!
  \********************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _createstockrecommendation_vue_vue_type_template_id_ea55de40_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./createstockrecommendation.vue?vue&type=template&id=ea55de40&scoped=true& */ "./resources/js/dashboard/stockrecommendationcomponents/createstockrecommendation.vue?vue&type=template&id=ea55de40&scoped=true&");
/* harmony import */ var _createstockrecommendation_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./createstockrecommendation.vue?vue&type=script&lang=js& */ "./resources/js/dashboard/stockrecommendationcomponents/createstockrecommendation.vue?vue&type=script&lang=js&");
/* harmony import */ var _createstockrecommendation_vue_vue_type_style_index_0_id_ea55de40_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./createstockrecommendation.vue?vue&type=style&index=0&id=ea55de40&scoped=true&lang=css& */ "./resources/js/dashboard/stockrecommendationcomponents/createstockrecommendation.vue?vue&type=style&index=0&id=ea55de40&scoped=true&lang=css&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! !../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");



;


/* normalize component */

var component = (0,_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__["default"])(
  _createstockrecommendation_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _createstockrecommendation_vue_vue_type_template_id_ea55de40_scoped_true___WEBPACK_IMPORTED_MODULE_0__.render,
  _createstockrecommendation_vue_vue_type_template_id_ea55de40_scoped_true___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns,
  false,
  null,
  "ea55de40",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/dashboard/stockrecommendationcomponents/createstockrecommendation.vue"
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (component.exports);

/***/ }),

/***/ "./resources/js/dashboard/stockrecommendationcomponents/createstockrecommendation.vue?vue&type=script&lang=js&":
/*!*********************************************************************************************************************!*\
  !*** ./resources/js/dashboard/stockrecommendationcomponents/createstockrecommendation.vue?vue&type=script&lang=js& ***!
  \*********************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_0_rules_0_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_createstockrecommendation_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./createstockrecommendation.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/dashboard/stockrecommendationcomponents/createstockrecommendation.vue?vue&type=script&lang=js&");
 /* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_node_modules_babel_loader_lib_index_js_clonedRuleSet_5_0_rules_0_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_createstockrecommendation_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/dashboard/stockrecommendationcomponents/createstockrecommendation.vue?vue&type=style&index=0&id=ea55de40&scoped=true&lang=css&":
/*!*****************************************************************************************************************************************************!*\
  !*** ./resources/js/dashboard/stockrecommendationcomponents/createstockrecommendation.vue?vue&type=style&index=0&id=ea55de40&scoped=true&lang=css& ***!
  \*****************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_style_loader_dist_cjs_js_node_modules_css_loader_dist_cjs_js_clonedRuleSet_9_0_rules_0_use_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_9_0_rules_0_use_2_node_modules_vue_loader_lib_index_js_vue_loader_options_createstockrecommendation_vue_vue_type_style_index_0_id_ea55de40_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/style-loader/dist/cjs.js!../../../../node_modules/css-loader/dist/cjs.js??clonedRuleSet-9[0].rules[0].use[1]!../../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9[0].rules[0].use[2]!../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./createstockrecommendation.vue?vue&type=style&index=0&id=ea55de40&scoped=true&lang=css& */ "./node_modules/style-loader/dist/cjs.js!./node_modules/css-loader/dist/cjs.js??clonedRuleSet-9[0].rules[0].use[1]!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9[0].rules[0].use[2]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/dashboard/stockrecommendationcomponents/createstockrecommendation.vue?vue&type=style&index=0&id=ea55de40&scoped=true&lang=css&");


/***/ }),

/***/ "./resources/js/dashboard/stockrecommendationcomponents/createstockrecommendation.vue?vue&type=template&id=ea55de40&scoped=true&":
/*!***************************************************************************************************************************************!*\
  !*** ./resources/js/dashboard/stockrecommendationcomponents/createstockrecommendation.vue?vue&type=template&id=ea55de40&scoped=true& ***!
  \***************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* reexport safe */ _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_createstockrecommendation_vue_vue_type_template_id_ea55de40_scoped_true___WEBPACK_IMPORTED_MODULE_0__.render),
/* harmony export */   "staticRenderFns": () => (/* reexport safe */ _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_createstockrecommendation_vue_vue_type_template_id_ea55de40_scoped_true___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns)
/* harmony export */ });
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_createstockrecommendation_vue_vue_type_template_id_ea55de40_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./createstockrecommendation.vue?vue&type=template&id=ea55de40&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/dashboard/stockrecommendationcomponents/createstockrecommendation.vue?vue&type=template&id=ea55de40&scoped=true&");


/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/dashboard/stockrecommendationcomponents/createstockrecommendation.vue?vue&type=template&id=ea55de40&scoped=true&":
/*!******************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/dashboard/stockrecommendationcomponents/createstockrecommendation.vue?vue&type=template&id=ea55de40&scoped=true& ***!
  \******************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* binding */ render),
/* harmony export */   "staticRenderFns": () => (/* binding */ staticRenderFns)
/* harmony export */ });
var render = function () {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "section",
    {
      staticClass: "d-flex justify-center align-center",
      staticStyle: { width: "100%", height: "100%" },
    },
    [
      _c(
        "main",
        { staticClass: "stock-wrapper" },
        [
          _c("div", { staticClass: "label_style1 mt-4" }, [
            _vm._v("Select Call Type:"),
          ]),
          _vm._v(" "),
          _c("div", { staticClass: "mt-4" }, [
            _c(
              "div",
              { staticClass: "d-flex" },
              _vm._l(_vm.calltypes, function (calltype, index) {
                return _c(
                  "div",
                  {
                    key: index,
                    staticClass: "selection_buttons_default mr-16",
                    class: _vm.selectionClassDynamic("call", calltype),
                    on: {
                      click: function ($event) {
                        return _vm.activationGeneral("call", calltype)
                      },
                    },
                  },
                  [
                    _c(
                      "div",
                      { staticClass: "d-flex justify-center align-center" },
                      [_c("span", [_vm._v(_vm._s(calltype.name) + " ")])]
                    ),
                  ]
                )
              }),
              0
            ),
          ]),
          _vm._v(" "),
          _c("v-divider", { staticClass: "mt-4 mb-2" }),
          _vm._v(" "),
          _c("div", { staticClass: "label_style1" }, [
            _vm._v("Select Category:"),
          ]),
          _vm._v(" "),
          _c("div", { staticClass: "mt-4" }, [
            _c(
              "div",
              { staticClass: "d-flex" },
              _vm._l(_vm.categories, function (category, index) {
                return _c(
                  "div",
                  {
                    key: index,
                    staticClass: "selection_buttons_default mr-16",
                    class: _vm.selectionClassDynamic("category", category),
                    on: {
                      click: function ($event) {
                        return _vm.activationGeneral("category", category)
                      },
                    },
                  },
                  [
                    _c(
                      "div",
                      { staticClass: "d-flex justify-center align-center" },
                      [_c("span", [_vm._v(_vm._s(category.name) + " ")])]
                    ),
                  ]
                )
              }),
              0
            ),
          ]),
          _vm._v(" "),
          _vm.togglecheckFutureSubCats()
            ? _c("v-divider", { staticClass: "mt-4 mb-2" })
            : _vm._e(),
          _vm._v(" "),
          _vm.togglecheckFutureSubCats()
            ? _c("section", [
                _c("div", { staticClass: "label_style1" }, [
                  _vm._v("Select Subcategory:"),
                ]),
                _vm._v(" "),
                _c("div", { staticClass: "mt-4" }, [
                  _c(
                    "div",
                    { staticClass: "d-flex" },
                    _vm._l(_vm.futuressubcats, function (futurecat, index) {
                      return _c(
                        "div",
                        {
                          key: index,
                          staticClass: "selection_buttons_default mr-16",
                          class: _vm.selectionClassDynamic(
                            "futurecat",
                            futurecat
                          ),
                          on: {
                            click: function ($event) {
                              return _vm.activationGeneral(
                                "futurecat",
                                futurecat
                              )
                            },
                          },
                        },
                        [
                          _c(
                            "div",
                            {
                              staticClass: "d-flex justify-center align-center",
                            },
                            [_c("span", [_vm._v(_vm._s(futurecat.name) + " ")])]
                          ),
                        ]
                      )
                    }),
                    0
                  ),
                ]),
              ])
            : _vm._e(),
          _vm._v(" "),
          _vm.togglecheckIntradaySubCats()
            ? _c("v-divider", { staticClass: "mt-4 mb-2" })
            : _vm._e(),
          _vm._v(" "),
          _vm.togglecheckIntradaySubCats()
            ? _c("section", [
                _c("div", { staticClass: "label_style1" }, [
                  _vm._v("Select Subcategory"),
                ]),
                _vm._v(" "),
                _c("div", { staticClass: "mt-4" }, [
                  _c(
                    "div",
                    { staticClass: "d-flex" },
                    _vm._l(_vm.intradaysubcats, function (intradaycat, index) {
                      return _c(
                        "div",
                        {
                          key: index,
                          staticClass: "selection_buttons_default mr-16",
                          class: _vm.selectionClassDynamic(
                            "intradaycat",
                            intradaycat
                          ),
                          on: {
                            click: function ($event) {
                              return _vm.activationGeneral(
                                "intradaycat",
                                intradaycat
                              )
                            },
                          },
                        },
                        [
                          _c(
                            "div",
                            {
                              staticClass: "d-flex justify-center align-center",
                            },
                            [
                              _c("span", [
                                _vm._v(_vm._s(intradaycat.name) + " "),
                              ]),
                            ]
                          ),
                        ]
                      )
                    }),
                    0
                  ),
                ]),
              ])
            : _vm._e(),
          _vm._v(" "),
          _c("v-divider", { staticClass: "mt-4 mb-2" }),
          _vm._v(" "),
          _c("section", [
            _c("div", { staticClass: "d-flex" }, [
              _c("div", { staticClass: "text_field_medium mr-5" }, [
                _c(
                  "div",
                  {},
                  [
                    _c("v-text-field", {
                      attrs: { outlined: "", dense: "", color: "black" },
                      scopedSlots: _vm._u([
                        {
                          key: "label",
                          fn: function () {
                            return [
                              _c("span", { staticStyle: { color: "black" } }, [
                                _vm._v(" ENTER SCRIP NAME"),
                              ]),
                            ]
                          },
                          proxy: true,
                        },
                      ]),
                      model: {
                        value: _vm.dataScrip,
                        callback: function ($$v) {
                          _vm.dataScrip = $$v
                        },
                        expression: "dataScrip",
                      },
                    }),
                  ],
                  1
                ),
              ]),
              _vm._v(" "),
              _c("div", { staticClass: "text_field_medium mr-5" }, [
                _c(
                  "div",
                  {},
                  [
                    _c("v-select", {
                      attrs: {
                        items: _vm.statuslist,
                        "item-text": function (item) {
                          return item.displayname
                        },
                        "item-value": function (item) {
                          return item.name
                        },
                        outlined: "",
                        dense: "",
                      },
                      scopedSlots: _vm._u([
                        {
                          key: "label",
                          fn: function () {
                            return [
                              _c("span", { staticClass: "input__label" }, [
                                _vm._v("Status "),
                              ]),
                            ]
                          },
                          proxy: true,
                        },
                      ]),
                      model: {
                        value: _vm.dataStatus,
                        callback: function ($$v) {
                          _vm.dataStatus = $$v
                        },
                        expression: "dataStatus",
                      },
                    }),
                  ],
                  1
                ),
              ]),
              _vm._v(" "),
              _c("div", { staticClass: "text_field_medium mr-5" }, [
                _c(
                  "div",
                  {},
                  [
                    _c("v-text-field", {
                      attrs: {
                        outlined: "",
                        dense: "",
                        color: "black",
                        type: "date",
                      },
                      scopedSlots: _vm._u([
                        {
                          key: "label",
                          fn: function () {
                            return [
                              _c("span", { staticStyle: { color: "black" } }, [
                                _vm._v(" ENTER DATE"),
                              ]),
                            ]
                          },
                          proxy: true,
                        },
                      ]),
                      model: {
                        value: _vm.dataRecommendationdate,
                        callback: function ($$v) {
                          _vm.dataRecommendationdate = $$v
                        },
                        expression: "dataRecommendationdate",
                      },
                    }),
                  ],
                  1
                ),
              ]),
            ]),
          ]),
          _vm._v(" "),
          _c("section", [
            _c("div", { staticClass: "d-flex" }, [
              _c("div", { staticClass: "mr-5" }, [
                _c(
                  "div",
                  {},
                  [
                    _c("v-text-field", {
                      attrs: { dense: "", color: "black" },
                      scopedSlots: _vm._u([
                        {
                          key: "label",
                          fn: function () {
                            return [
                              _c("span", { staticStyle: { color: "black" } }, [
                                _vm._v(" ENTRY PRICE"),
                              ]),
                            ]
                          },
                          proxy: true,
                        },
                      ]),
                      model: {
                        value: _vm.dataEntryPrice,
                        callback: function ($$v) {
                          _vm.dataEntryPrice = $$v
                        },
                        expression: "dataEntryPrice",
                      },
                    }),
                  ],
                  1
                ),
              ]),
              _vm._v(" "),
              _c("div", { staticClass: "mr-5" }, [
                _c(
                  "div",
                  {},
                  [
                    _c("v-text-field", {
                      attrs: { dense: "", color: "black" },
                      scopedSlots: _vm._u([
                        {
                          key: "label",
                          fn: function () {
                            return [
                              _c("span", { staticStyle: { color: "black" } }, [
                                _vm._v(" ENTER TARGET 1"),
                              ]),
                            ]
                          },
                          proxy: true,
                        },
                      ]),
                      model: {
                        value: _vm.dateTarget1,
                        callback: function ($$v) {
                          _vm.dateTarget1 = $$v
                        },
                        expression: "dateTarget1",
                      },
                    }),
                  ],
                  1
                ),
              ]),
              _vm._v(" "),
              _c("div", { staticClass: "mr-5" }, [
                _c(
                  "div",
                  {},
                  [
                    _c("v-text-field", {
                      attrs: { dense: "", color: "black" },
                      scopedSlots: _vm._u([
                        {
                          key: "label",
                          fn: function () {
                            return [
                              _c("span", { staticStyle: { color: "black" } }, [
                                _vm._v(" ENTER TARGET 2"),
                              ]),
                            ]
                          },
                          proxy: true,
                        },
                      ]),
                      model: {
                        value: _vm.dateTarget2,
                        callback: function ($$v) {
                          _vm.dateTarget2 = $$v
                        },
                        expression: "dateTarget2",
                      },
                    }),
                  ],
                  1
                ),
              ]),
              _vm._v(" "),
              _vm.togglecheckLotsize()
                ? _c("div", { staticClass: "mr-5" }, [
                    _c(
                      "div",
                      {},
                      [
                        _c("v-text-field", {
                          attrs: { dense: "", color: "black" },
                          scopedSlots: _vm._u(
                            [
                              {
                                key: "label",
                                fn: function () {
                                  return [
                                    _c(
                                      "span",
                                      { staticStyle: { color: "black" } },
                                      [_vm._v(" LOT SIZE")]
                                    ),
                                  ]
                                },
                                proxy: true,
                              },
                            ],
                            null,
                            false,
                            3513844843
                          ),
                          model: {
                            value: _vm.dataLotSize,
                            callback: function ($$v) {
                              _vm.dataLotSize = $$v
                            },
                            expression: "dataLotSize",
                          },
                        }),
                      ],
                      1
                    ),
                  ])
                : _vm._e(),
              _vm._v(" "),
              _c("div", { staticClass: "mr-5" }, [
                _c(
                  "div",
                  {},
                  [
                    _c("v-text-field", {
                      attrs: { dense: "", color: "black" },
                      scopedSlots: _vm._u([
                        {
                          key: "label",
                          fn: function () {
                            return [
                              _c("span", { staticStyle: { color: "black" } }, [
                                _vm._v(" STOP LOSS"),
                              ]),
                            ]
                          },
                          proxy: true,
                        },
                      ]),
                      model: {
                        value: _vm.dataStoploss,
                        callback: function ($$v) {
                          _vm.dataStoploss = $$v
                        },
                        expression: "dataStoploss",
                      },
                    }),
                  ],
                  1
                ),
              ]),
            ]),
          ]),
          _vm._v(" "),
          _c("v-divider", { staticClass: "mt-4 mb-2" }),
          _vm._v(" "),
          _vm.finalValidation()
            ? _c(
                "div",
                {
                  staticClass: "mt-5 submit_btn_style1",
                  on: {
                    click: function ($event) {
                      return _vm.createRecommendation()
                    },
                  },
                },
                [_vm._v("\n      CREATE\n    ")]
              )
            : _vm._e(),
          _vm._v(" "),
          !_vm.finalValidation()
            ? _c("div", { staticClass: "mt-5 submit_btn_disabled" }, [
                _vm._v("\n      CREATE\n    "),
              ])
            : _vm._e(),
          _vm._v(" "),
          _c("div", [
            _vm._v(
              "Meet validation : " + _vm._s(_vm.meetValidationSelectedFields())
            ),
          ]),
          _vm._v(" "),
          _c("div"),
        ],
        1
      ),
      _vm._v(" "),
      _vm.createrequest
        ? _c(
            "div",
            {
              staticClass:
                "overflay_full overflay_effect d-flex justify-center align-center",
            },
            [_vm._m(0)]
          )
        : _vm._e(),
      _vm._v(" "),
      _vm.successrequest
        ? _c(
            "div",
            {
              staticClass:
                "overflay_full overflay_effect_2 d-flex justify-center align-center",
            },
            [_vm._m(1)]
          )
        : _vm._e(),
    ]
  )
}
var staticRenderFns = [
  function () {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "d-flex align-center" }, [
      _c("div", { staticClass: "mr-4" }, [
        _c("span", { staticClass: "loading_text" }, [_vm._v("CREATING")]),
      ]),
      _vm._v(" "),
      _c("div", [
        _c("img", { attrs: { src: "/images/Ellipsis_loader2.gif" } }),
      ]),
    ])
  },
  function () {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", [
      _c("div", { staticClass: "success_imgwrap" }, [
        _c("img", { attrs: { src: "/images/success_check.png" } }),
      ]),
      _vm._v(" "),
      _c("div", { staticClass: "mt-6 success_text" }, [
        _vm._v("SUCCESSFULLY CREATED"),
      ]),
    ])
  },
]
render._withStripped = true



/***/ })

}]);