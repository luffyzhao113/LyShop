(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[12],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/modules/views/setting/spec/index.vue?vue&type=script&lang=js&":
/*!********************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/modules/views/setting/spec/index.vue?vue&type=script&lang=js& ***!
  \********************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _components_content_search__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../../components/content/search */ "./resources/js/modules/components/content/search.vue");
/* harmony import */ var _components_content_index__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../../components/content/index */ "./resources/js/modules/components/content/index.vue");
/* harmony import */ var _components_content_table__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../components/content/table */ "./resources/js/modules/components/content/table.vue");
/* harmony import */ var _mixins_content_list_page__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../../mixins/content-list-page */ "./resources/js/modules/mixins/content-list-page.js");
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//




/* harmony default export */ __webpack_exports__["default"] = ({
  name: "index",
  mixins: [_mixins_content_list_page__WEBPACK_IMPORTED_MODULE_3__["default"]],
  components: {
    ITable: _components_content_table__WEBPACK_IMPORTED_MODULE_2__["default"],
    IContent: _components_content_index__WEBPACK_IMPORTED_MODULE_1__["default"],
    ISearch: _components_content_search__WEBPACK_IMPORTED_MODULE_0__["default"]
  },
  data: function data() {
    return {
      table: {
        columns: [{
          title: '规格名称',
          slot: 'name'
        }, {
          title: '规格排序',
          slot: 'sort'
        }, {
          title: '规格值',
          slot: 'values'
        }, {
          title: '操作',
          slot: 'action'
        }]
      }
    };
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/modules/views/setting/spec/index.vue?vue&type=template&id=0475cae4&scoped=true&":
/*!************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/modules/views/setting/spec/index.vue?vue&type=template&id=0475cae4&scoped=true& ***!
  \************************************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "i-content",
    [
      _c("i-search"),
      _vm._v(" "),
      _c(
        "i-table",
        {
          attrs: { current: _vm.page.current, total: _vm.page.total },
          on: { "on-page-change": _vm.pageChange }
        },
        [
          _c("Table", {
            attrs: { columns: _vm.table.columns, data: _vm.table.data },
            scopedSlots: _vm._u([
              {
                key: "name",
                fn: function(ref) {
                  var row = ref.row
                  var index = ref.index
                  return [_c("span", [_vm._v(_vm._s(row.name))])]
                }
              },
              {
                key: "sort",
                fn: function(ref) {
                  var row = ref.row
                  var index = ref.index
                  return [_c("span", [_vm._v(_vm._s(row.sort))])]
                }
              },
              {
                key: "values",
                fn: function(ref) {
                  var row = ref.row
                  var index = ref.index
                  return [_c("span", [_vm._v(_vm._s(row.values))])]
                }
              },
              {
                key: "action",
                fn: function(ref) {
                  var row = ref.row
                  var index = ref.index
                  return [
                    _c(
                      "Button",
                      { attrs: { type: "warning", size: "small" } },
                      [_vm._v("编辑")]
                    ),
                    _vm._v(" "),
                    _c("Button", { attrs: { type: "error", size: "small" } }, [
                      _vm._v("删除")
                    ])
                  ]
                }
              }
            ])
          })
        ],
        1
      )
    ],
    1
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/js/modules/views/setting/spec/index.vue":
/*!***********************************************************!*\
  !*** ./resources/js/modules/views/setting/spec/index.vue ***!
  \***********************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _index_vue_vue_type_template_id_0475cae4_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./index.vue?vue&type=template&id=0475cae4&scoped=true& */ "./resources/js/modules/views/setting/spec/index.vue?vue&type=template&id=0475cae4&scoped=true&");
/* harmony import */ var _index_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./index.vue?vue&type=script&lang=js& */ "./resources/js/modules/views/setting/spec/index.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _index_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _index_vue_vue_type_template_id_0475cae4_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _index_vue_vue_type_template_id_0475cae4_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "0475cae4",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/modules/views/setting/spec/index.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/modules/views/setting/spec/index.vue?vue&type=script&lang=js&":
/*!************************************************************************************!*\
  !*** ./resources/js/modules/views/setting/spec/index.vue?vue&type=script&lang=js& ***!
  \************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_index_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../../node_modules/vue-loader/lib??vue-loader-options!./index.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/modules/views/setting/spec/index.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_index_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/modules/views/setting/spec/index.vue?vue&type=template&id=0475cae4&scoped=true&":
/*!******************************************************************************************************!*\
  !*** ./resources/js/modules/views/setting/spec/index.vue?vue&type=template&id=0475cae4&scoped=true& ***!
  \******************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_index_vue_vue_type_template_id_0475cae4_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../../node_modules/vue-loader/lib??vue-loader-options!./index.vue?vue&type=template&id=0475cae4&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/modules/views/setting/spec/index.vue?vue&type=template&id=0475cae4&scoped=true&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_index_vue_vue_type_template_id_0475cae4_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_index_vue_vue_type_template_id_0475cae4_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);