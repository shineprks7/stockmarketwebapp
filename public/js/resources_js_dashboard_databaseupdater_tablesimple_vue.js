"use strict";
(self["webpackChunk"] = self["webpackChunk"] || []).push([["resources_js_dashboard_databaseupdater_tablesimple_vue"],{

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/dashboard/databaseupdater/tablesimple.vue?vue&type=script&lang=js&":
/*!*********************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/dashboard/databaseupdater/tablesimple.vue?vue&type=script&lang=js& ***!
  \*********************************************************************************************************************************************************************************************************************************/
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
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  props: {
    inputvalue: [String, Array, Number],
    labelname: String,
    formuid: Number
  },
  data: function data() {
    return {
      editcontent: true,
      thevalue: '',
      width: "1000",
      labname: 'Enter Value Here',
      maxcolumns: 0,
      tabletype: false,
      headerstyle: 'pivot',
      tablerows: [],
      tablecolumnsall: []
    };
  },
  created: function created() {},
  mounted: function mounted() {},
  methods: {
    calculateColumnWidh: function calculateColumnWidh(widthratio) {
      return widthratio + "%";
    },
    bindClassColumn: function bindClassColumn(column) {
      if (column.rowindex == 1) {
        return "header_column " + column["class"];
      } else if (column.index == 1 && this.headerstyle == "pivot") {
        return "header_column " + column["class"];
        ;
      } else {
        return "normal_column " + column["class"];
      }
    },
    getPosition: function getPosition(value) {},
    sendDataToMainForm: function sendDataToMainForm() {
      this.$emit('messageFromText', this.formuid, this.thevalue);
    },
    parseTableTags: function parseTableTags() {
      var executebleelement = document.querySelector('.tabledata_paste');
      var hastable = executebleelement.querySelector('table');
      var hasrows = executebleelement.querySelector('tr');
      this.tablerows = [];

      if (hastable && hasrows) {
        var rows = hastable.querySelectorAll('tr');

        for (var i = 0; i < rows.length; i++) {
          var newobj = new Object();
          var cols = rows[i].querySelectorAll('td');
          newobj.index = i;
          newobj.numofcols = cols.length;

          if (cols.length > this.maxcolumns) {
            this.maxcolumns = cols.length;
          }

          newobj.rowwidth = rows[i].clientWidth;
          newobj.columns = [];
          this.width = rows[i].clientWidth + "px";

          if (i == 0) {
            newobj.header = true;
          }

          if (cols) {
            for (var j = 0; j < cols.length; j++) {
              var childobj = new Object();
              childobj.value = cols[j].innerText;
              childobj.colspan = cols[j].colSpan;
              childobj.index = j + 1;
              childobj.rowindex = i + 1;
              childobj["class"] = 'col_' + (j + 1);

              if (cols[j].colSpan > 1) {
                this.tabletype = true;
              }

              if (j == 0) {
                childobj.header = true;
              }

              this.tablecolumnsall.push(childobj);
              newobj.columns.push(childobj);
            }
          }

          this.tablerows.push(newobj);
        }

        console.log("Table Created Success fully");
        this.editcontent = false;
      } else {
        console.log("Not in Table Format");
      }
    },
    innerHtmlChange: function innerHtmlChange() {
      this.parseTableTags();
    }
  },
  computed: {
    labelNamefromParent: function labelNamefromParent() {
      if (this.labelname) {
        return this.labelname;
      } else {
        return "Enter Value Here";
      }
    },
    dataValue: {
      get: function get() {
        return this.thevalue;
      },
      set: function set(value) {
        this.thevalue = value;
      }
    }
  },
  watch: {
    thevalue: function thevalue(newData, oldData) {
      this.sendDataToMainForm();
    }
  }
});

/***/ }),

