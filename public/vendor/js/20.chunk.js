(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[20],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/modules/views/order/order/index.vue?vue&type=script&lang=js&":
/*!*******************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/modules/views/order/order/index.vue?vue&type=script&lang=js& ***!
  \*******************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _components_content_index__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../../components/content/index */ "./resources/js/modules/components/content/index.vue");
/* harmony import */ var _components_content_search__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../../components/content/search */ "./resources/js/modules/components/content/search.vue");
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
//
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
    IContent: _components_content_index__WEBPACK_IMPORTED_MODULE_0__["default"],
    ISearch: _components_content_search__WEBPACK_IMPORTED_MODULE_1__["default"],
    ITable: _components_content_table__WEBPACK_IMPORTED_MODULE_2__["default"]
  },
  data: function data() {
    return {
      loading: false,
      search: {},
      table: {
        columns: [{
          title: '商品',
          type: 'expand',
          width: 60,
          render: function render(h, params) {
            return h('div', 'aaa');
          }
        }, {
          title: '订单编号',
          key: 'code',
          minWidth: 150
        }, {
          title: '用户',
          slot: 'member',
          minWidth: 150
        }, {
          title: '订单状态',
          slot: 'status',
          width: 100
        }, {
          title: '快递信息',
          slot: 'express',
          minWidth: 150
        }, {
          title: '商品数量',
          key: 'count',
          width: 100
        }, {
          title: '订单总价',
          key: 'product_total',
          width: 100
        }, {
          title: '操作',
          key: 'action',
          width: 150
        }]
      }
    };
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/modules/views/order/order/index.vue?vue&type=template&id=24028bce&scoped=true&":
/*!***********************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/modules/views/order/order/index.vue?vue&type=template&id=24028bce&scoped=true& ***!
  \***********************************************************************************************************************************************************************************************************************************/
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
    { attrs: { "spin-show": _vm.loading } },
    [
      _c("i-search", {
        model: {
          value: _vm.search,
          callback: function($$v) {
            _vm.search = $$v
          },
          expression: "search"
        }
      }),
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
                key: "status",
                fn: function(ref) {
                  var row = ref.row
                  var index = ref.index
                  return [
                    row.status === "unpaid"
                      ? _c("span", [_vm._v("待支付")])
                      : _vm._e(),
                    _vm._v(" "),
                    row.status === "paid"
                      ? _c("span", [_vm._v("待发货")])
                      : _vm._e(),
                    _vm._v(" "),
                    row.status === "shipped"
                      ? _c("span", [_vm._v("已发货")])
                      : _vm._e(),
                    _vm._v(" "),
                    row.status === "sign"
                      ? _c("span", [_vm._v("已签收")])
                      : _vm._e(),
                    _vm._v(" "),
                    row.status === "apply_return"
                      ? _c("span", [_vm._v("申请退货中")])
                      : _vm._e(),
                    _vm._v(" "),
                    row.status === "returning"
                      ? _c("span", [_vm._v("退货中")])
                      : _vm._e(),
                    _vm._v(" "),
                    row.status === "returned"
                      ? _c("span", [_vm._v("退货完成")])
                      : _vm._e(),
                    _vm._v(" "),
                    row.status === "cancel"
                      ? _c("span", [_vm._v("取消")])
                      : _vm._e()
                  ]
                }
              },
              {
                key: "express",
                fn: function(ref) {
                  var row = ref.row
                  return [
                    _c("div", [
                      _c("div", [_vm._v(_vm._s(row.express.name))]),
                      _vm._v(" "),
                      _c("div", [_vm._v(_vm._s(row.express_no))])
                    ])
                  ]
                }
              },
              {
                key: "member",
                fn: function(ref) {
                  var row = ref.row
                  return [_c("span", [_vm._v(_vm._s(row.member.name))])]
                }
              },
              {
                key: "action",
                fn: function(ref) {
                  var row = ref.row
                  return [_c("span", [_vm._v("操作")])]
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

/***/ "./resources/js/modules/mixins/content-list-page.js":
/*!**********************************************************!*\
  !*** ./resources/js/modules/mixins/content-list-page.js ***!
  \**********************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _from_submit__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./from-submit */ "./resources/js/modules/mixins/from-submit.js");

/* harmony default export */ __webpack_exports__["default"] = ({
  mixins: [_from_submit__WEBPACK_IMPORTED_MODULE_0__["default"]],
  data: function data() {
    return {
      page: {
        current: 1,
        total: 100
      },
      table: {
        columns: [],
        data: []
      },
      component: {
        is: '',
        prop: null
      },
      loading: true
    };
  },
  mounted: function mounted() {
    var _this = this;

    this.$nextTick(function () {
      _this.getLists();
    });
  },
  methods: {
    pageChange: function pageChange(v) {
      this.getLists(v);
    },
    openComponent: function openComponent(is) {
      var prop = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : null;
      this.component.is = is;
      this.component.prop = prop;
    },
    closeComponent: function closeComponent() {
      this.component.is = '';
      this.component.prop = null;
    },
    openRoute: function openRoute(name, query) {
      this.$router.push({
        name: name,
        query: query
      });
    },
    getLists: function getLists() {}
  }
});

/***/ }),

/***/ "./resources/js/modules/mixins/from-submit.js":
/*!****************************************************!*\
  !*** ./resources/js/modules/mixins/from-submit.js ***!
  \****************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony default export */ __webpack_exports__["default"] = ({
  methods: {
    validate: function validate(name) {
      var _this = this;

      return new Promise(function (resolve, reject) {
        _this.$refs[name].validate(function (valid) {
          valid ? resolve() : reject();
        });
      });
    }
  }
});

/***/ }),

/***/ "./resources/js/modules/views/order/order/index.vue":
/*!**********************************************************!*\
  !*** ./resources/js/modules/views/order/order/index.vue ***!
  \**********************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _index_vue_vue_type_template_id_24028bce_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./index.vue?vue&type=template&id=24028bce&scoped=true& */ "./resources/js/modules/views/order/order/index.vue?vue&type=template&id=24028bce&scoped=true&");
/* harmony import */ var _index_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./index.vue?vue&type=script&lang=js& */ "./resources/js/modules/views/order/order/index.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _index_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _index_vue_vue_type_template_id_24028bce_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _index_vue_vue_type_template_id_24028bce_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "24028bce",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/modules/views/order/order/index.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/modules/views/order/order/index.vue?vue&type=script&lang=js&":
/*!***********************************************************************************!*\
  !*** ./resources/js/modules/views/order/order/index.vue?vue&type=script&lang=js& ***!
  \***********************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_index_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../../node_modules/vue-loader/lib??vue-loader-options!./index.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/modules/views/order/order/index.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_index_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/modules/views/order/order/index.vue?vue&type=template&id=24028bce&scoped=true&":
/*!*****************************************************************************************************!*\
  !*** ./resources/js/modules/views/order/order/index.vue?vue&type=template&id=24028bce&scoped=true& ***!
  \*****************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_index_vue_vue_type_template_id_24028bce_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../../node_modules/vue-loader/lib??vue-loader-options!./index.vue?vue&type=template&id=24028bce&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/modules/views/order/order/index.vue?vue&type=template&id=24028bce&scoped=true&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_index_vue_vue_type_template_id_24028bce_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_index_vue_vue_type_template_id_24028bce_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);