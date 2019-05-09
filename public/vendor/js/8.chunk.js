(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[8],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/modules/components/content/search.vue?vue&type=script&lang=js&":
/*!*********************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/modules/components/content/search.vue?vue&type=script&lang=js& ***!
  \*********************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
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
  name: "i-search",
  props: {
    value: {
      type: Object
    },
    title: {
      type: String,
      default: '搜索'
    },
    icon: {
      type: String,
      default: 'ios-search'
    }
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/modules/components/content/table.vue?vue&type=script&lang=js&":
/*!********************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/modules/components/content/table.vue?vue&type=script&lang=js& ***!
  \********************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
//
//
//
//
//
//
//
/* harmony default export */ __webpack_exports__["default"] = ({
  name: "i-table",
  props: {
    current: {
      type: Number
    },
    total: {
      type: Number
    },
    pageSize: {
      type: Number,
      default: 15
    },
    title: {
      type: String,
      default: '列表'
    },
    icon: {
      type: String,
      default: 'ios-list-box'
    }
  },
  methods: {
    change: function change(v) {
      this.$emit('on-page-change', v);
    }
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/modules/views/authorities/user/create.vue?vue&type=script&lang=js&":
/*!*************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/modules/views/authorities/user/create.vue?vue&type=script&lang=js& ***!
  \*************************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _mixins_content_drawer__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../../mixins/content-drawer */ "./resources/js/modules/mixins/content-drawer.js");
/* harmony import */ var _components_content_drawer__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../../components/content/drawer */ "./resources/js/modules/components/content/drawer.vue");
/* harmony import */ var _user__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./user */ "./resources/js/modules/views/authorities/user/user.js");
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
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
  name: "create",
  components: {
    IDrawer: _components_content_drawer__WEBPACK_IMPORTED_MODULE_1__["default"]
  },
  mixins: [_mixins_content_drawer__WEBPACK_IMPORTED_MODULE_0__["default"], _user__WEBPACK_IMPORTED_MODULE_2__["default"]],
  mounted: function mounted() {
    var _this = this;

    this.$http("authorities/user/create").then(function (res) {
      _this.roles.data = res;
    }).finally(function () {
      _this.loading = false;
    });
  },
  methods: {
    submit: function submit(name) {
      var _this2 = this;

      this.validate(name).then(function () {
        _this2.loading = true;

        _this2.$http.post("authorities/user", _this2.data).then(function () {
          _this2.closeDrawer(false);
        }).finally(function () {
          _this2.loading = false;
        });
      }).catch();
    }
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/modules/views/authorities/user/index.vue?vue&type=script&lang=js&":
/*!************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/modules/views/authorities/user/index.vue?vue&type=script&lang=js& ***!
  \************************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _components_content_index__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../../components/content/index */ "./resources/js/modules/components/content/index.vue");
/* harmony import */ var _components_content_search__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../../components/content/search */ "./resources/js/modules/components/content/search.vue");
/* harmony import */ var _components_content_table__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../components/content/table */ "./resources/js/modules/components/content/table.vue");
/* harmony import */ var _mixins_content_list_page__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../../mixins/content-list-page */ "./resources/js/modules/mixins/content-list-page.js");
/* harmony import */ var _create__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./create */ "./resources/js/modules/views/authorities/user/create.vue");
/* harmony import */ var _update__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./update */ "./resources/js/modules/views/authorities/user/update.vue");
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
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
    ISearch: _components_content_search__WEBPACK_IMPORTED_MODULE_1__["default"],
    IContent: _components_content_index__WEBPACK_IMPORTED_MODULE_0__["default"],
    Create: _create__WEBPACK_IMPORTED_MODULE_4__["default"],
    Update: _update__WEBPACK_IMPORTED_MODULE_5__["default"]
  },
  data: function data() {
    return {
      search: {},
      table: {
        columns: [{
          title: '姓名',
          slot: 'name'
        }, {
          title: '邮箱',
          slot: 'email'
        }, {
          title: '手机号码',
          slot: 'phone'
        }, {
          title: '所属部门',
          slot: 'role'
        }, {
          title: '性别',
          slot: 'sex'
        }, {
          title: '生日',
          slot: 'birthday'
        }, {
          title: '入职时间',
          slot: 'entryday'
        }, {
          title: '状态',
          slot: 'status'
        }, {
          title: '操作',
          slot: 'action'
        }]
      },
      loading: true
    };
  },
  methods: {
    getLists: function getLists() {
      var _this = this;

      var page = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 1;
      this.loading = true;
      this.$http.get("authorities/user", {
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
    status: function status(data) {
      var _this2 = this;

      this.loading = true;
      this.$http.put("authorities/user/".concat(data.id, "/status"), {
        status: data.status === 'on' ? 'off' : 'on'
      }).then(function () {
        _this2.getLists(_this2.page.current);
      }).finally(function () {
        _this2.loading = false;
      });
    }
  },
  filters: {
    status: function status(val) {
      return val === 'yes' ? '开启' : '关闭';
    },
    sex: function sex(val) {
      return val === 'man' ? '男' : '女';
    }
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/modules/views/authorities/user/update.vue?vue&type=script&lang=js&":
/*!*************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/modules/views/authorities/user/update.vue?vue&type=script&lang=js& ***!
  \*************************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _mixins_content_drawer__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../../mixins/content-drawer */ "./resources/js/modules/mixins/content-drawer.js");
/* harmony import */ var _components_content_drawer__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../../components/content/drawer */ "./resources/js/modules/components/content/drawer.vue");
/* harmony import */ var _user__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./user */ "./resources/js/modules/views/authorities/user/user.js");
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
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
  name: "update",
  components: {
    IDrawer: _components_content_drawer__WEBPACK_IMPORTED_MODULE_1__["default"]
  },
  mixins: [_mixins_content_drawer__WEBPACK_IMPORTED_MODULE_0__["default"], _user__WEBPACK_IMPORTED_MODULE_2__["default"]],
  mounted: function mounted() {
    var _this = this;

    this.$http("authorities/user/".concat(this.props.id, "/edit")).then(function (res) {
      _this.data = res.row;
      _this.roles.data = res.roles;
    }).finally(function () {
      _this.loading = false;
    });
  },
  methods: {
    submit: function submit(name) {
      var _this2 = this;

      this.validate(name).then(function () {
        _this2.loading = true;

        _this2.$http.put("authorities/user/".concat(_this2.props.id), _this2.data).then(function () {
          _this2.closeDrawer(false);
        }).finally(function () {
          _this2.loading = false;
        });
      }).catch();
    }
  }
});