/***/ "./node_modules/css-loader/dist/cjs.js??clonedRuleSet-9[0].rules[0].use[1]!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9[0].rules[0].use[2]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/dashboard/databaseupdater/tablesimple.vue?vue&type=style&index=0&id=439f6a54&scoped=true&lang=css&":
/*!*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/css-loader/dist/cjs.js??clonedRuleSet-9[0].rules[0].use[1]!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9[0].rules[0].use[2]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/dashboard/databaseupdater/tablesimple.vue?vue&type=style&index=0&id=439f6a54&scoped=true&lang=css& ***!
  \*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
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
___CSS_LOADER_EXPORT___.push([module.id, "\n.v-text-field--outlined[data-v-439f6a54] fieldset\r\n{\r\n    border-color:#000;\n}\n.tabledata_paste[data-v-439f6a54]\r\n{\r\n    width:800px;\r\n    overflow:scroll;\r\n    font-size:16px;\n}\n.table_flex_row[data-v-439f6a54]\r\n{\r\n    display: flex; flex-flow: row nowrap; margin-top: 10px;\n}\n.table_flex_column[data-v-439f6a54]\r\n{\r\n    display: flex; flex-flow: row nowrap; margin-top: 10px;\n}\n.header_column[data-v-439f6a54]\r\n{\r\n    color:blue;\r\n    padding:5px;\n}\n.normal_column[data-v-439f6a54]\r\n{\r\n    color:#000;\r\n    padding:5px;\n}\n.row_default[data-v-439f6a54]\r\n{ /* IE 10 */\r\nflex: 1;\n}\n.column_default[data-v-439f6a54]\r\n{\n}\n.table_default[data-v-439f6a54] \r\n{\r\n border-collapse: collapse;\r\n border:1px solid black;\n}\n.table_default td[data-v-439f6a54]\r\n{\r\n border:1px solid black;\n}\n.tabledata_paste[data-v-439f6a54] \r\n{\r\n  width:500px;\r\n  height:500px;\r\n  background:#ddd;\r\n  border:0px;\r\n  margin-left:auto;\r\n  margin-right:auto;\n}\r\n\r\n", ""]);
// Exports
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (___CSS_LOADER_EXPORT___);


/***/ }),

/***/ "./node_modules/style-loader/dist/cjs.js!./node_modules/css-loader/dist/cjs.js??clonedRuleSet-9[0].rules[0].use[1]!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9[0].rules[0].use[2]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/dashboard/databaseupdater/tablesimple.vue?vue&type=style&index=0&id=439f6a54&scoped=true&lang=css&":
/*!*********************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/style-loader/dist/cjs.js!./node_modules/css-loader/dist/cjs.js??clonedRuleSet-9[0].rules[0].use[1]!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9[0].rules[0].use[2]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/dashboard/databaseupdater/tablesimple.vue?vue&type=style&index=0&id=439f6a54&scoped=true&lang=css& ***!
  \*********************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! !../../../../node_modules/style-loader/dist/runtime/injectStylesIntoStyleTag.js */ "./node_modules/style-loader/dist/runtime/injectStylesIntoStyleTag.js");
/* harmony import */ var _node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _node_modules_css_loader_dist_cjs_js_clonedRuleSet_9_0_rules_0_use_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_9_0_rules_0_use_2_node_modules_vue_loader_lib_index_js_vue_loader_options_tablesimple_vue_vue_type_style_index_0_id_439f6a54_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! !!../../../../node_modules/css-loader/dist/cjs.js??clonedRuleSet-9[0].rules[0].use[1]!../../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9[0].rules[0].use[2]!../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./tablesimple.vue?vue&type=style&index=0&id=439f6a54&scoped=true&lang=css& */ "./node_modules/css-loader/dist/cjs.js??clonedRuleSet-9[0].rules[0].use[1]!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9[0].rules[0].use[2]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/dashboard/databaseupdater/tablesimple.vue?vue&type=style&index=0&id=439f6a54&scoped=true&lang=css&");

            

var options = {};

options.insert = "head";
options.singleton = false;

