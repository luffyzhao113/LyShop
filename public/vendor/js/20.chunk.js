(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[20],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/modules/views/goods/goods/recycle.vue?vue&type=script&lang=js&":
/*!*********************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/modules/views/goods/goods/recycle.vue?vue&type=script&lang=js& ***!
  \*********************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _components_content_index__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../../components/content/index */ "./resources/js/modules/components/content/index.vue");
/* harmony import */ var _mixins_content_list_page__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../../mixins/content-list-page */ "./resources/js/modules/mixins/content-list-page.js");
/* harmony import */ var _components_content_search__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../components/content/search */ "./resources/js/modules/components/content/search.vue");
/* harmony import */ var _components_content_table__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../../components/content/table */ "./resources/js/modules/components/content/table.vue");
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
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
  name: "recycle",
  mixins: [_mixins_content_list_page__WEBPACK_IMPORTED_MODULE_1__["default"]],
  components: {
    IContent: _components_content_index__WEBPACK_IMPORTED_MODULE_0__["default"],
    ITable: _components_content_table__WEBPACK_IMPORTED_MODULE_3__["default"],
    ISearch: _components_content_search__WEBPACK_IMPORTED_MODULE_2__["default"]
  },
  data: function data() {
    return {
      loading: false,
      table: {
        columns: [{
          title: '商品名称',
          key: 'name',
          ellipsis: true,
          tooltip: true,
          minWidth: 150
        }, {
          title: '商品分类',
          slot: 'categories',
          width: 150
        }, {
          title: '价格',
          key: 'price',
          width: 80
        }, {
          title: '库存',
          key: 'stock',
          width: 80
        }, {
          title: '类型',
          slot: 'type',
          width: 80
        }, {
          title: '查看次数',
          key: 'view',
          width: 100
        }, {
          title: '销量',
          key: 'sales',
          width: 80
        }, {
          title: '收藏次数',
          key: 'collect',
          width: 100
        }, {
          title: '状态',
          slot: 'status',
          width: 80
        }, {
          title: '操作',
          slot: 'action',
          width: 150
        }]
      },
      search: {}
    };
  },
  methods: {
    getLists: function getLists() {
      var _this = this;

      var page = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 1;
      this.loading = true;
      this.$http.get("goods/goods/recycle", {
        params: Object.assign({}, this.search, {
          page: page
        })
      }).then(function (data) {
        _this.table.data = data.data;
        _this.page.total = data.total;
        _this.page.current = data.current_page;
      }).finally(function () {
        _this.loading = false;
      });
    },
    recovery: function recovery(row) {
      var _this2 = this;

      this.loading = true;
      this.$http.put("goods/goods/".concat(row.id, "/recycle")).then(function () {
        _this2.getLists();
      }).finally(function () {
        _this2.loading = false;
      });
    },
    remove: function remove(row) {
      var _this3 = this;

      this.loading = true;
      this.$http.delete("goods/goods/".concat(row.id, "/recycle")).then(function () {
        _this3.getLists();
      }).finally(function () {
        _this3.loading = false;
      });
    }
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/modules/views/goods/goods/recycle.vue?vue&type=template&id=173324ac&scoped=true&":
/*!*************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/modules/views/goods/goods/recycle.vue?vue&type=template&id=173324ac&scoped=true& ***!
  \*************************************************************************************************************************************************************************************************************************************/
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
                key: "categories",
                fn: function(ref) {
                  var row = ref.row
                  var index = ref.index
                  return _vm._l(row.categories, function(item, key) {
                    return _c("span", { key: key }, [
                      _vm._v(
                        "\n                    " +
                          _vm._s(item.name) +
                          "\n                "
                      )
                    ])
                  })
                }
              },
              {
                key: "type",
                fn: function(ref) {
                  var row = ref.row
                  var index = ref.index
                  return [
                    row.type === "normal"
                      ? _c("span", [_vm._v("正常")])
                      : _vm._e(),
                    _vm._v(" "),
                    row.type === "group"
                      ? _c("span", [_vm._v("团购")])
                      : _vm._e(),
                    _vm._v(" "),
                    row.type === "seckill"
                      ? _c("span", [_vm._v("秒杀")])
                      : _vm._e()
                  ]
                }
              },
              {
                key: "status",
                fn: function(ref) {
                  var row = ref.row
                  var index = ref.index
                  return [
                    _c("span", [
                      _vm._v(
                        _vm._s(row.status === "grounding" ? "上架" : "下架")
                      )
                    ])
                  ]
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
                      {
                        attrs: { type: "primary", size: "small" },
                        on: {
                          click: function($event) {
                            return _vm.recovery(row)
                          }
                        }
                      },
                      [_vm._v("\n                    恢复\n                ")]
                    ),
                    _vm._v(" "),
                    _c(
                      "Button",
                      {
                        attrs: { type: "primary", size: "small" },
                        on: {
                          click: function($event) {
                            return _vm.remove(row)
                          }
                        }
                      },
                      [_vm._v("\n                    清除\n                ")]
                    )
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

/***/ "./resources/js/modules/views/goods/goods/recycle.vue":
/*!************************************************************!*\
  !*** ./resources/js/modules/views/goods/goods/recycle.vue ***!
  \************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _recycle_vue_vue_type_template_id_173324ac_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./recycle.vue?vue&type=template&id=173324ac&scoped=true& */ "./resources/js/modules/views/goods/goods/recycle.vue?vue&type=template&id=173324ac&scoped=true&");
/* harmony import */ var _recycle_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./recycle.vue?vue&type=script&lang=js& */ "./resources/js/modules/views/goods/goods/recycle.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _recycle_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _recycle_vue_vue_type_template_id_173324ac_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _recycle_vue_vue_type_template_id_173324ac_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "173324ac",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/modules/views/goods/goods/recycle.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/modules/views/goods/goods/recycle.vue?vue&type=script&lang=js&":
/*!*************************************************************************************!*\
  !*** ./resources/js/modules/views/goods/goods/recycle.vue?vue&type=script&lang=js& ***!
  \*************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_recycle_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../../node_modules/vue-loader/lib??vue-loader-options!./recycle.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/modules/views/goods/goods/recycle.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_recycle_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/modules/views/goods/goods/recycle.vue?vue&type=template&id=173324ac&scoped=true&":
/*!*******************************************************************************************************!*\
  !*** ./resources/js/modules/views/goods/goods/recycle.vue?vue&type=template&id=173324ac&scoped=true& ***!
  \*******************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_recycle_vue_vue_type_template_id_173324ac_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../../node_modules/vue-loader/lib??vue-loader-options!./recycle.vue?vue&type=template&id=173324ac&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/modules/views/goods/goods/recycle.vue?vue&type=template&id=173324ac&scoped=true&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_recycle_vue_vue_type_template_id_173324ac_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_recycle_vue_vue_type_template_id_173324ac_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);