/***/ }),

/***/ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/less-loader/dist/cjs.js!./node_modules/vue-loader/lib/index.js?!./resources/js/modules/components/content/table.vue?vue&type=style&index=0&id=36605e05&scoped=true&lang=less&":
/*!*********************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/css-loader!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--8-2!./node_modules/less-loader/dist/cjs.js!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/modules/components/content/table.vue?vue&type=style&index=0&id=36605e05&scoped=true&lang=less& ***!
  \*********************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(/*! ../../../../../node_modules/css-loader/lib/css-base.js */ "./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, ".ivu-page[data-v-36605e05] {\n  margin-top: 15px;\n  text-align: right;\n}\n", ""]);

// exports


/***/ }),

/***/ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/less-loader/dist/cjs.js!./node_modules/vue-loader/lib/index.js?!./resources/js/modules/components/content/table.vue?vue&type=style&index=0&id=36605e05&scoped=true&lang=less&":
/*!*************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/style-loader!./node_modules/css-loader!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--8-2!./node_modules/less-loader/dist/cjs.js!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/modules/components/content/table.vue?vue&type=style&index=0&id=36605e05&scoped=true&lang=less& ***!
  \*************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {


var content = __webpack_require__(/*! !../../../../../node_modules/css-loader!../../../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../../node_modules/postcss-loader/src??ref--8-2!../../../../../node_modules/less-loader/dist/cjs.js!../../../../../node_modules/vue-loader/lib??vue-loader-options!./table.vue?vue&type=style&index=0&id=36605e05&scoped=true&lang=less& */ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/less-loader/dist/cjs.js!./node_modules/vue-loader/lib/index.js?!./resources/js/modules/components/content/table.vue?vue&type=style&index=0&id=36605e05&scoped=true&lang=less&");

if(typeof content === 'string') content = [[module.i, content, '']];

var transform;
var insertInto;



var options = {"hmr":true}

options.transform = transform
options.insertInto = undefined;

var update = __webpack_require__(/*! ../../../../../node_modules/style-loader/lib/addStyles.js */ "./node_modules/style-loader/lib/addStyles.js")(content, options);

if(content.locals) module.exports = content.locals;