var update = _node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0___default()(_node_modules_css_loader_dist_cjs_js_clonedRuleSet_9_0_rules_0_use_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_9_0_rules_0_use_2_node_modules_vue_loader_lib_index_js_vue_loader_options_tablesimple_vue_vue_type_style_index_0_id_439f6a54_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_1__["default"], options);



/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_node_modules_css_loader_dist_cjs_js_clonedRuleSet_9_0_rules_0_use_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_9_0_rules_0_use_2_node_modules_vue_loader_lib_index_js_vue_loader_options_tablesimple_vue_vue_type_style_index_0_id_439f6a54_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_1__["default"].locals || {});

/***/ }),

/***/ "./resources/js/dashboard/databaseupdater/tablesimple.vue":
/*!****************************************************************!*\
  !*** ./resources/js/dashboard/databaseupdater/tablesimple.vue ***!
  \****************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _tablesimple_vue_vue_type_template_id_439f6a54_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./tablesimple.vue?vue&type=template&id=439f6a54&scoped=true& */ "./resources/js/dashboard/databaseupdater/tablesimple.vue?vue&type=template&id=439f6a54&scoped=true&");
/* harmony import */ var _tablesimple_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./tablesimple.vue?vue&type=script&lang=js& */ "./resources/js/dashboard/databaseupdater/tablesimple.vue?vue&type=script&lang=js&");
/* harmony import */ var _tablesimple_vue_vue_type_style_index_0_id_439f6a54_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./tablesimple.vue?vue&type=style&index=0&id=439f6a54&scoped=true&lang=css& */ "./resources/js/dashboard/databaseupdater/tablesimple.vue?vue&type=style&index=0&id=439f6a54&scoped=true&lang=css&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! !../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");



;


/* normalize component */

var component = (0,_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__["default"])(
  _tablesimple_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _tablesimple_vue_vue_type_template_id_439f6a54_scoped_true___WEBPACK_IMPORTED_MODULE_0__.render,
  _tablesimple_vue_vue_type_template_id_439f6a54_scoped_true___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns,
  false,
  null,
  "439f6a54",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/dashboard/databaseupdater/tablesimple.vue"
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (component.exports);

/***/ }),

/***/ "./resources/js/dashboard/databaseupdater/tablesimple.vue?vue&type=script&lang=js&":
/*!*****************************************************************************************!*\
  !*** ./resources/js/dashboard/databaseupdater/tablesimple.vue?vue&type=script&lang=js& ***!
  \*****************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_0_rules_0_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_tablesimple_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./tablesimple.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/dashboard/databaseupdater/tablesimple.vue?vue&type=script&lang=js&");
 /* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_node_modules_babel_loader_lib_index_js_clonedRuleSet_5_0_rules_0_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_tablesimple_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/dashboard/databaseupdater/tablesimple.vue?vue&type=style&index=0&id=439f6a54&scoped=true&lang=css&":
/*!*************************************************************************************************************************!*\
  !*** ./resources/js/dashboard/databaseupdater/tablesimple.vue?vue&type=style&index=0&id=439f6a54&scoped=true&lang=css& ***!
  \*************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_style_loader_dist_cjs_js_node_modules_css_loader_dist_cjs_js_clonedRuleSet_9_0_rules_0_use_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_9_0_rules_0_use_2_node_modules_vue_loader_lib_index_js_vue_loader_options_tablesimple_vue_vue_type_style_index_0_id_439f6a54_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/style-loader/dist/cjs.js!../../../../node_modules/css-loader/dist/cjs.js??clonedRuleSet-9[0].rules[0].use[1]!../../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9[0].rules[0].use[2]!../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./tablesimple.vue?vue&type=style&index=0&id=439f6a54&scoped=true&lang=css& */ "./node_modules/style-loader/dist/cjs.js!./node_modules/css-loader/dist/cjs.js??clonedRuleSet-9[0].rules[0].use[1]!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9[0].rules[0].use[2]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/dashboard/databaseupdater/tablesimple.vue?vue&type=style&index=0&id=439f6a54&scoped=true&lang=css&");


/***/ }),

