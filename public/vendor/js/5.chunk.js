(window.webpackJsonp=window.webpackJsonp||[]).push([[5],{"1wZO":function(t,a,e){"use strict";var n=e("rqBi");e.n(n).a},"2IPJ":function(t,a,e){"use strict";var n={name:"i-content",props:{spinShow:{type:Boolean,default:!1}}},o=(e("1wZO"),e("KHd+")),r=Object(o.a)(n,function(){var t=this.$createElement,a=this._self._c||t;return a("div",{staticClass:"content-wrapper"},[this._t("default"),this._v(" "),this.spinShow?a("Spin",{attrs:{size:"large",fix:""}}):this._e()],2)},[],!1,null,"094f7294",null);a.a=r.exports},"3Q9P":function(t,a,e){"use strict";a.a={methods:{validate:function(t){var a=this;return new Promise(function(e,n){a.$refs[t].validate(function(t){t?e():n()})})}}}},CoqM:function(t,a,e){"use strict";var n={name:"i-search",props:{value:{type:Object},title:{type:String,default:"搜索"},icon:{type:String,default:"ios-search"}}},o=e("KHd+"),r=Object(o.a)(n,function(){var t=this.$createElement,a=this._self._c||t;return a("Card",{attrs:{title:this.title,icon:this.icon}},[a("Form",{ref:"formSearch",attrs:{model:this.value,inline:"","label-width":60}},[this._t("default")],2)],1)},[],!1,null,"aca4acc4",null);a.a=r.exports},CpXx:function(t,a,e){"use strict";var n=e("j3Ox");e.n(n).a},"I+T0":function(t,a,e){(t.exports=e("I1BE")(!1)).push([t.i,".content-wrapper[data-v-094f7294]{padding:18px;overflow:auto}.content-wrapper>.ivu-card[data-v-094f7294]{margin-bottom:10px}",""])},LuDj:function(t,a,e){"use strict";var n=e("3Q9P");a.a={mixins:[n.a],data:function(){return{page:{current:1,total:100},table:{columns:[],data:[]},component:{is:"",prop:null},loading:!0}},mounted:function(){var t=this;this.$nextTick(function(){t.getLists()})},methods:{pageChange:function(t){this.getLists(t)},openComponent:function(t){var a=arguments.length>1&&void 0!==arguments[1]?arguments[1]:null;this.component.is=t,this.component.prop=a},closeComponent:function(){this.component.is="",this.component.prop=null},getLists:function(){}}}},PY6l:function(t,a,e){"use strict";var n={name:"i-table",props:{current:{type:Number},total:{type:Number},pageSize:{type:Number,default:15},title:{type:String,default:"列表"},icon:{type:String,default:"ios-list-box"}},methods:{change:function(t){this.$emit("on-page-change",t)}}},o=(e("Y4hK"),e("KHd+")),r=Object(o.a)(n,function(){var t=this,a=t.$createElement,e=t._self._c||a;return e("Card",{attrs:{title:t.title,icon:t.icon}},[t._t("default"),t._v(" "),e("Page",{attrs:{current:t.current,total:t.total,"page-size":t.pageSize,"show-total":"",size:"small"},on:{"on-change":t.change}})],2)},[],!1,null,"25badb01",null);a.a=r.exports},UqFG:function(t,a,e){(t.exports=e("I1BE")(!1)).push([t.i,".ivu-page[data-v-25badb01]{margin-top:15px;text-align:right}",""])},Y4hK:function(t,a,e){"use strict";var n=e("fByT");e.n(n).a},fByT:function(t,a,e){var n=e("UqFG");"string"==typeof n&&(n=[[t.i,n,""]]);var o={hmr:!0,transform:void 0,insertInto:void 0};e("aET+")(n,o);n.locals&&(t.exports=n.locals)},j3Ox:function(t,a,e){var n=e("wbTh");"string"==typeof n&&(n=[[t.i,n,""]]);var o={hmr:!0,transform:void 0,insertInto:void 0};e("aET+")(n,o);n.locals&&(t.exports=n.locals)},lEg9:function(t,a,e){"use strict";var n=e("3Q9P");a.a={mixins:[n.a],props:{props:null},data:function(){return{drawer:{value:!0}}},methods:{closeDrawer:function(t){!1===t&&(this.drawer.value=!1,this.drawer.props=null,this.$emit("on-close",!1),this.$emit("on-refresh"))}}}},rqBi:function(t,a,e){var n=e("I+T0");"string"==typeof n&&(n=[[t.i,n,""]]);var o={hmr:!0,transform:void 0,insertInto:void 0};e("aET+")(n,o);n.locals&&(t.exports=n.locals)},vXPX:function(t,a,e){"use strict";e.r(a);var n=e("2IPJ"),o=e("CoqM"),r=e("PY6l"),s=e("LuDj"),i=e("lEg9"),l=e("x91n"),c={data:function(){return{loading:!0,data:{sex:"women",status:"on"},departments:{data:[]},roles:{data:[]},ruleValidate:{name:[{required:!0,message:"用户姓名必须填写",trigger:"blur"},{type:"string",min:2,max:20,message:"用户姓名字符长度是2-20个字符",trigger:"blur"}],email:[{required:!0,message:"用户邮箱不能为空",trigger:"blur"},{type:"email",message:"用户邮箱格式不正确",trigger:"blur"}],phone:[{required:!0,message:"手机号码必须填写",trigger:"blur"},{pattern:/^1[34578]\d{9}$/,message:"手机号码格式不正确",trigger:"blur"}],role_id:[{required:!0,type:"number",message:"所属部门不能为空",trigger:"change"}],status:[{required:!0,type:"enum",enum:["off","on"],message:"用户状态不能为空"}],sex:[{required:!0,type:"enum",enum:["women","man"],message:"性别状态不能为空"}]}}}},u={name:"data",components:{IDrawer:l.a},mixins:[i.a,c],mounted:function(){var t=this;this.$http("authorities/user/create").then(function(a){t.roles.data=a,t.loading=!1})},methods:{submit:function(t){var a=this;this.validate(t).then(function(){a.loading=!0,a.$http.post("authorities/user",a.data).then(function(){a.closeDrawer(!1)}).finally(function(){a.loading=!1})}).catch()}}},p=e("KHd+"),d=Object(p.a)(u,function(){var t=this,a=t.$createElement,e=t._self._c||a;return e("i-drawer",{attrs:{title:"用户添加",width:620,loading:t.loading}},[e("Form",{ref:"formCreate",attrs:{model:t.data,"label-width":100,rules:t.ruleValidate}},[e("FormItem",{attrs:{label:"姓名",prop:"name"}},[e("Input",{attrs:{placeholder:"请输入姓名"},model:{value:t.data.name,callback:function(a){t.$set(t.data,"name",a)},expression:"data.name"}})],1),t._v(" "),e("FormItem",{attrs:{label:"邮箱",prop:"email"}},[e("Input",{attrs:{placeholder:"请输入邮箱"},model:{value:t.data.email,callback:function(a){t.$set(t.data,"email",a)},expression:"data.email"}})],1),t._v(" "),e("Row",[e("Col",{attrs:{span:"12"}},[e("FormItem",{attrs:{label:"手机号码",prop:"phone"}},[e("Input",{attrs:{placeholder:"手机号码"},model:{value:t.data.phone,callback:function(a){t.$set(t.data,"phone",a)},expression:"data.phone"}})],1)],1),t._v(" "),e("Col",{attrs:{span:"12"}},[e("FormItem",{attrs:{label:"用户状态",prop:"status"}},[e("i-switch",{attrs:{"true-value":"on","false-value":"off",size:"large"},model:{value:t.data.status,callback:function(a){t.$set(t.data,"status",a)},expression:"data.status"}},[e("span",{attrs:{slot:"open"},slot:"open"},[t._v("开启")]),t._v(" "),e("span",{attrs:{slot:"close"},slot:"close"},[t._v("关闭")])])],1)],1)],1),t._v(" "),e("Row",[e("Col",{attrs:{span:"12"}},[e("FormItem",{attrs:{label:"出生日期",prop:"birthday"}},[e("DatePicker",{attrs:{placeholder:"出生日期",format:"yyyy-MM-dd"},on:{"on-change":function(a){return t.data.birthday=a}}})],1)],1),t._v(" "),e("Col",{attrs:{span:"12"}},[e("FormItem",{attrs:{label:"用户性别",prop:"sex"}},[e("i-switch",{attrs:{"true-value":"man","false-value":"women",size:"large"},model:{value:t.data.sex,callback:function(a){t.$set(t.data,"sex",a)},expression:"data.sex"}},[e("span",{attrs:{slot:"open"},slot:"open"},[t._v("男")]),t._v(" "),e("span",{attrs:{slot:"close"},slot:"close"},[t._v("女")])])],1)],1)],1),t._v(" "),e("Row",[e("Col",{attrs:{span:"12"}},[e("FormItem",{attrs:{label:"入职时间",prop:"entryday"}},[e("DatePicker",{attrs:{placeholder:"入职时间",format:"yyyy-MM-dd"},on:{"on-change":function(a){return t.data.entryday=a}}})],1)],1),t._v(" "),e("Col",{attrs:{span:"12"}},[e("FormItem",{attrs:{label:"所属部门",prop:"role_id"}},[e("Select",{model:{value:t.data.role_id,callback:function(a){t.$set(t.data,"role_id",a)},expression:"data.role_id"}},t._l(t.roles.data,function(a){return e("Option",{key:a.id,attrs:{value:a.id}},[t._v("\n                            "+t._s(a.name)+"\n                        ")])}),1)],1)],1)],1),t._v(" "),e("FormItem",{attrs:{label:"密码",prop:"password"}},[e("Input",{attrs:{placeholder:"请输入密码",type:"password"},model:{value:t.data.password,callback:function(a){t.$set(t.data,"password",a)},expression:"data.password"}})],1),t._v(" "),e("FormItem",{attrs:{label:"确认密码",prop:"password_confirmation"}},[e("Input",{attrs:{placeholder:"请输入确认密码",type:"password"},model:{value:t.data.password_confirmation,callback:function(a){t.$set(t.data,"password_confirmation",a)},expression:"data.password_confirmation"}})],1)],1),t._v(" "),e("div",{attrs:{slot:"footer"},slot:"footer"},[e("Button",{attrs:{type:"primary",icon:"ios-add"},on:{click:function(a){return t.submit("formCreate")}}},[t._v("提交")])],1)],1)},[],!1,null,"3168e354",null).exports,m={name:"create",components:{IDrawer:l.a},mixins:[i.a,c],mounted:function(){var t=this;this.$http("authorities/user/".concat(this.props.id,"/edit")).then(function(a){t.data=a.data,t.roles.data=a.roles,t.loading=!1})},methods:{submit:function(t){var a=this;this.loading=!0,this.validate(t).then(function(){a.$http.put("authorities/user/".concat(a.props.id),a.data).then(function(){a.closeDrawer(!1)}).finally(function(){a.loading=!1})}).catch()}}},f=Object(p.a)(m,function(){var t=this,a=t.$createElement,e=t._self._c||a;return e("i-drawer",{attrs:{title:"用户添加",width:620,loading:t.loading}},[e("Form",{ref:"formUpdate",attrs:{model:t.data,"label-width":100,rules:t.ruleValidate}},[e("FormItem",{attrs:{label:"姓名",prop:"name"}},[e("Input",{attrs:{placeholder:"请输入姓名"},model:{value:t.data.name,callback:function(a){t.$set(t.data,"name",a)},expression:"data.name"}})],1),t._v(" "),e("FormItem",{attrs:{label:"邮箱",prop:"email"}},[e("Input",{attrs:{placeholder:"请输入邮箱"},model:{value:t.data.email,callback:function(a){t.$set(t.data,"email",a)},expression:"data.email"}})],1),t._v(" "),e("Row",[e("Col",{attrs:{span:"12"}},[e("FormItem",{attrs:{label:"手机号码",prop:"phone"}},[e("Input",{attrs:{placeholder:"手机号码"},model:{value:t.data.phone,callback:function(a){t.$set(t.data,"phone",a)},expression:"data.phone"}})],1)],1),t._v(" "),e("Col",{attrs:{span:"12"}},[e("FormItem",{attrs:{label:"用户状态",prop:"status"}},[e("i-switch",{attrs:{"true-value":"on","false-value":"off",size:"large"},model:{value:t.data.status,callback:function(a){t.$set(t.data,"status",a)},expression:"data.status"}},[e("span",{attrs:{slot:"open"},slot:"open"},[t._v("开启")]),t._v(" "),e("span",{attrs:{slot:"close"},slot:"close"},[t._v("关闭")])])],1)],1)],1),t._v(" "),e("Row",[e("Col",{attrs:{span:"12"}},[e("FormItem",{attrs:{label:"出生日期",prop:"birthday"}},[e("DatePicker",{attrs:{placeholder:"出生日期",value:t.data.birthday,format:"yyyy-MM-dd"},on:{"on-change":function(a){return t.data.birthday=a}}})],1)],1),t._v(" "),e("Col",{attrs:{span:"12"}},[e("FormItem",{attrs:{label:"用户性别",prop:"sex"}},[e("i-switch",{attrs:{"true-value":"man","false-value":"women",size:"large"},model:{value:t.data.sex,callback:function(a){t.$set(t.data,"sex",a)},expression:"data.sex"}},[e("span",{attrs:{slot:"open"},slot:"open"},[t._v("男")]),t._v(" "),e("span",{attrs:{slot:"close"},slot:"close"},[t._v("女")])])],1)],1)],1),t._v(" "),e("Row",[e("Col",{attrs:{span:"12"}},[e("FormItem",{attrs:{label:"入职时间",prop:"entryday"}},[e("DatePicker",{attrs:{placeholder:"入职时间",value:t.data.entryday,format:"yyyy-MM-dd"},on:{"on-change":function(a){return t.data.entryday=a}}})],1)],1),t._v(" "),e("Col",{attrs:{span:"12"}},[e("FormItem",{attrs:{label:"所属部门",prop:"department_id"}},[e("Select",{model:{value:t.data.role_id,callback:function(a){t.$set(t.data,"role_id",a)},expression:"data.role_id"}},t._l(t.roles.data,function(a){return e("Option",{key:a.id,attrs:{value:a.id}},[t._v("\n                            "+t._s(a.name)+"\n                        ")])}),1)],1)],1)],1),t._v(" "),e("FormItem",{attrs:{label:"密码",prop:"password"}},[e("Input",{attrs:{placeholder:"请输入密码",type:"password"},model:{value:t.data.password,callback:function(a){t.$set(t.data,"password",a)},expression:"data.password"}})],1),t._v(" "),e("FormItem",{attrs:{label:"确认密码",prop:"password_confirmation"}},[e("Input",{attrs:{placeholder:"请输入确认密码",type:"password"},model:{value:t.data.password_confirmation,callback:function(a){t.$set(t.data,"password_confirmation",a)},expression:"data.password_confirmation"}})],1)],1),t._v(" "),e("div",{attrs:{slot:"footer"},slot:"footer"},[e("Button",{attrs:{type:"primary",icon:"ios-add"},on:{click:function(a){return t.submit("formUpdate")}}},[t._v("提交")])],1)],1)},[],!1,null,"f8a24c94",null).exports,h={name:"index",mixins:[s.a],components:{ITable:r.a,ISearch:o.a,IContent:n.a,Create:d,Update:f},data:function(){return{search:{},table:{columns:[{title:"姓名",slot:"name"},{title:"邮箱",slot:"email"},{title:"手机号码",slot:"phone"},{title:"所属部门",slot:"role"},{title:"性别",slot:"sex"},{title:"生日",slot:"birthday"},{title:"入职时间",slot:"entryday"},{title:"状态",slot:"status"},{title:"操作",slot:"action"}]},loading:!0}},methods:{getLists:function(){var t=this,a=arguments.length>0&&void 0!==arguments[0]?arguments[0]:1;this.loading=!0,this.$http.get("authorities/user",{params:Object.assign({},this.search,{page:a})}).then(function(a){t.table.data=a.data,t.page.total=a.total,t.page.current=a.current_page}).finally(function(){t.loading=!1})},status:function(t){var a=this;this.loading=!0,this.$http.put("authorities/user/".concat(t.id,"/status"),{status:"on"===t.status?"off":"on"}).then(function(){a.getLists(a.page.current)})}}},v=Object(p.a)(h,function(){var t=this,a=t.$createElement,e=t._self._c||a;return e("i-content",{attrs:{"spin-show":t.loading}},[e("i-search",{model:{value:t.search,callback:function(a){t.search=a},expression:"search"}},[e("FormItem",{attrs:{label:"姓名","label-width":100}},[e("Input",{attrs:{placeholder:"姓名"},model:{value:t.search.name,callback:function(a){t.$set(t.search,"name",a)},expression:"search.name"}})],1),t._v(" "),e("FormItem",{attrs:{"label-width":1}},[e("Button",{attrs:{type:"primary",icon:"ios-search"},on:{click:t.getLists}},[t._v("搜索")]),t._v(" "),e("Button",{attrs:{type:"success",icon:"ios-add"},on:{click:function(a){return t.openComponent("Create")}}},[t._v("添加")])],1)],1),t._v(" "),e("i-table",{attrs:{current:t.page.current,total:t.page.total},on:{"on-page-change":t.pageChange}},[e("Table",{attrs:{columns:t.table.columns,data:t.table.data},scopedSlots:t._u([{key:"name",fn:function(a){var n=a.row;return a.index,[e("span",[t._v(t._s(n.name))])]}},{key:"email",fn:function(a){var n=a.row;return a.index,[e("span",[t._v(t._s(n.email))])]}},{key:"phone",fn:function(a){var n=a.row;return a.index,[e("span",[t._v(t._s(n.phone))])]}},{key:"role",fn:function(a){var n=a.row;return a.index,[e("span",[t._v(t._s(n.role.name))])]}},{key:"sex",fn:function(a){var n=a.row;return a.index,[e("span",[t._v(t._s(n.sex))])]}},{key:"birthday",fn:function(a){var n=a.row;return a.index,[e("span",[t._v(t._s(n.birthday))])]}},{key:"entryday",fn:function(a){var n=a.row;return a.index,[e("span",[t._v(t._s(n.entryday))])]}},{key:"status",fn:function(a){var n=a.row;return a.index,[e("Poptip",{attrs:{confirm:"",title:"你确定要更改这个用户的状态吗？"},on:{"on-ok":function(a){return t.status(n)}}},[e("Button",{attrs:{type:"off"===n.status?"error":"success",size:"small"}},[t._v(t._s("off"===n.status?"关闭":"开启")+"\n                    ")])],1)]}},{key:"action",fn:function(a){var n=a.row;return a.index,[e("Button",{attrs:{type:"warning",size:"small"},on:{click:function(a){return t.openComponent("Update",n)}}},[t._v("编辑")])]}}])})],1),t._v(" "),e(t.component.is,{tag:"component",attrs:{props:t.component.prop},on:{"on-close":t.closeComponent,"on-refresh":function(a){return t.getLists(1)}}})],1)},[],!1,null,"23610404",null);a.default=v.exports},wbTh:function(t,a,e){(t.exports=e("I1BE")(!1)).push([t.i,"\n.modal-body[data-v-441e9ea6] {\n    height: calc(100% - 53px);\n    overflow-y: auto;\n    margin-right: -16px;\n    padding-right: 16px;\n}\n.compon-drawer-footer[data-v-441e9ea6]{\n    border-top: 1px solid #e8e8e8;\n    padding: 10px 16px;\n    text-align: right;\n    background: #fff;\n}\n.compon-drawer-footer *[data-v-441e9ea6]{\n    text-align: right;\n}\n",""])},x91n:function(t,a,e){"use strict";var n={name:"i-drawer",props:{title:{type:String,default:"弹窗"},width:{type:Number,default:520},loading:{type:Boolean,default:!1}},methods:{change:function(t){this.$parent.closeDrawer(t)}}},o=(e("CpXx"),e("KHd+")),r=Object(o.a)(n,function(){var t=this,a=t.$createElement,e=t._self._c||a;return e("Drawer",{attrs:{title:t.title,value:!0,transfer:!1,"mask-closable":!1,width:t.width},on:{"on-visible-change":t.change}},[e("div",{staticClass:"modal-body"},[t._t("default")],2),t._v(" "),e("div",{staticClass:"compon-drawer-footer"},[t._t("footer")],2),t._v(" "),t.loading?e("Spin",{attrs:{size:"large",fix:""}}):t._e()],1)},[],!1,null,"441e9ea6",null);a.a=r.exports}}]);