if(false) {}

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/modules/components/content/search.vue?vue&type=template&id=70c25cfe&scoped=true&":
/*!*************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/modules/components/content/search.vue?vue&type=template&id=70c25cfe&scoped=true& ***!
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
    "Card",
    { attrs: { title: _vm.title, icon: _vm.icon } },
    [
      _c(
        "Form",
        {
          ref: "formSearch",
          attrs: { model: _vm.value, inline: "", "label-width": 60 }
        },
        [_vm._t("default")],
        2
      )
    ],
    1
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/modules/components/content/table.vue?vue&type=template&id=36605e05&scoped=true&":
/*!************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/modules/components/content/table.vue?vue&type=template&id=36605e05&scoped=true& ***!
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
    "Card",
    { attrs: { title: _vm.title, icon: _vm.icon } },
    [
      _vm._t("default"),
      _vm._v(" "),
      _c("Page", {
        attrs: {
          current: _vm.current,
          total: _vm.total,
          "page-size": _vm.pageSize,
          "show-total": "",
          size: "small"
        },
        on: { "on-change": _vm.change }
      })
    ],
    2
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/modules/views/authorities/user/create.vue?vue&type=template&id=297a7eca&scoped=true&":
/*!*****************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/modules/views/authorities/user/create.vue?vue&type=template&id=297a7eca&scoped=true& ***!
  \*****************************************************************************************************************************************************************************************************************************************/
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
    "i-drawer",
    { attrs: { title: "用户添加", width: 620, loading: _vm.loading } },
    [
      _c(
        "Form",
        {
          ref: "formCreate",
          attrs: {
            model: _vm.data,
            "label-width": 100,
            rules: _vm.ruleValidate
          }
        },
        [
          _c(
            "FormItem",
            { attrs: { label: "姓名", prop: "name" } },
            [
              _c("Input", {
                attrs: { placeholder: "请输入姓名" },
                model: {
                  value: _vm.data.name,
                  callback: function($$v) {
                    _vm.$set(_vm.data, "name", $$v)
                  },
                  expression: "data.name"
                }
              })
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "FormItem",
            { attrs: { label: "邮箱", prop: "email" } },
            [
              _c("Input", {
                attrs: { placeholder: "请输入邮箱" },
                model: {
                  value: _vm.data.email,
                  callback: function($$v) {
                    _vm.$set(_vm.data, "email", $$v)
                  },
                  expression: "data.email"
                }
              })
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "Row",
            [
              _c(
                "Col",
                { attrs: { span: "12" } },
                [
                  _c(
                    "FormItem",
                    { attrs: { label: "手机号码", prop: "phone" } },
                    [
                      _c("Input", {
                        attrs: { placeholder: "手机号码" },
                        model: {
                          value: _vm.data.phone,
                          callback: function($$v) {
                            _vm.$set(_vm.data, "phone", $$v)
                          },
                          expression: "data.phone"
                        }
                      })
                    ],
                    1
                  )
                ],
                1
              ),
              _vm._v(" "),
              _c(
                "Col",
                { attrs: { span: "12" } },
                [
                  _c(
                    "FormItem",
                    { attrs: { label: "用户状态", prop: "status" } },
                    [
                      _c(
                        "i-switch",
                        {
                          attrs: {
                            "true-value": "on",
                            "false-value": "off",
                            size: "large"
                          },
                          model: {
                            value: _vm.data.status,
                            callback: function($$v) {
                              _vm.$set(_vm.data, "status", $$v)
                            },
                            expression: "data.status"
                          }
                        },
                        [
                          _c(
                            "span",
                            { attrs: { slot: "open" }, slot: "open" },
                            [_vm._v("开启")]
                          ),
                          _vm._v(" "),
                          _c(
                            "span",
                            { attrs: { slot: "close" }, slot: "close" },
                            [_vm._v("关闭")]
                          )
                        ]
                      )
                    ],
                    1
                  )
                ],
                1
              )
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "Row",
            [
              _c(
                "Col",
                { attrs: { span: "12" } },
                [
                  _c(
                    "FormItem",
                    { attrs: { label: "出生日期", prop: "birthday" } },
                    [
                      _c("DatePicker", {
                        attrs: {
                          placeholder: "出生日期",
                          format: "yyyy-MM-dd"
                        },
                        on: {
                          "on-change": function(val) {
                            return (_vm.data.birthday = val)
                          }
                        }
                      })
                    ],
                    1
                  )
                ],
                1
              ),
              _vm._v(" "),
              _c(
                "Col",
                { attrs: { span: "12" } },
                [
                  _c(
                    "FormItem",
                    { attrs: { label: "用户性别", prop: "sex" } },
                    [
                      _c(
                        "i-switch",
                        {
                          attrs: {
                            "true-value": "man",
                            "false-value": "women",
                            size: "large"
                          },
                          model: {
                            value: _vm.data.sex,
                            callback: function($$v) {
                              _vm.$set(_vm.data, "sex", $$v)
                            },
                            expression: "data.sex"
                          }
                        },
                        [
                          _c(
                            "span",
                            { attrs: { slot: "open" }, slot: "open" },
                            [_vm._v("男")]
                          ),
                          _vm._v(" "),
                          _c(
                            "span",
                            { attrs: { slot: "close" }, slot: "close" },
                            [_vm._v("女")]
                          )
                        ]
                      )
                    ],
                    1
                  )
                ],
                1
              )
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "Row",
            [
              _c(
                "Col",
                { attrs: { span: "12" } },
                [
                  _c(
                    "FormItem",
                    { attrs: { label: "入职时间", prop: "entryday" } },
                    [
                      _c("DatePicker", {
                        attrs: {
                          placeholder: "入职时间",
                          format: "yyyy-MM-dd"
                        },
                        on: {
                          "on-change": function(val) {
                            return (_vm.data.entryday = val)
                          }
                        }
                      })
                    ],
                    1
                  )
                ],
                1
              ),
              _vm._v(" "),
              _c(
                "Col",
                { attrs: { span: "12" } },
                [
                  _c(
                    "FormItem",
                    { attrs: { label: "所属部门", prop: "role_id" } },
                    [
                      _c(
                        "Select",
                        {
                          model: {
                            value: _vm.data.role_id,
                            callback: function($$v) {
                              _vm.$set(_vm.data, "role_id", $$v)
                            },
                            expression: "data.role_id"
                          }
                        },
                        _vm._l(_vm.roles.data, function(item) {
                          return _c(
                            "Option",
                            { key: item.id, attrs: { value: item.id } },
                            [
                              _vm._v(
                                "\n                            " +
                                  _vm._s(item.name) +
                                  "\n                        "
                              )
                            ]
                          )
                        }),
                        1
                      )
                    ],
                    1
                  )
                ],
                1
              )
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "FormItem",
            { attrs: { label: "密码", prop: "password" } },
            [
              _c("Input", {
                attrs: { placeholder: "请输入密码", type: "password" },
                model: {
                  value: _vm.data.password,
                  callback: function($$v) {
                    _vm.$set(_vm.data, "password", $$v)
                  },
                  expression: "data.password"
                }
              })
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "FormItem",
            { attrs: { label: "确认密码", prop: "password_confirmation" } },
            [
              _c("Input", {
                attrs: { placeholder: "请输入确认密码", type: "password" },
                model: {
                  value: _vm.data.password_confirmation,
                  callback: function($$v) {
                    _vm.$set(_vm.data, "password_confirmation", $$v)
                  },
                  expression: "data.password_confirmation"
                }
              })
            ],
            1
          )
        ],
        1
      ),
      _vm._v(" "),
      _c(
        "div",
        { attrs: { slot: "footer" }, slot: "footer" },
        [
          _c(
            "Button",
            {
              attrs: { type: "primary", icon: "ios-add" },
              on: {
                click: function($event) {
                  return _vm.submit("formCreate")
                }
              }
            },
            [_vm._v("提交")]
          )
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

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/modules/views/authorities/user/index.vue?vue&type=template&id=03e64afa&scoped=true&":
/*!****************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/modules/views/authorities/user/index.vue?vue&type=template&id=03e64afa&scoped=true& ***!
  \****************************************************************************************************************************************************************************************************************************************/
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
      _c(
        "i-search",
        {
          model: {
            value: _vm.search,
            callback: function($$v) {
              _vm.search = $$v
            },
            expression: "search"
          }
        },
        [
          _c(
            "FormItem",
            { attrs: { label: "姓名", "label-width": 100 } },
            [
              _c("Input", {
                attrs: { placeholder: "姓名" },
                model: {
                  value: _vm.search.name,
                  callback: function($$v) {
                    _vm.$set(_vm.search, "name", $$v)
                  },
                  expression: "search.name"
                }
              })
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "FormItem",
            { attrs: { "label-width": 1 } },
            [
              _c("Button", { attrs: { type: "primary", icon: "ios-search" } }, [
                _vm._v("搜索")
              ]),
              _vm._v(" "),
              _c(
                "Button",
                {
                  attrs: { type: "success", icon: "ios-add" },
                  on: {
                    click: function($event) {
                      return _vm.openComponent("Create")
                    }
                  }
                },
                [_vm._v("添加")]
              )
            ],
            1
          )
        ],
        1
      ),
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
                key: "email",
                fn: function(ref) {
                  var row = ref.row
                  var index = ref.index
                  return [_c("span", [_vm._v(_vm._s(row.email))])]
                }
              },
              {
                key: "phone",
                fn: function(ref) {
                  var row = ref.row
                  var index = ref.index
                  return [_c("span", [_vm._v(_vm._s(row.phone))])]
                }
              },
              {
                key: "role",
                fn: function(ref) {
                  var row = ref.row
                  var index = ref.index
                  return [_c("span", [_vm._v(_vm._s(row.role.name))])]
                }
              },
              {
                key: "sex",
                fn: function(ref) {
                  var row = ref.row
                  var index = ref.index
                  return [_c("span", [_vm._v(_vm._s(_vm._f("sex")(row.sex)))])]
                }
              },
              {
                key: "birthday",
                fn: function(ref) {
                  var row = ref.row
                  var index = ref.index
                  return [_c("span", [_vm._v(_vm._s(row.birthday))])]
                }
              },
              {
                key: "entryday",
                fn: function(ref) {
                  var row = ref.row
                  var index = ref.index
                  return [_c("span", [_vm._v(_vm._s(row.entryday))])]
                }
              },
              {
                key: "status",
                fn: function(ref) {
                  var row = ref.row
                  var index = ref.index
                  return [
                    _c(
                      "Poptip",
                      {
                        attrs: {
                          confirm: "",
                          title: "你确定要更改这个用户的状态吗？"
                        },
                        on: {
                          "on-ok": function($event) {
                            return _vm.status(row)
                          }
                        }
                      },
                      [
                        _c(
                          "Button",
                          {
                            attrs: {
                              type: row.status === "off" ? "error" : "success",
                              size: "small"
                            }
                          },
                          [
                            _vm._v(
                              _vm._s(_vm._f("status")(row.status)) +
                                "\n                    "
                            )
                          ]
                        )
                      ],
                      1
                    )
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
                        attrs: { type: "warning", size: "small" },
                        on: {
                          click: function($event) {
                            return _vm.openComponent("Update", row)
                          }
                        }
                      },
                      [_vm._v("编辑")]
                    )
                  ]
                }
              }
            ])
          })
        ],
        1
      ),
      _vm._v(" "),
      _c(_vm.component.is, {
        tag: "component",
        attrs: { props: _vm.component.prop },
        on: {
          "on-close": _vm.closeComponent,
          "on-refresh": function($event) {
            return _vm.getLists(1)
          }
        }
      })
    ],
    1
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/modules/views/authorities/user/update.vue?vue&type=template&id=effaac30&scoped=true&":
/*!*****************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/modules/views/authorities/user/update.vue?vue&type=template&id=effaac30&scoped=true& ***!
  \*****************************************************************************************************************************************************************************************************************************************/
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
    "i-drawer",
    { attrs: { title: "用户添加", width: 620, loading: _vm.loading } },
    [
      _c(
        "Form",
        {
          ref: "formUpdate",
          attrs: {
            model: _vm.data,
            "label-width": 100,
            rules: _vm.ruleValidate
          }
        },
        [
          _c(
            "FormItem",
            { attrs: { label: "姓名", prop: "name" } },
            [
              _c("Input", {
                attrs: { placeholder: "请输入姓名" },
                model: {
                  value: _vm.data.name,
                  callback: function($$v) {
                    _vm.$set(_vm.data, "name", $$v)
                  },
                  expression: "data.name"
                }
              })
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "FormItem",
            { attrs: { label: "邮箱", prop: "email" } },
            [
              _c("Input", {
                attrs: { placeholder: "请输入邮箱" },
                model: {
                  value: _vm.data.email,
                  callback: function($$v) {
                    _vm.$set(_vm.data, "email", $$v)
                  },
                  expression: "data.email"
                }
              })
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "Row",
            [
              _c(
                "Col",
                { attrs: { span: "12" } },
                [
                  _c(
                    "FormItem",
                    { attrs: { label: "手机号码", prop: "phone" } },
                    [
                      _c("Input", {
                        attrs: { placeholder: "手机号码" },
                        model: {
                          value: _vm.data.phone,
                          callback: function($$v) {
                            _vm.$set(_vm.data, "phone", $$v)
                          },
                          expression: "data.phone"
                        }
                      })
                    ],
                    1
                  )
                ],
                1
              ),
              _vm._v(" "),
              _c(
                "Col",
                { attrs: { span: "12" } },
                [
                  _c(
                    "FormItem",
                    { attrs: { label: "用户状态", prop: "status" } },
                    [
                      _c(
                        "i-switch",
                        {
                          attrs: {
                            "true-value": "on",
                            "false-value": "off",
                            size: "large"
                          },
                          model: {
                            value: _vm.data.status,
                            callback: function($$v) {
                              _vm.$set(_vm.data, "status", $$v)
                            },
                            expression: "data.status"
                          }
                        },
                        [
                          _c(
                            "span",
                            { attrs: { slot: "open" }, slot: "open" },
                            [_vm._v("开启")]
                          ),
                          _vm._v(" "),
                          _c(
                            "span",
                            { attrs: { slot: "close" }, slot: "close" },
                            [_vm._v("关闭")]
                          )
                        ]
                      )
                    ],
                    1
                  )
                ],
                1
              )
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "Row",
            [
              _c(
                "Col",
                { attrs: { span: "12" } },
                [
                  _c(
                    "FormItem",
                    { attrs: { label: "出生日期", prop: "birthday" } },
                    [
                      _c("DatePicker", {
                        attrs: {
                          placeholder: "出生日期",
                          value: _vm.data.birthday,
                          format: "yyyy-MM-dd"
                        },
                        on: {
                          "on-change": function(val) {
                            return (_vm.data.birthday = val)
                          }
                        }
                      })
                    ],
                    1
                  )
                ],
                1
              ),
              _vm._v(" "),
              _c(
                "Col",
                { attrs: { span: "12" } },
                [
                  _c(
                    "FormItem",
                    { attrs: { label: "用户性别", prop: "sex" } },
                    [
                      _c(
                        "i-switch",
                        {
                          attrs: {
                            "true-value": "man",
                            "false-value": "women",
                            size: "large"
                          },
                          model: {
                            value: _vm.data.sex,
                            callback: function($$v) {
                              _vm.$set(_vm.data, "sex", $$v)
                            },
                            expression: "data.sex"
                          }
                        },
                        [
                          _c(
                            "span",
                            { attrs: { slot: "open" }, slot: "open" },
                            [_vm._v("男")]
                          ),
                          _vm._v(" "),
                          _c(
                            "span",
                            { attrs: { slot: "close" }, slot: "close" },
                            [_vm._v("女")]
                          )
                        ]
                      )
                    ],
                    1
                  )
                ],
                1
              )
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "Row",
            [
              _c(
                "Col",
                { attrs: { span: "12" } },
                [
                  _c(
                    "FormItem",
                    { attrs: { label: "入职时间", prop: "entryday" } },
                    [
                      _c("DatePicker", {
                        attrs: {
                          placeholder: "入职时间",
                          value: _vm.data.entryday,
                          format: "yyyy-MM-dd"
                        },
                        on: {
                          "on-change": function(val) {
                            return (_vm.data.entryday = val)
                          }
                        }
                      })
                    ],
                    1
                  )
                ],
                1
              ),
              _vm._v(" "),
              _c(
                "Col",
                { attrs: { span: "12" } },
                [
                  _c(
                    "FormItem",
                    { attrs: { label: "所属部门", prop: "department_id" } },
                    [
                      _c(
                        "Select",
                        {
                          model: {
                            value: _vm.data.department_id,
                            callback: function($$v) {
                              _vm.$set(_vm.data, "department_id", $$v)
                            },
                            expression: "data.department_id"
                          }
                        },
                        _vm._l(_vm.departments.data, function(item) {
                          return _c(
                            "Option",
                            { key: item.id, attrs: { value: item.id } },
                            [
                              _vm._v(
                                "\n                            " +
                                  _vm._s(item.name) +
                                  "\n                        "
                              )
                            ]
                          )
                        }),
                        1
                      )
                    ],
                    1
                  )
                ],
                1
              )
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "FormItem",
            { attrs: { label: "密码", prop: "password" } },
            [
              _c("Input", {
                attrs: { placeholder: "请输入密码", type: "password" },
                model: {
                  value: _vm.data.password,
                  callback: function($$v) {
                    _vm.$set(_vm.data, "password", $$v)
                  },
                  expression: "data.password"
                }
              })
            ],
            1
          ),
          _vm._v(" "),
          _c(
            "FormItem",
            { attrs: { label: "确认密码", prop: "password_confirmation" } },
            [
              _c("Input", {
                attrs: { placeholder: "请输入确认密码", type: "password" },
                model: {
                  value: _vm.data.password_confirmation,
                  callback: function($$v) {
                    _vm.$set(_vm.data, "password_confirmation", $$v)
                  },
                  expression: "data.password_confirmation"
                }
              })
            ],
            1
          )
        ],
        1
      ),
      _vm._v(" "),
      _c(
        "div",
        { attrs: { slot: "footer" }, slot: "footer" },
        [
          _c(
            "Button",
            {
              attrs: { type: "primary", icon: "ios-add" },
              on: {
                click: function($event) {
                  return _vm.submit("formUpdate")
                }
              }
            },
            [_vm._v("提交")]
          )
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

/***/ "./resources/js/modules/components/content/search.vue":
/*!************************************************************!*\
  !*** ./resources/js/modules/components/content/search.vue ***!
  \************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _search_vue_vue_type_template_id_70c25cfe_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./search.vue?vue&type=template&id=70c25cfe&scoped=true& */ "./resources/js/modules/components/content/search.vue?vue&type=template&id=70c25cfe&scoped=true&");
/* harmony import */ var _search_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./search.vue?vue&type=script&lang=js& */ "./resources/js/modules/components/content/search.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _search_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _search_vue_vue_type_template_id_70c25cfe_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _search_vue_vue_type_template_id_70c25cfe_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "70c25cfe",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/modules/components/content/search.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/modules/components/content/search.vue?vue&type=script&lang=js&":
/*!*************************************************************************************!*\
  !*** ./resources/js/modules/components/content/search.vue?vue&type=script&lang=js& ***!
  \*************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_search_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../node_modules/vue-loader/lib??vue-loader-options!./search.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/modules/components/content/search.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_search_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/modules/components/content/search.vue?vue&type=template&id=70c25cfe&scoped=true&":
/*!*******************************************************************************************************!*\
  !*** ./resources/js/modules/components/content/search.vue?vue&type=template&id=70c25cfe&scoped=true& ***!
  \*******************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_search_vue_vue_type_template_id_70c25cfe_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../node_modules/vue-loader/lib??vue-loader-options!./search.vue?vue&type=template&id=70c25cfe&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/modules/components/content/search.vue?vue&type=template&id=70c25cfe&scoped=true&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_search_vue_vue_type_template_id_70c25cfe_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_search_vue_vue_type_template_id_70c25cfe_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ }),

/***/ "./resources/js/modules/components/content/table.vue":
/*!***********************************************************!*\
  !*** ./resources/js/modules/components/content/table.vue ***!
  \***********************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _table_vue_vue_type_template_id_36605e05_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./table.vue?vue&type=template&id=36605e05&scoped=true& */ "./resources/js/modules/components/content/table.vue?vue&type=template&id=36605e05&scoped=true&");
/* harmony import */ var _table_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./table.vue?vue&type=script&lang=js& */ "./resources/js/modules/components/content/table.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _table_vue_vue_type_style_index_0_id_36605e05_scoped_true_lang_less___WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./table.vue?vue&type=style&index=0&id=36605e05&scoped=true&lang=less& */ "./resources/js/modules/components/content/table.vue?vue&type=style&index=0&id=36605e05&scoped=true&lang=less&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");






/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__["default"])(
  _table_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _table_vue_vue_type_template_id_36605e05_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _table_vue_vue_type_template_id_36605e05_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "36605e05",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/modules/components/content/table.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/modules/components/content/table.vue?vue&type=script&lang=js&":
/*!************************************************************************************!*\
  !*** ./resources/js/modules/components/content/table.vue?vue&type=script&lang=js& ***!
  \************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_table_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../node_modules/vue-loader/lib??vue-loader-options!./table.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/modules/components/content/table.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_table_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/modules/components/content/table.vue?vue&type=style&index=0&id=36605e05&scoped=true&lang=less&":
/*!*********************************************************************************************************************!*\
  !*** ./resources/js/modules/components/content/table.vue?vue&type=style&index=0&id=36605e05&scoped=true&lang=less& ***!
  \*********************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_8_2_node_modules_less_loader_dist_cjs_js_node_modules_vue_loader_lib_index_js_vue_loader_options_table_vue_vue_type_style_index_0_id_36605e05_scoped_true_lang_less___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/style-loader!../../../../../node_modules/css-loader!../../../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../../node_modules/postcss-loader/src??ref--8-2!../../../../../node_modules/less-loader/dist/cjs.js!../../../../../node_modules/vue-loader/lib??vue-loader-options!./table.vue?vue&type=style&index=0&id=36605e05&scoped=true&lang=less& */ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/less-loader/dist/cjs.js!./node_modules/vue-loader/lib/index.js?!./resources/js/modules/components/content/table.vue?vue&type=style&index=0&id=36605e05&scoped=true&lang=less&");
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_8_2_node_modules_less_loader_dist_cjs_js_node_modules_vue_loader_lib_index_js_vue_loader_options_table_vue_vue_type_style_index_0_id_36605e05_scoped_true_lang_less___WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_8_2_node_modules_less_loader_dist_cjs_js_node_modules_vue_loader_lib_index_js_vue_loader_options_table_vue_vue_type_style_index_0_id_36605e05_scoped_true_lang_less___WEBPACK_IMPORTED_MODULE_0__);
/* harmony reexport (unknown) */ for(var __WEBPACK_IMPORT_KEY__ in _node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_8_2_node_modules_less_loader_dist_cjs_js_node_modules_vue_loader_lib_index_js_vue_loader_options_table_vue_vue_type_style_index_0_id_36605e05_scoped_true_lang_less___WEBPACK_IMPORTED_MODULE_0__) if(__WEBPACK_IMPORT_KEY__ !== 'default') (function(key) { __webpack_require__.d(__webpack_exports__, key, function() { return _node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_8_2_node_modules_less_loader_dist_cjs_js_node_modules_vue_loader_lib_index_js_vue_loader_options_table_vue_vue_type_style_index_0_id_36605e05_scoped_true_lang_less___WEBPACK_IMPORTED_MODULE_0__[key]; }) }(__WEBPACK_IMPORT_KEY__));
 /* harmony default export */ __webpack_exports__["default"] = (_node_modules_style_loader_index_js_node_modules_css_loader_index_js_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_8_2_node_modules_less_loader_dist_cjs_js_node_modules_vue_loader_lib_index_js_vue_loader_options_table_vue_vue_type_style_index_0_id_36605e05_scoped_true_lang_less___WEBPACK_IMPORTED_MODULE_0___default.a); 

/***/ }),

/***/ "./resources/js/modules/components/content/table.vue?vue&type=template&id=36605e05&scoped=true&":
/*!******************************************************************************************************!*\
  !*** ./resources/js/modules/components/content/table.vue?vue&type=template&id=36605e05&scoped=true& ***!
  \******************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_table_vue_vue_type_template_id_36605e05_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../node_modules/vue-loader/lib??vue-loader-options!./table.vue?vue&type=template&id=36605e05&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/modules/components/content/table.vue?vue&type=template&id=36605e05&scoped=true&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_table_vue_vue_type_template_id_36605e05_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_table_vue_vue_type_template_id_36605e05_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ }),

/***/ "./resources/js/modules/views/authorities/user/create.vue":
/*!****************************************************************!*\
  !*** ./resources/js/modules/views/authorities/user/create.vue ***!
  \****************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _create_vue_vue_type_template_id_297a7eca_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./create.vue?vue&type=template&id=297a7eca&scoped=true& */ "./resources/js/modules/views/authorities/user/create.vue?vue&type=template&id=297a7eca&scoped=true&");
/* harmony import */ var _create_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./create.vue?vue&type=script&lang=js& */ "./resources/js/modules/views/authorities/user/create.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _create_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _create_vue_vue_type_template_id_297a7eca_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _create_vue_vue_type_template_id_297a7eca_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "297a7eca",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/modules/views/authorities/user/create.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/modules/views/authorities/user/create.vue?vue&type=script&lang=js&":
/*!*****************************************************************************************!*\
  !*** ./resources/js/modules/views/authorities/user/create.vue?vue&type=script&lang=js& ***!
  \*****************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_create_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../../node_modules/vue-loader/lib??vue-loader-options!./create.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/modules/views/authorities/user/create.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_create_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/modules/views/authorities/user/create.vue?vue&type=template&id=297a7eca&scoped=true&":
/*!***********************************************************************************************************!*\
  !*** ./resources/js/modules/views/authorities/user/create.vue?vue&type=template&id=297a7eca&scoped=true& ***!
  \***********************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_create_vue_vue_type_template_id_297a7eca_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../../node_modules/vue-loader/lib??vue-loader-options!./create.vue?vue&type=template&id=297a7eca&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/modules/views/authorities/user/create.vue?vue&type=template&id=297a7eca&scoped=true&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_create_vue_vue_type_template_id_297a7eca_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_create_vue_vue_type_template_id_297a7eca_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ }),

/***/ "./resources/js/modules/views/authorities/user/index.vue":
/*!***************************************************************!*\
  !*** ./resources/js/modules/views/authorities/user/index.vue ***!
  \***************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _index_vue_vue_type_template_id_03e64afa_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./index.vue?vue&type=template&id=03e64afa&scoped=true& */ "./resources/js/modules/views/authorities/user/index.vue?vue&type=template&id=03e64afa&scoped=true&");
/* harmony import */ var _index_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./index.vue?vue&type=script&lang=js& */ "./resources/js/modules/views/authorities/user/index.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _index_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _index_vue_vue_type_template_id_03e64afa_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _index_vue_vue_type_template_id_03e64afa_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "03e64afa",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/modules/views/authorities/user/index.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/modules/views/authorities/user/index.vue?vue&type=script&lang=js&":
/*!****************************************************************************************!*\
  !*** ./resources/js/modules/views/authorities/user/index.vue?vue&type=script&lang=js& ***!
  \****************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_index_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../../node_modules/vue-loader/lib??vue-loader-options!./index.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/modules/views/authorities/user/index.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_index_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/modules/views/authorities/user/index.vue?vue&type=template&id=03e64afa&scoped=true&":
/*!**********************************************************************************************************!*\
  !*** ./resources/js/modules/views/authorities/user/index.vue?vue&type=template&id=03e64afa&scoped=true& ***!
  \**********************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_index_vue_vue_type_template_id_03e64afa_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../../node_modules/vue-loader/lib??vue-loader-options!./index.vue?vue&type=template&id=03e64afa&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/modules/views/authorities/user/index.vue?vue&type=template&id=03e64afa&scoped=true&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_index_vue_vue_type_template_id_03e64afa_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_index_vue_vue_type_template_id_03e64afa_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ }),

/***/ "./resources/js/modules/views/authorities/user/update.vue":
/*!****************************************************************!*\
  !*** ./resources/js/modules/views/authorities/user/update.vue ***!
  \****************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _update_vue_vue_type_template_id_effaac30_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./update.vue?vue&type=template&id=effaac30&scoped=true& */ "./resources/js/modules/views/authorities/user/update.vue?vue&type=template&id=effaac30&scoped=true&");