/***/ "./resources/js/dashboard/databaseupdater/tablesimple.vue?vue&type=template&id=439f6a54&scoped=true&":
/*!***********************************************************************************************************!*\
  !*** ./resources/js/dashboard/databaseupdater/tablesimple.vue?vue&type=template&id=439f6a54&scoped=true& ***!
  \***********************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* reexport safe */ _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_tablesimple_vue_vue_type_template_id_439f6a54_scoped_true___WEBPACK_IMPORTED_MODULE_0__.render),
/* harmony export */   "staticRenderFns": () => (/* reexport safe */ _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_tablesimple_vue_vue_type_template_id_439f6a54_scoped_true___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns)
/* harmony export */ });
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_tablesimple_vue_vue_type_template_id_439f6a54_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./tablesimple.vue?vue&type=template&id=439f6a54&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/dashboard/databaseupdater/tablesimple.vue?vue&type=template&id=439f6a54&scoped=true&");


/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/dashboard/databaseupdater/tablesimple.vue?vue&type=template&id=439f6a54&scoped=true&":
/*!**************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/dashboard/databaseupdater/tablesimple.vue?vue&type=template&id=439f6a54&scoped=true& ***!
  \**************************************************************************************************************************************************************************************************************************************************/
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
  return _c("div", {}, [
    _vm.editcontent
      ? _c("div", {
          staticClass: "tabledata_paste mt-16 mb-16",
          attrs: { contenteditable: _vm.editcontent },
          on: {
            input: function ($event) {
              return _vm.innerHtmlChange($event)
            },
          },
        })
      : _vm._e(),
    _vm._v(" "),
    this.tabletype
      ? _c("div", [
          _c(
            "table",
            { staticClass: "table_default" },
            _vm._l(_vm.tablerows, function (row) {
              return _c(
                "tr",
                _vm._l(row.columns, function (col) {
                  return _c(
                    "td",
                    {
                      class: _vm.bindClassColumn(col),
                      attrs: { colspan: col.colspan },
                    },
                    [
                      _vm._v(
                        "\n          \n                          " +
                          _vm._s(col.value) +
                          "\n              \n\n             "
                      ),
                    ]
                  )
                }),
                0
              )
            }),
            0
          ),
        ])
      : _vm._e(),
    _vm._v(" "),
    !this.tabletype
      ? _c("div", [
          _c(
            "div",
            { staticClass: "d-flex " },
            _vm._l(_vm.maxcolumns, function (theindex) {
              return _c(
                "div",
                { staticClass: "d-flex flex-column row_default" },
                _vm._l(_vm.tablecolumnsall, function (col) {
                  return col.index == theindex
                    ? _c(
                        "div",
                        {
                          staticClass: "column_default",
                          class: _vm.bindClassColumn(col),
                        },
                        [
                          _vm._v(
                            "\n          \n                          " +
                              _vm._s(col.value) +
                              "\n              \n             "
                          ),
                          _c("v-divider", { staticClass: "mt-4 mb-4" }),
                        ],
                        1
                      )
                    : _vm._e()
                }),
                0
              )
            }),
            0
          ),
        ])
      : _vm._e(),
    _vm._v(" "),
    _c(
      "div",
      { staticClass: "mt-16" },
      [
        _c("v-btn", { staticClass: "mr-4", attrs: { color: "blue" } }, [
          _vm._v(" Column Groups "),
        ]),
        _vm._v(" "),
        _c(
          "v-btn",
          {
            staticClass: "mr-4",
            attrs: { color: "red" },
            on: {
              click: function ($event) {
                return _vm.parseTableTags()
              },
            },
          },
          [_vm._v(" Table Rows ")]
        ),
        _vm._v(" "),
        _c("v-btn", { staticClass: "mr-4", attrs: { color: "green" } }, [
          _vm._v(" Table Cells By Row "),
        ]),
      ],
      1
    ),
  ])
}
var staticRenderFns = []
render._withStripped = true



/***/ })

}]);