/* harmony import */ var _update_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./update.vue?vue&type=script&lang=js& */ "./resources/js/modules/views/authorities/user/update.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _update_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _update_vue_vue_type_template_id_effaac30_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _update_vue_vue_type_template_id_effaac30_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "effaac30",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/modules/views/authorities/user/update.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/modules/views/authorities/user/update.vue?vue&type=script&lang=js&":
/*!*****************************************************************************************!*\
  !*** ./resources/js/modules/views/authorities/user/update.vue?vue&type=script&lang=js& ***!
  \*****************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_update_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../../node_modules/vue-loader/lib??vue-loader-options!./update.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/modules/views/authorities/user/update.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_update_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/modules/views/authorities/user/update.vue?vue&type=template&id=effaac30&scoped=true&":
/*!***********************************************************************************************************!*\
  !*** ./resources/js/modules/views/authorities/user/update.vue?vue&type=template&id=effaac30&scoped=true& ***!
  \***********************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_update_vue_vue_type_template_id_effaac30_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../../node_modules/vue-loader/lib??vue-loader-options!./update.vue?vue&type=template&id=effaac30&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/modules/views/authorities/user/update.vue?vue&type=template&id=effaac30&scoped=true&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_update_vue_vue_type_template_id_effaac30_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_update_vue_vue_type_template_id_effaac30_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ }),

/***/ "./resources/js/modules/views/authorities/user/user.js":
/*!*************************************************************!*\
  !*** ./resources/js/modules/views/authorities/user/user.js ***!
  \*************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony default export */ __webpack_exports__["default"] = ({
  data: function data() {
    var _this = this;

    return {
      loading: true,
      data: {
        sex: 'women',
        status: 'on'
      },
      departments: {
        data: []
      },
      roles: {
        data: []
      },
      ruleValidate: {
        name: [{
          required: true,
          message: '用户姓名必须填写',
          trigger: 'blur'
        }, {
          type: 'string',
          min: 2,
          max: 20,
          message: '用户姓名字符长度是2-20个字符',
          trigger: 'blur'
        }],
        email: [{
          required: true,
          message: '用户邮箱不能为空',
          trigger: 'blur'
        }, {
          type: 'email',
          message: '用户邮箱格式不正确',
          trigger: 'blur'
        }],
        phone: [{
          required: true,
          message: '手机号码必须填写',
          trigger: 'blur'
        }, {
          pattern: /^1[34578]\d{9}$/,
          message: '手机号码格式不正确',
          trigger: 'blur'
        }],
        role_id: [{
          required: true,
          type: 'number',
          message: '所属部门不能为空',
          trigger: 'change'
        }],
        password: [{
          required: true,
          message: '用户密码不能为空',
          trigger: 'blur'
        }, {
          type: 'string',
          min: 6,
          max: 20,
          message: '用户密码字符长度是6-20个字符',
          trigger: 'blur'
        }],
        status: [{
          required: true,
          type: 'enum',
          enum: ['off', 'on'],
          message: '用户状态不能为空'
        }],
        sex: [{
          required: true,
          type: 'enum',
          enum: ['women', 'man'],
          message: '性别状态不能为空'
        }],
        password_confirmation: [{
          required: true,
          message: '二次输入密码不正确',
          trigger: 'blur'
        }, {
          trigger: 'blur',
          validator: function validator(rule, value, callback) {
            if (value === _this.data.password) {
              return callback();
            } else {
              return callback('二次输入密码不正确');
            }
          }
        }]
      }
    };
  }
});

/***/ })

}]);